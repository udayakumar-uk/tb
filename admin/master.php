<?php
	ob_start();
	session_start();
	include("include/includei.php");
	include("header.php");
if(!empty($_SESSION['tobadmin']))
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
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
.style19 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #FF0000;
}
.style20 {color: #0000FF}
.style21 {font-weight: bold}

-->
</style>
</head>
<script>
function validation()
{
	if(document.form1.edt.value!='')
	{
		if(document.form1.mlocation.value=='')
		{
			alert("Enter value");
			document.form1.mlocation.focus();
			return false;
		}
	}
	else
	{
		if(document.form1.addnew.value=='')
		{
			alert("Select what is to be added");
			document.form1.addnew.focus();
			return false;
		}
		else if(document.form1.addnew.value=='State' && document.form1.nstate.value=='')
		{
			alert("Enter State");
			document.form1.nstate.focus();
			return false;
		}
		else if(document.form1.addnew.value!='State' && document.form1.state.value=='')
		{
			alert("Select State");
			document.form1.state.focus();
			return false;
		}
		else if(document.form1.addnew.value!='State' && document.form1.ndistrict.value=='')
		{
			alert("Enter District");
			document.form1.ndistrict.focus();
			return false;
		}
	}
	document.form1.subm.value=1;
	return true
}
function mod_location(st,st1,st2)
{
	if(confirm("Are You Sure To "+st+" Selected Location Detailes"))
	{
		location.href="master.php?cedit="+st+"&cid="+st1+"&page_index="+st2;

	}
	else
	return false;
}
function del_location()
{
	if(confirm("Are You Sure To Delete Selected Location And Its Sub Locations"))
	{
		document.form1.subm.value=2;
		document.form1.submit();
	}
	else
	return false;
}
</script>
<body>
<?php
if(!empty($_POST['subm']) && $_POST['subm']==2)
{
	$n=$_POST['n'];
	$str="";
	for($i=1;$i<=$n;$i++)
	{
		$chk="chk".$i;
		$chkk="chkk".$i;
		if($_POST[$chk]!="")
		{
			if($_POST[$chkk]==1)
			{
				//if(count($arr[0])>0)
				//$sttr=implode(',',$arr[0]);
				if($str=="")
				$str=mysqli_real_escape_string($_POST[$chk]);
				else
				$str=$str.",".mysqli_real_escape_string($_POST[$chk]);
			}
		}
	}
if($str!="")
	{
	$upd=executework("delete from tob_location where id in(".$str.")");
	redirect("master.php?succ=3");
	}
}

if(!empty($_POST['subm']) && $_POST['subm']!=2)
{
				echo $newf=$_POST['addnew'];
				if($newf=='State')
				{
					$fld='nstate';
					$fld1=0;
				}
				else if($newf=='District')
				{
					$fld='ndistrict';
					$fld1=$_POST['state'];
				}

	$selpy=executework("select * from tob_location where precatid=".mysqli_real_escape_string($fld1)." and name='".mysqli_real_escape_string($_POST['nstate'])."'");
	$rowpoy=@mysqli_fetch_array($selpy);
	 $count=@mysqli_num_rows($selpy);
	if($count > 0)
	{
		redirect("master.php?succ=2");
	}
	
	else if($_POST['edt']!="")
	{
			$upd=executework("update tob_location set name='".mysqli_real_escape_string($_POST['mlocation'])."' where id=".mysqli_real_escape_string($_POST['edt']));
			redirect("master.php?succ=7");
	}
	else
	{
	
		$ins=executework("insert into tob_location values('','".mysqli_real_escape_string($newf)."','".mysqli_real_escape_string($fld1)."','".mysqli_real_escape_string($_POST[$fld])."',1)");
		redirect("master.php?succ=1");
	}
}
?>
<form id="form1" name="form1" method="post" action="master.php" onsubmit="return validation();" >
<?php
if(!empty($_GET['cid']))
{
	$selny=executework("select * from tob_location where id=".mysqli_real_escape_string($_GET['cid']));
	$rowny=@mysqli_fetch_array($selny);
}
?>
  <table width="100%" height="184" border="0" cellpadding="0" cellspacing="0">
  <?php
  if(!empty($_GET['succ']) && $_GET['succ']==7)
  {
  ?>
    <tr>
      <td colspan="3" class="style20"><div align="center" class="style1">Location Updated Successfully </div></td>
    </tr>
  <?php
  }
  	if(!empty($_GET['succ']) && $_GET['succ']==3)
	{
  ?>
    <tr>
      <td colspan="3" class="style20"><div align="center" class="style1">Given Details are Deleted Successfully </div></td>
    </tr>
  <?php
  }
  	if(!empty($_GET['succ']) && $_GET['succ']==2)
	{
  ?>
    <tr>
      <td colspan="3"><div align="center" class="style19">Given Data Already Exists </div></td>
    </tr>
	<?php
	}
	if(!empty($_GET['succ']) && $_GET['succ']==1)
	{
	?>
    <tr class="style20">
      <td colspan="3"><div align="center" class="style1">Data Inserted Successfully </div></td>
    </tr>
	<?php
	}
if(empty($_GET['cedit']))
{
	?>
    <tr>
      <td width="44%" class="style8"><div align="right">Add New </div></td>
      <td width="4%" class="style8"><div align="center">:</div></td>
      <td width="52%"><label>
        <select name="addnew" id="addnew" onchange="form1.submit();">
		<option value="">Select</option>
		<option value="State" <?php if(!empty($_POST['addnew']) && $_POST['addnew']=='State') { ?> selected="selected"<?php } ?>>State</option>
		<option value="District" <?php if(!empty($_POST['addnew']) && $_POST['addnew']=='District') { ?> selected="selected"<?php } ?>>District</option>
        </select>
      </label></td>
    </tr>
<?php
//$selectr=executework("select * from tob_location where precatid=0");
if(isset($_POST['addnew']) && $_POST['addnew']!='State')
{
	$stru=" and precatid=0";
	$selu=executework("select * from tob_location where tfield='State'".$stru." order by name");
	//echo "select * from tob_location where tfield='State'".$stru." order by name";
	
?>	
    <tr>
      <td class="style8"><div align="right">State </div></td>
      <td class="style8"><div align="center">:</div></td>
      <td><label>
        <select name="state" id="state" onchange="form1.submit();">
		<option value="">Select</option>
		<?php
		while($rowr=@mysqli_fetch_array($selu))
		{
		?>
		<option value="<?php echo $rowr['id'] ?>" <?php if($_POST['state']==$rowr['id']) { ?> selected="selected" <?php } ?>><?php echo $rowr['name'] ?></option>
		<?php
		}
		?>
        </select>
      </label></td>
    </tr>
	<?php
	}
		if(!empty($_POST['addnew']) && $_POST['addnew']=='State')
		{
	?>	
    <tr>
      <td class="style8"><div align="right">New State </div></td>
      <td class="style8"><div align="center">:</div></td>
      <td><label>
        <input name="nstate" type="text" id="nstate" />
      </label></td>
    </tr>
	<?php
	}
	//$str=executework("select * from tob_location precatid='".$rowr['id']."'");
	if(isset($_POST['addnew']) && $_POST['addnew']!="State" && $_POST['addnew']!="District")
	{
	
	$struo=" and name=".mysqli_real_escape_string($_POST['state'])."";
	$str=executework("select * from tob_location where tfield='District'".$struo." order by name");
	//echo "select * from tob_location where tfield='District'".$struo." order by name";

	?>
    <tr>
      <td class="style8"><div align="right">District</div></td>
      <td class="style8"><div align="center">:</div></td>
      <td><label>
        <select name="district" id="district" >
		<option value="">Select</option>
		<?php
		while($ror=@mysqli_fetch_array($str))
		{
		?>
		<option value="<?php echo $ror['id'] ?>" <?php if($_POST['district']==$ror['id']) { ?> selected="selected" <?php } ?>><?php echo $ror['name'] ?></option>
		<?php
		}
		?>
        </select>
      </label></td>
    </tr>
<?php
}
if(!empty($_POST['addnew']) && $_POST['addnew']=='District')
{
?>	
    <tr>
      <td class="style8"><div align="right">New District </div></td>
      <td class="style8"><div align="center">:</div></td>
      <td><label>
        <input name="ndistrict" type="text" id="ndistrict" />
      </label></td>
    </tr>
<?php
}
}
if(!empty($_GET['cedit']))
{
?>	
    <tr>
      <td class="style8"><div align="right">Modify</div></td>
      <td class="style8"><div align="center">:</div></td>
      <td><label>
        <input name="mlocation" type="text" id="mlocation"  value="<?php echo $rowny['name'] ?>"/>
      </label></td>
    </tr>
	<?php
	}
if(!empty($_POST['addnew']) || !empty($_GET['cedit']))
{
	?>
    <tr>
      <td>
          <div align="center"></div>          </td>
          <td colspan="2"><input type="submit" name="Submit" value="Submit" />
            <input name="edt" type="hidden" id="edt" value="<?php if(!empty($_GET['cid'])) echo $_GET['cid'] ?>" />
            
&nbsp;
<input type="button" name="Submit2" value="Cancel" onclick="location.href='master.php'" /></td>
    </tr>
<?php
}
?>
  </table>
<table width="80%" border="0" align="center">
                                      <tr>
                                        <td><table width="98%" border="0" align="center">
                                            <tr>
                                              <td><?php
											  $ct='';$f='';
		if(!empty($_POST['addnew']))
		$ct=" and tfield='".$_POST['addnew']."'";
		else if(!empty($_POST['states']))
		$f=$_POST['states'];
		else if(!empty($_POST['district']))
		$f=$_POST['district'];
		else
		$f='';
		if($f!="")
		{
			$arr=get_gensubcat("tob_location","tfield","precatid","id",0,'',$f);
			if(count($arr[0])>0)
			{
				$str=implode(',',$arr[0]);
				$ct.=" and id in (".$str.")";
			}
		}
		$selloc=executework("select * from tob_location where id<>'' ".$ct." order by tfield,precatid,name");
		$max_recs_per_page=20;
		$count=@mysqli_num_rows($selloc);
      ?>
                                                  <table width="90%" align="center" cellpadding="0" cellspacing="4">
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

	$select1= executework("select * from tob_location where id<>'' ".$ct." order by field(tfield,'State','District'),precatid,name LIMIT $pagenow1, $max_recs_per_page");
	
	//echo "select * from tob_location where id<>'' ".$ct." order by field(tfield,'State','District'),precatid,name LIMIT $pagenow1, $max_recs_per_page";
	$count1 = @mysqli_num_rows($sql1);
	
	if($pages > 1)
	{
	?>
                                                    <tr>
                                                      <td colspan="3" align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Page&nbsp; <span class="style3">
                                                        <?php
	  for($im=1;$im<=$pages;$im++)
	  {
	  		if($page12 != $im)
			{
				?>
                                                        <a href="tob/location.php?page_index=<?php echo "$im" ?>" class="b"><?php echo "$im" ?></a>&nbsp;
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
                                                      </span> </strong></font></td>
                                                    </tr>
                                                    <?php
	}
	?>
                                                </table></td>
                                            </tr>
                                            <tr>
                                              <td><table width="100%" border="1" align="center" cellpadding="2" cellspacing="0" bgcolor="#FFFFFF">
                          <tr class="style17">
  <td width="50" bgcolor="#FFFFFF"><div align="center" class="style14 style21">
                                                        <div align="center">SL No </div>
                            </div></td>
                            <td width="118" bgcolor="#FFFFFF"><div align="center"><strong><span class="style14">Category</span></strong></div></td>
                            <td width="155" bgcolor="#FFFFFF"><div align="center"><strong><span class="style14">Main Location </span></strong></div></td>
                            <td width="155" bgcolor="#FFFFFF"><div align="center"><strong><span class="style14">Location</span></strong></div></td>
                            <td bgcolor="#FFFFFF"><div align="center"></div></td>
  <td bgcolor="#FFFFFF"><div align="center"><strong>
                                                        <input type="button" name="Submit32" value="  Delete  " onClick="del_location()"/>
                            </strong></div></td>
                                                </tr>
                                                  <?php
			$i=$pagenow1+1;
			while($row=@mysqli_fetch_array($select1))
			{
				$seli=executework("select count(*) from tob_location where precatid=".mysqli_real_escape_string($row['id']));
				//echo "select count(*) from tob_location where precatid=".$row['id'];
				$rowi=@mysqli_fetch_array($seli);
				//print_r($rowi);
				
	$selkt=executework("select * from tob_location where id=".mysqli_real_escape_string($row['precatid']));
	//echo "select * from tob_location where id=".$row['precatid'];
	$rowkt=@mysqli_fetch_array($selkt);
	//print_r($rowkt);		
				//$cnt=get_locationcnt();
		?>
                                                  <tr class="style17">
                                                    <td bgcolor="#FFFFFF"><div align="center"><span class="style15" ><?php echo $i; ?></span></div></td>
                                                    <td bgcolor="#FFFFFF"><span class="style15" > &nbsp; <?php echo $row['tfield'];?></span></td>
                                                    <td bgcolor="#FFFFFF"><span class="style15" > &nbsp; <?php echo $rowkt['name'];?></span></td>
                                                    <td bgcolor="#FFFFFF"><span class="style15" > &nbsp; <?php echo $row['name'];?></span>
                                                        <input name="chk<?php echo $i ?>" type="hidden" id="chk<?php echo $i ?>" value="<?php echo $row['id'] ?>" /></td>
                                                    <td width="77" bgcolor="#FFFFFF"><div align="center">
               <input type="button" name="Submit22" value="  Modify  " onClick="mod_location('Modify','<?php echo $row['id'] ?>','<?php echo $page_index ?>')" />
                                                    </div></td>
                                                    <td width="85" bgcolor="#FFFFFF"><div align="center">
                                                        <label>
                                                        <input name="chkk<?php echo $i ?>" type="checkbox" id="chkk<?php echo $i ?>" value="1" />
                                                        </label>
                                                    </div></td>
                                                  </tr>
                                                  <?php
				$i++;
			}
		}
		?>
                                                </table>
                                <input name="n" type="hidden" id="n" value="<?php echo $i-1 ?>" />
                                                  <input name="subm" type="hidden" id="subm" /></td>
                                            </tr>
                                          </table>
                                            <?php
    if ($pages > 1)
  	{
  		?>
                                            <table width="80%" border="0" align="center" cellpadding="0" cellspacing="4">
                                              <tr>
                                                <td align="center" valign="top"><?php
   
		if($page_index != 1)
		{
			$pre=$page_index-1;
			?>
                                                    <input name="button" type="button"  class="fbutton" onClick="location.href='category.php?page_index=<?php echo "$pre" ?>'" value="Previous" />
                                                  &nbsp;
                                                  <?php
		}
		if($page_index < $pages)
   		{
   			$next=$page_index+1;			
			?>
                                                  <input name="button" type="button"  class="fbutton" onClick="location.href='category.php?page_index=<?php echo "$next" ?>'" value="  Next  " />
                                                  <?php
			
		}
		?>
                                                </td>
                                              </tr>
                                            </table>
                                          <?php
		}
	?>
                                        </td>
                                      </tr>
  </table>
  <p>&nbsp;</p>
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