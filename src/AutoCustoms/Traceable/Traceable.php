<?php

namespace AutoCustoms\Traceable;

use AutoCustoms\Traceable\Events\Trace;

/**
 * Class Traceable
 *
 * @package App\Foundation
 */
trait Traceable
{
    /**
     * @param mixed $message
     * @param int   $level
     */
    public function trace($message, $level = Trace::LINE)
    {
        self::sTrace($message, $level);
    }

    /**
     * Static trace method for use in static methods
     *
     * @param mixed $message
     * @param int   $level
     */
    public static function sTrace($message, $level = Trace::LINE)
    {
        $event = new Trace($message, $level);
        event($event);
    }
}