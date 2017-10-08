<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\Constraint;

use Yumi\Bundler\Constraint\Exception\ConstraintManagerException;
use Yumi\Bundler\View\ViewElement;

class ConstraintManager
{
    /**
     * Array with all created constraint containers
     * @var array
     */
    private $constraintContainersArray = array();

    public function __construct()
    {

    }

    public function assignTo(ViewElement $viewElement) : ConstraintContainer
    {
        if (empty($viewElement->getId())){
            throw new ConstraintManagerException("View element must have defined ID");
        }

        $constraintContainer = new ConstraintContainer($viewElement->getId());

        return $constraintContainer;
    }

    public function watchConstraintContainer(ConstraintContainer $constraintContainer) : void
    {
        $this->constraintContainersArray[] = $constraintContainer;
    }
}