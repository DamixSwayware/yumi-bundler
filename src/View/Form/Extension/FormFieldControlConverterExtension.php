<?php

namespace Yumi\Bundler\View\Form\Extension;

use Yumi\Bundler\View\Form\Exception\FormException;
use Yumi\Bundler\View\Form\Extension\FieldControl\Converter\FormFieldButtonConverter;
use Yumi\Bundler\View\Form\Extension\FieldControl\Converter\FormFieldCheckboxInputConverter;
use Yumi\Bundler\View\Form\Extension\FieldControl\Converter\FormFieldHiddenInputConverter;
use Yumi\Bundler\View\Form\Extension\FieldControl\Converter\FormFieldNumericInputConverter;
use Yumi\Bundler\View\Form\Extension\FieldControl\Converter\FormFieldRadioButtonGroupConverter;
use Yumi\Bundler\View\Form\Extension\FieldControl\Converter\FormFieldSelectBoxConverter;
use Yumi\Bundler\View\Form\Extension\FieldControl\Converter\FormFieldTextInputConverter;
use Yumi\Bundler\View\ViewElement;

/**
 * Trait FormFieldControlConverterExtension
 * @package Yumi\Bundler\View\Form\Extension
 * @author Reverze <hawkmedia24@gmail.com>
 * This file is a part of YumiBundler
 *
 * Helps to convert form fields into view controls
 */
trait FormFieldControlConverterExtension
{
    /**
     * Converts text input field into text input control
     */
    use FormFieldTextInputConverter;

    /**
     * Converts hidden input filed into hidden input control
     */
    use FormFieldHiddenInputConverter;

    /**
     * Converts submit button into button control
     */
    use FormFieldButtonConverter;

    /**
     * Converts checkbox input into checkbox control
     */
    use FormFieldCheckboxInputConverter;

    /**
     * Converts radio button group into radio button group control
     */
    use FormFieldRadioButtonGroupConverter;

    /**
     * Converts select box field into select box control
     */
    use FormFieldSelectBoxConverter;

    /**
     * Converts numeric input field into numeric input control
     */
    use FormFieldNumericInputConverter;

    protected $fieldControlConverters = array();

    /**
     * @var array[]
     */
    protected $viewControlRenderMiddlewares = array();

    protected function registerConverters() : self
    {
        $this->_registerFormFieldTextInputConverter();
        $this->_registerFormFieldHiddenInputConverter();
        $this->_registerFormFieldButtonConverter();
        $this->_registerFormFieldCheckboxInputConverter();
        $this->_registerFormFieldRadioButtonGroupConverter();
        $this->_registerFormFieldSelectBoxConverter();
        $this->_registerFormFieldNumericInputConverter();

        return $this;
    }

    /**
     * @param FormField[] $formFields
     *
     * @throws FormException
     * @return ViewElement[]
     */
    protected function castFieldsToFieldControls(array $formFields) : array
    {
        $this->registerConverters();

        $controls = array();

        foreach($formFields as &$formField){
            if (!isset($this->fieldControlConverters[$formField->getType()])){
                throw new FormException('The control converter for field type \'' . $formField->getType() . '\' is not defined');
            }

            $control = $this->fieldControlConverters[$formField->getType()]($formField);

            if (empty($control)){
                throw new FormException('The control converter did not return valid control element. Field type \'' . $formField->getType() . '\'');
            }

            $controls[] = $control;
        }

        return $controls;
    }

    /**
     * Adds a middleware which will be called before rendering control
     * @param string $fieldName
     * @param callable $middleware
     * @return FormFieldControlConverterExtension
     */
    public function addMiddlewareBeforeRenderControl(string $fieldName, callable $middleware) : self
    {
        if (!isset($this->viewControlRenderMiddlewares[$fieldName])){
            $this->viewControlRenderMiddlewares[$fieldName] = array();
        }

        $this->viewControlRenderMiddlewares[$fieldName][] = $middleware;

        return $this;
    }

    public function & renderFields() : array
    {
        $fields = array();

        /**
         * @var ViewElement[] $formControls
         */
        $formControls = $this->castFieldsToFieldControls($this->fields);

        foreach($formControls as $control){

            $fieldName = $control->getAttribute('name') ?? null;

            if (!empty($fieldName) && isset($this->viewControlRenderMiddlewares[$fieldName])){

                foreach($this->viewControlRenderMiddlewares[$fieldName] as $middleware){
                    $middleware($control);
                }
            }

            $fields[] = $control->render();
        }

        return $fields;
    }
}