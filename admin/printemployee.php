<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(isset($_SESSION["tobadmin"]))
{

$stp=''; $sc=0;
	
if(!empty($_FILES['image']['name']))
{
	$sel=executework("select * from master_employee where Employee_number='".$_GET['eid']."'");
	$count=@mysqli_num_rows($sel);
	if($count>0)
	{
		$row=@mysqli_fetch_array($sel);
		$target_pathn = "employeeimage/";
		$f=basename($_FILES['image']['name']);
		$len=strlen($f);
		$pos=strpos($f,'.');
		$ext=substr($f,$pos,$len);
		$f1=$row['Employee_number'].$ext;
		$file="employeeimage/".$f1;
		echo "exs=".file_exists($file);
		if(file_exists($file))
		{
			unlink("employeeimage/".$f1);
		}
		$tmpn=$_FILES['image']['tmp_name'];
		$target_pathsmn = $target_pathn .$f1; 
		move_uploaded_file($tmpn, $target_pathsmn);
		$update=executework("update master_employee set image='".$f1."' where Employee_number='".$row['Employee_number']."'");
		redirect("employee.php?eid=".$row['Employee_number']);
	}
	else
	{
		redirect("employeedata.php?valid=0");
	}
}
$select=executework("select * from master_employee where Employee_number='".$_GET['eid']."'");
$cnt=@mysqli_num_rows($select);
$row=@mysqli_fetch_array($select);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
}
.style8 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.style8a {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }

a:link {
	color: #000000;
	text-decoration: none;
}
a:visited {
	color: #000000;
	text-decoration: none;
}
a.b:hover {
	color: #990000;
	text-decoration: none;
}
a.b:active {
	color: #990000;
	text-decoration: none;
}

	#tabs {
	  overflow: hidden;
	  width: 100%;
	  margin: 0;
	  padding: 0;
	  list-style: none;
	  border-bottom:1px #ccc solid;
	  font-family:Arial, Helvetica, sans-serif;
	  font-size:12px;
	  color:#000;
	  line-height:19px;
	  
	}

	#tabs li {
	  float: left;
	  margin: 0 -15px 0 0;
	}

	#tabs a {
	  float: left;
	  position: relative;
	  padding: 0 20px;
	  height: 0;
	  line-height: 30px;
	  text-decoration: none;
	  color: #fff;      
	  border-right: 30px solid transparent;
	  border-bottom: 30px solid #023d5b;
	  border-bottom-color: #777\9;
	}

	#tabs a:hover,
	#tabs a:focus {
	  border-bottom-color: #3f7e0b;
	}

	#tabs a:focus {
	  outline: 0;
	}

	#tabs #current {
	  z-index: 3;
	  border-bottom-color: #d45c05;
	  opacity: 1;
	}
		#content {
	    background: #fff;
	    border-left: 1px solid #ccc;
		border-right: 1px solid #ccc;
		border-bottom: 1px solid #ccc;
	    padding: 10px;
		font-family:Arial, Helvetica, sans-serif;
	  font-size:12px;
		color:#333333;
		line-height:20px;

	    /*height: 220px;*/
	}

	#content h2,
	  #content h3,
	  #content p {
	    margin: 0 0 15px 0;
	}  
-->
</style>
</head>
<script language="javascript">
function validate_image()
{
	if(document.form1.image.value=="")
	{
		alert("Browse Image");
		document.form1.image.focus();
		return false;
	}
	else
	{
		var pimage="image";
		var pi=document.getElementById(pimage).value;
		var plen=pi.length;
		var ppos=pi.indexOf(".");
		var ext=pi.substr(ppos+1,plen);
		var ext1=ext.toLowerCase();
		if(ext1!='jpg' && ext1!='jpeg' && ext1!='gif' && ext1!='png')
		{
			alert("Only file types of jpg,jpeg,gif,png are allowed for Image");
			document.getElementById(pimage).value="";
			document.getElementById(pimage).focus();
			return false;
		}
		else
		return true;
	}
}
function back_list(st,st1)
{
	location.href="employeedata.php?catg="+st+"&group_by="+st1;
}

</script>
<body>
<?php

function dateobj_bet_dates($date2,$date1)
{
	$dt2=date('Y-m-d H:i:s',strtotime($date1));
	$dt1=date('Y-m-d H:i:s',strtotime($date2));
	$y1=date('Y',strtotime($date1));
	$y2=date('Y',strtotime($date2));
	$m1=date('m',strtotime($date1));
	$m2=date('m',strtotime($date2));
	$d1=date('d',strtotime($date1));
	$d2=date('d',strtotime($date2));
	$h1=date('H',strtotime($date1));
	$h2=date('H',strtotime($date2));
	$i1=date('i',strtotime($date1));
	$i2=date('i',strtotime($date2));
	$s1=date('s',strtotime($date1));
	$s2=date('s',strtotime($date2));
	
	$days=date('t',strtotime($date1));
	//echo "dd=".$days;
	
	if($s2>$s1)
	{
		$s1=$s1+60;
		$i1=$i1-1;
	}
	$s=$s1-$s2;
	if($i2>$i1)
	{
		$i1=$i1+60;
		$h1=$h1-1;
	}
	$i=$i1-$i2;
	if($h2>$h1)
	{
		$h1=$h1+24;
		$d1=$d1-1;
	}
	$h=$h1-$h2;
	if($d2>$d1)
	{
		$d1=$d1+$days;
		$m1=$m1-1;
	}
	$d=$d1-$d2;
	if($m2>$m1)
	{
		$m1=$m1+12;
		$y1=$y1-1;
	}
	$m=$m1-$m2;
		$y=$y1-$y2;
		
	if($y2>$y1)
	{
		return "invalid";
	}
	else
	{
		$arr=array($y,$m,$d,$h,$i,$s);
		return $arr;
	}
}

function GetDays($sStartDate, $sEndDate){  
  // Firstly, format the provided dates.  
  // This function works best with YYYY-MM-DD  
  // but other date formats will work thanks  
  // to strtotime().  
  $sStartDate = gmdate("Y-m-d", strtotime($sStartDate));  
  $sEndDate = gmdate("Y-m-d", strtotime($sEndDate));  
  
  // Start the variable off with the start date  
  $aDays[] = datepattrn($sStartDate);  
  
  // Set a 'temp' variable, sCurrentDate, with  
  // the start date - before beginning the loop  
  $sCurrentDate = $sStartDate;
  
  // While the current date is less than the end date
  while($sCurrentDate < $sEndDate){
    // Add a day to the current date  
    $sCurrentDate = gmdate("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));  
  
    // Add this new day to the aDays array  
    $aDays[] = datepattrn($sCurrentDate);  
  }
  
  // Once the loop has finished, return the  
  // array of days.  
  return $aDays;  
}
	function datepattrn($a)
	{
		$g="";
		if($a!="")
		{
			$b = substr($a,5, 2);// month
			$c = substr($a,7, 1);// '-'
			$d= substr($a,8, 2);// day
			$e = substr($a,4, 1);// '-'
			$f = substr($a,0, 4);// year
			$c="-";
			$e="-";
			$g=$d."/".$b."/".$f;
		}
		return $g;
	}
	function datepattrn1($a)
	{
		$g="";
		if($a!="")
		{
			$b = substr($a,3, 2);// month
			$c = substr($a,2, 1);// '-'
			$d= substr($a,0, 2);// day
			$e = substr($a,5, 1);// '-'
			$f = substr($a,6, 4);// year
			$c="-";
			$e="-";
			$g=$f."/".$b."/".$d;
		}
		return $g;
	}

	function numround($st,$n)
	{
		if($st!="")
		{
			$n1=pow(10 ,$n);
			$num=round($st*$n1)/($n1);
		}
		return $num;
	}
	if(!empty($row['image']))
	$img="employeeimage/".$row['image'];
	else
	$img="noimage.png";
	
	
	if(!empty($row['E_whether DR/PR']))
	{
		if($row['E_whether DR/PR']=='PR')
		$row['E_whether DR/PR']='Promotion';
		else
		$row['E_whether DR/PR']='Direct Recruitment';
	}
	if(!empty($row['E_Regular/Temp/Adhoc']))
	{
		if($row['E_Regular/Temp/Adhoc']=='R')
		$row['E_Regular/Temp/Adhoc']='Regular';
		else if($row['E_Regular/Temp/Adhoc']=='T')
		$row['E_Regular/Temp/Adhoc']='Temporary';
	}
	if(!empty($row['E_TECH/NON TECH']))
	{
		if($row['E_TECH/NON TECH']=='T')
		$row['E_TECH/NON TECH']='Technical';
		else if($row['E_TECH/NON TECH']=='NT')
		$row['E_TECH/NON TECH']='Non-Technical';
	}
	
		if(isset($_SESSION['tobadmin']) && $_SESSION['tobadmin']=='admin')
		{
			$detai=array('ADD','VIEW','MODIFY','DELETE','PRINT');
		}
		else if(isset($_SESSION['tobadmin']))
		{
			$sel=executework("select * from tob_employeeview where username='".$_SESSION['tobadmin']."'");
			$rowp=@mysqli_fetch_array($sel);
			$details=array($rowp['permissions']);
			foreach($details as $detail)
			$detai=explode(',',$detail);
		}
		else
		$detai=array();
if(!in_array('PRINT',$detai))
{
	redirect("employeedata.php");
}
?>
<?php //include_once("header.php"); ?>
<a name="top" id="top"></a>
<table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
 
  <tr>
    <td colspan="2" valign="top"><br />
      <table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30" align="justify"><div class="rightcorner1">
          <div class="innercontent">
            <div class="rightcorner1">
              <div class="innercontent">
                <div>
                  <div>
                    <div>
                      <div>
                        <table width="98%" border="0">
	  					<tr>
						 <td><strong><?php echo $stp ?></strong></td>
						</tr>
                          <tr>
                            <td height="90" colspan="2"><div align="center">
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return validate_image();" >
                    <br />

        <ul id="tabs">
      <li></li>
      <li></li>
  </ul>
<?php
$sob=executework("select * from tob_designation where id='".$row['Designation']."'");
$roer=@mysqli_fetch_array($sob);

$selectg=executework("select * from tob_platfrm where id='".$row['place_working']."'");
$rowtg=@mysqli_fetch_array($selectg);
?>
                    <div id="content">
      <div >
        <table width="800" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">
                      <tr>
                        <td colspan="3" bordercolor="#000000" bgcolor="#FFFFFF"><table width="800" border="1" align="center" cellpadding="4" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#000000">
                          <tr bgcolor="#F5F5F5">
                            <td width="24%" bgcolor="#F5F5F5" class="style8a">Name</td>
                            <td width="20%" bgcolor="#F5F5F5" class="style8"><?php echo $row['Name']; ?></td>
                            <td class="style8a">Employee Number</td>
                            <td class="style8"><?php echo $row['Employee_number']; ?></td>
                            <td width="22%" rowspan="6"><div align="center"><img src="<?php echo $img ?>" height="150"/></div></td>
                          </tr>
                          <tr bgcolor="#DDDDDD">
                            <td bgcolor="#DDDDDD" class="style8a">Present Designation</td>
                            <td bgcolor="#DDDDDD" class="style8"><?php echo $roer['designation']; ?></td>
                            <td bgcolor="#DDDDDD" class="style8a">Group</td>
                            <td bgcolor="#DDDDDD" class="style8"><?php echo $row['E_CLASSIFICATION']; ?></td>
                          </tr>
                          <tr bgcolor="#F5F5F5">
                            <td class="style8a">Present Place Of Working</td>
                            <td class="style8"><?php echo $rowtg['platform']; ?></td>
                            <td bgcolor="#F5F5F5" class="style8a">Section</td>
                            <td bgcolor="#F5F5F5" class="style8"><?php echo $row['E_SECTION']; ?></td>
                          </tr>
                          <tr bgcolor="#DDDDDD">
                            <td bgcolor="#DDDDDD" class="style8a">Working Since</td>
                            <td bgcolor="#DDDDDD" class="style8"><?php echo datepattrn($row['Working_from']); ?></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr bgcolor="#DDDDDD">
                            <td bgcolor="#F5F5F5" class="style8a">Pay Band</td>
                            <td bgcolor="#F5F5F5" class="style8"><?php echo $row['E_Pay_Band']; ?></td>
                            <td width="16%" bgcolor="#F5F5F5">&nbsp;</td>
                            <td width="18%" bgcolor="#F5F5F5">&nbsp;</td>
                            </tr>
                          <tr bgcolor="#DDDDDD">
                            <td class="style8a">Grade Pay</td>
                            <td class="style8"><?php echo $row['E_Grade_Pay']; ?></td>
                            <td class="style8a">Date Of Retirement</td>
                            <td class="style8"><?php echo datepattrn($row['E_DOR']); ?></td>
                            </tr>
                          
                        </table></td>
                        </tr>
                      
                      
                   <?php
				   $selser=executework("select * from service_details where E_NO='".$_GET['eid']."' order by E_FROM");
				   $cnts=@mysqli_num_rows($selser);
				   if($cnts>0)
				   {
				   ?>
                      <tr>
                        <td width="40%" bgcolor="#FFFFFF" class="style1">&nbsp;</td>
                        <td width="60%" colspan="2" bgcolor="#FFFFFF" class="style8">&nbsp;</td>
                      </tr>
                      <tr>
                        <td bgcolor="#FFFFFF" class="style1">Placement Details</td>
                        <td colspan="2" bgcolor="#FFFFFF" class="style8">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="3" bgcolor="#FFFFFF" class="style8"><table width="100%" border="1" align="center" cellpadding="4" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#000000">
                          <tr>
                            <td width="5%" rowspan="2" bgcolor="#F5F5F5"><div align="center">S.No</div></td>
                            <td width="21%" rowspan="2" bgcolor="#F5F5F5"><div align="center">Designation</div></td>
                            <td width="23%" rowspan="2" bgcolor="#F5F5F5"><div align="center">Place Of Working</div></td>
                            <td width="10%" rowspan="2" bgcolor="#F5F5F5"><div align="center">Place Code</div></td>
                            <td colspan="2" bgcolor="#F5F5F5"><div align="center">Duration</div></td>
                            <td width="12%" rowspan="2" bgcolor="#F5F5F5"><div align="center">Period Completed<br />
                              (Y-M-D)</div></td>
                            </tr>
                          <tr>
                            <td width="15%" bgcolor="#F5F5F5"><div align="center">From</div></td>
                            <td width="14%" bgcolor="#F5F5F5"><div align="center">To</div></td>
                          </tr>
                        <?php
							$s=1;
							$b=1;
							while($rows=@mysqli_fetch_array($selser))
							{
								if($b==1)
								$bg="#F5F5F5";
								else
								$bg="#DDDDDD";
								$fd=$rows['E_FROM'];
								if($rows['E_TO']!="" && $rows['E_TO']!='0000-00-00')
								$td=$rows['E_TO'];
								else
								$td=date('Y-m-d H:i:s');
								//$fd=gmdate('Y-m-d H:i:s',mktime(date("H")-1, date("i")-1, date("s")-1, date("m")-1, date("d")-1, date("Y")-1));
								$fdt=strtotime($fd);
								$tdt=strtotime($td);
								
								$diff=$tdt-$fdt;
								
								//echo "<br>dd=".$fd."--".$td."--".$fdt."--".$tdt."       ".$diff;
								$yr=$diff%(60*60*24);
								$diff=$diff-$sc;
								$m=$diff%(60*60);
								//echo "<br> sec=".$sc."  min=".$m;
								//echo "<br>";
								$days=NULL;
								$days=dateobj_bet_dates($fd,$td);
								
				$sobl=executework("select * from tob_designation where id='".$rows['E_CADRE']."'");
				$roert=@mysqli_fetch_array($sobl);
				
  $selectg1=executework("select * from tob_platfrm where id='".$rows['E_PLACE']."'");
  $rowtg1=@mysqli_fetch_array($selectg1);
						?>
                          <tr bgcolor="<?php echo $bg ?>">
                            <td><?php echo $s; ?></td>
                            <td><?php echo $roert['designation']; ?></td>
                            <td><?php echo $rowtg1['platform']; ?></td>
                            <td><div align="center"><?php echo $rows['E_PF']; ?></div></td>
                            <td><div align="center"><?php echo datepattrn($rows['E_FROM']); ?></div></td>
                            <td><div align="center"><?php echo datepattrn( substr($td,0,10)); ?></div></td>
                            <td><div align="center"><?php echo $days[0]."-".$days[1]."-".$days[2]; ?></div></td>
                            </tr>
                        <?php
								$s++;
								$b++;
								if($b>2)
								$b=1;
							}
						?>
                        </table></td>
                      </tr>
                  <?php
				  	}
				   $selv=executework("select * from disciplinary_det where E_NO='".$_GET['eid']."' order by id");
				   $cntv=@mysqli_num_rows($selv);
				   if($cntv>0)
				   {
				 ?>
                      <tr bgcolor="#FFFFFF">
                        <td colspan="3" class="style8">&nbsp;</td>
                      </tr>
                      <tr>
                        <td bgcolor="#FFFFFF" class="style1">Vigilance / Disciplinary Details</td>
                        <td colspan="2" bgcolor="#FFFFFF" class="style8">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="3" bgcolor="#FFFFFF" class="style8"><table width="100%" border="1" align="center" cellpadding="4" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#000000">
                            <tr>
                              <td width="5%" bgcolor="#F5F5F5"><div align="center">S.No</div></td>
                              <td width="21%" bgcolor="#F5F5F5"><div align="center">Case Ref. No</div></td>
                              <td width="23%" bgcolor="#F5F5F5"><div align="center">Details Of The Case</div></td>
                              <td width="10%" bgcolor="#F5F5F5"><div align="center">Status Of The Case</div></td>
                              </tr>

                            <?php
							$s=1;
							$b=1;
							while($rowv=@mysqli_fetch_array($selv))
							{
								if($b==1)
								$bg="#F5F5F5";
								else
								$bg="#DDDDDD";
						?>
                            <tr bgcolor="<?php echo $bg ?>">
                              <td><?php echo $s; ?></td>
                              <td><?php echo $rowv['refno']; ?></td>
                              <td><?php echo $rowv['det']; ?></td>
                              <td><div align="center"><?php echo $rowv['status']; ?></div></td>
                              </tr>
                            <?php
								$s++;
								$b++;
								if($b>2)
								$b=1;
							}
						?>
                        </table></td>
                      </tr>
                      <tr>
                        <td colspan="3" class="style8">&nbsp;</td>
                      </tr>
                  <?php
				  }
				  ?>
                    </table>
     
<table width="800" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">
<tr>
<td><span class="style1">Personal  Details</span></td>
</tr>
                      <tr>
                        <td colspan="3" bgcolor="#FFFFFF"><table width="100%" border="1" cellpadding="4" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#000000">
                          <tr bgcolor="#F5F5F5">
                            <td width="22%" class="style8a">Date Of Birth</td>
                            <td width="29%" class="style8"><?php echo datepattrn($row['E_DOB']); ?></td>
                            <td width="23%" bgcolor="#F5F5F5" class="style8a">Category</td>
                            <td width="26%" bgcolor="#F5F5F5" class="style8"><?php echo $row['E_CATEGORY']; ?></td>
                          </tr>
                          <tr bgcolor="#F5F5F5">
                            <td bgcolor="#DDDDDD" class="style8a">Date Of Entry Into Service</td>
                            <td bgcolor="#DDDDDD" class="style8"><?php echo datepattrn($row['E_DOJ']); ?></td>
                            <td bgcolor="#DDDDDD" class="style8a">DR/PR</td>
                            <td bgcolor="#DDDDDD" class="style8"><?php echo $row['E_whetherDRPR']; ?></td>
                          </tr>
                          <tr bgcolor="#F5F5F5">
                            <td class="style8a">Designation At Joining Service</td>
                            <td class="style8"><?php echo $row['E_JOINED_AS']; ?></td>
                            <td bgcolor="#F5F5F5" class="style8a">Regular/Temporary/Adhoc</td>
                            <td bgcolor="#F5F5F5" class="style8"><?php echo $row['E_RegularTempAdhoc']; ?></td>
                          </tr>
                          <tr bgcolor="#F5F5F5">
                            <td bgcolor="#DDDDDD" class="style8a">Total Service Completed</td>
                            <td bgcolor="#DDDDDD" class="style8">&nbsp;</td>
                            <td bgcolor="#DDDDDD" class="style8a">Native Place</td>
                            <td bgcolor="#DDDDDD" class="style8"><?php echo $row['E_NATIVE']; ?></td>
                          </tr>
                          <tr bgcolor="#F5F5F5">
                            <td class="style8a">Educational Qualifications</td>
                            <td class="style8"><?php echo $row['E_QUA']; ?></td>
                            <td class="style8a">Present Residing Address</td>
                            <td class="style8"><?php echo $row['E_ADDRESS']; ?></td>
                          </tr>
                          <tr bgcolor="#F5F5F5">
                            <td bgcolor="#DDDDDD" class="style8a">Technical/Non-Technical</td>
                            <td bgcolor="#DDDDDD" class="style8"><?php echo $row['E_TECHNON_TECH']; ?></td>
                            <td bgcolor="#DDDDDD" class="style8a">Phone Nos.</td>
                            <td bgcolor="#DDDDDD" class="style8"><?php echo $row['E_Phone1']; ?>,<?php echo $row['E_Phone2']; ?></td>
                          </tr>
                          <tr bgcolor="#F5F5F5">
                            <td bgcolor="#F5F5F5" class="style8a">Physical Handicapped</td>
                            <td bgcolor="#F5F5F5" class="style8"><?php echo $row['E_Handicapped']; ?></td>
                            <td bgcolor="#F5F5F5" class="style8a">&nbsp;</td>
                            <td bgcolor="#F5F5F5" class="style8">&nbsp;</td>
                          </tr>

                        </table></td>
                        </tr>
                      
                      
                   <?php
				   $selpr=executework("select * from promotion_det where E_NO='".$_GET['eid']."'");
				   $cntp=@mysqli_num_rows($selpr);
				   if($cntp>0)
				   {
				   		//$rowp=@mysqli_fetch_array($selpr);
				   ?>
                      <tr>
                        <td width="40%" bgcolor="#FFFFFF" class="style8">Promotion Details</td>
                        <td width="60%" colspan="2" bgcolor="#FFFFFF" class="style8">&nbsp;</td>
                      </tr>
                      <tr bgcolor="#FFFFFF">
                        <td colspan="3" class="style8"><table width="100%" border="1" cellpadding="4" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#000000">
                          <tr>
                            <td width="6%" bgcolor="#F5F5F5"><div align="center">S.No</div></td>
                            <td width="21%" bgcolor="#F5F5F5"><div align="center">Designation After Promotion</div></td>
                            <td width="18%" bgcolor="#F5F5F5"><div align="center">Date Of Promotion</div></td>
                            <td width="19%" bgcolor="#F5F5F5"><div align="center">Type Of Promotion<br />
                              (Regular/ACP/MACP)</div></td>
                            <td width="19%" bgcolor="#F5F5F5"><div align="center">Order No.</div></td>
                          </tr>
					<?php
								$s=1;
								$b=1;
						while($rowp=@mysqli_fetch_array($selpr))
						{
							if($rowp["E_DES"]!=NULL)
							{
								$des="E_DES";
								$dat="E_DOP_DT";
								if($b==1)
								$bg="#F5F5F5";
								else
								$bg="#DDDDDD";
								
								$strh=executework("select * from tob_designation where id='".$rowp[$des]."'");
								//echo "select * from tob_designation where id='".$rowp[$des]."'";
								$rotrh=@mysqli_fetch_array($strh);
						?>
                          <tr bgcolor="<?php echo $bg ?>">
                            <td><?php echo $s ?></td>
                            <td><?php echo $rotrh['designation']; ?></td>
                            <td><div align="center"><?php echo datepattrn($rowp[$dat]); ?></div></td>
                            <td><?php echo $rowp['ptype']; ?></td>
                            <td><?php echo $rowp['orderno']; ?></td>
                          </tr>
							 <?php
								$s++;
								$b++;
								if($b>2)
								$b=1;
							}
						}
							 ?>
                        </table></td>
                      </tr>
                 <?php
				  }
				 ?>
                   <?php
				   $selpr=executework("select * from tob_aaleaves where empno='".$_GET['eid']."' order by edate");
				   $cntp=@mysqli_num_rows($selpr);
				   if($cntp>0)
				   {
				   		//$rowp=@mysqli_fetch_array($selpr);
				   ?>
                      <tr>
                        <td width="40%" bgcolor="#FFFFFF" class="style8">Leave Details</td>
                        <td width="60%" colspan="2" bgcolor="#FFFFFF" class="style8">&nbsp;</td>
                      </tr>
                      <tr bgcolor="#FFFFFF">
                        <td colspan="3" class="style8"><table width="100%" border="1" cellpadding="4" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#000000">
                          <tr>
                            <td width="6%" rowspan="2" bgcolor="#F5F5F5"><div align="center">S.No</div></td>
                            <td width="6%" rowspan="2" bgcolor="#F5F5F5"><div align="center">Date</div></td>
                            <td width="21%" colspan="5" bgcolor="#F5F5F5"><div align="center">Earned Leaves</div></td>
                            <td width="18%" colspan="5" bgcolor="#F5F5F5"><div align="center">HPL</div></td>
                            </tr>
                          <tr>
                            <td bgcolor="#F5F5F5"><div align="center">OB</div></td>
                            <td bgcolor="#F5F5F5"><div align="center">Accured</div></td>
                            <td bgcolor="#F5F5F5"><div align="center">Total</div></td>
                            <td bgcolor="#F5F5F5"><div align="center">Used</div></td>
                            <td bgcolor="#F5F5F5"><div align="center">Balance</div></td>
                            <td bgcolor="#F5F5F5"><div align="center">OB</div></td>
                            <td bgcolor="#F5F5F5"><div align="center">Accured</div></td>
                            <td bgcolor="#F5F5F5"><div align="center">Total</div></td>
                            <td bgcolor="#F5F5F5"><div align="center">Used</div></td>
                            <td bgcolor="#F5F5F5"><div align="center">Balance</div></td>
                          </tr>
					<?php
								$s=1;
								$b=1;
						while($rowp=@mysqli_fetch_array($selpr))
						{
							if($rowp["edate"]!=NULL)
							{
								if($b==1)
								$bg="#F5F5F5";
								else
								$bg="#DDDDDD";
								$etot='';$ebal='';$htot="";$hbal="";
								if($rowp['etotal']>300)
								$etot="300+".($rowp['etotal']-300);
								else
								$etot=$rowp['etotal'];
								if($rowp['ebal']>300)
								$ebal="300+".($rowp['ebal']-300);
								else
								$ebal=$rowp['ebal'];
								if($rowp['htotal']>300)
								$htot="300+".($rowp['htotal']-300);
								else
								$htot=$rowp['htotal'];
								if($rowp['hbal']>300)
								$hbal="300+".($rowp['hbal']-300);
								else
								$hbal=$rowp['hbal'];
						?>
                          <tr bgcolor="<?php echo $bg ?>">
                            <td><?php echo $s ?></td>
                            <td><?php echo datepattrn($rowp['edate']); ?></td>
                            <td><div align="right"><?php echo $rowp["eob"]; ?></div></td>
                            <td><div align="right"><?php echo $rowp["eaccured"]; ?></div></td>
                            <td><div align="right"><?php echo $etot; ?></div></td>
                            <td><div align="right"><?php echo $rowp["eused"]; ?></div></td>
                            <td><div align="right"><?php echo $ebal; ?></div></td>
                            <td><div align="right"><?php echo $rowp["hob"]; ?></div></td>
                            <td><div align="right"><?php echo $rowp["haccured"]; ?></div></td>
                            <td><div align="right"><?php echo $htot; ?></div></td>
                            <td><div align="right"><?php echo $rowp["hused"]; ?></div></td>
                            <td><div align="right"><?php echo $hbal; ?></div></td>
                          </tr>
							 <?php
								$s++;
								$b++;
								if($b>2)
								$b=1;
							}
						}
							 ?>
                        </table></td>
                      </tr>
                 <?php
				  }
				 ?>
                    </table>      
      </div>
     </div>
  <script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>

 <!-- <script>
    function resetTabs(){
        $("#content > div").hide(); //Hide all content
        $("#tabs a").attr("id",""); //Reset id's      
    }

    var myUrl = window.location.href; //get URL
    var myUrlTab = myUrl.substring(myUrl.indexOf("#")); // For localhost/tabs.html#tab2, myUrlTab = #tab2     
    var myUrlTabName = myUrlTab.substring(0,4); // For the above example, myUrlTabName = #tab

    (function(){
        $("#content > div").hide(); // Initially hide all content
        $("#tabs li:first a").attr("id","current"); // Activate first tab
        $("#content > div:first").fadeIn(); // Show first tab content
        
        $("#tabs a").on("click",function(e) {
            e.preventDefault();
            if ($(this).attr("id") == "current"){ //detection for current tab
             return       
            }
            else{             
            resetTabs();
            $(this).attr("id","current"); // Activate this
            $($(this).attr('name')).fadeIn(); // Show content for current tab
            }
        });

        for (i = 1; i <= $("#tabs li").length; i++) {
          if (myUrlTab == myUrlTabName + i) {
              resetTabs();
              $("a[name='"+myUrlTab+"']").attr("id","current"); // Activate url tab
              $(myUrlTab).fadeIn(); // Show url tab content        
          }
        }
    })()
  </script>-->
 
</form>
                              </div></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    </div>
                </div>
              </div>
              </div>
              </div>
          <a href="javascript:window.print()" target="_blank"></a> </div></td>
      </tr>
    </table></td>
  </tr>
  <?php
  	if(empty($_GET['prin']))
	{
  ?>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><img src="tob2_imgs/spacer.png" width="220" height="1" /></td>
    <td width="442" valign="top"><img src="tob2_imgs/spacer.png" width="535" height="1" /></td>
  </tr>
  <?php
  	}
  ?>
</table>
<?php //include_once("footer.php"); ?>
<script>
var chkReadyState = setTimeout(function() {
    if (document.readyState == "complete") {
        // clear the interval
        clearTimeout(chkReadyState);
		//alert(document.readyState);
		window.print();
        // finally your page is loaded.
    }
	setTimeout(chkReadyState,100);
}, 100);
</script>
</body>
</html>
<?php 
}
else
{
?>
<script language="javascript">parent.location.href="index.php";</script>
<?php 
}	
?>