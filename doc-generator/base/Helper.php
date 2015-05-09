<?php
/**
 * This class contain common (static) methods
 */

namespace phpdocSeleniumGenerator;


abstract class Helper
{
    /**
     * Strip excess space symbols (spaces, EoL symbols etc.)
     *
     * @param string $sourceText
     *
     * @return string
     */
    static function plainText($sourceText)
    {
        return strtr($sourceText, [
            "\r"              => ' ',
            "\n"              => ' ',
            "\t"              => ' ',
            '               ' => ' ',
            '              '  => ' ',
            '             '   => ' ',
            '            '    => ' ',
            '           '     => ' ',
            '          '      => ' ',
            '         '       => ' ',
            '        '        => ' ',
            '       '         => ' ',
            '      '          => ' ',
            '     '           => ' ',
            '    '            => ' ',
            '   '             => ' ',
            '  '              => ' ',
        ]);
    }

    /**
     * Evaluates the value of the specified attribute for the given object or array.
     *
     * A default value (passed as the last parameter) will be returned if the attribute does
     * not exist or is broken in the middle (e.g. $object->author is null).
     *
     * @param mixed $objectOrArray This can be either an object or an array.
     * @param mixed $attribute     the attribute name (property name for objects, key name - for arrays).
     * @param mixed $defaultValue  the default value to return when the attribute does not exist.
     *
     * @return mixed the attribute value.
     */
    public static function value($objectOrArray, $attribute, $defaultValue = null)
    {
        if (isset($objectOrArray->$attribute)) {
            return $objectOrArray->$attribute;
        } elseif (isset($objectOrArray[$attribute])) {
            return $objectOrArray[$attribute];
        } else {
            return $defaultValue;
        }
    }

    /**
     * Filters items by given keys.
     *
     * @param array $array   source assoc array
     * @param array $keysInc keys of items, that should be included
     * @param array $keysExc keys of items, that should be excluded
     *
     * @return array|mixed|null    filtered array
     */
    public static function filterByKeys($array, array $keysInc = null, array $keysExc = null)
    {
        if ($keysInc !== null) {
            $array = array_intersect_key($array, array_flip($keysInc));
        }
        if ($keysExc) {
            $array = array_diff_key($array, array_flip($keysExc));
        }
        return $array;
    }

    /**
     * Returns =true, if specified string has specified prefix, else =false.
     * If prefix equal source string, then method returns =false (is not a prefix).
     *
     * @param string $prefix Prefix
     * @param string $str    Source string to check
     *
     * @return bool          Has specified prefix
     */
    static function hasPrefix($prefix, $str)
    {
        return (substr($str, 0, strlen($prefix)) === $prefix) && (strlen($str) !== strlen($prefix));
    }

    /**
     * Returns =true, if specified string has specified postfix, else =false.
     * If postfix equal source string, then method returns =false (is not a postfix).
     *
     * @param string $postfix Postfix
     * @param string $str     Source string to check
     *
     * @return bool           Has specified postfix
     */
    static function hasPostfix($postfix, $str)
    {
        return (substr($str, -strlen($postfix)) === $postfix) && (strlen($str) !== strlen($postfix));
    }

    /**
     * Cuts one or more prefixes (if present)
     *
     * @param string|string[] $prefix Single prefix, or list possible of prefixes
     * @param string          $str    Source string
     *
     * @return string
     */
    static function cutPrefix($prefix, $str)
    {
        if (is_array($prefix)) {
            foreach ($prefix as $singlePrefix) {
                $str = static::cutPrefix($singlePrefix, $str);
            }
        } else {
            if (static::hasPrefix($prefix, $str)) {
                $str = substr($str, strlen($prefix));
            }
        }
        return $str;
    }

    static function cutPostfix($postfix, $str)
    {
        if (is_array($postfix)) {
            foreach ($postfix as $singlePostfix) {
                $str = static::cutPostfix($singlePostfix, $str);
            }
        } else {
            if (static::hasPostfix($postfix, $str)) {
                $str = substr($str, 0, -strlen($postfix));
            }
        }
        return $str;
    }
}