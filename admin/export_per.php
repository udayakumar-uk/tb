<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION["tobadmin"]))
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Export Performance | Welcome To TOBBACO BOARD Admin</title>
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
</head>
<script type="text/javascript">
function check(form1)
{
	if(document.form1.month.value=="")
	{
		alert("Month Should Not Be Empty");
		document.form1.month.focus();
		return false;
	}
	else if(document.form1.year.value=="")
	{
		alert("Year Should Not Be Empty")
		document.form1.year.focus();
		return false;
	}
	else if(document.form1.catg.value=="")
	{
		alert("Category Should Not Be Empty");
		document.form1.catg.focus();
		return false;
	}
	else if(document.form1.qty.value=="")
	{
		alert("Quantity Should Not Be Empty");
		document.form1.qty.focus();
		return false;
	}
	else if(isNaN(document.form1.qty.value)==true)
	{
		alert("Quantity Should Be A number");
		document.form1.qty.value="";
		document.form1.qty.focus();
		return false;
	}
	else if(document.form1.val.value=="")
	{
		alert("Value(Rs.) Should Not Be Empty");
		document.form1.val.focus();
		return false;
	}
	else if(isNaN(document.form1.val.value)==true)
	{
		alert("Value(Rs.) Should Be A number");
		document.form1.val.value="";
		document.form1.val.focus();
		return false;
	}
	/*else if(document.form1.vald.value=="")
	{
		alert("Value($) Should Not Be Empty");
		document.form1.vald.focus();
		return false;
	}
	else if(isNaN(document.form1.vald.value)==true)
	{
		alert("Value($) Should Be A number");
		document.form1.vald.value="";
		document.form1.vald.focus();
		return false;
	}*/
	else
	{
		document.form1.subm.value=1;
		return true
	}
}
function delet(st,st1)
{
	if(confirm("Are You sure to Delete Selected Export Details Completely"))
	{
		location.href="export_per.php?id="+st+"&edit="+st1;
	}
}

function del(st,st1)
{
	if(confirm("Are You sure to Move Archive Selected Statistics Details"))
	{
		location.href="export_per.php?id="+st+"&edit="+st1;
	}
}
function modf(st,st1)
{
	if(confirm("Are You sure to Modify Selected export Details"))
	{
		location.href="export_per.php?id="+st+"&edit="+st1;
	}
}
function back1()
{
	location.href="export_per.php";
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


if(!empty($_GET['id']))
$id=$_GET['id'];
else if(!empty($_POST['id']))
$id=$_POST['id'];
else
$id='';

	if(!empty($_GET['edit']))
	{
		if($_GET['edit']=="delet")
		{
			$select=executework("select * from tob_export where id='".$id."'");
			$drow=@mysqli_fetch_array($select);
			$tupdate=executework("delete from tob_export where id='".$id."'");	
			redirect("export_per.php?succ=4");
		}
		else
		{
			if(!empty($_POST['subm']))
			{
					$tinsert=executework("update tob_export set quantity='".make_safe($_POST['qty']) ."',value='". make_safe($_POST['val']) ."',valued='". make_safe($_POST['vald']) ."' where id='".$id."'");
					redirect("export_per.php?succ=3");
			}
		}
	}
	else if(!empty($_POST['subm']))
	{
		$date=date("Y-m-d",time()+19800);
		$tselect=executework("select * from tob_export where catg='".make_safe($_POST['catg'])."' and month='".make_safe($_POST['month'])."' and year='".make_safe($_POST['year'])."'");
		$tcnt=@mysqli_num_rows($tselect);
		if($tcnt>0)
		{
			redirect("export_per.php?exist=1");
		}
		else
		{
			$intmax=executework("SELECT max(id) from tob_export");
			$cnt=@mysqli_num_rows($intmax);
			$row=@mysqli_fetch_array($intmax);
			if($row[0]!="")
			{
				$maxid=$row[0]+1;
			}
			else
			{
				$maxid=1;
			}
			$tinsert=executework("insert into tob_export values($maxid,'". make_safe($_POST['catg']) ."',". make_safe($_POST['month']) .",". make_safe($_POST['year']) .",". make_safe($_POST['qty']) .",". make_safe($_POST['val']) .",'',1)");
			redirect("export_per.php?succ=1");
		}
	}
?>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check(this);">
<?php
	$tselect=executework("select * from tob_export where id='".$id."'");
	$tcnt=@mysqli_num_rows($tselect);
	if((empty($_GET['edit']) && empty($id)) || (!empty($_GET['edit']) && $tcnt>0))
	{
		$trow=@mysqli_fetch_array($tselect);
?>
  <table width="90%" border="0" align="center">
    <tr>
      <td width="25%">&nbsp;</td>
      <td width="9%">&nbsp;</td>
      <td width="66%">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><span class="style1">Export Performance </span> </td>
    </tr>
     <tr>
      <td colspan="3" align="right"><span class="style1"><a href="export_gsettings.php" style="cursor:pointer; color:#3366CC">Export Graphsettings</a></span> </td>
    </tr>
    
	<?php
		if(!empty($_GET['exist']) && $_GET['exist']==1)
		{
	?>
    <tr>
      <td height="40" colspan="3" class="style7" style="padding-left:150px;">Given Export Details Alredy Exist </td>
    </tr>
	<?php
		}
		else if(!empty($_GET['succ']) && $_GET['succ']==1)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">New Export Details Posted Successfully</span> </td>
    </tr>
	<?php
		}
		else if(!empty($_GET['succ']) && $_GET['succ']==2)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">Selected Statistics Successfully Move To Archives</span> </td>
    </tr>
	<?php
		}
		else if(!empty($_GET['succ']) && $_GET['succ']==3)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">Selected Export Details Modified Successfully</span> </td>
    </tr>
	<?php
		}
		else if(!empty($_GET['succ']) && $_GET['succ']==4)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">Selected Export Details Deleted Successfully</span> </td>
    </tr>
	<?php
		}
		else
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7"></span> </td>
    </tr>
	<?php
		}
	?>
    <tr>
      <td height="30" style="padding-left:35px;"><span class="style4">Month &amp; Year </span></td>
      <td height="30"><div align="center"><strong>:</strong></div></td>
      <td height="30"><label>
        <select name="month" id="month">
          <option value="" selected="selected">Select</option>
          <option value="1">January</option>
          <option value="2">February</option>
          <option value="3">March</option>
          <option value="4">April</option>
          <option value="5">May</option>
          <option value="6">June</option>
          <option value="7">July</option>
          <option value="8">August</option>
          <option value="9">September</option>
          <option value="10">October</option>
          <option value="11">November</option>
          <option value="12">December</option>
        </select>
      </label>
                <?php
					if(!empty($trow['month']))
					$mn1=$trow['month'];
					else if(!empty($_POST['month']))
					$mn1=$_POST['month'];
					else
					$mn1='';

					if($mn1!="")
					{
					?>
                <script type="text/javascript">
					 var mn1='<?php echo $mn1 ?>';
					 var j;
					for(j=0;j<document.form1.month.options.length;j++)
					{
						if(document.form1.month.options[j].value==mn1)
						{
							document.form1.month.options[j].selected=true;
						}
					}
					</script>
                <?php
					}
				  ?>
        &amp;&nbsp; <label>
        <select name="year" id="year">
          <option value="">Select</option>
	<?php
		$y=date('Y');
		for($i=$y;$i>=2005;$i--)
		{
	?>
	      <option value="<?php echo $i ?>"><?php echo $i ?></option>
	<?php
		}
	?>
        </select>
                <?php
					if(!empty($trow['year']))
					$yr1=$trow['year'];
					else if(!empty($_POST['year']))
					$yr1=$_POST['year'];
					else
					$yr1='';

					if($yr1!="")
					{
					?>
                <script type="text/javascript">
					 var yr1='<?php echo $yr1 ?>';
					 var j;
					for(j=1;j<=document.form1.year.options.length;j++)
					{
						if(document.form1.year.options[j].value==yr1)
						{
							document.form1.year.options[j].selected=true;
						}
					}
					</script>
                <?php
					}
				  ?>
        </label></td>
    </tr>
    <tr>
      <td height="30" valign="top" style="padding-left:35px;"><span class="style4">Category</span></td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td height="30"><label>
        <select name="catg" id="catg">
          <option value="">Select</option>
          <option value="FCV">FCV</option>
          <option value="Non FCV">Non FCV</option>
          <option value="Refuse Tobacco">Refuse Tobacco</option>
          <option value="Tobacco Products">Tobacco Products</option>
          <option value="Unmanufactured Tobacco">Unmanufactured Tobacco</option>
        </select>
                <?php
					if(!empty($trow['catg']))
					$ct=$trow['catg'];
					else if(!empty($_POST['catg']))
					$ct=$_POST['catg'];
					else
					$ct='';

					if($ct!="")
					{
					?>
                <script type="text/javascript">
					 var ct='<?php echo $ct ?>';
					 var j;
					for(j=0;j<document.form1.catg.options.length;j++)
					{
						if(document.form1.catg.options[j].value==ct)
						{
							document.form1.catg.options[j].selected=true;
						}
					}
					</script>
                <?php
					}
				  ?>
      </label></td>
    </tr>

    <tr>
      <td height="30" valign="top" class="style4" style="padding-left:35px;">Quantity</td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td height="30" class="style8"><label>
      <input name="qty" type="text" id="qty" value="<?php if(!empty($trow['quantity'])) echo numround($trow['quantity'],3)?>" />
      </label></td>
    </tr>
    <tr>
      <td height="30" valign="top" class="style4" style="padding-left:35px;">Value (Rs)</td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td height="30" class="style8"><label>
      <input name="val" type="text" id="val" value="<?php if(!empty($trow['value'])) echo numround($trow['value'],2)?>" />
      </label></td>
    </tr>
    <tr style="display:none">
      <td height="30" valign="top" class="style4" style="padding-left:35px;">Value ($)</td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td height="30" class="style8"><label>
        <input name="vald" type="text" id="vald" value="<?php if(!empty($trow['valued'])) echo numround($trow['valued'],2)?>" />
      </label></td>
    </tr>
    
    <tr>
      <td height="50" class="style4" style="padding-left:35px;">&nbsp;</td>
      <td height="30">&nbsp;</td>
      <td height="30">
	  	<?php
			if(empty($_GET['edit']))
			{
		?>
        <input type="submit" name="Submit" value="Submit" />
        <input type="reset" name="Submit2" value="Reset" />
		<?php
			}
			else
			{
		?>
        <input type="submit" name="Submit" value="Modify" />
        <input type="reset" name="Submit2" value="Cancel" onclick="back1();" />
		<?php
			}
		?>
      <input name="subm" type="hidden" id="subm" />	 
	  <input name="ttype" type="hidden" id="ttype" value="<?php echo $_GET['edit']?>" /></td>
    </tr>
    <tr>
      <td height="50" class="style4" style="padding-left:35px;">&nbsp;</td>
      <td height="30">&nbsp;</td>
      <td height="30">&nbsp;</td>
    </tr>
    <tr>
      <td height="50" colspan="3" class="style4"><table width="100%" border="0" align="center">
        <tr>
          <td><table width="100%" border="0">
              <tr>
                <td>
	  <?php
		$max_recs_per_page=30;
		$select=executework("select * from tob_export order by year desc,month desc");
		$count=@mysqli_num_rows($select);
      ?>
                    <table width="100%" align="center" cellpadding="0" cellspacing="4">
                      <tr>
                        <td colspan="4"><div align="center" class="style53"><font color="#0000FF" size="3" face="Arial, Helvetica, sans-serif"><strong><font color="#0000BF">Total Statistics - <?php echo $count ?></font></strong></font> </div></td>
                      </tr>
                      <?php
if ($count > 0)
{
	if (empty($_GET['page_index']))
	{
		$page_index=1;
	}	
	else
	{
		$page_index=$_GET['page_index'];
	}
	$total_recs = $count;
	$pages = $count / $max_recs_per_page; 
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

	$select1= executework("select * from tob_export order by year desc,month desc LIMIT $pagenow1, $max_recs_per_page");
	$count1 = @mysqli_num_rows($select1);
	
	if($pages > 1)
	{
	?>
                      <tr>
                        <td colspan="3" align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Page&nbsp;
                                <?php
	  for($im=1;$im<=$pages;$im++)
	  {
	  		if($page12 != $im)
			{
				?>
                                <a href="export_per.php?page_index=<?php echo "$im" ?>" class="hlink1"><?php echo "$im" ?></a>&nbsp;
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
                        </strong></font></td>
                      </tr>
                      <?php
	}
	?>
                  </table></td>
              </tr>
              <tr>
                <td><table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
                    <tr>
                      <td width="47" height="30" bgcolor="#FFFFFF"><div align="center"><span class="style8">SL No </span></div></td>
                      <td width="137" bgcolor="#FFFFFF"><div align="center"><span class="style8">Month </span></div></td>
                      <td width="321" bgcolor="#FFFFFF"><div align="center" class="style8">Category</div></td>
                      <td width="222" bgcolor="#FFFFFF"><div align="center"><span class="style8">Quantity</span></div></td>
                      <td width="173" bgcolor="#FFFFFF"><div align="center" class="style8">Value(Rs.)</div></td>
                      <td width="173" bgcolor="#FFFFFF" style="display:none"><div align="center" class="style8">Value($)</div></td>
                      <td width="233" bgcolor="#FFFFFF"><div align="center" class="style8">Actions</div></td>
                      </tr>
                    <?php
			$i=$pagenow1+1;
			while($row=@mysqli_fetch_array($select1))
			{
				if(!empty($row['tfile']))
				$link="statisticsfiles/".$row['tfile'];
				else
				$link="#";
				$mn=$month_name = date( 'F', mktime(0, 0, 0, $row['month'], 10) );
		?>
                    <tr>
                      <td height="30" bgcolor="#FFFFFF" class="style17"><div align="center"><?php echo $i; ?></div></td>
                      <td bgcolor="#FFFFFF" class="style17" ><div align="center"><?php echo $mn."-".$row['year'];?></div></td>
                      <td bgcolor="#FFFFFF" class="style17" style="padding-left:15px; padding-right:15px;"><?php echo $row['catg']?></td>
                      <td bgcolor="#FFFFFF" class="style17" style="padding-left:15px;"><?php echo numround($row['quantity'],3)?>
                          </div></td>
                      <td bgcolor="#FFFFFF" class="style17" style="padding-left:15px;"><?php echo numround($row['value'],2);?></td>
                      <td bgcolor="#FFFFFF" class="style17" style="padding-left:15px; display:none"><?php echo numround($row['valued'],2);?></td>
                      <td bgcolor="#FFFFFF"><div align="center" class="style8"><?php //if(!empty($row['archive']) && $row['archive']==0){?><a href="javascript:modf('<?php echo $row['id'] ?>','edit')" class="b">Modify</a>&nbsp; |  &nbsp;<?php //}?><a href="javascript:delet('<?php echo $row['id'] ?>','delet')" class="b">Delete</a> </div></td>
                      </tr>
                    <?php
				$i++;
			}
		}
		?>
                </table></td>
              </tr>
            </table>
              <?php
    if ($pages > 1)
  	{
  		?>
              <table width="90%" border="0" align="center" cellpadding="0" cellspacing="4">
                <tr>
                  <td align="center" valign="top"><?php
   
		if($page_index != 1)
		{
			$pre=$page_index-1;
			
			?>
                      <input name="button" type="button"  class="fbutton" onclick="location.href='export_per.php?page_index=<?php echo "$pre" ?>'" value="Previous" />
                    &nbsp;
                    <?php
		}
		if($page_index < $pages)
   		{
   			$next=$page_index+1;			
			?>
                    <input name="button" type="button"  class="fbutton" onclick="location.href='export_per.php?page_index=<?php echo "$next" ?>'" value="  Next  " />
                    <?php
			
		}
		?>                  </td>
                </tr>
              </table>
            <?php
		}
	?>          </td>
        </tr>
      </table></td>
    </tr>
  </table>
  <?php
  	}
	else
	{
		redirect("invalidaccess.php");
	}
  ?>
</form>
<?php include_once("footer.php");?>
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