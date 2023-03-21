<?php

namespace Upbase\Jobtracking;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class JobtrackingServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     * @var bool
     */
    protected $defer = false;

    /**
     * @var string
     */
    protected $shortName = 'jobtracking';

    /**
     * Boot the service provider.
     * @return void
     */
    public function boot( Filesystem $filesystem)
    {
        $this->publishes([
            __DIR__.'/../database/migrations/create_jobtracking_tables.php.stub' => $this->getMigrationFileName($filesystem),
        ], 'migrations');
    }

    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        // Register config
        $this->registerConfig();

    }



    /**
     * Register config
     * @return void
     */
    protected function registerConfig()
    {
        $location = __DIR__ . '/../config/' . $this->shortName . '.php';

        $this->mergeConfigFrom(
            $location, $this->shortName
        );

        $this->publishes([
            $location => config_path($this->shortName . '.php'),
        ], 'config');
    }
    /**
     * Returns existing migration file if found, else uses the current timestamp.
     *
     * @param Filesystem $filesystem
     * @return string
     */
    protected function getMigrationFileName(Filesystem $filesystem): string
    {
        $timestamp = date('Y_m_d_His');

        return Collection::make($this->app->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR)
            ->flatMap(function ($path) use ($filesystem) {
                return $filesystem->glob($path.'*_create_jobtracking_tables.php');
            })->push($this->app->databasePath()."/migrations/{$timestamp}_create_jobtracking_tables.php")
            ->first();
    }

}
