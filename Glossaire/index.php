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

global $user, $nuked, $language;
translate("modules/Glossaire/lang/" . $language . ".lang.php");

$visiteur = (!$user) ? 0 : $user[1];
$ModName = basename(dirname(__FILE__));
$level_access = nivo_mod($ModName);
if ($visiteur >= $level_access && $level_access > -1){
   
    include("modules/Glossaire/function.php");
    compteur("Glossaire");

	    function index(){
        global $bgcolor1, $bgcolor2, $bgcolor3, $theme, $nuked, $user;

		include ('modules/Glossaire/template.php');
        $nb_membres = $nuked['glo_definitions'];

        if ($_REQUEST['letter'] == "Autres"){
            $and = "AND nom NOT REGEXP '^[a-zA-Z].'";
        } 
        else if ($_REQUEST['letter'] != "" && preg_match("`^[A-Z]+$`", $_REQUEST['letter'])){
            $and = "AND nom LIKE '" . $_REQUEST['letter'] . "%'";
        } 
        else{
            $and = "";
        } 

        $sql2 = mysql_query("SELECT nom FROM " . $nuked['prefix'] . "_glossaire WHERE affiche='O' " . $and . " ORDER BY nom");
        $count = mysql_num_rows($sql2);

        if (!$_REQUEST['p']) $_REQUEST['p'] = 1;
        $start = $_REQUEST['p'] * $nb_membres - $nb_membres;

        opentable();

        echo "<br /><table width=\"100%\" cellspacing=\"0\" cellpadding=\"3\" border=\"0\">\n"
				. "<tr><td align=\"center\"><br /><big>\n";
				
			MenuGlo();
			
		echo "</big><br /><br /></td></tr>\n";
        
		
        $alpha = array ("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "" . _OTHERS . "");

        echo "<tr><td align=\"center\"><a class=\"lettresa ".$current."\" href=\"index.php?file=Glossaire\">" . _ALL . "</a>&nbsp;";
        
        $num = count($alpha) - 1;
        $counter = 0;
        while (list(, $lettre) = each($alpha)){
        if ($_REQUEST['letter'] == $lettre) { $current ='current'; } else { $current ='lettresa'; }
            echo "<a class=\"".$current."\" href=\"index.php?file=Glossaire&amp;letter=" . $lettre . "\">" . $lettre . "</a>";

            if ($counter == round($num / 2)){
                echo " <br /><br /> ";
            } 
            else if ($counter != $num){
                echo " ";
            } 

            $counter++;
        } 

        echo "<br /><br /></td></tr></table><br />";

		if ($count > $nb_membres){
            $url_members = "index.php?file=Glossaire&amp;letter=" . $_REQUEST['letter'];
            number($count, $nb_membres, $url_members);
        } 

        echo "<table style=\"-webkit-border-radius: 10px;-moz-border-radius: 10px;border-radius: 10px;background: " . $bgcolor2 . ";border: 1px solid " . $bgcolor3 . ";\" width=\"100%\" cellpadding=\"2\" cellspacing=\"1\">\n"
				. "<tr style=\"background: " . $bgcolor3 . ";\">\n"
				. "<td style=\"-moz-border-radius-topleft: 10px;-webkit-border-top-left-radius: 10px;border-top-left-radius: 10px;width: 5%;\" align=\"center\"><b>"._LETTREINDEX."</b></td>\n"
				. "<td style=\"width: 20%;\" align=\"center\"><b>" . _TERMES . "</b></td>\n"
            	. "<td style=\"width: 60%;\" align=\"left\"><b>" . _DEFINITIONS . "</b></td>\n"
				. "<td style=\"width: 15%;-moz-border-radius-topright: 10px;-webkit-border-top-right-radius: 10px;border-top-right-radius: 10px;\" align=\"center\"><b>"._DATEAJOUT."</b></td></tr>\n";
               

        $sq2 = mysql_query("SELECT id, date, lettre, nom, definition, affiche, lien FROM " . $nuked['prefix'] . "_glossaire WHERE affiche='O' " . $and . " ORDER BY date LIMIT " . $start . ", " . $nb_membres);
        while (list($id, $date, $lettreg, $nom, $definition, $affiche, $url) = mysql_fetch_array($sq2)){

			$definition = preg_replace("`<br />`i", "", $definition);
			$date = nkDate($date);
			
			$url_img = "onmouseover=\"AffBulle('', '&raquo;&nbsp;"._APERCUSITELIENS."<br/><img src=\'http://www.apercite.fr/api/apercite/320x240/oui/" . $url . "\' style=\'max-width:160px;\' alt=\'\'/>', '');\" onmouseout=\"HideBulle();\"";

			if ($url != "" && preg_match("`http://`i", $url))  $home = "<a href=\"" . $url . "\" " .$url_img." onclick=\"window.open(this.href); return false;\"><img style=\"border: 0;\" src=\"modules/Members/images/browser.png\" alt=\"url\" /></a>";
            else $home = "<img style=\"border: 0;\" src=\"modules/Members/images/non.png\"/>";
           
            if ($j == 0){
                $bg = $bgcolor2;
                $j++;
            } 
            else{
                $bg = $bgcolor1;
                $j = 0;
            } 

            echo "<tr style=\"background: " . $bg . ";\">\n"
					. "<td style=\"-moz-border-radius-bottomleft: 10px;-webkit-border-bottom-left-radius: 10px;border-bottom-left-radius: 10px;width: 5%;\" align=\"center\">".$lettreg."</td>\n"
					. "<td style=\"width: 20%;\" align=\"center\"><a href=\"index.php?file=Glossaire&amp;op=terme&amp;nom=" . html_entity_decode($nom) . "\" title=\"" . _VIEWDEFINTION . "\"><b>" . $nom . "</b></a></td>\n"
                    . "</td><td style=\"font-family:times new roman,times,serif;width: 60%;\" align=\"left\">\n";

            if ($definition != "")
            {
                echo "<em>" . couper_texte_htmlflat($definition,80) . "</em>";
            }
            else
            {
                echo "<img style=\"border: 0;\" src=\"modules/Members/images/non.png\"/>";
            }	

            echo "<td style=\"-moz-border-radius-bottomright: 10px;-webkit-border-bottom-right-radius: 10px;border-bottom-right-radius: 10px;width: 15%;\" align=\"center\">" . $date . "</td>\n";

            echo "</td></tr>\n";
        } 

        if ($count == 0){
            echo "<tr><td colspan=\"8\" align=\"center\">" . _NOGLOSSAIREDEF . "</td></tr>\n";
        }
		
        echo "</table>";

        if ($count > $nb_membres){
            $url_members = "index.php?file=Glossaire&amp;letter=" . $_REQUEST['letter'];
            echo '<br />'; number($count, $nb_membres, $url_members);
        } 

        //$date_install = nkDate($nuked['date_install']);

        if ($_REQUEST['letter'] != ""){
            $_REQUEST['letter'] = htmlentities($_REQUEST['letter']);
            $_REQUEST['letter'] = nk_CSS($_REQUEST['letter']);

            echo "<br /><div style=\"text-align: center;\">" . $count . "&nbsp;" . _GLOSSFOUND . " <b>" . $_REQUEST['letter'] . "</b></div><br />\n";
        } 
        else{
            echo "<br /><div style=\"text-align: center;\">" . _THEREARE . "&nbsp;" . $count . "&nbsp;" . _GLOSDEFINITIONS . "&nbsp;<br />\n";

            if ($count > 0){
                $sql_member = mysql_query("SELECT nom FROM " . $nuked['prefix'] . "_glossaire WHERE affiche='O' ORDER BY id DESC LIMIT 0, 1");
                list($nomm) = mysql_fetch_array($sql_member);
                echo _LASTMEMBER . " <a href=\"index.php?file=Glossaire&amp;op=terme&amp;nom=" . $nomm . "\"><b>" . $nomm . "</b></a></div><br />\n";
            } 
            else{
                echo "</div><br />\n";
            } 
	}

        closetable();
    } 

    function terme($nom){
        global $nuked, $bgcolor1, $bgcolor2, $bgcolor3, $user, $visiteur;

		include ('modules/Glossaire/template.php');
        opentable();

        $sql = mysql_query("SELECT id, date, lettre, nom, definition, affiche, lien FROM " . $nuked['prefix'] . "_glossaire WHERE nom = '" . $nom . "'");
        $test = mysql_num_rows($sql);

        if ($test > 0){
            list($id, $date, $lettre, $nomdetail, $definition, $affiche, $lien) = mysql_fetch_array($sql);
            $dateajout = nkDate($date);
			
            if ($visiteur == 9){
               echo "<div style=\"text-align: right;\"><a href=\"index.php?file=Glossaire&amp;page=admin&amp;op=modif&amp;id=" . $id . "\"><img style=\"border: 0;\" src=\"images/edition.gif\" alt=\"\" title=\"" . _EDIT . "\" /></a>";
            
	            if ($id){
	                echo "<script type=\"text/javascript\">\n"
							."<!--\n"
							."\n"
							. "function deluser(pseudo, id)\n"
							. "{\n"
							. "if (confirm('" . _DELETETERME . " '+pseudo+' ! " . _CONFIRM . "'))\n"
							. "{document.location.href = 'index.php?file=Glossaire&page=admin&op=Suppr&id='+id;}\n"
							. "}\n"
							. "\n"
							. "// -->\n"
							. "</script>\n";

	            	echo "<a href=\"javascript:deluser('" . mysql_real_escape_string(stripslashes($nom)) . "', '" . $id . "');\"><img style=\"border: 0;\" src=\"images/delete.gif\" alt=\"\" title=\"" . _DELETE . "\" /></a>";
	            }
				
			echo "&nbsp;</div>\n";
			} 
            $pdffriend = "&nbsp;<a href=\"#\" onclick=\"javascript:window.open('index.php?file=Glossaire&amp;nuked_nude=index&amp;op=pdf&amp;id=" . $id . "','projet','toolbar=yes,location=no,directories=no,scrollbars=yes,resizable=yes')\"><img src=\"modules/Glossaire/images/pdf_file.png\" alt=\"Imprimer en pdf\" style=\"vertical-align:middle;\" width=\"20\" height=\"20\" border=\"0\" /></a>";
			
            echo "<br /><br /><div style=\"text-align: center;\"><xx class=\"membre_a\">" . $nom . "</xx></div><br /><br /><br />";
            if ($lien) { $witdh = '80%'; } else { $witdh = '100%';}
			echo "<table style=\"background: " . $bgcolor2 . ";border: 1px solid " . $bgcolor3 . ";\" width=\"100%\" cellpadding=\"2\" cellspacing=\"1\">\n"
					."<tr style=\"background: " . $bgcolor3 . ";\"><td style=\"width: 100%;height: 20px\" colspan=\"2\" align=\"left\"><big><b>" . _DEFINITION . "".$dateajout."".$pdffriend."</b></big></td></tr>\n"
					."<tr style=\"background: " . $bgcolor1 . ";\"><td style=\"width: 100%\"><table cellpadding=\"1\" cellspacing=\"1\">\n"
					."<tr><td style=\"width: ".$witdh.";\">" . html_entity_decode($definition) . "</td></tr>\n";
			

			if ($lien) { $back = "style=\"background: " . $bgcolor3 . ";width: 20%;\" align=\"right\""; } else { $back = '';}
			echo "</table></td><td ".$back.">\n";
			
			if ($lien) echo "<div class=\"containerglos\"><a href=\"" . $lien . "\" title=\"" . $lien . "\">
			<img src=\"http://www.apercite.fr/api/apercite/320x240/oui/".$lien."\">				
    		<div class='overlayglos'><div>+ "._LINKSASS2."</div></div></a></div>";
			
			echo "</td></tr></table><br />\n"
				."<br /><div style=\"text-align: center;\">\n";
        }
        else{
            echo "<br /><br /><div style=\"text-align: center;\">" . _NODEFINTION . "</div><br /><br />\n";
        } 
        echo "<center><a class=\"\" href=\"index.php?file=Glossaire\">"._RETURNGLO."</a></center>\n";
        closetable();
    } 
	

function Propose($nouvdef)
{
 global $user, $nuked;
 
 include ('modules/Glossaire/template.php');
OpenTable();
if($nuked['glo_definitions_ano'] == 1 || $user){

define('EDITOR_CHECK', 1);

echo "<B>"._PRODEF2."</B><P>"._YOUKNOW."<P>\n";

echo "<FORM ACTION=\"index.php?file=Glossaire&op=Propdef\" METHOD=POST>
<INPUT TYPE=\"hidden\" NAME=\"affiche\" VALUE=\"N\">
<INPUT TYPE=\"hidden\" NAME=\"logname\" VALUE=\"";
if($user) {
echo $user[2];
} else {
echo 'Anonyme';
}
echo "\">
<table style=\"margin: auto; width: 98%; text-align: left;\" cellspacing=\"0\" cellpadding=\"2\"border=\"0\">
    <TR>
      <TD>"._TERME2." </TD>
      <TD><INPUT TYPE=\"text\" NAME=\"terme\" SIZE=25></TD>
    </TR>
    <TR>
      <TD>"._DEF3." </TD>
      <TD><TEXTAREA id=\"e_basic\" NAME=\"def\" cols=\"70\" rows=\"15\"></TEXTAREA></TD>
    </TR>
    <TR>
      <TD>"._LINKSASS2." </TD>
      <TD><INPUT TYPE=\"text\" NAME=\"lien\" SIZE=50><BR><FONT SIZE=1>Ex. : http://"._NAMESIT.".fr</FONT></TD>
    </TR>
    <TR>
      <TD COLSPAN=2>&nbsp;</TD>
    </TR>
    <TR>
      <TD COLSPAN=2><INPUT TYPE=\"submit\" VALUE=\""._PRODEF3."\"></TD>
    </TR>
</TABLE></FORM>";

		echo "<center><a class=\"boutonhaut\" href=\"index.php?file=Glossaire\">"._RETURNGLO."</a></center>\n";
             } else {
        echo ""._MEMBERONLY." <a href=\"index.php?file=User&amp;op=reg_screen\">"._REGISTER."</a>";
             }
             CloseTable();             
}

function Demande()  {
 global $user, $nuked;
 
 	  OpenTable();
echo "<B>"._ASKDEF."</B><P>"._HEY."<P>\n";

echo "<FORM ACTION=\"index.php?file=Glossaire&op=demdef\" METHOD=POST>
<INPUT TYPE=\"hidden\" NAME=\"affiche\" VALUE=\"D\">
<INPUT TYPE=\"hidden\" NAME=\"logname\" VALUE=\"";
if($user) {
echo $user[2];
} else {
echo 'Anonyme';
}
echo "\">
<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
    <TR>
      <TD>"._LOOKINGFOR." </TD>
      <TD><INPUT TYPE=\"text\" CLASS=textbox NAME=\"terme\" SIZE=25></TD>
    </TR>
    <TR>
      <TD COLSPAN=2>&nbsp;</TD>
    </TR>
    <TR>
      <TD COLSPAN=2><INPUT TYPE=\"submit\" VALUE=\""._SEND."\"></TD>
    </TR>
</TABLE></FORM>";
		echo "[ <A HREF=\"index.php?file=Glossaire\">"._WELCOMEGLO."</A> ]\n";
		CloseTable();
}

function Propdef($terme, $def, $affiche, $lien, $mess, $logname)  {
    global $nuked, $user;

	$terme = mysql_real_escape_string(stripslashes($terme));
	$def = mysql_real_escape_string(stripslashes($def));
    $date = time();
	
mysql_query("INSERT INTO " . $nuked['prefix'] . "_glossaire (id, date, lettre, nom, definition, affiche, lien) VALUES ('', '$date' , '', '$terme', '$def', '$affiche', '$lien')");

if($user) {
            $result = mysql_query("select email from ".$nuked['prefix']."_users where pseudo = '".$logname."'");
            list($adrs) = mysql_fetch_row($result);
    } else {
            $adrs = $nuked['mail'];
}


if ($nuked['glo_definitions_mail'] == 1) {
$message = ""._PROBY." $logname $adrs\n\n"._SUBTERM." $terme\n"._DEF3." $def";
$subject = ""._PRODEFBY." $terme";
mail($nuked['mail'], "$subject", $message, "From: $adrs");
}
    echo "<br /><div style=\"text-align: center;\">"._YOSUBREG."</div>";
	redirect("index.php?file=Glossaire", 3);
	
}


function Demdef($terme, $affiche, $mess, $logname)  {
    global $nuked, $user;

	$terme = mysql_real_escape_string(stripslashes($terme));
    $date = time();
	
mysql_query("INSERT INTO " . $nuked['prefix'] . "_glossaire (id, date, lettre, nom, definition, affiche) VALUES ('', '$date' , '', '$terme', '', '$affiche')");

if($user) {
            $result = mysql_query("select email from ".$nuked['prefix']."_users where pseudo = '".$logname."'");
            list($adrs) = mysql_fetch_row($result);
    } else {
$adrs = $nuked['mail'];
}

 if ($nuked['glo_definitions_mail'] == 1) {
$message = ""._ASKFROM." $logname $adrs\n\n"._DEMTERM." $terme";
$subject = ""._ASKDEF." $terme";
mail($nuked['adminmail'], "$subject", $message, "From: $adrs");
}

	echo "<br /><div style=\"text-align: center;\">"._YOSUBREG."</div>";
	redirect("index.php?file=Glossaire", 3);
}

    function pdf($id) {
        global $nuked;

        $sql = mysql_query("SELECT nom, lettre, definition FROM " . $nuked['prefix'] . "_glossaire  WHERE id = '" . $id . "'");
        list($title, $lettre, $text) = mysql_fetch_row($sql);

        $text = "<br />" . $text;

        $text = str_replace("&quot;", "\"", $text);
        $text = str_replace("&#039;", "'", $text);
        $text = str_replace("&agrave;", "à", $text);
        $text = str_replace("&acirc;", "â", $text);
        $text = str_replace("&eacute;", "é", $text);
        $text = str_replace("&egrave;", "è", $text);
        $text = str_replace("&ecirc;", "ê", $text);
        $text = str_replace("&ucirc;", "û", $text);

        $text = preg_replace('#\r\n\t#', '', $text);
        $text = str_replace('<div style="page-break-after: always;"><span style="display: none;">&nbsp;</span></div>', '</page><page>', $text);

        $articleurl = $nuked['url'] . "/index.php?file=Glossaire";

        $sitename = $nuked['name'] . " - " . $nuked['slogan'];

        $texte = '<page><b>'.$lettre.'</b>&nbsp;comme<h1>'.$title.'</h1><hr />'.$text.'<hr />'.$sitename.'<br />'.$articleurl.'</page>';
        $_REQUEST['file'] = $sitename.'_'.$title;
        $_REQUEST['file'] = str_replace(' ','_',$_REQUEST['file']);
        $_REQUEST['file'] .= '.pdf';

        // convert in PDF
        require_once('Includes/html2pdf/html2pdf.class.php');
        try
        {
            $html2pdf = new HTML2PDF('P', 'A4', 'fr');
            $html2pdf->setDefaultFont('dejavusans');
            $html2pdf->writeHTML(utf8_encode($texte), isset($_GET['vuehtml']));
            $html2pdf->Output($title.'.pdf');
        }
        catch(HTML2PDF_exception $e) {
            echo $e;
            exit;
        }
    }


	
switch ($_REQUEST['op']){

	case "Demande":
		Demande();
		break;
	case "Propose":
		Propose($_REQUEST['nouvdef']);
		break;
	case "Propdef":
        Propdef($_REQUEST['terme'], $_REQUEST['def'], $_REQUEST['affiche'], $_REQUEST['lien'], $_REQUEST['mess'], $_REQUEST['logname']);
        break;
    case "demdef":
        Demdef($_REQUEST['terme'], $_REQUEST['affiche'], $_REQUEST['mess'], $_REQUEST['logname']);
        break;
	case"terme":
        terme($_REQUEST['nom']);
        break;  
	case'pdf':
        pdf($_REQUEST['id']);
        break;
	default:
		index();
		break;
}

} 
else if ($level_access == -1){
    opentable();
    echo "<br /><br /><div style=\"text-align: center;\">" . _MODULEOFF . "<br /><br /><a href=\"javascript:history.back()\"><b>" . _BACK . "</b></a><br /><br /></div>";
    closetable();
} 
else if ($level_access == 1 && $visiteur == 0){
    opentable();
    echo "<br /><br /><div style=\"text-align: center;\">" . _USERENTRANCE . "<br /><br /><b><a href=\"index.php?file=User&amp;op=login_screen\">" . _LOGINUSER . "</a> | <a href=\"index.php?file=User&amp;op=reg_screen\">" . _REGISTERUSER . "</a></b><br /><br /></div>";
    closetable();
} 
else{
    opentable();
    echo "<br /><br /><div style=\"text-align: center;\">" . _NOENTRANCE . "<br /><br /><a href=\"javascript:history.back()\"><b>" . _BACK . "</b></a><br /><br /></div>";
    closetable();
} 
?>