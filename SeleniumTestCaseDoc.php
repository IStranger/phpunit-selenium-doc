<?php

/**
 * Class SeleniumTestCaseDoc
 *
 * This class provides extended documentation (phpDoc) for phpunit-selenium methods
 * (override documentation of methods {@link PHPUnit_Extensions_SeleniumTestCase}).
 * Class used for easy development of tests in IDE (like phpStorm or NetBeans).
 *
 * @see     http://release.seleniumhq.org/selenium-core/1.0.1/reference.html
 *
 *
 * @author  G.Azamat <m@fx4web.com>
 * @date    2015-05-21
 * @link    http://fx4.ru/
 * @link    https://github.com/IStranger/phpunit-selenium-doc
 */
trait SeleniumTestCaseDoc
{
    // private variables doc_* only for separate phpDoc by section (and for links)

    /**
     * <h3>Element Locators</h3>
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
     */
    private $doc_Element_Locators;

    /**
     * <h3>Element Filters</h3>
     *
     * Element filters can be used with a locator to refine a list of candidate elements. They are currently used only in
     * the 'name' element-locator. <br/> Filters look much like locators, ie. <b>filterType=argument</b>
     *
     * Supported element-filters are: <br/>
     * + <b>value=valuePattern </b><br/>
     *      Matches elements based on their values. This is particularly useful for refining a list of similarly-named
     *      toggle-buttons. <br/>
     * + <b>index=index </b><br/>
     *      Selects a single element based on its position in the list (offset from zero). <br/>
     */
    private $doc_Element_Filters;

    /**
     * <h3>String-match Patterns</h3>
     *
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
     */
    private $doc_String_match_Patterns;

    /**
     * <h3>Stored Variables and Javascript evaluation</h3>
     *
     * <p>All Selenium command parameters can be constructed using both simple variable substitution as well as full
     * javascript. Both of these mechanisms can access previously stored variables, but do so using different syntax.</p>
     *
     * <h4>Stored Variables</h4>
     *
     * <p>The commands <em>store</em>, <em>storeValue</em> and <em>storeText</em> can be used to store a variable
     * value for later access. Internally, these variables are stored in a map called "storedVars",
     * with values keyed by the variable name. These commands are documented in the command reference.</p>
     *
     * <h4>Variable substitution</h4>
     *
     * <p>Variable substitution provides a simple way to include a previously stored variable in a
     * command parameter. This is a simple mechanism, by which the variable to substitute is indicated
     * by ${variableName}. Multiple variables can be substituted, and intermixed with static text.</p>
     *
     * <h4>Example:</h4>
     *
     * <pre><code>
     *      $this->storeTitle('pageTitle');
     *      $this->storeText('css=.text','elementText');
     *      $this->store('fullPageTitle', '{$pageTitle} -- ${elementText}');
     *      $this->type('textElement', 'Page title is: ${fullPageTitle}');
     * </code></pre>
     *
     * <h4>Javascript evaluation</h4>
     *
     * <p>Javascript evaluation provides the full power of javascript in constructing a command parameter.
     * To use this mechanism, the <em>entire</em> parameter value must be prefixed by
     * 'javascript{' with a trailing '}'. The text inside the braces is evaluated as a javascript expression,
     * and can access previously stored variables using the <em>storedVars</em> map detailed above.
     * Note that variable substitution cannot be combined with javascript evaluation.</p>
     *
     * <h4>Example:</h4>
     *
     * <pre><code>
     *      $this->store('javascript{'merchant' + (new Date()).getTime()}', 'merchantId');
     *      $this->type('textElement', 'javascript{storedVars['merchantId'].toUpperCase()}');
     * </code></pre>
     *
     */
    private $doc_Stored_Variables;

    /**
     * Defines a new function for Selenium to locate elements on the page. 
     * 
     * For example, if you define the strategy "foo", and someone runs click("foo=blah"), we'll run your function,
     * passing you the string "blah", and click on the element that your function returns, or throw an "Element not
     * found" error if your function returns null. We'll pass three arguments to your function:
     * 
     * <ul>
     *     <li>locator: the string the user passed in</li>
     *     <li>inWindow: the currently selected window</li>
     *     <li>inDocument: the currently selected document</li>
     * </ul>
     * 
     * The function must return null if the element can't be found.
     * 
     * @param string   $strategyName        the name of the strategy to define; this should use only letters [a-zA-Z]
     *                                      with no spaces  or other punctuation.
     * @param string   $functionDefinition  a string defining the body of a function in JavaScript. For example:
     *                                      <code>return  inDocument.getElementById(locator);</code>
     * 
     * @return  void
     * 
     * @see  addLocationStrategyAndWait  Related Action
     */
    public function addLocationStrategy($strategyName, $functionDefinition)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Defines a new function for Selenium to locate elements on the page. 
     * 
     * For example, if you define the strategy "foo", and someone runs click("foo=blah"), we'll run your function,
     * passing you the string "blah", and click on the element that your function returns, or throw an "Element not
     * found" error if your function returns null. We'll pass three arguments to your function:
     * 
     * <ul>
     *     <li>locator: the string the user passed in</li>
     *     <li>inWindow: the currently selected window</li>
     *     <li>inDocument: the currently selected document</li>
     * </ul>
     * 
     * The function must return null if the element can't be found.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $strategyName        the name of the strategy to define; this should use only letters [a-zA-Z]
     *                                      with no spaces  or other punctuation.
     * @param string   $functionDefinition  a string defining the body of a function in JavaScript. For example:
     *                                      <code>return  inDocument.getElementById(locator);</code>
     * 
     * @return  void
     * 
     * @see  addLocationStrategy  Base method, from which has been generated (automatically) current method
     */
    public function addLocationStrategyAndWait($strategyName, $functionDefinition)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Loads script content into a new script tag in the Selenium document. 
     * 
     * This differs from the runScript command in that runScript adds the script tag to the document of the AUT, not
     * the Selenium document. The following entities in the script content are replaced by the characters they
     * represent: &lt; &gt; &amp; The corresponding remove command is removeScript.
     * 
     * @param string   $scriptContent  the Javascript content of the script to add
     * @param string   $scriptTagId    (optional) the id of the new script tag. If specified, and an element with this
     *                                 id already  exists, this operation will fail.
     * 
     * @return  void
     * 
     * @see  addScriptAndWait  Related Action
     */
    public function addScript($scriptContent, $scriptTagId)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Loads script content into a new script tag in the Selenium document. 
     * 
     * This differs from the runScript command in that runScript adds the script tag to the document of the AUT, not
     * the Selenium document. The following entities in the script content are replaced by the characters they
     * represent: &lt; &gt; &amp; The corresponding remove command is removeScript.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $scriptContent  the Javascript content of the script to add
     * @param string   $scriptTagId    (optional) the id of the new script tag. If specified, and an element with this
     *                                 id already  exists, this operation will fail.
     * 
     * @return  void
     * 
     * @see  addScript  Base method, from which has been generated (automatically) current method
     */
    public function addScriptAndWait($scriptContent, $scriptTagId)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Add a selection to the set of selected options in a multi-select element using an option locator. @see #doSelect
     * for details of option locators.
     * 
     * @param string   $locator        an element locator identifying a multi-select box (see
     *                                 {@link doc_Element_Locators})
     * @param string   $optionLocator  an option locator (a label by default)
     * 
     * @return  void
     * 
     * @see  addSelectionAndWait  Related Action
     */
    public function addSelection($locator, $optionLocator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Add a selection to the set of selected options in a multi-select element using an option locator. @see #doSelect
     * for details of option locators.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator        an element locator identifying a multi-select box (see
     *                                 {@link doc_Element_Locators})
     * @param string   $optionLocator  an option locator (a label by default)
     * 
     * @return  void
     * 
     * @see  addSelection  Base method, from which has been generated (automatically) current method
     */
    public function addSelectionAndWait($locator, $optionLocator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Specifies whether Selenium should use the native in-browser implementation of XPath (if any native version is
     * available); if you pass "false" to this function, we will always use our pure-JavaScript xpath library. 
     * 
     * Using the pure-JS xpath library can improve the consistency of xpath element locators between different browser
     * vendors, but the pure-JS version is much slower than the native implementations.
     * 
     * @param string   $allow  boolean, true means we'll prefer to use native XPath; false means we'll only use JS
     *                         XPath
     * 
     * @return  void
     * 
     * @see  allowNativeXpathAndWait  Related Action
     */
    public function allowNativeXpath($allow)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Specifies whether Selenium should use the native in-browser implementation of XPath (if any native version is
     * available); if you pass "false" to this function, we will always use our pure-JavaScript xpath library. 
     * 
     * Using the pure-JS xpath library can improve the consistency of xpath element locators between different browser
     * vendors, but the pure-JS version is much slower than the native implementations.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $allow  boolean, true means we'll prefer to use native XPath; false means we'll only use JS
     *                         XPath
     * 
     * @return  void
     * 
     * @see  allowNativeXpath  Base method, from which has been generated (automatically) current method
     */
    public function allowNativeXpathAndWait($allow)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Press the alt key and hold it down until doAltUp() is called or a new page is loaded.
     * 
     * @return  void
     * 
     * @see  altKeyDownAndWait  Related Action
     */
    public function altKeyDown()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Press the alt key and hold it down until doAltUp() is called or a new page is loaded.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @return  void
     * 
     * @see  altKeyDown  Base method, from which has been generated (automatically) current method
     */
    public function altKeyDownAndWait()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Release the alt key.
     * 
     * @return  void
     * 
     * @see  altKeyUpAndWait  Related Action
     */
    public function altKeyUp()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Release the alt key.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @return  void
     * 
     * @see  altKeyUp  Base method, from which has been generated (automatically) current method
     */
    public function altKeyUpAndWait()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Instructs Selenium to return the specified answer string in response to the next JavaScript prompt
     * [window.prompt()].
     * 
     * @param string   $answer  the answer to give in response to the prompt pop-up
     * 
     * @return  void
     */
    public function answerOnNextPrompt($answer)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the message of a JavaScript alert generated during the previous action, or fail if there
     * were no alerts. 
     * 
     * <p>Getting an alert has the same effect as manually clicking OK. If an alert is generated but you do not consume
     * it with getAlert, the next Selenium action will fail.</p>
     * 
     * <p>Under Selenium, JavaScript alerts will NOT pop up a visible alert dialog.</p>
     * 
     * <p>Selenium does NOT support JavaScript alerts that are generated in a page's onload() event handler. In this
     * case a visible dialog WILL be generated and Selenium will hang until someone manually clicks OK.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>The message of the most recent JavaScript alert</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyAlert}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAlert       Base method, from which has been generated (automatically) current method
     * @see  assertNotAlert   Related Assertion
     * @see  getAlert         Related Accessor
     * @see  verifyAlert      Related Assertion
     * @see  verifyNotAlert   Related Assertion
     * @see  waitForAlert     Related Assertion
     * @see  waitForNotAlert  Related Assertion
     */
    public function assertAlert($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the message of a JavaScript alert generated during the previous action, or fail if there
     * were no alerts. 
     * 
     * <p>Getting an alert has the same effect as manually clicking OK. If an alert is generated but you do not consume
     * it with getAlert, the next Selenium action will fail.</p>
     * 
     * <p>Under Selenium, JavaScript alerts will NOT pop up a visible alert dialog.</p>
     * 
     * <p>Selenium does NOT support JavaScript alerts that are generated in a page's onload() event handler. In this
     * case a visible dialog WILL be generated and Selenium will hang until someone manually clicks OK.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>The message of the most recent JavaScript alert</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotAlert}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAlert       Base method, from which has been generated (automatically) current method
     * @see  assertAlert      Related Assertion
     * @see  getAlert         Related Accessor
     * @see  verifyAlert      Related Assertion
     * @see  verifyNotAlert   Related Assertion
     * @see  waitForAlert     Related Assertion
     * @see  waitForNotAlert  Related Assertion
     */
    public function assertNotAlert($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Retrieves the message of a JavaScript alert generated during the previous action, or fail if there were no
     * alerts. 
     * 
     * <p>Getting an alert has the same effect as manually clicking OK. If an alert is generated but you do not consume
     * it with getAlert, the next Selenium action will fail.</p>
     * 
     * <p>Under Selenium, JavaScript alerts will NOT pop up a visible alert dialog.</p>
     * 
     * <p>Selenium does NOT support JavaScript alerts that are generated in a page's onload() event handler. In this
     * case a visible dialog WILL be generated and Selenium will hang until someone manually clicks OK.</p>
     * 
     * @return  string  The message of the most recent JavaScript alert
     * 
     * @see  storeAlert       Base method, from which has been generated (automatically) current method
     * @see  assertAlert      Related Assertion
     * @see  assertNotAlert   Related Assertion
     * @see  verifyAlert      Related Assertion
     * @see  verifyNotAlert   Related Assertion
     * @see  waitForAlert     Related Assertion
     * @see  waitForNotAlert  Related Assertion
     */
    public function getAlert()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Retrieves the message of a JavaScript alert generated during the previous action, or fail if there were no
     * alerts. 
     * 
     * <p>Getting an alert has the same effect as manually clicking OK. If an alert is generated but you do not consume
     * it with getAlert, the next Selenium action will fail.</p>
     * 
     * <p>Under Selenium, JavaScript alerts will NOT pop up a visible alert dialog.</p>
     * 
     * <p>Selenium does NOT support JavaScript alerts that are generated in a page's onload() event handler. In this
     * case a visible dialog WILL be generated and Selenium will hang until someone manually clicks OK.</p>
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>The message of the most recent JavaScript alert (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $variableName  the name of a variable in which the result is to be stored (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertAlert      Related Assertion
     * @see  assertNotAlert   Related Assertion
     * @see  getAlert         Related Accessor
     * @see  verifyAlert      Related Assertion
     * @see  verifyNotAlert   Related Assertion
     * @see  waitForAlert     Related Assertion
     * @see  waitForNotAlert  Related Assertion
     */
    public function storeAlert($variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the message of a JavaScript alert generated during the previous action, or fail if there
     * were no alerts. 
     * 
     * <p>Getting an alert has the same effect as manually clicking OK. If an alert is generated but you do not consume
     * it with getAlert, the next Selenium action will fail.</p>
     * 
     * <p>Under Selenium, JavaScript alerts will NOT pop up a visible alert dialog.</p>
     * 
     * <p>Selenium does NOT support JavaScript alerts that are generated in a page's onload() event handler. In this
     * case a visible dialog WILL be generated and Selenium will hang until someone manually clicks OK.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>The message of the most recent JavaScript alert</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertAlert}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAlert       Base method, from which has been generated (automatically) current method
     * @see  assertAlert      Related Assertion
     * @see  assertNotAlert   Related Assertion
     * @see  getAlert         Related Accessor
     * @see  verifyNotAlert   Related Assertion
     * @see  waitForAlert     Related Assertion
     * @see  waitForNotAlert  Related Assertion
     */
    public function verifyAlert($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the message of a JavaScript alert generated during the previous action, or fail if there
     * were no alerts. 
     * 
     * <p>Getting an alert has the same effect as manually clicking OK. If an alert is generated but you do not consume
     * it with getAlert, the next Selenium action will fail.</p>
     * 
     * <p>Under Selenium, JavaScript alerts will NOT pop up a visible alert dialog.</p>
     * 
     * <p>Selenium does NOT support JavaScript alerts that are generated in a page's onload() event handler. In this
     * case a visible dialog WILL be generated and Selenium will hang until someone manually clicks OK.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>The message of the most recent JavaScript alert</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotAlert}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAlert       Base method, from which has been generated (automatically) current method
     * @see  assertAlert      Related Assertion
     * @see  assertNotAlert   Related Assertion
     * @see  getAlert         Related Accessor
     * @see  verifyAlert      Related Assertion
     * @see  waitForAlert     Related Assertion
     * @see  waitForNotAlert  Related Assertion
     */
    public function verifyNotAlert($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the message of a JavaScript alert generated during the previous action, or fail if there
     * were no alerts. 
     * 
     * <p>Getting an alert has the same effect as manually clicking OK. If an alert is generated but you do not consume
     * it with getAlert, the next Selenium action will fail.</p>
     * 
     * <p>Under Selenium, JavaScript alerts will NOT pop up a visible alert dialog.</p>
     * 
     * <p>Selenium does NOT support JavaScript alerts that are generated in a page's onload() event handler. In this
     * case a visible dialog WILL be generated and Selenium will hang until someone manually clicks OK.</p>
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>The message of the most recent JavaScript alert</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAlert       Base method, from which has been generated (automatically) current method
     * @see  assertAlert      Related Assertion
     * @see  assertNotAlert   Related Assertion
     * @see  getAlert         Related Accessor
     * @see  verifyAlert      Related Assertion
     * @see  verifyNotAlert   Related Assertion
     * @see  waitForNotAlert  Related Assertion
     */
    public function waitForAlert($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the message of a JavaScript alert generated during the previous action, or fail if there
     * were no alerts. 
     * 
     * <p>Getting an alert has the same effect as manually clicking OK. If an alert is generated but you do not consume
     * it with getAlert, the next Selenium action will fail.</p>
     * 
     * <p>Under Selenium, JavaScript alerts will NOT pop up a visible alert dialog.</p>
     * 
     * <p>Selenium does NOT support JavaScript alerts that are generated in a page's onload() event handler. In this
     * case a visible dialog WILL be generated and Selenium will hang until someone manually clicks OK.</p>
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>The message of the most recent JavaScript alert</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAlert      Base method, from which has been generated (automatically) current method
     * @see  assertAlert     Related Assertion
     * @see  assertNotAlert  Related Assertion
     * @see  getAlert        Related Accessor
     * @see  verifyAlert     Related Assertion
     * @see  verifyNotAlert  Related Assertion
     * @see  waitForAlert    Related Assertion
     */
    public function waitForNotAlert($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Has an alert occurred? 
     * 
     * <p> This function never throws an exception </p>.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if there is an alert</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyAlertNotPresent}).</p>
     * 
     * @return  void
     * 
     * @see  storeAlertPresent       Base method, from which has been generated (automatically) current method
     * @see  assertAlertPresent      Related Assertion
     * @see  isAlertPresent          Related Accessor
     * @see  verifyAlertNotPresent   Related Assertion
     * @see  verifyAlertPresent      Related Assertion
     * @see  waitForAlertNotPresent  Related Assertion
     * @see  waitForAlertPresent     Related Assertion
     */
    public function assertAlertNotPresent()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Has an alert occurred? 
     * 
     * <p> This function never throws an exception </p>.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if there is an alert</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyAlertPresent}).</p>
     * 
     * @return  void
     * 
     * @see  storeAlertPresent       Base method, from which has been generated (automatically) current method
     * @see  assertAlertNotPresent   Related Assertion
     * @see  isAlertPresent          Related Accessor
     * @see  verifyAlertNotPresent   Related Assertion
     * @see  verifyAlertPresent      Related Assertion
     * @see  waitForAlertNotPresent  Related Assertion
     * @see  waitForAlertPresent     Related Assertion
     */
    public function assertAlertPresent()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Has an alert occurred? 
     * 
     * <p> This function never throws an exception </p>.
     * 
     * @return  bool  true if there is an alert
     * 
     * @see  storeAlertPresent       Base method, from which has been generated (automatically) current method
     * @see  assertAlertNotPresent   Related Assertion
     * @see  assertAlertPresent      Related Assertion
     * @see  verifyAlertNotPresent   Related Assertion
     * @see  verifyAlertPresent      Related Assertion
     * @see  waitForAlertNotPresent  Related Assertion
     * @see  waitForAlertPresent     Related Assertion
     */
    public function isAlertPresent()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Has an alert occurred? 
     * 
     * <p> This function never throws an exception </p>.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>true if there is an alert (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $variableName  the name of a variable in which the result is to be stored (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertAlertNotPresent   Related Assertion
     * @see  assertAlertPresent      Related Assertion
     * @see  isAlertPresent          Related Accessor
     * @see  verifyAlertNotPresent   Related Assertion
     * @see  verifyAlertPresent      Related Assertion
     * @see  waitForAlertNotPresent  Related Assertion
     * @see  waitForAlertPresent     Related Assertion
     */
    public function storeAlertPresent($variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Has an alert occurred? 
     * 
     * <p> This function never throws an exception </p>.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if there is an alert</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertAlertNotPresent}).</p>
     * 
     * @return  void
     * 
     * @see  storeAlertPresent       Base method, from which has been generated (automatically) current method
     * @see  assertAlertNotPresent   Related Assertion
     * @see  assertAlertPresent      Related Assertion
     * @see  isAlertPresent          Related Accessor
     * @see  verifyAlertPresent      Related Assertion
     * @see  waitForAlertNotPresent  Related Assertion
     * @see  waitForAlertPresent     Related Assertion
     */
    public function verifyAlertNotPresent()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Has an alert occurred? 
     * 
     * <p> This function never throws an exception </p>.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if there is an alert</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertAlertPresent}).</p>
     * 
     * @return  void
     * 
     * @see  storeAlertPresent       Base method, from which has been generated (automatically) current method
     * @see  assertAlertNotPresent   Related Assertion
     * @see  assertAlertPresent      Related Assertion
     * @see  isAlertPresent          Related Accessor
     * @see  verifyAlertNotPresent   Related Assertion
     * @see  waitForAlertNotPresent  Related Assertion
     * @see  waitForAlertPresent     Related Assertion
     */
    public function verifyAlertPresent()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Has an alert occurred? 
     * 
     * <p> This function never throws an exception </p>.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>true if there is an alert</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @return  void
     * 
     * @see  storeAlertPresent      Base method, from which has been generated (automatically) current method
     * @see  assertAlertNotPresent  Related Assertion
     * @see  assertAlertPresent     Related Assertion
     * @see  isAlertPresent         Related Accessor
     * @see  verifyAlertNotPresent  Related Assertion
     * @see  verifyAlertPresent     Related Assertion
     * @see  waitForAlertPresent    Related Assertion
     */
    public function waitForAlertNotPresent()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Has an alert occurred? 
     * 
     * <p> This function never throws an exception </p>.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>true if there is an alert</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @return  void
     * 
     * @see  storeAlertPresent       Base method, from which has been generated (automatically) current method
     * @see  assertAlertNotPresent   Related Assertion
     * @see  assertAlertPresent      Related Assertion
     * @see  isAlertPresent          Related Accessor
     * @see  verifyAlertNotPresent   Related Assertion
     * @see  verifyAlertPresent      Related Assertion
     * @see  waitForAlertNotPresent  Related Assertion
     */
    public function waitForAlertPresent()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the IDs of all buttons on the page. 
     * 
     * <p>If a given button has no ID, it will appear as "" in this array.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the IDs of all buttons on the page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyAllButtons}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllButtons       Base method, from which has been generated (automatically) current method
     * @see  assertNotAllButtons   Related Assertion
     * @see  getAllButtons         Related Accessor
     * @see  verifyAllButtons      Related Assertion
     * @see  verifyNotAllButtons   Related Assertion
     * @see  waitForAllButtons     Related Assertion
     * @see  waitForNotAllButtons  Related Assertion
     */
    public function assertAllButtons($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the IDs of all buttons on the page. 
     * 
     * <p>If a given button has no ID, it will appear as "" in this array.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the IDs of all buttons on the page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotAllButtons}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllButtons       Base method, from which has been generated (automatically) current method
     * @see  assertAllButtons      Related Assertion
     * @see  getAllButtons         Related Accessor
     * @see  verifyAllButtons      Related Assertion
     * @see  verifyNotAllButtons   Related Assertion
     * @see  waitForAllButtons     Related Assertion
     * @see  waitForNotAllButtons  Related Assertion
     */
    public function assertNotAllButtons($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Returns the IDs of all buttons on the page. 
     * 
     * <p>If a given button has no ID, it will appear as "" in this array.</p>
     * 
     * @return  string[]  the IDs of all buttons on the page
     * 
     * @see  storeAllButtons       Base method, from which has been generated (automatically) current method
     * @see  assertAllButtons      Related Assertion
     * @see  assertNotAllButtons   Related Assertion
     * @see  verifyAllButtons      Related Assertion
     * @see  verifyNotAllButtons   Related Assertion
     * @see  waitForAllButtons     Related Assertion
     * @see  waitForNotAllButtons  Related Assertion
     */
    public function getAllButtons()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Returns the IDs of all buttons on the page. 
     * 
     * <p>If a given button has no ID, it will appear as "" in this array.</p>
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>the IDs of all buttons on the page (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $variableName  the name of a variable in which the result is to be stored (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertAllButtons      Related Assertion
     * @see  assertNotAllButtons   Related Assertion
     * @see  getAllButtons         Related Accessor
     * @see  verifyAllButtons      Related Assertion
     * @see  verifyNotAllButtons   Related Assertion
     * @see  waitForAllButtons     Related Assertion
     * @see  waitForNotAllButtons  Related Assertion
     */
    public function storeAllButtons($variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the IDs of all buttons on the page. 
     * 
     * <p>If a given button has no ID, it will appear as "" in this array.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the IDs of all buttons on the page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertAllButtons}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllButtons       Base method, from which has been generated (automatically) current method
     * @see  assertAllButtons      Related Assertion
     * @see  assertNotAllButtons   Related Assertion
     * @see  getAllButtons         Related Accessor
     * @see  verifyNotAllButtons   Related Assertion
     * @see  waitForAllButtons     Related Assertion
     * @see  waitForNotAllButtons  Related Assertion
     */
    public function verifyAllButtons($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the IDs of all buttons on the page. 
     * 
     * <p>If a given button has no ID, it will appear as "" in this array.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the IDs of all buttons on the page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotAllButtons}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllButtons       Base method, from which has been generated (automatically) current method
     * @see  assertAllButtons      Related Assertion
     * @see  assertNotAllButtons   Related Assertion
     * @see  getAllButtons         Related Accessor
     * @see  verifyAllButtons      Related Assertion
     * @see  waitForAllButtons     Related Assertion
     * @see  waitForNotAllButtons  Related Assertion
     */
    public function verifyNotAllButtons($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the IDs of all buttons on the page. 
     * 
     * <p>If a given button has no ID, it will appear as "" in this array.</p>
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the IDs of all buttons on the page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllButtons       Base method, from which has been generated (automatically) current method
     * @see  assertAllButtons      Related Assertion
     * @see  assertNotAllButtons   Related Assertion
     * @see  getAllButtons         Related Accessor
     * @see  verifyAllButtons      Related Assertion
     * @see  verifyNotAllButtons   Related Assertion
     * @see  waitForNotAllButtons  Related Assertion
     */
    public function waitForAllButtons($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the IDs of all buttons on the page. 
     * 
     * <p>If a given button has no ID, it will appear as "" in this array.</p>
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the IDs of all buttons on the page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllButtons      Base method, from which has been generated (automatically) current method
     * @see  assertAllButtons     Related Assertion
     * @see  assertNotAllButtons  Related Assertion
     * @see  getAllButtons        Related Accessor
     * @see  verifyAllButtons     Related Assertion
     * @see  verifyNotAllButtons  Related Assertion
     * @see  waitForAllButtons    Related Assertion
     */
    public function waitForNotAllButtons($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the IDs of all input fields on the page. 
     * 
     * <p>If a given field has no ID, it will appear as "" in this array.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the IDs of all field on the page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyAllFields}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllFields       Base method, from which has been generated (automatically) current method
     * @see  assertNotAllFields   Related Assertion
     * @see  getAllFields         Related Accessor
     * @see  verifyAllFields      Related Assertion
     * @see  verifyNotAllFields   Related Assertion
     * @see  waitForAllFields     Related Assertion
     * @see  waitForNotAllFields  Related Assertion
     */
    public function assertAllFields($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the IDs of all input fields on the page. 
     * 
     * <p>If a given field has no ID, it will appear as "" in this array.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the IDs of all field on the page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotAllFields}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllFields       Base method, from which has been generated (automatically) current method
     * @see  assertAllFields      Related Assertion
     * @see  getAllFields         Related Accessor
     * @see  verifyAllFields      Related Assertion
     * @see  verifyNotAllFields   Related Assertion
     * @see  waitForAllFields     Related Assertion
     * @see  waitForNotAllFields  Related Assertion
     */
    public function assertNotAllFields($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Returns the IDs of all input fields on the page. 
     * 
     * <p>If a given field has no ID, it will appear as "" in this array.</p>
     * 
     * @return  string[]  the IDs of all field on the page
     * 
     * @see  storeAllFields       Base method, from which has been generated (automatically) current method
     * @see  assertAllFields      Related Assertion
     * @see  assertNotAllFields   Related Assertion
     * @see  verifyAllFields      Related Assertion
     * @see  verifyNotAllFields   Related Assertion
     * @see  waitForAllFields     Related Assertion
     * @see  waitForNotAllFields  Related Assertion
     */
    public function getAllFields()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Returns the IDs of all input fields on the page. 
     * 
     * <p>If a given field has no ID, it will appear as "" in this array.</p>
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>the IDs of all field on the page (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $variableName  the name of a variable in which the result is to be stored (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertAllFields      Related Assertion
     * @see  assertNotAllFields   Related Assertion
     * @see  getAllFields         Related Accessor
     * @see  verifyAllFields      Related Assertion
     * @see  verifyNotAllFields   Related Assertion
     * @see  waitForAllFields     Related Assertion
     * @see  waitForNotAllFields  Related Assertion
     */
    public function storeAllFields($variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the IDs of all input fields on the page. 
     * 
     * <p>If a given field has no ID, it will appear as "" in this array.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the IDs of all field on the page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertAllFields}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllFields       Base method, from which has been generated (automatically) current method
     * @see  assertAllFields      Related Assertion
     * @see  assertNotAllFields   Related Assertion
     * @see  getAllFields         Related Accessor
     * @see  verifyNotAllFields   Related Assertion
     * @see  waitForAllFields     Related Assertion
     * @see  waitForNotAllFields  Related Assertion
     */
    public function verifyAllFields($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the IDs of all input fields on the page. 
     * 
     * <p>If a given field has no ID, it will appear as "" in this array.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the IDs of all field on the page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotAllFields}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllFields       Base method, from which has been generated (automatically) current method
     * @see  assertAllFields      Related Assertion
     * @see  assertNotAllFields   Related Assertion
     * @see  getAllFields         Related Accessor
     * @see  verifyAllFields      Related Assertion
     * @see  waitForAllFields     Related Assertion
     * @see  waitForNotAllFields  Related Assertion
     */
    public function verifyNotAllFields($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the IDs of all input fields on the page. 
     * 
     * <p>If a given field has no ID, it will appear as "" in this array.</p>
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the IDs of all field on the page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllFields       Base method, from which has been generated (automatically) current method
     * @see  assertAllFields      Related Assertion
     * @see  assertNotAllFields   Related Assertion
     * @see  getAllFields         Related Accessor
     * @see  verifyAllFields      Related Assertion
     * @see  verifyNotAllFields   Related Assertion
     * @see  waitForNotAllFields  Related Assertion
     */
    public function waitForAllFields($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the IDs of all input fields on the page. 
     * 
     * <p>If a given field has no ID, it will appear as "" in this array.</p>
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the IDs of all field on the page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllFields      Base method, from which has been generated (automatically) current method
     * @see  assertAllFields     Related Assertion
     * @see  assertNotAllFields  Related Assertion
     * @see  getAllFields        Related Accessor
     * @see  verifyAllFields     Related Assertion
     * @see  verifyNotAllFields  Related Assertion
     * @see  waitForAllFields    Related Assertion
     */
    public function waitForNotAllFields($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the IDs of all links on the page. 
     * 
     * <p>If a given link has no ID, it will appear as "" in this array.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the IDs of all links on the page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyAllLinks}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllLinks       Base method, from which has been generated (automatically) current method
     * @see  assertNotAllLinks   Related Assertion
     * @see  getAllLinks         Related Accessor
     * @see  verifyAllLinks      Related Assertion
     * @see  verifyNotAllLinks   Related Assertion
     * @see  waitForAllLinks     Related Assertion
     * @see  waitForNotAllLinks  Related Assertion
     */
    public function assertAllLinks($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the IDs of all links on the page. 
     * 
     * <p>If a given link has no ID, it will appear as "" in this array.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the IDs of all links on the page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotAllLinks}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllLinks       Base method, from which has been generated (automatically) current method
     * @see  assertAllLinks      Related Assertion
     * @see  getAllLinks         Related Accessor
     * @see  verifyAllLinks      Related Assertion
     * @see  verifyNotAllLinks   Related Assertion
     * @see  waitForAllLinks     Related Assertion
     * @see  waitForNotAllLinks  Related Assertion
     */
    public function assertNotAllLinks($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Returns the IDs of all links on the page. 
     * 
     * <p>If a given link has no ID, it will appear as "" in this array.</p>
     * 
     * @return  string[]  the IDs of all links on the page
     * 
     * @see  storeAllLinks       Base method, from which has been generated (automatically) current method
     * @see  assertAllLinks      Related Assertion
     * @see  assertNotAllLinks   Related Assertion
     * @see  verifyAllLinks      Related Assertion
     * @see  verifyNotAllLinks   Related Assertion
     * @see  waitForAllLinks     Related Assertion
     * @see  waitForNotAllLinks  Related Assertion
     */
    public function getAllLinks()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Returns the IDs of all links on the page. 
     * 
     * <p>If a given link has no ID, it will appear as "" in this array.</p>
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>the IDs of all links on the page (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $variableName  the name of a variable in which the result is to be stored (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertAllLinks      Related Assertion
     * @see  assertNotAllLinks   Related Assertion
     * @see  getAllLinks         Related Accessor
     * @see  verifyAllLinks      Related Assertion
     * @see  verifyNotAllLinks   Related Assertion
     * @see  waitForAllLinks     Related Assertion
     * @see  waitForNotAllLinks  Related Assertion
     */
    public function storeAllLinks($variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the IDs of all links on the page. 
     * 
     * <p>If a given link has no ID, it will appear as "" in this array.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the IDs of all links on the page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertAllLinks}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllLinks       Base method, from which has been generated (automatically) current method
     * @see  assertAllLinks      Related Assertion
     * @see  assertNotAllLinks   Related Assertion
     * @see  getAllLinks         Related Accessor
     * @see  verifyNotAllLinks   Related Assertion
     * @see  waitForAllLinks     Related Assertion
     * @see  waitForNotAllLinks  Related Assertion
     */
    public function verifyAllLinks($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the IDs of all links on the page. 
     * 
     * <p>If a given link has no ID, it will appear as "" in this array.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the IDs of all links on the page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotAllLinks}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllLinks       Base method, from which has been generated (automatically) current method
     * @see  assertAllLinks      Related Assertion
     * @see  assertNotAllLinks   Related Assertion
     * @see  getAllLinks         Related Accessor
     * @see  verifyAllLinks      Related Assertion
     * @see  waitForAllLinks     Related Assertion
     * @see  waitForNotAllLinks  Related Assertion
     */
    public function verifyNotAllLinks($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the IDs of all links on the page. 
     * 
     * <p>If a given link has no ID, it will appear as "" in this array.</p>
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the IDs of all links on the page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllLinks       Base method, from which has been generated (automatically) current method
     * @see  assertAllLinks      Related Assertion
     * @see  assertNotAllLinks   Related Assertion
     * @see  getAllLinks         Related Accessor
     * @see  verifyAllLinks      Related Assertion
     * @see  verifyNotAllLinks   Related Assertion
     * @see  waitForNotAllLinks  Related Assertion
     */
    public function waitForAllLinks($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the IDs of all links on the page. 
     * 
     * <p>If a given link has no ID, it will appear as "" in this array.</p>
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the IDs of all links on the page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllLinks      Base method, from which has been generated (automatically) current method
     * @see  assertAllLinks     Related Assertion
     * @see  assertNotAllLinks  Related Assertion
     * @see  getAllLinks        Related Accessor
     * @see  verifyAllLinks     Related Assertion
     * @see  verifyNotAllLinks  Related Assertion
     * @see  waitForAllLinks    Related Assertion
     */
    public function waitForNotAllLinks($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the IDs of all windows that the browser knows about in an array.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>Array of identifiers of all windows that the browser knows about.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyAllWindowIds}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllWindowIds       Base method, from which has been generated (automatically) current method
     * @see  assertNotAllWindowIds   Related Assertion
     * @see  getAllWindowIds         Related Accessor
     * @see  verifyAllWindowIds      Related Assertion
     * @see  verifyNotAllWindowIds   Related Assertion
     * @see  waitForAllWindowIds     Related Assertion
     * @see  waitForNotAllWindowIds  Related Assertion
     */
    public function assertAllWindowIds($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the IDs of all windows that the browser knows about in an array.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>Array of identifiers of all windows that the browser knows about.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotAllWindowIds}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllWindowIds       Base method, from which has been generated (automatically) current method
     * @see  assertAllWindowIds      Related Assertion
     * @see  getAllWindowIds         Related Accessor
     * @see  verifyAllWindowIds      Related Assertion
     * @see  verifyNotAllWindowIds   Related Assertion
     * @see  waitForAllWindowIds     Related Assertion
     * @see  waitForNotAllWindowIds  Related Assertion
     */
    public function assertNotAllWindowIds($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Returns the IDs of all windows that the browser knows about in an array.
     * 
     * @return  string[]  Array of identifiers of all windows that the browser knows about.
     * 
     * @see  storeAllWindowIds       Base method, from which has been generated (automatically) current method
     * @see  assertAllWindowIds      Related Assertion
     * @see  assertNotAllWindowIds   Related Assertion
     * @see  verifyAllWindowIds      Related Assertion
     * @see  verifyNotAllWindowIds   Related Assertion
     * @see  waitForAllWindowIds     Related Assertion
     * @see  waitForNotAllWindowIds  Related Assertion
     */
    public function getAllWindowIds()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Returns the IDs of all windows that the browser knows about in an array.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>Array of identifiers of all windows that the browser knows about. (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $variableName  the name of a variable in which the result is to be stored (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertAllWindowIds      Related Assertion
     * @see  assertNotAllWindowIds   Related Assertion
     * @see  getAllWindowIds         Related Accessor
     * @see  verifyAllWindowIds      Related Assertion
     * @see  verifyNotAllWindowIds   Related Assertion
     * @see  waitForAllWindowIds     Related Assertion
     * @see  waitForNotAllWindowIds  Related Assertion
     */
    public function storeAllWindowIds($variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the IDs of all windows that the browser knows about in an array.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>Array of identifiers of all windows that the browser knows about.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertAllWindowIds}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllWindowIds       Base method, from which has been generated (automatically) current method
     * @see  assertAllWindowIds      Related Assertion
     * @see  assertNotAllWindowIds   Related Assertion
     * @see  getAllWindowIds         Related Accessor
     * @see  verifyNotAllWindowIds   Related Assertion
     * @see  waitForAllWindowIds     Related Assertion
     * @see  waitForNotAllWindowIds  Related Assertion
     */
    public function verifyAllWindowIds($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the IDs of all windows that the browser knows about in an array.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>Array of identifiers of all windows that the browser knows about.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotAllWindowIds}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllWindowIds       Base method, from which has been generated (automatically) current method
     * @see  assertAllWindowIds      Related Assertion
     * @see  assertNotAllWindowIds   Related Assertion
     * @see  getAllWindowIds         Related Accessor
     * @see  verifyAllWindowIds      Related Assertion
     * @see  waitForAllWindowIds     Related Assertion
     * @see  waitForNotAllWindowIds  Related Assertion
     */
    public function verifyNotAllWindowIds($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the IDs of all windows that the browser knows about in an array.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>Array of identifiers of all windows that the browser knows about.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllWindowIds       Base method, from which has been generated (automatically) current method
     * @see  assertAllWindowIds      Related Assertion
     * @see  assertNotAllWindowIds   Related Assertion
     * @see  getAllWindowIds         Related Accessor
     * @see  verifyAllWindowIds      Related Assertion
     * @see  verifyNotAllWindowIds   Related Assertion
     * @see  waitForNotAllWindowIds  Related Assertion
     */
    public function waitForAllWindowIds($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the IDs of all windows that the browser knows about in an array.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>Array of identifiers of all windows that the browser knows about.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllWindowIds      Base method, from which has been generated (automatically) current method
     * @see  assertAllWindowIds     Related Assertion
     * @see  assertNotAllWindowIds  Related Assertion
     * @see  getAllWindowIds        Related Accessor
     * @see  verifyAllWindowIds     Related Assertion
     * @see  verifyNotAllWindowIds  Related Assertion
     * @see  waitForAllWindowIds    Related Assertion
     */
    public function waitForNotAllWindowIds($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the names of all windows that the browser knows about in an array.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>Array of names of all windows that the browser knows about.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyAllWindowNames}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllWindowNames       Base method, from which has been generated (automatically) current method
     * @see  assertNotAllWindowNames   Related Assertion
     * @see  getAllWindowNames         Related Accessor
     * @see  verifyAllWindowNames      Related Assertion
     * @see  verifyNotAllWindowNames   Related Assertion
     * @see  waitForAllWindowNames     Related Assertion
     * @see  waitForNotAllWindowNames  Related Assertion
     */
    public function assertAllWindowNames($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the names of all windows that the browser knows about in an array.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>Array of names of all windows that the browser knows about.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotAllWindowNames}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllWindowNames       Base method, from which has been generated (automatically) current method
     * @see  assertAllWindowNames      Related Assertion
     * @see  getAllWindowNames         Related Accessor
     * @see  verifyAllWindowNames      Related Assertion
     * @see  verifyNotAllWindowNames   Related Assertion
     * @see  waitForAllWindowNames     Related Assertion
     * @see  waitForNotAllWindowNames  Related Assertion
     */
    public function assertNotAllWindowNames($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Returns the names of all windows that the browser knows about in an array.
     * 
     * @return  string[]  Array of names of all windows that the browser knows about.
     * 
     * @see  storeAllWindowNames       Base method, from which has been generated (automatically) current method
     * @see  assertAllWindowNames      Related Assertion
     * @see  assertNotAllWindowNames   Related Assertion
     * @see  verifyAllWindowNames      Related Assertion
     * @see  verifyNotAllWindowNames   Related Assertion
     * @see  waitForAllWindowNames     Related Assertion
     * @see  waitForNotAllWindowNames  Related Assertion
     */
    public function getAllWindowNames()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Returns the names of all windows that the browser knows about in an array.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>Array of names of all windows that the browser knows about. (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $variableName  the name of a variable in which the result is to be stored (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertAllWindowNames      Related Assertion
     * @see  assertNotAllWindowNames   Related Assertion
     * @see  getAllWindowNames         Related Accessor
     * @see  verifyAllWindowNames      Related Assertion
     * @see  verifyNotAllWindowNames   Related Assertion
     * @see  waitForAllWindowNames     Related Assertion
     * @see  waitForNotAllWindowNames  Related Assertion
     */
    public function storeAllWindowNames($variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the names of all windows that the browser knows about in an array.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>Array of names of all windows that the browser knows about.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertAllWindowNames}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllWindowNames       Base method, from which has been generated (automatically) current method
     * @see  assertAllWindowNames      Related Assertion
     * @see  assertNotAllWindowNames   Related Assertion
     * @see  getAllWindowNames         Related Accessor
     * @see  verifyNotAllWindowNames   Related Assertion
     * @see  waitForAllWindowNames     Related Assertion
     * @see  waitForNotAllWindowNames  Related Assertion
     */
    public function verifyAllWindowNames($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the names of all windows that the browser knows about in an array.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>Array of names of all windows that the browser knows about.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotAllWindowNames}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllWindowNames       Base method, from which has been generated (automatically) current method
     * @see  assertAllWindowNames      Related Assertion
     * @see  assertNotAllWindowNames   Related Assertion
     * @see  getAllWindowNames         Related Accessor
     * @see  verifyAllWindowNames      Related Assertion
     * @see  waitForAllWindowNames     Related Assertion
     * @see  waitForNotAllWindowNames  Related Assertion
     */
    public function verifyNotAllWindowNames($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the names of all windows that the browser knows about in an array.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>Array of names of all windows that the browser knows about.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllWindowNames       Base method, from which has been generated (automatically) current method
     * @see  assertAllWindowNames      Related Assertion
     * @see  assertNotAllWindowNames   Related Assertion
     * @see  getAllWindowNames         Related Accessor
     * @see  verifyAllWindowNames      Related Assertion
     * @see  verifyNotAllWindowNames   Related Assertion
     * @see  waitForNotAllWindowNames  Related Assertion
     */
    public function waitForAllWindowNames($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the names of all windows that the browser knows about in an array.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>Array of names of all windows that the browser knows about.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllWindowNames      Base method, from which has been generated (automatically) current method
     * @see  assertAllWindowNames     Related Assertion
     * @see  assertNotAllWindowNames  Related Assertion
     * @see  getAllWindowNames        Related Accessor
     * @see  verifyAllWindowNames     Related Assertion
     * @see  verifyNotAllWindowNames  Related Assertion
     * @see  waitForAllWindowNames    Related Assertion
     */
    public function waitForNotAllWindowNames($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the titles of all windows that the browser knows about in an array.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>Array of titles of all windows that the browser knows about.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyAllWindowTitles}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllWindowTitles       Base method, from which has been generated (automatically) current method
     * @see  assertNotAllWindowTitles   Related Assertion
     * @see  getAllWindowTitles         Related Accessor
     * @see  verifyAllWindowTitles      Related Assertion
     * @see  verifyNotAllWindowTitles   Related Assertion
     * @see  waitForAllWindowTitles     Related Assertion
     * @see  waitForNotAllWindowTitles  Related Assertion
     */
    public function assertAllWindowTitles($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the titles of all windows that the browser knows about in an array.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>Array of titles of all windows that the browser knows about.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotAllWindowTitles}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllWindowTitles       Base method, from which has been generated (automatically) current method
     * @see  assertAllWindowTitles      Related Assertion
     * @see  getAllWindowTitles         Related Accessor
     * @see  verifyAllWindowTitles      Related Assertion
     * @see  verifyNotAllWindowTitles   Related Assertion
     * @see  waitForAllWindowTitles     Related Assertion
     * @see  waitForNotAllWindowTitles  Related Assertion
     */
    public function assertNotAllWindowTitles($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Returns the titles of all windows that the browser knows about in an array.
     * 
     * @return  string[]  Array of titles of all windows that the browser knows about.
     * 
     * @see  storeAllWindowTitles       Base method, from which has been generated (automatically) current method
     * @see  assertAllWindowTitles      Related Assertion
     * @see  assertNotAllWindowTitles   Related Assertion
     * @see  verifyAllWindowTitles      Related Assertion
     * @see  verifyNotAllWindowTitles   Related Assertion
     * @see  waitForAllWindowTitles     Related Assertion
     * @see  waitForNotAllWindowTitles  Related Assertion
     */
    public function getAllWindowTitles()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Returns the titles of all windows that the browser knows about in an array.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>Array of titles of all windows that the browser knows about. (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $variableName  the name of a variable in which the result is to be stored (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertAllWindowTitles      Related Assertion
     * @see  assertNotAllWindowTitles   Related Assertion
     * @see  getAllWindowTitles         Related Accessor
     * @see  verifyAllWindowTitles      Related Assertion
     * @see  verifyNotAllWindowTitles   Related Assertion
     * @see  waitForAllWindowTitles     Related Assertion
     * @see  waitForNotAllWindowTitles  Related Assertion
     */
    public function storeAllWindowTitles($variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the titles of all windows that the browser knows about in an array.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>Array of titles of all windows that the browser knows about.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertAllWindowTitles}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllWindowTitles       Base method, from which has been generated (automatically) current method
     * @see  assertAllWindowTitles      Related Assertion
     * @see  assertNotAllWindowTitles   Related Assertion
     * @see  getAllWindowTitles         Related Accessor
     * @see  verifyNotAllWindowTitles   Related Assertion
     * @see  waitForAllWindowTitles     Related Assertion
     * @see  waitForNotAllWindowTitles  Related Assertion
     */
    public function verifyAllWindowTitles($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the titles of all windows that the browser knows about in an array.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>Array of titles of all windows that the browser knows about.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotAllWindowTitles}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllWindowTitles       Base method, from which has been generated (automatically) current method
     * @see  assertAllWindowTitles      Related Assertion
     * @see  assertNotAllWindowTitles   Related Assertion
     * @see  getAllWindowTitles         Related Accessor
     * @see  verifyAllWindowTitles      Related Assertion
     * @see  waitForAllWindowTitles     Related Assertion
     * @see  waitForNotAllWindowTitles  Related Assertion
     */
    public function verifyNotAllWindowTitles($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the titles of all windows that the browser knows about in an array.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>Array of titles of all windows that the browser knows about.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllWindowTitles       Base method, from which has been generated (automatically) current method
     * @see  assertAllWindowTitles      Related Assertion
     * @see  assertNotAllWindowTitles   Related Assertion
     * @see  getAllWindowTitles         Related Accessor
     * @see  verifyAllWindowTitles      Related Assertion
     * @see  verifyNotAllWindowTitles   Related Assertion
     * @see  waitForNotAllWindowTitles  Related Assertion
     */
    public function waitForAllWindowTitles($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the titles of all windows that the browser knows about in an array.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>Array of titles of all windows that the browser knows about.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAllWindowTitles      Base method, from which has been generated (automatically) current method
     * @see  assertAllWindowTitles     Related Assertion
     * @see  assertNotAllWindowTitles  Related Assertion
     * @see  getAllWindowTitles        Related Accessor
     * @see  verifyAllWindowTitles     Related Assertion
     * @see  verifyNotAllWindowTitles  Related Assertion
     * @see  waitForAllWindowTitles    Related Assertion
     */
    public function waitForNotAllWindowTitles($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the value of an element attribute. 
     * 
     * The value of the attribute may differ across browsers (this is the case for the "style" attribute, for example).
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the value of the specified attribute</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyAttribute}).</p>
     * 
     * @param string   $attributeLocator  an element locator followed by an @ sign and then the name of the attribute,
     *                                    e.g.  "foo@bar"
     * @param string   $pattern           the String-match Patterns 
     *                                    (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAttribute       Base method, from which has been generated (automatically) current method
     * @see  assertNotAttribute   Related Assertion
     * @see  getAttribute         Related Accessor
     * @see  verifyAttribute      Related Assertion
     * @see  verifyNotAttribute   Related Assertion
     * @see  waitForAttribute     Related Assertion
     * @see  waitForNotAttribute  Related Assertion
     */
    public function assertAttribute($attributeLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the value of an element attribute. 
     * 
     * The value of the attribute may differ across browsers (this is the case for the "style" attribute, for example).
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the value of the specified attribute</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotAttribute}).</p>
     * 
     * @param string   $attributeLocator  an element locator followed by an @ sign and then the name of the attribute,
     *                                    e.g.  "foo@bar"
     * @param string   $pattern           the String-match Patterns 
     *                                    (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAttribute       Base method, from which has been generated (automatically) current method
     * @see  assertAttribute      Related Assertion
     * @see  getAttribute         Related Accessor
     * @see  verifyAttribute      Related Assertion
     * @see  verifyNotAttribute   Related Assertion
     * @see  waitForAttribute     Related Assertion
     * @see  waitForNotAttribute  Related Assertion
     */
    public function assertNotAttribute($attributeLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets the value of an element attribute. 
     * 
     * The value of the attribute may differ across browsers (this is the case for the "style" attribute, for example).
     * 
     * @param string   $attributeLocator  an element locator followed by an @ sign and then the name of the attribute,
     *                                    e.g.  "foo@bar"
     * 
     * @return  string  the value of the specified attribute
     * 
     * @see  storeAttribute       Base method, from which has been generated (automatically) current method
     * @see  assertAttribute      Related Assertion
     * @see  assertNotAttribute   Related Assertion
     * @see  verifyAttribute      Related Assertion
     * @see  verifyNotAttribute   Related Assertion
     * @see  waitForAttribute     Related Assertion
     * @see  waitForNotAttribute  Related Assertion
     */
    public function getAttribute($attributeLocator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets the value of an element attribute. 
     * 
     * The value of the attribute may differ across browsers (this is the case for the "style" attribute, for example).
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>the value of the specified attribute (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $attributeLocator  an element locator followed by an @ sign and then the name of the attribute,
     *                                    e.g.  "foo@bar"
     * @param string   $variableName      the name of a variable in which the result is to be stored. (see
     *                                    {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertAttribute      Related Assertion
     * @see  assertNotAttribute   Related Assertion
     * @see  getAttribute         Related Accessor
     * @see  verifyAttribute      Related Assertion
     * @see  verifyNotAttribute   Related Assertion
     * @see  waitForAttribute     Related Assertion
     * @see  waitForNotAttribute  Related Assertion
     */
    public function storeAttribute($attributeLocator, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the value of an element attribute. 
     * 
     * The value of the attribute may differ across browsers (this is the case for the "style" attribute, for example).
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the value of the specified attribute</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertAttribute}).</p>
     * 
     * @param string   $attributeLocator  an element locator followed by an @ sign and then the name of the attribute,
     *                                    e.g.  "foo@bar"
     * @param string   $pattern           the String-match Patterns 
     *                                    (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAttribute       Base method, from which has been generated (automatically) current method
     * @see  assertAttribute      Related Assertion
     * @see  assertNotAttribute   Related Assertion
     * @see  getAttribute         Related Accessor
     * @see  verifyNotAttribute   Related Assertion
     * @see  waitForAttribute     Related Assertion
     * @see  waitForNotAttribute  Related Assertion
     */
    public function verifyAttribute($attributeLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the value of an element attribute. 
     * 
     * The value of the attribute may differ across browsers (this is the case for the "style" attribute, for example).
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the value of the specified attribute</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotAttribute}).</p>
     * 
     * @param string   $attributeLocator  an element locator followed by an @ sign and then the name of the attribute,
     *                                    e.g.  "foo@bar"
     * @param string   $pattern           the String-match Patterns 
     *                                    (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAttribute       Base method, from which has been generated (automatically) current method
     * @see  assertAttribute      Related Assertion
     * @see  assertNotAttribute   Related Assertion
     * @see  getAttribute         Related Accessor
     * @see  verifyAttribute      Related Assertion
     * @see  waitForAttribute     Related Assertion
     * @see  waitForNotAttribute  Related Assertion
     */
    public function verifyNotAttribute($attributeLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the value of an element attribute. 
     * 
     * The value of the attribute may differ across browsers (this is the case for the "style" attribute, for example).
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the value of the specified attribute</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $attributeLocator  an element locator followed by an @ sign and then the name of the attribute,
     *                                    e.g.  "foo@bar"
     * @param string   $pattern           the String-match Patterns 
     *                                    (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAttribute       Base method, from which has been generated (automatically) current method
     * @see  assertAttribute      Related Assertion
     * @see  assertNotAttribute   Related Assertion
     * @see  getAttribute         Related Accessor
     * @see  verifyAttribute      Related Assertion
     * @see  verifyNotAttribute   Related Assertion
     * @see  waitForNotAttribute  Related Assertion
     */
    public function waitForAttribute($attributeLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the value of an element attribute. 
     * 
     * The value of the attribute may differ across browsers (this is the case for the "style" attribute, for example).
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the value of the specified attribute</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $attributeLocator  an element locator followed by an @ sign and then the name of the attribute,
     *                                    e.g.  "foo@bar"
     * @param string   $pattern           the String-match Patterns 
     *                                    (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAttribute      Base method, from which has been generated (automatically) current method
     * @see  assertAttribute     Related Assertion
     * @see  assertNotAttribute  Related Assertion
     * @see  getAttribute        Related Accessor
     * @see  verifyAttribute     Related Assertion
     * @see  verifyNotAttribute  Related Assertion
     * @see  waitForAttribute    Related Assertion
     */
    public function waitForNotAttribute($attributeLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns an array of JavaScript property values from all known windows having one.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the set of values of this attribute from all known windows.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyAttributeFromAllWindows}).</p>
     * 
     * @param string   $attributeName  name of an attribute on the windows
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAttributeFromAllWindows       Base method, from which has been generated (automatically) current
     *                                          method
     * @see  assertNotAttributeFromAllWindows   Related Assertion
     * @see  getAttributeFromAllWindows         Related Accessor
     * @see  verifyAttributeFromAllWindows      Related Assertion
     * @see  verifyNotAttributeFromAllWindows   Related Assertion
     * @see  waitForAttributeFromAllWindows     Related Assertion
     * @see  waitForNotAttributeFromAllWindows  Related Assertion
     */
    public function assertAttributeFromAllWindows($attributeName, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns an array of JavaScript property values from all known windows having one.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the set of values of this attribute from all known windows.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotAttributeFromAllWindows}).</p>
     * 
     * @param string   $attributeName  name of an attribute on the windows
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAttributeFromAllWindows       Base method, from which has been generated (automatically) current
     *                                          method
     * @see  assertAttributeFromAllWindows      Related Assertion
     * @see  getAttributeFromAllWindows         Related Accessor
     * @see  verifyAttributeFromAllWindows      Related Assertion
     * @see  verifyNotAttributeFromAllWindows   Related Assertion
     * @see  waitForAttributeFromAllWindows     Related Assertion
     * @see  waitForNotAttributeFromAllWindows  Related Assertion
     */
    public function assertNotAttributeFromAllWindows($attributeName, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Returns an array of JavaScript property values from all known windows having one.
     * 
     * @param string   $attributeName  name of an attribute on the windows
     * 
     * @return  string[]  the set of values of this attribute from all known windows.
     * 
     * @see  storeAttributeFromAllWindows       Base method, from which has been generated (automatically) current
     *                                          method
     * @see  assertAttributeFromAllWindows      Related Assertion
     * @see  assertNotAttributeFromAllWindows   Related Assertion
     * @see  verifyAttributeFromAllWindows      Related Assertion
     * @see  verifyNotAttributeFromAllWindows   Related Assertion
     * @see  waitForAttributeFromAllWindows     Related Assertion
     * @see  waitForNotAttributeFromAllWindows  Related Assertion
     */
    public function getAttributeFromAllWindows($attributeName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Returns an array of JavaScript property values from all known windows having one.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>the set of values of this attribute from all known windows. (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $attributeName  name of an attribute on the windows
     * @param string   $variableName   the name of a variable in which the result is to be stored. (see
     *                                 {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertAttributeFromAllWindows      Related Assertion
     * @see  assertNotAttributeFromAllWindows   Related Assertion
     * @see  getAttributeFromAllWindows         Related Accessor
     * @see  verifyAttributeFromAllWindows      Related Assertion
     * @see  verifyNotAttributeFromAllWindows   Related Assertion
     * @see  waitForAttributeFromAllWindows     Related Assertion
     * @see  waitForNotAttributeFromAllWindows  Related Assertion
     */
    public function storeAttributeFromAllWindows($attributeName, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns an array of JavaScript property values from all known windows having one.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the set of values of this attribute from all known windows.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertAttributeFromAllWindows}).</p>
     * 
     * @param string   $attributeName  name of an attribute on the windows
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAttributeFromAllWindows       Base method, from which has been generated (automatically) current
     *                                          method
     * @see  assertAttributeFromAllWindows      Related Assertion
     * @see  assertNotAttributeFromAllWindows   Related Assertion
     * @see  getAttributeFromAllWindows         Related Accessor
     * @see  verifyNotAttributeFromAllWindows   Related Assertion
     * @see  waitForAttributeFromAllWindows     Related Assertion
     * @see  waitForNotAttributeFromAllWindows  Related Assertion
     */
    public function verifyAttributeFromAllWindows($attributeName, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns an array of JavaScript property values from all known windows having one.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the set of values of this attribute from all known windows.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotAttributeFromAllWindows}).</p>
     * 
     * @param string   $attributeName  name of an attribute on the windows
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAttributeFromAllWindows       Base method, from which has been generated (automatically) current
     *                                          method
     * @see  assertAttributeFromAllWindows      Related Assertion
     * @see  assertNotAttributeFromAllWindows   Related Assertion
     * @see  getAttributeFromAllWindows         Related Accessor
     * @see  verifyAttributeFromAllWindows      Related Assertion
     * @see  waitForAttributeFromAllWindows     Related Assertion
     * @see  waitForNotAttributeFromAllWindows  Related Assertion
     */
    public function verifyNotAttributeFromAllWindows($attributeName, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns an array of JavaScript property values from all known windows having one.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the set of values of this attribute from all known windows.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $attributeName  name of an attribute on the windows
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAttributeFromAllWindows       Base method, from which has been generated (automatically) current
     *                                          method
     * @see  assertAttributeFromAllWindows      Related Assertion
     * @see  assertNotAttributeFromAllWindows   Related Assertion
     * @see  getAttributeFromAllWindows         Related Accessor
     * @see  verifyAttributeFromAllWindows      Related Assertion
     * @see  verifyNotAttributeFromAllWindows   Related Assertion
     * @see  waitForNotAttributeFromAllWindows  Related Assertion
     */
    public function waitForAttributeFromAllWindows($attributeName, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns an array of JavaScript property values from all known windows having one.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the set of values of this attribute from all known windows.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $attributeName  name of an attribute on the windows
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeAttributeFromAllWindows      Base method, from which has been generated (automatically) current
     *                                         method
     * @see  assertAttributeFromAllWindows     Related Assertion
     * @see  assertNotAttributeFromAllWindows  Related Assertion
     * @see  getAttributeFromAllWindows        Related Accessor
     * @see  verifyAttributeFromAllWindows     Related Assertion
     * @see  verifyNotAttributeFromAllWindows  Related Assertion
     * @see  waitForAttributeFromAllWindows    Related Assertion
     */
    public function waitForNotAttributeFromAllWindows($attributeName, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the entire text of the page.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the entire text of the page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyBodyText}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeBodyText       Base method, from which has been generated (automatically) current method
     * @see  assertNotBodyText   Related Assertion
     * @see  getBodyText         Related Accessor
     * @see  verifyBodyText      Related Assertion
     * @see  verifyNotBodyText   Related Assertion
     * @see  waitForBodyText     Related Assertion
     * @see  waitForNotBodyText  Related Assertion
     */
    public function assertBodyText($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the entire text of the page.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the entire text of the page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotBodyText}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeBodyText       Base method, from which has been generated (automatically) current method
     * @see  assertBodyText      Related Assertion
     * @see  getBodyText         Related Accessor
     * @see  verifyBodyText      Related Assertion
     * @see  verifyNotBodyText   Related Assertion
     * @see  waitForBodyText     Related Assertion
     * @see  waitForNotBodyText  Related Assertion
     */
    public function assertNotBodyText($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets the entire text of the page.
     * 
     * @return  string  the entire text of the page
     * 
     * @see  storeBodyText       Base method, from which has been generated (automatically) current method
     * @see  assertBodyText      Related Assertion
     * @see  assertNotBodyText   Related Assertion
     * @see  verifyBodyText      Related Assertion
     * @see  verifyNotBodyText   Related Assertion
     * @see  waitForBodyText     Related Assertion
     * @see  waitForNotBodyText  Related Assertion
     */
    public function getBodyText()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets the entire text of the page.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>the entire text of the page (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $variableName  the name of a variable in which the result is to be stored (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertBodyText      Related Assertion
     * @see  assertNotBodyText   Related Assertion
     * @see  getBodyText         Related Accessor
     * @see  verifyBodyText      Related Assertion
     * @see  verifyNotBodyText   Related Assertion
     * @see  waitForBodyText     Related Assertion
     * @see  waitForNotBodyText  Related Assertion
     */
    public function storeBodyText($variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the entire text of the page.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the entire text of the page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertBodyText}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeBodyText       Base method, from which has been generated (automatically) current method
     * @see  assertBodyText      Related Assertion
     * @see  assertNotBodyText   Related Assertion
     * @see  getBodyText         Related Accessor
     * @see  verifyNotBodyText   Related Assertion
     * @see  waitForBodyText     Related Assertion
     * @see  waitForNotBodyText  Related Assertion
     */
    public function verifyBodyText($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the entire text of the page.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the entire text of the page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotBodyText}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeBodyText       Base method, from which has been generated (automatically) current method
     * @see  assertBodyText      Related Assertion
     * @see  assertNotBodyText   Related Assertion
     * @see  getBodyText         Related Accessor
     * @see  verifyBodyText      Related Assertion
     * @see  waitForBodyText     Related Assertion
     * @see  waitForNotBodyText  Related Assertion
     */
    public function verifyNotBodyText($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the entire text of the page.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the entire text of the page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeBodyText       Base method, from which has been generated (automatically) current method
     * @see  assertBodyText      Related Assertion
     * @see  assertNotBodyText   Related Assertion
     * @see  getBodyText         Related Accessor
     * @see  verifyBodyText      Related Assertion
     * @see  verifyNotBodyText   Related Assertion
     * @see  waitForNotBodyText  Related Assertion
     */
    public function waitForBodyText($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the entire text of the page.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the entire text of the page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeBodyText      Base method, from which has been generated (automatically) current method
     * @see  assertBodyText     Related Assertion
     * @see  assertNotBodyText  Related Assertion
     * @see  getBodyText        Related Accessor
     * @see  verifyBodyText     Related Assertion
     * @see  verifyNotBodyText  Related Assertion
     * @see  waitForBodyText    Related Assertion
     */
    public function waitForNotBodyText($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets whether a toggle-button (checkbox/radio) is checked. 
     * 
     * Fails if the specified element doesn't exist or isn't a toggle-button.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if the checkbox is checked, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyChecked}).</p>
     * 
     * @param string   $locator  an element locator pointing to a checkbox or radio button (see
     *                           {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeChecked       Base method, from which has been generated (automatically) current method
     * @see  assertNotChecked   Related Assertion
     * @see  isChecked          Related Accessor
     * @see  verifyChecked      Related Assertion
     * @see  verifyNotChecked   Related Assertion
     * @see  waitForChecked     Related Assertion
     * @see  waitForNotChecked  Related Assertion
     */
    public function assertChecked($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets whether a toggle-button (checkbox/radio) is checked. 
     * 
     * Fails if the specified element doesn't exist or isn't a toggle-button.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if the checkbox is checked, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotChecked}).</p>
     * 
     * @param string   $locator  an element locator pointing to a checkbox or radio button (see
     *                           {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeChecked       Base method, from which has been generated (automatically) current method
     * @see  assertChecked      Related Assertion
     * @see  isChecked          Related Accessor
     * @see  verifyChecked      Related Assertion
     * @see  verifyNotChecked   Related Assertion
     * @see  waitForChecked     Related Assertion
     * @see  waitForNotChecked  Related Assertion
     */
    public function assertNotChecked($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets whether a toggle-button (checkbox/radio) is checked. 
     * 
     * Fails if the specified element doesn't exist or isn't a toggle-button.
     * 
     * @param string   $locator  an element locator pointing to a checkbox or radio button (see
     *                           {@link doc_Element_Locators})
     * 
     * @return  bool  true if the checkbox is checked, false otherwise
     * 
     * @see  storeChecked       Base method, from which has been generated (automatically) current method
     * @see  assertChecked      Related Assertion
     * @see  assertNotChecked   Related Assertion
     * @see  verifyChecked      Related Assertion
     * @see  verifyNotChecked   Related Assertion
     * @see  waitForChecked     Related Assertion
     * @see  waitForNotChecked  Related Assertion
     */
    public function isChecked($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets whether a toggle-button (checkbox/radio) is checked. 
     * 
     * Fails if the specified element doesn't exist or isn't a toggle-button.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>true if the checkbox is checked, false otherwise (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $locator       an element locator pointing to a checkbox or radio button (see
     *                                {@link doc_Element_Locators})
     * @param string   $variableName  the name of a variable in which the result is to be stored. (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertChecked      Related Assertion
     * @see  assertNotChecked   Related Assertion
     * @see  isChecked          Related Accessor
     * @see  verifyChecked      Related Assertion
     * @see  verifyNotChecked   Related Assertion
     * @see  waitForChecked     Related Assertion
     * @see  waitForNotChecked  Related Assertion
     */
    public function storeChecked($locator, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets whether a toggle-button (checkbox/radio) is checked. 
     * 
     * Fails if the specified element doesn't exist or isn't a toggle-button.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if the checkbox is checked, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertChecked}).</p>
     * 
     * @param string   $locator  an element locator pointing to a checkbox or radio button (see
     *                           {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeChecked       Base method, from which has been generated (automatically) current method
     * @see  assertChecked      Related Assertion
     * @see  assertNotChecked   Related Assertion
     * @see  isChecked          Related Accessor
     * @see  verifyNotChecked   Related Assertion
     * @see  waitForChecked     Related Assertion
     * @see  waitForNotChecked  Related Assertion
     */
    public function verifyChecked($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets whether a toggle-button (checkbox/radio) is checked. 
     * 
     * Fails if the specified element doesn't exist or isn't a toggle-button.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if the checkbox is checked, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotChecked}).</p>
     * 
     * @param string   $locator  an element locator pointing to a checkbox or radio button (see
     *                           {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeChecked       Base method, from which has been generated (automatically) current method
     * @see  assertChecked      Related Assertion
     * @see  assertNotChecked   Related Assertion
     * @see  isChecked          Related Accessor
     * @see  verifyChecked      Related Assertion
     * @see  waitForChecked     Related Assertion
     * @see  waitForNotChecked  Related Assertion
     */
    public function verifyNotChecked($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets whether a toggle-button (checkbox/radio) is checked. 
     * 
     * Fails if the specified element doesn't exist or isn't a toggle-button.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>true if the checkbox is checked, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $locator  an element locator pointing to a checkbox or radio button (see
     *                           {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeChecked       Base method, from which has been generated (automatically) current method
     * @see  assertChecked      Related Assertion
     * @see  assertNotChecked   Related Assertion
     * @see  isChecked          Related Accessor
     * @see  verifyChecked      Related Assertion
     * @see  verifyNotChecked   Related Assertion
     * @see  waitForNotChecked  Related Assertion
     */
    public function waitForChecked($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets whether a toggle-button (checkbox/radio) is checked. 
     * 
     * Fails if the specified element doesn't exist or isn't a toggle-button.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>true if the checkbox is checked, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $locator  an element locator pointing to a checkbox or radio button (see
     *                           {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeChecked      Base method, from which has been generated (automatically) current method
     * @see  assertChecked     Related Assertion
     * @see  assertNotChecked  Related Assertion
     * @see  isChecked         Related Accessor
     * @see  verifyChecked     Related Assertion
     * @see  verifyNotChecked  Related Assertion
     * @see  waitForChecked    Related Assertion
     */
    public function waitForNotChecked($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the message of a JavaScript confirmation dialog generated during the previous action. 
     * 
     * <p> By default, the confirm function will return true, having the same effect as manually clicking OK. This can
     * be changed by prior execution of the chooseCancelOnNextConfirmation command. </p>
     * 
     * <p> If an confirmation is generated but you do not consume it with getConfirmation, the next Selenium action
     * will fail. </p>
     * 
     * <p> NOTE: under Selenium, JavaScript confirmations will NOT pop up a visible dialog. </p>
     * 
     * <p> NOTE: Selenium does NOT support JavaScript confirmations that are generated in a page's onload() event
     * handler. In this case a visible dialog WILL be generated and Selenium will hang until you manually click OK.
     * </p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the message of the most recent JavaScript confirmation dialog</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyConfirmation}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeConfirmation       Base method, from which has been generated (automatically) current method
     * @see  assertNotConfirmation   Related Assertion
     * @see  getConfirmation         Related Accessor
     * @see  verifyConfirmation      Related Assertion
     * @see  verifyNotConfirmation   Related Assertion
     * @see  waitForConfirmation     Related Assertion
     * @see  waitForNotConfirmation  Related Assertion
     */
    public function assertConfirmation($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the message of a JavaScript confirmation dialog generated during the previous action. 
     * 
     * <p> By default, the confirm function will return true, having the same effect as manually clicking OK. This can
     * be changed by prior execution of the chooseCancelOnNextConfirmation command. </p>
     * 
     * <p> If an confirmation is generated but you do not consume it with getConfirmation, the next Selenium action
     * will fail. </p>
     * 
     * <p> NOTE: under Selenium, JavaScript confirmations will NOT pop up a visible dialog. </p>
     * 
     * <p> NOTE: Selenium does NOT support JavaScript confirmations that are generated in a page's onload() event
     * handler. In this case a visible dialog WILL be generated and Selenium will hang until you manually click OK.
     * </p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the message of the most recent JavaScript confirmation dialog</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotConfirmation}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeConfirmation       Base method, from which has been generated (automatically) current method
     * @see  assertConfirmation      Related Assertion
     * @see  getConfirmation         Related Accessor
     * @see  verifyConfirmation      Related Assertion
     * @see  verifyNotConfirmation   Related Assertion
     * @see  waitForConfirmation     Related Assertion
     * @see  waitForNotConfirmation  Related Assertion
     */
    public function assertNotConfirmation($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Retrieves the message of a JavaScript confirmation dialog generated during the previous action. 
     * 
     * <p> By default, the confirm function will return true, having the same effect as manually clicking OK. This can
     * be changed by prior execution of the chooseCancelOnNextConfirmation command. </p>
     * 
     * <p> If an confirmation is generated but you do not consume it with getConfirmation, the next Selenium action
     * will fail. </p>
     * 
     * <p> NOTE: under Selenium, JavaScript confirmations will NOT pop up a visible dialog. </p>
     * 
     * <p> NOTE: Selenium does NOT support JavaScript confirmations that are generated in a page's onload() event
     * handler. In this case a visible dialog WILL be generated and Selenium will hang until you manually click OK.
     * </p>
     * 
     * @return  string  the message of the most recent JavaScript confirmation dialog
     * 
     * @see  storeConfirmation       Base method, from which has been generated (automatically) current method
     * @see  assertConfirmation      Related Assertion
     * @see  assertNotConfirmation   Related Assertion
     * @see  verifyConfirmation      Related Assertion
     * @see  verifyNotConfirmation   Related Assertion
     * @see  waitForConfirmation     Related Assertion
     * @see  waitForNotConfirmation  Related Assertion
     */
    public function getConfirmation()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Retrieves the message of a JavaScript confirmation dialog generated during the previous action. 
     * 
     * <p> By default, the confirm function will return true, having the same effect as manually clicking OK. This can
     * be changed by prior execution of the chooseCancelOnNextConfirmation command. </p>
     * 
     * <p> If an confirmation is generated but you do not consume it with getConfirmation, the next Selenium action
     * will fail. </p>
     * 
     * <p> NOTE: under Selenium, JavaScript confirmations will NOT pop up a visible dialog. </p>
     * 
     * <p> NOTE: Selenium does NOT support JavaScript confirmations that are generated in a page's onload() event
     * handler. In this case a visible dialog WILL be generated and Selenium will hang until you manually click OK.
     * </p>
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>the message of the most recent JavaScript confirmation dialog (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $variableName  the name of a variable in which the result is to be stored (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertConfirmation      Related Assertion
     * @see  assertNotConfirmation   Related Assertion
     * @see  getConfirmation         Related Accessor
     * @see  verifyConfirmation      Related Assertion
     * @see  verifyNotConfirmation   Related Assertion
     * @see  waitForConfirmation     Related Assertion
     * @see  waitForNotConfirmation  Related Assertion
     */
    public function storeConfirmation($variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the message of a JavaScript confirmation dialog generated during the previous action. 
     * 
     * <p> By default, the confirm function will return true, having the same effect as manually clicking OK. This can
     * be changed by prior execution of the chooseCancelOnNextConfirmation command. </p>
     * 
     * <p> If an confirmation is generated but you do not consume it with getConfirmation, the next Selenium action
     * will fail. </p>
     * 
     * <p> NOTE: under Selenium, JavaScript confirmations will NOT pop up a visible dialog. </p>
     * 
     * <p> NOTE: Selenium does NOT support JavaScript confirmations that are generated in a page's onload() event
     * handler. In this case a visible dialog WILL be generated and Selenium will hang until you manually click OK.
     * </p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the message of the most recent JavaScript confirmation dialog</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertConfirmation}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeConfirmation       Base method, from which has been generated (automatically) current method
     * @see  assertConfirmation      Related Assertion
     * @see  assertNotConfirmation   Related Assertion
     * @see  getConfirmation         Related Accessor
     * @see  verifyNotConfirmation   Related Assertion
     * @see  waitForConfirmation     Related Assertion
     * @see  waitForNotConfirmation  Related Assertion
     */
    public function verifyConfirmation($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the message of a JavaScript confirmation dialog generated during the previous action. 
     * 
     * <p> By default, the confirm function will return true, having the same effect as manually clicking OK. This can
     * be changed by prior execution of the chooseCancelOnNextConfirmation command. </p>
     * 
     * <p> If an confirmation is generated but you do not consume it with getConfirmation, the next Selenium action
     * will fail. </p>
     * 
     * <p> NOTE: under Selenium, JavaScript confirmations will NOT pop up a visible dialog. </p>
     * 
     * <p> NOTE: Selenium does NOT support JavaScript confirmations that are generated in a page's onload() event
     * handler. In this case a visible dialog WILL be generated and Selenium will hang until you manually click OK.
     * </p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the message of the most recent JavaScript confirmation dialog</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotConfirmation}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeConfirmation       Base method, from which has been generated (automatically) current method
     * @see  assertConfirmation      Related Assertion
     * @see  assertNotConfirmation   Related Assertion
     * @see  getConfirmation         Related Accessor
     * @see  verifyConfirmation      Related Assertion
     * @see  waitForConfirmation     Related Assertion
     * @see  waitForNotConfirmation  Related Assertion
     */
    public function verifyNotConfirmation($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the message of a JavaScript confirmation dialog generated during the previous action. 
     * 
     * <p> By default, the confirm function will return true, having the same effect as manually clicking OK. This can
     * be changed by prior execution of the chooseCancelOnNextConfirmation command. </p>
     * 
     * <p> If an confirmation is generated but you do not consume it with getConfirmation, the next Selenium action
     * will fail. </p>
     * 
     * <p> NOTE: under Selenium, JavaScript confirmations will NOT pop up a visible dialog. </p>
     * 
     * <p> NOTE: Selenium does NOT support JavaScript confirmations that are generated in a page's onload() event
     * handler. In this case a visible dialog WILL be generated and Selenium will hang until you manually click OK.
     * </p>
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the message of the most recent JavaScript confirmation dialog</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeConfirmation       Base method, from which has been generated (automatically) current method
     * @see  assertConfirmation      Related Assertion
     * @see  assertNotConfirmation   Related Assertion
     * @see  getConfirmation         Related Accessor
     * @see  verifyConfirmation      Related Assertion
     * @see  verifyNotConfirmation   Related Assertion
     * @see  waitForNotConfirmation  Related Assertion
     */
    public function waitForConfirmation($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the message of a JavaScript confirmation dialog generated during the previous action. 
     * 
     * <p> By default, the confirm function will return true, having the same effect as manually clicking OK. This can
     * be changed by prior execution of the chooseCancelOnNextConfirmation command. </p>
     * 
     * <p> If an confirmation is generated but you do not consume it with getConfirmation, the next Selenium action
     * will fail. </p>
     * 
     * <p> NOTE: under Selenium, JavaScript confirmations will NOT pop up a visible dialog. </p>
     * 
     * <p> NOTE: Selenium does NOT support JavaScript confirmations that are generated in a page's onload() event
     * handler. In this case a visible dialog WILL be generated and Selenium will hang until you manually click OK.
     * </p>
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the message of the most recent JavaScript confirmation dialog</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeConfirmation      Base method, from which has been generated (automatically) current method
     * @see  assertConfirmation     Related Assertion
     * @see  assertNotConfirmation  Related Assertion
     * @see  getConfirmation        Related Accessor
     * @see  verifyConfirmation     Related Assertion
     * @see  verifyNotConfirmation  Related Assertion
     * @see  waitForConfirmation    Related Assertion
     */
    public function waitForNotConfirmation($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Has confirm() been called? 
     * 
     * <p> This function never throws an exception </p>.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if there is a pending confirmation</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyConfirmationNotPresent}).</p>
     * 
     * @return  void
     * 
     * @see  storeConfirmationPresent       Base method, from which has been generated (automatically) current method
     * @see  assertConfirmationPresent      Related Assertion
     * @see  isConfirmationPresent          Related Accessor
     * @see  verifyConfirmationNotPresent   Related Assertion
     * @see  verifyConfirmationPresent      Related Assertion
     * @see  waitForConfirmationNotPresent  Related Assertion
     * @see  waitForConfirmationPresent     Related Assertion
     */
    public function assertConfirmationNotPresent()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Has confirm() been called? 
     * 
     * <p> This function never throws an exception </p>.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if there is a pending confirmation</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyConfirmationPresent}).</p>
     * 
     * @return  void
     * 
     * @see  storeConfirmationPresent       Base method, from which has been generated (automatically) current method
     * @see  assertConfirmationNotPresent   Related Assertion
     * @see  isConfirmationPresent          Related Accessor
     * @see  verifyConfirmationNotPresent   Related Assertion
     * @see  verifyConfirmationPresent      Related Assertion
     * @see  waitForConfirmationNotPresent  Related Assertion
     * @see  waitForConfirmationPresent     Related Assertion
     */
    public function assertConfirmationPresent()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Has confirm() been called? 
     * 
     * <p> This function never throws an exception </p>.
     * 
     * @return  bool  true if there is a pending confirmation
     * 
     * @see  storeConfirmationPresent       Base method, from which has been generated (automatically) current method
     * @see  assertConfirmationNotPresent   Related Assertion
     * @see  assertConfirmationPresent      Related Assertion
     * @see  verifyConfirmationNotPresent   Related Assertion
     * @see  verifyConfirmationPresent      Related Assertion
     * @see  waitForConfirmationNotPresent  Related Assertion
     * @see  waitForConfirmationPresent     Related Assertion
     */
    public function isConfirmationPresent()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Has confirm() been called? 
     * 
     * <p> This function never throws an exception </p>.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>true if there is a pending confirmation (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $variableName  the name of a variable in which the result is to be stored (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertConfirmationNotPresent   Related Assertion
     * @see  assertConfirmationPresent      Related Assertion
     * @see  isConfirmationPresent          Related Accessor
     * @see  verifyConfirmationNotPresent   Related Assertion
     * @see  verifyConfirmationPresent      Related Assertion
     * @see  waitForConfirmationNotPresent  Related Assertion
     * @see  waitForConfirmationPresent     Related Assertion
     */
    public function storeConfirmationPresent($variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Has confirm() been called? 
     * 
     * <p> This function never throws an exception </p>.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if there is a pending confirmation</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertConfirmationNotPresent}).</p>
     * 
     * @return  void
     * 
     * @see  storeConfirmationPresent       Base method, from which has been generated (automatically) current method
     * @see  assertConfirmationNotPresent   Related Assertion
     * @see  assertConfirmationPresent      Related Assertion
     * @see  isConfirmationPresent          Related Accessor
     * @see  verifyConfirmationPresent      Related Assertion
     * @see  waitForConfirmationNotPresent  Related Assertion
     * @see  waitForConfirmationPresent     Related Assertion
     */
    public function verifyConfirmationNotPresent()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Has confirm() been called? 
     * 
     * <p> This function never throws an exception </p>.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if there is a pending confirmation</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertConfirmationPresent}).</p>
     * 
     * @return  void
     * 
     * @see  storeConfirmationPresent       Base method, from which has been generated (automatically) current method
     * @see  assertConfirmationNotPresent   Related Assertion
     * @see  assertConfirmationPresent      Related Assertion
     * @see  isConfirmationPresent          Related Accessor
     * @see  verifyConfirmationNotPresent   Related Assertion
     * @see  waitForConfirmationNotPresent  Related Assertion
     * @see  waitForConfirmationPresent     Related Assertion
     */
    public function verifyConfirmationPresent()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Has confirm() been called? 
     * 
     * <p> This function never throws an exception </p>.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>true if there is a pending confirmation</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @return  void
     * 
     * @see  storeConfirmationPresent      Base method, from which has been generated (automatically) current method
     * @see  assertConfirmationNotPresent  Related Assertion
     * @see  assertConfirmationPresent     Related Assertion
     * @see  isConfirmationPresent         Related Accessor
     * @see  verifyConfirmationNotPresent  Related Assertion
     * @see  verifyConfirmationPresent     Related Assertion
     * @see  waitForConfirmationPresent    Related Assertion
     */
    public function waitForConfirmationNotPresent()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Has confirm() been called? 
     * 
     * <p> This function never throws an exception </p>.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>true if there is a pending confirmation</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @return  void
     * 
     * @see  storeConfirmationPresent       Base method, from which has been generated (automatically) current method
     * @see  assertConfirmationNotPresent   Related Assertion
     * @see  assertConfirmationPresent      Related Assertion
     * @see  isConfirmationPresent          Related Accessor
     * @see  verifyConfirmationNotPresent   Related Assertion
     * @see  verifyConfirmationPresent      Related Assertion
     * @see  waitForConfirmationNotPresent  Related Assertion
     */
    public function waitForConfirmationPresent()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Return all cookies of the current page under test.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>all cookies of the current page under test</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyCookie}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeCookie       Base method, from which has been generated (automatically) current method
     * @see  assertNotCookie   Related Assertion
     * @see  getCookie         Related Accessor
     * @see  verifyCookie      Related Assertion
     * @see  verifyNotCookie   Related Assertion
     * @see  waitForCookie     Related Assertion
     * @see  waitForNotCookie  Related Assertion
     */
    public function assertCookie($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Return all cookies of the current page under test.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>all cookies of the current page under test</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotCookie}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeCookie       Base method, from which has been generated (automatically) current method
     * @see  assertCookie      Related Assertion
     * @see  getCookie         Related Accessor
     * @see  verifyCookie      Related Assertion
     * @see  verifyNotCookie   Related Assertion
     * @see  waitForCookie     Related Assertion
     * @see  waitForNotCookie  Related Assertion
     */
    public function assertNotCookie($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Return all cookies of the current page under test.
     * 
     * @return  string  all cookies of the current page under test
     * 
     * @see  storeCookie       Base method, from which has been generated (automatically) current method
     * @see  assertCookie      Related Assertion
     * @see  assertNotCookie   Related Assertion
     * @see  verifyCookie      Related Assertion
     * @see  verifyNotCookie   Related Assertion
     * @see  waitForCookie     Related Assertion
     * @see  waitForNotCookie  Related Assertion
     */
    public function getCookie()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Return all cookies of the current page under test.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>all cookies of the current page under test (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $variableName  the name of a variable in which the result is to be stored (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertCookie      Related Assertion
     * @see  assertNotCookie   Related Assertion
     * @see  getCookie         Related Accessor
     * @see  verifyCookie      Related Assertion
     * @see  verifyNotCookie   Related Assertion
     * @see  waitForCookie     Related Assertion
     * @see  waitForNotCookie  Related Assertion
     */
    public function storeCookie($variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Return all cookies of the current page under test.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>all cookies of the current page under test</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertCookie}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeCookie       Base method, from which has been generated (automatically) current method
     * @see  assertCookie      Related Assertion
     * @see  assertNotCookie   Related Assertion
     * @see  getCookie         Related Accessor
     * @see  verifyNotCookie   Related Assertion
     * @see  waitForCookie     Related Assertion
     * @see  waitForNotCookie  Related Assertion
     */
    public function verifyCookie($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Return all cookies of the current page under test.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>all cookies of the current page under test</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotCookie}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeCookie       Base method, from which has been generated (automatically) current method
     * @see  assertCookie      Related Assertion
     * @see  assertNotCookie   Related Assertion
     * @see  getCookie         Related Accessor
     * @see  verifyCookie      Related Assertion
     * @see  waitForCookie     Related Assertion
     * @see  waitForNotCookie  Related Assertion
     */
    public function verifyNotCookie($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Return all cookies of the current page under test.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>all cookies of the current page under test</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeCookie       Base method, from which has been generated (automatically) current method
     * @see  assertCookie      Related Assertion
     * @see  assertNotCookie   Related Assertion
     * @see  getCookie         Related Accessor
     * @see  verifyCookie      Related Assertion
     * @see  verifyNotCookie   Related Assertion
     * @see  waitForNotCookie  Related Assertion
     */
    public function waitForCookie($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Return all cookies of the current page under test.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>all cookies of the current page under test</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeCookie      Base method, from which has been generated (automatically) current method
     * @see  assertCookie     Related Assertion
     * @see  assertNotCookie  Related Assertion
     * @see  getCookie        Related Accessor
     * @see  verifyCookie     Related Assertion
     * @see  verifyNotCookie  Related Assertion
     * @see  waitForCookie    Related Assertion
     */
    public function waitForNotCookie($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the value of the cookie with the specified name, or throws an error if the cookie is not
     * present.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the value of the cookie</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyCookieByName}).</p>
     * 
     * @param string   $name     the name of the cookie
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeCookieByName       Base method, from which has been generated (automatically) current method
     * @see  assertNotCookieByName   Related Assertion
     * @see  getCookieByName         Related Accessor
     * @see  verifyCookieByName      Related Assertion
     * @see  verifyNotCookieByName   Related Assertion
     * @see  waitForCookieByName     Related Assertion
     * @see  waitForNotCookieByName  Related Assertion
     */
    public function assertCookieByName($name, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the value of the cookie with the specified name, or throws an error if the cookie is not
     * present.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the value of the cookie</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotCookieByName}).</p>
     * 
     * @param string   $name     the name of the cookie
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeCookieByName       Base method, from which has been generated (automatically) current method
     * @see  assertCookieByName      Related Assertion
     * @see  getCookieByName         Related Accessor
     * @see  verifyCookieByName      Related Assertion
     * @see  verifyNotCookieByName   Related Assertion
     * @see  waitForCookieByName     Related Assertion
     * @see  waitForNotCookieByName  Related Assertion
     */
    public function assertNotCookieByName($name, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Returns the value of the cookie with the specified name, or throws an error if the cookie is not present.
     * 
     * @param string   $name  the name of the cookie
     * 
     * @return  string  the value of the cookie
     * 
     * @see  storeCookieByName       Base method, from which has been generated (automatically) current method
     * @see  assertCookieByName      Related Assertion
     * @see  assertNotCookieByName   Related Assertion
     * @see  verifyCookieByName      Related Assertion
     * @see  verifyNotCookieByName   Related Assertion
     * @see  waitForCookieByName     Related Assertion
     * @see  waitForNotCookieByName  Related Assertion
     */
    public function getCookieByName($name)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Returns the value of the cookie with the specified name, or throws an error if the cookie is not present.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>the value of the cookie (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $name          the name of the cookie
     * @param string   $variableName  the name of a variable in which the result is to be stored. (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertCookieByName      Related Assertion
     * @see  assertNotCookieByName   Related Assertion
     * @see  getCookieByName         Related Accessor
     * @see  verifyCookieByName      Related Assertion
     * @see  verifyNotCookieByName   Related Assertion
     * @see  waitForCookieByName     Related Assertion
     * @see  waitForNotCookieByName  Related Assertion
     */
    public function storeCookieByName($name, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the value of the cookie with the specified name, or throws an error if the cookie is not
     * present.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the value of the cookie</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertCookieByName}).</p>
     * 
     * @param string   $name     the name of the cookie
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeCookieByName       Base method, from which has been generated (automatically) current method
     * @see  assertCookieByName      Related Assertion
     * @see  assertNotCookieByName   Related Assertion
     * @see  getCookieByName         Related Accessor
     * @see  verifyNotCookieByName   Related Assertion
     * @see  waitForCookieByName     Related Assertion
     * @see  waitForNotCookieByName  Related Assertion
     */
    public function verifyCookieByName($name, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the value of the cookie with the specified name, or throws an error if the cookie is not
     * present.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the value of the cookie</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotCookieByName}).</p>
     * 
     * @param string   $name     the name of the cookie
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeCookieByName       Base method, from which has been generated (automatically) current method
     * @see  assertCookieByName      Related Assertion
     * @see  assertNotCookieByName   Related Assertion
     * @see  getCookieByName         Related Accessor
     * @see  verifyCookieByName      Related Assertion
     * @see  waitForCookieByName     Related Assertion
     * @see  waitForNotCookieByName  Related Assertion
     */
    public function verifyNotCookieByName($name, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the value of the cookie with the specified name, or throws an error if the cookie is not
     * present.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the value of the cookie</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $name     the name of the cookie
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeCookieByName       Base method, from which has been generated (automatically) current method
     * @see  assertCookieByName      Related Assertion
     * @see  assertNotCookieByName   Related Assertion
     * @see  getCookieByName         Related Accessor
     * @see  verifyCookieByName      Related Assertion
     * @see  verifyNotCookieByName   Related Assertion
     * @see  waitForNotCookieByName  Related Assertion
     */
    public function waitForCookieByName($name, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the value of the cookie with the specified name, or throws an error if the cookie is not
     * present.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the value of the cookie</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $name     the name of the cookie
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeCookieByName      Base method, from which has been generated (automatically) current method
     * @see  assertCookieByName     Related Assertion
     * @see  assertNotCookieByName  Related Assertion
     * @see  getCookieByName        Related Accessor
     * @see  verifyCookieByName     Related Assertion
     * @see  verifyNotCookieByName  Related Assertion
     * @see  waitForCookieByName    Related Assertion
     */
    public function waitForNotCookieByName($name, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns true if a cookie with the specified name is present, or false otherwise.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if a cookie with the specified name is present, or false otherwise.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyCookieNotPresent}).</p>
     * 
     * @param string   $name  the name of the cookie
     * 
     * @return  void
     * 
     * @see  storeCookiePresent       Base method, from which has been generated (automatically) current method
     * @see  assertCookiePresent      Related Assertion
     * @see  isCookiePresent          Related Accessor
     * @see  verifyCookieNotPresent   Related Assertion
     * @see  verifyCookiePresent      Related Assertion
     * @see  waitForCookieNotPresent  Related Assertion
     * @see  waitForCookiePresent     Related Assertion
     */
    public function assertCookieNotPresent($name)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns true if a cookie with the specified name is present, or false otherwise.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if a cookie with the specified name is present, or false otherwise.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyCookiePresent}).</p>
     * 
     * @param string   $name  the name of the cookie
     * 
     * @return  void
     * 
     * @see  storeCookiePresent       Base method, from which has been generated (automatically) current method
     * @see  assertCookieNotPresent   Related Assertion
     * @see  isCookiePresent          Related Accessor
     * @see  verifyCookieNotPresent   Related Assertion
     * @see  verifyCookiePresent      Related Assertion
     * @see  waitForCookieNotPresent  Related Assertion
     * @see  waitForCookiePresent     Related Assertion
     */
    public function assertCookiePresent($name)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Returns true if a cookie with the specified name is present, or false otherwise.
     * 
     * @param string   $name  the name of the cookie
     * 
     * @return  bool  true if a cookie with the specified name is present, or false otherwise.
     * 
     * @see  storeCookiePresent       Base method, from which has been generated (automatically) current method
     * @see  assertCookieNotPresent   Related Assertion
     * @see  assertCookiePresent      Related Assertion
     * @see  verifyCookieNotPresent   Related Assertion
     * @see  verifyCookiePresent      Related Assertion
     * @see  waitForCookieNotPresent  Related Assertion
     * @see  waitForCookiePresent     Related Assertion
     */
    public function isCookiePresent($name)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Returns true if a cookie with the specified name is present, or false otherwise.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>true if a cookie with the specified name is present, or false otherwise. (see
     * {@link doc_Stored_Variables})</p>
     * 
     * @param string   $name          the name of the cookie
     * @param string   $variableName  the name of a variable in which the result is to be stored. (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertCookieNotPresent   Related Assertion
     * @see  assertCookiePresent      Related Assertion
     * @see  isCookiePresent          Related Accessor
     * @see  verifyCookieNotPresent   Related Assertion
     * @see  verifyCookiePresent      Related Assertion
     * @see  waitForCookieNotPresent  Related Assertion
     * @see  waitForCookiePresent     Related Assertion
     */
    public function storeCookiePresent($name, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns true if a cookie with the specified name is present, or false otherwise.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if a cookie with the specified name is present, or false otherwise.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertCookieNotPresent}).</p>
     * 
     * @param string   $name  the name of the cookie
     * 
     * @return  void
     * 
     * @see  storeCookiePresent       Base method, from which has been generated (automatically) current method
     * @see  assertCookieNotPresent   Related Assertion
     * @see  assertCookiePresent      Related Assertion
     * @see  isCookiePresent          Related Accessor
     * @see  verifyCookiePresent      Related Assertion
     * @see  waitForCookieNotPresent  Related Assertion
     * @see  waitForCookiePresent     Related Assertion
     */
    public function verifyCookieNotPresent($name)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns true if a cookie with the specified name is present, or false otherwise.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if a cookie with the specified name is present, or false otherwise.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertCookiePresent}).</p>
     * 
     * @param string   $name  the name of the cookie
     * 
     * @return  void
     * 
     * @see  storeCookiePresent       Base method, from which has been generated (automatically) current method
     * @see  assertCookieNotPresent   Related Assertion
     * @see  assertCookiePresent      Related Assertion
     * @see  isCookiePresent          Related Accessor
     * @see  verifyCookieNotPresent   Related Assertion
     * @see  waitForCookieNotPresent  Related Assertion
     * @see  waitForCookiePresent     Related Assertion
     */
    public function verifyCookiePresent($name)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns true if a cookie with the specified name is present, or false otherwise.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>true if a cookie with the specified name is present, or false otherwise.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $name  the name of the cookie
     * 
     * @return  void
     * 
     * @see  storeCookiePresent      Base method, from which has been generated (automatically) current method
     * @see  assertCookieNotPresent  Related Assertion
     * @see  assertCookiePresent     Related Assertion
     * @see  isCookiePresent         Related Accessor
     * @see  verifyCookieNotPresent  Related Assertion
     * @see  verifyCookiePresent     Related Assertion
     * @see  waitForCookiePresent    Related Assertion
     */
    public function waitForCookieNotPresent($name)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns true if a cookie with the specified name is present, or false otherwise.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>true if a cookie with the specified name is present, or false otherwise.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $name  the name of the cookie
     * 
     * @return  void
     * 
     * @see  storeCookiePresent       Base method, from which has been generated (automatically) current method
     * @see  assertCookieNotPresent   Related Assertion
     * @see  assertCookiePresent      Related Assertion
     * @see  isCookiePresent          Related Accessor
     * @see  verifyCookieNotPresent   Related Assertion
     * @see  verifyCookiePresent      Related Assertion
     * @see  waitForCookieNotPresent  Related Assertion
     */
    public function waitForCookiePresent($name)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the text cursor position in the given input element or textarea; beware, this may not work
     * perfectly on all browsers. 
     * 
     * <p>Specifically, if the cursor/selection has been cleared by JavaScript, this command will tend to return the
     * position of the last location of the cursor, even though the cursor is now gone from the page. This is filed as
     * <a href="http://jira.openqa.org/browse/SEL-243">SEL-243</a>.</p> This method will fail if the specified element
     * isn't an input element or textarea, or there is no cursor in the element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the numerical position of the cursor in the field</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyCursorPosition}).</p>
     * 
     * @param string   $locator  an element locator pointing to an input element or textarea (see
     *                           {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeCursorPosition       Base method, from which has been generated (automatically) current method
     * @see  assertNotCursorPosition   Related Assertion
     * @see  getCursorPosition         Related Accessor
     * @see  verifyCursorPosition      Related Assertion
     * @see  verifyNotCursorPosition   Related Assertion
     * @see  waitForCursorPosition     Related Assertion
     * @see  waitForNotCursorPosition  Related Assertion
     */
    public function assertCursorPosition($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the text cursor position in the given input element or textarea; beware, this may not work
     * perfectly on all browsers. 
     * 
     * <p>Specifically, if the cursor/selection has been cleared by JavaScript, this command will tend to return the
     * position of the last location of the cursor, even though the cursor is now gone from the page. This is filed as
     * <a href="http://jira.openqa.org/browse/SEL-243">SEL-243</a>.</p> This method will fail if the specified element
     * isn't an input element or textarea, or there is no cursor in the element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the numerical position of the cursor in the field</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotCursorPosition}).</p>
     * 
     * @param string   $locator  an element locator pointing to an input element or textarea (see
     *                           {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeCursorPosition       Base method, from which has been generated (automatically) current method
     * @see  assertCursorPosition      Related Assertion
     * @see  getCursorPosition         Related Accessor
     * @see  verifyCursorPosition      Related Assertion
     * @see  verifyNotCursorPosition   Related Assertion
     * @see  waitForCursorPosition     Related Assertion
     * @see  waitForNotCursorPosition  Related Assertion
     */
    public function assertNotCursorPosition($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Retrieves the text cursor position in the given input element or textarea; beware, this may not work perfectly
     * on all browsers. 
     * 
     * <p>Specifically, if the cursor/selection has been cleared by JavaScript, this command will tend to return the
     * position of the last location of the cursor, even though the cursor is now gone from the page. This is filed as
     * <a href="http://jira.openqa.org/browse/SEL-243">SEL-243</a>.</p> This method will fail if the specified element
     * isn't an input element or textarea, or there is no cursor in the element.
     * 
     * @param string   $locator  an element locator pointing to an input element or textarea (see
     *                           {@link doc_Element_Locators})
     * 
     * @return  int  the numerical position of the cursor in the field
     * 
     * @see  storeCursorPosition       Base method, from which has been generated (automatically) current method
     * @see  assertCursorPosition      Related Assertion
     * @see  assertNotCursorPosition   Related Assertion
     * @see  verifyCursorPosition      Related Assertion
     * @see  verifyNotCursorPosition   Related Assertion
     * @see  waitForCursorPosition     Related Assertion
     * @see  waitForNotCursorPosition  Related Assertion
     */
    public function getCursorPosition($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Retrieves the text cursor position in the given input element or textarea; beware, this may not work perfectly
     * on all browsers. 
     * 
     * <p>Specifically, if the cursor/selection has been cleared by JavaScript, this command will tend to return the
     * position of the last location of the cursor, even though the cursor is now gone from the page. This is filed as
     * <a href="http://jira.openqa.org/browse/SEL-243">SEL-243</a>.</p> This method will fail if the specified element
     * isn't an input element or textarea, or there is no cursor in the element.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>the numerical position of the cursor in the field (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $locator       an element locator pointing to an input element or textarea (see
     *                                {@link doc_Element_Locators})
     * @param string   $variableName  the name of a variable in which the result is to be stored. (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertCursorPosition      Related Assertion
     * @see  assertNotCursorPosition   Related Assertion
     * @see  getCursorPosition         Related Accessor
     * @see  verifyCursorPosition      Related Assertion
     * @see  verifyNotCursorPosition   Related Assertion
     * @see  waitForCursorPosition     Related Assertion
     * @see  waitForNotCursorPosition  Related Assertion
     */
    public function storeCursorPosition($locator, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the text cursor position in the given input element or textarea; beware, this may not work
     * perfectly on all browsers. 
     * 
     * <p>Specifically, if the cursor/selection has been cleared by JavaScript, this command will tend to return the
     * position of the last location of the cursor, even though the cursor is now gone from the page. This is filed as
     * <a href="http://jira.openqa.org/browse/SEL-243">SEL-243</a>.</p> This method will fail if the specified element
     * isn't an input element or textarea, or there is no cursor in the element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the numerical position of the cursor in the field</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertCursorPosition}).</p>
     * 
     * @param string   $locator  an element locator pointing to an input element or textarea (see
     *                           {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeCursorPosition       Base method, from which has been generated (automatically) current method
     * @see  assertCursorPosition      Related Assertion
     * @see  assertNotCursorPosition   Related Assertion
     * @see  getCursorPosition         Related Accessor
     * @see  verifyNotCursorPosition   Related Assertion
     * @see  waitForCursorPosition     Related Assertion
     * @see  waitForNotCursorPosition  Related Assertion
     */
    public function verifyCursorPosition($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the text cursor position in the given input element or textarea; beware, this may not work
     * perfectly on all browsers. 
     * 
     * <p>Specifically, if the cursor/selection has been cleared by JavaScript, this command will tend to return the
     * position of the last location of the cursor, even though the cursor is now gone from the page. This is filed as
     * <a href="http://jira.openqa.org/browse/SEL-243">SEL-243</a>.</p> This method will fail if the specified element
     * isn't an input element or textarea, or there is no cursor in the element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the numerical position of the cursor in the field</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotCursorPosition}).</p>
     * 
     * @param string   $locator  an element locator pointing to an input element or textarea (see
     *                           {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeCursorPosition       Base method, from which has been generated (automatically) current method
     * @see  assertCursorPosition      Related Assertion
     * @see  assertNotCursorPosition   Related Assertion
     * @see  getCursorPosition         Related Accessor
     * @see  verifyCursorPosition      Related Assertion
     * @see  waitForCursorPosition     Related Assertion
     * @see  waitForNotCursorPosition  Related Assertion
     */
    public function verifyNotCursorPosition($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the text cursor position in the given input element or textarea; beware, this may not work
     * perfectly on all browsers. 
     * 
     * <p>Specifically, if the cursor/selection has been cleared by JavaScript, this command will tend to return the
     * position of the last location of the cursor, even though the cursor is now gone from the page. This is filed as
     * <a href="http://jira.openqa.org/browse/SEL-243">SEL-243</a>.</p> This method will fail if the specified element
     * isn't an input element or textarea, or there is no cursor in the element.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the numerical position of the cursor in the field</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $locator  an element locator pointing to an input element or textarea (see
     *                           {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeCursorPosition       Base method, from which has been generated (automatically) current method
     * @see  assertCursorPosition      Related Assertion
     * @see  assertNotCursorPosition   Related Assertion
     * @see  getCursorPosition         Related Accessor
     * @see  verifyCursorPosition      Related Assertion
     * @see  verifyNotCursorPosition   Related Assertion
     * @see  waitForNotCursorPosition  Related Assertion
     */
    public function waitForCursorPosition($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the text cursor position in the given input element or textarea; beware, this may not work
     * perfectly on all browsers. 
     * 
     * <p>Specifically, if the cursor/selection has been cleared by JavaScript, this command will tend to return the
     * position of the last location of the cursor, even though the cursor is now gone from the page. This is filed as
     * <a href="http://jira.openqa.org/browse/SEL-243">SEL-243</a>.</p> This method will fail if the specified element
     * isn't an input element or textarea, or there is no cursor in the element.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the numerical position of the cursor in the field</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $locator  an element locator pointing to an input element or textarea (see
     *                           {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeCursorPosition      Base method, from which has been generated (automatically) current method
     * @see  assertCursorPosition     Related Assertion
     * @see  assertNotCursorPosition  Related Assertion
     * @see  getCursorPosition        Related Accessor
     * @see  verifyCursorPosition     Related Assertion
     * @see  verifyNotCursorPosition  Related Assertion
     * @see  waitForCursorPosition    Related Assertion
     */
    public function waitForNotCursorPosition($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determines whether the specified input element is editable, ie hasn't been disabled. 
     * 
     * This method will fail if the specified element isn't an input element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if the input element is editable, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyEditable}).</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeEditable       Base method, from which has been generated (automatically) current method
     * @see  assertNotEditable   Related Assertion
     * @see  isEditable          Related Accessor
     * @see  verifyEditable      Related Assertion
     * @see  verifyNotEditable   Related Assertion
     * @see  waitForEditable     Related Assertion
     * @see  waitForNotEditable  Related Assertion
     */
    public function assertEditable($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determines whether the specified input element is editable, ie hasn't been disabled. 
     * 
     * This method will fail if the specified element isn't an input element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if the input element is editable, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotEditable}).</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeEditable       Base method, from which has been generated (automatically) current method
     * @see  assertEditable      Related Assertion
     * @see  isEditable          Related Accessor
     * @see  verifyEditable      Related Assertion
     * @see  verifyNotEditable   Related Assertion
     * @see  waitForEditable     Related Assertion
     * @see  waitForNotEditable  Related Assertion
     */
    public function assertNotEditable($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Determines whether the specified input element is editable, ie hasn't been disabled. 
     * 
     * This method will fail if the specified element isn't an input element.
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  bool  true if the input element is editable, false otherwise
     * 
     * @see  storeEditable       Base method, from which has been generated (automatically) current method
     * @see  assertEditable      Related Assertion
     * @see  assertNotEditable   Related Assertion
     * @see  verifyEditable      Related Assertion
     * @see  verifyNotEditable   Related Assertion
     * @see  waitForEditable     Related Assertion
     * @see  waitForNotEditable  Related Assertion
     */
    public function isEditable($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Determines whether the specified input element is editable, ie hasn't been disabled. 
     * 
     * This method will fail if the specified element isn't an input element.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>true if the input element is editable, false otherwise (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $locator       an element locator 
     *                                (see {@link doc_Element_Locators})
     * @param string   $variableName  the name of a variable in which the result is to be stored. (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertEditable      Related Assertion
     * @see  assertNotEditable   Related Assertion
     * @see  isEditable          Related Accessor
     * @see  verifyEditable      Related Assertion
     * @see  verifyNotEditable   Related Assertion
     * @see  waitForEditable     Related Assertion
     * @see  waitForNotEditable  Related Assertion
     */
    public function storeEditable($locator, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determines whether the specified input element is editable, ie hasn't been disabled. 
     * 
     * This method will fail if the specified element isn't an input element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if the input element is editable, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertEditable}).</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeEditable       Base method, from which has been generated (automatically) current method
     * @see  assertEditable      Related Assertion
     * @see  assertNotEditable   Related Assertion
     * @see  isEditable          Related Accessor
     * @see  verifyNotEditable   Related Assertion
     * @see  waitForEditable     Related Assertion
     * @see  waitForNotEditable  Related Assertion
     */
    public function verifyEditable($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determines whether the specified input element is editable, ie hasn't been disabled. 
     * 
     * This method will fail if the specified element isn't an input element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if the input element is editable, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotEditable}).</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeEditable       Base method, from which has been generated (automatically) current method
     * @see  assertEditable      Related Assertion
     * @see  assertNotEditable   Related Assertion
     * @see  isEditable          Related Accessor
     * @see  verifyEditable      Related Assertion
     * @see  waitForEditable     Related Assertion
     * @see  waitForNotEditable  Related Assertion
     */
    public function verifyNotEditable($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determines whether the specified input element is editable, ie hasn't been disabled. 
     * 
     * This method will fail if the specified element isn't an input element.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>true if the input element is editable, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeEditable       Base method, from which has been generated (automatically) current method
     * @see  assertEditable      Related Assertion
     * @see  assertNotEditable   Related Assertion
     * @see  isEditable          Related Accessor
     * @see  verifyEditable      Related Assertion
     * @see  verifyNotEditable   Related Assertion
     * @see  waitForNotEditable  Related Assertion
     */
    public function waitForEditable($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determines whether the specified input element is editable, ie hasn't been disabled. 
     * 
     * This method will fail if the specified element isn't an input element.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>true if the input element is editable, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeEditable      Base method, from which has been generated (automatically) current method
     * @see  assertEditable     Related Assertion
     * @see  assertNotEditable  Related Assertion
     * @see  isEditable         Related Accessor
     * @see  verifyEditable     Related Assertion
     * @see  verifyNotEditable  Related Assertion
     * @see  waitForEditable    Related Assertion
     */
    public function waitForNotEditable($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the height of an element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>height of an element in pixels</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyElementHeight}).</p>
     * 
     * @param string   $locator  an element locator pointing to an element 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementHeight       Base method, from which has been generated (automatically) current method
     * @see  assertNotElementHeight   Related Assertion
     * @see  getElementHeight         Related Accessor
     * @see  verifyElementHeight      Related Assertion
     * @see  verifyNotElementHeight   Related Assertion
     * @see  waitForElementHeight     Related Assertion
     * @see  waitForNotElementHeight  Related Assertion
     */
    public function assertElementHeight($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the height of an element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>height of an element in pixels</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotElementHeight}).</p>
     * 
     * @param string   $locator  an element locator pointing to an element 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementHeight       Base method, from which has been generated (automatically) current method
     * @see  assertElementHeight      Related Assertion
     * @see  getElementHeight         Related Accessor
     * @see  verifyElementHeight      Related Assertion
     * @see  verifyNotElementHeight   Related Assertion
     * @see  waitForElementHeight     Related Assertion
     * @see  waitForNotElementHeight  Related Assertion
     */
    public function assertNotElementHeight($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Retrieves the height of an element.
     * 
     * @param string   $locator  an element locator pointing to an element 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  int  height of an element in pixels
     * 
     * @see  storeElementHeight       Base method, from which has been generated (automatically) current method
     * @see  assertElementHeight      Related Assertion
     * @see  assertNotElementHeight   Related Assertion
     * @see  verifyElementHeight      Related Assertion
     * @see  verifyNotElementHeight   Related Assertion
     * @see  waitForElementHeight     Related Assertion
     * @see  waitForNotElementHeight  Related Assertion
     */
    public function getElementHeight($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Retrieves the height of an element.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>height of an element in pixels (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $locator       an element locator pointing to an element 
     *                                (see {@link doc_Element_Locators})
     * @param string   $variableName  the name of a variable in which the result is to be stored. (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertElementHeight      Related Assertion
     * @see  assertNotElementHeight   Related Assertion
     * @see  getElementHeight         Related Accessor
     * @see  verifyElementHeight      Related Assertion
     * @see  verifyNotElementHeight   Related Assertion
     * @see  waitForElementHeight     Related Assertion
     * @see  waitForNotElementHeight  Related Assertion
     */
    public function storeElementHeight($locator, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the height of an element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>height of an element in pixels</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertElementHeight}).</p>
     * 
     * @param string   $locator  an element locator pointing to an element 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementHeight       Base method, from which has been generated (automatically) current method
     * @see  assertElementHeight      Related Assertion
     * @see  assertNotElementHeight   Related Assertion
     * @see  getElementHeight         Related Accessor
     * @see  verifyNotElementHeight   Related Assertion
     * @see  waitForElementHeight     Related Assertion
     * @see  waitForNotElementHeight  Related Assertion
     */
    public function verifyElementHeight($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the height of an element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>height of an element in pixels</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotElementHeight}).</p>
     * 
     * @param string   $locator  an element locator pointing to an element 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementHeight       Base method, from which has been generated (automatically) current method
     * @see  assertElementHeight      Related Assertion
     * @see  assertNotElementHeight   Related Assertion
     * @see  getElementHeight         Related Accessor
     * @see  verifyElementHeight      Related Assertion
     * @see  waitForElementHeight     Related Assertion
     * @see  waitForNotElementHeight  Related Assertion
     */
    public function verifyNotElementHeight($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the height of an element.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>height of an element in pixels</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $locator  an element locator pointing to an element 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementHeight       Base method, from which has been generated (automatically) current method
     * @see  assertElementHeight      Related Assertion
     * @see  assertNotElementHeight   Related Assertion
     * @see  getElementHeight         Related Accessor
     * @see  verifyElementHeight      Related Assertion
     * @see  verifyNotElementHeight   Related Assertion
     * @see  waitForNotElementHeight  Related Assertion
     */
    public function waitForElementHeight($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the height of an element.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>height of an element in pixels</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $locator  an element locator pointing to an element 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementHeight      Base method, from which has been generated (automatically) current method
     * @see  assertElementHeight     Related Assertion
     * @see  assertNotElementHeight  Related Assertion
     * @see  getElementHeight        Related Accessor
     * @see  verifyElementHeight     Related Assertion
     * @see  verifyNotElementHeight  Related Assertion
     * @see  waitForElementHeight    Related Assertion
     */
    public function waitForNotElementHeight($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Get the relative index of an element to its parent (starting from 0). 
     * 
     * The comment node and empty text node will be ignored.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>of relative index of the element to its parent (starting from 0)</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyElementIndex}).</p>
     * 
     * @param string   $locator  an element locator pointing to an element 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementIndex       Base method, from which has been generated (automatically) current method
     * @see  assertNotElementIndex   Related Assertion
     * @see  getElementIndex         Related Accessor
     * @see  verifyElementIndex      Related Assertion
     * @see  verifyNotElementIndex   Related Assertion
     * @see  waitForElementIndex     Related Assertion
     * @see  waitForNotElementIndex  Related Assertion
     */
    public function assertElementIndex($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Get the relative index of an element to its parent (starting from 0). 
     * 
     * The comment node and empty text node will be ignored.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>of relative index of the element to its parent (starting from 0)</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotElementIndex}).</p>
     * 
     * @param string   $locator  an element locator pointing to an element 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementIndex       Base method, from which has been generated (automatically) current method
     * @see  assertElementIndex      Related Assertion
     * @see  getElementIndex         Related Accessor
     * @see  verifyElementIndex      Related Assertion
     * @see  verifyNotElementIndex   Related Assertion
     * @see  waitForElementIndex     Related Assertion
     * @see  waitForNotElementIndex  Related Assertion
     */
    public function assertNotElementIndex($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Get the relative index of an element to its parent (starting from 0). 
     * 
     * The comment node and empty text node will be ignored.
     * 
     * @param string   $locator  an element locator pointing to an element 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  int  of relative index of the element to its parent (starting from 0)
     * 
     * @see  storeElementIndex       Base method, from which has been generated (automatically) current method
     * @see  assertElementIndex      Related Assertion
     * @see  assertNotElementIndex   Related Assertion
     * @see  verifyElementIndex      Related Assertion
     * @see  verifyNotElementIndex   Related Assertion
     * @see  waitForElementIndex     Related Assertion
     * @see  waitForNotElementIndex  Related Assertion
     */
    public function getElementIndex($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Get the relative index of an element to its parent (starting from 0). 
     * 
     * The comment node and empty text node will be ignored.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>of relative index of the element to its parent (starting from 0) (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $locator       an element locator pointing to an element 
     *                                (see {@link doc_Element_Locators})
     * @param string   $variableName  the name of a variable in which the result is to be stored. (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertElementIndex      Related Assertion
     * @see  assertNotElementIndex   Related Assertion
     * @see  getElementIndex         Related Accessor
     * @see  verifyElementIndex      Related Assertion
     * @see  verifyNotElementIndex   Related Assertion
     * @see  waitForElementIndex     Related Assertion
     * @see  waitForNotElementIndex  Related Assertion
     */
    public function storeElementIndex($locator, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Get the relative index of an element to its parent (starting from 0). 
     * 
     * The comment node and empty text node will be ignored.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>of relative index of the element to its parent (starting from 0)</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertElementIndex}).</p>
     * 
     * @param string   $locator  an element locator pointing to an element 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementIndex       Base method, from which has been generated (automatically) current method
     * @see  assertElementIndex      Related Assertion
     * @see  assertNotElementIndex   Related Assertion
     * @see  getElementIndex         Related Accessor
     * @see  verifyNotElementIndex   Related Assertion
     * @see  waitForElementIndex     Related Assertion
     * @see  waitForNotElementIndex  Related Assertion
     */
    public function verifyElementIndex($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Get the relative index of an element to its parent (starting from 0). 
     * 
     * The comment node and empty text node will be ignored.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>of relative index of the element to its parent (starting from 0)</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotElementIndex}).</p>
     * 
     * @param string   $locator  an element locator pointing to an element 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementIndex       Base method, from which has been generated (automatically) current method
     * @see  assertElementIndex      Related Assertion
     * @see  assertNotElementIndex   Related Assertion
     * @see  getElementIndex         Related Accessor
     * @see  verifyElementIndex      Related Assertion
     * @see  waitForElementIndex     Related Assertion
     * @see  waitForNotElementIndex  Related Assertion
     */
    public function verifyNotElementIndex($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Get the relative index of an element to its parent (starting from 0). 
     * 
     * The comment node and empty text node will be ignored.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>of relative index of the element to its parent (starting from 0)</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $locator  an element locator pointing to an element 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementIndex       Base method, from which has been generated (automatically) current method
     * @see  assertElementIndex      Related Assertion
     * @see  assertNotElementIndex   Related Assertion
     * @see  getElementIndex         Related Accessor
     * @see  verifyElementIndex      Related Assertion
     * @see  verifyNotElementIndex   Related Assertion
     * @see  waitForNotElementIndex  Related Assertion
     */
    public function waitForElementIndex($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Get the relative index of an element to its parent (starting from 0). 
     * 
     * The comment node and empty text node will be ignored.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>of relative index of the element to its parent (starting from 0)</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $locator  an element locator pointing to an element 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementIndex      Base method, from which has been generated (automatically) current method
     * @see  assertElementIndex     Related Assertion
     * @see  assertNotElementIndex  Related Assertion
     * @see  getElementIndex        Related Accessor
     * @see  verifyElementIndex     Related Assertion
     * @see  verifyNotElementIndex  Related Assertion
     * @see  waitForElementIndex    Related Assertion
     */
    public function waitForNotElementIndex($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Verifies that the specified element is somewhere on the page.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if the element is present, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyElementNotPresent}).</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeElementPresent       Base method, from which has been generated (automatically) current method
     * @see  assertElementPresent      Related Assertion
     * @see  isElementPresent          Related Accessor
     * @see  verifyElementNotPresent   Related Assertion
     * @see  verifyElementPresent      Related Assertion
     * @see  waitForElementNotPresent  Related Assertion
     * @see  waitForElementPresent     Related Assertion
     */
    public function assertElementNotPresent($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Verifies that the specified element is somewhere on the page.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if the element is present, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyElementPresent}).</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeElementPresent       Base method, from which has been generated (automatically) current method
     * @see  assertElementNotPresent   Related Assertion
     * @see  isElementPresent          Related Accessor
     * @see  verifyElementNotPresent   Related Assertion
     * @see  verifyElementPresent      Related Assertion
     * @see  waitForElementNotPresent  Related Assertion
     * @see  waitForElementPresent     Related Assertion
     */
    public function assertElementPresent($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Verifies that the specified element is somewhere on the page.
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  bool  true if the element is present, false otherwise
     * 
     * @see  storeElementPresent       Base method, from which has been generated (automatically) current method
     * @see  assertElementNotPresent   Related Assertion
     * @see  assertElementPresent      Related Assertion
     * @see  verifyElementNotPresent   Related Assertion
     * @see  verifyElementPresent      Related Assertion
     * @see  waitForElementNotPresent  Related Assertion
     * @see  waitForElementPresent     Related Assertion
     */
    public function isElementPresent($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Verifies that the specified element is somewhere on the page.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>true if the element is present, false otherwise (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $locator       an element locator 
     *                                (see {@link doc_Element_Locators})
     * @param string   $variableName  the name of a variable in which the result is to be stored. (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertElementNotPresent   Related Assertion
     * @see  assertElementPresent      Related Assertion
     * @see  isElementPresent          Related Accessor
     * @see  verifyElementNotPresent   Related Assertion
     * @see  verifyElementPresent      Related Assertion
     * @see  waitForElementNotPresent  Related Assertion
     * @see  waitForElementPresent     Related Assertion
     */
    public function storeElementPresent($locator, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Verifies that the specified element is somewhere on the page.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if the element is present, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertElementNotPresent}).</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeElementPresent       Base method, from which has been generated (automatically) current method
     * @see  assertElementNotPresent   Related Assertion
     * @see  assertElementPresent      Related Assertion
     * @see  isElementPresent          Related Accessor
     * @see  verifyElementPresent      Related Assertion
     * @see  waitForElementNotPresent  Related Assertion
     * @see  waitForElementPresent     Related Assertion
     */
    public function verifyElementNotPresent($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Verifies that the specified element is somewhere on the page.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if the element is present, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertElementPresent}).</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeElementPresent       Base method, from which has been generated (automatically) current method
     * @see  assertElementNotPresent   Related Assertion
     * @see  assertElementPresent      Related Assertion
     * @see  isElementPresent          Related Accessor
     * @see  verifyElementNotPresent   Related Assertion
     * @see  waitForElementNotPresent  Related Assertion
     * @see  waitForElementPresent     Related Assertion
     */
    public function verifyElementPresent($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Verifies that the specified element is somewhere on the page.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>true if the element is present, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeElementPresent      Base method, from which has been generated (automatically) current method
     * @see  assertElementNotPresent  Related Assertion
     * @see  assertElementPresent     Related Assertion
     * @see  isElementPresent         Related Accessor
     * @see  verifyElementNotPresent  Related Assertion
     * @see  verifyElementPresent     Related Assertion
     * @see  waitForElementPresent    Related Assertion
     */
    public function waitForElementNotPresent($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Verifies that the specified element is somewhere on the page.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>true if the element is present, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeElementPresent       Base method, from which has been generated (automatically) current method
     * @see  assertElementNotPresent   Related Assertion
     * @see  assertElementPresent      Related Assertion
     * @see  isElementPresent          Related Accessor
     * @see  verifyElementNotPresent   Related Assertion
     * @see  verifyElementPresent      Related Assertion
     * @see  waitForElementNotPresent  Related Assertion
     */
    public function waitForElementPresent($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the horizontal position of an element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>of pixels from the edge of the frame.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyElementPositionLeft}).</p>
     * 
     * @param string   $locator  an element locator pointing to an element OR an element itself (see
     *                           {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementPositionLeft       Base method, from which has been generated (automatically) current method
     * @see  assertNotElementPositionLeft   Related Assertion
     * @see  getElementPositionLeft         Related Accessor
     * @see  verifyElementPositionLeft      Related Assertion
     * @see  verifyNotElementPositionLeft   Related Assertion
     * @see  waitForElementPositionLeft     Related Assertion
     * @see  waitForNotElementPositionLeft  Related Assertion
     */
    public function assertElementPositionLeft($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the horizontal position of an element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>of pixels from the edge of the frame.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotElementPositionLeft}).</p>
     * 
     * @param string   $locator  an element locator pointing to an element OR an element itself (see
     *                           {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementPositionLeft       Base method, from which has been generated (automatically) current method
     * @see  assertElementPositionLeft      Related Assertion
     * @see  getElementPositionLeft         Related Accessor
     * @see  verifyElementPositionLeft      Related Assertion
     * @see  verifyNotElementPositionLeft   Related Assertion
     * @see  waitForElementPositionLeft     Related Assertion
     * @see  waitForNotElementPositionLeft  Related Assertion
     */
    public function assertNotElementPositionLeft($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Retrieves the horizontal position of an element.
     * 
     * @param string   $locator  an element locator pointing to an element OR an element itself (see
     *                           {@link doc_Element_Locators})
     * 
     * @return  int  of pixels from the edge of the frame.
     * 
     * @see  storeElementPositionLeft       Base method, from which has been generated (automatically) current method
     * @see  assertElementPositionLeft      Related Assertion
     * @see  assertNotElementPositionLeft   Related Assertion
     * @see  verifyElementPositionLeft      Related Assertion
     * @see  verifyNotElementPositionLeft   Related Assertion
     * @see  waitForElementPositionLeft     Related Assertion
     * @see  waitForNotElementPositionLeft  Related Assertion
     */
    public function getElementPositionLeft($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Retrieves the horizontal position of an element.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>of pixels from the edge of the frame. (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $locator       an element locator pointing to an element OR an element itself (see
     *                                {@link doc_Element_Locators})
     * @param string   $variableName  the name of a variable in which the result is to be stored. (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertElementPositionLeft      Related Assertion
     * @see  assertNotElementPositionLeft   Related Assertion
     * @see  getElementPositionLeft         Related Accessor
     * @see  verifyElementPositionLeft      Related Assertion
     * @see  verifyNotElementPositionLeft   Related Assertion
     * @see  waitForElementPositionLeft     Related Assertion
     * @see  waitForNotElementPositionLeft  Related Assertion
     */
    public function storeElementPositionLeft($locator, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the horizontal position of an element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>of pixels from the edge of the frame.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertElementPositionLeft}).</p>
     * 
     * @param string   $locator  an element locator pointing to an element OR an element itself (see
     *                           {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementPositionLeft       Base method, from which has been generated (automatically) current method
     * @see  assertElementPositionLeft      Related Assertion
     * @see  assertNotElementPositionLeft   Related Assertion
     * @see  getElementPositionLeft         Related Accessor
     * @see  verifyNotElementPositionLeft   Related Assertion
     * @see  waitForElementPositionLeft     Related Assertion
     * @see  waitForNotElementPositionLeft  Related Assertion
     */
    public function verifyElementPositionLeft($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the horizontal position of an element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>of pixels from the edge of the frame.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotElementPositionLeft}).</p>
     * 
     * @param string   $locator  an element locator pointing to an element OR an element itself (see
     *                           {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementPositionLeft       Base method, from which has been generated (automatically) current method
     * @see  assertElementPositionLeft      Related Assertion
     * @see  assertNotElementPositionLeft   Related Assertion
     * @see  getElementPositionLeft         Related Accessor
     * @see  verifyElementPositionLeft      Related Assertion
     * @see  waitForElementPositionLeft     Related Assertion
     * @see  waitForNotElementPositionLeft  Related Assertion
     */
    public function verifyNotElementPositionLeft($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the horizontal position of an element.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>of pixels from the edge of the frame.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $locator  an element locator pointing to an element OR an element itself (see
     *                           {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementPositionLeft       Base method, from which has been generated (automatically) current method
     * @see  assertElementPositionLeft      Related Assertion
     * @see  assertNotElementPositionLeft   Related Assertion
     * @see  getElementPositionLeft         Related Accessor
     * @see  verifyElementPositionLeft      Related Assertion
     * @see  verifyNotElementPositionLeft   Related Assertion
     * @see  waitForNotElementPositionLeft  Related Assertion
     */
    public function waitForElementPositionLeft($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the horizontal position of an element.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>of pixels from the edge of the frame.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $locator  an element locator pointing to an element OR an element itself (see
     *                           {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementPositionLeft      Base method, from which has been generated (automatically) current method
     * @see  assertElementPositionLeft     Related Assertion
     * @see  assertNotElementPositionLeft  Related Assertion
     * @see  getElementPositionLeft        Related Accessor
     * @see  verifyElementPositionLeft     Related Assertion
     * @see  verifyNotElementPositionLeft  Related Assertion
     * @see  waitForElementPositionLeft    Related Assertion
     */
    public function waitForNotElementPositionLeft($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the vertical position of an element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>of pixels from the edge of the frame.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyElementPositionTop}).</p>
     * 
     * @param string   $locator  an element locator pointing to an element OR an element itself (see
     *                           {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementPositionTop       Base method, from which has been generated (automatically) current method
     * @see  assertNotElementPositionTop   Related Assertion
     * @see  getElementPositionTop         Related Accessor
     * @see  verifyElementPositionTop      Related Assertion
     * @see  verifyNotElementPositionTop   Related Assertion
     * @see  waitForElementPositionTop     Related Assertion
     * @see  waitForNotElementPositionTop  Related Assertion
     */
    public function assertElementPositionTop($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the vertical position of an element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>of pixels from the edge of the frame.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotElementPositionTop}).</p>
     * 
     * @param string   $locator  an element locator pointing to an element OR an element itself (see
     *                           {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementPositionTop       Base method, from which has been generated (automatically) current method
     * @see  assertElementPositionTop      Related Assertion
     * @see  getElementPositionTop         Related Accessor
     * @see  verifyElementPositionTop      Related Assertion
     * @see  verifyNotElementPositionTop   Related Assertion
     * @see  waitForElementPositionTop     Related Assertion
     * @see  waitForNotElementPositionTop  Related Assertion
     */
    public function assertNotElementPositionTop($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Retrieves the vertical position of an element.
     * 
     * @param string   $locator  an element locator pointing to an element OR an element itself (see
     *                           {@link doc_Element_Locators})
     * 
     * @return  int  of pixels from the edge of the frame.
     * 
     * @see  storeElementPositionTop       Base method, from which has been generated (automatically) current method
     * @see  assertElementPositionTop      Related Assertion
     * @see  assertNotElementPositionTop   Related Assertion
     * @see  verifyElementPositionTop      Related Assertion
     * @see  verifyNotElementPositionTop   Related Assertion
     * @see  waitForElementPositionTop     Related Assertion
     * @see  waitForNotElementPositionTop  Related Assertion
     */
    public function getElementPositionTop($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Retrieves the vertical position of an element.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>of pixels from the edge of the frame. (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $locator       an element locator pointing to an element OR an element itself (see
     *                                {@link doc_Element_Locators})
     * @param string   $variableName  the name of a variable in which the result is to be stored. (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertElementPositionTop      Related Assertion
     * @see  assertNotElementPositionTop   Related Assertion
     * @see  getElementPositionTop         Related Accessor
     * @see  verifyElementPositionTop      Related Assertion
     * @see  verifyNotElementPositionTop   Related Assertion
     * @see  waitForElementPositionTop     Related Assertion
     * @see  waitForNotElementPositionTop  Related Assertion
     */
    public function storeElementPositionTop($locator, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the vertical position of an element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>of pixels from the edge of the frame.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertElementPositionTop}).</p>
     * 
     * @param string   $locator  an element locator pointing to an element OR an element itself (see
     *                           {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementPositionTop       Base method, from which has been generated (automatically) current method
     * @see  assertElementPositionTop      Related Assertion
     * @see  assertNotElementPositionTop   Related Assertion
     * @see  getElementPositionTop         Related Accessor
     * @see  verifyNotElementPositionTop   Related Assertion
     * @see  waitForElementPositionTop     Related Assertion
     * @see  waitForNotElementPositionTop  Related Assertion
     */
    public function verifyElementPositionTop($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the vertical position of an element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>of pixels from the edge of the frame.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotElementPositionTop}).</p>
     * 
     * @param string   $locator  an element locator pointing to an element OR an element itself (see
     *                           {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementPositionTop       Base method, from which has been generated (automatically) current method
     * @see  assertElementPositionTop      Related Assertion
     * @see  assertNotElementPositionTop   Related Assertion
     * @see  getElementPositionTop         Related Accessor
     * @see  verifyElementPositionTop      Related Assertion
     * @see  waitForElementPositionTop     Related Assertion
     * @see  waitForNotElementPositionTop  Related Assertion
     */
    public function verifyNotElementPositionTop($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the vertical position of an element.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>of pixels from the edge of the frame.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $locator  an element locator pointing to an element OR an element itself (see
     *                           {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementPositionTop       Base method, from which has been generated (automatically) current method
     * @see  assertElementPositionTop      Related Assertion
     * @see  assertNotElementPositionTop   Related Assertion
     * @see  getElementPositionTop         Related Accessor
     * @see  verifyElementPositionTop      Related Assertion
     * @see  verifyNotElementPositionTop   Related Assertion
     * @see  waitForNotElementPositionTop  Related Assertion
     */
    public function waitForElementPositionTop($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the vertical position of an element.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>of pixels from the edge of the frame.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $locator  an element locator pointing to an element OR an element itself (see
     *                           {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementPositionTop      Base method, from which has been generated (automatically) current method
     * @see  assertElementPositionTop     Related Assertion
     * @see  assertNotElementPositionTop  Related Assertion
     * @see  getElementPositionTop        Related Accessor
     * @see  verifyElementPositionTop     Related Assertion
     * @see  verifyNotElementPositionTop  Related Assertion
     * @see  waitForElementPositionTop    Related Assertion
     */
    public function waitForNotElementPositionTop($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the width of an element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>width of an element in pixels</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyElementWidth}).</p>
     * 
     * @param string   $locator  an element locator pointing to an element 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementWidth       Base method, from which has been generated (automatically) current method
     * @see  assertNotElementWidth   Related Assertion
     * @see  getElementWidth         Related Accessor
     * @see  verifyElementWidth      Related Assertion
     * @see  verifyNotElementWidth   Related Assertion
     * @see  waitForElementWidth     Related Assertion
     * @see  waitForNotElementWidth  Related Assertion
     */
    public function assertElementWidth($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the width of an element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>width of an element in pixels</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotElementWidth}).</p>
     * 
     * @param string   $locator  an element locator pointing to an element 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementWidth       Base method, from which has been generated (automatically) current method
     * @see  assertElementWidth      Related Assertion
     * @see  getElementWidth         Related Accessor
     * @see  verifyElementWidth      Related Assertion
     * @see  verifyNotElementWidth   Related Assertion
     * @see  waitForElementWidth     Related Assertion
     * @see  waitForNotElementWidth  Related Assertion
     */
    public function assertNotElementWidth($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Retrieves the width of an element.
     * 
     * @param string   $locator  an element locator pointing to an element 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  int  width of an element in pixels
     * 
     * @see  storeElementWidth       Base method, from which has been generated (automatically) current method
     * @see  assertElementWidth      Related Assertion
     * @see  assertNotElementWidth   Related Assertion
     * @see  verifyElementWidth      Related Assertion
     * @see  verifyNotElementWidth   Related Assertion
     * @see  waitForElementWidth     Related Assertion
     * @see  waitForNotElementWidth  Related Assertion
     */
    public function getElementWidth($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Retrieves the width of an element.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>width of an element in pixels (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $locator       an element locator pointing to an element 
     *                                (see {@link doc_Element_Locators})
     * @param string   $variableName  the name of a variable in which the result is to be stored. (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertElementWidth      Related Assertion
     * @see  assertNotElementWidth   Related Assertion
     * @see  getElementWidth         Related Accessor
     * @see  verifyElementWidth      Related Assertion
     * @see  verifyNotElementWidth   Related Assertion
     * @see  waitForElementWidth     Related Assertion
     * @see  waitForNotElementWidth  Related Assertion
     */
    public function storeElementWidth($locator, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the width of an element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>width of an element in pixels</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertElementWidth}).</p>
     * 
     * @param string   $locator  an element locator pointing to an element 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementWidth       Base method, from which has been generated (automatically) current method
     * @see  assertElementWidth      Related Assertion
     * @see  assertNotElementWidth   Related Assertion
     * @see  getElementWidth         Related Accessor
     * @see  verifyNotElementWidth   Related Assertion
     * @see  waitForElementWidth     Related Assertion
     * @see  waitForNotElementWidth  Related Assertion
     */
    public function verifyElementWidth($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the width of an element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>width of an element in pixels</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotElementWidth}).</p>
     * 
     * @param string   $locator  an element locator pointing to an element 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementWidth       Base method, from which has been generated (automatically) current method
     * @see  assertElementWidth      Related Assertion
     * @see  assertNotElementWidth   Related Assertion
     * @see  getElementWidth         Related Accessor
     * @see  verifyElementWidth      Related Assertion
     * @see  waitForElementWidth     Related Assertion
     * @see  waitForNotElementWidth  Related Assertion
     */
    public function verifyNotElementWidth($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the width of an element.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>width of an element in pixels</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $locator  an element locator pointing to an element 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementWidth       Base method, from which has been generated (automatically) current method
     * @see  assertElementWidth      Related Assertion
     * @see  assertNotElementWidth   Related Assertion
     * @see  getElementWidth         Related Accessor
     * @see  verifyElementWidth      Related Assertion
     * @see  verifyNotElementWidth   Related Assertion
     * @see  waitForNotElementWidth  Related Assertion
     */
    public function waitForElementWidth($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the width of an element.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>width of an element in pixels</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $locator  an element locator pointing to an element 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeElementWidth      Base method, from which has been generated (automatically) current method
     * @see  assertElementWidth     Related Assertion
     * @see  assertNotElementWidth  Related Assertion
     * @see  getElementWidth        Related Accessor
     * @see  verifyElementWidth     Related Assertion
     * @see  verifyNotElementWidth  Related Assertion
     * @see  waitForElementWidth    Related Assertion
     */
    public function waitForNotElementWidth($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the result of evaluating the specified JavaScript snippet. 
     * 
     * The snippet may have multiple lines, but only the result of the last line will be returned.
     * 
     * <p>Note that, by default, the snippet will run in the context of the "selenium" object itself, so [<b>this</b>]
     * will refer to the Selenium object. Use [<b>window</b>] to refer to the window of your application, e.g.
     * [<b>window.document.getElementById('foo')</b>] </p>
     * 
     * <p>If you need to use a locator to refer to a single element in your application page, you can use
     * [<b>this.browserbot.findElement("id=foo")</b>] where "id=foo" is your locator.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the results of evaluating the snippet</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyEval}).</p>
     * 
     * @param string   $script   the JavaScript snippet to run
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeEval       Base method, from which has been generated (automatically) current method
     * @see  assertNotEval   Related Assertion
     * @see  getEval         Related Accessor
     * @see  verifyEval      Related Assertion
     * @see  verifyNotEval   Related Assertion
     * @see  waitForEval     Related Assertion
     * @see  waitForNotEval  Related Assertion
     */
    public function assertEval($script, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the result of evaluating the specified JavaScript snippet. 
     * 
     * The snippet may have multiple lines, but only the result of the last line will be returned.
     * 
     * <p>Note that, by default, the snippet will run in the context of the "selenium" object itself, so [<b>this</b>]
     * will refer to the Selenium object. Use [<b>window</b>] to refer to the window of your application, e.g.
     * [<b>window.document.getElementById('foo')</b>] </p>
     * 
     * <p>If you need to use a locator to refer to a single element in your application page, you can use
     * [<b>this.browserbot.findElement("id=foo")</b>] where "id=foo" is your locator.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the results of evaluating the snippet</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotEval}).</p>
     * 
     * @param string   $script   the JavaScript snippet to run
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeEval       Base method, from which has been generated (automatically) current method
     * @see  assertEval      Related Assertion
     * @see  getEval         Related Accessor
     * @see  verifyEval      Related Assertion
     * @see  verifyNotEval   Related Assertion
     * @see  waitForEval     Related Assertion
     * @see  waitForNotEval  Related Assertion
     */
    public function assertNotEval($script, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets the result of evaluating the specified JavaScript snippet. 
     * 
     * The snippet may have multiple lines, but only the result of the last line will be returned.
     * 
     * <p>Note that, by default, the snippet will run in the context of the "selenium" object itself, so [<b>this</b>]
     * will refer to the Selenium object. Use [<b>window</b>] to refer to the window of your application, e.g.
     * [<b>window.document.getElementById('foo')</b>] </p>
     * 
     * <p>If you need to use a locator to refer to a single element in your application page, you can use
     * [<b>this.browserbot.findElement("id=foo")</b>] where "id=foo" is your locator.</p>
     * 
     * @param string   $script  the JavaScript snippet to run
     * 
     * @return  string  the results of evaluating the snippet
     * 
     * @see  storeEval       Base method, from which has been generated (automatically) current method
     * @see  assertEval      Related Assertion
     * @see  assertNotEval   Related Assertion
     * @see  verifyEval      Related Assertion
     * @see  verifyNotEval   Related Assertion
     * @see  waitForEval     Related Assertion
     * @see  waitForNotEval  Related Assertion
     */
    public function getEval($script)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets the result of evaluating the specified JavaScript snippet. 
     * 
     * The snippet may have multiple lines, but only the result of the last line will be returned.
     * 
     * <p>Note that, by default, the snippet will run in the context of the "selenium" object itself, so [<b>this</b>]
     * will refer to the Selenium object. Use [<b>window</b>] to refer to the window of your application, e.g.
     * [<b>window.document.getElementById('foo')</b>] </p>
     * 
     * <p>If you need to use a locator to refer to a single element in your application page, you can use
     * [<b>this.browserbot.findElement("id=foo")</b>] where "id=foo" is your locator.</p>
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>the results of evaluating the snippet (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $script        the JavaScript snippet to run
     * @param string   $variableName  the name of a variable in which the result is to be stored. (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertEval      Related Assertion
     * @see  assertNotEval   Related Assertion
     * @see  getEval         Related Accessor
     * @see  verifyEval      Related Assertion
     * @see  verifyNotEval   Related Assertion
     * @see  waitForEval     Related Assertion
     * @see  waitForNotEval  Related Assertion
     */
    public function storeEval($script, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the result of evaluating the specified JavaScript snippet. 
     * 
     * The snippet may have multiple lines, but only the result of the last line will be returned.
     * 
     * <p>Note that, by default, the snippet will run in the context of the "selenium" object itself, so [<b>this</b>]
     * will refer to the Selenium object. Use [<b>window</b>] to refer to the window of your application, e.g.
     * [<b>window.document.getElementById('foo')</b>] </p>
     * 
     * <p>If you need to use a locator to refer to a single element in your application page, you can use
     * [<b>this.browserbot.findElement("id=foo")</b>] where "id=foo" is your locator.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the results of evaluating the snippet</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertEval}).</p>
     * 
     * @param string   $script   the JavaScript snippet to run
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeEval       Base method, from which has been generated (automatically) current method
     * @see  assertEval      Related Assertion
     * @see  assertNotEval   Related Assertion
     * @see  getEval         Related Accessor
     * @see  verifyNotEval   Related Assertion
     * @see  waitForEval     Related Assertion
     * @see  waitForNotEval  Related Assertion
     */
    public function verifyEval($script, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the result of evaluating the specified JavaScript snippet. 
     * 
     * The snippet may have multiple lines, but only the result of the last line will be returned.
     * 
     * <p>Note that, by default, the snippet will run in the context of the "selenium" object itself, so [<b>this</b>]
     * will refer to the Selenium object. Use [<b>window</b>] to refer to the window of your application, e.g.
     * [<b>window.document.getElementById('foo')</b>] </p>
     * 
     * <p>If you need to use a locator to refer to a single element in your application page, you can use
     * [<b>this.browserbot.findElement("id=foo")</b>] where "id=foo" is your locator.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the results of evaluating the snippet</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotEval}).</p>
     * 
     * @param string   $script   the JavaScript snippet to run
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeEval       Base method, from which has been generated (automatically) current method
     * @see  assertEval      Related Assertion
     * @see  assertNotEval   Related Assertion
     * @see  getEval         Related Accessor
     * @see  verifyEval      Related Assertion
     * @see  waitForEval     Related Assertion
     * @see  waitForNotEval  Related Assertion
     */
    public function verifyNotEval($script, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the result of evaluating the specified JavaScript snippet. 
     * 
     * The snippet may have multiple lines, but only the result of the last line will be returned.
     * 
     * <p>Note that, by default, the snippet will run in the context of the "selenium" object itself, so [<b>this</b>]
     * will refer to the Selenium object. Use [<b>window</b>] to refer to the window of your application, e.g.
     * [<b>window.document.getElementById('foo')</b>] </p>
     * 
     * <p>If you need to use a locator to refer to a single element in your application page, you can use
     * [<b>this.browserbot.findElement("id=foo")</b>] where "id=foo" is your locator.</p>
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the results of evaluating the snippet</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $script   the JavaScript snippet to run
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeEval       Base method, from which has been generated (automatically) current method
     * @see  assertEval      Related Assertion
     * @see  assertNotEval   Related Assertion
     * @see  getEval         Related Accessor
     * @see  verifyEval      Related Assertion
     * @see  verifyNotEval   Related Assertion
     * @see  waitForNotEval  Related Assertion
     */
    public function waitForEval($script, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the result of evaluating the specified JavaScript snippet. 
     * 
     * The snippet may have multiple lines, but only the result of the last line will be returned.
     * 
     * <p>Note that, by default, the snippet will run in the context of the "selenium" object itself, so [<b>this</b>]
     * will refer to the Selenium object. Use [<b>window</b>] to refer to the window of your application, e.g.
     * [<b>window.document.getElementById('foo')</b>] </p>
     * 
     * <p>If you need to use a locator to refer to a single element in your application page, you can use
     * [<b>this.browserbot.findElement("id=foo")</b>] where "id=foo" is your locator.</p>
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the results of evaluating the snippet</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $script   the JavaScript snippet to run
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeEval      Base method, from which has been generated (automatically) current method
     * @see  assertEval     Related Assertion
     * @see  assertNotEval  Related Assertion
     * @see  getEval        Related Accessor
     * @see  verifyEval     Related Assertion
     * @see  verifyNotEval  Related Assertion
     * @see  waitForEval    Related Assertion
     */
    public function waitForNotEval($script, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the specified expression. 
     * 
     * <p>This is useful because of JavaScript preprocessing. It is used to generate commands like assertExpression and
     * waitForExpression.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the value passed in</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyExpression}).</p>
     * 
     * @param string   $expression  the value to return
     * @param string   $pattern     the String-match Patterns 
     *                              (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeExpression       Base method, from which has been generated (automatically) current method
     * @see  assertNotExpression   Related Assertion
     * @see  getExpression         Related Accessor
     * @see  verifyExpression      Related Assertion
     * @see  verifyNotExpression   Related Assertion
     * @see  waitForExpression     Related Assertion
     * @see  waitForNotExpression  Related Assertion
     */
    public function assertExpression($expression, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the specified expression. 
     * 
     * <p>This is useful because of JavaScript preprocessing. It is used to generate commands like assertExpression and
     * waitForExpression.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the value passed in</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotExpression}).</p>
     * 
     * @param string   $expression  the value to return
     * @param string   $pattern     the String-match Patterns 
     *                              (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeExpression       Base method, from which has been generated (automatically) current method
     * @see  assertExpression      Related Assertion
     * @see  getExpression         Related Accessor
     * @see  verifyExpression      Related Assertion
     * @see  verifyNotExpression   Related Assertion
     * @see  waitForExpression     Related Assertion
     * @see  waitForNotExpression  Related Assertion
     */
    public function assertNotExpression($expression, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Returns the specified expression. 
     * 
     * <p>This is useful because of JavaScript preprocessing. It is used to generate commands like assertExpression and
     * waitForExpression.</p>
     * 
     * @param string   $expression  the value to return
     * 
     * @return  string  the value passed in
     * 
     * @see  storeExpression       Base method, from which has been generated (automatically) current method
     * @see  assertExpression      Related Assertion
     * @see  assertNotExpression   Related Assertion
     * @see  verifyExpression      Related Assertion
     * @see  verifyNotExpression   Related Assertion
     * @see  waitForExpression     Related Assertion
     * @see  waitForNotExpression  Related Assertion
     */
    public function getExpression($expression)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Returns the specified expression. 
     * 
     * <p>This is useful because of JavaScript preprocessing. It is used to generate commands like assertExpression and
     * waitForExpression.</p>
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>the value passed in (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $expression    the value to return
     * @param string   $variableName  the name of a variable in which the result is to be stored. (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertExpression      Related Assertion
     * @see  assertNotExpression   Related Assertion
     * @see  getExpression         Related Accessor
     * @see  verifyExpression      Related Assertion
     * @see  verifyNotExpression   Related Assertion
     * @see  waitForExpression     Related Assertion
     * @see  waitForNotExpression  Related Assertion
     */
    public function storeExpression($expression, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the specified expression. 
     * 
     * <p>This is useful because of JavaScript preprocessing. It is used to generate commands like assertExpression and
     * waitForExpression.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the value passed in</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertExpression}).</p>
     * 
     * @param string   $expression  the value to return
     * @param string   $pattern     the String-match Patterns 
     *                              (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeExpression       Base method, from which has been generated (automatically) current method
     * @see  assertExpression      Related Assertion
     * @see  assertNotExpression   Related Assertion
     * @see  getExpression         Related Accessor
     * @see  verifyNotExpression   Related Assertion
     * @see  waitForExpression     Related Assertion
     * @see  waitForNotExpression  Related Assertion
     */
    public function verifyExpression($expression, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the specified expression. 
     * 
     * <p>This is useful because of JavaScript preprocessing. It is used to generate commands like assertExpression and
     * waitForExpression.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the value passed in</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotExpression}).</p>
     * 
     * @param string   $expression  the value to return
     * @param string   $pattern     the String-match Patterns 
     *                              (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeExpression       Base method, from which has been generated (automatically) current method
     * @see  assertExpression      Related Assertion
     * @see  assertNotExpression   Related Assertion
     * @see  getExpression         Related Accessor
     * @see  verifyExpression      Related Assertion
     * @see  waitForExpression     Related Assertion
     * @see  waitForNotExpression  Related Assertion
     */
    public function verifyNotExpression($expression, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the specified expression. 
     * 
     * <p>This is useful because of JavaScript preprocessing. It is used to generate commands like assertExpression and
     * waitForExpression.</p>
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the value passed in</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $expression  the value to return
     * @param string   $pattern     the String-match Patterns 
     *                              (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeExpression       Base method, from which has been generated (automatically) current method
     * @see  assertExpression      Related Assertion
     * @see  assertNotExpression   Related Assertion
     * @see  getExpression         Related Accessor
     * @see  verifyExpression      Related Assertion
     * @see  verifyNotExpression   Related Assertion
     * @see  waitForNotExpression  Related Assertion
     */
    public function waitForExpression($expression, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the specified expression. 
     * 
     * <p>This is useful because of JavaScript preprocessing. It is used to generate commands like assertExpression and
     * waitForExpression.</p>
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the value passed in</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $expression  the value to return
     * @param string   $pattern     the String-match Patterns 
     *                              (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeExpression      Base method, from which has been generated (automatically) current method
     * @see  assertExpression     Related Assertion
     * @see  assertNotExpression  Related Assertion
     * @see  getExpression        Related Accessor
     * @see  verifyExpression     Related Assertion
     * @see  verifyNotExpression  Related Assertion
     * @see  waitForExpression    Related Assertion
     */
    public function waitForNotExpression($expression, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the entire HTML source between the opening and closing "html" tags.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the entire HTML source</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyHtmlSource}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeHtmlSource       Base method, from which has been generated (automatically) current method
     * @see  assertNotHtmlSource   Related Assertion
     * @see  getHtmlSource         Related Accessor
     * @see  verifyHtmlSource      Related Assertion
     * @see  verifyNotHtmlSource   Related Assertion
     * @see  waitForHtmlSource     Related Assertion
     * @see  waitForNotHtmlSource  Related Assertion
     */
    public function assertHtmlSource($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the entire HTML source between the opening and closing "html" tags.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the entire HTML source</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotHtmlSource}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeHtmlSource       Base method, from which has been generated (automatically) current method
     * @see  assertHtmlSource      Related Assertion
     * @see  getHtmlSource         Related Accessor
     * @see  verifyHtmlSource      Related Assertion
     * @see  verifyNotHtmlSource   Related Assertion
     * @see  waitForHtmlSource     Related Assertion
     * @see  waitForNotHtmlSource  Related Assertion
     */
    public function assertNotHtmlSource($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Returns the entire HTML source between the opening and closing "html" tags.
     * 
     * @return  string  the entire HTML source
     * 
     * @see  storeHtmlSource       Base method, from which has been generated (automatically) current method
     * @see  assertHtmlSource      Related Assertion
     * @see  assertNotHtmlSource   Related Assertion
     * @see  verifyHtmlSource      Related Assertion
     * @see  verifyNotHtmlSource   Related Assertion
     * @see  waitForHtmlSource     Related Assertion
     * @see  waitForNotHtmlSource  Related Assertion
     */
    public function getHtmlSource()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Returns the entire HTML source between the opening and closing "html" tags.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>the entire HTML source (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $variableName  the name of a variable in which the result is to be stored (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertHtmlSource      Related Assertion
     * @see  assertNotHtmlSource   Related Assertion
     * @see  getHtmlSource         Related Accessor
     * @see  verifyHtmlSource      Related Assertion
     * @see  verifyNotHtmlSource   Related Assertion
     * @see  waitForHtmlSource     Related Assertion
     * @see  waitForNotHtmlSource  Related Assertion
     */
    public function storeHtmlSource($variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the entire HTML source between the opening and closing "html" tags.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the entire HTML source</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertHtmlSource}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeHtmlSource       Base method, from which has been generated (automatically) current method
     * @see  assertHtmlSource      Related Assertion
     * @see  assertNotHtmlSource   Related Assertion
     * @see  getHtmlSource         Related Accessor
     * @see  verifyNotHtmlSource   Related Assertion
     * @see  waitForHtmlSource     Related Assertion
     * @see  waitForNotHtmlSource  Related Assertion
     */
    public function verifyHtmlSource($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the entire HTML source between the opening and closing "html" tags.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the entire HTML source</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotHtmlSource}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeHtmlSource       Base method, from which has been generated (automatically) current method
     * @see  assertHtmlSource      Related Assertion
     * @see  assertNotHtmlSource   Related Assertion
     * @see  getHtmlSource         Related Accessor
     * @see  verifyHtmlSource      Related Assertion
     * @see  waitForHtmlSource     Related Assertion
     * @see  waitForNotHtmlSource  Related Assertion
     */
    public function verifyNotHtmlSource($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the entire HTML source between the opening and closing "html" tags.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the entire HTML source</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeHtmlSource       Base method, from which has been generated (automatically) current method
     * @see  assertHtmlSource      Related Assertion
     * @see  assertNotHtmlSource   Related Assertion
     * @see  getHtmlSource         Related Accessor
     * @see  verifyHtmlSource      Related Assertion
     * @see  verifyNotHtmlSource   Related Assertion
     * @see  waitForNotHtmlSource  Related Assertion
     */
    public function waitForHtmlSource($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the entire HTML source between the opening and closing "html" tags.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the entire HTML source</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeHtmlSource      Base method, from which has been generated (automatically) current method
     * @see  assertHtmlSource     Related Assertion
     * @see  assertNotHtmlSource  Related Assertion
     * @see  getHtmlSource        Related Accessor
     * @see  verifyHtmlSource     Related Assertion
     * @see  verifyNotHtmlSource  Related Assertion
     * @see  waitForHtmlSource    Related Assertion
     */
    public function waitForNotHtmlSource($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the absolute URL of the current page.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the absolute URL of the current page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyLocation}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeLocation       Base method, from which has been generated (automatically) current method
     * @see  assertNotLocation   Related Assertion
     * @see  getLocation         Related Accessor
     * @see  verifyLocation      Related Assertion
     * @see  verifyNotLocation   Related Assertion
     * @see  waitForLocation     Related Assertion
     * @see  waitForNotLocation  Related Assertion
     */
    public function assertLocation($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the absolute URL of the current page.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the absolute URL of the current page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotLocation}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeLocation       Base method, from which has been generated (automatically) current method
     * @see  assertLocation      Related Assertion
     * @see  getLocation         Related Accessor
     * @see  verifyLocation      Related Assertion
     * @see  verifyNotLocation   Related Assertion
     * @see  waitForLocation     Related Assertion
     * @see  waitForNotLocation  Related Assertion
     */
    public function assertNotLocation($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets the absolute URL of the current page.
     * 
     * @return  string  the absolute URL of the current page
     * 
     * @see  storeLocation       Base method, from which has been generated (automatically) current method
     * @see  assertLocation      Related Assertion
     * @see  assertNotLocation   Related Assertion
     * @see  verifyLocation      Related Assertion
     * @see  verifyNotLocation   Related Assertion
     * @see  waitForLocation     Related Assertion
     * @see  waitForNotLocation  Related Assertion
     */
    public function getLocation()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets the absolute URL of the current page.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>the absolute URL of the current page (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $variableName  the name of a variable in which the result is to be stored (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertLocation      Related Assertion
     * @see  assertNotLocation   Related Assertion
     * @see  getLocation         Related Accessor
     * @see  verifyLocation      Related Assertion
     * @see  verifyNotLocation   Related Assertion
     * @see  waitForLocation     Related Assertion
     * @see  waitForNotLocation  Related Assertion
     */
    public function storeLocation($variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the absolute URL of the current page.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the absolute URL of the current page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertLocation}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeLocation       Base method, from which has been generated (automatically) current method
     * @see  assertLocation      Related Assertion
     * @see  assertNotLocation   Related Assertion
     * @see  getLocation         Related Accessor
     * @see  verifyNotLocation   Related Assertion
     * @see  waitForLocation     Related Assertion
     * @see  waitForNotLocation  Related Assertion
     */
    public function verifyLocation($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the absolute URL of the current page.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the absolute URL of the current page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotLocation}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeLocation       Base method, from which has been generated (automatically) current method
     * @see  assertLocation      Related Assertion
     * @see  assertNotLocation   Related Assertion
     * @see  getLocation         Related Accessor
     * @see  verifyLocation      Related Assertion
     * @see  waitForLocation     Related Assertion
     * @see  waitForNotLocation  Related Assertion
     */
    public function verifyNotLocation($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the absolute URL of the current page.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the absolute URL of the current page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeLocation       Base method, from which has been generated (automatically) current method
     * @see  assertLocation      Related Assertion
     * @see  assertNotLocation   Related Assertion
     * @see  getLocation         Related Accessor
     * @see  verifyLocation      Related Assertion
     * @see  verifyNotLocation   Related Assertion
     * @see  waitForNotLocation  Related Assertion
     */
    public function waitForLocation($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the absolute URL of the current page.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the absolute URL of the current page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeLocation      Base method, from which has been generated (automatically) current method
     * @see  assertLocation     Related Assertion
     * @see  assertNotLocation  Related Assertion
     * @see  getLocation        Related Accessor
     * @see  verifyLocation     Related Assertion
     * @see  verifyNotLocation  Related Assertion
     * @see  waitForLocation    Related Assertion
     */
    public function waitForNotLocation($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the number of pixels between "mousemove" events during dragAndDrop commands (default=10).
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the number of pixels between "mousemove" events during dragAndDrop commands (default=10)</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyMouseSpeed}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeMouseSpeed       Base method, from which has been generated (automatically) current method
     * @see  assertNotMouseSpeed   Related Assertion
     * @see  getMouseSpeed         Related Accessor
     * @see  verifyMouseSpeed      Related Assertion
     * @see  verifyNotMouseSpeed   Related Assertion
     * @see  waitForMouseSpeed     Related Assertion
     * @see  waitForNotMouseSpeed  Related Assertion
     */
    public function assertMouseSpeed($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the number of pixels between "mousemove" events during dragAndDrop commands (default=10).
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the number of pixels between "mousemove" events during dragAndDrop commands (default=10)</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotMouseSpeed}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeMouseSpeed       Base method, from which has been generated (automatically) current method
     * @see  assertMouseSpeed      Related Assertion
     * @see  getMouseSpeed         Related Accessor
     * @see  verifyMouseSpeed      Related Assertion
     * @see  verifyNotMouseSpeed   Related Assertion
     * @see  waitForMouseSpeed     Related Assertion
     * @see  waitForNotMouseSpeed  Related Assertion
     */
    public function assertNotMouseSpeed($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Returns the number of pixels between "mousemove" events during dragAndDrop commands (default=10).
     * 
     * @return  int  the number of pixels between "mousemove" events during dragAndDrop commands (default=10)
     * 
     * @see  storeMouseSpeed       Base method, from which has been generated (automatically) current method
     * @see  assertMouseSpeed      Related Assertion
     * @see  assertNotMouseSpeed   Related Assertion
     * @see  verifyMouseSpeed      Related Assertion
     * @see  verifyNotMouseSpeed   Related Assertion
     * @see  waitForMouseSpeed     Related Assertion
     * @see  waitForNotMouseSpeed  Related Assertion
     */
    public function getMouseSpeed()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Returns the number of pixels between "mousemove" events during dragAndDrop commands (default=10).
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>the number of pixels between "mousemove" events during dragAndDrop commands (default=10) (see
     * {@link doc_Stored_Variables})</p>
     * 
     * @param string   $variableName  the name of a variable in which the result is to be stored (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertMouseSpeed      Related Assertion
     * @see  assertNotMouseSpeed   Related Assertion
     * @see  getMouseSpeed         Related Accessor
     * @see  verifyMouseSpeed      Related Assertion
     * @see  verifyNotMouseSpeed   Related Assertion
     * @see  waitForMouseSpeed     Related Assertion
     * @see  waitForNotMouseSpeed  Related Assertion
     */
    public function storeMouseSpeed($variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the number of pixels between "mousemove" events during dragAndDrop commands (default=10).
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the number of pixels between "mousemove" events during dragAndDrop commands (default=10)</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertMouseSpeed}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeMouseSpeed       Base method, from which has been generated (automatically) current method
     * @see  assertMouseSpeed      Related Assertion
     * @see  assertNotMouseSpeed   Related Assertion
     * @see  getMouseSpeed         Related Accessor
     * @see  verifyNotMouseSpeed   Related Assertion
     * @see  waitForMouseSpeed     Related Assertion
     * @see  waitForNotMouseSpeed  Related Assertion
     */
    public function verifyMouseSpeed($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the number of pixels between "mousemove" events during dragAndDrop commands (default=10).
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the number of pixels between "mousemove" events during dragAndDrop commands (default=10)</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotMouseSpeed}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeMouseSpeed       Base method, from which has been generated (automatically) current method
     * @see  assertMouseSpeed      Related Assertion
     * @see  assertNotMouseSpeed   Related Assertion
     * @see  getMouseSpeed         Related Accessor
     * @see  verifyMouseSpeed      Related Assertion
     * @see  waitForMouseSpeed     Related Assertion
     * @see  waitForNotMouseSpeed  Related Assertion
     */
    public function verifyNotMouseSpeed($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the number of pixels between "mousemove" events during dragAndDrop commands (default=10).
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the number of pixels between "mousemove" events during dragAndDrop commands (default=10)</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeMouseSpeed       Base method, from which has been generated (automatically) current method
     * @see  assertMouseSpeed      Related Assertion
     * @see  assertNotMouseSpeed   Related Assertion
     * @see  getMouseSpeed         Related Accessor
     * @see  verifyMouseSpeed      Related Assertion
     * @see  verifyNotMouseSpeed   Related Assertion
     * @see  waitForNotMouseSpeed  Related Assertion
     */
    public function waitForMouseSpeed($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the number of pixels between "mousemove" events during dragAndDrop commands (default=10).
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the number of pixels between "mousemove" events during dragAndDrop commands (default=10)</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeMouseSpeed      Base method, from which has been generated (automatically) current method
     * @see  assertMouseSpeed     Related Assertion
     * @see  assertNotMouseSpeed  Related Assertion
     * @see  getMouseSpeed        Related Accessor
     * @see  verifyMouseSpeed     Related Assertion
     * @see  verifyNotMouseSpeed  Related Assertion
     * @see  waitForMouseSpeed    Related Assertion
     */
    public function waitForNotMouseSpeed($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Check if these two elements have same parent and are ordered siblings in the DOM. 
     * 
     * Two same elements will not be considered ordered.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if element1 is the previous sibling of element2, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotOrdered}).</p>
     * 
     * @param string   $locator1  an element locator pointing to the first element 
     *                            (see {@link doc_Element_Locators})
     * @param string   $locator2  an element locator pointing to the second element 
     *                            (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeOrdered       Base method, from which has been generated (automatically) current method
     * @see  assertOrdered      Related Assertion
     * @see  isOrdered          Related Accessor
     * @see  verifyNotOrdered   Related Assertion
     * @see  verifyOrdered      Related Assertion
     * @see  waitForNotOrdered  Related Assertion
     * @see  waitForOrdered     Related Assertion
     */
    public function assertNotOrdered($locator1, $locator2)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Check if these two elements have same parent and are ordered siblings in the DOM. 
     * 
     * Two same elements will not be considered ordered.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if element1 is the previous sibling of element2, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyOrdered}).</p>
     * 
     * @param string   $locator1  an element locator pointing to the first element 
     *                            (see {@link doc_Element_Locators})
     * @param string   $locator2  an element locator pointing to the second element 
     *                            (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeOrdered       Base method, from which has been generated (automatically) current method
     * @see  assertNotOrdered   Related Assertion
     * @see  isOrdered          Related Accessor
     * @see  verifyNotOrdered   Related Assertion
     * @see  verifyOrdered      Related Assertion
     * @see  waitForNotOrdered  Related Assertion
     * @see  waitForOrdered     Related Assertion
     */
    public function assertOrdered($locator1, $locator2)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Check if these two elements have same parent and are ordered siblings in the DOM. 
     * 
     * Two same elements will not be considered ordered.
     * 
     * @param string   $locator1  an element locator pointing to the first element 
     *                            (see {@link doc_Element_Locators})
     * @param string   $locator2  an element locator pointing to the second element 
     *                            (see {@link doc_Element_Locators})
     * 
     * @return  bool  true if element1 is the previous sibling of element2, false otherwise
     * 
     * @see  storeOrdered       Base method, from which has been generated (automatically) current method
     * @see  assertNotOrdered   Related Assertion
     * @see  assertOrdered      Related Assertion
     * @see  verifyNotOrdered   Related Assertion
     * @see  verifyOrdered      Related Assertion
     * @see  waitForNotOrdered  Related Assertion
     * @see  waitForOrdered     Related Assertion
     */
    public function isOrdered($locator1, $locator2)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Check if these two elements have same parent and are ordered siblings in the DOM. 
     * 
     * Two same elements will not be considered ordered.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>true if element1 is the previous sibling of element2, false otherwise (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $locator1      an element locator pointing to the first element (see
     *                                {@link doc_Element_Locators})
     * @param string   $locator2      an element locator pointing to the second element (see
     *                                {@link doc_Element_Locators})
     * @param string   $variableName  the name of a variable in which the result is to be stored. (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertNotOrdered   Related Assertion
     * @see  assertOrdered      Related Assertion
     * @see  isOrdered          Related Accessor
     * @see  verifyNotOrdered   Related Assertion
     * @see  verifyOrdered      Related Assertion
     * @see  waitForNotOrdered  Related Assertion
     * @see  waitForOrdered     Related Assertion
     */
    public function storeOrdered($locator1, $locator2, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Check if these two elements have same parent and are ordered siblings in the DOM. 
     * 
     * Two same elements will not be considered ordered.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if element1 is the previous sibling of element2, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotOrdered}).</p>
     * 
     * @param string   $locator1  an element locator pointing to the first element 
     *                            (see {@link doc_Element_Locators})
     * @param string   $locator2  an element locator pointing to the second element 
     *                            (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeOrdered       Base method, from which has been generated (automatically) current method
     * @see  assertNotOrdered   Related Assertion
     * @see  assertOrdered      Related Assertion
     * @see  isOrdered          Related Accessor
     * @see  verifyOrdered      Related Assertion
     * @see  waitForNotOrdered  Related Assertion
     * @see  waitForOrdered     Related Assertion
     */
    public function verifyNotOrdered($locator1, $locator2)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Check if these two elements have same parent and are ordered siblings in the DOM. 
     * 
     * Two same elements will not be considered ordered.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if element1 is the previous sibling of element2, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertOrdered}).</p>
     * 
     * @param string   $locator1  an element locator pointing to the first element 
     *                            (see {@link doc_Element_Locators})
     * @param string   $locator2  an element locator pointing to the second element 
     *                            (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeOrdered       Base method, from which has been generated (automatically) current method
     * @see  assertNotOrdered   Related Assertion
     * @see  assertOrdered      Related Assertion
     * @see  isOrdered          Related Accessor
     * @see  verifyNotOrdered   Related Assertion
     * @see  waitForNotOrdered  Related Assertion
     * @see  waitForOrdered     Related Assertion
     */
    public function verifyOrdered($locator1, $locator2)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Check if these two elements have same parent and are ordered siblings in the DOM. 
     * 
     * Two same elements will not be considered ordered.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>true if element1 is the previous sibling of element2, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $locator1  an element locator pointing to the first element 
     *                            (see {@link doc_Element_Locators})
     * @param string   $locator2  an element locator pointing to the second element 
     *                            (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeOrdered      Base method, from which has been generated (automatically) current method
     * @see  assertNotOrdered  Related Assertion
     * @see  assertOrdered     Related Assertion
     * @see  isOrdered         Related Accessor
     * @see  verifyNotOrdered  Related Assertion
     * @see  verifyOrdered     Related Assertion
     * @see  waitForOrdered    Related Assertion
     */
    public function waitForNotOrdered($locator1, $locator2)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Check if these two elements have same parent and are ordered siblings in the DOM. 
     * 
     * Two same elements will not be considered ordered.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>true if element1 is the previous sibling of element2, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $locator1  an element locator pointing to the first element 
     *                            (see {@link doc_Element_Locators})
     * @param string   $locator2  an element locator pointing to the second element 
     *                            (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeOrdered       Base method, from which has been generated (automatically) current method
     * @see  assertNotOrdered   Related Assertion
     * @see  assertOrdered      Related Assertion
     * @see  isOrdered          Related Accessor
     * @see  verifyNotOrdered   Related Assertion
     * @see  verifyOrdered      Related Assertion
     * @see  waitForNotOrdered  Related Assertion
     */
    public function waitForOrdered($locator1, $locator2)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the message of a JavaScript question prompt dialog generated during the previous action. 
     * 
     * <p>Successful handling of the prompt requires prior execution of the answerOnNextPrompt command. If a prompt is
     * generated but you do not get/verify it, the next Selenium action will fail.</p>
     * 
     * <p>NOTE: under Selenium, JavaScript prompts will NOT pop up a visible dialog.</p>
     * 
     * <p>NOTE: Selenium does NOT support JavaScript prompts that are generated in a page's onload() event handler. In
     * this case a visible dialog WILL be generated and Selenium will hang until someone manually clicks OK.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the message of the most recent JavaScript question prompt</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotPrompt}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storePrompt       Base method, from which has been generated (automatically) current method
     * @see  assertPrompt      Related Assertion
     * @see  getPrompt         Related Accessor
     * @see  verifyNotPrompt   Related Assertion
     * @see  verifyPrompt      Related Assertion
     * @see  waitForNotPrompt  Related Assertion
     * @see  waitForPrompt     Related Assertion
     */
    public function assertNotPrompt($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the message of a JavaScript question prompt dialog generated during the previous action. 
     * 
     * <p>Successful handling of the prompt requires prior execution of the answerOnNextPrompt command. If a prompt is
     * generated but you do not get/verify it, the next Selenium action will fail.</p>
     * 
     * <p>NOTE: under Selenium, JavaScript prompts will NOT pop up a visible dialog.</p>
     * 
     * <p>NOTE: Selenium does NOT support JavaScript prompts that are generated in a page's onload() event handler. In
     * this case a visible dialog WILL be generated and Selenium will hang until someone manually clicks OK.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the message of the most recent JavaScript question prompt</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyPrompt}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storePrompt       Base method, from which has been generated (automatically) current method
     * @see  assertNotPrompt   Related Assertion
     * @see  getPrompt         Related Accessor
     * @see  verifyNotPrompt   Related Assertion
     * @see  verifyPrompt      Related Assertion
     * @see  waitForNotPrompt  Related Assertion
     * @see  waitForPrompt     Related Assertion
     */
    public function assertPrompt($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Retrieves the message of a JavaScript question prompt dialog generated during the previous action. 
     * 
     * <p>Successful handling of the prompt requires prior execution of the answerOnNextPrompt command. If a prompt is
     * generated but you do not get/verify it, the next Selenium action will fail.</p>
     * 
     * <p>NOTE: under Selenium, JavaScript prompts will NOT pop up a visible dialog.</p>
     * 
     * <p>NOTE: Selenium does NOT support JavaScript prompts that are generated in a page's onload() event handler. In
     * this case a visible dialog WILL be generated and Selenium will hang until someone manually clicks OK.</p>
     * 
     * @return  string  the message of the most recent JavaScript question prompt
     * 
     * @see  storePrompt       Base method, from which has been generated (automatically) current method
     * @see  assertNotPrompt   Related Assertion
     * @see  assertPrompt      Related Assertion
     * @see  verifyNotPrompt   Related Assertion
     * @see  verifyPrompt      Related Assertion
     * @see  waitForNotPrompt  Related Assertion
     * @see  waitForPrompt     Related Assertion
     */
    public function getPrompt()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Retrieves the message of a JavaScript question prompt dialog generated during the previous action. 
     * 
     * <p>Successful handling of the prompt requires prior execution of the answerOnNextPrompt command. If a prompt is
     * generated but you do not get/verify it, the next Selenium action will fail.</p>
     * 
     * <p>NOTE: under Selenium, JavaScript prompts will NOT pop up a visible dialog.</p>
     * 
     * <p>NOTE: Selenium does NOT support JavaScript prompts that are generated in a page's onload() event handler. In
     * this case a visible dialog WILL be generated and Selenium will hang until someone manually clicks OK.</p>
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>the message of the most recent JavaScript question prompt (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $variableName  the name of a variable in which the result is to be stored (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertNotPrompt   Related Assertion
     * @see  assertPrompt      Related Assertion
     * @see  getPrompt         Related Accessor
     * @see  verifyNotPrompt   Related Assertion
     * @see  verifyPrompt      Related Assertion
     * @see  waitForNotPrompt  Related Assertion
     * @see  waitForPrompt     Related Assertion
     */
    public function storePrompt($variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the message of a JavaScript question prompt dialog generated during the previous action. 
     * 
     * <p>Successful handling of the prompt requires prior execution of the answerOnNextPrompt command. If a prompt is
     * generated but you do not get/verify it, the next Selenium action will fail.</p>
     * 
     * <p>NOTE: under Selenium, JavaScript prompts will NOT pop up a visible dialog.</p>
     * 
     * <p>NOTE: Selenium does NOT support JavaScript prompts that are generated in a page's onload() event handler. In
     * this case a visible dialog WILL be generated and Selenium will hang until someone manually clicks OK.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the message of the most recent JavaScript question prompt</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotPrompt}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storePrompt       Base method, from which has been generated (automatically) current method
     * @see  assertNotPrompt   Related Assertion
     * @see  assertPrompt      Related Assertion
     * @see  getPrompt         Related Accessor
     * @see  verifyPrompt      Related Assertion
     * @see  waitForNotPrompt  Related Assertion
     * @see  waitForPrompt     Related Assertion
     */
    public function verifyNotPrompt($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the message of a JavaScript question prompt dialog generated during the previous action. 
     * 
     * <p>Successful handling of the prompt requires prior execution of the answerOnNextPrompt command. If a prompt is
     * generated but you do not get/verify it, the next Selenium action will fail.</p>
     * 
     * <p>NOTE: under Selenium, JavaScript prompts will NOT pop up a visible dialog.</p>
     * 
     * <p>NOTE: Selenium does NOT support JavaScript prompts that are generated in a page's onload() event handler. In
     * this case a visible dialog WILL be generated and Selenium will hang until someone manually clicks OK.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the message of the most recent JavaScript question prompt</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertPrompt}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storePrompt       Base method, from which has been generated (automatically) current method
     * @see  assertNotPrompt   Related Assertion
     * @see  assertPrompt      Related Assertion
     * @see  getPrompt         Related Accessor
     * @see  verifyNotPrompt   Related Assertion
     * @see  waitForNotPrompt  Related Assertion
     * @see  waitForPrompt     Related Assertion
     */
    public function verifyPrompt($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the message of a JavaScript question prompt dialog generated during the previous action. 
     * 
     * <p>Successful handling of the prompt requires prior execution of the answerOnNextPrompt command. If a prompt is
     * generated but you do not get/verify it, the next Selenium action will fail.</p>
     * 
     * <p>NOTE: under Selenium, JavaScript prompts will NOT pop up a visible dialog.</p>
     * 
     * <p>NOTE: Selenium does NOT support JavaScript prompts that are generated in a page's onload() event handler. In
     * this case a visible dialog WILL be generated and Selenium will hang until someone manually clicks OK.</p>
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the message of the most recent JavaScript question prompt</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storePrompt      Base method, from which has been generated (automatically) current method
     * @see  assertNotPrompt  Related Assertion
     * @see  assertPrompt     Related Assertion
     * @see  getPrompt        Related Accessor
     * @see  verifyNotPrompt  Related Assertion
     * @see  verifyPrompt     Related Assertion
     * @see  waitForPrompt    Related Assertion
     */
    public function waitForNotPrompt($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Retrieves the message of a JavaScript question prompt dialog generated during the previous action. 
     * 
     * <p>Successful handling of the prompt requires prior execution of the answerOnNextPrompt command. If a prompt is
     * generated but you do not get/verify it, the next Selenium action will fail.</p>
     * 
     * <p>NOTE: under Selenium, JavaScript prompts will NOT pop up a visible dialog.</p>
     * 
     * <p>NOTE: Selenium does NOT support JavaScript prompts that are generated in a page's onload() event handler. In
     * this case a visible dialog WILL be generated and Selenium will hang until someone manually clicks OK.</p>
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the message of the most recent JavaScript question prompt</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storePrompt       Base method, from which has been generated (automatically) current method
     * @see  assertNotPrompt   Related Assertion
     * @see  assertPrompt      Related Assertion
     * @see  getPrompt         Related Accessor
     * @see  verifyNotPrompt   Related Assertion
     * @see  verifyPrompt      Related Assertion
     * @see  waitForNotPrompt  Related Assertion
     */
    public function waitForPrompt($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option labels in the specified select drop-down.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>an array of all option labels in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotSelectOptions}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectOptions       Base method, from which has been generated (automatically) current method
     * @see  assertSelectOptions      Related Assertion
     * @see  getSelectOptions         Related Accessor
     * @see  verifyNotSelectOptions   Related Assertion
     * @see  verifySelectOptions      Related Assertion
     * @see  waitForNotSelectOptions  Related Assertion
     * @see  waitForSelectOptions     Related Assertion
     */
    public function assertNotSelectOptions($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option labels in the specified select drop-down.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>an array of all option labels in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifySelectOptions}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectOptions       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectOptions   Related Assertion
     * @see  getSelectOptions         Related Accessor
     * @see  verifyNotSelectOptions   Related Assertion
     * @see  verifySelectOptions      Related Assertion
     * @see  waitForNotSelectOptions  Related Assertion
     * @see  waitForSelectOptions     Related Assertion
     */
    public function assertSelectOptions($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets all option labels in the specified select drop-down.
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * 
     * @return  string[]  an array of all option labels in the specified select drop-down
     * 
     * @see  storeSelectOptions       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectOptions   Related Assertion
     * @see  assertSelectOptions      Related Assertion
     * @see  verifyNotSelectOptions   Related Assertion
     * @see  verifySelectOptions      Related Assertion
     * @see  waitForNotSelectOptions  Related Assertion
     * @see  waitForSelectOptions     Related Assertion
     */
    public function getSelectOptions($selectLocator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets all option labels in the specified select drop-down.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>an array of all option labels in the specified select drop-down (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $variableName   the name of a variable in which the result is to be stored. (see
     *                                 {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertNotSelectOptions   Related Assertion
     * @see  assertSelectOptions      Related Assertion
     * @see  getSelectOptions         Related Accessor
     * @see  verifyNotSelectOptions   Related Assertion
     * @see  verifySelectOptions      Related Assertion
     * @see  waitForNotSelectOptions  Related Assertion
     * @see  waitForSelectOptions     Related Assertion
     */
    public function storeSelectOptions($selectLocator, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option labels in the specified select drop-down.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>an array of all option labels in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotSelectOptions}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectOptions       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectOptions   Related Assertion
     * @see  assertSelectOptions      Related Assertion
     * @see  getSelectOptions         Related Accessor
     * @see  verifySelectOptions      Related Assertion
     * @see  waitForNotSelectOptions  Related Assertion
     * @see  waitForSelectOptions     Related Assertion
     */
    public function verifyNotSelectOptions($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option labels in the specified select drop-down.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>an array of all option labels in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertSelectOptions}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectOptions       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectOptions   Related Assertion
     * @see  assertSelectOptions      Related Assertion
     * @see  getSelectOptions         Related Accessor
     * @see  verifyNotSelectOptions   Related Assertion
     * @see  waitForNotSelectOptions  Related Assertion
     * @see  waitForSelectOptions     Related Assertion
     */
    public function verifySelectOptions($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option labels in the specified select drop-down.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>an array of all option labels in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectOptions      Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectOptions  Related Assertion
     * @see  assertSelectOptions     Related Assertion
     * @see  getSelectOptions        Related Accessor
     * @see  verifyNotSelectOptions  Related Assertion
     * @see  verifySelectOptions     Related Assertion
     * @see  waitForSelectOptions    Related Assertion
     */
    public function waitForNotSelectOptions($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option labels in the specified select drop-down.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>an array of all option labels in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectOptions       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectOptions   Related Assertion
     * @see  assertSelectOptions      Related Assertion
     * @see  getSelectOptions         Related Accessor
     * @see  verifyNotSelectOptions   Related Assertion
     * @see  verifySelectOptions      Related Assertion
     * @see  waitForNotSelectOptions  Related Assertion
     */
    public function waitForSelectOptions($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets option element ID for selected option in the specified select element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the selected option ID in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotSelectedId}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedId       Base method, from which has been generated (automatically) current method
     * @see  assertSelectedId      Related Assertion
     * @see  getSelectedId         Related Accessor
     * @see  verifyNotSelectedId   Related Assertion
     * @see  verifySelectedId      Related Assertion
     * @see  waitForNotSelectedId  Related Assertion
     * @see  waitForSelectedId     Related Assertion
     */
    public function assertNotSelectedId($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets option element ID for selected option in the specified select element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the selected option ID in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifySelectedId}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedId       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedId   Related Assertion
     * @see  getSelectedId         Related Accessor
     * @see  verifyNotSelectedId   Related Assertion
     * @see  verifySelectedId      Related Assertion
     * @see  waitForNotSelectedId  Related Assertion
     * @see  waitForSelectedId     Related Assertion
     */
    public function assertSelectedId($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets option element ID for selected option in the specified select element.
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * 
     * @return  string  the selected option ID in the specified select drop-down
     * 
     * @see  storeSelectedId       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedId   Related Assertion
     * @see  assertSelectedId      Related Assertion
     * @see  verifyNotSelectedId   Related Assertion
     * @see  verifySelectedId      Related Assertion
     * @see  waitForNotSelectedId  Related Assertion
     * @see  waitForSelectedId     Related Assertion
     */
    public function getSelectedId($selectLocator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets option element ID for selected option in the specified select element.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>the selected option ID in the specified select drop-down (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $variableName   the name of a variable in which the result is to be stored. (see
     *                                 {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertNotSelectedId   Related Assertion
     * @see  assertSelectedId      Related Assertion
     * @see  getSelectedId         Related Accessor
     * @see  verifyNotSelectedId   Related Assertion
     * @see  verifySelectedId      Related Assertion
     * @see  waitForNotSelectedId  Related Assertion
     * @see  waitForSelectedId     Related Assertion
     */
    public function storeSelectedId($selectLocator, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets option element ID for selected option in the specified select element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the selected option ID in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotSelectedId}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedId       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedId   Related Assertion
     * @see  assertSelectedId      Related Assertion
     * @see  getSelectedId         Related Accessor
     * @see  verifySelectedId      Related Assertion
     * @see  waitForNotSelectedId  Related Assertion
     * @see  waitForSelectedId     Related Assertion
     */
    public function verifyNotSelectedId($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets option element ID for selected option in the specified select element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the selected option ID in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertSelectedId}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedId       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedId   Related Assertion
     * @see  assertSelectedId      Related Assertion
     * @see  getSelectedId         Related Accessor
     * @see  verifyNotSelectedId   Related Assertion
     * @see  waitForNotSelectedId  Related Assertion
     * @see  waitForSelectedId     Related Assertion
     */
    public function verifySelectedId($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets option element ID for selected option in the specified select element.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the selected option ID in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedId      Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedId  Related Assertion
     * @see  assertSelectedId     Related Assertion
     * @see  getSelectedId        Related Accessor
     * @see  verifyNotSelectedId  Related Assertion
     * @see  verifySelectedId     Related Assertion
     * @see  waitForSelectedId    Related Assertion
     */
    public function waitForNotSelectedId($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets option element ID for selected option in the specified select element.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the selected option ID in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedId       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedId   Related Assertion
     * @see  assertSelectedId      Related Assertion
     * @see  getSelectedId         Related Accessor
     * @see  verifyNotSelectedId   Related Assertion
     * @see  verifySelectedId      Related Assertion
     * @see  waitForNotSelectedId  Related Assertion
     */
    public function waitForSelectedId($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option element IDs for selected options in the specified select or multi-select element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>an array of all selected option IDs in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotSelectedIds}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedIds       Base method, from which has been generated (automatically) current method
     * @see  assertSelectedIds      Related Assertion
     * @see  getSelectedIds         Related Accessor
     * @see  verifyNotSelectedIds   Related Assertion
     * @see  verifySelectedIds      Related Assertion
     * @see  waitForNotSelectedIds  Related Assertion
     * @see  waitForSelectedIds     Related Assertion
     */
    public function assertNotSelectedIds($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option element IDs for selected options in the specified select or multi-select element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>an array of all selected option IDs in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifySelectedIds}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedIds       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedIds   Related Assertion
     * @see  getSelectedIds         Related Accessor
     * @see  verifyNotSelectedIds   Related Assertion
     * @see  verifySelectedIds      Related Assertion
     * @see  waitForNotSelectedIds  Related Assertion
     * @see  waitForSelectedIds     Related Assertion
     */
    public function assertSelectedIds($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets all option element IDs for selected options in the specified select or multi-select element.
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * 
     * @return  string[]  an array of all selected option IDs in the specified select drop-down
     * 
     * @see  storeSelectedIds       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedIds   Related Assertion
     * @see  assertSelectedIds      Related Assertion
     * @see  verifyNotSelectedIds   Related Assertion
     * @see  verifySelectedIds      Related Assertion
     * @see  waitForNotSelectedIds  Related Assertion
     * @see  waitForSelectedIds     Related Assertion
     */
    public function getSelectedIds($selectLocator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets all option element IDs for selected options in the specified select or multi-select element.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>an array of all selected option IDs in the specified select drop-down (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $variableName   the name of a variable in which the result is to be stored. (see
     *                                 {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertNotSelectedIds   Related Assertion
     * @see  assertSelectedIds      Related Assertion
     * @see  getSelectedIds         Related Accessor
     * @see  verifyNotSelectedIds   Related Assertion
     * @see  verifySelectedIds      Related Assertion
     * @see  waitForNotSelectedIds  Related Assertion
     * @see  waitForSelectedIds     Related Assertion
     */
    public function storeSelectedIds($selectLocator, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option element IDs for selected options in the specified select or multi-select element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>an array of all selected option IDs in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotSelectedIds}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedIds       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedIds   Related Assertion
     * @see  assertSelectedIds      Related Assertion
     * @see  getSelectedIds         Related Accessor
     * @see  verifySelectedIds      Related Assertion
     * @see  waitForNotSelectedIds  Related Assertion
     * @see  waitForSelectedIds     Related Assertion
     */
    public function verifyNotSelectedIds($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option element IDs for selected options in the specified select or multi-select element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>an array of all selected option IDs in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertSelectedIds}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedIds       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedIds   Related Assertion
     * @see  assertSelectedIds      Related Assertion
     * @see  getSelectedIds         Related Accessor
     * @see  verifyNotSelectedIds   Related Assertion
     * @see  waitForNotSelectedIds  Related Assertion
     * @see  waitForSelectedIds     Related Assertion
     */
    public function verifySelectedIds($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option element IDs for selected options in the specified select or multi-select element.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>an array of all selected option IDs in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedIds      Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedIds  Related Assertion
     * @see  assertSelectedIds     Related Assertion
     * @see  getSelectedIds        Related Accessor
     * @see  verifyNotSelectedIds  Related Assertion
     * @see  verifySelectedIds     Related Assertion
     * @see  waitForSelectedIds    Related Assertion
     */
    public function waitForNotSelectedIds($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option element IDs for selected options in the specified select or multi-select element.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>an array of all selected option IDs in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedIds       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedIds   Related Assertion
     * @see  assertSelectedIds      Related Assertion
     * @see  getSelectedIds         Related Accessor
     * @see  verifyNotSelectedIds   Related Assertion
     * @see  verifySelectedIds      Related Assertion
     * @see  waitForNotSelectedIds  Related Assertion
     */
    public function waitForSelectedIds($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets option index (option number, starting at 0) for selected option in the specified select element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the selected option index in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotSelectedIndex}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedIndex       Base method, from which has been generated (automatically) current method
     * @see  assertSelectedIndex      Related Assertion
     * @see  getSelectedIndex         Related Accessor
     * @see  verifyNotSelectedIndex   Related Assertion
     * @see  verifySelectedIndex      Related Assertion
     * @see  waitForNotSelectedIndex  Related Assertion
     * @see  waitForSelectedIndex     Related Assertion
     */
    public function assertNotSelectedIndex($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets option index (option number, starting at 0) for selected option in the specified select element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the selected option index in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifySelectedIndex}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedIndex       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedIndex   Related Assertion
     * @see  getSelectedIndex         Related Accessor
     * @see  verifyNotSelectedIndex   Related Assertion
     * @see  verifySelectedIndex      Related Assertion
     * @see  waitForNotSelectedIndex  Related Assertion
     * @see  waitForSelectedIndex     Related Assertion
     */
    public function assertSelectedIndex($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets option index (option number, starting at 0) for selected option in the specified select element.
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * 
     * @return  string  the selected option index in the specified select drop-down
     * 
     * @see  storeSelectedIndex       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedIndex   Related Assertion
     * @see  assertSelectedIndex      Related Assertion
     * @see  verifyNotSelectedIndex   Related Assertion
     * @see  verifySelectedIndex      Related Assertion
     * @see  waitForNotSelectedIndex  Related Assertion
     * @see  waitForSelectedIndex     Related Assertion
     */
    public function getSelectedIndex($selectLocator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets option index (option number, starting at 0) for selected option in the specified select element.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>the selected option index in the specified select drop-down (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $variableName   the name of a variable in which the result is to be stored. (see
     *                                 {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertNotSelectedIndex   Related Assertion
     * @see  assertSelectedIndex      Related Assertion
     * @see  getSelectedIndex         Related Accessor
     * @see  verifyNotSelectedIndex   Related Assertion
     * @see  verifySelectedIndex      Related Assertion
     * @see  waitForNotSelectedIndex  Related Assertion
     * @see  waitForSelectedIndex     Related Assertion
     */
    public function storeSelectedIndex($selectLocator, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets option index (option number, starting at 0) for selected option in the specified select element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the selected option index in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotSelectedIndex}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedIndex       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedIndex   Related Assertion
     * @see  assertSelectedIndex      Related Assertion
     * @see  getSelectedIndex         Related Accessor
     * @see  verifySelectedIndex      Related Assertion
     * @see  waitForNotSelectedIndex  Related Assertion
     * @see  waitForSelectedIndex     Related Assertion
     */
    public function verifyNotSelectedIndex($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets option index (option number, starting at 0) for selected option in the specified select element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the selected option index in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertSelectedIndex}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedIndex       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedIndex   Related Assertion
     * @see  assertSelectedIndex      Related Assertion
     * @see  getSelectedIndex         Related Accessor
     * @see  verifyNotSelectedIndex   Related Assertion
     * @see  waitForNotSelectedIndex  Related Assertion
     * @see  waitForSelectedIndex     Related Assertion
     */
    public function verifySelectedIndex($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets option index (option number, starting at 0) for selected option in the specified select element.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the selected option index in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedIndex      Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedIndex  Related Assertion
     * @see  assertSelectedIndex     Related Assertion
     * @see  getSelectedIndex        Related Accessor
     * @see  verifyNotSelectedIndex  Related Assertion
     * @see  verifySelectedIndex     Related Assertion
     * @see  waitForSelectedIndex    Related Assertion
     */
    public function waitForNotSelectedIndex($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets option index (option number, starting at 0) for selected option in the specified select element.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the selected option index in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedIndex       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedIndex   Related Assertion
     * @see  assertSelectedIndex      Related Assertion
     * @see  getSelectedIndex         Related Accessor
     * @see  verifyNotSelectedIndex   Related Assertion
     * @see  verifySelectedIndex      Related Assertion
     * @see  waitForNotSelectedIndex  Related Assertion
     */
    public function waitForSelectedIndex($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option indexes (option number, starting at 0) for selected options in the specified select
     * or multi-select element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>an array of all selected option indexes in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotSelectedIndexes}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedIndexes       Base method, from which has been generated (automatically) current method
     * @see  assertSelectedIndexes      Related Assertion
     * @see  getSelectedIndexes         Related Accessor
     * @see  verifyNotSelectedIndexes   Related Assertion
     * @see  verifySelectedIndexes      Related Assertion
     * @see  waitForNotSelectedIndexes  Related Assertion
     * @see  waitForSelectedIndexes     Related Assertion
     */
    public function assertNotSelectedIndexes($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option indexes (option number, starting at 0) for selected options in the specified select
     * or multi-select element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>an array of all selected option indexes in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifySelectedIndexes}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedIndexes       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedIndexes   Related Assertion
     * @see  getSelectedIndexes         Related Accessor
     * @see  verifyNotSelectedIndexes   Related Assertion
     * @see  verifySelectedIndexes      Related Assertion
     * @see  waitForNotSelectedIndexes  Related Assertion
     * @see  waitForSelectedIndexes     Related Assertion
     */
    public function assertSelectedIndexes($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets all option indexes (option number, starting at 0) for selected options in the specified select or
     * multi-select element.
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * 
     * @return  string[]  an array of all selected option indexes in the specified select drop-down
     * 
     * @see  storeSelectedIndexes       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedIndexes   Related Assertion
     * @see  assertSelectedIndexes      Related Assertion
     * @see  verifyNotSelectedIndexes   Related Assertion
     * @see  verifySelectedIndexes      Related Assertion
     * @see  waitForNotSelectedIndexes  Related Assertion
     * @see  waitForSelectedIndexes     Related Assertion
     */
    public function getSelectedIndexes($selectLocator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets all option indexes (option number, starting at 0) for selected options in the specified select or
     * multi-select element.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>an array of all selected option indexes in the specified select drop-down (see
     * {@link doc_Stored_Variables})</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $variableName   the name of a variable in which the result is to be stored. (see
     *                                 {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertNotSelectedIndexes   Related Assertion
     * @see  assertSelectedIndexes      Related Assertion
     * @see  getSelectedIndexes         Related Accessor
     * @see  verifyNotSelectedIndexes   Related Assertion
     * @see  verifySelectedIndexes      Related Assertion
     * @see  waitForNotSelectedIndexes  Related Assertion
     * @see  waitForSelectedIndexes     Related Assertion
     */
    public function storeSelectedIndexes($selectLocator, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option indexes (option number, starting at 0) for selected options in the specified select
     * or multi-select element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>an array of all selected option indexes in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotSelectedIndexes}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedIndexes       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedIndexes   Related Assertion
     * @see  assertSelectedIndexes      Related Assertion
     * @see  getSelectedIndexes         Related Accessor
     * @see  verifySelectedIndexes      Related Assertion
     * @see  waitForNotSelectedIndexes  Related Assertion
     * @see  waitForSelectedIndexes     Related Assertion
     */
    public function verifyNotSelectedIndexes($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option indexes (option number, starting at 0) for selected options in the specified select
     * or multi-select element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>an array of all selected option indexes in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertSelectedIndexes}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedIndexes       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedIndexes   Related Assertion
     * @see  assertSelectedIndexes      Related Assertion
     * @see  getSelectedIndexes         Related Accessor
     * @see  verifyNotSelectedIndexes   Related Assertion
     * @see  waitForNotSelectedIndexes  Related Assertion
     * @see  waitForSelectedIndexes     Related Assertion
     */
    public function verifySelectedIndexes($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option indexes (option number, starting at 0) for selected options in the specified select
     * or multi-select element.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>an array of all selected option indexes in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedIndexes      Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedIndexes  Related Assertion
     * @see  assertSelectedIndexes     Related Assertion
     * @see  getSelectedIndexes        Related Accessor
     * @see  verifyNotSelectedIndexes  Related Assertion
     * @see  verifySelectedIndexes     Related Assertion
     * @see  waitForSelectedIndexes    Related Assertion
     */
    public function waitForNotSelectedIndexes($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option indexes (option number, starting at 0) for selected options in the specified select
     * or multi-select element.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>an array of all selected option indexes in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedIndexes       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedIndexes   Related Assertion
     * @see  assertSelectedIndexes      Related Assertion
     * @see  getSelectedIndexes         Related Accessor
     * @see  verifyNotSelectedIndexes   Related Assertion
     * @see  verifySelectedIndexes      Related Assertion
     * @see  waitForNotSelectedIndexes  Related Assertion
     */
    public function waitForSelectedIndexes($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets option label (visible text) for selected option in the specified select element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the selected option label in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotSelectedLabel}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedLabel       Base method, from which has been generated (automatically) current method
     * @see  assertSelectedLabel      Related Assertion
     * @see  getSelectedLabel         Related Accessor
     * @see  verifyNotSelectedLabel   Related Assertion
     * @see  verifySelectedLabel      Related Assertion
     * @see  waitForNotSelectedLabel  Related Assertion
     * @see  waitForSelectedLabel     Related Assertion
     */
    public function assertNotSelectedLabel($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets option label (visible text) for selected option in the specified select element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the selected option label in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifySelectedLabel}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedLabel       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedLabel   Related Assertion
     * @see  getSelectedLabel         Related Accessor
     * @see  verifyNotSelectedLabel   Related Assertion
     * @see  verifySelectedLabel      Related Assertion
     * @see  waitForNotSelectedLabel  Related Assertion
     * @see  waitForSelectedLabel     Related Assertion
     */
    public function assertSelectedLabel($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets option label (visible text) for selected option in the specified select element.
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * 
     * @return  string  the selected option label in the specified select drop-down
     * 
     * @see  storeSelectedLabel       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedLabel   Related Assertion
     * @see  assertSelectedLabel      Related Assertion
     * @see  verifyNotSelectedLabel   Related Assertion
     * @see  verifySelectedLabel      Related Assertion
     * @see  waitForNotSelectedLabel  Related Assertion
     * @see  waitForSelectedLabel     Related Assertion
     */
    public function getSelectedLabel($selectLocator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets option label (visible text) for selected option in the specified select element.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>the selected option label in the specified select drop-down (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $variableName   the name of a variable in which the result is to be stored. (see
     *                                 {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertNotSelectedLabel   Related Assertion
     * @see  assertSelectedLabel      Related Assertion
     * @see  getSelectedLabel         Related Accessor
     * @see  verifyNotSelectedLabel   Related Assertion
     * @see  verifySelectedLabel      Related Assertion
     * @see  waitForNotSelectedLabel  Related Assertion
     * @see  waitForSelectedLabel     Related Assertion
     */
    public function storeSelectedLabel($selectLocator, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets option label (visible text) for selected option in the specified select element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the selected option label in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotSelectedLabel}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedLabel       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedLabel   Related Assertion
     * @see  assertSelectedLabel      Related Assertion
     * @see  getSelectedLabel         Related Accessor
     * @see  verifySelectedLabel      Related Assertion
     * @see  waitForNotSelectedLabel  Related Assertion
     * @see  waitForSelectedLabel     Related Assertion
     */
    public function verifyNotSelectedLabel($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets option label (visible text) for selected option in the specified select element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the selected option label in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertSelectedLabel}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedLabel       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedLabel   Related Assertion
     * @see  assertSelectedLabel      Related Assertion
     * @see  getSelectedLabel         Related Accessor
     * @see  verifyNotSelectedLabel   Related Assertion
     * @see  waitForNotSelectedLabel  Related Assertion
     * @see  waitForSelectedLabel     Related Assertion
     */
    public function verifySelectedLabel($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets option label (visible text) for selected option in the specified select element.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the selected option label in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedLabel      Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedLabel  Related Assertion
     * @see  assertSelectedLabel     Related Assertion
     * @see  getSelectedLabel        Related Accessor
     * @see  verifyNotSelectedLabel  Related Assertion
     * @see  verifySelectedLabel     Related Assertion
     * @see  waitForSelectedLabel    Related Assertion
     */
    public function waitForNotSelectedLabel($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets option label (visible text) for selected option in the specified select element.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the selected option label in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedLabel       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedLabel   Related Assertion
     * @see  assertSelectedLabel      Related Assertion
     * @see  getSelectedLabel         Related Accessor
     * @see  verifyNotSelectedLabel   Related Assertion
     * @see  verifySelectedLabel      Related Assertion
     * @see  waitForNotSelectedLabel  Related Assertion
     */
    public function waitForSelectedLabel($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option labels (visible text) for selected options in the specified select or multi-select
     * element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>an array of all selected option labels in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotSelectedLabels}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedLabels       Base method, from which has been generated (automatically) current method
     * @see  assertSelectedLabels      Related Assertion
     * @see  getSelectedLabels         Related Accessor
     * @see  verifyNotSelectedLabels   Related Assertion
     * @see  verifySelectedLabels      Related Assertion
     * @see  waitForNotSelectedLabels  Related Assertion
     * @see  waitForSelectedLabels     Related Assertion
     */
    public function assertNotSelectedLabels($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option labels (visible text) for selected options in the specified select or multi-select
     * element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>an array of all selected option labels in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifySelectedLabels}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedLabels       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedLabels   Related Assertion
     * @see  getSelectedLabels         Related Accessor
     * @see  verifyNotSelectedLabels   Related Assertion
     * @see  verifySelectedLabels      Related Assertion
     * @see  waitForNotSelectedLabels  Related Assertion
     * @see  waitForSelectedLabels     Related Assertion
     */
    public function assertSelectedLabels($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets all option labels (visible text) for selected options in the specified select or multi-select element.
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * 
     * @return  string[]  an array of all selected option labels in the specified select drop-down
     * 
     * @see  storeSelectedLabels       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedLabels   Related Assertion
     * @see  assertSelectedLabels      Related Assertion
     * @see  verifyNotSelectedLabels   Related Assertion
     * @see  verifySelectedLabels      Related Assertion
     * @see  waitForNotSelectedLabels  Related Assertion
     * @see  waitForSelectedLabels     Related Assertion
     */
    public function getSelectedLabels($selectLocator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets all option labels (visible text) for selected options in the specified select or multi-select element.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>an array of all selected option labels in the specified select drop-down (see
     * {@link doc_Stored_Variables})</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $variableName   the name of a variable in which the result is to be stored. (see
     *                                 {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertNotSelectedLabels   Related Assertion
     * @see  assertSelectedLabels      Related Assertion
     * @see  getSelectedLabels         Related Accessor
     * @see  verifyNotSelectedLabels   Related Assertion
     * @see  verifySelectedLabels      Related Assertion
     * @see  waitForNotSelectedLabels  Related Assertion
     * @see  waitForSelectedLabels     Related Assertion
     */
    public function storeSelectedLabels($selectLocator, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option labels (visible text) for selected options in the specified select or multi-select
     * element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>an array of all selected option labels in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotSelectedLabels}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedLabels       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedLabels   Related Assertion
     * @see  assertSelectedLabels      Related Assertion
     * @see  getSelectedLabels         Related Accessor
     * @see  verifySelectedLabels      Related Assertion
     * @see  waitForNotSelectedLabels  Related Assertion
     * @see  waitForSelectedLabels     Related Assertion
     */
    public function verifyNotSelectedLabels($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option labels (visible text) for selected options in the specified select or multi-select
     * element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>an array of all selected option labels in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertSelectedLabels}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedLabels       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedLabels   Related Assertion
     * @see  assertSelectedLabels      Related Assertion
     * @see  getSelectedLabels         Related Accessor
     * @see  verifyNotSelectedLabels   Related Assertion
     * @see  waitForNotSelectedLabels  Related Assertion
     * @see  waitForSelectedLabels     Related Assertion
     */
    public function verifySelectedLabels($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option labels (visible text) for selected options in the specified select or multi-select
     * element.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>an array of all selected option labels in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedLabels      Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedLabels  Related Assertion
     * @see  assertSelectedLabels     Related Assertion
     * @see  getSelectedLabels        Related Accessor
     * @see  verifyNotSelectedLabels  Related Assertion
     * @see  verifySelectedLabels     Related Assertion
     * @see  waitForSelectedLabels    Related Assertion
     */
    public function waitForNotSelectedLabels($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option labels (visible text) for selected options in the specified select or multi-select
     * element.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>an array of all selected option labels in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedLabels       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedLabels   Related Assertion
     * @see  assertSelectedLabels      Related Assertion
     * @see  getSelectedLabels         Related Accessor
     * @see  verifyNotSelectedLabels   Related Assertion
     * @see  verifySelectedLabels      Related Assertion
     * @see  waitForNotSelectedLabels  Related Assertion
     */
    public function waitForSelectedLabels($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets option value (value attribute) for selected option in the specified select element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the selected option value in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotSelectedValue}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedValue       Base method, from which has been generated (automatically) current method
     * @see  assertSelectedValue      Related Assertion
     * @see  getSelectedValue         Related Accessor
     * @see  verifyNotSelectedValue   Related Assertion
     * @see  verifySelectedValue      Related Assertion
     * @see  waitForNotSelectedValue  Related Assertion
     * @see  waitForSelectedValue     Related Assertion
     */
    public function assertNotSelectedValue($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets option value (value attribute) for selected option in the specified select element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the selected option value in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifySelectedValue}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedValue       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedValue   Related Assertion
     * @see  getSelectedValue         Related Accessor
     * @see  verifyNotSelectedValue   Related Assertion
     * @see  verifySelectedValue      Related Assertion
     * @see  waitForNotSelectedValue  Related Assertion
     * @see  waitForSelectedValue     Related Assertion
     */
    public function assertSelectedValue($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets option value (value attribute) for selected option in the specified select element.
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * 
     * @return  string  the selected option value in the specified select drop-down
     * 
     * @see  storeSelectedValue       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedValue   Related Assertion
     * @see  assertSelectedValue      Related Assertion
     * @see  verifyNotSelectedValue   Related Assertion
     * @see  verifySelectedValue      Related Assertion
     * @see  waitForNotSelectedValue  Related Assertion
     * @see  waitForSelectedValue     Related Assertion
     */
    public function getSelectedValue($selectLocator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets option value (value attribute) for selected option in the specified select element.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>the selected option value in the specified select drop-down (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $variableName   the name of a variable in which the result is to be stored. (see
     *                                 {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertNotSelectedValue   Related Assertion
     * @see  assertSelectedValue      Related Assertion
     * @see  getSelectedValue         Related Accessor
     * @see  verifyNotSelectedValue   Related Assertion
     * @see  verifySelectedValue      Related Assertion
     * @see  waitForNotSelectedValue  Related Assertion
     * @see  waitForSelectedValue     Related Assertion
     */
    public function storeSelectedValue($selectLocator, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets option value (value attribute) for selected option in the specified select element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the selected option value in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotSelectedValue}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedValue       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedValue   Related Assertion
     * @see  assertSelectedValue      Related Assertion
     * @see  getSelectedValue         Related Accessor
     * @see  verifySelectedValue      Related Assertion
     * @see  waitForNotSelectedValue  Related Assertion
     * @see  waitForSelectedValue     Related Assertion
     */
    public function verifyNotSelectedValue($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets option value (value attribute) for selected option in the specified select element.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the selected option value in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertSelectedValue}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedValue       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedValue   Related Assertion
     * @see  assertSelectedValue      Related Assertion
     * @see  getSelectedValue         Related Accessor
     * @see  verifyNotSelectedValue   Related Assertion
     * @see  waitForNotSelectedValue  Related Assertion
     * @see  waitForSelectedValue     Related Assertion
     */
    public function verifySelectedValue($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets option value (value attribute) for selected option in the specified select element.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the selected option value in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedValue      Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedValue  Related Assertion
     * @see  assertSelectedValue     Related Assertion
     * @see  getSelectedValue        Related Accessor
     * @see  verifyNotSelectedValue  Related Assertion
     * @see  verifySelectedValue     Related Assertion
     * @see  waitForSelectedValue    Related Assertion
     */
    public function waitForNotSelectedValue($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets option value (value attribute) for selected option in the specified select element.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the selected option value in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedValue       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedValue   Related Assertion
     * @see  assertSelectedValue      Related Assertion
     * @see  getSelectedValue         Related Accessor
     * @see  verifyNotSelectedValue   Related Assertion
     * @see  verifySelectedValue      Related Assertion
     * @see  waitForNotSelectedValue  Related Assertion
     */
    public function waitForSelectedValue($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option values (value attributes) for selected options in the specified select or
     * multi-select element. 
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>an array of all selected option values in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotSelectedValues}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedValues       Base method, from which has been generated (automatically) current method
     * @see  assertSelectedValues      Related Assertion
     * @see  getSelectedValues         Related Accessor
     * @see  verifyNotSelectedValues   Related Assertion
     * @see  verifySelectedValues      Related Assertion
     * @see  waitForNotSelectedValues  Related Assertion
     * @see  waitForSelectedValues     Related Assertion
     */
    public function assertNotSelectedValues($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option values (value attributes) for selected options in the specified select or
     * multi-select element. 
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>an array of all selected option values in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifySelectedValues}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedValues       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedValues   Related Assertion
     * @see  getSelectedValues         Related Accessor
     * @see  verifyNotSelectedValues   Related Assertion
     * @see  verifySelectedValues      Related Assertion
     * @see  waitForNotSelectedValues  Related Assertion
     * @see  waitForSelectedValues     Related Assertion
     */
    public function assertSelectedValues($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets all option values (value attributes) for selected options in the specified select or multi-select element. 
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * 
     * @return  string[]  an array of all selected option values in the specified select drop-down
     * 
     * @see  storeSelectedValues       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedValues   Related Assertion
     * @see  assertSelectedValues      Related Assertion
     * @see  verifyNotSelectedValues   Related Assertion
     * @see  verifySelectedValues      Related Assertion
     * @see  waitForNotSelectedValues  Related Assertion
     * @see  waitForSelectedValues     Related Assertion
     */
    public function getSelectedValues($selectLocator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets all option values (value attributes) for selected options in the specified select or multi-select element. 
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>an array of all selected option values in the specified select drop-down (see
     * {@link doc_Stored_Variables})</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $variableName   the name of a variable in which the result is to be stored. (see
     *                                 {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertNotSelectedValues   Related Assertion
     * @see  assertSelectedValues      Related Assertion
     * @see  getSelectedValues         Related Accessor
     * @see  verifyNotSelectedValues   Related Assertion
     * @see  verifySelectedValues      Related Assertion
     * @see  waitForNotSelectedValues  Related Assertion
     * @see  waitForSelectedValues     Related Assertion
     */
    public function storeSelectedValues($selectLocator, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option values (value attributes) for selected options in the specified select or
     * multi-select element. 
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>an array of all selected option values in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotSelectedValues}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedValues       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedValues   Related Assertion
     * @see  assertSelectedValues      Related Assertion
     * @see  getSelectedValues         Related Accessor
     * @see  verifySelectedValues      Related Assertion
     * @see  waitForNotSelectedValues  Related Assertion
     * @see  waitForSelectedValues     Related Assertion
     */
    public function verifyNotSelectedValues($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option values (value attributes) for selected options in the specified select or
     * multi-select element. 
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>an array of all selected option values in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertSelectedValues}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedValues       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedValues   Related Assertion
     * @see  assertSelectedValues      Related Assertion
     * @see  getSelectedValues         Related Accessor
     * @see  verifyNotSelectedValues   Related Assertion
     * @see  waitForNotSelectedValues  Related Assertion
     * @see  waitForSelectedValues     Related Assertion
     */
    public function verifySelectedValues($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option values (value attributes) for selected options in the specified select or
     * multi-select element. 
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>an array of all selected option values in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedValues      Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedValues  Related Assertion
     * @see  assertSelectedValues     Related Assertion
     * @see  getSelectedValues        Related Accessor
     * @see  verifyNotSelectedValues  Related Assertion
     * @see  verifySelectedValues     Related Assertion
     * @see  waitForSelectedValues    Related Assertion
     */
    public function waitForNotSelectedValues($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets all option values (value attributes) for selected options in the specified select or
     * multi-select element. 
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>an array of all selected option values in the specified select drop-down</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $pattern        the String-match Patterns 
     *                                 (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSelectedValues       Base method, from which has been generated (automatically) current method
     * @see  assertNotSelectedValues   Related Assertion
     * @see  assertSelectedValues      Related Assertion
     * @see  getSelectedValues         Related Accessor
     * @see  verifyNotSelectedValues   Related Assertion
     * @see  verifySelectedValues      Related Assertion
     * @see  waitForNotSelectedValues  Related Assertion
     */
    public function waitForSelectedValues($selectLocator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determines whether some option in a drop-down menu is selected.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if some option has been selected, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotSomethingSelected}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeSomethingSelected       Base method, from which has been generated (automatically) current method
     * @see  assertSomethingSelected      Related Assertion
     * @see  isSomethingSelected          Related Accessor
     * @see  verifyNotSomethingSelected   Related Assertion
     * @see  verifySomethingSelected      Related Assertion
     * @see  waitForNotSomethingSelected  Related Assertion
     * @see  waitForSomethingSelected     Related Assertion
     */
    public function assertNotSomethingSelected($selectLocator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determines whether some option in a drop-down menu is selected.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if some option has been selected, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifySomethingSelected}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeSomethingSelected       Base method, from which has been generated (automatically) current method
     * @see  assertNotSomethingSelected   Related Assertion
     * @see  isSomethingSelected          Related Accessor
     * @see  verifyNotSomethingSelected   Related Assertion
     * @see  verifySomethingSelected      Related Assertion
     * @see  waitForNotSomethingSelected  Related Assertion
     * @see  waitForSomethingSelected     Related Assertion
     */
    public function assertSomethingSelected($selectLocator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Determines whether some option in a drop-down menu is selected.
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * 
     * @return  bool  true if some option has been selected, false otherwise
     * 
     * @see  storeSomethingSelected       Base method, from which has been generated (automatically) current method
     * @see  assertNotSomethingSelected   Related Assertion
     * @see  assertSomethingSelected      Related Assertion
     * @see  verifyNotSomethingSelected   Related Assertion
     * @see  verifySomethingSelected      Related Assertion
     * @see  waitForNotSomethingSelected  Related Assertion
     * @see  waitForSomethingSelected     Related Assertion
     */
    public function isSomethingSelected($selectLocator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Determines whether some option in a drop-down menu is selected.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>true if some option has been selected, false otherwise (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $variableName   the name of a variable in which the result is to be stored. (see
     *                                 {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertNotSomethingSelected   Related Assertion
     * @see  assertSomethingSelected      Related Assertion
     * @see  isSomethingSelected          Related Accessor
     * @see  verifyNotSomethingSelected   Related Assertion
     * @see  verifySomethingSelected      Related Assertion
     * @see  waitForNotSomethingSelected  Related Assertion
     * @see  waitForSomethingSelected     Related Assertion
     */
    public function storeSomethingSelected($selectLocator, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determines whether some option in a drop-down menu is selected.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if some option has been selected, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotSomethingSelected}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeSomethingSelected       Base method, from which has been generated (automatically) current method
     * @see  assertNotSomethingSelected   Related Assertion
     * @see  assertSomethingSelected      Related Assertion
     * @see  isSomethingSelected          Related Accessor
     * @see  verifySomethingSelected      Related Assertion
     * @see  waitForNotSomethingSelected  Related Assertion
     * @see  waitForSomethingSelected     Related Assertion
     */
    public function verifyNotSomethingSelected($selectLocator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determines whether some option in a drop-down menu is selected.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if some option has been selected, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertSomethingSelected}).</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeSomethingSelected       Base method, from which has been generated (automatically) current method
     * @see  assertNotSomethingSelected   Related Assertion
     * @see  assertSomethingSelected      Related Assertion
     * @see  isSomethingSelected          Related Accessor
     * @see  verifyNotSomethingSelected   Related Assertion
     * @see  waitForNotSomethingSelected  Related Assertion
     * @see  waitForSomethingSelected     Related Assertion
     */
    public function verifySomethingSelected($selectLocator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determines whether some option in a drop-down menu is selected.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>true if some option has been selected, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeSomethingSelected      Base method, from which has been generated (automatically) current method
     * @see  assertNotSomethingSelected  Related Assertion
     * @see  assertSomethingSelected     Related Assertion
     * @see  isSomethingSelected         Related Accessor
     * @see  verifyNotSomethingSelected  Related Assertion
     * @see  verifySomethingSelected     Related Assertion
     * @see  waitForSomethingSelected    Related Assertion
     */
    public function waitForNotSomethingSelected($selectLocator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determines whether some option in a drop-down menu is selected.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>true if some option has been selected, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeSomethingSelected       Base method, from which has been generated (automatically) current method
     * @see  assertNotSomethingSelected   Related Assertion
     * @see  assertSomethingSelected      Related Assertion
     * @see  isSomethingSelected          Related Accessor
     * @see  verifyNotSomethingSelected   Related Assertion
     * @see  verifySomethingSelected      Related Assertion
     * @see  waitForNotSomethingSelected  Related Assertion
     */
    public function waitForSomethingSelected($selectLocator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Get execution speed (i.e., get the millisecond length of the delay following each selenium
     * operation). 
     * 
     * By default, there is no such delay, i.e., the delay is 0 milliseconds. See also setSpeed.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the execution speed in milliseconds.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotSpeed}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSpeed       Base method, from which has been generated (automatically) current method
     * @see  assertSpeed      Related Assertion
     * @see  getSpeed         Related Accessor
     * @see  verifyNotSpeed   Related Assertion
     * @see  verifySpeed      Related Assertion
     * @see  waitForNotSpeed  Related Assertion
     * @see  waitForSpeed     Related Assertion
     */
    public function assertNotSpeed($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Get execution speed (i.e., get the millisecond length of the delay following each selenium
     * operation). 
     * 
     * By default, there is no such delay, i.e., the delay is 0 milliseconds. See also setSpeed.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the execution speed in milliseconds.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifySpeed}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSpeed       Base method, from which has been generated (automatically) current method
     * @see  assertNotSpeed   Related Assertion
     * @see  getSpeed         Related Accessor
     * @see  verifyNotSpeed   Related Assertion
     * @see  verifySpeed      Related Assertion
     * @see  waitForNotSpeed  Related Assertion
     * @see  waitForSpeed     Related Assertion
     */
    public function assertSpeed($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Get execution speed (i.e., get the millisecond length of the delay following each selenium operation). 
     * 
     * By default, there is no such delay, i.e., the delay is 0 milliseconds. See also setSpeed.
     * 
     * @return  void  the execution speed in milliseconds.
     * 
     * @see  storeSpeed       Base method, from which has been generated (automatically) current method
     * @see  assertNotSpeed   Related Assertion
     * @see  assertSpeed      Related Assertion
     * @see  verifyNotSpeed   Related Assertion
     * @see  verifySpeed      Related Assertion
     * @see  waitForNotSpeed  Related Assertion
     * @see  waitForSpeed     Related Assertion
     */
    public function getSpeed()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Get execution speed (i.e., get the millisecond length of the delay following each selenium operation). 
     * 
     * By default, there is no such delay, i.e., the delay is 0 milliseconds. See also setSpeed.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>the execution speed in milliseconds. (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $variableName  the name of a variable in which the result is to be stored (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertNotSpeed   Related Assertion
     * @see  assertSpeed      Related Assertion
     * @see  getSpeed         Related Accessor
     * @see  verifyNotSpeed   Related Assertion
     * @see  verifySpeed      Related Assertion
     * @see  waitForNotSpeed  Related Assertion
     * @see  waitForSpeed     Related Assertion
     */
    public function storeSpeed($variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Get execution speed (i.e., get the millisecond length of the delay following each selenium
     * operation). 
     * 
     * By default, there is no such delay, i.e., the delay is 0 milliseconds. See also setSpeed.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the execution speed in milliseconds.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotSpeed}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSpeed       Base method, from which has been generated (automatically) current method
     * @see  assertNotSpeed   Related Assertion
     * @see  assertSpeed      Related Assertion
     * @see  getSpeed         Related Accessor
     * @see  verifySpeed      Related Assertion
     * @see  waitForNotSpeed  Related Assertion
     * @see  waitForSpeed     Related Assertion
     */
    public function verifyNotSpeed($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Get execution speed (i.e., get the millisecond length of the delay following each selenium
     * operation). 
     * 
     * By default, there is no such delay, i.e., the delay is 0 milliseconds. See also setSpeed.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the execution speed in milliseconds.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertSpeed}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSpeed       Base method, from which has been generated (automatically) current method
     * @see  assertNotSpeed   Related Assertion
     * @see  assertSpeed      Related Assertion
     * @see  getSpeed         Related Accessor
     * @see  verifyNotSpeed   Related Assertion
     * @see  waitForNotSpeed  Related Assertion
     * @see  waitForSpeed     Related Assertion
     */
    public function verifySpeed($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Get execution speed (i.e., get the millisecond length of the delay following each selenium
     * operation). 
     * 
     * By default, there is no such delay, i.e., the delay is 0 milliseconds. See also setSpeed.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the execution speed in milliseconds.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSpeed      Base method, from which has been generated (automatically) current method
     * @see  assertNotSpeed  Related Assertion
     * @see  assertSpeed     Related Assertion
     * @see  getSpeed        Related Accessor
     * @see  verifyNotSpeed  Related Assertion
     * @see  verifySpeed     Related Assertion
     * @see  waitForSpeed    Related Assertion
     */
    public function waitForNotSpeed($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Get execution speed (i.e., get the millisecond length of the delay following each selenium
     * operation). 
     * 
     * By default, there is no such delay, i.e., the delay is 0 milliseconds. See also setSpeed.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the execution speed in milliseconds.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeSpeed       Base method, from which has been generated (automatically) current method
     * @see  assertNotSpeed   Related Assertion
     * @see  assertSpeed      Related Assertion
     * @see  getSpeed         Related Accessor
     * @see  verifyNotSpeed   Related Assertion
     * @see  verifySpeed      Related Assertion
     * @see  waitForNotSpeed  Related Assertion
     */
    public function waitForSpeed($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the text from a cell of a table. 
     * 
     * The cellAddress syntax tableLocator.row.column, where row and column start at 0.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the text from the specified cell</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotTable}).</p>
     * 
     * @param string   $tableCellAddress  a cell address, e.g. "foo.1.4"
     * @param string   $pattern           the String-match Patterns 
     *                                    (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeTable       Base method, from which has been generated (automatically) current method
     * @see  assertTable      Related Assertion
     * @see  getTable         Related Accessor
     * @see  verifyNotTable   Related Assertion
     * @see  verifyTable      Related Assertion
     * @see  waitForNotTable  Related Assertion
     * @see  waitForTable     Related Assertion
     */
    public function assertNotTable($tableCellAddress, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the text from a cell of a table. 
     * 
     * The cellAddress syntax tableLocator.row.column, where row and column start at 0.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the text from the specified cell</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyTable}).</p>
     * 
     * @param string   $tableCellAddress  a cell address, e.g. "foo.1.4"
     * @param string   $pattern           the String-match Patterns 
     *                                    (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeTable       Base method, from which has been generated (automatically) current method
     * @see  assertNotTable   Related Assertion
     * @see  getTable         Related Accessor
     * @see  verifyNotTable   Related Assertion
     * @see  verifyTable      Related Assertion
     * @see  waitForNotTable  Related Assertion
     * @see  waitForTable     Related Assertion
     */
    public function assertTable($tableCellAddress, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets the text from a cell of a table. 
     * 
     * The cellAddress syntax tableLocator.row.column, where row and column start at 0.
     * 
     * @param string   $tableCellAddress  a cell address, e.g. "foo.1.4"
     * 
     * @return  string  the text from the specified cell
     * 
     * @see  storeTable       Base method, from which has been generated (automatically) current method
     * @see  assertNotTable   Related Assertion
     * @see  assertTable      Related Assertion
     * @see  verifyNotTable   Related Assertion
     * @see  verifyTable      Related Assertion
     * @see  waitForNotTable  Related Assertion
     * @see  waitForTable     Related Assertion
     */
    public function getTable($tableCellAddress)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets the text from a cell of a table. 
     * 
     * The cellAddress syntax tableLocator.row.column, where row and column start at 0.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>the text from the specified cell (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $tableCellAddress  a cell address, e.g. "foo.1.4"
     * @param string   $variableName      the name of a variable in which the result is to be stored. (see
     *                                    {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertNotTable   Related Assertion
     * @see  assertTable      Related Assertion
     * @see  getTable         Related Accessor
     * @see  verifyNotTable   Related Assertion
     * @see  verifyTable      Related Assertion
     * @see  waitForNotTable  Related Assertion
     * @see  waitForTable     Related Assertion
     */
    public function storeTable($tableCellAddress, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the text from a cell of a table. 
     * 
     * The cellAddress syntax tableLocator.row.column, where row and column start at 0.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the text from the specified cell</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotTable}).</p>
     * 
     * @param string   $tableCellAddress  a cell address, e.g. "foo.1.4"
     * @param string   $pattern           the String-match Patterns 
     *                                    (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeTable       Base method, from which has been generated (automatically) current method
     * @see  assertNotTable   Related Assertion
     * @see  assertTable      Related Assertion
     * @see  getTable         Related Accessor
     * @see  verifyTable      Related Assertion
     * @see  waitForNotTable  Related Assertion
     * @see  waitForTable     Related Assertion
     */
    public function verifyNotTable($tableCellAddress, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the text from a cell of a table. 
     * 
     * The cellAddress syntax tableLocator.row.column, where row and column start at 0.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the text from the specified cell</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertTable}).</p>
     * 
     * @param string   $tableCellAddress  a cell address, e.g. "foo.1.4"
     * @param string   $pattern           the String-match Patterns 
     *                                    (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeTable       Base method, from which has been generated (automatically) current method
     * @see  assertNotTable   Related Assertion
     * @see  assertTable      Related Assertion
     * @see  getTable         Related Accessor
     * @see  verifyNotTable   Related Assertion
     * @see  waitForNotTable  Related Assertion
     * @see  waitForTable     Related Assertion
     */
    public function verifyTable($tableCellAddress, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the text from a cell of a table. 
     * 
     * The cellAddress syntax tableLocator.row.column, where row and column start at 0.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the text from the specified cell</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $tableCellAddress  a cell address, e.g. "foo.1.4"
     * @param string   $pattern           the String-match Patterns 
     *                                    (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeTable      Base method, from which has been generated (automatically) current method
     * @see  assertNotTable  Related Assertion
     * @see  assertTable     Related Assertion
     * @see  getTable        Related Accessor
     * @see  verifyNotTable  Related Assertion
     * @see  verifyTable     Related Assertion
     * @see  waitForTable    Related Assertion
     */
    public function waitForNotTable($tableCellAddress, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the text from a cell of a table. 
     * 
     * The cellAddress syntax tableLocator.row.column, where row and column start at 0.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the text from the specified cell</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $tableCellAddress  a cell address, e.g. "foo.1.4"
     * @param string   $pattern           the String-match Patterns 
     *                                    (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeTable       Base method, from which has been generated (automatically) current method
     * @see  assertNotTable   Related Assertion
     * @see  assertTable      Related Assertion
     * @see  getTable         Related Accessor
     * @see  verifyNotTable   Related Assertion
     * @see  verifyTable      Related Assertion
     * @see  waitForNotTable  Related Assertion
     */
    public function waitForTable($tableCellAddress, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the text of an element. 
     * 
     * This works for any element that contains text. This command uses either the textContent (Mozilla-like browsers)
     * or the innerText (IE-like browsers) of the element, which is the rendered text shown to the user.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the text of the element</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotText}).</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeText       Base method, from which has been generated (automatically) current method
     * @see  assertText      Related Assertion
     * @see  getText         Related Accessor
     * @see  verifyNotText   Related Assertion
     * @see  verifyText      Related Assertion
     * @see  waitForNotText  Related Assertion
     * @see  waitForText     Related Assertion
     */
    public function assertNotText($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the text of an element. 
     * 
     * This works for any element that contains text. This command uses either the textContent (Mozilla-like browsers)
     * or the innerText (IE-like browsers) of the element, which is the rendered text shown to the user.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the text of the element</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyText}).</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeText       Base method, from which has been generated (automatically) current method
     * @see  assertNotText   Related Assertion
     * @see  getText         Related Accessor
     * @see  verifyNotText   Related Assertion
     * @see  verifyText      Related Assertion
     * @see  waitForNotText  Related Assertion
     * @see  waitForText     Related Assertion
     */
    public function assertText($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets the text of an element. 
     * 
     * This works for any element that contains text. This command uses either the textContent (Mozilla-like browsers)
     * or the innerText (IE-like browsers) of the element, which is the rendered text shown to the user.
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  string  the text of the element
     * 
     * @see  storeText       Base method, from which has been generated (automatically) current method
     * @see  assertNotText   Related Assertion
     * @see  assertText      Related Assertion
     * @see  verifyNotText   Related Assertion
     * @see  verifyText      Related Assertion
     * @see  waitForNotText  Related Assertion
     * @see  waitForText     Related Assertion
     */
    public function getText($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets the text of an element. 
     * 
     * This works for any element that contains text. This command uses either the textContent (Mozilla-like browsers)
     * or the innerText (IE-like browsers) of the element, which is the rendered text shown to the user.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>the text of the element (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $locator       an element locator 
     *                                (see {@link doc_Element_Locators})
     * @param string   $variableName  the name of a variable in which the result is to be stored. (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertNotText   Related Assertion
     * @see  assertText      Related Assertion
     * @see  getText         Related Accessor
     * @see  verifyNotText   Related Assertion
     * @see  verifyText      Related Assertion
     * @see  waitForNotText  Related Assertion
     * @see  waitForText     Related Assertion
     */
    public function storeText($locator, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the text of an element. 
     * 
     * This works for any element that contains text. This command uses either the textContent (Mozilla-like browsers)
     * or the innerText (IE-like browsers) of the element, which is the rendered text shown to the user.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the text of the element</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotText}).</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeText       Base method, from which has been generated (automatically) current method
     * @see  assertNotText   Related Assertion
     * @see  assertText      Related Assertion
     * @see  getText         Related Accessor
     * @see  verifyText      Related Assertion
     * @see  waitForNotText  Related Assertion
     * @see  waitForText     Related Assertion
     */
    public function verifyNotText($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the text of an element. 
     * 
     * This works for any element that contains text. This command uses either the textContent (Mozilla-like browsers)
     * or the innerText (IE-like browsers) of the element, which is the rendered text shown to the user.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the text of the element</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertText}).</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeText       Base method, from which has been generated (automatically) current method
     * @see  assertNotText   Related Assertion
     * @see  assertText      Related Assertion
     * @see  getText         Related Accessor
     * @see  verifyNotText   Related Assertion
     * @see  waitForNotText  Related Assertion
     * @see  waitForText     Related Assertion
     */
    public function verifyText($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the text of an element. 
     * 
     * This works for any element that contains text. This command uses either the textContent (Mozilla-like browsers)
     * or the innerText (IE-like browsers) of the element, which is the rendered text shown to the user.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the text of the element</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeText      Base method, from which has been generated (automatically) current method
     * @see  assertNotText  Related Assertion
     * @see  assertText     Related Assertion
     * @see  getText        Related Accessor
     * @see  verifyNotText  Related Assertion
     * @see  verifyText     Related Assertion
     * @see  waitForText    Related Assertion
     */
    public function waitForNotText($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the text of an element. 
     * 
     * This works for any element that contains text. This command uses either the textContent (Mozilla-like browsers)
     * or the innerText (IE-like browsers) of the element, which is the rendered text shown to the user.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the text of the element</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeText       Base method, from which has been generated (automatically) current method
     * @see  assertNotText   Related Assertion
     * @see  assertText      Related Assertion
     * @see  getText         Related Accessor
     * @see  verifyNotText   Related Assertion
     * @see  verifyText      Related Assertion
     * @see  waitForNotText  Related Assertion
     */
    public function waitForText($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the title of the current page.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the title of the current page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotTitle}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeTitle       Base method, from which has been generated (automatically) current method
     * @see  assertTitle      Related Assertion
     * @see  getTitle         Related Accessor
     * @see  verifyNotTitle   Related Assertion
     * @see  verifyTitle      Related Assertion
     * @see  waitForNotTitle  Related Assertion
     * @see  waitForTitle     Related Assertion
     */
    public function assertNotTitle($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the title of the current page.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the title of the current page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyTitle}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeTitle       Base method, from which has been generated (automatically) current method
     * @see  assertNotTitle   Related Assertion
     * @see  getTitle         Related Accessor
     * @see  verifyNotTitle   Related Assertion
     * @see  verifyTitle      Related Assertion
     * @see  waitForNotTitle  Related Assertion
     * @see  waitForTitle     Related Assertion
     */
    public function assertTitle($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets the title of the current page.
     * 
     * @return  string  the title of the current page
     * 
     * @see  storeTitle       Base method, from which has been generated (automatically) current method
     * @see  assertNotTitle   Related Assertion
     * @see  assertTitle      Related Assertion
     * @see  verifyNotTitle   Related Assertion
     * @see  verifyTitle      Related Assertion
     * @see  waitForNotTitle  Related Assertion
     * @see  waitForTitle     Related Assertion
     */
    public function getTitle()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets the title of the current page.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>the title of the current page (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $variableName  the name of a variable in which the result is to be stored (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertNotTitle   Related Assertion
     * @see  assertTitle      Related Assertion
     * @see  getTitle         Related Accessor
     * @see  verifyNotTitle   Related Assertion
     * @see  verifyTitle      Related Assertion
     * @see  waitForNotTitle  Related Assertion
     * @see  waitForTitle     Related Assertion
     */
    public function storeTitle($variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the title of the current page.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the title of the current page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotTitle}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeTitle       Base method, from which has been generated (automatically) current method
     * @see  assertNotTitle   Related Assertion
     * @see  assertTitle      Related Assertion
     * @see  getTitle         Related Accessor
     * @see  verifyTitle      Related Assertion
     * @see  waitForNotTitle  Related Assertion
     * @see  waitForTitle     Related Assertion
     */
    public function verifyNotTitle($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the title of the current page.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the title of the current page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertTitle}).</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeTitle       Base method, from which has been generated (automatically) current method
     * @see  assertNotTitle   Related Assertion
     * @see  assertTitle      Related Assertion
     * @see  getTitle         Related Accessor
     * @see  verifyNotTitle   Related Assertion
     * @see  waitForNotTitle  Related Assertion
     * @see  waitForTitle     Related Assertion
     */
    public function verifyTitle($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the title of the current page.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the title of the current page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeTitle      Base method, from which has been generated (automatically) current method
     * @see  assertNotTitle  Related Assertion
     * @see  assertTitle     Related Assertion
     * @see  getTitle        Related Accessor
     * @see  verifyNotTitle  Related Assertion
     * @see  verifyTitle     Related Assertion
     * @see  waitForTitle    Related Assertion
     */
    public function waitForNotTitle($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the title of the current page.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the title of the current page</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeTitle       Base method, from which has been generated (automatically) current method
     * @see  assertNotTitle   Related Assertion
     * @see  assertTitle      Related Assertion
     * @see  getTitle         Related Accessor
     * @see  verifyNotTitle   Related Assertion
     * @see  verifyTitle      Related Assertion
     * @see  waitForNotTitle  Related Assertion
     */
    public function waitForTitle($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the (whitespace-trimmed) value of an input field (or anything else with a value parameter). 
     * 
     * For checkbox/radio elements, the value will be "on" or "off" depending on whether the element is checked or not.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the element value, or "on/off" for checkbox/radio elements</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotValue}).</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeValue       Base method, from which has been generated (automatically) current method
     * @see  assertValue      Related Assertion
     * @see  getValue         Related Accessor
     * @see  verifyNotValue   Related Assertion
     * @see  verifyValue      Related Assertion
     * @see  waitForNotValue  Related Assertion
     * @see  waitForValue     Related Assertion
     */
    public function assertNotValue($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the (whitespace-trimmed) value of an input field (or anything else with a value parameter). 
     * 
     * For checkbox/radio elements, the value will be "on" or "off" depending on whether the element is checked or not.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the element value, or "on/off" for checkbox/radio elements</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyValue}).</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeValue       Base method, from which has been generated (automatically) current method
     * @see  assertNotValue   Related Assertion
     * @see  getValue         Related Accessor
     * @see  verifyNotValue   Related Assertion
     * @see  verifyValue      Related Assertion
     * @see  waitForNotValue  Related Assertion
     * @see  waitForValue     Related Assertion
     */
    public function assertValue($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets the (whitespace-trimmed) value of an input field (or anything else with a value parameter). 
     * 
     * For checkbox/radio elements, the value will be "on" or "off" depending on whether the element is checked or not.
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  string  the element value, or "on/off" for checkbox/radio elements
     * 
     * @see  storeValue       Base method, from which has been generated (automatically) current method
     * @see  assertNotValue   Related Assertion
     * @see  assertValue      Related Assertion
     * @see  verifyNotValue   Related Assertion
     * @see  verifyValue      Related Assertion
     * @see  waitForNotValue  Related Assertion
     * @see  waitForValue     Related Assertion
     */
    public function getValue($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gets the (whitespace-trimmed) value of an input field (or anything else with a value parameter). 
     * 
     * For checkbox/radio elements, the value will be "on" or "off" depending on whether the element is checked or not.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>the element value, or "on/off" for checkbox/radio elements (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $locator       an element locator 
     *                                (see {@link doc_Element_Locators})
     * @param string   $variableName  the name of a variable in which the result is to be stored. (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertNotValue   Related Assertion
     * @see  assertValue      Related Assertion
     * @see  getValue         Related Accessor
     * @see  verifyNotValue   Related Assertion
     * @see  verifyValue      Related Assertion
     * @see  waitForNotValue  Related Assertion
     * @see  waitForValue     Related Assertion
     */
    public function storeValue($locator, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the (whitespace-trimmed) value of an input field (or anything else with a value parameter). 
     * 
     * For checkbox/radio elements, the value will be "on" or "off" depending on whether the element is checked or not.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the element value, or "on/off" for checkbox/radio elements</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotValue}).</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeValue       Base method, from which has been generated (automatically) current method
     * @see  assertNotValue   Related Assertion
     * @see  assertValue      Related Assertion
     * @see  getValue         Related Accessor
     * @see  verifyValue      Related Assertion
     * @see  waitForNotValue  Related Assertion
     * @see  waitForValue     Related Assertion
     */
    public function verifyNotValue($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the (whitespace-trimmed) value of an input field (or anything else with a value parameter). 
     * 
     * For checkbox/radio elements, the value will be "on" or "off" depending on whether the element is checked or not.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the element value, or "on/off" for checkbox/radio elements</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertValue}).</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeValue       Base method, from which has been generated (automatically) current method
     * @see  assertNotValue   Related Assertion
     * @see  assertValue      Related Assertion
     * @see  getValue         Related Accessor
     * @see  verifyNotValue   Related Assertion
     * @see  waitForNotValue  Related Assertion
     * @see  waitForValue     Related Assertion
     */
    public function verifyValue($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the (whitespace-trimmed) value of an input field (or anything else with a value parameter). 
     * 
     * For checkbox/radio elements, the value will be "on" or "off" depending on whether the element is checked or not.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the element value, or "on/off" for checkbox/radio elements</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeValue      Base method, from which has been generated (automatically) current method
     * @see  assertNotValue  Related Assertion
     * @see  assertValue     Related Assertion
     * @see  getValue        Related Accessor
     * @see  verifyNotValue  Related Assertion
     * @see  verifyValue     Related Assertion
     * @see  waitForValue    Related Assertion
     */
    public function waitForNotValue($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Gets the (whitespace-trimmed) value of an input field (or anything else with a value parameter). 
     * 
     * For checkbox/radio elements, the value will be "on" or "off" depending on whether the element is checked or not.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the element value, or "on/off" for checkbox/radio elements</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeValue       Base method, from which has been generated (automatically) current method
     * @see  assertNotValue   Related Assertion
     * @see  assertValue      Related Assertion
     * @see  getValue         Related Accessor
     * @see  verifyNotValue   Related Assertion
     * @see  verifyValue      Related Assertion
     * @see  waitForNotValue  Related Assertion
     */
    public function waitForValue($locator, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determines if the specified element is visible. 
     * 
     * An element can be rendered invisible by setting the CSS "visibility" property to "hidden", or the "display"
     * property to "none", either for the element itself or one if its ancestors. This method will fail if the element
     * is not present.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if the specified element is visible, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotVisible}).</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeVisible       Base method, from which has been generated (automatically) current method
     * @see  assertVisible      Related Assertion
     * @see  isVisible          Related Accessor
     * @see  verifyNotVisible   Related Assertion
     * @see  verifyVisible      Related Assertion
     * @see  waitForNotVisible  Related Assertion
     * @see  waitForVisible     Related Assertion
     */
    public function assertNotVisible($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determines if the specified element is visible. 
     * 
     * An element can be rendered invisible by setting the CSS "visibility" property to "hidden", or the "display"
     * property to "none", either for the element itself or one if its ancestors. This method will fail if the element
     * is not present.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if the specified element is visible, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyVisible}).</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeVisible       Base method, from which has been generated (automatically) current method
     * @see  assertNotVisible   Related Assertion
     * @see  isVisible          Related Accessor
     * @see  verifyNotVisible   Related Assertion
     * @see  verifyVisible      Related Assertion
     * @see  waitForNotVisible  Related Assertion
     * @see  waitForVisible     Related Assertion
     */
    public function assertVisible($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Determines if the specified element is visible. 
     * 
     * An element can be rendered invisible by setting the CSS "visibility" property to "hidden", or the "display"
     * property to "none", either for the element itself or one if its ancestors. This method will fail if the element
     * is not present.
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  bool  true if the specified element is visible, false otherwise
     * 
     * @see  storeVisible       Base method, from which has been generated (automatically) current method
     * @see  assertNotVisible   Related Assertion
     * @see  assertVisible      Related Assertion
     * @see  verifyNotVisible   Related Assertion
     * @see  verifyVisible      Related Assertion
     * @see  waitForNotVisible  Related Assertion
     * @see  waitForVisible     Related Assertion
     */
    public function isVisible($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Determines if the specified element is visible. 
     * 
     * An element can be rendered invisible by setting the CSS "visibility" property to "hidden", or the "display"
     * property to "none", either for the element itself or one if its ancestors. This method will fail if the element
     * is not present.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>true if the specified element is visible, false otherwise (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $locator       an element locator 
     *                                (see {@link doc_Element_Locators})
     * @param string   $variableName  the name of a variable in which the result is to be stored. (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertNotVisible   Related Assertion
     * @see  assertVisible      Related Assertion
     * @see  isVisible          Related Accessor
     * @see  verifyNotVisible   Related Assertion
     * @see  verifyVisible      Related Assertion
     * @see  waitForNotVisible  Related Assertion
     * @see  waitForVisible     Related Assertion
     */
    public function storeVisible($locator, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determines if the specified element is visible. 
     * 
     * An element can be rendered invisible by setting the CSS "visibility" property to "hidden", or the "display"
     * property to "none", either for the element itself or one if its ancestors. This method will fail if the element
     * is not present.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if the specified element is visible, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotVisible}).</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeVisible       Base method, from which has been generated (automatically) current method
     * @see  assertNotVisible   Related Assertion
     * @see  assertVisible      Related Assertion
     * @see  isVisible          Related Accessor
     * @see  verifyVisible      Related Assertion
     * @see  waitForNotVisible  Related Assertion
     * @see  waitForVisible     Related Assertion
     */
    public function verifyNotVisible($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determines if the specified element is visible. 
     * 
     * An element can be rendered invisible by setting the CSS "visibility" property to "hidden", or the "display"
     * property to "none", either for the element itself or one if its ancestors. This method will fail if the element
     * is not present.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if the specified element is visible, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertVisible}).</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeVisible       Base method, from which has been generated (automatically) current method
     * @see  assertNotVisible   Related Assertion
     * @see  assertVisible      Related Assertion
     * @see  isVisible          Related Accessor
     * @see  verifyNotVisible   Related Assertion
     * @see  waitForNotVisible  Related Assertion
     * @see  waitForVisible     Related Assertion
     */
    public function verifyVisible($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determines if the specified element is visible. 
     * 
     * An element can be rendered invisible by setting the CSS "visibility" property to "hidden", or the "display"
     * property to "none", either for the element itself or one if its ancestors. This method will fail if the element
     * is not present.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>true if the specified element is visible, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeVisible      Base method, from which has been generated (automatically) current method
     * @see  assertNotVisible  Related Assertion
     * @see  assertVisible     Related Assertion
     * @see  isVisible         Related Accessor
     * @see  verifyNotVisible  Related Assertion
     * @see  verifyVisible     Related Assertion
     * @see  waitForVisible    Related Assertion
     */
    public function waitForNotVisible($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determines if the specified element is visible. 
     * 
     * An element can be rendered invisible by setting the CSS "visibility" property to "hidden", or the "display"
     * property to "none", either for the element itself or one if its ancestors. This method will fail if the element
     * is not present.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>true if the specified element is visible, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  storeVisible       Base method, from which has been generated (automatically) current method
     * @see  assertNotVisible   Related Assertion
     * @see  assertVisible      Related Assertion
     * @see  isVisible          Related Accessor
     * @see  verifyNotVisible   Related Assertion
     * @see  verifyVisible      Related Assertion
     * @see  waitForNotVisible  Related Assertion
     */
    public function waitForVisible($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determine whether current/locator identify the frame containing this running code. 
     * 
     * <p>This is useful in proxy injection mode, where this code runs in every browser frame and window, and sometimes
     * the selenium server needs to identify the "current" frame. In this case, when the test calls selectFrame, this
     * routine is called for each frame to figure out which one has been selected. The selected frame will return true,
     * while all others will return false.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if the new frame is this code's window</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotWhetherThisFrameMatchFrameExpression}).</p>
     * 
     * @param string   $currentFrameString  starting frame
     * @param string   $target              new frame (which might be relative to the current one)
     * 
     * @return  void
     * 
     * @see  storeWhetherThisFrameMatchFrameExpression       Base method, from which has been generated (automatically)
     *                                                       current method
     * @see  assertWhetherThisFrameMatchFrameExpression      Related Assertion
     * @see  getWhetherThisFrameMatchFrameExpression         Related Accessor
     * @see  verifyNotWhetherThisFrameMatchFrameExpression   Related Assertion
     * @see  verifyWhetherThisFrameMatchFrameExpression      Related Assertion
     * @see  waitForNotWhetherThisFrameMatchFrameExpression  Related Assertion
     * @see  waitForWhetherThisFrameMatchFrameExpression     Related Assertion
     */
    public function assertNotWhetherThisFrameMatchFrameExpression($currentFrameString, $target)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determine whether current/locator identify the frame containing this running code. 
     * 
     * <p>This is useful in proxy injection mode, where this code runs in every browser frame and window, and sometimes
     * the selenium server needs to identify the "current" frame. In this case, when the test calls selectFrame, this
     * routine is called for each frame to figure out which one has been selected. The selected frame will return true,
     * while all others will return false.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if the new frame is this code's window</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyWhetherThisFrameMatchFrameExpression}).</p>
     * 
     * @param string   $currentFrameString  starting frame
     * @param string   $target              new frame (which might be relative to the current one)
     * 
     * @return  void
     * 
     * @see  storeWhetherThisFrameMatchFrameExpression       Base method, from which has been generated (automatically)
     *                                                       current method
     * @see  assertNotWhetherThisFrameMatchFrameExpression   Related Assertion
     * @see  getWhetherThisFrameMatchFrameExpression         Related Accessor
     * @see  verifyNotWhetherThisFrameMatchFrameExpression   Related Assertion
     * @see  verifyWhetherThisFrameMatchFrameExpression      Related Assertion
     * @see  waitForNotWhetherThisFrameMatchFrameExpression  Related Assertion
     * @see  waitForWhetherThisFrameMatchFrameExpression     Related Assertion
     */
    public function assertWhetherThisFrameMatchFrameExpression($currentFrameString, $target)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Determine whether current/locator identify the frame containing this running code. 
     * 
     * <p>This is useful in proxy injection mode, where this code runs in every browser frame and window, and sometimes
     * the selenium server needs to identify the "current" frame. In this case, when the test calls selectFrame, this
     * routine is called for each frame to figure out which one has been selected. The selected frame will return true,
     * while all others will return false.</p>
     * 
     * @param string   $currentFrameString  starting frame
     * @param string   $target              new frame (which might be relative to the current one)
     * 
     * @return  bool  true if the new frame is this code's window
     * 
     * @see  storeWhetherThisFrameMatchFrameExpression       Base method, from which has been generated (automatically)
     *                                                       current method
     * @see  assertNotWhetherThisFrameMatchFrameExpression   Related Assertion
     * @see  assertWhetherThisFrameMatchFrameExpression      Related Assertion
     * @see  verifyNotWhetherThisFrameMatchFrameExpression   Related Assertion
     * @see  verifyWhetherThisFrameMatchFrameExpression      Related Assertion
     * @see  waitForNotWhetherThisFrameMatchFrameExpression  Related Assertion
     * @see  waitForWhetherThisFrameMatchFrameExpression     Related Assertion
     */
    public function getWhetherThisFrameMatchFrameExpression($currentFrameString, $target)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Determine whether current/locator identify the frame containing this running code. 
     * 
     * <p>This is useful in proxy injection mode, where this code runs in every browser frame and window, and sometimes
     * the selenium server needs to identify the "current" frame. In this case, when the test calls selectFrame, this
     * routine is called for each frame to figure out which one has been selected. The selected frame will return true,
     * while all others will return false.</p>
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>true if the new frame is this code's window (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $currentFrameString  starting frame
     * @param string   $target              new frame (which might be relative to the current one)
     * @param string   $variableName        the name of a variable in which the result is to be stored. (see
     *                                      {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertNotWhetherThisFrameMatchFrameExpression   Related Assertion
     * @see  assertWhetherThisFrameMatchFrameExpression      Related Assertion
     * @see  getWhetherThisFrameMatchFrameExpression         Related Accessor
     * @see  verifyNotWhetherThisFrameMatchFrameExpression   Related Assertion
     * @see  verifyWhetherThisFrameMatchFrameExpression      Related Assertion
     * @see  waitForNotWhetherThisFrameMatchFrameExpression  Related Assertion
     * @see  waitForWhetherThisFrameMatchFrameExpression     Related Assertion
     */
    public function storeWhetherThisFrameMatchFrameExpression($currentFrameString, $target, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determine whether current/locator identify the frame containing this running code. 
     * 
     * <p>This is useful in proxy injection mode, where this code runs in every browser frame and window, and sometimes
     * the selenium server needs to identify the "current" frame. In this case, when the test calls selectFrame, this
     * routine is called for each frame to figure out which one has been selected. The selected frame will return true,
     * while all others will return false.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if the new frame is this code's window</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotWhetherThisFrameMatchFrameExpression}).</p>
     * 
     * @param string   $currentFrameString  starting frame
     * @param string   $target              new frame (which might be relative to the current one)
     * 
     * @return  void
     * 
     * @see  storeWhetherThisFrameMatchFrameExpression       Base method, from which has been generated (automatically)
     *                                                       current method
     * @see  assertNotWhetherThisFrameMatchFrameExpression   Related Assertion
     * @see  assertWhetherThisFrameMatchFrameExpression      Related Assertion
     * @see  getWhetherThisFrameMatchFrameExpression         Related Accessor
     * @see  verifyWhetherThisFrameMatchFrameExpression      Related Assertion
     * @see  waitForNotWhetherThisFrameMatchFrameExpression  Related Assertion
     * @see  waitForWhetherThisFrameMatchFrameExpression     Related Assertion
     */
    public function verifyNotWhetherThisFrameMatchFrameExpression($currentFrameString, $target)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determine whether current/locator identify the frame containing this running code. 
     * 
     * <p>This is useful in proxy injection mode, where this code runs in every browser frame and window, and sometimes
     * the selenium server needs to identify the "current" frame. In this case, when the test calls selectFrame, this
     * routine is called for each frame to figure out which one has been selected. The selected frame will return true,
     * while all others will return false.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if the new frame is this code's window</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertWhetherThisFrameMatchFrameExpression}).</p>
     * 
     * @param string   $currentFrameString  starting frame
     * @param string   $target              new frame (which might be relative to the current one)
     * 
     * @return  void
     * 
     * @see  storeWhetherThisFrameMatchFrameExpression       Base method, from which has been generated (automatically)
     *                                                       current method
     * @see  assertNotWhetherThisFrameMatchFrameExpression   Related Assertion
     * @see  assertWhetherThisFrameMatchFrameExpression      Related Assertion
     * @see  getWhetherThisFrameMatchFrameExpression         Related Accessor
     * @see  verifyNotWhetherThisFrameMatchFrameExpression   Related Assertion
     * @see  waitForNotWhetherThisFrameMatchFrameExpression  Related Assertion
     * @see  waitForWhetherThisFrameMatchFrameExpression     Related Assertion
     */
    public function verifyWhetherThisFrameMatchFrameExpression($currentFrameString, $target)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determine whether current/locator identify the frame containing this running code. 
     * 
     * <p>This is useful in proxy injection mode, where this code runs in every browser frame and window, and sometimes
     * the selenium server needs to identify the "current" frame. In this case, when the test calls selectFrame, this
     * routine is called for each frame to figure out which one has been selected. The selected frame will return true,
     * while all others will return false.</p>
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>true if the new frame is this code's window</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $currentFrameString  starting frame
     * @param string   $target              new frame (which might be relative to the current one)
     * 
     * @return  void
     * 
     * @see  storeWhetherThisFrameMatchFrameExpression      Base method, from which has been generated (automatically)
     *                                                      current method
     * @see  assertNotWhetherThisFrameMatchFrameExpression  Related Assertion
     * @see  assertWhetherThisFrameMatchFrameExpression     Related Assertion
     * @see  getWhetherThisFrameMatchFrameExpression        Related Accessor
     * @see  verifyNotWhetherThisFrameMatchFrameExpression  Related Assertion
     * @see  verifyWhetherThisFrameMatchFrameExpression     Related Assertion
     * @see  waitForWhetherThisFrameMatchFrameExpression    Related Assertion
     */
    public function waitForNotWhetherThisFrameMatchFrameExpression($currentFrameString, $target)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determine whether current/locator identify the frame containing this running code. 
     * 
     * <p>This is useful in proxy injection mode, where this code runs in every browser frame and window, and sometimes
     * the selenium server needs to identify the "current" frame. In this case, when the test calls selectFrame, this
     * routine is called for each frame to figure out which one has been selected. The selected frame will return true,
     * while all others will return false.</p>
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>true if the new frame is this code's window</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $currentFrameString  starting frame
     * @param string   $target              new frame (which might be relative to the current one)
     * 
     * @return  void
     * 
     * @see  storeWhetherThisFrameMatchFrameExpression       Base method, from which has been generated (automatically)
     *                                                       current method
     * @see  assertNotWhetherThisFrameMatchFrameExpression   Related Assertion
     * @see  assertWhetherThisFrameMatchFrameExpression      Related Assertion
     * @see  getWhetherThisFrameMatchFrameExpression         Related Accessor
     * @see  verifyNotWhetherThisFrameMatchFrameExpression   Related Assertion
     * @see  verifyWhetherThisFrameMatchFrameExpression      Related Assertion
     * @see  waitForNotWhetherThisFrameMatchFrameExpression  Related Assertion
     */
    public function waitForWhetherThisFrameMatchFrameExpression($currentFrameString, $target)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determine whether currentWindowString plus target identify the window containing this running code. 
     * 
     * <p>This is useful in proxy injection mode, where this code runs in every browser frame and window, and sometimes
     * the selenium server needs to identify the "current" window. In this case, when the test calls selectWindow, this
     * routine is called for each window to figure out which one has been selected. The selected window will return
     * true, while all others will return false.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if the new window is this code's window</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotWhetherThisWindowMatchWindowExpression}).</p>
     * 
     * @param string   $currentWindowString  starting window
     * @param string   $target               new window (which might be relative to the current one, e.g., "_parent")
     * 
     * @return  void
     * 
     * @see  storeWhetherThisWindowMatchWindowExpression       Base method, from which has been generated
     *                                                         (automatically) current method
     * @see  assertWhetherThisWindowMatchWindowExpression      Related Assertion
     * @see  getWhetherThisWindowMatchWindowExpression         Related Accessor
     * @see  verifyNotWhetherThisWindowMatchWindowExpression   Related Assertion
     * @see  verifyWhetherThisWindowMatchWindowExpression      Related Assertion
     * @see  waitForNotWhetherThisWindowMatchWindowExpression  Related Assertion
     * @see  waitForWhetherThisWindowMatchWindowExpression     Related Assertion
     */
    public function assertNotWhetherThisWindowMatchWindowExpression($currentWindowString, $target)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determine whether currentWindowString plus target identify the window containing this running code. 
     * 
     * <p>This is useful in proxy injection mode, where this code runs in every browser frame and window, and sometimes
     * the selenium server needs to identify the "current" window. In this case, when the test calls selectWindow, this
     * routine is called for each window to figure out which one has been selected. The selected window will return
     * true, while all others will return false.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if the new window is this code's window</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyWhetherThisWindowMatchWindowExpression}).</p>
     * 
     * @param string   $currentWindowString  starting window
     * @param string   $target               new window (which might be relative to the current one, e.g., "_parent")
     * 
     * @return  void
     * 
     * @see  storeWhetherThisWindowMatchWindowExpression       Base method, from which has been generated
     *                                                         (automatically) current method
     * @see  assertNotWhetherThisWindowMatchWindowExpression   Related Assertion
     * @see  getWhetherThisWindowMatchWindowExpression         Related Accessor
     * @see  verifyNotWhetherThisWindowMatchWindowExpression   Related Assertion
     * @see  verifyWhetherThisWindowMatchWindowExpression      Related Assertion
     * @see  waitForNotWhetherThisWindowMatchWindowExpression  Related Assertion
     * @see  waitForWhetherThisWindowMatchWindowExpression     Related Assertion
     */
    public function assertWhetherThisWindowMatchWindowExpression($currentWindowString, $target)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Determine whether currentWindowString plus target identify the window containing this running code. 
     * 
     * <p>This is useful in proxy injection mode, where this code runs in every browser frame and window, and sometimes
     * the selenium server needs to identify the "current" window. In this case, when the test calls selectWindow, this
     * routine is called for each window to figure out which one has been selected. The selected window will return
     * true, while all others will return false.</p>
     * 
     * @param string   $currentWindowString  starting window
     * @param string   $target               new window (which might be relative to the current one, e.g., "_parent")
     * 
     * @return  bool  true if the new window is this code's window
     * 
     * @see  storeWhetherThisWindowMatchWindowExpression       Base method, from which has been generated
     *                                                         (automatically) current method
     * @see  assertNotWhetherThisWindowMatchWindowExpression   Related Assertion
     * @see  assertWhetherThisWindowMatchWindowExpression      Related Assertion
     * @see  verifyNotWhetherThisWindowMatchWindowExpression   Related Assertion
     * @see  verifyWhetherThisWindowMatchWindowExpression      Related Assertion
     * @see  waitForNotWhetherThisWindowMatchWindowExpression  Related Assertion
     * @see  waitForWhetherThisWindowMatchWindowExpression     Related Assertion
     */
    public function getWhetherThisWindowMatchWindowExpression($currentWindowString, $target)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Determine whether currentWindowString plus target identify the window containing this running code. 
     * 
     * <p>This is useful in proxy injection mode, where this code runs in every browser frame and window, and sometimes
     * the selenium server needs to identify the "current" window. In this case, when the test calls selectWindow, this
     * routine is called for each window to figure out which one has been selected. The selected window will return
     * true, while all others will return false.</p>
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>true if the new window is this code's window (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $currentWindowString  starting window
     * @param string   $target               new window (which might be relative to the current one, e.g., "_parent")
     * @param string   $variableName         the name of a variable in which the result is to be stored. (see
     *                                       {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertNotWhetherThisWindowMatchWindowExpression   Related Assertion
     * @see  assertWhetherThisWindowMatchWindowExpression      Related Assertion
     * @see  getWhetherThisWindowMatchWindowExpression         Related Accessor
     * @see  verifyNotWhetherThisWindowMatchWindowExpression   Related Assertion
     * @see  verifyWhetherThisWindowMatchWindowExpression      Related Assertion
     * @see  waitForNotWhetherThisWindowMatchWindowExpression  Related Assertion
     * @see  waitForWhetherThisWindowMatchWindowExpression     Related Assertion
     */
    public function storeWhetherThisWindowMatchWindowExpression($currentWindowString, $target, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determine whether currentWindowString plus target identify the window containing this running code. 
     * 
     * <p>This is useful in proxy injection mode, where this code runs in every browser frame and window, and sometimes
     * the selenium server needs to identify the "current" window. In this case, when the test calls selectWindow, this
     * routine is called for each window to figure out which one has been selected. The selected window will return
     * true, while all others will return false.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if the new window is this code's window</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotWhetherThisWindowMatchWindowExpression}).</p>
     * 
     * @param string   $currentWindowString  starting window
     * @param string   $target               new window (which might be relative to the current one, e.g., "_parent")
     * 
     * @return  void
     * 
     * @see  storeWhetherThisWindowMatchWindowExpression       Base method, from which has been generated
     *                                                         (automatically) current method
     * @see  assertNotWhetherThisWindowMatchWindowExpression   Related Assertion
     * @see  assertWhetherThisWindowMatchWindowExpression      Related Assertion
     * @see  getWhetherThisWindowMatchWindowExpression         Related Accessor
     * @see  verifyWhetherThisWindowMatchWindowExpression      Related Assertion
     * @see  waitForNotWhetherThisWindowMatchWindowExpression  Related Assertion
     * @see  waitForWhetherThisWindowMatchWindowExpression     Related Assertion
     */
    public function verifyNotWhetherThisWindowMatchWindowExpression($currentWindowString, $target)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determine whether currentWindowString plus target identify the window containing this running code. 
     * 
     * <p>This is useful in proxy injection mode, where this code runs in every browser frame and window, and sometimes
     * the selenium server needs to identify the "current" window. In this case, when the test calls selectWindow, this
     * routine is called for each window to figure out which one has been selected. The selected window will return
     * true, while all others will return false.</p>
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if the new window is this code's window</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertWhetherThisWindowMatchWindowExpression}).</p>
     * 
     * @param string   $currentWindowString  starting window
     * @param string   $target               new window (which might be relative to the current one, e.g., "_parent")
     * 
     * @return  void
     * 
     * @see  storeWhetherThisWindowMatchWindowExpression       Base method, from which has been generated
     *                                                         (automatically) current method
     * @see  assertNotWhetherThisWindowMatchWindowExpression   Related Assertion
     * @see  assertWhetherThisWindowMatchWindowExpression      Related Assertion
     * @see  getWhetherThisWindowMatchWindowExpression         Related Accessor
     * @see  verifyNotWhetherThisWindowMatchWindowExpression   Related Assertion
     * @see  waitForNotWhetherThisWindowMatchWindowExpression  Related Assertion
     * @see  waitForWhetherThisWindowMatchWindowExpression     Related Assertion
     */
    public function verifyWhetherThisWindowMatchWindowExpression($currentWindowString, $target)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determine whether currentWindowString plus target identify the window containing this running code. 
     * 
     * <p>This is useful in proxy injection mode, where this code runs in every browser frame and window, and sometimes
     * the selenium server needs to identify the "current" window. In this case, when the test calls selectWindow, this
     * routine is called for each window to figure out which one has been selected. The selected window will return
     * true, while all others will return false.</p>
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>true if the new window is this code's window</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $currentWindowString  starting window
     * @param string   $target               new window (which might be relative to the current one, e.g., "_parent")
     * 
     * @return  void
     * 
     * @see  storeWhetherThisWindowMatchWindowExpression      Base method, from which has been generated
     *                                                        (automatically) current method
     * @see  assertNotWhetherThisWindowMatchWindowExpression  Related Assertion
     * @see  assertWhetherThisWindowMatchWindowExpression     Related Assertion
     * @see  getWhetherThisWindowMatchWindowExpression        Related Accessor
     * @see  verifyNotWhetherThisWindowMatchWindowExpression  Related Assertion
     * @see  verifyWhetherThisWindowMatchWindowExpression     Related Assertion
     * @see  waitForWhetherThisWindowMatchWindowExpression    Related Assertion
     */
    public function waitForNotWhetherThisWindowMatchWindowExpression($currentWindowString, $target)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Determine whether currentWindowString plus target identify the window containing this running code. 
     * 
     * <p>This is useful in proxy injection mode, where this code runs in every browser frame and window, and sometimes
     * the selenium server needs to identify the "current" window. In this case, when the test calls selectWindow, this
     * routine is called for each window to figure out which one has been selected. The selected window will return
     * true, while all others will return false.</p>
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>true if the new window is this code's window</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $currentWindowString  starting window
     * @param string   $target               new window (which might be relative to the current one, e.g., "_parent")
     * 
     * @return  void
     * 
     * @see  storeWhetherThisWindowMatchWindowExpression       Base method, from which has been generated
     *                                                         (automatically) current method
     * @see  assertNotWhetherThisWindowMatchWindowExpression   Related Assertion
     * @see  assertWhetherThisWindowMatchWindowExpression      Related Assertion
     * @see  getWhetherThisWindowMatchWindowExpression         Related Accessor
     * @see  verifyNotWhetherThisWindowMatchWindowExpression   Related Assertion
     * @see  verifyWhetherThisWindowMatchWindowExpression      Related Assertion
     * @see  waitForNotWhetherThisWindowMatchWindowExpression  Related Assertion
     */
    public function waitForWhetherThisWindowMatchWindowExpression($currentWindowString, $target)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the number of nodes that match the specified xpath, eg. "//table" would give the number of
     * tables.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the number of nodes that match the specified xpath</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyNotXpathCount}).</p>
     * 
     * @param string   $xpath    the xpath expression to evaluate. do NOT wrap this expression in a 'count()' function;
     *                           we will  do that for you.
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeXpathCount       Base method, from which has been generated (automatically) current method
     * @see  assertXpathCount      Related Assertion
     * @see  getXpathCount         Related Accessor
     * @see  verifyNotXpathCount   Related Assertion
     * @see  verifyXpathCount      Related Assertion
     * @see  waitForNotXpathCount  Related Assertion
     * @see  waitForXpathCount     Related Assertion
     */
    public function assertNotXpathCount($xpath, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the number of nodes that match the specified xpath, eg. "//table" would give the number of
     * tables.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the number of nodes that match the specified xpath</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyXpathCount}).</p>
     * 
     * @param string   $xpath    the xpath expression to evaluate. do NOT wrap this expression in a 'count()' function;
     *                           we will  do that for you.
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeXpathCount       Base method, from which has been generated (automatically) current method
     * @see  assertNotXpathCount   Related Assertion
     * @see  getXpathCount         Related Accessor
     * @see  verifyNotXpathCount   Related Assertion
     * @see  verifyXpathCount      Related Assertion
     * @see  waitForNotXpathCount  Related Assertion
     * @see  waitForXpathCount     Related Assertion
     */
    public function assertXpathCount($xpath, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Returns the number of nodes that match the specified xpath, eg. "//table" would give the number of tables.
     * 
     * @param string   $xpath  the xpath expression to evaluate. do NOT wrap this expression in a 'count()' function;
     *                         we will  do that for you.
     * 
     * @return  int  the number of nodes that match the specified xpath
     * 
     * @see  storeXpathCount       Base method, from which has been generated (automatically) current method
     * @see  assertNotXpathCount   Related Assertion
     * @see  assertXpathCount      Related Assertion
     * @see  verifyNotXpathCount   Related Assertion
     * @see  verifyXpathCount      Related Assertion
     * @see  waitForNotXpathCount  Related Assertion
     * @see  waitForXpathCount     Related Assertion
     */
    public function getXpathCount($xpath)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Returns the number of nodes that match the specified xpath, eg. "//table" would give the number of tables.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>the number of nodes that match the specified xpath (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $xpath         the xpath expression to evaluate. do NOT wrap this expression in a 'count()'
     *                                function; we will  do that for you.
     * @param string   $variableName  the name of a variable in which the result is to be stored. (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertNotXpathCount   Related Assertion
     * @see  assertXpathCount      Related Assertion
     * @see  getXpathCount         Related Accessor
     * @see  verifyNotXpathCount   Related Assertion
     * @see  verifyXpathCount      Related Assertion
     * @see  waitForNotXpathCount  Related Assertion
     * @see  waitForXpathCount     Related Assertion
     */
    public function storeXpathCount($xpath, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the number of nodes that match the specified xpath, eg. "//table" would give the number of
     * tables.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the number of nodes that match the specified xpath</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertNotXpathCount}).</p>
     * 
     * @param string   $xpath    the xpath expression to evaluate. do NOT wrap this expression in a 'count()' function;
     *                           we will  do that for you.
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeXpathCount       Base method, from which has been generated (automatically) current method
     * @see  assertNotXpathCount   Related Assertion
     * @see  assertXpathCount      Related Assertion
     * @see  getXpathCount         Related Accessor
     * @see  verifyXpathCount      Related Assertion
     * @see  waitForNotXpathCount  Related Assertion
     * @see  waitForXpathCount     Related Assertion
     */
    public function verifyNotXpathCount($xpath, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the number of nodes that match the specified xpath, eg. "//table" would give the number of
     * tables.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>the number of nodes that match the specified xpath</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertXpathCount}).</p>
     * 
     * @param string   $xpath    the xpath expression to evaluate. do NOT wrap this expression in a 'count()' function;
     *                           we will  do that for you.
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeXpathCount       Base method, from which has been generated (automatically) current method
     * @see  assertNotXpathCount   Related Assertion
     * @see  assertXpathCount      Related Assertion
     * @see  getXpathCount         Related Accessor
     * @see  verifyNotXpathCount   Related Assertion
     * @see  waitForNotXpathCount  Related Assertion
     * @see  waitForXpathCount     Related Assertion
     */
    public function verifyXpathCount($xpath, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the number of nodes that match the specified xpath, eg. "//table" would give the number of
     * tables.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the number of nodes that match the specified xpath</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $xpath    the xpath expression to evaluate. do NOT wrap this expression in a 'count()' function;
     *                           we will  do that for you.
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeXpathCount      Base method, from which has been generated (automatically) current method
     * @see  assertNotXpathCount  Related Assertion
     * @see  assertXpathCount     Related Assertion
     * @see  getXpathCount        Related Accessor
     * @see  verifyNotXpathCount  Related Assertion
     * @see  verifyXpathCount     Related Assertion
     * @see  waitForXpathCount    Related Assertion
     */
    public function waitForNotXpathCount($xpath, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Returns the number of nodes that match the specified xpath, eg. "//table" would give the number of
     * tables.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>the number of nodes that match the specified xpath</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $xpath    the xpath expression to evaluate. do NOT wrap this expression in a 'count()' function;
     *                           we will  do that for you.
     * @param string   $pattern  the String-match Patterns 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeXpathCount       Base method, from which has been generated (automatically) current method
     * @see  assertNotXpathCount   Related Assertion
     * @see  assertXpathCount      Related Assertion
     * @see  getXpathCount         Related Accessor
     * @see  verifyNotXpathCount   Related Assertion
     * @see  verifyXpathCount      Related Assertion
     * @see  waitForNotXpathCount  Related Assertion
     */
    public function waitForXpathCount($xpath, $pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Has a prompt occurred? 
     * 
     * <p> This function never throws an exception </p>.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if there is a pending prompt</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyPromptNotPresent}).</p>
     * 
     * @return  void
     * 
     * @see  storePromptPresent       Base method, from which has been generated (automatically) current method
     * @see  assertPromptPresent      Related Assertion
     * @see  isPromptPresent          Related Accessor
     * @see  verifyPromptNotPresent   Related Assertion
     * @see  verifyPromptPresent      Related Assertion
     * @see  waitForPromptNotPresent  Related Assertion
     * @see  waitForPromptPresent     Related Assertion
     */
    public function assertPromptNotPresent()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Has a prompt occurred? 
     * 
     * <p> This function never throws an exception </p>.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if there is a pending prompt</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyPromptPresent}).</p>
     * 
     * @return  void
     * 
     * @see  storePromptPresent       Base method, from which has been generated (automatically) current method
     * @see  assertPromptNotPresent   Related Assertion
     * @see  isPromptPresent          Related Accessor
     * @see  verifyPromptNotPresent   Related Assertion
     * @see  verifyPromptPresent      Related Assertion
     * @see  waitForPromptNotPresent  Related Assertion
     * @see  waitForPromptPresent     Related Assertion
     */
    public function assertPromptPresent()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Has a prompt occurred? 
     * 
     * <p> This function never throws an exception </p>.
     * 
     * @return  bool  true if there is a pending prompt
     * 
     * @see  storePromptPresent       Base method, from which has been generated (automatically) current method
     * @see  assertPromptNotPresent   Related Assertion
     * @see  assertPromptPresent      Related Assertion
     * @see  verifyPromptNotPresent   Related Assertion
     * @see  verifyPromptPresent      Related Assertion
     * @see  waitForPromptNotPresent  Related Assertion
     * @see  waitForPromptPresent     Related Assertion
     */
    public function isPromptPresent()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Has a prompt occurred? 
     * 
     * <p> This function never throws an exception </p>.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>true if there is a pending prompt (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $variableName  the name of a variable in which the result is to be stored (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertPromptNotPresent   Related Assertion
     * @see  assertPromptPresent      Related Assertion
     * @see  isPromptPresent          Related Accessor
     * @see  verifyPromptNotPresent   Related Assertion
     * @see  verifyPromptPresent      Related Assertion
     * @see  waitForPromptNotPresent  Related Assertion
     * @see  waitForPromptPresent     Related Assertion
     */
    public function storePromptPresent($variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Has a prompt occurred? 
     * 
     * <p> This function never throws an exception </p>.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if there is a pending prompt</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertPromptNotPresent}).</p>
     * 
     * @return  void
     * 
     * @see  storePromptPresent       Base method, from which has been generated (automatically) current method
     * @see  assertPromptNotPresent   Related Assertion
     * @see  assertPromptPresent      Related Assertion
     * @see  isPromptPresent          Related Accessor
     * @see  verifyPromptPresent      Related Assertion
     * @see  waitForPromptNotPresent  Related Assertion
     * @see  waitForPromptPresent     Related Assertion
     */
    public function verifyPromptNotPresent()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Has a prompt occurred? 
     * 
     * <p> This function never throws an exception </p>.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if there is a pending prompt</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertPromptPresent}).</p>
     * 
     * @return  void
     * 
     * @see  storePromptPresent       Base method, from which has been generated (automatically) current method
     * @see  assertPromptNotPresent   Related Assertion
     * @see  assertPromptPresent      Related Assertion
     * @see  isPromptPresent          Related Accessor
     * @see  verifyPromptNotPresent   Related Assertion
     * @see  waitForPromptNotPresent  Related Assertion
     * @see  waitForPromptPresent     Related Assertion
     */
    public function verifyPromptPresent()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Has a prompt occurred? 
     * 
     * <p> This function never throws an exception </p>.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>true if there is a pending prompt</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @return  void
     * 
     * @see  storePromptPresent      Base method, from which has been generated (automatically) current method
     * @see  assertPromptNotPresent  Related Assertion
     * @see  assertPromptPresent     Related Assertion
     * @see  isPromptPresent         Related Accessor
     * @see  verifyPromptNotPresent  Related Assertion
     * @see  verifyPromptPresent     Related Assertion
     * @see  waitForPromptPresent    Related Assertion
     */
    public function waitForPromptNotPresent()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Has a prompt occurred? 
     * 
     * <p> This function never throws an exception </p>.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>true if there is a pending prompt</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @return  void
     * 
     * @see  storePromptPresent       Base method, from which has been generated (automatically) current method
     * @see  assertPromptNotPresent   Related Assertion
     * @see  assertPromptPresent      Related Assertion
     * @see  isPromptPresent          Related Accessor
     * @see  verifyPromptNotPresent   Related Assertion
     * @see  verifyPromptPresent      Related Assertion
     * @see  waitForPromptNotPresent  Related Assertion
     */
    public function waitForPromptPresent()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Verifies that the specified text pattern appears somewhere on the rendered page shown to the user.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if the pattern matches the text, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyTextNotPresent}).</p>
     * 
     * @param string   $pattern  a pattern to match with the text of the page 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeTextPresent       Base method, from which has been generated (automatically) current method
     * @see  assertTextPresent      Related Assertion
     * @see  isTextPresent          Related Accessor
     * @see  verifyTextNotPresent   Related Assertion
     * @see  verifyTextPresent      Related Assertion
     * @see  waitForTextNotPresent  Related Assertion
     * @see  waitForTextPresent     Related Assertion
     */
    public function assertTextNotPresent($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Verifies that the specified text pattern appears somewhere on the rendered page shown to the user.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if the pattern matches the text, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will abort the current test case (in contrast to the
     * {@link verifyTextPresent}).</p>
     * 
     * @param string   $pattern  a pattern to match with the text of the page 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeTextPresent       Base method, from which has been generated (automatically) current method
     * @see  assertTextNotPresent   Related Assertion
     * @see  isTextPresent          Related Accessor
     * @see  verifyTextNotPresent   Related Assertion
     * @see  verifyTextPresent      Related Assertion
     * @see  waitForTextNotPresent  Related Assertion
     * @see  waitForTextPresent     Related Assertion
     */
    public function assertTextPresent($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Verifies that the specified text pattern appears somewhere on the rendered page shown to the user.
     * 
     * @param string   $pattern  a pattern to match with the text of the page 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  bool  true if the pattern matches the text, false otherwise
     * 
     * @see  storeTextPresent       Base method, from which has been generated (automatically) current method
     * @see  assertTextNotPresent   Related Assertion
     * @see  assertTextPresent      Related Assertion
     * @see  verifyTextNotPresent   Related Assertion
     * @see  verifyTextPresent      Related Assertion
     * @see  waitForTextNotPresent  Related Assertion
     * @see  waitForTextPresent     Related Assertion
     */
    public function isTextPresent($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Verifies that the specified text pattern appears somewhere on the rendered page shown to the user.
     * 
     * <h4>Stored value:</h4>
     * 
     * <p>true if the pattern matches the text, false otherwise (see {@link doc_Stored_Variables})</p>
     * 
     * @param string   $pattern       a pattern to match with the text of the page (see
     *                                {@link doc_String_match_Patterns})
     * @param string   $variableName  the name of a variable in which the result is to be stored. (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     * 
     * @see  assertTextNotPresent   Related Assertion
     * @see  assertTextPresent      Related Assertion
     * @see  isTextPresent          Related Accessor
     * @see  verifyTextNotPresent   Related Assertion
     * @see  verifyTextPresent      Related Assertion
     * @see  waitForTextNotPresent  Related Assertion
     * @see  waitForTextPresent     Related Assertion
     */
    public function storeTextPresent($pattern, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Verifies that the specified text pattern appears somewhere on the rendered page shown to the user.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if the pattern matches the text, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertTextNotPresent}).</p>
     * 
     * @param string   $pattern  a pattern to match with the text of the page 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeTextPresent       Base method, from which has been generated (automatically) current method
     * @see  assertTextNotPresent   Related Assertion
     * @see  assertTextPresent      Related Assertion
     * @see  isTextPresent          Related Accessor
     * @see  verifyTextPresent      Related Assertion
     * @see  waitForTextNotPresent  Related Assertion
     * @see  waitForTextPresent     Related Assertion
     */
    public function verifyTextNotPresent($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Verifies that the specified text pattern appears somewhere on the rendered page shown to the user.
     * 
     * <h4>Value to verify:</h4>
     * 
     * <p>true if the pattern matches the text, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>If assertion will fail the test, it will continue to run the test case (in contrast to the
     * {@link assertTextPresent}).</p>
     * 
     * @param string   $pattern  a pattern to match with the text of the page 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeTextPresent       Base method, from which has been generated (automatically) current method
     * @see  assertTextNotPresent   Related Assertion
     * @see  assertTextPresent      Related Assertion
     * @see  isTextPresent          Related Accessor
     * @see  verifyTextNotPresent   Related Assertion
     * @see  waitForTextNotPresent  Related Assertion
     * @see  waitForTextPresent     Related Assertion
     */
    public function verifyTextPresent($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Verifies that the specified text pattern appears somewhere on the rendered page shown to the user.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>true if the pattern matches the text, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  a pattern to match with the text of the page 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeTextPresent      Base method, from which has been generated (automatically) current method
     * @see  assertTextNotPresent  Related Assertion
     * @see  assertTextPresent     Related Assertion
     * @see  isTextPresent         Related Accessor
     * @see  verifyTextNotPresent  Related Assertion
     * @see  verifyTextPresent     Related Assertion
     * @see  waitForTextPresent    Related Assertion
     */
    public function waitForTextNotPresent($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Assertion: Verifies that the specified text pattern appears somewhere on the rendered page shown to the user.
     * 
     * <h4>Expected value/condition:</h4>
     * 
     * <p>true if the pattern matches the text, false otherwise</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>This command wait for some condition to become true (or returned value is equal specified value).</p>
     * 
     * <p>This command will succeed immediately if the condition is already true.</p>
     * 
     * @param string   $pattern  a pattern to match with the text of the page 
     *                           (see {@link doc_String_match_Patterns})
     * 
     * @return  void
     * 
     * @see  storeTextPresent       Base method, from which has been generated (automatically) current method
     * @see  assertTextNotPresent   Related Assertion
     * @see  assertTextPresent      Related Assertion
     * @see  isTextPresent          Related Accessor
     * @see  verifyTextNotPresent   Related Assertion
     * @see  verifyTextPresent      Related Assertion
     * @see  waitForTextNotPresent  Related Assertion
     */
    public function waitForTextPresent($pattern)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Temporarily sets the "id" attribute of the specified element, so you can locate it in the future using its ID
     * rather than a slow/complicated XPath. 
     * 
     * This ID will disappear once the page is reloaded.
     * 
     * @param string   $locator     an element locator pointing to an element 
     *                              (see {@link doc_Element_Locators})
     * @param string   $identifier  a string to be used as the ID of the specified element
     * 
     * @return  void
     * 
     * @see  assignIdAndWait  Related Action
     */
    public function assignId($locator, $identifier)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Temporarily sets the "id" attribute of the specified element, so you can locate it in the future using its ID
     * rather than a slow/complicated XPath. 
     * 
     * This ID will disappear once the page is reloaded.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator     an element locator pointing to an element 
     *                              (see {@link doc_Element_Locators})
     * @param string   $identifier  a string to be used as the ID of the specified element
     * 
     * @return  void
     * 
     * @see  assignId  Base method, from which has been generated (automatically) current method
     */
    public function assignIdAndWait($locator, $identifier)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Sets a file input (upload) field to the file listed in fileLocator.
     * 
     * @param string   $fieldLocator  an element locator 
     *                                (see {@link doc_Element_Locators})
     * @param string   $fileLocator   a URL pointing to the specified file. Before the file can be set in the input
     *                                field (fieldLocator), Selenium RC may need to transfer the file to the local
     *                                machine before attaching the file in a web page form. This is common in selenium
     *                                grid configurations where the RC server driving the browser is not the same
     *                                machine that started the test. Supported Browsers: Firefox ("*chrome") only.
     * 
     * @return  void
     */
    public function attachFile($fieldLocator, $fileLocator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Saves the entire contents of the current window canvas to a PNG file. 
     * 
     * Contrast this with the captureScreenshot command, which captures the contents of the OS viewport (i.e. whatever
     * is currently being displayed on the monitor), and is implemented in the RC only. Currently this only works in
     * Firefox when running in chrome mode, and in IE non-HTA using the EXPERIMENTAL "Snapsie" utility. The Firefox
     * implementation is mostly borrowed from the Screengrab! Firefox extension. Please see http://www.screengrab.org
     * and http://snapsie.sourceforge.net/ for details.
     * 
     * @param string   $filename  the path to the file to persist the screenshot as. No filename extension will be
     *                            appended by  default. Directories will not be created if they do not exist, and an
     *                            exception will be thrown, possibly  by native code.
     * @param string   $kwargs    a kwargs string that modifies the way the screenshot is captured. Example:
     *                            "background=#CCFFDD"  . Currently valid options:  <dl>  <dt>background</dt>  <dd>the
     *                            background CSS for the HTML document. This may be useful to set for capturing
     *                            screenshots of  less-than-ideal layouts, for example where absolute positioning
     *                            causes the calculation of the  canvas dimension to fail and a black background is
     *                            exposed (possibly obscuring black text).  </dd>  </dl>
     * 
     * @return  void
     * 
     * @see  captureEntirePageScreenshotAndWait  Related Action
     */
    public function captureEntirePageScreenshot($filename, $kwargs)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Saves the entire contents of the current window canvas to a PNG file. 
     * 
     * Contrast this with the captureScreenshot command, which captures the contents of the OS viewport (i.e. whatever
     * is currently being displayed on the monitor), and is implemented in the RC only. Currently this only works in
     * Firefox when running in chrome mode, and in IE non-HTA using the EXPERIMENTAL "Snapsie" utility. The Firefox
     * implementation is mostly borrowed from the Screengrab! Firefox extension. Please see http://www.screengrab.org
     * and http://snapsie.sourceforge.net/ for details.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $filename  the path to the file to persist the screenshot as. No filename extension will be
     *                            appended by  default. Directories will not be created if they do not exist, and an
     *                            exception will be thrown, possibly  by native code.
     * @param string   $kwargs    a kwargs string that modifies the way the screenshot is captured. Example:
     *                            "background=#CCFFDD"  . Currently valid options:  <dl>  <dt>background</dt>  <dd>the
     *                            background CSS for the HTML document. This may be useful to set for capturing
     *                            screenshots of  less-than-ideal layouts, for example where absolute positioning
     *                            causes the calculation of the  canvas dimension to fail and a black background is
     *                            exposed (possibly obscuring black text).  </dd>  </dl>
     * 
     * @return  void
     * 
     * @see  captureEntirePageScreenshot  Base method, from which has been generated (automatically) current method
     */
    public function captureEntirePageScreenshotAndWait($filename, $kwargs)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Downloads a screenshot of the browser current window canvas to a based 64 encoded PNG file. 
     * 
     * The <b>entire</b> windows canvas is captured, including parts rendered outside of the current view port.
     * 
     * <p><b>Note:</b> Currently this only works in Mozilla and when running in chrome mode.</p>
     * 
     * @param string   $kwargs  A kwargs string that modifies the way the screenshot is captured. Example:
     *                          "background=#CCFFDD". This may be useful to set for capturing screenshots of
     *                          less-than-ideal layouts, for example where absolute positioning causes the calculation
     *                          of the canvas dimension to fail and a black background is exposed (possibly obscuring
     *                          black text).
     * 
     * @return  string  The base 64 encoded string of the page screenshot (PNG file)
     * 
     * @see  captureEntirePageScreenshotToStringAndWait  Related Action
     */
    public function captureEntirePageScreenshotToString($kwargs)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Downloads a screenshot of the browser current window canvas to a based 64 encoded PNG file. 
     * 
     * The <b>entire</b> windows canvas is captured, including parts rendered outside of the current view port.
     * 
     * <p><b>Note:</b> Currently this only works in Mozilla and when running in chrome mode.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $kwargs  A kwargs string that modifies the way the screenshot is captured. Example:
     *                          "background=#CCFFDD". This may be useful to set for capturing screenshots of
     *                          less-than-ideal layouts, for example where absolute positioning causes the calculation
     *                          of the canvas dimension to fail and a black background is exposed (possibly obscuring
     *                          black text).
     * 
     * @return  string  The base 64 encoded string of the page screenshot (PNG file)
     * 
     * @see  captureEntirePageScreenshotToString  Base method, from which has been generated (automatically) current
     *                                            method
     */
    public function captureEntirePageScreenshotToStringAndWait($kwargs)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Captures a PNG screenshot to the specified file.
     * 
     * @param string   $filename  the absolute path to the file to be written, e.g. "c:\blah\screenshot.png"
     * 
     * @return  void
     * 
     * @see  captureScreenshotAndWait  Related Action
     */
    public function captureScreenshot($filename)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Captures a PNG screenshot to the specified file.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $filename  the absolute path to the file to be written, e.g. "c:\blah\screenshot.png"
     * 
     * @return  void
     * 
     * @see  captureScreenshot  Base method, from which has been generated (automatically) current method
     */
    public function captureScreenshotAndWait($filename)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Capture a PNG screenshot. 
     * 
     * It then returns the file as a base 64 encoded string.
     * 
     * @return  string  The base 64 encoded string of the screen shot (PNG file)
     * 
     * @see  captureScreenshotToStringAndWait  Related Action
     */
    public function captureScreenshotToString()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Capture a PNG screenshot. 
     * 
     * It then returns the file as a base 64 encoded string.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @return  string  The base 64 encoded string of the screen shot (PNG file)
     * 
     * @see  captureScreenshotToString  Base method, from which has been generated (automatically) current method
     */
    public function captureScreenshotToStringAndWait()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Check a toggle-button (checkbox/radio).
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  checkAndWait  Related Action
     */
    public function check($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Check a toggle-button (checkbox/radio).
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  check  Base method, from which has been generated (automatically) current method
     */
    public function checkAndWait($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * <p> By default, Selenium's overridden window.confirm() function will return true, as if the user had manually
     * clicked OK; after running this command, the next call to confirm() will return false, as if the user had clicked
     * Cancel. 
     * 
     * Selenium will then resume using the default behavior for future confirmations, automatically returning true (OK)
     * unless/until you explicitly call this command for each confirmation. </p>
     * 
     * <p> Take note - every time a confirmation comes up, you must consume it with a corresponding getConfirmation, or
     * else the next selenium operation will fail. </p>
     * 
     * @return  void
     * 
     * @see  chooseCancelOnNextConfirmationAndWait  Related Action
     */
    public function chooseCancelOnNextConfirmation()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * <p> By default, Selenium's overridden window.confirm() function will return true, as if the user had manually
     * clicked OK; after running this command, the next call to confirm() will return false, as if the user had clicked
     * Cancel. 
     * 
     * Selenium will then resume using the default behavior for future confirmations, automatically returning true (OK)
     * unless/until you explicitly call this command for each confirmation. </p>
     * 
     * <p> Take note - every time a confirmation comes up, you must consume it with a corresponding getConfirmation, or
     * else the next selenium operation will fail. </p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @return  void
     * 
     * @see  chooseCancelOnNextConfirmation  Base method, from which has been generated (automatically) current method
     */
    public function chooseCancelOnNextConfirmationAndWait()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * <p> Undo the effect of calling chooseCancelOnNextConfirmation. 
     * 
     * Note that Selenium's overridden window.confirm() function will normally automatically return true, as if the
     * user had manually clicked OK, so you shouldn't need to use this command unless for some reason you need to
     * change your mind prior to the next confirmation. After any confirmation, Selenium will resume using the default
     * behavior for future confirmations, automatically returning true (OK) unless/until you explicitly call
     * chooseCancelOnNextConfirmation for each confirmation. </p>
     * 
     * <p> Take note - every time a confirmation comes up, you must consume it with a corresponding getConfirmation, or
     * else the next selenium operation will fail. </p>
     * 
     * @return  void
     * 
     * @see  chooseOkOnNextConfirmationAndWait  Related Action
     */
    public function chooseOkOnNextConfirmation()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * <p> Undo the effect of calling chooseCancelOnNextConfirmation. 
     * 
     * Note that Selenium's overridden window.confirm() function will normally automatically return true, as if the
     * user had manually clicked OK, so you shouldn't need to use this command unless for some reason you need to
     * change your mind prior to the next confirmation. After any confirmation, Selenium will resume using the default
     * behavior for future confirmations, automatically returning true (OK) unless/until you explicitly call
     * chooseCancelOnNextConfirmation for each confirmation. </p>
     * 
     * <p> Take note - every time a confirmation comes up, you must consume it with a corresponding getConfirmation, or
     * else the next selenium operation will fail. </p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @return  void
     * 
     * @see  chooseOkOnNextConfirmation  Base method, from which has been generated (automatically) current method
     */
    public function chooseOkOnNextConfirmationAndWait()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Clicks on a link, button, checkbox or radio button. 
     * 
     * If the click action causes a new page to load (like a link usually does), call waitForPageToLoad.
     * 
     * @param string   $locator  an element locator
     * 
     * @return  void
     * 
     * @see  clickAndWait  Related Action
     */
    public function click($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Clicks on a link, button, checkbox or radio button. 
     * 
     * If the click action causes a new page to load (like a link usually does), call waitForPageToLoad.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator  an element locator
     * 
     * @return  void
     * 
     * @see  click  Base method, from which has been generated (automatically) current method
     */
    public function clickAndWait($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Clicks on a link, button, checkbox or radio button. 
     * 
     * If the click action causes a new page to load (like a link usually does), call waitForPageToLoad.
     * 
     * @param string   $locator      an element locator
     * @param string   $coordString  specifies the x,y position (i.e. - 10,20) of the mouse event relative to the
     *                               element  returned by the locator.
     * 
     * @return  void
     * 
     * @see  clickAtAndWait  Related Action
     */
    public function clickAt($locator, $coordString)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Clicks on a link, button, checkbox or radio button. 
     * 
     * If the click action causes a new page to load (like a link usually does), call waitForPageToLoad.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator      an element locator
     * @param string   $coordString  specifies the x,y position (i.e. - 10,20) of the mouse event relative to the
     *                               element  returned by the locator.
     * 
     * @return  void
     * 
     * @see  clickAt  Base method, from which has been generated (automatically) current method
     */
    public function clickAtAndWait($locator, $coordString)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates the user clicking the "close" button in the titlebar of a popup window or tab. 
     * 
     * @return  void
     */
    public function close()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates opening the context menu for the specified element (as might happen if the user "right-clicked" on the
     * element).
     * 
     * @param string   $locator  an element locator
     * 
     * @return  void
     * 
     * @see  contextMenuAndWait  Related Action
     */
    public function contextMenu($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates opening the context menu for the specified element (as might happen if the user "right-clicked" on the
     * element).
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator  an element locator
     * 
     * @return  void
     * 
     * @see  contextMenu  Base method, from which has been generated (automatically) current method
     */
    public function contextMenuAndWait($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates opening the context menu for the specified element (as might happen if the user "right-clicked" on the
     * element).
     * 
     * @param string   $locator      an element locator
     * @param string   $coordString  specifies the x,y position (i.e. - 10,20) of the mouse event relative to the
     *                               element  returned by the locator.
     * 
     * @return  void
     * 
     * @see  contextMenuAtAndWait  Related Action
     */
    public function contextMenuAt($locator, $coordString)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates opening the context menu for the specified element (as might happen if the user "right-clicked" on the
     * element).
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator      an element locator
     * @param string   $coordString  specifies the x,y position (i.e. - 10,20) of the mouse event relative to the
     *                               element  returned by the locator.
     * 
     * @return  void
     * 
     * @see  contextMenuAt  Base method, from which has been generated (automatically) current method
     */
    public function contextMenuAtAndWait($locator, $coordString)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Press the control key and hold it down until doControlUp() is called or a new page is loaded.
     * 
     * @return  void
     * 
     * @see  controlKeyDownAndWait  Related Action
     */
    public function controlKeyDown()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Press the control key and hold it down until doControlUp() is called or a new page is loaded.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @return  void
     * 
     * @see  controlKeyDown  Base method, from which has been generated (automatically) current method
     */
    public function controlKeyDownAndWait()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Release the control key.
     * 
     * @return  void
     * 
     * @see  controlKeyUpAndWait  Related Action
     */
    public function controlKeyUp()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Release the control key.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @return  void
     * 
     * @see  controlKeyUp  Base method, from which has been generated (automatically) current method
     */
    public function controlKeyUpAndWait()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Create a new cookie whose path and domain are same with those of current page under test, unless you specified a
     * path for this cookie explicitly.
     * 
     * @param string   $nameValuePair  name and value of the cookie in a format "name=value"
     * @param string   $optionsString  options for the cookie. Currently supported options include 'path', 'max_age'
     *                                 and  'domain'. the optionsString's format is "path=/path/, max_age=60,
     *                                 domain=.foo.com". The order of options  are irrelevant, the unit of the value of
     *                                 'max_age' is second. Note that specifying a domain that isn't a  subset of the
     *                                 current domain will usually fail.
     * 
     * @return  void
     * 
     * @see  createCookieAndWait  Related Action
     */
    public function createCookie($nameValuePair, $optionsString)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Create a new cookie whose path and domain are same with those of current page under test, unless you specified a
     * path for this cookie explicitly.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $nameValuePair  name and value of the cookie in a format "name=value"
     * @param string   $optionsString  options for the cookie. Currently supported options include 'path', 'max_age'
     *                                 and  'domain'. the optionsString's format is "path=/path/, max_age=60,
     *                                 domain=.foo.com". The order of options  are irrelevant, the unit of the value of
     *                                 'max_age' is second. Note that specifying a domain that isn't a  subset of the
     *                                 current domain will usually fail.
     * 
     * @return  void
     * 
     * @see  createCookie  Base method, from which has been generated (automatically) current method
     */
    public function createCookieAndWait($nameValuePair, $optionsString)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Calls deleteCookie with recurse=true on all cookies visible to the current page. 
     * 
     * As noted on the documentation for deleteCookie, recurse=true can be much slower than simply deleting the cookies
     * using a known domain/path.
     * 
     * @return  void
     * 
     * @see  deleteAllVisibleCookiesAndWait  Related Action
     */
    public function deleteAllVisibleCookies()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Calls deleteCookie with recurse=true on all cookies visible to the current page. 
     * 
     * As noted on the documentation for deleteCookie, recurse=true can be much slower than simply deleting the cookies
     * using a known domain/path.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @return  void
     * 
     * @see  deleteAllVisibleCookies  Base method, from which has been generated (automatically) current method
     */
    public function deleteAllVisibleCookiesAndWait()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Delete a named cookie with specified path and domain. 
     * 
     * Be careful; to delete a cookie, you need to delete it using the exact same path and domain that were used to
     * create the cookie. If the path is wrong, or the domain is wrong, the cookie simply won't be deleted. Also note
     * that specifying a domain that isn't a subset of the current domain will usually fail. Since there's no way to
     * discover at runtime the original path and domain of a given cookie, we've added an option called 'recurse' to
     * try all sub-domains of the current domain with all paths that are a subset of the current path. Beware; this
     * option can be slow. In big-O notation, it operates in O(n*m) time, where n is the number of dots in the domain
     * name and m is the number of slashes in the path.
     * 
     * @param string   $name           the name of the cookie to be deleted
     * @param string   $optionsString  options for the cookie. Currently supported options include 'path', 'domain' and
     *                                  'recurse.' The optionsString's format is "path=/path/, domain=.foo.com,
     *                                 recurse=true". The order of  options are irrelevant. Note that specifying a
     *                                 domain that isn't a subset of the current domain will  usually fail.
     * 
     * @return  void
     * 
     * @see  deleteCookieAndWait  Related Action
     */
    public function deleteCookie($name, $optionsString)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Delete a named cookie with specified path and domain. 
     * 
     * Be careful; to delete a cookie, you need to delete it using the exact same path and domain that were used to
     * create the cookie. If the path is wrong, or the domain is wrong, the cookie simply won't be deleted. Also note
     * that specifying a domain that isn't a subset of the current domain will usually fail. Since there's no way to
     * discover at runtime the original path and domain of a given cookie, we've added an option called 'recurse' to
     * try all sub-domains of the current domain with all paths that are a subset of the current path. Beware; this
     * option can be slow. In big-O notation, it operates in O(n*m) time, where n is the number of dots in the domain
     * name and m is the number of slashes in the path.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $name           the name of the cookie to be deleted
     * @param string   $optionsString  options for the cookie. Currently supported options include 'path', 'domain' and
     *                                  'recurse.' The optionsString's format is "path=/path/, domain=.foo.com,
     *                                 recurse=true". The order of  options are irrelevant. Note that specifying a
     *                                 domain that isn't a subset of the current domain will  usually fail.
     * 
     * @return  void
     * 
     * @see  deleteCookie  Base method, from which has been generated (automatically) current method
     */
    public function deleteCookieAndWait($name, $optionsString)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Selects the main window. 
     * 
     * Functionally equivalent to using [<b>selectWindow()</b>] and specifying no value for [<b>windowID</b>].
     * 
     * @return  void
     * 
     * @see  deselectPopUpAndWait  Related Action
     */
    public function deselectPopUp()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Selects the main window. 
     * 
     * Functionally equivalent to using [<b>selectWindow()</b>] and specifying no value for [<b>windowID</b>].
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @return  void
     * 
     * @see  deselectPopUp  Base method, from which has been generated (automatically) current method
     */
    public function deselectPopUpAndWait()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Double clicks on a link, button, checkbox or radio button. 
     * 
     * If the double click action causes a new page to load (like a link usually does), call waitForPageToLoad.
     * 
     * @param string   $locator  an element locator
     * 
     * @return  void
     * 
     * @see  doubleClickAndWait  Related Action
     */
    public function doubleClick($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Double clicks on a link, button, checkbox or radio button. 
     * 
     * If the double click action causes a new page to load (like a link usually does), call waitForPageToLoad.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator  an element locator
     * 
     * @return  void
     * 
     * @see  doubleClick  Base method, from which has been generated (automatically) current method
     */
    public function doubleClickAndWait($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Doubleclicks on a link, button, checkbox or radio button. 
     * 
     * If the action causes a new page to load (like a link usually does), call waitForPageToLoad.
     * 
     * @param string   $locator      an element locator
     * @param string   $coordString  specifies the x,y position (i.e. - 10,20) of the mouse event relative to the
     *                               element  returned by the locator.
     * 
     * @return  void
     * 
     * @see  doubleClickAtAndWait  Related Action
     */
    public function doubleClickAt($locator, $coordString)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Doubleclicks on a link, button, checkbox or radio button. 
     * 
     * If the action causes a new page to load (like a link usually does), call waitForPageToLoad.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator      an element locator
     * @param string   $coordString  specifies the x,y position (i.e. - 10,20) of the mouse event relative to the
     *                               element  returned by the locator.
     * 
     * @return  void
     * 
     * @see  doubleClickAt  Base method, from which has been generated (automatically) current method
     */
    public function doubleClickAtAndWait($locator, $coordString)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Drags an element a certain distance and then drops it.
     * 
     * @param string   $locator          an element locator
     * @param string   $movementsString  offset in pixels from the current location to which the element should be
     *                                   moved, e.g.,  "+70,-300"
     * 
     * @return  void
     * 
     * @see  dragAndDropAndWait  Related Action
     */
    public function dragAndDrop($locator, $movementsString)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Drags an element a certain distance and then drops it.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator          an element locator
     * @param string   $movementsString  offset in pixels from the current location to which the element should be
     *                                   moved, e.g.,  "+70,-300"
     * 
     * @return  void
     * 
     * @see  dragAndDrop  Base method, from which has been generated (automatically) current method
     */
    public function dragAndDropAndWait($locator, $movementsString)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Drags an element and drops it on another element.
     * 
     * @param string   $locatorOfObjectToBeDragged      an element to be dragged
     * @param string   $locatorOfDragDestinationObject  an element whose location (i.e., whose center-most pixel) will
     *                                                  be the  point where locatorOfObjectToBeDragged is dropped
     * 
     * @return  void
     * 
     * @see  dragAndDropToObjectAndWait  Related Action
     */
    public function dragAndDropToObject($locatorOfObjectToBeDragged, $locatorOfDragDestinationObject)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Drags an element and drops it on another element.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locatorOfObjectToBeDragged      an element to be dragged
     * @param string   $locatorOfDragDestinationObject  an element whose location (i.e., whose center-most pixel) will
     *                                                  be the  point where locatorOfObjectToBeDragged is dropped
     * 
     * @return  void
     * 
     * @see  dragAndDropToObject  Base method, from which has been generated (automatically) current method
     */
    public function dragAndDropToObjectAndWait($locatorOfObjectToBeDragged, $locatorOfDragDestinationObject)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * deprecated - use dragAndDrop instead.
     * 
     * @param string   $locator          an element locator
     * @param string   $movementsString  offset in pixels from the current location to which the element should be
     *                                   moved, e.g.,  "+70,-300"
     * 
     * @return  void
     * 
     * @see  dragdrop         Base method, from which has been generated (automatically) current method
     * @see  dragDropAndWait  Related Action
     */
    public function dragDrop($locator, $movementsString)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * deprecated - use dragAndDrop instead.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator          an element locator
     * @param string   $movementsString  offset in pixels from the current location to which the element should be
     *                                   moved, e.g.,  "+70,-300"
     * 
     * @return  void
     * 
     * @see  dragdrop  Base method, from which has been generated (automatically) current method
     * @see  dragDrop  Related Action
     */
    public function dragDropAndWait($locator, $movementsString)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Explicitly simulate an event, to trigger the corresponding "on<em>event</em>" handler.
     * 
     * @param string   $locator    an element locator 
     *                             (see {@link doc_Element_Locators})
     * @param string   $eventName  the event name, e.g. "focus" or "blur"
     * 
     * @return  void
     * 
     * @see  fireEventAndWait  Related Action
     */
    public function fireEvent($locator, $eventName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Explicitly simulate an event, to trigger the corresponding "on<em>event</em>" handler.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator    an element locator 
     *                             (see {@link doc_Element_Locators})
     * @param string   $eventName  the event name, e.g. "focus" or "blur"
     * 
     * @return  void
     * 
     * @see  fireEvent  Base method, from which has been generated (automatically) current method
     */
    public function fireEventAndWait($locator, $eventName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Move the focus to the specified element; for example, if the element is an input field, move the cursor to that
     * field.
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  focusAndWait  Related Action
     */
    public function focus($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Move the focus to the specified element; for example, if the element is an input field, move the cursor to that
     * field.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  focus  Base method, from which has been generated (automatically) current method
     */
    public function focusAndWait($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates the user clicking the "back" button on their browser.
     * 
     * @return  void
     * 
     * @see  goBackAndWait  Related Action
     */
    public function goBack()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates the user clicking the "back" button on their browser.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @return  void
     * 
     * @see  goBack  Base method, from which has been generated (automatically) current method
     */
    public function goBackAndWait()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Briefly changes the backgroundColor of the specified element yellow. 
     * 
     * Useful for debugging.
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  highlightAndWait  Related Action
     */
    public function highlight($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Briefly changes the backgroundColor of the specified element yellow. 
     * 
     * Useful for debugging.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  highlight  Base method, from which has been generated (automatically) current method
     */
    public function highlightAndWait($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Specifies whether Selenium will ignore xpath attributes that have no value, i.e. are the empty string, when
     * using the non-native xpath evaluation engine. 
     * 
     * You'd want to do this for performance reasons in IE. However, this could break certain xpaths, for example an
     * xpath that looks for an attribute whose value is NOT the empty string. The hope is that such xpaths are
     * relatively rare, but the user should have the option of using them. Note that this only influences xpath
     * evaluation when using the ajaxslt engine (i.e. not "javascript-xpath").
     * 
     * @param string   $ignore  boolean, true means we'll ignore attributes without value at the expense of xpath 
     *                          "correctness"; false means we'll sacrifice speed for correctness.
     * 
     * @return  void
     * 
     * @see  ignoreAttributesWithoutValueAndWait  Related Action
     */
    public function ignoreAttributesWithoutValue($ignore)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Specifies whether Selenium will ignore xpath attributes that have no value, i.e. are the empty string, when
     * using the non-native xpath evaluation engine. 
     * 
     * You'd want to do this for performance reasons in IE. However, this could break certain xpaths, for example an
     * xpath that looks for an attribute whose value is NOT the empty string. The hope is that such xpaths are
     * relatively rare, but the user should have the option of using them. Note that this only influences xpath
     * evaluation when using the ajaxslt engine (i.e. not "javascript-xpath").
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $ignore  boolean, true means we'll ignore attributes without value at the expense of xpath 
     *                          "correctness"; false means we'll sacrifice speed for correctness.
     * 
     * @return  void
     * 
     * @see  ignoreAttributesWithoutValue  Base method, from which has been generated (automatically) current method
     */
    public function ignoreAttributesWithoutValueAndWait($ignore)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates a user pressing a key (without releasing it yet).
     * 
     * @param string   $locator      an element locator 
     *                               (see {@link doc_Element_Locators})
     * @param string   $keySequence  Either be a string("\" followed by the numeric keycode of the key to be pressed,
     *                               normally  the ASCII value of that key), or a single character. For example: "w",
     *                               "\119".
     * 
     * @return  void
     * 
     * @see  keyDownAndWait  Related Action
     */
    public function keyDown($locator, $keySequence)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates a user pressing a key (without releasing it yet).
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator      an element locator 
     *                               (see {@link doc_Element_Locators})
     * @param string   $keySequence  Either be a string("\" followed by the numeric keycode of the key to be pressed,
     *                               normally  the ASCII value of that key), or a single character. For example: "w",
     *                               "\119".
     * 
     * @return  void
     * 
     * @see  keyDown  Base method, from which has been generated (automatically) current method
     */
    public function keyDownAndWait($locator, $keySequence)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates a user pressing a key (without releasing it yet) by sending a native operating system keystroke. 
     * 
     * <p>This function uses the java.awt.Robot class to send a keystroke; this more accurately simulates typing a key
     * on the keyboard. It does not honor settings from the shiftKeyDown, controlKeyDown, altKeyDown and metaKeyDown
     * commands, and does not target any particular HTML element. To send a keystroke to a particular element, focus on
     * the element first before running this command.</p>
     * 
     * @param string   $keycode  an integer keycode number corresponding to a java.awt.event.KeyEvent; note that Java
     *                           keycodes are NOT the same thing as JavaScript keycodes!
     * 
     * @return  void
     * 
     * @see  keyDownNativeAndWait  Related Action
     */
    public function keyDownNative($keycode)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates a user pressing a key (without releasing it yet) by sending a native operating system keystroke. 
     * 
     * <p>This function uses the java.awt.Robot class to send a keystroke; this more accurately simulates typing a key
     * on the keyboard. It does not honor settings from the shiftKeyDown, controlKeyDown, altKeyDown and metaKeyDown
     * commands, and does not target any particular HTML element. To send a keystroke to a particular element, focus on
     * the element first before running this command.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $keycode  an integer keycode number corresponding to a java.awt.event.KeyEvent; note that Java
     *                           keycodes are NOT the same thing as JavaScript keycodes!
     * 
     * @return  void
     * 
     * @see  keyDownNative  Base method, from which has been generated (automatically) current method
     */
    public function keyDownNativeAndWait($keycode)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates a user pressing and releasing a key.
     * 
     * @param string   $locator      an element locator 
     *                               (see {@link doc_Element_Locators})
     * @param string   $keySequence  Either be a string("\" followed by the numeric keycode of the key to be pressed,
     *                               normally  the ASCII value of that key), or a single character. For example: "w",
     *                               "\119".
     * 
     * @return  void
     * 
     * @see  keyPressAndWait  Related Action
     */
    public function keyPress($locator, $keySequence)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates a user pressing and releasing a key.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator      an element locator 
     *                               (see {@link doc_Element_Locators})
     * @param string   $keySequence  Either be a string("\" followed by the numeric keycode of the key to be pressed,
     *                               normally  the ASCII value of that key), or a single character. For example: "w",
     *                               "\119".
     * 
     * @return  void
     * 
     * @see  keyPress  Base method, from which has been generated (automatically) current method
     */
    public function keyPressAndWait($locator, $keySequence)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates a user pressing and releasing a key by sending a native operating system keystroke. 
     * 
     * <p>This function uses the java.awt.Robot class to send a keystroke; this more accurately simulates typing a key
     * on the keyboard. It does not honor settings from the shiftKeyDown, controlKeyDown, altKeyDown and metaKeyDown
     * commands, and does not target any particular HTML element. To send a keystroke to a particular element, focus on
     * the element first before running this command.</p>
     * 
     * @param string   $keycode  an integer keycode number corresponding to a java.awt.event.KeyEvent; note that Java
     *                           keycodes are NOT the same thing as JavaScript keycodes!
     * 
     * @return  void
     * 
     * @see  keyPressNativeAndWait  Related Action
     */
    public function keyPressNative($keycode)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates a user pressing and releasing a key by sending a native operating system keystroke. 
     * 
     * <p>This function uses the java.awt.Robot class to send a keystroke; this more accurately simulates typing a key
     * on the keyboard. It does not honor settings from the shiftKeyDown, controlKeyDown, altKeyDown and metaKeyDown
     * commands, and does not target any particular HTML element. To send a keystroke to a particular element, focus on
     * the element first before running this command.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $keycode  an integer keycode number corresponding to a java.awt.event.KeyEvent; note that Java
     *                           keycodes are NOT the same thing as JavaScript keycodes!
     * 
     * @return  void
     * 
     * @see  keyPressNative  Base method, from which has been generated (automatically) current method
     */
    public function keyPressNativeAndWait($keycode)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates a user releasing a key.
     * 
     * @param string   $locator      an element locator 
     *                               (see {@link doc_Element_Locators})
     * @param string   $keySequence  Either be a string("\" followed by the numeric keycode of the key to be pressed,
     *                               normally  the ASCII value of that key), or a single character. For example: "w",
     *                               "\119".
     * 
     * @return  void
     * 
     * @see  keyUpAndWait  Related Action
     */
    public function keyUp($locator, $keySequence)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates a user releasing a key.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator      an element locator 
     *                               (see {@link doc_Element_Locators})
     * @param string   $keySequence  Either be a string("\" followed by the numeric keycode of the key to be pressed,
     *                               normally  the ASCII value of that key), or a single character. For example: "w",
     *                               "\119".
     * 
     * @return  void
     * 
     * @see  keyUp  Base method, from which has been generated (automatically) current method
     */
    public function keyUpAndWait($locator, $keySequence)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates a user releasing a key by sending a native operating system keystroke. 
     * 
     * <p>This function uses the java.awt.Robot class to send a keystroke; this more accurately simulates typing a key
     * on the keyboard. It does not honor settings from the shiftKeyDown, controlKeyDown, altKeyDown and metaKeyDown
     * commands, and does not target any particular HTML element. To send a keystroke to a particular element, focus on
     * the element first before running this command.</p>
     * 
     * @param string   $keycode  an integer keycode number corresponding to a java.awt.event.KeyEvent; note that Java
     *                           keycodes are NOT the same thing as JavaScript keycodes!
     * 
     * @return  void
     * 
     * @see  keyUpNativeAndWait  Related Action
     */
    public function keyUpNative($keycode)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates a user releasing a key by sending a native operating system keystroke. 
     * 
     * <p>This function uses the java.awt.Robot class to send a keystroke; this more accurately simulates typing a key
     * on the keyboard. It does not honor settings from the shiftKeyDown, controlKeyDown, altKeyDown and metaKeyDown
     * commands, and does not target any particular HTML element. To send a keystroke to a particular element, focus on
     * the element first before running this command.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $keycode  an integer keycode number corresponding to a java.awt.event.KeyEvent; note that Java
     *                           keycodes are NOT the same thing as JavaScript keycodes!
     * 
     * @return  void
     * 
     * @see  keyUpNative  Base method, from which has been generated (automatically) current method
     */
    public function keyUpNativeAndWait($keycode)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Press the meta key and hold it down until doMetaUp() is called or a new page is loaded.
     * 
     * @return  void
     * 
     * @see  metaKeyDownAndWait  Related Action
     */
    public function metaKeyDown()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Press the meta key and hold it down until doMetaUp() is called or a new page is loaded.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @return  void
     * 
     * @see  metaKeyDown  Base method, from which has been generated (automatically) current method
     */
    public function metaKeyDownAndWait()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Release the meta key.
     * 
     * @return  void
     * 
     * @see  metaKeyUpAndWait  Related Action
     */
    public function metaKeyUp()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Release the meta key.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @return  void
     * 
     * @see  metaKeyUp  Base method, from which has been generated (automatically) current method
     */
    public function metaKeyUpAndWait()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates a user pressing the left mouse button (without releasing it yet) on the specified element.
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  mouseDownAndWait  Related Action
     */
    public function mouseDown($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates a user pressing the left mouse button (without releasing it yet) on the specified element.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  mouseDown  Base method, from which has been generated (automatically) current method
     */
    public function mouseDownAndWait($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates a user pressing the left mouse button (without releasing it yet) at the specified location.
     * 
     * @param string   $locator      an element locator 
     *                               (see {@link doc_Element_Locators})
     * @param string   $coordString  specifies the x,y position (i.e. - 10,20) of the mouse event relative to the
     *                               element  returned by the locator.
     * 
     * @return  void
     * 
     * @see  mouseDownAtAndWait  Related Action
     */
    public function mouseDownAt($locator, $coordString)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates a user pressing the left mouse button (without releasing it yet) at the specified location.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator      an element locator 
     *                               (see {@link doc_Element_Locators})
     * @param string   $coordString  specifies the x,y position (i.e. - 10,20) of the mouse event relative to the
     *                               element  returned by the locator.
     * 
     * @return  void
     * 
     * @see  mouseDownAt  Base method, from which has been generated (automatically) current method
     */
    public function mouseDownAtAndWait($locator, $coordString)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates a user pressing the mouse button (without releasing it yet) on the specified element.
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  mouseMoveAndWait  Related Action
     */
    public function mouseMove($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates a user pressing the mouse button (without releasing it yet) on the specified element.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  mouseMove  Base method, from which has been generated (automatically) current method
     */
    public function mouseMoveAndWait($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates a user pressing the mouse button (without releasing it yet) on the specified element.
     * 
     * @param string   $locator      an element locator 
     *                               (see {@link doc_Element_Locators})
     * @param string   $coordString  specifies the x,y position (i.e. - 10,20) of the mouse event relative to the
     *                               element  returned by the locator.
     * 
     * @return  void
     * 
     * @see  mouseMoveAtAndWait  Related Action
     */
    public function mouseMoveAt($locator, $coordString)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates a user pressing the mouse button (without releasing it yet) on the specified element.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator      an element locator 
     *                               (see {@link doc_Element_Locators})
     * @param string   $coordString  specifies the x,y position (i.e. - 10,20) of the mouse event relative to the
     *                               element  returned by the locator.
     * 
     * @return  void
     * 
     * @see  mouseMoveAt  Base method, from which has been generated (automatically) current method
     */
    public function mouseMoveAtAndWait($locator, $coordString)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates a user moving the mouse pointer away from the specified element.
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  mouseOutAndWait  Related Action
     */
    public function mouseOut($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates a user moving the mouse pointer away from the specified element.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  mouseOut  Base method, from which has been generated (automatically) current method
     */
    public function mouseOutAndWait($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates a user hovering a mouse over the specified element.
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  mouseOverAndWait  Related Action
     */
    public function mouseOver($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates a user hovering a mouse over the specified element.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  mouseOver  Base method, from which has been generated (automatically) current method
     */
    public function mouseOverAndWait($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates the event that occurs when the user releases the mouse button (i.e., stops holding the button down) on
     * the specified element.
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  mouseUpAndWait  Related Action
     */
    public function mouseUp($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates the event that occurs when the user releases the mouse button (i.e., stops holding the button down) on
     * the specified element.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  mouseUp  Base method, from which has been generated (automatically) current method
     */
    public function mouseUpAndWait($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates the event that occurs when the user releases the mouse button (i.e., stops holding the button down) at
     * the specified location.
     * 
     * @param string   $locator      an element locator 
     *                               (see {@link doc_Element_Locators})
     * @param string   $coordString  specifies the x,y position (i.e. - 10,20) of the mouse event relative to the
     *                               element  returned by the locator.
     * 
     * @return  void
     * 
     * @see  mouseUpAtAndWait  Related Action
     */
    public function mouseUpAt($locator, $coordString)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates the event that occurs when the user releases the mouse button (i.e., stops holding the button down) at
     * the specified location.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator      an element locator 
     *                               (see {@link doc_Element_Locators})
     * @param string   $coordString  specifies the x,y position (i.e. - 10,20) of the mouse event relative to the
     *                               element  returned by the locator.
     * 
     * @return  void
     * 
     * @see  mouseUpAt  Base method, from which has been generated (automatically) current method
     */
    public function mouseUpAtAndWait($locator, $coordString)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates the event that occurs when the user releases the right mouse button (i.e., stops holding the button
     * down) on the specified element.
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  mouseUpRightAndWait  Related Action
     */
    public function mouseUpRight($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates the event that occurs when the user releases the right mouse button (i.e., stops holding the button
     * down) on the specified element.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  mouseUpRight  Base method, from which has been generated (automatically) current method
     */
    public function mouseUpRightAndWait($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates the event that occurs when the user releases the right mouse button (i.e., stops holding the button
     * down) at the specified location.
     * 
     * @param string   $locator      an element locator 
     *                               (see {@link doc_Element_Locators})
     * @param string   $coordString  specifies the x,y position (i.e. - 10,20) of the mouse event relative to the
     *                               element  returned by the locator.
     * 
     * @return  void
     * 
     * @see  mouseUpRightAtAndWait  Related Action
     */
    public function mouseUpRightAt($locator, $coordString)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates the event that occurs when the user releases the right mouse button (i.e., stops holding the button
     * down) at the specified location.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator      an element locator 
     *                               (see {@link doc_Element_Locators})
     * @param string   $coordString  specifies the x,y position (i.e. - 10,20) of the mouse event relative to the
     *                               element  returned by the locator.
     * 
     * @return  void
     * 
     * @see  mouseUpRightAt  Base method, from which has been generated (automatically) current method
     */
    public function mouseUpRightAtAndWait($locator, $coordString)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Opens an URL in the test frame. 
     * 
     * This accepts both relative and absolute URLs. The "open" command waits for the page to load before proceeding,
     * ie. the "AndWait" suffix is implicit. <em>Note</em>: The URL must be on the same domain as the runner HTML due
     * to security restrictions in the browser (Same Origin Policy). If you need to open an URL on another domain, use
     * the Selenium Server to start a new browser session on that domain.
     * 
     * @param string   $url  the URL to open; may be relative or absolute
     * 
     * @return  void
     */
    public function open($url)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Opens a popup window (if a window with that ID isn't already open). 
     * 
     * After opening the window, you'll need to select it using the selectWindow command.
     * 
     * <p>This command can also be a useful workaround for bug SEL-339. In some cases, Selenium will be unable to
     * intercept a call to window.open (if the call occurs during or before the "onLoad" event, for example). In those
     * cases, you can force Selenium to notice the open window's name by using the Selenium openWindow command, using
     * an empty (blank) url, like this: openWindow("", "myFunnyWindow").</p>
     * 
     * @param string   $url       the URL to open, which can be blank
     * @param string   $windowID  the JavaScript window ID of the window to select
     * 
     * @return  void
     * 
     * @see  openWindowAndWait  Related Action
     */
    public function openWindow($url, $windowID)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Opens a popup window (if a window with that ID isn't already open). 
     * 
     * After opening the window, you'll need to select it using the selectWindow command.
     * 
     * <p>This command can also be a useful workaround for bug SEL-339. In some cases, Selenium will be unable to
     * intercept a call to window.open (if the call occurs during or before the "onLoad" event, for example). In those
     * cases, you can force Selenium to notice the open window's name by using the Selenium openWindow command, using
     * an empty (blank) url, like this: openWindow("", "myFunnyWindow").</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $url       the URL to open, which can be blank
     * @param string   $windowID  the JavaScript window ID of the window to select
     * 
     * @return  void
     * 
     * @see  openWindow  Base method, from which has been generated (automatically) current method
     */
    public function openWindowAndWait($url, $windowID)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Wait for the specified amount of time (in milliseconds).
     * 
     * @param string   $waitTime  the amount of time to sleep (in milliseconds)
     * 
     * @return  void
     */
    public function pause($waitTime)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates the user clicking the "Refresh" button on their browser.
     * 
     * @return  void
     * 
     * @see  refreshAndWait  Related Action
     */
    public function refresh()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates the user clicking the "Refresh" button on their browser.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @return  void
     * 
     * @see  refresh  Base method, from which has been generated (automatically) current method
     */
    public function refreshAndWait()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Unselects all of the selected options in a multi-select element.
     * 
     * @param string   $locator  an element locator identifying a multi-select box 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  removeAllSelectionsAndWait  Related Action
     */
    public function removeAllSelections($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Unselects all of the selected options in a multi-select element.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator  an element locator identifying a multi-select box 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  removeAllSelections  Base method, from which has been generated (automatically) current method
     */
    public function removeAllSelectionsAndWait($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Removes a script tag from the Selenium document identified by the given id. 
     * 
     * Does nothing if the referenced tag doesn't exist.
     * 
     * @param string   $scriptTagId  the id of the script element to remove.
     * 
     * @return  void
     * 
     * @see  removeScriptAndWait  Related Action
     */
    public function removeScript($scriptTagId)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Removes a script tag from the Selenium document identified by the given id. 
     * 
     * Does nothing if the referenced tag doesn't exist.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $scriptTagId  the id of the script element to remove.
     * 
     * @return  void
     * 
     * @see  removeScript  Base method, from which has been generated (automatically) current method
     */
    public function removeScriptAndWait($scriptTagId)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Remove a selection from the set of selected options in a multi-select element using an option locator. @see
     * #doSelect for details of option locators.
     * 
     * @param string   $locator        an element locator identifying a multi-select box (see
     *                                 {@link doc_Element_Locators})
     * @param string   $optionLocator  an option locator (a label by default)
     * 
     * @return  void
     * 
     * @see  removeSelectionAndWait  Related Action
     */
    public function removeSelection($locator, $optionLocator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Remove a selection from the set of selected options in a multi-select element using an option locator. @see
     * #doSelect for details of option locators.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator        an element locator identifying a multi-select box (see
     *                                 {@link doc_Element_Locators})
     * @param string   $optionLocator  an option locator (a label by default)
     * 
     * @return  void
     * 
     * @see  removeSelection  Base method, from which has been generated (automatically) current method
     */
    public function removeSelectionAndWait($locator, $optionLocator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Retrieve the last messages logged on a specific remote control. 
     * 
     * Useful for error reports, especially when running multiple remote controls in a distributed environment. The
     * maximum number of log messages that can be retrieve is configured on remote control startup.
     * 
     * @return  string  The last N log messages as a multi-line string.
     */
    public function retrieveLastRemoteControlLogs()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Executes a command rollup, which is a series of commands with a unique name, and optionally arguments that
     * control the generation of the set of commands. 
     * 
     * If any one of the rolled-up commands fails, the rollup is considered to have failed. Rollups may also contain
     * nested rollups.
     * 
     * @param string   $rollupName  the name of the rollup command
     * @param string   $kwargs      keyword arguments string that influences how the rollup expands into commands
     * 
     * @return  void
     * 
     * @see  rollupAndWait  Related Action
     */
    public function rollup($rollupName, $kwargs)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Executes a command rollup, which is a series of commands with a unique name, and optionally arguments that
     * control the generation of the set of commands. 
     * 
     * If any one of the rolled-up commands fails, the rollup is considered to have failed. Rollups may also contain
     * nested rollups.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $rollupName  the name of the rollup command
     * @param string   $kwargs      keyword arguments string that influences how the rollup expands into commands
     * 
     * @return  void
     * 
     * @see  rollup  Base method, from which has been generated (automatically) current method
     */
    public function rollupAndWait($rollupName, $kwargs)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Creates a new "script" tag in the body of the current test window, and adds the specified text into the body of
     * the command. 
     * 
     * Scripts run in this way can often be debugged more easily than scripts executed using Selenium's "getEval"
     * command. Beware that JS exceptions thrown in these script tags aren't managed by Selenium, so you should
     * probably wrap your script in try/catch blocks if there is any chance that the script will throw an exception.
     * 
     * @param string   $script  the JavaScript snippet to run
     * 
     * @return  void
     * 
     * @see  runScriptAndWait  Related Action
     */
    public function runScript($script)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Creates a new "script" tag in the body of the current test window, and adds the specified text into the body of
     * the command. 
     * 
     * Scripts run in this way can often be debugged more easily than scripts executed using Selenium's "getEval"
     * command. Beware that JS exceptions thrown in these script tags aren't managed by Selenium, so you should
     * probably wrap your script in try/catch blocks if there is any chance that the script will throw an exception.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $script  the JavaScript snippet to run
     * 
     * @return  void
     * 
     * @see  runScript  Base method, from which has been generated (automatically) current method
     */
    public function runScriptAndWait($script)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Select an option from a drop-down using an option locator.
     * 
     * <p>Option locators provide different ways of specifying options of an HTML Select element(e.g. for selecting a
     * specific option, or for asserting that the selected option satisfies a specification).There are several forms of
     * Select Option Locator.</p>
     * 
     * <ul>
     *     <li><b>label=labelPattern</b> (label=regexp:^[Oo]ther) <br/>
     * matches options based on their labels, i.e. the visible text. (This is the default.) </li>
     *     <li><b>value=valuePattern</b> (value=other) <br/>
     * matches options based on their values. </li>
     *     <li><b>id=id</b> (id=option1) <br/>
     * matches options based on their ids. </li>
     *     <li><b>index=index</b> (index=2) <br/>
     * matches an option based on its index (offset from zero). </li>
     * </ul>
     * 
     * <p>If no option locator prefix is provided, the default behaviour is to match on label.</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $optionLocator  an option locator (a label by default)
     * 
     * @return  void
     * 
     * @see  selectAndWait  Related Action
     */
    public function select($selectLocator, $optionLocator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Select an option from a drop-down using an option locator.
     * 
     * <p>Option locators provide different ways of specifying options of an HTML Select element(e.g. for selecting a
     * specific option, or for asserting that the selected option satisfies a specification).There are several forms of
     * Select Option Locator.</p>
     * 
     * <ul>
     *     <li><b>label=labelPattern</b> (label=regexp:^[Oo]ther) <br/>
     * matches options based on their labels, i.e. the visible text. (This is the default.) </li>
     *     <li><b>value=valuePattern</b> (value=other) <br/>
     * matches options based on their values. </li>
     *     <li><b>id=id</b> (id=option1) <br/>
     * matches options based on their ids. </li>
     *     <li><b>index=index</b> (index=2) <br/>
     * matches an option based on its index (offset from zero). </li>
     * </ul>
     * 
     * <p>If no option locator prefix is provided, the default behaviour is to match on label.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $selectLocator  an element locator identifying a drop-down menu (see
     *                                 {@link doc_Element_Locators})
     * @param string   $optionLocator  an option locator (a label by default)
     * 
     * @return  void
     * 
     * @see  select  Base method, from which has been generated (automatically) current method
     */
    public function selectAndWait($selectLocator, $optionLocator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Selects a frame within the current window. (You may invoke this command multiple times to select nested frames.)
     * To select the parent frame, use "relative=parent" as a locator; to select the top frame, use "relative=top". 
     * 
     * You can also select a frame by its 0-based index number; select the first frame with "index=0", or the third
     * frame with "index=2".
     * 
     * <p>You may also use a DOM expression to identify the frame you want directly, like this:
     * [<b>dom=frames["main"].frames["subframe"]</b>] </p>.
     * 
     * @param string   $locator  an element locator identifying a frame or iframe 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     */
    public function selectFrame($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simplifies the process of selecting a popup window (and does not offer functionality beyond what
     * <code>selectWindow()</code> already provides). 
     * 
     * <ul>
     *     <li>If [<b>windowID</b>] is either not specified, or specified as  "null", the first non-top window is
     * selected. The top window is the one  that would be selected by [<b>selectWindow()</b>] without providing a 
     * [<b>windowID</b>] . This should not be used when more than one popup  window is in play. </li>
     *     <li>Otherwise, the window will be looked up considering  [<b>windowID</b>] as the following in order: 1) the
     * "name" of the  window, as specified to [<b>window.open()</b>]; 2) a javascript  variable which is a reference to
     * a window; and 3) the title of the  window. This is the same ordered lookup performed by  [<b>selectWindow</b>] .
     * </li>
     * </ul>
     * 
     * @param string   $windowID  an identifier for the popup window, which can take on a number of different meanings
     * 
     * @return  void
     * 
     * @see  selectPopUpAndWait  Related Action
     */
    public function selectPopUp($windowID)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simplifies the process of selecting a popup window (and does not offer functionality beyond what
     * <code>selectWindow()</code> already provides). 
     * 
     * <ul>
     *     <li>If [<b>windowID</b>] is either not specified, or specified as  "null", the first non-top window is
     * selected. The top window is the one  that would be selected by [<b>selectWindow()</b>] without providing a 
     * [<b>windowID</b>] . This should not be used when more than one popup  window is in play. </li>
     *     <li>Otherwise, the window will be looked up considering  [<b>windowID</b>] as the following in order: 1) the
     * "name" of the  window, as specified to [<b>window.open()</b>]; 2) a javascript  variable which is a reference to
     * a window; and 3) the title of the  window. This is the same ordered lookup performed by  [<b>selectWindow</b>] .
     * </li>
     * </ul>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $windowID  an identifier for the popup window, which can take on a number of different meanings
     * 
     * @return  void
     * 
     * @see  selectPopUp  Base method, from which has been generated (automatically) current method
     */
    public function selectPopUpAndWait($windowID)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Selects a popup window using a window locator; once a popup window has been selected, all commands go to that
     * window. 
     * 
     * To select the main window again, use null as the target.
     * 
     * <p> Window locators provide different ways of specifying the window object: by title, by internal JavaScript
     * "name," or by JavaScript variable. </p>
     * 
     * <ul>
     *     <li>  <strong>title</strong>=<em>My Special Window</em>:  Finds the window using the text that appears in
     * the title bar. Be careful;  two windows can share the same title. If that happens, this locator will  just pick
     * one. </li>
     *     <li>  <strong>name</strong>=<em>myWindow</em>:  Finds the window using its internal JavaScript "name"
     * property. This is the second  parameter "windowName" passed to the JavaScript method window.open(url,
     * windowName, windowFeatures,  replaceFlag)  (which Selenium intercepts). </li>
     *     <li>  <strong>var</strong>=<em>variableName</em>:  Some pop-up windows are unnamed (anonymous), but are
     * associated with a JavaScript variable name in the  current  application window, e.g. "window.foo =
     * window.open(url);". In those cases, you can open the window using  "var=foo". </li>
     * </ul>
     * 
     * <p> If no window locator prefix is provided, we'll try to guess what you mean like this:</p>
     * 
     * <p>1.) if windowID is null, (or the string "null") then it is assumed the user is referring to the original
     * window instantiated by the browser).</p>
     * 
     * <p>2.) if the value of the "windowID" parameter is a JavaScript variable name in the current application window,
     * then it is assumed that this variable contains the return value from a call to the JavaScript window.open()
     * method.</p>
     * 
     * <p>3.) Otherwise, selenium looks in a hash it maintains that maps string names to window "names".</p>
     * 
     * <p>4.) If <em>that</em> fails, we'll try looping over all of the known windows to try to find the appropriate
     * "title". Since "title" is not necessarily unique, this may have unexpected behavior.</p>
     * 
     * <p>If you're having trouble figuring out the name of a window that you want to manipulate, look at the Selenium
     * log messages which identify the names of windows created via window.open (and therefore intercepted by
     * Selenium). You will see messages like the following for each window as it is opened:</p>
     * 
     * <p> [<b>debug: window.open call intercepted; window ID (which you can use with selectWindow()) is 
     * "myNewWindow"</b>] </p>
     * 
     * <p>In some cases, Selenium will be unable to intercept a call to window.open (if the call occurs during or
     * before the "onLoad" event, for example). (This is bug SEL-339.) In those cases, you can force Selenium to notice
     * the open window's name by using the Selenium openWindow command, using an empty (blank) url, like this:
     * openWindow("", "myFunnyWindow").</p>
     * 
     * @param string   $windowID  the JavaScript window ID of the window to select
     * 
     * @return  void
     */
    public function selectWindow($windowID)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Sets the threshold for browser-side logging messages; log messages beneath this threshold will be discarded. 
     * 
     * Valid logLevel strings are: "debug", "info", "warn", "error" or "off". To see the browser logs, you need to
     * either show the log window in GUI mode, or enable browser-side logging in Selenium RC.
     * 
     * @param string   $logLevel  one of the following: "debug", "info", "warn", "error" or "off"
     * 
     * @return  void
     * 
     * @see  setBrowserLogLevelAndWait  Related Action
     */
    public function setBrowserLogLevel($logLevel)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Sets the threshold for browser-side logging messages; log messages beneath this threshold will be discarded. 
     * 
     * Valid logLevel strings are: "debug", "info", "warn", "error" or "off". To see the browser logs, you need to
     * either show the log window in GUI mode, or enable browser-side logging in Selenium RC.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $logLevel  one of the following: "debug", "info", "warn", "error" or "off"
     * 
     * @return  void
     * 
     * @see  setBrowserLogLevel  Base method, from which has been generated (automatically) current method
     */
    public function setBrowserLogLevelAndWait($logLevel)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Writes a message to the status bar and adds a note to the browser-side log.
     * 
     * @param string   $context  the message to be sent to the browser
     * 
     * @return  void
     */
    public function setContext($context)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Moves the text cursor to the specified position in the given input element or textarea. 
     * 
     * This method will fail if the specified element isn't an input element or textarea.
     * 
     * @param string   $locator   an element locator pointing to an input element or textarea (see
     *                            {@link doc_Element_Locators})
     * @param string   $position  the numerical position of the cursor in the field; position should be 0 to move the
     *                            position  to the beginning of the field. You can also set the cursor to -1 to move it
     *                            to the end of the field.
     * 
     * @return  void
     * 
     * @see  setCursorPositionAndWait  Related Action
     */
    public function setCursorPosition($locator, $position)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Moves the text cursor to the specified position in the given input element or textarea. 
     * 
     * This method will fail if the specified element isn't an input element or textarea.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator   an element locator pointing to an input element or textarea (see
     *                            {@link doc_Element_Locators})
     * @param string   $position  the numerical position of the cursor in the field; position should be 0 to move the
     *                            position  to the beginning of the field. You can also set the cursor to -1 to move it
     *                            to the end of the field.
     * 
     * @return  void
     * 
     * @see  setCursorPosition  Base method, from which has been generated (automatically) current method
     */
    public function setCursorPositionAndWait($locator, $position)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Configure the number of pixels between "mousemove" events during dragAndDrop commands (default=10). 
     * 
     * <p>Setting this value to 0 means that we'll send a "mousemove" event to every single pixel in between the start
     * location and the end location; that can be very slow, and may cause some browsers to force the JavaScript to
     * timeout.</p>
     * 
     * <p>If the mouse speed is greater than the distance between the two dragged objects, we'll just send one
     * "mousemove" at the start location and then one final one at the end location.</p>
     * 
     * @param string   $pixels  the number of pixels between "mousemove" events
     * 
     * @return  void
     * 
     * @see  setMouseSpeedAndWait  Related Action
     */
    public function setMouseSpeed($pixels)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Configure the number of pixels between "mousemove" events during dragAndDrop commands (default=10). 
     * 
     * <p>Setting this value to 0 means that we'll send a "mousemove" event to every single pixel in between the start
     * location and the end location; that can be very slow, and may cause some browsers to force the JavaScript to
     * timeout.</p>
     * 
     * <p>If the mouse speed is greater than the distance between the two dragged objects, we'll just send one
     * "mousemove" at the start location and then one final one at the end location.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $pixels  the number of pixels between "mousemove" events
     * 
     * @return  void
     * 
     * @see  setMouseSpeed  Base method, from which has been generated (automatically) current method
     */
    public function setMouseSpeedAndWait($pixels)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Set execution speed (i.e., set the millisecond length of a delay which will follow each selenium operation). 
     * 
     * By default, there is no such delay, i.e., the delay is 0 milliseconds.
     * 
     * @param string   $value  the number of milliseconds to pause after operation
     * 
     * @return  void
     * 
     * @see  setSpeedAndWait  Related Action
     */
    public function setSpeed($value)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Set execution speed (i.e., set the millisecond length of a delay which will follow each selenium operation). 
     * 
     * By default, there is no such delay, i.e., the delay is 0 milliseconds.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $value  the number of milliseconds to pause after operation
     * 
     * @return  void
     * 
     * @see  setSpeed  Base method, from which has been generated (automatically) current method
     */
    public function setSpeedAndWait($value)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Press the shift key and hold it down until doShiftUp() is called or a new page is loaded.
     * 
     * @return  void
     * 
     * @see  shiftKeyDownAndWait  Related Action
     */
    public function shiftKeyDown()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Press the shift key and hold it down until doShiftUp() is called or a new page is loaded.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @return  void
     * 
     * @see  shiftKeyDown  Base method, from which has been generated (automatically) current method
     */
    public function shiftKeyDownAndWait()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Release the shift key.
     * 
     * @return  void
     * 
     * @see  shiftKeyUpAndWait  Related Action
     */
    public function shiftKeyUp()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Release the shift key.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @return  void
     * 
     * @see  shiftKeyUp  Base method, from which has been generated (automatically) current method
     */
    public function shiftKeyUpAndWait()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Kills the running Selenium Server and all browser sessions. 
     * 
     * After you run this command, you will no longer be able to send commands to the server; you can't remotely start
     * the server once it has been stopped. Normally you should prefer to run the "stop" command, which terminates the
     * current browser session, rather than shutting down the entire server.
     * 
     * @return  void
     */
    public function shutDownSeleniumServer()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * This command is a synonym for storeExpression.
     * 
     * @param string   $expression    the value to store
     * @param string   $variableName  the name of a variable in which the result is to be stored. (see
     *                                {@link doc_Stored_Variables})
     * 
     * @return  void
     */
    public function store($expression, $variableName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Submit the specified form. 
     * 
     * This is particularly useful for forms without submit buttons, e.g. single-input "Search" forms.
     * 
     * @param string   $formLocator  an element locator for the form you want to submit (see
     *                               {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  submitAndWait  Related Action
     */
    public function submit($formLocator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Submit the specified form. 
     * 
     * This is particularly useful for forms without submit buttons, e.g. single-input "Search" forms.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $formLocator  an element locator for the form you want to submit (see
     *                               {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  submit  Base method, from which has been generated (automatically) current method
     */
    public function submitAndWait($formLocator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Sets the value of an input field, as though you typed it in. 
     * 
     * <p>Can also be used to set the value of combo boxes, check boxes, etc. In these cases, value should be the value
     * of the option selected, not the visible text.</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * @param string   $value    the value to type
     * 
     * @return  void
     * 
     * @see  typeAndWait  Related Action
     */
    public function type($locator, $value)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Sets the value of an input field, as though you typed it in. 
     * 
     * <p>Can also be used to set the value of combo boxes, check boxes, etc. In these cases, value should be the value
     * of the option selected, not the visible text.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * @param string   $value    the value to type
     * 
     * @return  void
     * 
     * @see  type  Base method, from which has been generated (automatically) current method
     */
    public function typeAndWait($locator, $value)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates keystroke events on the specified element, as though you typed the value key-by-key. 
     * 
     * <p>This is a convenience method for calling keyDown, keyUp, keyPress for every character in the specified
     * string; this is useful for dynamic UI widgets (like auto-completing combo boxes) that require explicit key
     * events.</p>
     * 
     * <p>Unlike the simple "type" command, which forces the specified value into the page directly, this command may
     * or may not have any visible effect, even in cases where typing keys would normally have a visible effect. For
     * example, if you use "typeKeys" on a form element, you may or may not see the results of what you typed in the
     * field.</p>
     * 
     * <p>In some cases, you may need to use the simple "type" command to set the value of the field and then the
     * "typeKeys" command to send the keystroke events corresponding to what you just typed.</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * @param string   $value    the value to type
     * 
     * @return  void
     * 
     * @see  typeKeysAndWait  Related Action
     */
    public function typeKeys($locator, $value)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Simulates keystroke events on the specified element, as though you typed the value key-by-key. 
     * 
     * <p>This is a convenience method for calling keyDown, keyUp, keyPress for every character in the specified
     * string; this is useful for dynamic UI widgets (like auto-completing combo boxes) that require explicit key
     * events.</p>
     * 
     * <p>Unlike the simple "type" command, which forces the specified value into the page directly, this command may
     * or may not have any visible effect, even in cases where typing keys would normally have a visible effect. For
     * example, if you use "typeKeys" on a form element, you may or may not see the results of what you typed in the
     * field.</p>
     * 
     * <p>In some cases, you may need to use the simple "type" command to set the value of the field and then the
     * "typeKeys" command to send the keystroke events corresponding to what you just typed.</p>
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * @param string   $value    the value to type
     * 
     * @return  void
     * 
     * @see  typeKeys  Base method, from which has been generated (automatically) current method
     */
    public function typeKeysAndWait($locator, $value)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Uncheck a toggle-button (checkbox/radio).
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  uncheckAndWait  Related Action
     */
    public function uncheck($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Uncheck a toggle-button (checkbox/radio).
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $locator  an element locator 
     *                           (see {@link doc_Element_Locators})
     * 
     * @return  void
     * 
     * @see  uncheck  Base method, from which has been generated (automatically) current method
     */
    public function uncheckAndWait($locator)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Allows choice of one of the available libraries.
     * 
     * @param string   $libraryName  name of the desired library Only the following three can be chosen:
     *                               
     *                               <ul>
     *                                   <li>"ajaxslt" - Google's library</li>
     *                                   <li>"javascript-xpath" - Cybozu Labs' faster library</li>
     *                                   <li>"default" - The default library. Currently the default library is
     *                               "ajaxslt" .</li>
     *                               </ul>
     *                               
     *                               If libraryName isn't one of these three, then no change will be made.
     * 
     * @return  void
     * 
     * @see  useXpathLibraryAndWait  Related Action
     */
    public function useXpathLibrary($libraryName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Allows choice of one of the available libraries.
     * 
     * <h4>Notes:</h4>
     * 
     * <p>After execution of this action, Selenium wait for a new page to load (see {@link waitForPageToLoad})</p>
     * 
     * @param string   $libraryName  name of the desired library Only the following three can be chosen:
     *                               
     *                               <ul>
     *                                   <li>"ajaxslt" - Google's library</li>
     *                                   <li>"javascript-xpath" - Cybozu Labs' faster library</li>
     *                                   <li>"default" - The default library. Currently the default library is
     *                               "ajaxslt" .</li>
     *                               </ul>
     *                               
     *                               If libraryName isn't one of these three, then no change will be made.
     * 
     * @return  void
     * 
     * @see  useXpathLibrary  Base method, from which has been generated (automatically) current method
     */
    public function useXpathLibraryAndWait($libraryName)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Runs the specified JavaScript snippet repeatedly until it evaluates to "true". 
     * 
     * The snippet may have multiple lines, but only the result of the last line will be considered.
     * 
     * <p>Note that, by default, the snippet will be run in the runner's test window, not in the window of your
     * application. To get the window of your application, you can use the JavaScript snippet
     * [<b>selenium.browserbot.getCurrentWindow()</b>], and then run your JavaScript in there</p>.
     * 
     * @param string   $script   the JavaScript snippet to run
     * @param string   $timeout  a timeout in milliseconds, after which this command will return with an error
     * 
     * @return  void
     */
    public function waitForCondition($script, $timeout)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Waits for a new frame to load. 
     * 
     * <p>Selenium constantly keeps track of new pages and frames loading, and sets a "newPageLoaded" flag when it
     * first notices a page load.</p> See waitForPageToLoad for more information.
     * 
     * @param string   $frameAddress  FrameAddress from the server side
     * @param string   $timeout       a timeout in milliseconds, after which this command will return with an error
     * 
     * @return  void
     */
    public function waitForFrameToLoad($frameAddress, $timeout)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Waits for a new page to load. 
     * 
     * <p>You can use this command instead of the "AndWait" suffixes, "clickAndWait", "selectAndWait", "typeAndWait"
     * etc. (which are only available in the JS API).</p>
     * 
     * <p>Selenium constantly keeps track of new pages loading, and sets a "newPageLoaded" flag when it first notices a
     * page load. Running any other Selenium command after turns the flag to false. Hence, if you want to wait for a
     * page to load, you must wait immediately after a Selenium command that caused a page-load.</p>
     * 
     * @param string   $timeout  a timeout in milliseconds, after which this command will return with an error
     * 
     * @return  void
     */
    public function waitForPageToLoad($timeout)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Waits for a popup window to appear and load up.
     * 
     * @param string   $windowID  the JavaScript window "name" of the window that will appear (not the text of the
     *                            title bar)  If unspecified, or specified as "null", this command will wait for the
     *                            first non-top window to appear  (don't rely on this if you are working with multiple
     *                            popups simultaneously).
     * @param string   $timeout   a timeout in milliseconds, after which the action will return with an error. If this
     *                            value is  not specified, the default Selenium timeout will be used. See the
     *                            setTimeout() command.
     * 
     * @return  void
     */
    public function waitForPopUp($windowID, $timeout)
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Gives focus to the currently selected window.
     * 
     * @return  void
     */
    public function windowFocus()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    /**
     * Resize currently selected window to take up the entire screen.
     * 
     * @return  void
     */
    public function windowMaximize()
    {
        $this->_callParentMethod(__METHOD__, func_get_args());
    }
    
    

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