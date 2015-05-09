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
     * Returns =true, if specified string has specified prefix, else =false
     *
     * @param string $prefix Prefix
     * @param string $str    Source string to check
     *
     * @return bool          Has specified prefix
     */
    static function hasPrefix($prefix, $str)
    {
        return (substr($str, 0, strlen($prefix)) === $prefix);
    }

    /**
     * Returns =true, if specified string has specified postfix, else =false
     *
     * @param string $postfix Postfix
     * @param string $str     Source string to check
     *
     * @return bool           Has specified postfix
     */
    static function hasPostfix($postfix, $str)
    {
        return (substr($str, -strlen($postfix)) === $postfix);
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