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


// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// ---- captureEntirePageScreenshotToString
$mCaptureEntirePageScreenshotToString              = Method::createNew();
$mCaptureEntirePageScreenshotToString->name        = 'captureEntirePageScreenshotToString';
$mCaptureEntirePageScreenshotToString->type        = Method::determineTypeByName($mCaptureEntirePageScreenshotToString->name);
$mCaptureEntirePageScreenshotToString->subtype     = Method::determineSubtypeByName($mCaptureEntirePageScreenshotToString->name);
$mCaptureEntirePageScreenshotToString->description = <<<TEXT
    Downloads a screenshot of the browser current window canvas to a based 64 encoded PNG file.
    The <b>entire</b> windows canvas is captured, including parts rendered outside of the current view port.
    <p><b>Note:</b> Currently this only works in Mozilla and when running in chrome mode.</p>
TEXT;

// first argument
$argument              = Argument::createNew();
$argument->name        = 'kwargs';
$argument->type        = Argument::DEFAULT_TYPE;
$argument->description = <<<TEXT
    A kwargs string that modifies the way the screenshot is captured. Example: "background=#CCFFDD". This may be useful
    to set for capturing screenshots of less-than-ideal layouts, for example where absolute positioning causes
    the calculation of the canvas dimension to fail and a black background is exposed (possibly obscuring black text).
TEXT;
$mCaptureEntirePageScreenshotToString->addArgument($argument);

// return value
$mCaptureEntirePageScreenshotToString->returnValue              = ReturnValue::createNew();
$mCaptureEntirePageScreenshotToString->returnValue->type        = ReturnValue::TYPE_STRING;
$mCaptureEntirePageScreenshotToString->returnValue->description = 'The base 64 encoded string of the page screenshot (PNG file)';

// add to common method list (method and its derivative methods)
$methods[] = $mCaptureEntirePageScreenshotToString;
$methods[] = $mCaptureEntirePageScreenshotToString->createNewMethodWithName('captureEntirePageScreenshotToStringAndWait');


// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// ---- captureScreenshot
$mCaptureScreenshot              = Method::createNew();
$mCaptureScreenshot->name        = 'captureScreenshot';
$mCaptureScreenshot->type        = Method::determineTypeByName($mCaptureScreenshot->name);
$mCaptureScreenshot->subtype     = Method::determineSubtypeByName($mCaptureScreenshot->name);
$mCaptureScreenshot->description = 'Captures a PNG screenshot to the specified file.';

// first argument
$argument              = Argument::createNew();
$argument->name        = 'filename';
$argument->type        = Argument::DEFAULT_TYPE;
$argument->description = 'the absolute path to the file to be written, e.g. "c:\blah\screenshot.png"';
$mCaptureScreenshot->addArgument($argument);

// return value
$mCaptureScreenshot->returnValue       = ReturnValue::createNew();
$mCaptureScreenshot->returnValue->type = ReturnValue::TYPE_VOID;

// add to common method list (method and its derivative methods)
$methods[] = $mCaptureScreenshot;
$methods[] = $mCaptureScreenshot->createNewMethodWithName('captureScreenshotAndWait');


// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// ---- captureScreenshotToString
$mCaptureScreenshotToString              = Method::createNew();
$mCaptureScreenshotToString->name        = 'captureScreenshotToString';
$mCaptureScreenshotToString->type        = Method::determineTypeByName($mCaptureScreenshotToString->name);
$mCaptureScreenshotToString->subtype     = Method::determineSubtypeByName($mCaptureScreenshotToString->name);
$mCaptureScreenshotToString->description = 'Capture a PNG screenshot. It then returns the file as a base 64 encoded string.';

// return value
$mCaptureScreenshotToString->returnValue              = ReturnValue::createNew();
$mCaptureScreenshotToString->returnValue->type        = ReturnValue::TYPE_STRING;
$mCaptureScreenshotToString->returnValue->description = 'The base 64 encoded string of the screen shot (PNG file)';

// add to common method list (method and its derivative methods)
$methods[] = $mCaptureScreenshotToString;
$methods[] = $mCaptureScreenshotToString->createNewMethodWithName('captureScreenshotToStringAndWait');


// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// ---- keyDownNative
$mKeyDownNative              = Method::createNew();
$mKeyDownNative->name        = 'keyDownNative';
$mKeyDownNative->type        = Method::determineTypeByName($mKeyDownNative->name);
$mKeyDownNative->subtype     = Method::determineSubtypeByName($mKeyDownNative->name);
$mKeyDownNative->description = <<<TEXT
    Simulates a user pressing a key (without releasing it yet) by sending a native operating system keystroke.
    <p>This function uses the java.awt.Robot class to send a keystroke; this more accurately simulates typing a key
    on the keyboard. It does not honor settings from the shiftKeyDown, controlKeyDown, altKeyDown and metaKeyDown commands,
    and does not target any particular HTML element. To send a keystroke to a particular element,
    focus on the element first before running this command.</p>
TEXT;

// first argument
$argument              = Argument::createNew();
$argument->name        = 'keycode';
$argument->type        = Argument::DEFAULT_TYPE;
$argument->description = <<<TEXT
    an integer keycode number corresponding to a java.awt.event.KeyEvent;
    note that Java keycodes are NOT the same thing as JavaScript keycodes!
TEXT;
$mKeyDownNative->addArgument($argument);

// return value
$mKeyDownNative->returnValue       = ReturnValue::createNew();
$mKeyDownNative->returnValue->type = ReturnValue::TYPE_VOID;

// add to common method list (method and its derivative methods)
$methods[] = $mKeyDownNative;
$methods[] = $mKeyDownNative->createNewMethodWithName('keyDownNativeAndWait');


// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// ---- keyPressNative
$mKeyPressNative              = Method::createNew();
$mKeyPressNative->name        = 'keyPressNative';
$mKeyPressNative->type        = Method::determineTypeByName($mKeyPressNative->name);
$mKeyPressNative->subtype     = Method::determineSubtypeByName($mKeyPressNative->name);
$mKeyPressNative->description = <<<TEXT
    Simulates a user pressing and releasing a key by sending a native operating system keystroke.
    <p>This function uses the java.awt.Robot class to send a keystroke; this more accurately simulates typing a key
    on the keyboard. It does not honor settings from the shiftKeyDown, controlKeyDown, altKeyDown and metaKeyDown commands,
    and does not target any particular HTML element. To send a keystroke to a particular element,
    focus on the element first before running this command.</p>
TEXT;


// first argument
$argument              = Argument::createNew();
$argument->name        = 'keycode';
$argument->type        = Argument::DEFAULT_TYPE;
$argument->description = <<<TEXT
    an integer keycode number corresponding to a java.awt.event.KeyEvent;
    note that Java keycodes are NOT the same thing as JavaScript keycodes!
TEXT;
$mKeyPressNative->addArgument($argument);

// return value
$mKeyPressNative->returnValue       = ReturnValue::createNew();
$mKeyPressNative->returnValue->type = ReturnValue::TYPE_VOID;

// add to common method list (method and its derivative methods)
$methods[] = $mKeyPressNative;
$methods[] = $mKeyPressNative->createNewMethodWithName('keyPressNativeAndWait');


// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// ---- keyUpNative
$mKeyUpNative              = Method::createNew();
$mKeyUpNative->name        = 'keyUpNative';
$mKeyUpNative->type        = Method::determineTypeByName($mKeyUpNative->name);
$mKeyUpNative->subtype     = Method::determineSubtypeByName($mKeyUpNative->name);
$mKeyUpNative->description = <<<TEXT
    Simulates a user releasing a key by sending a native operating system keystroke.
    <p>This function uses the java.awt.Robot class to send a keystroke; this more accurately simulates typing a key
    on the keyboard. It does not honor settings from the shiftKeyDown, controlKeyDown, altKeyDown and metaKeyDown commands,
    and does not target any particular HTML element. To send a keystroke to a particular element,
    focus on the element first before running this command.</p>
TEXT;


// first argument
$argument              = Argument::createNew();
$argument->name        = 'keycode';
$argument->type        = Argument::DEFAULT_TYPE;
$argument->description = <<<TEXT
    an integer keycode number corresponding to a java.awt.event.KeyEvent;
    note that Java keycodes are NOT the same thing as JavaScript keycodes!
TEXT;
$mKeyUpNative->addArgument($argument);

// return value
$mKeyUpNative->returnValue       = ReturnValue::createNew();
$mKeyUpNative->returnValue->type = ReturnValue::TYPE_VOID;

// add to common method list (method and its derivative methods)
$methods[] = $mKeyUpNative;
$methods[] = $mKeyUpNative->createNewMethodWithName('keyUpNativeAndWait');


// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// ---- retrieveLastRemoteControlLogs
$mRetrieveLastRemoteControlLogs              = Method::createNew();
$mRetrieveLastRemoteControlLogs->name        = 'retrieveLastRemoteControlLogs';
$mRetrieveLastRemoteControlLogs->type        = Method::determineTypeByName($mRetrieveLastRemoteControlLogs->name);
$mRetrieveLastRemoteControlLogs->subtype     = Method::determineSubtypeByName($mRetrieveLastRemoteControlLogs->name);
$mRetrieveLastRemoteControlLogs->description = <<<TEXT
    Retrieve the last messages logged on a specific remote control. Useful for error reports, especially when running
    multiple remote controls in a distributed environment. The maximum number of log messages that can be retrieve
    is configured on remote control startup.
TEXT;

// return value
$mRetrieveLastRemoteControlLogs->returnValue              = ReturnValue::createNew();
$mRetrieveLastRemoteControlLogs->returnValue->type        = ReturnValue::TYPE_STRING;
$mRetrieveLastRemoteControlLogs->returnValue->description = 'The last N log messages as a multi-line string.';

// add to common method list (method and its derivative methods)
$methods[] = $mRetrieveLastRemoteControlLogs;


// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// ---- setContext
$mSetContext              = Method::createNew();
$mSetContext->name        = 'setContext';
$mSetContext->type        = Method::determineTypeByName($mSetContext->name);
$mSetContext->subtype     = Method::determineSubtypeByName($mSetContext->name);
$mSetContext->description = 'Writes a message to the status bar and adds a note to the browser-side log.';

// first argument
$argument              = Argument::createNew();
$argument->name        = 'context';
$argument->type        = Argument::DEFAULT_TYPE;
$argument->description = 'the message to be sent to the browser';
$mSetContext->addArgument($argument);

// return value
$mSetContext->returnValue       = ReturnValue::createNew();
$mSetContext->returnValue->type = ReturnValue::TYPE_VOID;

// add to common method list (method and its derivative methods)
$methods[] = $mSetContext;


// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// ---- shutDownSeleniumServer
$mShutDownSeleniumServer              = Method::createNew();
$mShutDownSeleniumServer->name        = 'shutDownSeleniumServer';
$mShutDownSeleniumServer->type        = Method::determineTypeByName($mShutDownSeleniumServer->name);
$mShutDownSeleniumServer->subtype     = Method::determineSubtypeByName($mShutDownSeleniumServer->name);
$mShutDownSeleniumServer->description = <<<TEXT
    Kills the running Selenium Server and all browser sessions. After you run this command, you will no longer be able
    to send commands to the server; you can't remotely start the server once it has been stopped.
    Normally you should prefer to run the "stop" command, which terminates the current browser session,
    rather than shutting down the entire server.
TEXT;

// return value
$mShutDownSeleniumServer->returnValue       = ReturnValue::createNew();
$mShutDownSeleniumServer->returnValue->type = ReturnValue::TYPE_VOID;

// add to common method list (method and its derivative methods)
$methods[] = $mShutDownSeleniumServer;


// .... other methods place here. Should be added:
// keyDownNative
// keyPressNative
// keyUpNative
// retrieveLastRemoteControlLogs
// setContext
// shutDownSeleniumServer


// index by method name
$methodsByName = [];
foreach ($methods as $method) {
    $methodsByName[$method->name] = $method;
}

return $methodsByName;