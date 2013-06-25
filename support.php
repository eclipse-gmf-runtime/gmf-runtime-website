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

$pageTitle 		= "GMF Runtime Support";
$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="/gmf-runtime/style.css"/>');

$html  = <<<EOHTML
<div id="midcolumn">
<h2>$pageTitle</h2>
<p>GMF Runtime support is provided by the community on a volunteer basis. You may use the following means to reach this community.</p>

<h3>Frequently Asked Questions (FAQs)</h3>
<p>For frequently asked questions and known pitfalls please refer to the <a href="http://wiki.eclipse.org/Graphical_Modeling_Framework_FAQ">GMF FAQ</a>. You might also consider the
<a href="http://wiki.eclipse.org/index.php/GEF_Troubleshooting_Guide">GEF Troubleshooting Guide</a>,the <a href="http://www.eclipse.org/swt/faq.php">SWT FAQs</a> or the <a href="http://wiki.eclipse.org/index.php/Eclipse_FAQs">Eclipse FAQs</a>.
</p>

<h3>Forum & Newsgroup</h3>
<p>Ask questions on the <a href="http://www.eclipse.org/forums/index.php?t=thread&frm_id=16">GMF Community Forum</a>
or the <a href="news://news.eclipse.org/eclipse.tools.gmf" target="_top">GMF newsgroup</a> (same contents).
</p>

<h3>Bugzilla</h3>
<p>Report defects and ask for enhancements by creating a
<a href="https://bugs.eclipse.org/bugs/enter_bug.cgi?product=GMP">new bug entry</a> in the <a href="https://bugs.eclipse.org/bugs/">Eclipse Bugzilla</a>.
</p>
</div>
EOHTML;

# Generate the web page
$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>