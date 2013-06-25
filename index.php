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

$localVersion = false;

$pageTitle 		= "Eclipse GMF Runtime";

// 	# Paste your HTML content between the EOHTML markers!
$html = <<<EOHTML
<div id="bigbuttons">
<h3>Primary Links</h3>
<ul>
<li><a id="buttonDownload" href="downloads.php" title="Download">
	Downloads, Software Install Site</a></li>
<li><a id="buttonDocumentation" href="documentation.php" title="Documentation">
	Tutorials, Examples, Reference Documentation</a></li>
<li><a id="buttonSupport" href="support.php" title="Support">
	Bug Tracker, Newsgroup</a></li>
<li><a id="buttonInvolved" href="getting_involved.php" title="Getting Involved">
	git, Workspace Setup, Wiki, Committers</a></li>
</ul>
</div>

<div id="midcolumn">
<h3>Eclipse Graphical Modeling Framework (GMF) Runtime</h3>

<div id="introText">

<p>The GMF Runtime is an industry proven application framework for creating graphical editors using EMF and GEF.</p>
<p>The GMF Runtime provides many features that one would have to code by hand if using EMF and GMF directly.</p>
<ul><li>A set of reusable components for graphical editors, such as printing, image export, actions and toolbars and much more.</li>
<li>A standardized model to describe diagram elements, which separates between the semantic (domain) and notation (diagram) elements.</li>
<li>A command infrastructure that bridges the different command frameworks used by EMF and GEF.</li>
<li>An extensible framework that allows graphical editors to be open and extendible.</li></ul>

</div>

</div>

<div id="rightcolumn">

<div>
<h3>Current Status</h3>
<p>Development is underway for the GMF Runtime 1.7.0 for Eclipse Kepler, due June 2013.</p>
</div>

<div id="headlines">
<h3>GMF Runtime 1.6.0 Now Available</h3>
<p><i>June 23, 2012 -</i> GMF Runtime 1.6.0 for Eclipse Juno. Check the <a href="http://www.eclipse.org/modeling/gmp/downloads/?project=gmf-runtime">Download</a> site to download.</p>
</div>

</div>
EOHTML;

# Generate the web page
$App->generatePage($theme, $Menu, null, $pageAuthor, $pageKeywords, $pageTitle, $html);

?>
