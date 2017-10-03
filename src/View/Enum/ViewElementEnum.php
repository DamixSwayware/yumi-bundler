<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Enum;

abstract class ViewElementEnum
{
    /**
     * Table element
     */
    public const TABLE_ELEMENT = 'table';

    /**
     * Table row element
     */
    public const TABLE_ROW_ELEMENT = 'row';

    /**
     * Table row column element
     */
    public const TABLE_COLUMN_ELEMENT = 'column';

    /**
     * Menu element
     */
    public const MENU_ELEMENT = 'menu';

    /**
     * Menu item element
     */
    public const MENU_ITEM_ELEMENT = 'menu_item';

    /**
     *
     */
    public const MENU_HEADER_ELEMENT = 'menu_header';

    private function __construct()
    {
        //nothing special to do here
    }

}