<?php

/**
 * @Author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Menu;

use Yumi\Bundler\View\ViewElement;

class MenuItem extends ViewElement
{
    /**
     * Identifier of resource to which link redirects
     * @var string|null
     */
    private $uri = null;

    /**
     * Title of menu item
     * @var string|null
     */
    private $title = null;

    /**
     * Item tooltip
     * @var string|null
     */
    private $tooltip = null;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Sets identifier of resource to which link redirects
     * @param null|string $uri
     * @return MenuItem
     */
    public function setUri(?string $uri) : self
    {
        $this->uri = trim($uri);
        return $this;
    }

    /**
     * Gets identifier of resource to which link redirects
     * @return null|string
     */
    public function getUri() : ?string
    {
        return $this->uri;
    }

    /**
     * Sets title of menu item
     * @param string $title
     * @return MenuItem
     */
    public function setTitle(string $title) : self
    {
        $this->title = trim($title);
        return $this;
    }

    /**
     * Gets title of menu item.
     * Returns null if title was not set
     * @return null|string
     */
    public function getTitle() : ?string
    {
        return $this->title;
    }

    /**
     * Sets text of tooltip
     * @param null|string $tooltipText
     * @return MenuItem
     */
    public function setTooltipText(?string $tooltipText) : self
    {
        $this->tooltip = trim($tooltipText);
        return $this;
    }

    /**
     * Gets text of tooltip
     * @return null|string
     */
    public function getTooltipText() : ?string
    {
        return $this->tooltip;
    }

    /**
     * {@inheritdoc}
     * @return array
     */
    public function & render() : array
    {
        $item = [
            'title' => $this->title,
            'uri' => $this->uri,
            'tooltipText' => $this->tooltip,
        ];

        return $item;
    }
}