<?php 
ob_start();
@session_start();
include "include/include.php";
$selcont=executework("select * from tob_cms where pageid=83");
$rowc=@mysqli_fetch_array($selcont);?>
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
					<div id="breadcrumbs-four">
    <a href="index.php">Home</a>
    <a href="#">Sitemap</a></div>
                  <!--<p><span class="navclass"> <a href="index.php" style="color:#FFFFFF" >Home</a></span>  &nbsp; &raquo;&nbsp; 
	 	                   <span class="navclass"><a href="#" style="color:#FFFFFF"> Exports</a></span>  &nbsp; &raquo;&nbsp; 
                           <span class="navclass"><a href="#" style="color:#FFFFFF"> Assistance to Exporters </a></span>
                      </p>-->
						<!--<h2><a href="#">Sample post with, links, paragraphs and comments</a></h2>-->
						<!--<p class="info">>>> Posted by Admin - 01/01/2012 - 0 Comments</p>-->
					</div>
					<div class="content" style="padding-top:15px; text-align:justify">
                          <p style="font-size:13px;">&nbsp;</p>
                          <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                              <td height="30" align="justify"><div class="rightcorner1">
                                <div class="innercontent">
                                  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td valign="top" style="padding: 10px; background-color: #fdf7ef;"><ul style="width:30%; float:left">
        <li><a href="index.php">Home</a></li>
        <li>
          <a href="#">About Us</a>
          <ul>
            <li><a href="bactivities.php">Board&nbsp;Activities</a></li>
            <li><a href="#" tabindex="-1">Board&nbsp;Act&nbsp;&&nbsp;Rules</a>
                <ul>
                    <li><a href="act.php">Board&nbsp;Act</a></li>
                    <li><a href="forms.php">Forms</a></li>
                </ul>
            </li>
            <li><a href="bmembers.php">Board Members</a></li>
            <li><a href="orgchart.php">Organization&nbsp;Chart</a></li>
            <li><a href="contactus.php">Administrative&nbsp;Offieces</a></li>
            <li><a href="#" tabindex="-1">Employees Corner</a>
                <ul>
                    <li><a href="empcorner.php?stype=Transfers And Postings">Transfers&nbsp;&&nbsp;Postings</a></li>
                    <li><a href="empcorner.php?stype=Appointment Orders">Appointment&nbsp;Orders</a></li>
                    <li><a href="empcorner.php?stype=Promotions">Promotions</a></li>
                    <li><a href="empcorner.php?stype=Utility Forms">Utility&nbsp;Forms</a></li>
                    <li><a href="circulars.php">Circulars&nbsp;&&nbsp;Notifications</a></li>
                </ul>
            </li>
            <li><a href="#" tabindex="-1">Others</a>
                <ul>
                    <li><a href="news.php">News&nbsp;&&nbsp;Events</a></li>
                    <li><a href="photogallery.php">Photogallery</a></li>
                    <li><a href="publications.php">Publications</a></li>
                    <li><a href="rta.php">RTI Act</a></li>
                    <li><a href="tenders.php">Tenders</a></li>
                </ul>
            </li>
          </ul>
        </li>
        </ul>
        <ul style="width:30%; float:left">
		<li>
          <a href="#">Tobacco Varities</a>
          <ul>
            <li><a href="#" tabindex="-1">FCV Tobacco</a>
                <ul>
                    <li><a href="fcvm.php">FCV(Mysore)</a></li>
                    <li><a href="fcvs.php">FCV(SLS)</a></li>
                    <li><a href="fcvn.php">FCV(NLS)</a></li>
                    <li><a href="fcvb.php">FCV(SBS)</a></li>
                </ul>
            </li>
            <li><a href="#" tabindex="-1">Non FCV Tobacco</a>
                <ul>
                    <li><a href="#" tabindex="-1">Burley</a>
                        <ul>
                            <li><a href="b_mansoon.php">Mansoon</a></li>
                            <li><a href="b_tradition.php">Traditional</a></li>
                        </ul>
                    </li>
                    <li><a href="orental.php">Oriental</a></li>
                    <li><a href="aircured.php">Air Cured</a></li>
                    <li><a href="#" tabindex="-1">Sun&nbsp;Cured</a>
                        <ul>
                            <li><a href="sc_eluru.php">Natu(Eluru)</a></li>
                            <li><a href="sc_kurnool.php">Natu(Kurnool)</a></li>
                        </ul>
                    </li>
                    <li><a href="fire_cured.php">Fire&nbsp;Cured</a></li>
                    <li><a href="beedi.php">Beedi</a></li>
                    <li><a href="#" tabindex="-1">Cigar</a>
                        <ul>
                            <li><a href="wrapper.php">Wrapper</a></li>
                            <li><a href="filter.php">Filter</a></li>

                        </ul>
                    </li>
                    <li><a href="lanka_tobacco.php">Lanka&nbsp;Tobacco</a></li>
                    <li><a href="cheroot.php">Cheroot</a></li>
                    <li><a href="#" tabindex="-1">Chewing&nbsp;Tobacco</a>
                        <ul>
                            <li><a href="red_chopadia.php">Red&nbsp;Chopadia</a></li>
                            <li><a href="ristica.php">Rustica</a></li>
                            <li><a href="chew_bihar.php">Bihar</a></li>
                            <li><a href="chew_wb.php">West&nbsp;Bengal</a></li>
                            <li><a href="chew_tn.php">Tamil&nbsp;Nadu</a></li>
                            <li><a href="chew_bc.php">Black&nbsp;Chopadia</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
          </ul>
        </li>
        </ul>
        <ul style="width:30%; float:left">
		<li>
          <a href="#">Crop Planning & Regulation</a>
          <ul>
            <li> <a href="propolicy.php">Production Policy</a></li>
            <li><a href="#" tabindex="-1">Criteria&nbsp;for&nbsp;Registration</a>
                <ul>
                    <li><a href="commnur.php">Nursary Registrations</a></li>
                    <li><a href="regdfcv.php">Grower&nbsp;and&nbsp;Barn&nbsp;Operator&nbsp;Registrations</a></li>
                    <li><a href="lfcr.php">Licence For Construction of Barn</a></li>
                </ul>
            </li>
            <li><a href="penaltyforvio.php">Penalities For Violation</a></li>
            <li><a href="welfaremeasures.php">Grower&nbsp;Welfare&nbsp;Measures</a></li>
          </ul>
        </li>
        <li>
         	<a href="#">Services To FCV Growers<span class="caret"></span></a>
            <ul>
                <li> <a href="input.php">Supply of Inputs</a></li>
                <li><a href="cropdev.php">Crop Development Activities</a></li>
                <li><a href="fcv.php">Assistance to FCV Growers</a></li>
                <li><a href="welfaresch.php">Welfare Schemes</a></li>
            </ul>
         </li>
		<li>
         	<a href="#">Auction System<span class="caret"></span></a>
            <ul>
            	<li><a href="#" tabindex="-1">Indroduction</a>
                    <ul>
                        <li><a href="auctions.php">Auction&nbsp;Performance</a></li>
                        <li><a href="eauction.php">e-Auction System</a></li>
                        <li><a href="modus.php">Modus Operandi</a></li>
                        <li><a href="flowchart.php">Flow Chart</a></li>
                    </ul>
                </li>
			
                <li><a href="#" tabindex="-1">Auction&nbsp;Platform&nbsp;Locations</a>
                    <ul>
                          <li><a href="apa.php">Andhra Pradesh</a></li>
                          <li><a href="apk1.php">Karnataka</a></li>
                          <li><a href="fap.php">Facilities&nbsp;at&nbsp;Auction&nbsp;Platforms</a></li>
                    </ul>
				</li>
                           
            </ul>
         </li>
        <li>
            <a href="#">Assistance To Exporterts<span class="caret"></span></a>
            <ul>
                <li><a href="export_per.php">Export Performance</a></li>
                <li><a href="exporters.php">Assistance to Exporters </a></li>
                <li><a href="#" tabindex="-1">Export Promotion Activities </a>
                    <ul>
                          <li><a href="indentives.php">Incentives/Benefits</a></li>
                    </ul>
                </li>
                <li><a href="#" tabindex="-1">Traders Facilitation </a>
                     <ul>
                        <li><a href="expdir.php">Directory</a></li>
                        <li><a href="registrationp.php">Registration&nbsp;Procedure</a></li>
                        <li><a href="registrationfees.php">Registration&nbsp;Fee</a></li>
                        <li><a href="downloadf13.php">Online&nbsp;Registration</a></li>
                    </ul>
               </li>
            </ul>
         </li>
		 <li>
             <a href="contactus1.php">Contact Us</a>
         </li>
      </ul></td>
                                      </tr>
                                    </table>
                                    <p>&nbsp;</p>
                                  </div>
                                <a href="javascript:window.print()" target="_blank"></a> </div></td>
                            </tr>
                          </table>
                          <p>&nbsp;</p>
					    <p style="font-size:13px;">&nbsp;</p>
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