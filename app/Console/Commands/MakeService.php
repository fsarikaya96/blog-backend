<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Service Command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $implementationPath = app_path("Services/Backend/Implementations/{$name}.php");
        $interfacePath = app_path("Services/Backend/Interfaces/I{$name}.php");

        if (file_exists($implementationPath)) {
            $this->error("Implementation file '{$name}.php' already exists!");
            return;
        }

        if (file_exists($interfacePath)) {
            $this->error("Interface file 'I{$name}.php' already exists!");
            return;
        }

        $implementationContent = "<?php\n\nnamespace App\Services\Backend\Implementations;\n\nuse App\Services\Backend\Interfaces\I{$name};\n\nclass {$name} implements I{$name}\n{\n}";

        $interfaceContent = "<?php\n\nnamespace App\Services\Backend\Interfaces;\n\ninterface I{$name}\n{\n}";

        File::ensureDirectoryExists(app_path('Services/Backend/Implementations'));
        File::ensureDirectoryExists(app_path('Services/Backend/Interfaces'));

        File::put($implementationPath, $implementationContent);
        File::put($interfacePath, $interfaceContent);

        $this->info('--------------------------------');
        $this->info('Service created successfully.');
        $this->info('--------------------------------');
    }
}
