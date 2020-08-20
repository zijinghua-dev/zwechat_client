<?php

Route::middleware(['api'])->prefix('api/zijinghua/wechat/client')->group(function () {
    Route::get('open-id', 'Zijinghua\Zwechat\Client\Http\Controllers\Api\Wechat@openId');
    Route::get('union-id', 'Zijinghua\Zwechat\Client\Http\Controllers\Api\Wechat@unionId');
    Route::get('jssdk-config', 'Zijinghua\Zwechat\Client\Http\Controllers\Api\Wechat@jssdkConfig');
    Route::get('redirect-url', 'Zijinghua\Zwechat\Client\Http\Controllers\Api\Wechat@redirectUrl');
});
