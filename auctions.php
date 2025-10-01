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
<link class="include" rel="stylesheet" type="text/css" href="graph/jquery.jqplot.min.css" />
    <link rel="stylesheet" type="text/css" href="graph/examples.min.css" />
    <link type="text/css" rel="stylesheet" href="graph/syntaxhighlighter/styles/shCoreDefault.min.css" />
    <link type="text/css" rel="stylesheet" href="graph/syntaxhighlighter/styles/shThemejqPlot.min.css" />
  
  <!--[if lt IE 9]><script language="javascript" type="text/javascript" src="../excanvas.js"></script><![endif]-->
    <script class="include" type="text/javascript"    src="graph/jquery.min.js"></script>
<script src="jquery.ui-1.5.2/ui/ui.datepicker.js" type="text/javascript"></script>
<link href="jquery.ui-1.5.2/themes/ui.datepicker.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--
.style36 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.style38 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
-->
tr, th, td {
    padding: 5px !important;
}
</style>
<script language="javascript">
function toggle_forms(st,frm)
{
	document.getElementById(frm).action=st;
	document.getElementById(frm).submit();
}
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
</head>
<body>
<?php
	function numround($st,$n)
	{
		if(!empty($st))
		{
			$n1=pow(10 ,$n);
			$num=round($st*$n1)/($n1);
		}
		return $num;
	}
	function num_deczero($n)
	{
		$exn='';
		for($i=1;$i<=$n;$i++)
		$exn=$exn."0";
		return $exn;
	}
	function num_fround($st,$n)
	{
		$exn='';
		if($st=="")
		$st=0;
		if($st!="" && $st!=0)
		{
			$st=numround($st,$n);
			if($st=="")
			$st=0;
			$nd=numberOfDecimals($st);
			$n2=$n-$nd;
			if($nd==0)
			$num=$st.".".num_deczero($n);
			else if($n2>0)
			{
				for($i=1;$i<=$n2;$i++)
				$exn=$exn."0";
				$num=$st.num_deczero($n2);
			}
			else
			$num=$st;
		}
		else
		{
			//echo "extn=".$exn;
			$num="0.".num_deczero($n);
		}
		return $num;
	}
function numberOfDecimals($value)
{
    if ((int)$value == $value)
    {
        return 0;
    }
    else if (! is_numeric($value))
    {
        // throw new Exception('numberOfDecimals: ' . $value . ' is not a number!');
        return false;
    }

    return strlen($value) - strrpos($value, '.') - 1;
}
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

<?php
$qry1='';$tvalv=0;
$qry=''; $st=''; $prc=''; $td=''; $yrs='';

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
	
if(!empty($_POST['state']))
$stat=$_POST['state'];
else if(!empty($_GET['state']))
$stat=$_GET['state'];
else
$stat='Karnataka';
/*if($_POST['platform']!="")
{
	$plats=implode('^',$_REQUEST['platform']);
	$plats1=implode(',',$_REQUEST['platform']);
}
if($plats!="")
{
	$qry=" and id in (".$plats1.")";
}
*/
//$seldat=executework("select tob_auction.tdate from tob_platform,tob_auction where tob_platform.id=tob_auction.platf and tob_platform.id=".$row['id']." and tob_auction.year=".$yr." order by tob_auction.tdate");

if(!empty($_POST['pdate']))
{
	$qdate2=date('Y-m-d',strtotime(str_replace('/','-',$_POST['pdate'])));
	
}
else
{
	$qdate2=date('Y-m-d');
	
}
	$seldat1=executework("select year from tob_auction where isactive=1 and platf in(select id from tob_platform where state='".$stat."')".$qry." order by tdate desc limit 1");
	$rowdt1=@mysqli_fetch_array($seldat1);
if(!empty($_POST['pdate']))
{
	$qdate=datepattrn1($_POST['pdate']);
	$qdate1=$_POST['pdate'];
	$yr=substr($qdate,0,4);
}
else
{
	$seldat=executework("select tdate from tob_auction where isactive=1".$qry." order by tdate desc limit 1");
	$rowdt=@mysqli_fetch_array($seldat);
	$qdate1=datepattrn($rowdt['tdate']);
}
//$yr=substr($rowdt1['tdate'],0,4);
$yr=$rowdt1['year'];
if(!empty($qdate))
{
	$qry1=" and tob_auction.tdate<='".$qdate."'";
}

$selplat1=executework("select * from tob_platform where state='".$stat."' order by platform");
$cntp1=@mysqli_num_rows($selplat1);
$u=0;
while($row1=@mysqli_fetch_array($selplat1))
{
	$plat1[$u]=array($row1['id'],$row1['platform']);
	$u++;
}
$selplat=executework("select * from tob_platform where state='".$stat."'".$qry." order by platform");
$cntp=@mysqli_num_rows($selplat);

$t=0;
$str="";

$tqty="";
$tval="";
$days=0;
$selycnt=executework("select distinct count(distinct tdate) as cnt from tob_platform,tob_auction where tob_platform.id=tob_auction.platf and tob_platform.state='".$stat."'".$qry1." and tob_auction.year=(select distinct year from tob_platform,tob_auction where tob_platform.id=tob_auction.platf and tob_platform.state='".$stat."'"." order by tob_auction.year desc limit 1) order by cnt desc limit 1");
$rowycnt=@mysqli_fetch_array($selycnt);
if(!empty($rowycnt['cnt']))
$days=$rowycnt['cnt'];
while($row=@mysqli_fetch_array($selplat))
{
	$plat[$t]=array($row['id'],$row['platform']);
	$selqdat=executework("select distinct tdate,aprice,qsold from tob_platform,tob_auction where tob_platform.id=tob_auction.platf and tob_platform.id='".$row['id']."'".$qry1." order by tob_auction.tdate");
	$selqdat1=executework("SELECT year FROM tob_auction where platf='".$row['id']."'".$qry1." order by year desc limit 1");
	$rowd1=@mysqli_fetch_array($selqdat1);
	if(empty($rowd1['year']))
	$year=date('Y');
	else
	$year=$rowd1['year'];
	//$selqdat=executework("SELECT tdate,aprice,qsold FROM tob_auction WHERE year=".$year." AND platf=29");
	$cntd=@mysqli_num_rows($selqdat);
	if($cntd>0)
	{
//		if($cntd>$days)
//		$days=$cntd;
		$k=0;
		$str1="";
		$st1="";
		$st2="";
		$qty=0;
		$vald=0;
		while($rowqd=@mysqli_fetch_array($selqdat))
		{
			if($rowqd['aprice']>0)
			{
				$dates[$t]['d'][$k]=$rowqd['tdate'];
				$dates[$t]['v'][$k]=round($rowqd['aprice']);
				if($st1=="")
				$st1=$rowqd['tdate'];
				else
				$st1=$st1."^".$rowqd['tdate'];
	
				if($st2=="")
				$st2=round($rowqd['aprice']);
				else
				$st2=$st2."^".round($rowqd['aprice']);
				
				
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
		$str=$row['platform']."*".$st1."*".$st2;
		else
		$str=$str."~".$row['platform']."*".$st1."*".$st2;
		
		if($st=="")
		$st=$row['platform'];
		else
		$st=$st.":".$row['platform'];
		
		if($td=="")
		$td=$st1;
		else
		$td=$td.":".$st1;
		
		if($prc=="")
		$prc=$st2;
		else
		$prc=$prc.":".$st2;
	}
	$t++;
}

?>

      <?php
					if(!empty($_POST['state']))
					$mn1=$_POST['state'];
					else if(!empty($_GET['state']))
					$mn1=$_GET['state'];
					else
					$mn1='Karnataka';
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
	?>
      <br />
      <table width="99%" border="0" align="right" cellpadding="0" cellspacing="0" style="width: 100%; border-spacing: 10px;">
      <tr>
        <td height="30" align="justify"><div class="rightcorner1">
          <div class="innercontent">
            <div class="rightcorner1">
              <div class="innercontent">
                    <form id="actn" name="actn" method="post" action="">
                      <div> <br />
                          <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
                            <tr>
                              <td width="31%" class="style38"><label>
                                <input type="radio" name="state" id="state" value="Andhra Pradesh" <?php echo $ap ?> onChange="actn.submit();" />
                                &nbsp;&nbsp;Andhra Pradesh
                              </label></td>
                              <td width="27%" class="style38"><label>
                              <input name="tp" type="radio" value="q" checked="checked" onChange="actn.submit();" />
                              </label>
Day Information </td>
                              <td width="35%" align="center"><div align="left">Date :&nbsp;
                                      <label>
                                      <input name="pdate" type="text" id="pdate" value="<?php echo $qdate1 ?>" onChange="actn.submit();" style="border: solid 1px; padding: 5px;" />
                                      </label>
                              </div></td>
                              <td width="7%" align="center">&nbsp;</td>
                            </tr>
                            <tr>
                              <td class="style38"><label>
                              <input type="radio" name="state" id="state2" value="Karnataka" <?php echo $kt ?> onChange="actn.submit();" />
&nbsp;&nbsp;Karnataka </label></td>
                              <td class="style38"><input name="tp" type="radio" value="v" onChange="actn.submit();" />
Cumulative Information </td>
                              <td align="center" class="style38"><div align="left"><a style="cursor:pointer" onClick="toggle_forms('auctions1.php','actn');" class="b">View in Graph Format</a></div></td>
                              <td align="center">&nbsp;</td>
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

					if(!empty($tps))
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
							<tr>
							  <td height="32" colspan="4" align="center" valign="middle">&nbsp;</td>
						    </tr>
							<tr>
							<td height="32" colspan="4" align="center" valign="middle">
							   
                               <span class="style36"><?php echo $yr." ".$stat; ?> Auctions - Sales Report</span>			                 </td>
                            </tr>
							
							
							<tr>
							<td height="32" colspan="4" align="center" valign="middle" class="style38">
							<?php
							
							
							$sel3=executework("select * from tob_auction,tob_platform where tob_auction.platf=tob_platform.id and state='".$stat."' and date(tdate)<='".$qdate2."' and tob_platform.isactive=1 order by tob_auction.tdate desc limit 1");
							$row=@mysqli_fetch_array($sel3);
								$adate=$row['tdate'];
								
						?>							 &nbsp;&nbsp; Start Auction Year : <?php echo $yr ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Day : <?php echo $days ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Auction&nbsp;Date : <?php echo datepattrn($adate) ?></td>
						    </tr>
							  
						    <tr>
							<td height="32" colspan="4" align="center" valign="middle">
							
							  <table width="90%" border="1" cellpadding="5" cellspacing="0" bordercolor="#c66f2f" style="width: 100%; border-spacing: 10px;">
						<?php
							if(!empty($_POST['tp']) && $_POST['tp']=='v')
							{
						?>
							  <tr>
                                <td width="22%" bgcolor="#FFFFFF"><div align="center"><span class="style36">Name of the Auction Platform</span></div></td>
								<td width="16%" bgcolor="#FFFFFF"><div align="center"><span class="style36">Quantity Authorized (M.Kgs.)</span></div></td>
								<td width="16%" bgcolor="#FFFFFF"><div align="center"><span class="style36"> Cumulative Total Bales Marketed</span></div></td>
								<td width="16%" bgcolor="#FFFFFF"><div align="center"><span class="style36">Cumulative Quantity Marketed (Kgs.)</span></div></td>
								<td width="14%" bgcolor="#FFFFFF"><div align="center"><span class="style36"> Cumulative Average Price (Rs./Kg)</span></div></td>
								<td width="16%" bgcolor="#FFFFFF"><div align="center"><span class="style36">End Date Of Auction (d-m-y)</span></div></td>
							  </tr>
							  <?php
							}
							else
							{
						?>
							  <tr>
                                <td bgcolor="#FFFFFF"><div align="center"><span class="style36">Name of the Auction Platform</span></div></td>
								<td bgcolor="#FFFFFF"><div align="center"><span class="style36">Quantity Authorized (M.Kgs.)</span></div></td>
								<td bgcolor="#FFFFFF"><div align="center"><span class="style36"> Total Bales Marketed</span></div></td>
								<td bgcolor="#FFFFFF"><div align="center"><span class="style36">Quantity Marketed (Kgs.)</span></div></td>
								<td bgcolor="#FFFFFF"><div align="center"><span class="style36"> Average Price (Rs./Kg)</span></div></td>
								<td bgcolor="#FFFFFF"><div align="center"><span class="style36">End Date Of Auction (d-m-y)</span></div></td>
							  </tr>
							  <?php
							}
							$qrv='';
							//if(!empty($_POST['tp']) && $_POST['tp']=='q')
							//$qrv=" and tdate='".$adate."'";
							$sel1=executework("select distinct platf,platform,tob_platform.catg,tob_platform.seqid from tob_auction,tob_platform where tob_auction.platf=tob_platform.id and state='".$stat."'".$qrv." and tob_platform.isactive=1 order by field(tob_platform.catg,'NBS','SBS','SLS','NLS'),tob_platform.seqid");
							$cntt=@mysqli_num_rows($sel1);
							$qau=0;
							$tbal=0;
							$tquat=0;
							$tvalu=0;
							while($row1=@mysqli_fetch_array($sel1))
							{
								$selauct=executework("select * from tob_auct where platf=".$row1['platf']." and year=".$yr);
								
								$rowa=@mysqli_fetch_array($selauct);
								$qrv='';
								if(!empty($_POST['tp']) && $_POST['tp']=='v')
								$qrv=" and tdate between '".$rowa['cdate']."' and '".$adate."'";
								else
								$qrv=" and tdate='".$adate."'";
								$selsm=executework("select sum(bsold) as bsold,sum(qsold) as qsold,sum(tvalue) as tval,sum(aprice) as apric from tob_auction where platf='".$row1['platf']."'".$qrv);
								$rows=@mysqli_fetch_array($selsm);

								if(!empty($_POST['tp']) && $_POST['tp']=='v')
								{
									$eq=$rows['qsold'];
									$eb=$rows['bsold'];
									if($eq>0)
									$ep=$rows['tval']/$eq;
									else
									$ep=0;
									//$ep=$row1['cprice'];
								}
								else
								{
									$eq=$rows['qsold'];
									$eb=$rows['bsold'];
									$ep=$rows['apric'];
								}
								$qau+=$rowa['qauth'];
								$tbal+=$eb;
								$tquat+=$eq;
								$tvalu+=$rows['tval'];
								$tvalv+=$rows['tval'];
								if($eb>0)
								{
							?>
							  <tr>
                                <td bgcolor="#FFFFFF"><span class="style38"><?php echo $row1['platform'] ?></span></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo num_fround($rowa['qauth'],2) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo $eb ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo num_fround($eq,1) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo num_fround($ep,2) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="center"><span class="style38">
								  <?php if($rowa['edate']!="" && $rowa['edate']!='0000-00-00' && $rowa['edate']!='1970-01-01') { echo datepattrn($rowa['edate']); } ?>
								  </span></div></td>  
                              </tr>
							  <?php
							  	}
							
							}
							//echo "tval=".$tvalv."--".$tvalu."--".$tquat;
							if($tquat>0)
							{
								if(!empty($_POST['tp']) && $_POST['tp']=='v')
								$tcpr=$tvalv/$tquat;
								else
								$tcpr=$tvalu/$tquat;
							}
							else
							$tcpr=0;
							 ?>
							  <tr>
							    <td bgcolor="#FFFFFF" class="style36"><strong>Grand Total </strong></td>
							    <td bgcolor="#FFFFFF"><div align="right"><strong><?php echo num_fround($qau,2) ?></strong></div></td>
							    <td bgcolor="#FFFFFF"><div align="right"><strong><?php echo $tbal ?></strong></div></td>
							    <td bgcolor="#FFFFFF"><div align="right"><strong><?php echo num_fround($tquat,1) ?></strong></div></td>
							    <td bgcolor="#FFFFFF"><div align="right"><strong><?php echo num_fround($tcpr,2) ?></strong></div></td>
							    <td bgcolor="#FFFFFF">&nbsp;</td>
							    </tr>
							  </table>							  </td>
						    </tr>
						    <tr>
						      <td height="32" colspan="4" align="center" valign="middle">&nbsp;</td>
						    </tr>
							<?php
							if(!empty($_POST['tp']) && $_POST['tp']=='v')
							{
							?>
							  <!--<tr>
							    <td height="32" colspan="4" align="center" valign="middle" bgcolor="#FFF9FF"><table width="66%" border="0" cellpadding="1" cellspacing="1" bgcolor="#000033">
							<tr>
                                <td width="25%" bgcolor="#FFFFFF"><div align="center" class="style36">Grade Out-turn</div></td>
								<td width="27%" bgcolor="#FFFFFF"><div align="center" class="style36">Quantity Marketed (M.Kgs.)</div></td>
								  
								<td width="26%" bgcolor="#FFFFFF"><div align="center" class="style36">% share</div></td>
							  <td width="22%" bgcolor="#FFFFFF"><div align="center" class="style36">Average Price (Rs. / Kg.)</div></td>
                            </tr>
							  <tr>
                                <td bgcolor="#FFFFFF"><span class="style38">Bright Grades</span></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo numround($row['bq'],3) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo numround($row['bp'],2) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo numround($row['ba'],2) ?></span></div></td>
                              </tr>
							  <tr>
                                <td bgcolor="#FFFFFF"><span class="style38">Medium Grades</span></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo numround($row['mq'],3) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo numround($row['mp'],2) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo numround($row['ma'],2) ?></span></div></td>
                              </tr>
							  <tr>
                                <td bgcolor="#FFFFFF"><span class="style38">Low Grades</span></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo numround($row['lq'],3) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo numround($row['lp'],2) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo numround($row['la'],2) ?></span></div></td>
                              </tr>
							  </table></td>
						    </tr>-->
							<?php
							}
							?>
                          </table>
                        <br />
                         
                            
                        </form>
              </div>
              </div>
              </div>
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