# phpunit-selenium-doc
This class provides extended documentation (phpDoc) for phpunit-selenium methods.
Class used for easy development of tests in IDE (like phpStorm or NetBeans).

# Installation
Class SeleniumTestCaseDoc is [trait](http://php.net/manual/en/language.oop5.traits.php), which can be mixed to any class (extended from PHPUnit_Extensions_SeleniumTestCase). 
This class overrides documentation of PHPUnit_Extensions_SeleniumTestCase methods (according official description of selenium commands). 
The implementation of there overridden methods is unchanged.

# Resources

+ Original phpunit class with minimal documentation: [SeleniumTestCase.php](https://github.com/giorgiosironi/phpunit-selenium/blob/master/PHPUnit/Extensions/SeleniumTestCase.php)
+ Description of [selenium core commands](http://release.seleniumhq.org/selenium-core/1.0.1/reference.html)