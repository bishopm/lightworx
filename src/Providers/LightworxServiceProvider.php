<?php namespace Bishopm\Lightworx\Providers;

use Bishopm\Lightworx\Http\Middleware\AdminRoute;
use Bishopm\Lightworx\Livewire\Search;
use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Livewire\Livewire;

class LightworxServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        $router = $this->app['router'];
        $router->aliasMiddleware('adminonly', AdminRoute::class);
        Schema::defaultStringLength(191);
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'lightworx');
        Paginator::useBootstrapFive();
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../Http/routes.php');
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
        Livewire::component('search', Search::class);
        Blade::componentNamespace('Bishopm\\Lightworx\\Resources\\Views\\Components', 'lightworx');
        Config::set('auth.providers.users.model','Bishopm\Lightworx\Models\User');
    }

    /**
     * Register any lightworx services.
     *
     * @return void
     */
    public function register(): void
    {
        foreach (glob(__DIR__ . '/../Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['lightworx'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../../config/lightworx.php' => config_path('lightworx.php'),
        ], 'lightworx.config');

        // Publishing the views.
        // $this->publishes([
        //    __DIR__.'/../Resources' => public_path('vendor/bishopm'),
        // ], 'lightworx.views');

        // Publishes assets.
        $this->publishes([
            __DIR__.'/../Resources/assets' => public_path('lightworx'),
          ], 'assets');
        

        // Registering lightworx commands.
        $this->commands([
            'Bishopm\Lightworx\Console\Commands\InstallLightworx'
        ]);
    }
}
