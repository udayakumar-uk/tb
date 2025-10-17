<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION['tobadmin'])){
?>

<?php
if(!empty($_GET['movid'])){	
	$selrec1=executework("select * from  tob_album_title where id='".mysqli_real_escape_string($_GET['movid'])."'");
	$rowrec1=@mysqli_fetch_array($selrec1);
	if($_GET['act']=='up')
	$qry="where position > ".$rowrec1['position']." order by position asc limit 1";
	if($_GET['act']=='down')
	$qry="where position < ".$rowrec1['position']." order by position desc limit 1";
	
	$selqry=executework("select * from tob_album_title ".$qry."");
	echo "select * from tob_album_title ".$qry."";
	$rowqry=@mysqli_fetch_array($selqry);
	
	print_r($rowqry);
	$temp=$rowqry['position'];
	$upd1=executework("update tob_album_title set position='".$rowrec1['position']."' where id='".$rowqry['id']."'");
	echo "update tob_album_title set position='".$rowrec1['position']."' where id='".$rowqry['id']."'";
	$upd2=executework("update tob_album_title set position='".$temp."' where id='".$rowrec1['id']."'");
	echo "update tob_album_title set position='".$temp."' where id='".$rowrec1['id']."'";
	redirect("albummodify.php?titid=".$rowrec1['id']."");
}

if(!empty($_GET['pedit']) && $_GET['pedit']=='delet'){
	$selche=executework("select * from tob_images where titleid=".mysqli_real_escape_string($_GET['title'])." ");
	while($rche=@mysqli_fetch_array($selche)){
		$dir = "../tbdata/photogallery/oimages/";
		$dir1 = "../tbdata/photogallery/thimages/";
		$filename = $rche['image'];
		unlink ($dir.$filename);
		unlink ($dir1.$filename);
	}
	$selp=executework("delete from tob_images where titleid=".mysqli_real_escape_string($_GET['title'])."");
	$selp1=executework("delete from tob_album_title where id=".mysqli_real_escape_string($_GET['title'])."");
	redirect("albummodify.php?succ=success");
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
  	<?php include_once("head.php")?>
	<title>Albums List | Tobacco Board</title>

</head>


<body>
	
<section id="adminLayout">

	<?php include "header.php" ?>

	<?php include "sidebar.php"; ?>
	
	<main id="adminMain" class="container-fluid">
	
		<div class="row">
			<h2 class="admin-title col">Albums List </h2>
		
			<div class="col">
				<?php if(!empty($_GET['exist']) && $_GET['exist']==1){ ?>
					<div class="alert alert-danger d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
						<span class="flex-shrink-0 me-2 material-symbols-rounded">warning</span>
						<span> Given Album Title Alredy Exist </span>
					</div>
				<?php } else if((!empty($_GET['succ']) && $_GET['succ']==1) || (!empty($_GET['succ']) && $_GET['succ']==2) || (!empty($_GET['succ']) && $_GET['succ']==3) || (!empty($_GET['succ']) && $_GET['succ']==4)){ ?>
					<div class="alert alert-success d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
						<span class="flex-shrink-0 me-2 material-symbols-rounded">check_circle</span>
						<?php if(!empty($_GET['succ']) && $_GET['succ']==1){ ?>
							<span> New Album Created Successfully </span>
						<?php } else if(!empty($_GET['succ']) && $_GET['succ']=='success'){ ?>
							<span> Selected Album Details Deleted Successfully </span>
						<?php } else if(!empty($_GET['succ']) && $_GET['succ']==4){ ?>
							<span> Selected Album Details Modified Successfully </span>
						<?php } else if(!empty($_GET['titid'])){ ?>
							<span> Album Adjusted Successfully </span>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>


      	<form id="form1" name="form1" method="post" action="">
		
			<?php
				$max_recs_per_page=30;
				$select=executework("select * from  tob_album_title order by position desc");
				$count=@mysqli_num_rows($select);
			?>

			
		<div class="row">
			<?php if($count > 0) { ?>
				<h2 class="admin-title col">Total Albums - <?php echo $count; ?> </h2>
			<?php } ?>
		
			<div class="col">

			<?php if ($count > 0){
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

				$select1= executework("select * from  tob_album_title order by position desc LIMIT $pagenow1, $max_recs_per_page");
				$count1 = @mysqli_num_rows($select1);
	
				if($pages > 1){ ?>
				<ul class="pagination">
					<?php for($im=1;$im<=$pages;$im++) {
						if($page12 != $im){ ?>
							<li class="page-item"><a class="page-link hlink1" href="albumdelete.php?page_index=<?php echo "$im" ?>"><?php echo "$im" ?></a></li>
						<?php } else{ ?>
							<li class="page-item active" aria-current="page"> <span class="page-link"><?php echo "$im" ?></span> </li>
						<?php } } ?>
					</ul>
				<?php } ?>
			</div>
		</div>

	
		<?php if($count > 0) {  ?> 
				

		<div class="table-responsive">
			<table class="table table-bordered ">
				<thead class="text-center">
					<tr>
						<th>SL No </th>
						<th>Album Title </th>
						<th>Album Cover Image </th>
						<th style="min-width: 100px">Actions</th>
						<th>Move</th>
					</tr>
				</thead>
				<tbody>

				<?php $i=1;
				while($row=@mysqli_fetch_array($select1)) {
					$selimg=executework("select * from tob_images where titleid='".$row['id']."' and cover=1");
					$cntt=@mysqli_num_rows($selimg);
					$rowt=@mysqli_fetch_array($selimg);
					if($cntt>0)
					$immg="<img src='../tbdata/photogallery/thimages/". $rowt['image']."' height=80 width=100 />";
					else
					$immg="";
					
					$selimg1=executework("select * from tob_images where titleid='".$row['id']."'");
					$cntt1=@mysqli_num_rows($selimg1);
					$rowt1=@mysqli_fetch_array($selimg1);
				?>
		   
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $row['title'];?></td>
					<td><?php echo $immg ?></td>
					<td><a href="modphotogallery.php?titid=<?php echo $row['id'] ?>"> Album Images</a></td>
					
					<td>
						<?php if($i!=1) { ?> 
							<a href="#" onclick="moveto('<?php echo $row['id'] ?>','up');"><img src="tob2_imgs/uparrow.jpg" height="40" width="40" /></a>
						<?php }  if($i!=$count) {  ?>
							<a href="#" onclick="moveto('<?php echo $row['id'] ?>','down');"><img src="tob2_imgs/downarrow.jpg" height="40" width="40" /></a>
						<?php } ?>
					</td>
                            
        		<?php $i++; } } ?>
				</tbody>
			</table>
		</div>

		<?php } else  { ?>
			<div class="text-center text-secondary">No Albums Found</div>
		<?php } ?>



		<?php if ($pages > 1) { ?>
			<div class="text-end">
				<?php if($page_index != 1){
					$pre=$page_index-1; ?>
					<button name="button" type="button" class="btn btn-sm btn-primary fbutton" onclick="location.href='imagelist.php?page_index=<?php echo $pre ?>'" />Previous</button>
				<?php
				}
				if($page_index < $pages) {
				$next=$page_index+1; ?>
					<button name="button" type="button" class="btn btn-sm btn-primary fbutton" onclick="location.href='imagelist.php?page_index=<?php echo $next ?>'" />Next  </button>
				<?php } ?>
			</div>
        <?php } ?>

      </form>


</main>

</section>



<?php include_once("footer.php");?>



<script>
function moveto(st,st1){
	document.form1.action="albummodify.php?movid="+st+"&act="+st1;
	document.form1.submit();
}
</script>
<script type="text/javascript">
function modfy2(st,st1,st2,i){
	var val=document.getElementById("hfdel"+i).value;
	if(confirm("Are You Sure To Delete This Album Detailes Completely?Album contains "+val+" Image(s)")){
		location.href="albumdelete.php?pedit="+st+"&title="+st1+"&page_index="+st2;

	}
}
function modfy1(st,st1,st2){
	if(confirm("Are You Sure To Modify This Album images")){
		location.href="pimagemod.php?pedit="+st+"&title="+st1+"&page_index="+st2;

	}
}
</script>

<?php } else { ?>
	<script language="javascript">parent.location.href="index.php";</script>
<?php } ?>



</body>
</html>