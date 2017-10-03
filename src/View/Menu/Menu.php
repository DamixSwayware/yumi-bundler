<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Menu;

use Yumi\Bundler\View\Menu\Exception\MenuException;
use Yumi\Bundler\View\ViewElement;

class Menu extends ViewElement
{
    /**
     * Menu located at the left side of view area
     */
    public const POSITION_LEFT = 'left';

    /**
     * Menu located at the right side of view area
     */
    public const POSITION_RIGHT = 'right';

    /**
     * Menu located at the top of view area
     */
    public const POSITION_TOP = 'top';

    /**
     * Menu located at the bottom of view area
     */
    public const POSITION_BOTTOM = 'bottom';

    /**
     * Menu position
     * @var string|null
     */
    private $position = null;

    /**
     * Menu header
     * @var \Yumi\Bundler\View\Menu\MenuHeader
     */
    private $header = null;

    /**
     * Menu items
     * @var \Yumi\Bundler\View\Menu\MenuItem[]
     */
    private $items = array();

    public function __construct()
    {
        parent::__construct();

        $this->elementType = 'menu_element';

        $this->setDefaultPosition();

    }

    private final function setDefaultPosition()
    {
        $this->position = self::POSITION_LEFT;
    }

    /**
     * Sets the position of the menu
     * @param string $position
     * @return Menu
     * @throws MenuException
     */
    public function setPosition(string $position) : self
    {
         $position = strtolower(trim($position));

         if ($position !== self::POSITION_LEFT && $position !== self::POSITION_RIGHT &&
            $position !== self::POSITION_BOTTOM && $position !== self::POSITION_TOP){
            throw new MenuException("Unknown menu position: '$position'");
         }

         $this->position = $position;

         return $this;
    }

    /**
     * Gets the position of the menu
     * @return string
     */
    public function getPosition() : string
    {
        return $this->position;
    }

    /**
     * Creates and attachs new menu header.
     * Existing header will be replaced
     * @return MenuHeader
     */
    public function createHeader() : MenuHeader
    {
        $header = new MenuHeader();
        $this->setHeader($header);
        return $header;
    }

    /**
     * Sets menu header
     * @param MenuHeader $header
     * @return Menu
     */
    public function setHeader(MenuHeader $header) : self
    {
        $this->header = $header;
        return $this;
    }

    /**
     * Gets menu header
     * @return null|MenuHeader
     */
    public function getHeader() :? MenuHeader
    {
        return $this->header;
    }

    /**
     * Creates and add new menu item
     * @return MenuItem
     */
    public function createItem() : MenuItem
    {
        $item = new MenuItem();
        $this->addItem($item);
        return $item;
    }

    /**
     * Adds menu item
     * @param MenuItem $item
     * @return Menu
     */
    public function addItem(MenuItem $item) : self
    {
        $this->items[] = $item;
        return $this;
    }

    /**
     * Sets menu items
     * @param MenuItem[] $items
     * @return Menu
     * @throws MenuException
     */
    public function setItems(array $items) : self
    {
        foreach($items as &$item){
            if (!$item instanceof MenuItem){
                throw new MenuException("Menu item is not instance of MenuItem");
            }
        }

        $this->items = $items;
        return $this;
    }

    /**
     * Gets menu item
     * @return MenuItem[]
     */
    public function getItems() : array
    {
        return $this->items;
    }

    /**
     * {@inheritdoc}
     * @return array
     */
    public function & render() : array
    {
        $menu = array();

        $menu['position'] = $this->getPosition();
        $menu['header'] = !empty($this->getHeader()) ?
            $this->getHeader()->render() : null;

        $menuItems = array();

        foreach($this->items as &$item){
            $menuItems[] = $item->render();
        }

        $menu['items'] = $menuItems;

        $menu = array_merge($menu, parent::render());
        return $menu;
    }
}