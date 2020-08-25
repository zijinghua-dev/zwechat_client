#初始化工作

>(1) 使用php artisan vendor:publish --provider='Zijinghua\Zwechat\Client\ServiceProvider'发布包

>(2) 根据实际需要，在.env中增加WECHAT_SERVER_CENTER_BASE_URL、WECHAT_APP_ID配置，格式如下:

 > - WECHAT_SERVER_CENTER_BASE_URL是微信服务中心的域名或ip
 > - WECHAT_APP_ID是微信app id
 
 #接口

(1) 接口：获取微信openid
>- API：api/zijinghua/wechat/client/open-id。
>- 请求方式：GET。
>- 请求参数：
>- >- code：微信授权code
>- 正常返回：{"open_id":"openid"}\
>- 异常返回：{"message":"message", "errors":{"code":"异常code","message":"message"}}

(2) 接口：获取微信unionid，
>- API：api/zijinghua/wechat/client/union-id。
>- 请求方式：GET。
>- 请求参数：
>- >- code：微信授权code
>- 正常返回：
```json
{
    "openid": "openid",
    "nickname": "昵称",
    "sex": 1,
    "language": "zh_CN",
    "city": "city",
    "province": "province",
    "country": "country",
    "headimgurl": "微信头像",
    "privilege": [],
    "unionid": "unionid"
}
```
                 
>- 异常返回：{"message":"message", "errors":{"code":"异常code","message":"message"}}

(3) 接口：获取微信jssdk配置，
>- API：api/zijinghua/wechat/client/jssdk-config。
>- 请求方式：GET。
>- 请求参数：
>- >- url：调用微信jssdk所在页面对应的URL；
>- >- js_apis：需要调用的微信jssdk，多个sdk之间用逗号隔开
>- 正常返回：
```json
{
    "debug": false,
    "beta": false,
    "jsApiList": [
        "updateAppMessageShareData",
        "updateTimelineShareData"
    ],
    "appId": "wxc6aecc4a0df02cda",
    "nonceStr": "eEoJwxRBFi",
    "timestamp": 1597213070,
    "url": "http://local.d2p.shop:8000",
    "signature": "e094e67b7b37484f1507ab342d969dd1dedce04c"
}
```


(4) 接口：获取跳转到微信授权的url，
>- API：api/zijinghua/wechat/client/redirect-url。
>- 请求方式：GET。
>- 请求参数：
>- >- url：调用微信jssdk所在页面对应的URL；
>- >- js_apis：需要调用的微信jssdk，多个sdk之间用逗号隔开
>- 正常返回：
```json
{
    "debug": false,
    "beta": false,
    "jsApiList": [
        "updateAppMessageShareData",
        "updateTimelineShareData"
    ],
    "appId": "wxc6aecc4a0df02cda",
    "nonceStr": "eEoJwxRBFi",
    "timestamp": 1597213070,
    "url": "http://local.d2p.shop:8000",
    "signature": "e094e67b7b37484f1507ab342d969dd1dedce04c"
}
```
