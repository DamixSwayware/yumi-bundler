<?php

namespace Yumi\Bundler\View\Form;

use Yumi\Bundler\View\Form\Processor\FormProcessorAbstract;
use Yumi\Bundler\View\ViewElement;
use Yumi\Bundler\Driver\FormDriverInterface;
use Yumi\Bundler\Driver\FormDriverManager;
use Yumi\Bundler\View\Form\Exception\FormException;

abstract class FormAbstract extends ViewElement
{
    public const METHOD_GET = 'GET';

    public const METHOD_POST = 'POST';

    public const METHOD_PUT = 'PUT';

    public const METHOD_DELETE = 'DELETE';

    protected $fields = array();

    /**
     * @var FormDriverInterface
     */
    protected $formDriver = null;

    /**
     * @var FormProcessorAbstract[]
     */
    protected $processors = array();

    public function __construct()
    {
        parent::__construct();

        $this->elementType = 'form';

        $this->formDriver = FormDriverManager::getManager()->createFromDefaultFromDriver($this);
    }

    /**
     * Adds a form processor
     * @param FormProcessorAbstract $formProcessorAbstract
     * @param bool $asFirst
     * @return FormAbstract
     */
    public function addProcessor(FormProcessorAbstract $formProcessorAbstract, bool $asFirst = false) : self
    {
        if ($asFirst === true){
            array_unshift($this->processors, $formProcessorAbstract);
        }
        else{
            $this->processors[] = $formProcessorAbstract;
        }

        return $this;
    }

    public function process() : bool
    {
        foreach($this->processors as $processor){
            $res = $processor->execute($this);

            if ($res === false){
                return false;
            }
        }

        return true;
    }

    /**
     * Adds form field
     * @param string $fieldName
     * @param string $fieldType
     * @param FormFieldOptions|null $options
     * @param bool $override
     * @return Form
     * @throws FormException
     */
    public function addField(string $fieldName, string $fieldType, FormFieldOptions $options = null, bool $override = false) : self
    {
        if ($override === false && isset($this->fields[$fieldName])){
            throw new FormException('The field \'' . $fieldName . '\' is already defined for that form. If you want to override field please set parameter override to true');
        }

        $formField = new FormField($fieldName, $fieldType, $options);

        $this->insertValueIntoField($formField);

        $this->fields[$fieldName] = $formField;
        return $this;
    }

    /**
     * Gets form field
     * @param string $fieldName
     * @return null|FormField
     */
    public function getField(string $fieldName) : ?FormField
    {
        return $this->fields[$fieldName] ?? null;
    }

    /**
     * Gets the value under field
     * @param string $fieldName
     * @return mixed|null
     */
    public function getFieldValue(string $fieldName)
    {
        return isset($this->fields[$fieldName]) ? $this->fields[$fieldName]->getValue() : null;
    }

    /**
     * Sets the value under field
     * @param string $fieldName
     * @param $value
     * @return FormAbstract
     * @throws FormException
     */
    public function setFieldValue(string $fieldName, $value) : self
    {
        if (!isset($this->fields[$fieldName])){
            throw new FormException('The field \'' . $fieldName . '\' is not defined');
        }

        $this->fields[$fieldName]->setValue($value);

        return $this;
    }

    public function setAction(?string $actionUrl) : self
    {
        $this->addAttribute('action', $actionUrl);
        return $this;
    }

    public function getAction() : ?string
    {
        return $this->getAttribute('action');
    }

    public function setMethod(?string $method) : self
    {
        $this->addAttribute('method', $method);
        return $this;
    }

    public function getMethod() : ?string
    {
        return $this->getAttribute('method');
    }


    private function insertValueIntoField(FormField $formField) : void
    {
        $formField->setValue($this->formDriver->getFieldValue($formField->getName()));
    }

}