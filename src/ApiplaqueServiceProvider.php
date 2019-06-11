<?php


namespace Tcgv2\Apiplaque;


use Illuminate\Support\ServiceProvider;

class ApiplaqueServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ApiplaqueService::class, function () {
            return new ApiplaqueService(env('APIPLAQUE_TOKEN', 'demoxM'));
        });
    }
}