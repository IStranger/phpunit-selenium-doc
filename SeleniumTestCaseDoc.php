<?php

/**
 * Class SeleniumTestCaseDoc
 *
 * This class provides extended documentation (phpDoc) for phpunit-selenium methods
 * (override documentation of methods {@link PHPUnit_Extensions_SeleniumTestCase}).
 * Class used for easy development of tests in IDE (like phpStorm or NetBeans).
 *
 *
 *
 * Element Locators (delete space after "@" symbol below)
 * =======================================================
 *
 * Element Locators tell Selenium which HTML element a command refers to. The format of a locator is:
 * <b> locatorType=argument </b>
 *
 * We support the following strategies for locating elements (and locator types):
 *      + <b>identifier=id </b><br/>
 *          Select the element with the specified @ id attribute. If no match is found, select the first element whose
 *          @ name attribute is id. This is normally the default; see below.
 *      + <b>id=id</b><br/>
 *          Select the element with the specified @ id attribute.
 *      + <b>name=name </b><br/>
 *          Select the first element with the specified @ name attribute. <br/>
 *          -- username <br/>
 *          -- name=username  <br/>
 *          -- name=flavour value=chocolate <br/>
 *              The name may optionally be followed by one or more element-filters, separated from the name by
 *              whitespace. If the filterType is not specified, value is assumed. (see "Element Filters" below)
 *      + <b>dom=javascriptExpression </b><br/>
 *          Find an element by evaluating the specified string. This allows you to traverse the HTML Document Object
 *          Model using JavaScript. Note that you must not return a value in this string; simply make it the last
 *          expression in the block.  <br/>
 *          -- dom=document.forms['myForm'].myDropdown  <br/>
 *          -- dom=document.images[56] <br/>
 *          -- dom=function foo() { return document.links[1]; }; foo(); <br/>
 *      + <b>xpath=xpathExpression </b><br/>
 *          Locate an element using an XPath expression. <br/>
 *          -- xpath=//img[@ alt='The image alt text'] <br/>
 *          -- xpath=//table[@ id='table1']//tr[4]/td[2] <br/>
 *          -- xpath=//a[contains(@ href,'#id1')] <br/>
 *          -- xpath=//a[contains(@ href,'#id1')]/@ class <br/>
 *          -- xpath=(//table[@ class='stylee'])//th[text()='theHeaderText']/../td <br/>
 *          -- xpath=//input[@ name='name2' and @ value='yes'] <br/>
 *          -- xpath=//*[text()="right"] <br/>
 *      + <b>link=textPattern </b><br/>
 *          Select the link (anchor) element which contains text matching the specified pattern. <br/>
 *           -- link=The link text <br/>
 *      + <b>css=cssSelectorSyntax </b><br/>
 *          Select the element using css selectors. Please refer to CSS2 selectors, CSS3 selectors for more
 *          information. You can also check the TestCssLocators test in the selenium test suite for an example of
 *          usage, which is included in the downloaded selenium core package. <br/>
 *           -- css=a[href="#id3"] <br/>
 *           -- css=span#firstChild + span <br/>
 *              Currently the css selector locator supports all css1, css2 and css3 selectors except namespace in css3,
 *              some pseudo classes(:nth-of-type, :nth-last-of-type, :first-of-type, :last-of-type, :only-of-type,
 *              :visited, :hover, :active, :focus, :indeterminate) and pseudo elements(::first-line, ::first-letter,
 *              ::selection, ::before, ::after). <br/>
 *      + <b>ui=uiSpecifierString </b><br/>
 *          Locate an element by resolving the UI specifier string to another locator, and evaluating it. See the
 *          Selenium UI-Element Reference for more details. <br/>
 *           -- ui=loginPages::loginButton() <br/>
 *           -- ui=settingsPages::toggle(label=Hide Email) <br/>
 *           -- ui=forumPages::postBody(index=2)//a[2] <br/> <br/>
 *
 *  Without an explicit locator prefix, Selenium uses the following <b>default</b> strategies:
 *      + <b>dom</b>, for locators starting with "document." <br/>
 *      + <b>xpath</b>, for locators starting with "//" <br/>
 *      + <b>identifier</b>, otherwise <br/>
 *
 *
 *
 * Element Filters
 * =========================
 * Element filters can be used with a locator to refine a list of candidate elements. They are currently used only in
 * the 'name' element-locator. <br/> Filters look much like locators, ie. <b>filterType=argument</b>
 *
 * Supported element-filters are: <br/>
 * + <b>value=valuePattern </b><br/>
 *      Matches elements based on their values. This is particularly useful for refining a list of similarly-named
 *      toggle-buttons. <br/>
 * + <b>index=index </b><br/>
 *      Selects a single element based on its position in the list (offset from zero). <br/>
 *
 *
 *
 * String-match Patterns
 * =========================
 * Various Pattern syntaxes are available for matching string values:
 *      + <b>glob:pattern </b><br/>
 *              Match a string against a "glob" (aka "wildmat") pattern. "Glob" is a kind of limited regular-expression
 *              syntax typically used in command-line shells. In a glob pattern, "*" represents any sequence of
 *              characters, and "?" represents any single character. Glob patterns match against the entire string.
 *              <br/>
 *      + <b>regexp:regexp </b><br/>
 *              Match a string using a regular-expression. The full power of JavaScript regular-expressions is
 *              available. <br/>
 *      + <b>regexpi:regexpi </b><br/>
 *              Match a string using a case-insensitive regular-expression. <br/>
 *      + <b>exact:string </b><br/>
 *              Match a string exactly, verbatim, without any of that fancy wildcard stuff. <br/>
 *
 *
 *
 *
 * @see     http://release.seleniumhq.org/selenium-core/1.0.1/reference.html
 *
 *
 *
 * @author  G.Azamat <m@fx4web.com>
 * @link    http://fx4.ru/
 * @link    https://github.com/IStranger/phpunit-selenium-doc
 */
trait SeleniumTestCaseDoc
{
    /**
     * Opens an URL in the test frame. This accepts both relative and absolute URLs. The "open" command waits for the
     * page to load before proceeding, ie. the "AndWait" suffix is implicit.
     * Note: The URL must be on the same domain as the runner HTML due to security restrictions in the browser
     * (Same Origin Policy). If you need to open an URL on another domain, use the Selenium Server to start a
     * new browser session on that domain.
     *
     * @param string $url   the URL to open;
     *                      may be relative or absolute
     * @return void
     */
    public function open($url)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }

    /**
     * Sets the value of an input field, as though you typed it in. Can also be used to set the value of combo boxes,
     * check boxes, etc. In these cases, value should be the value of the option selected, not the visible text.
     *
     * @param string           $locator  an element locator
     *                                   (see "Element Locators" in {@link SeleniumTestCaseDoc} )
     * @param string|int|float $value    the value to type
     * @return void
     * @see typeAndWait
     */
    public function type($locator, $value)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }

    /**
     * Select an option from a drop-down using an option locator. <br/>
     *
     * Option locators provide different ways of specifying options of an HTML Select element
     * (e.g. for selecting a specific option, or for asserting that the selected option satisfies a specification).
     * There are several forms of Select Option Locator.
     *
     * + <b>label=labelPattern</b> (label=regexp:^[Oo]ther) <br/>
     *      matches options based on their labels, i.e. the visible text. (This is the default.) <br/>
     * + <b>value=valuePattern</b> (value=other) <br/>
     *      matches options based on their values. <br/>
     * + <b>id=id</b> (id=option1) <br/>
     *      matches options based on their ids. <br/>
     * + <b>index=index</b> (index=2) <br/>
     *      matches an option based on its index (offset from zero). <br/>
     *
     * If no option locator prefix is provided, the default behaviour is to match on label.
     *
     * @param string $selectLocator   an element locator identifying a drop-down menu
     *                                (see "Element Locators" in {@link SeleniumTestCaseDoc} )
     * @param string $optionLocator   an option locator (a label by default)
     * @return void
     * @see selectAndWait
     */
    public function select($selectLocator, $optionLocator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }

    /**
     * Clicks on a link, button, checkbox or radio button. If the click action causes a new page to load (like a link
     * usually does), call waitForPageToLoad.
     *
     * @param string $locator   an element locator
     *                          (see "Element Locators" in {@link SeleniumTestCaseDoc} )
     * @return void
     * @see clickAndWait
     */
    public function click($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }

    /**
     * Create a new cookie whose path and domain are same with those of current page under test, unless you specified a
     * path for this cookie explicitly.
     *
     * @param string $nameValuePair name and value of the cookie in a format "name=value"
     * @param string $optionsString options for the cookie. Currently supported options include 'path', 'max_age' and
     *                              'domain'. the optionsString's format is "path=/path/, max_age=60, domain=.foo.com".
     *                              The order of options are irrelevant, the unit of the value of 'max_age' is second.
     *                              Note that specifying a domain that isn't a subset of the current domain will
     *                              usually fail.
     * @return void
     */
    public function createCookie($nameValuePair, $optionsString)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }

    // =================================================================================================================
    // ========== assert - methods
    /**
     * Asserts that the specified text pattern appears somewhere on the rendered page shown to the user.
     *
     * @param string $pattern  a pattern to match with the text of the page
     *                         (see "String-match Patterns" in {@link SeleniumTestCaseDoc} )
     * @return void
     * @see assertTextNotPresent
     * @see waitForTextPresent
     * @see waitForTextNotPresent
     */
    public function assertTextPresent($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }

    /**
     * Asserts that the specified element is somewhere on the page.
     *
     * @param string $locator   an element locator
     *                          (see "Element Locators" in {@link SeleniumTestCaseDoc} )
     * @return void
     * @see assertElementNotPresent
     * @see waitForElementPresent
     * @see waitForElementNotPresent
     */
    public function assertElementPresent($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }

    // =================================================================================================================
    // ========== assert NOT - methods

    /**
     * See {@link assertElementPresent}
     *
     * @param string $locator
     * @return void
     */
    public function assertElementNotPresent($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }

    /**
     * See {@link assertTextPresent}
     *
     * @param string $pattern
     * @return void
     */
    public function assertTextNotPresent($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }

    // =================================================================================================================
    // ========== andWait - methods

    /**
     * Waits for a new page to load. See detail {@link type}
     *
     * @param string           $locator
     * @param string|int|float $value
     * @return void
     */
    public function typeAndWait($locator, $value)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }

    /**
     * Waits for a new page to load. See detail {@link select}
     *
     * @param string $selectLocator
     * @param string $optionLocator
     * @return void
     */
    public function selectAndWait($selectLocator, $optionLocator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }

    /**
     * Waits for a new page to load. See detail {@link click}
     *
     * @param string $locator
     * @return void
     */
    public function clickAndWait($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }

    /**
     * Calls parent implementation of specified nonstatic method (from the parent class)
     *
     * @param string $currentMethodName  Name of current method (from current called object),
     *                                   see {@link __METHOD__} constant
     * @param array  $args
     * @return mixed
     */
    private function _callParentMethod($currentMethodName, $args)
    {
        $currentMethodName = explode('::', $currentMethodName)[1];
        return call_user_func_array('parent::' . $currentMethodName, $args);
    }
}