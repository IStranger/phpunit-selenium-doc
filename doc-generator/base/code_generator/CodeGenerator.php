<?php
/**
 * Generates php code with documentation
 */

namespace phpdocSeleniumGenerator\code_generator;

use phpdocSeleniumGenerator\Helper;
use phpdocSeleniumGenerator\models\Method;

class CodeGenerator
{
    use \phpdocSeleniumGenerator\CommonTrait;

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

    /**
     * Creates new method with the specified name (converts from current method).
     * Only {@link Method::SUBTYPE_BASE} + {@link Method::SUBTYPE_STORE} supported for current method.
     *
     * @param Method $oldMethod     Source method, from which created new method
     * @param string $newMethodName Name of new method
     *
     * @return Method               New converted method
     * @throws \Exception           If current method has unsupported subtype, or incorrect name for new method
     */
    function createNewMethodWithName(Method $oldMethod, $newMethodName)
    {
        $newMethod          = $oldMethod->createClone();
        $newMethod->name    = $newMethodName;
        $newMethod->type    = Method::determineTypeByName($newMethod->name);
        $newMethod->subtype = Method::determineSubtypeByName($newMethod->name);

        // see also links
        $newMethod->seeLinks = Helper::prependAssoc($newMethod->seeLinks, [
            $oldMethod->name => 'Base method, from which has been generated (automatically) current method'
        ]);

        if ($oldMethod->subtype === Method::SUBTYPE_BASE) {

            // ---- Source method has Action type
            switch ($newMethod->subtype) {
                case Method::SUBTYPE_BASE:                    // Action --> Action
                    return $newMethod;

                case Method::SUBTYPE_AND_WAIT:                // Action --> Action
                    $newMethod->description .= Helper::EOL . Helper::EOL . ' <p><b>Note:</b> After execution of this action, ' .
                        'Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>';
                    return $newMethod;

                default:
                    self::throwException("Incorrect subtype for creating of new method: '$oldMethod->subtype'. " .
                                         "Source method (Action) should be converted only to Action.");
            }

        } elseif ($oldMethod->subtype === Method::SUBTYPE_STORE) {

            // ---- Source method has Accessor type
            switch ($newMethod->subtype) {
                case Method::SUBTYPE_STORE:                   // Accessor --> Accessor
                    $newMethod->description .=
                        '<h3>Stored value:</h3>' .
                        '<p>' . $newMethod->returnValue->description . ' (see {@link doc_Stored_Variables})</p>';

                    $newMethod->returnValue->description = ''; // store* methods has no return value todo to check this
                    return $newMethod;

                case Method::SUBTYPE_GET:                     // Accessor --> Accessor
                    $newMethod->deleteArgumentByName('variableName');
                    return $newMethod;

                case Method::SUBTYPE_IS:                      // Accessor --> Accessor
                    $newMethod->deleteArgumentByName('variableName');
                    return $newMethod;

                case Method::SUBTYPE_ASSERT:                  // Accessor --> Assertion
                case Method::SUBTYPE_ASSERT_NOT:
                    $derivativeMethod = $newMethod->getDerivativeMethodByName($newMethodName, true);
                    $newMethod->setArgumentsAndKeepOldDescription($derivativeMethod->arguments);

                    $newMethod->description =
                        '<b>Assertion:</b> ' .
                        $newMethod->description .
                        '<h3>Value to verify:</h3> ' .
                        '<p>' . $newMethod->returnValue->description . '</p>' .
                        '<h3>Notes:</h3> ' .
                        '<p>If assertion will fail the test, it will abort the current test case (in contrast to the verify*).</p>'; // todo add related verify* link

                    $newMethod->returnValue->description = ''; // assert* methods has no return value todo to check this
                    return $newMethod;

                case Method::SUBTYPE_VERIFY:                  // Accessor --> Assertion
                case Method::SUBTYPE_VERIFY_NOT:
                    $derivativeMethod = $newMethod->getDerivativeMethodByName($newMethodName, true);
                    $newMethod->setArgumentsAndKeepOldDescription($derivativeMethod->arguments);

                    $newMethod->description =
                        '<b>Assertion:</b> ' .
                        $newMethod->description .
                        '<h3>Value to verify:</h3> ' .
                        '<p>' . $newMethod->returnValue->description . '</p>' .
                        '<h3>Notes:</h3> ' .
                        '<p>If assertion will fail the test, it will continue to run the test case (in contrast to the assert*).</p>'; // todo add related assert* link

                    $newMethod->returnValue->description = ''; // verify* methods has no return value todo to check this
                    return $newMethod;

                case Method::SUBTYPE_WAIT_FOR:                  // Accessor --> Assertion
                case Method::SUBTYPE_WAIT_FOR_NOT:
                    $derivativeMethod = $newMethod->getDerivativeMethodByName($newMethodName, true);
                    $newMethod->setArgumentsAndKeepOldDescription($derivativeMethod->arguments);

                    $newMethod->description =
                        '<b>Assertion:</b> ' .
                        $newMethod->description .
                        '<h3>Expected value/condition:</h3> ' .
                        '<p>' . $newMethod->returnValue->description . '</p>' .
                        '<h3>Notes:</h3> ' .
                        "<p>This command wait for some condition to become true (or returned value is equal specified value).</p>" .
                        '<p><b>Note:</b> This command will succeed immediately if the condition is already true.</p>';

                    $newMethod->returnValue->description = ''; // waitFor* methods has no return value todo to check this
                    return $newMethod;

                default:
                    self::throwException("Incorrect subtype for creating of new method: '{$oldMethod->subtype}'. " .
                                         "Source method (Accessor) should be converted only to Accessor or Assertion.");
            }

        } else {
            self::throwException("Incorrect subtype of source method: '{$oldMethod->subtype}'. " .
                                 "Source method support only Method::SUBTYPE_BASE and Method::SUBTYPE_STORE subtypes.");
        }

        return $newMethod;
    }

    protected function getDocBlock(Method $method)
    {
        $docBlock =
            $this->_wrapAroundIfExist($this->phpDocDescription($method)) .
            $this->_wrapAroundIfExist($this->phpDocArguments($method), Helper::EOL) . // the blank lines around
            $this->_wrapAroundIfExist($this->phpDocReturnValue($method), Helper::EOL) .
            $this->_wrapAroundIfExist($this->phpDocSeeAlso($method), Helper::EOL);

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
            $maxLength               = max($maxLength, strlen($phpDoc[$argument->name]));
        }

        // html link replace pairs
        $linkReplaces = [
            'locators'   => '(see {@link doc_Element_Locators})',       // <a href="#locators">element locator</a>
            'patterns'   => '(see {@link doc_String_match_Patterns})',  // <a href="#patterns">pattern</a>
            'storedVars' => '(see {@link doc_Stored_Variables})',       // <a href="#storedVars">variable</a>
        ];

        // add formatted description for arguments (aligned for all arguments)
        $descriptionLength = self::DOC_BLOCK_WIDTH - $maxLength;
        $firstSpaces       = str_repeat(' ', $maxLength);
        foreach ($method->arguments as $argument) {
            $argDescription = ($argument->description === null)
                ? Helper::value($this->manualArgumentDescription, $argument->name, '')
                : $argument->description;

            // trace, if empty description
            if (!trim($argDescription)) {
                echo 'Warning [method = ' . $method->name . ']: argument has no description. Problem argument:'
                    . $argument->name . Helper::EOL;
            }

            // replace html link tags
            foreach ($linkReplaces as $linkHash => $linkPhpDoc) {
                $regExp = '/<a href="#' . $linkHash . '">([\w ]+)<\/a>/';
                if (preg_match($regExp, $argDescription)) {
                    $argDescription = preg_replace($regExp, '$1', $argDescription) . ' ' . $linkPhpDoc;
                }
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
     * Returns description of "See also" of specified method for DocBlock
     *
     * @param Method $method
     *
     * @return string   Parts of DocBlock of specified method
     */
    protected function phpDocSeeAlso(Method $method)
    {
        $phpDoc    = [];
        $maxLength = 0;
        foreach ($method->seeLinks as $seeLink => $seeLinkDescr) {
            $phpDoc[$seeLink] = '@see  ' . $seeLink . '  ';
            $maxLength        = max($maxLength, strlen($phpDoc[$seeLink]));
        }

        $descrLength = self::DOC_BLOCK_WIDTH - $maxLength;
        $firstSpaces = str_repeat(' ', $maxLength);
        foreach ($method->seeLinks as $seeLink => $seeLinkDescr) {
            $descr            = $this->_wordWrap($seeLinkDescr, $descrLength);
            $descr            = trim($this->_addInLineBeginning($descr, $firstSpaces));
            $phpDoc[$seeLink] = str_pad($phpDoc[$seeLink], $maxLength) . $descr;
        }

        return join(Helper::EOL, $phpDoc);
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
        if (preg_match_all('/\{\@link\s+\w+\}/', $text, $m)) {
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