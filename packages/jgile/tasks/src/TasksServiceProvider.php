<?php

namespace Jgile\Tasks;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Jgile\Tasks\Models\Tasks;
use Jgile\Tasks\Policies\TasksPolicy;

class TasksServiceProvider extends ServiceProvider
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

        Gate::policy(Tasks::class, TasksPolicy::class);

//        $this->registerDirectives();
    }


    /**
     * Publishes config
     */
    public function publishesConfig()
    {
        $this->publishes([__DIR__.'/../config/tasks.php' => config_path('tasks.php')], ['tasks', 'tasks-config']);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/tasks.php', 'tasks');
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
        $this->publishes([__DIR__.'/../resources/views' => resource_path('views/vendor/tasks')], ['tasks', 'tasks-views']);
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tasks');
    }


    /**
     * Register Migrations
     */
    public function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->publishes([__DIR__.'/../database/migrations' => database_path('migrations')], ['tasks', 'tasks-migrations']);
    }


    /**
     * Register Translations
     */
    public function registerTranslations()
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'tasks');
        $this->publishes([__DIR__.'/../resources/lang' => resource_path('lang/vendor/tasks')], ['tasks', 'tasks-lang']);
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
