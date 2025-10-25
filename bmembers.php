<?php 
ob_start();
@session_start();
include "include/include.php";
$selb=executework("SELECT min(`sl_no`) as min_sl,max(`sl_no`) as max_sl FROM `tob_brdmember`");
$rowb=@mysqli_fetch_array($selb);
$s=1;

$min=$rowb['min_sl'];
$max=$rowb['max_sl'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Members | Tobacco Board</title>
  
	<?php include "head.php"; ?>
</head>

<body>
  
<?php include "tb_header.php"; ?>


<!--------------Content--------------->
<div id="main-content">
    <div id="content" class="container">

      <div class="profile-wrapper row justify-content-center py-3">
        <?php 
		 	  for($i=$min;$i<=$max;$i++) {
          $sel_brd=executework("select * from tob_brdmember where status='1' and sl_no='".$i."' order by sl_no,id desc");
          $cnt_brd=@mysqli_num_rows($sel_brd);

          if($cnt_brd>0) {
            while($row_brd=@mysqli_fetch_array($sel_brd)) { ?>
              
            <div class="col-md-4 my-3">
                <div class="profile-card box-shadow h-100">
                    <?php if(!empty($row_brd['image'])) { ?>
                    <img src="./tbdata/members/<?php echo $row_brd['image']; ?>" class="card-img-top border flex-shrink-0" alt="Boardmembers" /> <?php } else {?>
                    <img src="./tbdata/members/boardmembers_thumb.gif" class="card-img-top border flex-shrink-0" alt="Boardmembers" /><?php }?>
                    <div class="card-body flex-grow-0">
                      <h4 class="card-title fs-6 text-dark-emphasis"><?php echo $row_brd['name']; ?></h4>
                      <p class="card-text text-goldenbrown my-2 lh-sm fw-600"><?php echo $row_brd['designation']; ?></p>
                      <small class="card-text text-secondary d-block lh-sm"><?php echo $row_brd['addr']; ?></small>
                    </div>
                </div>
            </div>

		    <?php $s++; } } }?> 

    </div>
  </div>
</div>

<!--------------Footer--------------->
<?php include "tb_footer.php"; ?>

</body>
</html>