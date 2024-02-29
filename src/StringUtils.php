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
 * A utility class around strings
 *
 * @author Arnaud Scoté <arnaud@griiv.fr>
 */
class StringUtils
{

    const CASE_SENSITIVE   = true;
    const CASE_INSENSITIVE = false;

    /**
     * @param  String  $haystack
     * @param  String  $needle
     * @param  Boolean $caseSensitive self::CASE_INSENSITIVE or self::CASE_SENSITIVE
     * @return Boolean
     */
    public static function beginsWith($haystack, $needle, $caseSensitive = self::CASE_INSENSITIVE)
    {
        if ($caseSensitive === self::CASE_SENSITIVE) {
            return mb_substr($haystack, 0, mb_strlen($needle, "UTF-8"), "UTF-8") == $needle;
        }
        return mb_strtolower(mb_substr($haystack, 0, mb_strlen($needle, "UTF-8"), "UTF-8"), "UTF-8")
            === mb_strtolower($needle, "UTF-8");
    }


    /**
     * @param  String  $haystack
     * @param  String  $needle
     * @param  Boolean $caseSensitive self::CASE_INSENSITIVE or self::CASE_SENSITIVE
     * @return Boolean
     */
    public static function endsWith($haystack, $needle, $caseSensitive = self::CASE_INSENSITIVE)
    {
        $len = mb_strlen($needle, "UTF-8");
        if ($caseSensitive === self::CASE_SENSITIVE) {
            return mb_substr($haystack, -$len, $len, "UTF-8") == $needle;
        }
        return mb_strtolower(mb_substr($haystack, -$len, $len, "UTF-8"), "UTF-8") === mb_strtolower($needle, "UTF-8");
    }
    private static $fromAccents = array('à', 'â', 'ä', 'á', 'ã', 'å', 'À', 'Â', 'Ä', 'Á', 'Ã', 'Å', 'æ', 'Æ', 'ç', 'Ç', 'è', 'ê', 'ë', 'é', 'È', 'Ê',
        'Ë', 'É', 'ð', 'Ð', 'ì', 'î', 'ï', 'í', 'Ì', 'Î', 'Ï', 'Í', 'ñ', 'Ñ', 'ò', 'ô', 'ö', 'ó', 'õ', 'ø', 'Ò', 'Ô', 'Ö', 'Ó', 'Õ', 'Ø', 'œ', 'Œ',
        'ù', 'û', 'ü', 'ú', 'Ù', 'Û', 'Ü', 'Ú', 'ý', 'ÿ', 'Ý', 'Ÿ');
    private static $toAccents = array('a', 'a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A', 'A', 'A', 'ae', 'AE', 'c', 'C', 'e', 'e', 'e', 'e', 'E', 'E',
        'E', 'E', 'ed', 'ED', 'i', 'i', 'i', 'i', 'I', 'I', 'I', 'I', 'n', 'N', 'o', 'o', 'o', 'o', 'o', 'o', 'O', 'O', 'O', 'O', 'O', 'O', 'oe', 'OE',
        'u', 'u', 'u', 'u', 'U', 'U', 'U', 'U', 'y', 'y', 'Y', 'Y');
    /**
     * @param  String $string
     * @return String
     */
    public static function stripAccents($string)
    {
        return str_replace(self::$fromAccents, self::$toAccents, $string);
    }

    /**
     * Returns true when the string contains only whitespaces or null.
     *
     * @param  String $string
     * @return Boolean
     */
    public static function isEmpty($string)
    {
        return $string === null || (!is_array($string) && strlen(trim($string))) == 0;
    }

    /**
     * Returns true when the string contains at least one non whitespace character
     *
     * @param  String $string
     * @return Boolean
     */
    public static function isNotEmpty($string)
    {
        return !self::isEmpty($string);
    }

    /**
     * @param string  $string
     * @param integer $nbChar
     *
     * @return string
     */
    public static function cutText($string, $nbChar)
    {
        return wordwrap($string, $nbChar, "|", false);
    }

    public static function resumeText($string, $nbChar)
    {
        $cutString = self::cutText($string, $nbChar);
        $cutString = gn_util_ArrayUtils::firstElement(explode('|', $cutString));

        return $cutString;
    }

    /**
     * UTF8-safe ucfirst.
     *
     * @param  String $string
     * @return String
     */
    public static function ucfirst($string)
    {
        return self::strtoupper(self::substr($string, 0, 1)) . self::substr($string, 1);
    }

    /**
     * @deprecated use toUpper
     */
    private static function strtoupper($string)
    {
        return mb_strtoupper($string, "UTF-8");
    }

    /**
     * UTF8-safe substr.
     *
     * @param  String  $string
     * @param  Integer $start
     * @param  Integer $length
     * @return String
     */
    public static function substr($string, $start, $length = null)
    {
        if (is_null($length)) {
            $length = self::strlen($string);
        }
        return mb_substr($string, $start, $length, "UTF-8");
    }

    /**
     * UTF8-safe strlen.
     *
     * @param  String $string
     * @return Integer
     */
    public static function strlen($string)
    {
        return mb_strlen($string, "UTF-8");
    }
}