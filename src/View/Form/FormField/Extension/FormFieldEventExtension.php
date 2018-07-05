<?php

namespace Yumi\Bundler\View\Form\FormField\Extension;

use Yumi\Bundler\View\Form\FormField\Event\FormFieldValueChangedEvent;

/**
 * Trait FormFieldEventExtension
 * @package Yumi\Bundler\Form\FormField\Extension
 * @author Reverze <hawkmedia24@gmail.com>
 *
 * This file is a part of YumiBundler
 *
 */
trait FormFieldEventExtension
{
    protected $onChangedValueCallback = null;

    public function onChangedValue(?callable $callback) : self
    {
        $this->onChangedValueCallback = $callback;

        return $this;
    }

    public function setValue($value)
    {
        parent::setValue($value);

        if ($this->onChangedValueCallback !== null){
            $event = new FormFieldValueChangedEvent();
            $event->setValue($value);

            ($this->onChangedValueCallback)($event);
        }


        return $this;
    }
}
