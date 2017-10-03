<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View;

use Yumi\Bundler\View\Content\Content;
use Yumi\Bundler\View\Menu\Exception\MenuException;
use Yumi\Bundler\View\Menu\Menu;

class View extends ViewElement
{
    /**
     * @var Menu[]
     */
    private $menus = array();

    /**
     * @var Content
     */
    private $content = null;

    public function __construct()
    {
        $this->elementType = 'view_element';
    }

    /**
     * Creates and attach new menu
     * @return Menu
     */
    public function createMenu() : Menu
    {
        $menu = new Menu();
        $this->addMenu($menu);
        return $menu;
    }

    /**
     * Adds a new menu to view
     * @param Menu $menu
     * @return View
     */
    public function addMenu(Menu $menu) : self
    {
        $this->menus[] = $menu;
        return $this;
    }

    /**
     * Set menus
     * @param array $menus
     * @return View
     * @throws MenuException
     */
    public function setMenus(array $menus) : self
    {
        foreach($menus as &$menu){
            if (!$menu instanceof Menu){
                throw new MenuException("Menu element is not instance of class Menu");
            }
        }

        $this->menus = $menus;
        return $this;
    }

    /**
     * Gets menus
     * @return array
     */
    public function getMenus() : array
    {
        return $this->menus;
    }

    /**
     * @param Content $content
     * @return View
     */
    public function setContent(Content $content) : self
    {
        $this->content = $content;
        return $this;
    }

    public function getContent() :? Content
    {
        return $this->content;
    }

    public function & render() : array
    {
        $item = array();

        $menus = array();

        foreach($this->menus as &$menu){
            $menus[] = $menu->render();
        }

        $item['menus'] = $menus;

        $item = array_merge($item, parent::render());
        return $item;
    }
}