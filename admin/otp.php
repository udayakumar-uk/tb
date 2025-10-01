<?php

ob_start();

session_start();

error_reporting(0);

header( 'X-Frame-Options: SAMEORIGIN' );

header("Cache-control: private"); 

include_once("include/includei.php");

include('nocsrf.php');

function sendSMS($number,$message,$concat = 1) 
{
	//$request = "http://www.smslogin.mobi/spanelv2/api.php?username=oranze&password=a12345&to=".$number."&from=Kitgnt&message=".urlencode($message);
	$request = "http://www.smslogin.mobi/spanelv2/api.php?username=oranze&password=a12345&to=".$number."&from=WSTTEC&message=".urlencode($message);
	//$request="http://www.smslogin.mobi/spanelv2/api.php?username=vajram&password=123456&to=".$number."&from=vajram&message=".urlencode($message);  
	$ch = curl_init();
	echo $ch;
	
	curl_setopt($ch, CURLOPT_URL, $request);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec($ch);
	curl_close($ch);
	return explode(',',$response);
}
function str_rand($length, $seeds)
{
    // Possible seeds
    $seedings['alpha'] = 'abcdefghijklmnopqrstuvwqyz';
    $seedings['numeric'] = '0123456789';
    $seedings['alphanum'] = 'abcdefghijklmnopqrstuvwqyz0123456789';
    $seedings['hexidec'] = '0123456789abcdef';
    
    // Choose seed
    if (isset($seedings[$seeds]))
    {
        $seeds = $seedings[$seeds];
    }
    
    // Seed generator
    list($usec, $sec) = explode(' ', microtime());
    $seed = (float) $sec + ((float) $usec * 100000);
    mt_srand($seed);
    
    // Generate
    $str = '';
    $seeds_count = strlen($seeds);
    
    for ($i = 0; $length > $i; $i++)
    {
        $str .= $seeds{mt_rand(0, $seeds_count - 1)};
    }
    
    return $str;
}

if(!empty($_GET['username']))
{
	$username=$_GET['username'];
}
else if(!empty($_POST['username']))
{
	$username=$_POST['username'];
}
else
{
	$username="";
}

if(!empty($username))
{
	$sud=executework("select * from tob_employeeview where username='".$username."'");
	$rud=@mysqli_fetch_array($sud);
	$userid=$rud['id'];
}
else
{
	$userid="";
}
if(!empty($_GET['msg']))
{
	$rand_num=str_rand(5,'numeric');
	$msg="Your otp for Admin Login is: ".$rand_num."";
	
	$sms_api_result = sendSMS('8179995254,9394154838,9390053147',$msg,'1');
	$upd=executework("update tob_admin set otp='".$rand_num."' where id=1");
	redirect("otp.php?username=".$_GET['username']);
}
else if(!empty($_GET['empmsg']))
{
	$sld=executework("select * from tob_employeeview where username='".$_GET['username']."'");
	if($_GET['username']=="director")
	{
		$rand_num=str_rand(5,'numeric');
		$msg="Your otp for Admin Login is: ".$rand_num."";
		
		$sms_api_result = sendSMS('9394154838,9866076426',$msg,'1');
		$upd=executework("update tob_employeeview set otp='".$rand_num."' where id='".$userid."'");
		redirect("otp.php?username=".$_GET['username']);
	}
	else if($_GET['username']=="personnel")
	{
		$rand_num=str_rand(5,'numeric');
		$msg="Your otp for Admin Login is: ".$rand_num."";
		
		$sms_api_result = sendSMS('9394154838,9052562591',$msg,'1');
		$upd=executework("update tob_employeeview set otp='".$rand_num."' where id='".$userid."'");
		redirect("otp.php?username=".$_GET['username']);
	}
}
if(!empty($_POST['Submit']))
{
	//echo "hiii";
	if($_POST['username']=="admin")
	{
		//echo "hello";
		$sel=executework("select * from tob_admin where admin='admin' and otp='".$_POST['otp']."'");
		$cnt=@mysqli_num_rows($sel);
		if($cnt>0)
		{
			
			$row=@mysqli_fetch_array($sel);
			$_SESSION['tobadmin']=$row['admin'];
			$_SESSION['tob']='admin';
			
			$ins=executework("update tob_admin set previous_date ='". make_safe($row['current_dt'])."', current_dt='". make_safe(date('Y-m-d H:i:s'))."', ip_address ='".$_SERVER['REMOTE_ADDR']."' where admin ='".$_SESSION['tobadmin']."'");
			
			redirect("adminmain.php");
		}
		else
		{
			redirect("otp.php?invalid=1&username=admin");
		}
	}
	else if($_POST['username']=="director" || $_POST['username']=="personnel")
	{
		$sel=executework("select * from tob_employeeview where username='".$_POST['username']."' and otp='".$_POST['otp']."'");
		$cnt=@mysqli_num_rows($sel);
		if($cnt>0)
		{
			
			$row=@mysqli_fetch_array($sel);
			$_SESSION['tobadmin']=$row['username'];
			$_SESSION['tob']='state';
			
			$update=executework("update tob_employeeview set previous_date ='". make_safe($row['current_dt'])."', current_dt='". make_safe(date('Y-m-d H:i:s'))."', ip_address ='".$_SERVER['REMOTE_ADDR']."' where username ='".$_SESSION['tobadmin']."'");
			
			redirect("adminmain.php");
		}
		else
		{
			redirect("otp.php?invalid=1&username=".$_POST['username']);
		}
	} 
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

<link rel="stylesheet" href="jsc/slider.css" type="text/css" media="screen" />

<link rel="stylesheet" href="jsc/style.css" type="text/css" media="screen" />

<title>Administrator  Login |Welcome To TOBACCO BOARD</title>

<style type="text/css">

<!--

body {

	margin-left: 0px;

	margin-top: 0px;

	margin-right: 00px;

	margin-bottom: 0px;

	background-image: url(hamara_nw_imgs/bkgrd.gif);

}

.sll img{ max-width:100px; min-height:80px;} 

.style5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #FFFFFF; }

a:link {

	color: #E6EAEE;

	text-decoration: none;

}

a:visited {

	color: #E6EAEE;

	text-decoration: none;

}

a:hover {

	color: #E6EAEE;

	text-decoration: none;

}

a:active {

	color: #E6EAEE;

	text-decoration: none;

}

a.a:link {

	color: #000000;

	text-decoration: none;

}

a.a:visited {

	color: #000000;

	text-decoration: none;

}

a.a:hover {

	color: #000000;

	text-decoration: none;

}

a.a:active {

	color: #000000;

	text-decoration: none;

}

a.b:link {

	color: #000000;

	text-decoration: none;

}

a.b:visited {

	text-decoration: none;

	color: #000000;

}

a.b:hover {

	text-decoration: none;

	color: #000000;

}

a.b:active {

	text-decoration: none;

	color: #000000;

}

a.c:link {

	color: #C15E02;

	text-decoration: none;

}

a.c:visited {

	text-decoration: none;

	color: #C15E02;

}

a.c:hover {

	text-decoration: none;

	color: #C15E02;

}

a.c:active {

	text-decoration: none;

	color: #C15E02;

}

.style112 {

	font-family: Arial, Helvetica, sans-serif;

	font-size: 24px;

	color: #E6EAEE;

}



-->

</style>

<script type="text/javascript">

//      var verifyCallback = function(response) 
//
//	  {      
//
//	    // alert(response);
//
//      };
//
//      var widgetId1;
//
//      var widgetId2;
//
//      var onloadCallback = function() {
//
//        widgetId1 = grecaptcha.render('example1', {
//
//          'sitekey' : '6LfI0A4UAAAAAKxiHIvGTOjk1EcDCtpVPeRYZrAg',
//
//          'theme' : 'light'
//
//        });
//
//      };

    </script>

<script language="JavaScript">

	function funcheck(form)

	{

		var fieldcheck=true;

		if (form.otp.value=="")

		{

			

			alert("Enter OTP")

			document.f1.otp.focus()

			return false

		}


		else

		{

			return true;

			

		}

	}



</script>

</head>

<body>
<?php 

//192.188.0.110;

//$result=csrf_token_check();
	$result='Done';


$token = NoCSRF::generate( 'csrf_token' );

?>
<?php

include_once("header.php");

?>
<form  action="" method="post" name="f1" id="f1" onsubmit="return funcheck(this)">

  <center>

    <table width="50%" align="center">

      

      <tr>

        <td colspan="3">&nbsp;</td>

      </tr>

      <tr>

        <td colspan="3">&nbsp;</td>

      </tr>

      <tr>

        <td colspan="3"><div align="left"><strong><font size="3" face="Verdana, Arial, Helvetica, sans-serif"> OTP </font></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div></td>

      </tr>

      <tr>

        <td width="30%">&nbsp;</td>

        <td width="10%">&nbsp;</td>

        <td width="60%">&nbsp;</td>

      </tr>


     <?php
  	if(isset($exist) && $exist!="")
	{
  ?>
      <tr>
        <td colspan="3"><div align="center"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Invalid Login </strong></font></div></td>
      </tr>
      <?php
	}
	else if(!empty($_GET['invalid'])==1)
	{
	?>
    <tr>
        <td colspan="3"><div align="center"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Invalid OTP </strong></font></div></td>
      </tr>
    <?php
	}
	if(!empty($_GET['username']))
	{
		if($_GET['username']=="admin")
		{
			$slo=executework("select * from tob_admin where admin='".$_GET['username']."'");
			$rlo=@mysqli_fetch_array($slo);
			$otpv=$rlo['otp'];
		}
		else
		{
			$slo=executework("select * from tob_employeeview where username='".$_GET['username']."'");
			$rlo=@mysqli_fetch_array($slo);
			$otpv=$rlo['otp'];
		}
  ?>
  <tr>
        <td colspan="3"><div align="center"><font color="#3b680e" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Your OTP for admin login : <?php echo $otpv; ?> </strong></font></div></td>
      </tr>
  <?php
  	}
  ?>
  

   <?php /*?><tr>

        <td colspan="3" align="center"> <?php echo $msg;  ?></td>

      </tr><?php */?>

      <tr>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td><div align="right"><strong>Enter your OTP</strong></div></td>

        <td><div align="center"><strong>:</strong></div></td>

        <td>
        <input type="hidden" name="username" id="username" value="<?php echo $username; ?>">
        <input type="hidden" name="userid" id="userid" value="<?php echo $userid; ?>">
        <input type="text" name="otp" id="otp" size="20" maxlength="10" />
        </td>

      </tr>

      


   <!--   <tr>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td><div id="example1"></div></td>

      </tr>-->

      <tr>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

		

        <td><label>

        <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">

          <input type="submit" name="Submit" value="Submit" />

        </label></td>

      </tr>

      <tr>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

      </tr>

    </table>

  </center>


</form>
</td>

</tr>

</table>

<script type="text/javascript" src="jsc/jquery-1.6.1.min.js"></script>

    <script type="text/javascript" src="jsc/jquery.nivo.slider.pack.js"></script>

    <script type="text/javascript">

    $(window).load(function() {

        $('#slider').nivoSlider();

    });

    </script></body>

<?php

include_once("footer.php");

?>

<div class=sll>

<script language="JavaScript" type="text/javascript">

TrustLogo("https://tobaccoboard.com/comodo_secure_seal_100x85_transp.png", "CL1", "none");

</script>

<a  href="https://ssl.comodo.com" id="comodoTL">Comodo SSL</a>

</div>

</body>

</html>

<script type='text/javascript'>

function refreshCaptcha(){

	var img = document.images['captchaimg'];

	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;

}

</script>


