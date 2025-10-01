<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style2 {font-family: Arial, Helvetica, sans-serif; font-size: 20px; color: #327DC0;}
.style9 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold; color: #FFFFFF; }
.style10 {color: #FFFFFF}
a.a:link {
	color: #FFFFFF;
	text-decoration: none;
}
a.a:visited {
	color: #FFFFFF;
	text-decoration: none;
}
a.a:hover {
	color: #FFFFFF;
	text-decoration: none;
}
a.a:active {
	color: #FFFFFF;
	text-decoration: none;
}

-->
</style>
<script language="JavaScript">
<!--
function mmLoadMenus() {
  if (window.mm_menu_0118120323_0) return;
            window.mm_menu_0118120323_0 = new Menu("root",113,24,"Arial, Helvetica, sans-serif",12,"#FFFFFF","#FFFFFF","#333399","#333399","left","middle",6,1,1000,-5,7,true,false,true,0,true,true);
  mm_menu_0118120323_0.addMenuItem("Upload&nbsp;Album","location='photogallery.php'");
  mm_menu_0118120323_0.addMenuItem("View&nbsp;Album","location='imagelist.php'");
   mm_menu_0118120323_0.fontWeight="bold";
   mm_menu_0118120323_0.hideOnMouseOut=true;
   mm_menu_0118120323_0.bgColor='#555555';
   mm_menu_0118120323_0.menuBorder=1;
   mm_menu_0118120323_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0118120323_0.menuBorderBgColor='#777777';

      window.mm_menu_0206194126_0 = new Menu("root",140,24,"Arial, Helvetica, sans-serif",12,"#FFFFFF","#FFFFFF","#333399","#333399","left","middle",6,1,1000,-5,7,true,false,true,0,true,true);
  mm_menu_0206194126_0.addMenuItem("Add&nbsp;Platform","location='platform.php'");
  mm_menu_0206194126_0.addMenuItem("Auctions","location='auctions.php'");
  mm_menu_0206194126_0.addMenuItem("Export&nbsp;Performance","location='export_per.php'");
   mm_menu_0206194126_0.fontWeight="bold";
   mm_menu_0206194126_0.hideOnMouseOut=true;
   mm_menu_0206194126_0.bgColor='#555555';
   mm_menu_0206194126_0.menuBorder=1;
   mm_menu_0206194126_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0206194126_0.menuBorderBgColor='#777777';

mm_menu_0206194126_0.writeMenus();
} // mmLoadMenus()
//-->
</script>
<script language="JavaScript" src="mm_menu.js"></script>
</head>

<body>
<script language="JavaScript1.2">mmLoadMenus();</script>
<table width="1100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="412" background="tob2_imgs/logo_bg1.jpg"><img src="../img/logo.png" width="475" height="93" /></td>
    <td width="568" background="tob2_imgs/logo_bg1.jpg"><div align="center" class="style2">TOBACCO BOARD ADMIN </div></td>
  </tr>
  <tr>
    <td colspan="2" height=""><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <?php
		if(!empty($_SESSION['tobadmin']))
		{
	?>
      <tr bgcolor="#333399" height="40">
        <td width="7%"><div align="center" class="style9"><a href="adminmain.php" class="a">Home</a></div></td>
        <td width="9%"><div align="center" class="style9"><a href="tenders.php" class="a">Tenders</a></div></td>
        <td width="12%"><div align="center" class="style9"><a href="news.php" class="a">News &amp; Events</a> </div></td>
        <td width="10%"><div align="center" class="style9"><a href="statistics.php" class="a">Statistics</a></div></td>
        <td width="10%"><div align="center" class="style9"><a href="circulars.php" class="a">Circulars</a></div></td>
        <td width="14%" class="style9"><div align="center"><a href="#" name="link2" id="link1" onmouseover="MM_showMenu(window.mm_menu_0118120323_0,10,20,null,'link2')" onmouseout="MM_startTimeout();" class="a">Photo Gallery</a> </div></td>
        <td width="10%" class="style9"><div align="center"><a href="#" name="link5" class="a" id="link3" onmouseover="MM_showMenu(window.mm_menu_0206194126_0,0,17,null,'link5')" onmouseout="MM_startTimeout();">Graphs</a></div></td>
        <td width="16%" class="style9"><div align="center"><a href="changepassword.php" class="a">Change Password</a> </div></td>
        <td width="11%" class="style9"><div align="center"><a href="logout.php" class="a">Logout</a></div></td>
        <td width="1%">&nbsp;</td>
      </tr>
      <?php
		}
		else
		{
	?>
      <tr bgcolor="#333399" height="40">
        <td bgcolor="#333399">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td class="style9">&nbsp;</td>
        <td class="style9">&nbsp;</td>
        <td class="style9">&nbsp;</td>
        <td class="style9">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <?php
		}
	?>
    </table>