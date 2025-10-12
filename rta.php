<?php 
ob_start();
@session_start();
include "include/include.php";
$selcont=executework("select * from tob_cms where pageid=58");
$rowc=@mysqli_fetch_array($selcont);?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>RTI Act | Tobacco Board</title>
  
	<?php include "head.php"; ?>
</head>
<body>

<?php include "tb_header.php"; ?>

<!--------------Content--------------->
<div id="main-content">
    <div id="content" class="container">
        <?php echo $rowc['content'] ?>
    </div>
</div>

<!--------------Footer--------------->
<?php include "tb_footer.php"; ?>

</body>
</html>