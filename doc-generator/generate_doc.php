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
use \phpdocSeleniumGenerator\Helper;
use \phpdocSeleniumGenerator\code_generator\CodeGenerator;

/**
 * @var models\Method[] $manualMethodsDescription Array of models, indexed by method name
 */

// HTML documentation (local file can be changed to http://release.seleniumhq.org/selenium-core/1.0.1/reference.html)
define('SELENIUM_DOC_REFERENCE', 'source-doc/selenium-core-reference-1.0.1.html');

// Load manual description of some methods
$manualMethodsDescription = require_once('source-doc/manual_methods_description.php');

// Parsing of official documentation
$parser = new Parser(file_get_contents(SELENIUM_DOC_REFERENCE));


// Search description for available selenium commands (methods of phpunit-selenium-driver)
$driver     = new phpunitSeleniumDriver();
$methods    = [];
$notFounded = [];

foreach ($driver->getAvailableSeleniumCommands() as $methodFullName => $returnType) {
    // Create model of available method
    $method                    = models\Method::createNew();
    $method->name              = $methodFullName;
    $method->type              = models\Method::determineTypeByName($methodFullName);
    $method->subtype           = models\Method::determineSubtypeByName($methodFullName);
    $method->returnValue       = models\ReturnValue::createNew();
    $method->returnValue->type = $returnType;

    // Search of description in manual/parsed docs
    if (array_key_exists($methodFullName, $manualMethodsDescription)) {
        $methods[] = $manualMethodsDescription[$methodFullName];
    } elseif ($foundMethod = $parser->getMethodByBaseName($method->getBaseName(true))) {
        $documentedMethod                    = $foundMethod->createNewMethodWithName($method->name); // convert to target method
        $documentedMethod->returnValue->type = $returnType;  // selenium documentation has no info about php variable type

        $methods[] = $documentedMethod;
    } else {
        $notFounded[$method->getBaseName()][] = $method->name;
        /*
         * // todo for this commands need manual description
        array (
          0 => 'CssCount',
          1 => 'LogMessages',
          2 => 'attachFile',
          3 => 'captureEntirePageScreenshotToString',
          4 => 'captureScreenshot',
          5 => 'captureScreenshotToString',
          6 => 'keyDownNative',
          7 => 'keyPressNative',
          8 => 'keyUpNative',
          9 => 'retrieveLastRemoteControlLogs',
          10 => 'setContext',
          11 => 'shutDownSeleniumServer',
        )
        array (
          'CssCount' =>
          array (
            0 => 'assertCssCount',
            1 => 'assertNotCssCount',
            2 => 'getCssCount',
            3 => 'storeCssCount',
            4 => 'verifyCssCount',
            5 => 'verifyNotCssCount',
            6 => 'waitForCssCount',
            7 => 'waitForNotCssCount',
          ),
          'LogMessages' =>
          array (
            0 => 'assertLogMessages',
            1 => 'assertNotLogMessages',
            2 => 'getLogMessages',
            3 => 'storeLogMessages',
            4 => 'verifyLogMessages',
            5 => 'verifyNotLogMessages',
            6 => 'waitForLogMessages',
            7 => 'waitForNotLogMessages',
          ),
          'attachFile' =>
          array (
            0 => 'attachFile',
          ),
          'captureEntirePageScreenshotToString' =>
          array (
            0 => 'captureEntirePageScreenshotToString',
            1 => 'captureEntirePageScreenshotToStringAndWait',
          ),
          'captureScreenshot' =>
          array (
            0 => 'captureScreenshot',
            1 => 'captureScreenshotAndWait',
          ),
          'captureScreenshotToString' =>
          array (
            0 => 'captureScreenshotToString',
            1 => 'captureScreenshotToStringAndWait',
          ),
          'keyDownNative' =>
          array (
            0 => 'keyDownNative',
            1 => 'keyDownNativeAndWait',
          ),
          'keyPressNative' =>
          array (
            0 => 'keyPressNative',
            1 => 'keyPressNativeAndWait',
          ),
          'keyUpNative' =>
          array (
            0 => 'keyUpNative',
            1 => 'keyUpNativeAndWait',
          ),
          'retrieveLastRemoteControlLogs' =>
          array (
            0 => 'retrieveLastRemoteControlLogs',
          ),
          'setContext' =>
          array (
            0 => 'setContext',
          ),
          'shutDownSeleniumServer' =>
          array (
            0 => 'shutDownSeleniumServer',
          ),
        )
        */
    }
}

$generator = new CodeGenerator();
if (!file_put_contents('SeleniumTestCaseDoc.generated.php', $generator->generate($methods))) {
    throw new Exception('Error at file write');
}


// var_export($methods);
// var_export($driver->getAvailableSeleniumCommands());
// var_export(array_keys($notFounded)); // todo debug
if (!empty($notFounded)) {
    echo 'Not found description for methods:' . Helper::EOL;
    var_export($notFounded);
}