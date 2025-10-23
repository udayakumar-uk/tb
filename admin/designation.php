<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(isset($_SESSION["tobadmin"]) && $_SESSION['tobadmin']=='admin') { ?>


<!DOCTYPE html>
<html lang="en">
<head>
  	<?php include_once("head.php")?>
	<title>Designation | Tobacco Board</title>
</head>
<body>

<section id="adminLayout">

	<?php include "header.php" ?>

	<?php include "sidebar.php"; ?>
	
	<main id="adminMain" class="container-fluid">


	<?php if(isset($_POST['Submit']) && $_POST['Submit']!="") {
		if($_POST['tid']!="") {
		executework("update tob_designation set designation='".mysqli_real_escape_string($_POST['designation'])."' where id='".mysqli_real_escape_string($_POST['tid'])."'");
			redirect("designation.php?succ=2");
		}
		else {
		executework("insert into tob_designation value('','".mysqli_real_escape_string($_POST['designation'])."')");
			redirect("designation.php?succ=1");
		}	
	}
	if(isset($_GET['did']) && $_GET['did']!="") {
		executework("delete from tob_designation where id='".mysqli_real_escape_string($_GET['did'])."'");
		redirect("designation.php?del=1");
	}
	if(isset($_GET['succ']) && $_GET['succ']==1)
	$message="Designation added successfully";
	else if(isset($_GET['succ']) && $_GET['succ']==2)
	$message="Designation updated successfully";
	else if(isset($_GET['del']) && $_GET['del']==1)
	$message="Designation deleted successfully";
	else
	$message='';
	?>

	<div class="row">
		<h2 class="admin-title col">Designation </h2>

		<div class="col-auto">
			<?php if($message!=''){ ?>
				<div class="alert alert-success d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">check_circle</span>
					<span><?php echo $message; ?></span>
				</div>
			<?php } ?>
		</div>
	</div>


	<form id="form1" name="form1" method="post" action="">
		<?php if(isset($_GET['mid']) && $_GET['mid']!='') {
			$selty=executework("select * from tob_designation where id='".mysqli_real_escape_string($_GET['mid'])."'");
			$rowty=@mysqli_fetch_array($selty);
		} ?>

		<div class="row align-items-end">
			<div class="form-group col-md-6">
				<label for="designation">Add Designation</label>
				<input name="designation" type="text" id="designation" class="form-control" size="40" value="<?php if(isset($rowty)) echo $rowty['designation'] ?>" />
			</div>
			<div class="form-group col-md-6">
				<input name="tid" type="hidden" id="tid" value="<?php if(isset($_GET['mid'])) echo $_GET['mid'] ?>" />
				<input type="submit" class="btn btn-primary" name="Submit" value="Submit" />
			</div>
		</div>



	<div class="table-responsive">
		<table class="table table-bordered ">
			<thead class="text-center">
				<tr>
					<th>SL No </th>
					<th>Designation</th>
					<th style="min-width: 100px">Actions</th>
				</tr>
			</thead>
			<tbody>
				
			<?php
				$sel=executework("select * from tob_designation");
				$i=1;
			while($row=@mysqli_fetch_array($sel)) { ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $row['designation'] ?></td>
 
				<td class="text-center">
					<a href="designation.php?mid=<?php echo $row['id'] ?>" class="btn icon-btn btn-secondary" type="button">
						<span class="material-symbols-rounded">Edit</span>
					</a>
					<a href="designation.php?did=<?php echo $row['id'] ?>" class="btn icon-btn btn-danger" type="button">
						<span class="material-symbols-rounded">delete</span>
					</a>
				</td>
			</tr>
		<?php $i++; } ?>
		</tbody>
  </table>
</form>

</main>

</section>

<?php include_once("footer.php");?>

<script>
	function validate() {
		if(document.form1.designation.value=="") {
			alert("Enter Designation");
			document.form1.designation.focus();
			return false;
		}
		else {
			return true;
		}
	}
</script>


<?php } else { ?>
	<script language="javascript">parent.location.href="index.php";</script>
<?php } ?>

</body>
</html>