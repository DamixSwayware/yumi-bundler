<?php

namespace Yumi\Bundler\View\Form;

abstract class FormGroupAbstract
{
    /**
     * @var FormAbstract[]
     */
    private $forms = array();

    public function add(FormAbstract $form) : self
    {
        $this->forms[$form->getName()] = $form;

        return $this;
    }

    public function get(string $formName) : ?FormAbstract
    {
        return $this->forms[$formName] ?? null;
    }

    public function getAll() : array
    {
        return $this->forms;
    }

    public function process() : void
    {
        foreach($this->forms as $form){
            $form->process();
        }
    }

}