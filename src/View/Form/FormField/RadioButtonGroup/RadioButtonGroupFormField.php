<?php

namespace Yumi\Bundler\View\Form\FormField\RadioButtonGroup;

use Yumi\Bundler\View\Form\FormField;
use Yumi\Bundler\View\Form\FormFieldOptions;

/**
 * Class RadioButtonGroupFormField
 * @package Yumi\Bundler\View\Form\FormField\RadioButtonGroup
 * @author Reverze <hawkmedia24@gmail.com>
 *
 */
class RadioButtonGroupFormField extends FormField
{
    protected $radioButtonsDefinitions = array();

    public function __construct(string $name, string $type, FormFieldOptions $options = null)
    {
        parent::__construct($name, $type, $options);
    }

    /**
     * Sets the definition array which describes the radio buttons at group
     * @param array $definitions
     * @return RadioButtonGroupFormField
     */
    public function setDefinition(array $definitions) : self
    {
        $this->radioButtonsDefinitions = $definitions;

        return $this;
    }

    /**
     * Gets the definition array which describes the radio buttons at group
     * @return RadioButtonGroupFormField
     */
    public function getDefinition() : array
    {
        return $this->radioButtonsDefinitions;
    }
}