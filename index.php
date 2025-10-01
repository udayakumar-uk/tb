<?php 
ob_start();
@session_start();
include "include/include.php";
$selectp=executework("select * from tob_album_title,tob_images where tob_album_title.id=tob_images.titleid and tob_images.cover=1 order by tob_album_title.position desc,tob_images.cover,tob_images.position desc");
$countp=@mysqli_num_rows($selectp);
$base_url="http://".$_SERVER['SERVER_NAME'];
$base_path=$_SERVER['DOCUMENT_ROOT'];
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

    <!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>Tobacco Board</title>
	
    <!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="css/zerogrid.css">
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
	<link rel="stylesheet" href="css/responsiveslides.css" />
	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<!--[if lt IE 8]>
       <div style=' clear: both; text-align:center; position: relative;'>
         <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
           <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
        </a>
      </div>
    <![endif]-->
    <!--[if lt IE 9]>
		<script src="js/html5.js"></script>
		<script src="js/css3-mediaqueries.js"></script>
	<![endif]-->
	
	<!--<link href='./images/favicon.ico' rel='icon' type='image/x-icon'/>-->
	
	<script src="js/jquery.min.js"></script>
	<script src="js/responsiveslides.js"></script>
	<script>
    $(function () {
      $("#slider").responsiveSlides({
        auto: true,
        pager: true,
        nav: true,
        speed: 500,
        //maxwidth: 800,
        namespace: "centered-btns"
      });
    });
function show_pop(dname,id)
{
	if(dname!="" && dname!='#')
	{
		window.open(dname,"DisplayWindow","resizable=no,titlebar=no,toolbar=no,scrollbars=yes,directories=no,menubar=no,width=600,height=900,left=300,top=25");
	}
}		
  </script>

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
    background-color:transparent;
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

.dropdown-content a:hover {background-color: transparent}

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
    background-color: rgba(0,71,0,1);
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: 1px solid #ccc;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: 4px;
     -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
    box-shadow: 0 6px 12px rgba(0,0,0,.175);
}	
.dropdown-menu > li > a:focus, .dropdown-menu > li > a:hover {
    color: #669900;
    text-decoration: none;
    background-color: transparent;
	
}
.dropdown-menu > li > a{
color:#fff;
}
.navbar-inverse .navbar-nav > .open > a, .navbar-inverse .navbar-nav > .open > a:focus, .navbar-inverse .navbar-nav > .open > a:hover {
    color: #fff;
    background-color: transparent;
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

table, table td{
	padding:5px;
}
marquee h2{
margin: 0px;
}
.style1 {
	color: #1B4B29;
	font-weight: bold;
}
.style2 {color: #292860}
</style>    
</head>
<body>
<?php include "tb_header.php"; ?>
	<span class="style3">
<?php 
  	$selatest=executework("select * from tob_latest where archive=0 order by id desc limit 8");
	$lnews='';
	while($rowlt=@mysqli_fetch_array($selatest))
	{
		if($rowlt['tfile']!="")
		{
			$tf="<a href='tbdata/latest/".$rowlt['tfile']."' target=_blank >";
			$tf1="</a>";
		}
		else
		{
			$tf="";
			$tf1="";
		}
		if($lnews=="")
		$lnews=$tf.$rowlt['description'].$tf1;
		else
		$lnews=$lnews."  ".$tf.$rowlt['description'].$tf1;
	}
  ?>
<!--</span>
	<div class="col-md-12 column" style="margin-top: 30px;">
    <div class="newsscroll">
      <div>
        <p>
          <marquee scrollamount="3" direction="left" onMouseOver="this.stop();" onMouseOut="this.start();">
          <?php //echo $lnews ?>
          </marquee>
        </p>
		 
        
      </div>
    </div>
  </div>-->
<section id="content">
	<div class="zerogrid">
		<div class="row block">
          <marquee scrollamount="10" direction="left" onMouseOver="this.stop();" onMouseOut="this.start();">
          <?php echo $lnews ?>
          </marquee>
        </div>
    </div>
	<div class="zerogrid">
		<div class="row block">
			<div class="main-content col11">
			
				<div class="rslides_container">
					<ul class="rslides" id="slider" style="padding-left:0px; max-width:100%">
						<li  style="padding-left:0px"><img src="images/b1.jpg"/></li>
						<li  style="padding-left:0px"><img src="images/69.jpg"/></li>
						<!-- <li  style="padding-left:0px"><img src="images/b33.jpg"/></li>  -->
						<li  style="padding-left:0px"><img src="images/162board.jpg"/></li>
						<li  style="padding-left:0px"><img src="images/b4.jpg"/></li>
						<li  style="padding-left:0px"><img src="images/auction.jpg"/></li>
					</ul>
				</div>
				<!--<article>
				<h2 style="border-bottom:2px solid #c66f2f">WELCOME TO TOBACCO BOARD MINISTRY OF COMMERCE & INDUSTRY, GOVT. OF INDIA</h2>
					<div class="heading">
						
					</div>
					<div class="content" style="padding-top:15px; text-align:justify">
						<img src="images/v1.jpg"/>
						<p style="font-size:13px;">Tobacco is an important commercial crop grown in India. It occupies the third position in the world with an annual production of about 800 Million Kgs. Of the different types grown, flue-cured tobacco, country tobacco, burley, bidi, rustica and chewing tobacco are considered important. India stands 3rd in production of tobacco and in exports, Brazil and USA are ahead of India.<br>
						Tobacco and tobacco products earn approx Rs.20,000 Cr. to the national exchequer by way of excise duty, and approx.Rs.5000 Cr. by way of foreign exchange every year. </p>
					</div>
                   </article>-->
			</div>
			
			
			
		
		<div class="sidebar col05">
        	<div style="font-size:14px !important; font-weight:600; background-color:#F5E7D8; padding:52px 7px 52px 7px; text-align:justify; border-radius:5px;"><strong style="font-size:14px !important; font-weight:600; color:#a94442">Mission:</strong> "To strive for the overall development of tobacco growers and the Indian Tobacco Industry."</div>
        
        	<div style="font-size:14px !important; font-weight:600; background-color: #E3FFDF;  padding:20px 7px 20px 7px; text-align:justify; border-radius:5px; margin-top:15px;"> <strong style="font-size:14px !important; font-weight:600; color:#a94442">Vision:</strong> "Tobacco Board is committed to accomplishing its role - the expressed will of Parliament - for the smooth functioning of a vibrant farming system, fair and remunerative prices to tobacco growers and export promotion." </div>
       
				<!--<section style="background:#dbead1; border:1px solid #ededed; border-radius:5px; text-align:center; padding:10px;">             
                
                <img src="images/chairman.png" style="width:40%;" align="middle"><br>

             <strong>  D.V.Swamy, IAS,<br>
                 Chairman</strong><br>                
				</section>
                
         <section style="background:#f4dec8; border:1px solid #ededed; border-radius:5px; text-align:center; padding:10px;">  
                
                              
                 <img src="images/ed.jpg" style="width:40%;" align="middle"><br>

               <strong> Dr. A SRIDHAR BABU, IAS,<br>
                 Executive Director</strong><br>  
					
				</section>-->
				
			</div>
		</div>
		</div>
			
			
			
			<div class="zerogrid">
		<div class="row">
		<section class="col-1-3" style="width:50%">
				<h2 style="border-bottom:2px solid #c66f2f; margin-top:0px; font-size:20px; color:#246537; text-align:center">WELCOME TO TOBACCO BOARD, MINISTRY OF COMMERCE & INDUSTRY, DEPT. OF COMMERCE, GOVT. OF INDIA</h2>
				<div class="content">
              <p align="justify" style="font-size:14px;">  
				Tobacco is one of the important commercial crops grown in India. It provides employment directly and indirectly to<span class="style1"> 45.7</span> million people and <span class="style1">Rs.12,005.89 crore </span>in terms of foreign exchange to the National exchequer during 2023-24. India has a prominent place in the production of tobacco in the world. During <span class="style1">2022</span>, India stands as<span class="style1"> 2nd largest country </span>in Production <span class="style1">(FAO Stat data, 2022)</span>, <span class="style1">2nd Largest Exporter</span> (in quantity terms) and <span class="style1">5th Largest Exporter </span>of unmanufactured tobacco (in value terms) in the world <span class="style1">(ITC Trademap data 2022)</span>. India produces different styles of Flue Cured Virginia tobacco, which vary in their physical and chemical characteristics.	</p>
<!--<img src="images/v1.jpg"/>-->	
					</div>
			</section>
			<!--<section class="col-1-3" style="width:24%">
				<h2 style="border-bottom:2px solid #c66f2f; margin-top:0px;">TWITTER</h2>
				
			</section>-->
		
		
		<section class="col-1-3" style="width:22%">
				<h2 style="border-bottom:2px solid #c66f2f; margin-top:0px; text-align:center">CHAIRMAN</h2>
				<div class="content" style="padding-top:1px; text-align:justify">
					
				<div style="background:#dbead1; border:1px solid #ededed; border-radius:5px; text-align:center; padding:10px;">             
                
                <img src="<?php echo $base_url; ?>/tbdata/members/newChairman.jpg" style="width:auto; height:150px; margin:5px;" align="middle"><br>

             		<strong>  Shri Yashwanth Kumar Chidipothu</strong><br> 
					<strong><a href="Chairman-_Profile.pdf" target="_blank">Profile</a></strong>      
				</div>
					</div>
			</section>
            <section class="col-1-3" style="width:22%">
				<h2 style="border-bottom:2px solid #c66f2f; margin-top:0px; text-align:center">EXECUTIVE DIRECTOR</h2>
				<div class="content" style="padding-top:1px; text-align:justify">
					
				<div style="background:#dbead1; border:1px solid #ededed; border-radius:5px; text-align:center; padding:10px;">             
                
                <img src="<?php echo $base_url; ?>/tbdata/members/Babu.jpg" style="width:auto; height:150px; margin:5px;" align="middle"><br>

             		<strong>  Dr. A SRIDHAR BABU, IAS</strong><br>                
				</div>
					</div>
			</section>
			
		</div>
		</div>
			<div class="zerogrid">
		<div class="row">
        	<section class="col-lg-4" style="height:350px;">
	  <div class="content" style="height:310px">
				<h2 style="border-bottom:2px solid #c66f2f;margin-top:0px;">FCV TOBACCO AUCTION PRICES</h2>
						<div class="holder" style="overflow-y:auto; height:100%">
<?php
	$statess=array('Andhra Pradesh','Karnataka');
	$states1=array('AP','KARNATAKA');
	$catgs[0]=array('NBS','NLS','SBS','SLS');
	$catgs[1]=array('Mysore','Periyapatna');
	$catgs1[0]=array('NBS','NLS','SBS','SLS');
	$catgs1[1]=array('Mysore','P.patna');
?>
  <?php 
  for($i=0;$i<2;$i++)
  {
  	$selauct=executework("select * from tob_auctsetting where state='".$statess[$i]."' and status='1'");
	$rowc=@mysqli_fetch_array($selauct);
  ?>
          
				<h5 style="border-bottom:1px solid #c66f2f;margin-top:10px; padding-bottom:0px; font-weight:bold; text-align:center"><?php echo strtoupper($statess[$i]); ?></h5>
          <table width="100%" border="0">
  <tr style="background-color: #292860; color: white; text-align: center;">
    <td style="border:solid 1px"><strong>Year</strong></td>
    <td style="border:solid 1px"><strong>Date</strong></td>
    <td style="border:solid 1px"><strong>Days</strong></td>
    <td style="border:solid 1px"><strong>Qty<br>
      (M.Kgs)</strong></td>
    <td style="border:solid 1px"><strong>Avg.<br>
      Price</strong></td>
  </tr>
  <tr>
    <td style="border:solid 1px"><?php echo $rowc['year']."(Final)"; ?></td>
    <td style="border:solid 1px"><?php echo date('d-m-Y',strtotime($rowc['sdate'])); ?></td>
    <td style="border:solid 1px"><?php echo $rowc['days']; ?></td>
    <td style="border:solid 1px"><?php echo $rowc['qty']; ?></td>
    <td style="border:solid 1px"><?php echo $rowc['avg']; ?></td>
  </tr>
  <?php
		$sel3=executework("select * from tob_auction,tob_platform where tob_auction.platf=tob_platform.id and tob_platform.state='".$statess[$i]."' and date(tdate)<='".date('Y-m-d')."' and tob_platform.isactive=1 order by tob_auction.tdate desc limit 1");
		$row=@mysqli_fetch_array($sel3);
		$adate=$row['tdate'];
		$yr=$row['year'];
		$selycnt=executework("select distinct count(distinct tdate) as cnt from tob_platform,tob_auction where tob_platform.id=tob_auction.platf and tob_platform.state='".$statess[$i]."' and date(tdate)<='".date('Y-m-d')."' and tob_auction.year=".$yr." order by cnt desc limit 1");
		$rowycnt=@mysqli_fetch_array($selycnt);
		if(!empty($rowycnt['cnt']))
		$days=$rowycnt['cnt'];
	
		$qrv=" and year ='".$yr."'";
		$selsm=executework("select sum(bsold) as bsold,sum(qsold) as qsold,sum(tvalue) as tval,sum(aprice) as apric from tob_auction where platf in(select id from tob_platform where state='".$statess[$i]."')".$qrv);
		$rows=@mysqli_fetch_array($selsm);
		$avg=$rows['tval']/$rows['qsold'];
		if($rows['qsold']>0)
		{
//			if($statess[$i]=='Karnataka')
//			$yrr=($yr-1)."-".$yr;
//			else
			$yrr=$yr
  ?>
			  
  <tr style="font-weight: bold;">
	  
    <td style="border:solid 1px"><a href="auctions.php?state=<?php echo $statess[$i]; ?>" style="text-decoration: none; color: #331c78;"><?php echo $yrr; ?></a></td>
    <td style="border:solid 1px"><a href="auctions.php?state=<?php echo $statess[$i]; ?>" style="text-decoration: none; color: #331c78;"><?php echo date('d-m-Y',strtotime($adate)); ?></a></td>
    <td style="border:solid 1px"><a href="auctions.php?state=<?php echo $statess[$i]; ?>" style="text-decoration: none; color: #331c78;"><?php echo $days; ?></a></td>
    <td style="border:solid 1px"><a href="auctions.php?state=<?php echo $statess[$i]; ?>" style="text-decoration: none; color: #331c78;"><?php echo round($rows['qsold']/1000000,2); ?></a></td>
    <td style="border:solid 1px"><a href="auctions.php?state=<?php echo $statess[$i]; ?>" style="text-decoration: none; color: #331c78;"><?php echo round($avg,2); ?></a></td>
	  
  </tr> 
  <?php
		}
	?>
</table>
         
    <?php
  }
  ?>

         
					</div>
               </div>
			</section>
            <section class="col-lg-8" style="height:350px;">
				<h2 style="border-bottom:2px solid #c66f2f;margin-top:0px;">EXPORT PERFORMANCE</h2>
				<div class="content" style="height:310px;">
						<div class="holder" style=" height:100%;  overflow-y:auto;">
				<a href="export_per.php" style="text-decoration: none; color: #331c78;">
<?php
	$variety=array('FCV','Non FCV', 'Refuse Tobacco', 'Tobacco Products', 'Un Manufactured Tobacco');
	$sel=executework("select * from tob_homexport");
	$data=array();
	while($row=@mysqli_fetch_array($sel))
	{
		$vart=$row['variety'];
		$data[$vart]=$row;
	}
	
	$selid=executework("select * from tob_gsettings where graph='Action Graph'");
	$cnt=@mysqli_num_rows($selid);
	$row=@mysqli_fetch_array($selid);
	
	$fmn=$row['export_fmonth'];
	$fyr=$row['export_fyear'];
	$tmn=$row['export_tmonth'];
	$tyr=$row['export_tyear'];

	$fcv=array('FCV','Non FCV','Refuse Tobacco','Tobacco Products','Unmanufactured Tobacco');
	$fcv1=array('FCV','Non FCV','Refuse Tobacco','Tobacco Products','Un manufactured Tobacco');
	$seldl=executework("select * from tob_dollar where id=1");
	$rowdl=@mysqli_fetch_array($seldl);
	$usd=$rowdl['dollar'];
	$selcm=executework("select month,year from tob_export order by year desc,month desc limit 1");
	$rowcm=@mysqli_fetch_array($selcm);
	/*$tyr=$rowcm['year'];
	$tmn=$rowcm['month'];
	
	if($tmn<=3)
	$eyr=$tyr-1;
	else
	$eyr=$tyr;
	$emn=4;*/
?>
			<div style="width: 48%; float: left; text-align: center; font-weight: 700; margin-right: 2%; margin-bottom:20px;"><span class="style2">CURRENT MONTH - <?php echo strtoupper(date('M y',strtotime($tyr."-".$tmn."-01"))); ?></span></div>
			<div style="width: 48%; float: left; text-align: center; font-weight: 700; margin-bottom:20px;"><span class="style2">CUMULATIVE - <?php echo date('M y',strtotime($fyr."-".$fmn."-01"))." - ".date('M y',strtotime($tyr."-".$tmn."-01")); ?></span></div>
          <table width="48%" border="0" style="margin-right:2%; float:left">
  
  <tr style="background-color: #292860; color: white; text-align: center; font-weight:bold">
    <td style="border:solid 1px">Variety</td>
    <td style="border:solid 1px">Qty<br>(M.Tons)</td>
    <td style="border:solid 1px">Value<br>(Rs Cr.)</td>
    <td style="border:solid 1px">Value<br>(M.USD)</td>
    </tr>
  <?php 
  for($i=0;$i<5;$i++)
  {
  	$vart=$variety[$i];
  ?>
  <tr>
    <td style="border:solid 1px"><?php echo $vart; ?></td>
    <td style="border:solid 1px"><div align="right"><?php echo round($data[$vart]['cqty']); //echo date('M-Y',strtotime('01-'.$rowy['mn']."-".$rowy['yr'])); ?></div></td>
    <td style="border:solid 1px"><div align="right"><?php echo round($data[$vart]['cvalr']); ?></div></td>
    <td style="border:solid 1px"><div align="right"><?php echo round($data[$vart]['cvald']); ?></div></td>
    </tr>
  <?php
  }
  ?>
</table>
			<table width="48%" border="0" style="float:left">
  
  <tr style="background-color: #292860; color: white; text-align: center; font-weight:bold">
    <td style="border:solid 1px">Variety</td>
    <td style="border:solid 1px">Qty<br>(M.Tons)</td>
    <td style="border:solid 1px">Value<br>(Rs Cr.)</td>
    <td style="border:solid 1px">Value<br>(M.USD)</td>
  </tr>
  <?php 
  for($i=0;$i<5;$i++)
  {
  	$vart=$variety[$i];
  ?>
  <tr>
    <td style="border:solid 1px"><?php echo $vart; ?></td>
    <td style="border:solid 1px"><div align="right"><?php echo round($data[$vart]['mqty']); //echo date('M-Y',strtotime('01-'.$rowy['mn']."-".$rowy['yr'])); ?></div></td>
    <td style="border:solid 1px"><div align="right"><?php echo round($data[$vart]['mvalr']); ?></div></td>
    <td style="border:solid 1px"><div align="right"><?php echo round($data[$vart]['mvald']); ?></div></td>
  </tr>
  <?php
  }
  ?>
</table>

          </a>
          		</div>
          			</div>
			</section>
	  
	  
           </div> 
		
	</div>
    
<!--   2nd-->
			<div class="zerogrid">
		<div class="row">
			<section class="col-lg-4" style="height:350px;">
				<h2 style="border-bottom:2px solid #c66f2f; margin-top:0px;">WHATS NEW</h2>
				<div class="content" style="height:310px">
						<div class="holder" style="overflow-y:hide; height:100%">
                        <marquee direction="up" onMouseOver="this.stop();" onMouseOut="this.start();" scrollamount="5" style="height:100%;">
                          <ul id="ticker01">
                          <?php 
		$archive="where home=1 and archive='0'";
		$select=executework("select * from tob_news ".$archive." order by id desc limit 3");
		$count=@mysqli_num_rows($select);
		while($rown=@mysqli_fetch_array($select))
		{
				if($rown['tfile']!="" && $rown['tfile']!='#')
				$link="tbdata/newsfiles/".$rown['tfile'];
				else
				$link="#";
				$fcheck=explode(".",$rown['tfile']);
		   ?>
      			  <li><a href="<?php echo $link?>" target="<?php  if($link!="#"){?>_blank<?php  }?>"><?php echo $rown['description']; ?></a></li>
     <?php }?>
<li style="text-align:right"><a href="news.php">More..</a></li>        

				           </ul>
                        </marquee>
                         </div>
					</div>
			</section>
	  <section class="col-lg-4">
				<h2 style="border-bottom:2px solid #c66f2f;margin-top:0px;">STATISTICS</h2>
		  <div class="content" style="height:105px;">
				<div class="holder" style="overflow-y:hide; height:100%">
                        
                          <ul id="ticker03">
                          <?php 
						  $arr=array('Production Data','Auction Data','Exports Data','Extension Data');
						  for($i=0;$i<count($arr);$i++)
						  {
		$archive="where archive='0' and stype='".$arr[$i]."'";
		$select=executework("select * from tob_statistics ".$archive." order by id desc limit 2");
		$count=@mysqli_num_rows($select);
		$rowc=@mysqli_fetch_array($select);
		if($count>0 && $rowc['tdate']>=date('Y-m-d', strtotime(date('Y-m-d'). ' - 5 days')))
		$new=1;
		else
		$new=0
//								if($count>0)
//								{
						  ?>
                          	<li style="color: #964a13; font-size: 12px !important; font-weight: 700; text-transform: uppercase; border-bottom: 0px;
 text-decoration: none; text-align:left; margin:0px 0px;"><a style="font-size:12px; color:#964a13" href="statistics.php?stype=<?php echo $arr[$i]; ?>"><?php echo $arr[$i]; ?></a><?php if($new==1){ ?><img src="new.png" width="25" height="auto" /><?php } ?></li>
                         <?php 
						  		}
/*?> <?php		while($rown=@mysqli_fetch_array($select))
		{
				if($rown['tfile']!="" && $rown['tfile']!='#')
				$link="tbdata/statisticsfiles/".$rown['tfile'];
				else
				$link="#";
				$fcheck=explode(".",$rown['tfile']);
		   ?>
      			  <li><a href="<?php echo $link?>" target="<?php  if($link!="#"){?>_blank<?php  }?>"><?php echo $rown['description']; ?></a></li>
     <?php }
	 	if($count>0)
		{
	 ?>
							  <li style="text-align:right"><a href="statistics.php?stype=<?php echo $arr[$i]; ?>">More..</a></li>
					<?php   
		}  
//	 						}
	 ?>
        <?php */?>

	              </ul>
                         
                         </div>
					</div>
                    <h2 style="border-bottom:2px solid #c66f2f;margin-top:10px;">TENDERS</h2>
		  <div class="content" style="height:158px;">
				<div class="holder" style="height:100%">
                        <marquee direction="up" onMouseOver="this.stop();" onMouseOut="this.start();" scrollamount="5" style="height:100%;">
                          <ul id="ticker02">
                          <?php 
	$archive1="where home=1 and archive='0'";
	$select=executework("select * from tob_tender ".$archive1." order by id desc limit 3");
	$count=@mysqli_num_rows($select);
	if($count>0)
	{
		while($rown=@mysqli_fetch_array($select))
		{
				if($rown['mfile']!="")
				{
					$link1="tbdata/tenderfiles/$rown[mfile]";
					$link="reg.php?pg=".$rown['mfile']."&id=".$rown['id'];
				}
				else
				$link="#";

				if($rown['subtitle1']!='' && $rown['tfile']!="")
				{
					$links1="reg.php?pg=".$rown['tfile']."&id=".$rown['id'];
				}
				else
				$links1="#";

				if($rown['subtitle2']!='' && $rown['sfile']!="")
				{
					$links2="reg.php?pg=".$rown['sfile']."&id=".$rown['id'];
				}
				else
				$links2="#";
				
				$fcheck=explode(".",$rown['tfile']);
		   ?>
      			  <li>
            <?php  if($rown['isactive']=='0') { ?>
            <a href="#" onClick="show_pop('<?php  echo $link ?>')">
            <?php  echo $rown['description']; ?>
            </a>
            <?php if($rown['subtitle1']!='') { ?>
            &nbsp;&nbsp;&nbsp;<a href="#" <?php if($links1!='#' && $links1!='') { ?>onClick="show_pop('<?php  echo $links1; ?>');" <?php } ?>>
            <?php  echo $rown['subtitle1']; ?>
            </a>
            <?php } if($rown['subtitle2']!='') { ?>
            &nbsp;&nbsp;&nbsp; <a href="#" <?php if($links2!='#' && $links2!='') { ?>onClick="show_pop('<?php  echo $links2 ?>')" <?php } ?>>
            <?php  echo $rown['subtitle2']; ?>
            </a>
            <?php } ?>
            &nbsp;&nbsp;&nbsp;
            <?php  } else { ?>
            <a href="#"><?php echo $rown['description']; ?></a>
            <?php  }?>
          </li>
          <?php 
		}
	?>
							  <li style="text-align:right"><a href="tenders.php">More..</a></li>
        
        <?php 
	}
?>			</ul>
</marquee>
                         </div>
					</div>
				
			</section>		
	  <section class="col-lg-4" style="height:350px;">
				<h2 style="border-bottom:2px solid #c66f2f;margin-top:0px;">CIRCULARS</h2>
	  <div class="content" style="height:85px">
						<div class="holder" style="overflow-y:hide; height:100%">
                        
                          <ul id="ticker05">
                          <?php 
						  $arr=array('Grower Community','Trader Community','Official');
						  for($i=0;$i<count($arr);$i++)
						  {
		$archive="where archive='0' and stype='".$arr[$i]."'";
		$select=executework("select * from tob_circulars ".$archive." order by id desc limit 1");
		$count=@mysqli_num_rows($select);
		$rowc=@mysqli_fetch_array($select);
		if($count>0 && $rowc['ndate']>=date('Y-m-d', strtotime(date('Y-m-d'). ' - 5 days')))
		$new=1;
		else
		$new=0
//								if($count>0)
//								{
						  ?>
                          	<li style="color: #964a13; font-size: 12px !important; font-weight: 700; text-transform: uppercase; border-bottom: 0px;
 text-decoration: none; text-align:left; margin:0px 0px;"><a style="font-size:12px; color:#964a13" href="circulars.php?stype=<?php echo $arr[$i]; ?>"><?php echo $arr[$i]; ?></a><?php if($new==1){ ?><img src="new.png" width="25" height="auto" /><?php } ?></li>
                          <?php
						  		}
 /*?>		while($rown=@mysqli_fetch_array($select))
		{
				if($rown['tfile']!="" && $rown['tfile']!='#')
				$link="tbdata/circularfiles/".$rown['tfile'];
				else
				$link="#";
				$fcheck=explode(".",$rown['tfile']);
		   ?>
      			  <li><a href="<?php echo $link?>" target="<?php  if($link!="#"){?>_blank<?php  }?>"><?php echo $rown['description']; ?></a></li>
     <?php }
	 	if($count>0)
		{
	 ?>
							  <li style="text-align:right"><a href="circulars.php?stype=<?php echo $arr[$i]; ?>">More..</a></li>
					<?php   
		}  
	 					}<?php */?>
	 
        

				           </ul>
                         </marquee>
                         </div>
               </div>
               <h2 style="border-bottom:2px solid #c66f2f; margin-top:10px;">PUBLICATIONS</h2>
				<div class="content" style="height:178px">
						<div class="holder" style="overflow-y:hide; height:100%">
                        <!--<marquee direction="up" onMouseOver="this.stop();" onMouseOut="this.start();" scrollamount="5" style="height:100%;">-->
                          <ul id="ticker04">
                          <?php 
		$archive="where home=1 and archive='0'";
		$select=executework("select * from tob_publications ".$archive." order by id desc limit 2");
		$count=@mysqli_num_rows($select);
		while($rown=@mysqli_fetch_array($select))
		{
				if($rown['tfile']!="" && $rown['tfile']!='#')
				$link="tbdata/publicationsfiles/".$rown['tfile'];
				else
				$link="#";
				$fcheck=explode(".",$rown['tfile']);
		   ?>
      			  <li><a href="<?php echo $link?>" target="<?php  if($link!="#"){?>_blank<?php  }?>"><?php echo $rown['description']; ?></a></li>
     <?php }
	 	if($count>0)
		{
	 ?>
							  <li style="text-align:right"><a href="publications.php">More..</a></li>
					<?php   
		}  
	 ?>
        

				           </ul>
                        <!--</marquee>-->
                         </div>
					</div>
			</section>
	  
           </div> 
		
	</div>
  
	<div class="zerogrid">
		<div class="row">
		
            
	  
			
	  <section class="col-lg-12">
				<h2 style="border-bottom:2px solid #c66f2f;margin-top:0px;">PHOTO GALLERY</h2>
		  <div class="content" style="height:230px;">
				<div class="holder" style="height:100%">
				<marquee direction="left" onMouseOver="this.stop();" onMouseOut="this.start();" loop>
                        <?php 
				  while($rowp=@mysqli_fetch_array($selectp))
				  {
				  	if(!empty($rowp['image']) && file_exists($base_path."/tbdata/photogallery/oimages/".$rowp['image']))
					{
				  ?>
				<a href="viewphotos.php?tit=<?php echo urlencode($rowp['titleid']); ?>"><img src="http://tobaccoboard.com/tbdata/photogallery/oimages/<?php  echo $rowp['image'] ?>?v=<?php echo time(); ?>" style="height:230px; width:auto" height="180" width="auto"></a>
                   <?php 
				   	}
				  }
				  ?>    
                        </marquee>
                      </div>
                  </div>
				
			</section>
            <section class="col-lg-12">
            	<div class="content" style="text-align:center; margin-top: 20px; width:190px; float:left">
						<a href="http://tobaccoboard.in" target="_blank">
      <img src="<?php echo $base_url; ?>/img/ad1.jpg" style="width:180px; height:85px" />
      </a> 
					</div>
				
		  
				<div class="content" style="text-align:center; margin-top: 20px; width:190px; float:left">
						<a href="https://www.tobaccoboard-eoffice.com/tb-grower/" target="_blank">
      <img src="<?php echo $base_url; ?>/img/ad4new.jpg" style="width:180px; height:85px" />
      </a> 
					</div>
                    <div class="content" style="text-align:center; margin-top: 20px; padding:0px; width:200px; float:left;border: solid 2px #505050; height: 85px;">
						 <strong style="color: #c17b3e; font-family: arial; font-size: 15px;">Emergency Security Alert</strong> <br><a style="font-size: 14px; font-weight: bold; color: #264185;" href="tbdata/pdf/Critical_Advisory_in_view_of_G20_Summit.pdf" target="_blank">Attachment 1</a> <br>  <a style="font-size: 14px; font-weight: bold; color: #264185;" href="tbdata/pdf/Advisory_CIAD_2023_S3.pdf" target="_blank">Attachment 2</a> <br>  <a style="font-size: 14px; font-weight: bold; color: #264185;" href="tbdata/pdf/NR_239_GR_500.jpg" target="_blank">Attachment 3</a>	
					</div>
                    
                    <div class="content" style="text-align:center; margin-top: 20px; padding:0px; width:160px; float:left;border: solid 2px #505050; height: 85px; margin-left:5px;">
						 <strong style="color: #c17b3e; font-family: arial; font-size: 15px;">Stay Safe Online</strong> <br><a style="font-size: 14px; font-weight: bold; color: #264185;" href="https://www.mygov.in/staysafeonline" target="_blank">Awareness topics 
</a> <br>  <a style="font-size: 14px; font-weight: bold; color: #264185;" href="https://staysafeonline.in/awareness-material" target="_blank">Awareness material</a>	
					</div>
				
				   <div class="content" style="text-align:center; margin-top: 20px; padding:10px; padding-top:20px; width:160px; float:left;border: solid 2px #505050; height: 85px; margin-left:5px;">
						 <a style="font-size: 14px; font-weight: bold; color: #264185;" href="https://www.cvc.gov.in/?q=guidelines/tender-guidelines" target="_blank">CVC guidelines for Tender process
</a> <br>  
					</div>
				
				<div class="content" style="text-align:center; margin-top: 20px; padding:10px; padding-top:20px; width:160px; float:left;border: solid 2px #505050; height: 85px; margin-left:5px;">
						 <a style="font-size: 14px; font-weight: bold; color: #264185;" href="video.php">Tobacco Board PIDPI
</a> <br>  
					</div>
				
			<!--	<div class="content" style="text-align:center; margin-top: 5px; padding:2px; width:190px; float:left;border: solid 2px #505050; height: 85px; margin-left:5px;">
						 <strong style="color: #c17b3e; font-family: arial; font-size: 15px;"></strong> <br><a style="font-size: 14px; font-weight: bold; color: #264185;" href="webex.php">Webex Meeting Details on 12-12-23 from 11.30 A.M. to 2.00 P.M.
</a> <br>  
					</div>-->
			</section>
            
		</div>
	</div>
		</div>
		
	</div>
	
	
</section>

<!--------------Footer--------------->
<?php  include "tb_footer.php"; ?>
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
 //   $("ul#ticker01").liScroll();
    //$("ul#ticker02").liScroll();
//    $("ul#ticker03").liScroll();
//    $("ul#ticker04").liScroll();
//    $("ul#ticker05").liScroll();
});
</script>


</body></html>