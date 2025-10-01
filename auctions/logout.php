<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<?php
unset($_SESSION['tobadmin']);
unset($_SESSION['tob']);
//redirect("index.php");
?>
<script>parent.location.href="index.php"</script>
</body>
</html>
