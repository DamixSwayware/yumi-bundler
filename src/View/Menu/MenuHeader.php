<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Menu;

use Yumi\Bundler\View\ViewElement;

class MenuHeader extends ViewElement
{
    /**
     * Title of the menu header
     * @var string|null
     */
    private $title = null;

    /**
     * Subtitle of the menu
     * @var string|null
     */
    private $subtitle = null;


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Sets title of the menu header
     * @param string $title
     * @return MenuHeader
     */
    public function setTitle(string $title) : self
    {
        $this->title = trim($title);
        return $this;
    }

    /**
     * Sets subtitle of menu
     * @param string $subTitle
     * @return MenuHeader
     */
    public function setSubTitle(?string $subTitle) : self
    {
        $this->subtitle = trim($subTitle);
        return $this;
    }

    /**
     * Gets title of the menu header
     * @return null|string
     */
    public function getTitle() :? string
    {
        return $this->title;
    }

    /**
     * Gets subtitle of the menu
     * @return null|string
     */
    public function getSubTitle() :? string
    {
        return $this->subtitle;
    }

    /**
     * {@inheritdoc}
     * @return array
     */
    public function & render() : array
    {
        $header = [
            'title' => $this->getTitle(),
            'subTitle' => $this->getSubTitle(),
        ];

        $header = array_merge($header, parent::render());

        return $header;
    }
}