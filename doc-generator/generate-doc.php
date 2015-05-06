<?php
/**
 * This script parse official documentation html page and generate phpdoc for selenium methods
 *
 * @see https://php.net/manual/en/simplexml.examples-basic.php
 * @see http://www.w3schools.com/XPath/
 */

// HTML documentation (local file can be changed to http://release.seleniumhq.org/selenium-core/1.0.1/reference.html)
define('SELENIUM_DOC_REFERENCE', 'selenium-core-reference-1.0.1.html');

$htmlPage = file_get_contents(SELENIUM_DOC_REFERENCE);

/**
 * Убирает переносы строки и лишние пробелы
 *
 * @param string $sourceText
 * @return string
 */
function getPlainText($sourceText)
{
    return strtr($sourceText, [
        "\r"              => ' ',
        "\n"              => ' ',
        "\t"              => ' ',
        '               ' => ' ',
        '              '  => ' ',
        '             '   => ' ',
        '            '    => ' ',
        '           '     => ' ',
        '          '      => ' ',
        '         '       => ' ',
        '        '        => ' ',
        '       '         => ' ',
        '      '          => ' ',
        '     '           => ' ',
        '    '            => ' ',
        '   '             => ' ',
        '  '              => ' ',
    ]);
}

// --- Selenium Actions
$matches = [];
preg_match('/<h2>Selenium Actions<\/h2>\s*(<dl>[\s\S]+<\/dl>)\s*<a name="accessors"><\/a>/', $htmlPage, $matches);
$htmlActions = $matches[1];


// --- Selenium Actions
$matches = [];
preg_match('/<h2>Selenium Accessors<\/h2>\s*(<dl>[\s\S]+<\/dl>)\s*<h2>/', $htmlPage, $matches);
$htmlAccessors = $matches[1];


// --- Make XML (for easy parsing)
$xmlStr = <<<XML
<?xml version='1.0' standalone='yes'?>
<doc>
    <actions>
        $htmlActions
    </actions>
    <accessors>
        $htmlAccessors
    </accessors>
</doc>
XML;
$xmlStr = str_replace('<br>', '', $xmlStr); // delete incorrect xml tags


// --- Parsing XML
$xmlPage = simplexml_load_string($xmlStr);

// -- actions
$xmlActions = $xmlPage->xpath('//actions/descendant::a[@name]');
foreach ($xmlActions as $xmlAction) {
    /*  // Типичное описание action (вырезаны переносы строк):
        <dt>
            <strong>
                <a name="addLocationStrategy"></a>
                addLocationStrategy(strategyName,functionDefinition )
            </strong>
        </dt>
        <dd>Defines a new function for Selenium to locate elements on the page.
            For example, if you define the strategy "foo", and someone runs click("foo=blah"), we'll run your function,
            passing you the string "blah", and click on the element that your function returns, or throw an
            "Element not found" error if your function returns null.

            We'll pass three arguments to your function:
            <ul>
                <li>locator: the string the user passed in</li>
                <li>inWindow: the currently selected window</li>
                <li>inDocument: the currently selected document</li>
            </ul>
            The function must return null if the element can't be found.

            <p>Arguments:</p>
            <ul>
                <li>strategyName - the name of the strategy to define; this should use only letters [a-zA-Z] with no spaces
                    or other punctuation.
                </li>
                <li>functionDefinition - a string defining the body of a function in JavaScript. For example: <code>return
                    inDocument.getElementById(locator);</code>
                </li>
            </ul>
        </dd>
     */
    $actionName = (string)$xmlAction->attributes()['name'];  // (string)$xmlAction->xpath('parent::*')[0]; // arguments

    // method description
    $xmlActionDescription = $xmlAction->xpath('ancestor::dt/following-sibling::dd[1]')[0];
    $text = getPlainText($xmlActionDescription->asXML());
    preg_match('/<dd>\s*(?P<description>[\s\S]+)\s*(<p>Arguments:<\/p>)?[\s\S]*<\/dd>/', $text, $matches) &&
    array_key_exists('description', $matches)
    OR die('Error at parse method description: ' . $text);
    $actionDescription = $matches['description'];

    // method arguments
    $xmlActionArguments = $xmlActionDescription->xpath("p[text()='Arguments:']/following-sibling::ul/li");
    $actionArguments = [];
    foreach ($xmlActionArguments as $xmlActionArgument) {
        $text = getPlainText($xmlActionArgument->asXML());
        preg_match('/<li>\s*(?P<name>[a-zA-Z0-9]+)\s*-\s*(?P<description>[\s\S]+)\s*<\/li>/', $text, $matches) &&
        array_key_exists('name', $matches) &&
        array_key_exists('description', $matches)
        OR die('Error at parse argument description: ' . $text);

        $actionArguments[$matches['name']] = $matches['description'];
        //var_dump($matches);
    }
    var_export([$actionName, $actionDescription, $actionArguments]);
    echo "\n------------------------------------------\n";
}

//var_export($xmlActions[0]);