<?php
/**
 * @return null | string
 */
function getAuth()
{
    return config('wechat-client.current_auth_guard');
}
