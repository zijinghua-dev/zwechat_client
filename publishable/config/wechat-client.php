<?php
return [
    'base_url' => rtrim(env('WECHAT_SERVER_CENTER_BASE_URL')).'/',
    'apis' => [
        'open_id' => env('WECHAT_SERVER_CENTER_API_OPEN_ID', 'api/zijinghua/wechat/open-id'),
        'union_id' => env('WECHAT_SERVER_CENTER_API_UNION_ID', 'api/zijinghua/wechat/union-id'),
        'jssdk_config' => env('WECHAT_SERVER_CENTER_API_JSSDK_CONFIG', 'api/zijinghua/wechat/jssdk-config'),
    ],
    'wechat_app_id' => env('WECHAT_APP_ID'),
    'current_auth_guard' => env('CURRENT_AUTH_GUARD', 'api')
];
