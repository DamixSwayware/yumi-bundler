<?php

namespace Yumi\Bundler\View\Form\Extension;

use Yumi\Bundler\View\Form\Exception\FormException;
use Yumi\Bundler\View\Form\FieldOptions\ButtonFieldOptions;
use Yumi\Bundler\View\Form\FormField;
use Yumi\Bundler\View\Form\FormFieldType;

trait FormSubmitExtension
{
    /**
     * Adds submit button
     * @param string $buttonText
     * @param null|string $actionName
     * @param null|string $actionValue
     * @param null|ButtonFieldOptions $options
     *
     * @throws FormException
     *
     * @return Form
     */
    public function addSubmitButton(string $buttonText, ?string $actionName = null, ?string $actionValue = null, ?ButtonFieldOptions $options = null) : self
    {
        $options = empty($options) ? new ButtonFieldOptions() : $options;

        if (empty($actionName)){
            $actionName = 'submit';

            if (\in_array($actionName, $this->formActions, true)){
                throw new FormException('The form action event \'' . $actionName . '\' is already in use. Please set up custom action name');
            }
        }

        $formField = new FormField($actionName, FormFieldType::BUTTON, $options);

        if ($options->actionName === null){
            $options->actionName = $actionName;
        }

        if ($options->actionValue === null){
            $options->actionValue = empty($actionValue) ? '0' : $actionValue;
        }

        $formField->setValue($buttonText);

        $this->fields[$actionName] = $formField;
        $this->formActions[$actionName] = [];

        return $this;
    }
}