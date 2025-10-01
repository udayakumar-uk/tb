<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Employee Data | Tobacco Board, Guntur</title>

<style type="text/css">
<!--
.style30 {color: #990000}
.style31 {color: #FF0000}
-->
</style>
</head>
<script type="text/JavaScript">
function validate_login()
{
	if(document.getElementById("userid").value=="")
	{
		alert("Enter User Id");
		document.getElementById("userid").focus();
		return false;
	}
	else if(document.getElementById("pass").value=="")
	{
		alert("Enter Password");
		document.getElementById("pass").focus();
		return false;
	}
	else
	return true;
}
</script>
<body>
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
  if($_GET['stype']!="")
  $stp=$_GET['stype'];
  else
  $stp='Employee Data';
  if($stp=='Employee Data')
  $stp='Employee Data';
  
	if($_POST['userid']!="")
	{
		$sel=executework("select * from employee_admin where userid='".$_POST['userid']."' and pass='".$_POST['pass']."'");
		$cnt=@mysqli_num_rows($sel);
		if($cnt>0)
		{
			session_register("tobacco");
        	$_SESSION['tobacco']=$_POST['userid'];
			redirect("employeedata.php");
		}
		else
		{
			$valid=1;
		}
	}
  
?>
<a name="top" id="top"></a>
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><img src="tob2_imgs/spacer.png" width="1" height="2" /></td>
  </tr>
  <tr>
    <td colspan="2" valign="top"><div id="head">
      <?php include_once("headerad.php")
  ?>
    </div></td>
  </tr>
  <tr>
    <td colspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tabbor">
      <tr>
        <td width="90%" height="25" bgcolor="#F7F7F7">&nbsp;</td>
        <td width="10%" bgcolor="#F7F7F7">&nbsp;</td>
      </tr>
    </table>
        <br />
        <table width="99%" border="0" align="right" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30" align="justify"><div class="rightcorner1">
                <div class="innercontent">
                  <div class="rightcorner1">
                    <div class="innercontent">
                      <div>
                        <div>
                          <div>
                            <div>
                              <table width="65%" border="0">
                                <tr>
                                  <td><strong><?php echo $stp ?></strong></td>
                                </tr>
                                <tr>
                                  <td height="90" colspan="3"><div align="center">
                                      <form id="form2" name="form2" method="post" action="" onsubmit="return validate_login();">
                                        <table width="80%" border="0" align="center" cellpadding="2" cellspacing="2">
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
                                            <td width="33%"><strong>Login</strong></td>
                                            <td width="6%">&nbsp;</td>
                                            <td width="61%">&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td><span class="style31">
                                              <?php if($valid==1) { ?>
                                              Invalid UserId or Password.
                                              <?php } ?>
                                            </span></td>
                                          </tr>
                                          <tr>
                                            <td><div align="right">User Id</div></td>
                                            <td>&nbsp;</td>
                                            <td><label>
                                              <input type="text" name="userid" id="userid" />
                                            </label></td>
                                          </tr>
                                          <tr>
                                            <td><div align="right">Password</div></td>
                                            <td>&nbsp;</td>
                                            <td><label>
                                              <input type="password" name="pass" id="pass" />
                                            </label></td>
                                          </tr>
                                          <tr>
                                            <td colspan="3"><div align="center">
                                                <label>
                                                <input type="submit" name="button" id="button" value="Submit" />
                                                </label>
                                            </div></td>
                                          </tr>
                                        </table>
                                      </form>
                                  </div></td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <a href="javascript:window.print()" target="_blank"></a> </div></td>
          </tr>
      </table></td>
  </tr>
  <?php
  	if(empty($_GET[prin]))
	{
  ?>
  <tr>
    <td colspan="2" valign="top"><table width="100%" border="0">
      <tr>
        <td width="39%">&nbsp;</td>
        <td width="41%">&nbsp;</td>
        <td width="20%"><div align="right"><a href="#top" ><img src="tob2_imgs/bact2top.jpg" width="94" height="27" border="0" title="Back to top" alt="Back to Top" /></a></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><img src="tob2_imgs/spacer.png" width="220" height="1" /></td>
    <td width="442" valign="top"><img src="tob2_imgs/spacer.png" width="535" height="1" /></td>
  </tr>
  <?php
  	}
  ?>
  <tr>
    <td colspan="2" valign="top"><div id="footer">
      <?php include_once("footerad.php")
  ?>
    </div></td>
  </tr>
</table>
</body>
</html>
