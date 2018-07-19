<?php

namespace Yumi\Bundler\View\Layout\Grid\Enum;

abstract class ColumnType
{
    /**
     * Extra Small (<576px)
     */
    public const EXTRA_SMALL = '';

    /**
     * Small ([576px;768px])
     */
    public const SMALL = 'sm';

    /**
     * Medium ([768px;992px])
     */
    public const MEDIUM = 'md';

    /**
     * Large ([992px;1200px;])
     */
    public const LARGE = 'lg';

    /**
     * Extra large [>=1200px;]
     */
    public const EXTRA_LARGE = 'xl';

    /**
     * Gets an array with all available types of column
     * @return string{]
     */
    public static function getAllTypes() : array
    {
        return [
            self::EXTRA_SMALL,
            self::SMALL,
            self::MEDIUM,
            self::LARGE,
            self::EXTRA_LARGE
        ];
    }

    public static function isTypeValid(string $columnType) : bool
    {
        return (\in_array($columnType, self::getAllTypes(), true));
    }
}