<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION['tobadmin'])) {

	if(!empty($_POST['subm'])) {
	
		if($_POST['disable']==1) {
			$chkds=" ,isactive=0";
			$dis=0;
		}
		else {
			$chkds=" ,isactive=1";
			$dis=1;
		}
		if($_POST['hpage']==1) {
			$chkds1=" ,home=1";
			$dis1=1;
		}
		else {
			$chkds1=" ,home=0";
			$dis1=0;
		}
		if(!empty($_POST['hpage'])) {
		$hpag=1;
		}
		else {
		$hpag=0;
		}
		if(!empty($_POST['plats'])) {
			$selplx=executework("select * from tob_platform where platform='".$_POST['plat']."' and id<>".$_POST['plats']);
			$cntx=@mysqli_num_rows($selplx);
			if($cntx>0) {
				$exst=1;
				redirect("platform.php?exst=1");
			}
			else {
				$upplx=executework("update tob_platform set platform='".$_POST['plat']."',apfno='".$_POST['apf']."',dist='".$_POST['dist']."',sno='".$_POST['sno']."',seqid=".$_POST['sno'].$chkds.$chkds1." where id='".$_POST['plats']."'");
				redirect("platform.php?succ=2");
			}
		}
		else {
			$selmax=executework("select max(id) from tob_platform");
			$rowm=@mysqli_fetch_array($selmax);
			if($rowm[0]!="")
			$max=$rowm[0]+1;
			else
			$max=1;
			
			$selpl=executework("select * from tob_platform where platform='".$_POST['plat']."'");
			$cntp=@mysqli_num_rows($selpl);
			
			$selsno=executework("select * from tob_platform where seqid='".$_POST['sno']."'");
			$cntsno=@mysqli_num_rows($selsno);
			if($cntp>0 || $cntsno>0) {
				if($cntp>0) {
				$exst=1;
				redirect("platform.php?exst=1");
				}
				if($cntsno>0) {
				$exst=2;
				redirect("platform.php?exst=2");
				}
				else 
				{
				$exst=3;
				redirect("platform.php?exst=3");
				}
			}
			else {
			
		/*$selst3=executework("select * from tob_catg where id='".$_POST[state]."'");
		$fest3=mysqli_fetch_array($selst3);
		
		$seldt3=executework("select * from tob_catg where id='".$_POST[dist]."'");
		$fedt3=mysqli_fetch_array($seldt3);*/
				$inttob=executework("insert into tob_platform values(".$max.",'".$_POST['sno']."','".$_POST['state']."','".$_POST['dist']."','".$_POST['catg']."','".$_POST['plat']."','".$_POST['plat']."','".$_POST['apf']."','".$_POST['sno']."',".$dis1.",".$dis.")");
				
				$succ=1;
				redirect("platform.php?succ=1");
			}
		}
	}
?>

<script>
function chng() {
	if(document.form1.state.value!='Karnataka') {
		document.getElementById("ct").style.visibility='visible';
		document.getElementById("ct").style.position='relative';
	}
	else
	{
		document.getElementById("ct").style.visibility='hidden';
		document.getElementById("ct").style.position='absolute';
	}
}
function chk() {
	document.form1.submit();
}
</script>

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

	function numround($st,$n) {
		if($st!="") {
			$n1=pow(10 ,$n);
			$num=round($st*$n1)/($n1);
		}
		return $num;
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  	<?php include_once("head.php")?>
	<title>Add Platform | Tobacco Board</title>
</head>
<body>

<section id="adminLayout">

	<?php include "header.php" ?>

	<?php include "sidebar.php"; ?>
	
	<main id="adminMain" class="container-fluid">
		
	<div class="row">
		<h2 class="admin-title col">Add Platform</h2>

		<div class="col-auto">
			<?php if((!empty($_GET['exst']) && $_GET['exst']==2) || (!empty($_GET['exst']) && $_GET['exst']==3) || (!empty($_GET['exst']) && $_GET['exst']==1)){ ?>
				<div class="alert alert-danger d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">warning</span>
					<?php if(!empty($_GET['exst']) && $_GET['exst']==1){ ?>
						<span> Given Platform Alredy Exist</span>
					<?php } else if(!empty($_GET['exst']) && $_GET['exst']==2){ ?>
						<span>Given Seq Id Already Exist</span>
					<?php } else if(!empty($_GET['exst']) && $_GET['exst']==3){ ?>
						<span> Given Platform And Seq Id Already Exist </span>
					<?php } ?>
				</div>
			<?php } else if((!empty($_GET['succ']) && $_GET['succ']==1) || (!empty($_GET['succ']) && $_GET['succ']==2) || (!empty($_GET['succ']) && $_GET['succ']==3) || (!empty($_GET['succ']) && $_GET['succ']==4)){ ?>
				<div class="alert alert-success d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">check_circle</span>
					<?php if(!empty($_GET['succ']) && $_GET['succ']==1){ ?>
						<span> New Platform Added Successfully</span>
					<?php } else if(!empty($_GET['succ']) && $_GET['succ']==2){ ?>
						<span> Platform Modified  Successfully </span>
					<?php } else if(!empty($_GET['succ']) && $_GET['succ']==3){ ?>
						<span> Selected Export Details Modified Successfully </span>
					<?php } else if(!empty($_GET['succ']) && $_GET['succ']==4){ ?>
						<span> Selected Export Details Deleted Successfully </span>
					<?php }  ?>
				</div>
			<?php } ?>
		</div>
	</div>
	

<form action="platform.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check(this);">
  

	<?php $selst=executework("select DISTINCT state,id from tob_states order by id"); ?>
	
	<div class="row align-items-end">
		<div class="form-group col-md-6">
			<label for="state" class="form-label">States</label>
			<select name="state" id="state" onchange="chk()"  class="form-select">
				<option value="" selected="selected">Select</option>
				<?php while($fest=@mysqli_fetch_array($selst)) { ?>
					<option value="<?php echo $fest['state'] ?>"><?php echo $fest['state'] ?></option>
				<?php } ?>
				
				<?php if(!empty($_POST['state'])) { ?>
				<script type="text/javascript">
					var ct1='<?php echo $_POST['state'] ?>';
					
					for(j=0;j<document.form1.state.options.length;j++) {
						if(document.form1.state.options[j].value==ct1)
						{
						document.form1.state.options[j].selected=true;
						}
					}
					</script>
				<?php  } ?> 
			</select>
		</div>
		<div class="form-group col-md-6" id="ct">
			<label for="catg" class="form-label">Category</label>
			<select name="catg" id="catg" onchange="chk();" class="form-select">
				<option value="NBS">NBS</option>
				<option value="CBS">CBS</option>
				<option value="SBS">SBS</option>
				<option value="SLS">SLS</option>
				<option value="NLS">NLS</option>
        	</select>
			<?php
				if(!empty($trow['catg']))
				$ct=$trow['catg'];
				else if(!empty($_POST['catg']))
				$ct=$_POST['catg'];
				else
				$ct='';

				if($ct!="") {
				?>
				<script type="text/javascript">
					var ct='<?php echo $ct ?>';
					var z;
				for(z=0;z<document.form1.catg.options.length;z++) {
					if(document.form1.catg.options[z].value==ct)
					{
						document.form1.catg.options[z].selected=true;
					}
				}
				</script>
			<?php }  ?>
		</div>

			
		<?php
		$chkd=''; $chkd1=''; $qry='';
		if(!empty($_POST['state'])) {
			if($_POST['state']!='' && $_POST['catg']!="")
			$qry=" and catg='".$_POST['catg']."'";
		
		
			$selplat=executework("select * from tob_platform where state='".$_POST['state']."' ".$qry." order by catg,seqid,apfno");
		
			//echo "select * from tob_platform where state='".$_POST[state]."' and dist='".$_POST[dist]."'".$qry." order by catg,seqid,apfno";
			// $cn=mysqli_num_rows($selplat);
			if($_POST['plats']!="") {
				$selpl=executework("select * from tob_platform where id=".$_POST['plats']);
				$rown=@mysqli_fetch_array($selpl);
				if($rown['isactive']==0)
				$chkd="checked='checked'";
				else
				$chkd="";
				if($rown['home']==1)
				$chkd1="checked='checked'";
				else
				$chkd1="";
			}
		} ?>

		<div class="form-group col-md-6">
			<label for="plats" class="form-label">Platforms</label>
			<select name="plats" id="plats" onchange="chk();" class="form-select">
          		<option value="">Select</option>
				<?php  while($rowp=@mysqli_fetch_array($selplat)) {  ?>
					<option value="<?php echo $rowp['id'] ?>"><?php echo $rowp['platform'] ?></option>
				<?php } ?>
			</select>
			
			<?php
			if(!empty($_POST['plats'])) { ?>
				<script type="text/javascript">
					var ctp='<?php echo $_POST['plats'] ?>';
					var m;
				for(m=0;m<document.form1.plats.options.length;m++) {
					if(document.form1.plats.options[m].value==ctp)
					{
						document.form1.plats.options[m].selected=true;
					}
				}
				</script>
			<?php } ?>
		</div>

		<div class="form-group col-md-6">
			<label for="plat" class="form-label">Platform Name</label>
			<input name="plat" type="text" id="plat" size="30" class="form-control" value="<?php if(!empty($rown['platform'])) echo $rown['platform']?>" />
		</div>
 
		<div class="form-group col-md-6">
			<?php
			if(!empty($_POST['state'])) {
			$seldt=executework("select * from tob_states where state='".$_POST['state']."'");
			
			$splt=executework("select  * from tob_platform where  id='".$_POST['plats']."'");
			$fetplt=mysqli_fetch_array($splt);
			
			$seldt1=executework("select * from tob_platform where state='".$_POST['state']."' and platform='".$fetplt['platform']."' and catg='".$_POST['catg']."'");
			$fedt1=mysqli_fetch_array($seldt1);
			} ?>
			<label for="dist" class="form-label">District</label>
			<select name="dist" id="dist" class="form-select">
        		<option value="">Select</option>
				<?php while($fedt=@mysqli_fetch_array($seldt)) { ?>
						<option value="<?php echo $fedt['dist'] ?>"><?php echo $fedt['dist'] ?></option>
				<?php } ?>
			</select>
	  		<?php if(!empty($_POST['dist']) || !empty($fedt1['dist'])) { ?>
                <script type="text/javascript">
				<?php 
					if(!empty($fedt1['dist'])) { ?>
					var ct='<?php echo $fedt1['dist'] ?>';
					<?php
					}
					else
					{
					?>
					 var ct='<?php echo $_POST[dist]?>';
					 <?php
					 }
					 ?>
					 
					 for(l=0;l<document.form1.dist.options.length;l++) {
						if(document.form1.dist.options[l].value==ct)
						{
							document.form1.dist.options[l].selected=true;
						}
					}
					</script>
                <?php } ?> 
		</div>
		<div class="form-group col-md-6">
			<label for="apf" class="form-label">APF No</label>
			<input name="apf" type="text" id="apf" size="30" class="form-control" value="<?php if(!empty($rown['apfno'])) echo $rown['apfno']?>" />
		</div>

		<div class="form-group col-md-6">
			<label for="sno" class="form-label">Seq No</label>
			<input name="sno" type="text" id="sno" size="30" class="form-control" value="<?php if(!empty($rown['seqid'])) echo $rown['seqid']?>" />
		</div>
		<div class="form-group col-md-6">
			<div class="form-check">
				<input class="form-check-input" name="hpage" type="checkbox" id="hpage" value="1" <?php echo $chkd1 ?> />
        		<label class="form-check-label" for="hpage">Show in homepage</label>
			</div>
			<div class="form-check">
				<input class="form-check-input" name="disable" type="checkbox" id="disable" value="1" <?php echo $chkd ?> />
        		<label class="form-check-label" for="disable">Disable</label>
			</div>
		</div>
	</div>
 
	<div class="submit-button text-end">
		<?php if(empty($_GET['edit'])){ ?>
			<input type="reset" class="btn btn-light" name="Submit2" value="Reset" />
			<input type="submit" class="btn btn-primary" name="Submit" value="Submit" />
		<?php } else { ?>
			<input type="reset" class="btn btn-light" name="Submit2" value="Cancel" onclick="back1();" />
			<input type="submit" class="btn btn-primary" name="Submit" value="Modify" />
		<?php } ?>
		
		<input name="subm" type="hidden" id="subm" />	 
		<input name="ttype" type="hidden" id="ttype" value="<?php echo $_GET['edit']?>" />
	</div>

</form>

</main>

</section>

<?php include_once("footer.php");?>



<script type="text/javascript">

function check(form1) {
	if(document.form1.state.value=="") {
		alert("State Should Not Be Empty");
		document.form1.state.focus();
		return false;
	}
	else if(document.form1.state.value=='Andhra Pradesh' && document.form1.catg.value=="") {
		alert("Category Should Not Be Empty")
		document.form1.catg.focus();
		return false;
	}
	else if(document.form1.plat.value=="") {
		alert("Platform Name Should Not Be Empty");
		document.form1.plat.focus();
		return false;
	}
	else if(document.form1.apf.value=="") {
		alert("ApfNo Should Not Be Empty");
		document.form1.apf.focus();
		return false;
	}
	else if(isNaN(document.form1.apf.value)) {
		alert("ApfNo Should  Be Numerical");
		document.form1.apf.focus();
		return false;
	}
	else if(document.form1.sno.value=="") {
		alert("Sq No Should Not Be Empty");
		document.form1.sno.focus();
		return false;
	}
	else if(isNaN(document.form1.sno.value)) {
		alert("Seq No Should  Be Numerical");
		document.form1.sno.focus();
		return false;
	}
	else
	{
		document.form1.subm.value=1;
		return true
	}
}


chng();

</script>


<?php } else { ?>
	<script language="javascript">parent.location.href="index.php";</script>
<?php } ?>


</body>
</html>