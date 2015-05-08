<?php
/**
 * This class contain description of single argument of selenium method
 */

namespace phpdocSeleniumGenerator;

class Argument extends Base
{
    private $_method;

    /**
     * @var string Name of argument
     */
    public $name;

    /**
     * @var string Type of arguments (php variable type)
     */
    public $type;

    /**
     * @var string Description of method
     */
    public $description;

    /**
     * @param Method $method Related method for this argument
     */
    function __construct(Method $method = null)
    {
        if ($method) {
            $this->setMethod($method);
        }
    }

    /**
     * @return Method Related method for this argument
     */
    function getMethod()
    {
        return $this->_method;
    }

    /**
     * @param Method $method Set specified as "related method" for this argument
     *
     * @return $this
     */
    function setMethod(Method $method)
    {
        $this->_method = $method;
        return $this;
    }

    /**
     * Load data about argument from specified XML node.
     *
     * Typical html code that described argument of method:
     * <pre><code>
     *      <li>strategyName - the name of the strategy to define; this should use only letters [a-zA-Z] with no
     *      spaces or other punctuation.
     *      </li>
     *
     *      // OR
     *
     *      <li>functionDefinition - a string defining the body of a function in JavaScript. For example:
     *      < code >return inDocument.getElementById(locator);< / code >
     *      </li>
     * </code></pre>
     *
     * @param \SimpleXMLElement $li XML node, which contain list item with detail description of argument
     *
     * @return $this
     */
    function loadFromXML(\SimpleXMLElement $li)
    {
        $text = Helper::plainText($li->asXML());
        preg_match('/<li>\s*(?P<name>[a-zA-Z0-9]+)\s*-\s*(?P<description>[\s\S]+)\s*<\/li>/', $text, $matches) &&
        array_key_exists('name', $matches) &&
        array_key_exists('description', $matches)
        OR die('Error at parse argument description: ' . $text);

        $this->name = $matches['name'];
        $this->description = $matches['description'];
        $this->type = 'string'; // by default we assume string variable type
        // todo need more accurate algorithm type determination (for example, by prefix of argument name ...)

        return $this;
    }
}