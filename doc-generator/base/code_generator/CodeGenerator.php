<?php
/**
 * Generates php code with documentation
 */

namespace phpdocSeleniumGenerator\code_generator;

use phpdocSeleniumGenerator\Helper;
use phpdocSeleniumGenerator\models\Method;

class CodeGenerator
{
    private $_tplClass;
    private $_tplMethod;

    const TPL_CLASS  = 'tpl/class.tpl';
    const TPL_METHOD = 'tpl/method.tpl';

    /** Prefix for each line of DocBlock of method */
    const METHOD_DOC_BLOCK_PREFIX = ' * ';
    /** Count of space symbol, which will be put before class implementation */
    const METHOD_LEFT_SPACE_OFFSET = 4;
    /** Useful width of DocBlock of method (symbol count) */
    const DOC_BLOCK_WIDTH = 112;

    /** @var array Additional description for arguments, which has empty description, indexed by argument name.
     * For example, description of some arguments skipped in off documentation (single variableName argument in store*,
     * in derivative methods etc.) */
    public $manualArgumentDescription = [
        'variableName' => 'the name of a variable in which the result is to be stored (see {@link doc_Stored_Variables})', // store*
        'pattern'      => 'the String-match Patterns (see {@link doc_String_match_Patterns})', // derivative
    ];

    function __construct()
    {
        $dir = __DIR__ . DIRECTORY_SEPARATOR;
        if (file_exists($dir . self::TPL_CLASS) && file_exists($dir . self::TPL_METHOD)) {
            $this->_tplClass  = Helper::unifyEOL(file_get_contents($dir . self::TPL_CLASS));
            $this->_tplMethod = Helper::unifyEOL(file_get_contents($dir . self::TPL_METHOD));
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
                '%method.name%'           => $method->name,
                '%method.arguments:list%' => $this->getArgumentListAsPhp($method),
                '%method.doc_block%'      => $this->getDocBlock($method),
            ]);
        }
        $code = strtr($this->_tplClass, [
            '%methods%' => $this->_addInLineBeginning($code, str_repeat(' ', self::METHOD_LEFT_SPACE_OFFSET)),
            '%date%'    => date('Y-m-d'),
        ]);

        return $code;
    }

    protected function getDocBlock(Method $method)
    {
        $docBlock =
            $this->_wrapAroundIfExist($this->phpDocDescription($method)) .
            $this->_wrapAroundIfExist($this->phpDocArguments($method), Helper::EOL) . // the blank lines around
            $this->_wrapAroundIfExist($this->phpDocReturnValue($method), Helper::EOL);

        return $this->_addInLineBeginning(trim($docBlock));
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
    protected function phpDocArguments(Method $method)
    {
        $phpDoc = [];

        // type + name of argument
        $maxLength = 0;
        foreach ($method->arguments as $argument) {
            $phpDoc[$argument->name] = '@param ' . $argument->type . '   $' . $argument->name . '  ';
            $length                  = strlen($phpDoc[$argument->name]);
            $maxLength               = ($length > $maxLength) ? $length : $maxLength;
        }

        // add formatted description for arguments (aligned for all arguments)
        $descriptionLength = self::DOC_BLOCK_WIDTH - $maxLength;
        $firstSpaces       = str_repeat(' ', $maxLength);
        foreach ($method->arguments as $argument) {
            $argDescription = ($argument->description === null)
                ? Helper::value($this->manualArgumentDescription, $argument->name, '')
                : $argument->description;

            if (!trim($argDescription)) { // trace empty description
                echo 'Warning [method = ' . $method->name . ']: argument has no description. Problem argument:'
                    . $argument->name . Helper::EOL;
            }

            $argDescription          = Helper::formatAsHtml($argDescription);
            $argDescription          = $this->_wordWrap($argDescription, $descriptionLength, Helper::EOL);
            $argDescription          = $this->_fixPhpDocLinks($argDescription);
            $argDescription          = trim($this->_addInLineBeginning($argDescription, $firstSpaces));
            $phpDoc[$argument->name] = str_pad($phpDoc[$argument->name], $maxLength) . $argDescription;
        }

        return join(Helper::EOL, $phpDoc);
    }

    /**
     * Returns description of specified method for DocBlock
     *
     * @param Method $method
     *
     * @return string       Parts of DocBlock of specified method
     */
    protected function phpDocDescription(Method $method)
    {
        // direct replaces
        $phpDoc = strtr($method->description, [
            '@see #doSelect' => '{@link select}',    // addSelection + removeSelection
            '<code>'         => '[<b>',              // for inline code blocks
            '</code>'        => '</b>]',
        ]);

        $phpDoc = Helper::formatAsHtml($phpDoc);
        return $this->_wordWrap($phpDoc, self::DOC_BLOCK_WIDTH, Helper::EOL);
    }

    /**
     * Returns description of return value of specified method for DocBlock
     *
     * @param Method $method
     *
     * @return string   Parts of DocBlock of specified method
     */
    protected function phpDocReturnValue(Method $method)
    {
        $phpDoc      = '@return  ' . $method->returnValue->type . '  ';
        $length      = strlen($phpDoc);
        $descrLength = self::DOC_BLOCK_WIDTH - $length;
        $firstSpaces = str_repeat(' ', $length);
        $phpDoc      = $phpDoc . $this->_wordWrap($method->returnValue->description, $descrLength, Helper::EOL);
        $phpDoc      = $this->_fixPhpDocLinks($phpDoc);
        $phpDoc      = trim($this->_addInLineBeginning($phpDoc, $firstSpaces));

        return $phpDoc;
    }

    /**
     * Adds specified string in beginning of each line of specified text.
     *
     * @param string $multiLineText Multi line text
     * @param string $addString     String to add
     *
     * @return string
     */
    private function _addInLineBeginning($multiLineText, $addString = self::METHOD_DOC_BLOCK_PREFIX)
    {
        return $addString . join(Helper::EOL . $addString, explode(Helper::EOL, $multiLineText));
    }

    /**
     * Adds specified strings to the beginning and end of text, if it exist.
     *
     * @param string $text   Text to wrap
     * @param string $before String to add to the beginning of the text (if it exist)
     * @param string $after  String to add to the end of the text (if it exist)
     *
     * @return string
     */
    private function _wrapAroundIfExist($text, $before = '', $after = Helper::EOL)
    {
        if ($text) {
            $text = $before . $text . $after;
        }
        return $text;
    }

    /**
     * Wraps specified text to a given number of characters (like {@link wordwrap})
     *
     * @param string $text  The input text.
     * @param int    $width The column width.
     * @param string $break The line is broken using the optional break parameter.
     *
     * @return string
     */
    private function _wordWrap($text, $width = 75, $break = Helper::EOL)
    {
        // don't break special words
        $specialWordsReplaceRules = [];
        if (preg_match_all('/\{\@link\s+.+\}/', $text, $m)) {
            $i = 0;
            foreach ($m[0] as $specialWord) {
                $specialWordsReplaceRules[$specialWord] = $i . str_repeat('_', strlen($specialWord) - 1);
                $i++;
            }
        }
        $text = strtr($text, $specialWordsReplaceRules);

        // word wrap
        $text = wordwrap($text, $width, $break);

        // restore of special words
        $text = strtr($text, array_flip($specialWordsReplaceRules));
        return $text;
    }

    /**
     * Fixes {@.link linkName} tags (phpDoc): This tag can not be clicked when located in the first line
     * (only for @.param, @.var, @.return, @.property)
     *
     * @param string $text
     *
     * @return string
     */
    private function _fixPhpDocLinks($text)
    {
        if ($text) {
            $lines     = explode(Helper::EOL, $text);
            $firstLine = $lines[0];

            // find '{@link linkName}' or '(see {@link linkName})'
            if (preg_match('/(\(see\s+)?\{@link\s+\w+\}\)?/', $firstLine, $m)) {
                $linkTag   = $m[0];
                $firstLine = str_replace($linkTag, Helper::EOL . $linkTag, $firstLine); // fix: add EOL before tag
            }
            $lines[0] = $firstLine;
            $text     = join(Helper::EOL, $lines);
        }
        return $text;
    }
}