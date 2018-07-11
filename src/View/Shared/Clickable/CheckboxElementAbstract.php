<?php

namespace Yumi\Bundler\View\Shared\Clickable;

use Yumi\Bundler\View\ViewElement;

/**
 * Class CheckboxElementAbstract
 * @package Yumi\Bundler\View\Shared\Clickable
 * @author Reverze <hawkmedia24@gmail.com>
 *
 * This file is a part of YumiBundler
 *
 */
class CheckboxElementAbstract extends ViewElement
{
    protected $label = null;

    public function __construct()
    {
        parent::__construct();

        $this->elementType = 'checkbox_element';
    }

    public function setName(string $name) : self
    {
        $this->addAttribute('name', $name);
        return $this;
    }

    public function getName() : ?string
    {
        return $this->getAttribute('name');
    }

    public function setValue(string $value) : self
    {
        $this->addAttribute('value', $value);
        return $this;
    }

    public function getValue() : ?string
    {
        return $this->getAttribute('value');
    }

    public function setLabel(string $label) : self
    {
        $this->label = $label;
        return $this;
    }

    public function getLabel() : ?string
    {
        return $this->label;
    }

    public function & render() : array
    {
        $result = parent::render();

        $result['label'] = $this->label;

        return $result;
    }
}