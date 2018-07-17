<?php

namespace Yumi\Bundler\View\Shared\Clickable\SelectBox;

use Yumi\Bundler\View\ViewElement;

/**
 * Class OptionElementAbstract
 * @package Yumi\Bundler\View\Shared\Clickable\SelectBox
 * @author Reverze <hawkmedia24@gmail.com>
 *
 * This file is a part of YumiBundler
 */
class OptionElementAbstract extends ViewElement
{
    public function __construct()
    {
        parent::__construct();

        $this->elementType = 'select_box_option_element';
    }

    /**
     * Sets the value of selectbox' option
     * @param null|string $value
     * @return OptionElement
     */
    public function setValue(?string $value) : self
    {
        $this->addAttribute('value', $value);

        return $this;
    }

    /**
     * Gets selectbox option value
     * @return null|string
     */
    public function getValue() : ?string
    {
        return $this->getAttribute('value');
    }

    /**
     * Sets label
     * @param null|string $label
     * @return OptionElementAbstract
     */
    public function setLabel(?string $label) : self
    {
        $this->setSimpleValue($label);

        return $this;
    }

    /**
     * Gets label
     * @return null|string
     */
    public function getLabel() : ?string
    {
        return $this->getSimpleValue();
    }

    /**
     * Sets selected state
     * @param bool $state
     * @return OptionElementAbstract
     */
    public function setSelectedState(bool $state = false) : self
    {
        $state ? $this->addAttribute('selected', 'selected')
            : $this->deleteAttribute('selected');

        return $this;
    }


    public function & render() : array
    {
        $result = parent::render();

        return $result;
    }
}