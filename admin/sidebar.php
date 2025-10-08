
<aside id="adminSidebar" class="border-end bg-white">
	<section id="adminLogo" class="p-2">
		<img src="../img/logo.png" width="200" alt="logo">
	</section>
	
<?php
if(!empty($_SESSION['tob']) && $_SESSION['tob']=='admin'){
	$selectr=executework("select * from tob_admin where admin='".$_SESSION['tobadmin']."'");
	$rowtr=@mysqli_fetch_array($selectr);
}
if(!empty($_SESSION['tob']) && $_SESSION['tob']=='state'){
	$stct=executework("select * from tob_employeeview where username='".$_SESSION['tobadmin']."'");
	$rowct=@mysqli_fetch_array($stct);
}
if(!empty($_SESSION['tob'])){ ?>

<div id="adminNav" class="p-2">
	<ul>
<?php }

//echo $_SESSION['tob'];
if(isset($_SESSION['tobadmin']) && !empty($_SESSION['tobadmin'])){
	while($rowmn=@mysqli_fetch_array($selm)){
		$sel2=executework("select * from tob_pages where menu_id='".$rowmn['id']."' and isactive=1 order by morder");
		$cnt2=@mysqli_num_rows($sel2);
		if($cnt2>0){
			$cls="class='caret'";
		} else{
			$cls='';
		}
		
		if($rowmn['cms']==1 && $cnt2==0 && $_SESSION['tobadmin']=='admin' ){
			$link="page_cms1.php?page_id=".$rowmn['id'];
		}else if($rowmn['link']!='' && $cnt2==0 && $_SESSION['tobadmin']=='admin'){
			$link=$rowmn['link'];
		}else{
			$link='#';
		} ?>

		<?php if($_SESSION['tobadmin']=='admin') {
	 		if($cnt2>0) { ?>
			<li>
				<a href="#" class="fs-3"><?php echo $rowmn['page']; ?></a>
    			<ul>
      			<?php while($row=@mysqli_fetch_array($sel2)) { 
		
					$sel3=executework("select * from tob_pages where menu_id='".$row['id']."' and isactive=1 order by morder");
					$cnt3=@mysqli_num_rows($sel3);
					
					if($cnt3>0)
					$cls="class='dropdown-submenu'";
					else
					$cls='';
				
					if($row['cms']==1  )
					$link="page_cms1.php?page_id=".$row['id'];
					else if($row['link']!='')
					$link=$row['link'];
					else
					$link='#';
		 		?>

        		<?php if($cnt3>0) { ?>

				<li>
					<a href="<?php echo $link; ?>" class="fs-4"><?php echo $row['page']; ?></a>
					<ul>
					<?php while($row2=@mysqli_fetch_array($sel3)) {
						
						$sel4=executework("select * from tob_pages where menu_id='".$row2['id']."' and isactive=1 order by morder");
						$cnt4=@mysqli_num_rows($sel4);

						if($cnt4>0)
						$cls="class='dropdown-submenu'";
						else
						$cls='';
						
						if($row2['cms']==1  )
						$link="page_cms1.php?page_id=".$row2['id'];
						else if($row2['link']!='')
						$link=$row2['link'];
						else
						$link='#';
		
						if($cnt4>0) { ?>
         
						<li>
							<a class="fs-5" href="<?php echo $link; ?>"><?php echo $row2['page']; ?></a>
						
							<ul style="margin-top:0px">
							<?php while($row3=@mysqli_fetch_array($sel4)) {
								if($row3['cms']==1  )
								$link="page_cms1.php?page_id=".$row3['id'];
								else if($row3['link']!='')
								$link=$row3['link'];
								else
								$link='#';
							?>
            				<li> <a class="text-primary" href="<?php echo $link; ?>"><?php echo $row3['page']; ?></a></li>
							<?php } ?>
							</ul>
						</li>
             
			 			<?php } else { ?>
			  				<li><a href="<?php echo $link; ?>"><?php echo $row2['page']; ?></a></li>
			 			<?php } ?>
			 		<?php } ?>
			 		</ul>
   		 		</li>
    			<?php } else { ?>
      				<li><a href="<?php echo $link; ?>"><?php echo $row['page']; ?></a></li>
      			<?php } ?>
    		<?php } ?>
    		</ul>
    	</li>
    	<?php } else { ?>
  			<li><a href="<?php echo $link; ?>"><?php echo $rowmn['page']; ?></a></li>
  		<?php } } ?>
	<?php } 

	$lsel=executework("select * from tob_pages where menu_id='10001' and isactive=1 order by morder");
	if($_SESSION['tobadmin']=='admin') { ?>


	<ul>
		<li><a href="#">Left Menu</a>
			<ul>
			<?php while($lrow=@mysqli_fetch_array($lsel)) { 
				if($lrow['cms']==1  )
				$link="page_cms1.php?page_id=".$lrow['id'];
				else if($lrow['link']!='')
				$link=$lrow['link'];
				else
				$link='#';
			?>
			<li><a href="<?php echo $link; ?>"><?php echo $lrow['page']; ?></a></li>
			<?php } ?>
			</ul>
 		</li>
	</ul>

	<?php }
	if($_SESSION['tobadmin']=='admin') { ?>
	<ul>
		<li><a href="#">Others</a>
		<ul>
			<li><a href="trainings.php">Trainings</a></li>
			<li><a href="dltreg.php">Tenders Registration</a></li>
			<li><a href="upload.php">File Upload</a></li>
			<li><a href="tb_views.php">Views on TB Bill</a></li>
			<li><a href="dollar.php">Dollar Value</a></li>
			<li><a href="export_gsettings.php">Homepage Export Performance</a></li>
			<li><a href="auction_gsettings.php">Homepage Auction Data</a></li>
		</ul>
 		</li>
	</ul>

	<?php }
		if($_SESSION['tobadmin']=='admin' || ($_SESSION['tob']=='state')) {	?>
		<ul>
			<li><a href="#">Employees</a>
			<ul>
				<?php if($_SESSION['tob']=='admin') { ?>
					<li><a href="employeeview.php">Users</a></li>
					<li><a href="master.php">Location</a></li>
					<li><a href="platfrm.php">Platform</a></li>
					<li><a href="designation.php">Designation</a></li>
				<?php } ?>
				<li><a href="employeedata.php">Employee Details</a></li>
			</ul>
			</li>
		</ul>
	<?php } } ?>

		</ul>
</div>

</aside>