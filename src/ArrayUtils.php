<?php
/**
 * This file is part of the Symfony package.
 *
 * (c) Arnaud Scoté <arnaud@griiv.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 **/

namespace Griiv\Utils;

/**
 * A utility class around arrays
 *
 * @author Arnaud Scoté <arnaud@griiv.fr>
 */
class ArrayUtils
{
    /**
     * @param  array $array
     * @return mixed the first element of the array or null
     */
    public static function firstElement(array $array)
    {
        if (self::isEmpty($array)) {
            return null;
        }
        return reset($array);
    }

    /**
     * @param  array $array
     * @return mixed the last element of the array or null
     */
    public static function lastElement(array $array)
    {
        if (self::isEmpty($array)) {
            return null;
        }
        return end($array);
    }

    /**
     * @param  array $array
     * @return boolean True if $array is empty
     */
    public static function isEmpty(array $array)
    {
        return $array === null || count($array) == 0;
    }

    /**
     * @param  array $array
     * @return boolean True if $array is not empty
     */
    public static function isNotEmpty(array $array)
    {
        return !self::isEmpty($array);
    }

    /**
     * @param  array $array
     * @return mixed random element or null
     */
    public static function randomElement(array $array)
    {
        if (self::isEmpty($array)) {
            return null;
        }
        shuffle($array);
        return self::firstElement($array);
    }
}