<?php

declare(strict_types=1);

namespace ESputnik;

use DtKt\ServiceManager\ServiceManager;
use ESputnik\ServiceProvider\EsputnikServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->singleton('esputnik', fn($app) => new ESputnikManager($app));
        $this->app->alias('esputnik', ESputnikManager::class);
        $this->app->bind(ESputnik::class, fn(Application $app) => $app
            ->make(ESputnikManager::class)->driver());

        $path = dirname(__DIR__).'/config/config.php';

        $this->mergeConfigFrom($path, 'esputnik');

        $this->publishes([$path => config_path('esputnik.php')], 'config');

        $this->app->extend(ServiceManager::class, fn(ServiceManager $manager) => $manager
            ->extend(EsputnikServiceProvider::class));
    }

    public function provides(): array
    {
        return ['esputnik', ESputnik::class, ESputnikManager::class];
    }
}
