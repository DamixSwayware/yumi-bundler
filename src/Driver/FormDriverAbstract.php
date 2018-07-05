<?php

namespace Yumi\Bundler\Driver;

abstract class FormDriverAbstract implements FormDriverInterface
{
    protected $form = null;

    public function setForm(Form $form)
    {
        $this->form = $form;
    }
}