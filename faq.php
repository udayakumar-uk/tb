<?php 
ob_start();
@session_start();
include "include/include.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title> FAQ | Tobacco Board</title>
	
	<?php include "head.php"; ?>
</head>
<body>

<?php include "tb_header.php"; ?>

<!--------------Content--------------->
<div id="main-content">
  <div id="content" class="container">
    
  <div class="row">
    <h2 class="admin-title col">FAQ</h2>

    <div class="col-auto">
      <?php if(isset($_GET['succ']) && $_GET['succ']==2){ ?>
        <div class="alert alert-danger d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
          <span class="flex-shrink-0 me-2 material-symbols-rounded">check_circle</span>
          <span> Mail has not sent.Please try again later</span>
        </div>
      <?php } ?>
      <?php if(isset($_GET['succ']) && $_GET['succ']==1){ ?>
        <div class="alert alert-success d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
          <span class="flex-shrink-0 me-2 material-symbols-rounded">check_circle</span>
          <span> Mail has sent successfully</span>
        </div>
      <?php } ?>
    </div>
  </div>

  <form id="form1" name="form1" method="post" action="faq.php" onsubmit="return validation();"> 
    <span class="text-danger" id="error_msg"></span> 
    <div class="row">
      <div class="col-md-6 row">
        <div class="form-group col-md-6">
          <label for="name" class="form-label">Name</label>
          <input name="name" type="text" id="name" class="form-control" />
        </div>
        <div class="form-group col-md-6">
          <label for="email" class="form-label">E-Mail</label>
          <input name="email" type="text" id="email" class="form-control" />
        </div>
        <div class="form-group col-md-6">
          <label for="org" class="form-label">Organization Name</label>
          <input name="org" type="text" id="org" class="form-control" />
        </div>
        <div class="form-group col-md-6">
          <label for="ph" class="form-label">Mobile/Telephone Number</label>
          <input name="ph" type="text" id="ph" class="form-control" />
        </div>
        <div class="form-group col-md-6">
          <label for="address" class="form-label">Address</label>
          <textarea name="address" id="address" rows="3" class="form-control"></textarea> 
        </div>
        <div class="form-group col-md-6">
          <label for="fb" class="form-label">Your Question</label>
          <textarea name="fb" id="fb" rows="3" class="form-control"></textarea> 
        </div>
        
        <div class="submit-button text-end">
          <input type="submit" class="btn btn-primary" name="Submit" value="Submit" />
        </div>
      </div>
    </div>
    
	</form>
    <?php
		  if(!empty($_POST['Submit']))
		  {
  				$strhtml1=$strhtml1."<div align=left><table border=1 cellpadding=8 cellspacing=0 bordercolor=#0000FF >";

				$strhtml1=$strhtml1."<tr><td >Name</td> <td >".$_POST['name']."</td></tr>";

				$strhtml1=$strhtml1."<tr><td >E-Mail</td> <td >".$_POST['email']."</td></tr>";

				$strhtml1=$strhtml1."<tr><td >Organization Name</td> <td >".$_POST['org']."</td></tr>";

				$strhtml1=$strhtml1."<tr><td >Address</td> <td >".$_POST['address']."</td></tr>";
				
				$strhtml1=$strhtml1."<tr><td >Phone Number</td> <td >".$_POST['ph']."</td></tr>";
				
				$strhtml1=$strhtml1."<tr><td >Question</td> <td >".$_POST['fb']."</td></tr>";

				$strhtml1=$strhtml1."</table></div>";

  
  
  	$tom="info@tobaccoboard.co.in,triveni11592@gmail.com";
	
	$subject="Feed Back";
	
	$msg =  $strhtml1;
	
	$headers  = "MIME-Version: 1.0\r\n";
	
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	
	$headers .= "From: ". $_POST['email'] ."";
	if(mail($tom, $subject, $msg, $headers))
	{
		redirect("faq.php?succ=1");
	}
	else
	{
		redirect("faq.php?succ=2");
	}

}
?>
			
			
  </div>
</div>


<!--------------Footer--------------->
<?php include "tb_footer.php"; ?>

</body>
</html>	