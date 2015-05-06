# phpunit-selenium-doc
This class provides extended documentation (phpDoc) for phpunit-selenium methods.
Class used for easy development of tests in IDE (like phpStorm or NetBeans).

SeleniumTestCaseDoc overrides documentation of PHPUnit_Extensions_SeleniumTestCase methods 
(according official description of selenium commands). 
The implementation of there overridden methods is unchanged.

# Installation (via composer)

Class SeleniumTestCaseDoc is [trait](http://php.net/manual/en/language.oop5.traits.php), which can be mixed to any class 
(extended from PHPUnit_Extensions_SeleniumTestCase).

+ **Manual installation:** extract files under vendor directory and add this class to your autoloader (or include manually).
+ **Installation via composer:** add to your composer.json file ("require" section) the following line  <code>"istranger/yii-resource-smart-load": "dev-master"</code>
  (see <a href="https://packagist.org/packages/istranger/phpunit-selenium-doc">packagist page</a>)
+ Add to your web test class SeleniumTestCaseDoc as trait:
```php
class WebTestCase extends CWebTestCase // CWebTestCase extends PHPUnit_Extensions_SeleniumTestCase
{
    use SeleniumTestCaseDoc; // use extended documentation for selenium methods
    ...
```

# Resources

+ Original phpunit class with minimal documentation: [SeleniumTestCase.php](https://github.com/giorgiosironi/phpunit-selenium/blob/master/PHPUnit/Extensions/SeleniumTestCase.php#L46)
+ Description of [selenium core commands](http://release.seleniumhq.org/selenium-core/1.0.1/reference.html)