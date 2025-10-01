<?php 
ob_start();
@session_start();
include "include/include.php";?>
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


</style>    
</head>
<body>
<?php include "tb_header.php"; ?>
<section id="content">
	<div class="zerogrid">
		<div class="row block">
			<div class="main-content col11">
			
				<div class="rslides_container">
					<ul class="rslides" id="slider" style="padding-left:0px">
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
			
			
			
			<div class="zerogrid">
		<div class="row">
		<div class="sidebar col05">
				<section style="background:#ededed; border:1px solid #ededed; border-radius:5px;">
					<div class="heading" style="background:url(images/t1.png);"><img style="padding-bottom:15px; padding-right:10px;" src="images/t2.png"><a href="registrationp.php">Traders Registration</a></div>
					<div class="heading" style="background:url(images/t1.png);"><img style="padding-bottom:15px; padding-right:10px;" src="images/t3.png"><a href="cmanufac.php">Cigarette Manufacturers</a></div>
					<div class="heading" style="background:url(images/t1.png);"><img style="padding-bottom:15px; padding-right:10px;" src="images/t4.png"><a href="aplatform.php">Auction Platforms</a></div>
					<div class="heading" style="background:url(images/t1.png);"><img style="padding-bottom:15px; padding-right:10px;" src="images/t5.png"><a href="news.php">News & Events</a></div>
					<div class="heading" style="background:url(images/t1.png);"><img style="padding-bottom:15px; padding-right:10px;" src="images/t6.png"><a href="circulars.php">Circulars & Notifications</a></div>
					<div class="heading" style="background:url(images/t1.png);"><img style="padding-bottom:15px; padding-right:10px;" src="images/t7.png"><a href="publications.php">Publications</a></div>
					
				</section>
				
			</div>
		</div>
		</div>
			
			
			
			<div class="zerogrid">
		<div class="row">
		<section class="col-1-3" style="width:69%">
				<h2 style="border-bottom:2px solid #c66f2f; margin-top:0px;">WELCOME TO TOBACCO BOARD MINISTRY OF COMMERCE & INDUSTRY, GOVT. OF INDIA</h2>
				
			</section>
			<!--<section class="col-1-3" style="width:24%">
				<h2 style="border-bottom:2px solid #c66f2f; margin-top:0px;">TWITTER</h2>
				
			</section>-->
		<section class="col-1-3" style="width:28%">
				<!--<h2 style="border-bottom:2px solid #c66f2f">WHATS NEW</h2>-->
				<div class="content">
						<img src="images/v1.jpg"/>	
					</div>
			</section>
		
		<section class="col-1-3" style="width:40%">
			<!--	<h2 style="border-bottom:2px solid #c66f2f">CIRCULARS & NOTIFICATIONS</h2>-->
				<div class="content" style="padding-top:1px; text-align:justify">
					
						<p style="font-size:13px;">Tobacco is an important commercial crop grown in India. It occupies the third position in the world with an annual production of about 800 Million Kgs. Of the different types grown, flue-cured tobacco, country tobacco, burley, bidi, rustica and chewing tobacco are considered important. India stands 3rd in production of tobacco and in exports, Brazil and USA are ahead of India.<br>
						Tobacco and tobacco products earn approx Rs.20,000 Cr. to the national exchequer by way of excise duty, and approx.Rs.5000 Cr. by way of foreign exchange every year. </p>
					</div>
					<div class="footer" style="float:right;">
						<p class="more"><a class="button" href="bactivities.php">Read more >></a></p>
					</div>
			</section>
			<section class="col-1-3" style="width:26%; margin-top:-40px;">
				<!--<h2 style="border-bottom:2px solid #c66f2f">WHATS NEW</h2>-->
				<div class="content">
						<p><a class="twitter-timeline" data-width="250" data-height="240" href="https://twitter.com/TobaccoBoard?ref_src=twsrc%5Etfw">Tweets by TobaccoBoard</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script> </script> 
                        </p>
					</div>
			</section>
		</div>
		</div>
			<div class="zerogrid">
		<div class="row">
			<section class="col-1-3" style="width:460px">
				<h2 style="border-bottom:2px solid #c66f2f; margin-top:0px;">CIRCULARS & NOTIFICATIONS</h2>
				<div class="content">
						<div class="holder">
                          <ul id="ticker01">
                          <?php 
						   if($_GET[ar]==1)
		$archive="where archive=1";
		else
		$archive="where archive=0";
                          $select=executework("select * from tob_circulars $archive order by id desc limit 0,20");
						 /// echo ("select * from tob_circulars $archive order by id desc");
		$count=@mysql_num_rows($select);
		if($count>0)
		{
		   while($row=@mysql_fetch_array($select))
		   {?>
      			  <li><a href="admin/circularfiles/<?php echo $row['tfile']; ?>"><?php echo $row['title']; ?></a><img src="images/new.gif"></li>
     <?php }  }?>
       <li> &nbsp;</li>
        
							<!--<li><a href="#">Notification for Registration of Traders and Manufacturers of Virginia Tobacco for the year 2017</a><img src="images/new.gif"></li>
							<li><a href="#">End up doing is adding some code</a><img src="images/new.gif"></li>
							<li><a href="#">The code that you want to run</a><img src="images/new.gif"></li>
							<li><a href="#">Inside of which is the code that you want to run</a></li>
							<li><a href="#">Right when the page is loaded</a></li>
							<li><a href="#">Problematically, however, the Javascript code</a><img src="images/new.gif"></li>
							<li><a href="#">The first thing that most Javascript programmers</a></li>
							<li><a href="#">End up doing is adding some code</a><img src="images/new.gif"></li>
							<li><a href="#">The code that you want to run</a></li>
							<li><a href="#">Inside of which is the code that you want to run</a></li>
							<li><a href="#">Right when the page is loaded</a><img src="images/new.gif"></li>
							<li><a href="#">Problematically, however, the Javascript code</a></li>-->
				           </ul>
                         </div>
					</div>
			</section>
			<section class="col-1-3" style="width:220px">
				<h2 style="border-bottom:2px solid #c66f2f;margin-top:0px;">WHATS NEW</h2>
				<div class="content">
						<ul>
          <?php 
		$archive="where home=1";
		$select=executework("select * from tob_news ".$archive." order by id desc limit 3");
		$count=@mysql_num_rows($select);
		while($rown=@mysql_fetch_array($select))
		{
				if($rown['tfile']!="")
				$link="admin/newsfiles/".$rown['tfile'];
				else
				$link="#";
				$fcheck=explode(".",$rown['tfile']);
	?>
          <li><a href="<?php  echo $link?>" target="<?php  if($link!="#"){?>_blank<?php  }?>">
            <?php  echo $rown[description]; if($fcheck[1]=='pdf'){?>
            &nbsp;
            <!--<img src="tob2_imgs/pdf_icon.gif" width="12" height="15" border="0" />-->
            <?php  }?>
            </a>
            <!--&nbsp;&nbsp;&nbsp;<a href="<?php  echo $link?>" target="_blank"><img src="tob2_imgs/newindow_icon.gif" border="0" /> </a>-->
          </li>
          <?php 
		}
		?>
        </ul>
					</div>
			</section>
			<section class="col-1-3" style="width:220px">
				<h2 style="border-bottom:2px solid #c66f2f;margin-top:0px;">TENDERS</h2>
				<div class="content">
						        <?php 
	$archive1="where home=1";
	$select=executework("select * from tob_tender ".$archive1." order by id desc limit 3");
	$count=@mysql_num_rows($select);
	if($count>0)
	{
?>
        <ul>
          <?php 
		while($rown=@mysql_fetch_array($select))
		{
				if($rown['mfile']!="")
				{
					$link1="../admin/tenderfiles/$rown[mfile]";
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
        <?php } ?>				</div>
			</section>
		</div>
	</div>
  
	<div class="zerogrid">
		<div class="row">
		<section class="col-1-3" style="width:220px">
				<h2 style="border-bottom:2px solid #c66f2f;margin-top:0px;">PHOTO GALLERY</h2>
				<div class="content">
				<div class="gal">
						<table border="0px">
                          <?php $sel_imgs=mysql_query(" SELECT tob_album_title . * , tob_images.image FROM tob_album_title, tob_images WHERE tob_album_title.id = tob_images.titleid GROUP BY tob_images.titleid ORDER BY tob_album_title.id DESC LIMIT 0 , 6 ");
	if(@mysql_num_rows($sel_imgs)>0)
	{	$ipi=0; 
	 ?><tr><?php 
	 while($row_imgs=mysql_fetch_array($sel_imgs))
	{ $pi++;?>
		<td width="50%"><a href="viewphotos.php?tit=<?php echo $row_imgs['id']; ?>"><img src="https://tobaccoboard.com/admin/photogallery/oimages/<?php echo $row_imgs['image']; ?>" style="width:80%; height:auto"/></a></td>		<?php  if(  ($pi%2)==0) {  ?>
					</tr>
                    <tr>
                      <?php  }
	} }  ?>		</table>
					</div>
					</div>
				
			</section>
			<section class="col-1-3" style="width:220px">
				<h2 style="border-bottom:2px solid #c66f2f;margin-top:0px;">EXPORT PERFORMANCE</h2>
				  <a href="export_per.php"> <div id="chart2" style="width:210px; height:175px;"></div></a>
			</section>
			
			<section class="col-1-3" style="width:220px">
				<h2 style="border-bottom:2px solid #c66f2f;margin-top:0px;">Fcv tobacco auction prices</h2>
				<div class="content">
						<a href="auctions1.php">
      <div id="chart3" style="width:215px; height:170px;margin-top:10px" ></div>
      </a> 
					</div>
			</section>
			<section class="col-1-3" style="width:220px">
				<h2 style="border-bottom:2px solid #c66f2f;margin-top:0px;">OTHER PROGRAMMES</h2>
				<div class="content">
						<ul class="list">
							<li><a href="http://www.tobaccoboard.in" target="_blank"><img src="images/ad1.jpg"></a></li>
							<li><a href="http://www.tobaccoboard.in" target="_blank"><img src="images/ad2.jpg"></a></li>
							<li><a href="rcmcapplication.pdf" target="_blank"><img src="images/ad3.png"></a></li>
							
						</ul>
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