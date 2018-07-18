<?php

namespace Yumi\Bundler\View\Form\Extension\FieldControl\Converter;
use Yumi\Bundler\View\Form\FormField;
use Yumi\Bundler\View\Form\FormFieldType;
use Yumi\Bundler\View\Shared\Textual\NumericInputElement;
use Yumi\Bundler\View\ViewElement;

/**
 * Trait FormFieldNumericInputConverter
 * @package Yumi\Bundler\View\Form\Extension\FieldControl\Converter
 * @author Reverze <hawkemdia24@gmail.com>
 *
 * This file is a part of YumiBundler
 *
 */
trait FormFieldNumericInputConverter
{
    protected function _registerFormFieldNumericInputConverter() : callable
    {
        $self = $this;

        $converter = function(FormField $formField) use(&$self){

            $numericInput = new NumericInputElement();

            if (!empty($formField->getName())){
                $numericInput->addAttribute('name', $formField->getName());
            }

            $options = $formField->getOptions()->castAsArray();

            if (isset($options['max'])){
                $numericInput->setMaxValue($options['max']);
                unset($options['max']);
            }

            if (isset($options['min'])){
                $numericInput->setMinValue($options['min']);
                unset($options['min']);
            }

            if (isset($options['step'])){
                $numericInput->setStepSize($options['step']);
                unset($options['step']);
            }

            if (isset($options['placeholder'])){
                $numericInput->setPlaceholder($options['placeholder']);
                unset($options['placeholder']);
            }

            $numericInput->addAttributes($options);

            $numericInput->addAttribute('events', $formField->getListenedEvents());

            if (empty($numericInput->getId())){
                $numericInput->setId(ViewElement::getUniqueIDForElement($numericInput));
            }

            return $numericInput;
        };

        $this->fieldControlConverters[FormFieldType::NUMERIC_INPUT] = $converter;

        return $converter;

    }
}