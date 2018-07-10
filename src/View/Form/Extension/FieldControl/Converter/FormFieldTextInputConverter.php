<?php

namespace Yumi\Bundler\View\Form\Extension\FieldControl\Converter;

use Yumi\Bundler\View\Form\FormField;
use Yumi\Bundler\View\Form\FormFieldType;
use Yumi\Bundler\View\Shared\Textual\TextElement;
use Yumi\Bundler\View\ViewElement;

/**
 * Trait FormFieldTextInputConverter
 * @package Yumi\Bundler\View\Form\Extension\FieldControl\Converter
 * @author Reverze <hawkmedia24@gmail.com>
 * This file is a part of YumiBundler
 *
 * This converter allows to convert text input field to text input control.
 */
trait FormFieldTextInputConverter
{
    /**
     * Registers a converter
     * @return FormFieldTextInputConverter
     */
    protected function _registerFormFieldTextInputConverter(): self
    {
        $self = $this;

        $this->fieldControlConverters[FormFieldType::TEXT_INPUT] = function(FormField $formField) use(&$self){

            $textControl = new TextElement();

            BaseControlConverter::convert($textControl, $formField);

            if (empty($textControl->getId()) && $formField->hasOption('label')){
                $textControl->setId(ViewElement::getUniqueIDForElement($textControl));
            }

            if (!empty($formField->getValue())){
                $textControl->addAttribute('value', $formField->getValue());
            }

            return $textControl;
        };

        return $this;
    }
}