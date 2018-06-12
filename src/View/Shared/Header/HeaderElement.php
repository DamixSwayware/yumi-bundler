<?php

/**
 * This file is a part of YumiBundler
 *
 * @Author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Shared\Header;

use Yumi\Bundler\View\ViewElement;

abstract class HeaderElement extends ViewElement
{
    private $text = null;

    public function setText(?string $text) : self
    {
        $this->text = $text;
        return $this;
    }

    public function getText() : ?string
    {
        return $this->text;
    }
}