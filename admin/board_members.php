<?php
ob_start();
session_start();
header("Cache-control: private"); 
include("include/includei.php");
include("check_user.php");
include('nocsrf.php');
if(!empty($_GET['id']))
$id=$_GET['id'];
else if(!empty($_POST['id']))
$id=$_POST['id'];
else
$id='';
if(!empty($_GET['edit']))
$edit=$_GET['edit'];
else if(!empty($_POST['ttype']))
$edit=$_POST['ttype'];
else
$edit='';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(!empty($_SESSION['tobadmin'])) {?>

<?php
	$token = NoCSRF::generate( 'csrf_token' );
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

if(!empty($_GET['id']))
$id=$_GET['id'];
else if(!empty($_POST['id']))
$id=$_POST['id'];
else
$id='';
if(!empty($_GET['edit'])){
	 $result=csrf_token_check();
		$select=executework("select * from tob_brdmember where id=".$id);
		$drow=@mysqli_fetch_array($select);
		if($_GET['edit']=="delet")
		{
			$dir = "../tbdata/members/";
			$filename = $drow['image'];
			unlink ($dir.$filename);
			$tupdate=executework("delete from tob_brdmember where id=".$id);	
			redirect("board_members.php?succ=4");
		}
		else if($_GET['edit']=='edit')
		{ 
		 if(!empty($_POST['Submit']))
		 {
				$mimage="bimg";
				$target_pathi= "../tbdata/members/";
				$f5="";
				$f6="";
				if (!empty($_FILES[$mimage]['name']))
				{
					$f5= basename($_FILES[$mimage]['name']); 
					$ef2=$target_pathi.$drow['bimg'];
					$target_pathsmy = $target_pathi .basename( $_FILES[$mimage]['name']); 
					//$f5=basename( $_FILES[$mimage]['name']); 
					//echo $target_pathsmy;
					move_uploaded_file($_FILES[$mimage]['tmp_name'], $target_pathsmy);
					$f6=",image='$f5' ";
				}
				//echo ("update tob_brdmember set name='". $_POST['mem_name'] ."',designation='".$_POST['designation']."', addr='".$_POST['addr']."' ".$f6." where id=".$id);
				//exit();
	$tinsert=executework("update tob_brdmember set sl_no='".$_POST['sl_no']."',name='".addslashes($_POST['mem_name'])."',designation='".addslashes($_POST['designation'])."', addr='".addslashes($_POST['addr'])."' ".$f6." where id=".$id);
					
					redirect("board_members.php?succ=3");
		}

		}
	}
	else if(!empty($_POST['Submit'])){

		$mimage="bimg";
					$target_pathny = "../tbdata/members/";
					$f10="";
					
					if (!empty($_FILES[$mimage]['name']))
					{
						$f10= basename($_FILES[$mimage]['name']); 
						$target_pathsy = $target_pathny .basename( $_FILES[$mimage]['name']); 
						$f10=basename( $_FILES[$mimage]['name']); 
						move_uploaded_file($_FILES[$mimage]['tmp_name'], $target_pathsy);
					}
				$tinsert=executework("insert into tob_brdmember (sl_no,name,designation,image,addr,added_on,status) values('".$_POST['sl_no']."','". addslashes($_POST['mem_name']) ."','". addslashes($_POST['designation']) ."','".$f10."','".addslashes($_POST['addr'])."','".date('Y-m-d H:i:s')."',1)");
				//echo "insert into tob_brdmember (sl_no,name,designation,image,addr,added_on,status) values('".$_POST['sl_no']."','". $_POST['mem_name'] ."','". $_POST['designation'] ."','".$f10."','".addslashes($_POST['addr'])."','".date('Y-m-d H:i:s')."',1)";
				redirect("board_members.php?succ=1");	
	} ?>


<!DOCTYPE html>
<html lang="en">
<head>
  	<?php include_once("head.php")?>
	<title>Board Members | Tobacco Board</title>
</head>
<body>

<section id="adminLayout">

	<?php include "header.php" ?>

	<?php include "sidebar.php"; ?>
	
	<main id="adminMain" class="container-fluid">

	<h2 class="admin-title">Board Members</h2>
	
	<div id="adminTab">
	<nav>
		<div class="nav nav-tabs align-items-center" id="nav-tab" role="tablist">
			<button class="nav-link <?php if(empty($_GET['page_index'])){ ?> active <?php } ?>" id="post-tab" data-bs-toggle="tab" data-bs-target="#post-members" type="button" role="tab" aria-controls="post-member" aria-selected="true">Post Members</button>
			<button class="nav-link <?php if(!empty($_GET['page_index']) && $_GET['page_index']!=""){ ?> active <?php } ?>" id="view-tab" data-bs-toggle="tab" data-bs-target="#view-members" type="button" role="tab" aria-controls="view-member" aria-selected="false">View Members</button>
			
			<?php if(isset($_GET['exist']) && $_GET['exist']==1){ ?>
				<div class="alert alert-danger d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">warning</span>
					<span>Given Board Member Details Alredy Exist</span>
				</div>
					
			<?php } else if((isset($_GET['succ']) && $_GET['succ']==1) || (!empty($_GET['succ']) && $_GET['succ']==2) || (!empty($_GET['succ']) && $_GET['succ']==3) || (!empty($_GET['succ']) && $_GET['succ']==4)){ ?>
				<div class="alert alert-success d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">check_circle</span>
					<?php if(isset($_GET['succ']) && $_GET['succ']==1){ ?>
						<span> New Board Member Details Posted Successfully </span>
					<?php } else if(isset($_GET['succ']) && $_GET['succ']==3){ ?>
						<span>Selected Member Details Modify Successfully </span>
					<?php } else if(isset($_GET['succ']) && $_GET['succ']==4){ ?>
						<span> Selected Member Details Deleted Successfully</span>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</nav>

	
	<div class="tab-content" id="nav-tabContent">
		<div class="tab-pane fade <?php if(empty($_GET['page_index'])){ ?> show active <?php } ?>" id="post-members" role="tabpanel" aria-labelledby="post-members-tab" tabindex="0">
			

		<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check(this);">
		<?php
			$tselect=executework("select * from tob_brdmember where id='".$id."'");
			$tcnt=@mysqli_num_rows($tselect);
			
			if((empty($edit) && empty($id)) || (!empty($edit) && $tcnt>0)){
				$trow=@mysqli_fetch_array($tselect);
				if(!empty($trow['home']))
				$home="checked='checked'";
				else
				$home="";
				if(!empty($trow['isactive']) && $trow['isactive']!=0)
				$actv="checked='checked'";
				else
				$actv="";
		?>

	<div class="row">
		<div class="col-md-6 form-group">
			<label for="sl_no" class="form-label">Sl.No</label>
			<input name="sl_no" type="number" class="form-control" id="sl_no" size="50" value="<?php if(!empty($trow['sl_no'])) echo $trow['sl_no'] ?>" />
		</div>

		<div class="col-md-6 form-group">
			<label for="mem_name" class="form-label">Name</label>
			<input name="mem_name" type="text" class="form-control" id="mem_name" size="50" value="<?php if(!empty($trow['name'])) echo stripslashes($trow['name']) ?>" />
		</div>

		<div class="col-md-6 form-group">
			<label for="designation" class="form-label">Designation</label>
			<input type="text" name="designation" class="form-control" id="designation" value="<?php if(!empty($trow['designation'])) echo stripslashes($trow['designation']) ?>" />
		</div>

		<div class="col-md-6">
			<label for="bimg" class="form-label">Image</label>
			<div class="input-group form-group">
				<input name="bimg" type="file" id="bimg" class="form-control">
				<label class="input-group-text" for="bimg">Upload File</label>
			</div>

		</div>
		
		<div class="form-group col-md-6">
			<label for="addr" class="form-label">Address</label>
			<textarea name="addr" cols="40" rows="5" class="form-control" id="addr"><?php if(!empty($trow['addr'])) echo stripslashes($trow['addr']) ?></textarea>
		</div>

	</div>

	<div class="submit-button text-end">
		<?php if(empty($edit)){ ?>
			<input type="reset" class="btn btn-light" name="Submit2" value="Reset" />
			<input type="submit" class="btn btn-primary" name="Submit" value="Submit" />
		<?php } else { ?>
			<input type="reset" class="btn btn-light" name="Submit2" value="Cancel" onclick="back1();" />
			<input type="submit" class="btn btn-primary" name="Submit" value="Modify" />
		<?php } ?>
		
		<input name="subm" type="hidden" id="subm" />	 
		<input name="ttype" type="hidden" id="ttype" value="<?php echo $edit; ?>" />

	</div>
		
		
	<?php } else { redirect("invalidaccess.php"); } ?>

	<input type="hidden" name="csrf_token" value="<?php echo $token; ?>">

</form>

</div>



<div class="tab-pane fade <?php if(!empty($_GET['page_index']) && $_GET['page_index']!=""){ ?> show active <?php } ?>" id="view-members" role="tabpanel" aria-labelledby="view-members-tab" tabindex="1">
	  <?php
		$max_recs_per_page=30;
		$select=executework("select * from tob_brdmember order by id desc");
		$count=@mysqli_num_rows($select);
      ?>

	<div class="d-flex align-items-center justify-content-between my-3">
		<h4 class="sub-title no-dash mb-0">Total Members - <?php echo $count ?></h4>

		
			<?php
			$pages='';
			if ($count > 0) {
				if (empty($_GET['page_index'])){
					$page_index=1;
				}	
				else {
					$page_index=$_GET['page_index'];
				}
				$total_recs = $count;
				$pages = $count / $max_recs_per_page; 
				if ($pages < 1){ 
					$pages = 1; 
				}
				if ($pages / (int) $pages <> 1){ 
					$pages = (int) $pages + 1; 
				} 
				else { 
					$pages = $pages; 
				}
				$page12=(int) $page_index;
				
				$pagenow1 = ($max_recs_per_page*($page12-1)); 

				$select1= executework("select * from tob_brdmember order by sl_no,id  LIMIT $pagenow1, $max_recs_per_page");
				$count1 = @mysqli_num_rows($select1);
				


				if($pages > 1){ ?>
				<ul class="pagination">
					<?php for($im=1;$im<=$pages;$im++) {
						if($page12 != $im){ ?>
							<li class="page-item"><a class="page-link hlink1" href="admin/board_members.php?page_index=<?php echo "$im" ?>"><?php echo "$im" ?></a></li>
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
						<th>#</th>
						<th>SL No </th>
						<th>Image </th>
						<th>Name</th>
						<th>Designation</th>
						<th>Address</th>
						<th style="min-width: 100px">Actions</th>
					</tr>
				</thead>
				<tbody>
				
                <?php
				$i=$pagenow1+1;
				while($row=@mysqli_fetch_array($select1)) {
				//print_r($row);
				if(!empty($row['image']))
				$link="../tbdata/members/".$row['image'];
				else
				$link="../tbdata/members/boardmembers_thumb.gif";
				?>
				
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $row['sl_no']; ?></td>
					<td><img src="<?php echo $link; ?>" class="img-fluid rounded-3" width="100" height="100" alt="<?php echo stripslashes($row['name']); ?>" /></td>
					<td><?php echo stripslashes($row['name']); ?></td>
					<td><?php echo stripslashes($row['designation']); ?></td>
					<td><?php echo stripslashes($row['addr']); ?></td>
					<td class="text-center">
						<button onclick="modf('<?php echo $row['id'] ?>','edit')" class="btn icon-btn btn-secondary" type="button">
							<span class="material-symbols-rounded">Edit</span>
						</button>
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
					<button name="button" type="button" class="btn btn-sm btn-primary fbutton" onclick="location.href='board_members.php?page_index=<?php echo $pre ?>'" />Previous</button>
				<?php
				}
				if($page_index < $pages) {
				$next=$page_index+1; ?>
					<button name="button" type="button" class="btn btn-sm btn-primary fbutton" onclick="location.href='board_members.php?page_index=<?php echo $next ?>'" />Next  </button>
				<?php } ?>
			</div>
        <?php } ?>
		
	</div>
</div>



</main>

</section>


<?php include_once("footer.php");?>



<script type="text/javascript">
function check(form1) {
	var mfile=document.form1.bimg.value;
	var mflen=mfile.length;
	var dpos=mfile.indexOf(".");
	var ext=mfile.substr(dpos+1,mflen);
	var ext1=ext.toLowerCase();

	if(document.form1.mem_name.value==""){
		alert("Member Name Should Not Be Empty");
		document.form1.mem_name.focus();
		return false;
	}
	else if(document.form1.designation.value==""){
		alert("Designation Should Not Be Empty")
		document.form1.designation.focus();
		return false;
	}
	else if(ext1!='' && ext1!='jpg' && ext1!='jpeg' && ext1!='gif'){
		alert("Only file types of jpg,jpeg,gif are allowed for Tender Files");
		document.form1.bimg.value="";
		document.form1.bimg.focus();
		return false;
	}	
	else {
		document.form1.subm.value=1;
		return true
	}
}
function delet(st,st1) {
	if(confirm("Are You sure to Delete Selected Member Details Completely")){
		location.href="board_members.php?id="+st+"&edit="+st1;
	}
}

function del(st,st1) {
	if(confirm("Are You sure to Move Archive Selected Tender Details")){
		location.href="tenders.php?id="+st+"&edit="+st1;
	}
}
function modf(st,st1) {
	if(confirm("Are You sure to Modify Selected Member")){
		location.href="board_members.php?id="+st+"&edit="+st1;
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