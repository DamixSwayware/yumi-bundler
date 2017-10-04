<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Content\Container;

class GridContainer extends Container
{
    public function __construct()
    {
        parent::__construct();

        $this->elementType = 'grid_container';
    }

    public function & render() : array
    {
        return parent::render();
    }
}
