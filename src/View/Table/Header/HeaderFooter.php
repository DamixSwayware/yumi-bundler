<?php

/**
 * This file is a part of YumiBundler
 *
 * @Author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Table\Header;

use Yumi\Bundler\View\ViewElement;

class HeaderFooter extends ViewElement
{
    public function __construct()
    {
        parent::__construct();

        $this->elementType = 'table_header_footer';
    }
}