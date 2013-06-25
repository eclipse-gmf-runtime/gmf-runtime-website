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

$pageTitle 		= "Eclipse Graphical Modeling Framework (GMF) Project Releases";
$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="/gmf-runtime/style.css"/>');

$html  = <<<EOHTML
<div id="midcolumn">
<h2>$pageTitle</h2>
<style type="text/css">
   h1 { font-family : Arial, Helvetica, sans-serif; font-size : 14pt; font-weight : bold; font-style : normal; }
   p { font-family : Arial, Helvetica, sans-serif; font-size : 10pt; font-style : normal; }
   table { text-align:left; padding: 3px; border: 1px solid black; }
   tr.white { background-color: white; border: 1px solid black; }
   tr.top { background-color: #CCFFFF; border: 1px solid black; }
   tr.callisto { background-color: #FFCCFF; border: 1px solid black; }
   tr.europa { background-color: #FFFFCC; border: 1px solid black; }
   tr.ganymede { background-color: #CCFFCC; border: 1px solid black; }
   tr.galileo { background-color: #FFCCCC; border: 1px solid black; }
   tr.helios { background-color: #CCFFFF; border: 1px solid black; }
   tr.indigo { background-color: #CCCCFF; border: 1px solid black; }
   tr.juno { background-color: #FFCCFF; border: 1px solid black; }
   tr.kepler { background-color: #FFFFCC; border: 1px solid black; }
   tr.luna { background-color: #AACCEE; border: 1px solid black; }
   td { font-family : Arial, Helvetica, sans-serif; padding: 3px; font-size : 8pt; text-align: left; vertical-align: top; border: 1px solid black;}
</style>

<p>The following table lists the releases completed over the years, with their version numbers. The table includes the four Graphical Modeling Projects; 
GMF Runtime, GMF Notation, GMF Tooling and Graphiti, as well as their dependencies.</p>
<table border="1">
<tr class="top">
<td>Eclipse<br>Simultanious<br>Release</td>
<td>Release<br>Date</td>
<td><b>GMF<br>Runtime<br></b>[1]</td>
<td><b>GMF<br>Notation<br></b>[1]</td>
<td>Eclipse<br>Platform</td>
<td>GEF</td>
<td>EMF<br>Core</td>
<td>EMF<br>Query</td>
<td>EMF<br>Validation</td>
<td>EMF<br>Transaction</td>
<td>MDT<br>OCL</td>
<td>MDT<br>UML2</td>
<td><b>GMF<br>Tooling<br>(GMF SDK)</b></td>
<td>QVT<br>OML</td>
<td><b>Graphiti</b></td>
</tr>

<tr class="callisto">
<td rowspan="4">Callisto</td>
<td>06/26/06</td>
<td>1.0.0</td>
<td rowspan="4">[2]</td>
<td>3.2.0</td>
<td>3.2.0</td>
<td>2.2.0</td>
<td>1.0.0</td>
<td>1.0.0</td>
<td>1.0.0</td>
<td>1.0.0</td>
<td rowspan="4">[3]</td>
<td>1.0.0</td>
<td rowspan="4">[4]</td>
<td rowspan="4">[5]</td>
</tr>

<tr class="callisto">
<td>09/27/06</td>
<td>1.0.1</td>
<td rowspan="2">3.2.1</td>
<td rowspan="2">3.2.1</td>
<td rowspan="2">2.2.1</td>
<td>1.0.1</td>
<td>1.0.1</td>
<td>1.0.1</td>
<td>1.0.1</td>
<td>1.0.1</td>
</tr>

<tr class="callisto">
<td>10/27/06</td>
<td>1.0.2</td>
<td rowspan="2">1.0.2</td>
<td rowspan="2">1.0.2</td>
<td>1.0.2</td>
<td rowspan="2">1.0.2</td>
<td>1.0.2</td>
</tr>

<tr class="callisto">
<td>02/10/07</td>
<td>1.0.3</td>
<td>3.2.2</td>
<td>3.2.2</td>
<td>2.2.2</td>
<td>1.0.3</td>
<td>1.0.3</td>
</tr>

<tr class="europa">
<td rowspan="3">Europa</td>
<td>06/27/07</td>
<td>1.0.100</td>
<td rowspan="3">[2]</td>
<td>3.3.0</td>
<td>3.3.0</td>
<td>2.3.0</td>
<td>1.1.0</td>
<td>1.1.0</td>
<td>1.1.0</td>
<td>1.1.0</td>
<td>2.1.0</td>
<td>2.0.0</td>
<td rowspan="3">[4]</td>
<td rowspan="3">[5]</td>
</tr>

<tr class="europa">
<td>09/28/07</td>
<td>1.0.101</td>
<td>3.3.1</td>
<td>3.3.1</td>
<td>2.3.1</td>
<td rowspan="2">1.1.1</td>
<td rowspan="2">1.1.1</td>
<td>1.1.1</td>
<td>1.1.1</td>
<td rowspan="2">2.1.1</td>
<td>2.0.1</td>
</tr>

<tr class="europa">
<td>02/29/08</td>
<td>1.0.102</td>
<td>3.3.2</td>
<td>3.3.0</td>
<td>2.3.0</td>
<td>1.1.2</td>
<td>1.1.2</td>
<td>2.0.2</td>
</tr>

<tr class="ganymede">
<td rowspan="5">Ganymede</td>
<td>06/25/08</td>
<td>1.1.0</td>
<td>1.1.0</td>
<td rowspan="2">3.4.0</td>
<td rowspan="2">3.4.0</td>
<td rowspan="2">2.4.0</td>
<td rowspan="5">1.2.0</td>
<td>1.2.0</td>
<td>1.2.0</td>
<td>1.2.0</td>
<td rowspan="2">2.2.0</td>
<td>2.1.0</td>
<td rowspan="5">[4]</td>
<td rowspan="5">[5]</td>
</tr>

<tr class="ganymede">
<td>08/15/08</td>
<td>1.1.1</td>
<td>1.1.1</td>
<td rowspan="4">1.2.1</td>
<td>1.2.1</td>
<td>1.2.1</td>
<td>2.1.1</td>
</tr>

<tr class="ganymede">
<td>09/24/09</td>
<td>1.1.2</td>
<td rowspan="3">1.1.2</td>
<td>3.4.1</td>
<td>3.4.1</td>
<td>2.4.2</td>
<td>1.2.2</td>
<td>1.2.2</td>
<td>2.2.1</td>
<td>2.1.2</td>
</tr>

<tr class="ganymede">
<td>02/25/09</td>
<td>1.1.3</td>
<td rowspan="2">3.4.2</td>
<td rowspan="2">3.4.2</td>
<td rowspan="2">2.4.3</td>
<td rowspan="2">1.2.3</td>
<td rowspan="2">1.2.3</td>
<td rowspan="2">2.2.3</td>
<td rowspan="2">2.1.3</td>
</tr>

<tr class="ganymede">
<td>06/13/10<br>(patch)</td>
<td>1.1.4</td>
</tr>

<tr class="galileo">
<td rowspan="4">Galileo</td>
<td>06/24/09</td>
<td>1.2.0</td>
<td>1.2.0</td>
<td>3.5.0</td>
<td>3.5.0</td>
<td rowspan="4">2.5.0</td>
<td rowspan="4">1.3.0</td>
<td>1.3.0</td>
<td>1.3.0</td>
<td rowspan="4">1.3.0</td>
<td>3.0.0</td>
<td>2.2.0</td>
<td rowspan="2">2.0.0</td>
<td rowspan="4">[5]</td>
</tr>

<tr class="galileo">
<td>09/25/09</td>
<td>1.2.1</td>
<td>1.2.1</td>
<td>3.5.1</td>
<td>3.5.1</td>
<td rowspan="3">1.3.1</td>
<td rowspan="3">1.3.1</td>
<td rowspan="3">3.0.1</td>
<td>2.2.1</td>
</tr>

<tr class="galileo">
<td>02/26/10</td>
<td>1.3.0</td>
<td rowspan="2">1.3.0</td>
<td rowspan="2">3.5.2</td>
<td rowspan="2">3.5.2</td>
<td rowspan="2">2.2.2</td>
<td rowspan="2">2.0.1</td>
</tr>

<tr class="galileo">
<td>(patch)</td>
<td>1.3.3</td>
</tr>

<tr class="helios">
<td rowspan="4">Helios</td>
<td>06/23/10</td>
<td>1.4.0</td>
<td>1.4.0</td>
<td>3.6.0</td>
<td>3.6.0</td>
<td>2.6.0</td>
<td rowspan="4">1.4.0</td>
<td rowspan="4">1.4.0</td>
<td rowspan="4">1.4.0</td>
<td>3.0.0</td>
<td>3.1.0</td>
<td>2.3.0</td>
<td>3.0.0</td>
<td rowspan="4">[5]</td>
</tr>

<tr class="helios">
<td>09/24/10</td>
<td>1.4.1</td>
<td rowspan="3">1.4.1</td>
<td>3.6.1</td>
<td>3.6.1</td>
<td rowspan="3">2.6.1</td>
<td>3.1.1</td>
<td>3.0.1</td>
<td rowspan="3">2.3.1</td>
<td rowspan="3">3.0.1</td>
</tr>

<tr class="helios">
<td>2/25/2011</td>
<td>1.4.2</td>
<td rowspan="2">3.6.2</td>
<td rowspan="2">3.6.2</td>
<td rowspan="2">3.0.2</td>
<td rowspan="2">3.1.2</td>
</tr>

<tr class="helios">
<td>(patch)</td>
<td>1.4.3</td>
</tr>

<tr class="indigo">
<td>Indigo</td>
<td>06/22/11</td>
<td>1.5.0</td>
<td>1.5.0</td>
<td>3.7.0</td>
<td>3.7.0</td>
<td>2.7.0</td>
<td>1.5.0</td>
<td>1.5.0</td>
<td>1.5.0</td>
<td>3.1.0</td>
<td>3.2.0</td>
<td>2.4.0</td>
<td>3.1.0</td>
<td>0.8.0</td>
</tr>

<tr class="juno">
<td rowspan="4">Juno</td>
<td>06/27/12</td>
<td>1.6.0</td>
<td rowspan="4">1.6.0</td>
<td>4.2.0</td>
<td>3.8.0</td>
<td>2.8.0</td>
<td rowspan="4">1.6.0</td>
<td rowspan="4">1.6.0</td>
<td rowspan="4">1.6.0</td>
<td>4.0.0</td>
<td rowspan="4">4.0.0</td>
<td rowspan="4">3.0.0</td>
<td rowspan="4">3.2.0</td>
<td rowspan="4">0.9.0</td>
</tr>

<tr class="juno">
<td>09/22/12</td>
<td>1.6.1</td>
<td>4.2.1</td>
<td>3.8.1</td>
<td>2.8.1</td>
<td rowspan="3">4.0.1</td>
</tr>

<tr class="juno">
<td>09/22/12</td>
<td>1.6.2</td>
<td rowspan="2">4.2.2</td>
<td rowspan="2">3.8.2</td>
<td rowspan="2">2.8.3</td>
</tr>

<tr class="juno">
<td>(patch)</td>
<td>1.6.3</td>
</tr>

<tr class="kepler">
<td>Kepler</td>
<td>06/26/13</td>
<td>1.7.0</td>
<td>1.7.0</td>
<td>4.3.0</td>
<td>3.9.0</td>
<td>2.9.0</td>
<td>1.7.0</td>
<td>1.7.0</td>
<td>1.7.0</td>
<td>4.1.0</td>
<td>4.1.0</td>
<td>3.1.0</td>
<td>3.3.0</td>
<td>0.10.0</td>
</tr>

<tr class="luna">
<td>Luna</td>
<td>06/26/14</td>
<td>1.8.0</td>
<td>1.8.0</td>
<td>4.4.0</td>
<td>3.10.0</td>
<td>2.10.0</td>
<td>1.8.0</td>
<td>1.8.0</td>
<td>1.8.0</td>
<td>4.2.0</td>
<td>4.2.0</td>
<td>3.2.0</td>
<td>3.4.0</td>
<td>0.11.0</td>
</tr>

<tr class="white">
<td colspan="15">
[1] - GMF Runtime and GMF Notation were not separate projects until Helios and the GMF Restructure.<br>
[2] - GMF Notation was not a separate feature until Ganymede.<br>
[3] - MDT OCL started depending on MDT UML2 in Europa.<br>
[4] - GMF Tooling started depending on M2M QVT in Galileo.<br>
[5] - Graphiti will have its first release in Indigo.<br>
Last Updated June 24 2013
</td>
</tr>
</table>
</div>
EOHTML;

# Generate the web page
$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>
