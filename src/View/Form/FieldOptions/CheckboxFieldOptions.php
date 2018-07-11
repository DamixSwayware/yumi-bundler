<?php

namespace Yumi\Bundler\View\Form\FieldOptions;

use Yumi\Bundler\View\Form\FormFieldOptions;

/**
 * Class CheckboxFieldOptions
 * @package Yumi\Bundler\View\Form\FieldOptions
 * @author Reverze <hawkmedia24@gmail.com>
 * This file is a part of YumiBundler
 *
 */
class CheckboxFieldOptions extends FormFieldOptions
{
    /**
     * The checked attribute
     * @var string|null
     */
    public $checked = null;

    /**
     * Sets checkbox as checked by default
     * @return CheckboxFieldOptions
     */
    public function setAsChecked() : self
    {
        $this->checked = 'checked';
        return $this;
    }

    /**
     * Sets checkbox as not checked by default
     * @return CheckboxFieldOptions
     */
    public function setAsNotChecked() : self
    {
        $this->checked = null;
        return $this;
    }
}