<?php

namespace AutoCustoms\Traceable\Listeners;

use AutoCustoms\Traceable\Events\Trace;
use Illuminate\Console\OutputStyle;

class TraceStdOut
{
    /**
     * @var Symfony\Component\Console\Output\OutputInterface
     * @access protected
     */
    protected $output;

    /**
     * TraceStdOut constructor.
     *
     * @param OutputStyle $output
     */
    public function __construct(OutputStyle $output)
    {
        $this->output = $output;
    }

    /**
     * Handle the event.
     *
     * @param  Trace  $event
     * @return void
     */
    public function handle(Trace $event)
    {
        if (!is_string($event->getMessage())) {
            dump($event->getMessage());
        } else {
            switch ($event->getLevel()) {
                case Trace::LINE:
                    $style = null;
                    break;
                case Trace::INFO:
                    $style = 'info';
                    break;
                case Trace::COMMENT:
                    $style = 'comment';
                    break;
                case Trace::QUESTION:
                    $style = 'question';
                    break;
                case Trace::ERROR:
                    $style = 'error';
                    break;
                default:
                    $style = null;
                    break;
            }

            $this->line($event->getMessage(), $style);
        }
    }

    /**
     * @param      $string
     * @param null $style
     */
    protected function line($string, $style = null)
    {
        $styled = $style ? "<$style>$string</$style>" : $string;

        $this->output->writeln($styled);
    }
}
