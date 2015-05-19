<?php

use phpdocSeleniumGenerator\models\Argument;
use phpdocSeleniumGenerator\models\Method;
use phpdocSeleniumGenerator\models\ReturnValue;

$methods = [];

// Select command
$method              = Method::createNew();
$method->name        = 'select';
$method->description = <<<TEXT
Select an option from a drop-down using an option locator.

<p>Option locators provide different ways of specifying options of an HTML Select element
(e.g. for selecting a specific option, or for asserting that the selected option satisfies a specification).
There are several forms of Select Option Locator.</p>

<ul>
    <li><b>label=labelPattern</b> (label=regexp:^[Oo]ther) <br/>
        matches options based on their labels, i.e. the visible text. (This is the default.) </li>
    <li><b>value=valuePattern</b> (value=other) <br/>
        matches options based on their values. </li>
    <li><b>id=id</b> (id=option1) <br/>
        matches options based on their ids. </li>
    <li><b>index=index</b> (index=2) <br/>
        matches an option based on its index (offset from zero). </li>
</ul>

<p>If no option locator prefix is provided, the default behaviour is to match on label.</p>
TEXT;

// Select: first argument
$argument              = Argument::createNew();
$argument->name        = 'selectLocator';
$argument->type        = Argument::DEFAULT_TYPE;
$argument->description = 'an element locator identifying a drop-down menu (see {@link doc_Element_Locators})';
$method->addArgument($argument);

// Select: second argument
$argument              = Argument::createNew();
$argument->name        = 'optionLocator';
$argument->type        = Argument::DEFAULT_TYPE;
$argument->description = 'an option locator (a label by default)';
$method->addArgument($argument);

// Select: return value
$method->returnValue       = ReturnValue::createNew();
$method->returnValue->type = ReturnValue::TYPE_VOID;

// add to common method list
$methods[$method->name] = $method;

// .... other methods

return $methods;