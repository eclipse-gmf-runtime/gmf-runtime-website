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

function doLatest($releases, $label = "Releases")
{
	#global $rssfeed, $showMax, $showAll, $sortBy;
	global $showMax, $showAll, $sortBy;
	if (sizeof($releases)>0)
	{
		print "<div class=\"homeitem3col\">\n";
		#print "<a name=\"latest\"></a><h3>${rssfeed}Latest $label</h3>\n";
		print "<a name=\"latest\"></a><h3>Latest $label</h3>\n";
		print "<ul class=\"releases\">\n";
		$c = 0;
		foreach ($releases as $rID => $rbranch)
		{
			$ID = preg_replace("/^(\d{12})([IMNRS])$/", "$2$1", $rID);
			$branch = preg_replace("/.$/", "", $rbranch);
			print outputBuild($branch, $ID, $c++);
			if (!$showAll && $c == $showMax && $c < sizeof($releases))
			{
				print showToggle($showAll, $showMax, $sortBy, sizeof($releases));
				break;
			}
			else if ($showAll && sizeof($releases) > $showMax && $c == sizeof($releases))
			{
				print showToggle($showAll, $showMax, $sortBy, sizeof($releases));
			}
		}
		print "</ul>\n";
		print "</div>\n";
	}
}

function reorderAndSplitArray($arr, $buildTypes)
{
	// the first dimension's order is preserved (kept as it is in the config file)
	// sort the second dimension using the IMNRS order in $buildTypes
	// rsort the third dimension

	$new = array();
	$rels = array();
	foreach ($buildTypes as $br => $types)
	{
		foreach ($types as $bt => $names)
		{
			if ($bt == "R" && isset($arr[$br][$bt]))
			{
				$id = $arr[$br][$bt][0];
				$rels[substr($id,1) . $bt] = $br . $bt;
			}
			else if (array_key_exists($br, $arr) && array_key_exists($bt, $arr[$br]) && is_array($arr[$br][$bt]))
			{
				$new[$br][$bt] = $arr[$br][$bt];
				rsort($new[$br][$bt]);
			}
		}
	}
	return array($new,$rels);
}

function getBuildsFromDirs() // massage the builds into more useful structures
{
	global $PWD, $sortBy;

	$branchDirs = loadDirSimple($PWD, ".*", "d");
	$buildDirs = array();

	foreach ($branchDirs as $branch)
	{
		if ($branch != "OLD")
		{
			$buildDirs[$branch] = loadDirSimple("$PWD/$branch", "[IMNRS]\d{12}", "d");
		}
	}

	$builds_temp = array();
	foreach ($buildDirs as $br => $dirList)
	{
		foreach ($dirList as $dir)
		{
			$ty = substr($dir, 0, 1); //first char

			if ($sortBy != "date")
			{
				$builds_temp[$br][$ty][] = $dir;
			}
			else
			{
				$dttm = substr($dir, 1); // last 12 digits
				$a = $dttm . $ty;
				$b = $br . $ty;

				$builds_temp[$a] = $b;
			}
		}
	}

	return $builds_temp;
}

function getBuildTypes($branches, $buildtypes)
{
	$arr = array();

	foreach ($branches as $branch)
	{
		foreach (array_keys($buildtypes) as $z)
		{
			if (!array_key_exists($branch, $arr))
			{
				$arr[$branch] = array();
			}

			// [2.0][N]
			$arr[$branch][$z] = "$branch {$buildtypes[$z]} Build";
		}
	}

	return $arr;
}

function IDtoDateStamp($ID, $style) // given N200402121441, return date("D, j M Y -- H:i (O)")
{
	$styles = array('Y/m/d H:i', "D, j M Y -- H:i (O)", 'Y/m/d');
	$m = null;
	if (preg_match("/(\d{4})(\d\d)(\d\d)(?:_)?(\d\d)(\d\d)/", $ID, $m))
	{
		$ts = mktime($m[4], $m[5], 0, $m[2], $m[3], $m[1]);
		return date($styles[$style], $ts);
	}

	return "";
}

function createFileLinks($dls, $PWD, $branch, $ID, $pre2, $filePreProj, $ziplabel = "") // the new way - use a ziplabel pregen'd from a dir list!
{
	global $projectname, $suf, $modelingprojectname, $shortprojectname, $filePreStatic;
	$uu = 0;

	if (!$ziplabel)
	{
		$zips_in_folder = loadDirSimple("$PWD/$branch/$ID/", "(\.zip|\.tar\.gz)", "f");
		$ziplabel = preg_replace("/(.+)\-([^\-]+)(\.zip|\.tar\.gz)/", "$2", $zips_in_folder[0]); // grab first entry
	}

	$cnt=-1; // for use with static prefix list

	$echo_out_all = "";

	foreach (array_keys($dls[$shortprojectname]) as $z)
	{
		$echo_out = "";
		foreach ($dls[$shortprojectname][$z] as $label => $u)
		{
			$cnt++;
			if (!is_array($u))
			{
				$u = $u ? array("$u") : array("");
			}

			// support a page with three different valid prefixes which can
			// overlap when searched using dynamic check below
			if ($filePreStatic && is_array($filePreStatic) && array_key_exists($modelingprojectname,$filePreStatic))
			{
				$filePreProj = array($filePreStatic[$modelingprojectname][$cnt]); // just one value to check
			}

			$tries = array();
			foreach ($u as $ux)
			{
				foreach ($filePreProj as $filePre)
				{ 
					$tries[] = "$branch/$ID/$pre2$filePre$ux-$ziplabel.zip"; 
					$tries[] = "$branch/$ID/$filePre$ux-$ziplabel.zip"; 
					$tries[] = "$branch/$ID/$pre2$filePre$ux-incubation-$ziplabel.zip"; 
					$tries[] = "$branch/$ID/$filePre$ux-incubation-$ziplabel.zip"; 
					$tries[] = "$branch/$ID/$ux-$ziplabel.zip"; 
				}
			}
			$outNotFound = "<i><b>$pre2</b>$filePre";
			if (sizeof($u) > 1 ) {
				$outNotFound .= "</i>{"; foreach ($u as $ui => $ux) {
					$outNotFound .= ($ui>0 ? "," : "") . $ux;
				} $outNotFound .= "}<i>";
			}
			else
			{
				$outNotFound .= $u[0];
			}
			$outNotFound .= "-$ziplabel ...</i>";
			$out = "";
			foreach ($tries as $y)
			{
				if (is_file("$PWD/$y"))
				{
					$out = fileFound("$PWD/", $y, $label);
					break;
				}
			}
			if ($out)
			{
				$echo_out .= "<li class=\"separator\">\n";
				$echo_out .= $out;
				$echo_out .= "</li>\n";
			}
			else if (!isset($extraZips) || !is_array($extraZips) || !in_array($filePre . $u[0],$extraZips)) // $extraZips defined in downloads/index.php if necessary
			{
				$echo_out .= "<li>\n";
				$echo_out .= $outNotFound;
				$echo_out .= "</li>\n";
			}
			$uu++;
		}
		if ($echo_out) // if the whole category is empty, don't show it (eg., GEF)
		{
			$echo_out_all .= "<li><img src=\"/$projectname/images/dl.gif\" alt=\"Download\"/> $z\n<ul>\n" . $echo_out . "</ul>\n</li>\n";
		}
	}
	return $echo_out_all;
}

function fileFound($PWD, $url, $label, $md5AlignRight = true, $icon = null)
{
	global $downloadScript, $downloadPre, $projectname, $modelingprojectname, $topprojectname, $shortprojectname;

	$out = "";
	$mid = "$downloadPre/$modelingprojectname/$topprojectname/$shortprojectname/downloads/drops/"; 
	$md5files = array("$url.md5", preg_replace("#/([^/]+$)#", "/checksum/$1", $url) . ".md5");
	foreach ($md5files as $md5file)
	{
		if (is_file($PWD.$md5file))
		{
			$out .= "<span style=\"float:right;\">&nbsp;&nbsp;" . pretty_size(filesize("$PWD$url")) . " (<a href=\"" . "http://download.eclipse.org" .
			"$mid$md5file\">md5</a>)</span>"; break;
		}
	}
	#return $md5AlignRight ? $out . "<a href=\"$downloadScript$mid$url\">$label</a>" :
	#	"<a href=\"$downloadScript$mid$url\">$icon</a>&nbsp;<a href=\"$downloadScript$mid$url\">$label</a>" . $out;
	return "<span style=\"float:left;clear:left;\"><a href=\"$downloadScript$mid$url\">$icon</a>&nbsp;<a href=\"$downloadScript$mid$url\">$label</a></span>" . $out;
}

function doNLSLinksList($packs, $cols, $subcols, $packSuf, $folder, $isArchive = false)
{
	global $downloadScript, $downloadPre, $projectname, $modelingprojectname, $shortprojectname;

	foreach ($packs as $name => $packPre)
	{
		foreach ($cols as $alt => $packMid)
		{
			print "<li><img src=\"/$projectname/images/dl.gif\" alt=\"$alt\"/> $alt: ";
			$ret = array();
			if (sizeof($subcols) > 2)
			{
				print "<ul>\n";
				$cnt = 0;
				foreach ($subcols as $alt2 => $packMid2)
				{
					if ($cnt > 0 && $cnt % 2 == 0)
					{
						print "<li>" . join(", ", $ret) . "</li>\n";
						$ret = array();
					}
					$ret[] = "<a href=\"" . ($isArchive ? "http://archive.eclipse.org" : $downloadScript) .
					"$downloadPre/$projectname/$modelingprojectname/downloads/drops/$folder$packPre$packMid-$packMid2$packSuf\">$alt2</a>";
					$cnt++;
				}
				if (sizeof($ret) > 0)
				{
					print "<li>" . join(", ", $ret) . "</li>\n";
				}
				print "</ul>\n";
			}
			else
			{
				foreach ($subcols as $alt2 => $packMid2)
				{
					$ret[] = "<a href=\"" . ($isArchive ? "http://archive.eclipse.org" : $downloadScript) .
					"$downloadPre/$projectname/$modelingprojectname/downloads/drops/$folder$packPre$packMid-$packMid2$packSuf\">$alt2</a>";
				}
				print join(", ", $ret);
			}
			print "</li>\n";
		}
	}
}

function grep($pattern, $file, $file_cache = null)
{
	$filec = $file_cache ? $file_cache : loadFile($file);

	foreach ($filec as $z)
	{
		if (preg_match($pattern, $z))
		{
			$filec = array();
			return true;
		}
	}

	$filec = array();
	return false;
}

function loadFile($file)
{
	$maxfilesize = 64*1024; // 64K file limit
	$filec = array();
	if (is_file($file) && is_readable($file))
	{
		if (filesize($file) < ($maxfilesize))
		{
			$filec = file($file);
		}
		else
		{
			exec("tail -n50 $file", $filec); // just grab the last n lines
		}
	}

	return $filec;
}

function outputBuild($branch, $ID, $c)
{
	global $PWD, $dls, $filePre, $modelingprojectname, $sortBy, $shortprojectname, $jdk14testsPWD, $jdk50testsPWD, $jdk60testsPWD, $testsPWD, $deps, $projectname, $hiddenBuilds;

	# suppress hidden builds for public server
	foreach ($hiddenBuilds as $hb) {
		if (trim($hb) == "$projectname/$branch/$ID")
		{
			debug("Build $projectname/$branch/$ID is hidden, pending mirror replication.", 1);
			return "";
		}
	}
	$pre2 = (is_dir("$PWD/$branch/$ID/eclipse/$ID/") ? "eclipse/$branch/$ID/" : "");

	$zips_in_folder = loadDirSimple("$PWD/$branch/$ID/", "(\.zip|\.tar\.gz)", "f");
	$ziplabel = (sizeof($zips_in_folder) < 1) ? $ID :
	preg_replace("/(.+)\-([^\-]+)(\.zip|\.tar\.gz)/", "$2", $zips_in_folder[0]); // grab first entry

	// generalize for any relabelled build, thus 2.0.1/M200405061234/*-2.0.2.zip is possible; label = 2.0.2
	$IDlabel = $ziplabel;

	$ret = "<li>\n";
	$ret .= "<a href=\"javascript:toggle('r$ID')\">" .
	"<i>" . ($sortBy == "date" && $IDlabel != $branch ? "$branch / " : "") . "$IDlabel</i> " .
	"(" . IDtoDateStamp($ID, 2) . ")" .
	"</a>" .
	"<a name=\"$ID\"></a> " .
	"<a href=\"?showAll=1&amp;hlbuild=$ID" .
	($sortBy == "date" ? "&amp;sortBy=date" : "") .
	"&amp;project=$shortprojectname#$ID\">" .
	"<img alt=\"Link to this build\" src=\"/$projectname/images/link.png\"/>" .
	"</a>" .
	((isset($opts["noclean"]) && $opts["noclean"]) || is_dir("$PWD/$branch/$ID/eclipse/$ID") ? doNoclean("$PWD/$branch/$ID") : "");

	$ret .= "<ul id=\"r$ID\"" . (($c == 0 && !isset($_GET["hlbuild"])) || isset($_GET["hlbuild"]) && $ID == $_GET["hlbuild"] ? "" : " style=\"display: none\"") . ">\n";

	if (!isset($filePre[$modelingprojectname]) && isset($filePre["/"]))
	{
		$filePre[$modelingprojectname] = $filePre["/"];
	}
	if (!isset($filePre[$modelingprojectname]))
	{
		$topProj = preg_replace("#.+/(.+)#","$1", $projectname);
		$filePre[$modelingprojectname] = array($shortprojectname);
	}
	
	$ret .= createFileLinks($dls, $PWD, $branch, $ID, $pre2, $filePre[$modelingprojectname], $ziplabel);

	$ret .= "</ul>\n";
	$ret .= "</li>\n";

	return $ret;
}

function showToggle($showAll, $showMax, $sortBy, $count)
{
	global $shortprojectname;
	$ret = "<li><a href=\"" . $_SERVER["PHP_SELF"] . "?project=".$shortprojectname."&amp;showAll=" . ($showAll == "1" ? "" : "1") . "&amp;showMax=$showMax&amp;sortBy=$sortBy\">" . ($showAll != "1" ? "show all $count" : "show only $showMax") . "...</a></li>\n";
	return $ret;
}

function showArchived($oldrels)
{
	global $projectname, $modelingprojectname, $projectdisplayname;

	$thresh = sizeof($oldrels) > 5 ? ceil(sizeof($oldrels)/3) : 6;
	print "<h3><a name=\"archives\"></a>Archived Releases</h3>\n";
	print "<p>Older $projectdisplayname releases have been moved to archive.eclipse.org, and can be accessed here:</p>";
	print '<table cellspacing="0" cellpadding="0" border="0" style="margin:0"><tr valign="top">'."\n";
	print "<td><ul id=\"archives\">\n";
	$cnt=-1;
	foreach (array_keys($oldrels) as $z)
	{
		$cnt++;
		if ($cnt % $thresh == 0)
		{
			print "</ul></td><td><ul id=\"archives\">\n";
		}
		if (!$z || $oldrels[$z] === null)
		{
			$cnt--; # spacer
		}
		else if (!is_array($oldrels[$z]))
		{
			print "<li style=''><a href=\"http://archive.eclipse.org/$projectname/$modelingprojectname/downloads/drops/$z/R$oldrels[$z]/\">$z</a> (" . IDtoDateStamp($oldrels[$z], 2) . ")</li>\n";
		}
		else 
		{
			print "<li><a href=\"" . $oldrels[$z][1] . "\">$z</a> (" . $oldrels[$z][0] . ")</li>\n";
		}
	}
	print "</ul>\n";
	print "</td>";
	print "</tr></table>\n";
	#print "</div>\n";
}
?>
