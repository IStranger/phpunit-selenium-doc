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

    const REGEXP_PHPDOC_INLINE_LINK = '\{@link\s+[\w\$\(\)\:]+(?:\s+[\w\$\(\)\:]+)*\}';


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
     * Additional description for arguments.
     *
     * @return array    Additional description for arguments, which has empty description, indexed by argument name.
     *                  For example, description of some arguments skipped in off documentation (single variableName
     *                  argument in store*, in derivative methods etc.)
     */
    function manualArgumentDescription()
    {
        return [
            'variableName' => 'the name of a variable in which the result is to be stored (see ' .
                CodeGenerator::linkToProperty('doc_Stored_Variables', '', 'Stored Variables') . ')', // store*
            'pattern'      => 'the String-match Patterns (see ' .
                CodeGenerator::linkToProperty('doc_String_match_Patterns', '', 'String match Patterns') . ')', // derivative
        ];
    }

    /**
     * Optional arguments (and their default values) of methods.
     * @return array Array in format: ['methodName' => ['argumentName' => 'defaultValue']]
     */
    function optionalArguments()
    {
        return [
            'waitForCondition'   => ['timeout' => null],
            'waitForFrameToLoad' => ['timeout' => null],
            'waitForPageToLoad'  => ['timeout' => null],
            'waitForPopUp'       => ['timeout' => null, 'windowID' => null],
            'selectPopUp'        => ['windowID' => null],
            'selectPopUpAndWait' => ['windowID' => null],
            'selectWindow'       => ['windowID' => null],
        ];
    }

    /**
     * Returns generated php code for specified methods list.
     *
     * <b>Note:</b> object list can be updated (optional arguments etc.).
     *
     * @param Method[] $methods
     *
     * @return string phpCode
     */
    function generate($methods)
    {
        // prepare methods
        $optionalArgsMyMethodName = $this->optionalArguments();
        foreach ($methods as $method) {
            if ($optionalArgs = Helper::value($optionalArgsMyMethodName, $method->name)) {
                foreach ($optionalArgs as $argName => $argDefaultValue) {
                    $method->getArgumentByName($argName)->setAsOptional($argDefaultValue);
                }
            }
        }

        // generate
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
        $newMethod              = $oldMethod->createClone();
        $newMethod->name        = $newMethodName;
        $newMethod->type        = Method::determineTypeByName($newMethod->name);
        $newMethod->subtype     = Method::determineSubtypeByName($newMethod->name);
        $newMethod->description = $this->_addEndDotIfNotExist($newMethod->description); // add end of last sentence

        // see also links
        $newMethod->seeLinks = Helper::prependAssoc($newMethod->seeLinks, [
            $oldMethod->getNameFQSEN() => 'Base method, from which has been generated (automatically) current method'
        ]);

        if ($oldMethod->subtype === Method::SUBTYPE_BASE) {

            // ---- Source method has Action type
            switch ($newMethod->subtype) {
                case Method::SUBTYPE_BASE:                    // Action --> Action
                    return $newMethod;

                case Method::SUBTYPE_AND_WAIT:                // Action --> Action
                    $newMethod->description .=
                        '<h4>Notes:</h4>' .
                        '<p>After execution of this action, Selenium wait for a new page to load ' .
                        '(see ' . CodeGenerator::linkToMethod('waitForPageToLoad') . ')</p>';
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
                        '<h4>Stored value:</h4>' .
                        '<p>' . $newMethod->returnValue->description . ' (see ' .
                        CodeGenerator::linkToProperty('doc_Stored_Variables', '', 'Stored Variables') . ')</p>';

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
                    $relatedVerifyMethodName = $newMethod->makeNameForSubtype(Method::SUBTYPE_VERIFY);

                    $newMethod->description =
                        'Assertion: ' . $newMethod->description .
                        '<h4>Value to verify:</h4> ' .
                        '<p>' . $newMethod->returnValue->description . '</p>' .
                        '<h4>Notes:</h4> ' .
                        '<p>If assertion will fail the test, it will abort the current test case ' .
                        '(in contrast to the ' . CodeGenerator::linkToMethod($relatedVerifyMethodName) . ').</p>';

                    $newMethod->returnValue->description = ''; // assert* methods has no return value todo to check this
                    return $newMethod;

                case Method::SUBTYPE_VERIFY:                  // Accessor --> Assertion
                case Method::SUBTYPE_VERIFY_NOT:
                    $derivativeMethod = $newMethod->getDerivativeMethodByName($newMethodName, true);
                    $newMethod->setArgumentsAndKeepOldDescription($derivativeMethod->arguments);
                    $relatedAssertMethodName = $newMethod->makeNameForSubtype(Method::SUBTYPE_ASSERT);

                    $newMethod->description =
                        'Assertion: ' . $newMethod->description .
                        '<h4>Value to verify:</h4> ' .
                        '<p>' . $newMethod->returnValue->description . '</p>' .
                        '<h4>Notes:</h4> ' .
                        '<p>If assertion will fail the test, it will continue to run the test case ' .
                        '(in contrast to the ' . CodeGenerator::linkToMethod($relatedAssertMethodName) . ').</p>';

                    $newMethod->returnValue->description = ''; // verify* methods has no return value todo to check this
                    return $newMethod;

                case Method::SUBTYPE_WAIT_FOR:                  // Accessor --> Assertion
                case Method::SUBTYPE_WAIT_FOR_NOT:
                    $derivativeMethod = $newMethod->getDerivativeMethodByName($newMethodName, true);
                    $newMethod->setArgumentsAndKeepOldDescription($derivativeMethod->arguments);

                    $newMethod->description =
                        'Assertion: ' . $newMethod->description .
                        '<h4>Expected value/condition:</h4> ' .
                        '<p>' . $newMethod->returnValue->description . '</p>' .
                        '<h4>Notes:</h4> ' .
                        "<p>This command wait for some condition to become true (or returned value is equal specified value).</p>" .
                        '<p>This command will succeed immediately if the condition is already true.</p>';

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
            $this->_wrapAroundIfExist($this->phpDocSummary($method)) .
            $this->_wrapAroundIfExist($this->phpDocDescription($method), Helper::EOL) . // 2xEOL after Summary is required
            $this->_wrapAroundIfExist($this->phpDocArguments($method), Helper::EOL) .   // the blank lines around
            $this->_wrapAroundIfExist($this->phpDocReturnValue($method), Helper::EOL) .
            $this->_wrapAroundIfExist($this->phpDocSeeAlso($method), Helper::EOL);

        // strip excess EOLs:
        $docBlock = strtr($docBlock, [
            Helper::EOL . Helper::EOL . Helper::EOL . Helper::EOL . Helper::EOL => Helper::EOL . Helper::EOL,
            Helper::EOL . Helper::EOL . Helper::EOL . Helper::EOL               => Helper::EOL . Helper::EOL,
            Helper::EOL . Helper::EOL . Helper::EOL                             => Helper::EOL . Helper::EOL,
        ]);

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
            $str = '$' . $argument->name;   // all arguments of selenium commands has simple php type
            if ($argument->isOptional()) {
                $defaultValue = $argument->getDefaultValue();
                $defaultValue = ($defaultValue === null)
                    ? 'null'
                    : (string)$argument->getDefaultValue();
                $str .= ' = ' . $defaultValue;
            }
            $argumentList[] = $str;
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
            // <a href="#locators">element locator</a>
            'locators'   => '(see ' . static::linkToProperty('doc_Element_Locators', '', 'Element Locators') . ')',

            // <a href="#patterns">pattern</a>
            'patterns'   => '(see ' . static::linkToProperty('doc_String_match_Patterns', '', 'String match Patterns') . ')',

            // <a href="#storedVars">variable</a>
            'storedVars' => '(see ' . static::linkToProperty('doc_Stored_Variables', '', 'Stored Variables') . ')',
        ];

        // add formatted description for arguments (aligned for all arguments)
        $descriptionLength = self::DOC_BLOCK_WIDTH - $maxLength;
        $firstSpaces       = str_repeat(' ', $maxLength);
        foreach ($method->arguments as $argument) {
            $argDescription = ($argument->description === null)
                ? Helper::value($this->manualArgumentDescription(), $argument->name, '')
                : $argument->description;

            // trace, if empty description
            if (!trim($argDescription)) {
                echo 'Warning [method = ' . $method->name . ']: argument has no description. Problem argument:'
                    . $argument->name . Helper::EOL;
            }

            // direct replaces
            if (($argument->name === 'locator') && ($argDescription === 'an element locator')) {
                $argDescription = 'an <a href="#locators">element locator</a>';
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
     * Returns "Summary" of specified method for DocBlock
     *
     * @param Method $method
     *
     * @return string       Parts of DocBlock of specified method
     */
    protected function phpDocSummary(Method $method)
    {
        $phpDocDescription = $this->_prepareMethodDescriptionForPhpDoc($method->description);

        // Summary: first sentence
        $firstSentence = Helper::extractFirstSentence($phpDocDescription);
        $firstSentence = $this->_addEndDotIfNotExist($firstSentence);
        $phpDocSummary = Helper::plainText($firstSentence);

        return $this->_wordWrap($phpDocSummary, self::DOC_BLOCK_WIDTH);
    }

    /**
     * Returns "Description" of specified method for DocBlock
     *
     * @param Method $method
     *
     * @return string       Parts of DocBlock of specified method
     */
    protected function phpDocDescription(Method $method)
    {
        $phpDocDescription = $this->_prepareMethodDescriptionForPhpDoc($method->description);
        $firstSentence     = Helper::extractFirstSentence($phpDocDescription);

        // Description: others sentences (except first)
        $phpDocDescription = trim(str_replace($firstSentence, '', $phpDocDescription));
        $phpDocDescription = Helper::formatAsHtml($phpDocDescription);

        return $this->_wordWrap($phpDocDescription, self::DOC_BLOCK_WIDTH, Helper::EOL);
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
     * Returns description of "See also" of specified method for DocBlock.
     *
     * @param Method $method
     *
     * @note Notes
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
     * Returns generated inline link phpDoc-tag (for specified property).
     *
     * @param string $propertyName Name of property (without class name).
     *                             Example: 'propertyName' or '$propertyName'
     * @param string $className    Name of class, which contain specified property. Can contain namespaces.
     *                             By default (=''), it is assumed current class.
     *                             Example: 'ClassName', '\My\Space\MyClass'
     * @param string $linkTitle    Title of link.
     *
     * @return string              Generated inline link phpDoc-tag
     *
     * @see fqsenForProperty()
     */
    public static function linkToProperty($propertyName, $className = '', $linkTitle = '')
    {
        $linkTitle = $linkTitle
            ? ' ' . trim($linkTitle)
            : '';
        return '{@link ' . static::fqsenForProperty($propertyName, $className) . $linkTitle . '}';
    }

    /**
     * Returns generated inline link phpDoc-tag (for specified method).
     *
     * @param string $methodName   Name of method (without class name).
     *                             Example: 'methodName' or 'methodName()'
     * @param string $className    Name of class, which contain specified property. Can contain namespaces.
     *                             By default (=''), it is assumed current class.
     *                             Example: 'ClassName', '\My\Space\MyClass'
     * @param string $linkTitle    Title of link.
     *
     * @return string              Generated inline link phpDoc-tag
     *
     * @see fqsenForMethod()
     */
    public static function linkToMethod($methodName, $className = '', $linkTitle = '')
    {
        $linkTitle = $linkTitle
            ? ' ' . trim($linkTitle)
            : '';
        return '{@link ' . static::fqsenForMethod($methodName, $className) . $linkTitle . '}';
    }

    /**
     * Returns "Fully Qualified Structural Element Name" (FQSEN) for specified property.
     *
     * @param string $propertyName Name of property (without class name).
     *                             Example: 'propertyName' or '$propertyName'
     * @param string $className    Name of class, which contain specified property. Can contain namespaces.
     *                             By default (=''), it is assumed current class.
     *                             Example: 'ClassName', '\My\Space\MyClass'
     *
     * @return string              Generated FQSEN
     *
     * @see http://www.phpdoc.org/docs/latest/glossary.html#term-fully-qualified-structural-element-name-fqsen
     * @see http://www.phpdoc.org/docs/latest/glossary.html#term-structural-element
     */
    public static function fqsenForProperty($propertyName, $className = '')
    {
        $className    = $className
            ? trim($className) . '::'
            : '';
        $propertyName = '$' . Helper::cutPrefix('$', $propertyName);

        return $className . $propertyName;
    }

    /**
     * Returns "Fully Qualified Structural Element Name" (FQSEN) for specified method.
     *
     * @param string $methodName   Name of method (without class name).
     *                             Example: 'methodName' or 'methodName()'
     * @param string $className    Name of class, which contain specified property. Can contain namespaces.
     *                             By default (=''), it is assumed current class.
     *                             Example: 'ClassName', '\My\Space\MyClass'
     *
     * @return string              Generated FQSEN
     *
     * @see http://www.phpdoc.org/docs/latest/glossary.html#term-fully-qualified-structural-element-name-fqsen4e
     * @see http://www.phpdoc.org/docs/latest/glossary.html#term-structural-element
     */
    public static function fqsenForMethod($methodName, $className = '')
    {
        $className  = $className
            ? trim($className) . '::'
            : '';
        $methodName = Helper::cutPostfix('()', $methodName) . '()';
        return $className . $methodName;
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
        if (preg_match_all('/' . self::REGEXP_PHPDOC_INLINE_LINK . '/', $text, $m)) {
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
            if (preg_match('/(\(see\s+)?' . self::REGEXP_PHPDOC_INLINE_LINK . '\)?/', $firstLine, $m)) {
                $linkTag   = $m[0];
                $firstLine = str_replace($linkTag, Helper::EOL . $linkTag, $firstLine); // fix: add EOL before tag
            }
            $lines[0] = $firstLine;
            $text     = join(Helper::EOL, $lines);
        }
        return $text;
    }

    /**
     * Adds dot (if not exist) in to end of specified text (completion of sentence).
     *
     * @param string $text
     *
     * @return string   Trimmed text with dot in the end.
     */
    private function _addEndDotIfNotExist($text)
    {
        $endSymbols = '[' . join('', Helper::$endOfSentence) . ']'; // symbol class like: [.!?]
        // find text like: "end</p>", "end </p>", "end  </p>"
        $regExpDotBeforeClosingTag = '/(?<!' . $endSymbols . '|' . $endSymbols . '\s|' . $endSymbols . '\s\s)(?P<tag><\/\w+>)\s*\Z/';

        $testedText = trim(strip_tags($text));
        if ($testedText && !Helper::hasPostfix(Helper::$endOfSentence, $testedText)) {
            $postfix = preg_match($regExpDotBeforeClosingTag, $text, $m)
                ? $m['tag']
                : '';
            $text    = Helper::cutPostfix($postfix, rtrim($text)) . '.' . $postfix;
        }
        return $text;
    }

    /**
     * Prepares {@link Method::description} for phpDoc: replaces some words etc.
     *
     * @param string $methodDescription description of method
     *
     * @return string
     */
    private function _prepareMethodDescriptionForPhpDoc($methodDescription)
    {
        // direct replaces
        $phpDocDescription = strtr($methodDescription, [
            '@see #doSelect' => 'See ' . CodeGenerator::linkToMethod('select'),     // addSelection + removeSelection
            '<code>'         => '[<b>',                                             // for inline code blocks
            '</code>'        => '</b>]',
        ]);

        return $phpDocDescription;
    }
}