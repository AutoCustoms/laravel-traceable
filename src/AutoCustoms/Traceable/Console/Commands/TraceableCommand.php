<?php

namespace AutoCustoms\Traceable\Console\Commands;

use AutoCustoms\Traceable\Listeners\TraceStdOut;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class TraceableCommand extends Command
{
    /**
     * TraceableCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $arg = new InputOption('trace', 't', InputOption::VALUE_NONE, 'Write trace output to stdout');
        $this->getDefinition()->addOption($arg);
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        if ($this->option('trace')) {
            app('events')->listen('AutoCustoms\\Traceable\\Events\\Trace', [new TraceStdOut($this->output), 'handle']);
        }
    }
}

