<?php
/*
Copyright © Magd Almuntaser, OneXGen Technology. All rights reserved.
Project: MPWA Whatsapp Gateway | Multi Device
Licensed under the CC BY-NC-ND 4.0 License.
For details, visit https://creativecommons.org/licenses/by-nc-nd/4.0/.
*/

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       Paginator::useBootstrap();
       Model::preventLazyLoading(true);

       if (! $this->app->runningInConsole()) {
           $request = request();
           $basePath = rtrim($request->getBasePath(), '/');
           $rootUrl = rtrim($request->getSchemeAndHttpHost() . $basePath, '/');

           if (! empty($rootUrl)) {
               URL::forceRootUrl($rootUrl);
           }

           URL::forceScheme($request->getScheme());

           $theme = env('THEME_NAME', 'eres');
           $assetUrl = rtrim($rootUrl, '/') . '/themes/' . $theme;
           config(['app.asset_url' => $assetUrl]);
           app('url')->useAssetOrigin($assetUrl);

           Log::info('Installer assets', [
               'base_path' => $basePath,
               'root_url' => $rootUrl,
               'asset_url' => $assetUrl,
               'full_css' => asset('vendor/css/core.css'),
           ]);
       }
    }
}
