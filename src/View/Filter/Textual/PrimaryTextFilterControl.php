<?php

/**
 * This file is a part of YumiBundler
 *
 * @Author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Filter\Textual;

use Yumi\Bundler\View\Filter\FilterControl;

class PrimaryTextFilterControl extends FilterControl
{
    public function process(): bool
    {
        return true;
    }
}