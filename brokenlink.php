<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/include.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title> Broken Link | Tobacco Board</title>
	
	<?php include "head.php"; ?>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js"></script>

<script>

function validation(){

	var mandatory=0;
	var valid=0;
	if($('#name').val()==''){
		mandatory=1;
	}
	else if($('#email').val()==''){
		mandatory=1;
	}
	else if($('#bl').val()==''){
		mandatory=1;
	}

	else if($('#email').val()!='' && echeck($('#email').val())==false){
		valid=1;
	}
	
	if(mandatory==1){
		$('#error_msg').html('Some fields are missing. * Fields are mandatory');
		return false;
	}
	else if(valid==1){
		$('#error_msg').html('Enter valid data');
		return false;
	}
	else {
		return true;
	}
}
function echeck(str){
	if (str.length > 0 ){
		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1){
			return false
		}

		else if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
			return false
		}

		else if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
			return false
		}

		else if (str.indexOf(at,(lat+1))!=-1){
			return false
		}

		else if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
			return false
		}

		else if (str.indexOf(dot,(lat+2))==-1){
			return false
		}

		else if (str.indexOf(" ")!=-1){
			return false
		}
		else if (str.lastIndexOf(".")>lstr-3){
			return false
		}
		else {
			return true					
		}
	} else {
		return true
	}
}
function trimString(str){
	while (str.charAt(0) == ' ')
	str = str.substring(1);
	while (str.charAt(str.length - 1) == ' ')
	str = str.substring(0, str.length - 1);
	return str;
}

</script>


</head>
<body>

<?php include "tb_header.php"; ?>

<!--------------Content--------------->
<div id="main-content">
  <div id="content" class="container">


<?php
	function datepattrn($a){
 		$b = substr($a,5, 2);// month
 		$c = substr($a,7, 1);// '-'
		$d= substr($a,8, 2);// day
		$e = substr($a,4, 1);// '-'
 		$f = substr($a,0, 4);// year
		$c="-";
		$e="-";
		$g=$d."/".$b."/".$f;
		return $g;
	}
	function datepattrn1($a){
 		$b = substr($a,3, 2);// month
 		$c = substr($a,2, 1);// '-'
		$d= substr($a,0, 2);// day
		$e = substr($a,5, 1);// '-'
 		$f = substr($a,6, 4);// year
		$c="-";
		$e="-";
		$g=$f."/".$b."/".$d;
		return $g;
	}
?>


<a name="top" id="top"></a>

<div class="row">
	<h2 class="admin-title col">Brokenlink</h2>

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

<form id="form1" name="form1" method="post" action="brokenlink.php" onsubmit="return validation();">
	<div class="row">
		<div class="col-lg-4 col-sm-6">
			<span class="text-danger" id="error_msg"></span> 
			<div class="form-group">
				<label for="name" class="form-label">Name</label>
            	<input name="name" type="text" id="name" class="form-control" />
			</div>
			<div class="form-group">
				<label for="email" class="form-label">E-Mail</label>
            	<input name="email" type="text" id="email" class="form-control" />
			</div>
			<div class="form-group">
				<label for="email" class="form-label">Broken Link</label>
            	<textarea name="bl" id="bl" class="form-control"></textarea>
			</div>
			
			<div class="submit-button">
				<input type="submit" class="btn btn-primary" name="Submit" value="Submit" />
			</div>
		</div>
	</div>
</form>


	</div>
</div>


<?php
	if(!empty($_POST['Submit']))  {
		$strhtml1=$strhtml1."<div align=left><table border=1 cellpadding=8 cellspacing=0 bordercolor=#0000FF >";

		$strhtml1=$strhtml1."<tr><td >Name</td>&nbsp;<td >".$_POST['name']."</td></tr>";

		$strhtml1=$strhtml1."<tr><td >E-Mail</td>&nbsp;<td >".$_POST['email']."</td></tr>";
		
		$strhtml1=$strhtml1."<tr><td >Broken Link</td>&nbsp;<td >".$_POST['bl']."</td></tr>";

		$strhtml1=$strhtml1."</table></div>";
  
		$tom="info@tobaccoboard.com,triveni11592@gmail.com";

		$subject="Feed Back";

		$msg =  $strhtml1;

		$headers  = "MIME-Version: 1.0\r\n";

		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

		$headers .= "From: ". $_POST['email'] ."";

		if(mail($tom, $subject, $msg, $headers)){
			redirect("brokenlink.php?succ=1");
		}
		else {
			redirect("brokenlink.php?succ=2");
		}
   
	}
  ?>



<!--------------Footer--------------->
<?php include "tb_footer.php"; ?>

</body>
</html>	