<?php

namespace Yumi\Bundler\View\Form\FieldOptions;

use Yumi\Bundler\View\Form\FormFieldOptions;

/**
 * Class RadioButtonFieldOptions
 * @package Yumi\Bundler\View\Form\FieldOptions
 * @author Reverze <hawkmedia24@gmail.com>
 *
 * This file is a part of YumiBundler
 *
 */
class RadioButtonFieldOptions extends FormFieldOptions
{
    /**
     * The checked attribute
     * @var string|null
     */
    public $checked = null;

    /**
     * Sets radio as checked by default
     * @return RadioButtonFieldOptions
     */
    public function setAsChecked() : self
    {
        $this->checked = 'checked';
        return $this;
    }

    /**
     * Sets radio as not checked by default
     * @return RadioButtonFieldOptions
     */
    public function setAsNotChecked() : self
    {
        $this->checked = null;
        return $this;
    }
}