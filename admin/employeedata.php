<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(isset($_SESSION["tobadmin"]))
{

	if(isset($_POST['empno']) && $_POST['empno']!="")
	$qr=" and Employee_number='".$_POST['empno']."'";
	else if(isset($_POST['empname']) && $_POST['empname']!="")
	$qr.=" and Name like '%".$_POST['empname']."%'";
	else
	$qr='';
	
	
/*	$stort=executework("select * from tob_employeeview");
	$rowxt=@mysqli_fetch_array($stort);
	$selot=executework("select * from tob_platform state='".$rowxt['state']."'");
	$rowot=@mysqli_fetch_array($selot);
*/		
		if(isset($_SESSION['tobadmin']) && $_SESSION['tobadmin']=='admin')
		{
		
			$stateos="";
		}
		else
		
		
		{	
		$selju=executework("select * from tob_employeeview where username='".$_SESSION['tobadmin']."'");
		$rowpju=@mysqli_fetch_array($selju);
		//$stateos=explode(',',$rowpju['state']);
		$stateos=$rowpju['state'];
		}
	if(!empty($stateos))
	{
	$st="and place_working in(select id from tob_platfrm where state in(".$rowpju['state']."))";
	}
	else
	{
	$st="";
	}
	//echo $stateos;
	
	//print_r($st);	
	//if(in_array('Andhra Pradesh',$sst) && in_array('Karnataka',$sst))
	$select=executework("select * from master_employee where Name<>''".$qr.$st."  order by  place_working,ABS(Employee_number)");
	
	//echo "select * from master_employee where Name<>''".$qr.$st."  order by  place_working,ABS(Employee_number)";	
	
	//print_r($stateos);
				$stre=executework("select * from master_employee where Name<>'' and emp_status='Retired' ".$qr.$st."  order by  place_working,ABS(Employee_number)");
				//echo "select * from master_employee where Name<>'' and status=1 ".$qr.$st."  order by  place_working,ABS(Employee_number)";
				$cnount=@mysqli_num_rows($stre);
				
				$stre1=executework("select * from master_employee where Name<>'' and emp_status='In-Service' ".$qr.$st."  order by  place_working,ABS(Employee_number)");
				//echo "select * from master_employee where Name<>'' and status=0 ".$qr.$st."  order by  place_working,ABS(Employee_number)";
				$cnount1=@mysqli_num_rows($stre1);

				$stre2=executework("select * from master_employee where Name<>'' and emp_status='VRS' ".$qr.$st."  order by  place_working,ABS(Employee_number)");
				//echo "select * from master_employee where Name<>'' and status=1 ".$qr.$st."  order by  place_working,ABS(Employee_number)";
				$cnount2=@mysqli_num_rows($stre2);
				
				$stre3=executework("select * from master_employee where Name<>'' and emp_status='Death' ".$qr.$st."  order by  place_working,ABS(Employee_number)");
				//echo "select * from master_employee where Name<>'' and status=1 ".$qr.$st."  order by  place_working,ABS(Employee_number)";
				$cnount3=@mysqli_num_rows($stre3);
				
	            $cnt=@mysqli_num_rows($select);

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Employee Data | Welcome To TOBBACO BOARD Admin</title>
<style type="text/css">
<!--
.style17 {font-family: Arial, Helvetica, sans-serif;font-size: 12px; }
.style8 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }

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
.style18 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.style19 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #FF0000;
}
.style20 {color: #0000FF}
.style21 {color: #FF0000}

-->
</style>
<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
</head>
<script language="javascript">
function delt(st)
{
	if(confirm("Are You Sure To Delete This  Registration?"))
	location.href="dltreg.php?delt="+st;
	else
	return false;
}

function addnewemp()
{
	if(confirm("Are You Sure To Add New Employee.?"))
	location.href="dltreg.php?delt="+st;
	else
	return false;
}

function delt(st)
{
	if(confirm("Do You Want to Remove Employee..?"))
	{
		location.href='employeedata.php?empid='+st;
	}
	else
	{
		return false;
	}
}

function retair(st5)
{
		location.href='employeedata.php?rid='+st5;
		document.form1.submit();
}

function printdet(url) {
  var win = window.open(url, '_blank');
  win.focus();
}

</script>
<body>
<?php include_once("header.php");?>
<?php
if(isset($_GET['empid']) && $_GET['empid']!="")
{
	
	
	$sel=executework("select image from master_employee where Employee_number='".$_GET['empid']."' ");
	$row=@mysqli_fetch_array($sel);
	if(file_exists("employeeimage/".$row['image']))
		{
			unlink("employeeimage/".$row['image']);
		}
		$del=executework("delete from master_employee where Employee_number='".$_GET['empid']."'");
		redirect("employeedata.php?sucdel=del");
}
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

	function numround($st,$n)
	{
		if($st!="")
		{
			$n1=pow(10 ,$n);
			$num=round($st*$n1)/($n1);
		}
		return $num;
	}

?>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" >

                    <p>&nbsp;</p>
                    <table width="100%" border="0" cellpadding="4" cellspacing="5">
                      <tr>
                        <td colspan="3"><div align="center">
                          <table width="80%" border="0" cellpadding="2" cellspacing="4">
                            <tr>
                              <td width="43%" class="style8">Employee No&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp; <label>
                                <input type="text" name="empno" id="empno" value="<?php if(isset($_POST['empno'])) echo $_POST['empno'] ?>" />
                              </label></td>
                              <td width="35%" class="style8">Employee Name&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp; <label>
                                <input type="text" name="empname" id="empname" value="<?php if(isset($_POST['empname'])) echo $_POST['empname'] ?>" />
                              </label></td>
                              <td width="22%"><label>
                                <input type="submit" name="button" id="button" value="Search" />
                              </label>
                                &nbsp;&nbsp; <label>
                                <input type="button" name="button2" id="button2" value=" Clear " onclick="javascript:location.href='employeedata.php'" />
                                </label></td>
                            </tr>
                          </table>
                        </div></td>
                      </tr>
                      <tr>
                        <td width="77%" valign="bottom"><label>
                        <?php
						if(isset($_GET['sucdel']) && $_GET['sucdel']!="")
						{
						?>
                        <div align="center" class="style19">Employee Removed From List</div>
                        <?php
						}
						if(isset($_GET['succ']) && $_GET['succ']==9)
						{
						?>
						
                        <div align="center" class="style19">Retaired</div><?php } ?>
					  <div align="center">&nbsp;
						    <span class="style21">Retaired-<?php echo $cnount ?>&nbsp;&nbsp;&nbsp;</span>&nbsp;<span class="style21">VRS-<?php echo $cnount2 ?>&nbsp;&nbsp;&nbsp;</span>&nbsp;<span class="style21">Death-<?php echo $cnount3 ?>&nbsp;&nbsp;&nbsp;</span>&nbsp;
						    <span class="style22 style20">In-Service -<?php echo $cnount1 ?> </span></div>
						</div>											    </td>
                        <td width="17%" valign="bottom">
                        <?php
						if(in_array('ADD',$detai))
						{
						?>
                        <div align="right"><a href="newemployee.php" target="_blank"><span class="style18">
                          </label>
                          <span class="style20">Add New Employee</span></span></a></div>
                        <?php
						}
						?>
                        </td>
                        <td width="6%">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="3"><table width="90%" align="center" cellpadding="1" cellspacing="1" bgcolor="#0000FF">
                          <tr class="style3">
                            <td width="3%" bgcolor="#FFFFFF" class="style17"><div align="center"><strong>S.No.</strong></div></td>
                            <td width="10%" bgcolor="#FFFFFF" class="style17"><div align="center"><strong>Staff Code</strong></div></td>
                            <td width="18%" bgcolor="#FFFFFF" class="style17"><div align="center"><strong>Name </strong></div></td>
                            <td width="12%" bgcolor="#FFFFFF" class="style17"><div align="center"><strong>Designation</strong></div></td>
                            <td width="11%" bgcolor="#FFFFFF" class="style17"><div align="center"><strong>Place Of Working </strong></div></td>
                            <td width="5%" bgcolor="#FFFFFF" class="style17"><div align="center"><strong>Gender</strong></div></td>
                            <td width="7%" bgcolor="#FFFFFF" class="style17"><div align="center"><strong>Date Of Birth</strong></div></td>
                            <td width="11%" bgcolor="#FFFFFF" class="style17"><div align="center"><strong>DOJ In Present Job</strong></div></td>
                            <td width="11%" bgcolor="#FFFFFF" class="style17"><div align="center"><strong>Status</strong></div></td>
                            <td width="11%" bgcolor="#FFFFFF" class="style17"><div align="center"><strong>Date Of Retirement </strong></div></td>
                        <?php
						if(in_array('VIEW',$detai))
						{
						?>
                            <td width="6%" bgcolor="#FFFFFF" class="style17"><div align="center"></div></td>
                        <?php
						}
						if(in_array('MODIFY',$detai))
						{
						?>
                            <td width="7%" bgcolor="#FFFFFF" class="style17"><div align="center"></div></td>
                        <?php
						}
						if(in_array('DELETE',$detai))
						{
						?>
                            <td width="6%" bgcolor="#FFFFFF" class="style17">&nbsp;</td>
                        <?php
						}
						if(in_array('PRINT',$detai))
						{
						?>
                            <td width="4%" bgcolor="#FFFFFF" class="style17">&nbsp;</td>
                        <?php
						}
						?>
                           </tr>
                     <?php
					$i=1;
					while($row=@mysqli_fetch_array($select))
					{
				$str=executework("select * from tob_designation where id='".$row['Designation']."'");
				$rowtr=@mysqli_fetch_array($str);	
				//if($row['E_REGN_CODE']where in('AR1' or 'AR2'))
				$strop=executework("select * from tob_employeeview where state='Andhra Pradesh'");
				$rowop=@mysqli_fetch_array($strop);
				
				$selectg=executework("select * from tob_platfrm where id='".$row['place_working']."'");
				$rowtg=@mysqli_fetch_array($selectg);
				//if($rowop['state']=='Andhra Pradesh' || $row['state']=='AR1')
				//{
				//}
				//if($_)20086603523
					?>
                          <tr class="style3">
                            <td bgcolor="#FFFFFF" class="style17"><?php echo $i ?></td>
                            <td bgcolor="#FFFFFF" class="style17"><?php echo $row['Employee_number']; ?></td>
                            <td bgcolor="#FFFFFF" class="style17"><?php echo $row['Name'] ?></td>
                            <td bgcolor="#FFFFFF" class="style17"><?php echo $rowtr['designation'] ?></td>
                            <td bgcolor="#FFFFFF" class="style17"><?php echo $rowtg['platform'] ?></td>
                            <td bgcolor="#FFFFFF" class="style17"><?php echo $row['E_SEX'] ?></td>
                            <td bgcolor="#FFFFFF" class="style17"><?php if($row['E_DOB']!="" && $row['E_DOB']!='0000-00-00') { echo datepattrn($row['E_DOB']);} ?></td>
                            <td bgcolor="#FFFFFF" class="style17"><?php if($row['E_DOJ']!="" && $row['E_DOJ']!='0000-00-00') { echo datepattrn($row['E_DOJ']); } ?></td>
							<td bgcolor="#FFFFFF" class="style17"><label><?php echo $row['emp_status']; ?></label></td>
                            <td bgcolor="#FFFFFF" class="style17"><?php if($row['E_DOR']!="" && $row['E_DOR']!='0000-00-00') { echo datepattrn($row['E_DOR']);} ?>&nbsp;</td>
                            <?php
						if(in_array('VIEW',$detai))
						{
						?>
                            <td bgcolor="#FFFFFF" class="style17"><div align="center"><a href="employee.php?eid=<?php echo $row['Employee_number'] ?>&n=<?php echo $i; ?>" class="b"><strong>View</strong></a></div></td>
                        <?php
						}
						if(in_array('MODIFY',$detai))
						{
						?>
                            <td bgcolor="#FFFFFF" class="style17"><div align="center"><a href="memployee.php?eid=<?php echo $row['Employee_number'] ?>" class="b"><strong>Modify</strong></a></div></td>
                        <?php
						}
						if(in_array('DELETE',$detai))
						{
						?>
                            <td bgcolor="#FFFFFF" class="style17"><div align="center"><a href="javascript:void(0)" class="b" onclick="delt('<?php echo $row['Employee_number'] ?>');"><strong>Remove</strong></a></div></td>
                        <?php
						}
						if(in_array('PRINT',$detai))
						{
						?>
                            <td bgcolor="#FFFFFF" class="style17"><div align="center"><strong><a href="javascript:void(0)" class="b" onclick="MM_openBrWindow('printemployee.php?eid=<?php echo $row['Employee_number'] ?>','','width=600,height=1000')">Print</a ></div></td>
                        <?php
						}
						?>
                          </tr>
                          <?php
						$i++;
					}
					?>
                        </table></td>
                      </tr>
                    </table>
</form>

</body>
</html>
<script>
var valid='<?php echo $_GET['valid'] ?>';
if(valid!="" && valid==0)
{
	alert("Invalid Employee Details");
}
var succ='<?php echo $_GET['esucc']; ?>';

if(succ!="" && succ==1)
{
	alert("Data updated successfully");
}
var mid='<?php if(!empty($_GET['mid'])) echo $_GET['mid']; ?>';

if(mid!="" && mid==1)
{
	//alert("Data modified successfully");
}

</script>
<?php 
}
else
{
?>
<script language="javascript">parent.location.href="index.php";</script>
<?php 
}	
?>