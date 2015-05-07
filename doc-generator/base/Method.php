<?php
/**
 * This class contain full description of selenium method (target, arguments list, return value etc.)
 */

namespace phpdocSeleniumGenerator;

class Method extends Base
{
    /**
     * @var string Name of method
     */
    public $name;

    /**
     * @var Argument[] List of method arguments
     */
    public $arguments = [];

    /**
     * @var string Description of method
     */
    public $description;

    /**
     * Load data about method from specified XML nodes.
     *
     *
     * Typical html code that described method:
     * <pre><code>
     *    <dt>
     *        <strong>
     *            <a name="addLocationStrategy"></a>
     *            addLocationStrategy(strategyName,functionDefinition)
     *        </strong>
     *    </dt>
     *
     *    <dd>Defines a new function for Selenium to locate elements on the page.
     *        For example, if you define the strategy "foo", and someone runs click("foo=blah"), we'll run your
     *        function, passing you the string "blah", and click on the element that your function returns, or throw an
     *        "Element not found" error if your function returns null.
     *
     *        We'll pass three arguments to your function:
     *        <ul>
     *            <li>locator: the string the user passed in</li>
     *            <li>inWindow: the currently selected window</li>
     *            <li>inDocument: the currently selected document</li>
     *        </ul>
     *        The function must return null if the element can't be found.
     *
     *        <p>Arguments:</p>
     *        <ul>
     *            <li>strategyName - the name of the strategy to define; this should use only letters [a-zA-Z] with no
     *            spaces or other punctuation.
     *            </li>
     *            <li>functionDefinition - a string defining the body of a function in JavaScript. For example:
     *            < code >return inDocument.getElementById(locator);< / code >
     *            </li>
     *        </ul>
     *    </dd>
     * </code></pre>
     *
     * @param \SimpleXMLElement $dt XML node, which contain determination
     * @param \SimpleXMLElement $dd XML node, which contain description
     *
     * @return $this
     */
    function loadFromXML(\SimpleXMLElement $dt, \SimpleXMLElement $dd)
    {
        // name
        $this->name = (string)$dt->xpath('descendant::a[@name]')[0]->attributes()['name'];

        // description (without arguments)
        $text = Helper::plainText($dd->asXML());
        preg_match('/<dd>\s*(?P<description>[\s\S]+)\s*(<p>Arguments:<\/p>)?[\s\S]*<\/dd>/', $text, $matches) &&
        array_key_exists('description', $matches)
        OR die('Error at parse method description: ' . $text);
        $this->description = $matches['description'];

        // arguments
        $xmlArguments = $dd->xpath("p[text()='Arguments:']/following-sibling::ul/li");
        foreach ($xmlArguments as $xmlArgument) {
            $this->arguments[] = Argument::modelNew()
                ->setMethod($this)
                ->loadFromXML($xmlArgument);
        }
        return $this;
    }
}