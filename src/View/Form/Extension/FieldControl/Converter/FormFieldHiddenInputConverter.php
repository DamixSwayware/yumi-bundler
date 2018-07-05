<?php

namespace Yumi\Bundler\View\Form\Extension\FieldControl\Converter;

use Yumi\Bundler\View\Form\FormField;
use Yumi\Bundler\View\Form\FormFieldType;
use Yumi\Bundler\View\Shared\Textual\HiddenInputElement;

/**
 * Trait FormFieldTextInputConverter
 * @package Yumi\Bundler\View\Form\Extension\FieldControl\Converter
 * @author Reverze <hawkmedia24@gmail.com>
 * This file is a part of YumiBundler
 *
 * This converter allows to convert text input field to text input control.
 */
trait FormFieldHiddenInputConverter
{
    /**
     * Registers a converter
     * @return FormFieldTextInputConverter
     */
    protected function _registerFormFieldHiddenInputConverter(): self
    {
        $self = $this;

        $this->fieldControlConverters[FormFieldType::HIDDEN_INPUT] = function(FormField $formField) use(&$self){

            $hiddenControl = new HiddenInputElement();

            if (!empty($formField->getName())){
                $hiddenControl->addAttribute('name', $formField->getName());
            }

            if (!empty($formField->getValue())){
                $hiddenControl->addAttribute('value', $formField->getValue());
            }

            return $hiddenControl;
        };

        return $this;
    }
}