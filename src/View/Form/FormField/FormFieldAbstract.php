<?php

namespace Yumi\Bundler\View\Form\FormField;

use Yumi\Bundler\View\Form\FormFieldOptions;

/**
 * Class FormFieldAbstract
 * @package Yumi\Bundler\View\Form\FormField
 * @author Reverze <hawkmedia24@gmail.com>
 *
 * This file is a part of YumiBundler
 *
 */
abstract class FormFieldAbstract
{
    protected $fieldName = null;

    protected $fieldType = null;

    protected $fieldOptions = null;

    protected $value = null;

    public function __construct(string $name, string $type, FormFieldOptions $options = null)
    {
        $this->fieldName = $name;
        $this->fieldType = $type;
        $this->fieldOptions = $options;
    }

    public function getName() : string
    {
        return $this->fieldName;
    }

    public function getType() : string
    {
        return $this->fieldType;
    }

    public function getOptions() : ?FormFieldOptions
    {
        return $this->fieldOptions;
    }

    public function hasOption(string $optionName) : bool
    {
        if ($this->fieldOptions === null){
            return false;
        }

        if (\property_exists($this->fieldOptions, $optionName)){
            return true;
        }

        return false;
    }

    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }
}