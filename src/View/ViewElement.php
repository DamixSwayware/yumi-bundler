<?php

namespace Yumi\Bundler\View;

abstract class ViewElement
{
    /**
     * @var null
     */
    protected $tagName = null;

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

    }

    public function getTagName() : string
    {
        return $this->tagName;
    }

    public function getId() : string
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
        $this->id = (string) $value;
    }

    public function setClasses(array $classes) : self
    {
        $this->classes = (array) $classes;
    }

    public function addClass(string $className) : self
    {
        $this->classes[] = $className;
    }

    public function setStyles(array $styles) : self
    {
        $this->styles = $styles;
    }

    public function addStyle(string $modifierName, $modifierValue)
    {
        $this->styles[trim($modifierName)] = (string) $modifierValue;
    }

    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function addAttribute(string $attributeName, $attributeValue)
    {
        $this->attributes[trim($attributeName)] = (string) $attributeValue;
    }

    public function setDataAttributes(array $dataAttributes)
    {
        $this->dataAttributes = $dataAttributes;
    }

    public function addDataAttribute(string $attributeName, $attributeValue)
    {
        $this->attributes[trim($attributeName)] = (string) $attributeValue;
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

    public abstract function & render() : array;

}