<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
error_reporting(E_ALL);
 ini_set("display_errors", 1);
if(!empty($_SESSION['tobadmin'])) {
	$dat=date('Y-m-d');
	$dat='2014-01-21';
?>


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
	
	print_r($_POST);
	print_r($_FILES);
if(!empty($_POST['pi_subm']))
{
	if($_POST['pcat']!="")
	{
		$gid=$_POST['pcat'];
	}
	else
	{
		$selg=executework("select * from tob_album_title where title='".$_POST['pncat']."'");
		$cnt=@mysqli_num_rows($selg);
		if($cnt>0)
		{
			redirect("photogallery.php?exst=1");
		}
		else 
		{
			$intmaxtit=executework("SELECT max(id) from tob_album_title");
			$cnttit=@mysqli_num_rows($intmaxtit);
			$rowtit=@mysqli_fetch_array($intmaxtit);
			
			if($rowtit[0]!="")
			{
				$maxid1=$rowtit[0]+1;
			}
			else
			{
				$maxid1=1;
			}	
			//--------- album title insertion ----------------------
			$selalpos=executework("select max(position) from tob_album_title");
			$rowpos=@mysqli_fetch_array($selalpos);
			if($rowpos[0]!="")
			$posion=$rowpos[0]+1;
			else
			$posion=1;
			$psel=executework("insert into tob_album_title values(".$maxid1.",'".$_POST['pncat']."','".$_POST['hpncat']."','".$posion."','".$dat."')");
			$gid=$maxid1;
		}
	}
	
	$cnt1=$_POST['k'];	
	$size="";
	$selmpos=executework("select max(position) as pos1 from tob_images where titleid='".$gid."'");
	$rowmpos=@mysqli_fetch_array($selmpos);
	if($rowmpos['pos1']==0)
	$posid=1;
	else
	$posid=$rowmpos['pos1']+1;
	for($j=1;$j<=$cnt1;$j++)
	{
		$pimage1="pimage".$j; 
		if($size=="")
		$size=$_FILES[$pimage1]['size'];
		else 
		$size=$size+$_FILES[$pimage1]['size'];
	}

	$intmax=executework("SELECT max(id) from tob_images");
	$cnt=@mysqli_num_rows($intmax);
	$row=@mysqli_fetch_array($intmax);
	if($row[0]!="")
	{
		$maxid=$row[0]+1;
	}
	else
	{
		$maxid=1;
	}

	echo "size=".$size;
	$stt="";
	if($size<=3300000)
	{
		$target_pathn = "../tbdata/photogallery/oimages/";
		$target_patht = "../tbdata/photogallery/thimages/";
		for($i=1;$i<=$cnt1;$i++)
		{
			$pimage="pimage".$i; 
			$sta="sta".$i;


			if (!empty($_FILES[$pimage]['name']))
			{
				$f=basename($_FILES[$pimage]['name']);
				$len=strlen($f);
				$pos=strpos($f,'.');
				$ext=substr($f,$pos,$len);
				$tmpn=$_FILES[$pimage]['tmp_name'];
//					$f1=basename($_FILES[$pimage]['name']); 
				$target_pathsmn = $target_pathn .$maxid.strtolower($ext); 
				$target_pathsmt = $target_patht .$maxid.strtolower($ext); 
				$f1=$maxid.strtolower($ext); 
				move_uploaded_file($tmpn, $target_pathsmn);
				$add=$target_pathsmn;
				$tsrc=$target_pathsmt;
		
				$width="";
				$height="";
				$thumb_height = 120;
				
				// Content type
				header('(anti-spam-(anti-spam-content-type:)) image/jpeg');
				
				// Get new sizes
				list($width, $height) = getimagesize($add);
				$ratio = ($height/$width);
				$newwidth = ($thumb_height/$ratio);
				$newheight = $thumb_height;
	
				$n_width=$newwidth; // Fix the width of the thumb nail images
				$n_height=$newheight; // Fix the height of the thumb nail imaage
				


				if ($_FILES[$pimage]['type']=="image/gif")
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
				else if($_FILES[$pimage]['type']=="image/jpeg")
				{
					$im=ImageCreateFromJPEG($add);
					$width=ImageSx($im); // Original picture width is stored
					$height=ImageSy($im); // Original picture height is stored
					$newimage=imagecreatetruecolor($n_width,$n_height);
					imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
					if(ImageJpeg($newimage,$tsrc))
					echo "image uploaded";
					else
					echo "not uploaded";
					chmod("$tsrc",0777);
				
				}
				else
				{
					copy($target_pathsmn, $target_pathsmt);
				}

				if(in_array($i,$_POST['sta']))
				$sta=1;
				else
				$sta=0;
				
				if(!empty($f1))
				{
					$psel=executework("insert into tob_images values($maxid,'".$gid."','$f1','".$sta."','".$posid."',0,0)");
					$succ=1;
				}	
				if($sta==1)
				$stt=$maxid;
				$posid++;		
				$maxid++;
			}
		}
	}
	else
	redirect("photogallery.php?sizelimit=1");
	if($stt!="")
	{
		//$uptit=executework("update tob_images set cover=0 where titleid='".$gid."'");
		//$uptit=executework("update tob_images set cover=1 where id='".$stt."'");
	}
	$updat=executework("update tob_album_title set updated_on='".$dat."' where id=".$gid);
	redirect("photogallery.php?succ=1");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  	<?php include_once("head.php")?>
	<title>Photogallery | Tobacco Board</title>

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
		<h2 class="admin-title col">New Albums </h2>
	
		<div class="col">
			<?php if(!empty($_GET['exist']) && $_GET['exist']==1){ ?>
				<div class="alert alert-danger d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">warning</span>
					<span> Album Already Exists With Same Title </span>
				</div>
			<?php } else if(!empty($_GET['sizelimit'])){ ?>
				<div class="alert alert-danger d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">warning</span>
					<span> Uploaded Files Size Exceeded The Limit(3MB) </span>
				</div>
					
			<?php } else if((!empty($_GET['succ']) && $_GET['succ']==1) || (!empty($_GET['succ']) && $_GET['succ']==2) || (!empty($_GET['succ']) && $_GET['succ']==3) || (!empty($_GET['succ']) && $_GET['succ']==4)){ ?>
				<div class="alert alert-success d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">check_circle</span>
					<?php if(!empty($_GET['succ']) && $_GET['succ']==1){ ?>
						<span> New Album Created Successfully </span>
					<?php } else if(!empty($_GET['succ']) && $_GET['succ']=='title'){ ?>
						<span> Images Added  Successfully </span>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</div>


	<form action="photogallery.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check(this);">
 
			<div class="form-group">
				<label for="pcat" class="form-label">Albums</label>
				
				<?php
					$catselect=executework("select * from tob_album_title order by id");
					$ccnt=@mysqli_num_rows($catselect);
				?>
				<select name="pcat" class="form-select w-100" id="pcat" onchange="return chng();" style="width:250px;">
					<option value="">Select Album</option>
					<?php if($ccnt>0) {
						while($crow=@mysqli_fetch_array($catselect)) { ?>
							<option value="<?php echo $crow['id']?>"><?php echo $crow['title']?></option>
						<?php } } ?>
				</select>
				<?php
					if(!empty($_POST['pcat'])) { ?>
					<script type="text/javascript">
						var pcats='<?php echo $_POST['pcat'] ?>';
						var j;
						for(j=0;j<document.form1.pcat.options.length;j++)
						{
							if(document.form1.pcat.options[j].value==pcats)
							{
								document.form1.pcat.options[j].selected=true;
							}
						}
					</script>
				<?php } ?>
				
			</div>
	
			
		  
		<?php if(empty($_POST['pcat'])) { ?>
			<div class="row">
				<div class="form-group col-md-6">
					<label for="description" class="form-label">New Album Title</label>
					<input class="form-control" name="pncat" type="text" id="pncat" size="40" onchange="showHint('pncat')" />
				</div>
				<div class="form-group col-md-6">
					<label for="description" class="form-label">New Album Title (Hindi)</label>
					<input class="form-control" name="hpncat" type="text" id="hpncat" size="40" onchange="showHint('pncat')" />
				</div>
			</div>
						
		<?php } for($i=1;$i<=5;$i++) { ?>

			<div class="d-flex align-items-center mb-3 gap-4">
				<label for="pimage<?php echo $i;?>" class="col-form-label">Image <?php echo $i;?></label>
				<div class="input-group w-auto flex-grow-1">
					<input name="pimage<?php echo $i;?>" class="form-control" type="file" id="pimage<?php echo $i;?>" />
					<label class="input-group-text" for="pimage<?php echo $i;?>">Upload File</label>
				</div>
				<div class="form-check">
					<input type="checkbox" class="form-check-input" value="<?php echo $i ?>" name="home" id="sta[<?php echo $i ?>]">
					<label class="form-check-label" for="sta[<?php echo $i ?>]"> Home </label>
				</div>
			</div>
			
		<?php }
			if(!empty($_POST['pcat']))
			$value="";
			else
			$value="new"; ?>

			
		<div class="submit-button text-end">
			<input type="submit" class="btn btn-primary" name="Submit" value="Submit" />
         
            <input name="k" type="hidden" id="k" value="<?php echo $i-1;?>" />
            <input name="pi_subm" type="hidden" id="pi_subm" />
            <input name="type" type="hidden" id="type" value="<?php echo $value;?>" /></td>
		</div>
		
	</form>


<script>
	jQuery('#adate').datepicker();
	jQuery('#adate').readOnly=true;
</script>

<?php include_once("footer.php");?>


<script type="text/javascript">
var xmlhttp,usd,tmp,flav,qty,str

function showHint(st)
{
	str=document.getElementById(st).value;
if (str.length==0)
  {
  document.getElementById(usd).innerHTML="";
  return;
  }
xmlhttp=GetXmlHttpObject();
if (xmlhttp==null)
  {
  alert ("Your browser does not support XMLHTTP!");
  return;
  }
var url="sub.php?tit="+str;
xmlhttp.onreadystatechange=stateChanged;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);
}

function stateChanged()
{
if (xmlhttp.readyState==4)
  {
	var value=xmlhttp.responseText;
	if(value=='')
	{
	}
	else
	{
		if(value>0)
		{
			alert(" Given Album Title Alredy Exist Select Title");	
			document.getElementById("pncat").value=" ";
			document.getElementById("pcat").focus();			
		}
		else 
		{
			document.getElementById("title").value=str;
		}
	}
  }
}

function GetXmlHttpObject()
{
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  return new XMLHttpRequest();
  }
if (window.ActiveXObject)
  {
  // code for IE6, IE5
  return new ActiveXObject("Microsoft.XMLHTTP");
  }
return null;
}

function check(form1)
{
	if(document.form1.pcat.value=="" && document.form1.pncat.value=="")
	{
		alert("Please Enter New Album English Title");
		document.form1.pncat.focus();
		return false;
	}
	if(document.form1.pcat.value=="" && document.form1.hpncat.value=="")
	{
		alert("Please Enter New Album Hindi Title");
		document.form1.pncat.focus();
		return false;
	}		
/*	if(document.form1.pimage1.value=="")
	{
		alert("Browse Atleast One Image");
		document.form1.pimage1.focus();
		return false;		
	}*/
/*	if(document.form1.pcat.value=="" && document.form1.sta[0].checked==false)
	{
		alert("Please Select Cover Page");
		document.form1.sta[0].focus();
		return false;		
	}
*/	else
	{
		var chk=0;
		var k=document.form1.k.value;
		for(i=1;i<k;i++)
		{
			var pimage="pimage"+i;
			var sta="sta"+i;
			var pi=document.getElementById(pimage).value;
			var plen=pi.length;
			var ppos=pi.indexOf(".");
			var ext=pi.substr(ppos+1,plen);
			var ext1=ext.toLowerCase();
				if(document.getElementById(pimage).value!="")
				{
					if(ext1!='jpg' && ext1!='jpeg' && ext1!='gif' && ext1!='png')
					{
						alert("Only file types of jpg,jpeg,gif,png are allowed for Image");
						document.getElementById(pimage).value="";
						document.getElementById(pimage).focus();
						return false;
					}
					chk=1;
				}
			}
			if(chk==0)
			{
				alert("Browse Atleast One Image");
				document.form1.pimage1.focus();
				return false;		
			}
		document.form1.pi_subm.value=1;
		return true;	
	}	
}
function chng()
{
	document.form1.submit();
}

function chkbox(st)
{
	var n=document.form1.k.value;
	if(document.getElementById("sta"+st).checked==true && document.getElementById("pimage"+st).value!="")
	{
		for(i=1;i<n;i++)
		{
			if(st!=i)
			{
				document.getElementById("sta"+i).checked=false;
			}
		}
	}
	else if(document.getElementById("sta"+st).checked==true && document.getElementById("pimage"+st).value=="")
	{
		alert("Browse File");
		document.getElementById("sta"+st).checked=false;
		document.getElementById("pimage"+st).focus();
		return false;
	}
}
</script>

<?php } else { ?>
	<script language="javascript">parent.location.href="index.php";</script>
<?php } ?>



</body>
</html>