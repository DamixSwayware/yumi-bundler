<?php

namespace Yumi\Bundler\View\Form;

use Yumi\Bundler\Driver\FormDriverAbstract;
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

    public const FORM_NAME_FIELD = 'form_name';

    protected $fields = array();

    /**
     * @var FormDriverInterface
     */
    protected $formDriver = null;

    /**
     * @var FormProcessorAbstract[]
     */
    protected $processors = array();

    /**
     * The name of form
     * @var string|null
     */
    protected $name = null;

    public function __construct(string $formName)
    {
        parent::__construct();

        $this->elementType = 'form';

        $this->name = $formName;

        $this->formDriver = FormDriverManager::getManager()->createFromDefaultFromDriver($this);


        $this->addField(self::FORM_NAME_FIELD, FormFieldType::HIDDEN_INPUT);
        $this->getField(self::FORM_NAME_FIELD)->setValue(FormDriverManager::hashFormName($formName));

        $this->addAttribute('name', $formName);
    }

    /**
     * Gets form driver used by form
     * @return FormDriverAbstract
     */
    public function getFormDriver() : FormDriverAbstract
    {
        return $this->formDriver;
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
    protected function addField(string $fieldName, string $fieldType, FormFieldOptions $options = null, bool $override = false) : self
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
     * Groups fields by type
     * @param string $fieldType
     * @return array
     */
    public function groupFieldByType(string $fieldType) : array
    {
        $result = array();

        foreach($this->fields as $fieldName => $field){
            if ($field->getType() === $fieldType){
                $result[$fieldName] = $field;
            }
        }

        return $result;
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

    public function getName() : string
    {
        return $this->name;
    }

    protected function insertValueIntoField(FormField $formField) : void
    {
        $formField->setValue($this->formDriver->getFieldValue($formField->getName()));
    }

}