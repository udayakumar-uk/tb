<?php
date_default_timezone_set("Asia/Calcutta");
		if(isset($_SESSION['tobadmin']) && $_SESSION['tobadmin']=='admin')
		{
			$detai=array('ADD','VIEW','MODIFY','DELETE','PRINT');
			$stateos=array('Andra Pradesh','Karnataka');
		}
		else if(isset($_SESSION['tobadmin']))
		{
			$sel=executework("select * from tob_employeeview where username='".$_SESSION['tobadmin']."'");
			$rowp=@mysqli_fetch_array($sel);
			$details=array($rowp['permissions']);
			foreach($details as $detail)
			$detai=explode(',',$detail);
			
			$stateos=array($rowp['state']);
			$sst=implode("','",$stateos);
			
		}
		else
		$detai=array();
		$sst=array();
	if(!empty($_SESSION['tob']) && $_SESSION['tob']=='admin')
	{
	$selectr=executework("select * from tob_admin where admin='".$_SESSION['tobadmin']."'");
	$rowtr=@mysqli_fetch_array($selectr);
	}
	if(!empty($_SESSION['tob']) && $_SESSION['tob']=='state')
	{
	$stct=executework("select * from tob_employeeview where username='".$_SESSION['tobadmin']."'");
	$rowct=@mysqli_fetch_array($stct);
	}
	if(!empty($_SESSION['tob']))
	{
		if(empty($rowct['previous_date']) || (!empty($rowtr['previous_date']) && $rowtr['previous_date']=='0000-00-00 00:00:00'))
		$apdt=$rowtr['current_dt'];
		else if(!empty($rowtr['previous_date']))
		$apdt=$rowtr['previous_date'];
		else
		$pdt='';
	}
?>

<?php
$selm=executework("select * from tob_pages where menu_id=0 and isactive=1 order by morder");
?>


<!-- Heaeder details -->
<?php
  $selectr=executework("select * from tob_admin where admin='".$_SESSION['tobadmin']."'");
  $rowtr=@mysqli_fetch_array($selectr);
?>
  
<!-- User name -->
<?php
	$userName = "";
	$lastLogin = "";
	$ipAddress = "";
	if($_SESSION['tob']=='admin') {
		$userName = $rowtr['admin'];
		$lastLogin = date('d/m/Y h:i A', strtotime($apdt));
		$ipAddress =  $rowtr['ip_address'];
	}
	if($_SESSION['tob']=='state') {
		$userName = $rowct['username'];
		$lastLogin = date('d/m/Y h:i A', strtotime($pdt));
		$ipAddress = $rowct['ip_address'];
	}

?>
  

<header id="adminHeader" class="border-bottom py-2 px-3">
	<div class="container-fluid">
		<div class="d-flex align-items-center gap-3">
			<div class="admin-navbar flex-grow-1" style="--bs-scroll-height: 100px;">
				<h4 class="text-capitalize m-0">Welcome <?php echo $userName ?> </h4>
				<small class="text-secondary d-inline-block">Last Login : <?php echo $lastLogin ?> </small>
			</div>
			
			<small class="badge text-bg-dark lh-sm rounded-pill">IP Address : <?php echo $ipAddress ?></small>
			
			<div class="nav-item dropdown">
				<a class="nav-link dropdown-toggle no-carat" href="javascript:;" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					<img src="https://avatar.iran.liara.run/public/boy?username=<?php echo $userName ?>" alt="Admin Profile" width="40" class="rounded-pill border">
				</a>
				<ul class="dropdown-menu dropdown-menu-end">
					<li><a class="dropdown-item" href="changepassword.php">Change Password</a></li>
					<li style="--bs-dropdown-link-color: rgba(var(--bs-danger-rgb));"><a class="dropdown-item" href="logout.php">Logout</a></li>
				</ul>
			</div>	
		
		</div>
	</div>

</header>

