<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Content\Container;

use Yumi\Bundler\View\Content\Container\Exception\ContainerException;
use Yumi\Bundler\View\Content\Exception\ContentException;
use Yumi\Bundler\View\ViewElement;

abstract class Container extends ViewElement
{
    /**
     * @var ViewElement
     */
    protected $items = array();

    /**
     * Item order
     * @var array
     */
    private $itemOrder = array();

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Adds item to container
     * @param ViewElement $item
     * @throws ContainerException
     * @return Container
     */
    public function addItem($item)
    {
        if (!$item instanceof ViewElement){
            throw new ContainerException("Item is not instance of ViewElement");
        }

        $this->items[] = $item;
        return $this;
    }

    /**
     * Sets items
     * @param array $items
     * @return Container
     * @throws ContentException
     */
    public function setItems(array $items) : self
    {
        foreach($items as &$item){
            if (!$item instanceof ViewElement){
                throw new ContentException("Item is not instance of ViewElement");
            }
        }

        $this->items = $items;
        return $this;
    }

    /**
     * Order of items
     * @param array $itemOrder Array of IDs of elements
     * @return Container
     */
    public function itemOrder(array $itemOrder) : self
    {
        $this->itemOrder = $itemOrder;
        return $this;
    }

    /**
     * Gets items
     * @return array
     */
    public function getItems() : array
    {
        return $this->items;
    }

    /**
     * Renders container and nested items
     * @return array
     */
    public function & render() : array
    {
        $result = array();

        $items = array();

        foreach($this->items as &$item){
            if (!in_array($item->getId(), $this->itemOrder)){
                $items[] = $item->render();
            }
        }

        $result['items'] = $items;

        $orderedItems = array();

        foreach($this->itemOrder as &$elementId){
            $item = $this->getItemByElementId($elementId);

            if (!empty($item)){
                $orderedItems[] = $item->render();
            }
        }

        $result['orderedItems'] = $orderedItems;

        $result = array_merge($result, parent::render());

        return $result;
    }

    /**
     * Gets item by element id
     * @param null|string $elementId
     * @return null|ViewElement
     */
    private function getItemByElementId(?string $elementId) :? ViewElement
    {
        foreach($this->items as &$item){
            if ($item->getId() === $elementId){
                return $item;
            }
        }

        return null;
    }
}