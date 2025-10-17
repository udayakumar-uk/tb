<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION['tobadmin'])) { ?>


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
		if($_GET['edit']=="delet")
		{
			$select=executework("select * from tob_vacancies where id=".$id);
			$drow=@mysqli_fetch_array($select);
			$dir = "../tbdata/vacanciesfiles/";
			$filename = $drow['tfile'];
			unlink ($dir.$filename);
			$tupdate=executework("delete from tob_vacancies where id=".$id);	
			redirect("vacancies.php?succ=4");
		}
		else if($_GET['edit']=="archive")
		{
			$tupdate=executework("update tob_vacancies set archive=1 where id=".$id);	
			redirect("vacancies.php?succ=2");
		}
		else
		{
			if(!empty($_POST['subm'])) {
				$pimage="tfile";
				$target_pathn = "../tbdata/vacanciesfiles/";
				$f1="";
				$f2="";
				if (!empty($_FILES[$pimage]['name']))
				{
					$f1= basename($_FILES[$pimage]['name']); 
					$target_pathsmn = $target_pathn .basename( $_FILES[$pimage]['name']); 
					$f1=basename( $_FILES[$pimage]['name']); 
				
					if(file_exists($f1))
					unlink($f1);
					move_uploaded_file($_FILES[$pimage]['tmp_name'], $target_pathsmn);
					$f2=",tfile='$f1' ";
				}
					if($_POST['tendr']=="")
					{
					$a=0;
					}
					else
					{
					$a=1;
					}
					$tinsert=executework("update tob_vacancies set tenderno='". $_POST['tenderno'] ."',description='". $_POST['description'] ."',hdescription='". $_POST['hdescription'] ."',tstatus='". $_POST['tstatus'] ."',home='".$a."'$f2 where id=".$id);
					redirect("vacancies.php?succ=3");
			}
		}
	}
	else if(!empty($_POST['subm'])) {
		$date=date("Y-m-d",time()+19800);
		$tselect=executework("select * from tob_vacancies where description='". $_POST['description']."'");
		$tcnt=@mysqli_num_rows($tselect);
		if($tcnt>0)
		{
			redirect("vacancies.php?exist=1");
		}
		else
		{
			$intmax=executework("SELECT max(id) from tob_vacancies");
			$cnt=@mysqli_num_rows($intmax);
			$row=@mysqli_fetch_array($intmax);
			if($row[0]!="") {
				$maxid=$row[0]+1;
			}
			else
			{
				$maxid=1;
			}
				$pimage="tfile";
				$target_pathn = "../tbdata/vacanciesfiles/";
				$f1="";
				if (!empty($_FILES[$pimage]['name']))
				{
					$f1= basename($_FILES[$pimage]['name']); 
					$target_pathsmn = $target_pathn .basename( $_FILES[$pimage]['name']); 
					$f1=basename( $_FILES[$pimage]['name']); 
					move_uploaded_file($_FILES[$pimage]['tmp_name'], $target_pathsmn);
				}
					if($_POST['tendr']=="")
					{
					$a=0;
					}
					else
					{
					$a=1;
					}
			$tinsert=executework("insert into tob_vacancies values($maxid,'$date','". $_POST['tenderno'] ."','". $_POST['description'] ."','". $_POST['hdescription'] ."','$f1','". $_POST['tstatus'] ."',0,'".$a."')");
			redirect("vacancies.php?succ=1");
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  	<?php include_once("head.php")?>
	<title>Statistics | Tobacco Board</title>
</head>
<body>

<section id="adminLayout">

	<?php include "header.php" ?>

	<?php include "sidebar.php"; ?>
	
	<main id="adminMain" class="container-fluid">

	<h2 class="admin-title">Post Vacancies </h2>

	<div id="adminTab">
	<nav>
		<div class="nav nav-tabs align-items-center" id="nav-tab" role="tablist">
			<button class="nav-link <?php if(empty($_GET['page_index'])){ ?> active <?php } ?>" id="post-tab" data-bs-toggle="tab" data-bs-target="#post-vacancy" type="button" role="tab" aria-controls="nav-post" aria-selected="true">Post Vacancy</button>
			<button class="nav-link <?php if(!empty($_GET['page_index']) && $_GET['page_index']!=""){ ?> active <?php } ?>" id="view-tab" data-bs-toggle="tab" data-bs-target="#view-vacancy" type="button" role="tab" aria-controls="nav-view" aria-selected="false">View Vacancy</button>
			
			<?php if(!empty($_GET['exist']) && $_GET['exist']==1){ ?>
				<div class="alert alert-danger d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">warning</span>
					<span> Given Vacancies Details Alredy Exist </span>
				</div>
					
			<?php } else if((!empty($_GET['succ']) && $_GET['succ']==1) || (!empty($_GET['succ']) && $_GET['succ']==2) || (!empty($_GET['succ']) && $_GET['succ']==3) || (!empty($_GET['succ']) && $_GET['succ']==4)){ ?>
				<div class="alert alert-success d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">check_circle</span>
					<?php if(!empty($_GET['succ']) && $_GET['succ']==1){ ?>
						<span> New Vacancies Posted Successfully </span>
					<?php } else if(!empty($_GET['succ']) && $_GET['succ']==2){ ?>
						<span> Selected Vacancies Successfully Move To Archives </span>
					<?php } else if(!empty($_GET['succ']) && $_GET['succ']==3){ ?>
						<span> Selected Vacancies Details Modify Successfully </span>
					<?php } else if(!empty($_GET['succ']) && $_GET['succ']==4){ ?>
						<span> Selected Vacancies Details Deleted Successfully </span>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</nav>

	<div class="tab-content" id="nav-tabContent">
		<div class="tab-pane fade <?php if(empty($_GET['page_index'])){ ?> show active <?php } ?>" id="post-vacancy" role="tabpanel" aria-labelledby="post-vacancy-tab" tabindex="0">


	<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check(this);">
		<?php
		$tselect=executework("select * from tob_vacancies where id='".$id."'");
		$tcnt=@mysqli_num_rows($tselect);
		if((empty($_GET['edit']) && empty($id)) || (!empty($_GET['edit']) && $tcnt>0)) {
			$trow=@mysqli_fetch_array($tselect);
			if(isset($trow['home']) && $trow['home'] != "")
			$home="checked='checked'";
			else
			$home="";
		?>


	<div class="row">
		<div class="form-group col-md-6">
			<label for="tenderno" class="form-label">Notice No</label>
			<input name="tenderno" class="form-control" type="text" id="tenderno" size="53" value="<?php echo $trow['tenderno']?>" />
		</div>
		<div class="form-group col-md-6">
			<label for="tstatus" class="form-label">Status</label>
			<input name="tstatus" class="form-control" type="text" id="tstatus" size="53" value="<?php echo $trow['tstatus']?>" />
		</div>
	</div>

	<div class="form-group">
		<label for="description" class="form-label">Description</label>
		<textarea name="description" cols="40" rows="5" class="form-control" placeholder="Leave a description" id="description"><?php echo $trow['description']?></textarea>
	</div>
	
	<div class="form-group">
		<label for="hdescription" class="form-label">Hindi Description</label>
		<textarea name="hdescription" cols="40" rows="5" class="form-control" placeholder="Leave a description" id="hdescription"><?php echo $trow['hdescription']?></textarea>
	</div>

	<div class="row align-items-center">
		<div class="col-md-6">
			<div class="input-group form-group">
				<input name="tfile" type="file" id="tfile" class="form-control">
				<label class="input-group-text" for="tfile">Upload File</label>
			</div>

			<?php if(!empty($trow['tfile'])){?>
				<a href="../tbdata/circularfiles/<?php echo $trow['tfile']?>" target="_blank">
					<img src="../tbdata/vacanciesfiles/<?php echo $trow['tfile']?>" alt="document" height="100" width="100" class="border rounded-3"/>
				</a>
			<?php }?>
		</div>
		<div class="col-md-6">
			<div class="form-group form-check">
				<input type="checkbox" class="form-check-input" value="1" <?php echo $home ?> name="tendr" id="tendr">
				<label class="form-check-label" for="tendr">Show In Home Page</label>
			</div>
		</div>
	</div>
	
	<div class="submit-button text-end">
		<?php if(empty($_GET['edit'])){ ?>
			<input type="reset" class="btn btn-light" name="Submit2" value="Reset" />
			<input type="submit" class="btn btn-primary" name="Submit" value="Submit" />
		<?php } else{ ?>
			<input type="reset" class="btn btn-light" name="Submit2" value="Cancel" onclick="back1();" />
			<input type="submit" class="btn btn-primary" name="Submit" value="Modify" />
		<?php } ?>
			<input name="subm" type="hidden" id="subm" />	 
			<input name="ttype" type="hidden" id="ttype" value="<?php if(!empty($_GET['edit'])) echo $_GET['edit']; ?>" /></td>
	</div>

	<?php } else { redirect("invalidaccess.php"); } ?>
</form>

</div>

	
	<div class="tab-pane fade <?php if(!empty($_GET['page_index']) && $_GET['page_index']!=""){ ?> show active <?php } ?>" id="view-vacancy" role="tabpanel" aria-labelledby="view-statics-tab" tabindex="1">
		
	  <?php
		$max_recs_per_page=30;
		$select=executework("select * from tob_vacancies order by id desc");
		$count=@mysqli_num_rows($select);
      ?>

	  
	<div class="d-flex align-items-center justify-content-between my-3">
		<h4 class="sub-title no-dash mb-0">Total Vacancies - <?php echo $count ?></h4> 
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

			$select1= executework("select * from tob_vacancies order by id desc LIMIT $pagenow1, $max_recs_per_page");
			$count1 = @mysqli_num_rows($select1);
			
			if($pages > 1){ ?>
				<ul class="pagination">
					<?php for($im=1;$im<=$pages;$im++) {
					if($page12 != $im){ ?>
						<li class="page-item"><a class="page-link hlink1" href="vacancies.php?page_index=<?php echo "$im" ?>"><?php echo "$im" ?></a></li>
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
						<th>SL No </th>
						<th>Date</th>
						<th>Descripotion </th>
						<th>Hindi Descripotion </th>
						<th>Notice No</th>
						<th>Vacancie Status</th>
						<th>Status</th>
						<th style="min-width: 130px">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=$pagenow1+1;
					while($row=@mysqli_fetch_array($select1)) {
					if(!empty($row['tfile']))
					$link="../tbdata/vacanciesfiles/".$row['tfile'];
					else
					$link="#"; ?>

					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo datepattrn($row['tdate']); ?></td>
						<td><?php echo $row['description']?></td>
						<td><?php echo $row['hdescription']?></td>
						<td><a href="<?php echo $link;?>" target="<?php if($link!="#"){?>_blank<?php }?>" class="b"><?php echo $row['tenderno']?></a></td>
						<td><?php echo $row['tstatus']?></td>
						<td><?php if($row['archive']==0) echo "<span class='text-success'>Active</span>"; else echo "<span class='text-secondary'>Archive</span>";?></td>
						<td class="text-center">
							<?php if($row['archive']==0){?>
								<button onclick="modf('<?php echo $row['id'] ?>','edit')" class="btn icon-btn btn-secondary" type="button">
									<span class="material-symbols-rounded">edit</span>
								</button>
								<button onclick="del('<?php echo $row['id'] ?>','archive')" class="btn icon-btn btn-dark" type="button">
									<span class="material-symbols-rounded">archive</span>
								</button>
							<?php }?>
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
					<button name="button" type="button" class="btn btn-sm btn-primary fbutton" onclick="location.href='vacancies.php?page_index=<?php echo $pre ?>'">Previous</button>
				<?php
				}
				if($page_index < $pages) {
				$next=$page_index+1; ?>
					<button name="button" type="button" class="btn btn-sm btn-primary fbutton" onclick="location.href='vacancies.php?page_index=<?php echo $next ?>'">Next  </button>
				<?php } ?>
			</div>
		<?php } ?>

	</div>
</div>


<?php include_once("footer.php");?>

<?php include_once("tinymce.php");?>


<script type="text/javascript">
function check(form1) {
	var tfile=document.form1.tfile.value;
	var tflen=tfile.length;
	var dpos=tfile.indexOf(".");
	var ext=tfile.substr(dpos+1,tflen);
	var ext1=ext.toLowerCase();
/*	if(document.form1.tenderno.value=="") {
		alert("Tender Notice No Should Not Be Empty");
		document.form1.tenderno.focus();
		return false;
	}
*/
	if(document.form1.description.value=="") {
		alert("Description of Tender Should Not Be Empty")
		document.form1.description.focus();
		return false;
	}
	else if(document.form1.hdescription.value=="") {
		alert("Hindi Description of Tender Should Not Be Empty")
		document.form1.hdescription.focus();
		return false;
	}
/*	else if(document.form1.tfile.value=="" && document.form1.ttype.value=="") {
		alert("Browse Tender File");
		document.form1.tfile.focus();
		return false;
	}
*/	else if(ext1!="" && ext1!='jpg' && ext1!='jpeg' && ext1!='gif' && ext1!='png' && ext1!='txt' && ext1!='pdf' && ext1!='doc' && ext1!='docx' && document.form1.ttype.value=="") {
		alert("Only file types of txt,pdf,doc,docx,jpg,jpeg,gif,png are allowed for Tender Files");
		document.form1.tfile.value="";
		document.form1.tfile.focus();
		return false;
	}	
/*	else if(document.form1.tstatus.value=="") {
		alert("Status Should Not Be Empty");
		document.form1.tstatus.focus();
		return false		
	}
*/	else
	{
		document.form1.subm.value=1;
		return true
	}
}
function delet(st,st1) {
	if(confirm("Are You sure to Delete Selected Details Completely")) {
		location.href="vacancies.php?id="+st+"&edit="+st1;
	}
}

function del(st,st1) {
	if(confirm("Are You sure to Move Archive Selected Details")) {
		location.href="vacancies.php?id="+st+"&edit="+st1;
	}
}
function modf(st,st1) {
	if(confirm("Are You sure to Modify Selected Details")) {
		location.href="vacancies.php?id="+st+"&edit="+st1;
	}
}
function back1() {
	location.href="vacancies.php";
}
</script>




<?php } else { ?>
	<script language="javascript">parent.location.href="index.php";</script>
<?php } ?>


</body>
</html>
