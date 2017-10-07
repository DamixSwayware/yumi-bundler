<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Table\Sequence;

abstract class ModifierSequence
{
    protected $modifiers = array();

    public function __construct()
    {

    }

    /**
     * Adds modifier
     * @param callable $modifier
     * @return ModifierSequence
     */
    public function addModifier(callable $modifier) : self
    {
        $this->modifiers[] = $modifier;
        return $this;
    }

    public abstract function execute();
}