<?php

namespace Yumi\Bundler\View\Shared\Textual;
use Yumi\Bundler\View\ViewElement;

/**
 * Class HiddenInputElement
 * @package Yumi\Bundler\View\Shared\Textual
 *
 * @author Reverze <hawkmedia24@gmail.com>
 * This file is a part of YumiBundler
 */
class HiddenInputElement extends ViewElement
{
    public function __construct()
    {
        parent::__construct();

        $this->elementType = 'hidden_element';
    }

    public function & render() : array
    {
        $result = parent::render();

        return $result;
    }
}