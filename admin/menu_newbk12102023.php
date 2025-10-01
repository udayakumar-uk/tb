<script language="JavaScript">
<!--
function mmLoadMenus() {

  if (window.mm_menu_0118120323_0) return;

              window.mm_menu_0118120323_0 = new Menu("root",135,24,"Arial, Helvetica, sans-serif",12,"#FFFFFF","#FFFFFF","#333399","#333399","left","middle",6,1,1000,-5,7,true,false,true,0,true,true);

/*  mm_menu_0118120323_0.addMenuItem("Upload&nbsp;Album","location='photogallery.php'");

  mm_menu_0118120323_0.addMenuItem("View&nbsp;Album","location='imagelist.php'");
*/
  mm_menu_0118120323_0.addMenuItem("Add&nbsp;Gallery","location='photogallery.php'");
  mm_menu_0118120323_0.addMenuItem("Modify&nbsp;Gallery","location='albummodify.php'");
  mm_menu_0118120323_0.addMenuItem("Delete&nbsp;Gallery","location='albumdelete.php'");
  mm_menu_0118120323_0.addMenuItem("Home&nbsp;Page&nbsp;Slides","location='upload_slides.php'");

   mm_menu_0118120323_0.fontWeight="bold";

   mm_menu_0118120323_0.hideOnMouseOut=true;

   mm_menu_0118120323_0.bgColor='#555555';

   mm_menu_0118120323_0.menuBorder=1;

   mm_menu_0118120323_0.menuLiteBgColor='#FFFFFF';

   mm_menu_0118120323_0.menuBorderBgColor='#777777';

    window.mm_menu_0206194126_0 = new Menu("root",146,24,"Arial, Helvetica, sans-serif",12,"#FFFFFF","#FFFFFF","#333399","#333399","left","middle",6,1,1000,-5,7,true,false,true,0,true,true);
	
<?php if($_SESSION['tobadmin']!="" && $_SESSION['tob']=='admin') { ?>
  mm_menu_0206194126_0.addMenuItem("Add&nbsp;Platform","location='platform.php'");
<?php } if($_SESSION['tobadmin']!="" && $_SESSION['tob']!='employeeuser') { ?>
  mm_menu_0206194126_0.addMenuItem("Auction&nbsp;Details","location='platform1.php'");

  mm_menu_0206194126_0.addMenuItem("Auctions","location='auctions1.php'");
<?php } if($_SESSION['tobadmin']!="" && $_SESSION['tob']=='admin') {?>
  mm_menu_0206194126_0.addMenuItem("Export&nbsp;Performance","location='export_per.php'");

  mm_menu_0206194126_0.addMenuItem("Lookup","location='states.php'");

  mm_menu_0206194126_0.addMenuItem("Graph&nbsp;Settings","location='gsettings.php'");
	<?php } ?>
   mm_menu_0206194126_0.fontWeight="bold";

   mm_menu_0206194126_0.hideOnMouseOut=true;

   mm_menu_0206194126_0.bgColor='#555555';

   mm_menu_0206194126_0.menuBorder=1;

   mm_menu_0206194126_0.menuLiteBgColor='#FFFFFF';

   mm_menu_0206194126_0.menuBorderBgColor='#777777';

window.mm_menu_0319162428_0 = new Menu("root",148,25,"Verdana, Arial, Helvetica, sans-serif",12,"#FFFFFF","#FFFFFF","#00528C","#0077D1","left","middle",3,0,250,-5,7,true,false,true,0,true,false);

  mm_menu_0319162428_0.addMenuItem("Tenders&nbsp;Registration","location='dltreg.php'");

   mm_menu_0319162428_0.hideOnMouseOut=true;

   mm_menu_0319162428_0.bgColor='#555555';

   mm_menu_0319162428_0.menuBorder=1;

   mm_menu_0319162428_0.menuLiteBgColor='#FFFFFF';

   mm_menu_0319162428_0.menuBorderBgColor='#777777';



                  window.mm_menu_0502185927_0 = new Menu("root",120,24,"Arial, Helvetica, sans-serif",12,"#FFFFFF","#FFFFFF","#333399","#333399","left","middle",6,1,1000,-5,7,true,false,true,0,true,true);

  mm_menu_0502185927_0.addMenuItem("Tenders","location='tenders.php'");

  mm_menu_0502185927_0.addMenuItem("News&nbsp;&&nbsp;Events","location='news.php'");

  mm_menu_0502185927_0.addMenuItem("Publications","location='publications.php'");

  mm_menu_0502185927_0.addMenuItem("Statistics","location='statistics.php'");

  mm_menu_0502185927_0.addMenuItem("Employee&nbsp;Corner","location='employee_corner.php'");

  mm_menu_0502185927_0.addMenuItem("Circulars","location='circulars.php'");

  mm_menu_0502185927_0.addMenuItem("Vacancies","location='vacancies.php'");

  mm_menu_0502185927_0.addMenuItem("Latest&nbsp;News","location='latest.php'");
  
    mm_menu_0502185927_0.addMenuItem("Board&nbsp;Members","location='board_members.php'");

    mm_menu_0502185927_0.addMenuItem("Trainings","location='trainings.php'");

   mm_menu_0502185927_0.fontWeight="bold";

   mm_menu_0502185927_0.hideOnMouseOut=true;

   mm_menu_0502185927_0.bgColor='#555555';

   mm_menu_0502185927_0.menuBorder=0;

   mm_menu_0502185927_0.menuLiteBgColor='#FFFFFF';

   mm_menu_0502185927_0.menuBorderBgColor='#777777';



  window.mm_menu_0827125102_0 = new Menu("root",120,24,"Arial, Helvetica, sans-serif",12,"#FFFFFF","#FFFFFF","#333399","#333399","left","middle",6,1,1000,-5,7,true,false,true,0,true,true);
  mm_menu_0827125102_0.addMenuItem("Users","location='employeeview.php'");
  mm_menu_0827125102_0.addMenuItem("Location","location='master.php'");
  mm_menu_0827125102_0.addMenuItem("Platform","location='platfrm.php'");
  mm_menu_0827125102_0.addMenuItem("Designations","location='designation.php'");
   mm_menu_0827125102_0.fontWeight="bold";
   mm_menu_0827125102_0.hideOnMouseOut=true;
   mm_menu_0827125102_0.bgColor='#555555';
   mm_menu_0827125102_0.menuBorder=0;
   mm_menu_0827125102_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0827125102_0.menuBorderBgColor='#777777';

    window.mm_menu_0902164011_0 = new Menu("root",116,24,"Arial, Helvetica, sans-serif",12,"#FFFFFF","#FFFFFF","#333399","#333399","left","middle",6,1,1000,-5,7,true,false,true,0,true,true);
  mm_menu_0902164011_0.addMenuItem("Auction&nbsp;Details","location='platform1.php'");
  mm_menu_0902164011_0.addMenuItem("Auction","location='auctions.php'");
  mm_menu_0902164011_0.addMenuItem("Graph&nbsp;Setting","location='gsettings.php'");
   mm_menu_0902164011_0.fontWeight="bold";
   mm_menu_0902164011_0.hideOnMouseOut=true;
   mm_menu_0902164011_0.bgColor='#555555';
   mm_menu_0902164011_0.menuBorder=0;
   mm_menu_0902164011_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0902164011_0.menuBorderBgColor='#777777';

mm_menu_0902164011_0.writeMenus();
} // mmLoadMenus()
//-->
</script>
<script language="JavaScript" src="mm_menu.js"></script>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    
<?php /*?><nav>
  <div class="container">
    <ul>
    <?php
	while($rowmn=@mysqli_fetch_array($selm))
	{
		$sel2=executework("select * from tob_pages where menu_id='".$rowmn['id']."'");
		$cnt2=@mysqli_num_rows($sel2);
		if($cnt2>0)
		$cls=" class='fa fa-angle-down'";
		else
		$cls='';
		
		
		if($rowmn['cms']==1 && $cnt2==0 )
		$link="page_cms.php?page_id=".$rowmn['id'];
		else if($rowmn['link']!='' && $cnt2==0)
		$link=$rowmn['link'];
		else
		$link='#';
		
	?>
      <li><a href="<?php echo $link; ?>" <?php echo $cls; ?>><?php echo $rowmn['page']; ?></a>
     <?php 
	 if($cnt2>0)
	 {
	 	//echo "step2";
	 ?>
      <ul>
        <?php while($row=@mysqli_fetch_array($sel2)) { 
		
			$sel3=executework("select * from tob_pages where menu_id='".$row['id']."'");
			echo ("select * from tob_pages where menu_id='".$row['id']."'");
			$cnt3=@mysqli_num_rows($sel3);
			if($cnt3>0)
			$cls=" class='fa fa-angle-down'";
			else
			$cls='';
		
			if($row['cms']==1  )
			$link="page_cms.php?page_id=".$row['id'];
			else if($row['link']!='')
			$link=$row['link'];
			else
			$link='#';
		
		?>
            <li><a href="<?php echo $link; ?>" <?php echo  $cls; ?>><?php echo $row['page']; ?></a>
            <?php if($cnt3>0) {?>
            
            <ul>
             <?php while($row2=@mysqli_fetch_array($sel3)) { 
				
					if($row2['cms']==1  )
					$link="page_cms.php?page_id=".$row2['id'];
					else if($row2['link']!='')
					$link=$row2['link'];
					else
					$link='#';
		
			?>
            <li><a href="<?php echo $link; ?>"><?php echo $row2['page']; ?></a></li>
            <?php } ?>
            </ul>
            <?php } ?>
            </li>
        <?php } ?>
        </ul>
   <?php } ?>
	</li>
	<?php  }
	?>
      <li><a href="#">About Us</a></li>
      <li> <a href="#">Categories<i class='fa fa-angle-down'></i></a>
        <ul>
        
          <li><a href="#">Category One</a></li>
          <li><a href="#">Category Two</a></li>
          <li><a href="#">Category Three</a></li>
        </ul>
      </li>
      <li class='sub-menu'> <a href="#">Services<i class='fa fa-angle-down'></i></a>
        <ul>
          <li><a href="#">Service One</a></li>
          <li><a href="#">Service Two</a></li>
          <li><a href="#">Service Three</a></li>
          <li class='sub-menu'><a href="#">Service Four<i class='fa fa-angle-down'></i></a>
           <ul>
          <li><a href="#">Service One1</a></li>
          <li><a href="#">Service Two2</a></li>
          <li><a href="#">Service Three3</a></li>
          <li><a href="#">Service Four4</a></li>
          <li><a href="#">Service Five5</a></li>
          <li><a href="#">Service Six6</a></li>
        </ul>
          
          </li>
          <li><a href="#">Service Five</a></li>
          <li><a href="#">Service Six</a></li>
        </ul>
      </li>
      <li><a href="#">Contact Us</a></li>
    </ul>
  </div>
</nav><?php */?>
<?php
if(!empty($_SESSION['tob']) && $_SESSION['tob']=='admin')
{
$selectr=executework("select * from tob_admin where admin='".$_SESSION['tobadmin']."'");
$rowtr=@mysqli_fetch_array($selectr);
}
if(!empty($_SESSION['tob']) && $_SESSION['tob']=='state')
{
$stct=executework("select * from tob_employeeview where username='".$_SESSION['tobadmin']."'");
$rowct=@mysqli_fetch_array($stct);
}
if(!empty($_SESSION['tob']))
{
?>
<div align="right"><span class="style12"><span class="style14">Welcome ,<?php if($_SESSION['tob']=='admin') { ?><?php echo $rowtr['admin']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;Last Login : <?php echo date('d/m/Y h:i A', strtotime($apdt)); ?> | &nbsp;&nbsp; IP Address : <?php echo $rowtr['ip_address'] ?> <?php } if($_SESSION['tob']=='state') { ?>&nbsp;&nbsp;<?php echo $rowct['username'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;Last Login : <?php echo date('d/m/Y h:i A', strtotime($pdt)); ?> | &nbsp;&nbsp;IP Address : <?php echo $rowct['ip_address'] ?> <?php } ?></span>&nbsp;&nbsp;&nbsp;&nbsp;| <a href="changepassword.php">Change Password</a>&nbsp;&nbsp; |&nbsp;&nbsp; <a href="logout.php">Logout</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></div>
<br />
<?php
}
//echo $_SESSION['tob'];
if(isset($_SESSION['tobadmin']) && !empty($_SESSION['tobadmin']))
{
	while($rowmn=@mysqli_fetch_array($selm))
	{
		
		$sel2=executework("select * from tob_pages where menu_id='".$rowmn['id']."' and isactive=1 order by morder");
		$cnt2=@mysqli_num_rows($sel2);
		if($cnt2>0)
		$cls="class='caret'";
		else
		$cls='';
		
		
		if($rowmn['cms']==1 && $cnt2==0 && $_SESSION['tobadmin']=='admin' )
		$link="page_cms1.php?page_id=".$rowmn['id'];
		else if($rowmn['link']!='' && $cnt2==0 && $_SESSION['tobadmin']=='admin')
		$link=$rowmn['link'];
		else
		$link='#';
		
	?>
    <div style="background-color: #333399;width: 100%;height: 52px;">
<ul id="nav">

	<?php
	if($_SESSION['tobadmin']=='admin')
	{
	 if($cnt2>0) {
	 ?>
    <li style="padding-left:-50px"><a href="#"><?php echo $rowmn['page']; ?></a>
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
        <?php 
		if($cnt3>0)
		{
		?>
         <li style="padding-left:-50px"><a href="<?php echo $link; ?>"><?php echo $row['page']; ?></a>
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
		
			
		if($cnt4>0)
		{
		?>
         <li style="padding-left:-50px; margin-top:-5px"><a href="<?php echo $link; ?>"><?php echo $row2['page']; ?></a>
             <ul style="margin-top:0px">
              <?php while($row3=@mysqli_fetch_array($sel4)) { 
				
					if($row3['cms']==1  )
					$link="page_cms1.php?page_id=".$row3['id'];
					else if($row3['link']!='')
					$link=$row3['link'];
					else
					$link='#';
		
			?>
            <li><a href="<?php echo $link; ?>"><?php echo $row3['page']; ?></a>
			<?php } ?>
            </ul>
			</li>
             
			 <?php } else { ?>
			  <li><a href="<?php echo $link; ?>"><?php echo $row2['page']; ?></a></li>
			 <?php } ?>
			 
			 
			 <?php } ?>
			 </ul>
   		 </li>
    	
           
    	<?php }  else { ?>
      <li><a href="<?php echo $link; ?>"><?php echo $row['page']; ?></a></li>

      <?php } ?>
     
    <?php } ?>
    </ul>
    </li>
    <?php } else { 
	
	 ?>
  <li><a href="<?php echo $link; ?>"><?php echo $rowmn['page']; ?></a></li>
  <?php }
  } ?>
  
  
  
  
</ul>

<?php } 
	$lsel=executework("select * from tob_pages where menu_id='10001' and isactive=1 order by morder");
	if($_SESSION['tobadmin']=='admin')
	{
?>
<ul id="nav">
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
<?php
}
if($_SESSION['tobadmin']=='admin')
{
?>
<ul id="nav">
<li><a href="#">Others</a>
 <ul>

 	<li><a href="trainings.php">Trainings</a></li>
  
    
        	<li><a href="dltreg.php">Tenders Registration</a></li>
          
    <li><a href="upload.php">File Upload</a></li>
    <li><a href="tb_views.php">Views on TB Bill</a></li>
   	<li><a href="dollar.php">Dollar Value</a></li>

 </ul>
 
 </li>
</ul>
<?php
}
	if($_SESSION['tobadmin']=='admin' || ($_SESSION['tob']=='state'))
	{
?>
<ul id="nav">
<li><a href="#">Employees</a>
<ul>
	<?php
		if($_SESSION['tob']=='admin')
		{
	?>
    	    <li><a href="employeeview.php">Users</a></li>
            <li><a href="master.php">Location</a></li>
            <li><a href="platfrm.php">Platform</a></li>
            <li><a href="designation.php">Designation</a></li>
    <?php
		}
		?>
     <li><a href="employeedata.php">Employee Details</a></li>
    </ul></li>
</ul>


<?php
	}
}
?>


      <?php /*?><?php
	  if(!empty($_SESSION['tob']) && $_SESSION['tob']=='admin')
	  {
	  $selectr=executework("select * from tob_admin where admin='".$_SESSION['tobadmin']."'");
	  $rowtr=@mysqli_fetch_array($selectr);
	  }
	  if(!empty($_SESSION['tob']) && $_SESSION['tob']=='state')
	  {
	  $stct=executework("select * from tob_employeeview where username='".$_SESSION['tobadmin']."'");
	  $rowct=@mysqli_fetch_array($stct);
	  }
//echo $_SESSION['tob'];
		if(isset($_SESSION['tobadmin']) && !empty($_SESSION['tobadmin']))
		{
	?>

      <tr bgcolor="#333399" height="40">

        <td colspan="12"><span class="style12"> &nbsp;&nbsp; <a href="adminmain.php" class="a">Home</a>&nbsp;&nbsp; |&nbsp;&nbsp; <?php if($_SESSION['tobadmin']!="" && $_SESSION['tob']=='admin') {  ?><a href="#" name="link9" class="a" id="link7" onmouseover="MM_showMenu(window.mm_menu_0502185927_0,0,14,null,'link9')" onmouseout="MM_startTimeout();">Dynamic Pages</a>&nbsp;&nbsp; |&nbsp;&nbsp; <a href="#" name="link6" id="link1" onmouseover="MM_showMenu(window.mm_menu_0118120323_0,10,20,null,'link6')" onmouseout="MM_startTimeout();" class="a">Photo Gallery</a>&nbsp;&nbsp; |&nbsp;&nbsp;<a href="#" name="link5" class="a" id="link3" onmouseover="MM_showMenu(window.mm_menu_0206194126_0,0,17,null,'link5')" onmouseout="MM_startTimeout();">Graphs</a>&nbsp;&nbsp;|&nbsp;&nbsp; <a href="#" name="link2" class="a" id="link4" onmouseover="MM_showMenu(window.mm_menu_0319162428_0,-8,30,null,'link2')" onmouseout="MM_startTimeout();">Registrations</a>&nbsp;&nbsp; |&nbsp;&nbsp; <a href="page_cms.php" class="a">CMS</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="upload.php" class="a">File Upload </a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="employeeview.php" name="link8" class="a" id="link8" onmouseover="MM_showMenu(window.mm_menu_0827125102_0,0,19,null,'link8')" onmouseout="MM_startTimeout();">Employee </a>&nbsp;&nbsp;|&nbsp;&nbsp;<?php  } if($_SESSION['tobadmin']!="") { ?><a href="employeedata.php" class="a">Employee&nbsp;Details</a><?php }  ?>
        </span></td>

      </tr>
		<?php
		if(empty($rowct['previous_date']) || $rowct['previous_date']=='0000-00-00 00:00:00')
			$pdt=$rowct['current_dt'];
			else
			$pdt=$rowct['previous_date'];
			
		if(empty($rowct['previous_date']) || $rowtr['previous_date']=='0000-00-00 00:00:00')
			$apdt=$rowtr['current_dt'];
			else
			$apdt=$rowtr['previous_date'];
			
		?>
      <tr bgcolor="#333399" height="40">
	
        <td colspan="12" bgcolor="#FFFFFF"><div align="right"><span class="style12"><span class="style14">Welcome ,<?php if($_SESSION['tob']=='admin') { ?><?php echo $rowtr['admin']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;Last Login : <?php echo date('d/m/Y h:i A', strtotime($apdt)); ?> | &nbsp;&nbsp; IP Address : <?php echo $rowtr['ip_address'] ?> <?php } if($_SESSION['tob']=='state') { ?>&nbsp;&nbsp;<?php echo $rowct['username'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;Last Login : <?php echo date('d/m/Y h:i A', strtotime($pdt)); ?> | &nbsp;&nbsp;IP Address : <?php echo $rowct['ip_address'] ?> <?php } ?></span>&nbsp;&nbsp;&nbsp;&nbsp;| <a href="changepassword.php">Change Password</a>&nbsp;&nbsp; |&nbsp;&nbsp; <a href="logout.php">Logout</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></div></td>

      </tr>

      <?php

		}

		else

		{

	?>

      <tr bgcolor="#333399" height="40">

        <td bgcolor="#333399">&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td class="style9">&nbsp;</td>

        <td class="style9">&nbsp;</td>

        <td class="style9">&nbsp;</td>

        <td class="style9">&nbsp;</td>

        <td class="style9">&nbsp;</td>

        <td class="style9">&nbsp;</td>

        <td>&nbsp;</td>

      </tr>

      <?php

		}

	?><?php */?>

    </table>