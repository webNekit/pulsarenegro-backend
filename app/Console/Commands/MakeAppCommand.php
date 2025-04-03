<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeAppCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:app {name} {--show} {--all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new application structure with views, controller and service provider registration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = Str::lower($this->argument('name'));
        $studlyName = Str::studly($name);
        $withShow = $this->option('show') || $this->option('all');

        // 1. Create view directories
        $this->createViewStructure($name, $withShow);

        // 2. Generate controller
        $this->generateController($studlyName, $withShow);

        // 3. Update AppServiceProvider
        $this->updateServiceProvider($name);

        $this->info("Application '$name' created successfully!");
        $this->line("Don't forget to register routes for {$studlyName}Controller!");
    }

    protected function createViewStructure($name, $withShow)
    {
        $viewsPath = resource_path("views/website/{$name}");

        if (!File::exists($viewsPath)) {
            File::makeDirectory($viewsPath, 0755, true);
            $this->info("Created views directory: {$viewsPath}");
        }

        // Create index.blade.php
        $indexPath = "{$viewsPath}/index.blade.php";
        if (!File::exists($indexPath)) {
            File::put($indexPath, $this->generateIndexBlade($name));
            $this->info("Created view: {$indexPath}");
        }

        if ($withShow) {
            // Create show.blade.php
            $showPath = "{$viewsPath}/show.blade.php";
            if (!File::exists($showPath)) {
                File::put($showPath, $this->generateShowBlade($name));
                $this->info("Created view: {$showPath}");
            }
        }
    }

    protected function generateController($studlyName, $withShow)
    {
        $controllerDir = app_path("Http/Controllers/{$studlyName}");
        $controllerPath = "{$controllerDir}/{$studlyName}Controller.php";

        if (!File::exists($controllerDir)) {
            File::makeDirectory($controllerDir, 0755, true);
            $this->info("Created controller directory: {$controllerDir}");
        }

        if (!File::exists($controllerPath)) {
            $controllerContent = $this->generateControllerContent($studlyName, $withShow);
            File::put($controllerPath, $controllerContent);
            $this->info("Created controller: {$controllerPath}");
        }
    }

    protected function updateServiceProvider($name)
    {
        $providerPath = app_path('Providers/AppServiceProvider.php');
        $providerContent = File::get($providerPath);

        $newLine = "\$this->loadViewsFrom(base_path('resources/views/website/{$name}'), '{$name}');";

        // Check if line already exists
        if (str_contains($providerContent, $newLine)) {
            $this->line("View registration for '{$name}' already exists in AppServiceProvider");
            return;
        }

        // Find boot() method and add our line before closing brace
        $updatedContent = preg_replace_callback(
            '/public function boot\(\):\s*void\s*\{([^\}]*)\}/s',
            function ($matches) use ($newLine) {
                $existingContent = trim($matches[1]);
                $indentation = strspn($existingContent, " \t") > 0 ?
                    substr($existingContent, 0, strspn($existingContent, " \t")) : "\t\t";

                return "public function boot(): void\n\t{\n{$matches[1]}{$indentation}{$newLine}\n\t}";
            },
            $providerContent
        );

        File::put($providerPath, $updatedContent);
        $this->info("Added view registration to AppServiceProvider for '{$name}'");
    }

    protected function generateIndexBlade($name)
    {
        $title = Str::title(str_replace('_', ' ', $name));
        return <<<BLADE
<x-app :title="\$title">
    <h1>{{ \$title }}</h1>
    <!-- Your {$title} index content here -->
</x-app>
BLADE;
    }

    protected function generateShowBlade($name)
    {
        $title = Str::title(str_replace('_', ' ', $name));
        return <<<BLADE
<x-app :title="\$title">
    <h1>{{ \$title }} Details</h1>
    <!-- Your {$title} show content here -->
</x-app>
BLADE;
    }

    protected function generateControllerContent($studlyName, $withShow)
    {
        $lowerName = Str::lower($studlyName);
        $showMethod = $withShow ? "\n\n    public function show()\n    {\n        return view('{$lowerName}::show', ['title' => '{$studlyName} Show']);\n    }" : '';

        return <<<PHP
<?php

namespace App\Http\Controllers\\{$studlyName};

use App\Http\Controllers\Controller;

class {$studlyName}Controller extends Controller
{
    public function index()
    {
        return view('{$lowerName}::index', ['title' => '{$studlyName}']);
    }{$showMethod}
}
PHP;
    }
}
