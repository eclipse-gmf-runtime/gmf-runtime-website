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
require_once('_projectCommon.php');

$pageTitle = "Eclipse GMF Runtime";
$pageKeywords = "Eclipse, Graphical, Modeling, Framework, GMF, Runtime, Project";
$pageAuthor = "Anthony Hunter";

# Initialize custom solstice $variables.
$variables = array();

# Add classes to <body>. (String)
$variables['body_classes'] = '';

# Insert custom HTML in the breadcrumb region. (String)
$variables['breadcrumbs_html'] = "";

# Hide the breadcrumbs. (Bool)
$variables['hide_breadcrumbs'] = FALSE;

# Insert HTML before the left nav. (String)
$variables['leftnav_html'] = '';

# Update the main container class (String)
$variables['main_container_classes'] = 'container';

# Insert HTML after opening the main content container, before the left sidebar. (String)
$variables['main_container_html'] = '';

# Insert header navigation for project websites.
$links = array();
$links[] = array(
  'icon' => 'fa-download', // Required
  'url' => 'downloads.php', // Required
  'title' => 'Download', // Required
  'text' => 'Update Sites, P2 Repositories, SDK downloads, Nightly Builds, Translations' // Optional
);

$links[] = array(
  'icon' => 'fa-users', // Required
  'url' => 'getting_involved.php', // Required
  'title' => 'Geting Involved', // Required
  'text' => 'Git, Contributor Mailing List, Wiki, Committers' // Optional
);

$links[] = array(
  'icon' => 'fa-book', // Required
  'url' => 'documentation.php', // Required
  'title' => 'Documentation', // Required
  'text' => 'Online Reference, EMF Wiki' // Optional
);

$links[] = array(
  'icon' => 'fa-support', // Required
  'url' => 'support.php', // Required
  'title' => 'Support', // Required
  'text' => 'EMF Query FAQ, Forum, Newsgroup, Bugzilla' // Optional
);

$variables['header_nav'] = array(
  'links' =>  $links, // Required
  'logo' => array( // Required
    'src' => 'images/backgroundMain.png', // Required
    'alt' => 'EMF Query', // Optional
    'url' => 'http://www.eclipse.org/emf-query', // Optional
  ),
);

// CFA Link - Big orange button in header
$variables['btn_cfa'] = array(
  'hide' => FALSE, // Optional - Hide the CFA button.
  'html' => '', // Optional - Replace CFA html and insert custom HTML.
  'class' => 'btn btn-huge btn-warning', // Optional - Replace class on CFA link.
  'href' => '//www.eclipse.org/downloads/', // Optional - Replace href on CFA link.
  'text' => '<i class="fa fa-download"></i> Download' // Optional - Replace text of CFA link.
);

# Set Solstice theme variables. (Array)
$App->setThemeVariables($variables);

// 	# Paste your HTML content between the EOHTML markers!
$html = <<<EOHTML
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

<div class="sideitem">
<h2>Current Status</h2>
<p>Development is underway for the proposed GMF Runtime 1.10.0 release for Eclipse Neon, due June 2016.</p>
</div>

<div class="sideitem">
<h2>GMF Runtime 1.9.0 Now Available</h2>
<p><i>June 24, 2015 -</i> GMF Runtime 1.9.0 for Eclipse Mars has been released. Check the <a href="downloads.php">Downloads</a> page.</p
</div>

</div>
EOHTML;

# Generate the web page
$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);

?>
