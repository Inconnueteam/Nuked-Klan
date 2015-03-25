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

global $user, $language;
translate("modules/Glossaire/lang/" . $language . ".lang.php");
include("modules/Admin/design.php");

$visiteur = (!$user) ? 0 : $user[1];
$ModName = basename(dirname(__FILE__));
$level_admin = admin_mod($ModName);
if ($visiteur >= $level_admin && $level_admin > -1){

include("modules/Glossaire/function.php");

function main() {

    global $nuked;
	
        echo "<div class=\"content-box\">\n" //<!-- Start Content Box -->
                . "<div class=\"content-box-header\"><h3>" . _ADMINGLOSSAIRE . "</h3>\n"
                . "<div style=\"text-align:right;\"><a href=\"help/" . $language . "/Glossaire.php\" rel=\"modal\">\n"
                . "<img style=\"border: 0;\" src=\"help/help.gif\" alt=\"\" title=\"" . _HELP . "\" /></a>\n"
                . "</div></div>\n"			
                . "<div class=\"tab-content\" id=\"tab2\"><div style=\"text-align: center;\">" . _ENTATTENTEGLO . "<b> | "
                . "<a href=\"index.php?file=Glossaire\">" . _SEELIST . "</a> | "
                . "<a href=\"index.php?file=Glossaire&amp;page=admin&amp;op=ajoutdef\">" . _ADDDEF . "</a> | "
                . "<a href=\"index.php?file=Glossaire&amp;page=admin&amp;op=pref\">" . _CONFGLO . "</a></b></div><br />\n";

        echo "<p><br /><b>"._WAITDEFVALID."</b><br />";

$propodef = mysql_query("SELECT id, nom FROM " . $nuked['prefix'] . "_glossaire WHERE affiche='N' order by nom");
$propo = mysql_num_rows($propodef);

if($propo == 0) {
  echo ""._NODEFWAIT."<P>";
} else {
  echo ""._THEREIS." <FONT COLOR=\"#FF0000\">$propo</FONT> "._WAITDEF."<p>";
  echo "<TABLE BORDER=1 CELLPADDING=2 CELLSPACING=1>
    <tr>
      <TD WIDTH=20><CENTER><B>"._NUM."</B></CENTER></td>
      <TD WIDTH=150><B>"._TERME4."</B></td>
      <td><CENTER><B>"._OPTION."</B></CENTER></td>
    </tr>";

while ( list($texte_id, $texte_nom) = mysql_fetch_row($propodef) ) {

$texte_nom = html_entity_decode($texte_nom);

 echo "<tr><td><CENTER>$texte_id</CENTER></td><td>&nbsp;&nbsp;$texte_nom</td><td>&nbsp;&nbsp;[ <A HREF=\"index.php?file=Glossaire&page=admin&op=modif&id=".$texte_id."\">"._MODVAL."</A> | <A HREF=\"suppr-def.php?id=".$texte_id."\">"._SUPPR."</A> ]&nbsp;&nbsp;</td></tr>";
  }
 echo    "</TABLE><P><BR>";
}


echo "<P><BR><B>"._ASKWAIT."</B><BR>";

    $propodef = mysql_query("SELECT id, nom FROM " . $nuked['prefix'] . "_glossaire WHERE affiche='D' order by nom");
    $propo = mysql_num_rows( $propodef);

if($propo == 0) {
  echo ""._ASKDEFWAIT."<P>";
} else {
  echo ""._THEREIS." <FONT COLOR=\"#FF0000\">$propo</FONT> "._DEFREQ."<p>";
  echo "<TABLE BORDER=1 CELLPADDING=2 CELLSPACING=1>
    <tr>
      <TD WIDTH=20><CENTER><B>"._NUM."</B></CENTER></td>
      <TD WIDTH=150><B>"._TERME4."</B></td>
      <td><CENTER><B>"._OPTION."</B></CENTER></td>
    </tr>";

while ( list($texte_id, $texte_nom) = mysql_fetch_row($propodef) ) {

$texte_nom = html_entity_decode($texte_nom);

 echo "<tr><td><CENTER>$texte_id</CENTER></td><td>&nbsp;&nbsp;$texte_nom</td><td>&nbsp;&nbsp;[ <A HREF=\"index.php?file=Glossaire&page=admin&op=modif&id=".$texte_id."\">"._MODVAL."</A> | <A HREF=\"index.php?file=Glossaire&page=admin&op=Suppr&id=".$texte_id."\">"._SUPPR."</A> ]&nbsp;&nbsp;</td></tr>";
  }
 echo    "</TABLE><P><BR>";
}
}

function pref() {

   global $user, $nuked;


        echo "<div class=\"content-box\">\n" //<!-- Start Content Box -->
                . "<div class=\"content-box-header\"><h3>" . _TITRECONF . "</h3>\n"
                . "<div style=\"text-align:right;\"><a href=\"help/" . $language . "/Glossaire.php\" rel=\"modal\">\n"
                . "<img style=\"border: 0;\" src=\"help/help.gif\" alt=\"\" title=\"" . _HELP . "\" /></a>\n"
                . "</div></div>\n"; 				

        echo "<FORM ACTION=\"index.php?file=Glossaire&page=admin&op=prefok\" METHOD=POST>
              <table>
              <tr>
              <td>"._DEFPAGE."</td>
              <td><INPUT TYPE=\"text\" NAME=\"glo_definitions\" SIZE=10 value=\"".$nuked['glo_definitions']."\"></td>
              </tr>
              <tr>
              <td>"._ANNOADDDEF."</td>
              <td><SELECT NAME=\"glo_definitions_ano\">";
			  
        if ($nuked['glo_definitions_ano'] == 1) {
		
	    echo "<OPTION VALUE=\"1\" selected>  "._OUI."";
	    echo "<OPTION VALUE=\"0\">  "._NON."";
	    
		} else {
		
	    echo "<OPTION VALUE=\"1\"> "._OUI."";
	    echo "<OPTION VALUE=\"0\" selected>  "._NON."";
		
	    }
		
        echo "</SELECT></td>
              </tr>
              <tr>
              <td>"._MAILWEBM."</td>
              <td><SELECT NAME=\"glo_definitions_mail\">";
			  
    if ($nuked['glo_definitions_mail'] == 1) {
	
	    echo "<OPTION VALUE=\"1\" selected> "._OUI."";
	    echo "<OPTION VALUE=\"0\">  "._NON."";
		
	    } else {
		
	    echo "<OPTION VALUE=\"1\"> "._OUI."";
	    echo "<OPTION VALUE=\"0\" selected>  "._NON."";
	    
		}
		
        echo "</SELECT></td>
              </tr>
              </table><p>
              <INPUT TYPE=\"submit\" VALUE=\""._VALID."\"></FORM>";
}

function prefok($glo_definitions, $glo_definitions_ano, $glo_definitions_mail) {
global $user, $nuked;

	$upd = mysql_query("UPDATE " . CONFIG_TABLE . " SET value = '" . $glo_definitions . "' WHERE name = 'glo_definitions'"); 
	$upd = mysql_query("UPDATE " . CONFIG_TABLE . " SET value = '" . $glo_definitions_ano . "' WHERE name = 'glo_definitions_ano'"); 
	$upd = mysql_query("UPDATE " . CONFIG_TABLE . " SET value = '" . $glo_definitions_mail . "' WHERE name = 'glo_definitions_mail'"); 
	
	    // Action
        $texteaction = "". _ACTIONGLOSSAIREPREF .".";
        $acdate = time();
        $sqlaction = mysql_query("INSERT INTO ". $nuked['prefix'] ."_action  (`date`, `pseudo`, `action`)  VALUES ('".$acdate."', '".$user[0]."', '".$texteaction."')");
        //Fin action
		
 echo "<div class=\"notification success png_bg\">\n"
                . "<div>\n"
                . "" . _OKCONFIG . "\n"
                . "</div>\n"
                . "</div>\n";
                
        redirect("index.php?file=Glossaire&page=admin&op=pref", 2);
	}

	function ajoutdef() {
    global $nuked;


	        echo "<div class=\"content-box\">\n" //<!-- Start Content Box -->
                . "<div class=\"content-box-header\"><h3>" . _ADDDEF . "</h3>\n"
                . "<div style=\"text-align:right;\"><a href=\"help/" . $language . "/Glossaire.php\" rel=\"modal\">\n"
                . "<img style=\"border: 0;\" src=\"help/help.gif\" alt=\"\" title=\"" . _HELP . "\" /></a>\n"
                . "</div></div>\n"; 	
				

            echo "<CENTER>[ <A HREF=\"index.php?file=Glossaire&page=admin\">"._ADMIN2."</A> | <A HREF=\"index.php?file=Glossaire\">"._SEELIST."</A> | "._ADDDEF." ]</CENTER>";

            echo "
                  <P>
                  <FORM ACTION='index.php?file=Glossaire&page=admin&op=ajoutdefok' METHOD=POST>
                  <INPUT TYPE=\"hidden\" NAME=\"affiche\" VALUE=\"O\">
                  <table style=\"margin: auto; width: 98%; text-align: left;\" cellspacing=\"0\" cellpadding=\"2\"border=\"0\">
                  <TR>
                  <TD ALIGN=\"LEFT\">"._LETTRE." </TD>
                  <TD>";
				  
                  LettreGloAj($texte_lettre);
				  
            echo "</TD>
                  </TR>
                  <TR>
                  <TD ALIGN=\"LEFT\">"._TERME2." </TD>
                  <TD><INPUT TYPE='text' NAME='nom' SIZE=50></TD>
                  </TR>
                  <TR>
                  <TD ALIGN=\"LEFT\">"._DEF3." </TD>
                  <TD><TEXTAREA class=\"editor\" name=\"definition\" COLS=40 ROWS=8></TEXTAREA></TD>
                  </TR>
                  <TR>
                  <TD ALIGN=\"LEFT\">"._LINKSASS2." </TD>
                  <TD><INPUT TYPE='text' NAME='lien' SIZE=50><BR><FONT SIZE=1>Ex. : http://www."._NAMESIT.".com</FONT></TD>
                  </TR>
                  <TR>
                  <TD ALIGN=\"CENTER\" COLSPAN=2><CENTER><INPUT TYPE='submit' VALUE='"._ADD."'></CENTER></TD>
                  </TR>
                  </TABLE></FORM>";

}

function ajoutdefok($lettre, $nom, $definition, $affiche, $lien) {
global $nuked;

            $nom = mysql_real_escape_string(stripslashes($nom));
            $definition = html_entity_decode($definition);
            $definition = mysql_real_escape_string(stripslashes($definition));
			$date = time();
			
  if ($lettre == "")
  {
  echo "<P><BR><CENTER><FONT COLOR=\"#FF0000\">"._OOPSLETTRE."</FONT></CENTER>";
  } else {

mysql_query("INSERT INTO " . $nuked['prefix'] . "_glossaire VALUES ('', '".$date."', '".$lettre."', '".$nom."', '".$definition."', '".$affiche."', '".$lien."')");

 echo "<div class=\"notification success png_bg\">\n"
                . "<div>\n"
                . "" . _ENRDEF . "\n"
                . "</div>\n"
                . "</div>\n";
                
        redirect("index.php?file=Glossaire&page=admin", 2);
	
  }
  }
  
function modif($id) {
global $nuked;

	        echo "<div class=\"content-box\">\n" //<!-- Start Content Box -->
                . "<div class=\"content-box-header\"><h3>" . _MOVALDEF . "</h3>\n"
                . "<div style=\"text-align:right;\"><a href=\"help/" . $language . "/Glossaire.php\" rel=\"modal\">\n"
                . "<img style=\"border: 0;\" src=\"help/help.gif\" alt=\"\" title=\"" . _HELP . "\" /></a>\n"
                . "</div></div>\n"; 



echo "<CENTER>[ <A HREF=\"index.php\">"._ADMIN2."</A> | <A HREF=\"../index.php\">"._SEELIST."</A> | <A HREF=\"ajout-def.php\">"._ADDDEF."</A> ]</CENTER>";

$TableRep = mysql_query("SELECT id, lettre, nom, definition, affiche, lien FROM " . $nuked['prefix'] . "_glossaire WHERE id = '$id'");
$NombreEntrees = mysql_num_rows($TableRep);

if($NombreEntrees == 0)  {
  echo "<P><BR>"._NOEXISTDEF." $id";
} else {

  list($texte_id, $texte_lettre, $texte_nom, $texte_def, $texte_aff, $texte_lien) = mysql_fetch_row($TableRep);

$texte_nom = html_entity_decode($texte_nom);
$texte_def = html_entity_decode($texte_def);

echo "<FORM enctype='multipart/form-data' ACTION='index.php?file=Glossaire&page=admin&op=modifok&id=$texte_id' METHOD=POST>
<INPUT TYPE=\"hidden\" NAME=\"affiche\" VALUE=\"O\">
<INPUT TYPE=\"hidden\" NAME=\"id\" VALUE=\"$texte_id\">";

echo "
<TABLE BORDER=0 CELLPADDING=5>
    <TR>
      <TD ALIGN=\"LEFT\">"._LETTRE." </TD>
      <TD>";
LettreGloAj($texte_lettre);
echo "</TD>
    </TR>
    <TR>
      <TD ALIGN=\"LEFT\">"._TERME2."</TD>
      <TD><INPUT TYPE='text' NAME='nom' VALUE='$texte_nom' SIZE=50></TD>
    </TR>
    <TR>
      <TD ALIGN=\"LEFT\">"._DEF3."</TD>
      <TD><TEXTAREA class=\"editor\" NAME=\"definition\" COLS=40 ROWS=8>$texte_def</TEXTAREA></TD>
    </TR>
    <TR>
      <TD ALIGN=\"LEFT\">"._LINKSASS2."</TD>
      <TD><INPUT TYPE='text' NAME='lien' VALUE='$texte_lien' SIZE=50></TD>
    </TR>
    <TR>
      <TD ALIGN=\"CENTER\" COLSPAN=2><CENTER><INPUT TYPE='submit' NAME='Validation'  VALUE='"._MODVAL."'></CENTER></FORM></TD>
    </TR>
    <TR>
      <TD ALIGN=\"CENTER\" COLSPAN=2><CENTER><FORM ACTION='index.php?file=Glossaire&page=admin&op=Suppr&id=$texte_id' METHOD=POST><INPUT TYPE=\"submit\" VALUE=\""._SUPPR."\"></FORM></CENTER></TD>
    </TR>
</TABLE>";
}
}
  
function modifok($id, $lettre, $nom, $definition, $lien) {
global $nuked;

  if ($id == "")  {

	OpenTable();
       echo " "._THEREISPROBLEM." ";
	   	   echo "<p><center>[ <a href=\"javascript:history.go(-1)\">"._COMEBACK."</a> ]</center>";
	CloseTable();


  } else {

            $nom = mysql_real_escape_string(stripslashes($nom));
            $definition = html_entity_decode($definition);
            $definition = mysql_real_escape_string(stripslashes($definition));
			$date = time();
			
mysql_query("UPDATE " . $nuked['prefix'] . "_glossaire SET date = '$date', lettre = '$lettre' , nom = '$nom' , definition = '$definition', affiche = 'O' , lien = '$lien'  WHERE id='$id'");

 echo "<div class=\"notification success png_bg\">\n"
                . "<div>\n"
                . "" . _DEFUPDATED . "\n"
                . "</div>\n"
                . "</div>\n";
                
        redirect("index.php?file=Glossaire&page=admin", 2);	
  }
}

function Suppr($id) {
global $nuked;

	        echo "<div class=\"content-box\">\n" //<!-- Start Content Box -->
                . "<div class=\"content-box-header\"><h3>" . _MOVALDEF . "</h3>\n"
                . "<div style=\"text-align:right;\"><a href=\"help/" . $language . "/Glossaire.php\" rel=\"modal\">\n"
                . "<img style=\"border: 0;\" src=\"help/help.gif\" alt=\"\" title=\"" . _HELP . "\" /></a>\n"
                . "</div></div>\n"; 
				

echo "<CENTER>[ <A HREF=\"index.php\">"._ADMIN2."</A> | <A HREF=\"../index.php\">"._SEELIST."</A> | <A HREF=\"ajout-def.php\">"._ADDDEF."</A> ]</CENTER>";

$result = mysql_query("SELECT lettre, nom, definition, lien FROM " . $nuked['prefix'] . "_glossaire WHERE id = '$id'");
list ($texte_lettre, $texte_nom, $texte_def, $texte_lien)  = mysql_fetch_row($result);

$texte_nom = html_entity_decode($texte_nom);
$texte_def = html_entity_decode($texte_def);

echo "<P><BR><B>"._SUPPRSURE." <FONT COLOR=\"#FF0000\">$id</FONT> "._ANDCOMLINK." ?</B></CENTER><P>";

echo "<TABLE BORDER=0 CELLPADDING=5>
    <TR>
      <TD><B>"._LETTRE." </B></TD>
      <TD>$texte_lettre</TD><P>
    </TR>
    <TR>
      <TD><B>"._TERME2." </B></TD>
      <TD>$texte_nom</TD>
    </TR>
    <TR>
      <TD VALIGN=\"TOP\"><B>"._DEF3." </B></TD>
      <TD>$texte_def</TD>
    </TR>
    <TR>
      <TD VALIGN=\"TOP\"><B>"._LINKSASS2." </B></TD>
      <TD><A HREF=\"$texte_lien\" TARGET=\"_blank\">$texte_lien</A></TD>
    </TR>
    <TR>
      <TD COLSPAN=2>&nbsp;</TD>
    </TR>
    <TR>
      <TD COLSPAN=2><CENTER>
<form method=post action=\"index.php?file=Glossaire&page=admin&op=SupprOk&id=$id\"><input type=submit value=\""._SUPPR2."\"></form>
 </CENTER></TD>
    </TR>
</TABLE>";
}

function SupprOk($id) {
global $nuked;

mysql_query("DELETE FROM " . $nuked['prefix'] . "_glossaire WHERE id = '".$id."'");

 echo "<div class=\"notification success png_bg\">\n"
                . "<div>\n"
                . "" . _DEFNUM . "\n"
                . "</div>\n"
                . "</div>\n";
                
        redirect("index.php?file=Glossaire&page=admin", 2);

}

switch ($_REQUEST['op']){

        case "main":
            main();
            break;
			
		case "pref":
		    admintop();
            pref();
			adminfoot();
            break;	
			
		case "prefok":
		    admintop();
            prefok($_REQUEST['glo_definitions'], $_REQUEST['glo_definitions_ano'], $_REQUEST['glo_definitions_mail']);
			adminfoot();
            break;	
			
		case "ajoutdef":
		    admintop();
            ajoutdef();
			adminfoot();
            break;	
			
		case "ajoutdefok":
		    admintop();
            ajoutdefok($_REQUEST['lettre'], $_REQUEST['nom'], $_REQUEST['definition'], $_REQUEST['affiche'], $_REQUEST['lien']);
			adminfoot();
            break;	
			
		case "modif":
		    admintop();
            modif($_REQUEST['id']);
			adminfoot();
            break;	
			
		case "modifok":
		    admintop();
		    modifok($_REQUEST['id'], $_REQUEST['lettre'], $_REQUEST['nom'], $_REQUEST['definition'], $_REQUEST['lien']);
			adminfoot();
		    break;
		
		case "Suppr":
		    admintop();
            Suppr($_REQUEST['id']);
			adminfoot();
            break;	
			
		case "SupprOk":
		    admintop();
		    SupprOk($_REQUEST['id']);
			adminfoot();
		    break;
		
			default:
            admintop();
            main();
            adminfoot();
            break;
}

} 
else if ($level_admin == -1){
    admintop();
    
    echo "<div class=\"notification error png_bg\">\n"
            . "<div>\n"
            . "<br /><br /><div style=\"text-align: center;\">" . _MODULEOFF . "<br /><br /><a href=\"javascript:history.back()\"><b>" . _BACK . "</b></a></div><br /><br />"
            . "</div>\n"
            . "</div>\n";
            
    adminfoot();
}
else if ($visiteur > 1){
    admintop();
    
    echo "<div class=\"notification error png_bg\">\n"
            . "<div>\n"
            . "<br /><br /><div style=\"text-align: center;\">" . _NOENTRANCE . "<br /><br /><a href=\"javascript:history.back()\"><b>" . _BACK . "</b></a></div><br /><br />"
            . "</div>\n"
            . "</div>\n";
        
    adminfoot();
}
else{
    admintop();
    
    echo "<div class=\"notification error png_bg\">\n"
            . "<div>\n"
            . "<br /><br /><div style=\"text-align: center;\">" . _ZONEADMIN . "<br /><br /><a href=\"javascript:history.back()\"><b>" . _BACK . "</b></a></div><br /><br />"
            . "</div>\n"
            . "</div>\n";
    adminfoot();
}
?>