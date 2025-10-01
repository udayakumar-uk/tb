<?php 
ob_start();
@session_start();
include "include/include.php";
$selectp=executework("select * from tob_album_title,tob_images where tob_album_title.id=tob_images.titleid order by tob_images.cover,tob_album_title.position desc,tob_images.position desc limit 5");
$countp=@mysqli_num_rows($selectp);
$base_url="https://".$_SERVER['SERVER_NAME'];
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
        maxwidth: 800,
        namespace: "centered-btns"
      });
    });
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
</style>    
</head>
<body>
<?php include "tb_header.php"; ?>
<section id="content">
	<div class="zerogrid">
		<div class="row block">
			<div class="main-content col11">
			
				<div class="rslides_container">
					<ul class="rslides" id="slider" style="padding-left:0px; max-width:100%">
						<li  style="padding-left:0px"><img src="images/b1.jpg"/></li>
						<li  style="padding-left:0px"><img src="images/b2.jpg"/></li>
						<li  style="padding-left:0px"><img src="images/b3.jpg"/></li>
						<li  style="padding-left:0px"><img src="images/b4.jpg"/></li>
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
        	<div style="font-size:14px !important; font-weight:600; background-color:#F5E7D8; padding:20px 7px 20px 7px; text-align:justify; border-radius:5px;"><strong style="font-size:14px !important; font-weight:600; color:#a94442">Mission:</strong> "To strive for the overall development of tobacco growers and the Indian Tobacco Industry."</div>
        
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
              <p align="justify" style="font-size:13px;">  Tobacco is one of the important commercial crops grown in India. It provides employment directly and indirectly to 45.7 million people and Rs.6,529.30 crore in terms of foreign exchange to the National exchequer. During 2021-22. India has a prominent place in the production of tobacco in the world. During 2021, India stands as 2nd largest country in production and during the period, India stands as 3rd largest exporter of unmanufactured tobacco in the world. India produces different styles of Flue Cured Virginia tobacco, which vary in their physical and chemical characteristics.  </p>
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
                
                <img src="<?php echo $base_url; ?>/tbdata/members/CM_DVswamy.jpg" style="width:auto; height:150px; margin:5px;" align="middle"><br>

             		<strong>  D.V.Swamy, IAS</strong><br>                
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
				<h2 style="border-bottom:2px solid #c66f2f; margin-top:0px;">WHATS NEW</h2>
				<div class="content" style="height:310px">
						<div class="holder" style="overflow-y:hide; height:100%">
                          <ul id="ticker01">
                          <?php 
		$archive="where home=1 and archive='0'";
		$select=executework("select * from tob_news ".$archive." order by id desc limit 2");
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
        

				           </ul>
                         </div>
					</div>
			</section>
	  <section class="col-lg-4" style="height:350px;">
	  <div class="content" style="height:310px">
				<h2 style="border-bottom:2px solid #c66f2f;margin-top:0px;">AUCTION PRICES</h2>
						<div class="holder" style="overflow-y:hide; height:100%">
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
  ?>
          <!--<a href="auctions.php" style="text-decoration: none; color: #331c78;">-->
				<h5 style="border-bottom:1px solid #c66f2f;margin-top:20px; text-align:center"><?php echo strtoupper($statess[$i]); ?></h5>
          <table width="100%" border="0">
  <tr style="background-color: #292860; color: white; text-align: center;">
    <td style="border:solid 1px"><strong>Year</strong></td>
    <td style="border:solid 1px"><strong>Date</strong></td>
    <td style="border:solid 1px"><strong>Days</strong></td>
    <td style="border:solid 1px"><strong>Qty<br>
      (Kgs)</strong></td>
    <td style="border:solid 1px"><strong>Cum.<br>
      Price</strong></td>
  </tr>
  <?php
  	//for($j=0;$j<count($catgs[$i]);$j++)
	//{
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
  ?>
  <tr>
    <td style="border:solid 1px"><?php echo $yr; ?></td>
    <td style="border:solid 1px"><?php echo date('d-m-Y',strtotime($adate)); ?></td>
    <td style="border:solid 1px"><?php echo $days; ?></td>
    <td style="border:solid 1px"><?php echo round($rows['qsold']); ?></td>
    <td style="border:solid 1px"><?php echo round($avg); ?></td>
  </tr>
  <?php
		}
  	//}
	?>
</table>
    <?php
  }
  ?>

         <!-- </a>-->
         
					</div>
               </div>
			</section>
	  <section class="col-lg-4" style="height:350px;">
				<h2 style="border-bottom:2px solid #c66f2f;margin-top:0px;">EXPORT PERFORMANCE</h2>
				<div class="content" style="height:310px">
						<div class="holder" style="overflow-y:scroll; height:100%">
				<a href="export_per.php" style="text-decoration: none; color: #331c78;">
          <table width="100%" border="0">
<?php
	$fcv=array('FCV','Tobacco Products','Unmanufactured Tobacco');
	$fcv1=array('FCV','TP','UT');
?>
  <tr style="background-color: #292860; color: white; text-align: center; font-weight:bold">
    <td rowspan="2" style="border:solid 1px">Variety</td>
    <td colspan="2" style="border:solid 1px">Current Month</td>
    <td colspan="2" style="border:solid 1px">Prev Month</td>
    </tr>
  <tr style="background-color: #292860; color: white; text-align: center; font-weight:bold">
    <td style="border:solid 1px">Qty<br>(Tons)</td>
    <td style="border:solid 1px">Value<br>(Rs)</td>
    <td style="border:solid 1px">Qty<br>(Tons)</td>
    <td style="border:solid 1px">Value<br>(Rs)</td>
  </tr>
  <?php 
  for($i=0;$i<3;$i++)
  {
	$selmaxy=executework("select max(year) as yr,max(month) as mn from tob_export where catg='".$fcv[$i]."' group by year order by year desc limit 1
	");
	$rowy=@mysqli_fetch_array($selmaxy);
	$mnn=date('Y-m-d',strtotime('01-'.$rowy['mn']."-".$rowy['yr']));
	$pm=date('n',strtotime('-1 month',strtotime($mnn)));
	$py=date('Y',strtotime('-1 month',strtotime($mnn)));
	$self=executework("SELECT catg,month,year,ROUND(quantity,0) as qty,ROUND(value,0) as gval from tob_export where isactive=1 and month=".$rowy['mn']." and year=".$rowy['yr']." and catg='".$fcv[$i]."'");
	$rowf=@mysqli_fetch_array($self);

	$self1=executework("SELECT catg,month,year,ROUND(quantity,0) as qty,ROUND(value,0) as gval from tob_export where isactive=1 and month=".$pm." and year=".$py." and catg='".$fcv[$i]."'");
	$rowf1=@mysqli_fetch_array($self1);

  ?>
  <tr>
    <td style="border:solid 1px"><?php echo $fcv1[$i]; ?></td>
    <td style="border:solid 1px"><div align="right"><?php echo $rowf['qty']; //echo date('M-Y',strtotime('01-'.$rowy['mn']."-".$rowy['yr'])); ?></div></td>
    <td style="border:solid 1px"><div align="right"><?php echo $rowf['gval']; ?></div></td>
    <td style="border:solid 1px"><div align="right"><?php echo $rowf1['qty']; //echo date('M-Y',strtotime('01-'.$rowy['mn']."-".$rowy['yr'])); ?></div></td>
    <td style="border:solid 1px"><div align="right"><?php echo $rowf1['gval']; ?></div></td>
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
  
	<div class="zerogrid">
		<div class="row">
		<section class="col-lg-4">
				<h2 style="border-bottom:2px solid #c66f2f;margin-top:0px;">TENDERS</h2>
		  <div class="content" style="height:350px;">
				<div class="holder" style="overflow-y:scroll; height:100%">
                          <ul id="ticker01">
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
        </ul>
        <?php 
	}
?>
                         </div>
					</div>
			</section>
	  <section class="col-lg-4">
				<h2 style="border-bottom:2px solid #c66f2f;margin-top:0px;">STATISTICS</h2>
		  <div class="content" style="height:230px;">
				<div class="holder" style="overflow-y:hide; height:100%">
                          <ul id="ticker01">
                          <?php 
		$archive="where home=1 and archive='0'";
		$select=executework("select * from tob_statistics ".$archive." order by id desc limit 3");
		$count=@mysqli_num_rows($select);
		while($rown=@mysqli_fetch_array($select))
		{
				if($rown['tfile']!="" && $rown['tfile']!='#')
				$link="tbdata/statisticsfiles/".$rown['tfile'];
				else
				$link="#";
				$fcheck=explode(".",$rown['tfile']);
		   ?>
      			  <li><a href="<?php echo $link?>" target="<?php  if($link!="#"){?>_blank<?php  }?>"><?php echo $rown['description']; ?></a></li>
     <?php }?>
        

				           </ul>
                         </div>
					</div>
				<div class="content" style="text-align:center; margin-top: 20px;">
						<a href="#">
      <img src="<?php echo $base_url; ?>/img/ad1.jpg" style="width:200px; height:auto" />
      </a> 
					</div>
			</section>
			
	  <section class="col-lg-4">
				<h2 style="border-bottom:2px solid #c66f2f;margin-top:0px;">PHOTO GALLERY</h2>
		  <div class="content" style="height:230px;">
				<div class="holder" style="height:100%">
				<marquee direction="left" onMouseOver="this.stop();" onMouseOut="this.start();" loop>
                        <?php 
				  while($rowp=@mysqli_fetch_array($selectp))
				  {
				  	if(!empty($rowp['image']) && file_exists($base_url."/tbdata/photogallery/oimages/".$rowp['image']))
					{
				  ?>
				<a href="viewphoto.php?tit=<?php echo urlencode($rowp['title']); ?>"><img src="http://tobaccoboard.com/tbdata/photogallery/oimages/<?php  echo $rowp['image'] ?>" style="height:230px; width:auto" height="180" width="auto"></a>
                   <?php 
				   	}
				  }
				  ?>    
                        </marquee>
                      </div>
                  </div>
				<div class="content" style="text-align:center; margin-top: 20px;">
						<a href="#">
      <img src="<?php echo $base_url; ?>/img/ad4new.jpg" style="width:200px; height:auto" />
      </a> 
					</div>
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
    $("ul#ticker01").liScroll();
});
</script>


</body></html>