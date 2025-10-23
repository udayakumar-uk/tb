<?php
ob_start();
session_start();
include('include/includei.php');
include('header.php');
if(!empty($_SESSION['tobadmin']))
{
?>

<?php
if(isset($_POST['Submit']) && $_POST['Submit']!="")
{
	$sel="";
	$solt="";
	for($j=0;$j<count($_POST['check_box']);$j++)
	{
		if($solt=="")
		$solt=$_POST['check_box'][$j];
		else
		$solt=$solt.','.$_POST['check_box'][$j];
	}
	for($i=0;$i<count($_POST['check_list']);$i++)//syntax is foreach($array as $value)
	{
		if($sel=="")
		$sel=$_POST['check_list'][$i];
		else
		$sel=$sel.','.$_POST['check_list'][$i];
	}
	
	if(isset($_POST['status']) && $_POST['status']!='')
	$status=1;
	else
	$status=0;
	
	if($_POST['userid']!='')
	$qr=" and id<>".$_POST['userid'];

	$select=executework("select * from tob_employeeview where username='".$_POST['username']."'".$qr);
	$cnt=@mysqli_num_rows($select);
	if($cnt>0)
	{
		redirect("employeeview.php?exst=1");
	}
	else
	{
		if($_POST['userid']!='') {
			$upd=executework("update tob_employeeview set name='".$_POST['name']."',details='".$_POST['details']."',username='".$_POST['username']."',password='".$_POST['password']."',state='".$solt."',disable='".$status."',permissions='".$sel."' where id='".$_POST['userid']."'");
			//echo "update tob_employeeview set name='".$_POST['name']."',details='".$_POST['details']."',username='".$_POST['username']."',password='".$_POST['password']."',state='".$solt."',disable='".$status."',permissions='".$sel."' where id='".$_POST['userid']."'";
			redirect("employeeview.php?succ=2");
		}
		else
		{
			$ins=executework("insert into tob_employeeview values('','".$_POST['name']."','".$_POST['details']."','".$_POST['username']."','".$_POST['password']."','".$solt."','".$status."','".$sel."','','','')");
			redirect("employeeview.php?succ=1");
		}
	}
}
$st='';
if(isset($_GET['id']) && $_GET['id']!='')
{
	$selm=executework("select * from tob_employeeview where id='".$_GET['id']."'");
	$cntm=@mysqli_num_rows($selm);
	if($cntm==0)
	redirect("employeeview.php?invalid=1");
	$rowm=@mysqli_fetch_array($selm);
	$perm=explode(',',$rowm['permissions']);
	$arr=explode(',',$rowm['state']);
	if($rowm['disable']==1)
	$st="checked='checked'";
	else
	$st='';
}

if(isset($_GET['did']) && $_GET['did']!='')
{
	$seld=executework("select * from tob_employeeview where id='".$_GET['did']."'");
	$cntd=@mysqli_num_rows($seld);
	if($cntd==0)
	redirect("employeeview.php?invalid=1");
	else
	{
		$del=executework("delete from tob_employeeview where id='".$_GET['did']."'");
		redirect("employeeview.php?del=1");
	}
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
  	<?php include_once("head.php")?>
	<title>Location | Tobacco Board</title>
</head>
<body>

<section id="adminLayout">

	<?php include "header.php" ?>

	<?php include "sidebar.php"; ?>
	
	<main id="adminMain" class="container-fluid">

	<h2 class="admin-title">Users</h2>
	
	<div id="adminTab">
	<nav>
		<div class="nav nav-tabs align-items-center" id="nav-tab" role="tablist">
			<button class="nav-link <?php if(empty($_GET['page_index'])){ ?> active <?php } ?>" id="post-tab" data-bs-toggle="tab" data-bs-target="#post-users" type="button" role="tab" aria-controls="post-member" aria-selected="true">Post Users</button>
			<button class="nav-link <?php if(!empty($_GET['page_index']) && $_GET['page_index']!=""){ ?> active <?php } ?>" id="view-tab" data-bs-toggle="tab" data-bs-target="#view-users" type="button" role="tab" aria-controls="view-member" aria-selected="false">View Users</button>

			<?php if(isset($_GET['exst']) && $_GET['exst']==1){ ?>
				<div class="alert alert-danger d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">warning</span>
					<span>User already exists with same username</span>
				</div>
					
			<?php } else if(isset($_GET['invalid']) && $_GET['invalid']==1){ ?>
				<div class="alert alert-danger d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">warning</span>
					<span>Invalid Access</span>
				</div>
			<?php } else if((isset($_GET['succ']) && $_GET['succ']==1) || (!empty($_GET['succ']) && $_GET['succ']==2) || (!empty($_GET['succ']) && $_GET['succ']==3) || (!empty($_GET['succ']) && $_GET['succ']==4)){ ?>
				<div class="alert alert-success d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">check_circle</span>
					<?php if(isset($_GET['succ']) && $_GET['succ']==1){ ?>
						<span> User created successfully </span>
					<?php } else if(isset($_GET['succ']) && $_GET['succ']==2){ ?>
						<span>User updated successfully </span>
					<?php } else if(isset($_GET['del']) && $_GET['del']==1){ ?>
						<span> User deleted successfully</span>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</nav>

	
	<div class="tab-content" id="nav-tabContent">
		<div class="tab-pane fade <?php if(empty($_GET['page_index'])){ ?> show active <?php } ?>" id="post-users" role="tabpanel" aria-labelledby="post-users-tab" tabindex="0">
			

		<form id="form1" name="form1" method="post" action="" onsubmit="return validation();">
			

		<div class="row">
			<div class="col-md-6 form-group">
				<label for="username" class="form-label">UserName</label>
				<input name="username" type="text" class="form-control" id="username" size="30" value="<?php if(isset($rowm)){ echo $rowm['username']; } ?>" />
			</div>

			<div class="col-md-6 form-group">
				<label for="password" class="form-label">Password</label>
        		<input name="password" type="text" class="form-control" id="password" size="30" value="<?php if(isset($rowm)){ echo $rowm['password']; } ?>" />
			</div>

			<div class="col-md-6 form-group">
				<label for="name" class="form-label">Name</label>
        		<input name="name" type="text" id="name" size="30" class="form-control"  value="<?php if(isset($rowm)){ echo $rowm['name']; } ?>"/>
			</div>
			
			<div class="form-group col-md-6">
				<label for="details" class="form-label">Details</label>
				<textarea name="details" cols="40" rows="4" class="form-control" id="details"><?php if(isset($rowm)){ echo $rowm['details']; } ?></textarea>
			</div>
		
			<?php
			$sroty1=executework("select * from tob_location where tfield='State' and precatid=0");
			$cnt1=@mysqli_num_rows($sroty1);
			?>
			
			<div class="form-group col-md-6">
				<label class="form-label"> States </label>
				<div class="d-flex flex-wrap gap-2 align-items-center">
			
					
				<?php if($cnt1 >0) {
					$j=1; ?>
					<?php
					while($stsdf=@mysqli_fetch_array($sroty1)) {
						//$arr=array();
						if(isset($rowm) && in_array($stsdf['id'],$arr))
						$chk1='checked="checked"';		
						else
						$chk1=''; 
					?> 
					<div class="form-check">
						<input name="check_box[]" class="form-check-input"  type="checkbox" id="check_box[]" value="<?php echo $stsdf['id']; ?>"<?php echo $chk1;?>    />
						<?php echo $stsdf['name']; ?>
					</div>  
						<?php 
						$j++;
						if($j>=5) {
							$j=1;
						?>
					<?php } } } ?>
				</div>
			</div>


		
		<?php $details=array('ADD','VIEW','MODIFY','DELETE','PRINT'); ?>
		
		<div class="form-group col-md-6">
			<label class="form-label"> Permissions(can select multiples)  </label>
			<div class="d-flex flex-wrap gap-2 align-items-center">
		
			<?php for($i=0;$i<count($details);$i++) {
				if(isset($rowm) && in_array($details[$i],$perm))
				$chk='checked="checked"';		
				else
				$chk=''; 
				?>	 
				
				<div class="form-check">
					<input name="check_list[]" type="checkbox" class="form-check-input" id="check_list[]" value="<?php echo $details[$i] ?>" <?php echo $chk; ?>  />
					<?php echo  $details[$i]; ?>
				</div>

				<?php } 
				/*foreach($_POST['check_list[]'] as $selected)
				echo "$selected";*/
				?>
				<?php
				if(!empty($rowm['disable']))
				$chked='checked="checked"';		
				else
				$chked='';
				?>

			</div>
		</div>

		
		<div class="col-md-6 form-group">
			<div class="form-check">
				<input class="form-check-input" type="checkbox" name="status" id="status" value="1" <?php echo $chked; ?> >
				<label class="form-check-label" for="status">
					Disable
				</label>
			</div> 
		</div> 
		<div class="form-group col-md-12 text-end">
			<input type="hidden" name="userid" id="userid" value="<?php if(isset($_GET['id'])){  echo $_GET['id']; } ?>" />
			<input type="submit" class="btn btn-primary" name="Submit" value="Submit" />
		</div> 

	</div>
	</form>
</div>

	<div class="tab-pane fade <?php if(!empty($_GET['page_index']) && $_GET['page_index']!=""){ ?> show active <?php } ?>" id="view-users" role="tabpanel" aria-labelledby="view-users-tab" tabindex="1">

		<?php
		$selecty=executework("select * from tob_employeeview");
		$cnt=@mysqli_num_rows($selecty);
		if($cnt >0)
		{
		?>
		
		<div class="table-responsive">
			<table class="table table-bordered ">
				<thead class="text-center">
					<tr>
						<th>S.No </th>
						<th>Name</th>
						<th>Details </th>
						<th>UserName</th>
						<th>State</th>
						<th>Permissions</th>
						<th>Status</th>
						<th style="min-width: 100px">Action</th>
					</tr>
				</thead>
				<tbody>
				 
				<?php
				$i=1;
				while($row=@mysqli_fetch_array($selecty)) {
				if($row['disable']==1)
				$stat='Disabled';
				else
				$stat='Active';
				
				$stry=$row['state'];
				//$cm=str_split($row['state'],$stry);
				//print_r($cm);
				$slet=executework("select group_concat(name) as strat from tob_location where id in(".$row['state'].")");
				//echo "select group_concat(name) as strat from tob_location where id in(".$row['state'].")";
				$rowtt=@mysqli_fetch_array($slet);
				//$slet=executework("select * group_concat('".$row['state']."') as strat from tob_location");
					
				
				//$sperm=explode(',',$rowtt['name']);
				//print_r($sperm);
				?>
				<tr class="style17">
					<td><?php echo $i ?></td>
					<td><?php echo $row['name'] ?></td>
					<td><?php echo $row['details'] ?></td>
					<td><?php echo $row['username'] ?></td>
					<td><?php echo $rowtt['strat'] ?></td>
					<td><?php echo $row['permissions'] ?></td>
					<td><?php echo $stat ?></td>
					<td class="text-center">
						<button type="button" name="button<?=$row['id']; ?>" id="button<?=$row['id']; ?>" value="Modify" onclick="modify_user('<?=$row['id']; ?>');" class="btn icon-btn btn-secondary">
							<span class="material-symbols-rounded">Edit</span>
						</button>
						<button  type="button" name="button" id="button" value="Delete" onclick="delete_user('<?=$row['id']; ?>');" class="btn icon-btn btn-danger">
							<span class="material-symbols-rounded">delete</span>
						</button>
					</td>
					
				</tr>
	<?php
	$i++;
	}
	?>
  </table>
  <?php
  }
  }
  ?>
</form>

</main>

</section>

<?php include_once("footer.php");?>


<script>
function validation()
{
	if(document.form1.name.value=="")
	{
		alert("Enter Name");
		document.form1.name.focus();
		return false;
	}
	
	if(document.form1.details.value=="")
	{
		alert("Enter Details");
		document.form1.details.focus();
		return false;
	}
	
	if(document.form1.username.value=="")
	{
		alert("Enter UserName");
		document.form1.username.focus();
		return false;
	}
	
	if(document.form1.password.value=="")
	{
		alert("Enter Password");
		document.form1.password.focus();
		return false;
	}
	
	else
	{
		var checkboxes = document.getElementsByName('check_list[]');
		var vals = "";
		 for (var i=0, n=checkboxes.length;i<n;i++)
		 {
			  if (checkboxes[i].checked) 
			  {
				vals=1;
			  }
		}
		if(vals=='') {
			alert("Provide permissions");
			return false;
		}
		return true;
	}
}

function modify_user(id)
{
	if(confirm("Are you sure to modify this user information?"))
	{
		window.location="employeeview.php?id="+id;
		return false;
	}
	else
	return false;
}
function delete_user(id)
{
	if(confirm("Are you sure to delete this user information?"))
	{
		window.location="employeeview.php?did="+id;
		return false;
	}
	else
	return false;
}
</script>

</body>
</html>
