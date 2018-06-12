<?php

/**
 * This file is a part of YumiBundler
 *
 * @Author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Shared\Header;

class FourthHeaderElement extends HeaderElement
{
    public function __construct()
    {
        parent::__construct();

        $this->elementType = 'fourth_header_element';
    }
}