<?php
namespace Prettus\Repository\Generators\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Prettus\Repository\Generators\ServiceGenerator;
use Prettus\Repository\Generators\FileAlreadyExistsException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ServiceCommand extends Command
{

    /**
     * The name of command.
     *
     * @var string
     */
    protected $name = 'make:service';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Create a new RESTfull service.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Service';


    /**
     * Execute the command.
     *
     * @return void
     */
    public function fire()
    {
        try {

            (new ServiceGenerator([
                'name' => $this->argument('name'),
                'force' => $this->option('force'),
            ]))->run();
            $this->info($this->type . ' created successfully.');
        } catch (FileAlreadyExistsException $e) {
            $this->error($this->type . ' already exists!');

            return false;
        }
    }


    /**
     * The array of command arguments.
     *
     * @return array
     */
    public function getArguments()
    {
        return [
            [
                'name',
                InputArgument::REQUIRED,
                'The name of model for which the service is being generated.',
                null
            ],
        ];
    }


    /**
     * The array of command options.
     *
     * @return array
     */
    public function getOptions()
    {
        return [
            [
                'force',
                'f',
                InputOption::VALUE_NONE,
                'Force the creation if file already exists.',
                null
            ],
        ];
    }
}
