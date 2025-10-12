<?php
ob_start();
session_start();
error_reporting(0);
header('X-Frame-Options: SAMEORIGIN');
header('Cache-control: private');
include_once('include/includei.php');
include('nocsrf.php');
?>


<?php
// result=csrf_token_check();
$result = 'Done';
if (!empty($result) && $result === 'Done') {
		if (isset($_POST['userid']) && !empty($_POST['userid'])) {
				$intst00 = executework("select * from tob_admin where admin='" . $_POST['userid'] . "' and password='" . $_POST['password'] . "'");
				$countst00 = @mysqli_num_rows($intst00);
				if ($countst00 > 0) {
						$row00 = @mysqli_fetch_array($intst00);
						$_SESSION['tobadmin'] = $_POST['userid'];
						$_SESSION['tob'] = 'admin';
						$ins = executework("update tob_admin set previous_date ='" . $row00['current_dt'] . "', current_dt='" . date('Y-m-d H:i:s') . "', ip_address ='" . $_SERVER['REMOTE_ADDR'] . "' where admin ='" . $_SESSION['tobadmin'] . "'");
						redirect('adminmain.php');
				} else {
						$intst000 = executework("select * from tob_employeeview where username ='" . $_POST['userid'] . "' and password ='" . $_POST['password'] . "' and disable=0");
						$countst000 = @mysqli_num_rows($intst000);
						$rowt = @mysqli_fetch_array($intst000);
						if ($rowt['permissions'] == 'VIEW,PRINTt' || $rowt['permissions'] == 'PRINT,VIEWt') {
								$exist = 1;
						} elseif ($countst000 > 0) {
								$_SESSION['tobadmin'] = $_POST['userid'];
								$_SESSION['tob'] = 'state';
								$update = executework("update tob_employeeview set previous_date ='" . $rowt['current_dt'] . "', current_dt='" . date('Y-m-d H:i:s') . "', ip_address ='" . $_SERVER['REMOTE_ADDR'] . "' where username ='" . $_SESSION['tobadmin'] . "'");
								redirect('adminmain.php');
						} else {
								$exist = 1;
						}
				}
		}
}

$token = NoCSRF::generate('csrf_token'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<title>Administrator Login | Welcome To TOBACCO BOARD</title>
	<?php include_once('head.php'); ?>

	<script language="JavaScript">
		function funcheck(form) {
				if (form.userid.value == "") {
						alert('Enter Userid');
						document.f1.userid.focus();
						return false;
				} else if (form.password.value == "") {
						alert('Enter Password');
						document.f1.password.focus();
						return false;
				}
				return true;
		}
	</script>
</head>

<body>

<div id="adminLogin" class="container-fluid">
	<div class="row justify-content-center align-items-center">
		<div class="col-md-5 d-none d-md-block vh-100 py-3">
			<div class="login-img position-relative h-100">
				<img src="../img/login/login.webp" alt="Login image" class="img-fluid rounded-4 h-100 w-100" style="object-fit: cover">
				<a class="d-inline-block position-absolute bottom-0 end-0 py-2 px-3 text-white" href="https://ssl.comodo.com" target="_blank" id="comodoTL">Comodo SSL</a>
			</div>
		</div>
		<div class="col-sm-12 col-md-7">
			<div class="form-section">
				<h1>Administrator Login</h1>

				<?php if (isset($exist) && $exist != "") { ?>
					<div class="alert alert-danger d-flex align-items-center" role="alert">
						<span class="material-symbols-outlined pe-2">cloud_alert</span>
						<span >Invalid Login</span>
					</div>
				<?php } ?>
				<?php if (!empty($msg)) { echo '<div class="alert alert-warning" role="alert">' . $msg . '</div>'; } ?>

				<form action="" method="post" name="f1" id="f1" onsubmit="return funcheck(this)">
					<div class="mb-3">
						<label for="userid" class="form-label">User</label>
						<input type="text" class="form-control" id="userid" name="userid" required>
					</div>
					<div class="mb-3">
						<label for="password" class="form-label">Password</label>
						<input type="password" class="form-control" id="password" name="password" required>
					</div>

					<div class="mb-3" style="display:none;">
						<label class="form-label">Validation code</label>
						<div>
							<img src="captcha.php?rand=<?php echo rand();?>" id="captchaimg" alt="captcha"><br>
							<small class="form-text text-muted">Enter the code above here</small>
							<input id="captcha_code" name="captcha_code" type="text" class="form-control mt-2">
							<small class="form-text text-muted">Can't read the image? <a href="javascript: refreshCaptcha();">refresh</a></small>
						</div>
					</div>

					<input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
					<div class="d-grid">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<script type='text/javascript'>
function refreshCaptcha(){
		var img = document.images['captchaimg'];
		img.src = img.src.substring(0,img.src.lastIndexOf('?')) + '?rand=' + Math.random()*1000;
}
</script>

</body>
</html>