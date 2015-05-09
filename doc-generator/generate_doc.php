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
use \phpdocSeleniumGenerator\models;
use \phpdocSeleniumGenerator\phpunitSeleniumDriver;
use \phpdocSeleniumGenerator\Parser;


// HTML documentation (local file can be changed to http://release.seleniumhq.org/selenium-core/1.0.1/reference.html)
define('SELENIUM_DOC_REFERENCE', 'source-doc/selenium-core-reference-1.0.1.html');


// Parsing of official documentation
$parser = new Parser(file_get_contents(SELENIUM_DOC_REFERENCE));


// Search description for available selenium commands (methods of phpunit-selenium-driver)
$driver = new phpunitSeleniumDriver();
$methods = [];
foreach ($driver->getAvailableSeleniumCommands() as $methodFullName => $returnType) {
    // Create model of available method
    $method = models\Method::createNew();
    $method->name = $methodFullName;
    $method->type = models\Method::determineTypeByName($methodFullName);
    $method->returnValue = models\ReturnValue::createNew();
    $method->returnValue->type = $returnType;

    // Search of description in parsed docs
    if ($findMethod = $parser->getMethodByBaseName($method->getBaseName(true))) {
        // todo implement
    }else{
        $notFounded[$method->getBaseName()][] = $method->name; // todo debug
    }

    $methods[] = $method;
}

// var_export($methods);

//var_export(array_keys($notFounded));
//var_export($notFounded);