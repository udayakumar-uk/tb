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
  	<?php include_once("head.php")?>
	<title>Graph Settings | Tobacco Board</title>
	<script src="genfunctions.js" type="text/javascript"></script>
	<script src="../jquery.ui-1.5.2/jquery-1.2.6.js" type="text/javascript"></script>
	<script src="../jquery.ui-1.5.2/ui/ui.datepicker.js" type="text/javascript"></script>
	<link href="../jquery.ui-1.5.2/themes/ui.datepicker.css" rel="stylesheet" type="text/css" />

	<script>
	function validate_settings()
	{
		var fdat=document.form1.fdate.value;
		var tdat=document.form1.tdate.value;
		if(fdat!="" && tdat!="")
		{
			var dd=fdat.substring(0,2);
			var mm=fdat.substring(3,5);
			var yy=fdat.substring(6,10);
			fdat=yy+"-"+mm+"-"+dd;
			fdatt=new Date(fdat).getTime();
			
			var dd=tdat.substring(0,2);
			var mm=tdat.substring(3,5);
			var yy=tdat.substring(6,10);
			tdat=yy+"-"+mm+"-"+dd;
			tdatt=new Date(tdat).getTime();
			if(fdatt>tdatt)
			var valid='n';
			else
			var valid='y';
		}
		else
		var valid="";
			if(document.form1.tg.value=="")
		{
			alert("Select Table / Graph")
			document.form1.tg.focus();
			return false;
		}

		if(document.form1.hstates.value=="")
		{
			alert("Select Default State For Home Page");
			document.form1.hstates.focus();
			return false;
		}
		if(document.form1.gstates.value=="")
		{
			alert("Select Default State For Graph Page");
			document.form1.gstates.focus();
			return false;
		}
		if(document.form1.hxmin.value=="")
		{
			alert("Enter Average Price Range For Home Page");
			document.form1.hxmin.focus();
			return false;
		}
		if(isNaN(document.form1.hxmin.value)==true)
		{
			alert("Enter Valid Average Price Range For Home Page");
			document.form1.hxmin.value="";
			document.form1.hxmin.focus();
			return false;
		}
		if(document.form1.hxmax.value=="")
		{
			alert("Enter Average Price Range For Home Page");
			document.form1.hxmax.focus();
			return false;
		}
		if(isNaN(document.form1.hxmax.value)==true)
		{
			alert("Enter Valid Average Price Range For Home Page");
			document.form1.hxmax.value="";
			document.form1.hxmax.focus();
			return false;
		}
		if(parseInt(document.form1.hxmax.value)<parseInt(document.form1.hxmin.value))
		{
			alert("Enter Valid Average Price Range For Home Page");
			document.form1.hxmax.value="";
			document.form1.hxmax.focus();
			return false;
		}
		
		if(document.form1.gxmin.value=="")
		{
			alert("Enter Average Price Range For Day Inforation");
			document.form1.gxmin.focus();
			return false;
		}
		if(isNaN(document.form1.gxmin.value)==true)
		{
			alert("Enter Valid Average Price Range For Day Inforation");
			document.form1.gxmin.value="";
			document.form1.gxmin.focus();
			return false;
		}
		if(document.form1.gxmax.value=="")
		{
			alert("Enter Average Price Range For Day Inforation");
			document.form1.gxmax.focus();
			return false;
		}
		if(isNaN(document.form1.gxmax.value)==true)
		{
			alert("Enter Valid Average Price Range For Day Inforation");
			document.form1.gxmax.value="";
			document.form1.gxmax.focus();
			return false;
		}
		if(parseInt(document.form1.gxmax.value)<parseInt(document.form1.gxmin.value))
		{
			alert("Enter Valid Average Price Range For Day Inforation");
			document.form1.gxmax.value="";
			document.form1.gxmax.focus();
			return false;
		}

		if(document.form1.cxmin.value=="")
		{
			alert("Enter Average Price Range For Cumulative");
			document.form1.cxmin.focus();
			return false;
		}
		if(isNaN(document.form1.cxmin.value)==true)
		{
			alert("Enter Valid Average Price Range For Cumulative");
			document.form1.cxmin.value="";
			document.form1.cxmin.focus();
			return false;
		}
		if(document.form1.cxmax.value=="")
		{
			alert("Enter Average Price Range For Cumulative");
			document.form1.cxmax.focus();
			return false;
		}
		if(isNaN(document.form1.cxmax.value)==true)
		{
			alert("Enter Valid Average Price Range For Cumulative");
			document.form1.cxmax.value="";
			document.form1.cxmax.focus();
			return false;
		}
		if(parseInt(document.form1.cxmax.value)<parseInt(document.form1.cxmin.value))
		{
			alert("Enter Valid Average Price Range For Cumulative");
			document.form1.cxmax.value="";
			document.form1.cxmax.focus();
			return false;
		}
		if(document.form1.fdate.value=="")
		{
			alert("Enter Date Range");
			document.form1.fdate.focus();
			return false;
		}
		if(document.form1.tdate.value=="")
		{
			alert("Enter Date Range");
			document.form1.tdate.focus();
			return false;
		}
		else if(valid!="" && valid=='n')
		{
			alert("Invalid Date Range");
			document.form1.tdate.focus();
			return false;
		}
		else
		{
			document.form1.subm.value=1;
			return true;
		}
	}
	</script>

</head>
<body>

<section id="adminLayout">

	<?php include "header.php" ?>

	<?php include "sidebar.php"; ?>
	
	<main id="adminMain" class="container-fluid">
		

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
if(!empty($_POST['subm']))
{
	$selmax=executework("select max(id) from tob_gsettings");
	$rowm=@mysqli_fetch_array($selmax);
	if($rowm[0]!="")
	$max=$rowm[0]+1;
	else
	$max=1;
	
	$selid=executework("select * from tob_gsettings where graph='Action Graph'");
	//echo "select * from tob_gsettings where graph='Action Graph'";
	$cnt=@mysqli_num_rows($selid);
	if($cnt>0)
	{
		$row=@mysqli_fetch_array($selid);
		$upd=executework("update tob_gsettings set tg='".$_POST['tg']."',dstate_home='".$_POST['hstates']."',dstate_graph='".$_POST['gstates']."',min1='".$_POST['hxmin']."',max1='".$_POST['hxmax']."',min2='".$_POST['gxmin']."',max2='".$_POST['gxmax']."',min3='".$_POST['cxmin']."',max3='".$_POST['cxmax']."',fdate='".datepattrn1($_POST['fdate'])."',tdate='".datepattrn1($_POST['tdate'])."' where id=".$row['id']);
		//echo "update tob_gsettings set tg='".$_POST['tg']."',dstate_home='".$_POST['hstates']."',dstate_graph='".$_POST['gstates']."',min1='".$_POST['hxmin']."',max1='".$_POST['hxmax']."',min2='".$_POST['gxmin']."',max2='".$_POST['gxmax']."',min3='".$_POST['cxmin']."',max3='".$_POST['cxmax']."',fdate='".datepattrn1($_POST['fdate'])."',tdate='".datepattrn1($_POST['tdate'])."' where id=".$row['id'];
	}
	else
	{
//		$int=executework("insert into values(".$max.",'Action Graph'
	}
	$succ="success1";
	redirect("gsettings.php?succ=".$succ);
}
?>


	<div class="row">
		<h2 class="admin-title col">Auction Graph</h2>

		<div class="col-auto">
			<?php if((!empty($_GET['succ']) && $_GET['succ']=="stateexists") || (!empty($_GET['succ']) && $_GET['succ']=="distexists")){ ?>
				<div class="alert alert-danger d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">warning</span>
					<?php if(!empty($_GET['succ']) && $_GET['succ']=="stateexists"){ ?>
						<span> State Already Exists</span>
					<?php } else if(!empty($_GET['succ']) && $_GET['succ']=="distexists"){ ?>
						<span>District Already Exists</span>
					<?php } ?>
				</div>
			<?php } else if((!empty($_GET['succ']) && $_GET['succ']=="success") || (!empty($_GET['succ']) && $_GET['succ']=="success1")){ ?>
				<div class="alert alert-success d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">check_circle</span>
					<?php if(!empty($_GET['succ']) && $_GET['succ']=="success"){ ?>
						<span> Given Details Inserted Success fully</span>
					<?php } else if(!empty($_GET['succ']) && $_GET['succ']=="success1"){ ?>
						<span> Given Details Updated Successfully </span>
					<?php }  ?>
				</div>
			<?php } ?>
		</div>
	</div>




<form id="form1" name="form1" method="post" action="gsettings.php" onsubmit="return validate_settings();">
	


	<?php
		$sels=executework("select * from tob_gsettings where graph='Action Graph'"); 
		$row=@mysqli_fetch_array($sels);
	?>
	
	<div class="row">
		
		<div class="form-group col-md-6">
			<h5 class="text-primary">Default in Home Page</h5>
			<label for="states" class="form-label">Home Page</label>
			<select name="tg" id="tg" class="form-select">
				<option value="">Select</option>
				<option value="Table">Table</option>
				<option value="Graph">Graph</option>
			</select>
		</div>
		<?php if(!empty($row['tg'])) { ?>
			<script>sel_combo('tg','<?php echo $row['tg'] ?>');</script>
		<?php  }  ?>

		<div class="form-group col-md-12 row">
			<h5 class="text-primary">Default State</h5>
		
			<?php
				$selht=executework("select * from tob_employeeview where username='".$_SESSION['tobadmin']."'");
				$rowty=@mysqli_fetch_array($selht);
					$details=array($rowty['permissions']);
					foreach($details as $detail)
					$detai=explode(',',$detail);
			?>

			<div class="form-group col-md-6">
				<label for="hstates" class="form-label">Home Page</label>
      			<select name="hstates" id="hstates" class="form-select">
					<?php
					if($_SESSION['tobadmin']=='admin' || in_array('Andhra Pradesh',$detai) || in_array('Karnataka',$detai))
					{
					?>
					<option value="">Select</option>
					<?php
					}
					if((isset($_SESSION['tobadmin']) && $_SESSION['tobadmin']=='admin') || in_array('Andhra Pradesh',$detai))
					{
					?>
					<option value="Andhra Pradesh">Andhra Pradesh</option>
					<?php
					}
					if((isset($_SESSION['tobadmin']) && $_SESSION['tobadmin']=='admin') || in_array('Karnataka',$detai))
					{
					?>
					<option value="Karnataka">Karnataka</option>
					<?php
					}
					?>
				</select>
      			<script>sel_combo('hstates','<?php echo $row['dstate_home'] ?>');</script>
			</div>
			<div class="form-group col-md-6">
				<label for="gstates" class="form-label">Graph Page</label>
      			<select name="gstates" id="gstates" class="form-select">
					<?php
					if($_SESSION['tobadmin']=='admin' || in_array('Andhra Pradesh',$detai) || in_array('Karnataka',$detai))
					{
					?>
					<option value="">Select</option>
					<?php
					}
					if((isset($_SESSION['tobadmin']) && $_SESSION['tobadmin']=='admin') || in_array('Andhra Pradesh',$detai))
					{
					?>
					<option value="Andhra Pradesh">Andhra Pradesh</option>
					<?php
					}
					if((isset($_SESSION['tobadmin']) && $_SESSION['tobadmin']=='admin') || in_array('Karnataka',$detai))
					{
					?>
					<option value="Karnataka">Karnataka</option>
					<?php
					}
					?>
				</select>
				<script>sel_combo('gstates','<?php echo $row['dstate_graph'] ?>');</script>
			</div>
		</div>
		<div class="col-md-12 row">
			<h5 class="text-primary">Average Price Range</h5>
			<div class="form-group col-md-6">
				<label for="hxmin" class="form-label">Home Page</label>
				<div class="d-flex gap-3">
					<div class="input-group">
						<span class="input-group-text">Min</span>
						<input name="hxmin" class="form-control" type="text" id="hxmin" value="<?php echo $row['min1'] ?>" size="10" />
					</div>
					<div class="input-group">
						<span class="input-group-text">Min</span>
						<input name="hxmax" class="form-control" type="text" id="hxmax" value="<?php echo $row['max1'] ?>"  />
					</div>
				</div>
			</div>
			<div class="form-group col-md-6">
				<label for="gxmin" class="form-label">Graph Page Day</label>
				<div class="d-flex gap-3">
					<div class="input-group">
						<span class="input-group-text">Min</span>
						<input name="gxmin" class="form-control" type="text" id="gxmin" value="<?php echo $row['min2'] ?>" size="10" />
					</div>
					<div class="input-group">
						<span class="input-group-text">Min</span>
						<input name="gxmax" class="form-control" type="text" id="gxmax" value="<?php echo $row['max2'] ?>"  />
					</div>
					</div>
			</div>
			<div class="form-group col-md-6">
				<label for="cxmin" class="form-label">Graph Page Cumulative</label>
				<div class="d-flex gap-3">
				<div class="input-group">
					<span class="input-group-text">Min</span>
					<input name="cxmin" class="form-control" type="text" id="cxmin" value="<?php echo $row['min3'] ?>" size="10" />
				</div>
				<div class="input-group">
					<span class="input-group-text">Min</span>
					<input name="cxmax" class="form-control" type="text" id="cxmax" value="<?php echo $row['max3'] ?>"  />
				</div>
				</div>
			</div>
		</div>
		<div class="col-md-12 row">
			<h5 class="text-primary">Dates Range</h5>
			<div class="form-group col-md-6">
				<label for="fdate" class="form-label">Home Page</label>
				<div class="d-flex gap-3">
				<div class="input-group">
					<span class="input-group-text">From</span>
					<input name="fdate" class="form-control" size="20" type="text" id="fdate" value="<?php echo datepattrn($row['fdate']) ?>" />
				</div>
				<div class="input-group">
					<span class="input-group-text">To</span>
					<input name="tdate" class="form-control" type="text" id="tdate" value="<?php echo datepattrn($row['tdate']) ?>"  />
				</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="submit-button text-end">
		<input type="submit" class="btn btn-primary" name="Submit" value="Submit" />
		<input name="subm" type="hidden" id="subm" />
	</div>
    
	
</form>

</main>

</section>

<script>
jQuery('#fdate').datepicker();
jQuery('#fdate').readOnly=true;
jQuery('#tdate').datepicker();
jQuery('#tdate').readOnly=true;
</script>
<?php include_once("footer.php");?>

<?php } else { ?>
	<script language="javascript">parent.location.href="index.php";</script>
<?php } ?>


</body>
</html>
