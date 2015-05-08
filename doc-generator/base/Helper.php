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
            if (substr($str, 0, strlen($prefix)) === $prefix) {
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
            if (substr($str, -strlen($postfix)) === $postfix) {
                $str = substr($str, 0, -strlen($postfix));
            }
        }
        return $str;
    }
}