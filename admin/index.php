<?php

ob_start();

session_start();

error_reporting(0);

header( 'X-Frame-Options: SAMEORIGIN' );

header("Cache-control: private"); 

include_once("include/includei.php");

include('nocsrf.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

<!--<link rel="stylesheet" href="jsc/slider.css" type="text/css" media="screen" />-->

<!--<link rel="stylesheet" href="jsc/style.css" type="text/css" media="screen" />-->

<title>Administrator  Login |Welcome To TOBACCO BOARD</title>

<style type="text/css">

<!--

body {

	margin-left: 0px;

	margin-top: 0px;

	margin-right: 00px;

	margin-bottom: 0px;

	/*background-image: url(hamara_nw_imgs/bkgrd.gif);*/

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

		if (form.userid.value=="")

		{

			

			alert("Enter Userid")

			document.f1.userid.focus()

			return false

		}

		else if(form.password.value=="")

		{

			

			alert("Enter Password ")

			document.f1.password.focus()

			return false

		}
// 		else if(form.captcha_code.value=="")
// 		{
// 			alert("Enter Captcha Code ")

// 			document.f1.captcha_code.focus()

// 			return false
// 		}

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

	if(!empty($result) && $result=='Done')

	{
	

if (isset($_POST['userid']) && !empty($_POST['userid']))

{

// if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0){  
// 		$msg="<span style='color:red'>The Captcha code does not match!</span>";// Captcha verification is incorrect.		
// 		echo "cjk";
// 	}
// 	else
// 	{
		
		$intst00=executework("select * from tob_admin where admin='" . $_POST['userid'] . "' and password='" . $_POST['password'] . "'");


		$countst00=@mysqli_num_rows($intst00);


		if($countst00 > 0)

		{

			$row00=@mysqli_fetch_array($intst00);

        	$_SESSION['tobadmin']=$_POST['userid'];

			$_SESSION['tob']='admin';

			//print_r($row00);

		

		$ins=executework("update tob_admin set previous_date ='".$row00['current_dt']."', current_dt='".date('Y-m-d H:i:s')."', ip_address ='".$_SERVER['REMOTE_ADDR']."' where admin ='".$_SESSION['tobadmin']."'");

			redirect("adminmain.php");

		}

		else

		{

			$intst000=executework("select * from tob_employeeview where username ='".$_POST['userid']."' and password ='".$_POST['password']."' and disable=0");

			$countst000=@mysqli_num_rows($intst000);

			$rowt=@mysqli_fetch_array($intst000);

			if($rowt['permissions']=='VIEW,PRINTt' || $rowt['permissions']=='PRINT,VIEWt')

			{

				$exist=1;

			}

			

			else if($countst000 > 0)

			{

				$_SESSION['tobadmin']=$_POST['userid'];

				$_SESSION['tob']='state';

				//echo $rowt['current_dt'];

				$update=executework("update tob_employeeview set previous_date ='".$rowt['current_dt']."', current_dt='".date('Y-m-d H:i:s')."', ip_address ='".$_SERVER['REMOTE_ADDR']."' where username ='".$_SESSION['tobadmin']."'");

				redirect("adminmain.php");

			}

			else

			{

				$exist=1;

			}

		}

//}

}

}

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

        <td colspan="3"><div align="left"><strong><font size="3" face="Verdana, Arial, Helvetica, sans-serif"> Administrator Login </font></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div></td>

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
  ?>
  

   <tr>

        <td colspan="3" align="center"> <?php echo $msg;  ?></td>

      </tr>

      <tr>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td><div align="right"><strong>Userid</strong></div></td>

        <td><div align="center"><strong>:</strong></div></td>

        <td><input type="text" name="userid" size="20" maxlength="10" /></td>

      </tr>

      <tr>

        <td><div align="right"><strong>Password</strong></div></td>

        <td><div align="center"><strong>:</strong></div></td>

        <td><input type="password" name="password" size="20" maxlength="15" /></td>

      </tr>

<tr style="display:none">
      <td><div align="right"><strong>Validation code</strong></div></td>
      <td><div align="center">:</div></td>
      <td width="49%" class="style7"><img src="captcha.php?rand=<?php echo rand();?>" id='captchaimg'><br>
          <label for='message'><span class="style7">Enter the code above here</span></label>
        <br>
        <input id="captcha_code" name="captcha_code"  type="text" >
        <br>
        Can't read the image? click <a href='javascript: refreshCaptcha();' class="style1" style="color:#0066FF">here</a> to refresh.</td>
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

<!--<script type="text/javascript" src="jsc/jquery-1.6.1.min.js"></script>-->

    <!--<script type="text/javascript" src="jsc/jquery.nivo.slider.pack.js"></script>-->

    <script type="text/javascript">

    $(window).load(function() {

        // $('#slider').nivoSlider();

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