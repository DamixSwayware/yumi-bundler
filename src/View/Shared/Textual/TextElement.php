<?php

/**
 * This file is a part of YumiBundler
 *
 * @Author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Shared\Textual;


use Yumi\Bundler\View\ViewElement;

class TextElement extends ViewElement
{
    public function __construct()
    {
        parent::__construct();

        $this->elementType = 'text_element';
    }
}