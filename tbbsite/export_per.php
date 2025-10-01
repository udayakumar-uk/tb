<?php 
ob_start();
@session_start();
include "include/include.php";
$m=date('m');
$y=date('Y');
$selmaxy=executework("select max(year) as yr,max(month) as mn from tob_export group by year order by year desc limit 1
");
$rowy=@mysqli_fetch_array($selmaxy);
$y=$rowy['yr'];
$m=$rowy['mn'];
if($m<=3)
$yy=$y-1;
else
$yy=$y;
$cyr=$yy."-".($yy+1);
$pyr=($yy-1)."-".$yy;
$categ=array('','FCV','Tobacco Products','Unmanufactured Tobacco');
$catg=implode(',',$categ);
for($k=1;$k<=2;$k++)
{
	$mn=4;
	if($k==1)
	$y1=$yy;
	else
	$y1=$yy-1;
	for($i=1;$i<=12;$i++)
	{
		$year[$i]['m']=$mn;
		$year[$i]['y']=$y1;
		$mn++;
		if($mn>=13)
		{
			$mn=1;
			$y1=$y1+1;
		}
	}
	
	$i=0;
	for($n=1;$n<count($categ);$n++)
	{
		$qry=" and catg='".$categ[$n]."'";
		$sq[$k][$n]="";
		$sv[$k][$n]="";
		for($j=1;$j<=12;$j++)
		{
			$qty="";
			$gv="";
			
			$sel=executework("SELECT catg,month,year,ROUND(quantity,0) as Quantity,ROUND(value,0) as gval from tob_export where isactive=1 and month=".$year[$j]['m']." and year=".$year[$j]['y'].$qry);

			$row=@mysqli_fetch_array($sel);
			$gv=$row['gval'];
			$qty=$row['Quantity'];
			
			if($j==1)
			{
				$sq[$k][$n]=$qty;
				$sv[$k][$n]=$gv;
			}
			else
			{
				$sq[$k][$n]=$sq[$k][$n].",".$qty;
				$sv[$k][$n]=$sv[$k][$n].",".$gv;
			}
			
		}
	}
}

/*
$selcont=executework("select * from tob_cms where pageid=45");
$rowc=@mysqli_fetch_array($selcont);*/
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
    <link class="include" rel="stylesheet" type="text/css" href="graph/jquery.jqplot.min.css" />
    <link rel="stylesheet" type="text/css" href="graph/examples.min.css" />
    <link type="text/css" rel="stylesheet" href="graph/syntaxhighlighter/styles/shCoreDefault.min.css" />
    <link type="text/css" rel="stylesheet" href="graph/syntaxhighlighter/styles/shThemejqPlot.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script language="javascript" type="text/javascript" src="https://code.google.com/p/explorercanvas/source/browse/trunk/excanvas.js"></script>
    <script class="include" type="text/javascript" src="graph/jquery.min.js"></script>
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
    /*$(function () {
      $("#slider").responsiveSlides({
        auto: true,
        pager: true,
        nav: true,
        speed: 500,
        maxwidth: 800,
        namespace: "centered-btns"
      });
    });*/
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
	<a href="index.php" class="active">Home</a>
	<a href="#">Assistance To Exporters</a>
	<a href="#">Export Performance</a>
	
</div>
                   <!-- <p><span class="navclass"> <a href="index.php" style="color:#FFFFFF" >Home</a></span>  &nbsp; &raquo;&nbsp; 
	 	                   <span class="navclass"><a href="#" style="color:#FFFFFF"> Export Performance</a></span> 
                      </p>-->
						<!--<h2><a href="#">Sample post with, links, paragraphs and comments</a></h2>-->
						<!--<p class="info">>>> Posted by Admin - 01/01/2012 - 0 Comments</p>-->
					</div>
					<div class="content" style="padding-top:15px; text-align:justify">
                          <table width="99%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30" align="justify"><div class="rightcorner1">
          <div class="innercontent">
            <div class="rightcorner1">
              <div class="innercontent">
                <div>
                  <div>
                    <form id="graph" name="graph" method="post" action="">
                      <div> <br />
                          <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#F0F0F0" style="width:90%; margin-left:10%">
                            <tr bgcolor="#FFF0FF">
                              <td height="43">&nbsp;</td>
                              <td>&nbsp;</td>
                              <td align="center">&nbsp;</td>
                            </tr>
                            <tr bgcolor="#FFF0FF">
                              <td width="53%" height="43"><label> &nbsp;&nbsp; Category :
                                <select name="catg" id="catg" style="border: solid 1px; padding: 5px;">
                                      <option value="FCV" selected="selected">FCV</option>
                                      <option value="Tobacco Products">Tobacco Products</option>
                                      <option value="Unmanufactured Tobacco">Unmanufactured Tobacco</option>
                                    </select>
                                    <?php
					if(!empty($_POST['catg']))
					$mn1=$_POST['catg'];

					if(!empty($mn1))
					{
					?>
                                    <script type="text/javascript">
					 var mn1='<?php echo $mn1 ?>';
					 var j;
					for(j=0;j<=document.graph.catg.options.length;j++)
					{
						if(document.graph.catg.options[j].value==mn1)
						{
							document.graph.catg.options[j].selected=true;
						}
					}
					        </script>
                                    <?php
					}
				  ?>
                              </label></td>
                              <td width="14%">&nbsp;
                                  <label>
                                  <input name="tp" type="radio" value="q" checked="checked" />
                                  </label>
                                Quantity</td>
                              <td width="33%" align="center"><div align="left">
                                  <input name="tp" type="radio" value="v" />
                                Value </div></td>
                              <?php
					if(!empty($_POST['yr']))
					$yrs=$_POST['yr'];

					if(!empty($yrs))
					{
					?>
                              <script type="text/javascript">
					 var yrs='<?php echo $yrs ?>';
					 var j;
					for(j=0;j<document.graph.yr.length;j++)
					{
						if(document.graph.yr[j].value==yrs)
						{
							document.graph.yr[j].checked=true;
						}
					}
					    </script>
                              <?php
					}
				  ?>
                            </tr>
                            <tr bgcolor="#FFF0FF">
                              <td height="32" colspan="3" align="center" valign="middle"><label>
                                <?php
					if(!empty($_POST['tp']))
					$tps=$_POST['tp'];

					if(!empty($tps))
					{
					?>
                                <script type="text/javascript">
					 var tps='<?php echo $tps ?>';
					 var j;
					for(j=0;j<document.graph.tp.length;j++)
					{
						if(document.graph.tp[j].value==tps)
						{
							document.graph.tp[j].checked=true;
						}
					}
					              </script>
                                <?php
					}
				  ?>
                                <input name="grph" type="submit" id="grph" value="Submit" style="padding: 10px; background-color: #005100; color: white; border-radius: 5px;" />
                              </label></td>
                            </tr>
                            <tr bgcolor="#FFF0FF">
                              <td height="32" colspan="3" align="center" valign="middle">&nbsp;</td>
                            </tr>
                          </table>
                        <br />
                          <div class="example-content">
                            <!-- Example scripts go here -->
                            <div id="chart2" style="margin-top:20px; margin-left:40px; width:900px; height:500px;"></div>
                            <table width="700" border="0">
                              <tr>
                                <td><div align="center"></div></td>
                              </tr>
                            </table>
                            <div id="chart3" style="margin-top:20px; margin-left:40px; width:900px; height:500px;"></div>
                            <table width="700" border="0">
                              <tr>
                                <td><div align="center"></div></td>
                              </tr>
                            </table>
                            <!--<pre class="code brush:js"></pre>-->
                            <script class="" type="text/javascript">
//JQ = jQuery.noConflict();
 var categ=new Array();
 categ=Array('','FCV','Tobacco Products','Unmanufactured Tobacco');
// var sq1[1]='<?php //echo $sq[1][1] ?>';
// var sv1[1]='<?php //echo $sv[1][1] ?>';/ var sq1[2]='<?php //echo $sq[1][2] ?>';
// var sv1[2]='<?php //echo $sv[1][2] ?>';
// var sq1[3]='<?php //echo $sq[1][3] ?>';
// var sv1[3]='<?php //echo $sv[1][3] ?>';
// 
// var sq2[1]='<?php //echo $sq[2][1] ?>';
// var sv2[1]='<?php //echo $sv[2][1] ?>';
// var sq2[2]='<?php //echo $sq[2][2] ?>';
// var sv2[2]='<?php //echo $sv[2][2] ?>';
// var sq2[3]='<?php //echo $sq[2][3] ?>';
// var sv2[3]='<?php //echo $sv[2][3] ?>';

 var sq11='<?php echo $sq[1][1] ?>';
 var sv11='<?php echo $sv[1][1] ?>';
 var sq21='<?php echo $sq[1][2] ?>';
 var sv21='<?php echo $sv[1][2] ?>';
 var sq31='<?php echo $sq[1][3] ?>';
 var sv31='<?php echo $sv[1][3] ?>';
 
 var sq12='<?php echo $sq[2][1] ?>';
 var sv12='<?php echo $sv[2][1] ?>';
 var sq22='<?php echo $sq[2][2] ?>';
 var sv22='<?php echo $sv[2][2] ?>';
 var sq32='<?php echo $sq[2][3] ?>';
 var sv32='<?php echo $sv[2][3] ?>';
 var pyr='<?php echo $pyr ?>';
 var cyr='<?php echo $cyr ?>';
								
var gcat= document.getElementById("catg").value;
var gcatn=categ.indexOf(gcat);

if(gcatn==1)
var strq=sq11+","+sq12;
if(gcatn==2)
var strq=sq21+","+sq22;
if(gcatn==3)
var strq=sq31+","+sq32;
								
var arrq=strq.split(',');
								
if(gcatn==1)
var strv=sv11+","+sv12;
if(gcatn==2)
var strv=sv21+","+sv22;
if(gcatn==3)
var strv=sv31+","+sv32;
var arrv=strv.split(',');
		var smaxx = Math.max.apply(Math, arrq);
		if(smaxx=="")
		smaxx=2000;
		var rem1=parseFloat(smaxx)/1000;
		var rem2=Math.round(rem1);
//		alert(rem2.length);
		smaxx=((parseFloat(rem2)+1)*1000);

		var smaxv = Math.max.apply(Math, arrv);
		if(smaxv=="")
		smaxv=200;
		var rem1=parseFloat(smaxv)/100;
		var rem2=Math.round(rem1);
		//alert(rem2);
		smaxv=((parseFloat(rem2)+1)*100);
//alert(smaxv);

//JQ = jQuery.noConflict()
//jQuery.noConflict();
  $(document).ready(function(){
	chngc();
	
  });
  function grph(chrt,y,cat,qv){
  
		if(y==1)
		{
			var xlab=categ[cat]+'('+cyr+')';
			var tit="Exports For Current Year";
		}
		else
		{
			var xlab=categ[cat]+'('+pyr+')';
			var tit="Exports For Previous Year";
		}
		if(qv=='q')
		var ylab='Q<br>u<br>a<br>n<br>t<br>i<br>t<br>y<br> <br>I<br>n<br> <br>T<br>o<br>n<br>s';
		else
		var ylab='V<br>a<br>l<br>u<br>e<br> <br>i<br>n<br> <br>R<br>u<br>p<br>e<br>e<br>s<br>/<br>C<br>r<br>o<br>r<br>e<br>s';
		var sqv1=window['s'+qv+cat+y];
		var str1= new Array();
		str1=sqv1;

		var str=str1.split(',');
		if(qv=='q')
		{
			if(cat==2)
			var mnn=1000;
			else
			var mnn=5000;
		}
		else
		{
			if(cat==2)
			var mnn=4000;
			else
			var mnn=6000;
		}
		var s=str;
		/*var smax = Math.max.apply(Math, s);
		if(smax=="")
		smax=500;
		var rem1=parseFloat(smax)/100;
		var rem2=Math.round(rem1);
//		alert(rem2.length);
		smax=((parseFloat(rem2)+1)*100)+500;*/
	  	if(qv=='q')
		smax=smaxx;
	  	else
		smax=smaxv;
	  
		var smin = Math.min.apply(Math, s);
		var rem1=parseFloat(smin)/100;
		var rem2=Math.round(rem1);
		//alert(smin);
		smin=((parseFloat(rem2)-1)*100)-500;
		if(smin=="")
		smin=4000;
	  mnn=0;

		s1=[s[0],s[1],s[2],s[3],s[4],s[5],s[6],s[7],s[8],s[9],s[10],s[11]];
 //       var s2 = [7, 5, 3, 2];
         var ticks = ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'];
	  //alert(s1);
        
        plot2 = $.jqplot(chrt, [s1], {
            seriesDefaults: {
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true },
				markerOptions: {
//							show: true,             // wether to show data point markers.
//							style: 'filledCircle',  // circle, diamond, square, filledCircle.
//													// filledDiamond or filledSquare.
//							lineWidth: 2,       // width of the stroke drawing the marker.
							size: 15,            // size (diameter, edge length, etc.) of the marker.
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
                        barPadding: -25,
                        barMargin: 0,
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
                    ticks: ticks,
					label:xlab,
					tickOptions: {
                    angle: 0,
                    fontSize: '10pt',
                    showMark: true,
                }
                },
				yaxis: {
					min: mnn,
					max: smax,
					numberTicks: 11, 
	                pointLabels: { show: true },
					label:ylab,
					tickOptions: {
                    angle: 0,
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
    
        $('#'+chrt).bind('jqplotDataHighlight', 
            function (ev, seriesIndex, pointIndex, data) {
                $('#info2').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
            }
        );
            
        $('#'+chrt).bind('jqplotDataUnhighlight', 
            function (ev) {
                $('#info2').html('Nothing');
            }
        );
    }
function chngc()
{
	var cat=document.getElementById("catg").value;
//	var tp=document.form1.tp.checked;
	var val;
	var tp1=document.graph.tp.length;
	for(i = 0; i < tp1; i++) {
		if(document.graph.tp[i].checked) {
			val=document.graph.tp[i].value;
		}
	}

if (!Array.prototype.indexOf) {
    Array.prototype.indexOf = function (searchElement, fromIndex) {
      if ( this === undefined || this === null ) {
        throw new TypeError( '"this" is null or not defined' );
      }

      var length = this.length >>> 0; // Hack to convert object.length to a UInt32

      fromIndex = +fromIndex || 0;

      if (Math.abs(fromIndex) === Infinity) {
        fromIndex = 0;
      }

      if (fromIndex < 0) {
        fromIndex += length;
        if (fromIndex < 0) {
          fromIndex = 0;
        }
      }

      for (;fromIndex < length; fromIndex++) {
        if (this[fromIndex] === searchElement) {
          return fromIndex;
        }
      }

      return -1;
    };
  }
	var catn=categ.indexOf(cat);

  	grph('chart2',1,catn,val);
  	grph('chart3',2,catn,val);
}
                        </script>
                            <!-- End example scripts -->
                            <!-- Don't touch this! -->
                            <script class="include" type="text/javascript" src="graph/jquery.jqplot.min.js"></script>
                            <script type="text/javascript" src="graph/syntaxhighlighter/scripts/shCore.min.js"></script>
                            <script type="text/javascript" src="graph/syntaxhighlighter/scripts/shBrushJScript.min.js"></script>
                            <script type="text/javascript" src="graph/syntaxhighlighter/scripts/shBrushXml.min.js"></script>
                            <!-- Additional plugins go here -->
                            <script class="include" type="text/javascript" src="graph/jquery.jqplot.min.js"></script>
                            <script class="include" type="text/javascript" src="graph/plugins11/jqplot.barRenderer.min.js"></script>
                            <script class="include" type="text/javascript" src="graph/plugins11/jqplot.pieRenderer.min.js"></script>
                            <script class="include" type="text/javascript" src="graph/plugins11/jqplot.categoryAxisRenderer.min.js"></script>
                            <script class="include" type="text/javascript" src="graph/plugins11/jqplot.pointLabels.min.js"></script>
 <script type="text/javascript" src="graph/plugins11/jqplot.highlighter.min.js"></script>
<script type="text/javascript" src="graph/plugins11/jqplot.cursor.min.js"></script>
<script type="text/javascript"   src="graph/plugins11/jqplot.canvasTextRenderer.min.js"></script>
<script type="text/javascript"   src="graph/plugins11/jqplot.canvasAxisLabelRenderer.min.js"></script>
<script type="text/javascript"   src="graph/plugins11/jqplot.canvasAxisTickRenderer.min.js"></script>
                           <!-- End additional plugins -->
                          </div>
                        <!--	<script type="text/javascript" src="example.min.js"></script>
-->
                      </div>
                        </form>
                    </div>
                </div>
              </div>
              </div>
              </div>
          <a href="javascript:window.print()" target="_blank"></a> </div></td>
      </tr>
    </table>
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