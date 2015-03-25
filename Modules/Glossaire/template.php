<?php
// -------------------------------------------------------------------------//
// Nuked-KlaN - PHP Portal                                                  //
// http://www.nuked-klan.org                                                //
// -------------------------------------------------------------------------//
// New look by kotshiro http://kotshiro.free.fr Octobre 2013                //
// This program is free software. you can redistribute it and/or modify     //
// it under the terms of the GNU General Public License as published by     //
// the Free Software Foundation; either version 2 of the License.           //
// -------------------------------------------------------------------------//

defined('INDEX_CHECK') or die ('You can\'t run this file alone.');

global $bgcolor1, $bgcolor2, $bgcolor3;
// Definition des 3 couleurs, par defaut ceux de nuked-klan, vous pouvez les remplacer par un code couleur.
// Exemple : $color1 = "#FFFFFF";

$color1 = $bgcolor1;
$color2 = $bgcolor2;
$color3 = $bgcolor3;

?>
<style>
@import url(http://fonts.googleapis.com/css?family=Shadows+Into+Light);
.lettresa {
position:relative;
z-index:2;
/*color: <?php echo $bgcolor2; ?>;*/

font-size: 14px;
padding: 10px;
text-shadow: 0px -1px 0px <?php echo $bgcolor2; ?>;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
  background: <?php echo $bgcolor3; ?>;
  background-image: -webkit-linear-gradient(top, <?php echo $bgcolor3; ?>, <?php echo $bgcolor2; ?>);
  background-image: -moz-linear-gradient(top, <?php echo $bgcolor3; ?>, <?php echo $bgcolor2; ?>);
  background-image: -ms-linear-gradient(top, <?php echo $bgcolor3; ?>, <?php echo $bgcolor2; ?>);
  background-image: -o-linear-gradient(top, <?php echo $bgcolor3; ?>, <?php echo $bgcolor2; ?>);
  background-image: linear-gradient(to bottom, <?php echo $bgcolor3; ?>, <?php echo $bgcolor2; ?>);
-webkit-box-shadow: 0px 2px 1px rgba(50, 50, 50, 0.75);
-moz-box-shadow:    0px 2px 1px rgba(50, 50, 50, 0.75);
box-shadow:         0px 2px 1px rgba(50, 50, 50, 0.75);
}

.lettresa:hover{
position:relative;
z-index:8;
font-size: 14px;
padding: 10px;
text-shadow: 0px -1px 0px <?php echo $bgcolor2; ?>;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
  background: <?php echo $bgcolor2; ?>;
  background-image: -webkit-linear-gradient(top, <?php echo $bgcolor2; ?>, <?php echo $bgcolor3; ?>);
  background-image: -moz-linear-gradient(top, <?php echo $bgcolor2; ?>, <?php echo $bgcolor3; ?>);
  background-image: -ms-linear-gradient(top, <?php echo $bgcolor2; ?>, <?php echo $bgcolor3; ?>);
  background-image: -o-linear-gradient(top, <?php echo $bgcolor2; ?>, <?php echo $bgcolor3; ?>);
  background-image: linear-gradient(to bottom, <?php echo $bgcolor2; ?>, <?php echo $bgcolor3; ?>);
  text-decoration: none;
  -webkit-box-shadow: 0px 2px 1px rgba(50, 50, 50, 0.75);
-moz-box-shadow:    0px 2px 1px rgba(50, 50, 50, 0.75);
box-shadow:         0px 2px 1px rgba(50, 50, 50, 0.75); 
transition: 1s; -webkit-transition: 1s; 
}
.current {
  position:relative;
z-index:2;
/*color: <?php echo $bgcolor2; ?>;*/

font-size: 24px;
padding: 10px;
text-shadow: 0px -1px 0px <?php echo $bgcolor2; ?>;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
  background: <?php echo $bgcolor3; ?>;
  background-image: -webkit-linear-gradient(top, <?php echo $bgcolor3; ?>, <?php echo $bgcolor2; ?>);
  background-image: -moz-linear-gradient(top, <?php echo $bgcolor3; ?>, <?php echo $bgcolor2; ?>);
  background-image: -ms-linear-gradient(top, <?php echo $bgcolor3; ?>, <?php echo $bgcolor2; ?>);
  background-image: -o-linear-gradient(top, <?php echo $bgcolor3; ?>, <?php echo $bgcolor2; ?>);
  background-image: linear-gradient(to bottom, <?php echo $bgcolor3; ?>, <?php echo $bgcolor2; ?>);
-webkit-box-shadow: 0px 2px 1px rgba(50, 50, 50, 0.75);
-moz-box-shadow:    0px 2px 1px rgba(50, 50, 50, 0.75);
box-shadow:         0px 2px 1px rgba(50, 50, 50, 0.75);
}

.membre_a {

/*color: <?php echo $bgcolor2; ?>;*/
font-size: 20px;
padding: 20px;
text-shadow: 0px -1px 0px <?php echo $bgcolor1; ?>;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
background: <?php echo $bgcolor3; ?>;
background: -moz-linear-gradient(45deg, <?php echo $bgcolor3; ?> 30%, <?php echo $bgcolor1; ?> 70%);
background: -webkit-linear-gradient(45deg, <?php echo $bgcolor3; ?> 30%, <?php echo $bgcolor1; ?>) 70%);
background: -o-linear-gradient(45deg, <?php echo $bgcolor3; ?> 30%, <?php echo $bgcolor1; ?> 70%);
background: -ms-linear-gradient(45deg, <?php echo $bgcolor3; ?> 30%, <?php echo $bgcolor1; ?> 70%);
background: linear-gradient(45deg, <?php echo $bgcolor3; ?> 30%, <?php echo $bgcolor1; ?> 70%);
-webkit-box-shadow: 0px 2px 1px rgba(50, 50, 50, 0.75);
-moz-box-shadow:    0px 2px 1px rgba(50, 50, 50, 0.75);
box-shadow:         0px 2px 1px rgba(50, 50, 50, 0.75);
}
.glossairetitre {

/*color: <?php echo $bgcolor2; ?>;*/
font-size: 26px;
padding: 10px;
margin-bottom: 5px;
text-shadow: 0px -1px 0px <?php echo $bgcolor1; ?>;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
background: <?php echo $bgcolor3; ?>;
background: -moz-linear-gradient(45deg, <?php echo $bgcolor3; ?> 30%, <?php echo $bgcolor1; ?> 70%);
background: -webkit-linear-gradient(45deg, <?php echo $bgcolor3; ?> 30%, <?php echo $bgcolor1; ?>) 70%);
background: -o-linear-gradient(45deg, <?php echo $bgcolor3; ?> 30%, <?php echo $bgcolor1; ?> 70%);
background: -ms-linear-gradient(45deg, <?php echo $bgcolor3; ?> 30%, <?php echo $bgcolor1; ?> 70%);
background: linear-gradient(45deg, <?php echo $bgcolor3; ?> 30%, <?php echo $bgcolor1; ?> 70%);
-webkit-box-shadow: 0px 2px 1px rgba(50, 50, 50, 0.75);
-moz-box-shadow:    0px 2px 1px rgba(50, 50, 50, 0.75);
box-shadow:         0px 2px 1px rgba(50, 50, 50, 0.75);
}
.containerglos {
  position: relative;
  display: inline-block;
}
.containerglos img{
 border: 1px solid <?php echo $bgcolor3; ?>;
 background: <?php echo $bgcolor1; ?>; 
 padding: 2px; 
 overflow: auto; 
 max-width: 120px;
}
.overlayglos {
  position: absolute;
  top: 0;
  right: 0;
  left: 0;
  background-color: rgba(59, 76, 126, 0.6);
  background: rgba(59, 76, 126, 0.6);   
}
.overlayglos div{
  font-family: 'Shadows Into Light', cursive;
  font-size: 15px;
  color: white;	
  padding: 3px;
  vertical-align: baseline;
  text-align: center;
}
.boutonhaut {
						
						font-family:times new roman,times,serif;
						text-align: center;
						padding: 10px 20px 10px 20px;
						-moz-box-shadow: 5px 5px 10px <?php echo $bgcolor2; ?>;
                        -webkit-box-shadow: 5px 5px 10px <?php echo $bgcolor2; ?>;
                        -o-box-shadow: 5px 5px 10px <?php echo $bgcolor2; ?>;
                        box-shadow: 5px 5px 10px <?php echo $bgcolor2; ?>;
                        -moz-border-radius: 5px;
                        -webkit-border-radius: 5px;
                        border-radius: 5px;
                        border: 1px solid <?php echo $bgcolor3; ?>;
                        background:<?php echo $bgcolor1; ?>;
                        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="<?php echo $bgcolor1; ?>", endColorstr="<?php echo $bgcolor3; ?>"); /* Pour IE seulement et mode gradient à linear */
                        background: -webkit-gradient(linear, left top, left bottom, from(<?php echo $bgcolor1; ?>), to(<?php echo $bgcolor3; ?>));
                        background: -webkit-linear-gradient(<?php echo $bgcolor1; ?>, <?php echo $bgcolor3; ?>);
                        background: -moz-linear-gradient(<?php echo $bgcolor1; ?>, <?php echo $bgcolor3; ?>);
                        background: -o-linear-gradient(<?php echo $bgcolor1; ?>, <?php echo $bgcolor3; ?>); 
                        background: -ms-linear-gradient(<?php echo $bgcolor1; ?>, <?php echo $bgcolor3; ?>); 
                        background: linear-gradient(<?php echo $bgcolor1; ?>, <?php echo $bgcolor3; ?>); 
                        text-decoration: none;
					}
                        .boutonhaut:hover {
                        background:<?php echo $bgcolor3; ?>;
                        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="<?php echo $bgcolor3; ?>", endColorstr="<?php echo $bgcolor1; ?>"); /* Pour IE seulement et mode gradient à linear */
                        background: -webkit-gradient(linear, left top, left bottom, from(<?php echo $bgcolor3; ?>), to(<?php echo $bgcolor1; ?>));
                        background: -webkit-linear-gradient(<?php echo $bgcolor3; ?>, <?php echo $bgcolor1; ?>);
                        background: -moz-linear-gradient(<?php echo $bgcolor3; ?>, <?php echo $bgcolor1; ?>);
                        background: -o-linear-gradient(<?php echo $bgcolor3; ?>, <?php echo $bgcolor1; ?>); 
                        background: -ms-linear-gradient(<?php echo $bgcolor3; ?>, <?php echo $bgcolor1; ?>); 
                        background: linear-gradient(<?php echo $bgcolor3; ?>, <?php echo $bgcolor1; ?>); 
                        text-decoration: none;

					}
</style>