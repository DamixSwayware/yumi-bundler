<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Exception;

class ViewException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}