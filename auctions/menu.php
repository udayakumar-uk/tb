<?php 
include_once("include/includei.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<style>
#nav {
    list-style:none inside;
    margin:0;
    padding:0;
    text-align:center;
    }

#nav li {
    display:block;
    position:relative;
    float:left;
    background: #333399; /* menu background color */
    }

#nav li a {
    display:block;
    padding:0;
    text-decoration:none;
    width:200px; /* this is the width of the menu items */
    line-height:35px; /* this is the hieght of the menu items */
    color:#ffffff; /* list item font color */
    }
        
#nav li li a {font-size:80%;} /* smaller font size for sub menu items */
    
#nav li:hover {background:#003f20;} /* highlights current hovered list item and the parent list items when hovering over sub menues */



/*--- Sublist Styles ---*/
#nav ul {
    position:absolute;
    padding:0;
    left:0;
    display:none; /* hides sublists */
    }

#nav li:hover ul ul {display:none;} /* hides sub-sublists */

#nav li:hover ul {display:block;} /* shows sublist on hover */

#nav li li:hover ul {
    display:block; /* shows sub-sublist on hover */
    margin-left:200px; /* this should be the same width as the parent list item */
    margin-top:-35px; /* aligns top of sub menu with top of list item */
    }
</style>

<?php
$selm=executework("select * from tob_pages where menu_id=0 and isactive=1 order by morder");
?>
<?php
	while($rowmn=@mysqli_fetch_array($selm))
	{
		
		$sel2=executework("select * from tob_pages where menu_id='".$rowmn['id']."'");
		
		$cnt2=@mysqli_num_rows($sel2);
		if($cnt2>0)
		$cls="class='caret'";
		else
		$cls='';
		
		
		if($rowmn['cms']==1 && $cnt2==0 )
		$link="page_cms.php?page_id=".$rowmn['id'];
		else if($rowmn['link']!='' && $cnt2==0)
		$link=$rowmn['link'];
		else
		$link='#';
		
	?>
<ul id="nav">

	<?php if($cnt2>0) {
	
	 ?>
    <li><a href="#"><?php echo $rowmn['page']; ?></a>
    
    <ul>
      <?php while($row=@mysqli_fetch_array($sel2)) { 
		
			$sel3=executework("select * from tob_pages where menu_id='".$row['id']."'");
			
			$cnt3=@mysqli_num_rows($sel3);
			if($cnt3>0)
			$cls="class='dropdown-submenu'";
			else
			$cls='';
		
			if($row['cms']==1  )
			$link="page_cms.php?page_id=".$row['id'];
			else if($row['link']!='')
			$link=$row['link'];
			else
			$link='#';
		
		?>
        <?php 
		if($cnt3>0)
		{
		?>
         <li><a href="<?php echo $link; ?>"><?php echo $row['page']; ?></a>
             <ul>
              <?php while($row2=@mysqli_fetch_array($sel3)) { 
				
					if($row2['cms']==1  )
					$link="page_cms.php?page_id=".$row2['id'];
					else if($row2['link']!='')
					$link=$row2['link'];
					else
					$link='#';
		
			?>
            <li><a href="<?php echo $link; ?>"><?php echo $row2['page']; ?></a>
            <?php } ?>
             </ul>
   		 </li>
    	<?php } else { ?>
      <li><a href="<?php echo $link; ?>"><?php echo $row['page']; ?></a></li>
      <?php } ?>
    
      
     
    <?php } ?>
    </ul>
    <?php } else { 
	
	 ?>
  <li><a href="<?php echo $link; ?>"><?php echo $rowmn['page']; ?></a></li>
  <?php } ?>
  
</ul>
<?php } ?>