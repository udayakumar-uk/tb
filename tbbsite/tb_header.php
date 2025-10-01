<?php
$base_url="https://".$_SERVER['SERVER_NAME'];
function remove_tag($string,$tag)
{	
	$string=str_replace('<'.$tag.'>','',$string,$temp=1);
	$string=str_replace("<\\".$tag.'>','',$string,$temp=1);
	return $string;
}
function remove_firstp($string)
{	
	$string=str_replace('<p>','',$string);
	$string=str_replace('<\p>','',$string);
	return $string;
	// urldecode($string);
}
?>
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
	.nav > li:hover {
	background:#003300;
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
    color: #e2a27c;
    text-decoration: none;
    background-color: transparent;
	
}
.dropdown-menu > li {
border-bottom: 1px solid #999;
width:100%;
}
.dropdown-menu > li > a{
color:#fff;
display: block;
padding: 3px 20px 5px 20px;
clear: both;
font-weight: 400;
line-height: 1.42857143;
white-space: nowrap;


}
.navbar-inverse .navbar-nav > .open > a, .navbar-inverse .navbar-nav > .open > a:focus, .navbar-inverse .navbar-nav > .open > a:hover {
    color: #fff;
    background-color: transparent;
}

.dropdown-submenu {
    position: relative;
}

.dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -6px;
    margin-left: -1px;
    -webkit-border-radius: 0 6px 6px 6px;
    -moz-border-radius: 0 6px 6px;
    border-radius: 0 6px 6px 6px;
}

.dropdown-submenu:hover>.dropdown-menu {
    display: block;
}

.dropdown-submenu>a:after {
    display: block;
    content: " ";
    float: right;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid;
    border-width: 5px 0 5px 5px;
    border-left-color: #ccc;
    margin-top: 5px;
    margin-right: -10px;
}

.dropdown-submenu:hover>a:after {
    border-left-color: #fff;
}

.dropdown-submenu.pull-left {
    float: none;
}

.dropdown-submenu.pull-left>.dropdown-menu {
    left: -100%;
    margin-left: 10px;
    -webkit-border-radius: 6px 0 6px 6px;
    -moz-border-radius: 6px 0 6px 6px;
    border-radius: 6px 0 6px 6px;
}

nav{
	/*width:1040px;*/
}
nav ul li{
	padding:6px 0px 0px 0px;
}
div,p,li{
	font-size:14px !important;
}
</style>
<header> 
	<div class="zerogrid">
		<div class="row" style="background-image:url(images/tricolor.jpg);height: 138px; background-size: cover;">
			<div class="col05">
				<div id="logo" style="margin-top: 10px;"><a href="index.php"><img style="max-width:350px;" src="./images/logo1.png"/></a></div>
			</div>
			<div class="col06 offset05" style="float: right; margin-top: 20px;">
			<div style="margin-top:50px;"><img style="padding:0 8px;" src="images/home.png">|
			<a style="padding:0 10px; color:#333; font-size: 16px;" href="">हिंदी में</a>|
			<img style="padding:0 5px;" src="images/twitter1.png">
            <img style="padding:0 5px;" src="images/fb.png">
             <img style="padding:0 5px;" src="images/koo.png" style="width:25px; height:25px;">
			</div>
			  <!-- <div id='search-box'>
				  <form action='' id='search-form' method='get' target='_top'>
					<input id='search-text' name='q' placeholder='type here' type='text'/>
					<button id='search-button' type='submit'><span>Search</span></button>
				  </form>
				</div>-->
		  </div>
		</div>
	</div>
</header>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
     <!-- <a class="navbar-brand" href="#">WebSiteName</a>-->
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <?php include_once("menu.php"); ?>
    </div>
  </div>
</nav>