<?php
/**
 * Base class for phpdoc generator
 */

namespace phpdocSeleniumGenerator;

class Base
{
    /**
     * @return string Name of current class
     */
    static function className()
    {
        return get_called_class();
    }

    /**
     * @return static New instance of current class
     */
    static function modelNew()
    {
        $className = static::className();
        return new $className();
    }

    /**
     * Throws exception with specified message
     *
     * @param string $msg Exception message
     *
     * @throws \Exception
     */
    protected function throwException($msg)
    {
        $msg = 'Class "' . static::className() . '" ::> ' . $msg;
        throw new \Exception($msg);
    }
}