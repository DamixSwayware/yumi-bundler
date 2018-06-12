<?php

/**
 * This file is a part of YumiBundler
 *
 * @Author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Shared\Header;

class ThirdHeaderElement extends HeaderElement
{
    public function __construct()
    {
        parent::__construct();

        $this->elementType = 'third_header_element';
    }
}