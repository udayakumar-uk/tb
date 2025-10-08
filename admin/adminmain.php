<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION['tobadmin']))
{
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once("head.php")?>
  
  <title>TOBACCO BOARD | Admin</title>
</head>
<body>

<section id="adminLayout">
<?php include "header.php"?>

<?php include "sidebar.php"; ?>

<main id="adminMain" class="text-center">
  <h1>WELCOME TO TOBACCO BOARD ADMINISTRATION </h1>
</main>


</section>

<?php include_once("footer.php");?>

</body>
</html>
<?php }
  else { ?>
  
  <script>parent.location.href="index.php";</script>

  <?php }	?>