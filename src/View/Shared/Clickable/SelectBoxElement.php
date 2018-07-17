<?php

namespace Yumi\Bundler\View\Shared\Clickable;

use Yumi\Bundler\View\Shared\Clickable\Exception\SelectBoxElementException;
use Yumi\Bundler\View\Shared\Clickable\SelectBox\OptionElement;
use Yumi\Bundler\View\ViewElement;

/**
 * Class SelectBoxElement
 * @package Yumi\Bundler\View\Shared\Clickable
 * @author Reverze <hawkmedia24@gmail.com>
 *
 * This file is a part of YumiBundler
 *
 */
class SelectBoxElement extends ViewElement
{
    /**
     * Contains option elements. Option element is identified by its 'value'
     * @var OptionElement[]
     */
    protected $optionElements = array();

    public function __construct()
    {
        parent::__construct();

        $this->elementType = 'select_box_element';
    }

    /**
     * Sets the name
     * @param string $name
     * @return SelectBoxElement
     */
    public function setName(string $name) : self
    {
        $this->addAttribute('name', $name);

        return $this;
    }

    /**
     * Gets the name
     * @return null|string
     */
    public function getName() : ?string
    {
        return $this->addAttribute('name');
    }

    /**
     * Adds an option element
     * @param OptionElement $optionElement
     * @param bool $override
     * @return SelectBoxElement
     * @throws SelectBoxElementException
     */
    public function addOption(OptionElement $optionElement, bool $override = false) : self
    {
        if (empty($optionElement->getValue())){
            throw new SelectBoxElementException('The option element does not have defined value. Please define the value of option element');
        }

        if ($override === false && isset($this->optionElements[$optionElement->getValue()])){
            throw new SelectBoxElementException('There is already defined option with value \'' . $optionElement->getValue() . '\'');
        }

        $this->optionElements[$optionElement->getValue()] = $optionElement;

        return $this;
    }

    /**
     * Gets an option element.
     *
     * @param string $optionValue
     * @return null|OptionElement
     */
    public function getOption(string $optionValue) : ?OptionElement
    {
        return $this->optionElements[$optionValue] ?? null;
    }

    /**
     * Gets option elements
     * @return OptionElement[]
     */
    public function getOptions() : array
    {
        return $this->optionElements;
    }

    /**
     * Creates option elements using array definition
     * @param array $options
     * @return SelectBoxElement
     * @throws SelectBoxElementException
     */
    public function createOptions(array $options) : self
    {
        foreach($options as $optionValue => &$optionParameters){

            $optionElement = new OptionElement();
            $optionElement->setValue((string) $optionValue);

            if (!empty($optionParameters['label'])){
                $optionElement->setLabel($optionParameters['label']);
            }

            if (!empty($optionParameters['selected']) && \is_bool($optionParameters['selected'])){
                $optionElement->setSelectedState($optionParameters['selected']);
            }

            $this->addOption($optionElement);
        }

        return $this;
    }

    /**
     * Determines if multiple select is allowed
     * @param bool $allowMultiple
     * @return SelectBoxElement
     */
    public function allowMultiple(bool $allowMultiple = false) : self
    {
        $allowMultiple === true ?
            $this->addAttribute('multiple', 'multiple') :
            $this->deleteAttribute('multiple');

        return $this;
    }

    /**
     * Checks if multiple select is allowed
     * @return bool
     */
    public function isMultipleSelectedAllowed() : bool
    {
        return $this->getAttribute('multiple') !== null;
    }


    public function & render() : array
    {
        $result = parent::render();

        $result['items'] = array();


        foreach($this->optionElements as $optionElement){
            $result['items'][] = $optionElement->render();
        }

        return $result;
    }
}