<?php
/*
 * @Author: yuyanli 603447409@qq.com
 * @Date: 2025-07-10 11:53:12
 * @LastEditors: yuyanli 603447409@qq.com
 * @LastEditTime: 2025-07-10 11:56:07
 * @FilePath: \tianditu-sdk\src\TiandituServiceProvider.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

namespace Alphathinkyyl\Tianditu;

use Illuminate\Support\ServiceProvider;
use Alphathinkyyl\Tianditu\Services\TiandituService;


class TiandituServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/tianditu.php', 'tianditu');

        $this->app->singleton(TiandituService::class, function ($app) {
            return new TiandituService(config('tianditu.api_key'));
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/tianditu.php' => config_path('tianditu.php'),
        ], 'config');
    }
}
