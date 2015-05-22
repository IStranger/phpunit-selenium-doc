<?php
/**
 * This class contain full description of selenium method (target, arguments list, return value etc.)
 */

namespace phpdocSeleniumGenerator\models;

use phpdocSeleniumGenerator\code_generator\CodeGenerator;
use phpdocSeleniumGenerator\Helper;

class Method extends Base
{
    /**
     * Actions are commands that generally manipulate the state of the application.
     * They do things like "click this link" and "select that option".
     * If an Action fails, or has an error, the execution of the current test is stopped.
     *
     * Many Actions can be called with the "AndWait" suffix, e.g. "clickAndWait". This suffix tells Selenium that the
     * action will cause the browser to make a call to the server, and that Selenium should wait for a new page to
     * load.
     *
     * <b>Note:</b> Not all actions can be called with the "AndWait" suffix (for example waitFor* actions)
     *
     * @see Method::TYPE_ACCESSOR
     * @see Method::TYPE_ASSERTION
     */
    const TYPE_ACTION = 'action';

    /**
     * Accessors examine the state of the application and store the results in variables, e.g. "storeTitle",
     * "getElementWidth" or "isTextPresent". They are also used to automatically generate Assertions.
     *
     * @see Method::TYPE_ACTION
     * @see Method::TYPE_ASSERTIONsdfsd
     */
    const TYPE_ACCESSOR = 'accessor';

    /**
     * Assertions are like Accessors (see {@link Method::TYPE_ACCESSOR}), but they verify that the state of the
     * application conforms to what is expected. Examples include "make sure the page title is X" and "verify that this
     * checkbox is checked".
     *
     * All Selenium Assertions can be used in 3 modes: "assert", "verify", and "waitFor". For example, you can
     * "assertText", "verifyText" and "waitForText". When an "assert" fails, the test is aborted. When a "verify"
     * fails, the test will continue execution, logging the failure. This allows a single "assert" to ensure that the
     * application is on the correct page, followed by a bunch of "verify" assertions to test form field values,
     * labels, etc.
     *
     * "waitFor" commands wait for some condition to become true (which can be useful for testing Ajax applications).
     * They will succeed immediately if the condition is already true. However, they will fail and halt the test if the
     * condition does not become true within the current timeout setting (see the setTimeout action below).
     *
     * <b>Note:</b> all assertions automatically generated from related accessor
     *
     * @see Method::TYPE_ACTION
     * @see Method::TYPE_ACCESSOR
     */
    const TYPE_ASSERTION = 'assertion';

    /**
     * @var array   Possible values of
     *              {@link type} (array keys) and labels (array values)
     */
    static $typesAll = [
        self::TYPE_ACTION    => 'Action',
        self::TYPE_ACCESSOR  => 'Accessor',
        self::TYPE_ASSERTION => 'Assertion',
    ];

    // action subtypes:
    const SUBTYPE_BASE     = 'action';
    const SUBTYPE_AND_WAIT = 'actionAndWait';

    // accessor subtypes:
    const SUBTYPE_STORE = 'storeAccessor';
    const SUBTYPE_GET   = 'getAccessor';
    const SUBTYPE_IS    = 'isAccessor';

    // assertion subtypes:
    const SUBTYPE_VERIFY       = 'verifyAssertion';
    const SUBTYPE_VERIFY_NOT   = 'verifyNotAssertion';
    const SUBTYPE_ASSERT       = 'assertAssertion';
    const SUBTYPE_ASSERT_NOT   = 'assertNotAssertion';
    const SUBTYPE_WAIT_FOR     = 'waitForAssertion';
    const SUBTYPE_WAIT_FOR_NOT = 'waitForNotAssertion';

    /**
     * @var array   Possible values of
     *              {@link subtype}, indexed by {@link type}
     */
    static $subtypesAll = [

        self::TYPE_ACTION    => [
            self::SUBTYPE_BASE,
            self::SUBTYPE_AND_WAIT,
        ],

        self::TYPE_ACCESSOR  => [
            self::SUBTYPE_STORE,
            self::SUBTYPE_GET,
            self::SUBTYPE_IS,
        ],

        self::TYPE_ASSERTION => [
            self::SUBTYPE_VERIFY,
            self::SUBTYPE_VERIFY_NOT,
            self::SUBTYPE_ASSERT,
            self::SUBTYPE_ASSERT_NOT,
            self::SUBTYPE_WAIT_FOR,
            self::SUBTYPE_WAIT_FOR_NOT,
        ],
    ];

    /**
     * @var string Name of method
     */
    public $name;

    /**
     * @var string Type of method (related command)
     *
     * @see typesAll
     * @see Method::TYPE_ACTION
     * @see Method::TYPE_ACCESSOR
     * @see Method::TYPE_ASSERTION
     */
    public $type;

    /**
     * @var string Subtype of method (related command)
     *
     * @see subtypesAll
     * @see Method::SUBTYPE_BASE
     * @see Method::SUBTYPE_AND_WAIT
     * @see Method::SUBTYPE_STORE
     * @see Method::SUBTYPE_GET
     * @see Method::SUBTYPE_IS
     * @see Method::SUBTYPE_VERIFY
     * @see Method::SUBTYPE_VERIFY_NOT
     * @see Method::SUBTYPE_ASSERT
     * @see Method::SUBTYPE_ASSERT_NOT
     * @see Method::SUBTYPE_WAIT_FOR
     * @see Method::SUBTYPE_WAIT_FOR_NOT
     */
    public $subtype;

    /**
     * @var array|Argument[] Array of method arguments, indexed by their names
     */
    public $arguments = [];

    /**
     * @var string Description of method
     */
    public $description;

    /**
     * @var ReturnValue Return value of method
     */
    public $returnValue;

    /**
     * @var array "See also" links in format: [fqsenname|URL] => 'description'
     * @see CodeGenerator::fqsenForProperty()
     * @see CodeGenerator::fqsenForMethod()
     */
    public $seeLinks = [];

    /**
     * @var array|Method[]  Derivative methods (only for store*: automatically generated related Assertions),
     *                      indexed by their names
     */
    public $derivativeMethods = [];

    /**
     * @param bool $lowerCase If =true, returned in lower case
     *
     * @return string Base name of method. <br/>
     *                Actions: without postfixes: *AndWait <br/>
     *                Accessors: without prefixes: store*, get*, is* <br/>
     *                Assertion: without prefixes: assert*, verify*, waitFor* <br/>
     * @throws \Exception   If not assigned
     *                      {@link type} of method
     */
    function getBaseName($lowerCase = false)
    {
        $baseName = null;
        switch ($this->type) {
            case static::TYPE_ACTION:
                $baseName = Helper::cutPostfix(['AndWait'], $this->name);
                break;

            case static::TYPE_ACCESSOR:
                $baseName = Helper::cutPrefix(['store', 'get', 'is'], $this->name);
                break;

            case static::TYPE_ASSERTION:
                $name     = str_replace('Not', '', $this->name);
                $baseName = Helper::cutPrefix(['assert', 'verify', 'waitFor'], $name);
                break;

            default:
                $this::throwException('Cannot determine base name without assigned type of method');
        }
        return $lowerCase ? strtolower($baseName) : $baseName;
    }

    /**
     * Returns FQSEN-name of current method (without class name)
     *
     * @return string FQSEN of current method
     *
     * @see CodeGenerator::fqsenForMethod()
     */
    function getNameFQSEN()
    {
        return CodeGenerator::fqsenForMethod($this->name);
    }

    /**
     * Adds specified argument model to the argument list of current method.
     *
     * @param Argument $argument Argument model to add
     *
     * @return $this
     * @throws \Exception If current method already has the argument with the same name.
     */
    function addArgument(Argument $argument)
    {
        if (array_key_exists($argument->name, $this->arguments)) {
            $this::throwException("Argument '{$argument->name}' cannot be added to the method '{$this->name}', " .
                                  "because the method already has argument with the same name.");
        } else {
            $this->arguments[$argument->name] = $argument;
        }
        return $this;
    }

    /**
     * Returns specified argument from argument list of the current method.
     *
     * @param string $argumentName   Name of argument
     * @param bool   $throwException Throw exception or return null
     *
     * @return Argument|null            Argument model, or =null if not found ($throwException = false)
     * @throws \Exception               If specified argument not found ($throwException = true)
     */
    function getArgumentByName($argumentName, $throwException = false)
    {
        if ($argument = Helper::value($this->arguments, $argumentName)) {
            return $argument;
        } else {
            if ($throwException) {
                $this::throwException('[Method = "' . $this->name . '"] Not found argument with name = ' . $argumentName);
            } else {
                return null;
            }
        }
    }

    /**
     * Deletes specified argument from argument list of the current method.
     *
     * @param string $argumentName Name of argument to delete
     *
     * @return $this
     */
    function deleteArgumentByName($argumentName)
    {
        $this->arguments = Helper::filterByKeys($this->arguments, null, [$argumentName]);
        return $this;
    }

    /**
     * Deletes all arguments
     *
     * @return $this
     */
    function deleteAllArguments()
    {
        $this->arguments = [];
        return $this;
    }

    function addDerivativeMethod(Method $method)
    {
        $this->derivativeMethods[$method->name] = $method;

        return $this;
    }

    /**
     * Returns derivative method by name
     *
     * @param string $fullMethodName Full name of method
     * @param bool   $throwException Throw exception or return null
     *
     * @return Method|null          Method model, or =null if not found ($throwException = false)
     * @throws \Exception           If specified method not found ($throwException = true)
     */
    function getDerivativeMethodByName($fullMethodName, $throwException = false)
    {
        if ($method = Helper::value($this->derivativeMethods, $fullMethodName)) {
            return $method;
        } else {
            if ($throwException) {
                $this::throwException('[Method = "' . $this->name . '"] Not found derivative method with name = ' . $fullMethodName);
            } else {
                return null;
            }
        }
    }

    /**
     * Determines {@link type} of method by name
     *
     * @param string $methodFullName Name of method
     *
     * @return string Type of method (related command),
     *                possible values see {@link typesAll}
     */
    static function determineTypeByName($methodFullName)
    {
        $name2type = [
            // 'store' => static::TYPE_ACTION,      // 'store' - is not detected as prefix store*, see Helper::hasPrefix
            'waitForCondition'   => static::TYPE_ACTION,
            'waitForFrameToLoad' => static::TYPE_ACTION,
            'waitForPageToLoad'  => static::TYPE_ACTION,
            'waitForPopUp'       => static::TYPE_ACTION
        ];

        $prefix2type = [
            'store'   => static::TYPE_ACCESSOR,
            'get'     => static::TYPE_ACCESSOR,
            'is'      => static::TYPE_ACCESSOR,
            'assert'  => static::TYPE_ASSERTION,
            'verify'  => static::TYPE_ASSERTION,
            'waitFor' => static::TYPE_ASSERTION
        ];

        // determine by full name (exclusions)
        if (array_key_exists($methodFullName, $name2type)) {
            return $name2type[$methodFullName];
        }

        // determine by prefix
        foreach ($prefix2type as $prefix => $type) {
            if (Helper::hasPrefix($prefix, $methodFullName)) {
                return $type;
            }
        }

        return static::TYPE_ACTION; // by default commands without specified prefixes is Actions
    }

    /**
     * Determines {@link subtype} of method by name.
     *
     * @param string $methodFullName Name of method
     *
     * @return string Subtype of method (related command),
     *                possible values see {@link subtypesAll}
     */
    static function determineSubtypeByName($methodFullName)
    {
        $resultSubtype = null;
        switch (static::determineTypeByName($methodFullName)) {
            case self::TYPE_ACTION:
                $resultSubtype = Helper::hasPostfix('AndWait', $methodFullName)
                    ? static::SUBTYPE_AND_WAIT
                    : static::SUBTYPE_BASE;
                break;

            case self::TYPE_ACCESSOR:
                $prefix2subtype = [
                    'store' => static::SUBTYPE_STORE,
                    'get'   => static::SUBTYPE_GET,
                    'is'    => static::SUBTYPE_IS,
                ];
                foreach ($prefix2subtype as $prefix => $subtype) { // determine by prefix
                    if (Helper::hasPrefix($prefix, $methodFullName)) {
                        $resultSubtype = $subtype;
                    }
                }
                break;

            case self::TYPE_ASSERTION:
                $hasNot         = strpos($methodFullName, 'Not') !== false;
                $prefix2subtype = $hasNot
                    ? [
                        'assert'  => static::SUBTYPE_ASSERT_NOT,
                        'verify'  => static::SUBTYPE_VERIFY_NOT,
                        'waitFor' => static::SUBTYPE_WAIT_FOR_NOT
                    ]
                    : [
                        'assert'  => static::SUBTYPE_ASSERT,
                        'verify'  => static::SUBTYPE_VERIFY,
                        'waitFor' => static::SUBTYPE_WAIT_FOR
                    ];
                foreach ($prefix2subtype as $prefix => $subtype) { // determine by prefix
                    if (Helper::hasPrefix($prefix, $methodFullName)) {
                        $resultSubtype = $subtype;
                    }
                }
                break;
        }

        if (!$resultSubtype) {
            static::throwException('Cannot evaluate subtype for method: ' . $methodFullName);
        }

        return $resultSubtype; // by default commands without specified prefixes is Actions
    }

    /**
     * Sets specified argument list. Similar arguments keep old description + type.
     *
     * @param Argument[] $arguments New args
     *
     * @return $this
     */
    function setArgumentsAndKeepOldDescription(array $arguments)
    {
        // prepare new argument list
        $newArgumentList = [];
        foreach ($arguments as $arg) {
            $cloneArg       = $arg->createClone();
            $cloneArg->type = Argument::DEFAULT_TYPE;

            // copy old description
            if ($baseArg = $this->getArgumentByName($cloneArg->name)) {
                $cloneArg->type        = $baseArg->type;
                $cloneArg->description = $baseArg->description;
            }
            $newArgumentList[] = $cloneArg;
        }

        // set new argument list
        $this->deleteAllArguments();
        foreach ($newArgumentList as $newArg) {
            $this->addArgument($newArg);
        }

        return $this;
    }

    /**
     * Returns name of new method, which can be created from current through
     * {@link CodeGenerator::createNewMethodWithName}.
     *
     * @param string $newSubtype
     *
     * @return string               Name of new method
     */
    function makeNameForSubtype($newSubtype)
    {
        // ---- Source method has Accessor type
        switch ($this->subtype) {
            case Method::SUBTYPE_ASSERT:
            case Method::SUBTYPE_ASSERT_NOT:

                if (in_array($newSubtype, [Method::SUBTYPE_VERIFY, Method::SUBTYPE_VERIFY_NOT])) {
                    return 'verify' . Helper::cutPrefix('assert', $this->name);
                } else {
                    self::throwException("Incorrect subtype: some cases (may be) not handled.");
                }
                break;

            case Method::SUBTYPE_VERIFY:
            case Method::SUBTYPE_VERIFY_NOT:

                if (in_array($newSubtype, [Method::SUBTYPE_ASSERT, Method::SUBTYPE_ASSERT_NOT])) {
                    return 'assert' . Helper::cutPrefix('verify', $this->name);
                } else {
                    self::throwException("Incorrect subtype: some cases (may be) not handled.");
                }
                break;

            default:
                self::throwException("Incorrect subtype: some cases (may be) not handled.");
        }

        // todo implement and test other cases (other subtypes)
    }
}