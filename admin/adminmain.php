<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION['tobadmin'])) { ?>

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
    <h1 class="title my-5 no-dash text-secondary">WELCOME TO TOBACCO BOARD ADMINISTRATION </h1>
</main>


</section>

<?php include_once("footer.php");?>

<?php } else { ?>
  <script>parent.location.href="index.php";</script>
<?php }	?>

</body>
</html>