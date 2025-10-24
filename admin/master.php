<?php
	ob_start();
	session_start();
	include("include/includei.php");
	include("header.php");
if(!empty($_SESSION['tobadmin'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
  	<?php include_once("head.php")?>
	<title>Location | Tobacco Board</title>
</head>
<body>

<section id="adminLayout">

	<?php include "header.php" ?>

	<?php include "sidebar.php"; ?>
	
	<main id="adminMain" class="container-fluid">

	<div class="row">
		<h2 class="admin-title col">Location</h2>

		<div class="col-auto">
			<?php if(!empty($_GET['succ']) && $_GET['succ']==2){ ?>
				<div class="alert alert-danger d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">warning</span>
					<span>Given Data Already Exists</span>
				</div>
			<?php } else if((!empty($_GET['succ']) && $_GET['succ']==7) || (!empty($_GET['succ']) && $_GET['succ']==3) || (!empty($_GET['succ']) && $_GET['succ']==1)){ ?>
				<div class="alert alert-success d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">check_circle</span>
					<?php if(!empty($_GET['succ']) && $_GET['succ']==7){ ?>
						<span> Location Updated Successfully</span>
					<?php } else if(!empty($_GET['succ']) && $_GET['succ']==3){ ?>
						<span> Given Details are Deleted Successfully </span>
					<?php } else if(!empty($_GET['succ']) && $_GET['succ']==1){ ?>
						<span>Data Inserted Successfully</span>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</div>

<body>
<?php
if(!empty($_POST['subm']) && $_POST['subm']==2) {
	$n=$_POST['n'];
	$str="";
	for($i=1;$i<=$n;$i++) {
		$chk="chk".$i;
		$chkk="chkk".$i;
		if($_POST[$chk]!="") {
			if($_POST[$chkk]==1)
			{
				//if(count($arr[0])>0)
				//$sttr=implode(',',$arr[0]);
				if($str=="")
				$str=mysqli_real_escape_string($_POST[$chk]);
				else
				$str=$str.",".mysqli_real_escape_string($_POST[$chk]);
			}
		}
	}
if($str!="") {
	$upd=executework("delete from tob_location where id in(".$str.")");
	redirect("master.php?succ=3");
	}
}

if(!empty($_POST['subm']) && $_POST['subm']!=2) {
	echo $newf=$_POST['addnew'];
	if($newf=='State')
	{
		$fld='nstate';
		$fld1=0;
	}
	else if($newf=='District')
	{
		$fld='ndistrict';
		$fld1=$_POST['state'];
	}

	$selpy=executework("select * from tob_location where precatid=".mysqli_real_escape_string($fld1)." and name='".mysqli_real_escape_string($_POST['nstate'])."'");
	$rowpoy=@mysqli_fetch_array($selpy);
	 $count=@mysqli_num_rows($selpy);
	if($count > 0) {
		redirect("master.php?succ=2");
	}
	
	else if($_POST['edt']!="") {
			$upd=executework("update tob_location set name='".mysqli_real_escape_string($_POST['mlocation'])."' where id=".mysqli_real_escape_string($_POST['edt']));
			redirect("master.php?succ=7");
	}
	else {
	
		$ins=executework("insert into tob_location values('','".mysqli_real_escape_string($newf)."','".mysqli_real_escape_string($fld1)."','".mysqli_real_escape_string($_POST[$fld])."',1)");
		redirect("master.php?succ=1");
	}
}
?>
<form id="form1" name="form1" method="post" action="master.php" onsubmit="return validation();" >
	<?php
	if(!empty($_GET['cid'])) {
		$selny=executework("select * from tob_location where id=".mysqli_real_escape_string($_GET['cid']));
		$rowny=@mysqli_fetch_array($selny);
	}
	?>

	<?php if(empty($_GET['cedit'])) { ?>
		
		<div class="row align-items-end">
			<div class="form-group col-md-6">
				<label for="addnew">Add New</label>
				<select name="addnew" id="addnew" onchange="form1.submit();" class="form-select">
					<option value="" selected>Select</option>
					<option value="State" <?php if(!empty($_POST['addnew']) && $_POST['addnew']=='State') { ?> selected="selected"<?php } ?>>State</option>
					<option value="District" <?php if(!empty($_POST['addnew']) && $_POST['addnew']=='District') { ?> selected="selected"<?php } ?>>District</option>
				</select>
			</div>

			<?php
			//$selectr=executework("select * from tob_location where precatid=0");
			if(isset($_POST['addnew']) && $_POST['addnew']!='State') {
				$stru=" and precatid=0";
				$selu=executework("select * from tob_location where tfield='State'".$stru." order by name");
				//echo "select * from tob_location where tfield='State'".$stru." order by name";
				
			?>	
			
			<div class="form-group col-md-6">
				<label for="state">State</label>
				<select name="state" id="state" onchange="form1.submit();" class="form-select">
					<?php while($rowr=@mysqli_fetch_array($selu)) { ?>
						<option value="<?php echo $rowr['id'] ?>" <?php if($_POST['state']==$rowr['id']) { ?> selected="selected" <?php } ?>><?php echo $rowr['name'] ?></option>
					<?php } ?>
				</select>
			</div>
			
			<?php } if(!empty($_POST['addnew']) && $_POST['addnew']=='State') { ?>	
				
			<div class="col-md-6 form-group">
				<label for="nstate" class="form-label">New State</label>
				<input class="form-control" name="nstate" type="text" id="nstate" />
			</div>
			 
			<?php }
			//$str=executework("select * from tob_location precatid='".$rowr['id']."'");
			if(isset($_POST['addnew']) && $_POST['addnew']!="State" && $_POST['addnew']!="District") {
			
			$struo=" and name=".mysqli_real_escape_string($_POST['state'])."";
			$str=executework("select * from tob_location where tfield='District'".$struo." order by name");
			//echo "select * from tob_location where tfield='District'".$struo." order by name";

			?>
			
			<div class="form-group col-md-6">
				<label for="district">District</label>
				<select name="district" id="district" class="form-select">
					<?php while($ror=@mysqli_fetch_array($str)) { ?>
						<option value="<?php echo $ror['id'] ?>" <?php if($_POST['district']==$ror['id']) { ?> selected="selected" <?php } ?>><?php echo $ror['name'] ?></option>
					<?php } ?>
				</select>
			</div>
			 
		<?php } if(!empty($_POST['addnew']) && $_POST['addnew']=='District') { ?>
			
			<div class="col-md-6 form-group">
				<label for="ndistrict" class="form-label">New District</label>
				<input class="form-control" name="ndistrict" type="text" id="ndistrict" />
			</div> 
		<?php } }
		if(!empty($_GET['cedit'])) { ?>	

			<div class="col-md-6 form-group">
				<label for="mlocation" class="form-label">Modify</label>
				<input class="form-control" name="mlocation" type="text" id="mlocation"  value="<?php echo $rowny['name'] ?>" />
			</div>  
		<?php }

		if(!empty($_POST['addnew']) || !empty($_GET['cedit'])) { ?> 

			<div class="form-group col-md-6 text-end">
            	<input name="edt" type="hidden" id="edt" value="<?php if(!empty($_GET['cid'])) echo $_GET['cid'] ?>" />
				<input type="button" class="btn btn-light" name="Submit2" value="Cancel" onclick="location.href='master.php'" />
				<input type="submit" class="btn btn-primary" name="Submit" value="Submit" />
			</div>
	</div>

	<?php } ?>
<table width="80%" border="0" align="center">
			<tr>
			<td><table width="98%" border="0" align="center">
				<tr>
					<td><?php
											  $ct='';$f='';
		if(!empty($_POST['addnew']))
		$ct=" and tfield='".$_POST['addnew']."'";
		else if(!empty($_POST['states']))
		$f=$_POST['states'];
		else if(!empty($_POST['district']))
		$f=$_POST['district'];
		else
		$f='';
		if($f!="") {
			$arr=get_gensubcat("tob_location","tfield","precatid","id",0,'',$f);
			if(count($arr[0])>0)
			{
				$str=implode(',',$arr[0]);
				$ct.=" and id in (".$str.")";
			}
		}
		$selloc=executework("select * from tob_location where id<>'' ".$ct." order by tfield,precatid,name");
		$max_recs_per_page=20;
		$count=@mysqli_num_rows($selloc);
      ?>
				<table width="90%" align="center" cellpadding="0" cellspacing="4">
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

				$select1= executework("select * from tob_location where id<>'' ".$ct." order by field(tfield,'State','District'),precatid,name LIMIT $pagenow1, $max_recs_per_page");
				
				//echo "select * from tob_location where id<>'' ".$ct." order by field(tfield,'State','District'),precatid,name LIMIT $pagenow1, $max_recs_per_page";
				$count1 = @mysqli_num_rows($sql1);
	
	if($pages > 1) {
	?>
				<tr>
				<td colspan="3" align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Page&nbsp; <span class="style3">
				<?php
				for($im=1;$im<=$pages;$im++)
				{
				if($page12 != $im)
				{
				?>
				<a href="tob/location.php?page_index=<?php echo "$im" ?>" class="b"><?php echo "$im" ?></a>&nbsp;
				<?php
				}
				else
				{
				?>
				<font color="red"><?php echo "$im" ?></font>&nbsp;
				<?php
				}
				}
				?>
				</span> </strong></font></td>
				</tr>
				<?php
				}
				?>
				</table></td>
				</tr>
                                            <tr>
                                              <td><table width="100%" border="1" align="center" cellpadding="2" cellspacing="0" bgcolor="#FFFFFF">
                          <tr class="style17">
  <td width="50" bgcolor="#FFFFFF"><div align="center" class="style14 style21">
    			<div align="center">SL No </div>
                            </div></td>
                            <td width="118" bgcolor="#FFFFFF"><div align="center"><strong><span class="style14">Category</span></strong></div></td>
                            <td width="155" bgcolor="#FFFFFF"><div align="center"><strong><span class="style14">Main Location </span></strong></div></td>
                            <td width="155" bgcolor="#FFFFFF"><div align="center"><strong><span class="style14">Location</span></strong></div></td>
                            <td bgcolor="#FFFFFF"><div align="center"></div></td>
  <td bgcolor="#FFFFFF"><div align="center"><strong>
                                                        <input type="button" name="Submit32" value="  Delete  " onClick="del_location()"/>
                            </strong></div></td>
                                                </tr>


		<?php $i=$pagenow1+1;
			while($row=@mysqli_fetch_array($select1)) {
				$seli=executework("select count(*) from tob_location where precatid=".mysqli_real_escape_string($row['id']));
				//echo "select count(*) from tob_location where precatid=".$row['id'];
				$rowi=@mysqli_fetch_array($seli);
				//print_r($rowi);
				
					$selkt=executework("select * from tob_location where id=".mysqli_real_escape_string($row['precatid']));
					//echo "select * from tob_location where id=".$row['precatid'];
					$rowkt=@mysqli_fetch_array($selkt);
			//print_r($rowkt);		
						//$cnt=get_locationcnt();
				?>
					<tr class="style17">
					<td bgcolor="#FFFFFF"><div align="center"><span class="style15" ><?php echo $i; ?></span></div></td>
					<td bgcolor="#FFFFFF"><span class="style15" > &nbsp; <?php echo $row['tfield'];?></span></td>
					<td bgcolor="#FFFFFF"><span class="style15" > &nbsp; <?php echo $rowkt['name'];?></span></td>
					<td bgcolor="#FFFFFF"><span class="style15" > &nbsp; <?php echo $row['name'];?></span>
						<input name="chk<?php echo $i ?>" type="hidden" id="chk<?php echo $i ?>" value="<?php echo $row['id'] ?>" /></td>
					<td width="77" bgcolor="#FFFFFF"><div align="center">
	<input type="button" name="Submit22" value="  Modify  " onClick="mod_location('Modify','<?php echo $row['id'] ?>','<?php echo $page_index ?>')" />
					</div></td>
					<td width="85" bgcolor="#FFFFFF"><div align="center">
						<label>
						<input name="chkk<?php echo $i ?>" type="checkbox" id="chkk<?php echo $i ?>" value="1" />
						</label>
					</div></td>
					</tr>
					<?php
	$i++;
	}
	}
	?>
				</table>
				<input name="n" type="hidden" id="n" value="<?php echo $i-1 ?>" />
				<input name="subm" type="hidden" id="subm" /></td>
			</tr>
			</table>



				<?php if ($pages > 1) { ?>
					<div class="text-end">
						<?php if($page_index != 1){
							$pre=$page_index-1; ?>
							<button name="button" type="button" class="btn btn-sm btn-primary fbutton" onclick="location.href='category.php?page_index=<?php echo $pre ?>'" />Previous</button>
						<?php
						}
						if($page_index < $pages) {
						$next=$page_index+1; ?>
							<button name="button" type="button" class="btn btn-sm btn-primary fbutton" onclick="location.href='category.php?page_index=<?php echo $next ?>'" />Next  </button>
						<?php } ?>
					</div>
				<?php } ?>
  
</form>

</main>

</section>

<?php include_once("footer.php");?>

<script>
function validation() {
	if(document.form1.edt.value!='') {
		if(document.form1.mlocation.value=='') {
			alert("Enter value");
			document.form1.mlocation.focus();
			return false;
		}
	}
	else
	{
		if(document.form1.addnew.value=='') {
			alert("Select what is to be added");
			document.form1.addnew.focus();
			return false;
		}
		else if(document.form1.addnew.value=='State' && document.form1.nstate.value=='') {
			alert("Enter State");
			document.form1.nstate.focus();
			return false;
		}
		else if(document.form1.addnew.value!='State' && document.form1.state.value=='') {
			alert("Select State");
			document.form1.state.focus();
			return false;
		}
		else if(document.form1.addnew.value!='State' && document.form1.ndistrict.value=='') {
			alert("Enter District");
			document.form1.ndistrict.focus();
			return false;
		}
	}
	document.form1.subm.value=1;
	return true
}
function mod_location(st,st1,st2) {
	if(confirm("Are You Sure To "+st+" Selected Location Detailes")) {
		location.href="master.php?cedit="+st+"&cid="+st1+"&page_index="+st2;

	}
	else
	return false;
}
function del_location() {
	if(confirm("Are You Sure To Delete Selected Location And Its Sub Locations")) {
		document.form1.subm.value=2;
		document.form1.submit();
	}
	else
	return false;
}
</script>



<?php } else { ?>
	<script language="javascript">parent.location.href="index.php";</script>
<?php } ?>

</body>
</html>