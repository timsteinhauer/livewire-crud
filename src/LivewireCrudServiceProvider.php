<?php

namespace Timsteinhauer\LivewireCrud;

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
        $this->app->afterResolving(BladeCompiler::class, function () {
            if (class_exists(Livewire::class)) {
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

        $this->publishing();

    }

    /**
     * Configure the Blade components.
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
    protected function publishing()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/timsteinhauer/livewirecrud'),
        ], 'livewirecrud-views');

        $this->callSilent('vendor:publish', ['--tag' => 'livewirecrud-views']);
    }



}