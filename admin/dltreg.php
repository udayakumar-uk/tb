<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION['tobadmin'])) {
$select1=executework("select * from tob_reg order by tdate desc");
$cnt=@mysqli_num_rows($select1);
	
	if(!empty($_GET['delt'])) {
		$seld=executework("select * from tob_reg where id=".mysqli_real_escape_string($_GET['delt']));
		$rowd=@mysqli_fetch_array($seld);
		$delid=executework("delete from tob_reg where id=".mysqli_real_escape_string($_GET['delt']));
		redirect("dltreg.php?dsuc=1");
	}
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

	function numround($st,$n) {
		if($st!="") {
			$n1=pow(10 ,$n);
			$num=round($st*$n1)/($n1);
		}
		return $num;
	}

if(!empty($_POST['delet'])) {
	$ids="";
	for($i=1;$i<=$_POST['n'];$i++) {
		if($_POST['delt'.$i]!="") {
			if($ids=="")
			$ids=mysqli_real_escape_string($_POST['delt'.$i]);
			else
			$ids.=",".mysqli_real_escape_string($_POST['delt'.$i]);
		}
	}
	$del=executework("delete from tob_reg where id in (".$ids.")");
	redirect("dltreg.php?succ=1");
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
	

<?php
if(!in_array('DELETE',$detai)) {
	redirect("employeedata.php");
}
?>
	<main id="adminMain" class="container-fluid">

	<h2 class="admin-title col">Tenders Registration </h2>

	<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" >

	<?php
		$max_recs_per_page=25;
		if($cnt>0) {
			if (empty($_GET['page_index'])) {
		$page_index=1;
			}	
			
			else {
			$page_index=$_GET['page_index'];
			}
			
			$total_recs = $cnt;
			$pages = $cnt / $max_recs_per_page; 
			
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
//	if($pages==$_GET['page_index'])
//	$pagenow2=$cnt;
//	else
	$pagenow2 = $pagenow1+$max_recs_per_page; 
	$select=executework("select * from tob_reg order by tdate desc LIMIT $pagenow1, $max_recs_per_page");
?>

		<div class="text-center">
			<span><?php echo $pagenow1+1 ?></span> To 
			<span><?php echo $pagenow2 ?></span> Of 
			<span><?php echo $cnt; ?></span>
		</div>

		<?php if($pages > 1){ ?>
		<ul class="pagination flex-wrap justify-content-center my-3">
			<?php for($im=1;$im<=$pages;$im++) {
			if($page12 != $im){ ?>
				<li class="page-item"><a class="page-link hlink1" href="dltreg.php?page_index=<?php echo "$im" ?>"><?php echo "$im" ?></a></li>
			<?php } else{ ?>
				<li class="page-item active" aria-current="page"> <span class="page-link"><?php echo "$im" ?></span> </li>
			<?php } } ?>
		</ul>
		<?php } ?>

		
		<div class="table-responsive">
			<table class="table table-bordered ">
				<thead class="text-center">
					<tr>
						<th><button type="button" class="btn icon-btn btn-danger" name="button" id="button" value="Delete" onclick="delt_bulk();"><span class="material-symbols-rounded">delete</span></button> </th>
						<th>S.No.</th>
                        <th>Date</th>
                        <th>Tender No </th>
                        <th>Name of Company</th>
                        <th>Address  </th>
                        <th>Email_Id</th>
                        <th>Phone No</th>
                        <th>Fax No</th>
						<th>Website</th>
						<th>Cantact Persion</th>
						<th>Designation</th>
						<th>Mobile No</th>
                    </tr>
				</thead>
				<tbody>

					<?php
					$i=1;
					$j=$pagenow1+1;
					while($row=@mysqli_fetch_array($select)) {
						$seltnd=executework("select * from tob_tender where id=".$row['tenderid']);
						$rowd=@mysqli_fetch_array($seltnd);
					?>

					<tr>
 
						<td><div class="form-check"><input name="delt<?php echo $i ?>" type="checkbox" class="form-check-input" id="delt<?php echo $i ?>" value="<?php echo $row['id'] ?>" /></div></td>
						<td><?php echo $j ?></td>
						<td><?php if($row['tdate']!="" && $row['tdate']!='0000-00-00') { echo datepattrn($row['tdate']); } ?>&nbsp;</td>
                        <td><?php echo $rowd['tenderno'] ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['addrs'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['ph_no'] ?></td>
                        <td><?php echo $row['fax_no'] ?></td>
						<td><?php echo $row['website'] ?></td>
						<td><?php echo $row['cpersion'] ?></td>
						<td><?php echo $row['designation'] ?></td>
						<td><?php echo $row['mob_no'] ?></td>
                      </tr>
					<?php
						$i++;$j++;
					}
					?>
  </table>
 <?php
		}
 ?>                 
                    <input name="n" type="hidden" id="n" value="<?php echo $i-1 ?>" />
                    <input type="hidden" name="delet" id="delet" />
</form>

</main>

</section>

<?php include_once("footer.php");?>


<script language="javascript">
function delt(st) {
	if(confirm("Are You Sure To Delete This  Registration?"))
	location.href="dltreg.php?delt="+st;
	else
	return false;
}
function delt_bulk() {
	if(confirm("Are You Sure To Delete Selected Registrations?")) {
		var n=document.form1.n.value;
		var s=0;
		for(i=1;i<=n;i++) {
			if(document.getElementById("delt"+i).checked==true) {
				s=1;
			}
		}
		if(s==0) {
			alert("Select records to delete");
			return false;
		}
		else {
			document.form1.delet.value=1;
			document.form1.submit();
		}
	}
	else
	return false;
}
function pageindex(st,st1) {
	
	if(st!="" && st1!="") {
		var x=document.form1.action=st1+"?page_index="+st;
		document.form1.submit();
	}
	else
	{
	return false;
	}

}
</script>

<?php } else { ?>
	<script language="javascript">parent.location.href="index.php";</script>
<?php } ?>


</body>
</html>