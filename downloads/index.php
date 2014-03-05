<?php
/******************************************************************************
 * Copyright (c) 2013, 2014 IBM Corporation and others.
* All rights reserved. This program and the accompanying materials
* are made available under the terms of the Eclipse Public License v1.0
* which accompanies this distribution, and is available at
* http://www.eclipse.org/legal/epl-v10.html
*
* Contributors:
*    IBM Corporation - initial implementation
****************************************************************************/
$defaultProj = "";
unset($_GET["project"]); // gef has no subprojects, so this should be blank
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/nav.class.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/menu.class.php");
$App = new App();
$Nav = new Nav();
$Menu = new Menu();
include($App->getProjectCommon());
ob_start();

/* $project => sections/Project Name => (prettyname => filename) */
$dls = array(
		/*"/newProj" => array(
		 "Project Name" => array( 
		 		"<acronym title=\"Click to download archived All-In-One p2 Repo Update Site\"><img alt=\"Click to download archived All-In-One p2 Repo Update Site\" src=\"/$projectname/images/dl-icon-update-zip.gif\"/> <b style=\"color:green\">All-In-One Update Site</b></acronym>" => "Update",
		 		"SDK (Runtime, Source)" => "SDK",
		 		"Runtime" => "runtime",
		 		"Examples" => "examples",
		 		"Automated Tests" => "automated-tests"
		 )
		),*/
		"$shortprojectname" => array(
				"$projectdisplayname" => array(
						"<acronym title=\"Click to download archived All-In-One p2 Repo Update Site\"><img alt=\"Click to download archived All-In-One p2 Repo Update Site\" src=\"/$projectname/images/dl-icon-update-zip.gif\"/> <b style=\"color:green\">All-In-One Update Site</b></acronym>" => "$projectname-Update",
						"GMF Runtime SDK" => "gmf-sdk-runtime",
						"GMF Runtime" => "gmf-runtime",
						"GMF Runtime Tests" => "gmf-tests-runtime",
						"GMF Runtime Examples" => "gmf-examples-runtime",
				)
		),
);

/* list of valid file prefixes for projects who have been renamed; keys have leading / to match $modelingprojectname */
/* only required if using something other than the default; otherwise will be generated */
$filePre = array( 
		"/$projectname" => array("$topprojectname"),
);

/* define showNotes(), $oldrels, doLanguagePacks() in extras-$projectname.php if necessary, downloads-common.php will include them */
/* end config */
require_once($_SERVER["DOCUMENT_ROOT"] . "/$projectname/downloads/downloads-common.php");

$html = ob_get_contents();
ob_end_clean();

$pageTitle = "$projectdisplayname P2 Repositories and Zip Downloads";
$pageKeywords = "$topprojectname $projectname $shortprojectname";
$pageAuthor = "Anthony Hunter";

# Generate the web page
$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="/' . $projectname . '/style.css"/>' . "\n");
$App->AddExtraHtmlHeader('<script src="/' . $projectname . '/downloads/downloads.js" type="text/javascript"></script>' . "\n"); //ie doesn't understand self closing script tags, and won't even try to render the page if you use one
$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);

?>
