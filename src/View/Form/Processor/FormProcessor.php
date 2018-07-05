<?php

namespace Yumi\Bundler\View\Form\Processor;

use Yumi\Bundler\View\Form\FormAbstract;

class FormProcessor extends FormProcessorAbstract
{
    private $executeCallback = null;

    /**
     * Allows to set callback which will be executed when processor start
     * @param callable|null $callable
     * @return FormProcessor
     */
    public function setExecuteCallback(?callable $callable) : self
    {
        $this->executeCallback = $callable;

        return $this;
    }

    public function execute(FormAbstract $form): bool
    {
        if ($this->executeCallback !== null){
            return ($this->executeCallback)($form);
        }
    }

}