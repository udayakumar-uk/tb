<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");

$selcont=executework("select * from tob_cms where pageid=29");
$rowc=@mysqli_fetch_array($selcont);
/*<!--print_r($rowc);-->*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tobacco Board, Guntur</title>
<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
</head>
<body>
<a name="top" id="top"></a>
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><img src="tob2_imgs/spacer.png" width="1" height="2" /></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><div id="head"><?php include_once("header.php");?></div></td>
  </tr>
  <tr>
    <?php
		if(empty($_GET['prin']))
		{
	?>
	 <td width="225" rowspan="2" valign="top" bgcolor="#ededed" >
	<?php include_once("leftmenu.php")
  ?>	</td>
    <?php
		}
	?>
    <td colspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tabbor">
      <tr>
        <td width="92%" height="25" bgcolor="#e7e6e6"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td><div class="breadcrumb flat"> <a href="#" class="active">&#2361;&#2379;&#2350;</a> <a href="#">&#70;&#67;&#86; &#2313;&#2340;&#2381;&#2346;&#2366;&#2342;&#2325;&#2379;&#2306; &#2325;&#2379; &#2360;&#2375;&#2357;&#2366;&#2319;&#2306;</a> <a href="#">&#2310;&#2342;&#2366;&#2344;&#2379;&#2306; &#2325;&#2368; &#2310;&#2346;&#2370;&#2352;&#2381;&#2340;&#2367;</a> </div>
                  <script src="js/crumb.js" type="text/javascript">
                  </script>

              </td>
            </tr>
        </table></td>
        <td width="8%" bgcolor="#e7e6e6"><?php
		   		if(empty($_GET['prin']))
				{
		   ?>
            <a href="#" onclick="MM_openBrWindow('bactivities.php?prin=y','','width=800,height=600')"><img src="tob2_imgs/printButton.gif" border="0" /></a> <a href="#" onclick="MM_openBrWindow('input.php?prin=y','','width=800,height=600')">Print</a>
            <?php
		   		}
		   ?>
        </td>
      </tr>
    </table>
      <br />
      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30" align="justify"><div class="rightcorner1">
           <div class="innercontent">
            <div id="innermenu" class="innermenbox"></div>
            <p><?php echo $rowc['hcontent'] ?>            </p>
            <p>&nbsp;</p>
           </div>
          <a href="javascript:window.print()" target="_blank"></a> </div></td>
      </tr>
      <tr>
        <!--<td height="30" align="justify" valign="top"><p align="justify"><strong><u><a name="input" id="input"></a><img align="right" src="img/input.jpg" width="184" height="125" border="0" />Input Management / Linkages:</u></strong></p>
          <p align="justify"><strong>Co ordination with Banks: </strong><br />
            Board organises input loans to the registered growers in Andhra Pradesh and Karnataka through nationalised banks at competitive rate of interest.</p>
          <p align="justify">&nbsp;</p>
          <p align="justify"><strong><u><a name="gap" id="gap"></a><img align="right" src="img/gap.jpg" width="184" height="116" />Good Agricultural Practices: </u></strong></p>
          <p align="justify">The concept of GAP&rsquo;s aims at ensuring sustainable, economically viable production of usable Tobacco and defined as &ldquo;Agricultural Practices which produce a quality crop while protecting, sustaining or enhancing the environment with regard to soil, water, air, animal and plant life&rdquo;.</p>
          <p align="justify">&nbsp;</p>
          <p align="justify"><strong><u><a name="swm" id="swm"></a>Crop Developmental Activities:</u></strong><br />
            <br />
              <strong>Soil &amp; Water Management</strong><br />
            <br />
            <img src="img/cda.jpg" align="right" width="194" height="130" />The Board every year extends the services of analysing soil and water samples collected from growers fields to advise growers on suitability of soil and irrigation water used for Tobacco Cultivation and thereby avoiding cultivation in soils with high chloride contents.<br />
            Based on the soil sample analysis, the growers are recommended on required dosages of fertilizers to be applied to produce quality leaf and improve yields and thereby obtain remunerative returns.<br />
            Board is having two soil Testing Laboratories one at Ongole in Andhra Pradesh and another at Periyapatna in Karnataka <br />
          </p>
          <p align="justify"><strong> <br />
              <a name="sh" id="sh"></a><img src="img/sh.jpg" width="193" height="124" align="right" />Soil Health</strong></p>
          <p align="justify">For improvement of Soil Organic Carbon in the soil, and there by enhance the soil health, Board is encouraging the growers for insitu green manuring with green manure crops like Sunnhemp, Diancha, Pillipeesara<br />
              <br />
          </p>
          <p align="justify"><strong><a name="vis" id="vis"></a>Variety Integrity and Selection</strong></p>
          <p align="justify">Tobacco Board organises supply of quality seed every year to the growers in time in the states of Andhra Pradesh and Karnataka through its Auction Platforms procuring the same from CTRI, Rajahmundry and M/s. ITC Ltd., - ABD &ndash;ILTD, Guntur</p>
          <p align="justify"><br />
              <br />
              <strong><u><a name="cm" id="cm"></a>Crop Management</strong> - 
              <strong>Supply of Inputs</strong><br /></u>
            <br />
              <strong>Seedlings &ndash; Produttion of uniform/healthy seedlings:</strong></p>
          <p align="justify"><img src="img/cm.jpg" width="187" height="193" align="right" />The Board organizing supply of Trays along with Cocopeat media to Tobacco growers in Andhra Pradesh and Karnataka at competitive prices by extending subsidy to raise healthy seedlings.<br />
            <br />
              <strong>Integrated Nutrient Management through Balanced Fertilization:</strong><br />
            <br />
            The Board procures recommended fertilizers to FCV Tobacco at competitive prices directly from manufacturing companies and supplies to growers in Andhra Pradesh and Karnataka in right time by arranging input loans at competitive rate of interest.</p>
          <p align="justify"><br />
            <br />
            <strong>Other Inputs</strong><br />
            <br />
            <img src="img/oi.jpg" width="191" height="175" align="right" />As a part of Integrated Pest Management, Board supplying Pheromone Traps/Yellow sticky traps/Light Traps to registered growers in Andhra Pradesh and Karnataka at competitive prices by extending subsidy to some extent on the price of input arranged<br />
            Board is organizing supply of Farm Mechanising implements like Bullock Drawn Ridgers, Tyne Cultivators, PVC Pipes, Weighing Scales, to help the farmers in certain areas of operation by supplying these inputs at competitive prices and extending subsidy </p>
          <p align="justify"><br />
          </p>
          <p align="justify"><strong><u><a name="acm" id="acm"></a>Agro Chemical Management</u></strong></p>
          <p align="justify"><strong>Pesticide Residual Analysis/Chemical Analysis of leaf samples: </strong><br />
            <br />
            Every year Board collecting leaf samples from each cluster under each  platform jurisdiction in Andhra Pradesh and Karnataka and getting analysed at NIPHM, Hyderabad and CTRI, Rajahmundry to detect pesticide residues and chemical constituents for identification of problematic areas and rectifying the problems by educating the growers by conducting awareness/Training Programmes</p>
          <p align="justify"><strong>Bio pesticides</strong><br />
            <br />
            Board is supplying bio pesticides to growers as a part of Integrated Pest Management for control of soil borne diseases in collaboration with NIPHM, Hyderabad by extending subsidy.<br />
            <br />
            <strong><u><a name="cbm" id="cbm"></a>Curing and Barn Management</u></strong><br />
            <br />
            <strong>Curing designs for energy conservation</strong><br />
            <br />
            <strong><img src="img/cbm.jpg" width="185" height="188" align="right" /></strong>Board is encouraging growers to go for energy conservation measures like fixing ventury furnace in barn and undertaking Glasswool barn insulation to coverage energy saving upto 15 to 20%. Board extending subsidy to the eligible growers for undertaking energy conservation measures.<br />
            <br />
            <strong>Curing fuels</strong><br />
            -	Encouraging growers to raise their own fuel.<br />
            -	Advising growers to load uniformly the barn to conserve fuel.<br />
            -	Board supplying curometers on 100 % subsidy to control temperature and avoid waste of fuel and to optimize leaf quality and yield. </p>
          <p align="justify"><br />
          </p>
          <p align="justify"><strong><u><a name="ofts" id="ofts"></a>On Farm Tobacco Storage &ndash; Post Harvest Product Management &ndash; Construction of Bulking Sheds</u></strong><br />
            <br />
            <img src="img/of.jpg" width="185" height="131" align="right" />The cured tobacco unloaded from the barns requires to be bulked properly to facilitate fermentation process and improve in quality before it is graded and packed in bales. <br />
          </p>
          <p align="justify">Board is arranging Medium Term Loans to the growers through banks for construction of bulking sheds of different dimensions and extend subsidy.<br /> 
            <br />
            <strong><a name="entrm" id="entrm"></a>Elimination of Non Tobacco Related Material (NTRM)/ Foreign matter - Supply of Tarpaulins</strong><br />
            <br />
            <img src="img/nt.jpg" width="185" height="131" align="right" />The customers for Indian Tobacco are particular about admixture of NTRMs   in the Tobacco. The Board is providing Tarpaulins to growers to remove all forms of NTRM from Tobacco at competitive prices and also extending subsidy to eligible growers.</p>
          <p align="justify">&nbsp;</p>
          <p align="justify">&nbsp;</p>
          <p align="justify"><strong><u><a name="oft" id="oft"></a>Farmer Training</u></strong><br />
            <br />
            <img src="img/ft.jpg" width="528" height="216" align="right" />Training programmes are organized by Board to farmers and technical staff covering all crop developmental activities through scientist farmer interface meetings in collaboration with CTRI, Rajahmundry, NIPHM, Hyderabad, field days, workshops, study tours, Group Meetings, awareness programmes:<br />
            <br />
            -	Seed bed preparation<br />
            -	Nursery Management<br />
            -	Transplanting and GAP fillings<br />
            -	Integrated Nutrient Management through balanced fertilizer applicaton.<br />
            -	Intercultural operations.<br />
            -	Integrated Pest Management covering application of bio pesticides and management of CPA residues.<br />
            -	Topping/de suckering<br />
            -	Harvesting, Curing, Grading.<br />
            <br />
            <strong><img src="img/oft.jpg" width="275" height="156" align="right" /><u>On Farm Trials</u></strong><br />
            <br />
            To sensitize farmers on adoption of GAP&rsquo;s and disseminate the results among the growers, Board is undertaking result demonstrations in willing farmers fields under each Auction Platform every year in Andhra Pradesh and Karnataka.</p>
          <p align="justify">The growers in whose fields the &lsquo;OFT&rsquo; were carried out were given cash incentives by the Board. </p>
          <p align="justify"><br />
          </p>
          <p align="justify"><strong><u><a name="mpa" id="mpa"></a><img src="img/mp.jpg" width="275" height="156"  align="right"/>Model Project Area</u></strong><br />
            <br />
            To enhance productivity and quality of Tobacco through intensive extension programmes Board is implementing this scheme by selecting one village(Low Production areas) covering approximately an area of 100 ha under each light soil auction platform and implementing GAP&rsquo;s and extending subsidies to certain inputs to the growers in the &lsquo;MPA&rsquo; village. <br />
          </p>
          <p align="justify"></p></td>-->
      </tr>
      <tr>
        <td height="30" align="justify">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
    <?php
  	if(empty($_GET['prin']))
	{
  ?>
  <tr>
    <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="2" valign="top"><table width="100%" border="0">
      <tr>
        <td width="47%">&nbsp;</td>
        <td width="33%">&nbsp;</td>
        <td width="20%"><div align="right"><a href="#top" ><img src="tob2_imgs/bact2top.jpg" width="94" height="27" border="0" title="Back to top" alt="Back to Top" /></a></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><img src="tob2_imgs/spacer.png" width="220" height="1" /></td>
    <td width="831" valign="top"><img src="tob2_imgs/spacer.png" width="535" height="1" /></td>
    <td width="263" valign="top"><img src="tob2_imgs/spacer.png" width="225" height="1" /></td>
  </tr>
    <?php
  	}
  ?>
  <tr>
    <td colspan="3" valign="top"><div id="footer"><?php include_once("footer.php");?></div></td>
  </tr>
</table>
</body>
</html>
