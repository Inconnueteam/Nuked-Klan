<?php
// -------------------------------------------------------------------------//
// Nuked-KlaN - PHP Portal                                                  //
// http://www.nuked-klan.org                                                //
// -------------------------------------------------------------------------//
// This program is free software. you can redistribute it and/or modify     //
// it under the terms of the GNU General Public License as published by     //
// the Free Software Foundation; either version 2 of the License.           //
// -------------------------------------------------------------------------//
if (!defined('INDEX_CHECK')) die('<div style="text-align:center;">You cannot open this page directly</div>');

global $nuked, $language, $theme, $bgcolor1, $bgcolor2, $bgcolor3;
translate("modules/Glossaire/lang/" . $language . ".lang.php");


        $result = mysql_query("SELECT nom, lettre, definition FROM " . $nuked['prefix'] . "_glossaire  WHERE affiche='O' ORDER by rand() LIMIT 0,1");

        while($myrow = mysql_fetch_array($result)) {

        $nom = html_entity_decode($myrow['nom']);
        $definition = html_entity_decode($myrow['definition']);

        echo "<div style='text-align: left;'>- <b>".$myrow['lettre']."</b>&nbsp;comme&nbsp;<b>".$nom."</b><br />".$definition."<br /></div>";
        }
		echo "<div align=\"right\"><a href=\"".$nuked['url']."/index.php?file=Glossaire\">"._MB_OTHERS_DEF."...</a></div>";



?>