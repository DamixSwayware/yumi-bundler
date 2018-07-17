<?php

namespace Yumi\Bundler\View\Form\FormField\SelectBox;

use Yumi\Bundler\View\Form\FormField;

/**
 * Class SelectBoxFormField
 * @package Yumi\Bundler\View\Form\FormField
 * @author Reverze <hawkmedia24@gmail.com>
 *
 * This file is a part of YumiBundler
 *
 */
class SelectBoxFormField extends FormField
{
    protected $optionValues = array();

    protected $allowMultiple = false;

    /**
     * Sets the values of the options
     * @param array $optionValues
     *
     * @throws FormField\SelectBox\Exception\SelectBoxFormFieldException
     *
     * @return SelectBoxFormField
     */
    public function setOptionValues(array $optionValues) : self
    {
        $values = array();

        foreach($optionValues as $key => $value){

            if (!\is_scalar($value) && !\is_array($value)){
                throw new FormField\SelectBox\Exception\SelectBoxFormFieldException('The given value is not a scalar or array');
            }

            $values[(string) $key] = \is_array($value) ? $value : [
                'label' => $value
            ];
        }

        $this->optionValues = $values;

        return $this;
    }

    /**
     * Gets the values of the options
     * @return array
     */
    public function getOptionValues() : array
    {
        return $this->optionValues;
    }

    /**
     * Determines if multiple select is enabled
     * @param bool $isAllowed
     * @return SelectBoxFormField
     */
    public function multipleSelect(bool $isAllowed = false) : self
    {
        $this->allowMultiple = $isAllowed;
        return $this;
    }

    /**
     * Checks if field allows to select multiple values
     * @return bool
     */
    public function isMultipleSelectAllowed() : bool
    {
        return $this->allowMultiple;
    }

    /**
     * {@inheritdoc}
     */
    public function setValue($value)
    {
        if (empty($value)){
            return parent::setValue(array());
        }

        $value = (array) $value;

        foreach($value as &$val){
            $val = (string) $val;
        }

        return parent::setValue($value);
    }


}