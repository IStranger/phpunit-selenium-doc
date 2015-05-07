<?php
/**
 * This script parse official documentation html page and generate phpdoc for selenium methods
 *
 * @see https://php.net/manual/en/simplexml.examples-basic.php
 * @see http://www.w3schools.com/XPath/
 * @see http://release.seleniumhq.org/selenium-core/1.0.1/reference.html
 */

require_once 'base/class_loader.php';
use \phpdocSeleniumGenerator\Method;

// HTML documentation (local file can be changed to http://release.seleniumhq.org/selenium-core/1.0.1/reference.html)
define('SELENIUM_DOC_REFERENCE', 'selenium-core-reference-1.0.1.html');


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

    //  Make XML (for easy parsing)
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

$xmlPage = html2xml(file_get_contents(SELENIUM_DOC_REFERENCE));

// Action methods
$methods = [];
$xmlActionsDT = $xmlPage->xpath('//actions/descendant::a[@name]/ancestor::dt');
foreach ($xmlActionsDT as $xmlActionDT) {
    $xmlActionDD = $xmlActionDT->xpath('following-sibling::dd[1]')[0];
    $methods[] = Method::modelNew()->loadFromXML($xmlActionDT, $xmlActionDD);
}

var_export($methods);