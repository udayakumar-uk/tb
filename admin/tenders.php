<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION['tobadmin'])) {
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

if(!empty($_GET['id']))
$id=$_GET['id'];
else if(!empty($_POST['id']))
$id=$_POST['id'];
else
$id='';

	if(!empty($_GET['edit'])) {
		$select=executework("select * from tob_tender where id='".$id."'");
		$drow=@mysqli_fetch_array($select);
		if($_GET['edit']=="delet") {
			$dir = "../tbdata/tenderfiles/";
			$filename = $drow['tfile'];
			unlink ($dir.$filename);
			$filen = $drow['mfile'];
			unlink ($dir.$filen);
			$files = $drow['sfile'];
			unlink ($dir.$files);
			
			$tupdate=executework("delete from tob_tender where id='".$id."'");	
			redirect("tenders.php?succ=4");
		}
		else if($_GET['edit']=="archive") {
			$tupdate=executework("update tob_tender set archive=1 where id='".$id."'");	
			redirect("tenders.php?succ=2");
		}
		else
		{
			if(!empty($_POST['subm']))
			{
				$pimage="tfile";
				$target_pathn = "../tbdata/tenderfiles/";
				$f1="";
				$f2="";
				if (!empty($_FILES[$pimage]['name']))
				{
					$f1= basename($_FILES[$pimage]['name']); 
					$ef=$target_pathn .$drow['tfile'];
					$target_pathsmn = $target_pathn .basename( $_FILES[$pimage]['name']); 
					$f1=basename( $_FILES[$pimage]['name']); 
				
					if(file_exists($f1))
					unlink($f1);
					if(file_exists($ef))
					unlink($ef);
					
					move_uploaded_file($_FILES[$pimage]['tmp_name'], $target_pathsmn);
					$f2=",tfile='$f1' ";
				}
				
				$simage="sfile";
				$target_path= "../tbdata/tenderfiles/";
				$f3="";
				$f4="";
				if (!empty($_FILES[$simage]['name']))
				{
					$f3= basename($_FILES[$simage]['name']); 
					$ef1=$target_path.$drow['sfile'];
					$target_pathsm = $target_pathn .basename( $_FILES[$simage]['name']); 
					$f1=basename( $_FILES[$simage]['name']); 
				
					if(file_exists($f3))
					unlink($f3);
					if(file_exists($ef1))
					unlink($ef1);
					
					move_uploaded_file($_FILES[$simage]['tmp_name'], $target_pathsm);
					$f4=",sfile='$f3' ";
				}
				
				$mimage="mfile";
				$target_pathi= "../tbdata/tenderfiles/";
				$f5="";
				$f6="";
				if (!empty($_FILES[$mimage]['name']))
				{
					$f5= basename($_FILES[$mimage]['name']); 
					$ef2=$target_pathi.$drow['mfile'];
					$target_pathsmy = $target_pathn .basename( $_FILES[$mimage]['name']); 
					$f5=basename( $_FILES[$mimage]['name']); 
				
					if(file_exists($f5))
					unlink($f5);
					if(file_exists($ef2))
					unlink($ef2);
					
					move_uploaded_file($_FILES[$mimage]['tmp_name'], $target_pathsmy);
					$f6=",mfile='".$f5."' ";
				}
					if($_POST['tendr']=="")
					{
					$a=0;
					}
					else
					{
					$a=1;
					}
	$tinsert=executework("update tob_tender set tenderno='". $_POST['tenderno'] ."',description='".$_POST['description']."', hdescription='".$_POST['hdescription']."', subtitle1='".$_POST['subt1']."', subtitle2='".$_POST['subt2']."', tstatus='".$_POST['tstatus']."', award='".$_POST['award']."', home='". $_POST['home'] ."', isactive='".$a."'".$f2.$f4.$f6." where id='".$id."'");
					
					redirect("tenders.php?succ=3");
			}
		}
	}
	else if(!empty($_POST['subm'])) {
		$date=date("Y-m-d",time()+19800);
		$tselect=executework("select * from tob_tender where tenderno='". $_POST['tenderno']."'");
		$tcnt=@mysqli_num_rows($tselect);
		if($tcnt>0) {
			redirect("tenders.php?exist=1");
		}
		else
		{
			$intmax=executework("SELECT max(id) from tob_tender");
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
			
				$mimage="mfile";
				$target_pathny = "../tbdata/tenderfiles/";
				$f10="";
				
				if (!empty($_FILES[$mimage]['name']))
				{
					$f10= basename($_FILES[$mimage]['name']); 
					$target_pathsy = $target_pathny .basename( $_FILES[$mimage]['name']); 
					$f10=basename( $_FILES[$mimage]['name']); 
					move_uploaded_file($_FILES[$mimage]['tmp_name'], $target_pathsy);
				}
				echo $f10;
			
				$pimage="tfile";
				$target_pathn = "../tbdata/tenderfiles/";
				$f1="";
				
				if (!empty($_FILES[$pimage]['name']))
				{
					$f1= basename($_FILES[$pimage]['name']); 
					$target_pathsmn = $target_pathn .basename( $_FILES[$pimage]['name']); 
					$f1=basename( $_FILES[$pimage]['name']); 
					move_uploaded_file($_FILES[$pimage]['tmp_name'], $target_pathsmn);
				}
				echo $f1;
				
				$simage="sfile";
				$target_path= "../tbdata/tenderfiles/";
				$f3="";
				
				if (!empty($_FILES[$simage]['name']))
				{
					$f3= basename($_FILES[$simage]['name']); 
					$target_pathsm = $target_path .basename( $_FILES[$simage]['name']); 
					$f3=basename( $_FILES[$simage]['name']); 
					move_uploaded_file($_FILES[$simage]['tmp_name'], $target_pathsm);
				}
				echo $f3;
				
				if(empty($_POST['tendr']))
				{
				$a=0;
				}
				else
				{
				$a=1;
				}
				if(!empty($_POST['home']))
				$home=1;
				else
				$home='';
			$tinsert=executework("insert into tob_tender values(".$maxid.",'".$date."','". $_POST['tenderno'] ."','". $_POST['description'] ."','". $_POST['hdescription'] ."','".$f10."','".$_POST['subt1']."','".$f1."','".$_POST['subt2']."','".$f3."','". $_POST['tstatus'] ."','".$_POST['award']."',0,'". $home ."','".$a."')");
			
			echo "insert into tob_tender values(".$maxid.",'".$date."','". $_POST['tenderno'] ."','". $_POST['description'] ."','". $_POST['hdescription'] ."','$f10','".$_POST['subt1']."','$f1','".$_POST['subt2']."','$f3','". $_POST['tstatus'] ."','".$_POST['award']."',0,'". $_POST['home'] ."','".$a."')";
			//echo "insert into tob_tender values($maxid,'$date','". $_POST[tenderno] ."','". $_POST[description] ."','". $_POST[hdescription] ."','".$_POST['title']."','".$_POST['subt1']."','$f1','".$_POST['subt2']."','$f2','". $_POST[tstatus] ."','".$_POST['award']."',0,'". $_POST[home] ."','".$a."')";
			redirect("tenders.php?succ=1");
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  	<?php include_once("head.php")?>
	<title>Post Tenders | Tobacco Board</title>
</head>
<body>

<section id="adminLayout">

	<?php include "header.php" ?>

	<?php include "sidebar.php"; ?>
	
	<main id="adminMain" class="container-fluid">
		
	<h2 class="admin-title">Post Tenders</h2>

	<div id="adminTab">
	<nav>
		<div class="nav nav-tabs align-items-center" id="nav-tab" role="tablist">
			<button class="nav-link <?php if(empty($_GET['page_index'])){ ?> active <?php } ?>" id="post-tab" data-bs-toggle="tab" data-bs-target="#post-tenders" type="button" role="tab" aria-controls="post-tenders" aria-selected="true">Post Tenders</button>
			<button class="nav-link <?php if(!empty($_GET['page_index']) && $_GET['page_index']!=""){ ?> active <?php } ?>" id="view-tab" data-bs-toggle="tab" data-bs-target="#view-tenders" type="button" role="tab" aria-controls="view-tenders" aria-selected="false">View Tenders</button>
			
			<?php if(isset($_GET['exist']) && $_GET['exist']==1){ ?>
				<div class="alert alert-danger d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">warning</span>
					<span>Given Tender Details Alredy Exist</span>
				</div>
					
			<?php } else if((isset($_GET['succ']) && $_GET['succ']==1) || (isset($_GET['succ']) && $_GET['succ']==2) || (isset($_GET['succ']) && $_GET['succ']==3) || (isset($_GET['succ']) && $_GET['succ']==4)){ ?>
				<div class="alert alert-success d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">check_circle</span>
					<?php if(isset($_GET['succ']) && $_GET['succ']==1){ ?>
						<span> New Tender Posted Successfully </span>
					<?php } else if(isset($_GET['succ']) && $_GET['succ']==2){ ?>
						<span> Selected Tender Successfully Move To Archives </span>
					<?php } else if(isset($_GET['succ']) && $_GET['succ']==3){ ?>
						<span>Selected Tender Details Modify Successfully </span>
					<?php } else if(isset($_GET['succ']) && $_GET['succ']==4){ ?>
						<span> Selected Tender Details Deleted Successfully</span>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</nav>

	<div class="tab-content" id="nav-tabContent">
		<div class="tab-pane fade <?php if(empty($_GET['page_index'])){ ?> show active <?php } ?>" id="post-tenders" role="tabpanel" aria-labelledby="post-tenders-tab" tabindex="0">
			


	<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check(this);">
	<?php
		$tselect=executework("select * from tob_tender where id='".$id."'");
		$tcnt=@mysqli_num_rows($tselect);
		if((empty($_GET['edit']) && empty($id)) || (!empty($_GET['edit']) && $tcnt>0)) {
			$trow=@mysqli_fetch_array($tselect);
			if($trow['home']!="")
			$home="checked='checked'";
			else
			$home="";
			if($trow['isactive']!=0)
			$actv="checked='checked'";
			else
			$actv="";
	?>

	<div class="row">
		<div class="col-md-6 form-group">
			<label for="tenderno" class="form-label">Tender Notice No</label>
			<input name="tenderno" type="text" class="form-control" id="tenderno" size="50" value="<?php if(!empty($trow['tenderno'])) echo $trow['tenderno'] ?>"  />
		</div> 
		
		<div class="form-group">
			<label for="description" class="form-label">Description of Tender</label>
			<textarea name="description" cols="40" rows="5" class="form-control" placeholder="Leave a description" id="description"><?php if(!empty($trow['description'])) echo $trow['description'] ?></textarea>
		</div>
		<div class="form-group">
			<label for="hdescription" class="form-label">Description of Tender (Hindi)</label>
			<textarea name="hdescription" cols="40" rows="5" class="form-control" placeholder="Leave a hdescription" id="hdescription"><?php if(!empty($trow['hdescription'])) echo $trow['hdescription'] ?></textarea>
		</div>
		
		<div class="col-md-6">
			<label for="mfile" class="form-label">Upload Tender File</label>
			<div class="input-group form-group">
				<input name="mfile" type="file" id="mfile" class="form-control">
				<label class="input-group-text" for="mfile">Upload File</label>
			</div>
			<?php if(!empty($trow['mfile'])){?><a href="../tbdata/tenderfiles/<?php echo $trow['mfile'] ?>" target="_blank">View File</a><br /><?php }?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 form-group">
			<label for="subt1" class="form-label">Subtitle1</label>
			<input name="subt1" type="text" class="form-control" id="subt1" size="50" value="<?php if(!empty($trow['subtitle1'])) echo $trow['subtitle1']?>"  />
		</div> 
		<div class="col-md-6">
			<label for="mfile" class="form-label">Upload Tender File1</label>
			<div class="input-group form-group">
				<input name="tfile" type="file" id="tfile" class="form-control">
				<label class="input-group-text" for="tfile">Upload File</label>
			</div>
			<?php if(!empty($trow['tfile'])){?><a href="../tbdata/tenderfiles/<?php echo $trow['tfile'] ?>" target="_blank">View File</a><br /><?php }?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 form-group">
			<label for="subt2" class="form-label">Subtitle2</label>
			<input name="subt2" type="text" class="form-control" id="subt2" size="50" value="<?php echo $trow['subtitle2'] ?>"  />
		</div> 
		<div class="col-md-6">
			<label for="mfile" class="form-label">Upload Tender File2</label>
			<div class="input-group form-group">
				<input name="sfile" type="file" id="sfile" class="form-control">
				<label class="input-group-text" for="sfile">Upload File</label>
			</div>
			<?php if(!empty($trow['sfile'])){?><a href="../tbdata/tenderfiles/<?php echo $trow['sfile'] ?>" target="_blank">View File</a><br /><?php }?>
		</div>
	</div>
 
	<div class="form-group">
		<label for="award" class="form-label">Awarded</label>
		<textarea name="award" cols="40" rows="5" class="form-control" placeholder="Leave a award" id="award"><?php echo $trow['award'] ?></textarea>
	</div>

	<div class="row">
		<div class="col-md-6 form-group">
			<label for="tstatus" class="form-label">Tender Status</label>
			<input name="tstatus" type="text" class="form-control" id="tstatus" size="50" value="<?php echo $trow['tstatus']?>"  />
			
		</div> 
		<div class="col-md-6 form-group d-flex align-items-end gap-3">
			<div class="form-check">
				<input class="form-check-input" name="home" type="checkbox" id="home" value="1" <?php echo $home; ?>/>
        		<label class="form-check-label" for="home">Home</label>
			</div>
			<div class="form-check">
				<input class="form-check-input" name="tendr" type="checkbox" id="tendr" value="1" <?php echo $actv;?> >
				<label class="form-check-label" for="tendr"> Tender Closed </label>
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
	
	<?php } else { redirect("invalidaccess.php"); } ?>

</form>

</div>

<div class="tab-pane fade <?php if(!empty($_GET['page_index']) && $_GET['page_index']!=""){ ?> show active <?php } ?>" id="view-tenders" role="tabpanel" aria-labelledby="view-tenders-tab" tabindex="1">

	  <?php
		$max_recs_per_page=30;
		$select=executework("select * from tob_tender order by id desc");
		$count=@mysqli_num_rows($select);
      ?>

	<div class="d-flex align-items-center justify-content-between my-3">
		<h4 class="sub-title no-dash mb-0">Total Tenders - <?php echo $count ?></h4>
 
		<?php
		if ($count > 0) {
			if (empty($_GET['page_index'])) {
				$page_index=1;
			}	
			else
			{
				$page_index=$_GET['page_index'];
			}
			$total_recs = $count;
			$pages = $count / $max_recs_per_page; 
			if ($pages < 1) { 
				$pages = 1; 
			}
			if ($pages / (int) $pages <> 1) { 
				$pages = (int) $pages + 1; 
			} 
			else
			{ 
				$pages = $pages; 
			}
			$page12=(int) $page_index;
			
			$pagenow1 = ($max_recs_per_page*($page12-1)); 

			$select1= executework("select * from tob_tender order by id desc LIMIT $pagenow1, $max_recs_per_page");
			$count1 = @mysqli_num_rows($select1);
	
			if($pages > 1){ ?>
			<ul class="pagination">
				<?php for($im=1;$im<=$pages;$im++) {
					if($page12 != $im){ ?>
						<li class="page-item"><a class="page-link hlink1" href="tenders.php?page_index=<?php echo "$im" ?>"><?php echo "$im" ?></a></li>
					<?php } else{ ?>
						<li class="page-item active" aria-current="page"> <span class="page-link"><?php echo "$im" ?></span> </li>
					<?php } } ?>
				</ul>
			<?php } ?>
		</div>
		
		
		<div class="table-responsive">
			<table class="table table-bordered ">
				<thead class="text-center">
					<tr>
						<th>SL No  </th>
						<th>Date </th>
						<th>Tender Notice No</th>
						<th>Tender Descripotion</th>
						<th>Tender Status</th>
						<th>Awarded To</th>
						<th>Status</th>
						<th style="min-width: 130px">Actions</th>
					</tr>
				</thead>
				<tbody>
					
                    <?php
					$i=$pagenow1+1;
					while($row=@mysqli_fetch_array($select1))
					{
						if(!empty($row['tfile']))
						$link="../tbdata/tenderfiles/".$row['mfile'];
						else
						$link="#";
					?>

                    <tr>
						<td><?php echo $i; ?></td>
						<td><?php echo datepattrn($row['tdate']); ?></td>
						<td><a href="<?php echo $link; ?>" target="<?php if($link!="#"){?>_blank<?php } ?>" class="b"><?php echo $row['tenderno'] ?></a></td>
						<td><?php echo $row['description'] ?></td>
						<td><?php echo $row['tstatus']?></td>
						<td><?php echo $row['award']?></td>
						<td><?php if($row['archive']==0) echo "Active"; else echo "Archive";?></td>
						<td class="text-center">
							<?php if($row['archive']==0) { ?>
								<button onclick="modf('<?php echo $row['id'] ?>','edit')" class="btn icon-btn btn-secondary" type="button">
									<span class="material-symbols-rounded">Edit</span>
								</button>
								<button onclick="del('<?php echo $row['id'] ?>','archive')" class="btn icon-btn btn-dark" type="button">
									<span class="material-symbols-rounded">archive</span>
								</button>
							<?php } ?>
							<button onclick="delet('<?php echo $row['id'] ?>','delet')" class="btn icon-btn btn-danger" type="button">
								<span class="material-symbols-rounded">delete</span>
							</button>
						</td> 
                    </tr>
                    <?php $i++; } } ?>
				</tbody>
            </table>
		</div>

		<?php if ($pages > 1) { ?>
			<div class="text-end">
				<?php if($page_index != 1){
					$pre=$page_index-1; ?>
					<button name="button" type="button" class="btn btn-sm btn-primary fbutton" onclick="location.href='tenders.php?page_index=<?php echo $pre ?>'" />Previous</button>
				<?php
				}
				if($page_index < $pages) {
				$next=$page_index+1; ?>
					<button name="button" type="button" class="btn btn-sm btn-primary fbutton" onclick="location.href='tenders.php?page_index=<?php echo $next ?>'" />Next  </button>
				<?php } ?>
			</div>
        <?php } ?>

	</div>
</div>

  
</main>

</section>

<?php include_once("footer.php");?>

<?php include_once("tinymce.php");?>



	
<!-- <script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

		// Theme options
//		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",
		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'},
			{title : 'New Style', inline : 'span', classes : 'style4'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script> -->

<script type="text/javascript">
function check(form1) {
	var mfile=document.form1.mfile.value;
	var mflen=mfile.length;
	var dpos=mfile.indexOf(".");
	var ext=mfile.substr(dpos+1,mflen);
	var ext1=ext.toLowerCase();

	var tfile=document.form1.tfile.value;
	var tflen=tfile.length;
	var tpos=tfile.indexOf(".");
	var text=tfile.substr(tpos+1,tflen);
	var text1=text.toLowerCase();

	var sfile=document.form1.sfile.value;
	var sflen=sfile.length;
	var spos=sfile.indexOf(".");
	var sext=sfile.substr(spos+1,sflen);
	var sext1=sext.toLowerCase();
	if(document.form1.tenderno.value=="") {
		alert("Tender Notice No Should Not Be Empty");
		document.form1.tenderno.focus();
		return false;
	}
	else if(document.form1.description.value=="") {
		alert("Description of Tender Should Not Be Empty")
		document.form1.description.focus();
		return false;
	}
	else if(document.form1.hdescription.value=="") {
		alert("Description of Tender In Hindi Should Not Be Empty")
		document.form1.hdescription.focus();
		return false;
	}
	else if(document.form1.mfile.value=="" && document.form1.ttype.value=="") {
		alert("Browse Tender File");
		document.form1.mfile.focus();
		return false;
	}
	else if(ext1!='jpg' && ext1!='jpeg' && ext1!='gif' && ext1!='png' && ext1!='txt' && ext1!='pdf' && ext1!='doc' && ext1!='docx' && ext1!='rar' && ext1!='zip' && document.form1.ttype.value=="") {
		alert("Only file types of txt,pdf,doc,docx,jpg,jpeg,png,gif,rar,zip are allowed for Tender Files");
		document.form1.tfile.value="";
		document.form1.tfile.focus();
		return false;
	}	
	else if(document.form1.tstatus.value=="") {
		alert("Status Should Not Be Empty");
		document.form1.tstatus.focus();
		return false		
	}
	else
	{
		document.form1.subm.value=1;
		return true
	}
}
function delet(st,st1) {
	if(confirm("Are You sure to Delete Selected Tender Details Completely")) {
		location.href="tenders.php?id="+st+"&edit="+st1;
	}
}

function del(st,st1) {
	if(confirm("Are You sure to Move Archive Selected Tender Details")) {
		location.href="tenders.php?id="+st+"&edit="+st1;
	}
}
function modf(st,st1) {
	if(confirm("Are You sure to Modify Selected Tender Details")) {
		location.href="tenders.php?id="+st+"&edit="+st1;
	}
}
function back1() {
	location.href="tenders.php";
}
</script>



<?php } else { ?>
	<script language="javascript">parent.location.href="index.php";</script>
<?php } ?>


</body>
</html>