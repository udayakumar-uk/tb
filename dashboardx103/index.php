<?php 
ob_start();
session_start();
header("Cache-control: private"); 
include_once("../include/includei.php");

function numround($st,$n)
	{
		if(!empty($st))
		{
			$n1=pow(10 ,$n);
			$num=round($st*$n1)/($n1);
		}
		return $num;
	}
	function num_deczero($n)
	{
		$exn='';
		for($i=1;$i<=$n;$i++)
		$exn=$exn."0";
		return $exn;
	}
	function num_fround($st,$n)
	{
		$exn='';
		if($st=="")
		$st=0;
		if($st!="" && $st!=0)
		{
			$st=numround($st,$n);
			if($st=="")
			$st=0;
			$nd=numberOfDecimals($st);
			$n2=$n-$nd;
			if($nd==0)
			$num=$st.".".num_deczero($n);
			else if($n2>0)
			{
				for($i=1;$i<=$n2;$i++)
				$exn=$exn."0";
				$num=$st.num_deczero($n2);
			}
			else
			$num=$st;
		}
		else
		{
			//echo "extn=".$exn;
			$num="0.".num_deczero($n);
		}
		return $num;
	}
function numberOfDecimals($value)
{
    if ((int)$value == $value)
    {
        return 0;
    }
    else if (! is_numeric($value))
    {
        // throw new Exception('numberOfDecimals: ' . $value . ' is not a number!');
        return false;
    }

    return strlen($value) - strrpos($value, '.') - 1;
}

//////******* Trainings *********///////
$selt=executework("select count(*) as cnt,sum(tno) as total from tob_training where status=1");
$cntt=@mysqli_num_rows($selt);
$rowt=@mysqli_fetch_array($selt);
if($cntt>0)
{
	$cnt=$rowt['cnt'];
	$tot=$rowt['total'];
}
else
{
	$cnt=0;
	$tot=0;
}
$seltrs=executework("select * from tob_training where status=1 and mnth= (select distinct mnth from tob_training where status=1 and ((mnth>=".date('n')." and yr=".date('Y').") or (yr>".date('Y').")) order by yr,mnth limit 1) and yr=(select distinct yr from tob_training where status=1 and ((mnth>=".date('n')." and yr=".date('Y').") or (yr>".date('Y').")) order by yr,mnth limit 1)");
$rows=@mysqli_fetch_array($seltrs);
$seltr=executework("select * from tob_training where status=1 and mnth= (select distinct mnth from tob_training where status=1 and ((mnth>=".date('n')." and yr=".date('Y').") or (yr>".date('Y').")) order by yr,mnth limit 1) and yr=(select distinct yr from tob_training where status=1 and ((mnth>=".date('n')." and yr=".date('Y').") or (yr>".date('Y').")) order by yr,mnth limit 1)");
////////******* Trainings END ******/////

///////******** Export Performance *******///////
$catgs=array('FCV','Tobacco Products','Unmanufactured Tobacco');
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

$selcre=executework("select catg, sum(quantity) as qty, sum(value) as val from tob_export where (year='".$yy."' and month>3) or (year='".($yy+1)."' and month<=3) group by catg");
$cntcr=@mysqli_num_rows($selcre);

while($rowcr=@mysqli_fetch_array($selcre))
{
	$catg=$rowcr['catg'];
	$expcr[$catg]['qty']=$rowcr['qty'];
	$expcr[$catg]['val']=$rowcr['val'];
}

$selpre=executework("select catg, sum(quantity) as qty, sum(value) as val from tob_export where (year='".($yy-1)."' and month>3) or (year='".$yy."' and month<=3) group by catg");
$cntpr=@mysqli_num_rows($selpre);
while($rowpr=@mysqli_fetch_array($selpre))
{
	$catg=$rowpr['catg'];
	$exppr[$catg]['qty']=$rowpr['qty'];
	$exppr[$catg]['val']=$rowpr['val'];
}

for($i=0;$i<count($catgs);$i++)
{
	$catg=$catgs[$i];
	if(empty($expcr[$catg]['qty']))
	$expcr[$catg]['qty']=0;
	if(empty($expcr[$catg]['val']))
	$expcr[$catg]['val']=0;
	
	if(empty($exppr[$catg]['qty']))
	$exppr[$catg]['qty']=0;
	if(empty($exppr[$catg]['val']))
	$exppr[$catg]['val']=0;
}

///////******** Export Performance END *******///////



///////******** Auctions *******///////

$seldst=executework("select * from tob_gsettings where graph='Action Graph'");
$rowg=@mysqli_fetch_array($seldst);
//if(empty($rowg['dstate_graph']))
$stt='Andhra Pradesh';
$stt1='Karnataka';
//else
//$stt=$rowg['dstate_graph'];

$seldatd=executework("select count(distinct tdate) as cnt from tob_auction where isactive=1 and platf in(select id from tob_platform where state='".$stt."')");
$rowtd=@mysqli_fetch_array($seldatd);
if(empty($rowtd['cnt']))
$days=0;
else
$days=$rowtd['cnt'];

$seldat=executework("select tdate from tob_auction where isactive=1 and platf in(select id from tob_platform where state='".$stt."') order by tdate limit 1");
$rowdt=@mysqli_fetch_array($seldat);
$yr=substr($rowdt['tdate'],0,4);

$selsm=executework("select sum(bsold) as bsold,sum(qsold) as qsold,sum(tvalue) as tval from tob_auction where platf in(select id from tob_platform where state='".$stt."')");
$rowsm=@mysqli_fetch_array($selsm);

$mqty=$rowsm['qsold'];
$mval=$rowsm['tval'];
if($mqty>0)
$avg=num_fround(($mval/$mqty),2);
else
$avg=0;

$seldatd1=executework("select count(distinct tdate) as cnt from tob_auction where isactive=1 and platf in(select id from tob_platform where state='".$stt1."')");
$rowtd1=@mysqli_fetch_array($seldatd1);
if(empty($rowtd1['cnt']))
$days1=0;
else
$days1=$rowtd1['cnt'];

$seldat1=executework("select tdate from tob_auction where isactive=1 and platf in(select id from tob_platform where state='".$stt1."') order by tdate limit 1");
$rowdt1=@mysqli_fetch_array($seldat1);
$yr1=substr($rowdt1['tdate'],0,4);

$selsm1=executework("select sum(bsold) as bsold,sum(qsold) as qsold,sum(tvalue) as tval from tob_auction where platf in(select id from tob_platform where state='".$stt1."')");
$rowsm1=@mysqli_fetch_array($selsm1);

$mqty1=$rowsm1['qsold'];
$mval1=$rowsm1['tval'];
if($mqty1>0)
$avg1=num_fround(($mval1/$mqty1),2);
else
$avg1=0;





///////******** Auctions END *******///////



?>
<!DOCTYPE html>
<html lang="en">

<head>
  
  <title>TB-DashBoard</title>
  <!--favicon-->
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
.mySlides {display:none;}
</style> 
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
  <style type="text/css">
  body,td,th {
	font-family: Roboto, sans-serif;
}
  </style>
<meta charset="UTF-8">
</head></head>
 <link class="include" rel="stylesheet" type="text/css" href="graph/jquery.jqplot.min.css" />
    <link rel="stylesheet" type="text/css" href="graph/examples.min.css" />
    <link type="text/css" rel="stylesheet" href="graph/syntaxhighlighter/styles/shCoreDefault.min.css" />
    <link type="text/css" rel="stylesheet" href="graph/syntaxhighlighter/styles/shThemejqPlot.min.css" />
  
  <!--[if lt IE 9]> <script language="javascript" type="text/javascript" src="graph/excanvas.js"></script><![endif]-->
    <script class="include" type="text/javascript"    src="graph/jquery.min.js"></script>
<script src="jquery.ui-1.5.2/ui/ui.datepicker.js" type="text/javascript"></script>
<link href="jquery.ui-1.5.2/themes/ui.datepicker.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function toggle_forms(st,frm)
{
	document.getElementById(frm).action=st;
	document.getElementById(frm).submit();
}
function checkAll(formname, checktoggle)
{
  var checkboxes = new Array(); 
  checkboxes = document[formname].getElementsByTagName('input');
  for (var i=0; i<checkboxes.length; i++)  {
    if (checkboxes[i].type == 'checkbox')   {
      checkboxes[i].checked = checktoggle;
    }
  }
  if(checktoggle=='true')
  document[formname].submit();
}
function subform()
{
	checkAll('actn','');
//	document.getElementById("platform[]").checkedvalue="";
	document.actn.submit();
}
</script>
<body>

<!-- Start wrapper-->
 <div id="wrapper">
 
  <!--Start sidebar-wrapper-->
   <!--<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     
	 <ul class="sidebar-menu do-nicescrol">
      
        <li><a href="index.html" class="waves-effect">
          <i class="icon-home"></i> <span>Dashboard</span> 
        </a>
        
      </li>
	  
	  <li>
        <a href="javaScript:void();" class="waves-effect">
          <i class="icon-chart"></i> <span>Graphs</span>
         
        </a>
        
       </li>
      <li>
        <a href="javaScript:void();" class="waves-effect">
          <i class="icon-briefcase"></i>
          <span>Growers</span> 
        </a>
        
      </li>
      
	  
      
      <li>
        <a href="javaScript:void();" class="waves-effect">
          <i class="icon-layers"></i>
          <span>Traders</span>
         
        </a>
        
      </li>
      <li>
        <a href="javaScript:void();" class="waves-effect">
          <i class="icon-support"></i> <span>Categories</span>
         
        </a>
        
      </li>
      
      <li>
        <a href="javaScript:void();" class="waves-effect">
          <i class="icon-fire"></i> <span>schemes</span>
          
        </a>
        
      </li>
	  
       
	   
	   <li>
        <a href="javaScript:void();" class="waves-effect">
          <i class="icon-grid"></i> <span>Trainies</span>
         
        </a>
        
       </li>

      </ul>
	 
   </div>-->
   <!--End sidebar-wrapper-->

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
color:#0c6f0c;font-size:30px;">PERFORMANCE DASHBOARD</h4>
        
      
    </li>
  </ul>
</nav>
</header>
<!--End topbar header-->

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">

      <!--Start Dashboard Content-->
	  
      <!--End Row-->
		 

	<div class="row mt-3">
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
            <div class="card-body" style="background-color:#FAE4E6; height: 300px;">
              <div class="media">
              <div class="media-body text-left"> 
               <marquee direction="up" onMouseOver="this.stop();" onMouseOut="this.start();">
                <span style="color:rgba(0, 49, 103, 0.86); font-size: 13px;">FCV (Qty)  : <?php echo $expcr['FCV']['qty']; ?> Tons<br>
                FCV (Value)  : <?php echo $expcr['FCV']['val']; ?> Lakhs<br><br>
                Tobacco Products (Qty)  : <?php echo $expcr['Tobacco Products']['qty']; ?> Tons<br>
                Tobacco Products (Value)  : <?php echo $expcr['Tobacco Products']['val']; ?> Lakhs<br><br>
                Unmanufactured Tobacco (Qty)  : <?php echo $expcr['Unmanufactured Tobacco']['qty']; ?> Tons<br>
                Unmanufactured Tobacco (Value)  : <?php echo $expcr['Unmanufactured Tobacco']['val']; ?> Lakhs<br>
                </span>
                </marquee>
              </div>
              
            </div>
            </div>
          </div></a>
        </div>
        
       
        <div class="col-12 col-lg-6 col-xl-3">
          <a href="auctions2.php"><div class="card border-success border-left-sm" style="background-color:#47d5ed;"><!--style="background-image: linear-gradient(#d10bf8,#09f6bc);">-->
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <h5 style="color:white">FCV TOBACCO <br>
                E- AUCTIONS</h5>
                
              </div>
              <div class="align-self-center w-circle-icon rounded-circle gradient-quepal">
                <img src="assets/images/auctionkt.png" style="width: 60px;" /></div>
            </div>
            </div>
            <div class="card-body" style="background-color:#E0F7FB; height: 300px; border: #28a745">
              <div class="media">
              <div class="media-body text-left">
              <div class="w3-content w3-section" style="width:100%; height:100%; border:0px solid #ccc;">
                <p style="padding-top:10px; padding-left:10px; height: 100%; " class="mySlides w3-animate-zoom">
                <span style="color:rgba(0, 49, 103, 0.86); font-size: 15px;">
                <span style="font-size: 17px; font-weight: bold; font-style: oblique;">Andhra Pradesh</span><br>
				Year  : <?php echo $yr; ?> <br>
                <!--Date  :--> <?php //echo date('d/m/Y',strtotime($rowdt['tdate'])); ?> 
                Days  : <?php echo $days; ?> <br>
                Quantity  : <?php echo $mqty; ?> Kgs <br>
                Average Price  : Rs.<?php echo $avg; ?>  
                </span>
				  </p>
               <p style="padding-top:10px; padding-left:10px; height: 100%" class="mySlides w3-animate-zoom">
                <span style="color:rgba(0, 49, 103, 0.86); font-size: 15px;">
                <span style="font-size: 17px; font-weight: bold; font-style: oblique;">Karnataka</span><br>
                Year  : <?php echo $yr1; ?> <br>
                <!--Date  :--> <?php //echo date('d/m/Y',strtotime($rowdt1['tdate'])); ?> 
                Days  : <?php echo $days1; ?> <br>
                Quantity  : <?php echo $mqty1; ?> Kgs 
                Average Price  : Rs.<?php echo $avg1; ?>  
                </span>
				  </p>
				  </div>
              </div>
              
            </div>
            </div>
          </div></a>
        </div>

       <div class="col-12 col-lg-6 col-xl-3">
         <a href="trainings.php"> <div class="card border-info border-left-sm" style="background-color:#2bcf90;"><!--style="background-image: linear-gradient(#008cff, #008cff);"-->
            <div class="card-body">
              <div class="media">
              <div class="media-body text-left">
                <h4 style="color:white;">CAPCITY BUILDING</h4>
                
              </div>
              <div class="align-self-center w-circle-icon rounded-circle gradient-scooter">
                <img src="assets/images/training.png" style="width: 60px;" /></div>
            </div>
            </div>
            <div class="card-body" style="background-color:#E7F9EB; height: 300px;">
              <div class="media">
              <div class="media-body text-left">
                <span style="color:rgba(217, 45, 37, 0.84);"><!--Trainings Programmes  : <?php //echo $cnt; ?><br><br><br>
No of Trainings  :  <?php //echo $tot; ?>-->
              <div class="w3-content w3-section" style="width:100%; height:100%; border:0px solid #ccc;">
              <span style="color:rgba(0, 49, 103, 0.86); font-size: 15px;">
                <span style="font-size: 17px; font-weight: bold; font-style: oblique;">
                <?php echo strtoupper(date('F',strtotime('2019-'.$rows['mnth'].'-1')))."-".$rows['yr']; ?></span>
               <?php
				  $cnt=@mysqli_num_rows($seltr);
				  if($cnt>0)
				  {
				   while($row=@mysqli_fetch_array($seltr))
				   {
					   ?>
					   <p style="padding-top:10px; padding-left:10px; color:rgba(0, 49, 103, 0.86); font-size: 15px;" class="mySlides1 w3-animate-zoom"><?php echo urldecode($row['name']); ?></p>
					   <?php
				   }
				  }
				  else
				  {
					  ?>
					   <p style="padding-top:80px; padding-left:40px;" class="mySlides1 w3-animate-zoom">No Records Found</p>
					  <?php
				  }
				   ?>
  
               </span>
              </div>
                
 
</div>
              
            </div>
            </div>
          </div>
			</a>
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

<script class="" type="text/javascript">
$(document).ready(function(){
	//graph1();
	//graph3();
	/*if(document.actn.tp[0].checked)
	{
		graph1();
	}
	else
	{
		graph3();
	}*/
});

</script>		
<script>
var myIndex = 0;
var myIndex1 = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block"; 
	
  var y = document.getElementsByClassName("mySlides1");
  for (i = 0; i < y.length; i++) {
    y[i].style.display = "none";  
  }
  myIndex1++;
  if (myIndex1 > y.length) {myIndex1 = 1}    
  y[myIndex1-1].style.display = "block"; 
	
  setTimeout(carousel, 2500);    
}
</script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
	
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
  <script src="assets/plugins/fullcalendar/js/fullcalendar-custom-script.js"></script>-->
	


<script src="assets/plugins/Chart.js/Chart.min.js"></script>
  <!-- Index js -->
<script src="assets/js/index.js"></script>
	  

	                            <!-- Don't touch this! -->
<script class="include" type="text/javascript"   src="graph/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="graph/syntaxhighlighter/scripts/shCore.min.js"></script>
<script type="text/javascript" src="graph/syntaxhighlighter/scripts/shBrushJScript.min.js"></script>
<script type="text/javascript" src="graph/syntaxhighlighter/scripts/shBrushXml.min.js"></script>

                            <!-- Additional plugins go here -->
<script type="text/javascript" src="graph/plugins11/jqplot.dateAxisRenderer.min.js"></script>
	
<!--						<script type="text/javascript"    src="graph/plugins11/jqplot.logAxisRenderer.min.js"></script>

                            <script class="include" type="text/javascript" src="graph/plugins11/jqplot.pieRenderer.min.js"></script>
                            <script class="include" type="text/javascript" src="graph/plugins11/jqplot.pointLabels.min.js"></script>
-->							
<script type="text/javascript" src="graph/plugins11/jqplot.highlighter.min.js"></script>
<script type="text/javascript" src="graph/plugins11/jqplot.cursor.min.js"></script>
<script type="text/javascript"   src="graph/plugins11/jqplot.canvasTextRenderer.min.js"></script>
<script type="text/javascript"   src="graph/plugins11/jqplot.canvasAxisLabelRenderer.min.js"></script>
<script type="text/javascript"   src="graph/plugins11/jqplot.canvasAxisTickRenderer.min.js"></script>
<script class="include" type="text/javascript"   src="graph/plugins11/jqplot.categoryAxisRenderer.min.js"></script>
<script class="include" type="text/javascript"   src="graph/plugins11/jqplot.barRenderer.min.js"></script>
	  
	</body>

</html>  
	  
	  
      

    
  

