<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/include.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Tobacco Board, Guntur</title>

<style type="text/css">
<!--
.style30 {color: #990000}
.style32 {	font-size: 16px;
	color: #CC0000;
	font-weight: bold;
}
.style34 {font-size: 16px}
-->
</style>
</head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js"></script>
<!--
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
-->  
  <script>
/*  $(function() {
    $("#form1").validate({
    
        // Specify the validation rules
        rules: {
            name: "required",
            email: {
                required: true,
                email: true
            },
            address: "required",
			ph: "required",
			fb: "required",
        },
        
        // Specify the validation error messages
        messages: {
            name: "Please enter your name",
            email: "Please enter a valid email address",
            address: "Please enter your address",
            ph: "Please enter Your Mobile Number",
			fb: "Please enter feedback",
        },
        
        submitHandler: function(form) {
            form1.submit();
        }
    });

  });
*/  

function validation()
{

	var mandatory=0;
	var valid=0;
	if($('#name').val()=='')
	{
		mandatory=1;
	}
	else if($('#email').val()=='')
	{
		mandatory=1;
	}
	else if($('#bl').val()=='')
	{
		mandatory=1;
	}

	else if($('#email').val()!='' && echeck($('#email').val())==false)
	{
		valid=1;
	}
	
	if(mandatory==1)
	{
		$('#error_msg').html('Some fields are missing. * Fields are mandatory');
		return false;
	}
	else if(valid==1)
	{
		$('#error_msg').html('Enter valid data');
		return false;
	}
	else
	{
		return true;
	}
}
function echeck(str)
{
	if (str.length > 0 )
	{
		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1)
		{

			return false
		}

		else if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr)
		{

			return false
		}

		else if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr)
		{

			return false
		}

		else if (str.indexOf(at,(lat+1))!=-1)
		{

			return false
		}

		else if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot)
		{

			return false
		}

		else if (str.indexOf(dot,(lat+2))==-1)
		{

			return false
		}

		else if (str.indexOf(" ")!=-1)
		{

			return false
		}
		else if (str.lastIndexOf(".")>lstr-3)
		{

			return false
		}
		else
		{
			return true					
		}
	}
	else
	{
		return true
	}
}
function trimString(str)
{
	while (str.charAt(0) == ' ')
	str = str.substring(1);
	while (str.charAt(str.length - 1) == ' ')
	str = str.substring(0, str.length - 1);
	return str;
}


  </script>
<body>
	<?php include "tb_header.php"; ?>
<?php
	function datepattrn($a)
	{
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
	function datepattrn1($a)
	{
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
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><img src="tob2_imgs/spacer.png" width="1" height="2" /></td>
  </tr>
  <tr>

  <tr>
  	<?php
		if(empty($_GET['prin']))
		{
	?>
    <td width="225" rowspan="2" valign="top" bgcolor="#ededed" >
	<?php include_once("leftmenu.php")
  ?>	</td>
  <?php
  		}
  ?>
    <td colspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tabbor">
      <tr>
        <td width="90%" height="25" bgcolor="#F7F7F7"><div class="breadcrumb flat"> <a href="index.php">&nbsp;Home</a>&nbsp;&nbsp; <a href="#">BrokenLink</a></div></td>
        <td width="10%" bgcolor="#F7F7F7">Print</td>
      </tr>
    </table>
      <br />
		<form id="form1" name="form1" method="post" action="brokenlink.php" onsubmit="return validation();">
      <table width="99%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30" align="justify"><table width="100%">
		<?php
		if(isset($_GET['succ']) && $_GET['succ']==1)
		{
		?>
          <tr>
            <td colspan="2"><div align="center">Mail has sent successfully.</div></td>
          </tr>
		  <?php
		  }
			if(isset($_GET['succ']) && $_GET['succ']==2)
			{
		  ?>
          <tr>
            <td colspan="2"><div align="center">Mail has not sent.Please try again laer.</div> </td>
            </tr>
			<?php
			}
			?>
          <tr>
            <td width="43%"><div align="left">Name</div></td>
            <td width="57%"><input name="name" type="text" id="name" /></td>
          </tr>
          <tr>
            <td><div align="left">E-Mail</div></td>
            <td>
                <input name="email" type="text" id="email" />            </td>
          </tr>

          <tr>
            <td><div align="left">Broken Link </div></td>
            <td>
                <textarea name="bl" id="bl"></textarea>            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>
                <input type="submit" name="Submit" value="Submit" /><span class="text-danger" id="error_msg"></span>            </td>
          </tr>
        </table></td>
      </tr>
    </table>
	</form>
	</td>
           
  </tr>
		  <?php
		  if(!empty($_POST['Submit']))
		  {
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
	
	if(mail($tom, $subject, $msg, $headers))
	{
		redirect("brokenlink.php?succ=1");
	}
	else
	{
		redirect("brokenlink.php?succ=2");
	}
  
//echo $tom;
//echo $subject;
//echo $msg;
}
  	if(empty($_GET[prin]))
	{
  ?>
  <tr>
    <td colspan="2" valign="top"><table width="100%" border="0">
      <tr valign="middle">
        <td><div align="right"><a href="#top" >
			<img src="tob2_imgs/bact2top.jpg" width="94" height="27" border="0" title="Back to top" alt="Back to Top" /></a></div>
		  </td>
        </tr>
    </table></td>
  </tr>

<?php
	}
?>

  <tr>
    <td colspan="3" valign="top"><div id="footer"><?php include_once("footer.php");?></div></td>
  </tr>

</table>
</body>
</html>
