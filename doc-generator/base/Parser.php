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
     * @var Method[]
     */
    private $_actionMethods;
    /**
     * @var Method[]
     */
    private $_accessorMethods;

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
    }

    function getActionMethods()
    {
        if ($this->_actionMethods === null) {
            $this->_actionMethods = $this->_parseActions();
        }
        return $this->_actionMethods;
    }

    function getAccessorMethods()
    {
        if ($this->_accessorMethods === null) {
            $this->_accessorMethods = $this->_parseAccessors();
        }
        return $this->_accessorMethods;
    }

    /**
     * Parsing of Action methods (commands) from documentation
     * @return Method[]
     */
    private function _parseActions()
    {
        $methods = [];
        $xmlActionsDT = $this->_xmlPage->xpath('//actions/descendant::a[@name]/ancestor::dt');
        foreach ($xmlActionsDT as $xmlActionDT) {
            $xmlActionDD = $xmlActionDT->xpath('following-sibling::dd[1]')[0];
            $method = Method::createNew()->loadFromXML($xmlActionDT, $xmlActionDD);

            if (!in_array($method->name, $this->exclusionCommands)) {
                $method->type = Method::TYPE_ACTION;
                $methods[$method->getBaseName()] = $method;
            }
        }
        return $methods;
    }

    /**
     * Parsing of Accessor methods (commands) from documentation
     * @return Method[]
     */
    private function _parseAccessors()
    {
        $methods = [];
        $xmlActionsDT = $this->_xmlPage->xpath('//accessors/descendant::a[@name]/ancestor::dt');
        foreach ($xmlActionsDT as $xmlActionDT) {
            $xmlActionDD = $xmlActionDT->xpath('following-sibling::dd[1]')[0];
            $method = Method::createNew()->loadFromXML($xmlActionDT, $xmlActionDD);

            if (!in_array($method->name, $this->exclusionCommands)) {
                $method->type = Method::TYPE_ACCESSOR;
                $methods[$method->getBaseName()] = $method;
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
        $xmlStr = <<<XML
<?xml version='1.0' standalone='yes'?>
<doc>
    <actions>
        $htmlActions
    </actions>
    <accessors>
        $htmlAccessors
    </accessors>
</doc>
XML;
        $xmlStr = str_replace('<br>', '', $xmlStr); // delete incorrect xml tags

        return simplexml_load_string($xmlStr);
    }

}