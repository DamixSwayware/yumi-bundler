<?php
/**
 * This file is a part of YumiBundler
 *
 * @Author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Filter;

use Yumi\Bundler\View\ViewElement;

abstract class FilterControl extends ViewElement
{
    protected $value = null;

    public function __construct()
    {
        parent::__construct();
    }

    abstract public function  process() : bool;

    public function setValue($value) : self
    {
        $this->value = empty($value) ? null : $value;
        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    protected function throwValueIsNotString() : void
    {
        throw new FilterException('The requested value is not a string');
    }

}

