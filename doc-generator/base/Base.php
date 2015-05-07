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
}