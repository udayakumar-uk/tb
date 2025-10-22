<?php
ob_start();
session_start();
include('include/includei.php');
include('header.php');
if(!empty($_SESSION['tobadmin'])) {
?>

<?php
if(!empty($_POST['name'])) {

	if(!empty($_GET['id']))
	$qr=" and id<>".$_GET['id'];
	else
	$qr='';
	
	print_r($_POST);
	$select=executework("select * from tob_training where name='". urlencode($_POST['name'])."'".$qr);
	$cnt=@mysqli_num_rows($select);
	if($cnt>0) {
		redirect("trainings.php?exst=1");
	}
	else
	{
		if(!empty($_GET['id']))
		{
			$upd=executework("update tob_training set name='".urlencode($_POST['name'])."',tno='".$_POST['tno']."',schedule='".urlencode($_POST['schedule'])."',mnth='".$_POST['mnth']."',yr='".$_POST['yr']."' where id='".$_GET['id']."'");
			redirect("trainings.php?succ=2");
		}
		else
		{
			
			$ins=executework("insert into tob_training (name,tno,schedule,mnth,yr,status) values('".urlencode($_POST['name'])."','".$_POST['tno']."','".urlencode($_POST['schedule'])."','".$_POST['mnth']."','".$_POST['yr']."',1)");
			redirect("trainings.php?succ=1");
		}
		
	}
}
$st='';
if(isset($_GET['id']) && $_GET['id']!='') {
	$selm=executework("select * from tob_training where id='".$_GET['id']."'");
	$cntm=@mysqli_num_rows($selm);
	if($cntm==0)
	redirect("trainings.php?invalid=1");
	$rowm=@mysqli_fetch_array($selm);
	$perm=explode(',',$rowm['permissions']);
	$arr=explode(',',$rowm['state']);
	if($rowm['disable']==1)
	$st="checked='checked'";
	else
	$st='';
	
}
if(!empty($rowm['yr']))
	$yr=$rowm['yr'];
else
	$yr=date('Y');

if(!empty($rowm['mnth']))
	$mn=$rowm['mnth'];
else
	$mn=date('n');

if(isset($_GET['did']) && $_GET['did']!='') {
	$seld=executework("select * from tob_training where id='".$_GET['did']."'");
	$cntd=@mysqli_num_rows($seld);
	if($cntd==0)
	redirect("trainings.php?invalid=1");
	else
	{
		$del=executework("delete from tob_training where id='".$_GET['did']."'");
		redirect("trainings.php?del=1");
	}
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  	<?php include_once("head.php")?>
	<title>Trainings | Tobacco Board</title>
<script class="include" type="text/javascript" src="../graph/jquery.min.js"></script>
</head>
<body>

<section id="adminLayout">

	<?php include "header.php" ?>

	<?php include "sidebar.php"; ?>
	
	<main id="adminMain" class="container-fluid">

	<h2 class="admin-title">Training </h2>


	<div id="adminTab">
	<nav>
		<div class="nav nav-tabs align-items-center" id="nav-tab" role="tablist">
			<button class="nav-link <?php if(empty($_GET['page_index'])){ ?> active <?php } ?>" id="post-tab" data-bs-toggle="tab" data-bs-target="#post-training" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Post Trainings</button>
			<button class="nav-link <?php if(!empty($_GET['page_index']) && $_GET['page_index']!=""){ ?> active <?php } ?>" id="view-tab" data-bs-toggle="tab" data-bs-target="#view-training" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">View Trainings</button>
			

			<?php if(isset($_GET['exst']) && $_GET['exst']==1){ ?>
				<div class="alert alert-danger d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">warning</span>
					<span> Training Programme exists with same name </span>
				</div>
			<?php } else if(isset($_GET['invalid']) && $_GET['invalid']==1){ ?>
				<div class="alert alert-danger d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">warning</span>
					<span> Invalid Access </span>
				</div>
			<?php } else if((isset($_GET['succ']) && $_GET['succ']==1) || (isset($_GET['succ']) && $_GET['succ']==2) || (isset($_GET['del']) && $_GET['del']==1)){ ?>
				<div class="alert alert-success d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">check_circle</span>
					<?php if(isset($_GET['succ']) && $_GET['succ']==1){ ?>
						<span> Training programme created successfully </span>
					<?php } else if(isset($_GET['succ']) && $_GET['succ']==2){ ?>
						<span> Training Programme updated successfully </span>
					<?php } else if(isset($_GET['del']) && $_GET['del']==1){ ?>
						<span> Training Programme deleted successfully </span>
					<?php } ?>
				</div>
			<?php } ?>
		</nav>

	<div class="tab-content" id="nav-tabContent">
		<div class="tab-pane fade <?php if(empty($_GET['page_index'])){ ?> show active <?php } ?>" id="post-training" role="tabpanel" aria-labelledby="post-training-tab" tabindex="0">
			
		<form id="form1" name="form1" method="post" action="" onsubmit="return validation();">

			<div class="row">
				<div class="form-group col-md-6">
					<label for="name" class="form-label">Name of Training Programme</label>
					<textarea name="name" cols="30" rows="3" class="form-control" placeholder="Leave a name" id="name"><?php if(isset($rowm)){ echo urldecode($rowm['name']); } ?></textarea>
				</div>
				<div class="form-group col-md-6">
					<label for="schedule" class="form-label">Name of Training Programme</label>
					<textarea name="schedule" cols="30" rows="3" class="form-control" placeholder="Leave a schedule" id="schedule"><?php if(isset($rowm)){ echo urldecode($rowm['schedule']); } ?></textarea>
				</div>
				<div class="form-group col-md-6">
					<label for="schedule" class="form-label">No. of Trainings</label>
					<input name="tno" type="text" id="tno" size="30" class="form-control" value="<?php if(isset($rowm)){ echo $rowm['tno']; } ?>" />
				</div>

				<div class="form-group col-md-6">
					<label for="schedule" class="form-label">Schedule Month &amp; Year</label>
					<div class="row">
						<div class="col-md-6">
							<select name="mnth" id="mnth" class="form-select">
								<option value="">Month</option>
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
						</div>
						<div class="col-md-6">
							<select name="yr" id="yr" class="form-select">
								<option value="">Year</option>
								<?php
								for($i=2015;$i<=(date('Y')+10); $i++) { ?>
									<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
								<?php } ?>
							</select>
							<script language="javascript">
								$('#mnth').val('<?php echo $mn; ?>'); $('#yr').val('<?php echo $yr; ?>');
							</script>
						</div>
					</div>
				</div>
			</div>  
 
			<div class="submit-button text-end">
				<input type="submit" class="btn btn-primary" name="Submit" value="Submit" />
				<input type="hidden" name="userid" id="userid" value="<?php if(isset($_GET['id'])){  echo $_GET['id']; } ?>" />
			</div>  
		</form>
		</div>

		<?php }  ?>


	<div class="tab-pane fade <?php if(!empty($_GET['page_index']) && $_GET['page_index']!=""){ ?> show active <?php } ?>" id="view-training" role="tabpanel" aria-labelledby="view-training-tab" tabindex="1">
		
	<?php
	$selecty=executework("select * from tob_training");
	$cnt=@mysqli_num_rows($selecty);
	if($cnt >0) { ?>
	
	<div class="table-responsive">
		<table class="table table-bordered ">
			<thead class="text-center">
				<tr>
					<th>SL No </th>
					<th>Training Programme Name </th>
					<th>No Of Trainings</th>
					<th>Schedule </th>
					<th>Schedule Month &amp; Year</th>
					<th>Status</th>
					<th style="min-width: 100px">Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$i=1;
			while($row=@mysqli_fetch_array($selecty)) {
				if(isset($row['disable']) && $row['disable']==1)
				$stat='Disabled';
				else
				$stat='Active';
			?>

			<tr>
				<td><?php echo $i ?></td>
				<td><?php echo urldecode($row['name']); ?></td>
				<td><?php echo $row['tno'] ?></td>
				<td><?php echo urldecode($row['schedule']) ?></td>
				<td><?php echo date('M', mktime(0, 0, 0, $row['mnth'], 10))." - ".$row['yr']; ?></td>
				<td><?php echo $stat ?></td>
				<td class="text-center">
					<button name="button<?php echo $row['id']; ?>" id="button<?php echo $row['id']; ?>" value="Modify" onclick="modify_user('<?php echo $row['id']; ?>');" class="btn icon-btn btn-secondary" type="button">
						<span class="material-symbols-rounded">edit</span>
					</button>
					<button type="button" name="button" id="button" value="Delete" onclick="delete_user('<?php echo $row['id']; ?>');" class="btn icon-btn btn-danger">
						<span class="material-symbols-rounded">delete</span>
					</button>
				</td>
			</tr>
		<?php $i++; } } ?>
		</tbody>
	</table>
</div>

	</div>
</div>

</main>

</section>

<?php include_once("footer.php");?>






<script>
function validation() {
	if(document.form1.name.value=="") {
		alert("Enter Name of the Training Programme");
		document.form1.name.focus();
		return false;
	}
	
	if(document.form1.tno.value=="") {
		alert("Enter No of Trainings");
		document.form1.tno.focus();
		return false;
	}
	
	if(document.form1.schedule.value=="") {
		alert("Enter Schedule of Training");
		document.form1.schedule.focus();
		return false;
	}
	
	if(document.form1.mnth.value=="") {
		alert("Select Schedule Month");
		document.form1.mnth.focus();
		return false;
	}
	
	if(document.form1.yr.value=="") {
		alert("Select Schedule Year");
		document.form1.yr.focus();
		return false;
	}
	
	return true;
}

function modify_user(id) {
	if(confirm("Are you sure to modify this information?")) {
		window.location="trainings.php?id="+id;
		return false;
	}
	else
	return false;
}
function delete_user(id) {
	if(confirm("Are you sure to delete this user information?")) {
		window.location="trainings.php?did="+id;
		return false;
	}
	else
	return false;
}
</script>

</body>
</html>