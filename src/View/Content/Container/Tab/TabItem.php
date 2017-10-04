<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Content\Container\Tab;

use Yumi\Bundler\View\Content\Container\Container;
use Yumi\Bundler\View\ViewElement;

class TabItem extends ViewElement
{
    /**
     * Title of tab
     * @var string|null
     */
    private $title = null;

    /**
     * Tooltip text
     * @var string|null
     */
    private $tooltip_text = null;

    /**
     * Assigned container to tab
     * @var string|null
     */
    private $container = null;

    /**
     * Is tab selected
     * @var bool
     */
    private $is_active = false;


    public function __construct()
    {
        parent::__construct();

        $this->elementType = 'tab_container_tab_item';
    }

    /**
     * Sets title of tab
     * @param string $title
     * @return TabItem
     */
    public function setTitle(string $title) : self
    {
        $this->title = trim($title);
        return $this;
    }

    /**
     * Gets title of tab
     * @return null|string
     */
    public function getTitle() :? string
    {
        return $this->title;
    }

    /**
     * Sets tooltip text
     * @param null|string $tooltipText
     * @return TabItem
     */
    public function setTooltipText(?string $tooltipText) : self
    {
        $this->tooltip_text = empty($tooltipText) ? null : trim($tooltipText);
        return $this;
    }

    /**
     * Gets tooltip text
     * @return null|string
     */
    public function getTooltipText() :? string
    {
        return $this->tooltip_text;
    }

    /**
     * Sets container
     * @param Container $container
     * @return TabItem
     */
    public function setContainer(Container $container) : self
    {
        $this->container = $container;
        return $this;
    }

    /**
     * Gets container
     * @return null|Container
     */
    public function getContainer() :? Container
    {
        return $this->container;
    }

    /**
     * Sets 'is_active' state
     * @param bool $state
     * @return TabItem
     */
    public function setIsActiveState(bool $state) : self
    {
        $this->is_active = $state;
        return $this;
    }

    /**
     * Checks if tab is active
     * @return bool
     */
    public function isActive() : bool
    {
        return $this->is_active;
    }

    public function & render() : array
    {
        $result = array();

        $result['title'] = $this->getTitle();
        $result['tooltipText'] = $this->getTooltipText();
        $result['container'] = !empty($this->getContainer()) ?
            $this->getContainer()->render() : null;
        $result['is_active'] = $this->isActive();

        $result = array_merge($result, parent::render());

        return $result;
    }
}