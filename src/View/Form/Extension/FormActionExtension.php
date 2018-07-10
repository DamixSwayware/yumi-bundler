<?php

namespace Yumi\Bundler\View\Form\Extension;
use Yumi\Bundler\View\Form\Event\FormEvent;

/**
 * Trait FormActionExtension
 * @package Yumi\Bundler\View\Form\Extension
 *
 * @author Reverze <hawkmedia24@gmail.com>
 *
 * This extension adds ability to define many actions performed by submitting form
 * and do suitable job depending on form action.
 */
trait FormActionExtension
{
    protected $formActions = array();

    protected $formActionPerformUnique = true;

    protected $formActionUniquenessBrokenCallback = null;

    protected $formActionUniquenessValidatorCallback = null;

    protected $formSubmitCallable = array();

    /**
     * Allows to set callback on the case when uniqueness of form actions was broken.
     * @param callable $callable
     * @return FormActionExtension
     */
    public function setCallbackOnBrokenFormActionUniqueness(?callable $callable) : self
    {
        $this->formActionUniquenessBrokenCallback = $callable;

        return $this;
    }

    /**
     * Allows to set callback to validator the uniqueness of form actions.
     * The validator only runs when form actions uniqueness is disabled.
     * @param callable|null $callable
     * @return FormActionExtension
     */
    public function setFormActionUniquenessValidator(?callable $callable) : self
    {
        $this->formActionUniquenessValidatorCallback = $callable;

        return $this;
    }

    /**
     * Disables the uniqueness of form actions
     * @return FormActionExtension
     */
    public function disableUniquenessFormAction() : self
    {
        $this->formActionPerformUnique = false;

        return $this;
    }

    /**
     * Enables the uniqueness of form actions
     * @return FormActionExtension
     */
    public function enableUniquenessFormAction() : self
    {
        $this->formActionPerformUnique = true;

        return $this;
    }

    /**
     * Checks if uniqueness of form actions is enabled
     * @return bool
     */
    public function isUniquenessFormActionEnabled() : bool
    {
        return $this->formActionPerformUnique;
    }

    /**
     * Gets the array with the list of defined form actions
     * @return array
     */
    public function getDefinedFormActions() : array
    {
        return \array_keys($this->formActions);
    }

    /**
     * Checks if particular form action was performed.
     *
     * @param null|string $particularActionName
     * @return bool
     */
    public function isActionPerformed(?string $particularActionName = null, array $formActionsIdentifiers = array()) : bool
    {
        $definedFormActions = empty($formActionsIdentifiers) ? $this->getDefinedFormActions() : $formActionsIdentifiers;

        //there is no need if given action name is really exists in defined form actions - performance reason
        if ($particularActionName !== null){
            $res = $this->formDriver->getFieldValue($particularActionName);

            return (int) $res === 1;
        }

        foreach($definedFormActions as &$formActionName){

            $res = $this->formDriver->getFieldValue($formActionName);

            if ((int) $res === 1){
                return true;
            }
        }

        return false;
    }

    public function processPerformedActions() : bool
    {
        $definedFormActions = $this->getDefinedFormActions();

        $performedActions = array();

        foreach($definedFormActions as &$definedFormAction){
            if ($this->isActionPerformed($definedFormAction, $definedFormActions)){
                $performedActions[] = $definedFormAction;
            }
        }

        if ($this->isUniquenessFormActionEnabled() && \count($performedActions) > 1){
            if ($this->formActionUniquenessBrokenCallback !== null){
                ($this->formActionUniquenessBrokenCallback)($performedActions);
            }

            return false;
        }

        if (!$this->isUniquenessFormActionEnabled()){
            $validatorResult = true;

            if ($this->formActionUniquenessValidatorCallback !== null){
                $validatorResult = ($this->formActionUniquenessValidatorCallback)($performedActions);
            }

            if ($validatorResult === false){
                return false;
            }
        }

        foreach($performedActions as &$performedAction){
            $this->executeActionQueueCallbacks($performedAction);
        }

        return true;
    }

    private function executeActionQueueCallbacks(string $actionIdentifier) : bool
    {
        if (!isset($this->formActions[$actionIdentifier])){
            return false;
        }

        if (!\is_array($this->formActions[$actionIdentifier])){
            return false;
        }

        $formEvent = new FormEvent();

        foreach($this->formActions[$actionIdentifier] as $callback){
            $callbackResult = $callback($formEvent);

            if ($callbackResult === false){
                return true;
            }
        }

        return true;
    }

    /**
     * Binds callable to form action
     * @param string $actionName
     * @param callable $callable
     * @return FormActionExtension
     */
    public function bindAction(string $actionName, callable $callable) : self
    {
        if (!isset($this->formActions[$actionName])){
            $this->formActions[$actionName] = array();
        }

        $this->formActions[$actionName][] = $callable;

        return $this;
    }

    /**
     * Triggers when form has been submitted
     * @param callable $callable
     * @return FormActionExtension
     */
    public function onSubmit(callable $callable) : self
    {
        $this->formSubmitCallable[] = $callable;

        return $this;
    }

    protected function processOnSubmit() : bool
    {
        $formEvent = new FormEvent();

        foreach($this->formSubmitCallable as &$callback){

            $callback($formEvent);
        }

        return true;
    }
}