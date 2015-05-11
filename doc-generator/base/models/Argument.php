<?php
/**
 * This class contain description of single argument of selenium method
 */

namespace phpdocSeleniumGenerator\models;

use phpdocSeleniumGenerator\Helper;


class Argument extends MethodComponent
{
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