<?php

namespace Yumi\Bundler\View\Form;

use Yumi\Bundler\Driver\FormDriverInterface;
use Yumi\Bundler\Driver\FormDriverManager;
use Yumi\Bundler\View\Form\Extension\FormActionExtension;
use Yumi\Bundler\View\Form\Extension\FormFieldBuilderExtension;
use Yumi\Bundler\View\Form\Extension\FormSubmitExtension;
use Yumi\Bundler\View\Form\Extension\FormFieldControlConverterExtension;
use Yumi\Bundler\View\Form\Exception\FormException;
use Yumi\Bundler\View\Form\Processor\Form\FormMatchProcessor;
use Yumi\Bundler\View\Form\Processor\FormProcessor;
use Yumi\Bundler\View\Form\Processor\FormProcessorAbstract;
use Yumi\Bundler\View\ViewElement;

/**
 * Class Form
 * @package Yumi\Bundler\View\Form
 * @author Reverze <hawkmedia24@gmail.com>
 * This file is a part of YumiBundler
 *
 */
class Form extends FormAbstract
{
    use FormActionExtension;
    use FormSubmitExtension;
    use FormFieldControlConverterExtension;
    use FormFieldBuilderExtension;

    public function __construct(string $formName)
    {
        parent::__construct($formName);

        $this->registerDefaultProcessors();
    }

    protected function registerDefaultProcessors() : void
    {
        $self = $this;

        $this->addProcessor(new FormMatchProcessor());

        $this->addProcessor((new FormProcessor())->setExecuteCallback(function() use (&$self){
            return $self->processOnSubmit();
        }));

        $this->addProcessor((new FormProcessor())->setExecuteCallback(function() use(&$self){
            return $self->processPerformedActions();
        }));
    }


    public function & render() : array
    {
        $result = parent::render();

        $result['fields'] = $this->renderFields();

        return $result;
    }

}