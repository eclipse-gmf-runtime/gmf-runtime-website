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

$pageTitle = "GMF Runtime Downloads";
$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="/gmf-runtime/style.css"/>');

$html  = <<<EOHTML
<div id="midcolumn">
<h2>$pageTitle</h2>
<p>All downloads are provided under the terms and conditions of the
<a href="/legal/epl/notice.php">Eclipse Foundation Software User Agreement</a>
unless otherwise specified.</p>

<h3>Installation via Eclipse Update Manager</h3>
<p>Using the Eclipse Update Manager (see <a href="http://help.eclipse.org/juno/index.jsp?topic=/org.eclipse.platform.doc.user/tasks/tasks-129.htm">Eclipse Help</a> for detailed instructions) GMF Runtime can be installed from the following update sites:
<ul>
	<li>Releases: <a href="http://download.eclipse.org/modeling/gmp/gmf-runtime/updates/releases/">http://download.eclipse.org/modeling/gmp/gmf-runtime/updates/releases/</a></li>
	<li>Milestones: <a href="http://download.eclipse.org/modeling/gmp/gmf-runtime/updates/milestones/">http://download.eclipse.org/modeling/gmp/gmf-runtime/updates/milestones/</a></li>
	<li>Integration: <a href="http://download.eclipse.org/modeling/gmp/gmf-runtime/updates/interim/">http://download.eclipse.org/modeling/gmp/gmf-runtime/updates/interim/</a></li>
	<li>Maintenance: <a href="http://download.eclipse.org/modeling/gmp/gmf-runtime/updates/maintenance/">http://download.eclipse.org/modeling/gmp/gmf-runtime/updates/maintenance/</a></li>
</ul>

<h3>Downloadable P2 Repositories and SDK dropins</h3>
<p>If you prefer an update-site or an SDK archive, you can download it from <a href="downloads/index.php">here directly</a>.</p>

<h3>Nightly Builds</h3>
<p>The nightly builds can also be used as a P2 repository. The nightly builds for the Kepler simultanious release can be accessed from <a href="https://hudson.eclipse.org/hudson/job/gmf-runtime-kepler/">Hudson</a>.</p>

<h3>Translations</h3>
<p>Translations packages can be downloaded from the <a href="http://www.eclipse.org/babel/downloads.php">Babel project downloads page</a>.</p>

</div>
EOHTML;

# Generate the web page
$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>