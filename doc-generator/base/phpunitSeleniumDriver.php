<?php
/**
 * This class extended from {@link PHPUnit_Extensions_SeleniumTestCase_Driver} for easy export of available selenium
 * commands
 * (see {@link phpunitSeleniumDriver::getAvailableSeleniumCommands})
 */

namespace phpdocSeleniumGenerator;


class phpunitSeleniumDriver extends \PHPUnit_Extensions_SeleniumTestCase_Driver
{
    /**
     * @var array Methods, that handled in PHPUnit_Extensions_SeleniumTestCase_Driver::__call,
     *            but not presented in DocBlock of this method.
     *            Format: ['methodName' => 'returnType']
     */
    protected $manualAddedMethods = [
        'captureEntirePageScreenshotToString' => 'void',  // in DocBlock only *AndWait version
        'captureScreenshot'                   => 'void',  // in DocBlock only *AndWait version
        'captureScreenshotToString'           => 'void',  // in DocBlock only *AndWait version
        'waitForFrameToLoad'                  => 'void',  // in DocBlock not presented
    ];

    /**
     * Returns array of virtual methods (available selenium commands)
     *
     * @return array Array of methods in format: ['methodName' => 'returnType']
     * @throws \Exception
     */
    public function getAvailableSeleniumCommands()
    {
        return $this->_getBaseMethods() + $this->_getAutoGeneratedMethods() + $this->manualAddedMethods;
    }

    /**
     * Parses list of methods from DocBlock of method PHPUnit_Extensions_SeleniumTestCase_Driver::__call
     *
     * @return array Array of methods in format: ['methodName' => 'returnType']
     * @throws \Exception
     */
    private function _getBaseMethods()
    {
        $method = new \ReflectionMethod(__CLASS__, '__call');
        $docComment = $method->getDocComment();

        $methods = [];
        if (preg_match_all('(@method\s+(\w+)\s+([\w]+)\((.*)\))', $docComment, $matches)) {
            foreach ($matches[2] as $methodKey => $method) {
                $methods[$method] = $this->_returnTypeConvert($matches[1][$methodKey]);
            }
        } else {
            throw new \Exception('Error at parsing of virtual methods of PHPUnit_Extensions_SeleniumTestCase_Driver::__call');
        }
        return $methods;
    }

    /**
     * Gets list of automatically generated methods (assert*, verify*, waitFor*, store*)
     *
     * @return array Array of methods in format: ['methodName' => 'returnType']
     */
    private function _getAutoGeneratedMethods()
    {
        $methods = [];
        foreach (static::$autoGeneratedCommands as $commandName => $dummy) {
            $methods[$commandName] = 'void';    // because only Action type commands
        }
        return $methods;
    }

    /**
     * Converts "phpunit" returnType (that used in DocBlock of class) to correct phpDoc variable type
     *
     * @param string $phpunitReturnType
     *
     * @return string
     * @see http://phpdoc.org/docs/latest/references/phpdoc/types.html
     */
    private function _returnTypeConvert($phpunitReturnType)
    {
        switch ($phpunitReturnType) {
            case 'unknown':
                return 'void';
            case 'boolean':
                return 'bool';      // short version
            case 'integer':
                return 'int';       // actually is a string that contains an integer
            case 'array':
                return 'string[]';
            default:
                return $phpunitReturnType;
        }
    }

    // show duplicate methods: waitForElementPresent and waitForElementNotPresent:
    // var_dump(array_intersect_key($this->_getBaseMethods(), $this->_getAutoGeneratedMethods()));
}