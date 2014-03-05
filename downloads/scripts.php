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

function loadDirSimple($dir, $ext, $type) // 1D array, not 2D
{
	$stuff = array();

	if(is_dir($dir) && is_readable($dir))
	{
		$handle = opendir($dir);
		while(($file = readdir($handle)) !== false)
		{
			if(preg_match("/$ext$/", $file) && !preg_match("/^\.{1,2}$/", $file))
			{
				if(($type == "d" && is_dir("$dir/$file")) ||($type == "f" && is_file("$dir/$file")))
				{
					$stuff[] = $file;
				}
			}
		}
		closedir($handle);
	}
	else
	{
		global $hadLoadDirSimpleError;
		if(!$hadLoadDirSimpleError)
		{
			$issue =(!is_dir($dir) ? "NOT FOUND" :(!is_readable($dir) ? "NOT READABLE" : "PROBLEM"));
			print "<p>Directory ($dir) <b>$issue</b> on mirror: <b>" . $_SERVER["HTTP_HOST"] . "</b>!</p>";
			print "<p>Please report this error to <a href=\"mailto:webmaster@eclipse.org?Subject=Directory ($dir) $issue in scripts.php::loadDirSimple() on mirror " . $_SERVER["HTTP_HOST"] . "\">webmaster@eclipse.org</a>, or make directory readable.</p>";
			$hadLoadDirSimpleError = 1;
		}
	}

	return $stuff;
}

/* TODO: remove this when we upgrade php to >= 4.3.0 everywhere */
if(!function_exists("file_get_contents"))
{
	function file_get_contents($file)
	{
		return(is_file($file) ? join("", file($file)) : "");
	}
}

function debug($str, $level = 0)
{
	global $debug;

	if($debug > $level)
	{
		print "<div class=\"debug\">$str</div>\n";
	}
}

function debug_r($str, $header = "", $footer = "", $level = 0, $isPreformatted = false)
{
	global $debug;

	if($debug > $level)
	{
		if($header)
		{
			print "<div class=\"debug\">";
			print $header;
			print "</div>\n";
		}
		print "<div class=\"debug\">";
		print $isPreformatted ? "<pre><small>" : "";
		print_r($str);
		print $isPreformatted ? "</small></pre>" : "";
		print "</div>\n";
		if($footer)
		{
			print "<div class=\"debug\">";
			print $footer;
			print "</div>\n";
		}
	}
}

function domainSuffix($domain)
{
	return preg_replace("/.*([^\.]+\.[^\.]+)$/", "$1", $domain);
}

/* convert a wiki category page into a series of <li> items */
function wikiCategoryToListItems($category)
{
	$wiki_contents = "";

	// insert wiki content
	$host = "wiki.eclipse.org";
	$url = "/Category:" . $category;

	$header = "Host: $host\r\n";
	$header .= "User-Agent: PHP Script\r\n";
	$header .= "Connection: close\r\n\r\n";

	$fp = fsockopen($host, 80, $errno, $errstr, 30);
	if(!$fp)
	{
		$out .= "<li><i>$errstr ($errno)</i></li>\n";
	}
	else
	{
		fputs($fp, "GET $url HTTP/1.1\r\n");
		fputs($fp, $header);
		while(!feof($fp))
		{
			$wiki_contents .= fgets($fp, 128);
		}
		fclose($fp);
	}

	$out = "";
	if($wiki_contents)
	{
		$m = null;
		if(preg_match("#<div id=\"mw-pages\">(.+)</div>[ \t\n]*<div class=\"printfooter\">#s", $wiki_contents, $m))
		{
			$links = null;
			if(preg_match_all("#<a href=\"([^\"]+)\" title=\"([^\"]+)\">([^<]+)</a>#", $m[1], $links, PREG_SET_ORDER))
			{
				foreach($links as $z)
				{
					$out .= "<li><a href=\"http://wiki.eclipse.org/$z[1]\" title=\"$z[2]\">$z[3]</a></li>\n";
				}
			}
		}
	}
	return $out;
}

function getProjectFromPath($projectname)
{
	$m = null;
	return preg_match("#/" . $projectname . "/([^/]+)/build/.+#", $_SERVER["PHP_SELF"], $m) ? $m[1] :(preg_match("#/(" .
			$projectname . ")/build/.+#", $_SERVER["PHP_SELF"], $m) ? $m[1] : "");
}

function cvsminus($rev)
{
	if(preg_match("/^1\.1$/", $rev)) // "1.10" == "1.1" returns true, curiously enough
	{
		return $rev;
	}
	else
	{
		if(preg_match("/\.1$/", $rev))
		{
			return preg_replace("/^(\d+\.\d+)\..+$/", "$1", $rev);
		}
		else
		{
			return preg_replace("/^(.+\.)(\d+)$/e", "\"$1\" . ($2 - 1);", $rev);
		}
	}
}

function getDownloadScript()
{
	global $projectname;
	if(strstr($projectname, "/") !== false)
	{
		list($topProj, $parentProj) = explode("/", $projectname); 
	}
	else
	{
		list($topProj, $parentProj) = array("NONE", $projectname); 
	}

	# if this is a Modeling page, use /modeling/download.php;
	# if this is a GEF page, use /gef/download.php
	# if /foo/download.php doesn't exist, revert to /downloads/download.php
	$dlScriptFile = $_SERVER["DOCUMENT_ROOT"] . "/" .($topProj == "NONE" ? $parentProj : $topProj) . "/download.php";
	#print "[$dlScriptFile =? " . is_file($dlScriptFile) . "]<br>";
	if(is_file($dlScriptFile))
	{
		$downloadScript = "http://www.eclipse.org/" .($topProj == "NONE" ? $parentProj : $topProj) . "/download.php?file=";
	}
	else
	{
		$downloadScript = "http://www.eclipse.org/downloads/download.php?file=";
	}
	return $downloadScript;
}

/* thanks to http://www.php.net/manual/en/function.filesize.php#80995 */
function dirsize($path)
{
	$dirsize = exec("du -s $path");
	if($dirsize)
	{
		$dirsize = explode(" ", $dirsize);
		return($dirsize[0] - 0) * 1024;
	}
	if(!is_dir($path))
	{
		return filesize($path);
	}
	$size = 0;
	foreach(scandir($path) as $file)
	{
		if($file != '.' && $file != '..')
		{
			$size += dirsize($path . '/' . $file);
		}
	}
	return $size;
}

function pretty_size($bytes)
{
	$sufs = array("B", "K", "M", "G", "T", "P"); //we shouldn't be larger than 999.9 petabytes any time soon, hopefully
	$suf = 0;

	while($bytes >= 1000)
	{
		$bytes /= 1024;
		$suf++;
	}

	return sprintf("%3.1f%s", $bytes, $sufs[$suf]);
}

?>
