﻿<?php 
ob_start();
@session_start();
include "include/include.php";
$selcont=executework("select * from tob_cms where pageid=83");
$rowc=@mysqli_fetch_array($selcont);?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title> Privacy Policy | Tobacco Board</title>
  
  <?php include "head.php"; ?>
</head>
<body>

<?php include "tb_header.php"; ?>

<!--------------Content--------------->
<div id="main-content">
  <div id="content" class="container">
    
    <p>As a general rule, this website does not  collect Personal   Information about you when you visit the site. You can  generally visit   the site without revealing Personal Information, unless you  choose to   provide such information. </p>
    <h5 class="text-goldenbrown">Site Visit data:</h5>
    <p>This website records your visit and logs  the following   information for statistical purposes -your server’s address; the  name   of the top-level domain from which you access the Internet (for example,    .gov, .com, .in, etc.); the type of browser you use; the date and time   you  access the site; the pages you have accessed and the documents   downloaded and  the previous Internet address from which you linked   directly to the site. </p>
    <p>We will not identify users or their  browsing   activities, except when a law enforcement agency may exercise a  warrant   to inspect the service provider’s logs. </p>
    <h5 class="text-goldenbrown">Cookies:</h5>
    <p>A  cookie is a piece of software code that an internet   web site sends to your  browser when you access information at that   site. This site does not use cookies. </p>
    <h5 class="text-goldenbrown">Email Management</h5>
    <p>Your email address will only be recorded  if you choose   to send a message. It will only be used for the purpose for which  you   have provided it and will not be added to a mailing list. Your email    address will not be used for any other purpose, and will not be   disclosed,  without your consent. </p>
    <h5 class="text-goldenbrown">Collection of  Personal Information:</h5>
    <p>If you are asked for any other Personal  Information   you will be informed how it will be used if you choose to give it.  If   at any time you believe the principles referred to in this privacy   statement  have not been followed, or have any other comments on these   principles, please  notify the webmaster through the contact us page. </p>
    <p><strong class="text-goldenbrown">Note: </strong>The use of the  term “Personal Information” in this privacy statement refersto  any information from which your identity is apparent or can be reasonably  ascertained. </p>
	
  </div>
</div>

<!--------------Footer--------------->
<?php include "tb_footer.php"; ?>

</body>
</html>	