<?php

namespace AutoCustoms\Traceable\Events;

class Trace extends Event
{
    const LINE = 0;
    const INFO = 1;
    const COMMENT = 2;
    const QUESTION = 4;
    const ERROR = 8;

    /**
     * @var mixed
     * @access protected
     */
    protected $message;

    /**
     * @var integer
     * @access protected
     */
    protected $level;

    /**
     * Create a new event instance.
     *
     * @param mixed $msg
     * @param int   $level
     */
    public function __construct($msg, $level = self::LINE)
    {
        $this->message = $msg;
        $this->level   = $level;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
