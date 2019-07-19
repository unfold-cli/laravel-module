<?php

namespace StubVendor\StubPackage;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use StubVendor\StubPackage\Models\StubModel;
use StubVendor\StubPackage\Policies\StubPackagePolicy;

class StubPackageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->registerRoutes();
        $this->publishesConfig();
        $this->registerViews();
        $this->registerMigrations();
        $this->registerTranslations();

        Gate::policy(StubModel::class, Stub-modelPolicy::class);

//        $this->registerDirectives();
    }


    /**
     * Publishes config
     */
    public function publishesConfig()
    {
        $this->publishes([__DIR__.'/../config/stub-model.php' => config_path('stub-model.php')], ['stub-model', 'stub-model-config']);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/stub-model.php', 'stub-model');
    }


    /**
     * Register Routes
     */
    public function registerRoutes()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/routes.php');
    }

    /**
     * Register Views
     */
    public function registerViews()
    {
        $this->publishes([__DIR__.'/../resources/views' => resource_path('views/vendor/stub-model')], ['stub-model', 'stub-model-views']);
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'stub-model');
    }


    /**
     * Register Migrations
     */
    public function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->publishes([__DIR__.'/../database/migrations' => database_path('migrations')], ['stub-model', 'stub-model-migrations']);
    }


    /**
     * Register Translations
     */
    public function registerTranslations()
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'stub-model');
        $this->publishes([__DIR__.'/../resources/lang' => resource_path('lang/vendor/stub-model')], ['stub-model', 'stub-model-lang']);
    }


    /**
     * Register commands.
     */
    public function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                FooCommand::class,
                BarCommand::class,
            ]);
        }
    }


    /**
     * Register Directives
     */
    public function registerDirectives()
    {
        Blade::directive('datetime', function ($expression) {
            return "<?php echo ($expression)->format('m/d/Y H:i'); ?>";
        });

        Blade::if('env', function ($environment) {
            return app()->environment($environment);
        });
    }

}
