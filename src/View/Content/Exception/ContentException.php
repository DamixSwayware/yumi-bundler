<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Content\Exception;

use Throwable;

class ContentException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}