<?php
/**
 * This class contain description of single argument of selenium method
 */

namespace phpdocSeleniumGenerator\models;

use phpdocSeleniumGenerator\Helper;


class Argument extends MethodComponent
{

    const TYPE_STRING = 'string';
    const TYPE_ARRAY  = 'array';

    /**
     * Default type of argument (php variable type)
     */
    const DEFAULT_TYPE = self::TYPE_STRING;

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

}