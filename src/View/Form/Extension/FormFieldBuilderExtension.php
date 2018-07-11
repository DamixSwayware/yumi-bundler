<?php

namespace Yumi\Bundler\View\Form\Extension;
use Yumi\Bundler\View\Form\FormField\RadioButtonGroup\RadioButtonGroupFormField;
use Yumi\Bundler\View\Form\FormFieldType;
use Yumi\Bundler\View\Shared\Button\RadioButtonGroupElement;

/**
 * Trait FormFieldBuilderExtension
 * @package Yumi\Bundler\View\Form\Extension
 * @author Reverze <hawkmedia24@gmail.com>
 *
 * This file is a part of YumiBundler.
 *
 * This trait adds an methods to build specific form fields
 *
 */
trait FormFieldBuilderExtension
{
    public function addRadioGroup(string $groupName, array $buttons) : self
    {
        $radioButtonGroupField = new RadioButtonGroupFormField($groupName, FormFieldType::RADIO_BUTTON_GROUP);
        $radioButtonGroupField->setDefinition($buttons);

        $this->fields[FormFieldType::RADIO_BUTTON_GROUP] = $radioButtonGroupField;

        $this->insertValueIntoField($radioButtonGroupField);

        return $this;
    }
}