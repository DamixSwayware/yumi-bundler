<?php

namespace Yumi\Bundler\View\Form\Event;

use Yumi\Bundler\View\Form\Event\Exception\FormEventException;
use Yumi\Bundler\View\Form\FormAbstract;
use Yumi\Bundler\View\Form\FormFieldType;

class FormEvent
{
    /**
     * @var null|FormAbstract
     */
    private $form = null;

    public function __construct(FormAbstract $form)
    {
        $this->form = $form;
    }

    /**
     * Checks if checkbox is selected
     *
     * @param string $checkboxName
     * @param bool $allowNotExistingField
     * @return bool
     * @throws FormEventException
     */
    public function isCheckboxSelected(string $checkboxName, bool $allowNotExistingField = false) : bool
    {
        $checkboxFields = $this->form->groupFieldByType(FormFieldType::CHECKBOX);

        if (!isset($checkboxFields[$checkboxName])){
            if ($allowNotExistingField === false){
                throw new FormEventException('The checkbox \'' . $checkboxName . '\' is not defined in your form');
            }

            return false;
        }

        return (int) $this->form->getFieldValue($checkboxName) === 1;
    }

    public function getValue(string $fieldName)
    {
        return $this->form->getFieldValue($fieldName);
    }
}