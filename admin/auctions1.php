<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION['tobadmin']))
{

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Auctions | Welcome To TOBBACO BOARD Admin</title>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
}
.style4 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
.style7 {font-size: 14px; color: #FF0000; font-family: Arial, Helvetica, sans-serif;}

a:link {
	color: #000000;
	text-decoration: none;
}
a:visited {
	color: #000000;
	text-decoration: none;
}
a.b:hover {
	color: #990000;
	text-decoration: none;
}
a.b:active {
	color: #990000;
	text-decoration: none;
}

-->
</style>
</head>
<script src="../jquery.ui-1.5.2/jquery-1.2.6.js" type="text/javascript"></script>
<script src="../jquery.ui-1.5.2/ui/ui.datepicker.js" type="text/javascript"></script>
<link href="../jquery.ui-1.5.2/themes/ui.datepicker.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function chk()
{
	document.form1.submit();
}

function gettoday()

{

	var today=new Date();

	var tyear=today.getFullYear(); 

	var tmonth=today.getMonth()+1;

	var tday=today.getDate();

	var todate=tyear+"/"+tmonth+"/"+tday;

	return todate;

}

function validate_date(valdate)
{

	var day1, day2;

	var month1, month2;

	var year1, year2;

	

	value1 = valdate;

	var value2=gettoday();
//	var value2=now.format("yyyy/mm/dd");

	

	day1 = value1.substring (0, value1.indexOf ("/"));

	month1 = value1.substring (value1.indexOf ("/")+1, value1.lastIndexOf ("/"));

	year1 = value1.substring (value1.lastIndexOf ("/")+1, value1.length);

	

	day2 = value2.substring (0, value2.indexOf ("/"));

	month2 = value2.substring (value2.indexOf ("/")+1, value2.lastIndexOf ("/"));

	year2 = value2.substring (value2.lastIndexOf ("/")+1, value2.length); 

	

	date1 = year1+"/"+month1+"/"+day1;

	date2 = value2;

	firstDate = Date.parse(date1)

	secondDate= Date.parse(date2)

	

	msPerDay = 24 * 60 * 60 * 1000

	dbd = Math.round((secondDate.valueOf()-firstDate.valueOf())/ msPerDay);


	if(dbd >=0)

	return true;

	else

	return false;



}

function check(form1)
{
	if(document.form1.state.value=="")
	{
		alert("State Should Not Be Empty");
		document.form1.state.focus();
		return false;
	}
	else if(document.form1.pdate.value=="")
	{
		alert("Select Date");
		document.form1.pdate.focus();
		return false;
	}
	else if(validate_date(document.form1.pdate.value)==false)
	{
		alert("Future Dates Are Not Alloed");
		document.form1.pdate.focus();
		return false;
	}
	else
	{
		var n=document.form1.n.value;
		
		var valid=true;
		for(i=1;i<=n;i++)
		{
			if(num_check("apf"+i) && num_check("aqty"+i) && num_check("eqty"+i) && num_check("bales"+i) && num_check("ns"+i) && num_check("nb"+i) && num_check("rr"+i) && num_check("cr"+i) && num_check("hbid"+i) && num_check("lbid"+i) && num_check("buyers"+i) && num_check("qsold"+i) && num_check("aprice"+i) && num_check("cprice"+i))
			{
				valid=true;
			}
			else
			return false;
		}

		if(num_check("bq") && num_check("mq") && num_check("lq") && num_check("bp") && num_check("mp") && num_check("lp") && num_check("ba") && num_check("ma") && num_check("la"))
		{
			valid=true;
		} 
		else
		return false;
		if(valid==true)
		{
			document.form1.subm.value=1;
			return true
		}
		else
		return false;
	}
}

function field_chk(st)
{
	if(document.getElementById(st).value=="")
	{
	}
}
function num_check(st)
{
	if(document.getElementById(st).value!="" && isNaN(document.getElementById(st).value)==true)
	{
		alert("Only numbers are allowed");
		document.getElementById(st).value="";
		document.getElementById(st).focus();
		return false;
	}
	else
	return true;
}
function tots(i)
{
	var bal=document.getElementById("bales"+i).value;
	var tots=document.getElementById("tot"+i).value;
	if(num_check("bales"+i) && bal!="" && tots!="")
	{
		var tot=parseFloat(bal)-parseFloat(tots);
		document.getElementById("bsold"+i).value=tot;
	}
}
function totb(i)
{
	var ns=document.getElementById("ns"+i).value;
	var nb=document.getElementById("nb"+i).value;
	var rr=document.getElementById("rr"+i).value;
	var cr=document.getElementById("cr"+i).value;
	
	if((ns!="" || nb!="" || rr!="" || cr!="") && (num_check("ns"+i) && num_check("nb"+i) && num_check("rr"+i) && num_check("cr"+i)))
	{
		if(ns=="")
		ns=0;
		if(nb=="")
		nb=0;
		if(rr=="")
		rr=0;
		if(cr=="")
		cr=0;
		var tot=parseInt(ns)+parseInt(nb)+parseInt(rr)+parseInt(cr);
		document.getElementById("tot"+i).value=tot;
		tots(i);
	}
}

function delst(st,st1)
{
	if(confirm("Are you sure to delete this date data?"))
	{
		location.href="auctions1.php?del=1&stat="+st1+"&dat="+st;
	}
	else
	return false;
}
</script>
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

	function numround($st,$n)
	{
		if($st!="")
		{
			$n1=pow(10 ,$n);
			$num=round($st*$n1)/($n1);
		}
		return $num;
	}

function set_num($st)
{
	$val="";
	if($st=="")
	$val=0;
	else
	$val=$st;
	return $val;
}
$pdat=date('d/m/Y');

if(!empty($_POST['state']))
$stat=$_POST['state'];
else if(!empty($_GET['stat']))
$stat=$_GET['stat'];
else
$stat='Karnataka';


if(!empty($_POST['delet']))
{
	$ids="";
	for($i=1;$i<=$_POST['n'];$i++)
	{
		if($_POST['delt'.$i]!="")
		{
			if($ids=="")
			$ids=stripslashes($_POST['delt'.$i]);
			else
			$ids.="','".stripslashes($_POST['delt'.$i]);
		}
	}

	$seldata=executework("select * from tob_auction where tdate in ('".$ids."') and platf in(select id from tob_platform where state='".$stat."')");
	$cnt=@mysqli_num_rows($seldata);
	
	if($cnt>0)
	{
		$deldata=executework("delete from tob_auction where tdate in ('".$ids."') and platf in(select id from tob_platform where state='".$stat."')");
		
	}
	$delgr=executework("delete from tob_grade where state='".$stat."' and pdate in ('".$ids."')");
	redirect("auctions1.php?stat=".$stat);
}




$selyr=executework("select max(year) from tob_auct where platf in(select id from tob_platform where state='".$stat."' and isactive=1)");
$rowy=@mysqli_fetch_array($selyr);
?>
<body>
<?php
if(!empty($_POST['dat']))
$ndate1=$_POST['dat'];
else if(!empty($_GET['dat']))
$ndate1=$_GET['dat'];
else 
$ndate1=date('Y');
?>
<?php include_once("header.php");?>
<form action="auctions1.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check(this);">
  <table width="79%" border="0" align="center">
    <tr>
      <td width="24%">&nbsp;</td>
      <td width="5%">&nbsp;</td>
      <td width="71%">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><span class="style1">Add Auctions </span> </td>
    </tr>
    
	<?php
		if(!empty($_GET['stat']) && $_GET['stat']==2)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">Data Deleted Successfully </span></td>
    </tr>
	<?php
		}
		if(!empty($_GET['succ']))
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">Data Stored  Successfully</span> </td>
    </tr>
	<?php
		}
		else
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7"></span> </td>
    </tr>
	<?php
		}
	?>
    <tr>
      <td height="30" style="padding-left:35px;"><span class="style4">State</span></td>
      <td height="30"><div align="center">:</div></td>
      <td height="30"><label></label>
          <select name="state" id="state" onchange="chk();">
            <option value="">Select</option>
            <option value="Andhra Pradesh">Andhra Pradesh</option>
            <option value="Karnataka" selected="selected">Karnataka</option>
          </select>
          <?php
					if($stat!="")
				{
					?>
         <script type="text/javascript">
					 var ct='<?php echo $stat; ?>';
					 var j;
					for(j=0;j<document.form1.state.options.length;j++)
					{
						if(document.form1.state.options[j].value==ct)
						{
							document.form1.state.options[j].selected=true;
						}
					}
				</script>
          <?php
					}
				?>      </td>
    </tr>
    
	<?php
	if(!empty($ndate1))
	{
		$sel=executework("select  distinct tdate,state from tob_auction,tob_platform where tob_platform.id=tob_auction.platf and tob_platform.state='".($stat)."' order by tdate desc");
		//echo "select  distinct tdate,state from tob_auction,tob_platform where tob_platform.id=tob_auction.platf and tob_platform.state='".($stat)."' order by tdate desc";
		$cnts=@mysqli_num_rows($sel);
	
	}
	?>
    
    <tr>
      <td height="21" class="style4" style="padding-left:35px;">&nbsp;</td>
      <td height="21">&nbsp;</td>
      <td height="21">&nbsp;</td>
    </tr>
	<?php
	if(!empty($ndate1) && !empty($stat))
	{
	?>
    <tr>
      <td height="21" colspan="3" class="style4"><table width="500" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><table width="106%" border="1" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td height="31"><a href="auctions.php?vd=<?php echo $stat; ?>"><strong>New Entry </strong></a></td>
              <td width="41%"><div align="center"><strong><a href="#" onclick="checka();">Check All</a> / <a href="#" onclick="unchecka();">Uncheck All</a> </strong></div></td>
            </tr>
            <tr>
              <td width="65%" height="31"><div align="left"><strong>&nbsp; <?php echo $stat; ?></strong></div></td>
              <td width="35%"><div align="center"><input type="button" name="Button" value="Delete"  onclick="delt_bulk();" />
               </div></td>
            </tr>
            <?php
		if($cnts>0)
		{
	?>
            <?php
			$i=1;
			while($re=mysqli_fetch_array($sel))
			{
		?>
            <tr>
              <td height="29"><div align="left"> &nbsp; &nbsp;<a href="auctions.php?vid=<?php echo $re['tdate']?>&amp;vd=<?php echo $re['state']?>" ><?php echo datepattrn($re['tdate'])?> </a></div></td>
              <td height="29"><div align="center">
                <input name="delt<?php echo $i ?>" type="checkbox" id="delt<?php echo $i ?>" value="<?php echo $re['tdate']?>" />
               </div></td>
            </tr>
            <?php
			$i++;
			 }
		 }
	}
	?>
            <tr>
              <td height="29">&nbsp;</td>
              <td height="29"><div align="center">
                <p>
                  <input type="button" name="Button2" value="Delete"  onclick="delt_bulk();" />
                </p>
                </div></td>
            </tr>
            <tr>
              <td height="29">&nbsp;</td>
              <td height="29"><div align="center"><strong><a href="#" onclick="checka();">Check All</a> / <a href="#" onclick="unchecka();">Uncheck All</a></strong></div></td>
            </tr>
  </table>
 <input name="n" type="hidden" id="n" value="<?php echo $i-1 ?>" />
 <input type="hidden" name="delet" id="delet" />					  </td>
  </tr>
  </table>  </td>
  </tr>
  </table>
</form>
<?php include_once("footer.php");?>
</body>
</html>
<?php
}
else
{
?>
	<script language="javascript">parent.location.href="index.php";</script>
<?php
}
?>
<script>
pdate='<?php if(!empty($dates1)) echo $dates1 ?>';
if(pdate!="")
{
	var pdates=new Array();
	pdates=pdate.split(',');
	for(k=0;k<pdates.length;k++)
	{
		jQuery('#'+pdates[k]).datepicker();
		jQuery('#'+pdates[k]).readOnly=true;
	}
}
jQuery('#pdate').datepicker();
jQuery('#pdate').readOnly=true;



function delt(st)
{
	if(confirm("Are You Sure To Delete This Data?"))
	location.href="auctions1.php?delt="+st;
	else
	return false;
}

function delt_bulk()
{
	if(confirm("Are You Sure To Delete Selected Data"))
	{
		var n=document.form1.n.value;
		var s=0;
		for(i=1;i<=n;i++)
		{
			if(document.getElementById("delt"+i).checked==true)
			{
				s=1;
			}
		}
		if(s==0)
		{
			alert("Select records to delete");
			return false;
		}
		else
		{
			document.form1.delet.value=1;
			document.form1.submit();
		}
	}
	else
	return false;
}

function checka()
{
	$('input:checkbox[id^="delt"]').attr('checked',true);
}
function unchecka()
{
	$('input:checkbox[id^="delt"]').each(function () {
		this.checked=false;
	});
}
</script>