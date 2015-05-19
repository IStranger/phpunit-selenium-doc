<?php
/**
 * This class contain common (static) methods
 */

namespace phpdocSeleniumGenerator;


abstract class Helper
{
    /** Line end symbol */
    const EOL = "\n";

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
            "\r"              => '',
            "\n"              => '',
            "\t"              => '',
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
     * Formats specifies html for "pretty" view
     *
     * @param string $sourceXHTML string to format
     *
     * @return string
     */
    static function formatAsHtml($sourceXHTML)
    {
        $xhtml = static::plainText($sourceXHTML);
        // split by lines
        $xhtml = strtr($xhtml, [
            '<p>'   => self::EOL . self::EOL . '<p>',
            '<h3>'  => self::EOL . self::EOL . '<h3>',
            '<h4>'  => self::EOL . self::EOL . '<h4>',
            '<ul>'  => self::EOL . self::EOL . '<ul>',
            '</ul>' => self::EOL . '</ul>' . self::EOL . self::EOL,
            '<li>'  => self::EOL . '<li>',
            '<br/>' => '<br/>' . self::EOL,
        ]);

        // delete excess spaces
        $xhtml = static::trimMultiLine($xhtml);

        // add whitespaces before some html elements
        $offset = str_repeat(' ', 4);
        $xhtml  = strtr($xhtml, [
            '<li>' => $offset . '<li>',
        ]);

        // + 3x меняем на -> 2х EOL
        return $xhtml;
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

    /**
     * Returns =true, if specified text has one of specified sub-strings.
     *
     * @param string|string[] $subStr Single sub-string, or list of sub-string
     * @param string          $text   Text to check
     *
     * @return bool
     */
    static function contain($subStr, $text)
    {
        $subStr = is_array($subStr) ? $subStr : [$subStr];

        $contain = false;
        foreach ($subStr as $searchStr) {
            $contain = $contain || (strpos($text, $searchStr) !== false);
        }
        return $contain;
    }

    /**
     * Trims each line of multi line text
     *
     * @param string $multiLineText
     *
     * @return string
     */
    static function trimMultiLine($multiLineText)
    {
        $lines = [];
        foreach (explode(Helper::EOL, $multiLineText) as $line) {
            $lines[] = trim($line);
        }
        return join(Helper::EOL, $lines);
    }

    /**
     * Replaces in the specified text all line ending symbols:
     *   CRLF (windows "\r\n") --> LF (unix "\n"),
     *   CR (mac "\r\n") --> LF (unix "\n")
     *
     * @param string $text Text to replace
     *
     * @return string
     */
    static function unifyEOL($text)
    {
        $text = str_replace("\r\n", self::EOL, $text);  // CRLF --> LF
        $text = str_replace("\r", self::EOL, $text);    // CR --> LF
        return $text;
    }
}