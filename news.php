<?php 
ob_start();
@session_start();
include "include/include.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title> News & Events | Tobacco Board</title>
	
	<?php include "head.php"; ?>

</head>

<body>

<?php include "tb_header.php"; ?>	


<!--------------Content--------------->
    

<div id="main-content">
  <div id="content" class="container">
        
  <?php
		$max_recs_per_page=30;
		if(!empty($_GET['ar']) && $_GET['ar']==1)
		$archive="where archive=1";
		else
		$archive="where archive=0";
		
		$select=executework("select * from tob_news $archive order by id desc");
		$count=@mysqli_num_rows($select);
		$row=@mysqli_fetch_array($select);
  if ($count > 0) { ?>
      <?php
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

    $select1= executework("select * from tob_news $archive order by id desc LIMIT $pagenow1, $max_recs_per_page");
    $count1 = @mysqli_num_rows($select1);
	


	if($pages > 1) { ?>

      <div class="d-flex align-items-center justify-content-between">
        <h4 class="title mb-0">News & Events</h4>
        <ul class="pagination">
        <?php
          for($im=1;$im<=$pages;$im++) {
              if($page12 != $im) { ?>
                <?php
                  $q_stype = isset($_GET['stype']) ? urlencode($_GET['stype']) : '';
                  $q_ar = isset($_GET['ar']) ? urlencode($_GET['ar']) : '';
                ?>
                <li class="page-item"><a class="page-link hlink1" href="news.php?page_index=<?php echo $im; ?>&amp;stype=<?php echo $q_stype; ?>&amp;ar=<?php echo $q_ar; ?>"> <?php echo $im; ?> </a></li>
                <?php
              } else { ?>
              
                <li class="page-item active" aria-current="page"> <span class="page-link"><?php echo "$im" ?></span> </li>

              <?php } } ?>
        </ul>
      </div>

    <?php } else { ?>
        <h4 class="title">News & Events</h4>
      <?php } ?>
  
        <ul>
        <?php
          while($rows=@mysqli_fetch_array($select1)) {
          if($rows['tfile']!="")
          $link=$base_url."/tbdata/newsfiles/".$rows['tfile'];
          else
          $link="#";
          $fcheck=explode(".",$rows['tfile']);
          if(!empty($rows['tfile'])) {
          ?>
            <li style="padding-bottom:10px; padding-right:10px;">
              <a href="<?php echo $link?>" target="<?php if($link!="#"){?>_blank<?php }?>"><?php echo remove_firstp($rows['description']); ?><?php if($fcheck[1]=='pdf'){?> <img src="tob2_imgs/pdf_icon.gif" width="12" height="15" border="0" /><?php }?></a> 
              <a href="http://tobaccoboard.com/<?php echo $link?>" target="<?php if($link!="#"){?>_blank<?php }?>"><img src="tob2_imgs/newindow_icon.gif" border="0" /> </a>
            </li>
          <?php } else { echo '<li style="padding-bottom:10px; padding-right:10px;">'.$rows['description'].'</li>'; }	} ?>
        </ul>
          <?php } else { ?>
              <h4 class="sub-title no-dash mb-0">News & Events</h4>
              <div class="py-5 text-secondary">Required Information Not Available</div>
          <?php } ?>
  
      </div>
  </div>

<!--------------Footer--------------->
<?php include "tb_footer.php"; ?>

</body>
</html>
