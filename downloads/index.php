<?php
/******************************************************************************
 * Copyright (c) 2013 IBM Corporation and others.
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

/* config */

/* zips that are allowed to be absent from the downloads page (eg., new ones added mid-stream) */
$extraZips = array(
		"gmf-examples-pde", "GMF-examples-pde", "gmf-xpand", "gmf-gmf-Update"
);

/* $project => sections/Project Name => (prettyname => filename) */
/* only required if using something other than the default 4; otherwise will be generated */
$dls = array(
		/*"/newProj" => array(
		 "Project Name" => array( # same as value in _projectCommon.php's $projects array
		 		"<acronym title=\"Click to download archived All-In-One p2 Repo Update Site\"><img alt=\"Click to download archived All-In-One p2 Repo Update Site\" src=\"/modeling/images/dl-icon-update-zip.gif\"/> <b style=\"color:green\">All-In-One Update Site</b></acronym>" => "Update",
		 		"SDK (Runtime, Source)" => "SDK",
		 		"Runtime" => "runtime",
		 		"Examples" => "examples",
		 		"Automated Tests" => "automated-tests"
		 )
		),*/
		"/gmf-runtime" => array(
				"GMF Runtime" => array(
						"<acronym title=\"Click to download archived All-In-One p2 Repo Update Site\"><img alt=\"Click to download archived All-In-One p2 Repo Update Site\" src=\"/modeling/images/dl-icon-update-zip.gif\"/> <b style=\"color:green\">All-In-One Update Site</b></acronym>" => "Update",
						"GMF Runtime Master" => "runtime-Master",
						"GMF Runtime SDK" => "sdk-runtime",
						"GMF Runtime" => "runtime",
				)
		),
);

/* list of valid file prefixes for projects who have been renamed; keys have leading / to match $proj */
/* only required if using something other than the default; otherwise will be generated */
$filePre = array( # use "/" because GEF has no parent or child projects/components
		"/gmf-runtime" => array("gmf"),
);

/* define showNotes(), $oldrels, doLanguagePacks() in extras-$proj.php (or just extras.php for flat projects) if necessary, downloads-common.php will include them */
/* end config */
require_once($_SERVER["DOCUMENT_ROOT"] . "/gmf-runtime/downloads/downloads-common.php");

$html = ob_get_contents();
ob_end_clean();

$trans = array_flip($projects);
$pageTitle = "GMF Runtime P2 Repositories and Zip Downloads";
$pageKeywords = "gmf runtime";
$pageAuthor = "Anthony Hunter";

# Generate the web page
$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="/gmf-runtime/style.css"/>' . "\n");
$App->AddExtraHtmlHeader('<script src="/gmf-runtime/downloads/downloads.js" type="text/javascript"></script>' . "\n"); //ie doesn't understand self closing script tags, and won't even try to render the page if you use one
$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);

?>
