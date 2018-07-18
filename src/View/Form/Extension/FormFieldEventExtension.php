<?php

namespace Yumi\Bundler\View\Form\Extension;

/**
 * Trait FormFieldEventExtension
 * @package Yumi\Bundler\View\Form\Extension
 * @author Reverze <hawkmedia24@gmail.com>
 *
 * This file is a part of YumiBundler
 *
 */
trait FormFieldEventExtension
{
    protected function processFieldEvents() : bool
    {
        foreach($this->fields as $field){

            $field->setForm($this);
            $this->insertValueIntoField($field);
        }

        return true;
    }
}