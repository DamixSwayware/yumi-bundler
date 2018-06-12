<?php

/**
 * This file is a part of YumiBundler
 *
 * @Author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Shared\Header;

class SecondHeaderElement extends HeaderElement
{
    public function __construct()
    {
        parent::__construct();

        $this->elementType = 'second_header_element';
    }
}