<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION['tobadmin']))
{
?>


<script type="text/javascript">
function valid(form1)
{
	if(document.form1.stype.value=="")
	{
		alert("Slide No Should Not Be Empty");
		document.form1.stype.focus();
		return false;
	}
	else if((document.form1.stype.value=='slide4' || document.form1.stype.value=='slide5' || document.form1.stype.value=='slide6') && document.getElementById("image1").value=="")
	{
		alert("Browse Slide Image");
		document.getElementById("image1").focus();
		return false;
	}
	else if((document.form1.stype.value=='slide1' || document.form1.stype.value=='slide2' || document.form1.stype.value=='slide3') && document.getElementById("image1").value=="" && document.getElementById("image2").value=="")
	{
		alert("Browse Slide Image");
		return false;
	}
/*	else if(document.getElementById("image1").value=="")
	{
		alert("Browse Slide Image1");
		document.getElementById("image1").focus();
		return false;
	}
*/	else
	{
		if(document.form1.stype.value=='slide1' || document.form1.stype.value=='slide2' || document.form1.stype.value=='slide3')
		var k=2;
		else
		var k=1;
		for(i=1;i<=k;i++)
		{
			var pimage="image"+i;
			var pi=document.getElementById(pimage).value;
			var plen=pi.length;
			var ppos=pi.indexOf(".");
			var ext=pi.substr(ppos+1,plen);
			var ext1=ext.toLowerCase();		

				if(ext1!='jpg' && ext1!='jpeg' && ext1!='gif' && document.getElementById(pimage).value!="")
				{
					alert("Only file types of jpg,jpeg,gif are allowed for Slide Image");
					document.getElementById(pimage).value="";
					document.getElementById(pimage).focus();
					return false;
				}
		}
		document.form1.subm_slide.value=1;
		return true;	
	}
}
function chng()
{
	document.form1.submit();
}
</script>


<?php
	if(!empty($_POST['subm_slide']))
	{
		$sel=executework("select * from tob_imageslide where slideno='".$_POST['stype']."'");
		$rsel=@mysqli_fetch_array($sel);
		
		$cnt1=2;
		for($i=1;$i<=$cnt1;$i++)
		{
			$pimage="image".$i; 
				$id="ids".$i;
				$target_pathn ="slide_images/";
				$dimage="slide_images/".$rsel[$pimage];
				$f1="";
				$f2="";
				if (!empty($_FILES[$pimage]['name']))
				{
					if(!empty($rsel[$pimage]))
					unlink($dimage);

					$f1= basename($_FILES[$pimage]['name']); 
					$target_pathsmn = $target_pathn .$rsel[id]."_".$i.basename( $_FILES[$pimage]['name']); 
					$f1=$rsel[id]."_".$i.basename( $_FILES[$pimage]['name']); 
					if(file_exists($f1))
					unlink($f1);
					move_uploaded_file($_FILES[$pimage]['tmp_name'], $target_pathsmn);
					$f2=" $pimage='$f1'";
					
				$add="slide_images/$f1";
				$tsrc="slide_images/$f1";
		
				$n_width=163; // Fix the width of the thumb nail images
				$n_height=129; // Fix the height of the thumb nail imaage
				if ($_FILES[$pimage][type]=="image/gif")
				{
				$im=ImageCreateFromGIF($add);
				$width=ImageSx($im); // Original picture width is stored
				$height=ImageSy($im); // Original picture height is stored
				$newimage=imagecreatetruecolor($n_width,$n_height);
				imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
				if (function_exists("imagegif")) 
				Header("Content-type: image/gif");
				ImageGIF($newimage,$tsrc);
				chmod("$tsrc",0777);
				}////////// end of gif file thumb nail creation//////////
				
				////////////// starting of JPG thumb nail creation//////////
				if($_FILES[$pimage]['type']=="image/jpeg"){
				$im=ImageCreateFromJPEG($add);
				$width=ImageSx($im); // Original picture width is stored
				$height=ImageSy($im); // Original picture height is stored
				$newimage=imagecreatetruecolor($n_width,$n_height);
				imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
				ImageJpeg($newimage,$tsrc);
				chmod("$tsrc",0777);
				}
					
				}	
					$selp=executework("update tob_imageslide set $f2 where slideno='".$_POST['stype']."'");
				$succ=$i;
			}
			if(!empty($succ))
			redirect("upload_slides.php?succ=1");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  	<?php include_once("head.php")?>
	<title>Upload Slides | Tobacco Board</title>

</head>


<body>
	
<section id="adminLayout">

	<?php include "header.php" ?>

	<?php include "sidebar.php"; ?>

	<main id="adminMain" class="container-fluid">

		<div class="row">
			<h2 class="admin-title col">Update Slide Images </h2>

			<div class="col">
				<?php if(!empty($_GET['succ'])) { ?>
					<div class="alert alert-success d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
						<span class="flex-shrink-0 me-2 material-symbols-rounded">check_circle</span>
						<span> Slide Images Updated Successfully </span>
					</div>
				<?php } ?>
			</div>
		</div>


		<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return valid(this);">

		
			<div class="form-group">
				<label for="stype" class="form-label">Slide No </label>
				<select name="stype" id="stype" onchange="chng();" class="form-select w-auto">
					<option value="" selected>Select Slide</option>
					<option value="slide1">Slide 1</option>
					<option value="slide2">Slide 2</option>
					<option value="slide3">Slide 3</option>
					<option value="slide4">Slide 4</option>
					<option value="slide5">Slide 5</option>
					<option value="slide6">Slide 6</option>
				</select>

				<?php if(!empty($_REQUEST['stype'])) { ?>
					<script language="JavaScript" type="text/javascript">
						var stype='<?php echo $_REQUEST['stype'] ?>';
						var i;
						for(i=0;i<document.form1.stype.options.length;i++) {
							if(document.form1.stype.options[i].value==stype)
							{
								document.form1.stype.options[i].selected=true;
							}
						}
					</script>
				<?php } ?>
			</div>


			<?php if(!empty($_POST['stype']))	{
				$select=executework("select * from tob_imageslide where slideno='". $_POST['stype'] ."'");
				$srow=@mysqli_fetch_array($select);
			} ?>

			<div class="row">

				<div class="col-md-4">
					<div class="box-shadow p-3 bg-white">
						<div class="form-group">
							<p for="image1" class="text-secondary">Image 1 </p>
							<?php if(!empty($srow['image1'])) {?>
								<img src="slide_images/<?php echo $srow['image1'];?>" width="100" height="100" class="rounded-3" />
							<?php }?>
						</div>

						<div class="input-group form-group mb-0">
							<input name="image1" type="file" id="image1" class="form-control" />
							<label class="input-group-text" for="image1">Upload File</label>
						</div>
					</div>
				</div>

			<?php if(!empty($_POST['stype']) && ($_POST['stype']=='slide1' || $_POST['stype']=='slide2' || $_POST['stype']=='slide3')) { ?>
				
				<div class="col-md-4">
					<div class="box-shadow p-3 bg-white">
						<div class="form-group">
							<p for="image2" class="text-secondary">Image 2 </p>
							<?php if(!empty($srow['image2'])) {?>
								<img src="slide_images/<?php echo $srow['image2'];?>" width="100" height="100" class="rounded-3" />
							<?php }?>
						</div>

						<div class="input-group form-group mb-0">
							<input name="image2" type="file" id="image2" class="form-control" />
							<label class="input-group-text" for="image2">Upload File</label>
						</div>
					</div>
				</div>
			<?php }	?>
			
			</div>


			<div class="submit-button text-end">
				<input name="subm_slide" type="hidden" id="subm_slide" />
				<input name="type" type="hidden" id="type" value="new" />
				<input type="submit" class="btn btn-primary" name="Submit" value="Update" />
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