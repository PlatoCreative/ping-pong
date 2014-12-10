<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 12/10/14
 * Time: 4:35 AM
 */

namespace Ping\Providers;


use Illuminate\Support\ServiceProvider;

class WebServiceProvider extends ServiceProvider{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $webPath = app_path().'/Core/Web';
        $this->app['view']->addNamespace('Web', $webPath.'/Views/');

        require $webPath.'/routes.php';
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}