<?php

namespace Yumi\Bundler\View\Form\Processor\Form;


use Yumi\Bundler\Driver\FormDriverManager;
use Yumi\Bundler\View\Form\FormAbstract;
use Yumi\Bundler\View\Form\Processor\FormProcessorAbstract;

/**
 * Class FormMatchProcessor
 * @package Yumi\Bundler\View\Form\Processor\Form
 * @author Reverze <hawkmedia24@gmail.com>
 *
 * This processor allows to identify the form by basing the requested data
 */
class FormMatchProcessor extends FormProcessorAbstract
{
    public function execute(FormAbstract $form): bool
    {
        $formHashName = FormDriverManager::hashFormName($form->getName());

        $requestedFormNameHash = $form->getFormDriver()->getFieldValue($form::FORM_NAME_FIELD);

        return $formHashName === $requestedFormNameHash;
    }

}