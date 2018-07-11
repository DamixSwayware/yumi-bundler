<?php

namespace Yumi\Bundler\View\Form\Extension\FieldControl\Converter;

use Yumi\Bundler\Driver\FormDriverManager;
use Yumi\Bundler\View\Form\FormAbstract;
use Yumi\Bundler\View\Form\FormField\RadioButtonGroup\RadioButtonGroupFormField;
use Yumi\Bundler\View\Form\FormFieldType;
use Yumi\Bundler\View\Shared\Button\RadioButtonGroupElement;
use Yumi\Bundler\View\ViewElement;

trait FormFieldRadioButtonGroupConverter
{
    protected function _registerFormFieldRadioButtonGroupConverter() : callable
    {
        $self = $this;

        $converter = function(RadioButtonGroupFormField $formField) use ($self) : RadioButtonGroupElement{

            $radioButtonGroupElement = new RadioButtonGroupElement();

            $radioButtonGroupElement->createItems($formField->getName(), $formField->getDefinition());

            $defaultSelectedRadioButton = (function() use($formField) : ?string {
                foreach($formField->getDefinition() as $buttonValue => &$description){
                    if (isset($description['default']) && $description['default'] === true){
                        return $buttonValue;
                    }
                }

                return null;
            })();

            $radioButtonGroupElement->addAttribute('events', $formField->getListenedEvents());

            $items = $radioButtonGroupElement->getItems();

            //generating id for items
            foreach($items as $item){
                if (empty($item->getId())){
                    $item->setId(ViewElement::getUniqueIDForElement($item));
                }
            }


            if ($defaultSelectedRadioButton !== null){
                foreach($items as $item){
                    if ($item->getValue() === $defaultSelectedRadioButton){
                        $item->addAttribute('checked', 'checked');
                    }
                }
            }

            if ($self->getFormDriver()->getFieldValue(FormAbstract::FORM_NAME_FIELD) ===
                FormDriverManager::hashFormName($self->getName())){

                foreach($items as $item){
                    if ($item->getValue() === $formField->getValue()){
                        $item->addAttribute('checked', 'checked');
                    }
                    else{
                        $item->addAttribute('checked', null);
                    }
                }
            }

            $radioButtonGroupElement->setId(ViewElement::getUniqueIDForElement($radioButtonGroupElement));

            return $radioButtonGroupElement;

        };

        $this->fieldControlConverters[FormFieldType::RADIO_BUTTON_GROUP] = $converter;

        return $converter;
    }
}