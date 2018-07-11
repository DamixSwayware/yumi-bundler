<?php

namespace Yumi\Bundler\View\Form\Extension\FieldControl\Converter;

use Yumi\Bundler\Driver\FormDriverManager;
use Yumi\Bundler\View\Form\FormAbstract;
use Yumi\Bundler\View\Form\FormField;
use Yumi\Bundler\View\Form\FormFieldType;
use Yumi\Bundler\View\Shared\Clickable\CheckboxElement;
use Yumi\Bundler\View\Shared\Textual\TextElement;
use Yumi\Bundler\View\ViewElement;

/**
 * Trait FormFieldTextInputConverter
 * @package Yumi\Bundler\View\Form\Extension\FieldControl\Converter
 * @author Reverze <hawkmedia24@gmail.com>
 * This file is a part of YumiBundler
 *
 * This converter allows to convert checkbox input field to checkbox input control.
 */
trait FormFieldCheckboxInputConverter
{
    /**
     * Registers a converter
     * @return callable
     */
    protected function _registerFormFieldCheckboxInputConverter(): callable
    {
        $self = $this;

        $converter = function(FormField $formField) use(&$self) : CheckboxElement{

            $control = new CheckboxElement();

            if (!empty($formField->getName())){
                $control->setName($formField->getName());
            }

            if ($formField->getOptions()){

                $options = $formField->getOptions()->castAsArray();

                if (!empty($options['label'])){
                    $control->setLabel($options['label']);
                }

                if (!empty($options['checked'])){
                    $control->addAttribute('checked', 'checked');
                }

                unset($options['label']);

                $control->addAttributes($formField->getOptions()->castAsArray());
            }

            $control->addAttribute('events', $formField->getListenedEvents());

            if (empty($control->getId()) && $formField->hasOption('label')){
                $control->setId(ViewElement::getUniqueIDForElement($control));
            }

            //override the checked attribute
            if ($self->getFormDriver()->getFieldValue(FormAbstract::FORM_NAME_FIELD) ===
                FormDriverManager::hashFormName($self->getName())){

                if ((int) $formField->getValue() === 1){
                    $control->addAttribute('checked', 'checked');
                }
                else{
                    $control->addAttribute('checked', null);
                }
            }



            $control->setValue('1');

            return $control;
        };

        $this->fieldControlConverters[FormFieldType::CHECKBOX] = $converter;

        return $converter;
    }
}