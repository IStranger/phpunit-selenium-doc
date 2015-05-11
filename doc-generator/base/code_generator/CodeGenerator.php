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

    /** Prefix for each line of DocBlock of method */
    const METHOD_DOC_BLOCK_PREFIX = ' * ';
    /** Useful width of DocBlock of method (symbol count) */
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
                '%method.arguments:php_doc%'         => $this->getArgumentsAsPhpDoc($method),
                '%method.returnValue:php_doc%'       => $this->getReturnValueAsPhpDoc($method),
                '%method.derivativeMethods:php_doc%' => self::METHOD_DOC_BLOCK_PREFIX,
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

    /**
     * Returns arguments description for DocBlock of specified method
     *
     * @param Method $method
     *
     * @return string           Parts of DocBlock of specified method
     */
    protected function getArgumentsAsPhpDoc(Method $method)
    {
        $phpDoc = [];

        // type + name of argument
        $maxLength = 0;
        foreach ($method->arguments as $argument) {
            $phpDoc[$argument->name] = '@param ' . $argument->type . '   $' . $argument->name . '  ';
            $length = strlen($phpDoc[$argument->name]);
            $maxLength = ($length > $maxLength) ? $length : $maxLength;
        }

        // add formatted description for arguments (aligned for all arguments)
        $descriptionLength = self::DOC_BLOCK_WIDTH - $maxLength;
        $firstSpaces = str_repeat(' ', $maxLength);
        foreach ($method->arguments as $argument) {
            $argDescription = wordwrap($argument->description, $descriptionLength, PHP_EOL . $firstSpaces);
            $phpDoc[$argument->name] = str_pad($phpDoc[$argument->name], $maxLength) . $argDescription . PHP_EOL;
        }

        return $this->addInLineBeginning(join('', $phpDoc));
    }

    /**
     * Returns description of specified method for DocBlock
     *
     * @param Method $method
     *
     * @return string       Parts of DocBlock of specified method
     */
    protected function getDescriptionAsPhpDoc(Method $method)
    {
        // need ignore of <code> blocks ...
        return $this->addInLineBeginning(wordwrap($method->description, self::DOC_BLOCK_WIDTH, PHP_EOL));
    }

    protected function getReturnValueAsPhpDoc(Method $method)
    {
        $phpDoc = '@return  ' . $method->returnValue->type . '  ';
        $length = strlen($phpDoc);
        $descriptionLength = self::DOC_BLOCK_WIDTH - $length;
        $firstSpaces = str_repeat(' ', $length);
        $phpDoc = $phpDoc . wordwrap($method->returnValue->description, $descriptionLength, PHP_EOL . $firstSpaces);

        return $this->addInLineBeginning($phpDoc);
    }

    /**
     * Adds specified string in beginning of each line of specified text.
     *
     * @param string $multiLineText Multi line text
     * @param string $addString     String to add
     *
     * @return string
     */
    protected function addInLineBeginning($multiLineText, $addString = self::METHOD_DOC_BLOCK_PREFIX)
    {
        return $addString . str_replace(PHP_EOL, PHP_EOL . $addString, $multiLineText);
    }
}