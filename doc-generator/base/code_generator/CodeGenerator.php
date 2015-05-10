<?php
/**
 * Generates php code with documentation
 */

namespace phpdocSeleniumGenerator\code_generator;

use phpdocSeleniumGenerator\models\Method;

class CodeGenerator
{
    private $_tplClass;
    private $_tplMethod;

    const TPL_CLASS  = 'tpl/class.tpl';
    const TPL_METHOD = 'tpl/method.tpl';

    /**
     * Useful width of DocBlock of method (symbol count)
     */
    const DOC_BLOCK_WIDTH = 112;

    function __construct()
    {
        $dir = __DIR__ . DIRECTORY_SEPARATOR;
        if (file_exists($dir . self::TPL_CLASS) && file_exists($dir . self::TPL_METHOD)) {
            $this->_tplClass = file_get_contents($dir . self::TPL_CLASS);
            $this->_tplMethod = file_get_contents($dir . self::TPL_METHOD);
        } else {
            throw new \Exception('Not found templates for code generator');
        }
    }

    /**
     * Returns generated php code for specified methods list
     *
     * @param Method[] $methods
     *
     * @return string phpCode
     */
    function generate($methods)
    {
        $code = '';
        foreach ($methods as $method) {
            $code .= strtr($this->_tplMethod, [
                '%method.name%'                      => $method->name,
                '%method.arguments:list%'            => $this->getArgumentListAsPhp($method),
                '%method.description:php_doc%'       => $this->getDescriptionAsPhpDoc($method),
                '%method.arguments:php_doc%'         => '*',
                '%method.returnValue:php_doc%'       => '*',
                '%method.derivativeMethods:php_doc%' => '*',
            ]);
        }
        $code = strtr($this->_tplClass, [
            '%methods%' => $code,
            '%date%'    => date('Y-m-d'),
        ]);

        return $code;
    }

    /**
     * Returns formatted argument list of specified method (as correct argument list for php function)
     *
     * @param Method $method
     *
     * @return string           Correct argument list for php function
     */
    protected function getArgumentListAsPhp(Method $method)
    {
        $argumentList = [];
        foreach ($method->arguments as $argument) {
            $argumentList[] = '$' . $argument->name; // all arguments of selenium commands has simple php type
        }
        return join(', ', $argumentList);
    }

    protected function getDescriptionAsPhpDoc(Method $method)
    {
        // need ignore of <code> blocks ...
        return $this->addFirstStar(wordwrap($method->description, self::DOC_BLOCK_WIDTH, PHP_EOL));
    }

    protected function addFirstStar($str)
    {
        return '* ' . str_replace(PHP_EOL, PHP_EOL . '* ', $str);
    }
}