<?php

namespace Zijinghua\Zwechat\Client\Services\Wechat;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Zijinghua\Zwechat\Client\Exceptions\InvalidConfigException;
use \Zijinghua\Zwechat\Client\Exceptions\Wechat\InvalidCodeException;

/**
 * @method array getOpenId(string $code, string $appId)
 * @method array getUnionId(string $code, string $appId)
 */
class SnsService
{
    protected $client;
    public $statusCode = 200;

    public function __construct()
    {
        $baseUrl = config('wechat-client.base_url');
        if (!$baseUrl) {
            throw new \Zijinghua\Zwechat\Client\Exceptions\InvalidConfigException('请配置wechat-client.base_url');
        }
        $this->client = new Client([
            'base_uri' => $baseUrl,
            'headers' => [
                'Accept' => 'application/json'
            ]
        ]);
    }

    public function __call($name, $arguments)
    {
        if (count($arguments)<2) {
            throw new \InvalidArgumentException('请传入code和app_id');
        }
        if (!isset($arguments[1]) || !$arguments[1]) {
            throw new \InvalidArgumentException('请传入app_id');
        }
        $api = '';
        switch ($name) {
            case 'getOpenId':
                $api = 'open_id';
                break;
            case 'getUnionId':
                $api = 'union_id';
                break;
        }
        try {
            $query = http_build_query(['code'=>$arguments[0], 'app_id' => $arguments[1]]);
            $response = $this->client->get(config("wechat-client.apis.$api").'?'.$query);
        } catch (RequestException $exception) {
            $response = $exception->getResponse();
        }
        $responseData = json_decode($response->getBody()->getContents(), true);
        if (is_array($responseData) && isset($responseData['errors'])) {
            throw new InvalidCodeException(@$responseData['errors']['message'], is_array($responseData)? $responseData:[$responseData]);
        }

        $this->statusCode = $response->getStatusCode();

        return $responseData;
    }

    public function jssdkConfig(string $appId, string $url)
    {
        try {
            $query = http_build_query(['app_id'=>$appId, 'url' => $url]);
            $response = $this->client->get(config("wechat-client.apis.jssdk_config").'?'.$query);
        } catch (RequestException $exception) {
            $response = $exception->getResponse();
        }

        $this->statusCode = $response->getStatusCode();
        return json_decode($response->getBody()->getContents(), true);
    }
}
