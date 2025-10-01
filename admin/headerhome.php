<?php
include_once("include/includei.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tobacco Board</title>
<script type="text/javascript" src="plugins/jquery.js"></script>
<script type="text/javascript" src="plugins/cycle-plugin2.js"></script>
<link rel="stylesheet" type="text/css" href="Scripts/home.css" />
<link rel="stylesheet" type="text/css" href="Scripts/doctextsizer.css" />
<script language="JavaScript" src="mm_menu.js" type="text/javascript"></script>
<script type="text/javascript" src="Scripts/doctextsizer.js"></script>
<script language="JavaScript" type="text/javascript">
<!--
function mmLoadMenus() {
  if (window.mm_menu_0102165742_0) return;
            window.mm_menu_0102165742_0 = new Menu("root",336,25,"",12,"#FFFFFF","#FFFFFF","#3985E5","#000084","left","middle",3,0,250,-5,7,true,true,true,0,true,false);
  mm_menu_0102165742_0.addMenuItem("Fuel&nbsp;Cured&nbsp;Virginia&nbsp;(FCV)","location='tfcv.php'");
  mm_menu_0102165742_0.addMenuItem("Burley&nbsp;&&nbsp;Oriental","location='tbo.php'");
  mm_menu_0102165742_0.addMenuItem("Suncured&nbsp;Country,&nbsp;Fire&nbsp;Cured&nbsp;Kentucky&nbsp;and&nbsp;Beedi","location='tsc.php'");
  mm_menu_0102165742_0.addMenuItem("Cigar&nbsp;Varieties","location='tcigar.php'");
  mm_menu_0102165742_0.addMenuItem("Chewing&nbsp;Tobacco","location='tchewing.php'");
   mm_menu_0102165742_0.hideOnMouseOut=true;
   mm_menu_0102165742_0.bgColor='#555555';
   mm_menu_0102165742_0.menuBorder=1;
   mm_menu_0102165742_0.menuLiteBgColor='#3985E5';
   mm_menu_0102165742_0.menuBorderBgColor='#3985E5';
  window.mm_menu_0102170034_0 = new Menu("root",192,25,"",12,"#FFFFFF","#FFFFFF","#3985E7","#000084","left","middle",3,0,250,-5,7,true,true,true,0,true,false);
 mm_menu_0102170034_0.addMenuItem("FCV&nbsp;(Traditional)","location='fcvt.php'");
  mm_menu_0102170034_0.addMenuItem("FCV&nbsp;(NLS)","location='fcvn.php'");
  mm_menu_0102170034_0.addMenuItem("FCV&nbsp;(SLS)","location='fcvs.php'");
  mm_menu_0102170034_0.addMenuItem("FCV&nbsp;(Mysore)","location='fcvm.php'");
  mm_menu_0102170034_0.addMenuItem("Soil&nbsp;types&nbsp;&&nbsp;Characteristics","location='soiltypes.php'");
   mm_menu_0102170034_0.hideOnMouseOut=true;
   mm_menu_0102170034_0.bgColor='#555555';
   mm_menu_0102170034_0.menuBorder=1;
   mm_menu_0102170034_0.menuLiteBgColor='#3985E5';
   mm_menu_0102170034_0.menuBorderBgColor='#3A82E6';
    window.mm_menu_0102170607_0 = new Menu("root",187,25,"",12,"#FFFFFF","#FFFFFF","#3A82E6","#000084","left","middle",3,0,250,-5,7,true,true,true,0,true,false);
 mm_menu_0102170607_0.addMenuItem("Supply&nbsp;of&nbsp;Inputs","location='supply.php'");
  mm_menu_0102170607_0.addMenuItem("Loans&nbsp;to&nbsp;Farmers","location='loans.php'");
  mm_menu_0102170607_0.addMenuItem("Soil&nbsp;&&nbsp;Water&nbsp;Analysis","location='soil.php'");
  mm_menu_0102170607_0.addMenuItem("Growers&nbsp;Welfare&nbsp;Schemes","location='growers.php'");
  mm_menu_0102170607_0.addMenuItem("Weather&nbsp;Information","location='weather.php'");
   mm_menu_0102170607_0.hideOnMouseOut=true;
   mm_menu_0102170607_0.bgColor='#555555';
   mm_menu_0102170607_0.menuBorder=1;
   mm_menu_0102170607_0.menuLiteBgColor='#3A82E6';
   mm_menu_0102170607_0.menuBorderBgColor='#3A82E6';
  window.mm_menu_0102170722_0 = new Menu("root",199,25,"",12,"#FFFFFF","#FFFFFF","#3985E7","#000084","left","middle",3,0,250,-5,7,true,true,true,0,true,false);
  mm_menu_0102170722_0.addMenuItem("Farm&nbsp;Mechanisation","location='farmm.php'");
  mm_menu_0102170722_0.addMenuItem("Yield&nbsp;&&nbsp;quality&nbsp;Improvement","location='yield.php'");
  mm_menu_0102170722_0.addMenuItem("Supply&nbsp;of&nbsp;Inputs","location='supplyofin.php'");
  mm_menu_0102170722_0.addMenuItem("Curing&nbsp;of&nbsp;Tabacco","location='gcuringot.php'");
  mm_menu_0102170722_0.addMenuItem("Transfer&nbsp;of&nbsp;Technology","location='transferot.php'");
  mm_menu_0102170722_0.addMenuItem("Awards&nbsp;to&nbsp;Growers","location='awardstg.php'");
   mm_menu_0102170722_0.hideOnMouseOut=true;
   mm_menu_0102170722_0.bgColor='#555555';
   mm_menu_0102170722_0.menuBorder=1;
   mm_menu_0102170722_0.menuLiteBgColor='#3985E5';
   mm_menu_0102170722_0.menuBorderBgColor='#3A82E6';

      window.mm_menu_0118174322_0 = new Menu("root",184,25,"",12,"#FFFFFF","#FFFFFF","#3985E5","#000084","left","middle",3,0,250,-5,7,true,true,true,0,true,false);
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

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div id="logoheader">
      <div class="logoleft"><img src="../img/logo.png" alt="Indian Tobacco" title="Indian Tobacco" width="475" height="93" /></div>
      <div class="logoright">
        <div class="group1">
          <form id="form1" name="form1" method="post" action="">
            <input type="text" name="textfield" />
            <input type="submit" name="Submit" value="Search" />
          </form>
        </div>
        <div class="group2"><a href="#" class="texttoggler" rel="smallview" title="small size"><img src="tob2_imgs/smallview.png" width="20" height="17" border="0"  alt="small" title="Small"/></a><a href="#" class="texttoggler" rel="normalview" title="normal size"><img src="tob2_imgs/normalview.png" width="20" height="17" border="0" alt="Normal" title="Normal" /></a><a href="#" class="texttoggler" rel="largeview" title="large size"><img src="tob2_imgs/largeview.png" width="20" height="17" border="0" alt="Large" title="Large" /></a> <a href="hindi/default.php"><img src="tob2_imgs/hindi.jpg" alt="Hindi Language" width="61" height="17" border="0" title="Hindi Language" /></a>
              <script type="text/javascript">
//documenttextsizer.setup("shared_css_class_of_toggler_controls")
documenttextsizer.setup("texttoggler")

  </script>
        </div>
      </div>
    </div>
        <div id="menu">
          <div align="center"><span class="navigat"><a class="nav" href="default.php">Home</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="nav" href="tfcv.php" name="link6" id="link1" onmouseover="MM_showMenu(window.mm_menu_0102165742_0,0,20,null,'link6')" onmouseout="MM_startTimeout();">Tobacco Varieties </a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="nav" href="fcvt.php" name="link9" id="link2" onmouseover="MM_showMenu(window.mm_menu_0102170034_0,0,20,null,'link9')" onmouseout="MM_startTimeout();">FCV Tobacco</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="nav" href="supply.php" name="link8" id="link4" onmouseover="MM_showMenu(window.mm_menu_0102170607_0,0,20,null,'link8')" onmouseout="MM_startTimeout();">Services of FCV Farmers</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="nav" href="farmm.php" name="link3" id="link5" onmouseover="MM_showMenu(window.mm_menu_0102170722_0,0,20,null,'link3')" onmouseout="MM_startTimeout();">Extension Services</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="auctionsystem.php" name="link11" class="nav" id="link7" onmouseover="MM_showMenu(window.mm_menu_0118174322_0,0,20,null,'link11')" onmouseout="MM_startTimeout();">Auctions</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="nav" href="export_per.php">Export Performance</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="nav" href="contactus.php">Contact Us</a></span></div>
        </div></td>
  </tr>
  <tr>
    <td height="129" background="tob2_imgs/animation_bg.jpg"><table width="100%" height="129px" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="129" background="tob2_imgs/animation_background.jpg"><table width="980" height="129px" border="0" align="left" cellpadding="0" cellspacing="0">
          <tr>
            <?php
	  	$sselect=executework("select * from tob_imageslide order by id");
		$i=1;$speed=2500;
		while($srow=@mysqli_fetch_array($sselect))
		{
	  ?>
            <td><div id="fade<?php echo $i; ?>" style="float-left; z-index:0; height:129px;" > <img height="129px" src="admin/slide_images/<?php echo $srow[image1]; ?>" /> <img height="129px" src="admin/slide_images/<?php echo $srow[image2]; ?>" /> </div>
                <script type="text/javascript">
	var speed1=2500;
	$('#fade<?php echo $i?>').cycle({ 
		fx:    'fade', 
		speed:  <?php echo $speed;?> 
	 });
          </script>
            </td>
            <?php
	  		$i++;
			$speed=$speed+500;
	  	}
	  ?>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
