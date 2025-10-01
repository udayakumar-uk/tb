<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");

if($_POST['email']!="")
{
	$selmax=executework("select max(id) from tob_reg");
	$rowm=@mysqli_fetch_array($selmax);
	if($rowm[0]!="")
	$maxid=$rowm[0]+1;
	else
	$maxid=1;
	
	$dat=date('Y-m-d');
	
		$intreg=executeupdate("insert into tob_reg values(".$maxid.",".$_POST['id'].",'".$dat."','".$_POST['name']."','".$_POST['adrs']."','".$_POST['email']."','".$_POST['phno']."','".$_POST['faxno']."','".$_POST['website']."','".$_POST['cpersion']."','".$_POST['designation']."','".$_POST['mobnum']."')");
		
		redirect("../admin/tenderfiles/".$_POST['openpdf']);

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tobacco Board, Guntur</title>

<style type="text/css">
<!--
.style31 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style34 {font-size: 12px}
.style35 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.style37 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
-->
</style>
<script language="javascript">
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

function check(form1)
{
var a=document.form1.phno.value;
var b=document.form1.mobnum.value;

if(document.form1.name.value=="")
{
	alert("Enter Name");
	document.form1.name.focus();
	return false;
}
else if(document.form1.adrs.value=="")
{
	alert("Enter Address");
	document.form1.adrs.focus();
	return false;
}
else if(document.form1.email.value=="")
{
	alert("Enter Email");
	document.form1.email.focus();
	return false;
}
else if(echeck(document.form1.email.value)==false)
{
	alert("Enter a valid Email");
	document.form1.email.focus();
	document.form1.email.value="";
	return false;
}
else if(document.form1.phno.value=="")
{
	alert("Enter Phone NUmber");
	document.form1.phno.focus();
	return false;
}
//else if(isNaN(document.form1.phno.value)==true)
//{
//	alert("Phone Number Must be Numeric");
//	document.form1.phno.focus();
//	return false;
//}
else if(a.length<10)
{
	alert("Phone Number Should Contain atleast 10 digits");
	document.form1.phno.focus();
	document.form1.phno.value=="";
	return false;
}
else if(document.form1.cpersion.value=="")
{
	alert("Enter Name of Contact Persion");
	document.form1.cpersion.focus();
	return false;
}
else if(document.form1.designation.value=="")
{
	alert("Enter Designation");
	document.form1.designation.focus();
	return false;
}
else if(document.form1.mobnum.value=="")
{
	alert("Enter Mobile Number");
	document.form1.mobnum.focus();
	return false;
}
else if(isNaN(document.form1.mobnum.value)==true)
{
	alert("Mobile Number Must be Numeric");
	document.form1.mobnum.focus();
	document.form1.mobnum.value=="";
	return false;
}
else if(b.length<10 || b.length>11)
{
	alert("Mobile Number Contain Min 10 digits and Max of 11 digits");
	document.form1.mobnum.focus();
	document.form1.mobnum.value=="";
	return false;
}
else
{
return true;
}
}
</script>

</head>
<body>
<table width="550" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="tob2_imgs/spacer.png" width="1" height="2" /></td>
  </tr>
  <tr>
    <td valign="top"><br />
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" bgcolor="#F7F7F7">&nbsp;<span class="style37">Tenders - <strong>Please fill below form to download Tender pdf file </strong></span></td>
          </tr>
        </table>
      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30" align="justify"><form id="form1" name="form1" method="post" action="reg.php" onsubmit="return check(this);">
                <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="38%"><span class="style31 style34"> Name of the Company* </span></td>
                    <td width="7%"><div align="center"><strong>:</strong></div></td>
                    <td width="55%"><input type="text" name="name" id="name" /></td>
                  </tr>
                  <tr>
                    <td width="38%"><span class="style34"></span></td>
                    <td width="7%"><div align="center"></div></td>
                    <td width="55%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="38%"><span class="style31 style34"> Address* </span></td>
                    <td width="7%"><div align="center"><strong>:</strong></div></td>
                    <td width="55%"><textarea name="adrs" id="adrs"></textarea></td>
                  </tr>
                  <td width="38%"><span class="style34"></span></td>
                    <td width="7%"><div align="center"></div></td>
                    <td width="55%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="38%"><span class="style31 style34"> E-mail ID * </span></td>
                    <td width="7%"><div align="center"><strong>:</strong></div></td>
                    <td width="55%"><input type="text" name="email" id="email" /></td>
                  </tr>
                  <tr>
                    <td width="38%"><span class="style34"></span></td>
                    <td width="7%"><div align="center"></div></td>
                    <td width="55%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="38%"><span class="style31 style34"> Phone No.* </span></td>
                    <td width="7%"><div align="center"><strong>:</strong></div></td>
                    <td width="55%"><input type="text" name="phno" id="phno" /></td>
                  </tr>
                  <tr>
                    <td width="38%"><span class="style34"></span></td>
                    <td width="7%"><div align="center"></div></td>
                    <td width="55%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="38%"><span class="style31 style34"> Fax No. </span></td>
                    <td width="7%"><div align="center"><strong>:</strong></div></td>
                    <td width="55%"><input type="text" name="faxno" id="faxno" /></td>
                  </tr>
                  <tr>
                    <td width="38%"><span class="style34"></span></td>
                    <td width="7%"><div align="center"></div></td>
                    <td width="55%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="38%"><span class="style31 style34"> Website </span></td>
                    <td width="7%"><div align="center"><strong>:</strong></div></td>
                    <td width="55%"><input type="text" name="website" id="website" /></td>
                  </tr>
                  <tr>
                    <td width="38%"><span class="style34"></span></td>
                    <td width="7%"><div align="center"></div></td>
                    <td width="55%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="38%"><span class="style31 style34"> Name of the Contact Person* </span></td>
                    <td width="7%"><div align="center"><strong>:</strong></div></td>
                    <td width="55%"><input type="text" name="cpersion" id="cpersion" /></td>
                  </tr>
                  <tr>
                    <td width="38%">&nbsp;</td>
                    <td width="7%"><div align="center"></div></td>
                    <td width="55%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="38%"><span class="style31 style34"> Designation* </span></td>
                    <td width="7%"><div align="center"><strong>:</strong></div></td>
                    <td width="55%"><input type="text" name="designation" id="designation" /></td>
                  </tr>
                  <tr>
                    <td width="38%">&nbsp;</td>
                    <td width="7%"><div align="center"></div></td>
                    <td width="55%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="38%"><span class="style31 style34"> Mobile No.* </span></td>
                    <td width="7%"><div align="center"><strong>:</strong></div></td>
                    <td width="55%"><input type="text" name="mobnum" id="mobnum" /></td>
                  </tr>
                  <tr> </tr>
                  <tr>
                    <td width="38%"><span class="style34"></span></td>
                    <td width="7%">&nbsp;</td>
                    <td width="55%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="38%">&nbsp;</td>
                    <td width="7%">&nbsp;</td>
                    <td width="55%"><input type="submit" name="Submit" value="Submit" id="Submit"/>
                      <input type="hidden" name="openpdf" value="<?php echo $_GET['pg']; ?>" />
                      <input name="id" type="hidden" id="id" value="<?php echo $_GET['id'] ?>" />
                      &nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="reset" name="reset" value="Reset" id="reset" /></td>
                  </tr>
                  <tr>
                    <td width="38%">&nbsp;</td>
                    <td width="7%">&nbsp;</td>
                    <td width="55%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="38%">&nbsp;</td>
                    <td width="7%">&nbsp;</td>
                    <td width="55%">&nbsp;</td>
                  </tr>
                </table>
            </form></td>
          </tr>
      </table></td>
  </tr>
  <tr>
    <td valign="top"><img src="tob2_imgs/spacer.png" width="220" height="1" /></td>
  </tr>
</table>
</body>
</html>
