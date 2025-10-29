<?php 
ob_start();
@session_start();
include "include/include.php";
$selcont=executework("select * from tob_cms where pageid=83");
$rowc=@mysqli_fetch_array($selcont);?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title> Terms & Conditions | Tobacco Board</title>
  
  <?php include "head.php"; ?>
</head>
<body>

<?php include "tb_header.php"; ?>

<!--------------Content--------------->
<div id="main-content">
  <div id="content" class="container">
    <p>This website is  designed, developed and maintained by Tobacco Board, Government of  India. </p>
    <p>Though all efforts have  been made to ensure the   accuracy and currency of the content on this website,  the same should   not be construed as a statement of law or used for any legal  purposes.   Incase of any ambiguity or doubts, users are advised to verify/check    with the Department(s) and/or other source(s), and to obtain appropriate    professional advice. </p>
    <p>Under no circumstances will this Department be  liable   for any expense, loss or damage including, without limitation, indirect    or consequential loss or damage, or any expense, loss or damage   whatsoever  arising from use, or loss of use, of data, arising out of or   in connection with  the use of this website. </p>
    <p>These terms and  conditions shall be governed by and   construed in accordance with the Indian  Laws. Any dispute arising under   these terms and conditions shall be subject to  the jurisdiction of the   courts of India. </p>
    <p>The information posted  on this website could include   hypertext links or pointers to information  created and maintained by   non-Government/private organisations. Tobacco Board is providing these   links and pointers solely for your  information and convenience. When   you select a link to an outside website, you  are leaving the Tobacco   Board website and are subject to the  privacy and security policies of   the owners/sponsors of the outside website. </p>
    <p>Tobacco Board,  does not guarantee the availability of such linked pages at all times. </p>
  </div>
</div>

<!--------------Footer--------------->
<?php include "tb_footer.php"; ?>

</body>
</html>	