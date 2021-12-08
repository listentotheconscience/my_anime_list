<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Symfony\Component\Console\Input\InputOption;

class MakeRepository extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name} {--model=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make repository';

    protected $type = 'Repository';

    protected $composer;

    public function __construct(Filesystem $files, Composer $composer)
    {
        parent::__construct($files);

        $this->composer = $composer;
    }

    protected function getStub()
    {
        return base_path('stubs/repository.stub');
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Repositories';
    }


    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)->replaceClass($this->replaceModel($stub), $name);
    }

    protected function replaceModel($stub): string
    {
        $model = $this->option('model');

        return str_replace('{{ model }}', $model, $stub);
    }

    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Create the class even if it already exists'],
            ['model', null, InputOption::VALUE_REQUIRED, 'Set model']
        ];
    }

    protected function getArguments()
    {
        return [
            ['name']
        ];
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        parent::handle();
        app()->make(Composer::class)->dumpAutoloads();
    }
}
