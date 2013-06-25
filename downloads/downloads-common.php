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

$deps = array(
	"eclipse" => "<a href=\"http://www.eclipse.org/eclipse/\">Eclipse</a>",
);

require_once($_SERVER["DOCUMENT_ROOT"] . "/gmf-runtime/downloads/downloads-scripts.php");

if (is_array($projects))
{
	$projectArray = getProjectArray($projects, $extraprojects, $nodownloads, $PR);
	$proj = "/" . (isset($_GET["project"]) && preg_match("/^(?:" . join("|", $projects) . ")$/", $_GET["project"]) ? $_GET["project"] :	""); # default
}
else
{
	$proj = "";
}

$proj = $PR;
$projct = $PR;
if (strstr($PR, "/") !== false)
{
	list($topProj, $parentProj) = explode("/", $PR); # modeling, emf
}
else
{
	list($topProj, $parentProj) = array("NONE", $PR); # NONE, gef
}

if (isset($projct) && isset($hasmoved) && is_array($hasmoved) && array_key_exists($projct,$hasmoved))
{
	header("Location: http://www.eclipse.org/modeling/" . $hasmoved[$projct] . "/downloads/?" . $_SERVER["QUERY_STRING"]);
	exit;
}

$numzips = isset($extraZips) ? 0 - sizeof($extraZips) : 0; // if extra zips (new zips added later), reduce the "required" count when testing a build
if (isset($dls[$proj]) && is_array($dls[$proj]))
{
	foreach (array_keys($dls[$proj]) as $z)
	{
		$numzips += sizeof($dls[$proj][$z]);
	}
}

# store an array of paths to hide
$hiddenBuilds = is_readable($_SERVER["DOCUMENT_ROOT"] . "/$PR/downloads/hidden.txt") ? file($_SERVER["DOCUMENT_ROOT"] . "/$PR/downloads/hidden.txt") : array();

// include extras-$proj.php or extras-$PR.php
$files = array ($_SERVER["DOCUMENT_ROOT"] . "/$PR/downloads/extras-" . $projct . ".php", $_SERVER["DOCUMENT_ROOT"] . "/$PR/downloads/extras-" . $PR . ".php");
foreach ($files as $file)
{
	if (file_exists($file))
	{
		include_once($file);
		break;
	}
}

$hadLoadDirSimpleError = 1; //have we echoed the loadDirSimple() error msg yet? if 1, omit error; if 0, echo at most 1 error
$sortBy = (isset($_GET["sortBy"]) && preg_match("/^(date)$/", $_GET["sortBy"], $regs) ? $regs[1] : "");
$showAll = (isset($_GET["showAll"]) && preg_match("/^(1)$/", $_GET["showAll"], $regs) ? $regs[1] : "0");
$showMax = (isset($_GET["showMax"]) && preg_match("/^(\d+)$/", $_GET["showMax"], $regs) ? $regs[1] : ($sortBy == "date" ? "10" : "5"));
$showBuildResults = !isset($_GET["light"]) && !isset($_GET["nostatus"]); // suppress display of status to render page faster

$PWD = "/home/data2/httpd/download.eclipse.org/$topLevel/$PR/downloads/drops";

$downloadScript = getdownloadScript();
$downloadPre = "";

print "<div id=\"midcolumn\">\n";
print "<h2>GMF Runtime P2 Repositories & SDK Dropins</h2>\n";
print "<p>This page provides a bundled P2 repository and different SDK dropins (in runnable form) for each build.</p>";

$branches = loadDirSimple($PWD, ".*", "d");
rsort($branches);
$buildTypes = getBuildTypes($branches, $buildtypes);

$builds = getBuildsFromDirs();
$releases = array();
if ($sortBy != "date")
{

	$builds = reorderAndSplitArray($builds, $buildTypes);
	$releases = $builds[1];
	$builds = $builds[0];
}
else
{
	krsort($builds); reset($builds);
}

print "<div id=\"midcolumn\">\n";
if (sizeof($builds) == 0 && sizeof($releases) == 0)
{
	print "<h2>Builds</h2>\n";
	print "<ul>\n";
	if (is_array($projectArray) && !in_array($projct, $projectArray))
	{
		print "<li><i><b>Sorry!</b></i> There are no builds yet available for this component.</li>";
	}
	else
	{
		print "<li><i><b>Error!</b></i> No builds found on this server!</li>";
	}
	print "</ul>\n";
}

if ($sortBy != "date")
{
	doLatest($releases, "Releases");

	$c = 0;
	foreach ($builds as $branch => $types)
	{
		foreach ($types as $type => $IDs)
		{
			print "<h3>" . $buildTypes[$branch][$type] . "s</h3>\n";
			print "<ul>\n";
			$i = 0;
			foreach ($IDs as $ID)
			{
				print outputBuild($branch, $ID, $c++);
				$i++;

				if (!$showAll && $i == $showMax && $i < sizeof($IDs))
				{
					print showToggle($showAll, $showMax, $sortBy, sizeof($IDs));
					break;
				}
				else if ($showAll && sizeof($IDs) > $showMax && $i == sizeof($IDs))
				{
					print showToggle($showAll, $showMax, $sortBy, sizeof($IDs));
				}
			}
			print "</ul>\n";
		}
	}
}
else if ($sortBy == "date")
{
	doLatest($builds, "Builds");
}

if (isset($oldrels) && is_array($oldrels) && sizeof($oldrels) > 0)
{
	showArchived($oldrels);
	showNotes();
}
print "</div>\n";
?>
