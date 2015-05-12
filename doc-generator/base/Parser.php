<?php
/**
 * Parser of html documentation (Selenium RC commands)
 *
 * @see http://release.seleniumhq.org/selenium-core/1.0.1/reference.html
 * @see https://phpunit.de/manual/current/en/phpunit-book.html#selenium.seleniumtestcase.tables.template-methods
 *
 * @see https://php.net/manual/en/simplexml.examples-basic.php
 * @see http://www.w3schools.com/XPath/
 */

namespace phpdocSeleniumGenerator;

use phpdocSeleniumGenerator\models\Method;
use phpdocSeleniumGenerator\models\Argument;
use phpdocSeleniumGenerator\models\ReturnValue;


class Parser
{
    /**
     * @var \SimpleXMLElement   XML object, which contain official documentation
     */
    private $_xmlPage;
    /**
     * @var Method[] "Cache" for parsed methods
     */
    private $_parsedMethods;

    /**
     * Selenium commands, which ignored at parsing
     *
     * @var string[]
     */
    public $exclusionCommands = [
        'assertErrorOnNext',    // we exclude assert* methods (from Accessors)
        'assertFailureOnNext',
        'assertSelected'
    ];

    /**
     * @param string $html Html, which should be parsed
     */
    function __construct($html)
    {
        $this->_xmlPage = $this->_html2xml($html);
        $this->_runParsing();
    }

    /**
     * Returns parsed methods (if necessary runs parsing)
     *
     * @return Method[]     Array of methods, indexed by basename (lower case)
     * @throws \Exception
     */
    function getParsedMethods()
    {
        if ($this->_parsedMethods === null) {
            $this->_runParsing();
        }
        return $this->_parsedMethods;
    }

    /**
     * Returns parsed method by basename
     *
     * @param string $methodBaseName basename of method (case insensitive)
     *
     * @return Method|null  Found model of method. If not found, returns =null.
     */
    function getMethodByBaseName($methodBaseName)
    {
        return Helper::value($this->getParsedMethods(), strtolower($methodBaseName));
    }

    /**
     * Runs parsing of methods and save result to "local cache"
     *
     * @throws \Exception   If duplicate base names of methods
     * @see _parsedMethods
     */
    private function _runParsing()
    {
        $actions = $this->_parseByMethodType(Method::TYPE_ACTION);
        $accessors = $this->_parseByMethodType(Method::TYPE_ACCESSOR);
        $duplicateNames = array_intersect_key($actions, $accessors);

        if (empty($duplicateNames)) {
            $this->_parsedMethods = $actions + $accessors;
        } else {
            throw new \Exception('Duplicate base names for parsed methods: ' . join(',', $duplicateNames));
        }
    }

    /**
     * Parsing of methods (commands) from documentation
     *
     * @param string $methodType Type of method,
     *                           see {@link Method::type}
     *
     * @return Method[]
     */
    private function _parseByMethodType($methodType)
    {
        $methods = [];
        $xmlDtNodes = $this->_xmlPage->xpath('//' . $methodType . '/descendant::a[@name]/ancestor::dt');
        foreach ($xmlDtNodes as $xmlDT) {
            $xmlDD = $xmlDT->xpath('following-sibling::dd[1]')[0];
            $method = $this->_createMethodFromXML($xmlDT, $xmlDD);

            if (!in_array($method->name, $this->exclusionCommands)) {
                $method->type = $methodType;
                $method->subtype = $method::determineSubtypeByName($method->name);
                $methods[$method->getBaseName(true)] = $method;
            }
        }
        return $methods;
    }

    /**
     * Creates method and load data from specified XML nodes.
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
     * @return Method
     */
    private function _createMethodFromXML(\SimpleXMLElement $dt, \SimpleXMLElement $dd)
    {
        $method = Method::createNew();

        // name
        $method->name = (string)$dt->xpath('descendant::a[@name]')[0]->attributes()['name'];

        // description (without arguments, returnValue, and related commands)
        $text = $dd->asXML();
        if (Helper::contain('Arguments:', $text)) {
            $assertion = '<p>[\s]*Arguments:';
        } elseif (Helper::contain('Returns:', $text)) {
            $assertion = '<p>\s*<dl>';
        } elseif (Helper::contain('Related Assertions, automatically generated:', $text)) {
            $assertion = '<p>Related Assertions,';
        } else {
            $assertion = null;
        }
        $regExp = $assertion
            ? '/<dd>\s*(?P<description>[\s\S]+)(?=' . $assertion . ')/'
            : '/<dd>\s*(?P<description>[\s\S]+)\s*<\/dd>/';
        preg_match($regExp, $text, $matches) &&
        array_key_exists('description', $matches)
        OR die('Error at parse method description: ' . $text);
        $method->description = $matches['description'];

        // arguments
        $xmlArguments = $dd->xpath("p[text()='Arguments:']/following-sibling::ul[1]/li");
        foreach ($xmlArguments as $xmlArgument) {
            $argument = $this->_createArgumentFromXML($xmlArgument)
                ->setMethod($method);
            $method->addArgument($argument);
        }

        // todo add parsing of statements "Returns:" and "Related Assertions, automatically generated:"
        $method->returnValue = ReturnValue::createNew();
        $method->returnValue->description = 'default description';

        return $method;
    }

    /**
     * Creates argument and load data from specified XML node.
     *
     * Typical html code that described argument of method:
     * <pre><code>
     *      <li>strategyName - the name of the strategy to define; this should use only letters [a-zA-Z] with no
     *      spaces or other punctuation.
     *      </li>
     *
     *      // OR
     *
     *      <li>functionDefinition - a string defining the body of a function in JavaScript. For example:
     *      < code >return inDocument.getElementById(locator);< / code >
     *      </li>
     * </code></pre>
     *
     * @param \SimpleXMLElement $li XML node, which contain list item with detail description of argument
     *
     * @return Argument
     */
    private function _createArgumentFromXML(\SimpleXMLElement $li)
    {
        $argument = Argument::createNew();

        $text = $li->asXML();
        preg_match('/<li>\s*(?P<name>[a-zA-Z0-9]+)\s*-\s*(?P<description>[\s\S]+)\s*<\/li>/', $text, $matches) &&
        array_key_exists('name', $matches) &&
        array_key_exists('description', $matches)
        OR die('Error at parse argument description: ' . $text);

        $argument->name = $matches['name'];
        $argument->description = $matches['description'];
        $argument->type = 'string'; // by default we assume string variable type
        // todo need more accurate algorithm type determination (for example, by prefix of argument name ...)

        return $argument;
    }

    /**
     * Makes easy xml object from specified html page
     *
     * @param string $html
     *
     * @return \SimpleXMLElement XML object with key nodes for easy parsing (see "actions" and "accessors" nodes)
     */
    private function _html2xml($html)
    {
        // Selenium Actions
        preg_match('/<h2>Selenium Actions<\/h2>\s*(<dl>[\s\S]+<\/dl>)\s*<a name="accessors"><\/a>/', $html, $matches);
        $htmlActions = $matches[1];


        // Selenium Actions
        preg_match('/<h2>Selenium Accessors<\/h2>\s*(<dl>[\s\S]+<\/dl>)\s*<h2>/', $html, $matches);
        $htmlAccessors = $matches[1];

        // Make XML (for easy parsing)
        $actionsNodeName = Method::TYPE_ACTION;
        $accessorsNodeName = Method::TYPE_ACCESSOR;
        $xmlStr = <<<XML
<?xml version='1.0' standalone='yes'?>
<doc>
    <$actionsNodeName>
        $htmlActions
    </$actionsNodeName>
    <$accessorsNodeName>
        $htmlAccessors
    </$accessorsNodeName>
</doc>
XML;
        $xmlStr = str_replace('<br>', '', $xmlStr); // delete incorrect xml tags

        return simplexml_load_string($xmlStr);
    }

}