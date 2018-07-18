<?php

namespace Yumi\Bundler\View\Form\Extension\FieldControl\Converter;

use Yumi\Bundler\View\Form\FormField;
use Yumi\Bundler\View\Form\FormFieldType;
use Yumi\Bundler\View\Shared\Button\ImageButtonElement;
use Yumi\Bundler\View\Shared\Button\SimpleButtonElement;
use Yumi\Bundler\View\ViewElement;

/**
 * Trait FormFieldTextInputConverter
 * @package Yumi\Bundler\View\Form\Extension\FieldControl\Converter
 * @author Reverze <hawkmedia24@gmail.com>
 * This file is a part of YumiBundler
 *
 * This converter allows to convert text input field to text input control.
 */
trait FormFieldButtonConverter
{
    /**
     * Registers a converter
     * @return callable
     */
    protected function _registerFormFieldButtonConverter(): callable
    {
        $self = $this;

        $converter = function(FormField $formField) use(&$self){

            $buttonControl = !empty($formField->getOptions()->image_source) ?
                new ImageButtonElement() : new SimpleButtonElement();

            $buttonControl->setId(ViewElement::getUniqueIDForElement($buttonControl));

            if ($formField->getOptions()){
                $buttonControl->addAttributes($formField->getOptions()->castAsArray());
            }

            if (!empty($formField->getOptions()->actionName)){
                $buttonControl->addAttribute('name', $formField->getOptions()->actionName);
            }


            $buttonControl->addAttribute('value', $formField->getValue());

            return $buttonControl;
        };

        $this->fieldControlConverters[FormFieldType::BUTTON] = $converter;

        return $converter;
    }
}