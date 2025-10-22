<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION['tobadmin'])) {
	$variety=array('FCV','Non FCV', 'Refuse Tobacco', 'Tobacco Products', 'Un Manufactured Tobacco');
	$sel=executework("select * from tob_homexport");
	$data=array();
	while($row=@mysqli_fetch_array($sel)){
		$vart=$row['variety'];
		$data[$vart]=$row;
	}

	if(!empty($_POST['subm'])){
		$selid=executework("select * from tob_gsettings where graph='Action Graph'");
		$cnt=@mysqli_num_rows($selid);
		$row=@mysqli_fetch_array($selid);
		
		$upd=executework("update tob_gsettings set export_fmonth='". make_safe($_POST['fmonth'])."',export_fyear='". make_safe($_POST['fyear'])."',export_tmonth='". make_safe($_POST['tmonth'])."',export_tyear='". make_safe($_POST['tyear'])."' where id=".$row['id']);

		for($i=0;$i<count($variety);$i++)
		{
			$vart=$variety[$i];
			$selv=executework("select * from tob_homexport where variety='".$variety[$i]."'");
			$cntv=@mysqli_num_rows($selv);
			if($cntv>0){
				$upd=executework("update tob_homexport set cqty='".$_POST['cqty'.$i]."',cvalr='".$_POST['cvalr'.$i]."',cvald='".$_POST['cvald'.$i]."',mqty='".$_POST['mqty'.$i]."', mvalr='".$_POST['mvalr'.$i]."', mvald='".$_POST['mvald'.$i]."' where variety='".$variety[$i]."'");
			}
			else
			{
				$int=executework("insert into tob_homexport (variety,cqty,cvalr,cvald,mqty,mvalr,mvald) values('".$variety[$i]."', '".$_POST['cqty'.$i]."','".$_POST['cvalr'.$i]."','".$_POST['cvald'.$i]."','".$_POST['mqty'.$i]."','".$_POST['mvalr'.$i]."','".$_POST['mvald'.$i]."')");
			}
		}
		redirect("export_gsettings.php?succ=1");
	}	
?>



<?php
	function datepattrn($a){
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
	function datepattrn1($a){
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
			<h2 class="admin-title col">Export Performance </h2>

			<div class="col-auto">
				<?php if(!empty($_GET['succ']) && $_GET['succ']=="stateexists"){ ?>
					<div class="alert alert-danger d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
						<span class="flex-shrink-0 me-2 material-symbols-rounded">warning</span>
						<span>State Already Exists</span>
					</div>
				<?php } else if(!empty($_GET['succ']) && $_GET['succ']=="distexists"){ ?>
					<div class="alert alert-danger d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
						<span class="flex-shrink-0 me-2 material-symbols-rounded">warning</span>
						<span>District Already Exists</span>
					</div>
				<?php } else if((!empty($_GET['succ']) && $_GET['succ']=="success") || (!empty($_GET['succ']) && $_GET['succ']=="distexists") || (!empty($_GET['succ']))) { ?>
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

		
	<?php $sels=executework("select * from tob_gsettings where graph='Action Graph'"); 
		  $row=@mysqli_fetch_array($sels); ?>
    
    <div class="row">
		<?php $months = array (
				array("January",1),
				array("Febrauary",2),
				array("March",3),
				array("April",4),
				array("May",5),
				array("June",6),
				array("July",7),
				array("August",8),
				array("September",9),
				array("October",10),
				array("November",11),
				array("December",12)
		); ?>

		<div class="form-group col-md-6 gap-2 d-flex align-items-center flex-wrap">

			<label for="fmonth" class="form-label w-100">From</label>
			<select name="fmonth" id="fmonth" class="form-select w-auto flex-grow-1">
				<option value="" selected>Select Month</option>
				<?php for($m=0;$m<count($months);$m++){ ?>
					<option value="<?php echo $months[$m][1]; ?>"><?php echo $months[$m][0]; ?></option>
				<?php } ?>
			</select>

			<select name="fyear" id="fyear" class="form-select w-auto flex-grow-1">
				<option value="" selected>Select Year</option>
				<?php for($y="2020";$y<=date('Y');$y++){ ?>
					<option value="<?php echo $y; ?>"><?php echo $y; ?></option>
				<?php } ?>
			</select>

			
			<?php if(!empty($row['export_fmonth'])){ ?>
				<script type="text/javascript">
					$('#fmonth').val('<?php echo $row['export_fmonth']; ?>');
				</script>
			<?php } ?>


			<?php if(!empty($row['export_fyear'])){ ?>
				<script type="text/javascript">
					$('#fyear').val('<?php echo $row['export_fyear']; ?>');
				</script>
			<?php } ?>
		</div>

		<div class="form-group col-md-6 gap-2 d-flex align-items-center flex-wrap">

			<label for="tmonth" class="form-label w-100">To</label>
			<select name="tmonth" id="tmonth" class="form-select w-auto flex-grow-1">
				<option value="" selected>Select Month</option>
				<?php for($m=0;$m<count($months);$m++){ ?>
					<option value="<?php echo $months[$m][1]; ?>"><?php echo $months[$m][0]; ?></option>
				<?php } ?>
			</select>

			<select name="tyear" id="tyear" class="form-select w-auto flex-grow-1">
				<option value="" selected>Select Year</option>
				<?php for($y="2020";$y<=date('Y');$y++){ ?>
					<option value="<?php echo $y; ?>"><?php echo $y; ?></option>
				<?php } ?>
			</select>

			
			<?php if(!empty($row['export_tmonth'])){ ?>
				<script type="text/javascript">
					$('#tmonth').val('<?php echo $row['export_tmonth']; ?>');
				</script>
			<?php } ?>
			

			<?php if(!empty($row['export_tyear'])){ ?>
				<script type="text/javascript">
					$('#tyear').val('<?php echo $row['export_tyear']; ?>');
				</script>
			<?php } ?>
		</div>
	</div>
	
	
			
	<div class="table-responsive">
		<table class="table table-bordered ">
			<thead class="text-center">
				<tr>
					<th rowspan="2">Variety</th>
					<th colspan="3">Current Month</th>
					<th colspan="3">Cummilative</th>
				</tr>
				<tr>
					<th>Qty (M.Tons)</th>
					<th>Value (Rs. Cr.)</th>
					<th>Value (M.USD)</th>
					<th>Qty (M.Tons)</th>
					<th>Value (Rs. Cr.)</th>
					<th>Value (M.USD)</th>
				</tr>
			</thead>
			<tbody>

          <?php for($i=0;$i<count($variety);$i++) {
		  	$vart=$variety[$i];
		  ?>
			<tr>
				<th> <?php echo $variety[$i]; ?> </th>
				<td>
					<div class="form-group mb-0">
						<input class="form-control" name="cqty<?php echo $i; ?>" type="text" id="cqty<?php echo $i; ?>" value="<?php if(!empty($data[$vart]['cqty'])) echo (float)$data[$vart]['cqty']; ?>" size="10" />
					</div>
				</td>
				<td>
					<div class="form-group mb-0">
						<input class="form-control" name="cvalr<?php echo $i; ?>" type="text" id="cvalr<?php echo $i; ?>" value="<?php if(!empty($data[$vart]['cvalr'])) echo (float)$data[$vart]['cvalr']; ?>" size="10" />
					</div>
				</td>
				<td>
					<div class="form-group mb-0">
						<input class="form-control" name="cvald<?php echo $i; ?>" type="text" id="cvald<?php echo $i; ?>" value="<?php if(!empty($data[$vart]['cvald'])) echo (float)$data[$vart]['cvald']; ?>" size="10" />
					</div>
				</td>
				<td>
					<div class="form-group mb-0">
						<input class="form-control" name="mqty<?php echo $i; ?>" type="text" id="mqty<?php echo $i; ?>" value="<?php if(!empty($data[$vart]['mqty'])) echo (float)$data[$vart]['mqty']; ?>" size="10" />
					</div>
				</td>
				<td>
					<div class="form-group mb-0">
						<input class="form-control" name="mvalr<?php echo $i; ?>" type="text" id="mvalr<?php echo $i; ?>" value="<?php if(!empty($data[$vart]['mvalr'])) echo (float)$data[$vart]['mvalr']; ?>" size="10" />
					</div>
				</td>
				<td>
					<div class="form-group mb-0">
						<input class="form-control" name="mvald<?php echo $i; ?>" type="text" id="mvald<?php echo $i; ?>" value="<?php if(!empty($data[$vart]['mvald'])) echo (float)$data[$vart]['mvald']; ?>" size="10" />
					</div>
				</td>
          	</tr>
          <?php } ?>
		  </tbody>
        </table>
	</div>

	
	<div class="text-center p-3">
		<input name="subm" class="btn btn-light" type="hidden" id="subm" />
		<input type="submit" class="btn btn-primary" name="Submit" value="Submit" />
	</div>
	
</form>


</main>

</section>

<?php include_once("footer.php");?>


<script>
function validate_settings(){
	var fmonth=$('#fmonth').val();
	var tmonth=$('#tmonth').val();
	var fyear=$('#fyear').val();
	var tyear=$('#tyear').val();
	
	var difference=((parseInt(tyear)-parseInt(fyear))*12)+(parseInt(tmonth)-parseInt(fmonth));
	
	var valid="";
	
	if(document.form1.fmonth.value==""){
		alert("Select from month");
		document.form1.fmonth.focus();
		return false;
	}
	else if(document.form1.fyear.value==""){
		alert("Select from year");
		document.form1.fyear.focus();
		return false;
	}
	else if(document.form1.tmonth.value==""){
		alert("Select to month");
		document.form1.tmonth.focus();
		return false;
	}
	else if(document.form1.tyear.value==""){
		alert("Select to year");
		document.form1.tyear.focus();
		return false;
	}
	
	else {
		document.form1.subm.value=1;
		return true;
	}
}
</script>

<script>
jQuery('#fdate').datepicker();
jQuery('#fdate').readOnly=true;
jQuery('#tdate').datepicker();
jQuery('#tdate').readOnly=true;
</script>


<?php } else { ?>
	<script language="javascript">parent.location.href="index.php";</script>
<?php } ?>


</body>
</html>
