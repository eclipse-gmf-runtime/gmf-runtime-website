<?php
/*******************************************************************************
 * Copyright (c) 2009, 2013 Eclipse Foundation and others.
* All rights reserved. This program and the accompanying materials
* are made available under the terms of the Eclipse Public License v1.0
* which accompanies this distribution, and is available at
* http://www.eclipse.org/legal/epl-v10.html
*
* Contributors:
*		Eclipse Foundation - Initial version
*		Anthony Hunter - changes for GMF Runtime
********************************************************************************/
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/nav.class.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/menu.class.php");
$App = new App();
$Nav = new Nav();
$Menu = new Menu();
include($App->getProjectCommon());

$pageTitle 		= "GMF Runtime Documentation";
$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="/gmf-runtime/style.css"/>');

$html  = <<<EOHTML
<div id="midcolumn">
<h2>$pageTitle</h2>
<h3>Reference Documentation</h3>
<p>Reference information can be found on the <a href="http://wiki.eclipse.org/GMF_Documentation">GMF Documentation</a> page in the Eclipse wiki.</p>
</div>
EOHTML;

# Generate the web page
$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>
