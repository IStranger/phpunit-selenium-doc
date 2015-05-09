<?php
/**
 * This class contain description of single argument of selenium method
 */

namespace phpdocSeleniumGenerator\models;

use phpdocSeleniumGenerator\Helper;


class Argument extends MethodComponent
{
    /**
     * @var string Name of argument
     */
    public $name;

    /**
     * @var string Type of argument (php variable type)
     */
    public $type;

    /**
     * @var string Description of argument
     */
    public $description;

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