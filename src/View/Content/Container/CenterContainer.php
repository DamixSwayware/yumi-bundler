<?php

namespace Yumi\Bundler\View\Content\Container;

use Yumi\Bundler\View\ViewElement;

class CenterContainer extends Container
{
    public function __construct()
    {
        parent::__construct();

        $this->elementType = 'center_container';

    }

    public function & render() : array
    {
        $result =  parent::render();
        return $result;
    }
}