<?php 
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if($_SESSION['tobacco']!="")
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Employee Data | Tobacco Board, Guntur</title>

<style type="text/css">
<!--
.style30 {color: #990000}
-->
</style>
</head>
<script type="text/JavaScript">
function validate_login()
{
	if(document.getElementById("userid").value=="")
	{
		alert("Enter User Id");
		document.getElementById("userid").focus();
		return false;
	}
	else if(document.getElementById("pass").value=="")
	{
		alert("Enter Password");
		document.getElementById("pass").focus();
		return false;
	}
	else
	return true;
}
function sel_combo(st,adv)
{
	var fld=document.getElementById(st);
	for(k=0;k<fld.options.length;k++)
	{
		if(fld.options[k].value==adv)
		{
			fld.options[k].selected=true;
		}

	}
}
</script>
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

-->
</style>
<script language="javascript">
function validate()
{
	if(document.form2.group_by.value=="" && document.form2.empno.value=="" && document.form2.empname.value=="")
	{
		document.form2.action="employeedata.php";
		document.form2.submit();
	}
	else if(document.form2.empno.value!="" || document.form2.empname.value!="")
	{
		document.form2.action="employeedata.php";
		document.form2.submit();
	}
	else
	document.form2.submit();
}
</script>
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
	$dat=date('Y-m-d');
  if(isset($_GET['stype']) && $_GET['stype']!="")
  $stp=$_GET['stype'];
  else
  $stp='Employee Data';
  if($stp=='Employee Data')
  $stp='Employee Data';
  
	if(isset($_POST['group_by']) && $_POST['group_by']!="")
	$grp=$_POST['group_by'];
	else if(isset($_GET['group_by']) && $_GET['group_by']!="")
	$grp=$_GET['group_by'];
	else
	$grp='';
	
	if(isset($_POST['empno']) && $_POST['empno']!="")
	$empn=$_POST['empno'];
	else if(isset($_GET['empno']) && $_GET['empno']!="")
	$empn=$_GET['empno'];
	else
	$empn='';
	if(isset($_POST['empname']) && $_POST['empname']!="")
	$empnm=$_POST['empname'];
	else if(isset($_GET['empname']) && $_GET['empname']!="")
	$empnm=$_GET['empname'];
	else
	$empnm='';
	
	if(isset($_POST['service']) && $_POST['service']!="")
	$service=$_POST['service'];
	else if(isset($_GET['service']) && $_GET['service']!="")
	$service=$_GET['service'];
	else
	$service='';
	
	$qr='';
	if(isset($service) && $service!="")
	{
		$end = date('Y-m-d', strtotime('-'.$service.' years'));
		$qr=" and master_employee.Employee_number in (select distinct E_NO from service_details where E_FROM<='".$end."')";
	}

	if($empn!="")
	$qr.=" and Employee_number='".$empn."'";
	if($empnm!="")
	$qr.=" and Name like '%".$empnm."%'";
	$select=executework("select *,count(*) as cnt from master_employee where Employee_number<>''".$qr." and (E_DOR=NULL or E_DOR>'".$dat."') group by ".$grp."  order by Employee_number");
	$count=@mysqli_num_rows($select);
?>
<a name="top" id="top"></a>
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><img src="tob2_imgs/spacer.png" width="1" height="2" /></td>
  </tr>
  <tr>
    <td colspan="2" valign="top"><div id="head"><?php  include_once("headerad.php")
  ?></div></td>
  </tr>
  <tr>
    <td colspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tabbor">
      <tr>
        <td width="90%" height="25" bgcolor="#F7F7F7">&nbsp;</td>
        <td width="10%" bgcolor="#F7F7F7">&nbsp;</td>
      </tr>
    </table>
      <br />
      <table width="99%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30" align="justify"><div class="rightcorner1">
          <div class="innercontent">
            <div class="rightcorner1">
              <div class="innercontent">
                <div>
                  <div>
                    <div>
                      <div>
                        <table width="80%" border="0" align="center">
	  					<tr>
						 <td><strong><?php  echo $stp ?></strong></td>
						</tr>
                          <tr>
                            <td height="90" colspan="3"><div align="center">
                              <form id="form2" name="form2" method="post" action="" onsubmit="return validate();">
                                <table width="80%" border="0" align="center" cellpadding="2" cellspacing="2">
                                  <tr>
                                    <td colspan="3" align="center">&nbsp;</td>
                                  </tr>
                                  <tr class="style8">
                                    <td align="center">Emplopyee No.&nbsp; :&nbsp; <label>
                                      <input name="empno" type="text" id="empno" value="<?php  echo $empn ?>" />
                                    </label></td>
                                      <td align="center">Employee Name&nbsp; :&nbsp;&nbsp; <label>
                                        <input name="empname" type="text" id="empname" value="<?php  echo $empnm ?>" />
                                      </label></td>
                                      <td align="center">&nbsp;</td>
                                      <script>
									  sel_combo("group_by",'<?php  echo $grp ?>');
									  </script>
                                  </tr>
                                  <tr>
                                    <td align="center" class="style8">Group By&nbsp;&nbsp;:&nbsp;&nbsp;
                                        <label>
                                        <select name="group_by" id="group_by" onchange="form2.submit()">
                                          <option value="">Select</option>
                                          <option value="Designation">Designation</option>
                                          <option value="place_working">Region</option>
                                          <option value="E_QUA">Qualification</option>
                                        </select>
                                      </label></td>
                                    <td align="center" class="style8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Service length&nbsp;&nbsp;:&nbsp;&nbsp;
                                        <label>
                                        <input type="text" name="service" id="service" value="<?php  echo $service ?>" />
                                        </label>
                                      Yrs</td>
                                    <td height="40">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td height="40" colspan="3"><div align="center">
                                      <label>
                                      <input type="submit" name="button" id="button" value="Search" />
                                      </label>
                                    </div></td>
                                  </tr>
                                  <?php 
									$ggrp='';
									if($grp!="")
									{
										if($grp=='Designation')
										$ggrp='Designation';
										else if($grp=='place_working')
										$ggrp='Region';
										else if($grp=='E_QUA')
										$ggrp='Qualification';
									}
								  ?>
                                  <tr>
                                    <td colspan="3"><div align="center" class="style8"><?php  echo $ggrp." Wise "; ?> - <?php  echo $count ?></div></td>
                                  </tr>
                                  <tr>
                                    <td colspan="3"><table width="90%" border="0" cellpadding="4" cellspacing="1" bgcolor="#CCCCCC">
                                 <?php 
								 $s=1;
								 while($row=@mysqli_fetch_array($select))
								 {
								 ?>
                                      <tr>
                                        <td width="7%" bgcolor="#FFFFFF"> &nbsp;<?php  echo $s ?></td>
                                        <td width="93%" bgcolor="#FFFFFF"> <a href="employeedata.php?catg=<?php  echo $row[$grp]; ?>&group_by=<?php  echo $grp ?>&service=<?php  echo $service ?>">&nbsp;<?php  echo $row[$grp]." (".$row['cnt'].")"; ?></a></td>
                                      </tr>
                                 <?php 
								 	$s++;
								 }
								 ?>
                                    </table></td>
                                  </tr>
                                </table>
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
    <td colspan="2" valign="top"><table width="100%" border="0">
      <tr>
        <td width="39%">&nbsp;</td>
        <td width="41%"><div align="center"></div></td>
        <td width="20%"><div align="right"><a href="#top" ><img src="tob2_imgs/bact2top.jpg" width="94" height="27" border="0" title="Back to top" alt="Back to Top" /></a></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="442" valign="top"><img src="tob2_imgs/spacer.png" width="535" height="1" /></td>
    <td width="20%" valign="top"><img src="tob2_imgs/spacer.png" width="225" height="1" /></td>
  </tr>
  <?php 
  	}
  ?>
  <tr>
    <td colspan="2" valign="top"><div id="footer"><?php  include_once("footerad.php")
  ?></div></td>
  </tr>
</table>
</body>
</html>
<?php 
}
else
{
	redirect("index.php");
}
?>