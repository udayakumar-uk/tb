<?php
include_once("include/includei.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Tobacco Board</title>
<link rel="stylesheet" type="text/css" href="Scripts/home.css" />
<link rel="stylesheet" type="text/css" href="Scripts/doctextsizer.css" />
<script language="JavaScript" src="mm_menu.js" type="text/javascript"></script>
<script type="text/javascript" src="plugins/jquery.js"></script>
<script type="text/javascript" src="plugins/cycle-plugin2.js"></script>
<script type="text/javascript" src="Scripts/doctextsizer.js"></script>
<script language="JavaScript" type="text/javascript">
<!--
function mmLoadMenus() {
  if (window.mm_menu_0118174322_0) return;
                window.mm_menu_0118174322_0 = new Menu("root",184,25,"",12,"#FFFFFF","#FFFFFF","#3985E5","#000084","left","middle",3,0,250,-5,7,true,true,true,0,true,false);
 mm_menu_0118174322_0.addMenuItem("Auction&nbsp;System","location='auctionsystem.php'");
  mm_menu_0118174322_0.addMenuItem("Auction&nbsp;Platform","location='aplatform.php'");
  mm_menu_0118174322_0.addMenuItem("Auction&nbsp;Procedure","location='aprocedures.php'");
  mm_menu_0118174322_0.addMenuItem("Buyers&nbsp;Participation","location='buyersparticipation.php'");
  mm_menu_0118174322_0.addMenuItem("Auction&nbsp;Achievements","location='aachievements.php'");
  mm_menu_0118174322_0.addMenuItem("Electronic&nbsp;Auction&nbsp;system&nbsp;","location='eauction.php'");
   mm_menu_0118174322_0.hideOnMouseOut=true;
   mm_menu_0118174322_0.bgColor='#555555';
   mm_menu_0118174322_0.menuBorder=1;
   mm_menu_0118174322_0.menuLiteBgColor='#3985E5';
   mm_menu_0118174322_0.menuBorderBgColor='#3A82E6';

mm_menu_0118174322_0.writeMenus();
} // mmLoadMenus()
//-->
</script>
</head>

<body>
  <script language="JavaScript1.2" type="text/javascript">mmLoadMenus();</script>
<script type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
function prin()
{
	document.getElementById("head").style.display="none";
	document.getElementById("innermenu").style.display="none";
	document.getElementById("footer").style.display="none";
	window.print();
	window.close();
}//-->
</script>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div id="logoheader">
      <div class="logoleft"><img src="tob2_imgs/tblogo.jpg" alt="Indian Tobacco" title="Indian Tobacco" width="475" height="93" /></div>
<div class="logoright">
        <div class="navigat"><?php if($_SESSION['tobacco']!="") { ?><a href="logoutad.php">Logout</a><?php } ?></div>
</div>
</div>
        </td>
  </tr>
</table>
</body>
</html>
