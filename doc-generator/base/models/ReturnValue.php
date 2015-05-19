<?php
/**
 * This class describe value, which returned by method (php variable type, description)
 */

namespace phpdocSeleniumGenerator\models;


class ReturnValue extends MethodComponent
{
    const TYPE_VOID         = 'void';
    const TYPE_BOOL         = 'bool';
    const TYPE_INT          = 'int';
    const TYPE_STRING       = 'string';
    const TYPE_STRING_ARRAY = 'string[]';

    /**
     * @var string Type of return value (php variable type)
     */
    public $type;

    /**
     * @var string Description of return value
     */
    public $description;
}