<?php
/**
 * This class contain description of single argument of selenium method
 */

namespace phpdocSeleniumGenerator\models;


class Argument extends MethodComponent
{

    const TYPE_STRING = 'string';
    const TYPE_ARRAY  = 'array';

    /**
     * Default type of argument (php variable type)
     */
    const DEFAULT_TYPE = self::TYPE_STRING;

    private $_isOptional = false;
    private $_defaultValue;

    /**
     * @var string Name of argument
     */
    public $name;

    /**
     * @var string Type of argument (php variable type)
     */
    public $type;

    /**
     * @var string Description of argument
     */
    public $description;

    /**
     * Sets current argument as optional and assigns default value.
     * Default value can be accessed using {@link getDefaultValue}.
     *
     * @param mixed $defaultValue
     *
     * @return $this
     *
     * @see getDefaultValue()
     * @see setAsRequired()
     * @see isOptional()
     */
    public function setAsOptional($defaultValue)
    {
        $this->_isOptional   = true;
        $this->_defaultValue = $defaultValue;
        return $this;
    }

    /**
     * Marks the current argument as required, and resets the default value.
     *
     * @return $this
     *
     * @see setAsOptional()
     * @see isOptional()
     */
    public function setAsRequired()
    {
        $this->_isOptional   = false;
        $this->_defaultValue = null;
        return $this;
    }

    /**
     * Checks, whether the current argument is optional.
     *
     * @return bool Returns =true, if the argument is optional, otherwise =false
     */
    public function isOptional()
    {
        return $this->_isOptional;
    }

    /**
     * Returns default value (only for optional arguments).
     *
     * @return mixed
     * @throws \Exception   If argument is required
     *
     * @see setAsRequired()
     * @see isOptional()
     */
    public function getDefaultValue()
    {
        if ($this->isOptional()) {
            return $this->_defaultValue;
        }
        $this::throwException('Default value can be accessed only for optional argument');
    }
}