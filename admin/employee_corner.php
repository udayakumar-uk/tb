<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION['tobadmin']))
{
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
		if($_GET['edit']=="delet") {
			$select=executework("select * from tob_employee where id='".$id."'");
			$drow=@mysqli_fetch_array($select);
			$dir = "../tbdata/employeefiles/";
			$filename = $drow['tfile'];
			unlink ($dir.$filename);
			$tupdate=executework("delete from tob_employee where id='".$id."'");	
			redirect("employee_corner.php?succ=4");
		}
		else if($_GET['edit']=="archive") {
			$tupdate=executework("update tob_employee set archive=1 where id='".$id."'");	
			redirect("employee_corner.php?succ=2");
		}
		else
		{
			if(!empty($_POST['subm']))
			{
				$pimage="tfile";
				$target_pathn = "../tbdata/employeefiles/";
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
					$f2=",tfile='".$f1."' ";
				}
					$tinsert=executework("update tob_employee set order_type='". $_POST['order_type'] ."',order_details='". $_POST['order_details'] ."',horder_details='". $_POST['horder_details'] ."',tstatus='". $_POST['order_status'] ."'".$f2." where id='".$id."'");
					redirect("employee_corner.php?succ=3");
			}
		}
	}
	else if(!empty($_POST['subm'])) {
		$date=date("Y-m-d",time()+19800);
		$tselect=executework("select * from tob_employee where order_type='". $_POST['order_type']."' and order_details='". $_POST['order_details'] ."'");
		$tcnt=@mysqli_num_rows($tselect);
/*		if($tcnt>0) {
			redirect("employee_corner.php?exist=1");
		}
		else
		{
*/			$intmax=executework("SELECT max(id) from tob_employee");
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
				$pimage="tfile";
				$target_pathn = "../tbdata/employeefiles/";
				$f1="";
				if (!empty($_FILES[$pimage]['name']))
				{
					$f1= basename($_FILES[$pimage]['name']); 
					$target_pathsmn = $target_pathn .basename( $_FILES[$pimage]['name']); 
					$f1=basename( $_FILES[$pimage]['name']); 
					move_uploaded_file($_FILES[$pimage]['tmp_name'], $target_pathsmn);
				}
			$tinsert=executework("insert into tob_employee values($maxid,'$date','". $_POST['order_type'] ."','". $_POST['order_details'] ."','". $_POST['horder_details'] ."','".$f1."','". $_POST['order_status'] ."',0)");
			redirect("employee_corner.php?succ=1");
		//}
		}
	?>

<!DOCTYPE html>
<html lang="en">
<head>
  	<?php include_once("head.php")?>
	<title>Post Employee Corner | Tobacco Board</title>
</head>
<body>

<section id="adminLayout">

	<?php include "header.php" ?>

	<?php include "sidebar.php"; ?>
	
	<main id="adminMain" class="container-fluid">
		
	<h2 class="admin-title">Post Employee Corner</h2>
	

	<div id="adminTab">
	<nav>
		<div class="nav nav-tabs align-items-center" id="nav-tab" role="tablist">
			<button class="nav-link <?php if(empty($_GET['page_index'])){ ?> active <?php } ?>" id="post-tab" data-bs-toggle="tab" data-bs-target="#post-members" type="button" role="tab" aria-controls="post-member" aria-selected="true">Post Members</button>
			<button class="nav-link <?php if(!empty($_GET['page_index']) && $_GET['page_index']!=""){ ?> active <?php } ?>" id="view-tab" data-bs-toggle="tab" data-bs-target="#view-members" type="button" role="tab" aria-controls="view-member" aria-selected="false">View Members</button>
			
			<?php if(!empty($_GET['exist']) && $_GET['exist']==1){ ?>
				<div class="alert alert-danger d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">warning</span>
					<span>Given  Details Alredy Exist</span>
				</div>
					
			<?php } else if((!empty($_GET['succ']) && $_GET['succ']==1) || (!empty($_GET['succ']) && $_GET['succ']==2) || (!empty($_GET['succ']) && $_GET['succ']==3) || (!empty($_GET['succ']) && $_GET['succ']==4)){ ?>
				<div class="alert alert-success d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">check_circle</span>
					<?php if(!empty($_GET['succ']) && $_GET['succ']==1){ ?>
						<span> New Details Posted Successfully </span>
					<?php } else if(!empty($_GET['succ']) && $_GET['succ']==2){ ?>
						<span> Selected Deltails Successfully Move To Archives </span>
					<?php } else if(!empty($_GET['succ']) && $_GET['succ']==3){ ?>
						<span>Selected Details Modify Successfully </span>
					<?php } else if(!empty($_GET['succ']) && $_GET['succ']==4){ ?>
						<span> Selected Details Deleted Successfully</span>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</nav>

	
	<div class="tab-content" id="nav-tabContent">
		<div class="tab-pane fade <?php if(empty($_GET['page_index'])){ ?> show active <?php } ?>" id="post-members" role="tabpanel" aria-labelledby="post-members-tab" tabindex="0">
			


<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check(this);">
	<?php
		$tselect=executework("select * from tob_employee where id='".$id."'");
		$tcnt=@mysqli_num_rows($tselect);
		if((empty($_GET['edit']) && empty($id)) || (!empty($_GET['edit']) && $tcnt>0)) {
			$trow=@mysqli_fetch_array($tselect);
		?>
	
	<div class="row">
		<div class="col-md-6 form-group">
			<label for="order_type" class="form-label">Order Type</label>
			<select name="order_type" id="order_type" class="form-select">
				<option value="" selected>Select Order Type</option>
				<option value="Transfers &amp; Postings">Transfers &amp; Postings</option>
				<option value="Appointment Orders">Appointment Orders</option>
				<option value="Promotions">Promotions</option>
				<option value="Utility Forms">Utility Forms</option>
			</select>

      		<?php if($trow['order_type']!="") { ?>
      		<script type="text/javascript">
				 var dist='<?php echo $trow['order_type'] ?>';
				 if(dist=='Transfers And Postings')
				 dist='Transfers & Postings';
				 var j;
				for(j=0;j<document.form1.order_type.options.length;j++)
				{
					if(document.form1.order_type.options[j].value==dist)
					{
						document.form1.order_type.options[j].selected=true;
					}
				}
			</script>
      		<?php } ?>
		</div>
		<div class="col-md-6 form-group">
			<label for="order_details" class="form-label">Order Details</label>
			<input name="order_details" type="text" class="form-control" id="order_details" size="50" value="<?php echo $trow['order_details']?>"  />
		</div> 
		
		<div class="form-group">
			<label for="horder_details" class="form-label">Hindi Order Details</label>
			<textarea name="horder_details" cols="40" rows="5" class="form-control" placeholder="Leave a details" id="horder_details"><?php echo $trow['horder_details']?></textarea>
		</div>
		<div class="col-md-6">
			<label for="tfile" class="form-label">Upload File</label>
			<div class="input-group form-group">
				<input name="tfile" type="file" id="tfile" class="form-control">
				<label class="input-group-text" for="tfile">Upload File</label>
			</div>
			<?php if(!empty($trow['tfile'])){?><a href="../tbdata/employeefiles/<?php echo $trow['tfile']?>" target="_blank">View File</a><br /><?php }?>
		</div>
		
		<div class="col-md-6 form-group">
			<label for="order_status" class="form-label">Status</label>
			<input name="order_status" type="text" class="form-control" id="order_status" />
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

<div class="tab-pane fade <?php if(!empty($_GET['page_index']) && $_GET['page_index']!=""){ ?> show active <?php } ?>" id="view-members" role="tabpanel" aria-labelledby="view-members-tab" tabindex="1">

	  <?php
		$max_recs_per_page=30;
		$select=executework("select * from tob_employee order by id desc");
		$count=@mysqli_num_rows($select);
      ?>
	
	<div class="d-flex align-items-center justify-content-between my-3">
		<h4 class="sub-title no-dash mb-0">Total - <?php echo $count ?></h4>

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

			$select1= executework("select * from tob_employee order by id desc LIMIT $pagenow1, $max_recs_per_page");
			$count1 = @mysqli_num_rows($select1);
			
			if($pages > 1){ ?>
			<ul class="pagination">
				<?php for($im=1;$im<=$pages;$im++) {
					if($page12 != $im){ ?>
						<li class="page-item"><a class="page-link hlink1" href="employee_corner.php?page_index=<?php echo "$im" ?>"><?php echo "$im" ?></a></li>
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
						<th>Order Type</th>
						<th>Order Details</th>
						<th>Hindi Order Details</th>
						<th>Order Status</th>
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
						$link="../tbdata/employeefiles/".$row['tfile'];
						else
						$link="#"; ?>

                    <tr>
						<td><?php echo $i; ?></td>
						<td><?php echo datepattrn($row['tdate']);?></td>
						<td><a href="<?php echo $link;?>" target="<?php if($link!="#"){?>_blank<?php }?>" class="text-decoration-underline"><?php echo $row['order_type']?></a></td>
						<td><?php echo $row['order_details']?></td>
						<td><?php echo $row['horder_details']?></td>
						<td><?php echo $row['tstatus']?></td>
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
					<button name="button" type="button" class="btn btn-sm btn-primary fbutton" onclick="location.href='employee_corner.php?page_index=<?php echo $pre ?>'" />Previous</button>
				<?php
				}
				if($page_index < $pages) {
				$next=$page_index+1; ?>
					<button name="button" type="button" class="btn btn-sm btn-primary fbutton" onclick="location.href='employee_corner.php?page_index=<?php echo $next ?>'" />Next  </button>
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
function check(form1)
{
	var tfile=document.form1.tfile.value;
	var tflen=tfile.length;
	var dpos=tfile.indexOf(".");
	var ext=tfile.substr(dpos+1,tflen);
	var ext1=ext.toLowerCase();
	if(document.form1.order_type.value=="") {
		alert("Select Order Type");
		document.form1.order_type.focus();
		return false;
	}
	else if(document.form1.order_details.value=="") {
		alert("Order Details Should Not Be Empty")
		document.form1.order_details.focus();
		return false;
	}
	else if(document.form1.horder_details.value=="") {
		alert("Hindi Order Details Should Not Be Empty")
		document.form1.horder_details.focus();
		return false;
	}
/*	else if(document.form1.tfile.value=="" && document.form1.ttype.value=="") {
		alert("Browse File");
		document.form1.tfile.focus();
		return false;
	}
*/	else if(ext1!="" && ext1!='jpg' && ext1!='jpeg' && ext1!='png' && ext1!='gif' && ext1!='txt' && ext1!='pdf' && ext1!='doc' && ext1!='docx' && document.form1.ttype.value=="") {
		alert("Only file types of txt,pdf,doc,docx,jpg,jpeg,gif,png are allowed for Tender Files");
		document.form1.tfile.value="";
		document.form1.tfile.focus();
		return false;
	}	
//	else if(document.form1.order_status.value=="")
//	{
//		alert("Status Should Not Be Empty");
//		document.form1.order_status.focus();
//		return false		
//	}
	else
	{
		document.form1.subm.value=1;
		return true
	}
}
function delet(st,st1)
{
	if(confirm("Are You sure to Delete Selected Details Completely")) {
		location.href="employee_corner.php?id="+st+"&edit="+st1;
	}
}

function del(st,st1)
{
	if(confirm("Are You sure to Move Archive Selected Details")) {
		location.href="employee_corner.php?id="+st+"&edit="+st1;
	}
}
function modf(st,st1)
{
	if(confirm("Are You sure to Modify Selected Details")) {
		location.href="employee_corner.php?id="+st+"&edit="+st1;
	}
}
function back1()
{
	location.href="employee_corner.php";
}
</script>



<?php } else { ?>
	<script language="javascript">parent.location.href="index.php";</script>
<?php } ?>


</body>
</html>