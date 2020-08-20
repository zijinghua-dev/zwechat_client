<?php
namespace Zijinghua\Zwechat\Client;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                realpath(__DIR__.'/../publishable/config/wechat-client.php') => config_path('wechat-client.php')
            ], 'config');
        }
        $this->loadRoutesFrom(realpath(__DIR__.'/../publishable/routes/api.php'));
    }
}
