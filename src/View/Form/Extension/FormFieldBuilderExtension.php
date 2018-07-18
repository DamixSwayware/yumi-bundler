<?php

namespace Yumi\Bundler\View\Form\Extension;
use Yumi\Bundler\View\Form\FieldOptions\CheckboxFieldOptions;
use Yumi\Bundler\View\Form\FieldOptions\NumericInputFieldOptions;
use Yumi\Bundler\View\Form\FieldOptions\TextFormFieldOptions;
use Yumi\Bundler\View\Form\FormField\RadioButtonGroup\RadioButtonGroupFormField;
use Yumi\Bundler\View\Form\FormField\SelectBox\SelectBoxFormField;
use Yumi\Bundler\View\Form\FormFieldOptions;
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
    /**
     * Adds a text input
     * @param string $inputName
     * @param null|TextFormFieldOptions $options
     * @return FormFieldBuilderExtension
     */
    public function addTextInput(string $inputName, ?TextFormFieldOptions $options =  null) : self
    {
        $options = $options ?? new TextFormFieldOptions();

        $this->addField($inputName, FormFieldType::TEXT_INPUT, $options);

        return $this;
    }

    /**
     * Adds a hidden input
     * @param string $inputName
     * @param null|TextFormFieldOptions $options
     * @return FormFieldBuilderExtension
     */
    public function addHiddenInput(string $inputName, ?TextFormFieldOptions $options = null) : self
    {
        $options = $options ?? new FormFieldOptions();

        $this->addField($inputName, FormFieldType::HIDDEN_INPUT, $options);

        return $this;
    }

    /**
     * Adds a checkbox
     * @param string $checkboxName
     * @param null|CheckboxFieldOptions $options
     * @return FormFieldBuilderExtension
     */
    public function addCheckbox(string $checkboxName, ?CheckboxFieldOptions $options = null) : self
    {
        $options = $options ?? new CheckboxFieldOptions();

        $this->addField($checkboxName, FormFieldType::CHECKBOX, $options);

        return $this;
    }

    /**
     * Adds numeric input
     * @param string $inputName
     * @param null|NumericInputFieldOptions $options
     * @return FormFieldBuilderExtension
     */
    public function addNumericInput(string $inputName, ?NumericInputFieldOptions $options = null) : self
    {
        $options = $options ?? new NumericInputFieldOptions();

        $this->addField($inputName, FormFieldType::NUMERIC_INPUT, $options);

        return $this;
    }

    /**
     * Adds a radio buttons group
     * @param string $groupName
     * @param array $buttons
     * @return FormFieldBuilderExtension
     */
    public function addRadioGroup(string $groupName, array $buttons) : self
    {
        $radioButtonGroupField = new RadioButtonGroupFormField($groupName, FormFieldType::RADIO_BUTTON_GROUP);
        $radioButtonGroupField->setDefinition($buttons);

        $this->fields[$groupName] = $radioButtonGroupField;

        $this->insertValueIntoField($radioButtonGroupField);

        return $this;
    }

    /**
     * Adds a select box field
     * @param string $selectName
     * @param array $options
     * @param array $fieldOptions
     * @return FormFieldBuilderExtension
     * @throws \Yumi\Bundler\View\Form\FormField\SelectBox\Exception\SelectBoxFormFieldException
     */
    protected function addSelectBox(string $selectName, array $options, array $fieldOptions = array()) : self
    {
        $selectBoxFormField = new SelectBoxFormField($selectName, FormFieldType::SELECT_BOX);
        $selectBoxFormField->setOptionValues($options);
        $selectBoxFormField->multipleSelect($fieldOptions['multiple'] ?? false);

        $this->fields[$selectName] = $selectBoxFormField;

        $this->insertValueIntoField($selectBoxFormField);

        return $this;
    }

    /**
     * Adds select box with disabled multiple select
     * @param string $selectName
     * @param array $options
     * @return FormFieldBuilderExtension
     * @throws \Yumi\Bundler\View\Form\FormField\SelectBox\Exception\SelectBoxFormFieldException
     */
    public function addSelect(string $selectName, array $options) : self
    {
        return $this->addSelectBox($selectName, $options, [
            'multiple' => false,
        ]);
    }

    /**
     * Adds select box with enabled multiple select
     * @param string $selectName
     * @param array $options
     * @return FormFieldBuilderExtension
     * @throws \Yumi\Bundler\View\Form\FormField\SelectBox\Exception\SelectBoxFormFieldException
     */
    public function addMultipleSelect(string $selectName, array $options) : self
    {
        return $this->addSelectBox($selectName, $options, [
            'multiple' => true,
        ]);
    }
}