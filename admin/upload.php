<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION['tobadmin'])) {
	if(!empty($_FILES['fil']['name'])) 
	{
			$path=$_SERVER['DOCUMENT_ROOT'];
			
			$sel=executework("select max(id) from tob_upload");
			$fe=mysqli_fetch_array($sel);
			if($fe[0]!="")
			{
			$maxid=$fe[0]+1;
			}
			else
			{
			$maxid=1;
			}
		
			if(!empty($_POST['eng_path']))
			$target_path=$path."/".$_POST['eng_path'];                                                                                                               
			if(!empty($_POST['hindi_path']))
			$target_path=$path."/".$_POST['hindi_path'];
			$nam1=basename($_FILES['fil']['name']);
				$len1=strlen($nam1);
				$pos1=strrpos($nam1,'.');
				$sub1=substr($nam1,$pos1,$len1);
				$mapimg1=$nam1;
				$target_pathsm1=$target_path.$mapimg1;
		
		//echo "Target_path=".$target_pathsm1;
		if(file_exists($target_pathsm1))
		{
		  unlink($target_pathsm1);
		}
		
	move_uploaded_file($_FILES['fil']['tmp_name'],$target_pathsm1);
	
		//$ins=executework("insert into tob_upload values('".$maxid."','".$iamg."',1)");
				$se=1;
		redirect("upload.php?sec=".$se);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  	<?php include_once("head.php")?>
	<title>Upload | Tobacco Board</title>
</head>
<body>

<section id="adminLayout">

	<?php include "header.php" ?>

	<?php include "sidebar.php"; ?>
	
	<main id="adminMain" class="container-fluid">

	<div class="row">
		<h2 class="admin-title col">Dollar Value </h2>

		<div class="col-auto">
			<?php if(!empty($_GET['sec']) && $_GET['sec']==1){ ?>
				<div class="alert alert-success d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">check_circle</span>
					<span>File Successfully Uploaded</span>
				</div>
			<?php } ?>
		</div>
	</div>
	
	<form  method="post" enctype="multipart/form-data" name="form1" id="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return false;">
          
		<div class="row align-items-end">
			<div class="form-group col-md-6">
				<label for="lang" class="form-label">Language</label>
				<select name="lang" id="lang" onchange="get_lang(this.value);" class="form-select">
					<option value="" selected>Select Language </option>
					<option value="english">English</option>
					<option value="hindi">Hindi</option>
				</select>
			</div>
			<div class="form-group col-md-6" id="eng_path" style="display:none;">
				<label for="eng_path" class="form-label">Path</label>
				<select name="eng_path" id="eng_path" class="form-select">
					<option value="" selected>Select Path </option>
					<option value="tbdata/pdf/">pdf</option>
					<option value="tbdata/images/">Images</option>
				</select>
			</div>
			<div class="form-group col-md-6" id="hindi_path" style="display:none;">
				<label for="hindi_path" class="form-label">Path</label>
				<select name="hindi_path" id="hindi_path" class="form-select">
					<option value="">Select Path</option>
					<option value="tbdata/hindi/pdf">pdf</option>
					<option value="tbdata/hindi/images/">Images</option>
					<option value="tbdata/hindi/members/">Members</option>
				</select>
			</div>
			<div class="form-group col-md-6">
				<div class="input-group">
					<input name="fil" type="file" id="fil" class="form-control">
					<label class="input-group-text" for="fil">Upload File</label>
				</div>
			</div>


			<div class="submit-button text-end mb-3">
				<?php if(empty($_GET['edit'])){ ?>
					<input type="reset" class="btn btn-light" name="Submit2" value="Reset" />
					<input type="submit" class="btn btn-primary" name="Submit" id="Submit" value="Submit" onclick="check_file();"  />
				<?php } else { ?>
					<input type="reset" class="btn btn-light" name="Submit2" value="Cancel" onclick="back1();" />
					<input type="submit" class="btn btn-primary" name="Submit" value="Modify" />
				<?php } ?>
					<input name="subm" type="hidden" id="subm" />	 
					<input name="ttype" type="hidden" id="ttype" value="<?php if(!empty($_GET['edit'])) echo $_GET['edit']; ?>" />
			</div>
		</div> 
		 
    </form>
		

</main>

</section>

<?php include_once("footer.php");?>


<script type="text/javascript">
function get_lang(lang) {
	
	if(lang=='english') {
		$("#hindi_path").hide();
		$("#eng_path").show();
	}
	else if(lang=='hindi') {
		$("#eng_path").hide();
		$("#hindi_path").show();
	}
	
}
function check_file() {
	//alert("hihi");
	if($('select#eng_path option:selected').val()!='')
	var path=$('select#eng_path option:selected').val();
	if($('select#hindi_path option:selected').val()!='')
	var path=$('select#hindi_path option:selected').val();
	
	var filess= $('input[type=file]').val().replace(/C:\\fakepath\\/i, '')
	var url=path+filess;
	//alert(url);
	$.ajax(url, { method: 'GET' }) .done(function(response) { 
	//alert("response="+response);
	
	if(confirm("A file with given name already exits. Do you want to overwrite existing file with this?")) {
		//alert("step1");
	 $("#form1").submit(); 
	} 
	else
	{ 
	  //alert("step2");
	  $("#form1")[0].reset();
	 // return false;
	} 
	}).fail(function(response) 
	{ 
		//alert("step3");
		document.form1.submit(); 
	})
		return false;
}
</script>





<?php } else { ?>
	<script language="javascript">parent.location.href="index.php";</script>
<?php } ?>


</body>
</html>