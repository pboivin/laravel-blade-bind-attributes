<?php

namespace Pboivin\LaravelBladeBindAttributes;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\View\DynamicComponent;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->extendBladeCompiler();
    }

    public function extendBladeCompiler()
    {
        $this->app->singleton('blade.compiler', function ($app) {
            return tap(new BladeCompiler(
                $app['files'],
                $app['config']['view.compiled'],
                $app['config']->get('view.relative_hash', false) ? $app->basePath() : '',
                $app['config']->get('view.cache', true),
                $app['config']->get('view.compiled_extension', 'php'),
            ), function ($blade) {
                $blade->component('dynamic-component', DynamicComponent::class);
            });
        });
    }
}
