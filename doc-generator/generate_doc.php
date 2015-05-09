<?php
/**
 * This script parse official documentation html page and generate phpdoc for methods of phpunit selenium driver.
 *
 * Directory "source-doc" should be contain actual version of html documentation.
 * Directory "base" should be contain actual version of PHPUnit_Extensions_SeleniumTestCase_Driver class (Driver.php)
 * (from https://github.com/giorgiosironi/phpunit-selenium/blob/master/PHPUnit/Extensions/SeleniumTestCase/Driver.php)
 *
 * @see https://php.net/manual/en/simplexml.examples-basic.php
 * @see http://www.w3schools.com/XPath/
 * @see http://release.seleniumhq.org/selenium-core/1.0.1/reference.html
 * @see https://phpunit.de/manual/current/en/phpunit-book.html#selenium.seleniumtestcase.tables.template-methods
 */

require_once 'base/class_loader.php';
use \phpdocSeleniumGenerator\Method;
use \phpdocSeleniumGenerator\phpunitSeleniumDriver;

// HTML documentation (local file can be changed to http://release.seleniumhq.org/selenium-core/1.0.1/reference.html)
define('SELENIUM_DOC_REFERENCE', 'source-doc/selenium-core-reference-1.0.1.html');


/**
 * Makes easy xml object from specified html page
 *
 * @param string $html
 *
 * @return SimpleXMLElement XML object with key nodes for easy parsing (see "actions" and "accessors" nodes)
 */
function html2xml($html)
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

// --------------------------------------
// Parsing of official documentation
$xmlPage = html2xml(file_get_contents(SELENIUM_DOC_REFERENCE));

// Parsing of Action methods
$methodsAction = [];
$xmlActionsDT = $xmlPage->xpath('//actions/descendant::a[@name]/ancestor::dt');
foreach ($xmlActionsDT as $xmlActionDT) {
    $xmlActionDD = $xmlActionDT->xpath('following-sibling::dd[1]')[0];
    $method = Method::modelNew()->loadFromXML($xmlActionDT, $xmlActionDD);
    $method->type = Method::TYPE_ACTION;
    $methodsAction[$method->getBaseName()] = $method->name;
}

// Parsing of Accessor methods
$methodsAccessor = [];
$xmlActionsDT = $xmlPage->xpath('//accessors/descendant::a[@name]/ancestor::dt');
foreach ($xmlActionsDT as $xmlActionDT) {
    $xmlActionDD = $xmlActionDT->xpath('following-sibling::dd[1]')[0];
    $method = Method::modelNew()->loadFromXML($xmlActionDT, $xmlActionDD);

    // we exclude assert* methods from accessor list
    if (!in_array($method->name, ['assertErrorOnNext', 'assertFailureOnNext', 'assertSelected'])) {
        $method->type = Method::TYPE_ACCESSOR;
        $methodsAccessor[$method->getBaseName()] = $method->name;
    }
}

//var_export($methodsAction);
//var_export($methodsAccessor);


// --------------------------------------
// Getting available selenium commands (methods of phpunit-selenium-driver)

$driver = new phpunitSeleniumDriver();
var_export($driver->getAvailableSeleniumCommands());



