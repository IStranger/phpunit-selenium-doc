<?php
/**
 * Script include all core classes for phpdoc generator code
 */
namespace phpdocSeleniumGenerator;


require_once 'Helper.php';
require_once 'CommonTrait.php';
require_once 'models/Base.php';
require_once 'models/MethodComponent.php';
require_once 'models/Argument.php';
require_once 'models/ReturnValue.php';
require_once 'models/Method.php';
require_once 'Parser.php';
require_once 'code_generator/CodeGenerator.php';

require_once 'Driver.php'; // phpunit-selenium driver (from https://github.com/giorgiosironi/phpunit-selenium)
require_once 'phpunitSeleniumDriver.php';