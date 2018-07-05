<?php

namespace Yumi\Bundler\View\Form\Processor;
use Yumi\Bundler\View\Form\FormAbstract;

/**
 * Class FormProcessorAbstract
 * @package Yumi\Bundler\View\Form\Processor
 * @author Reverze <hawkmedia24@gmail.com>
 *
 * This file is a part of YumiBundler
 *
 * The form processor represents the someone who performs some actions during form processing.
 * That someone can influence others processors eg. the single form processor can stop the whole
 * form processing process with false result.
 */
abstract class FormProcessorAbstract
{
    private $processorName = null;

    private $constantArgs = array();

    public function __construct(?string $processorName = null, array $constantArgs = array())
    {
        $this->processorName = $processorName;
        $this->constantArgs = $constantArgs;
    }

    /**
     * Gets the name of processor.
     * Processor's name is optional.
     *
     * @return null|string
     */
    public function getName() : ?string
    {
        return $this->processorName;
    }

    /**
     * Gets the constant args passed for processor
     * @return array
     */
    public function getConstantArgs() : array
    {
        return $this->constantArgs;
    }

    public abstract function execute(FormAbstract $form) : bool ;
}