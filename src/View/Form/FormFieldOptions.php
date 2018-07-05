<?php

namespace Yumi\Bundler\View\Form;

class FormFieldOptions
{
    /**
     * The name of options where value can be null
     * @var array
     */
    protected $allowNulls = [];

    public $label = null;

    public function addAllowNull(string $optionName) : self
    {
        if (!\in_array($optionName, $this->allowNulls, true)){
            $this->allowNulls[] = $optionName;
        }

        return $this;
    }

    public function setLabel(?string $label) : self
    {
        $this->label = $label;
        return $this;
    }

    public function __get($name)
    {
        return property_exists($this, $name) ? $this->{$name} : null;
    }

    public function __set($name, $value)
    {
        $this->{$name} = $value;
    }

    public function __isset($name)
    {
        return property_exists($this, $name);
    }

    public function castAsArray() : array
    {
        $reflect = new \ReflectionClass($this);

        $reflectedProperties = $reflect->getProperties(
            \ReflectionProperty::IS_PUBLIC
        );

        $properties = array();

        foreach($reflectedProperties as $reflectedProperty){

            $propertyValue = $this->{$reflectedProperty->name};

            if ($propertyValue === null && !\in_array($reflectedProperty->name, $this->allowNulls, true)){
                continue;
            }

            $properties[$reflectedProperty->name] = null === $propertyValue ? null : (string) $propertyValue;

        }

        return $properties;
    }
}