<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");

include_once("functions.php");

$aar=export_per();
$sq=$aar[0];
$sv=$aar[1];

$auct=auctions1();
$st=$auct[0];
$td=$auct[1];
$prc=$auct[2];

$seldst=executework("select * from tob_gsettings where graph='Action Graph'");
$rowg=@mysqli_fetch_array($seldst);
$hmin=$rowg['min1'];
$hmax=$rowg['max1'];
$rang=$hmin.":".$hmax;

$seldnws=executework("select max(ndate) from tob_news");
$rown=@mysqli_fetch_array($seldnws);
$upd[0]=$rown[0];

$seldnws1=executework("select max(ndate) from tob_publications");
$rown1=@mysqli_fetch_array($seldnws1);
$upd[1]=$rown1[0];

$seldnws2=executework("select max(pdate) from tob_images");
$rown2=@mysqli_fetch_array($seldnws2);
$upd[2]=$rown2[0];

$seldnws3=executework("select max(tdate) from tob_tender");
$rown3=@mysqli_fetch_array($seldnws3);
$upd[3]=$rown3[0];
$tdate=max($upd);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
<TITLE>Welcome To Tobacco Board, Guntur</TITLE>
<meta name="google-site-verification" content="BJ3Y96c47O6-SVOPUgN89gtDsF7O_JoOGD_ga7rc7dA" />
<META name="description" content="To strive for the overall development of tobacco growers and the Indian Tobacco Industry. Tobacco Board is committed to accomplishing its role - the expressed will of parliament - for the smooth functioning of a vibrant farming system, fair and remunerative prices to tobacco growers and export promotion">
<META name="keywords" content="Tobacco Board,  Fuel Cured Virginia, Burley And Oriental,Suncured Country,Cigar Varieties,Chewing Tobacco, Supply Of Input, Financial Assistance,
 Soil & Water Analysis, Growers Welfare Schemes, Farm Mechanisation, Curing Of Tobacco,Yield & Quality Improvement,Transfer Of Technology, Awards To Growers ">
<META name="key-phrases" content="Fuel Cured Virginia, Burley And Oriental,Suncured Country,Cigar Varieties,Chewing Tobacco, Supply Of Input, Financial Assistance,
 Soil & Water Analysis, Growers Welfare Schemes, Farm Mechanisation, Curing Of Tobacco,Yield & Quality Improvement,Transfer Of Technology, Awards To Growers">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="bulletin-text" content="Fuel Cured Virginia, Burley And Oriental,Suncured Country,Cigar Varieties,Chewing Tobacco, Supply Of Input, Financial Assistance,
 Soil & Water Analysis, Growers Welfare Schemes, Farm Mechanisation, Curing Of Tobacco,Yield & Quality Improvement,Transfer Of Technology, Awards To Growers">
<META name="abstract" content=" Fuel Cured Virginia, Burley And Oriental,Suncured Country,Cigar Varieties,Chewing Tobacco, Supply Of Input, Financial Assistance,
 Soil & Water Analysis, Growers Welfare Schemes, Farm Mechanisation, Curing Of Tobacco,Yield & Quality Improvement,Transfer Of Technology, Awards To Growers">
<META name="robots" content="index,follow">
<META name="author" content="Tobacco Board">
<META name="copyright" content="1998-2004 Tobacco Board">
<META name="revisit-after" content="2 days">
<Meta name="category" content=" Regional - Asia - India - Andhra Pradesh - Localities - Guntur">
<META NAME="expires" CONTENT="never">
<META NAME="Charest" CONTENT="ISO-8859-1">

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<META name="distribution" content="Global">
<Meta name="organization" content="http://www.tobaccoboard.com">
<Meta name="email" content="info@tobaccoboard.com">

	
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
  
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
    
    <script>
	
	$(function(){
    $('.carousel').carousel({
      interval: 3000
    });
});
	</script>
    
    
	<script type="text/javascript" language="javascript">
			$(function() {
				
				//	Responsive layout, resizing the items
				$('#foo4').carouFredSel({
					responsive: true,
					width: '100%',
					scroll: 1,
					items: {
						width: 225,
						height:120,
						visible: {
							min: 2,
							max: 6
						}
					}
				});

			});
		</script>    
	<script type="text/javascript" language="javascript" src="js/jquery.carouFredSel-6.1.0-packed.js"></script>
    <link class="include" rel="stylesheet" type="text/css" href="graph/jquery.jqplot.min.css" />
    <link rel="stylesheet" type="text/css" href="graph/examples.min.css" />
    <link type="text/css" rel="stylesheet" href="graph/syntaxhighlighter/styles/shCoreDefault.min.css" />
    <link type="text/css" rel="stylesheet" href="graph/syntaxhighlighter/styles/shThemejqPlot.min.css" />
   <link type="text/css" rel="stylesheet" href="css/banner.css" />
   
   
   

   
   
   
   
   
<!--[if IE]><script language="javascript" type="text/javascript" src="graph/excanvas.min.js"></script><![endif]-->

</head>

<body>
<?php 
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

?>
                            <script class="" type="text/javascript">
//JQ = jQuery.noConflict();
 var categ=new Array();
 categ=Array('','FCV','Tobacco Products','Unmanufactured Tobacco');

 var sq11='<?php  echo $sq[1][1] ?>';
 var sv11='<?php  echo $sv[1][1] ?>';
 var sq21='<?php  echo $sq[1][2] ?>';
 var sv21='<?php  echo $sv[1][2] ?>';
 var sq31='<?php  echo $sq[1][3] ?>';
 var sv31='<?php  echo $sv[1][3] ?>';
 
 var sq12='<?php  echo $sq[2][1] ?>';
 var sv12='<?php  echo $sv[2][1] ?>';
 var sq22='<?php  echo $sq[2][2] ?>';
 var sv22='<?php  echo $sv[2][2] ?>';
 var sq32='<?php  echo $sq[2][3] ?>';
 var sv32='<?php  echo $sv[2][3] ?>';
 var pyr='<?php  echo $pyr ?>';
 var cyr='<?php  echo $cyr ?>';
  $(document).ready(function(){
	chngc();
	graph1();
	
  });
  function grph(chrt,y,cat,qv){
  		
		if(y==1)
		{
			var xlab=categ[cat];
			var tit="Exports For Current Year";
		}
		else
		{
			var xlab=categ[cat];
			var tit="";
		}
		if(qv=='q')
		var ylab='';
		else
		var ylab='';
		var sqv1=window['s'+qv+cat+y];
		var str1= new Array();
		str1=sqv1;
		var str=str1.split(',');
	
		var s=str;
		var smax = Math.max.apply(Math, s);
		if(smax=="")
		smax=500;
		var rem1=parseFloat(smax)/100;
		var rem2=Math.round(rem1);
		smax=(parseFloat(rem2)+1)*100;

		s1=[s[8],s[9],s[10],s[11]];
         var ticks = ['Dec', 'Jan', 'Feb', 'Mar'];

        plot2 = $.jqplot(chrt, [s1], {
            seriesDefaults: {
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true },
				markerOptions: {
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
                    rendererOptions: {
                        // Speed up the animation a little bit.
                        // This is a number of milliseconds.  
                        // Default for bar series is 3000.  
                        animation: {
                            speed: 2500
                        },
                        barWidth: 15,
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
                        }
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
                    fontSize: '8pt',
                    showMark: true
                }
                },
				yaxis: {
					min: 0,
					max: smax,
					numberTicks: 2, 
	                pointLabels: { show: true },
					label:ylab,
                    fontSize: '8pt',
					tickOptions: {
                    angle: 90,
                    showMark: true
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
	var cat='FCV';
	var val;
	var catn=categ.indexOf(cat);

  	grph('chart2',2,catn,'q');
}


function graph1()
{
	var st1='<?php  echo $st ?>';
	var td1='<?php  echo $td ?>';
	var prc1='<?php  echo $prc ?>';
	var rang1='<?php  echo $rang ?>';
	
	var st=new Array();
	var td=new Array();
	var prc=new Array();
	var tot=new Array();
	var rang=new Array();

	st=st1.split(':');
	td=td1.split(':');
	prc=prc1.split(':');
	rang=rang1.split(':');
	
	for(i=0;i<st.length;i++)
	{
		var tds=td[i].split('^');
		var prcs=prc[i].split('^');
		var tot1=new Array();
		for(j=0;j<tds.length;j++)
		{
			tot1[j]=Array(tds[j],prcs[j]);
		}
		tot[i]=tot1;
	}
			var smax = Math.max.apply(Math, prcs);
		if(smax=="")
		smax=500;
		else
		smax=parseInt(smax);

		var rem1=parseFloat(smax)/100;
		var rem2=Math.round(rem1);
		if(rem2<rem1)
		var xtr=50;
		else
		xtr=0;
		smax=(parseFloat(rem2))*100+parseInt(xtr);
		smin=rang[0];
		smax=rang[1];
  var plot1 = $.jqplot ('chart3', tot, {
      // Give the plot a title.
      title: '',
//      title: 'Domestic Auction Information (Platform Wise)',
              animate: true,
            // Will animate plot on calls to plot1.replot({resetAxes:true})
            animateReplot: true,
     // You can specify options for all axes on the plot at once with
      // the axesDefaults object.  Here, we're using a canvas renderer
      // to draw the axis label which allows rotated text.
            seriesDefaults: {
                pointLabels: { show: false },
				markerOptions: {
							show: false,             // wether to show data point markers.
							style: 'filledCircle'  // circle, diamond, square, filledCircle.
//													// filledDiamond or filledSquare.
//							lineWidth: 2,       // width of the stroke drawing the marker.
//							size: 15,            // size (diameter, edge length, etc.) of the marker.
//							color: '#666666'    // color of marker, set to color of line by default.
//							shadow: true,       // wether to draw shadow on marker or not.
//							shadowAngle: 45,    // angle of the shadow.  Clockwise from x axis.
//							shadowOffset: 1,    // offset from the line of the shadow,
//							shadowDepth: 3,     // Number of strokes to make when drawing shadow.  Each stroke
//												// offset by shadowOffset from the last.
//							shadowAlpha: 0.07   // Opacity of the shadow
						}
            },
      axesDefaults: {
                 pointLabels: { show: false },
				markerOptions: {
							show: false,             // wether to show data point markers.
							style: 'filledCircle'  // circle, diamond, square, filledCircle.
//													// filledDiamond or filledSquare.
//							lineWidth: 2,       // width of the stroke drawing the marker.
//							size: 15,            // size (diameter, edge length, etc.) of the marker.
//							color: '#666666'    // color of marker, set to color of line by default.
//							shadow: true,       // wether to draw shadow on marker or not.
//							shadowAngle: 45,    // angle of the shadow.  Clockwise from x axis.
//							shadowOffset: 1,    // offset from the line of the shadow,
//							shadowDepth: 3,     // Number of strokes to make when drawing shadow.  Each stroke
//												// offset by shadowOffset from the last.
//							shadowAlpha: 0.07   // Opacity of the shadow
						},
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
                        highlightMouseOver: true
      },
	  legend:{
	  	show:false,
		placement:"insideGrid",
		labels:st
	  },
      // An axes object holds options for all axes.
      // Allowable axes are xaxis, x2axis, yaxis, y2axis, y3axis, ...
      // Up to 9 y axes are supported.
      axes: {
        // options for each axis are specified in seperate option objects.
        xaxis: {
          label: "Date",
		  renderer: $.jqplot.DateAxisRenderer,
          // Turn off "padding".  This will allow data point to lie on the
          // edges of the grid.  Default padding is 1.2 and will keep all
          // points inside the bounds of the grid.
					tickOptions: {
                    angle: 90,
//                    fontSize: '8pt',
                    showMark: true,
					formatString:'%b %#d'
                },
          pad: 0
        },
        yaxis: {
			max: smax/1,
			min: smin/1,
//			min: hmin,
//			max: hmax,
           fontSize: '2pt',
          label: "",
		  angle: 90
        },
		highlighter: {
			show: false,
			showLabel: false,
			tooltipAxes: 'y',
			sizeAdjust: 7.5 , tooltipLocation : 'ne'
		}
      }
    });
}

function show_pop(dname)
{
	if(dname!="" && dname!='#')
	{
		window.open(dname,"DisplayWindow","resizable=no,titlebar=no,toolbar=no,scrollbars=yes,directories=no,menubar=no,width=600,height=900,left=300,top=25");
	}
}
</script>
                            <!-- End example scripts -->
                            <!-- Don't touch this! -->
<script class="include" type="text/javascript" src="graph/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="graph/syntaxhighlighter/scripts/shCore.min.js"></script>
<script type="text/javascript" src="graph/syntaxhighlighter/scripts/shBrushJScript.min.js"></script>
<script type="text/javascript" src="graph/syntaxhighlighter/scripts/shBrushXml.min.js"></script>
<script type="text/javascript" src="graph/plugins11/jqplot.dateAxisRenderer.min.js"></script>
                            <!-- Additional plugins go here -->
<script class="include" type="text/javascript" src="graph/plugins11/jqplot.barRenderer.min.js"></script>
<script class="include" type="text/javascript" src="graph/plugins11/jqplot.pieRenderer.min.js"></script>
<script class="include" type="text/javascript" src="graph/plugins11/jqplot.categoryAxisRenderer.min.js"></script>
<script class="include" type="text/javascript" src="graph/plugins11/jqplot.pointLabels.min.js"></script>

<script type="text/javascript" src="graph/plugins11/jqplot.highlighter.min.js"></script>
<script type="text/javascript" src="graph/plugins11/jqplot.cursor.min.js"></script>
<script type="text/javascript"   src="graph/plugins11/jqplot.canvasTextRenderer.min.js"></script>
<script type="text/javascript"   src="graph/plugins11/jqplot.canvasAxisLabelRenderer.min.js"></script>
<script type="text/javascript"   src="graph/plugins11/jqplot.canvasAxisTickRenderer.min.js"></script>

 <link rel="stylesheet" type="text/css" href="engine1/style.css" />
   <link rel="stylesheet" href="css/hmenustyles.css">

 
 
 
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
        <div class="topbg"></div>
		</div>
</div>
	<div class="row clearfix">
		<div class="col-md-12 column">
			<div class="logo">
                        <div class="logolft">
            <p><img src="img/logo.png" width="360" height="101"></p>
     </div>
     
           <div class="topRgtPart">
        	<!-- social link start here -->
        	<ul class="social">
            	<li><a href="http://twitter.com/tobaccoboard" title="Twitter"><img src="tob2_imgs/twitter.jpg" alt="Twitter" /></a></li>
            </ul>
            <!-- social link end here -->
            
            <!-- top link start here -->
        	<ul class="topLink">
            <li></li>
                <li><img src="tob2_imgs/about.png"><br><a href="bactivities.php" title="About">&#2361;&#2350;&#2366;&#2352;&#2375; &#2348;&#2366;&#2352;&#2375; &#2350;&#2375;&#2306;</a></li>
                <li><img src="tob2_imgs/cont.png"><br><a href="contactus1.php" title="Contact">&#2361;&#2350;&#2360;&#2375; &#2360;&#2306;&#2346;&#2352;&#2381;&#2325; &#2325;&#2352;&#2375;&#2306;</a></li>
                <li><img src="tob2_imgs/hindia.png"><br>
                <a href="../indexeng.php" title="Hindi"><span class="hnd">English</span></a></li>
            </ul>
            <!-- top link end here -->
        </div>
        </div>
	  </div>
</div>
    
    
    
	<div class="row clearfix">
		<div class="col-md-12 column">

         <div id='cssmenu'>

         

					<ul>

						<li class="active"><a href="indexeng.php">&#2361;&#2379;&#2350;</a></li>
							<li class='has-sub'><a href="#">&#2361;&#2350;&#2366;&#2352;&#2375; &#2348;&#2366;&#2352;&#2375; &#2350;&#2375;&#2306;</a>
						
                         <ul>

					  <li><a href="bactivities.php">&#2348;&#2379;&#2352;&#2381;&#2337; &#2325;&#2368; &#2327;&#2340;&#2367;&#2357;&#2367;&#2343;&#2367;&#2351;&#2377;&#2306;</a></li>

								<!--<li><a href="act.php">Board Act & Rules </a></li>-->
                                
                                 <li class='has-sub'><a href="#">&#2348;&#2379;&#2352;&#2381;&#2337; &#2309;&#2343;&#2367;&#2344;&#2367;&#2351;&#2350</a>
								<ul>
                                <!--<li><a href="tfcv.php">FCV (Traditional)</a></li>-->
                                <li><a href="act.php">&#2348;&#2379;&#2352;&#2381;&#2337; &#2309;&#2343;&#2367;&#2344;&#2367;&#2351;&#2350;</a></li>
								<li><a href="forms.php">&#2347;&#2366;&#2352;&#2381;&#2350;</a></li>
							
								<!--<li><a href="soiltypes.php">Soil types & Characterstics</a></li>-->
                                </ul>
  </li>

								<li><a href="bmembers.php">&#2348;&#2379;&#2352;&#2381;&#2337; &#2325;&#2375; &#2360;&#2342;&#2360;&#2381;&#8205;&#2351;</a></li>

                                <li><a href="orgchart.php">&#2360;&#2306;&#2327;&#2336;&#2344; &#2330;&#2366;&#2352;&#2381;&#2335;</a></li>

								<li><a href="contactus.php">&#2346;&#2381;&#2352;&#2358;&#2366;&#2360;&#2344;&#2367;&#2325; &#2325;&#2366;&#2352;&#2381;&#2351;&#2366;&#2354;&#2351;</a></li>
                                                    <li class='has-sub'><a href="#">&#2325;&#2352;&#2381;&#2350;&#2330;&#2366;&#2352;&#2368; &#2325;&#2366;&#2352;&#2381;&#2344;&#2352;</a>
								<ul>
                                <!--<li><a href="tfcv.php">FCV (Traditional)</a></li>-->
                                    <li><a href='empcorner.php?stype=Transfers And Postings'><span>&#2360;&#2381;&#8205;&#2341;&#2366;&#2344;&#2366;&#2306;&#2340;&#2352;&#2339; &#2357; &#2340;&#2376;&#2344;&#2366;&#2340;&#2367;&#2351;&#2377;&#2306; </span></a></li>
    <li><a href='empcorner.php?stype=Appointment Orders'><span>&#2344;&#2367;&#2351;&#2369;&#2325;&#2381;&#2340;&#2367; &#2310;&#2342;&#2375;&#2358;</span></a></li>
    <li><a href='empcorner.php?stype=Promotions'><span>&#2346;&#2342;&#2379;&#2344;&#2381;&#8205;&#2344;&#2340;&#2367;&#2351;&#2377;&#2306; </span></a></li>
    <li  ><a href='empcorner.php?stype=Utility Forms'><span>&#2313;&#2346;&#2351;&#2379;&#2327;&#2368; &#2347;&#2366;&#2352;&#2381;&#2350;</span></a></li>
    <li  ><a href='circulars.php'>&#2346;&#2352;&#2367;&#2346;&#2340;&#2381;&#2352; &#2357; &#2309;&#2343;&#2367;&#2360;&#2370;&#2330;&#2344;&#2366;&#2317;&#2306; </a> </li>
                                 

								<!--<li><a href="soiltypes.php">Soil types & Characterstics</a></li>-->
                                </ul>
  </li>
                                <li class='has-sub'><a href="#">&#2309;&#2344;&#2381;&#8205;&#2351;</a>
								<ul style="z-index:999999">
                                <!--<li><a href="tfcv.php">FCV (Traditional)</a></li>-->
                                <li><a href="news.php">&#2360;&#2350;&#2366;&#2330;&#2366;&#2352; &#2357; &#2328;&#2335;&#2344;&#2366;&#2317;&#2306; </a></li>
								<li><a href="photogallery.php">&#2347;&#2379;&#2335;&#2379; &#2327;&#2377;&#2354;&#2352;&#2368;</a></li>
								<li><a href="publications.php">&#2346;&#2381;&#2352;&#2325;&#2366;&#2358;&#2344;</a></li>
								 
                                  <li><a href="rta.php">&#2310;&#2352;&#2335;&#2368;&#2319; &#2309;&#2343;&#2367;&#2344;&#2367;&#2351;&#2350;</a></li>
                                  <li><a href="tenders.php">&#2344;&#2367;&#2357;&#2367;&#2342;&#2366;&#2317;&#2306; </a></li>

								<!--<li><a href="soiltypes.php">Soil types & Characterstics</a></li>-->
                                </ul>
  </li>
  </ul>
  
  
                        </li>
                        

                         <li class='has-sub'><a href="#">&#2340;&#2350;&#2381;&#8205;&#2348;&#2366;&#2325;&#2370; &#2346;&#2381;&#2352;&#2325;&#2366;&#2352;</a>
                           <ul>
                         
								<li class='has-sub'><a href="#">&#2319;&#2347; &#2360;&#2368; &#2357;&#2368; &#2340;&#2350;&#2381;&#8205;&#2348;&#2366;&#2325;&#2370;</a>
								<ul>
                                <!--<li><a href="tfcv.php">FCV (Traditional)</a></li>-->
                                <li><a href="fcvm.php">&#2319;&#2347; &#2360;&#2368; &#2357;&#2368; &#40;&#2350;&#2376;&#2360;&#2370;&#2352;&#41;</a></li>
								<li><a href="fcvs.php">&#2319;&#2347; &#2360;&#2368; &#2357;&#2368; &#40;&#2342;&#2361;&#2350;&#2367;&#41;</a></li>
								<li><a href="fcvn.php">&#2319;&#2347; &#2360;&#2368; &#2357;&#2368; &#40;&#2313;&#2361;&#2350;&#2367;&#41;</a></li>
								 <li><a href="fcvb.php">&#2319;&#2347; &#2360;&#2368; &#2357;&#2368; &#40;&#2342;&#2325;&#2366;&#2350;&#2367;&#41;</a></li>

								<!--<li><a href="soiltypes.php">Soil types & Characterstics</a></li>-->
                                </ul>
  </li>
  
						    <li class='has-sub'><a href="tfcv.php">&#2344;&#2377;&#2344; &#45; &#2319;&#2347;&#2360;&#2368;&#2357;&#2368;</a>
						      <ul>
                                

								<li class="has-sub"><a href="#">&#2348;&#2352;&#2381;&#2354;&#2368;</a>
								<ul>
								<li><a href="b_monsoon.php">&#2350;&#2366;&#2344;&#2360;&#2370;&#2344;</a></li>
								<li><a href="b_tradition.php">&#2346;&#2352;&#2306;&#2346;&#2352;&#2366;&#2327;&#2340;</a></li>
								</ul>
								</li>
								<li><a href="orental.php">&#2323;&#2352;&#2367;&#2351;&#2306;&#2335;&#2354;</a></li>
								<!--<li><a href="aircured.php">Air Cured</a></li>-->
								
								<li class="has-sub"><a href="#">&#2360;&#2344; &#2325;&#2381;&#8205;&#2351;&#2370;&#2352;&#2337;</a>
								<ul>
								<li><a href="sc_eluru.php">&#2344;&#2366;&#2335;&#2370; &#40;&#2319;&#2354;&#2369;&#2352;&#2370;&#41;</a></li>
								<li><a href="sc_kurnool.php">&#2344;&#2366;&#2335;&#2370; &#40;&#2325;&#2352;&#2381;&#2344;&#2370;&#2354;&#41;</a></li>
								</ul>
								</li>
								<li><a href="fire_cured.php">&#2347;&#2366;&#2351;&#2352; &#2325;&#2381;&#8205;&#2351;&#2370;&#2352;&#2337;</a></li>
								<li><a href="beedi.php">&#2348;&#2368;&#2337;&#2368; </a></li>
								
								<li class="has-sub"><a href="#">&#2360;&#2367;&#2327;&#2366;&#2352;</a>
								<ul>
								<li><a href="wrapper.php">&#2352;&#2376;&#2346;&#2352;</a></li>
								<li><a href="filler.php">&#2347;&#2367;&#2354;&#2381;&#8205;&#2354;&#2352;</a></li>
								</ul>
								</li>
								<li><a href="lanka_tobacco.php">&#2354;&#2306;&#2325;&#2366; &#2340;&#2350;&#2381;&#8205;&#2348;&#2366;&#2325;&#2370; </a></li>
								<li><a href="cheroot.php">&#2330;&#2369;&#2352;&#2370;&#2335;</a></li>
								
								
								<li class="has-sub"><a href="#">&#2330;&#2352;&#2381;&#2357;&#2339; &#2340;&#2350;&#2381;&#8205;&#2348;&#2366;&#2325;&#2370;</a>
								<ul>
									<li><a href="red_chopadia.php">&#2354;&#2366;&#2354; &#2330;&#2379;&#2346;&#2366;&#2337;&#2367;&#2351;&#2366;</a></li>
									<li><a href="ristica.php">&#2352;&#2360;&#2381;&#2335;&#2367;&#2325;&#2366;</a></li>
									<li><a href="chew_bihar.php">&#2348;&#2367;&#2361;&#2366;&#2352;</a></li>
									<li><a href="chew_wb.php">&#2346;&#2358;&#2381;&#2330;&#2367;&#2350; &#2348;&#2306;&#2327;&#2366;&#2354;</a></li>
									<li><a href="chew_tn.php">&#2340;&#2350;&#2367;&#2354;&#2344;&#2366;&#2337;&#2370;</a></li>
									<li><a href="chew_bc.php">&#2325;&#2366;&#2354;&#2366; &#2330;&#2379;&#2346;&#2366;&#2337;&#2367;&#2351;&#2366;</a></li>
								</ul>
								</li>
								
								
								
								<!--<li><a href="tsc.php">Cured Kentucky and Beedi</a></li>

                                <li><a href="tcigar.php">Cigar Varieties</a></li>

								<li><a href="tchewing.php">Chewing Tobacco</a></li>-->
							</ul>
                        </li>
                        </ul>
                        </li>

                      

                       

                       <li class='has-sub'><a href="fcvgrowerss.php">&#2347;&#2360;&#2354; &#2351;&#2379;&#2332;&#2344;&#2366; &#2357; &#2357;&#2367;&#2344;&#2367;&#2351;&#2350;</a>

                       		  <ul>
								<li><a href="propolicy.php">&#2313;&#2340;&#2381;&#8205;&#2346;&#2366;&#2342;&#2344; &#2344;&#2368;&#2340;&#2367;</a>
                                	 <ul>
							</ul>
                                </li>
                                <li class='has-sub'><a href="criteria.php">&#2352;&#2332;&#2367;&#2360;&#2381;&#8205;&#2335;&#2381;&#2352;&#2375;&#2358;&#2344; &#2325;&#2375; &#2354;&#2367;&#2319; &#2350;&#2366;&#2344;&#2325;</a>
                                <ul>
                                <li><a href="commnur.php">&#2344;&#2352;&#2381;&#2360;&#2352;&#2368; &#2352;&#2332;&#2367;&#2360;&#2381;&#8205;&#2335;&#2381;&#2352;&#2375;&#2358;&#2344;</a></li>
                                <li><a href="regdfcv.php">&#2327;&#2381;&#2352;&#2379;&#2351;&#2352; &#2352;&#2332;&#2367;&#2360;&#2381;&#8205;&#2335;&#2381;&#2352;&#2375;&#2358;&#2344;</a></li>
                                <li><a href="licenseasbarn.php">&#2348;&#2326;&#2366;&#2352; &#2352;&#2332;&#2367;&#2360;&#2381;&#8205;&#2335;&#2381;&#2352;&#2375;&#2358;&#2344;</a></li>
                                <li><a href="lfcr.php">&#2348;&#2326;&#2366;&#2352; &#2344;&#2367;&#2352;&#2381;&#2350;&#2366;&#2339; &#2325;&#2375; &#2354;&#2367;&#2319; &#2309;&#2344;&#2369;&#2332;&#2381;&#2334;&#2346;&#2381;&#2340;&#2367;</a></li>
                                <!--<li><a href="penaltyforvio.php">Penalties for Violation</a></li>-->
                                </ul> </li>
                                <li><a href="penaltyforvio.php">&#2313;&#2354;&#2381;&#8205;&#2354;&#2306;&#2328;&#2344; &#2325;&#2375; &#2354;&#2367;&#2319; &#2332;&#2369;&#2352;&#2381;&#2350;&#2366;&#2344;&#2366;&#2317;&#2306;</a></li> 
						     </ul>
                        </li>
						 <li class='has-sub'><a href="#" >&#2319;&#2347;&#2360;&#2368;&#2357;&#2368; &#2327;&#2381;&#2352;&#2379;&#2351;&#2352;&#2379;&#2306; &#2325;&#2375; &#2354;&#2367;&#2319; &#2360;&#2375;&#2357;&#2366;&#2317;&#2306;</a>
							<ul>

                                  <li><a href="input.php">&#2311;&#2344;&#2346;&#2369;&#2335;&#2379;&#2306; &#2325;&#2368; &#2310;&#2346;&#2370;&#2352;&#2381;&#2340;&#2367; </a></li>

                            	  <li><a href="cropdev.php">&#2347;&#2360;&#2354; &#2357;&#2367;&#2325;&#2366;&#2360; &#2327;&#2340;&#2367;&#2357;&#2367;&#2343;&#2367;&#2351;&#2377;&#2306; </a></li>
                                  
                                  <!-- <li><a href="sertofcvf.php">Transfer of Technology</a></li>-->

								   <li><a href="fcv.php">&#2319;&#2347;&#2360;&#2368;&#2357;&#2368; &#2327;&#2381;&#2352;&#2379;&#2351;&#2352; &#2325;&#2379; &#2360;&#2361;&#2366;&#2351;&#2340;&#2366; </a>	
									 <ul>
										  <li><a href="fcv.php">&#2346;&#2381;&#2352;&#2380;&#2342;&#2381;&#2351;&#2379;&#2327;&#2367;&#2325;&#2368; &#2325;&#2366; &#2361;&#2360;&#2381;&#2340;&#2366;&#2306;&#2340;&#2352;&#2339;</a></li>
                                <li><a href="initiatives.php">&#2348;&#2379;&#2352;&#2381;&#2337; &#2342;&#2381;&#2357;&#2366;&#2352;&#2366; &#2358;&#2369;&#2352;&#2370; &#2325;&#2368; &#2327;&#2312; &#2346;&#2361;&#2354;</a></li>
										 
									   </ul>
									   
								
								</li>
							     <li><a href="welfaresch.php">&#2325;&#2354;&#2381;&#8205;&#2351;&#2366;&#2339; &#2351;&#2379;&#2332;&#2344;&#2366;&#2317;&#2306; </a></li>
                                 </ul>
						</li>
                        
                        <li class='has-sub'><a href="#">&#2344;&#2368;&#2354;&#2366;&#2350; &#2346;&#2381;&#2352;&#2339;&#2366;&#2354;&#2368;</a>
                          <ul>
								<li class='has-sub'><a href="#">&#2346;&#2352;&#2367;&#2330;&#2351;</a><ul>
								<li><a href="auctions.php">&#2344;&#2368;&#2354;&#2366;&#2350; &#2344;&#2367;&#2359;&#2381;&#8205;&#2346;&#2366;&#2342;&#2344;</a></li>
                                <li><a href="eauction.php">&#2312;&#45;&#2344;&#2368;&#2354;&#2366;&#2350; &#2346;&#2381;&#2352;&#2339;&#2366;&#2354;&#2368;</a></li>
<li><a href="modus.php">&#2325;&#2366;&#2352;&#2381;&#2351;&#45; &#2346;&#2381;&#2352;&#2339;&#2366;&#2354;&#2368;</a></li>
<li><a href="flowchart.php">&#2347;&#2381;&#2354;&#2379; &#2330;&#2366;&#2352;&#2381;&#2335;</a></li>
                                </ul> </li>
 <li class='has-sub'><a href="#">&#2344;&#2368;&#2354;&#2366;&#2350; &#2346;&#2381;&#8205;&#2354;&#2376;&#2335;&#2347;&#2366;&#2352;&#2381;&#2350; &#2325;&#2366; &#2360;&#2381;&#8205;&#2341;&#2366;&#2344;</a>
 <ul><li><a href="apa.php">&#2310;&#2344;&#2381;&#8205;&#2343;&#2381;&#2352; &#2346;&#2381;&#2352;&#2342;&#2375;&#2358; </a></li>
 <li><a href="apk1.php">&#2325;&#2352;&#2381;&#2344;&#2366;&#2335;&#2325;&#2366;</a></li>
 <li><a href="fap.php">&#2344;&#2368;&#2354;&#2366;&#2350; &#2346;&#2381;&#8205;&#2354;&#2376;&#2335;&#2347;&#2366;&#2352;&#2381;&#2350;&#2379;&#2306; &#2350;&#2375;&#2306; &#2360;&#2369;&#2357;&#2367;&#2343;&#2366;&#2317;&#2306;  </a></li>
 </ul>
 </li>
    </ul></li>                            
                        <li class='has-sub'><a href="#">&#2344;&#2367;&#2352;&#2381;&#2351;&#2366;&#2340;&#2325;&#2379;&#2306; &#2325;&#2379; &#2360;&#2361;&#2366;&#2351;&#2340;&#2366;</a>
              <ul>								
								<li><a href="export_per.php">&#2344;&#2367;&#2352;&#2381;&#2351;&#2366;&#2340; &#2344;&#2367;&#2359;&#2381;&#8205;&#2346;&#2366;&#2342;&#2344;</a></li>
								<li><a href="exporters.php">&#2344;&#2367;&#2352;&#2381;&#2351;&#2366;&#2340;&#2325;&#2379;&#2306; &#2325;&#2379; &#2360;&#2361;&#2366;&#2351;&#2340;&#2366;</a></li>
                                <!--<li><a href="#">Indian Tobacco Exports </a></li>-->
                                <li class='has-sub'><a href="#">&#2344;&#2367;&#2352;&#2381;&#2351;&#2366;&#2340; &#2346;&#2381;&#2352;&#2379;&#2340;&#2381;&#8205;&#2360;&#2366;&#2361;&#2344; &#2327;&#2340;&#2367;&#2357;&#2367;&#2343;&#2367;&#2351;&#2377;&#2306;  </a>
                                <ul>
                                <li><a href="expdir.php">&#2344;&#2367;&#2342;&#2375;&#2358;&#2367;&#2325;&#2366;</a></li>
                                <li><a href="incentives.php">&#2346;&#2381;&#2352;&#2379;&#2340;&#2381;&#8205;&#2360;&#2366;&#2361;&#2344; &#47; &#2354;&#2366;&#2349;</a></li>
                                </ul>
                                <li class='has-sub'><a href="#">&#2357;&#2381;&#8205;&#2351;&#2366;&#2346;&#2366;&#2352;&#2367;&#2351;&#2379;&#2306; &#2325;&#2368; &#2360;&#2369;&#2357;&#2367;&#2343;&#2366;</a>
                                  <ul>
         <li><a href='registrationp.php'><span>&#2352;&#2332;&#2367;&#2360;&#2381;&#8205;&#2335;&#2381;&#2352;&#2375;&#2358;&#2344; &#2325;&#2368; &#2346;&#2381;&#2352;&#2325;&#2381;&#2352;&#2367;&#2351;&#2366;</span></a></li>
         <li><a href='registrationfees.php'><span>&#2352;&#2332;&#2367;&#2360;&#2381;&#8205;&#2335;&#2381;&#2352;&#2375;&#2358;&#2344; &#2358;&#2369;&#2354;&#2381;&#8205;&#2325;</span></a></li>
         <li class='last'><a href='downloadf13.php'><span>&#2321;&#2344;&#2354;&#2366;&#2312;&#2344; &#2352;&#2332;&#2367;&#2360;&#2381;&#8205;&#2335;&#2381;&#2352;&#2375;&#2358;&#2344;</span></a></li>
        <!-- <li class='last'><a href="#">Downlaod of Form 13</a></li>-->
         <!--<li class='last'><a href="cmanufac.php">Directory of Traders</a></li>-->
      </ul>
   </li>
                                 
                                </li>   
  </ul>

                        </li>
                        

                         <li><a href="contactus1.php">&#2360;&#2306;&#2346;&#2352;&#2381;&#2325; &#2325;&#2352;&#2375;&#2306;</a></li>
					</ul>

                    

                   

</div>
		</div>
</div>
    
    
    
  <?php 
  	$selatest=executework("select * from tob_latest where archive=0 order by id desc limit 8");
	$lnews='';
	while($rowlt=@mysqli_fetch_array($selatest))
	{
		if($rowlt['tfile']!="")
		{
			$tf="<a href='admin/latest/".$rowlt['tfile']."' target=_blank >";
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
		$lnews=$lnews."  |  ".$tf.$rowlt['description'].$tf1;
	}
  ?>
	<div class="row clearfix">
		<div class="col-md-12 column">
		<div class="newsscroll">
        <div><p><marquee scrollamount="3" direction="left"><?php echo $lnews ?> </marquee></p>
        <div class="search" align="right">
          <label>
          <input type="text" name="textfield" id="textfield" placeholder="Search...">
          </label>
        </div>
        </div>	
		</div>
	</div>
    
    
    
    
    
  <div class="row clearfix">
		<div class="col-md-12 column">
        <div class="spacer"></div>
		</div>
	</div>
    
    
    
	<div class=" clearfix">
		<div class="col-md-6 column">
			<div class="carousel slide" id="carousel-13626">
				<ol class="carousel-indicators">
					<li class="active" data-slide-to="0" data-target="#carousel-13626">					</li>
					<li data-slide-to="1" data-target="#carousel-13626">					</li>
					<li data-slide-to="2" data-target="#carousel-13626">					</li>
                    <li data-slide-to="3" data-target="#carousel-13626">					</li>
                    <li data-slide-to="4" data-target="#carousel-13626">					</li>
					 <li data-slide-to="3" data-target="#carousel-13626">					</li>
                    <li data-slide-to="4" data-target="#carousel-13626">					</li>
				</ol>
				<div class="carousel-inner">
					<div class="item "><img src="img/new1.jpg"></div>
          <div class="item active"><img src="img/new2.jpg"></div>
          <div class="item "><img src="img/new3.jpg"></div>
          <div class="item "><img src="img/7.jpg"></div>
        <div class="item "><img src="img/8.jpg"></div>
         <div class="item "><img src="img/9.jpg"></div>
			<div class="item "><img src="img/new4.jpg"></div>
				</div> <a class="left carousel-control" href="#carousel-13626" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#carousel-13626" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>			</div>
		</div>
	  <div class="col-md-6 column">
      <div class="abut">
      <div class="abtb" style="padding-bottom:0px; margin-bottom:0px;">मिशन: </div>
         <p align="justify" style="line-height:18px; margin:0px;">“तम्बाूकू ग्रोयरों और भारतीय तम्बाोकू उद्योग के समग्र विकास के लिए प्रयास करना।“</p>
         </div>
         <div class="abut" style="background-color:#DBEDDD; margin-top:10px;">
      <div class="abtb" style="padding-bottom:0px; margin-bottom:0px;">विजन: </div>
        <p align="justify" style="line-height:18px;">”संसद के विवेचित संकल्पि, दोलायमान कृषि व्यमवस्था् के निर्विघ्ने कार्य, तम्बा कू ग्रोयरों के लिए स्प2ष्ट7 एवं लाभकारी मूल्यि और निर्यात प्रोत्सामहन के लिए तम्बाेकू बोर्ड अपनी भूमिका निभाने के लिए वचनबद्ध है।“ </p>
       
       </div>
       </div>
       </div>
    <!--<div class="col-md-3 column">
          <div id='cssmenuvv'>
		<ul>

        	<li><a href="registrationp.php">&#2335;&#2381;&#2352;&#2375;&#2337;&#2352;&#2381;&#2360; &#2346;&#2306;&#2332;&#2368;&#2325;&#2352;&#2339;</a></li>
            <li><a href="cmanufac.php">&#2360;&#2367;&#2327;&#2352;&#2375;&#2335; &#2344;&#2367;&#2352;&#2381;&#2350;&#2366;&#2340;&#2366;</a></li>
     	   <li><a href="aplatform.php">&#2344;&#2368;&#2354;&#2366;&#2350;&#2368; &#2346;&#2381;&#2354;&#2375;&#2335;&#2347;&#2366;&#2352;&#2381;&#2350;</a></li>
           <li><a href="news.php">&#2360;&#2350;&#2366;&#2330;&#2366;&#2352; &#2319;&#2357;&#2306; &#2328;&#2335;&#2344;&#2366;&#2325;&#2381;&#2352;&#2350;</a></li>
           <li><a href="photogallery.php">&#2347;&#2379;&#2335;&#2379; &#2327;&#2375;&#2354;&#2352;&#2368;</a></li>
           <li><a href="publications.php">&#2346;&#2381;&#2352;&#2325;&#2366;&#2358;&#2344;</a></li>
           <li><a href="circulars.php">&#2346;&#2352;&#2367;&#2346;&#2340;&#2381;&#2352; &#2324;&#2352; &#2309;&#2343;&#2367;&#2360;&#2370;&#2330;&#2344;&#2366;&#2319;&#2306;</a></li>
           <li><a href="rta.php">&#2360;&#2370;&#2330;&#2344;&#2366; &#2325;&#2366; &#2309;&#2343;&#2367;&#2325;&#2366;&#2352; &#2309;&#2343;&#2367;&#2344;&#2367;&#2351;&#2350;</a></li>
            <li><a href="tenders.php">&#2344;&#2367;&#2357;&#2367;&#2342;&#2366;&#2319;&#2306;</a></li>
        </ul>
        </div>
		</div>-->
	</div>
    


   <div class="row clearfix">
	<div class="col-md-12 column"> 
    <div class="spacer"></div>
    </div>
    </div>
    
    
    
    
	<div class="clearfix">
		<div class="col-md-6 column">
        <div class="abtb">&#2340;&#2306;&#2348;&#2366;&#2325;&#2370; &#2348;&#2379;&#2352;&#2381;&#2337; &#2325;&#2375; &#2348;&#2366;&#2352;&#2375; &#2350;&#2375;&#2306; <a href="#">&#2332;&#2381;&#2351;&#2366;&#2342;&#2366; &raquo;</a></div>
        <p class="abtb1" align="justify"><img src="img/atbt.png">तम्बा कू, भारत में उगाये जाने वाले एक महत्वरपूर्ण वाणिज्यिक फसल है। यह 750 मिलियन कि.ग्रा. के वार्षिक उत्पा दन के साथ विश्वा में तीसरी स्था न पर रहा है। उगाये जाने वाले विभिन्नर प्रकारों में से फ्लू-क्यूकरड तम्बािकू, देशी तम्बारकू, बर्ली, बीडी, रस्टिका और चर्वण तम्बा कू आदि., महत्व्पूर्ण माना जाता है। भारत तम्बारकू उत्पािदन में तीसरा स्थाेन में और निर्यात में ब्रेजिल और चीन के बाद रहा है। 
<br/>

तम्बामकू और तम्बा कू उत्पांदों के लिए वर्ष 2019-20 में उत्पााद शुल्क के रूप में रू.22,737 करोड और विदेशी मुद्रा के रूप में लगभग रू.5870 करोड रूपये राष्ट्री य राजकोष को योगदान दिया है। <br/>
</p>
      </div>
		
        
        
     <div class="col-md-3 column">
         <div class="abtb">&#2319;&#2347; &#2360;&#2368; &#2357;&#2368; &#2340;&#2306;&#2348;&#2366;&#2325;&#2370; &#2325;&#2368; &#2344;&#2368;&#2354;&#2366;&#2350;&#2368; &#2325;&#2368; &#2325;&#2368;&#2350;&#2340;&#2379;&#2306;</div>
        <a href="auctions1.php">
              <div id="chart3" style="width:215px; height:170px;margin-top:10px" ></div></a>		</div>
        
        
   <div class="col-md-3 column">
           <div class="abtb">&#2344;&#2367;&#2352;&#2381;&#2351;&#2366;&#2340; &#2346;&#2381;&#2352;&#2342;&#2352;&#2381;&#2358;&#2344;</div>
           <a href="export_per.php"><div id="chart2" style="width:210px; height:175px;"></div></a>		</div>
	</div>
   
   
   
    
    
   <div class="clearfix">
   <div class="spacer"></div>
   </div>
   
   
    
    
    
	<div class="clearfix">
		<div class="col-md-4 column">
        <div class="abtb">&#2344;&#2351;&#2366; &#2325;&#2381;&#2351;&#2366; &#2361;&#2376;<a href="news.php">&#2332;&#2381;&#2351;&#2366;&#2342;&#2366; &raquo;</a></div>
        <div  class="whatsnew">
        <ul>
              <?php 
		$archive="where home=1";
		$select=executework("select * from tob_news ".$archive." order by id desc limit 3");
		$count=@mysqli_num_rows($select);
		while($rown=@mysqli_fetch_array($select))
		{
				if($rown['tfile']!="")
				$link="../admin/newsfiles/".$rown['tfile'];
				else
				$link="#";
				$fcheck=explode(".",$rown['tfile']);
	?>
        	<li><a href="<?php  echo $link?>" target="<?php  if($link!="#"){?>_blank<?php  }?>"><?php  echo $rown['hdescription']; if($fcheck[1]=='pdf'){?>&nbsp;<!--<img src="tob2_imgs/pdf_icon.gif" width="12" height="15" border="0" />-->
                      <?php  }?>
                </a><!--&nbsp;&nbsp;&nbsp;<a href="<?php  echo $link?>" target="_blank"><img src="tob2_imgs/newindow_icon.gif" border="0" /> </a>--></li>
              <?php 
		}
		?>
        </ul>
        </div>
		</div>




        
      <div class="col-md-3 column">
        <div class="abtb">&#2344;&#2367;&#2357;&#2367;&#2342;&#2366;&#2319;&#2306; <a href="tenders.php">&#2332;&#2381;&#2351;&#2366;&#2342;&#2366; &raquo;</a></div>
        <div  class="whatsnew">
<?php 
	$archive1="where home=1";
	$select=executework("select * from tob_tender ".$archive1." order by id desc limit 3");
	$count=@mysqli_num_rows($select);
	if($count>0)
	{
?>      
        <ul>
                <?php 
		while($rown=@mysqli_fetch_array($select))
		{
				if($rown['tfile']!="")
				{
					$link1="../admin/tenderfiles/".$rown['tfile'];
					$link="reg.php?pg=".$rown['tfile']."&id=".$rown['id'];
				}
				else
				$link="#";
				$fcheck=explode(".",$rown['tfile']);
	?>
        	<li><?php  if($rown['isactive']=='0') { ?>
                      <a href="#" onClick="show_pop('<?php  echo $link ?>')"><?php  echo $rown['hdescription']; if($fcheck[1]=='pdf'){?>&nbsp;
                      <?php  }  ?>
                    </a>&nbsp;&nbsp;&nbsp;<?php  } else { ?><a href="#"><?php echo $rown['hdescription']; ?></a><?php  }?></li>
          <?php 
		}
	?>
        </ul>
<?php 
	}
?>
        </div>
		</div>
        
        
        
  <div class="col-md-3 column">
        <div class="abtb">&#2340;&#2350;&#2381;&#2348;&#2366;&#2325;&#2370; &#2325;&#2367;&#2360;&#2381;&#2350;&#2379;&#2306;</div>
        <div  class="whatsnew">
            <!-- slides start here-->
                   
                   
           <div class="carousel slide" id="carousel-13627">
				<div class="carousel-inner">
					<div class="item"><img src="tvarieties/s1.jpg"></div>
                    <div class="item "><img src="tvarieties/s2.jpg"></div>
                    <div class="item  active"><img src="tvarieties/s3.jpg"></div>
				</div> 
			</div>        
                   
                   
                   
                   
                   
                    
                    <!-- slides end here-->            
        </div>
        </div>
        
        
        
        
        
        
        
        
      <div class="col-md-2 column">
        <div  class="whatsnew">

        <a href="http://tobaccoboard.in" target="_blank"><img src="img/ad1.jpg"></a><br>
<br>
<a href="http://tobaccoboard.in" target="_blank"><img src="img/ad2.jpg"></a> 
<br><br>

<a href="rcmcapplication.pdf" target="_blank"><img src="img/ad3.png"></a>
</div>
		</div>
	</div>
    
    
    
    
    
  	<div class="clearfix">
		<div class="col-md-12 column">
        <div class="spacer"></div>
		</div>
	</div>
  
    
    
    
    
            <?php 
			$selectp=executework("select * from tob_album_title,tob_images where tob_album_title.id=tob_images.titleid and tob_images.status=1 order by tob_album_title.position desc,tob_images.position desc limit 8");
			$countp=@mysqli_num_rows($selectp);
			?>
	<div class="clearfix">
		<div class="col-md-12 column">
        
        <?php /*?><div class="list_carousel responsive">
			<ul id="foo4">
                        <?php 
				  while($rowp=@mysqli_fetch_array($selectp))
				  {
				  ?>
				<li><a href="viewphoto.php?tit=<?php  echo $rowp['title'] ?>"><img src="../admin/photogallery/thimages/<?php  echo $rowp['image'] ?>" height="136" width="auto"></a></li>
                   <?php 
				  }
				  ?>    
			</ul>
			<div class="clearfix"></div>
		</div><?php */?>
		</div>
	</div>
    
    
    
  
  <div class="clearfix">
		<div class="col-md-12 column">
        <div class="foter1">
          <p align="center"><a href="index.php">&#2361;&#2379;&#2350;</a> | <a href="aboutus.php">&#2361;&#2350;&#2366;&#2352;&#2375; &#2348;&#2366;&#2352;&#2375; &#2350;&#2375;&#2306;</a> | <a href="fcvt.php">&#2319;&#2347; &#2360;&#2368; &#2357;&#2368; &#2340;&#2306;&#2348;&#2366;&#2325;&#2370;</a> | <a href="tfcv.php">&#2340;&#2306;&#2348;&#2366;&#2325;&#2370; &#2325;&#2367;&#2360;&#2381;&#2350;&#2379;&#2306;</a> | <a href="exporters.php">निर्यातकों</a> | <a href="circulars.php">&#2346;&#2352;&#2367;&#2346;&#2340;&#2381;&#2352;&#2379;&#2306;</a> | <a href="vacancies.php">&#2349;&#2352;&#2340;&#2368;</a> | <a href="empcorner.php">&#2325;&#2352;&#2381;&#2350;&#2330;&#2366;&#2352;&#2368; &#2325;&#2377;&#2352;&#2381;&#2344;&#2352;</a> | <a href="forms.php">&#2347;&#2366;&#2352;&#2381;&#2350;</a> | <a href="contactus1.php">&#2361;&#2350;&#2360;&#2375; &#2360;&#2306;&#2346;&#2352;&#2381;&#2325; &#2325;&#2352;&#2375;&#2306;</a> </p>
          <p>| <a href="copyrights.php">कॉपीराइट पॉलिसी</a> |<a href="terms.php"> नियम एवं शर्तें</a> | <a href="privacypolicy.php">गोपनीयता नीति</a> | <a href="help.php">मदद</a> | <a href="sitemap.php">साइटमैप</a> |<a href="hyper.php">हाइपरलिंक नीति </a>| <a href="feedback.php">प्रतिक्रिया </a>| <a href="brokenlink.php">टूटे हुए लिंक </a></p>
          <p align="center"><a href="http://india.gov.in" target="_blank"><img src="tob2_imgs/indiagov.jpg" border="0" class="img-responsive"  style="width:250px; height:52px" ></a></p>
        </div>
    </div>
  </div>   
 
  <div class="clearfix">
		<div class="col-md-12 column">
        <div class="foter2">
       &copy; 2014. 
       <span lang="hi">सर्वाधिकार सुरक्षित।</span></div>
        </div>
  </div>   
  
  
    
</div>
</body>
</html>

