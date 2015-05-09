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
     * The attribute name can be given in a path syntax. For example, if the attribute
     * is "author.firstName", this method will return the value of "$object->author->firstName"
     * or "$array['author']['firstName']".
     * A default value (passed as the last parameter) will be returned if the attribute does
     * not exist or is broken in the middle (e.g. $object->author is null).
     *
     * Anonymous function could also be used for attribute calculation as follows:
     * <code>
     * $taskClosedSecondsAgo = self::value($closedTask,function($model) {
     *    return time() - $model->closed_at;
     * });
     * </code>
     * Your anonymous function should receive one argument, which is the object, the current
     * value is calculated from.
     *
     * @param mixed $object       This can be either an object or an array.
     * @param mixed $attribute    the attribute name (use dot to concatenate multiple attributes)
     *                            or anonymous function (PHP 5.3+). Remember that functions created by "create_function"
     *                            are not supported by this method. Also note that numeric value is meaningless when
     *                            first parameter is object typed.
     * @param mixed $defaultValue the default value to return when the attribute does not exist.
     * @return mixed the attribute value.
     */
    public static function value($object, $attribute, $defaultValue = null)
    {
        if (is_scalar($attribute)) {
            foreach (explode('.', $attribute) as $name) {
                if (isset($object->$name)) {
                    $object = $object->$name;
                } elseif (isset($object[$name])) { //A::isArrayable($object) AND
                    $object = $object[$name];
                } else {
                    return $defaultValue;
                }
            }
            return $object;
        } elseif (is_callable($attribute)) {
            if ($attribute instanceof \Closure) {
                $attribute = \Closure::bind($attribute, $object);
            }
            return call_user_func($attribute, $object);
        } else {
            return null;
        }
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