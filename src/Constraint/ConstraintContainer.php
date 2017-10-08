<?php
/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\Constraint;

class ConstraintContainer
{
    private $viewElementId = null;

    public function __construct(string $viewElementId)
    {
        $this->setViewElementId($viewElementId);
    }

    private function setViewElementId(string $viewElementId) : void
    {
        $this->viewElementId = trim($viewElementId);
    }

    /**
     * Gets id of view element
     * @return null|string
     */
    public function getViewElementId() :? string
    {
        return $this->viewElementId;
    }
}
