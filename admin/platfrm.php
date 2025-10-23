<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
include_once("header.php");
if(!empty($_SESSION['tobadmin'])) {
?>


<!DOCTYPE html>
<html lang="en">
<head>
  	<?php include_once("head.php")?>
	<title>Platforms | Tobacco Board</title>
</head>
<body>

<section id="adminLayout">

	<?php include "header.php" ?>

	<?php include "sidebar.php"; ?>
	
	<main id="adminMain" class="container-fluid">


	
	<div class="row">
		<h2 class="admin-title col">Platforms </h2>

		<div class="col">
			<?php if(isset($_GET['succ']) && $_GET['succ']==9){ ?>
				<div class="alert alert-danger d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">warning</span>
					<span>Given Platform Already Exists</span>
				</div>
			<?php } else if((isset($_GET['succ']) && $_GET['succ']==1) || (isset($_GET['succ']) && $_GET['succ']==2) || (isset($_GET['succ']) && $_GET['succ']==3)){ ?>
				<div class="alert alert-success d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">check_circle</span>
					<?php if(isset($_GET['succ']) && $_GET['succ']==1){ ?>
						<span> Given Platform Added Successfully</span>
					<?php } else if(isset($_GET['succ']) && $_GET['succ']==2){ ?>
						<span> Given Platform Modified Successfully </span>
					<?php } else if(isset($_GET['succ']) && $_GET['succ']==3){ ?>
						<span>Given Platform Deleted Successfully</span>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</div>

	
<form id="form1" name="form1" method="post" action="platfrm.php" onsubmit="return validate();">
	<?php
	if(!empty($_POST['mid']))
	$mid=$_POST['mid'];
	else if(!empty($_GET['mid']))
	$mid=$_GET['mid'];
	else
	$mid='';
	if(isset($_POST['Submit']) && $_POST['Submit']!="") {	
		if($_POST['check']==1)
		$chk=0;
		else
		$chk=1;
		if($_POST['apf']!='' &&$_POST['apf']!=0 )
		$mqry=" or  apfno='".$_POST['apf']."'";
		else
		$mqry='';
		if($mid!="") {
			$stry=executework("select * from tob_platfrm where ((state='".$_POST['state']."' and dist='".$_POST['district']."' and platform='".$_POST['platform_name']."') ".$mqry.") and id<>".$mid);
			$rowrg=@mysqli_num_rows($stry);
			if($rowrg >0) {
			$succ=9;
			redirect("platfrm.php?succ=9");

			}
			else {
				$up=executework("update tob_platfrm set state='".$_POST['state']."', dist='".$_POST['district']."',platform='".$_POST['platform_name']."',apfno='".$_POST['apf']."',isactive='".$chk."' where id='".$mid."'");
				redirect("platfrm.php?succ=2");
			}
		}
		else
		{
			$stry=executework("select * from tob_platfrm where (state='".$_POST['state']."' and dist='".$_POST['district']."' and platform='".$_POST['platform_name']."') ".$mqry);
			$rowrg=@mysqli_num_rows($stry);
			if($rowrg >0) {
			$succ=9;
			redirect("platfrm.php?succ=9");

			}
			else {
		$ins=executework("insert into tob_platfrm values('','','".$_POST['state']."','".$_POST['district']."','','".$_POST['platform_name']."','".$_POST['apf']."','','".$chk."')");
		redirect("platfrm.php?succ=1");
			}
		}
	}	
	?>
  <table width="100%" height="262" border="0" cellpadding="0" cellspacing="0">

	  
		<div class="row">
			<div class="form-group col-md-6">
			
				<?php
					if(!empty($mid)) {
					$seloy=executework("select * from tob_platfrm where id='".$mid."'");
					//echo "select * from tob_platforms where id='".$_GET['mid']."'";
					$rowy=@mysqli_fetch_array($seloy);
					}
				?>
				<?php $sel=executework("select * from tob_location where tfield='State'");  ?>


				<label for="state" class="form-label">State</label>
				<select name="state" id="state" onchange="form1.submit();" class="form-select">
					<option value="" selected>Select State </option>
					<?php while($row=@mysqli_fetch_array($sel)) { ?>
						<option value="<?=$row['id'];?>"><?=$row['name'];?></option>
					<?php } ?>
				</select>
				<?php
					if(!empty($_POST['state']))
					$state=$_POST['state'];
					else if(!empty($row['id']))
					$state=$row['id'];
					else if(!empty($rowy['state']))
					$state=$rowy['state'];
					else
					$state='';
					if($state!="") {
				?>
					<script type="text/javascript">
						var ctp='<?php echo $state ?>';
						var m;
						for(m=0;m<document.form1.state.options.length;m++) {
							if(document.form1.state.options[m].value==ctp)
							{
								document.form1.state.options[m].selected=true;
							}
						}
					</script>
				<?php } ?>
			</div>


			<div class="form-group col-md-6">
				<?php
				if($state!="") {
				$seluy=executework("select * from tob_location where id='".$state."'");
				$rowuy=@mysqli_fetch_array($seluy);
				$st=executework("select * from tob_location where precatid='".$rowuy['id']."'");
				// echo "select * from tob_location where precatid='".$_POST['state']."'";
				//$rowuy=@mysqli_fetch_array($seluy);
				
				?>

				<label for="district" class="form-label">District</label>
				<select name="district" id="district" class="form-select">
					<option value="" selected>Select District </option>
					<?php
					while($rowuyv=@mysqli_fetch_array($st)) {
					?>
					<option value="<?php echo $rowuyv['id'] ?>"><?php echo $rowuyv['name'] ?></option>
					<?php
					}
					?>
				</select>
				 <?php
					if(!empty($_POST['district']))
					$dist=$_POST['district'];
					else if(!empty($rowy['dist']))
					$dist=$rowy['dist'];
					else
					$dist='';
					if($dist!="") {
					?>
					<script type="text/javascript">
						var cttp='<?php echo $dist ?>';
						var m;
						for(m=0;m<document.form1.district.options.length;m++) {
							if(document.form1.district.options[m].value==cttp)
							{
								document.form1.district.options[m].selected=true;
							}
						}
					</script>
                <?php }  } ?>
			</div>
			<div class="col-md-6 form-group">
				<label for="sl_no" class="form-label">Platform Name</label>
				<input class="form-control" name="platform_name" type="text" id="platform_name" value="<?php if(!empty($rowy['platform'])) echo $rowy['platform']?>" />
			</div>
			<div class="col-md-6 form-group">
				<label for="sl_no" class="form-label">APF No</label>
				<input class="form-control" name="apf" type="text" id="apf" value="<?php if(!empty($rowy['apfno'])) echo $rowy['apfno']?>" />
			</div>
			<div class="form-group col-md-6">
				<?php
					if(!empty($rowy['isactive']) && $rowy['isactive']==1)
					$chked='';		
					else if(!empty($rowy['isactive']))
					$chked='checked="checked"';
					else 	
					$chked='';
				?>	
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="check" value="1"<?=$chked;?> >
					<label class="form-check-label" for="check">
						Disable
					</label>
				</div>
			</div>
			<div class="form-group col-md-6 text-end">
        		<input name="mid" type="hidden" id="mid" value="<?=$mid;?>" />
				<input type="reset" class="btn btn-light" name="Submit2" value="Reset" />
				<input type="submit" class="btn btn-primary" name="Submit" value="Submit" />
			</div>
		</div>
 
  <?php
  if(isset($_GET['did']) && $_GET['did']!="") {
  	$dlt=executework("delete from tob_platfrm where id='".$_GET['did']."'");
	redirect("platfrm.php?succ=3");
  }
  $selecth=executework("select * from tob_platfrm");
  $cnth=@mysqli_num_rows($selecth);
  if($cnth > 0)
  { 
  ?>
  
	<div class="table-responsive">
		<table class="table table-bordered ">
			<thead class="text-center">
				<tr>
					<th>S.No</th>
					<th>State</th>
					<th>District</th>
					<th>Platform Name</th>
					<th>APF No</th>
					<th>Status</th>
					<th style="min-width: 100px">Actions</th>
				</tr>
			</thead>
			<tbody>
				
			<?php
			$i=1;
			while($rowth=@mysqli_fetch_array($selecth)) {
			if($rowth['isactive']==1)
			$stat='Active';
			else
			$stat='Disabled';
			$sgh=executework("select * from tob_location  where id='".$rowth['state']."'");
			$rowgh=@mysqli_fetch_array($sgh);
			
			$stghty=executework("select * from tob_location  where id='".$rowth['dist']."'");
			$roth=@mysqli_fetch_array($stghty);
			?>

			<tr>
				<td><?=$i;?></td>
				<td><?php echo $rowgh['name'] ?></td>
				<td><?php echo $roth['name'] ?></td>
				<td><?php echo $rowth['platform'] ?></td>
				<td><?php echo $rowth['apfno'] ?></td>
				<td><?php echo $stat; ?></td>
				<td class="text-center">
					<button name="Submit3" onclick="mod_master('<?php echo $rowth['id'] ?>')" class="btn icon-btn btn-secondary" type="button">
						<span class="material-symbols-rounded">Edit</span>
					</button>
					<button name="Submit4" onclick="del_master('<?php echo $rowth['id'] ?>')" class="btn icon-btn btn-danger" type="button">
						<span class="material-symbols-rounded">delete</span>
					</button>
				</td>
			</tr>

			<?php $i++; } ?>
		</tbody>
	</table>
	<?php } ?>
  
</form>


</main>

</section>

<?php include_once("footer.php");?>


<script>
function mod_master(st) {
	if(confirm("Are You Sure To Modify")) {
		location.href="platfrm.php?mid="+st;

	}
	else
	return false;
}

function del_master(st4) {
	if(confirm("Are You Sure To Delete")) {
		location.href="platfrm.php?did="+st4;
	}
	else
	return false;
}

function validate() {
	if(document.form1.state.value=="") {
		alert("select State");
		document.form1.state.focus();
		return false;
	}
	if(document.form1.district.value=="") {
		alert("Enter District");
		document.form1.district.focus();
		return false;
	}
	if(document.form1.platform_name.value=="") {
		alert("Enter Platform Name");
		document.form1.platform_name.focus();
		return false;
	}
	if(document.form1.seq.value=="") {
		alert("Enter Seq No");
		document.form1.seq.focus();
		return false;
	}
	else
	{
		return true;
	}
}
function submt(st) {
	var std=document.getElementById('mid').value=st;
	//alert(std);
	document.form1.submit();
	
}
</script>

<?php } else { ?>
	<script language="javascript">parent.location.href="index.php";</script>
<?php } ?>

</body>
</html>