<?php 
ob_start();
@session_start();
include "include/include.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title> Publications | Tobacco Board</title>
	
	<?php include "head.php"; ?>

</head>

<body>

<?php include "tb_header.php"; ?>	

<!--------------Content--------------->
<div id="main-content">
  <div id="content" class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
		 
	<?php
	$max_recs_per_page=30;
	if(!empty($_GET['ar']) && $_GET['ar']==1)
	$archive="where archive=1";
	else
	$archive="where archive=0";
	
	$select=executework("select * from tob_tender $archive order by id desc");
	$count=@mysqli_num_rows($select);
	$row=@mysqli_fetch_array($select);
	
	if ($count > 0){?>
	
    <?php
	if (empty($_GET['page_index'])) {
		$page_index=1;
	}	
	else {
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
	else { 
		$pages = $pages; 
	}
	$page12=(int) $page_index;
	
	$pagenow1 = ($max_recs_per_page*($page12-1)); 

	$select1= executework("select * from tob_tender $archive order by id desc LIMIT $pagenow1, $max_recs_per_page");
	$count1 = @mysqli_num_rows($select1);
	
	if($pages > 1) { ?>
	<div class="d-flex align-items-center justify-content-between pb-4">
        <h4 class="title mb-0">Tenders</h4>
        <ul class="pagination">
        <?php
          for($im=1;$im<=$pages;$im++) {
              if($page12 != $im) { ?>
                <?php
                  $q_stype = isset($_GET['stype']) ? urlencode($_GET['stype']) : '';
                  $q_ar = isset($_GET['ar']) ? urlencode($_GET['ar']) : '';
                ?>
                <li class="page-item"><a class="page-link hlink1" href="tenders.php?page_index=<?php echo $im; ?>&amp;stype=<?php echo $q_stype; ?>&amp;ar=<?php echo $q_ar; ?>"> <?php echo $im; ?> </a></li>
                <?php
              } else { ?>
              
                <li class="page-item active" aria-current="page"> <span class="page-link"><?php echo "$im" ?></span> </li>

              <?php } } ?>
        </ul>
    </div>

       <?php } else { ?>
        <h4 class="title">Tenders</h4>
      <?php } ?>

	<table width="100%" border="1" align="center" cellpadding="7" cellspacing="1" bgcolor="#EDEDED">
		<tr>
			<td width="23%" height="30" bgcolor="#EDEDED"><div align="left"><strong>Tender Notice No </strong></div></td>
			<td width="33%" bgcolor="#EDEDED"><div align="left"><strong>Description of Tender </strong></div></td>
			<td width="20%" bgcolor="#EDEDED"><div align="left"><strong>Status</strong></div></td>
		</tr>
		<?php $i=1;$b=1;
		while($rows=@mysqli_fetch_array($select1)) {
			if($rows['mfile']!="") {
				$link1="admin/tenderfiles/".$rows['mfile'];
				$link="reg.php?pg=".$rows['mfile']."&id=".$rows['id'];
			}
			else
			$link="#";
			
			$fcheck=explode(".",$rows['mfile']);

			if($i%2)
			$bgcolor="#FFFFFF";
			else
			$bgcolor="#F4F4F4";
		?>

		<tr valign="top">
			<td width="23%" height="25" align="left" bgcolor="<?php echo $bgcolor ?>" style="padding-right:15px;"><?php echo $rows['tenderno'] ?></td>
			<td width="33%" align="left" bgcolor="<?php echo $bgcolor ?>" style="padding-right:15px;">
				<div align="left">
					<?php
					if($rows['isactive']=='0')
						{
						if(!empty($rows['mfile'])) {
					?>				    
						<a href="#" onClick="show_pop('<?php echo $link ?>')"><?php echo $rows['description']; if($fcheck[1]=='pdf'){?>&nbsp;<img src="tob2_imgs/pdf_icon.gif" width="12" height="15" border="0" /></a>
						<a href="<?php echo $link?>" target="<?php if($link!="#"){?>_blank<?php }?>"><img src="tob2_imgs/newindow_icon.gif" border="0" /></a>
					<?php } }
					else { echo $rows['description']; } }
					else { ?>

					<?php if(!empty($rows['mfile'])) { ?>				    
					<?php echo $rows['description']; if($fcheck[1]=='pdf'){?>&nbsp;<img src="tob2_imgs/pdf_icon.gif" width="12" height="15" border="0" />
					<?php }?> <img src="tob2_imgs/newindow_icon.gif" border="0" />											
					
					<?php } else { echo $rows['description']; } } ?>
				</div>
			</td>

			<td width="20%" align="left" bgcolor="<?php echo $bgcolor ?>" style="padding-right:15px;"><?php echo $rows['tstatus']?></td>
			<!-- <td width="24%" align="left" bgcolor="<?php echo $bgcolor?>" style="padding-right:15px;"><?php echo $rows['award']?></td> -->
		</tr>

		<tr valign="top">
			<td height="25" align="left" bgcolor="<?php echo $bgcolor?>" style="padding-right:15px;">&nbsp;</td>
			<td align="left" bgcolor="<?php echo $bgcolor?>" style="padding-right:15px;">
				<?php if($rows['tfile']!="") {
					$link1="admin/tenderfiles/$rows[tfile]";
					$link="reg.php?pg=".$rows['tfile']."&id=".$rows['id'];
				}
				else
				$link="#";
				
				$fcheck=explode(".",$rows['tfile']);

				if($i%2)
				$bgcolor="#FFFFFF";
				else
				$bgcolor="#F4F4F4";

				if($rows['isactive']=='0') {
				if(isset($rows['tfile']) && $rows['tfile']!="") {  ?>

				<p>
					<a href="#" onClick="show_pop('<?php echo $link ?>')"><?php echo $rows['subtitle1']; if($fcheck[1]=='pdf'){?>&nbsp;<img src="tob2_imgs/pdf_icon.gif" width="12" height="15" border="0" /> </a> 
					<a href="<?php echo $link ?>" target="<?php if($link!="#"){ ?>_blank<?php } ?>"><img src="tob2_imgs/newindow_icon.gif" border="0" /> </a>
				</p>
				  
				<?php } }
				else {
					echo $rows['subtitle1'];
				} } else { ?>
				
				<?php if(!empty($rows['tfile'])) { ?>				    
					<?php echo $rows['subtitle1']; if($fcheck[1]=='pdf'){?>&nbsp;<img src="tob2_imgs/pdf_icon.gif" width="12" height="15" border="0" />
					<?php }?>
					&nbsp;&nbsp;&nbsp;<img src="tob2_imgs/newindow_icon.gif" border="0" />											
					
				<?php } else {
					echo $rows['subtitle1'];
				} } ?>

				<?php
				if($rows['sfile']!="") {
					$link2="admin/tenderfiles/".$rows['sfile'];
					$links="reg.php?pg=".$rows['sfile']."&id=".$rows['id'];
				}
				else
				$links="#";
				
				$fcheck=explode(".",$rows['tfile']);

				if($i%2)
				$bgcolor="#FFFFFF";
				else
				$bgcolor="#F4F4F4";

				if($rows['isactive']=='0') {
				if(isset($rows['sfile']) && $rows['sfile']!="") { ?>
				
				<p>
					<a href="#" onClick="show_pop('<?php echo $links ?>')"><?php echo $rows['subtitle2']; if($fcheck[1]=='pdf'){ ?>&nbsp;<img src="tob2_imgs/pdf_icon.gif" width="12" height="15" border="0" /> </a>
					<a href="<?php echo $links ?>" target="<?php if($links!="#"){ ?>_blank<?php }?>"><img src="tob2_imgs/newindow_icon.gif" border="0" /></a>
				</p>
				  
			<?php } } else { echo $rows['subtitle2']; } } else { ?>	

				<?php if(!empty($rows['sfile'])) { ?>				    
				<?php echo $rows['subtitle2']; if($fcheck[1]=='pdf'){?>&nbsp;<img src="tob2_imgs/pdf_icon.gif" width="12" height="15" border="0" />
				<?php }?> <img src="tob2_imgs/newindow_icon.gif" border="0" />											
				      
				<?php } else { echo $rows['subtitle2']; } } ?>
					
			<td align="left" bgcolor="<?php echo $bgcolor ?>" style="padding-right:15px;">&nbsp;</td>
		</tr>

            <?php $i++; } ?>
		</table>
			
			<?php } else { ?>
				<h4 class="sub-title no-dash mb-0">Publications</h4>
				<div class="py-5 text-secondary">Required Information Not Available</div>
			<?php } ?>
	
			</div>
		</div>
	</div>
</div>

<!--------------Footer--------------->
<?php include "tb_footer.php"; ?>

</body>
</html>
