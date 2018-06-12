<?php


/**
 * This file is a part of YumiBundler
 *
 * @Author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\Tool;


class StyleManager
{
    /**
     * Converts integer into px value
     * @param int $value
     * @return string
     */
    public static function integerToPx(int $value) : string
    {
        return (string) $value . 'px';
    }
}