<?php 
ob_start();
@session_start();
include "include/include.php";
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
  if(!empty($_GET['stype']))
  $stp=$_GET['stype'];
  else
  $stp='Transfers & Postings';
  if($stp=='Transfers And Postings')
  $stp='Transfers & Postings';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php echo $stp; ?> | Tobacco Board</title>
	
	<?php include "head.php"; ?>

</head>
<body>

<?php include "tb_header.php"; ?>		

<!--------------Content--------------->


<div id="main-content">
  <div id="content" class="container">


<?php $max_recs_per_page=30;
  if(!empty($_GET['ar']) && $_GET['ar']==1 && !empty($stp))
  $archive="where archive=1 and order_type='".$stp."'";
  else if(!empty($stp))
  $archive="where archive=0 and order_type='".$stp."'";
  else
  $archive="where archive=0 and order_type='Transfers & Postings'";
  
  $select=executework("select * from tob_employee $archive order by id desc");
  $count=@mysqli_num_rows($select);
  $row=@mysqli_fetch_array($select); ?>
      
  <?php if ($count > 0) { ?>						

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

    $select1= executework("select * from tob_employee $archive order by id desc LIMIT $pagenow1, $max_recs_per_page");
    $count1 = @mysqli_num_rows($select1);
    
    if($pages > 1) { ?>

      <div class="d-flex align-items-center justify-content-between">
        <h4 class="sub-title no-dash mb-0"><?php echo $stp ?></h4>
        <ul class="pagination">
        <?php
          for($im=1;$im<=$pages;$im++) {
              if($page12 != $im) { ?>
                <?php
                  $q_stype = isset($_GET['stype']) ? urlencode($_GET['stype']) : '';
                  $q_ar = isset($_GET['ar']) ? urlencode($_GET['ar']) : '';
                ?>
                <li class="page-item"><a class="page-link hlink1" href="empcorner.php?page_index=<?php echo $im; ?>&amp;stype=<?php echo $q_stype; ?>&amp;ar=<?php echo $q_ar; ?>"> <?php echo $im; ?> </a></li>
                <?php
              } else { ?>
              
                <li class="page-item active" aria-current="page"> <span class="page-link"><?php echo "$im" ?></span> </li>

              <?php } } ?>
        </ul>
      </div>
      <?php } else { ?>
        
        <h4 class="title"><?php echo $stp ?></h4>
      <?php } ?>
        <ul>
         <?php
		  	while($rows=@mysqli_fetch_array($select1)) {
				if($rows['tfile']!="")
				$link=$base_url."/tbdata/employeefiles/".$rows['tfile'];
				else
				$link="#";
				$fcheck=explode(".",$rows['tfile']);
				if(!empty($rows['tfile'])) { ?>
					  <li>
						  <a href="<?php echo $link?>" target="<?php if($link!="#"){?>_blank<?php }?>"><?php echo $rows['order_details']; if($fcheck[1]=='pdf'){?>&nbsp;<img src="tob2_imgs/pdf_icon.gif" width="12" height="15" /><?php }?></a> 
              <a href="<?php echo $link?>" target="<?php if($link!="#"){?>_blank<?php }?>"><img src="tob2_imgs/newindow_icon.gif"  /> </a>
					  </li>
            <?php } else { echo "<li>".$rows['order_details']."</li>"; } } ?>
          </ul>
          
          <?php } else { ?>
                <h4 class="sub-title no-dash mb-0"><?php echo $stp ?></h4>
                <div class="py-5 text-secondary">Required Information Not Available</div>
            <?php } ?>

      </div>
  </div>

<!--------------Footer--------------->
<?php include "tb_footer.php"; ?>

</body>
</html>
