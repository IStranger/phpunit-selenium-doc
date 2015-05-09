<?php
/**
 * Script include all core classes for phpdoc generator code
 */
namespace phpdocSeleniumGenerator;

require_once 'Helper.php';
require_once 'Base.php';
require_once 'Argument.php';
require_once 'Method.php';
require_once 'Parser.php';

require_once 'Driver.php'; // phpunit-selenium driver (from https://github.com/giorgiosironi/phpunit-selenium)
require_once 'phpunitSeleniumDriver.php';