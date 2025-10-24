<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION['tobadmin']))
{
	$yr=date('Y');
	if(!empty($_POST['year']))
	$yrs=$_POST['year'];
	else
	$yrs=$yr;
	
?>

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

</script>

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

	if(!empty($_POST['subm']))
	{
		$selmax=executework("select max(id) from tob_auct");
		$rowm=@mysqli_fetch_array($selmax);
		if($rowm[0]!="")
		$max=$rowm[0]+1;
		else
		$max=1;

		$selplat=executework("select * from tob_platform where platform='".$_POST['plats']."'");
		$rowp=@mysqli_fetch_array($selplat);
		
		$seldat=executework("select * from tob_auct where platf=".$_POST['plats']." and year=".$_POST['year']);
		$cnt=@mysqli_num_rows($seldat);
		if($cnt>0)
		{
			$row=@mysqli_fetch_array($seldat);
			$upqry=executework("update tob_auct set qauth=".$_POST['qauth'].",qest=".$_POST['qest'].",cdate='".datepattrn1($_POST['cdate'])."',edate='".date('Y-m-d',strtotime($_POST['edate']))."' where id=".$row['id']);
		}
		else
		{
			$intqry=executework("insert into tob_auct values(".$max.",".$_POST['plats'].",".$_POST['year'].",".$_POST['qauth'].",".$_POST['qest'].",'".date('Y-m-d',strtotime($_POST['cdate']))."','".date('Y-m-d',strtotime($_POST['edate']))."')");
		}
		redirect("platform1.php?succ=1");
	} ?>



<!DOCTYPE html>
<html lang="en">
<head>
  	<?php include_once("head.php")?>
	<title>Add Auction Details | Tobacco Board</title>
	<script src="genfunctions.js" type="text/javascript"></script>
	<script src="../jquery.ui-1.5.2/jquery-1.2.6.js" type="text/javascript"></script>
	<script src="../jquery.ui-1.5.2/ui/ui.datepicker.js" type="text/javascript"></script>
	<link href="../jquery.ui-1.5.2/themes/ui.datepicker.css" rel="stylesheet" type="text/css" />
</head>
<body>

<section id="adminLayout">

	<?php include "header.php" ?>

	<?php include "sidebar.php"; ?>
	
	<main id="adminMain" class="container-fluid">
		
	<div class="row">
		<h2 class="admin-title col">Add Auction Details</h2>

		<div class="col-auto">
			<?php if(!empty($_GET['succ']) && $_GET['succ']==1){ ?>
				<div class="alert alert-success d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">check_circle</span>
					<span> Data Updated Successfully</span>
				</div>
			<?php } ?>
		</div>
	</div>
	

	<form action="platform1.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check(this);">

	<?php
	    $sel=executework("select * from tob_employeeview where username='".$_SESSION['tobadmin']."'");
		//echo "select * from tob_employeeview where username='".$_SESSION['tobadmin']."'";
		$row=@mysqli_fetch_array($sel);
			$details=array($row['permissions']);
			if($_SESSION['tob']=='admin')
			$detai=array('Andhra Pradesh','Karnataka');
			foreach($details as $detail)
			{
			    if($detail!='')
			    $detai=explode(',',$detail);
			    else
			    $detai=array();
			} ?>
	<div class="row">
		<div class="form-group col-md-6">
			<label for="state" class="form-label">States</label>
			<select name="state" id="state" onchange="chk()" class="form-select">
				<option value="" selected="selected">Select</option>
				<option value="Andhra Pradesh" >Andhra Pradesh</option>
				<option value="Karnataka" >Karnataka</option>
        	</select>
			<?php
			if(!empty($_POST['state']))
			$ct=$_POST['state'];
			else
			$ct=$detai;
			
			if($ct!="") { ?>
				<script type="text/javascript">
				var ct='<?php echo $ct ?>';
				var j;
				for(j=1;j<=document.form1.state.options.length;j++)
				{
					if(document.form1.state.options[j].value==ct)
					{
						document.form1.state.options[j].selected=true;
					}
				}
				</script>
			<?php } ?>   
		</div>

		
	<?php
	$qry='';
	if(!empty($_POST['state']))
	{
		if($_POST['state']=='Andhra Pradesh' && !empty($_POST['catg']))
		$qry=" and catg='".$_POST['catg']."'";
		$selplat=executework("select * from tob_platform where state='".$_POST['state']."'".$qry." and isactive=1 order by catg,sno,apfno");
		
		if(!empty($_POST['plats']))
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
		<div class="form-group col-md-6">
			<label for="plats" class="form-label">Platform Name</label>
			<select name="plats" id="plats" onchange="chk()" class="form-select">
          		<option value="">Select</option>
				<?php  while($rowp=@mysqli_fetch_array($selplat)) {  ?>
					<option value="<?php echo $rowp['id'] ?>"><?php echo $rowp['platform']."(".$rowp['apfno'].")"; ?></option>
				<?php }  ?>
			</select>
        		<?php
					if(!empty($_POST['plats'])) { ?>
      			<script type="text/javascript">
					 var ctp='<?php echo $_POST['plats'] ?>';
					 var j;
					for(j=0;j<document.form1.plats.options.length;j++)
					{
						if(document.form1.plats.options[j].value==ctp)
						{
							document.form1.plats.options[j].selected=true;
						}
					}
					</script>
      <?php
					}
				  ?>
		</div>
		
		<div class="form-group col-md-6">
			<label for="year" class="form-label">Auction Year</label>
			<select name="year" id="year" onchange="chk()" class="form-select">
				
			<?php
				for($i=2009;$i<=$yr;$i++)
				{
				?>
				<option value="<?php echo $i ?>"><?php echo $i ?></option>
				<?php
				}
				?>
			</select>
        		<?php
					if($yrs!="")
					{
					?>
        		<script type="text/javascript">
					 var ctp='<?php echo $yrs ?>';
					 var j;
					for(j=0;j<document.form1.year.options.length;j++)
					{
						if(document.form1.year.options[j].value==ctp)
						{
							document.form1.year.options[j].selected=true;
						}
					}
				</script>
        		<?php }
			
			if(!empty($_POST['plats']) && !empty($_POST['year'])) {		
				$selauct=executework("select * from tob_auct where platf=".$_POST['plats']." and year=".$_POST['year']);
				$cnta=@mysqli_num_rows($selauct);
				$rowa=@mysqli_fetch_array($selauct);
			}  ?>
	
		</div>

		
 
		<div class="form-group col-md-6">
			<label for="qauth" class="form-label">Quantity Autherised</label>
			<input name="qauth" type="text" id="qauth" class="form-control" value="<?php if(!empty($rowa['qauth'])) echo $rowa['qauth']?>" />
		</div>

		<div class="form-group col-md-6">
			<label for="qest" class="form-label">Quantity Estimated</label>
			<input name="qest" type="text" id="qest" class="form-control" value="<?php if(!empty($rowa['qest'])) echo $rowa['qest']?>" />
		</div>

		<div class="form-group col-md-6">
			<label for="cdate" class="form-label">Date Of Commence</label>
			<input name="cdate" type="text" id="cdate" class="form-control" value="<?php if(!empty($rowa['cdate']) && $rowa['cdate']!='0000-00-00') { echo datepattrn($rowa['cdate']); }?>" />
		</div>

		<div class="form-group col-md-6">
			<label for="edate" class="form-label">Date Of Closure</label>
			<input name="edate" type="text" id="edate" class="form-control" value="<?php if(!empty($rowa['edate']) && $rowa['edate']!='0000-00-00') { echo datepattrn($rowa['edate']); }?>" />
		</div>
	</div>
		
	<div class="submit-button text-end">
		<?php if(empty($_GET['edit'])){ ?>
			<input type="reset" class="btn btn-light" name="Submit2" value="Reset" />
			<input type="submit" class="btn btn-primary" name="Submit" value="Submit" />
		<?php } else { ?>
			<input type="reset" class="btn btn-light" name="Submit2" value="Cancel" onclick="back1();" />
			<input type="submit" class="btn btn-primary" name="Submit" value="Modify" />
		<?php } ?>
		
		<input name="subm" type="hidden" id="subm" />	 
		<input name="ttype" type="hidden" id="ttype" value="<?php echo $_GET['edit']?>" />
	</div>
</form>

</main>

</section>

<script>
jQuery('#cdate').datepicker();
jQuery('#cdate').readOnly=true;
jQuery('#edate').datepicker();
jQuery('#edate').readOnly=true;
chng();
</script>

<?php include_once("footer.php");?>


<script>

function check(form1)
{
	if(document.form1.state.value=="")
	{
		alert("State Should Not Be Empty");
		document.form1.state.focus();
		return false;
	}
	else if(document.form1.plats.value=="")
	{
		alert("Platform Name Should Not Be Empty");
		document.form1.plats.focus();
		return false;
	}
	else if(isNaN(document.form1.qauth.value)==true)
	{
		alert("Enter Valid Quantity Autherised");
		document.form1.qauth.value="";
		document.form1.qauth.focus();
		return false;
	}
	else if(isNaN(document.form1.qest.value)==true)
	{
		alert("Enter Valid Quantity Estimated");
		document.form1.qest.value="";
		document.form1.qest.focus();
		return false;
	}
	else if(document.form1.cdate.value=="")
	{
		alert("Date Of Commence Should Not Be Empty");
		document.form1.cdate.focus();
		return false;
	}
	else
	{
		document.form1.subm.value=1;
		return true
	}
}
</script>



<?php } else { ?>
	<script language="javascript">parent.location.href="index.php";</script>
<?php } ?>


</body>
</html>
