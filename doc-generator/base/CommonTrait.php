<?php
/**
 * Trait CommonTrait
 * contain common methods
 */

namespace phpdocSeleniumGenerator;


trait CommonTrait
{
    /**
     * @return string Name of current class.
     */
    static function className()
    {
        return get_called_class();
    }

    /**
     * @return static New instance of current class.
     */
    static function createNew()
    {
        $className = static::className();
        return new $className();
    }

    /**
     * Throws exception with specified message.
     *
     * @param string $msg Exception message.
     *
     * @throws \Exception
     */
    protected static function throwException($msg)
    {
        $msg = 'Class "' . static::className() . '" ::> ' . $msg;
        throw new \Exception($msg);
    }
}