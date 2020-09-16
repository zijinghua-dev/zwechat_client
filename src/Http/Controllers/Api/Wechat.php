<?php

namespace Zijinghua\Zwechat\Client\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Zijinghua\Zvoyager\Http\Services\GroupService;
use Zijinghua\Zwechat\Client\Http\Requests;
use Zijinghua\Zwechat\Client\Services\Wechat\SnsService;

class Wechat extends Controller
{
    /**
     * 获取微信open id
     * @param Requests\Wechat\OpenId $request
     * @param SnsService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function openId(Requests\Wechat\OpenId $request, SnsService $service)
    {
        $res = $service->getOpenId($request->input('code'), config('wechat-client.wechat_app_id'));
        if (floor($service->statusCode/200)==1 && isset($res['open_id'])) {
            $res['wechat_id'] = $res['open_id'];
            $res = array_reverse($res);
            $res = auth(getAuth())->attemptExternal($res);
            $group = (new GroupService())->getUserGroup($res['user']);
            return response()->json(
                ['token' => $res['token'], 'user_group'=>$group->id],
                $service->statusCode
            );
        }
        \Log::critical('调微信服务中心获取openid接口返回'.$service->statusCode, $res);
        return response()->json(
            $res,
            $service->statusCode
        );
    }

    /**
     * 获取微信union id
     * @param Requests\Wechat\OpenId $request
     * @param SnsService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function unionId(Requests\Wechat\OpenId $request, SnsService $service)
    {
        $res = $service->getUnionId($request->input('code'), config('wechat-client.wechat_app_id'));
        if (floor($service->statusCode/200)==1 && isset($res['unionid'])) {
            $res['wechat_id'] = $res['unionid'];
            $res = array_reverse($res);
            $res = auth(getAuth())->attemptExternal($res);
            $group = (new GroupService())->getUserGroup($res['user']);
            return response()->json(
                ['token' => $res['token'], 'user_group'=>$group->id],
                $service->statusCode
            );
        }
        \Log::critical('调微信服务中心获取unionid接口返回'.$service->statusCode, $res);
        return response()->json(
            $res,
            $service->statusCode
        );
    }

    /**
     * 获取调微信客户端调js sdk的配置
     * @param Requests\Wechat\JssdkConfig $request
     * @param SnsService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function jssdkConfig(Requests\Wechat\JssdkConfig $request, SnsService $service)
    {
        return response()->json(
            $service->jssdkConfig(
                config('wechat-client.wechat_app_id'),
                $request->input('url')
            ),
            $service->statusCode
        );
    }

    /**
     * @param Requests\Wechat\RedirectUrl $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function redirectUrl(Requests\Wechat\RedirectUrl $request)
    {
        if (!config('wechat-client.wechat_app_id')) {
            throw new \Zijinghua\Zwechat\Client\Exceptions\InvalidConfigException('请配置wechat-client.base_url');
        }
        $query = [
            'appid' => config('wechat-client.wechat_app_id'),
            'redirect_uri' => $request->input('redirect_url'),
            'response_type' => 'code',
            'scope' => $request->input('scope'),
            'state' => md5(time())
        ];

        return response()->json([
            'redirect_uri' => 'https://open.weixin.qq.com/connect/oauth2/authorize?'
                .http_build_query($query).'#wechat_redirect'
        ]);
    }
}
