<?php

/**
 * This file is a part of YumiBundler
 *
 * @Author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Filter\Textual;

use Yumi\Bundler\View\Filter\FilterControl;

class UrlTextFilterControl extends FilterControl
{
    public function process(): bool
    {
        if ($this->value === null){
            return true;
        }

        if (!\is_string($this->value)){
            $this->throwValueIsNotString();
        }

        return (bool) \filter_var($this->value, FILTER_VALIDATE_URL);
    }

}