<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ServiceMakeCommand extends Command
{
    protected $signature = 'make:service {name}';
    protected $description = 'Create a new Service class in app/Http/Services';

    public function handle()
    {
        $name = $this->argument('name');
        $className = Str::studly($name);
        $directory = app_path('Http/Services');
        $path = $directory . '/' . $className . '.php';

        if (file_exists($path)) {
            $this->error('Service already exists!');
            return;
        }

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $stub = <<<PHP
<?php

namespace App\Http\Services;

class {$className}
{
    //
}
PHP;

        file_put_contents($path, $stub);

        $this->info("Service {$className} created successfully at app/Http/Services/");
    }
}
