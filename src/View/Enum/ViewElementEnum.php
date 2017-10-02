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

    private function __construct()
    {
        //nothing special to do here
    }

}