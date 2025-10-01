<?php 
ob_start();
session_start();
header("Cache-control: private"); 
include_once("../include/includei.php");

//include_once("../functions.php");
$qry=''; $qry1='';
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

$seldst=executework("select * from tob_gsettings where graph='Action Graph'");
$rowg=@mysqli_fetch_array($seldst);
if(empty($rowg['dstate_graph']))
$stt='Karnataka';
else
$stt=$rowg['dstate_graph'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
  
  <title>TB-DashBoard</title>
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
  <style type="text/css">
  .style36 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
  </style>
</head>
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
color:#0c6f0c;font-size:30px;"><a href="index.php">PERFORMANCE DASHBOARD</a></h4>
        
      
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
        <div class="col-lg-12">
		
           <div class="card">
		  
		   
		    <h6 class="text-uppercase">SCHEDULED TRAINING PROGRAMMES</h6>
		   
              <div class="card-body"> 
			 
                

                <!-- Tab panes -->
                <div class="tab-content">
                  <div id="piil-1" class="container tab-pane active">
                     
                  <div class="card">
            <!--<div class="card-header"><i class="fa fa-table"></i> Data Table Example</div>-->
            <?php
				$sel3=executework("select * from tob_training where status=1");
				$cntt=@mysqli_num_rows($sel3);
			  ?>
              <div class="table-responsive">
              <table id="" class="table table-bordered" style="width: 100%">
                <thead>
                    <tr style="color:#008cff;">
                        <th>Name of the <br>Training<br> Programme</th>
                        <th>No. Of <br>Trainings</th>
                        <th>Training <br>Schedule</th>
                    </tr>
                </thead>
                <tbody>
 <?php
							while($row1=@mysqli_fetch_array($sel3))
							{
							?>
							  <tr>
                                <td bgcolor="#FFFFFF" style="width: 40%; max-width: 40%"><span class="style38" style="text-align: left"><?php echo urldecode($row1['name']); ?></span></td>
								<td bgcolor="#FFFFFF"><div align="center"><span class="style38"><?php echo $row1['tno'] ?></span></div></td>
								<td bgcolor="#FFFFFF" style="width: 40%"><div align="left"><span class="style38"><?php echo urldecode($row1['schedule']); ?></span></div></td>
                              </tr>
							  <?php
							
							}
							 ?>
                   
                    
                    
                </tbody>
                
				
            </table>
            </div>
            
          </div>
                      </div>
			    
				
                <div id="piil-2" class="container tab-pane fade">
				  
				
                     </div>
                 
                  
             </div>
				<br>
				
				<!--<ul class="nav nav-pills" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" href="#piil-1"> <span class="hidden-xs">Graph</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#piil-2"><span class="hidden-xs">Table</span></a>
                  </li>
                
                  
                </ul>-->
				
          </div>
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
	  

</body>

</html>  
	  
	  
      

    
  

