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
 * @date    %date%
 * @link    http://fx4.ru/
 * @link    https://github.com/IStranger/phpunit-selenium-doc
 *
 */
trait SeleniumTestCaseDoc_AutoGenerated
{

%methods%

    /**
     * Calls parent implementation of specified nonstatic method (from the parent class)
     *
     * @param string $currentMethodName  Name of current method (from current called object),
     *                                   see {@link __METHOD__} constant
     * @param array  $args
     *
     * @return mixed
     */
    private function _callParentMethod($currentMethodName, $args)
    {
        $currentMethodName = explode('::', $currentMethodName)[1];
        return call_user_func_array('parent::' . $currentMethodName, $args);
    }
}