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
     * @return callable
     */
    protected function _registerFormFieldHiddenInputConverter(): callable
    {
        $self = $this;

        $converter = function(FormField $formField) use(&$self){

            $hiddenControl = new HiddenInputElement();

            BaseControlConverter::convert($hiddenControl, $formField);

            if (!empty($formField->getValue())){
                $hiddenControl->addAttribute('value', $formField->getValue());
            }

            return $hiddenControl;
        };

        $this->fieldControlConverters[FormFieldType::HIDDEN_INPUT] = $converter;

        return $converter;
    }
}