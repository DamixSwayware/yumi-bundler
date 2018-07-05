<?php

namespace Yumi\Bundler\View\Form\FormField\Event;

use Yumi\Bundler\View\Form\Event\FormEvent;

class FormFieldValueChangedEvent extends FormEvent
{
    protected $value = null;

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value) : self
    {
        $this->value = $value;

        return $this;
    }

}