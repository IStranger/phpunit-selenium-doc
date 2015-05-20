<?php
/**
 * Base class for phpdoc generator
 */

namespace phpdocSeleniumGenerator\models;


class Base
{
    private static $_propertyNamesCache = [];

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
     * Creates clone of current instance (recursive!)
     *
     * @param string[]|null $propertyNamesToCopy   List of property names, whose values will be copied to clone of
     *                                             model. If =null, mean all properties.
     *
     * @return static New instance of current class with the same property values
     */
    function createClone($propertyNamesToCopy = null)
    {
        $copyPropertyNames = ($propertyNamesToCopy === null)
            ? $this->getPropertyNames()
            : $propertyNamesToCopy;

        $cloneModel = $this::createNew()
            ->setProperties($this->getProperties($copyPropertyNames));

        foreach ($copyPropertyNames as $propertyName) {
            $cloneModel->{$propertyName} = $this->_recursiveCloneIfNecessary($cloneModel->{$propertyName});
        }
        return $cloneModel;
    }

    /**
     * Sets property values.
     *
     * @param array $propValues Array of property values in format: ['propName' => 'propValue']
     *
     * @return $this            Returns current instance.
     */
    function setProperties($propValues)
    {
        foreach ($propValues as $propName => $propValue) {
            if (property_exists($this, $propName)) {
                $this->{$propName} = $propValue;
            } else {
                $this->throwException('Property "%propName%" does not exist in class "%className%"', [
                    '%propName%'  => $propName,
                    '%className%' => static::className(),
                ]);
            }
        }
        return $this;
    }
    
    /**
     * Gets property values.
     *
     * @param string[]|null $propertyNames   List of property names, whose values will be returned.
     *                                       If =null, mean all properties.
     *
     * @return array $propValues Array of property values in format: ['propName' => 'propValue'].
     */
    function getProperties($propertyNames = null)
    {
        $propertyNameList = ($propertyNames === null)
            ? $this->getPropertyNames()
            : $propertyNames;

        $propValues = [];
        foreach ($propertyNameList as $propName) {
            $propValues[$propName] = $this->{$propName};
        }
        return $propValues;
    }

    /**
     * Returns the list of property names.
     * By default, this method returns all public properties of the class.
     *
     * @return array list of property names. Defaults to all public properties of the class.
     */
    protected function getPropertyNames()
    {
        $className = get_class($this);
        if (!isset(self::$_propertyNamesCache[$className])) {
            $class = new \ReflectionClass(get_class($this));
            $names = [];
            foreach ($class->getProperties() as $property) {
                $name = $property->getName();
                if ($property->isPublic() && !$property->isStatic())
                    $names[] = $name;
            }
            return self::$_propertyNamesCache[$className] = $names;
        } else
            return self::$_propertyNamesCache[$className];
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

    /**
     * If specified value is instance of Base class (or Base child class), returns clone of this value,
     * otherwise returns the same value. <br/>
     * If value is array, this method will be called recursively for each array item.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    private function _recursiveCloneIfNecessary($value)
    {
        if (is_array($value)) {
            foreach ($value as $k => $v) {
                $value[$k] = $this->_recursiveCloneIfNecessary($v);
            }
            return $value;
        } else {
            return ($value instanceof Base)
                ? $value->createClone()
                : $value;
        }
    }
}