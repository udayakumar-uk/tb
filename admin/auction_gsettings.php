<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION['tobadmin'])){

	$states=array('Andhra Pradesh','Karnataka');
	if(!empty($_POST['subm'])){
		$selid=executework("select * from tob_auctsetting");
		$cnt=@mysqli_num_rows($selid);
		$row=@mysqli_fetch_array($selid);
		
		print_r($_POST);
		
		for($i=0;$i<count($states);$i++){
			$selv=executework("select * from tob_auctsetting where state='".$states[$i]."'");
			$cntv=@mysqli_num_rows($selv);
			if($cntv>0)
			{
				$upd=executework("update tob_auctsetting set year='".$_POST['year'.$i]."',sdate='".date('Y-m-d',strtotime(str_replace('/','-',$_POST['sdate'.$i])))."',days='".$_POST['days'.$i]."',qty='".$_POST['qty'.$i]."', avg='".$_POST['avg'.$i]."', modified_by='".$_SESSION['tobadmin']."', modified_on='".date('Y-m-d H:i:s')."' where state='".$states[$i]."'");
			}
			else
			{
				$int=executework("insert into tob_auctsetting (state,year,sdate,days,qty,avg,created_by,created_on,status) values('".$states[$i]."','".$_POST['year'.$i]."', '".date('Y-m-d',strtotime(str_replace('/','-',$_POST['sdate'.$i])))."','".$_POST['days'.$i]."','".$_POST['qty'.$i]."','".$_POST['avg'.$i]."','".$_SESSION['tobadmin']."','".date('Y-m-d H:i:s')."','1')");
			}
		}
		redirect("auction_gsettings.php?succ=1");
	}
?>


	
<?php
	function datepattrn($a) {
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
	function datepattrn1($a) {
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
?>


<!DOCTYPE html>
<html lang="en">
<head>
  	<?php include_once("head.php")?>
	<title>Graph Settings | Tobacco Board</title>
	
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
			<h2 class="admin-title col">Auction Data </h2>

			<div class="col-auto">
				<?php if(!empty($_GET['succ']) && $_GET['succ']=="stateexists"){ ?>
					<div class="alert alert-danger d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
						<span class="flex-shrink-0 me-2 material-symbols-rounded">warning</span>
						<span>State Already Exists</span>
					</div>
				<?php } else if(!empty($_GET['succ']) && $_GET['succ']=="districtexists"){ ?>
					<div class="alert alert-danger d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
						<span class="flex-shrink-0 me-2 material-symbols-rounded">warning</span>
						<span>District Already Exists</span>
					</div>
				<?php } else if((!empty($_GET['succ']) && $_GET['succ']=="success") || (!empty($_GET['succ']) && $_GET['succ']==1)) { ?>
					<div class="alert alert-success d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
						<span class="flex-shrink-0 me-2 material-symbols-rounded">check_circle</span>
						<?php if(!empty($_GET['succ']) && $_GET['succ']=="success"){ ?>
							<span> Given Details Inserted Successfully</span>
						<?php } else if(!empty($_GET['succ']) && $_GET['succ']==1){ ?>
							<span>Given Details Updated Successfully</span>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>

		<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validate_settings();">


		<?php
		for($i=0;$i<count($states);$i++) {
			$sels=executework("select * from tob_auctsetting where state='".$states[$i]."'"); 
			$row=@mysqli_fetch_array($sels);

			if(!empty($row['year']))
			$year=$row['year'];
			else if(!empty($_POST['year'.$i]))
			$year=$_POST['year'.$i];
			else
			$year=date('Y');
			
			if(!empty($row['sdate']))
			$sdate=date('d/m/Y',strtotime($row['sdate']));
			else if(!empty($_POST['sdate'.$i]))
			$sdate=$_POST['sdate'.$i];
			else
			$sdate=date('d/m/Y'); ?>
			
			
		<div class="table-responsive">
			<table class="table table-bordered ">
				<thead class="text-center">
					<tr>
						<th colspan="5"><h5><?php echo $states[$i]; ?></h5></th>
					</tr>
					<tr>
						<th>Year </th>
						<th>Date </th>
						<th>Days</th>
						<th>Qty (M.Kgs)</th>
						<th>Avg Price</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<div class="form-group mb-0">
								<select class="form-select" name="year<?php echo $i; ?>" id="year<?php echo $i; ?>">
									<option value="" selected>Select</option>
									<?php
									for($y=date('Y');$y>=2000;$y--) { ?>
										<option value="<?php echo $y; ?>"><?php echo $y; ?></option>
									<?php } ?>
								</select>
							</div>
						</td>
						<td>
							<div class="form-group mb-0">
								<input class="form-control" name="sdate<?php echo $i; ?>" type="text" id="sdate<?php echo $i; ?>" value="<?php if(!empty($row['sdate'])) echo $row['sdate']; ?>" size="10" />
							</div>
						</td>
						<td>
							<div class="form-group mb-0">
								<input class="form-control" name="days<?php echo $i; ?>" type="text" id="days<?php echo $i; ?>" value="<?php if(!empty($row['days'])) echo $row['days']; ?>" size="10" />
							</div>
						</td>
						<td>
							<div class="form-group mb-0">
								<input class="form-control" name="qty<?php echo $i; ?>" type="text" id="qty<?php echo $i; ?>" value="<?php if(!empty($row['qty'])) echo $row['qty']; ?>" size="10" />
							</div>
						</td>
						<td>
							<div class="form-group mb-0">
								<input class="form-control" name="avg<?php echo $i; ?>" type="text" id="avg<?php echo $i; ?>" value="<?php if(!empty($row['avg'])) echo $row['avg']; ?>" size="10" />
							</div>
						</td>
					</tr>
				</tbody>
			</table>
      </div>
	  
    <script>
		$('#year<?php echo $i; ?>').val('<?php echo $year; ?>');
		$('#sdate<?php echo $i; ?>').val('<?php echo $sdate; ?>');
		jQuery('#sdate<?php echo $i; ?>').datepicker();
		jQuery('#sdate<?php echo $i; ?>').readOnly=true;
	</script>

    <?php } ?>

	
	<div class="text-center p-3">
		<input name="subm" class="btn btn-light" type="hidden" id="subm" />
		<input type="submit" class="btn btn-primary" name="Submit" value="Submit" />
	</div>
    
</form>



</main>

</section>


<?php include_once("footer.php");?>

<script>
	
function validate_settings() {
	document.form1.subm.value=1;
	return true;
}
</script>

<?php } else { ?>
	<script language="javascript">parent.location.href="index.php";</script>
<?php } ?>


</body>
</html>