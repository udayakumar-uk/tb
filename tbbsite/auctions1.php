<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/include.php");
?>
<link rel="stylesheet" href="css/zerogrid.css">
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
	<link rel="stylesheet" href="css/responsiveslides.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/responsiveslides.js"></script>
	<script>
    $(function () {
      $("#slider").responsiveSlides({
        auto: true,
        pager: true,
        nav: true,
        speed: 500,
        maxwidth: 800,
        namespace: "centered-btns"
      });
    });
  </script>
<!--<style>
.dropbtn {
   /* background-color: #4CAF50;*/
    color: white;
  /*  padding: 16px;*/
    font-size: 13px;
    border: none;
    cursor: pointer;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #003300;
    min-width: 190px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color:#fff;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {background-color: #669900}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
  /*  background-color: #3e8e41;*/
}
.bottom a{
padding:5px;
color:#950C16;
font-size:12px;
}
.bottom{
border-bottom:2px solid #bd6424;
}
.bottom1 a{
padding:5px;
color:#0f5f17;
font-size:12px;
}
.bottom2{
    background-color: #0f5f17;
    border-radius: 7px;
    width: 100%;
    padding: 8px;
	margin-bottom:5px;
}
.bottom2 a{
padding:0 5px;
color:#fff;
font-size:12px;
}
.bottom3 {
padding:5px;
color:#666;
font-size:12px;
}

.holder {
    background-color: #eee;
    width: 440px;
    overflow: hidden;
    padding: 10px;
    font-family: Helvetica;
    height: 205px;
}
.holder .mask {
  position: relative;
  left: 0px;
  top: 10px;
  width:440px;
  height:205px;
  overflow: hidden;
}
.holder ul {
  list-style:none;
  margin:0;
  padding:0;
  position: relative;
}
.holder ul li {
 padding: 3px 0px;
border-bottom: 1px solid #ccc;
}
.holder ul li a {
  color:#413c3c;
  text-decoration:none;
  font-size:12px;
}
.gal img{
border: #999 5px solid;
margin:5px 2px;
}
ul.list li a {
    font-size: 13px;
    color: #686666;
    line-height: 25px;
}
.main-content article {
    margin: 0 0 10px 0;
    overflow: hidden;
    position: relative;
}
.sidebar section {
    margin-bottom: 0px;
}
.sidebar .content {
    padding: 10px;
}
</style>-->    
<style>
.dropbtn {
   /* background-color: #4CAF50;*/
    color: white;
  /*  padding: 16px;*/
    font-size: 13px;
    border: none;
    cursor: pointer;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #003300;
    min-width: 190px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color:#fff;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {background-color: #669900}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
  /*  background-color: #3e8e41;*/
}
.bottom a{
padding:5px;
color:#950C16;
font-size:12px;
}
.bottom{
border-bottom:2px solid #bd6424;
}
.bottom1 a{
padding:5px;
color:#0f5f17;
font-size:12px;
}
.bottom2{
    background-color: #0f5f17;
    border-radius: 7px;
    width: 100%;
    padding: 8px;
	margin-bottom:5px;
}
.bottom2 a{
padding:0 5px;
color:#fff;
font-size:12px;
}
.bottom3 {
padding:5px;
color:#666;
font-size:12px;
}

.navbar-inverse .navbar-nav > .active > a, .navbar-inverse .navbar-nav > .active > a:focus, .navbar-inverse .navbar-nav > .active > a:hover {
    color: #fff;
    background-color: transparent;
}
.navbar-nav > li > a {
    padding-top: 1px;
    padding-bottom: 1px;
}
.navbar-collapse {
    padding-right: 0;
    padding-left: 0px;
	}
	.container-fluid {
    padding-right: 0;
    padding-left: 0;
    margin-right: auto;
    margin-left: auto;
}

.navbar {
    position: relative;
    min-height: 40px;
    margin-bottom: 2px;
    border: 1px solid transparent;
       
}
.navbar-inverse .navbar-nav > li > a{
color:#fff;
}

.nav > li > a {
    position: relative;
    display: block;
    padding: 2px 6px;
	}
.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 160px;
    padding: 5px 0;
    margin: 2px 0 0;
    font-size: 14px;
    text-align: left;
    list-style: none;
    background-color: #003300;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: 1px solid #ccc;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: 4px;
     -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
    box-shadow: 0 6px 12px rgba(0,0,0,.175);
}	
.dropdown-menu > li > a:focus, .dropdown-menu > li > a:hover {
    color: #fff;
    text-decoration: none;
    background-color: #669900;
	
}
.dropdown-menu > li > a{
color:#fff;
}
.navbar-inverse .navbar-nav > .open > a, .navbar-inverse .navbar-nav > .open > a:focus, .navbar-inverse .navbar-nav > .open > a:hover {
    color: #fff;
    background-color: #003300;
}
.h2, h2 {
    font-size: 15px;
	font-weight:bold;
	padding:5px;
}

.navbar-inverse {
    background-color: transparent;
    border-color: #fff;
}
.navbar-toggle {
background:#333;
}
.headtitles {
    color: #a05404;
    font-size: 20px;
    line-height: 40px;
}
/*.topnav {
  overflow: hidden;
  background-color: #333;
  width:100%;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav .icon {
  display: none;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }

}*/
.breadcrumb {
    padding: 5px 1px;
    margin-bottom: 5px;
    list-style: outside none none;
    background-color:#fff;
    border-radius: 4px;
}

</style>
<?php
$qry=''; $qry1='';
	function datepattrn($a)
	{
 		$b = substr($a,5, 2);// month
 		$c = substr($a,7, 1);// '-'
		$d= substr($a,8, 2);// day
		$e = substr($a,4, 1);// '-'
 		$f = substr($a,0, 4);// year
		$c="-";
		$e="-";
		$g=$d."/".$b."/".$f;
		return $g;
	}
	function datepattrn1($a)
	{
 		$b = substr($a,3, 2);// month
 		$c = substr($a,2, 1);// '-'
		$d= substr($a,0, 2);// day
		$e = substr($a,5, 1);// '-'
 		$f = substr($a,6, 4);// year
		$c="-";
		$e="-";
		$g=$f."/".$b."/".$d;
		return $g;
	}

$seldst=executework("select * from tob_gsettings where graph='Action Graph'");
$rowg=@mysqli_fetch_array($seldst);
if(!empty($_POST['state']))
$stat=$_POST['state'];
else
$stat=$rowg['dstate_graph'];

if(!empty($_POST['platform']))
{
	$plats=implode('^',$_REQUEST['platform']);
	$plats1=implode(',',$_REQUEST['platform']);
}
if(!empty($plats))
{
	$qry=" and id in (".$plats1.")";
}

//$seldat=executework("select tob_auction.tdate from tob_platform,tob_auction where tob_platform.id=tob_auction.platf and tob_platform.id=".$row['id']." and tob_auction.year=".$yr." order by tob_auction.tdate");

if(!empty($_POST['pdate']))
{
	$qdate=datepattrn1($_POST['pdate']);
	$qdate1=$_POST['pdate'];
	$yr=substr($qdate,0,4);
}
else
{
	$yr=date('Y');
	$seldat=executework("select tdate from tob_auction where isactive=1".$qry." order by tdate desc limit 1");
	$rowdt=@mysqli_fetch_array($seldat);
	$qdate1=datepattrn($rowdt['tdate']);
}
if(!empty($qdate))
{
	$qry1=" and tob_auction.tdate<='".$qdate."'";
}

$selplat1=executework("select * from tob_platform where state='".$stat."' and isactive=1 order by catg, platform");
$cntp1=@mysqli_num_rows($selplat1);
$u=0;
while($row1=@mysqli_fetch_array($selplat1))
{
	$catg=$row1['catg'];
	$plat1[$u]=array($row1['id'],$row1['platform'],$catg);
	$u++;
}
$selplat=executework("select * from tob_platform where state='".$stat."' and isactive=1".$qry." order by platform");
$cntp=@mysqli_num_rows($selplat);
$t=0;
$str="";

$tqty="";
$tval="";
//$dt=" and cdate!='0000-00-00' and aprice>0";
//if(empty($_POST['tp']) || $_POST['tp']=='q')
//$dt=" and (tob_auct.cdate!='0000-00-00' OR tob_auct.cdate!='') and tob_auction.aprice>0";
//else
$dt=" and tob_auction.aprice>0";

while($row=@mysqli_fetch_array($selplat))
{
	$plat[$t]=array($row['id'],$row['platform']);
	//$selqdat=executework("select tdate,aprice,cprice,qsold from tob_platform,tob_auct,tob_auction where tob_platform.id=tob_auction.platf and tob_auct.platf=tob_auction.platf and tob_auct.year=tob_auction.year and tob_platform.id=".$row['id'].$qry1.$dt." order by tob_auction.tdate desc");
	$selqdat=executework("select tdate,aprice,cprice,qsold from tob_platform,tob_auction where tob_platform.id=tob_auction.platf and tob_platform.id=".$row['id'].$qry1.$dt." order by tob_auction.tdate desc");
		//echo "<br><br>select tdate,aprice,cprice,qsold from tob_platform,tob_auction where tob_platform.id=tob_auction.platf and tob_platform.id=".$row['id'].$qry1.$dt." order by tob_auction.tdate desc";
//	$selqdat=executework("select tdate,aprice,qsold from tob_platform,tob_auction where tob_platform.id=tob_auction.platf and tob_platform.id=".$row['id']." and tob_auction.year=".$yr.$qry1.$dt." order by tob_auction.tdate");
	$cntd=@mysqli_num_rows($selqdat);
	if($cntd>0)
	{
		$k=0;
		$str1="";
		$st1="";
		$st2="";
		$st3="";
		$qty=0;
		$vald=0;
		while($rowqd=@mysqli_fetch_array($selqdat))
		{
		
				$selsum=executework("select sum(qsold) as qs,sum(tvalue) as tv from tob_auction where tdate<='".$rowqd['tdate']."' and platf=".$row['id']);
				//echo "<br>select sum(qsold) as qs,sum(tvalue) as tv from tob_auction where tdate<='".$rowqd['tdate']."' and platf=".$row['id'];
				$rowsm=@mysqli_fetch_array($selsum);
				$ctval=$rowsm['tv'];
				$cqs=$rowsm['qs'];
				if($cqs>0)
				$cprice=$ctval/$cqs;
				else
				$cprice=0;
			//echo "cprc=".$cprice;
			if($rowqd['aprice']>0)
			{
				$dates[$t]['d'][$k]=$rowqd['tdate'];
				$dates[$t]['v'][$k]=round($cprice);
				if($st1=="")
				$st1=$rowqd['tdate'];
				else
				$st1=$st1."^".$rowqd['tdate'];
	
				if($st2=="")
				$st2=round($rowqd['aprice']);
				else
				$st2=$st2."^".round($rowqd['aprice']);
				
				if($st3=="")
				$st3=round($cprice);
				else
				$st3=$st3."^".round($cprice);
				
				
				$qty=$qty+$rowqd['qsold'];
				$vald=$vald+($rowqd['qsold']*$rowqd['aprice']);
				$k++;
			}
		}
		if($tqty=="")
		$tqty=$qty;
		else
		$tqty=$tqty.":".$qty;
		
		if($qty>0)
		$val=$vald/$qty;
		else
		$val=0;
		
		if($tval=="")
		$tval=round($val);
		else
		$tval=$tval.":".round($val);

		if($str=="")
		$str=$row['platform']."*".$st1."*".$st2."*".$st3;
		else
		$str=$str."~".$row['platform']."*".$st1."*".$st2."*".$st3;
		
		if(empty($st))
		$st=$row['platform'];
		else
		$st=$st.":".$row['platform'];
		
		if(empty($td))
		$td=$st1;
		else
		$td=$td.":".$st1;
		
		if(empty($prc))
		$prc=$st2;
		else
		$prc=$prc.":".$st2;

		if(empty($aprc))
		$aprc=$st3;
		else
		$aprc=$aprc.":".$st3;
	}
	$t++;
}
if(!empty($stat))
$mn1=$stat;
if($mn1=='Andhra Pradesh')
{
	$ap="checked=true";
	$kt="";
}
else if($mn1=='Karnataka')
{
	$ap="";
	$kt="checked=true";
}

//echo "aprc=".$aprc;
//echo "<br>prc=".$prc;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>FCV Tobacco Auctions  | Tobacco Board, Guntur</title>

<style type="text/css">
<!--
.style38 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
-->
</style>
    <link class="include" rel="stylesheet" type="text/css" href="jqplot1/jquery.jqplot.min.css" />
    <script class="include" type="text/javascript" src="jqplot1/jquery.min.js"></script>
<script src="jquery.ui-1.5.2/ui/ui.datepicker.js" type="text/javascript"></script>
<link href="jquery.ui-1.5.2/themes/ui.datepicker.css" rel="stylesheet" type="text/css" />
</head>
<script language="javascript">
function toggle_forms(st,frm)
{
	document.getElementById(frm).action=st;
	document.getElementById(frm).submit();
}
function checkAll(formname, checktoggle)
{
  var checkboxes = new Array(); 
  checkboxes = document[formname].getElementsByTagName('input');
  for (var i=0; i<checkboxes.length; i++)  {
    if (checkboxes[i].type == 'checkbox')   {
      checkboxes[i].checked = checktoggle;
    }
  }
  if(checktoggle=='true')
  document[formname].submit();
}
function subform()
{
	checkAll('actn','');
//	document.getElementById("platform[]").checkedvalue="";
	document.actn.submit();
}

function chkcatg(chk)
{
	var cls=$(chk).val();
	var chkd=$(chk).prop("checked");
	
	if(chkd)
	$('.'+cls).prop("checked",true);
	else
	$('.'+cls).prop("checked",false);
	document.actn.submit();
}
</script>
<body>
<?php
?>
<?php include "tb_header.php"; ?>		
<!--------------Content--------------->
<section id="content">
	<div class="zerogrid">
		<div class="row block">
		<?php include "tb_leftmenu.php"; ?>
			<div class="main-content col11">
				<article>
				<!--<h2 style="border-bottom:2px solid #c66f2f">ABOUT US</h2>-->
					<div class="heading">
					<div id="breadcrumbs-four">
	<a href="index.php" class="active">Home</a>
	<a href="#">Auction System</a>
	<a href="#">Auction Performance</a>
	
</div>
    </div>
    <div class="content" style="padding-top:15px; text-align:justify">


      <table width="100%" border="0" align="right" cellpadding="0" cellspacing="0" style="width: 100%; border-spacing: 10px;">
      <tr>
        <td height="30" align="justify"><div class="rightcorner1">
          <div class="innercontent">
            <div class="rightcorner1">
              <div class="innercontent">
                <div>
                  <div>
                    <form id="actn" name="actn" method="post" action="">
                      <div> <br />
                          <table width="90%" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#F0F0F0" style="margin-left:5%">
                            <tr bgcolor="#FFF0FF">
                              <td width="200" class="style38"><input type="radio" name="state" id="state" value="Andhra Pradesh" <?php echo $ap ?> onchange="subform();" />&nbsp;&nbsp;Andhra Pradesh </td>
                              <td width="232" class="style38"><label>
                              <input name="tp" type="radio" value="q" checked="checked" onchange="actn.submit();" />
                              </label>
Day Information </td>
                              <td width="312" class="style38">Date :&nbsp;
<label>
                                      <input name="pdate" type="text" id="pdate" value="<?php echo $qdate1 ?>" onchange="actn.submit();" style="border:solid 1px; padding:5px;" />
                                      </label>                              </td>
                            </tr>
                              <?php
					if(!empty($_POST['yr']))
					$yrs=$_POST['yr'];

				  ?>
                            <tr bgcolor="#FFF0FF">
                              <td class="style38">
                                <input type="radio" name="state" id="state2" value="Karnataka" <?php echo $kt ?> onchange="subform();" />
&nbsp;&nbsp;Karnataka                 </td>
                              <td class="style38"><input name="tp" type="radio" value="v" onchange="actn.submit();" />
                              Cumulative Information </td>
                              <td align="center" class="style38"><a style="cursor:pointer" onclick="toggle_forms('auctions.php','actn');"  class="b">View in Table Format</a></td>
                              <?php
					if(!empty($_POST['yr']))
					$yrs=$_POST['yr'];

					if(!empty($yrs))
					{
					?>
                              <script type="text/javascript">
					 var yrs='<?php echo $yrs ?>';
					 var j;
					for(j=0;j<document.actn.yr.length;j++)
					{
						if(document.actn.yr[j].value==yrs)
						{
							document.actn.yr[j].checked=true;
						}
					}
					        </script>
                              <?php
					}
				  ?>
                                <?php
					if(!empty($_POST['tp']))
					$tps=$_POST['tp'];
					else
					$tps='';

					if($tps!="")
					{
					?>
                              <script type="text/javascript">
					 var tps='<?php echo $tps ?>';
					 var j;
					for(j=0;j<document.actn.tp.length;j++)
					{
						if(document.actn.tp[j].value==tps)
						{
							document.actn.tp[j].checked=true;
						}
					}
					              </script>
                                <?php
					}
				  ?>
                            </tr>
                          </table>
                        <br />
                          <div class="example-content">
                            
							<table border="0">
                              <tr>
                                <td><div align="center"><!-- Example scripts go here -->
                            <div id="chart2" style="margin-top:20px; margin-left:20px; width:700px; height:550px;" align="center"></div></div></td>
                                <td valign="top"><div align="center">
                                  <table width="180" border="0" cellpadding="2" cellspacing="2" bgcolor="#CCCCCC">
                                        <?php
										$catgg='';
										$catgg1='';
									for($i=0;$i<count($plat1);$i++)
									{
										$chkk="";$chkk1="";
										if(isset($_POST['platform']))
										{
											if(in_array($plat1[$i][0],$_POST['platform']))
											{
												$chkk="checked=true";
											}
											else
											{
												$chkk="";
											}
										}
										else
										$chkk="checked=true";
										
										if($catgg1!=$plat1[$i][2])
										$catgg=$plat1[$i][2];
										else
										$catgg='';
										if($catgg!='')
										{
											if(isset($_POST['catg']))
											{
												if(in_array($plat1[$i][2],$_POST['catg']))
												{
													$chkk1="checked=true";
												}
												else
												{
													$chkk1="";
												}
											}
											else
											$chkk1="checked=true";
										
									?>
                                    <tr bgcolor="#e08e2f">
                                      <td><label><input name="catg[]" type="checkbox" value="<?php echo $plat1[$i][2] ?>" <?php echo $chkk1 ?> id="catg[]" onchange="chkcatg(this);" />
                                        &nbsp;&nbsp;<?php echo $catgg ?></label></td>
                                    </tr>
                                    <?php
										}
									?>
                                    <tr bgcolor="#FFFFFF">
                                      <td><label><input class="<?php echo $plat1[$i][2]; ?>" name="platform[]" type="checkbox"  style="margin-left:15px;" value="<?php echo $plat1[$i][0] ?>" <?php echo $chkk ?> id="platform[]" onchange="actn.submit();" />
                                        &nbsp;&nbsp;<?php echo $plat1[$i][1] ?></label></td>
                                    </tr>
                                        <!--<option value="<?php //echo $plat1[$i][0] ?>"><?php //echo $plat1[$i][1] ?></option>-->
                                        <?php
										$catgg1=$plat1[$i][2];
									}
									?>
                                    <tr bgcolor="#FFFFFF">
                                      <td class="style38"><div align="center"><a style="cursor:pointer" onclick="checkAll('actn', 'true');"><strong>Check All</strong></a></div></td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF">
                                      <td class="style38"><div align="center"><strong><a style="cursor:pointer" onclick="checkAll('actn','');">Uncheck All</a></strong></div></td>
                                    </tr>
                                  </table>
                                </div></td>
                              </tr>
                            </table>
                            
                            <!--<pre class="code brush:js"></pre>-->
                            <script class="" type="text/javascript">
$(document).ready(function(){
	if(document.actn.tp[0].checked)
	{
		graph1();
	}
	else
	{
		graph3();
	}
});

function graph1()
{
	//alert("chk");
	var st1='<?php echo $st ?>';
	var td1='<?php echo $td ?>';
	var prc1='<?php echo $prc ?>';
	var gmin='<?php echo $rowg['min2']; ?>';
	var gmax='<?php echo $rowg['max2']; ?>';
	var st=new Array();
	var td=new Array();
	var prc=new Array();
	var tot=new Array();

	st=st1.split(':');
	td=td1.split(':');
	prc=prc1.split(':');
	var prca=new Array();
	var a=0;
	for(i=0;i<st.length;i++)
	{
		var tds=td[i].split('^');
		var prcs=prc[i].split('^');
		var tot1=new Array();
		for(j=0;j<tds.length;j++)
		{
			tot1[j]=Array(tds[j],prcs[j]);
			prca[a]=prcs[j];
			a++;
		}
		tot[i]=tot1;
	}
//	alert("tot="+prca);
		var smax = Math.max.apply(Math, prca);
		var smin = Math.min.apply(Math, prca);
		if(smax=="")
		smax=200;
		else
		smax=parseInt(smax);
		
		if(smin=="")
		smin=120;
		else
		smin=parseInt(smin);

		var rema1=parseFloat(smin)/10;
		var rema2=Math.round(rema1);
		if(rema2>rema1)
		var xtra=10;
		else
		xtra=0;
		smin=(parseFloat(rema2)*10)-parseInt(xtra);

		var dif=parseFloat(smax)-parseFloat(smin);
		var dif1=parseFloat(dif)/10;
		var dif1=Math.round(dif1)+1;
		smax=parseFloat(smin)+(parseFloat(dif1)*10);
		//smin=gmin/1;
		//smax=gmax/1;
		//alert(smin+"   ---   "+smax);
	var plot3 = $.jqplot('chart2', tot, 
    { 
      //title:'Line Style Options', 
      // Set default options on all series, turn on smoothing.
      seriesDefaults: {
          rendererOptions: {
              smooth: true
          }
      },
	  //seriesColors:['#85802b', '#00749F', '#73C774', '#C7754C', '#C7754B'],
      // Series options are specified as an array of objects, one object
      // for each series.
        legend: {
            show: true,
		labels:st,
            placement: 'outsideGrid'
        },
			axesDefaults: {
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
          angle: -30,
		   fontSize: '7px'
        }
    },
            axes: {
				 yaxis: {
					min: smin,
					max: smax,
				  
				  angle: 90
				},
				xaxis:{
					renderer:$.jqplot.DateAxisRenderer
				}
            },
      series:[ 
	  	{
            lineWidth:2, 
            markerOptions: { style:"filledSquare", size:5 }
		},
           
      ]
    });
  /*var plot1 = $.jqplot ('chart2', tot, {
      // Give the plot a title.
      title: 'Domestic Auction Information (Platform Wise)',
              animate: true,
            // Will animate plot on calls to plot1.replot({resetAxes:true})
            animateReplot: true,
     // You can specify options for all axes on the plot at once with
      // the axesDefaults object.  Here, we're using a canvas renderer
      // to draw the axis label which allows rotated text.
            seriesDefaults: {
                pointLabels: { show: true },
				markerOptions: {
							show: true,             // wether to show data point markers.
							style: 'filledCircle',  // circle, diamond, square, filledCircle.
//													// filledDiamond or filledSquare.
							lineWidth: 2,       // width of the stroke drawing the marker.
							size: 5,            // size (diameter, edge length, etc.) of the marker.
//							color: '#666666'    // color of marker, set to color of line by default.
							shadow: false,       // wether to draw shadow on marker or not.
//							shadowAngle: 45,    // angle of the shadow.  Clockwise from x axis.
//							shadowOffset: 1,    // offset from the line of the shadow,
//							shadowDepth: 3,     // Number of strokes to make when drawing shadow.  Each stroke
//												// offset by shadowOffset from the last.
//							shadowAlpha: 0.07   // Opacity of the shadow
						}
            },
      axesDefaults: {
                 pointLabels: { show: true },
				markerOptions: {
							show: true,             // wether to show data point markers.
							style: 'filledCircle',  // circle, diamond, square, filledCircle.
//													// filledDiamond or filledSquare.
//							lineWidth: 2,       // width of the stroke drawing the marker.
//							size: 15,            // size (diameter, edge length, etc.) of the marker.
//							color: '#666666'    // color of marker, set to color of line by default.
//							shadow: true,       // wether to draw shadow on marker or not.
//							shadowAngle: 45,    // angle of the shadow.  Clockwise from x axis.
//							shadowOffset: 1,    // offset from the line of the shadow,
//							shadowDepth: 3,     // Number of strokes to make when drawing shadow.  Each stroke
//												// offset by shadowOffset from the last.
//							shadowAlpha: 0.07   // Opacity of the shadow
						},
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
                        highlightMouseOver: true
      },
	  legend:{
	  	show:true,
		placement:"outsideGrid",
		labels:st,
	  },
	  
      // An axes object holds options for all axes.
      // Allowable axes are xaxis, x2axis, yaxis, y2axis, y3axis, ...
      // Up to 9 y axes are supported.
      axes: {
        // options for each axis are specified in seperate option objects.
        xaxis: {
          label: "Date",
		numberTicks: 10, 
		  renderer: $.jqplot.DateAxisRenderer,
          // Turn off "padding".  This will allow data point to lie on the
          // edges of the grid.  Default padding is 1.2 and will keep all
          // points inside the bounds of the grid.
          pad: 0
        },
        yaxis: {
			min: smin,
			max: smax,
			numberTicks: 11, 
          label: "Average Price",
        },
		highlighter: {
			show: true, 
			showLabel: true, 
			tooltipAxes: 'y',
			sizeAdjust: 7.5 , tooltipLocation : 'ne'
		}
      }
    });*/
}

function graph3()
{
	var st1='<?php echo $st ?>';
	var td1='<?php echo $td ?>';
	var prc1='<?php echo $aprc ?>';
	var gmin='<?php echo $rowg['min3']; ?>';
	var gmax='<?php echo $rowg['max3']; ?>';
	//alert("prc="+prc1);
	var st=new Array();
	var td=new Array();
	var prc=new Array();
	var tot=new Array();

	st=st1.split(':');
	td=td1.split(':');
	prc=prc1.split(':');
	var prca=new Array();
	var a=0;
	for(i=0;i<st.length;i++)
	{
		var tds=td[i].split('^');
		var prcs=prc[i].split('^');
		var tot1=new Array();
		for(j=0;j<tds.length;j++)
		{
			tot1[j]=Array(tds[j],prcs[j]);
			prca[a]=prcs[j];
			a++;
		}
		tot[i]=tot1;
	}
//	alert(tot);
		var smax = Math.max.apply(Math, prca);
		var smin = Math.min.apply(Math, prca);
		if(smax=="")
		smax=200;
		else
		smax=parseInt(smax);
		
		if(smin=="")
		smin=120;
		else
		smin=parseInt(smin);

		var rema1=parseFloat(smin)/10;
		var rema2=Math.round(rema1);
		if(rema2>rema1)
		var xtra=10;
		else
		xtra=0;
		smin=(parseFloat(rema2)*10)-parseInt(xtra);

		var dif=parseFloat(smax)-parseFloat(smin);
		var dif1=parseFloat(dif)/10;
		var dif1=Math.round(dif1)+1;
		smax=parseFloat(smin)+(parseFloat(dif1)*10);

//		alert(smax+"--"+smin);
/*		var rem1=parseFloat(smax)/100;
		var rem2=Math.round(rem1);
//		alert(rem2);
		if(rem2<rem1)
		var xtr=50;
		else
		xtr=0;
//		alert(tot);
		smax=(parseFloat(rem2)*100)+parseInt(xtr);
		
*/
		smax=gmax/1;
		smin=gmin/1;
		var plot3 = $.jqplot('chart2', tot, 
    { 
      //title:'Line Style Options', 
      // Set default options on all series, turn on smoothing.
      seriesDefaults: {
          rendererOptions: {
              smooth: true
          }
      },
	  //seriesColors:['#85802b', '#00749F', '#73C774', '#C7754C', '#C7754B'],
      // Series options are specified as an array of objects, one object
      // for each series.
        legend: {
            show: true,
		labels:st,
            placement: 'outsideGrid'
        },
			axesDefaults: {
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
          angle: -30,
		   fontSize: '7px'
        }
    },
            axes: {
				 yaxis: {
					min: smin,
					max: smax,
				  
				  angle: 90
				},
				xaxis:{
					renderer:$.jqplot.DateAxisRenderer
				}
            },
      series:[ 
	  	{
            lineWidth:2, 
            markerOptions: { style:"filledSquare", size:5 }
		},
           
      ]
    });
  /*var plot1 = $.jqplot ('chart2', tot, {
      // Give the plot a title.
      title: 'Domestic Auction Information (Platform Wise)',
              animate: true,
            // Will animate plot on calls to plot1.replot({resetAxes:true})
            animateReplot: true,
     // You can specify options for all axes on the plot at once with
      // the axesDefaults object.  Here, we're using a canvas renderer
      // to draw the axis label which allows rotated text.
            seriesDefaults: {
                pointLabels: { show: true },
				markerOptions: {
							show: true,             // wether to show data point markers.
							style: 'filledCircle',  // circle, diamond, square, filledCircle.
//													// filledDiamond or filledSquare.
							lineWidth: 2,       // width of the stroke drawing the marker.
							size: 5,            // size (diameter, edge length, etc.) of the marker.
//							color: '#666666'    // color of marker, set to color of line by default.
							shadow: false,       // wether to draw shadow on marker or not.
//							shadowAngle: 45,    // angle of the shadow.  Clockwise from x axis.
//							shadowOffset: 1,    // offset from the line of the shadow,
//							shadowDepth: 3,     // Number of strokes to make when drawing shadow.  Each stroke
//												// offset by shadowOffset from the last.
//							shadowAlpha: 0.07   // Opacity of the shadow
						}
            },
      axesDefaults: {
                 pointLabels: { show: true },
				markerOptions: {
							show: true,             // wether to show data point markers.
							style: 'filledCircle',  // circle, diamond, square, filledCircle.
//													// filledDiamond or filledSquare.
//							lineWidth: 2,       // width of the stroke drawing the marker.
//							size: 15,            // size (diameter, edge length, etc.) of the marker.
//							color: '#666666'    // color of marker, set to color of line by default.
//							shadow: true,       // wether to draw shadow on marker or not.
//							shadowAngle: 45,    // angle of the shadow.  Clockwise from x axis.
//							shadowOffset: 1,    // offset from the line of the shadow,
//							shadowDepth: 3,     // Number of strokes to make when drawing shadow.  Each stroke
//												// offset by shadowOffset from the last.
//							shadowAlpha: 0.07   // Opacity of the shadow
						},
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
                        highlightMouseOver: true
      },
	  legend:{
	  	show:true,
		placement:"outsideGrid",
		labels:st,
	  },
      // An axes object holds options for all axes.
      // Allowable axes are xaxis, x2axis, yaxis, y2axis, y3axis, ...
      // Up to 9 y axes are supported.
      axes: {
        // options for each axis are specified in seperate option objects.
        xaxis: {
          label: "Date",
		numberTicks: 10, 
		  renderer: $.jqplot.DateAxisRenderer,
          // Turn off "padding".  This will allow data point to lie on the
          // edges of the grid.  Default padding is 1.2 and will keep all
          // points inside the bounds of the grid.
          pad: 0
        },
        yaxis: {
			min: smin,
			max: smax,
			numberTicks: 11, 
          label: "Cumulative Average Price",
        },
		highlighter: {
			show: true, 
			showLabel: true, 
			tooltipAxes: 'y',
			sizeAdjust: 7.5 , tooltipLocation : 'ne'
		}
      }
    });*/
}
 
   function graph2(){
  
	var st1='<?php echo $st ?>';
	var tqty1='<?php echo $tqty ?>';
	var tval1='<?php echo $tval ?>';

	var tqty=new Array();
	var s=new Array();
	var st=new Array();

	tqty=tqty1.split(':');
	s=tval1.split(':');
	st=st1.split(':');

	var xlab='<?php echo $qdate1 ?>';
	var tit="Domestic Auction Information (Platform Wise)";

		var ylab='Cumulative Average Price';
		var smax = Math.max.apply(Math, s);
		//alert(smax);
		if(smax=="")
		smax=200;
		var rem1=parseFloat(smax)/100;
		var rem2=Math.round(rem1);
		//alert(rem1);
		if(rem2<rem1)
		var xtr=50;
		else
		xtr=0;
		smax=(parseFloat(rem2)*100)+parseInt(xtr);

//		s1=[s[0],s[1],s[2],s[3],s[4],s[5],s[6],s[7],s[8],s[9],s[10],s[11]];
 //       var s2 = [7, 5, 3, 2];
//         var ticks = ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'];
         var ticks = st;
        plot2 = $.jqplot('chart2', [s], {
            seriesDefaults: {
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true },
				markerOptions: {
							seriesColors: [ "#4bb2c5", "#c5b47f", "#EAA228", "#579575", "#839557", "#958c12",
        "#953579", "#4b5de4", "#d8b83f", "#ff5800", "#0085cc"],
							show: true,             // wether to show data point markers.
							style: 'filledCircle',  // circle, diamond, square, filledCircle.
//													// filledDiamond or filledSquare.
//							lineWidth: 2,       // width of the stroke drawing the marker.
//							size: 15,            // size (diameter, edge length, etc.) of the marker.
//							color: '#666666'    // color of marker, set to color of line by default.
//							shadow: true,       // wether to draw shadow on marker or not.
//							shadowAngle: 45,    // angle of the shadow.  Clockwise from x axis.
//							shadowOffset: 1,    // offset from the line of the shadow,
//							shadowDepth: 3,     // Number of strokes to make when drawing shadow.  Each stroke
//												// offset by shadowOffset from the last.
//							shadowAlpha: 0.07   // Opacity of the shadow
						}
            },
             animate: true,
            // Will animate plot on calls to plot1.replot({resetAxes:true})
            animateReplot: true,
			title: tit,
           series:[
                {
                    pointLabels: {
                        show: true
                    },
                    renderer: $.jqplot.BarRenderer,
 					rendererOptions:{ varyBarColor : true },
                    showHighlight: true,
                  //  yaxis: 'y2axis',
                    rendererOptions: {
                        // Speed up the animation a little bit.
                        // This is a number of milliseconds.  
                        // Default for bar series is 3000.  
                        animation: {
                            speed: 2500
                        },
                        barWidth: 30,
                        barPadding: 25,
                        barMargin: 15,
                        highlightMouseOver: true
                    }
                }, 
                {
                    rendererOptions: {
                        // speed up the animation a little bit.
                        // This is a number of milliseconds.
                        // Default for a line series is 2500.
                        animation: {
                            speed: 2000
                        },
                    }
                }
            ],
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
					tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
                    ticks: ticks,
					label:xlab,
					tickOptions: {
                    angle: 90,
                    fontSize: '10pt',
                    showMark: true,
                }
                },
				yaxis: {
					min: 0,
					max: smax,
					numberTicks: 11, 
					tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
	                pointLabels: { show: true },
					label:ylab,
					tickOptions: {
                    angle: 90,
                    fontSize: '10pt',
                    showMark: true,
                }
				}
            },
            highlighter: {
                show: true, 
                showLabel: true, 
                tooltipAxes: 'y',
                sizeAdjust: 7.5 , tooltipLocation : 'ne'
            }
        });
    
//        $('#chart2').bind('jqplotDataHighlight', 
//            function (ev, seriesIndex, pointIndex, data) {
//                $('#info2').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
//            }
//        );
//            
//        $('#'+chrt).bind('jqplotDataUnhighlight', 
//            function (ev) {
//                $('#info2').html('Nothing');
//            }
//        );
    }
                       </script>
                            <!-- End example scripts -->
                            <!-- Don't touch this! -->
    <script class="include" type="text/javascript" src="jqplot1/jquery.jqplot.min.js"></script>
  <script class="include" type="text/javascript" src="jqplot1/plugins/jqplot.barRenderer.min.js"></script>
  <script class="include" type="text/javascript" src="jqplot1/plugins/jqplot.pieRenderer.min.js"></script>
  <script class="include" type="text/javascript" src="jqplot1/plugins/jqplot.categoryAxisRenderer.min.js"></script>
  <script class="include" type="text/javascript" src="jqplot1/plugins/jqplot.pointLabels.min.js"></script>
  <script class="include" type="text/javascript" src="jqplot1/plugins/jqplot.canvasTextRenderer.min.js"></script>
  <script type="text/javascript" src="jqplot1/plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
<script type="text/javascript" src="jqplot1/plugins/jqplot.categoryAxisRenderer.min.js"></script>
	<script type="text/javascript" src="jqplot1/plugins/jqplot.dateAxisRenderer.min.js"></script>

                      </div>
                        </form>
                    </div>
                </div>
              </div>
              </div>
              </div>
           </div></td>
      </tr>
    </table>
<script language="javascript">
jQuery('#pdate').datepicker();
jQuery('#pdate').readOnly=true;
</script>

					</div>
				<!--	<div class="footer">
						<p class="more"><a class="button" href="#">Read more >></a></p>
					</div>-->
				</article>
				
			</div>
			
			
			
		</div>
	</div>
</section>

<!--------------Footer--------------->
<?php include "tb_footer.php"; ?>
<script>
jQuery.fn.liScroll = function(settings) {
	settings = jQuery.extend({
		travelocity: 0.03
		}, settings);		
		return this.each(function(){
				var $strip = jQuery(this);
				$strip.addClass("newsticker")
				var stripHeight = 1;
				$strip.find("li").each(function(i){
					stripHeight += jQuery(this, i).outerHeight(true); // thanks to Michael Haszprunar and Fabien Volpi
				});
				var $mask = $strip.wrap("<div class='mask'></div>");
				var $tickercontainer = $strip.parent().wrap("<div class='tickercontainer'></div>");								
				var containerHeight = $strip.parent().parent().height();	//a.k.a. 'mask' width 	
				$strip.height(stripHeight);			
				var totalTravel = stripHeight;
				var defTiming = totalTravel/settings.travelocity;	// thanks to Scott Waye		
				function scrollnews(spazio, tempo){
				$strip.animate({top: '-='+ spazio}, tempo, "linear", function(){$strip.css("top", containerHeight); scrollnews(totalTravel, defTiming);});
				}
				scrollnews(totalTravel, defTiming);				
				$strip.hover(function(){
				jQuery(this).stop();
				},
				function(){
				var offset = jQuery(this).offset();
				var residualSpace = offset.top + stripHeight;
				var residualTime = residualSpace/settings.travelocity;
				scrollnews(residualSpace, residualTime);
				});			
		});	
};

$(function(){
    $("ul#ticker01").liScroll();
});
</script>