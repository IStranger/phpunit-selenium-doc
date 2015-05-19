<?php

use phpdocSeleniumGenerator\models\Argument;
use phpdocSeleniumGenerator\models\Method;
use phpdocSeleniumGenerator\models\ReturnValue;

$methods = [];

// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// ---- Select
$mSelect              = Method::createNew();
$mSelect->name        = 'select';
$mSelect->type        = Method::determineTypeByName($mSelect->name);
$mSelect->subtype     = Method::determineSubtypeByName($mSelect->name);
$mSelect->description = <<<TEXT
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

// first argument
$argument              = Argument::createNew();
$argument->name        = 'selectLocator';
$argument->type        = Argument::DEFAULT_TYPE;
$argument->description = 'an element locator identifying a drop-down menu (see {@link doc_Element_Locators})';
$mSelect->addArgument($argument);

// second argument
$argument              = Argument::createNew();
$argument->name        = 'optionLocator';
$argument->type        = Argument::DEFAULT_TYPE;
$argument->description = 'an option locator (a label by default)';
$mSelect->addArgument($argument);

// return value
$mSelect->returnValue       = ReturnValue::createNew();
$mSelect->returnValue->type = ReturnValue::TYPE_VOID;

// add to common method list (method and its derivative methods)
$methods[] = $mSelect;
$methods[] = $mSelect->createNewMethodWithName('selectAndWait');


/*
// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// ---- storeCssCount           - DEPRECATED!
// ---- http://software-testing-tutorials-automation.blogspot.ru/2013/07/selenium-storecsscount-and.html
$mStoreCssCount              = Method::createNew();
$mStoreCssCount->name        = 'storeCssCount';
$mStoreCssCount->type        = Method::determineTypeByName($mStoreCssCount->name);
$mStoreCssCount->subtype     = Method::determineSubtypeByName($mStoreCssCount->name);
$mStoreCssCount->description = <<<TEXT
Gets number of CSS count for specified elements.
TEXT;

// first argument
$argument              = Argument::createNew();
$argument->name        = 'locator';
$argument->type        = Argument::DEFAULT_TYPE;
$argument->description = 'an element locator identifying a targeted node (see {@link doc_Element_Locators})';
$mStoreCssCount->addArgument($argument);

// second argument
$argument              = Argument::createNew();
$argument->name        = 'variableName';
$argument->type        = Argument::DEFAULT_TYPE;
$argument->description = 'the name of a variable in which the result is to be stored (see {@link doc_Stored_Variables})';
$mStoreCssCount->addArgument($argument);

// return value
$mStoreCssCount->returnValue              = ReturnValue::createNew();
$mStoreCssCount->returnValue->type        = ReturnValue::TYPE_VOID;
$mStoreCssCount->returnValue->description = 'Number of elements found on page (corresponding to the specified locator)';

// add to common method list (method and its derivative methods)
$methods[] = $mStoreCssCount;
$methods[] = $mStoreCssCount->createNewMethodWithName('assertCssCount');
$methods[] = $mStoreCssCount->createNewMethodWithName('assertNotCssCount');
$methods[] = $mStoreCssCount->createNewMethodWithName('getCssCount');
$methods[] = $mStoreCssCount->createNewMethodWithName('verifyCssCount');
$methods[] = $mStoreCssCount->createNewMethodWithName('verifyNotCssCount');
$methods[] = $mStoreCssCount->createNewMethodWithName('waitForCssCount');
$methods[] = $mStoreCssCount->createNewMethodWithName('waitForNotCssCount');
*/


// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// ---- attachFile
$mAttachFile              = Method::createNew();
$mAttachFile->name        = 'attachFile';
$mAttachFile->type        = Method::determineTypeByName($mAttachFile->name);
$mAttachFile->subtype     = Method::determineSubtypeByName($mAttachFile->name);
$mAttachFile->description = 'Sets a file input (upload) field to the file listed in fileLocator.';

// first argument
$argument              = Argument::createNew();
$argument->name        = 'fieldLocator';
$argument->type        = Argument::DEFAULT_TYPE;
$argument->description = 'an element locator (see {@link doc_Element_Locators})';
$mAttachFile->addArgument($argument);

// second argument
$argument              = Argument::createNew();
$argument->name        = 'fileLocator';
$argument->type        = Argument::DEFAULT_TYPE;
$argument->description = <<<TEXT
a URL pointing to the specified file. Before the file can be set in the input field (fieldLocator), 
Selenium RC may need to transfer the file to the local machine before attaching the file in a web page form. 
This is common in selenium grid configurations where the RC server driving the browser is not the same machine 
that started the test. Supported Browsers: Firefox ("*chrome") only.
TEXT;

$mAttachFile->addArgument($argument);

// return value
$mAttachFile->returnValue       = ReturnValue::createNew();
$mAttachFile->returnValue->type = ReturnValue::TYPE_VOID;

// add to common method list (method and its derivative methods)
$methods[] = $mAttachFile;


// .... other methods place here

// index by method name
$methodsByName = [];
foreach ($methods as $method) {
    $methodsByName[$method->name] = $method;
}

return $methodsByName;