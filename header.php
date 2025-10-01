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

</style>    
</head>
<body>
<!--------------Header--------------->
<header> 
  <p>User page</p>
	<div class="zerogrid">
		<div class="row" style="background-image:url(images/tricolor.jpg);height: 138px;">
			<div class="col05">
				<div id="logo"><a href=""><img style="max-width:350px;" src="./images/logo1.png"/></a></div>
			</div>
			<div class="col06 offset05">
			<div style="margin-top:40px;"><img style="padding:0 10px;" src="images/home.png">|
			<a style="padding:0 10px; color:#333;" href="">हिंदी में</a>|
			<img style="padding:0 10px;" src="images/twitter1.png">
			</div>
			   <div id='search-box'>
				  <form action='' id='search-form' method='get' target='_top'>
					<input id='search-text' name='q' placeholder='type here' type='text'/>
					<button id='search-button' type='submit'><span>Search</span></button>
				  </form>
				</div>
			</div>
		</div>
	</div>
</header>

<!--------------Navigation--------------->

<nav>
	<ul>
		<li><a href="#">Home</a></li>
		<li>
		<div class="dropdown">
  <a class="dropbtn">About Us</a>
  <div class="dropdown-content">
    <a href="#">Board Activities</a>
    <a href="#">Board Act & Rules</a>
    <a href="#">Board Members</a>
	<a href="#">Organization Chart</a>
    <a href="#">Field Offices</a>
 
	
  </div>
</div>
		</li>
		<li>
		<div class="dropdown">
  <a class="dropbtn">Tobacco Varieties</a>
  <div class="dropdown-content">
    <a href="#">Flue Cured Virginia(FCV)</a>
    <a href="#">Burely and Oriental</a>
    <a href="#">Cured Kentucky and Beedi</a>
	<a href="#">Cigar Varieties</a>
    <a href="#">Chewing Tobacco</a>
   
	
  </div>
</div>
		</li>
		<li>
		<div class="dropdown">
  <a class="dropbtn">FCV Tobacco</a>
  <div class="dropdown-content">
    <a href="#">FCV (Traditional)</a>
    <a href="#">FCV (NLS)</a>
    <a href="#">FCV (SLS)</a>
	<a href="#">FCV (Mysore)</a>
    <a href="#">Soil Types&Characterstics</a>
    
	
  </div>
</div>
		</li>
		<li><a href="#">E-Auctions</a></li>
		<li><a href="#">Export Performance</a></li>
		<li><a href="#">Services for FCV Growers</a></li>
		
		<li>
		<div class="dropdown">
  <a class="dropbtn">Exporters</a>
  <div class="dropdown-content">
    <a href="#">Directory</a>
    <a href="#">Assistance to Exporters</a>
  
  </div>
</div>
		</li>
		<li><a href="#">Contact</a></li>
	</ul>
</nav>

			

</body></html>