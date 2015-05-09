<?php
/**
 * This class describe value, which returned by method (php variable type, description)
 */

namespace phpdocSeleniumGenerator\models;


class ReturnValue extends MethodComponent
{
    /**
     * @var string Type of return value (php variable type)
     */
    public $type;

    /**
     * @var string Description of return value
     */
    public $description;
}