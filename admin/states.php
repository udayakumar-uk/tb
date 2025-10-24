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
	<title>Add States | Tobacco Board</title>

	
	<script>
	function validate_sates()
	{
		if(document.form1.state.value=="")
		{
			alert("State Should Not Be Empty");
			document.form1.state.focus();
			return false;
		}
		if(document.form1.dist.value=="")
		{
			alert("District Should Not Be Empty");
			document.form1.dist.focus();
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
		if(!empty($_POST['subm']))
		{
		$selmax=executework("select max(id) from tob_states");
			$rowm=@mysqli_fetch_array($selmax);
			if($rowm[0]!="")
			$max=$rowm[0]+1;
			else
			$max=1;
			if(empty($_POST['states']) && empty($_POST['dists']))
			{
				$sst=executework("select state from tob_states where state='".$_POST['state']."'");
				$cntst=mysqli_num_rows($sst);
				
				$sdt=executework("select dist from tob_states where dist='".$_POST['dist']."'");
				$cntdt=mysqli_num_rows($sdt);
				
				if($cntst==0 && $cntdt==0)
				{			
				$instdt=executework("insert into tob_states values(".$max.",'".$_POST['state']."','".$_POST['dist']."')"); 
				$succ="success";
				}
					if($cntst > 0)
					{
					$succ="stateexists";
					}
					if($cntdt > 0)
					{
					$succ="distexists";
					}
				
			}
					if(!empty($_POST['states']) && empty($_POST['dists']))
					{			
						$dist=executework("select * from tob_states where dist='".$_POST['dist']."'");
						$cntdt=mysqli_num_rows($dist);
						if($cntdt >0)
						{
						$succ="distexists";
						}
						else
						{
							$insdt=executework("insert into tob_states values(".$max.",'".$_POST['state']."','".$_POST['dist']."')");
							$succ="success";
						}
					}
						if(!empty($_POST['states']) && !empty($_POST['dists']))
						{
							$updstate=executework("update tob_states set state='".$_POST['state']."',dist='".$_POST['dist']."' where state='".$_POST['states']."' and dist='".$_POST['dists']."'");
							
									
							$succ="success1";
							
						}
					redirect("states.php?succ=".$succ);
		}
		?>

	<div class="row">
		<h2 class="admin-title col">States Entry</h2>

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


<form id="form1" name="form1" method="post" action="states.php" onsubmit="return validate_sates();">
	 
	<?php $sels=executework("select DISTINCT state from tob_states");  ?>

	<div class="row">
		
		<div class="form-group col-md-6">
			<label for="states" class="form-label">States</label>
			<select name="states" id="states" onchange="form1.submit();" class="form-select">
				<option value="">Select</option>
				<?php while($fes=@mysqli_fetch_array($sels)) { ?>
					<option value="<?php echo $fes['state'] ?>"><?php echo $fes['state'] ?></option>
				<?php } ?>
			</select> 
			<?php
				if(!empty($_POST['states']))
				{
				?>
				<script type="text/javascript">
					var ct1='<?php echo $_POST['states'] ?>';
					
					for(j=0;j<document.form1.states.options.length;j++)
					{
						if(document.form1.states.options[j].value==ct1)
						{
						document.form1.states.options[j].selected=true;
						}
					}
				</script>
			<?php } ?>
		</div>

		<div class="form-group col-md-6">
			<label for="state" class="form-label">State</label>
			<input name="state" type="text" id="state" size="30" class="form-control" value="<?php if(!empty($_POST['states'])) echo $_POST['states'] ?>" />
		</div>

	<?php
		if(!empty($_POST['states']))
		$seld=executework("select * from  tob_states where state='".$_POST['states']."'"); 
	?>
		<div class="form-group col-md-6">
			<label for="dists" class="form-label">States</label>
			<select name="dists" id="dists" onchange="form1.submit();" class="form-select">
				<option value="">Select</option>
				<?php
				while($fed=@mysqli_fetch_array($seld))
				{
				?>
						<option value="<?php echo $fed['dist'] ?>"><?php echo $fed['dist'] ?></option>
						<?php
				}
				?>
			</select>

			<?php
					if(!empty($_POST['dists']))
					{
					?>
                <script type="text/javascript">
					 var ct1='<?php echo $_POST['dists'] ?>';
					 
					for(k=0;k<document.form1.dists.options.length;k++)
					{
						if(document.form1.dists.options[k].value==ct1)
						{
						document.form1.dists.options[k].selected=true;
						}
					}
				</script>
                <?php
					}
				?> 
	  	</div>
		<div class="form-group col-md-6">
			<label for="dist" class="form-label">District</label>
			<input name="dist" type="text" id="dist" class="form-control" value="<?php if(!empty($_POST['dists'])) echo $_POST['dists'] ?>" />
		</div>
	</div>
		
	<div class="submit-button text-end">
		<input type="submit" class="btn btn-primary" name="Submit" value="Submit" />
		<input name="subm" type="hidden" id="subm" />	
	</div>
	
</form>

</main>

</section>

<?php include_once("footer.php");?>

<?php } else { ?>
	<script language="javascript">parent.location.href="index.php";</script>
<?php } ?>


</body>
</html>
