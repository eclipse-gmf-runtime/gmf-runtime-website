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
*		Anthony Hunter - changes for GMF runtime
********************************************************************************/
$Nav->setLinkList(null);

$projectname = "gmf-runtime";
$projectdisplayname = "GMF Runtime";
$modelingprojectname = "modeling";
$topprojectname = "gmp"; 
$shortprojectname = "gmf-runtime";

$debug = (isset ($_GET["debug"]) && preg_match("/^\d+$/", $_GET["debug"]) ? $_GET["debug"] : -1);

include_once($_SERVER["DOCUMENT_ROOT"] . "/gmf-runtime/downloads/scripts.php");

$regs = null;
$buildtypes = array(
		"R" => "Release",
		"S" => "Stable",
		"I" => "Integration",
		"M" => "Maintenance",
		"N" => "Nightly"
);

# Set the theme for your project's web pages.
$theme = "solstice";

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

# Define your project-wide Navigation here
# This appears on the left of the page if you define a left nav
# Format is Link text, link URL (can be http://www.someothersite.com/), target (_self, _blank), level (1, 2 or 3)
# these are optional

# If you want to override the eclipse.org navigation, uncomment below.
# $Nav->setLinkList(array());

# Break the navigation into sections
$Nav->addNavSeparator("GMF Runtime", 	"/gmf-runtime");
$Nav->addCustomNav("Downloads", "/gmf-runtime/downloads.php", "_self", 3);
$Nav->addCustomNav("Releases", "/gmf-runtime/releases.php", "_self");
$Nav->addCustomNav("Documentation", "/gmf-runtime/documentation.php", "_self", 3);
$Nav->addCustomNav("Wiki", "http://wiki.eclipse.org/Graphical_Modeling_Framework", "_self", 3);
$Nav->addCustomNav("Support", "/gmf-runtime/support.php", "_self", 3);
$Nav->addCustomNav("Newsgroup", "http://dev.eclipse.org/newslists/news.eclipse.modeling.gmf/maillist.html", "_self", 3);
$Nav->addCustomNav("Mailing List", "https://dev.eclipse.org/mailman/listinfo/gmf-releng", "_self", 3);
$Nav->addCustomNav("Modeling Corner", "http://wiki.eclipse.org/Modeling_Corner", "_self", 3);

# Define keywords, author and title here, or in each PHP page specifically
$pageKeywords	= "eclipse, gmf, gmf runtime";
$pageAuthor		= "Anthony Hunter";

# top navigation bar
# To override and replace the navigation with your own, uncomment the line below.
$Menu->setMenuItemList(array());
$Menu->addMenuItem("Eclipse", "/", "_self");
$Menu->addMenuItem("GMF Runtime", "/gmf-runtime", "_self");
$Menu->addMenuItem("Downloads", "/gmf-runtime/downloads.php", "_self");
$Menu->addMenuItem("Documentation", "/gmf-runtime/documentation.php", "_self");
$Menu->addMenuItem("About", "http://www.eclipse.org/projects/project_summary.php?projectid=modeling.gmp.gmf-runtime", "_self");
$Menu->addMenuItem("Releases", "/gmf-runtime/releases.php", "_self");

# To enable occasional Eclipse Foundation Promotion banners on your pages (EclipseCon, etc)
$App->Promotion = TRUE;

?>