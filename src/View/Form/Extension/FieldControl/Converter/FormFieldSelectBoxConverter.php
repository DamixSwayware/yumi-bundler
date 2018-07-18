<?php

namespace Yumi\Bundler\View\Form\Extension\FieldControl\Converter;
use Yumi\Bundler\Driver\FormDriverManager;
use Yumi\Bundler\View\Form\FormAbstract;
use Yumi\Bundler\View\Form\FormField\SelectBox\SelectBoxFormField;
use Yumi\Bundler\View\Form\FormFieldType;
use Yumi\Bundler\View\Shared\Clickable\SelectBoxElement;
use Yumi\Bundler\View\ViewElement;

/**
 * Trait FormFieldSelectBoxConverter
 * @package Yumi\Bundler\View\Form\Extension\FieldControl\Converter
 * @author Reverze <hawkmedia24@gmail.com>
 *
 * This file is a part of YumiBundler
 *
 */
trait FormFieldSelectBoxConverter
{
    protected function _registerFormFieldSelectBoxConverter() : callable
    {
        $self = $this;

        $converter = function(SelectBoxFormField $selectBoxFormField) use (&$self) : SelectBoxElement{

            $selectBoxElement = new SelectBoxElement();

            $selectBoxElement->createOptions($selectBoxFormField->getOptionValues());
            $selectBoxElement->allowMultiple($selectBoxFormField->isMultipleSelectAllowed());

            $selectBoxElement->setName($selectBoxFormField->getName() . ($selectBoxFormField->isMultipleSelectAllowed() ? '[]' : ''));

            $selectBoxElement->addAttribute('events', $selectBoxFormField->getListenedEvents());

            $items = $selectBoxElement->getOptions();

            foreach($items as $optionElement){
                if (empty($optionElement->getId())){
                    $optionElement->setId(ViewElement::getUniqueIDForElement($optionElement));
                }
            }

            if ($self->getFormDriver()->getFieldValue(FormAbstract::FORM_NAME_FIELD) ===
                FormDriverManager::hashFormName($self->getName())){

                $selectedValues = $selectBoxFormField->getValue();

                if (empty($selectedValues)){
                    $selectedValues = array();
                }

                foreach($items as $optionElement){

                    $optionElement->setSelectedState(
                        \in_array($optionElement->getValue(), $selectedValues, true)
                    );
                }
            }

            if (empty($selectBoxElement->getId())){
                $selectBoxElement->setId(ViewElement::getUniqueIDForElement($selectBoxElement));
            }


            return $selectBoxElement;

        };


        $this->fieldControlConverters[FormFieldType::SELECT_BOX] = $converter;

        return $converter;
    }
}