<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION["tobadmin"]))
{
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

	function numround($st,$n)
	{
		if($st!="")
		{
			$n1=pow(10 ,$n);
			$num=round($st*$n1)/($n1);
		}
		return $num;
	}


if(!empty($_GET['id']))
$id=$_GET['id'];
else if(!empty($_POST['id']))
$id=$_POST['id'];
else
$id='';

	if(!empty($_GET['edit']))
	{
		if($_GET['edit']=="delet")
		{
			$select=executework("select * from tob_export where id='".$id."'");
			$drow=@mysqli_fetch_array($select);
			$tupdate=executework("delete from tob_export where id='".$id."'");	
			redirect("export_per.php?succ=4");
		}
		else
		{
			if(!empty($_POST['subm']))
			{
					$tinsert=executework("update tob_export set quantity='".make_safe($_POST['qty']) ."',value='". make_safe($_POST['val']) ."',valued='". make_safe($_POST['vald']) ."' where id='".$id."'");
					redirect("export_per.php?succ=3");
			}
		}
	}
	else if(!empty($_POST['subm']))
	{
		$date=date("Y-m-d",time()+19800);
		$tselect=executework("select * from tob_export where catg='".make_safe($_POST['catg'])."' and month='".make_safe($_POST['month'])."' and year='".make_safe($_POST['year'])."'");
		$tcnt=@mysqli_num_rows($tselect);
		if($tcnt>0)
		{
			redirect("export_per.php?exist=1");
		}
		else
		{
			$intmax=executework("SELECT max(id) from tob_export");
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
			$tinsert=executework("insert into tob_export values($maxid,'". make_safe($_POST['catg']) ."',". make_safe($_POST['month']) .",". make_safe($_POST['year']) .",". make_safe($_POST['qty']) .",". make_safe($_POST['val']) .",'',1)");
			redirect("export_per.php?succ=1");
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  	<?php include_once("head.php")?>
	<title>Export Performance | Tobacco Board</title>
</head>
<body>

<section id="adminLayout">

	<?php include "header.php" ?>

	<?php include "sidebar.php"; ?>
	
	<main id="adminMain" class="container-fluid">
		
	<h2 class="admin-title">Export Performance</h2>

	<div id="adminTab">
	<nav>
		<div class="nav nav-tabs align-items-center" id="nav-tab" role="tablist">
			<button class="nav-link <?php if(empty($_GET['page_index'])){ ?> active <?php } ?>" id="post-tab" data-bs-toggle="tab" data-bs-target="#post-export" type="button" role="tab" aria-controls="post-export" aria-selected="true">Post Export</button>
			<button class="nav-link <?php if(!empty($_GET['page_index']) && $_GET['page_index']!=""){ ?> active <?php } ?>" id="view-tab" data-bs-toggle="tab" data-bs-target="#view-export" type="button" role="tab" aria-controls="view-export" aria-selected="false">View Export</button>
			
			<?php if(!empty($_GET['exist']) && $_GET['exist']==1){ ?>
				<div class="alert alert-danger d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">warning</span>
					<span>Given Export Details Alredy Exist</span>
				</div>
			<?php } else if((!empty($_GET['succ']) && $_GET['succ']==1) || (!empty($_GET['succ']) && $_GET['succ']==2) || (!empty($_GET['succ']) && $_GET['succ']==3) || (!empty($_GET['succ']) && $_GET['succ']==4)){ ?>
				<div class="alert alert-success d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">check_circle</span>
					<?php if(!empty($_GET['succ']) && $_GET['succ']==1){ ?>
						<span> New Export Details Posted Successfully </span>
					<?php } else if(!empty($_GET['succ']) && $_GET['succ']==2){ ?>
						<span> Selected Statistics Successfully Move To Archives </span>
					<?php } else if(!empty($_GET['succ']) && $_GET['succ']==3){ ?>
						<span>Selected Export Details Modified Successfully </span>
					<?php } else if(!empty($_GET['succ']) && $_GET['succ']==4){ ?>
						<span> Selected Export Details Deleted Successfully</span>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</nav>

	<div class="tab-content" id="nav-tabContent">
		<div class="tab-pane fade <?php if(empty($_GET['page_index'])){ ?> show active <?php } ?>" id="post-export" role="tabpanel" aria-labelledby="post-export-tab" tabindex="0">
			
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check(this);">
	<?php
		$tselect=executework("select * from tob_export where id='".$id."'");
		$tcnt=@mysqli_num_rows($tselect);
		if((empty($_GET['edit']) && empty($id)) || (!empty($_GET['edit']) && $tcnt>0))
		{
			$trow=@mysqli_fetch_array($tselect);
	?>

			<div class="row align-items-end">
				<div class="form-group col-md-6">
					<label for="month" class="form-label">Month &amp; Year</label>
					<div class="row">
						<div class="col-md-6">
							<select name="month" id="month" class="form-select">
								<option value="" selected="selected">Select</option>
								<option value="1">January</option>
								<option value="2">February</option>
								<option value="3">March</option>
								<option value="4">April</option>
								<option value="5">May</option>
								<option value="6">June</option>
								<option value="7">July</option>
								<option value="8">August</option>
								<option value="9">September</option>
								<option value="10">October</option>
								<option value="11">November</option>
								<option value="12">December</option>
							</select> 
							<?php
							if(!empty($trow['month']))
							$mn1=$trow['month'];
							else if(!empty($_POST['month']))
							$mn1=$_POST['month'];
							else
							$mn1='';

							if($mn1!="")
							{
							?>
							<script type="text/javascript">
								var mn1='<?php echo $mn1 ?>';
								var j;
								for(j=0;j<document.form1.month.options.length;j++) {
									if(document.form1.month.options[j].value==mn1) {
										document.form1.month.options[j].selected=true;
									}
								}
							</script>
						<?php } ?> 
						</div>
						<div class="col-md-6">
							 <select name="year" id="year" class="form-select">
								<option value="" selected>Select</option>
								<?php $y=date('Y'); for($i=$y;$i>=2005;$i--) { ?>
									<option value="<?php echo $i ?>"><?php echo $i ?></option>
								<?php } ?>
							</select>
						<?php
							if(!empty($trow['year']))
							$yr1=$trow['year'];
							else if(!empty($_POST['year']))
							$yr1=$_POST['year'];
							else
							$yr1='';

							if($yr1!="")
							{
							?>
							<script type="text/javascript">
								var yr1='<?php echo $yr1 ?>';
								var j;
								for(j=1;j<=document.form1.year.options.length;j++)
								{
									if(document.form1.year.options[j].value==yr1)
									{
										document.form1.year.options[j].selected=true;
									}
								}
							</script>
						<?php } ?>
						</div>
					</div>
				</div>

				<div class="form-group col-md-6">
					<label for="month" class="form-label">Category</label>
					<select name="catg" id="catg" class="form-select">
						<option value="">Select</option>
						<option value="FCV">FCV</option>
						<option value="Non FCV">Non FCV</option>
						<option value="Refuse Tobacco">Refuse Tobacco</option>
						<option value="Tobacco Products">Tobacco Products</option>
						<option value="Unmanufactured Tobacco">Unmanufactured Tobacco</option>
					</select>

					<?php
						if(!empty($trow['catg']))
						$ct=$trow['catg'];
						else if(!empty($_POST['catg']))
						$ct=$_POST['catg'];
						else
						$ct='';

						if($ct!="")
						{
						?>
						<script type="text/javascript">
							var ct='<?php echo $ct ?>';
							var j;
							for(j=0;j<document.form1.catg.options.length;j++)
							{
								if(document.form1.catg.options[j].value==ct)
								{
									document.form1.catg.options[j].selected=true;
								}
							}
						</script>
					<?php }  ?>
				</div>
				<div class="form-group col-md-6">
					<label for="qty" class="form-label">Quantity</label>
					<input name="qty" type="text" id="qty" size="30" class="form-control" value="<?php if(!empty($trow['quantity'])) echo numround($trow['quantity'],3)?>" />
				</div>
				<div class="form-group col-md-6">
					<label for="val" class="form-label">Value (Rs)</label>
					<input name="val" type="text" id="val" size="30" class="form-control" value="<?php if(!empty($trow['value'])) echo numround($trow['value'],2)?>" />
				</div>
				<div class="form-group col-md-6">
					<label for="vald" class="form-label">Value ($)</label>
					<input name="vald" type="text" id="vald" size="30" class="form-control" value="<?php if(!empty($trow['valued'])) echo numround($trow['valued'],2)?>" />
				</div>


				<div class="submit-button text-end col-md-6 form-group">
					<a href="export_gsettings.php" class="btn btn-secondary">Export Graphsettings</a>
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

			</div>  
			
	<?php } else { redirect("invalidaccess.php"); } ?>

</form>

</div>

	
	<div class="tab-pane fade <?php if(!empty($_GET['page_index']) && $_GET['page_index']!=""){ ?> show active <?php } ?>" id="view-export" role="tabpanel" aria-labelledby="view-export-tab" tabindex="1">

		<?php
			$max_recs_per_page=30;
			$select=executework("select * from tob_export order by year desc,month desc");
			$count=@mysqli_num_rows($select);
		?>

		<div class="d-flex align-items-center justify-content-between my-3">
			<h4 class="sub-title no-dash mb-0">Total Statistics - <?php echo $count ?></h4>
  
                <?php
				if ($count > 0) {
					if (empty($_GET['page_index']))
					{
						$page_index=1;
					}	
					else
					{
						$page_index=$_GET['page_index'];
					}
					$total_recs = $count;
					$pages = $count / $max_recs_per_page; 
					if ($pages < 1)
					{ 
						$pages = 1; 
					}
					if ($pages / (int) $pages <> 1)
					{ 
						$pages = (int) $pages + 1; 
					} 
					else
					{ 
						$pages = $pages; 
					}
					$page12=(int) $page_index;
					
					$pagenow1 = ($max_recs_per_page*($page12-1)); 

					$select1= executework("select * from tob_export order by year desc,month desc LIMIT $pagenow1, $max_recs_per_page");
					$count1 = @mysqli_num_rows($select1);
	
				if($pages > 1){ ?>
				<ul class="pagination">
					<?php for($im=1;$im<=$pages;$im++) {
						if($page12 != $im){ ?>
							<li class="page-item"><a class="page-link hlink1" href="export_per.php?page_index=<?php echo "$im" ?>"><?php echo "$im" ?></a></li>
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
							<th>Month </th>
							<th>Category</th>
							<th>Quantity</th>
							<th>Value(Rs.)</th>
							<th style="display:none">Value($)</th>
							<th style="min-width: 130px">Actions</th>
						</tr>
					</thead>
					<tbody>
				
                    <?php
					$i=$pagenow1+1;
					while($row=@mysqli_fetch_array($select1))
					{
						if(!empty($row['tfile']))
						$link="statisticsfiles/".$row['tfile'];
						else
						$link="#";
						$mn=$month_name = date( 'F', mktime(0, 0, 0, $row['month'], 10) );
					?>

                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><div align="center"><?php echo $mn."-".$row['year'];?></td>
                      <td><?php echo $row['catg']?></td>
                      <td><?php echo numround($row['quantity'],3)?></td>
                      <td><?php echo numround($row['value'],2);?></td>
                      <td style="display:none"><?php echo numround($row['valued'],2);?></td>
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
					<button name="button" type="button" class="btn btn-sm btn-primary fbutton" onclick="location.href='export_per.php?page_index=<?php echo $pre ?>'" />Previous</button>
				<?php
				}
				if($page_index < $pages) {
				$next=$page_index+1; ?>
					<button name="button" type="button" class="btn btn-sm btn-primary fbutton" onclick="location.href='export_per.php?page_index=<?php echo $next ?>'" />Next  </button>
				<?php } ?>
			</div>
        <?php } ?>
 
	</div>
</div>

</main>

</section>

<?php include_once("footer.php");?>


<script type="text/javascript">
function check(form1)
{
	if(document.form1.month.value=="")
	{
		alert("Month Should Not Be Empty");
		document.form1.month.focus();
		return false;
	}
	else if(document.form1.year.value=="")
	{
		alert("Year Should Not Be Empty")
		document.form1.year.focus();
		return false;
	}
	else if(document.form1.catg.value=="")
	{
		alert("Category Should Not Be Empty");
		document.form1.catg.focus();
		return false;
	}
	else if(document.form1.qty.value=="")
	{
		alert("Quantity Should Not Be Empty");
		document.form1.qty.focus();
		return false;
	}
	else if(isNaN(document.form1.qty.value)==true)
	{
		alert("Quantity Should Be A number");
		document.form1.qty.value="";
		document.form1.qty.focus();
		return false;
	}
	else if(document.form1.val.value=="")
	{
		alert("Value(Rs.) Should Not Be Empty");
		document.form1.val.focus();
		return false;
	}
	else if(isNaN(document.form1.val.value)==true)
	{
		alert("Value(Rs.) Should Be A number");
		document.form1.val.value="";
		document.form1.val.focus();
		return false;
	}
	/*else if(document.form1.vald.value=="")
	{
		alert("Value($) Should Not Be Empty");
		document.form1.vald.focus();
		return false;
	}
	else if(isNaN(document.form1.vald.value)==true)
	{
		alert("Value($) Should Be A number");
		document.form1.vald.value="";
		document.form1.vald.focus();
		return false;
	}*/
	else
	{
		document.form1.subm.value=1;
		return true
	}
}
function delet(st,st1)
{
	if(confirm("Are You sure to Delete Selected Export Details Completely"))
	{
		location.href="export_per.php?id="+st+"&edit="+st1;
	}
}

function del(st,st1)
{
	if(confirm("Are You sure to Move Archive Selected Statistics Details"))
	{
		location.href="export_per.php?id="+st+"&edit="+st1;
	}
}
function modf(st,st1)
{
	if(confirm("Are You sure to Modify Selected export Details"))
	{
		location.href="export_per.php?id="+st+"&edit="+st1;
	}
}
function back1()
{
	location.href="export_per.php";
}
</script>



<?php } else { ?>
	<script language="javascript">parent.location.href="index.php";</script>
<?php } ?>


</body>
</html>