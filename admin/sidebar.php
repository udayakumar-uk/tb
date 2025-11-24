
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
	<ul class="navbar-nav">
<?php }

//echo $_SESSION['tob'];
if(isset($_SESSION['tobadmin']) && !empty($_SESSION['tobadmin'])){
	while($rowmn=@mysqli_fetch_array($selm)){
		$sel2=executework("select * from tob_pages where menu_id='".$rowmn['id']."' and isactive=1 order by morder");
		$cnt2=@mysqli_num_rows($sel2);
		
		if($rowmn['cms']==1 && $cnt2==0 && $_SESSION['tobadmin']=='admin' ){
			$link="page_cms1.php?page_id=".$rowmn['id'];
		}else if($rowmn['link']!='' && $cnt2==0 && $_SESSION['tobadmin']=='admin'){
			$link=$rowmn['link'];
		}else{
			$link='#';
		} ?>

		<?php if($_SESSION['tobadmin']=='admin') {
	 		if($cnt2>0) { ?>
			<li class="btn-group dropend">
				<a href="#" role="button" class="nav-link flex-grow-1 dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" ><?php echo $rowmn['page']; ?></a>
    			<ul class="dropdown-menu" >
      			<?php while($row=@mysqli_fetch_array($sel2)) { 
		
					$sel3=executework("select * from tob_pages where menu_id='".$row['id']."' and isactive=1 order by morder");
					$cnt3=@mysqli_num_rows($sel3);
					
					if($row['cms']==1  )
					$link="page_cms1.php?page_id=".$row['id'];
					else if($row['link']!='')
					$link=$row['link'];
					else
					$link='#';
		 		?>

        		<?php if($cnt3>0) { ?>

				<li class="btn-group dropend">
					<a role="button" class="nav-link flex-grow-1 dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" href="<?php echo $link; ?>"><?php echo $row['page']; ?></a>
					<ul class="dropdown-menu">
					<?php if($link !== '#') { ?>
						<li> <a class="nav-link" href="<?php echo $link; ?>"><?php echo $row['page']; ?></a></li>
					<?php } ?>
					<?php while($row2=@mysqli_fetch_array($sel3)) {
						
						$sel4=executework("select * from tob_pages where menu_id='".$row2['id']."' and isactive=1 order by morder");
						$cnt4=@mysqli_num_rows($sel4);
						
						if($row2['cms']==1  )
						$link="page_cms1.php?page_id=".$row2['id'];
						else if($row2['link']!='')
						$link=$row2['link'];
						else
						$link='#';
		
						if($cnt4>0) { ?>
         
						<li class="btn-group dropend">
							<a role="button" class="nav-link flex-grow-1 dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" href="<?php echo $link; ?>"><?php echo $row2['page']; ?></a>
						
							<ul class="dropdown-menu">
							<?php if($link !== '#') { ?>
								<li> <a class="nav-link" href="<?php echo $link; ?>"><?php echo $row2['page']; ?></a></li>
							<?php } ?>

							<?php while($row3=@mysqli_fetch_array($sel4)) {
								if($row3['cms']==1  )
								$link="page_cms1.php?page_id=".$row3['id'];
								else if($row3['link']!='')
								$link=$row3['link'];
								else
								$link='#';
							?>
            				<li> <a class="nav-link" href="<?php echo $link; ?>"><?php echo $row3['page']; ?></a></li>
							<?php } ?>
							</ul>
						</li>
             
			 			<?php } else { ?>
			  				<li><a class="nav-link" href="<?php echo $link; ?>"><?php echo $row2['page']; ?></a></li>
			 			<?php } ?>
			 		<?php } ?>
			 		</ul>
   		 		</li>
    			<?php } else { ?>
      				<li><a class="nav-link" href="<?php echo $link; ?>"><?php echo $row['page']; ?></a></li>
      			<?php } ?>
    		<?php } ?>
    		</ul>
    	</li>
    	<?php } else { ?>
  			<li><a class="nav-link contact" href="<?php echo $link; ?>"><?php echo $rowmn['page']; ?></a></li>
  		<?php } } ?>
	<?php } 

	$lsel=executework("select * from tob_pages where menu_id='10001' and isactive=1 order by morder");
	if($_SESSION['tobadmin']=='admin') { ?>

	<li class="btn-group dropend">
		<a href="#" role="button" class="nav-link flex-grow-1 dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside">Left Menu</a>
		<ul class="dropdown-menu">
		<?php while($lrow=@mysqli_fetch_array($lsel)) { 
			if($lrow['cms']==1  )
			$link="page_cms1.php?page_id=".$lrow['id'];
			else if($lrow['link']!='')
			$link=$lrow['link'];
			else
			$link='#';
		?>
		<li><a class="nav-link" href="<?php echo $link; ?>"><?php echo $lrow['page']; ?></a></li>
		<?php } ?>
		</ul>
	</li>
	<?php }

	if($_SESSION['tobadmin']=='admin' || ($_SESSION['tob']=='state')) {	?>
	<li class="btn-group dropend">
		<a href="#" role="button" class="nav-link flex-grow-1 dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside">Employees</a>
		<ul class="dropdown-menu">
			<?php if($_SESSION['tob']=='admin') { ?>
				<li><a class="nav-link" href="employeeview.php">Users</a></li>
				<li><a class="nav-link" href="master.php">Location</a></li>
				<li><a class="nav-link" href="platfrm.php">Platform</a></li>
				<li><a class="nav-link" href="designation.php">Designation</a></li>
			<?php } ?>
			<li><a class="nav-link" href="employeedata.php">Employee Details</a></li>
		</ul>
	</li>
	<?php }

	if($_SESSION['tobadmin']=='admin') { ?>
	<li class="btn-group dropend">
		<a href="#" role="button" class="nav-link flex-grow-1 dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside">Others</a>
		<ul class="dropdown-menu">
			<li><a class="nav-link" href="trainings.php">Trainings</a></li>
			<li><a class="nav-link" href="dltreg.php">Tenders Registration</a></li>
			<li><a class="nav-link" href="upload.php">File Upload</a></li>
			<li><a class="nav-link" href="tb_views.php">Views on TB Bill</a></li>
			<li><a class="nav-link" href="dollar.php">Dollar Value</a></li>
			<li><a class="nav-link" href="export_gsettings.php">Homepage Export Performance</a></li>
			<li><a class="nav-link" href="auction_gsettings.php">Homepage Auction Data</a></li>
		</ul>
 	</li> 
	<?php } } ?>

		</ul>
	</div>

</aside>