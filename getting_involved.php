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

$pageTitle 		= "GMF Runtime Getting Involved";
$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="/gmf-runtime/style.css"/>');

$html  = <<<EOHTML
<div id="midcolumn">
<h2>$pageTitle</h2>

<p>As every Eclipse project, GMF Runtime is strongly dependent on active support by its community.
You may become part of that community and get involved by reporting bugs or enhancement request,
by contributing patches, by participation in disscussions on the mailing list, or by supporting the
maintaining of the GMF wiki.</p>

<h3>Contributor Mailing List</h3>
<p>Technical or organizational discussions (no help wanted questions) around the GMF project take place
at the <a href="http://dev.eclipse.org/mailman/listinfo/gmf-dev">GMF Developer Mailing List</a>.
It is intended for use by developers actually working on or otherwise contributing to day-to-day
development of the GMF project itself. Older discussions can be found in the
<a href="http://dev.eclipse.org/mhonarc/lists/gmf-dev/maillist.html">Mailing List Archive</a>.</p>

</div>
EOHTML;

# Generate the web page
$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>