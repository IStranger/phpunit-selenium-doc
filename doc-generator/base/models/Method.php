<?php
/**
 * This class contain full description of selenium method (target, arguments list, return value etc.)
 */

namespace phpdocSeleniumGenerator\models;

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

    const SUBTYPE_BASE         = 'action';
    const SUBTYPE_AND_WAIT     = 'actionAndWait';
    const SUBTYPE_STORE        = 'storeAccessor';
    const SUBTYPE_GET          = 'getAccessor';
    const SUBTYPE_IS           = 'isAccessor';
    const SUBTYPE_VERIFY       = 'verifyAssertion';
    const SUBTYPE_VERIFY_NOT   = 'verifyNotAssertion';
    const SUBTYPE_ASSERT       = 'assertAssertion';
    const SUBTYPE_ASSERT_NOT   = 'assertNotAssertion';
    const SUBTYPE_WAIT_FOR     = 'waitForAssertion';
    const SUBTYPE_WAIT_FOR_NOT = 'waitForNotAssertion';

    /**
     * @var array   Possible values of
     *              {@link subtype} (array keys) and labels (array values), indexed by {@link type}
     */
    static $subtypesAll = [

        self::TYPE_ACTION    => [
            self::SUBTYPE_BASE     => '',
            self::SUBTYPE_AND_WAIT => 'AndWait',
        ],

        self::TYPE_ACCESSOR  => [
            self::SUBTYPE_STORE => 'store',
            self::SUBTYPE_GET   => 'get',
            self::SUBTYPE_IS    => 'is',
        ],

        self::TYPE_ASSERTION => [
            self::SUBTYPE_VERIFY       => 'verify',
            self::SUBTYPE_VERIFY_NOT   => 'verifyNot',
            self::SUBTYPE_ASSERT       => 'assert',
            self::SUBTYPE_ASSERT_NOT   => 'assertNot',
            self::SUBTYPE_WAIT_FOR     => 'waitFor',
            self::SUBTYPE_WAIT_FOR_NOT => 'waitForNot',
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
     * @var Argument[] List of method arguments
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
                $name = str_replace('Not', '', $this->name);
                $baseName = Helper::cutPrefix(['assert', 'verify', 'waitFor'], $name);
                break;

            default:
                $this::throwException('Cannot determine base name without assigned type of method');
        }
        return $lowerCase ? strtolower($baseName) : $baseName;
    }

    /**
     * Load data about method from specified XML nodes.
     *
     *
     * Typical html code that described method:
     * <pre><code>
     *    <dt>
     *        <strong>
     *            <a name="addLocationStrategy"></a>
     *            addLocationStrategy(strategyName,functionDefinition)
     *        </strong>
     *    </dt>
     *
     *    <dd>Defines a new function for Selenium to locate elements on the page.
     *        For example, if you define the strategy "foo", and someone runs click("foo=blah"), we'll run your
     *        function, passing you the string "blah", and click on the element that your function returns, or throw an
     *        "Element not found" error if your function returns null.
     *
     *        We'll pass three arguments to your function:
     *        <ul>
     *            <li>locator: the string the user passed in</li>
     *            <li>inWindow: the currently selected window</li>
     *            <li>inDocument: the currently selected document</li>
     *        </ul>
     *        The function must return null if the element can't be found.
     *
     *        <p>Arguments:</p>
     *        <ul>
     *            <li>strategyName - the name of the strategy to define; this should use only letters [a-zA-Z] with no
     *            spaces or other punctuation.
     *            </li>
     *            <li>functionDefinition - a string defining the body of a function in JavaScript. For example:
     *            < code >return inDocument.getElementById(locator);< / code >
     *            </li>
     *        </ul>
     *    </dd>
     * </code></pre>
     *
     * @param \SimpleXMLElement $dt XML node, which contain determination
     * @param \SimpleXMLElement $dd XML node, which contain description
     *
     * @return $this
     */
    function loadFromXML(\SimpleXMLElement $dt, \SimpleXMLElement $dd)
    {
        // name
        $this->name = (string)$dt->xpath('descendant::a[@name]')[0]->attributes()['name'];

        // description (without arguments)
        $text = Helper::plainText($dd->asXML());
        preg_match('/<dd>\s*(?P<description>[\s\S]+)\s*(<p>Arguments:<\/p>)?[\s\S]*<\/dd>/', $text, $matches) &&
        array_key_exists('description', $matches)
        OR die('Error at parse method description: ' . $text);
        $this->description = $matches['description'];

        // arguments
        $xmlArguments = $dd->xpath("p[text()='Arguments:']/following-sibling::ul[1]/li");
        foreach ($xmlArguments as $xmlArgument) {
            $this->arguments[] = Argument::createNew()
                ->setMethod($this)
                ->loadFromXML($xmlArgument);
        }
        return $this;
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
     * Determines {@link subtype} of method by name
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
                $hasNot = strpos($methodFullName, 'Not') !== false;
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
}