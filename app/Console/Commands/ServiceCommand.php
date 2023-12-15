<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;

class ServiceCommand extends GeneratorCommand
{

    protected $signature = 'make:service {name}';
    protected $type = 'Service';

    protected $description = 'Create a new service class';

    protected function getStub(): string
    {
        return __DIR__ .'/../../../stubs/service.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Services';
    }
}
