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

    public function __construct()
    {
        parent::__construct();

        $this->tagName = 'menu';

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

    public function & render() : array
    {
        return array();
    }
}