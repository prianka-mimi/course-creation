<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeModule extends Command
{
    protected $signature = 'make:module {name}';

    protected $description = 'Create a new module with blade files from stubs';

    protected $files;

    public function __construct()
    {
        parent::__construct();
        $this->files = new Filesystem();
    }

    public function handle()
    {
        $moduleName = $this->argument('name');
        $basePath = resource_path("views/backend/modules/{$moduleName}");
        $partialsPath = "{$basePath}/partials";

        if ($this->files->exists($basePath)) {
            $this->error("Module '{$moduleName}' already exists!");
            return 1;
        }

        // Create directories
        $this->files->makeDirectory($basePath, 0755, true);
        $this->files->makeDirectory($partialsPath, 0755, true);

        // List of blade files to create
        $bladeFiles = [
            'create.blade.php' => 'module/create.blade.stub',
            'edit.blade.php' => 'module/edit.blade.stub',
            'index.blade.php' => 'module/index.blade.stub',
            'show.blade.php' => 'module/show.blade.stub',
            'partials/_form.blade.php' => 'module/partials/_form.blade.stub',
        ];

        foreach ($bladeFiles as $fileName => $stubPath) {
            $stubFullPath = base_path("stubs/{$stubPath}");
            if (!$this->files->exists($stubFullPath)) {
                $this->error("Stub file {$stubPath} not found!");
                return 1;
            }
            $stubContent = $this->files->get($stubFullPath);
            $content = str_replace('{{module}}', $moduleName, $stubContent);
            $filePath = "{$basePath}/{$fileName}";
            $this->files->put($filePath, $content);
            $this->info("Created: {$filePath}");
        }

        $this->info("Module '{$moduleName}' created successfully.");
        return 0;
    }
}
