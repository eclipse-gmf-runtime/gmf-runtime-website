<?php
/*******************************************************************************
 * Copyright (c) 2009, 2016 Eclipse Foundation and others.
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

$html  = <<<EOHTML
<div id="midcolumn">
<h2>$pageTitle</h2>
<p>All downloads are provided under the terms and conditions of the
<a href="/legal/epl/notice.php">Eclipse Foundation Software User Agreement</a>
unless otherwise specified.</p>

<h3>Installation via Eclipse Update Manager</h3>
<p>Using the Eclipse Update Manager (see <a href="https://help.eclipse.org/latest/index.jsp?topic=/org.eclipse.platform.doc.user/tasks/tasks-129.htm">Eclipse Help</a> for detailed instructions) GMF Runtime can be installed from the following update sites:
<ul>
	<li>Releases: <a href="https://download.eclipse.org/modeling/gmp/gmf-runtime/updates/releases/">https://download.eclipse.org/modeling/gmp/gmf-runtime/updates/releases/</a></li>
	<li>Milestones: <a href="https://download.eclipse.org/modeling/gmp/gmf-runtime/updates/milestones/">https://download.eclipse.org/modeling/gmp/gmf-runtime/updates/milestones/</a></li>
	<li>Integration: <a href="https://download.eclipse.org/modeling/gmp/gmf-runtime/updates/interim/">https://download.eclipse.org/modeling/gmp/gmf-runtime/updates/interim/</a></li>
</ul>

</div>
EOHTML;

# Generate the web page
$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>
