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
 * @var models\Method[]|array $manualMethodsDescription Array of models, indexed by method name
 * @var models\Method[]|array $methodsByBaseName        Array of models, indexed by method name
 * @var models\Method[]       $methodsGroup
 */

// HTML documentation (local file can be changed to http://release.seleniumhq.org/selenium-core/1.0.1/reference.html)
define('SELENIUM_DOC_REFERENCE', 'source-doc/selenium-core-reference-1.0.1.html');

// Load manual description of some methods
$manualMethodsDescription = require_once('source-doc/manual_methods_description.php');

// Parsing of official documentation
$parser = new Parser(file_get_contents(SELENIUM_DOC_REFERENCE));


// Search description for available selenium commands (methods of phpunit-selenium-driver)
$driver            = new phpunitSeleniumDriver();
$generator         = new CodeGenerator();
$seleniumCommands  = $driver->getAvailableSeleniumCommands();
$methodsByBaseName = [];
$notFounded        = [];

foreach ($seleniumCommands as $methodFullName => $returnType) {
    // Create model of available method
    $method                    = models\Method::createNew();
    $method->name              = $methodFullName;
    $method->type              = models\Method::determineTypeByName($methodFullName);
    $method->subtype           = models\Method::determineSubtypeByName($methodFullName);
    $method->returnValue       = models\ReturnValue::createNew();
    $method->returnValue->type = $returnType;

    // Search of description in manual/parsed docs
    $documentedMethod = null;
    if (array_key_exists($methodFullName, $manualMethodsDescription)) {
        $documentedMethod = $manualMethodsDescription[$methodFullName];
    } elseif ($foundMethod = $parser->getMethodByBaseName($method->getBaseName(true))) {
        $documentedMethod                    = $generator->createNewMethodWithName($foundMethod, $method->name); // convert to target method
        $documentedMethod->returnValue->type = $returnType;  // selenium documentation has no info about php variable type
    }

    if ($documentedMethod) {
        $methodsByBaseName[$method->getBaseName()][] = $documentedMethod;
    } else {
        $notFounded[$method->getBaseName()][] = $method->name;
    }
}

// Add "see also" cross links (between methods of same group)
foreach ($methodsByBaseName as $methodBaseName => $methodsGroup) {
    $seeLinks = [];
    foreach ($methodsGroup as $method) {
        $linkDescription = '';
        switch ($method->type) {
            case models\Method::TYPE_ACTION:
                $linkDescription = 'Related Action';
                break;
            case models\Method::TYPE_ACCESSOR:
                $linkDescription = 'Related Accessor';
                break;
            case models\Method::TYPE_ASSERTION:
                $linkDescription = 'Related Assertion';
                break;
        }
        $seeLinks[$method->name] = $linkDescription;
    }

    foreach ($methodsGroup as $method) {
        $method->seeLinks += $seeLinks;
        $method->seeLinks = Helper::filterByKeys($method->seeLinks, null, [$method->name]); // delete link to self
    }
}

// Make plain array of methods
$methods = [];
foreach ($methodsByBaseName as $methodBaseName => $methodsGroup) {
    foreach ($methodsGroup as $method) {
        $methods[] = $method;
    }
}

// Output
if (!file_put_contents('SeleniumTestCaseDoc.generated.php', $generator->generate($methods))) {
    throw new Exception('Error at file write');
}

if (!empty($notFounded)) {
    echo 'Not found description for methods:' . Helper::EOL;
    var_export($notFounded);
}