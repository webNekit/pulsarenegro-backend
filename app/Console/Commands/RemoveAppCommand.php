<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class RemoveAppCommand extends Command
{
    protected $signature = 'remove:app {name} {--force : Force removal without confirmation}';
    protected $description = 'Remove application structure (views, controller and service provider registration)';

    public function handle()
    {
        $name = Str::lower($this->argument('name'));
        $studlyName = Str::studly($name);

        if (!$this->option('force') && !$this->confirm("Are you sure you want to remove application '$name'?")) {
            $this->info('Operation cancelled');
            return;
        }

        // 1. Remove views
        $this->removeViews($name);

        // 2. Remove controller
        $this->removeController($studlyName);

        // 3. Remove from AppServiceProvider
        $this->removeFromServiceProvider($name);

        $this->info("Application '$name' removed successfully!");
    }

    protected function removeViews($name)
    {
        $viewsPath = resource_path("views/website/{$name}");

        if (File::exists($viewsPath)) {
            File::deleteDirectory($viewsPath);
            $this->info("Removed views directory: {$viewsPath}");
        } else {
            $this->line("Views directory not found: {$viewsPath}");
        }
    }

    protected function removeController($studlyName)
    {
        $controllerPath = app_path("Http/Controllers/{$studlyName}");

        if (File::exists($controllerPath)) {
            File::deleteDirectory($controllerPath);
            $this->info("Removed controller directory: {$controllerPath}");
        } else {
            $this->line("Controller directory not found: {$controllerPath}");
        }
    }

    protected function removeFromServiceProvider($name)
    {
        $providerPath = app_path('Providers/AppServiceProvider.php');

        if (!File::exists($providerPath)) {
            $this->error('AppServiceProvider.php not found!');
            return;
        }

        $providerContent = File::get($providerPath);
        $searchLine = "\$this->loadViewsFrom(base_path('resources/views/website/{$name}'), '{$name}');";

        if (str_contains($providerContent, $searchLine)) {
            $updatedContent = str_replace($searchLine, '', $providerContent);
            File::put($providerPath, $updatedContent);
            $this->info("Removed view registration from AppServiceProvider for '{$name}'");
        } else {
            $this->line("View registration not found in AppServiceProvider for '{$name}'");
        }
    }
}
