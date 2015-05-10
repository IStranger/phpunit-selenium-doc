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
            $method = Method::createNew()->loadFromXML($xmlDT, $xmlDD);

            if (!in_array($method->name, $this->exclusionCommands)) {
                $method->type = $methodType;
                $method->subtype = $method::determineSubtypeByName($method->name);
                $methods[$method->getBaseName(true)] = $method;
            }
        }
        return $methods;
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