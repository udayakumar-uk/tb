<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION['tobadmin']))
{
$select1=executework("select * from tob_reg order by tdate desc");
$cnt=@mysqli_num_rows($select1);
	
	if(!empty($_GET['delt']))
	{
		$seld=executework("select * from tob_reg where id=".mysqli_real_escape_string($_GET['delt']));
		$rowd=@mysqli_fetch_array($seld);
		$delid=executework("delete from tob_reg where id=".mysqli_real_escape_string($_GET['delt']));
		redirect("dltreg.php?dsuc=1");
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
	color: #660000;
}
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
.style19 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; }

-->
</style>
</head>
<script language="javascript">
function delt(st)
{
	if(confirm("Are You Sure To Delete This  Registration?"))
	location.href="dltreg.php?delt="+st;
	else
	return false;
}
function delt_bulk()
{
	if(confirm("Are You Sure To Delete Selected Registrations?"))
	{
		var n=document.form1.n.value;
		var s=0;
		for(i=1;i<=n;i++)
		{
			if(document.getElementById("delt"+i).checked==true)
			{
				s=1;
			}
		}
		if(s==0)
		{
			alert("Select records to delete");
			return false;
		}
		else
		{
			document.form1.delet.value=1;
			document.form1.submit();
		}
	}
	else
	return false;
}
function pageindex(st,st1)
{
	
	if(st!="" && st1!="")
	{
		var x=document.form1.action=st1+"?page_index="+st;
		document.form1.submit();
	}
	else
	{
	return false;
	}

}
</script>
<body>
<?php include_once("header.php");?>
<?php
if(!in_array('DELETE',$detai))
{
	redirect("employeedata.php");
}
?>
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

if(!empty($_POST['delet']))
{
	$ids="";
	for($i=1;$i<=$_POST['n'];$i++)
	{
		if($_POST['delt'.$i]!="")
		{
			if($ids=="")
			$ids=mysqli_real_escape_string($_POST['delt'.$i]);
			else
			$ids.=",".mysqli_real_escape_string($_POST['delt'.$i]);
		}
	}
	$del=executework("delete from tob_reg where id in (".$ids.")");
	redirect("dltreg.php?succ=1");
}
?>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" >

                    <p>&nbsp;</p>
<?php
		$max_recs_per_page=25;
		if($cnt>0)
		{
			if (empty($_GET['page_index']))
			{
		$page_index=1;
			}	
			
			else
			{
			$page_index=$_GET['page_index'];
			}
			
			$total_recs = $cnt;
			$pages = $cnt / $max_recs_per_page; 
			
			if ($pages < 1)
			{ 
			$pages = 1; 
			}
			if ($pages / (int) $pages <> 1)
			{ 
				$pages = (int) $pages + 1; 
			} 
			else
			{ 
				$pages = $pages; 
			}
			
			$page12=(int) $page_index;
	
	$pagenow1 = ($max_recs_per_page*($page12-1));
//	if($pages==$_GET['page_index'])
//	$pagenow2=$cnt;
//	else
	$pagenow2 = $pagenow1+$max_recs_per_page; 
	
		$select=executework("select * from tob_reg order by tdate desc LIMIT $pagenow1, $max_recs_per_page");
?>
                    <table width="90%" align="center" cellpadding="1" cellspacing="1" bgcolor="#0000FF">
                      <tr class="style3">
                        <td colspan="13" bgcolor="#FFFFFF" class="style17"><div align="center" class="style8"><span class="style1"><?php echo $pagenow1+1 ?></span> To <span class="style1"><?php echo $pagenow2 ?></span> Of <span class="style19"><?php echo $cnt; ?></span></div></td>
                      </tr>
<?php		
	if($pages > 1)
					{
		?>
                      <tr class="style3">
                        <td colspan="13" bgcolor="#FFFFFF" class="style17"><div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Page&nbsp;
                          <?php
	  for($im=1;$im<=$pages;$im++)
	  {
	  		if($page12 != $im)
			{
				?>
                          <a style="cursor:pointer" onclick="javascript:pageindex('<?php echo "$im" ?>','dltreg.php');" class="l"><?php echo "$im" ?></a>&nbsp;
                          <?php
			}
			else
			{
					?>
                          <font color="red"><?php echo "$im" ?></font>&nbsp;
                          <?php
			}
		}
	?>
              </strong></font></div></td>
                      </tr>
            <?php
	}
	?>
                      <tr class="style3">
                        <td width="5%" bgcolor="#FFFFFF" class="style17"><div align="center">
                          <label>
                          <input type="button" name="button" id="button" value="Delete" onclick="delt_bulk();" />
                          </label>
</div></td>
                        <td width="5%" bgcolor="#FFFFFF" class="style17"><div align="center"><strong>S.No.</strong></div></td>
                        <td width="11%" bgcolor="#FFFFFF" class="style17"><div align="center"><strong>Date</strong></div></td>
                        <td width="11%" bgcolor="#FFFFFF" class="style17"><div align="center"><strong>Tender No </strong></div></td>
                        <td width="11%" bgcolor="#FFFFFF" class="style17"><div align="center"><strong>Name of Company</strong></div></td>
                        <td width="21%" bgcolor="#FFFFFF" class="style17"><div align="center"><strong>Address  </strong></div></td>
                        <td width="13%" bgcolor="#FFFFFF" class="style17"><div align="center"><strong>Email_Id</strong></div></td>
                        <td width="9%" bgcolor="#FFFFFF" class="style17"><div align="center"><strong>Phone No</strong></div></td>
                        <td width="10%" bgcolor="#FFFFFF" class="style17"><div align="center"><strong>Fax No</strong></div></td>
						<td width="9%" bgcolor="#FFFFFF" class="style17"><div align="center"><strong>Website</strong></div></td>
						<td width="9%" bgcolor="#FFFFFF" class="style17"><div align="center"><strong>Cantact Persion</strong></div></td>
						<td width="9%" bgcolor="#FFFFFF" class="style17"><div align="center"><strong>Designation</strong></div></td>
						<td width="9%" bgcolor="#FFFFFF" class="style17"><div align="center"><strong>Mobile No</strong></div></td>
                      </tr>
					<?php
					$i=1;
					$j=$pagenow1+1;
					while($row=@mysqli_fetch_array($select))
					{
						$seltnd=executework("select * from tob_tender where id=".$row['tenderid']);
						$rowd=@mysqli_fetch_array($seltnd);
					?>
                      <tr class="style3">
                        <td bgcolor="#FFFFFF" class="style17"><div align="center">
                          <label>
                          <input name="delt<?php echo $i ?>" type="checkbox" id="delt<?php echo $i ?>" value="<?php echo $row['id'] ?>" />
                          </label>
</div></td>
                        <td bgcolor="#FFFFFF" class="style17"><?php echo $j ?></td>
                        <td bgcolor="#FFFFFF" class="style17"><?php if($row['tdate']!="" && $row['tdate']!='0000-00-00') { echo datepattrn($row['tdate']); } ?>&nbsp;</td>
                        <td bgcolor="#FFFFFF" class="style17"><?php echo $rowd['tenderno'] ?></td>
                        <td bgcolor="#FFFFFF" class="style17"><?php echo $row['name'] ?></td>
                        <td bgcolor="#FFFFFF" class="style17"><?php echo $row['addrs'] ?></td>
                        <td bgcolor="#FFFFFF" class="style17"><?php echo $row['email'] ?></td>
                        <td bgcolor="#FFFFFF" class="style17"><?php echo $row['ph_no'] ?></td>
                        <td bgcolor="#FFFFFF" class="style17"><?php echo $row['fax_no'] ?></td>
						<td bgcolor="#FFFFFF" class="style17"><?php echo $row['website'] ?></td>
						<td bgcolor="#FFFFFF" class="style17"><?php echo $row['cpersion'] ?></td>
						<td bgcolor="#FFFFFF" class="style17"><?php echo $row['designation'] ?></td>
						<td bgcolor="#FFFFFF" class="style17"><?php echo $row['mob_no'] ?></td>
                      </tr>
					<?php
						$i++;$j++;
					}
					?>
  </table>
 <?php
		}
 ?>                 
                    <input name="n" type="hidden" id="n" value="<?php echo $i-1 ?>" />
                    <input type="hidden" name="delet" id="delet" />
</form>

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