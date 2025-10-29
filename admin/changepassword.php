<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION['tobadmin']))
{
?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<title>Change Password | Welcome To TOBACCO BOARD</title>
	<?php include_once('head.php'); ?>

<script type="text/javascript">
function valid(form1)
{
	 if(trimString(document.form1.oldpass.value)=="")
	{
		alert("Enter Old Password");
		document.form1.oldpass.value="";
		document.form1.oldpass.focus();
		return false;
	}
	else if(trimString(document.form1.newpass.value)=="")
	{
		alert("Enter New Password");
		document.form1.newpass.value="";
		document.form1.newpass.focus();
		return false;
	}
	else if(trimString(document.form1.conpass.value)=="")
	{
		alert("Enter Confirm Password");
		document.form1.conpass.value="";
		document.form1.conpass.focus();
		return false;
	}
	else if((trimString(document.form1.newpass.value))!=(trimString(document.form1.conpass.value)))
	{
		alert("New Password and confirm Password Not Match");
		document.form1.conpass.value="";
		document.form1.conpass.focus();
		return false;
	}
	else 
	return true;
}	

	function trimString(str)
	{
		while (str.charAt(0) ==' ')
		str = str.substring(1);
		while (str.charAt(str.length - 1) == ' ')
		str = str.substring(0, str.length - 1);
		return str;
	}

</script>
</head>

<body>

<?php
	if (!empty($_POST['oldpass']))
	{
		$sql=executework("select password from tob_admin where admin='".$_SESSION['tobadmin']."' and password='" .$_POST['oldpass'] . "'");
		$count=@mysqli_num_rows($sql);
		if($count > 0) {
			$sq11=executework("update tob_admin set password='".$_POST['newpass'] ."' where admin='".$_SESSION['tobadmin']."'");
			$succ=1;
		}
		else {
			$exist=1;
		}
	}	
?>


<div id="adminLogin" class="container-fluid">
	<div class="row justify-content-center align-items-center">
		<div class="col-md-5 d-none d-md-block vh-100 py-3">
			<div class="login-img position-relative h-100">
				<img src="../img/login/password-change.jpg" alt="Login image" class="img-fluid rounded-4 h-100 w-100" style="object-fit: cover">
				<a class="d-inline-block position-absolute bottom-0 end-0 py-2 px-3 text-white" href="https://ssl.comodo.com" target="_blank" id="comodoTL">Comodo SSL</a>
			</div>
		</div>
		<div class="col-sm-12 col-md-7">
			<div class="form-section">
				<h1>Change Password</h1>

				<?php if (!empty($exist)) { ?>
					<div class="alert alert-danger d-flex align-items-center ms-auto" role="alert">
						<span class="material-symbols-outlined pe-2">cloud_alert</span>
						<span >The Old Password is Wrong</span>
					</div>
				<?php } ?>
				<?php if (!empty($succ)) { ?>
					<div class="alert alert-danger d-flex align-items-center ms-auto" role="alert">
						<span class="material-symbols-outlined pe-2">success</span>
						<span >The Password Changed Successfully</span>
					</div>
				<?php } ?>

				<form id="form1" name="form1" method="post" action="" onsubmit="return valid(this);">
					<div class="form-group">
						<label for="newpass" class="form-label">Old Password</label>
						<input type="password" class="form-control" id="newpass" name="newpass" required>
					</div>
					<div class="form-group">
						<label for="password" class="form-label">New Password</label>
						<input type="password" class="form-control" id="password" name="password" required>
					</div>
					<div class="form-group">
						<label for="conpass" class="form-label">Confirm Password</label>
						<input type="password" class="form-control" id="conpass" name="conpass" required>
					</div>

					<div class="d-flex gap-3">
						<a href="./adminmain.php" class="btn btn-secondary w-100"><span class="material-symbols-rounded">arrow_back</span>&nbsp;Go Back</a>
						<button type="submit" class="btn btn-primary w-100">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php include_once("footer.php");?>

<?php } else { ?>
	<script language="javascript">parent.location.href="index.php";</script>
<?php } ?>

</body>
</html>
