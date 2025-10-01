<?php 
ob_start();
session_start();
header("Cache-control: private"); 
include_once("../include/includei.php");
$seldst=executework("select * from tob_gsettings where graph='Action Graph'");
$rowg=@mysqli_fetch_array($seldst);
if(empty($rowg['dstate_graph']))
$stt='Karnataka';
else
$stt=$rowg['dstate_graph'];

$m=date('m');
$y=date('Y');
$selmaxy=executework("select max(year) as yr,max(month) as mn from tob_export group by year order by year desc limit 1
");
$rowy=mysqli_fetch_array($selmaxy);
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

			$row=mysqli_fetch_array($sel);
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
//include_once("../functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<script language="javascript">
/*window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "Exports for Current Year (Quantity)"
	},	
	axisY: {
		title: "Billions of Barrels",
		titleFontColor: "#4F81BC",
		lineColor: "#4F81BC",
		labelFontColor: "#4F81BC",
		tickColor: "#4F81BC"
	},
	axisY2: {
		title: "Millions of Barrels/day",
		titleFontColor: "#C0504E",
		lineColor: "#C0504E",
		labelFontColor: "#C0504E",
		tickColor: "#C0504E"
	},	
	toolTip: {
		shared: true
	},
	legend: {
		cursor:"pointer",
		itemclick: toggleDataSeries
	},
	data: [{
		type: "column",
		name: "Proven Oil Reserves (bn)",
		legendText: "Proven Oil Reserves",
		showInLegend: true, 
		dataPoints:[
			{ label: "Saudi", y: 266.21 },
			{ label: "Venezuela", y: 302.25 },
			{ label: "Iran", y: 157.20 },
			{ label: "Iraq", y: 148.77 },
			{ label: "Kuwait", y: 101.50 },
			{ label: "UAE", y: 97.8 }
		]
	},
	{
		type: "column",	
		name: "Oil Production (million/day)",
		legendText: "Oil Production",
		axisYType: "secondary",
		showInLegend: true,
		dataPoints:[
			{ label: "Saudi", y: 10.46 },
			{ label: "Venezuela", y: 2.27 },
			{ label: "Iran", y: 3.99 },
			{ label: "Iraq", y: 4.45 },
			{ label: "Kuwait", y: 2.92 },
			{ label: "UAE", y: 3.1 }
		]
	}]
});
chart.render();

function toggleDataSeries(e) {
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else {
		e.dataSeries.visible = true;
	}
	chart.render();
}

}*/
	</script>
<head>
  
  <title>TB-DashBoard</title>
   <link class="include" rel="stylesheet" type="text/css" href="graph/jquery.jqplot.min.css" />
    <!--<link rel="stylesheet" type="text/css" href="graph/examples.min.css" />-->
    <link type="text/css" rel="stylesheet" href="graph/syntaxhighlighter/styles/shCoreDefault.min.css" />
    <link type="text/css" rel="stylesheet" href="graph/syntaxhighlighter/styles/shThemejqPlot.min.css" />
  
    <script class="include" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<!--[if IE]><script language="javascript" type="text/javascript" src="graph/excanvas.min.js"></script><![endif]-->
  <script language="javascript" type="text/javascript" src="https://code.google.com/p/explorercanvas/source/browse/trunk/excanvas.js"></script>
    <script class="include" type="text/javascript" src="graph/jquery.min.js"></script>
<script language="javascript" type="text/javascript">
//   j = jQuery.noConflict();
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
    
    <!--favicon-->
 
  <!-- Vector CSS -->
  <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
  <link href="assets/plugins/fullcalendar/css/fullcalendar.min.css" rel='stylesheet'/>
  <!-- simplebar CSS-->
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="assets/css/sidebar-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="assets/css/app-style.css" rel="stylesheet"/>
  
</head>

<body>

<!-- Start wrapper-->
 <div id="wrapper">
 
  

<!--Start topbar header-->
<header class="topbar-nav">
 <nav class="navbar navbar-expand bg-white">
 <!--<ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item">
	<h4>Performance DashBoard</h4>
      <!--<a class="nav-link toggle-menu" href="javascript:void();">
       <i class="icon-menu menu-icon"></i>
     </a>
    </li>
    
  </ul>-->
     <div class="brand-logo">
      <a href="index.html">
       <img src="assets/images/logo.png"  alt="logo icon">
       
     </a>
	 </div>
  <ul class="navbar-nav align-items-center right-nav-link">
  
  <li class="nav-item">
  
      
	  <h4 style="font-style: italic;
color:#0c6f0c;font-size:30px;"><a href="index.php">EXPORT PERFORMANCE</a></h4>
        
      
    </li>
  </ul>
</nav>
</header>
<!--End topbar header-->

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">

      <!--Start Dashboard Content-->
	  
   <div class="row mt-3">
       <div class="col-12 col-lg-6 col-xl-3">
          <a href="index.php"><div class="card border-danger border-left-sm" style="background-color:#fea406;"><!--style="background-image:linear-gradient(#17bf17, #09f9e0);}">-->
            <div class="card-body">
              <div class="media">
               <div class="media-body text-left">
                <h4 style="color:white">DASHBOARD </h4>
              </div>
               <div class="align-self-center w-circle-icon rounded-circle gradient-bloody">
                <img src="assets/images/dashboard.png" style="width: 60px;" /></div>
            </div>
            </div>
			  </div></a>
        </div>
        <div class="col-12 col-lg-6 col-xl-3">
          <a href="export_perf.php"><div class="card border-warning border-left-sm" style="background-color:#f8786b;"><!--style="background-image: linear-gradient(#0d7dea,#9ceae5);">-->
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <h5 style="color:white">EXPORT PERFORMANCE</h5>
              </div>
              <div class="align-self-center w-circle-icon rounded-circle gradient-blooker">
                <img src="assets/images/exports.png" style="width: 70px; " /></div>
            </div>
            </div>
            
          </div></a>
        </div>
        
       
        <div class="col-12 col-lg-6 col-xl-3">
          <a href="auctions.php"><div class="card border-success border-left-sm" style="background-color:#47d5ed;"><!--style="background-image: linear-gradient(#d10bf8,#09f6bc);">-->
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <h4 style="color:white">AUCTIONS</h4>
                <span style="color:white;"><?php //echo strtoupper($stt); ?></span>
              </div>
              <div class="align-self-center w-circle-icon rounded-circle gradient-quepal">
                <img src="assets/images/auctionkt.png" style="width: 60px;" /></div>
            </div>
            </div>
            
          </div></a>
        </div>

       <div class="col-12 col-lg-6 col-xl-3">
         <a href="trainings.php"> <div class="card border-info border-left-sm" style="background-color:#2bcf90;"><!--style="background-image: linear-gradient(#008cff, #008cff);"-->
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <h4 style="color:white;">Trainings</h4>
                
              </div>
              <div class="align-self-center w-circle-icon rounded-circle gradient-scooter">
                <img src="assets/images/training.png" style="width: 60px;" /></div>
            </div>
            </div>
            
          </div>
			</a>
        </div>
		
		
		
		<!--<div class="col-12 col-lg-6 col-xl-2">
          <div class="card border-warning border-left-sm" style="background-image: linear-gradient(#0d7dea,#9ceae5);">
            <div class="card-body">
              <marquee width="40%" direction="up" height="30%">
<p>This is sample scrolling text.</p>
<p>This is sample scrolling text.</p>
</marquee>
            </div>
          </div>
        </div>-->
      </div>


      
      <div class="row">
        <div class="col-lg-4" style="padding-left: 5px; padding-right: 5px;">
		
           <div class="card" >
		  
		   
		    <h6 class="text-uppercase">CURRENT YEAR(QUANTITY)</h6>
		   
              <div class="card-body" style="padding: 0.25em"> 
			 
                

                <!-- Tab panes -->
                <div class="tab-content">
                  <div id="piil-1" class="container tab-pane active" style="padding-left: 5px; padding-right: 5px;">
                     <!--<div id="chartContainer" style="height: 300px; width: 100%;"></div>
 </div>-->
					<!--<div><span>Moused Over: </span><span id="info1">Nothing</span></div>-->
    
    <div id="chart1" style="margin-top:0px; margin-left:0px; width:380px; height:300px;"></div>
<pre class="code brush:js"></pre> 
					</div>
                  
                 
                  
                </div>
				
				
              </div>
           </div>
        </div>
        
        <div class="col-lg-4" style="padding-left: 5px; padding-right: 5px;">
		
           <div class="card">
		  
		   
		    <h6 class="text-uppercase">CURRENT YEAR(QUANTITY)</h6>
		   
              <div class="card-body" style="padding: 0.25em"> 
			 
                

                <!-- Tab panes -->
                <div class="tab-content">
                  
                  <div id="piil-2" class="container tab-pane active" style="padding-left: 5px; padding-right: 5px;">
				  
				
    
    <div id="chart2" style="margin-top:0px; margin-left:0px; width:380px; height:300px;"></div>
<pre class="code brush:js"></pre>     </div>
                  
                 
                  
                </div>
				
				
              </div>
           </div>
        </div>

         <div class="col-lg-4" style="padding-left: 5px; padding-right: 5px;">
		
           <div class="card">
		  
		   
		    <h6 class="text-uppercase">CURRENT YEAR(QUANTITY)</h6>
		   
              <div class="card-body" style="padding: 0.25em"> 
			 
                

                <!-- Tab panes -->
                <div class="tab-content">

                  <div id="piil-3" class="container tab-pane active" style="padding-left: 5px; padding-right: 5px;">
				  
				
    
    <div id="chart3" style="margin-top:0px; margin-left:0px; width:380px; height:300px;"></div>
<pre class="code brush:js"></pre>     </div>
                 
                  
                </div>
				
				
              </div>
           </div>
        </div> 
		</div>     
      <div class="row">
        <div class="col-lg-4" style="padding-left: 5px; padding-right: 5px;">
		
           <div class="card" >
		  
		   
		    <h6 class="text-uppercase">CURRENT YEAR(VALUE)</h6>
		   
              <div class="card-body" style="padding: 0.25em"> 
			 
                

                <!-- Tab panes -->
                <div class="tab-content">
                  <div id="piil-4" class="container tab-pane active" style="padding-left: 5px; padding-right: 5px;">
                     <!--<div id="chartContainer" style="height: 300px; width: 100%;"></div>
 </div>-->
					<!--<div><span>Moused Over: </span><span id="info1">Nothing</span></div>-->
    
    <div id="chart4" style="margin-top:0px; margin-left:0px; width:380px; height:300px;"></div>
<pre class="code brush:js"></pre> 
					</div>
                  
                 
                  
                </div>
				
				
              </div>
           </div>
        </div>
        
        <div class="col-lg-4" style="padding-left: 5px; padding-right: 5px;">
		
           <div class="card">
		  
		   
		    <h6 class="text-uppercase">CURRENT YEAR(VALUE)</h6>
		   
              <div class="card-body" style="padding: 0.25em"> 
			 
                

                <!-- Tab panes -->
                <div class="tab-content">
                  
                  <div id="piil-5" class="container tab-pane active" style="padding-left: 5px; padding-right: 5px;">
				  
				
    
    <div id="chart5" style="margin-top:0px; margin-left:0px; width:380px; height:300px;"></div>
<pre class="code brush:js"></pre>     </div>
                  
                 
                  
                </div>
				
				
              </div>
           </div>
        </div>

         <div class="col-lg-4" style="padding-left: 5px; padding-right: 5px;">
		
           <div class="card">
		  
		   
		    <h6 class="text-uppercase">CURRENT YEAR(VALUE)</h6>
		   
              <div class="card-body" style="padding: 0.25em"> 
			 
                

                <!-- Tab panes -->
                <div class="tab-content">

                  <div id="piil-6" class="container tab-pane active" style="padding-left: 5px; padding-right: 5px;">
				  
				
    
    <div id="chart6" style="margin-top:0px; margin-left:0px; width:380px; height:300px;"></div>
<pre class="code brush:js"></pre>     </div>
                 
                  
                </div>
				
				
              </div>
           </div>
        </div> 
		</div>
       <div class="row">
        
        
        

         <div class="col-lg-2" style="padding-left: 5px; padding-right: 5px;">
		
           <a href="export_perf1.php"><div class="card">
		  
		   
		    <h6 class="text-uppercase" style="background-color: #1e4c1b">PREVIOUS YEAR</h6>
		   

           </div></a>
        </div> 
		</div> 
		  
  </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	<!--Start footer-->
	<footer class="footer">
      <div class="container-fluid">
        <div class="text-center">
         &copy; 2018 All rights reserved.
        </div>
      </div>
    </footer>
	<!--End footer-->
   
  </div><!--End wrapper-->



  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>


	<script language="javascript">

		
		
	$(document).ready(function(){
 var categ=new Array();
 categ=Array('','FCV','Tobacco Products','Unmanufactured Tobacco');
		
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

		  	//grph('chart1',1,"FCV","q");

		//alert(sq11);

function grphs(chart,sq,title,xlabel,ylabel,plot)
{
			
	
var s=sq.split(',');
var sqq = s.filter(arr => arr);

var smax = Math.max.apply(Math, s);
if(smax=="")
smax=500;
var rem1=parseFloat(smax)/1000;
var rem2=Math.round(rem1);
smax=(parseFloat(rem2)+1)*1000;
	
var smin = Math.min.apply(Math,sqq);
if(smin=="" || smin==0)
smin=1000;
var rem1=parseFloat(smin)/1000;
var rem2=Math.round(rem1);
smin=(parseFloat(rem2)-1)*1000;

	if(smin<0)
	smin=0;
	//alert(smin);
var s1=[s[0],s[1],s[2],s[3],s[4],s[5],s[6],s[7],s[8],s[9],s[10],s[11]];
		
		
        var ticks = ['Apr', 'May', 'June', 'July','Aug','Sept','Oct','Nov','Dec','Jan','Feb','Mar'];
        
        plot = $.jqplot(chart, [s1], {
            seriesDefaults: {
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true }
            },
 			//title: title,
			animate: true,
            // Will animate plot on calls to plot1.replot({resetAxes:true})
            animateReplot: true,
			axesDefaults: {
				tickRenderer: $.jqplot.CanvasAxisTickRenderer,
				tickOptions: {
				  angle: -45
				}
			},
           axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: ticks,
					label:xlabel,
					tickOptions: {
                    angle: -30,
                    fontSize: '10pt',
                    showMark: true,
                }
                },
			   
				yaxis: {
					min: smin,
					max: smax,
					numberTicks: 11, 
	                pointLabels: { show: true },
					label:ylabel,
					labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
					tickOptions: {
                    angle: -30,
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
    
        $('#'+chart).bind('jqplotDataHighlight', 
           /* function (ev, seriesIndex, pointIndex, data) {
                $('#info1').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
            }*/
        );
            
        /*$('#chart1').bind('jqplotDataUnhighlight', 
            function (ev) {
                $('#info1').html('Nothing');
            }
        );*/
		
}
		
		
function grphs1(chart,sq,title,xlabel,ylabel,plot)
{
	var s1=sq[0].split(',');
	var s2=sq[1].split(',');
	var s3=sq[2].split(',');
	var sqq1 = s1.filter(arr => arr);
	var sqq2 = s2.filter(arr => arr);
	var sqq3 = s3.filter(arr => arr);
	
	var s= Array.prototype.concat(sqq1,sqq2,sqq3);
	//alert(s);
	var sqq =s.filter(arr => arr);

var smax = Math.max.apply(Math, s);
if(smax=="")
smax=500;
var rem1=parseFloat(smax)/1000;
var rem2=Math.round(rem1);
smax=(parseFloat(rem2)+1)*1000;
	
var smin = Math.min.apply(Math,sqq);
if(smin=="" || smin==0)
smin=1000;
var rem1=parseFloat(smin)/1000;
var rem2=Math.round(rem1);
smin=(parseFloat(rem2)-1)*1000;
	//alert(smin);
var s1=[s1[0],s1[1],s1[2],s1[3],s1[4],s1[5],s1[6],s1[7],s1[8],s1[9],s1[10],s1[11]];
var s2=[s2[0],s2[1],s2[2],s2[3],s2[4],s2[5],s2[6],s2[7],s2[8],s2[9],s2[10],s2[11]];
var s3=[s3[0],s3[1],s3[2],s3[3],s3[4],s3[5],s3[6],s3[7],s3[8],s3[9],s3[10],s3[11]];
		
		
        var ticks = ['Apr', 'May', 'June', 'July','Aug','Sept','Oct','Nov','Dec','Jan','Feb','Mar'];
        
        plot = $.jqplot(chart, [s1,s2,s3], {
            seriesDefaults: {
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true }
            },
 			title: title,
			animate: true,
            // Will animate plot on calls to plot1.replot({resetAxes:true})
            animateReplot: true,
           axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: ticks,
					label:xlabel,
					tickOptions: {
                    angle: -45,
                    fontSize: '10pt',
                    showMark: true,
                }
                },
				yaxis: {
					min: smin,
					max: smax,
					numberTicks: 11, 
	                pointLabels: { show: true },
					label:ylabel,
					labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
					tickOptions: {
                    angle: -45,
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
    
        $('#'+chart).bind('jqplotDataHighlight', 
           /* function (ev, seriesIndex, pointIndex, data) {
                $('#info1').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
            }*/
        );
            
        /*$('#chart1').bind('jqplotDataUnhighlight', 
            function (ev) {
                $('#info1').html('Nothing');
            }
        );*/
		
}
		
grphs("chart1",sq11,"Exports For Current Year (Quantity)",categ[1],"Quantity in Tons","plot1");
grphs("chart2",sq21,"Exports For Current Year (Quantity)",categ[2],"Quantity in Tons","plot2");
grphs("chart3",sq31,"Exports For Current Year (Quantity)",categ[3],"Quantity in Tons","plot3");
//$('#piil-2').removeClass('active');
//$('#piil-2').addClass('fade');
//$('#piil-3').removeClass('active');
//$('#piil-3').addClass('fade');
		
grphs("chart4",sv11,"Exports For Current Year (Value)",categ[1],"Value in Rupees/Lakhs","plot4");
grphs("chart5",sv21,"Exports For Current Year (Value)",categ[2],"Value in Rupees/Lakhs","plot5");
grphs("chart6",sv31,"Exports For Current Year (Value)",categ[3],"Value in Rupees/Lakhs","plot6");
//$('#piil-5').removeClass('active');
//$('#piil-5').addClass('fade');
//$('#piil-6').removeClass('active');
//$('#piil-6').addClass('fade');
		
/*grphs("chart7",sq12,"Exports For Previous Year (Quantity)",categ[1],"Quantity in Tons","plot7");
grphs("chart8",sq22,"Exports For Previous Year (Quantity)",categ[2],"Quantity in Tons","plot8");
grphs("chart9",sq32,"Exports For Previous Year (Quantity)",categ[3],"Quantity in Tons","plot9");
$('#piil-8').removeClass('active');
$('#piil-8').addClass('fade');
$('#piil-9').removeClass('active');
$('#piil-9').addClass('fade');
		
grphs("chart10",sv12,"Exports For Previous Year (Value)",categ[1],"Value in Rupees/Lakhs","plot10");
grphs("chart11",sv22,"Exports For Previous Year (Value)",categ[2],"Value in Rupees/Lakhs","plot11");
grphs("chart12",sv32,"Exports For Previous Year (Value)",categ[3],"Value in Rupees/Lakhs","plot12");
$('#piil-11').removeClass('active');
$('#piil-11').addClass('fade');
$('#piil-12').removeClass('active');
$('#piil-12').addClass('fade');
		
var arr1= Array(sq11,sq21,sq31);
var arr2= Array(sv11,sv21,sv31);
var arr3= Array(sq12,sq22,sq32);
var arr4= Array(sv12,sv22,sv32);
		
var catg =categ[1]+"/"+categ[2]+"/"+categ[3];
grphs1("chart13",arr1,"Exports For Current Year (Quantity)",catg,"Quantity in Tons","plot13");
grphs1("chart14",arr2,"Exports For Current Year (Value)",catg,"Value in Rupees/Lakhs","plot14");
grphs1("chart15",arr3,"Exports For Previous Year (Quantity)",catg,"Quantity in Tons","plot15");
grphs1("chart16",arr4,"Exports For Previous Year (Value)",catg,"Value in Rupees/Lakhs","plot16");
*/		
		
        /*var s1 = [10, 6, 7, 10];
        var s2 = [11, 5, 3, 2];
        var s3 = [12, 4, 1, 7];
        var ticks = ['Apr', 'May', 'June', 'July','Aug','Sept','Oct','Nov','Dec','Jan','Feb','Mar'];
        
        plot2 = $.jqplot('chart3', [s1, s2, s3], {
            seriesDefaults: {
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true }
            },
 			title: "Exports For Current Year",
			animate: true,
            // Will animate plot on calls to plot1.replot({resetAxes:true})
            animateReplot: true,
           axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: ticks
                }
            }
        });
    
        $('#chart3').bind('jqplotDataHighlight', 
            function (ev, seriesIndex, pointIndex, data) {
                $('#info3').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
            }
        );
            
        $('#chart3').bind('jqplotDataUnhighlight', 
            function (ev) {
                $('#info3').html('Nothing');
            }
        );
		*/
		
		

    });
</script>	
		
			
					
  <!-- simplebar js -->
  <script src="assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- waves effect js -->
  <script src="assets/js/waves.js"></script>
  <!-- sidebar-menu js -->
  <script src="assets/js/sidebar-menu.js"></script>
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>
  
  <!-- Full Calendar -->
  <!--<script src='assets/plugins/fullcalendar/js/moment.min.js'></script>
  <script src='assets/plugins/fullcalendar/js/fullcalendar.min.js'></script>
  <script src="assets/plugins/fullcalendar/js/fullcalendar-custom-script.js"></script>
	


	  <script src="assets/plugins/Chart.js/Chart.min.js"></script>-->
  <!-- Index js -->
 <!-- <script src="assets/js/index.js"></script>-->
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
	  

	</body>

</html>  
	  
	  
      

    
  

