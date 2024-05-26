<?php

namespace Koungmeng\Rpsg5;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Command;

class RpsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->handlePublishing();
        }
    }

    public function handlePublishing()
    {
        $this->publishes([
            __DIR__ . '/stubs' => base_path('/')
        ], 'Rpsg5');
    }

    protected function handlePostPublishing()
    {
        if ($this->confirmPublishing()) {
            $this->publishFiles();
            $this->runMigrations();
            $this->installNpmPackages();
        }
    }

    /**
     * Confirm the package publishing.
     *
     * @return bool
     */
    protected function confirmPublishing()
    {
        $confirmed = $this->command->confirm('This will overwrite any existing files in your project. Are you sure you want to proceed?', false);

        if (!$confirmed) {
            $this->command->info('Publishing canceled.');
        }

        return $confirmed;
    }

    /**
     * Publish the package files.
     *
     * @return void
     */
    protected function publishFiles()
    {
        $this->callSilent('vendor:publish', ['--provider' => 'Koungmeng\Rpsg5\RpsServiceProvider', '--tag' => 'rpsg5', '--force' => true]);
    }

    /**
     * Run the database migrations.
     *
     * @return void
     */
    protected function runMigrations()
    {
        $this->command->info('Running database migrations...');
        Artisan::call('migrate', ['--force' => true]);
    }

    /**
     * Install NPM packages.
     *
     * @return void
     */
    protected function installNpmPackages()
    {
        $this->command->info('Installing NPM packages...');
        chdir(base_path());
        exec('npm install');
    }
}
