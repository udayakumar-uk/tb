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
    <a href="#">Copyrights</a></div>
                  <!--<p><span class="navclass"> <a href="index.php" style="color:#FFFFFF" >Home</a></span>  &nbsp; &raquo;&nbsp; 
	 	                   <span class="navclass"><a href="#" style="color:#FFFFFF"> Exports</a></span>  &nbsp; &raquo;&nbsp; 
                           <span class="navclass"><a href="#" style="color:#FFFFFF"> Assistance to Exporters </a></span>
                      </p>-->
						<!--<h2><a href="#">Sample post with, links, paragraphs and comments</a></h2>-->
						<!--<p class="info">>>> Posted by Admin - 01/01/2012 - 0 Comments</p>-->
					</div>
					<div class="content" style="padding-top:15px; text-align:justify">
                          <!--<?php echo $rowc['content'] ?>-->
						<p style="font-size:13px;">&ldquo;Material on this site is subject to copyright  protection unless otherwise indicated. The material may be downloaded without  requiring specific prior permission. Any other proposed use of the material is  subject to the approval of Tobacco Board. Application for  obtaining permission should be made to info@tobaccoboard.co.in.&rdquo; </p>
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

</body>
</html>