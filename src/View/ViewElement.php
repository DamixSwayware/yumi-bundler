<?php

namespace Yumi\Bundler\View;

use Yumi\Bundler\View\Exception;

abstract class ViewElement
{
    protected $elementType = null;

    /**
     * ID of element
     * @var string|null
     */
    private $id = null;

    /**
     * Set of assigned classes to element
     * @var array
     */
    private $classes = array();

    /**
     * Set of styles assigned to element
     * @var array
     */
    private $styles = array();

    /**
     * Set of attributes assigned to element
     * @var array
     */
    private $attributes = array();

    /**
     * Set of data attributes assigned to element
     * @var array
     */
    private $dataAttributes = array();

    public function __construct()
    {
        $this->elementType = 'view_element';
    }

    public function getId() : ?string
    {
        return $this->id;
    }

    public function getClasses() : array
    {
        return $this->classes;
    }

    public function getStyles() : array
    {
        return $this->styles;
    }

    public function getAttributes() : array
    {
        return $this->attributes;
    }

    public function getDataAttributes() : array
    {
        return $this->dataAttributes;
    }

    public function setId($value) : self
    {
        $this->id = trim((string) $value);
        return $this;
    }

    public function setClasses(array $classes) : self
    {
        $this->classes = $classes;
        return $this;
    }

    public function addClass(string $className) : self
    {
        $this->classes[] = $className;
        return $this;
    }

    public function setStyles(array $styles) : self
    {
        $this->styles = $styles;
        return $this;
    }

    public function addStyle(string $modifierName, $modifierValue) : self
    {
        $this->styles[trim($modifierName)] = (string) $modifierValue;
        return $this;
    }

    public function setAttributes(array $attributes) : self
    {
        $this->attributes = $attributes;
        return $this;
    }

    public function addAttribute(string $attributeName, $attributeValue) : self
    {
        $this->attributes[trim($attributeName)] = (string) $attributeValue;
        return $this;
    }

    public function setDataAttributes(array $dataAttributes) : self
    {
        $this->dataAttributes = $dataAttributes;
        return $this;
    }

    public function addDataAttribute(string $attributeName, $attributeValue) : self
    {
        $this->dataAttributes[trim($attributeName)] = (string) $attributeValue;
        return $this;
    }

    public function isClassExists(string $className) : bool
    {
        return isset($this->classes[trim($className)]);
    }

    public function isStyleExists(string $modifierName) : bool
    {
        return isset($this->styles[trim($modifierName)]);
    }

    public function isAttributeExists(string $attributeName) : bool
    {
        return isset($this->attributes[trim($attributeName)]);
    }

    public function isDataAttributeExists(string $attributeName) : bool
    {
        return isset($this->dataAttributes[trim($attributeName)]);
    }

    public function & render() : array
    {
        $element = array();

        if (empty($this->elementType)){
            throw new Exception\ViewException("Missed element type");
        }

        $element['_element_type'] = trim($this->elementType);
        $element['id'] = $this->getId();
        $element['classes'] = $this->getClasses();
        $element['styles'] = $this->getStyles();
        $element['attributes'] = $this->getAttributes();
        $element['dataAttributes'] = $this->getDataAttributes();

        return $element;
    }

}