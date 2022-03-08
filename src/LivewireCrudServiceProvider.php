<?php

namespace Timsteinhauer\LivewireCurd;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;

class LivewireCrudServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/jetstream.php', 'jetstream');

        $this->app->afterResolving(BladeCompiler::class, function () {
            if (config('jetstream.stack') === 'livewire' && class_exists(Livewire::class)) {
                Livewire::component('crud-index', CrudMain::class);

            }
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'livewirecrud');

        $this->configureComponents();
        $this->configurePublishing();

        # $this->configureCommands();

    }

    /**
     * Configure the Jetstream Blade components.
     *
     * @return void
     */
    protected function configureComponents()
    {
        $this->callAfterResolving(BladeCompiler::class, function () {

            // form field
            Blade::component('livewirecrud::forms.field', 'crud-field');

            // components
            $this->registerComponent('index');
        });
    }

    /**
     * Register the given component.
     *
     * @param  string  $component
     * @return void
     */
    protected function registerComponent(string $component)
    {
        Blade::component('livewirecrud::components.'.$component, 'crud-'.$component);
    }

    /**
     * Configure publishing for the package.
     *
     * @return void
     */
    protected function configurePublishing()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__.'/../stubs/config/jetstream.php' => config_path('jetstream.php'),
        ], 'jetstream-config');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/jetstream'),
        ], 'jetstream-views');

        $this->publishes([
            __DIR__.'/../database/migrations/2014_10_12_000000_create_users_table.php' => database_path('migrations/2014_10_12_000000_create_users_table.php'),
        ], 'jetstream-migrations');

        $this->publishes([
            __DIR__.'/../database/migrations/2020_05_21_100000_create_teams_table.php' => database_path('migrations/2020_05_21_100000_create_teams_table.php'),
            __DIR__.'/../database/migrations/2020_05_21_200000_create_team_user_table.php' => database_path('migrations/2020_05_21_200000_create_team_user_table.php'),
            __DIR__.'/../database/migrations/2020_05_21_300000_create_team_invitations_table.php' => database_path('migrations/2020_05_21_300000_create_team_invitations_table.php'),
        ], 'jetstream-team-migrations');

        $this->publishes([
            __DIR__.'/../routes/'.config('jetstream.stack').'.php' => base_path('routes/jetstream.php'),
        ], 'jetstream-routes');

        $this->publishes([
            __DIR__.'/../stubs/inertia/resources/js/Pages/Auth' => resource_path('js/Pages/Auth'),
            __DIR__.'/../stubs/inertia/resources/js/Jetstream/AuthenticationCard.vue' => resource_path('js/Jetstream/AuthenticationCard.vue'),
            __DIR__.'/../stubs/inertia/resources/js/Jetstream/AuthenticationCardLogo.vue' => resource_path('js/Jetstream/AuthenticationCardLogo.vue'),
            __DIR__.'/../stubs/inertia/resources/js/Jetstream/Checkbox.vue' => resource_path('js/Jetstream/Checkbox.vue'),
            __DIR__.'/../stubs/inertia/resources/js/Jetstream/ValidationErrors.vue' => resource_path('js/Jetstream/ValidationErrors.vue'),
        ], 'jetstream-inertia-auth-pages');
    }


    /**
     * Configure the commands offered by the application.
     *
     * @return void
     */
    protected function configureCommands()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            Console\InstallCommand::class,
        ]);
    }


}