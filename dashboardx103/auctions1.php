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

$stat="Andhra Pradesh";

if(!empty($_POST['platform']))
{
	$plats=implode('^',$_REQUEST['platform']);
	$plats1=implode(',',$_REQUEST['platform']);
}
if(!empty($plats))
{
	$qry=" and id in (".$plats1.")";
}

//$seldat=executework("select tob_auction.tdate from tob_platform,tob_auction where tob_platform.id=tob_auction.platf and tob_platform.id=".$row['id']." and tob_auction.year=".$yr." order by tob_auction.tdate");
	$seldat1=executework("select tdate from tob_auction where isactive=1 and platf in(select id from tob_platform where state='".$stat."')".$qry." order by tdate limit 1");
	$rowdt1=@mysqli_fetch_array($seldat1);

if(!empty($_POST['pdate']))
{
	$qdate=datepattrn1($_POST['pdate']);
	$qdate1=$_POST['pdate'];
	$yr=substr($qdate,0,4);
}
else
{
	$yr=date('Y');
	$seldat=executework("select tdate from tob_auction where isactive=1".$qry." order by tdate desc limit 1");
	$rowdt=@mysqli_fetch_array($seldat);
	$qdate1=datepattrn($rowdt['tdate']);
}
$yr=substr($rowdt1['tdate'],0,4);
if(!empty($qdate))
{
	$qry1=" and tob_auction.tdate<='".$qdate."'";
}

$selplat1=executework("select * from tob_platform where state='".$stat."' and isactive=1 order by platform");
$cntp1=@mysqli_num_rows($selplat1);
$u=0;
while($row1=@mysqli_fetch_array($selplat1))
{
	$plat1[$u]=array($row1['id'],$row1['platform']);
	$u++;
}
$selplat=executework("select * from tob_platform where state='".$stat."' and isactive=1".$qry." order by platform");
$cntp=@mysqli_num_rows($selplat);
$t=0;
$str="";

if(!empty($_POST['pdate']))
{
	$qdate2=datepattrn1($_POST['pdate']);
	
}
else
{
	$qdate2=date('Y-m-d');
	
}

$tqty="";
$tval="";
//$dt=" and cdate!='0000-00-00' and aprice>0";
$dt=" and (tob_auct.cdate!='0000-00-00' OR tob_auct.cdate!='') and tob_auction.aprice>0";
$dt1=" and (tob_auct.cdate!='0000-00-00' OR tob_auct.cdate!='') and tob_auction.cprice>0";

while($row=@mysqli_fetch_array($selplat))
{
	$plat[$t]=array($row['id'],$row['platform']);
		$selqdat=executework("select tdate,aprice,cprice,qsold from tob_platform,tob_auct,tob_auction where tob_platform.id=tob_auction.platf and tob_auct.platf=tob_auction.platf and tob_auct.year=tob_auction.year and tob_platform.id=".$row['id'].$qry1.$dt." order by tob_auction.tdate desc");
		//echo "<br>select tdate,aprice,cprice,qsold from tob_platform,tob_auct,tob_auction where tob_platform.id=tob_auction.platf and tob_auct.platf=tob_auction.platf and tob_auct.year=tob_auction.year and tob_platform.id=".$row['id'].$qry1.$dt." order by tob_auction.tdate desc";
//	$selqdat=executework("select tdate,aprice,qsold from tob_platform,tob_auction where tob_platform.id=tob_auction.platf and tob_platform.id=".$row['id']." and tob_auction.year=".$yr.$qry1.$dt." order by tob_auction.tdate");
	$cntd=@mysqli_num_rows($selqdat);
	if($cntd>0)
	{
		$days=$cntd;
		$k=0;
		$str1="";
		$st1="";
		$st2="";
		$st3="";
		$qty=0;
		$vald=0;
		while($rowqd=@mysqli_fetch_array($selqdat))
		{
			if($rowqd['aprice']>0)
			{
				$dates[$t]['d'][$k]=$rowqd['tdate'];
				$dates[$t]['v'][$k]=round($rowqd['aprice']);
				if($st1=="")
				$st1=$rowqd['tdate'];
				else
				$st1=$st1."^".$rowqd['tdate'];
	
				if($st2=="")
				$st2=round($rowqd['aprice']);
				else
				$st2=$st2."^".round($rowqd['aprice']);
				
				if($st3=="")
				$st3=round($rowqd['cprice']);
				else
				$st3=$st3."^".round($rowqd['cprice']);
				
				
				$qty=$qty+$rowqd['qsold'];
				$vald=$vald+($rowqd['qsold']*$rowqd['aprice']);
				$k++;
			}
		}
		if($tqty=="")
		$tqty=$qty;
		else
		$tqty=$tqty.":".$qty;
		
		if($qty>0)
		$val=$vald/$qty;
		else
		$val=0;
		
		if($tval=="")
		$tval=round($val);
		else
		$tval=$tval.":".round($val);

		if($str=="")
		$str=$row['platform']."*".$st1."*".$st2."*".$st3;
		else
		$str=$str."~".$row['platform']."*".$st1."*".$st2."*".$st3;
		
		if(empty($st))
		$st=$row['platform'];
		else
		$st=$st.":".$row['platform'];
		
		if(empty($td))
		$td=$st1;
		else
		$td=$td.":".$st1;
		
		if(empty($prc))
		$prc=$st2;
		else
		$prc=$prc.":".$st2;

		if(empty($aprc))
		$aprc=$st3;
		else
		$aprc=$aprc.":".$st3;
	}
	$t++;
}

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
color:#0c6f0c;font-size:30px;"><a href="index.php">E-AUCTIONS-ANDHRAPRADESH</a></h4>
        
      
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
		  
		   
		    <h6 class="text-uppercase">FCV TOBACCO AUCTIONS DAY INFORMATION</h6>
		   
              <div class="card-body"> 
			 
                

                <!-- Tab panes -->
                <div class="tab-content">
                  <div id="piil-1" class="container tab-pane active">
                     <form id="actn" name="actn" method="post" action="">
                      <div> 
                          <div class="example-content">
                            
							<table border="0">
                              <tr>
                                <td style="vertical-align: top"><div align="center"><!-- Example scripts go here -->
                            <div id="chart2" style="margin-top:20px; margin-left:20px; width:900px; height:500px;" align="center"></div></div></td>
                                <td valign="top"><div align="center">
                                  <table width="180" border="0" cellpadding="2" cellspacing="2" bgcolor="#FFF0FF" style="font-size: 12px;">
                                        <?php
									for($i=0;$i<count($plat1);$i++)
									{
										$chkk="";
										if(isset($_POST['platform']))
										{
											if(in_array($plat1[$i][0],$_POST['platform']))
											{
												$chkk="checked=true";
											}
											else
											{
												$chkk="";
											}
										}
										else
										$chkk="checked=true";
									?>
                                    <tr bgcolor="#FFFFFF">
                                      <td bgcolor="#FFF0FF"><label style="margin-bottom: 0px;"><input name="platform[]" type="checkbox" value="<?php echo $plat1[$i][0] ?>" <?php echo $chkk ?> id="platform[]" onchange="actn.submit();" />
                                        &nbsp;&nbsp;<?php echo $plat1[$i][1] ?></label></td>
                                    </tr>
                                        <!--<option value="<?php //echo $plat1[$i][0] ?>"><?php //echo $plat1[$i][1] ?></option>-->
                                        <?php
									}
									?>
                                    <tr bgcolor="#FFFFFF">
                                      <td bgcolor="#FFF0FF" class="style38"><div align="center"><a style="cursor:pointer" onclick="checkAll('actn', 'true');"><strong>Check All</strong></a></div></td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF">
                                      <td bgcolor="#FFF0FF" class="style38"><div align="center"><strong><a style="cursor:pointer" onclick="checkAll('actn','');">Uncheck All</a></strong></div></td>
                                    </tr>
                                  </table>
                                </div></td>
                              </tr>
                            </table>
                            <table width="700" border="0">
                              <tr>
                                <td><div align="center"></div></td>
                              </tr>
                            </table>
                            <!--<pre class="code brush:js"></pre>-->
                                                   </script>
                            <!-- End example scripts -->
                      </div>
                        </form> </div>
			    </div>
				
                <div id="piil-2" class="container tab-pane fade">
				  
				<div class="row">
        
          <div class="card">
            <!--<div class="card-header"><i class="fa fa-table"></i> Data Table Example</div>-->
            <?php
							$sel3=executework("select * from tob_grade where pdate<='".$qdate2."' and state='".$stat."' order by pdate desc limit 1");
							$rowaa=@mysqli_fetch_array($sel3);
								$adate=$rowaa['pdate'];
			  ?>
              <div class="table-responsive" style=" height: 500px; overflow: scroll;">
              <table id="" class="table table-bordered" style="font-size: 12px;">
                <thead>
                    <tr style="color:#008cff;">
                      <th colspan="6"><?php echo $yr; ?> Year Auctions - Sales Report</th>
                      </tr>
                    <tr style="color:#008cff;">
                      <th colspan="2">Start Auction Year : <?php echo $yr ?></th>
                      <th colspan="2">Day : <?php echo $days ?></th>
                      <th colspan="2">Auction&nbsp;Date : <?php echo datepattrn($adate) ?></th>
                      </tr>
                    <tr style="color:#008cff;">
                        <th>Name of the <br>Auction<br> Platform</th>
                        <th>Quantity <br>Authorized <br>(M.Kgs.)</th>
                        <th>Total <br>Bales<br> Marketed</th>
                        <th>Quantity<br> Marketed<br> (Kgs.)</th>
                        <th>Average <br>Price <br>(Rs./Kg)</th>
                        <th>End Date<br> Of<br> Auction <br>(d-m-y)</th>
                    </tr>
                </thead>
                <tbody>
 <?php
$sel1=executework("select * from tob_auction,tob_platform where tob_auction.platf=tob_platform.id and state='".$stat."' and tdate='".$adate."' and tob_platform.isactive=1 order by field(tob_platform.catg,'NBS','SBS','SLS','NLS'),tob_platform.seqid");
							$cntt=@mysqli_num_rows($sel1);
							$qau=0;
							$tbal=0;
							$tquat=0;
							$tvalu=0;
						  	$tvalv=0;
							while($row1=@mysqli_fetch_array($sel1))
							{
								$selauct=executework("select * from tob_auct where platf=".$row1['platf']." and year=".$yr);
								
								$rowa=@mysqli_fetch_array($selauct);
								$selsm=executework("select sum(bsold) as bsold,sum(qsold) as qsold,sum(tvalue) as tval from tob_auction where platf=".$row1['platf']." and tdate between '".$rowa['cdate']."' and '".$row1['tdate']."'");
								$rows=@mysqli_fetch_array($selsm);
								
								$eq=$row1['qsold'];
								$eb=$row1['bsold'];
								$ep=$row1['aprice'];
								
								$qau+=$rowa['qauth'];
								$tbal+=$eb;
								$tquat+=$eq;
								$tvalu+=$row1['tvalue'];
								$tvalv+=$rows['tval'];
							?>
							  <tr>
                                <td bgcolor="#FFFFFF"><span class="style38"><?php echo $row1['platform'] ?></span></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo num_fround($rowa['qauth'],2) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo $eb ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo num_fround($eq,1) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo num_fround($ep,2) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="center"><span class="style38">
								  <?php if($rowa['edate']!="" && $rowa['edate']!='0000-00-00') { echo datepattrn($rowa['edate']); } ?>
								  </span></div></td>  
                              </tr>
							  <?php
							
							}
						  if($tquat>0)
							{
								$tcpr=$tvalu/$tquat;
							}
							else
							$tcpr=0;
							 ?>
							  <tr style="color:#008cff;">
							    <td bgcolor="#FFFFFF" class="style36"><strong>GRAND TOTAL </strong></td>
							    <td bgcolor="#FFFFFF"><div align="right"><strong><?php echo num_fround($qau,2) ?></strong></div></td>
							    <td bgcolor="#FFFFFF"><div align="right"><strong><?php echo $tbal ?></strong></div></td>
							    <td bgcolor="#FFFFFF"><div align="right"><strong><?php echo num_fround($tquat,1) ?></strong></div></td>
							    <td bgcolor="#FFFFFF"><div align="right"><strong><?php echo num_fround($tcpr,2) ?></strong></div></td>
							    <td bgcolor="#FFFFFF">&nbsp;</td>
							    </tr>
                   
                    
                    
                </tbody>
                
				
            </table>
            </div>
            
          </div>
        
      </div><!-- End Row-->
                     </div>
                 
                  
             </div>
				<br>
				
				<ul class="nav nav-pills" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" href="#piil-1"> <span class="hidden-xs">Graph</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#piil-2"><span class="hidden-xs">Table</span></a>
                  </li>
                
                  
                </ul>
				
          </div>
        </div>
        <div class="col-lg-12">
		
           <div class="card">
		  
		   
		    <h6 class="text-uppercase">FCV TOBACCO AUCTIONS CUMULATIVE INFORMATION</h6>
		   
              <div class="card-body"> 
			 
                

                <!-- Tab panes -->
                <div class="tab-content">
                  <div id="piil-3" class="container tab-pane active">
                     <form id="actn1" name="actn1" method="post" action="">
                      <div> 
                          <div class="example-content">
                            
							<table border="0">
                              <tr>
                                <td style="vertical-align: top"><div align="center"><!-- Example scripts go here -->
                            <div id="chart3" style="margin-top:20px; margin-left:20px; width:900px; height:500px;" align="center"></div></div></td>
                                <td valign="top"><div align="center">
                                  <table width="180" border="0" cellpadding="2" cellspacing="2" bgcolor="#FFF0FF" style="font-size: 12px;">
                                        <?php
									for($i=0;$i<count($plat1);$i++)
									{
										$chkk="";
										if(isset($_POST['platform']))
										{
											if(in_array($plat1[$i][0],$_POST['platform']))
											{
												$chkk="checked=true";
											}
											else
											{
												$chkk="";
											}
										}
										else
										$chkk="checked=true";
									?>
                                    <tr bgcolor="#FFFFFF">
                                      <td bgcolor="#FFF0FF"><label style="margin-bottom: 0px;"><input name="platform[]" type="checkbox" value="<?php echo $plat1[$i][0] ?>" <?php echo $chkk ?> id="platform[]" onchange="actn.submit();" />
                                        &nbsp;&nbsp;<?php echo $plat1[$i][1] ?></label></td>
                                    </tr>
                                        <!--<option value="<?php //echo $plat1[$i][0] ?>"><?php //echo $plat1[$i][1] ?></option>-->
                                        <?php
									}
									?>
                                    <tr bgcolor="#FFFFFF">
                                      <td bgcolor="#FFF0FF" class="style38"><div align="center"><a style="cursor:pointer" onclick="checkAll('actn', 'true');"><strong>Check All</strong></a></div></td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF">
                                      <td bgcolor="#FFF0FF" class="style38"><div align="center"><strong><a style="cursor:pointer" onclick="checkAll('actn','');">Uncheck All</a></strong></div></td>
                                    </tr>
                                  </table>
                                </div></td>
                              </tr>
                            </table>
                            <table width="700" border="0">
                              <tr>
                                <td><div align="center"></div></td>
                              </tr>
                            </table>
                            <!--<pre class="code brush:js"></pre>-->
                                                   </script>
                            <!-- End example scripts -->
                      </div>
                    </form> </div>
			    </div>
				
                  <div id="piil-4" class="container tab-pane fade">
				  
				<div class="row">
        
          <div class="card">
            <!--<div class="card-header"><i class="fa fa-table"></i> Data Table Example</div>-->
            <?php
							$sel3=executework("select * from tob_grade where pdate<='".$qdate2."' and state='".$stat."' order by pdate desc limit 1");
							$rowaa=@mysqli_fetch_array($sel3);
								$adate=$rowaa['pdate'];
			  ?>
              <div class="table-responsive" style=" height: 500px; overflow: scroll;">
              <table id="" class="table table-bordered" style="font-size: 12px;">
                <thead>
                    <tr style="color:#008cff;">
                      <th colspan="6"><?php echo $yr; ?> Year Auctions - Sales Report</th>
                      </tr>
                    <tr style="color:#008cff;">
                      <th colspan="2">Start Auction Year : <?php echo $yr ?></th>
                      <th colspan="2">Day : <?php echo $days ?></th>
                      <th colspan="2">Auction&nbsp;Date : <?php echo datepattrn($adate) ?></th>
                      </tr>
                    <tr style="color:#008cff;">
                        <th>Name of the <br>Auction<br> Platform</th>
                        <th>Quantity <br>Authorized <br>(M.Kgs.)</th>
                        <th><span class="style36"> Cumulative<br>
                          Total<br>
                          Bales<br>
                          Marketed</span></th>
                        <th><span class="style36">Cumulative</span><br>
                          Quantity<br> 
                          Marketed<br> (Kgs.)</th>
                        <th><span class="style36">Cumulative</span><br>
                          Average <br>
                          Price <br>(Rs./Kg)</th>
                        <th>End Date<br> Of<br> Auction <br>(d-m-y)</th>
                    </tr>
                </thead>
                <tbody>
 <?php
$sel1=executework("select * from tob_auction,tob_platform where tob_auction.platf=tob_platform.id and state='".$stat."' and tdate='".$adate."' and tob_platform.isactive=1 order by field(tob_platform.catg,'NBS','SBS','SLS','NLS'),tob_platform.seqid");
							$cntt=@mysqli_num_rows($sel1);
							$qau=0;
							$tbal=0;
							$tquat=0;
							$tvalu=0;
						  	$tvalv=0;
							while($row1=@mysqli_fetch_array($sel1))
							{
								$selauct=executework("select * from tob_auct where platf=".$row1['platf']." and year=".$yr);
								
								$rowa=@mysqli_fetch_array($selauct);
								$selsm=executework("select sum(bsold) as bsold,sum(qsold) as qsold,sum(tvalue) as tval from tob_auction where platf=".$row1['platf']." and tdate between '".$rowa['cdate']."' and '".$row1['tdate']."'");
								$rows=@mysqli_fetch_array($selsm);
								
								$eq=$rows['qsold'];
								$eb=$rows['bsold'];
								$ep=$row1['cprice'];
								
								$qau+=$rowa['qauth'];
								$tbal+=$eb;
								$tquat+=$eq;
								$tvalu+=$row1['tvalue'];
								$tvalv+=$rows['tval'];
							?>
							  <tr>
                                <td bgcolor="#FFFFFF"><span class="style38"><?php echo $row1['platform'] ?></span></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo num_fround($rowa['qauth'],2) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo $eb ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo num_fround($eq,1) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo num_fround($ep,2) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="center"><span class="style38">
								  <?php if($rowa['edate']!="" && $rowa['edate']!='0000-00-00') { echo datepattrn($rowa['edate']); } ?>
								  </span></div></td>  
                              </tr>
							  <?php
							
							}	
                   if($tquat>0)
							{
								$tcpr=$tvalv/$tquat;
							}
							else
							$tcpr=0;
							 ?>
							  <tr style="color:#008cff;">
							    <td bgcolor="#FFFFFF" class="style36"><strong>GRAND TOTAL </strong></td>
							    <td bgcolor="#FFFFFF"><div align="right"><strong><?php echo num_fround($qau,2) ?></strong></div></td>
							    <td bgcolor="#FFFFFF"><div align="right"><strong><?php echo $tbal ?></strong></div></td>
							    <td bgcolor="#FFFFFF"><div align="right"><strong><?php echo num_fround($tquat,1) ?></strong></div></td>
							    <td bgcolor="#FFFFFF"><div align="right"><strong><?php echo num_fround($tcpr,2) ?></strong></div></td>
							    <td bgcolor="#FFFFFF">&nbsp;</td>
							    </tr>
							  <tr style="color:#008cff;">
							    <td colspan="6" bgcolor="#FFFFFF" class="style36">&nbsp;</td>
					      </tr>
							  <tr>
							    <td colspan="6" bgcolor="#FFFFFF" class="style36" style="text-align: center"><table width="66%" border="0" cellpadding="1" cellspacing="1" bgcolor="#000033" align="center">
							<tr style="color:#008cff;">
                                <td width="25%" bgcolor="#FFFFFF"><div align="center" class="style36">Grade Out-turn</div></td>
								<td width="27%" bgcolor="#FFFFFF"><div align="center" class="style36">Quantity Marketed (M.Kgs.)</div></td>
								  
								<td width="26%" bgcolor="#FFFFFF"><div align="center" class="style36">% share</div></td>
							  <td width="22%" bgcolor="#FFFFFF"><div align="center" class="style36">Average Price (Rs. / Kg.)</div></td>
                            </tr>
							  <tr>
                                <td bgcolor="#FFFFFF" style="color:#008cff;"><span class="style38">Bright Grades</span></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo numround($rowaa['bq'],3) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo numround($rowaa['bp'],2) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo numround($rowaa['ba'],2) ?></span></div></td>
                              </tr>
							  <tr>
                                <td bgcolor="#FFFFFF" style="color:#008cff;"><span class="style38">Medium Grades</span></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo numround($rowaa['mq'],3) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo numround($rowaa['mp'],2) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo numround($rowaa['ma'],2) ?></span></div></td>
                              </tr>
							  <tr>
                                <td bgcolor="#FFFFFF" style="color:#008cff;"><span class="style38">Low Grades</span></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo numround($rowaa['lq'],3) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo numround($rowaa['lp'],2) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo numround($rowaa['la'],2) ?></span></div></td>
                              </tr>
							  </table></td>
					      </tr>
                    
                    
                </tbody>
                
				
            </table>
            </div>
            
          </div>
        
      </div><!-- End Row-->
                </div>
                 
                  
             </div>
				<br>
				
				<ul class="nav nav-pills" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" href="#piil-3"> <span class="hidden-xs">Graph</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#piil-4"><span class="hidden-xs">Table</span></a>
                  </li>
                
                  
                </ul>
				
          </div>
         </div>
      </div>
<div class="row">
        
        
        

         <div class="col-lg-2" style="padding-left: 5px; padding-right: 5px;">
		
           <a href="auctions2.php"><div class="card">
		  
		   
		    <h6 class="text-uppercase" style="background-color: #1e4c1b">VIEW KARNATAKA</h6>
		   

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
<style type="text/css">
	.table thead th {
		padding-top: 0.25em;
		padding-bottom: 0.25em;
		padding: 0.25em;
	}
	.table td {
		padding: 0.25em;
	}
	</style>

<script class="" type="text/javascript">
$(document).ready(function(){
	graph1();
	graph3();
	/*if(document.actn.tp[0].checked)
	{
		graph1();
	}
	else
	{
		graph3();
	}*/
});

								
								
function graph1()
{
	var st1='<?php echo $st ?>';
	var td1='<?php echo $td ?>';
	var prc1='<?php echo $prc ?>';
	var gmin='<?php echo $rowg['min2']; ?>';
	var gmax='<?php echo $rowg['max2']; ?>';
	var st=new Array();
	var td=new Array();
	var prc=new Array();
	var tot=new Array();

	st=st1.split(':');
	td=td1.split(':');
	prc=prc1.split(':');
	var prca=new Array();
	var a=0;
	for(i=0;i<st.length;i++)
	{
		var tds=td[i].split('^');
		var prcs=prc[i].split('^');
		var tot1=new Array();
		for(j=0;j<tds.length;j++)
		{
			tot1[j]=Array(tds[j],prcs[j]);
			prca[a]=prcs[j];
			a++;
		}
		tot[i]=tot1;
	}
//	alert("tot="+prca);
		var smax = Math.max.apply(Math, prca);
		var smin = Math.min.apply(Math, prca);
		if(smax=="")
		smax=200;
		else
		smax=parseInt(smax);
		
		if(smin=="")
		smin=120;
		else
		smin=parseInt(smin);

		var rema1=parseFloat(smin)/10;
		var rema2=Math.round(rema1);
		if(rema2>rema1)
		var xtra=10;
		else
		xtra=0;
		smin=(parseFloat(rema2)*10)-parseInt(xtra);

		var dif=parseFloat(smax)-parseFloat(smin);
		var dif1=parseFloat(dif)/10;
		var dif1=Math.round(dif1)+1;
		smax=parseFloat(smin)+(parseFloat(dif1)*10);
		smin=gmin/1;
		smax=gmax/1;
  var plot1 = $.jqplot ('chart2', tot, {
      // Give the plot a title.
      //title: 'Domestic Auction Information (Platform Wise)',
              animate: true,
            // Will animate plot on calls to plot1.replot({resetAxes:true})
            animateReplot: true,
     // You can specify options for all axes on the plot at once with
      // the axesDefaults object.  Here, we're using a canvas renderer
      // to draw the axis label which allows rotated text.
            seriesDefaults: {
                pointLabels: { show: true },
				markerOptions: {
							show: true,             // wether to show data point markers.
							style: 'filledCircle',  // circle, diamond, square, filledCircle.
//													// filledDiamond or filledSquare.
							lineWidth: 2,       // width of the stroke drawing the marker.
							size: 5,            // size (diameter, edge length, etc.) of the marker.
//							color: '#666666'    // color of marker, set to color of line by default.
							shadow: false,       // wether to draw shadow on marker or not.
//							shadowAngle: 45,    // angle of the shadow.  Clockwise from x axis.
//							shadowOffset: 1,    // offset from the line of the shadow,
//							shadowDepth: 3,     // Number of strokes to make when drawing shadow.  Each stroke
//												// offset by shadowOffset from the last.
//							shadowAlpha: 0.07   // Opacity of the shadow
						}
            },
      axesDefaults: {
                 pointLabels: { show: true },
				markerOptions: {
							show: true,             // wether to show data point markers.
							style: 'filledCircle',  // circle, diamond, square, filledCircle.
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
		  tickRenderer: $.jqplot.CanvasAxisTickRenderer,
				tickOptions: {
				  angle: -45
				},
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
                        highlightMouseOver: true
      },
	  legend:{
	  	show:true,
		placement:"outsideGrid",
		labels:st,
	  },
	  
      // An axes object holds options for all axes.
      // Allowable axes are xaxis, x2axis, yaxis, y2axis, y3axis, ...
      // Up to 9 y axes are supported.
      axes: {
        // options for each axis are specified in seperate option objects.
        xaxis: {
          label: "Date",
		numberTicks: 10, 
		  renderer: $.jqplot.DateAxisRenderer,
          // Turn off "padding".  This will allow data point to lie on the
          // edges of the grid.  Default padding is 1.2 and will keep all
          // points inside the bounds of the grid.
          pad: 0
        },
        yaxis: {
			min: smin,
			max: smax,
			numberTicks: 11, 
          label: "Average Price",
        },
		highlighter: {
			show: true, 
			showLabel: true, 
			tooltipAxes: 'y',
			sizeAdjust: 7.5 , tooltipLocation : 'ne'
		}
      }
    });
}

function graph3()
{
	var st1='<?php echo $st ?>';
	var td1='<?php echo $td ?>';
	var prc1='<?php echo $aprc ?>';
	var gmin='<?php echo $rowg['min3']; ?>';
	var gmax='<?php echo $rowg['max3']; ?>';
//	alert(prc1);
	var st=new Array();
	var td=new Array();
	var prc=new Array();
	var tot=new Array();

	st=st1.split(':');
	td=td1.split(':');
	prc=prc1.split(':');
	var prca=new Array();
	var a=0;
	for(i=0;i<st.length;i++)
	{
		var tds=td[i].split('^');
		var prcs=prc[i].split('^');
		var tot1=new Array();
		for(j=0;j<tds.length;j++)
		{
			tot1[j]=Array(tds[j],prcs[j]);
			prca[a]=prcs[j];
			a++;
		}
		tot[i]=tot1;
	}
//	alert(tot);
		var smax = Math.max.apply(Math, prca);
		var smin = Math.min.apply(Math, prca);
		if(smax=="")
		smax=200;
		else
		smax=parseInt(smax);
		
		if(smin=="")
		smin=120;
		else
		smin=parseInt(smin);

		var rema1=parseFloat(smin)/10;
		var rema2=Math.round(rema1);
		if(rema2>rema1)
		var xtra=10;
		else
		xtra=0;
		smin=(parseFloat(rema2)*10)-parseInt(xtra);

		var dif=parseFloat(smax)-parseFloat(smin);
		var dif1=parseFloat(dif)/10;
		var dif1=Math.round(dif1)+1;
		smax=parseFloat(smin)+(parseFloat(dif1)*10);

//		alert(smax+"--"+smin);
/*		var rem1=parseFloat(smax)/100;
		var rem2=Math.round(rem1);
//		alert(rem2);
		if(rem2<rem1)
		var xtr=50;
		else
		xtr=0;
//		alert(tot);
		smax=(parseFloat(rem2)*100)+parseInt(xtr);
		
*/
		smax=gmax/1;
		smin=gmin/1;
  var plot1 = $.jqplot ('chart3', tot, {
      // Give the plot a title.
      //title: 'Domestic Auction Information (Platform Wise)',
              animate: true,
            // Will animate plot on calls to plot1.replot({resetAxes:true})
            animateReplot: true,
     // You can specify options for all axes on the plot at once with
      // the axesDefaults object.  Here, we're using a canvas renderer
      // to draw the axis label which allows rotated text.
            seriesDefaults: {
                pointLabels: { show: true },
				markerOptions: {
							show: true,             // wether to show data point markers.
							style: 'filledCircle',  // circle, diamond, square, filledCircle.
//													// filledDiamond or filledSquare.
							lineWidth: 2,       // width of the stroke drawing the marker.
							size: 5,            // size (diameter, edge length, etc.) of the marker.
//							color: '#666666'    // color of marker, set to color of line by default.
							shadow: false,       // wether to draw shadow on marker or not.
//							shadowAngle: 45,    // angle of the shadow.  Clockwise from x axis.
//							shadowOffset: 1,    // offset from the line of the shadow,
//							shadowDepth: 3,     // Number of strokes to make when drawing shadow.  Each stroke
//												// offset by shadowOffset from the last.
//							shadowAlpha: 0.07   // Opacity of the shadow
						}
            },
      axesDefaults: {
                 pointLabels: { show: true },
				markerOptions: {
							show: true,             // wether to show data point markers.
							style: 'filledCircle',  // circle, diamond, square, filledCircle.
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
		  tickRenderer: $.jqplot.CanvasAxisTickRenderer,
				tickOptions: {
				  angle: -45
				},
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
                        highlightMouseOver: true
      },
	  legend:{
	  	show:true,
		placement:"outsideGrid",
		labels:st,
	  },
      // An axes object holds options for all axes.
      // Allowable axes are xaxis, x2axis, yaxis, y2axis, y3axis, ...
      // Up to 9 y axes are supported.
      axes: {
        // options for each axis are specified in seperate option objects.
        xaxis: {
          label: "Date",
		numberTicks: 10, 
		  renderer: $.jqplot.DateAxisRenderer,
          // Turn off "padding".  This will allow data point to lie on the
          // edges of the grid.  Default padding is 1.2 and will keep all
          // points inside the bounds of the grid.
          pad: 0
        },
        yaxis: {
			min: smin,
			max: smax,
			numberTicks: 11, 
          label: "Cumulative Average Price",
        },
		highlighter: {
			show: true, 
			showLabel: true, 
			tooltipAxes: 'y',
			sizeAdjust: 7.5 , tooltipLocation : 'ne'
		}
      }
    });
}
 
   function graph2(){
  
	var st1='<?php echo $st ?>';
	var tqty1='<?php echo $tqty ?>';
	var tval1='<?php echo $tval ?>';

	var tqty=new Array();
	var s=new Array();
	var st=new Array();

	tqty=tqty1.split(':');
	s=tval1.split(':');
	st=st1.split(':');

	var xlab='<?php echo $qdate1 ?>';
	var tit="Domestic Auction Information (Platform Wise)";

		var ylab='Cumulative Average Price';
		var smax = Math.max.apply(Math, s);
		alert(smax);
		if(smax=="")
		smax=200;
		var rem1=parseFloat(smax)/100;
		var rem2=Math.round(rem1);
		//alert(rem1);
		if(rem2<rem1)
		var xtr=50;
		else
		xtr=0;
		smax=(parseFloat(rem2)*100)+parseInt(xtr);

//		s1=[s[0],s[1],s[2],s[3],s[4],s[5],s[6],s[7],s[8],s[9],s[10],s[11]];
 //       var s2 = [7, 5, 3, 2];
//         var ticks = ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'];
         var ticks = st;
        plot2 = $.jqplot('chart2', [s], {
            seriesDefaults: {
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true },
				markerOptions: {
							seriesColors: [ "#4bb2c5", "#c5b47f", "#EAA228", "#579575", "#839557", "#958c12",
        "#953579", "#4b5de4", "#d8b83f", "#ff5800", "#0085cc"],
							show: true,             // wether to show data point markers.
							style: 'filledCircle',  // circle, diamond, square, filledCircle.
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
             animate: true,
            // Will animate plot on calls to plot1.replot({resetAxes:true})
            animateReplot: true,
			//title: tit,
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
                        barPadding: 25,
                        barMargin: 15,
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
					tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
                    ticks: ticks,
					label:xlab,
					tickOptions: {
                    angle: 90,
                    fontSize: '10pt',
                    showMark: true,
                }
                },
				yaxis: {
					min: 0,
					max: smax,
					numberTicks: 11, 
					tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
	                pointLabels: { show: true },
					label:ylab,
					tickOptions: {
                    angle: 90,
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
    
//        $('#chart2').bind('jqplotDataHighlight', 
//            function (ev, seriesIndex, pointIndex, data) {
//                $('#info2').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
//            }
//        );
//            
//        $('#'+chrt).bind('jqplotDataUnhighlight', 
//            function (ev) {
//                $('#info2').html('Nothing');
//            }
//        );
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
	  
	  
      

    
  

