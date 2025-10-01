<?php
$inactive = 600;

if (isset($_SESSION["timeout"])) {
   $sessionTTL = time() - $_SESSION["timeout"];
    if ($sessionTTL > $inactive) {
        session_destroy();
        redirect("logout.php");
    }
}

$_SESSION["timeout"] = time();
?>