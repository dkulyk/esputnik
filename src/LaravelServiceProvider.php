<?php
declare(strict_types=1);

namespace ESputnik;

use Illuminate\Support\ServiceProvider;

/**
 * Class LaravelServiceProvider
 * @package ESputnik\src
 */
class LaravelServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function register(): void
    {
        $this->app->singleton('esputnik', function () {
            $book = (int)config('esputnik.book');
            return ESputnik::instance(
                config('esputnik.user', ''),
                config('esputnik.password', ''),
                $book ? null : $book
            );
        });

        $this->app->alias('esputnik', ESputnik::class);

        $path = \dirname(__DIR__) . '/config/config.php';

        $this->mergeConfigFrom($path, 'esputnik');

        $this->publishes([$path => config_path('esputnik.php')], 'config');
    }

    /**
     * @return array
     */
    public function provides(): array
    {
        return ['esputnik', ESputnik::class];
    }
}
