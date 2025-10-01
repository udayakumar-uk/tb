<?php 
ob_start();
@session_start();
include "include/include.php";
$selcont=executework("select * from tob_cms where pageid=41");
$rowc=@mysql_fetch_array($selcont);?>
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
	<meta name="description" content="Free Html5 Templates and Free Responsive Themes Designed by Kimmy | zerotheme.com">
	<meta name="author" content="www.zerotheme.com">
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
</head>
<body>
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
					<div class="breadcrumb flat">
	<a href="index.php" class="active">Home</a>
	<a href="#">Auction Procedures</a>
	<a href="#">Board Activities</a>
	
</div>
                   <!-- <p><span class="navclass"> <a href="index.php" style="color:#FFFFFF" >Home</a></span>  &nbsp; &raquo;&nbsp; 
	 	                   <span class="navclass"><a href="#" style="color:#FFFFFF"> Auction Procedures</a></span>  &nbsp; &raquo;&nbsp; 
                           <span class="navclass"><a href="#" style="color:#FFFFFF"> Board Activities</a></span>
                      </p>-->
						<!--<h2><a href="#">Sample post with, links, paragraphs and comments</a></h2>-->
						<!--<p class="info">>>> Posted by Admin - 01/01/2012 - 0 Comments</p>-->
					</div>
					<div class="content" style="padding-top:15px; text-align:justify">
                          <?php echo $rowc['content'] ?>
						  
						  
						  
						  <div><span class="headtitles">Introduction</span>
<p>The auction system was introduced for the sale of FCV tobacco for the first time in India at Karnataka State (Mysore) in 1984 and at Andhra Pradesh in 1985..</p>
<p>The Board has established and operating 12 auction platforms in Karnataka and 20 auction platforms in Andhra Pradesh. The location of auction platforms being operated by the Board are.</p>
<span class="headtitles">Buyer Activities</span>
<p>Every year, on application, Board grants authorization to buyers who intend to operate and buy tobacco on auction platform(s). The buyers authorized, on submission of Bank Guarantee or Letter of Standing Instructions (LSI) from Bank or Payment by a Bank Draft in advance, will be permitted on the auction platform for buying tobacco.</p>
</div>
<div>
<div class="rightcorner1">
<div class="innercontent">
<table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td valign="top" width="52%"><br /> <span><strong>Location of Auction Platforms in Karnataka&nbsp;</strong></span></td>
<td width="48%"><br /> <span><strong>Location of Auction Platforms in Andhra Pradesh</strong></span></td>
</tr>
<tr>
<td valign="top">
<table style="width: 90%;" border="0" cellspacing="1" cellpadding="5" align="left" bgcolor="#E7E6E6">
<tbody>
<tr>
<td bgcolor="#FF9900" width="44">
<div align="center">S.No.</div>
</td>
<td bgcolor="#FF9900" width="127">
<div align="center">Auction platform code No.</div>
</td>
<td bgcolor="#FF9900" width="206">
<div align="center">Location of the auction platform</div>
</td>
<td bgcolor="#FF9900" width="117">
<div align="center">District</div>
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF" width="44">
<p align="center">1</p>
</td>
<td bgcolor="#FFFFFF" width="127">
<p align="center">1</p>
</td>
<td bgcolor="#FFFFFF" width="206">
<p>H.D. Kote &ndash; I</p>
</td>
<td bgcolor="#FFFFFF" width="117">
<p>Mysore</p>
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF" width="44">
<p align="center">2</p>
</td>
<td bgcolor="#FFFFFF" width="127">
<p align="center">65</p>
</td>
<td bgcolor="#FFFFFF" width="206">
<p>H.D. Kote &ndash; II</p>
</td>
<td bgcolor="#FFFFFF" width="117">
<p>Mysore</p>
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF" width="44">
<p align="center">3</p>
</td>
<td bgcolor="#FFFFFF" width="127">
<p align="center">2</p>
</td>
<td bgcolor="#FFFFFF" width="206">
<p>Hunsur &ndash; I</p>
</td>
<td bgcolor="#FFFFFF" width="117">
<p>Mysore</p>
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF" width="44">
<p align="center">4</p>
</td>
<td bgcolor="#FFFFFF" width="127">
<p align="center">3</p>
</td>
<td bgcolor="#FFFFFF" width="206">
<p>Hunsur &ndash; II</p>
</td>
<td bgcolor="#FFFFFF" width="117">
<p>Mysore</p>
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF" width="44">
<p align="center">5</p>
</td>
<td bgcolor="#FFFFFF" width="127">
<p align="center">64</p>
</td>
<td bgcolor="#FFFFFF" width="206">
<p>Hunsur &ndash; III</p>
</td>
<td bgcolor="#FFFFFF" width="117">
<p>Mysore</p>
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF" width="44">
<p align="center">6</p>
</td>
<td bgcolor="#FFFFFF" width="127">
<p align="center">4</p>
</td>
<td bgcolor="#FFFFFF" width="206">
<p>Periyapatna &ndash; I</p>
</td>
<td bgcolor="#FFFFFF" width="117">
<p>Mysore</p>
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF" width="44">
<p align="center">7</p>
</td>
<td bgcolor="#FFFFFF" width="127">
<p align="center">5</p>
</td>
<td bgcolor="#FFFFFF" width="206">
<p>Periyapatna &ndash; II</p>
</td>
<td bgcolor="#FFFFFF" width="117">
<p>Mysore</p>
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF" width="44">
<p align="center">8</p>
</td>
<td bgcolor="#FFFFFF" width="127">
<p align="center">6</p>
</td>
<td bgcolor="#FFFFFF" width="206">
<p>Periyapatna &ndash; III</p>
</td>
<td bgcolor="#FFFFFF" width="117">
<p>Mysore</p>
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF" width="44">
<p align="center">9</p>
</td>
<td bgcolor="#FFFFFF" width="127">
<p align="center">7</p>
</td>
<td bgcolor="#FFFFFF" width="206">
<p>Ramanadhapura &ndash; I</p>
</td>
<td bgcolor="#FFFFFF" width="117">
<p>Hassan</p>
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF" width="44">
<p align="center">10</p>
</td>
<td bgcolor="#FFFFFF" width="127">
<p align="center">63</p>
</td>
<td bgcolor="#FFFFFF" width="206">
<p>Ramanadhapura &ndash; II</p>
</td>
<td bgcolor="#FFFFFF" width="117">
<p>Hassan</p>
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF" width="44">
<p align="center">11</p>
</td>
<td bgcolor="#FFFFFF" width="127">
<p align="center">61</p>
</td>
<td bgcolor="#FFFFFF" width="206">
<p>Kampalapura &ndash; I</p>
</td>
<td bgcolor="#FFFFFF" width="117">
<p>Mysore</p>
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF" width="44">
<p align="center">12</p>
</td>
<td bgcolor="#FFFFFF" width="127">
<p align="center">62</p>
</td>
<td bgcolor="#FFFFFF" width="206">
<p>Chilkunda</p>
</td>
<td bgcolor="#FFFFFF" width="117">
<p>Mysore</p>
</td>
</tr>
</tbody>
</table>
</td>
<td valign="top">
<table style="width: 486px;" border="0" cellspacing="1" cellpadding="5" align="left" bgcolor="#E7E6E6">
<tbody>
<tr>
<td bgcolor="#FF9900" width="24">
<p align="center">Sl. No.</p>
</td>
<td bgcolor="#FF9900" width="153">
<p align="center">Auction platform code No.</p>
</td>
<td bgcolor="#FF9900" width="134">
<p align="center">Location of the auction platform</p>
</td>
<td bgcolor="#FF9900" width="130">
<p align="center">District</p>
</td>
</tr>
<tr>
<td colspan="4" bgcolor="#FFFFFF">
<p>Northern Black Soils</p>
</td>
</tr>
<tr>
<td valign="top" bgcolor="#FFFFFF">
<p align="center">1</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="153">
<p align="center">15</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="134">
<p>Thorredu</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="130">
<p>East Godavari</p>
</td>
</tr>
<tr>
<td colspan="4" valign="top" bgcolor="#FFFFFF">
<p>Southern Black Soils</p>
</td>
</tr>
<tr>
<td valign="top" bgcolor="#FFFFFF">
<p align="center">2</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="153">
<p align="center">19</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="134">
<p>Vellampalli &ndash; I</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="130">
<p>Prakasam</p>
</td>
</tr>
<tr>
<td valign="top" bgcolor="#FFFFFF">
<p align="center">3</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="153">
<p align="center">31</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="134">
<p>Vellampalli &ndash; II</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="130">
<p>Prakasam</p>
</td>
</tr>
<tr>
<td valign="top" bgcolor="#FFFFFF">
<p align="center">4</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="153">
<p align="center">20</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="134">
<p>Ongole &ndash; I</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="130">
<p>Prakasam</p>
</td>
</tr>
<tr>
<td valign="top" bgcolor="#FFFFFF">
<p align="center">5</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="153">
<p align="center">23</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="134">
<p>Ongole &ndash; II</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="130">
<p>Prakasam</p>
</td>
</tr>
<tr>
<td valign="top" bgcolor="#FFFFFF">
<p align="center">6</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="153">
<p align="center">24</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="134">
<p>Tangutur &ndash; I</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="130">
<p>Prakasam</p>
</td>
</tr>
<tr>
<td valign="top" bgcolor="#FFFFFF">
<p align="center">7</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="153">
<p align="center">34</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="134">
<p>Tangutur &ndash; II</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="130">
<p>Prakasam</p>
</td>
</tr>
<tr>
<td valign="top" bgcolor="#FFFFFF">
<p align="center">8</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="153">
<p align="center">25</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="134">
<p>Kondepi</p>

</td>
<td valign="top" bgcolor="#FFFFFF" width="130">
<p>Prakasam</p>
</td>
</tr>
<tr>
<td colspan="4" valign="top" bgcolor="#FFFFFF">
<p>Southern Light Soils</p>
</td>
</tr>
<tr>
<td valign="top" bgcolor="#FFFFFF">
<p align="center">9</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="153">
<p align="center">21</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="134">
<p>Podili &ndash; II</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="130">
<p>Prakasam</p>
</td>
</tr>
<tr>
<td valign="top" bgcolor="#FFFFFF">
<p align="center">10</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="153">
<p align="center">22</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="134">
<p>Podili &ndash; I</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="130">
<p>Prakasam</p>
</td>
</tr>
<tr>
<td valign="top" bgcolor="#FFFFFF">
<p align="center">11</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="153">
<p align="center">26</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="134">
<p>Kandukur &ndash; I</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="130">
<p>Prakasam</p>
</td>
</tr>
<tr>
<td valign="top" bgcolor="#FFFFFF">
<p align="center">12</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="153">
<p align="center">27</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="134">
<p>Kandukur &ndash; II</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="130">
<p>Prakasam</p>
</td>
</tr>
<tr>
<td valign="top" bgcolor="#FFFFFF">
<p align="center">13</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="153">
<p align="center">28</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="134">
<p>Kaligiri</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="130">
<p>Nellore</p>
</td>
</tr>
<tr>
<td valign="top" bgcolor="#FFFFFF">
<p align="center">14</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="153">
<p align="center">29</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="134">
<p>D.C.Palli</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="130">
<p>Nellore</p>
</td>
</tr>
<tr>
<td valign="top" bgcolor="#FFFFFF">
<p align="center">15</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="153">
<p align="center">35</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="134">
<p>Kanigiri</p>
</td>
<td valign="top" bgcolor="#FFFFFF" width="130">
<p>Prakasam</p>
</td>
</tr>
<tr>
<td colspan="4" valign="top" bgcolor="#FFFFFF">
<p>Northern Light Soils</p>
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF">
<p align="center">16</p>
</td>
<td bgcolor="#FFFFFF" width="153">
<p align="center">17</p>
</td>
<td bgcolor="#FFFFFF" width="134">
<p>Devarapalli</p>
</td>
<td bgcolor="#FFFFFF" width="130">
<p>West Godavari</p>
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF">
<p align="center">17</p>
</td>
<td bgcolor="#FFFFFF" width="153">
<p align="center">18</p>
</td>
<td bgcolor="#FFFFFF" width="134">
<p>Jangareddygudem &ndash; I</p>
</td>
<td bgcolor="#FFFFFF" width="130">
<p>West Godavari</p>
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF">
<p align="center">18</p>
</td>
<td bgcolor="#FFFFFF" width="153">
<p align="center">32</p>
</td>
<td bgcolor="#FFFFFF" width="134">
<p>Jangareddygudem &ndash; II</p>
</td>
<td bgcolor="#FFFFFF" width="130">
<p>West Godavari</p>
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF">
<p align="center">19</p>
</td>
<td bgcolor="#FFFFFF" width="153">
<p align="center">30</p>
</td>
<td bgcolor="#FFFFFF" width="134">
<p>Koyyalagudem</p>
</td>
<td bgcolor="#FFFFFF" width="130">
<p>West Godavari</p>
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF">
<p align="center">20</p>
</td>
<td bgcolor="#FFFFFF" width="153">
<p align="center">33</p>
</td>
<td bgcolor="#FFFFFF" width="134">
<p>Gopalapuram</p>
</td>
<td bgcolor="#FFFFFF" width="130">
<p>West Godavari</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<div align="left">&nbsp;</div>
<div align="left"><span class="headtitles"><br /></span></div>
</div>
</div>
</div>
						<!--<p style="font-size:13px;">"To strive for the overall development of tobacco growers and the Indian Tobacco Industry."<br><br>
						"Tobacco Board is committed to accomplishing its role - the expressed will of parliament - for the smooth functioning of a vibrant farming system, fair and remunerative prices to tobacco growers and export promotion."<br><br>
						Recognizing the need to regulate production, promote overseas marketing and control recurring instances of imbalances in supply and demand, which lead to market problems, the Government of India under the Tobacco Board Act of 1975, established the Tobacco Board, in place of the Tobacco Export Promotion Council. The Board came into existence from 1-1-1976 and opened its head quarters at Guntur in Andhra Pradesh, India.

The Tobacco Board Act aims at planned development of Tobacco Industry in the country. The various activities of the Board outlined in the Act for the promotion of the industry are-

    Regulating the production and curing of Virginia Tobacco with regard to the demand in India and abroad.

    Constant monitoring of the Virginia tobacco market, both in India and abroad and ensuring fair and remunerative price to the growers and reducing wide fluctuations in the prices of the commodity.

    Sustaining and improving the existing international markets and developing new markets overseas for Indian Virginia Tobacco and its products and devising marketing strategies in consonance with demand for the commodity including group marketing under limited brand names.

    Establishing auction platforms for sale of Virginia tobacco by registered growers and functioning as an auctioneer at auction platforms either established by it or registered with it.

    Recommending to the Central Government the minimum prices to be fixed for exportable Virginia tobacco with a view to avoiding unhealthy competition amongst the exporters. (Under its Exim policy, the Government decided to abolish fixation of M.E.P. with effect from 1-4-1993).

    Regulating other aspects of Virginia tobacco marketing in India and export of Virginia tobacco having due regard to the interests of growers, manufacturers, dealers and the nation.

    Propagating information useful to the growers, dealers and exporters (including packers) of Virginia tobacco and manufacturers of tobacco products and others concerned.

    Purchasing Virginia tobacco from growers when the same is considered necessary or expedient for protecting the interests of the growers and disposing it in India or abroad as and when considered appropriate.

    Promoting tobacco grading at the level of growers.

    Sponsoring, assisting, co-coordinating or encouraging scientific, technological and economic research for promotion of tobacco industry.

 </p>-->
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


</body></html>