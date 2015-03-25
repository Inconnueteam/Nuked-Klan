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

function MenuGlo() {
echo "<center><a class=\"glossairetitre\" href=\"index.php?file=Glossaire\">" . _GLOSSAIRE . "</a><br /><br /><a class=\"boutonhaut\" href=\"index.php?file=Glossaire&amp;op=Propose\">"._PRODEF."</a>&nbsp;<a class=\"boutonhaut\" href=\"index.php?file=Glossaire&amp;op=Demande\">"._ASKDEF."</a></center>\n";
}

function Copyright() {
	
	OpenTable();
	CloseTable();
}

function LettreGloAj($texte_lettre) {
	 echo "<SELECT NAME=\"lettre\">\n";

if ($texte_lettre) {
		echo "<OPTION VALUE=\"$texte_lettre\"> $texte_lettre";
}

	$alphabet = array ("A","B","C","D","E","F","G","H","I","J","K","L","M",
						"N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
	$num = count($alphabet) - 1;
	$counter = 0;
	while (list(, $ltr) = each($alphabet)) {
		echo "<OPTION VALUE=\"$ltr\"> $ltr\n";

		$counter++;
	}
		echo "<OPTION VALUE=\"Autres\"> "._OTHERS."";
		echo "</SELECT>\n\n";
}


function NouvDef() {
global $nuked, $user;

	echo "<P>";
	OpenTable();
list($nbrs) = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM " . $nuked['prefix'] . "_glossaire WHERE affiche='O'"));

if($nbrs != 0)  {

echo "<B>10 "._LASTDEF."</B><BR><BR>";


$TableRep = mysql_query("SELECT id, lettre, nom, definition, affiche, lien FROM " . $nuked['prefix'] . "_glossaire WHERE affiche='O' ORDER BY id DESC LIMIT 0,10");
while ( list($glo_id, $glo_lettre, $glo_nom, $glo_definition, $glo_affiche, $glo_lien) = mysql_fetch_row($TableRep) ) {

$glo_nom = html_entity_decode($glo_nom);
$glo_definition = html_entity_decode($glo_definition);

$commD = "<a href=\"glossaire-comm.php?sid=$glo_id\"><img src=\"images/comm-glo.gif\" border=0 alt=\""._COMMADD."\" width=15 height=11></a>&nbsp;";
$imprD = "<a href=\"glossaire-p-f.php?op=ImprDef&sid=$glo_id\"><img src=\"images/print.gif\" border=0 Alt=\""._PRINT."\" width=15 height=11></a>&nbsp;";
$envD = "<a href=\"glossaire-p-f.php?op=EnvDef&sid=$glo_id\"><img src=\"images/friend.gif\" border=0 Alt=\""._FRIENDSEND."\" width=15 height=11></a>";

if ($anocomm ==1 || $user) {
echo "$commD ";
}
echo "$imprD $envD <B>$glo_nom</B> : $glo_definition";

if ($glo_lien) {
echo "<BR>+ "._LINKSASS2." <A HREF=\"$glo_lien\" TARGET=\"_blank\">$glo_lien</A>";
}

//list($nbbs) = mysql_fetch_row(mysql_query("SELECT count(id) as nbbs FROM ".$db->prefix("glossaire_comm")." WHERE def='$glo_id' AND affiche='O'"));
/*
if ($nbbs > 0) {
echo "<BR>+ <a href=\"glossaire-comm.php?op=LirComm&sid=$glo_id\">$nbbs "._COM."</a>";
}
*/
        if ( $xoopsUser ) {
		if ( $xoopsUser->isAdmin() ) {
echo "<BR>[ <A HREF=\"admin/mod-def.php?pa=modif&id=$glo_id\">"._MODIFY."</A> | <A HREF=\"admin/suppr-def.php?id=$glo_id\">"._SUPPR."</A> ]";
}
}
echo "<br><P>";


}
}
CloseTable();
}

?>
