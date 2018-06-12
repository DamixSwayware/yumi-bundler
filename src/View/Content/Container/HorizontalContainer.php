<?php

/**
 * This file is a part of YumiBundler
 *
 * @Author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Content\Container;

use Yumi\Bundler\Tool\StyleEnum;
use Yumi\Bundler\Tool\StyleManager;
use Yumi\Bundler\View\ViewElement;

class HorizontalContainer extends ViewElement
{
    /**
     * The left margin (it does not affect at first element at list)
     * @var int|null
     */
    private $spaceMargin = null;

    /**
     * The elements
     * @var ViewElement[]
     */
    private $elements = array();

    public function __construct()
    {
        parent::__construct();

        $this->elementType = 'horizontal_list_container';
    }

    /**
     * Removes all element from container
     * @return HorizontalContainer
     */
    public function removeAllElements() : self
    {
        $this->elements = array();

        return $this->elements;
    }

    /**
     * Adds a new element into container
     * @param ViewElement $viewElement
     * @return HorizontalContainer
     */
    public function addElement(ViewElement $viewElement) : self
    {
        $this->elements[] = $viewElement;

        return $this;
    }

    /**
     * Gets elements from container
     * @return ViewElement[]
     */
    public function getElements() : array
    {
        return $this->elements;
    }

    /**
     * Sets space margin
     * @param int|null $margin
     * @return HorizontalContainer
     */
    public function setSpaceMargin(?int $margin) : self
    {
        $this->spaceMargin = $margin;

        return $this;
    }

    /**
     * Gets space margin
     * @return int|null
     */
    public function getSpaceMargin() : ?int
    {
        return $this->spaceMargin;
    }

    public function & render() : array
    {
        $renderResult = parent::render();

        $elementsRenderResult = array();

        $isFirstElement = true;

        foreach($this->elements as $element){
            if ($isFirstElement === false && $this->spaceMargin !== null){
                $clonedElement = clone $element;

                if (!$clonedElement->hasStyle(StyleEnum::MARGIN_LEFT)){
                    $clonedElement->addStyle(
                        StyleEnum::MARGIN_LEFT,
                        StyleManager::integerToPx($this->spaceMargin)
                    );
                }

                $elementsRenderResult[] = $clonedElement->render();
                $isFirstElement = true;

                continue;
            }

            $elementsRenderResult[] = $element->render();

        }

        $renderResult['elements'] = $elementsRenderResult;

        return $renderResult;
    }
}