<?php

namespace Yumi\Bundler\View\Form\FormField\Extension;

use Yumi\Bundler\View\Form\FormField\Event\FormFieldValueChangedEvent;
use Yumi\Bundler\View\Form\FormFieldOptions;

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

    protected $listenedEvents = array();

    public function onChangedValue(?callable $callback) : self
    {
        $this->onChangedValueCallback = $callback;

        if ($callback !== null && !isset($this->listenedEvents['changed_value'])){
            $this->listenedEvents['changed_value'] = true;
        }

        return $this;
    }

    public function hasOnChangedValueCallback() : bool
    {
        return $this->onChangedValueCallback !== null;
    }

    public function setValue($value)
    {
        parent::setValue($value);

        if ($this->onChangedValueCallback !== null){
            $event = new FormFieldValueChangedEvent($this->getForm());
            $event->setValue($value);

            ($this->onChangedValueCallback)($event);
        }


        return $this;
    }

    public function getListenedEvents() : array
    {
        return $this->listenedEvents;
    }
}
