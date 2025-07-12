<?php

namespace Modules\Blog\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            module_path('Blog', 'Config/config.php'), 'blog'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(module_path('Blog', 'Routes/web.php'));
        $this->loadViewsFrom(module_path('Blog', 'Resources/views'), 'blog');
        $this->loadMigrationsFrom(module_path('Blog', 'Database/Migrations'));
        $this->loadTranslationsFrom(module_path('Blog', 'Resources/lang'), 'blog');

        $this->publishes([
            module_path('Blog', 'Config/config.php') => config_path('blog.php'),
        ], 'blog-config');
    }
}
