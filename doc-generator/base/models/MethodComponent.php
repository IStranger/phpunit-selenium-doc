<?php
/**
 * This class contain description selenium method component (argument, returnValue)
 */

namespace phpdocSeleniumGenerator\models;


class MethodComponent extends Base
{
    private $_method;

    /**
     * @param Method $method Related method for this argument
     */
    function __construct(Method $method = null)
    {
        if ($method) {
            $this->setMethod($method);
        }
    }

    /**
     * @return Method Related method for this argument
     */
    function getMethod()
    {
        return $this->_method;
    }

    /**
     * @param Method $method Set specified as "related method" for this argument
     *
     * @return $this
     */
    function setMethod(Method $method)
    {
        $this->_method = $method;
        return $this;
    }
}