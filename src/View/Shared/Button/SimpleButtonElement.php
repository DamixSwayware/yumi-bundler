<?php

namespace Yumi\Bundler\View\Shared\Button;


use Yumi\Bundler\View\ViewElement;

class SimpleButtonElement extends ViewElement
{
    public function __construct()
    {
        parent::__construct();

        $this->elementType = 'simple_button';
    }

    public function & render() : array
    {
        $result = parent::render();

        return $result;
    }
}