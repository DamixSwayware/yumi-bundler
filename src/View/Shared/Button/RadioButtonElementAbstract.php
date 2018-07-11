<?php

namespace Yumi\Bundler\View\Shared\Button;

use Yumi\Bundler\View\ViewElement;

/**
 * Class RadioButtonElementAbstract
 * @package Yumi\Bundler\View\Shared\Button
 * @author Reverze <hawkmedia24@gmail.com>
 *
 * This file is a part of YumiBundler
 *
 */
abstract class RadioButtonElementAbstract extends ViewElement
{
    protected $label = null;

    public function __construct()
    {
        parent::__construct();

        $this->elementType = 'radio_button_element';
    }

    /**
     * Sets the name of radio button
     * @param string $name
     * @return RadioButtonElementAbstract
     */
    public function setName(?string $name) : self
    {
        $this->addAttribute('name', $name);

        return $this;
    }

    /**
     * Gets the name of radio button
     * @return string
     */
    public function getName() : ?string
    {
        return $this->getAttribute('name');
    }

    /**
     * Sets the value
     * @param string $value
     * @return RadioButtonElementAbstract
     */
    public function setValue(?string $value) : self
    {
        $this->addAttribute('value', $value);

        return $this;
    }

    /**
     * Gets the button value
     * @return null|string
     */
    public function getValue() : ?string
    {
        return $this->getAttribute('value');
    }

    /**
     * Sets the button label
     * @param null|string $label
     * @return RadioButtonElementAbstract
     */
    public function setLabel(?string $label) : self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Gets the button label
     * @return null|string
     */
    public function getLabel() : ?string
    {
        return $this->label;
    }

    public function & render() : array
    {
        $result = parent::render();

        $result['label'] = $this->getLabel();

        return $result;
    }
}