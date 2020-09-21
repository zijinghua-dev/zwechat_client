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
        return response()->json(
            $service->getOpenId($request->input('code'), config('wechat-client.wechat_app_id')),
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
        return response()->json(
            $service->getUnionId($request->input('code'), config('wechat-client.wechat_app_id')),
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
