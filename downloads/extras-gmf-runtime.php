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

$oldrels = array(
	"2.2.2" => array("2010/02/24 12:28","http://archive.eclipse.org/modeling/gmf/gmf/downloads/drops/2.2.2/R201002241200"),
	"2.2.1" => array("2009/09/24 15:25","http://archive.eclipse.org/modeling/gmf/gmf/downloads/drops/2.2.1/R200909151752"),
	"2.2.0" => array("2009/06/22 12:28","http://archive.eclipse.org/modeling/gmf/gmf/downloads/drops/2.2.0/R200906220658"),
	"2.1.3" => array("2009/02/18 12:25","http://archive.eclipse.org/modeling/gmf/gmf/downloads/drops/2.1.3/R200902181028"),
	"2.1.2" => array("2008/09/17 16:25","http://archive.eclipse.org/modeling/gmf/downloads/drops/2.1.2/R200809171625"),
	"2.1.1" => array("2008/08/15 17:18","http://archive.eclipse.org/modeling/gmf/downloads/drops/2.1.1/R200808151718"),
	"2.1.0" => array("2008/06/12 14:02","http://archive.eclipse.org/modeling/gmf/downloads/drops/2.1.0/R200806121402"),
	"2.0.2" => array("2008/02/25 02:00","http://archive.eclipse.org/modeling/gmf/downloads/drops/R-2.0.2-200802250200"),
	"2.0.1" => array("2007/09/28 00:00","http://archive.eclipse.org/modeling/gmf/downloads/drops/R-2.0.1-200709280000"),
	"2.0.0" => array("2007/06/21 00:00","http://archive.eclipse.org/modeling/gmf/downloads/drops/R-2.0-200706210000"),
	"1.0.3" => array("2007/02/09 19:00","http://archive.eclipse.org/modeling/gmf/downloads/drops/R-1.0.3-200702091900"),
	"1.0.2" => array("2006/10/27 12:00","http://archive.eclipse.org/modeling/gmf/downloads/drops/R-1.0.2-200610271200"),
	"1.0.1" => array("2006/09/26 11:00","http://archive.eclipse.org/modeling/gmf/downloads/drops/R-1.0.1-200609261100"),
	"1.0.0" => array("2006/06/27 12:00","http://archive.eclipse.org/modeling/gmf/downloads/drops/R-1.0-200606271200"),
);

function showNotes()
{
?>
	<div class="homeitem3col">
		<h3>GMF Runtime Downloads</h3>
		<p>In the Helios release, the GMF project was restructured into the GMF Tooling, GMF Runtime and GMF Notation projects under the Graphical Modeling Project.</p>
		<p>A table of previous GMF releases can be found <a href="/modeling/gmp/development/releases.php"><b>HERE</b></a></p>
		<p>All downloads are provided under the terms and conditions of the <a href="http://www.eclipse.org/legal/epl/notice.html">Eclipse Foundation Software User Agreement</a> unless otherwise specified.</p>
	</div>
<?php
}
?>
