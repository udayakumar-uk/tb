<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
$select=executework("select * from tob_expreg");
$cnt=@mysqli_num_rows($select);
	
	if($_GET['delt']!="")
	{
		$seld=executework("select * from tob_expreg where id=".$_GET['delt']);
		$rowd=@mysqli_fetch_array($seld);
		$delid=executeupdate("delete from tob_expreg where id=".$_GET['delt']);
		redirect("view_exp.php?dsuc=1");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Add Platform | Welcome To TOBBACO BOARD Admin</title>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
}
.style4 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
.style7 {font-size: 14px; color: #FF0000; font-family: Arial, Helvetica, sans-serif;}
.style17 {font-family: Arial, Helvetica, sans-serif;font-size: 12px; }
.style8 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }

a:link {
	color: #000000;
	text-decoration: underline;
}
a:visited {
	color: #000000;
	text-decoration: underline;
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
</head>
<script language="javascript">
function delt(st)
{
	if(confirm("Are You Sure To Delete This Candidate Registration?"))
	location.href="view_exp.php?delt="+st;
	else
	return false;
}
</script>
<body>
<?php include_once("header.php");?>
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

                    <table width="90%" align="center" cellpadding="1" cellspacing="1" bgcolor="#0000FF">
                      <tr class="style3">
                        <td width="5%" bgcolor="#FFFFFF"><div align="center"><strong>S.No.</strong></div></td>
                        <td width="11%" bgcolor="#FFFFFF"><div align="center"><strong>Name of Company</strong></div></td>
                        <td width="21%" bgcolor="#FFFFFF"><div align="center"><strong>First Name  </strong></div></td>
                        <td width="13%" bgcolor="#FFFFFF"><div align="center"><strong>Last Name</strong></div></td>
                        <td width="9%" bgcolor="#FFFFFF"><div align="center"><strong>Picture</strong></div></td>
						<td width="9%" bgcolor="#FFFFFF"><div align="center"><strong></strong></div></td>
                        <td width="10%" bgcolor="#FFFFFF"><div align="center"><strong>User Name</strong></div></td>
						<td width="9%" bgcolor="#FFFFFF"><div align="center"><strong>Password</strong></div></td>
						<td width="9%" bgcolor="#FFFFFF"><div align="center"><strong>Category</strong></div></td>
						<td width="9%" bgcolor="#FFFFFF"><div align="center"><strong>Address</strong></div></td>
						<td width="9%" bgcolor="#FFFFFF"><div align="center"><strong>Post Code</strong></div></td>
						<td width="9%" bgcolor="#FFFFFF"><div align="center"><strong>Phone Num</strong></div></td>
						<td width="9%" bgcolor="#FFFFFF"><div align="center"><strong>Fax</strong></div></td>
						<td width="9%" bgcolor="#FFFFFF"><div align="center"><strong>Mobile No</strong></div></td>
                        <td width="11%" bgcolor="#FFFFFF"><div align="center"></div></td>
                        </tr>
					<?php
					$i=1;
					while($row=@mysqli_fetch_array($select))
					{
					?>
                      <tr class="style3">
                        <td bgcolor="#FFFFFF"><?php echo $i ?></td>
                        <td bgcolor="#FFFFFF"><?php echo $row['cname'] ?></td>
                        <td bgcolor="#FFFFFF"><?php echo $row['fname'] ?></td>
                        <td bgcolor="#FFFFFF"><?php echo $row['lname'] ?></td>
                        <td bgcolor="#FFFFFF"><?php echo $row['pic'] ?></td>
						<td bgcolor="#FFFFFF"><a  target="_blank" href="photos/<?php echo $row['pic'] ?>">View Photo</a></td>
                        <td bgcolor="#FFFFFF"><?php echo $row['uname'] ?></td>
						<td bgcolor="#FFFFFF"><?php echo $row['pwd'] ?></td>
						<td bgcolor="#FFFFFF"><?php echo $row['category'] ?></td>
						<td bgcolor="#FFFFFF"><?php echo $row['addrs'] ?></td>
						<td bgcolor="#FFFFFF"><?php echo $row['pcode'] ?></td>
						<td bgcolor="#FFFFFF"><?php echo $row['ph_no'] ?></td>
						<td bgcolor="#FFFFFF"><?php echo $row['fax_no'] ?></td>
						<td bgcolor="#FFFFFF"><?php echo $row['mob_no'] ?></td>
                        <td bgcolor="#FFFFFF"><div align="center"><a href="javascript:delt('<?php echo $row['id'] ?>');" class="b"><strong>Delete</strong></a></div></td>
                        </tr>
					<?php
						$i++;
					}
					?>
                    </table>
                  
</form>

</body>
</html>
