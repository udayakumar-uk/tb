<?php 
ob_start();
@session_start();
include "include/include.php";
$selcont=executework("select * from tob_cms where pageid=83");
$rowc=@mysqli_fetch_array($selcont);?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title> Copyrights | Tobacco Board</title>
  
  <?php include "head.php"; ?>
</head>
<body>

<?php include "tb_header.php"; ?>

<!--------------Content--------------->
<div id="main-content">
    <div id="content" class="container">
		<p>&ldquo;Material on this site is subject to copyright  protection unless otherwise indicated. The material may be downloaded without  requiring specific prior permission. Any other proposed use of the material is  subject to the approval of Tobacco Board. Application for  obtaining permission should be made to info@tobaccoboard.co.in.&rdquo; </p>			
    </div>
</div>

<!--------------Footer--------------->
<?php include "tb_footer.php"; ?>

</body>
</html>	