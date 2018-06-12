<?php

/**
 * This file is a part of YumiBundler
 *
 * @Author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Shared\Header;

class FifthHeaderElement extends HeaderElement
{
    public function __construct()
    {
        parent::__construct();

        $this->elementType = 'fifth_header_element';
    }
}