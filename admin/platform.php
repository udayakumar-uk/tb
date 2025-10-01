<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION['tobadmin']))
{

	if(!empty($_POST['subm']))
	{
	
			if($_POST['disable']==1)
			{
				$chkds=" ,isactive=0";
				$dis=0;
			}
			else
			{
				$chkds=" ,isactive=1";
				$dis=1;
			}
			if($_POST['hpage']==1)
			{
				$chkds1=" ,home=1";
				$dis1=1;
			}
			else
			{
				$chkds1=" ,home=0";
				$dis1=0;
			}
			if(!empty($_POST['hpage']))
			{
			$hpag=1;
			}
			else
			{
			$hpag=0;
			}
		if(!empty($_POST['plats']))
		{
			$selplx=executework("select * from tob_platform where platform='".$_POST['plat']."' and id<>".$_POST['plats']);
			$cntx=@mysqli_num_rows($selplx);
			if($cntx>0)
			{
				$exst=1;
				redirect("platform.php?exst=1");
			}
			else
			{
				$upplx=executework("update tob_platform set platform='".$_POST['plat']."',apfno='".$_POST['apf']."',dist='".$_POST['dist']."',sno='".$_POST['sno']."',seqid=".$_POST['sno'].$chkds.$chkds1." where id='".$_POST['plats']."'");
				redirect("platform.php?succ=2");
			}
		}
		else
		{
			$selmax=executework("select max(id) from tob_platform");
			$rowm=@mysqli_fetch_array($selmax);
			if($rowm[0]!="")
			$max=$rowm[0]+1;
			else
			$max=1;
			
			$selpl=executework("select * from tob_platform where platform='".$_POST['plat']."'");
			$cntp=@mysqli_num_rows($selpl);
			
			$selsno=executework("select * from tob_platform where seqid='".$_POST['sno']."'");
			$cntsno=@mysqli_num_rows($selsno);
			if($cntp>0 || $cntsno>0)
			{
				if($cntp>0)
				{
				$exst=1;
				redirect("platform.php?exst=1");
				}
				if($cntsno>0)
				{
				$exst=2;
				redirect("platform.php?exst=2");
				}
				else 
				{
				$exst=3;
				redirect("platform.php?exst=3");
				}
			}
			else
			{
			
		/*$selst3=executework("select * from tob_catg where id='".$_POST[state]."'");
		$fest3=mysqli_fetch_array($selst3);
		
		$seldt3=executework("select * from tob_catg where id='".$_POST[dist]."'");
		$fedt3=mysqli_fetch_array($seldt3);*/
				$inttob=executework("insert into tob_platform values(".$max.",'".$_POST['sno']."','".$_POST['state']."','".$_POST['dist']."','".$_POST['catg']."','".$_POST['plat']."','".$_POST['plat']."','".$_POST['apf']."','".$_POST['sno']."',".$dis1.",".$dis.")");
				
				$succ=1;
				redirect("platform.php?succ=1");
			}
		}
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
function chng()
{
	if(document.form1.state.value!='Karnataka')
	{
		document.getElementById("ct").style.visibility='visible';
		document.getElementById("ct").style.position='relative';
	}
	else
	{
		document.getElementById("ct").style.visibility='hidden';
		document.getElementById("ct").style.position='absolute';
	}
}

function chk()
{
	document.form1.submit();
}

function check(form1)
{
	if(document.form1.state.value=="")
	{
		alert("State Should Not Be Empty");
		document.form1.state.focus();
		return false;
	}
	else if(document.form1.state.value=='Andhra Pradesh' && document.form1.catg.value=="")
	{
		alert("Category Should Not Be Empty")
		document.form1.catg.focus();
		return false;
	}
	else if(document.form1.plat.value=="")
	{
		alert("Platform Name Should Not Be Empty");
		document.form1.plat.focus();
		return false;
	}
	else if(document.form1.apf.value=="")
	{
		alert("ApfNo Should Not Be Empty");
		document.form1.apf.focus();
		return false;
	}
	else if(isNaN(document.form1.apf.value))
	{
		alert("ApfNo Should  Be Numerical");
		document.form1.apf.focus();
		return false;
	}
	else if(document.form1.sno.value=="")
	{
		alert("Sq No Should Not Be Empty");
		document.form1.sno.focus();
		return false;
	}
	else if(isNaN(document.form1.sno.value))
	{
		alert("Seq No Should  Be Numerical");
		document.form1.sno.focus();
		return false;
	}
	else
	{
		document.form1.subm.value=1;
		return true
	}
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
<form action="platform.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check(this);">
  <table width="90%" border="0" align="center">
    <tr>
      <td width="25%">&nbsp;</td>
      <td width="9%">&nbsp;</td>
      <td width="66%">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><span class="style1">Add Platform </span> </td>
    </tr>
    
	<?php
		if(!empty($_GET['exst']) && $_GET['exst']==2)
		{
	?>
    <tr>
      <td height="40" colspan="3" class="style7" style="padding-left:150px;">Given Seq Id Already Exist </td>
    </tr>
	<?php
	}
		if(!empty($_GET['exst']) && $_GET['exst']==3)
		{
	?>
    <tr>
      <td height="40" colspan="3" class="style7" style="padding-left:150px;">Given Platform And Seq Id Already Exist </td>
    </tr>
	<?php
	}
		if(!empty($_GET['exst']) && $_GET['exst']==1)
		{
	?>
    <tr>
      <td height="40" colspan="3" class="style7" style="padding-left:150px;">Given Platform Alredy Exist </td>
    </tr>
	<?php
		}
		else if(!empty($_GET['succ']) && $_GET['succ']==1)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">New Platform Added Successfully</span> </td>
    </tr>
	<?php
		}
		else if(!empty($_GET['succ']) && $_GET['succ']==2)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">Platform Modified  Successfully</span> </td>
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
		$selst=executework("select DISTINCT state,id from tob_states order by id");
	?>
    <tr>
      <td height="30" style="padding-left:35px;"><div align="center"><span class="style4">States</span></div></td>
      <td height="30"><div align="center"><strong>:</strong></div></td>
      <td><label>
        <select name="state" id="state" onchange="chk();">
          <option value="" selected="selected">Select</option>
          <?php
		while($fest=@mysqli_fetch_array($selst))
		{
		 ?>
                <option value="<?php echo $fest['state'] ?>"><?php echo $fest['state'] ?></option>
                <?php
		}
		?>
        </select>
      </label>
	  				<?php
					if(!empty($_POST['state']))
					{
					
					?>
                <script type="text/javascript">
					 var ct1='<?php echo $_POST['state'] ?>';
					 
					for(j=0;j<document.form1.state.options.length;j++)
					{
						if(document.form1.state.options[j].value==ct1)
						{
						document.form1.state.options[j].selected=true;
						}
					}
					</script>
                <?php
					}
				?>        </td>
    </tr>
	<tr id="ct">
      <td height="30" valign="top" style="padding-left:35px;"><div align="center"><span class="style4">Category</span></div></td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td><label>
        <select name="catg" id="catg" onchange="chk();">
          <option value="">Select</option>
          <option value="NBS">NBS</option>
          <option value="CBS">CBS</option>
          <option value="SBS">SBS</option>
          <option value="SLS">SLS</option>
          <option value="NLS">NLS</option>
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
					 var z;
					for(z=0;z<document.form1.catg.options.length;z++)
					{
						if(document.form1.catg.options[z].value==ct)
						{
							document.form1.catg.options[z].selected=true;
						}
					}
					</script>
                <?php
					}
				  ?>
      </label></td>
    </tr>
	<?php
	$chkd=''; $chkd1=''; $qry='';
	if(!empty($_POST['state']))
	{
		if($_POST['state']!='' && $_POST['catg']!="")
		$qry=" and catg='".$_POST['catg']."'";
		/*$selst2=executework("select * from tob_states where state='".$_POST[state]."'");
		$fest2=mysqli_fetch_array($selst2);
		
		$seldt2=executework("select * from tob_states where dist='".$_POST[dist]."'");
		$fedt2=mysqli_fetch_array($seldt2);*/
		
		$selplat=executework("select * from tob_platform where state='".$_POST['state']."' ".$qry." order by catg,seqid,apfno");
		
		//echo "select * from tob_platform where state='".$_POST[state]."' and dist='".$_POST[dist]."'".$qry." order by catg,seqid,apfno";
		// $cn=mysqli_num_rows($selplat);
		if($_POST['plats']!="")
		{
			$selpl=executework("select * from tob_platform where id=".$_POST['plats']);
			$rown=@mysqli_fetch_array($selpl);
			if($rown['isactive']==0)
			$chkd="checked='checked'";
			else
			$chkd="";
			if($rown['home']==1)
			$chkd1="checked='checked'";
			else
			$chkd1="";
		}
	}
	?>
    <tr>
      <td height="30" valign="top" class="style4" style="padding-left:35px;"><div align="center">Platforms</div></td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td class="style8"><label>
        <select name="plats" id="plats" onchange="chk();">
          <option value="">Select</option>
		 <?php
		 while($rowp=@mysqli_fetch_array($selplat))
		 {
		 ?>
          <option value="<?php echo $rowp['id'] ?>"><?php echo $rowp['platform'] ?></option>
		 <?php
		 }
		 ?>
        </select>
        <?php
					if(!empty($_POST['plats']))
					{
					?>
      <script type="text/javascript">
					 var ctp='<?php echo $_POST['plats'] ?>';
					 var m;
					for(m=0;m<document.form1.plats.options.length;m++)
					{
						if(document.form1.plats.options[m].value==ctp)
						{
							document.form1.plats.options[m].selected=true;
						}
					}
					</script>
      <?php
					}
				  ?>
      </label></td>
    </tr>
    <tr>
      <td height="30" valign="top" class="style4" style="padding-left:35px;"><div align="center">Platform Name </div></td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td class="style8"><label>
      <input name="plat" type="text" id="plat" value="<?php if(!empty($rown['platform'])) echo $rown['platform']?>" />
      </label></td>
    </tr>
    <tr>
	<?php
	if(!empty($_POST['state']))
	{
	$seldt=executework("select * from tob_states where state='".$_POST['state']."'");
	
	$splt=executework("select  * from tob_platform where  id='".$_POST['plats']."'");
	$fetplt=mysqli_fetch_array($splt);
	
	$seldt1=executework("select * from tob_platform where state='".$_POST['state']."' and platform='".$fetplt['platform']."' and catg='".$_POST['catg']."'");
	$fedt1=mysqli_fetch_array($seldt1);
	}
	?>
      <td height="30" style="padding-left:35px;"><div align="center"><span class="style4">District</span>s</div></td>
      <td height="30"><div align="center"><strong>:</strong></div></td>
      <td><select name="dist" id="dist">
        <option value="">Select</option>
		<?php
		while($fedt=@mysqli_fetch_array($seldt))
		{
		 ?>
                <option value="<?php echo $fedt['dist'] ?>"><?php echo $fedt['dist'] ?></option>
                <?php
		}
		?>
      </select>
	  				<?php
					if(!empty($_POST['dist']) || !empty($fedt1['dist']))
					{
					?>
                <script type="text/javascript">
				<?php 
				
					if(!empty($fedt1['dist']))
					{ ?>
					var ct='<?php echo $fedt1['dist'] ?>';
					<?php
					}
					else
					{
					?>
					 var ct='<?php echo $_POST[dist]?>';
					 <?php
					 }
					 ?>
					 
					 for(l=0;l<document.form1.dist.options.length;l++)
					{
						if(document.form1.dist.options[l].value==ct)
						{
							document.form1.dist.options[l].selected=true;
						}
					}
					</script>
                <?php
					}
				?> 
      </td>
    </tr>
    <tr>
      <td height="30" valign="top" class="style4" style="padding-left:35px;">&nbsp;&nbsp; <div align="center">APF No.</div></td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td class="style8"><input name="apf" type="text" id="apf" value="<?php if(!empty($rown['apfno'])) echo $rown['apfno']?>" /></td>
    </tr>
    <tr>
      <td height="30" valign="top" class="style4" style="padding-left:35px;">&nbsp;&nbsp;
          <div align="center">Seq No.</div></td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td class="style8"><input name="sno" type="text" id="sno" value="<?php if(!empty($rown['seqid'])) echo $rown['seqid']?>" /></td>
    </tr>
    <tr>
      <td height="21" class="style4" style="padding-left:35px;"><div align="center">Show in homepage </div></td>
      <td height="21"><div align="center"><strong>:</strong></div></td>
      <td><input name="hpage" type="checkbox" id="hpage" value="1" <?php echo $chkd1 ?> /></td>
    </tr>
    <tr>
      <td height="22" valign="top" class="style4" style="padding-left:35px;">&nbsp; <div align="center">Disable</div></td>
      <td height="22" valign="top"><div align="center"><strong>:</strong></div></td>
      <td class="style8"><label>
      <input name="disable" type="checkbox" id="disable" value="1" <?php echo $chkd ?> />
      </label></td>
    </tr>
    <tr>
      <td height="50" class="style4" style="padding-left:35px;">&nbsp;</td>
      <td height="30">&nbsp;</td>
      <td>
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
      <td height="50" colspan="3" class="style4">&nbsp;</td>
    </tr>
  </table>
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
<script>
chng();
</script>