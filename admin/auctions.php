<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION['tobadmin']))
{
	$qry='';
	$yr=date('Y');
	
	if(!empty($_POST['year']))
	$yrs=$_POST['year'];
	else
	$yrs=$yr;
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
.style8 {font-size: 11px}

-->
</style>
</head>
<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script> 
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
			if(num_check("apf"+i) && num_check("bsold"+i) && num_check("qsold"+i) && num_check("aprice"+i) && num_check("cprice"+i))
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
	//alert(tots);
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

function caltot(st,st1)
{
	var h=document.form1.h.value;
	var j=1;
	var a,b;
	var tot=0;
	var val;
	for(i=1;i<=h;i++)
	{
		a=document.getElementById("stn"+i).value;
		b=document.getElementById("fn"+i).value;
		var stot=0;
		for(j==a;j<=b;j++)
		{
			val=document.getElementById(st+j).value;
			if(val=="")
			val=0;
			if(stot=="")
			stot=0;
			if(tot=="")
			tot=0;
			stot=parseFloat(val)+parseFloat(stot);
			tot=parseFloat(val)+parseFloat(tot);
		}
		document.getElementById(st1+i).value=stot;
	}
	//alert(tot);
	
	document.getElementById("n"+st1).value=tot;
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
if(!empty($_GET['vid']))
$pdat=(datepattrn($_GET['vid']));
else if(!empty($_POST['pdate']))
$pdat=($_POST['pdate']);
else
$pdat=date('d/m/Y');

if(!empty($_POST['state']))
$stat=($_POST['state']);
else if(!empty($_GET['vd']))
$stat=($_GET['vd']);
else
$stat='Andhra Pradesh';


?>
<body>
<?php

$seldat1=executework("select tdate from tob_auction where isactive=1 and platf in(select id from tob_platform where state='".$stat."')".$qry." order by tdate limit 1");
//echo "select tdate from tob_auction where isactive=1 and platf in(select id from tob_platform where state='".$stat."')".$qry." order by tdate limit 1";
$rowdt1=@mysqli_fetch_array($seldat1);
$ndate1=substr($rowdt1['tdate'],0,4);
//echo "dat=".$ndate1."--".$rowdt1['tdate'];
if(!empty($pdat))
{
	$ndate=$pdat;
	$ndate1=substr($ndate,6,4);
}
	$ndate1=$yrs;
	if(!empty($_POST['subm']))
	{
		$selmax=executework("select max(id)  from tob_auction");
		$rowmax=@mysqli_fetch_array($selmax);
		if($rowmax[0]!="")
		$maxid=$rowmax[0]+1;
		else
		$maxid=1;

		$selmax1=executework("select max(id)  from tob_grade");
		$rowmax1=@mysqli_fetch_array($selmax1);
		if($rowmax1[0]!="")
		$maxid1=$rowmax1[0]+1;
		else
		$maxid1=1;
		
		$n=$_POST['n'];
		
		$dates=datepattrn1($pdat);

		if($_POST['bq']=="") { $_POST['bq']=0; }
		if($_POST['mq']=="") { $_POST['mq']=0; }
		if($_POST['lq']=="") { $_POST['lq']=0; }
		if($_POST['bp']=="") { $_POST['bp']=0; }
		if($_POST['mp']=="") { $_POST['mp']=0; }
		if($_POST['lp']=="") { $_POST['lp']=0; }
		if($_POST['ba']=="") { $_POST['ba']=0; }
		if($_POST['ma']=="") { $_POST['ma']=0; }
		if($_POST['la']=="") { $_POST['la']=0; }
		$selgra=executework("select * from tob_grade where pdate='".$dates."' and state='".$stat."'");
		$cntg=@mysqli_num_rows($selgra);
		if($cntg>0)
		{
			$rowg=@mysqli_fetch_array($selgra);
			$upgrd=executework("update tob_grade set bq=".($_POST['bq']).",mq=".($_POST['mq']).",lq=".($_POST['lq']).",bp=".($_POST['bp']).",mp=".($_POST['mp']).",lp=".($_POST['lp']).",ba=".($_POST['ba']).",ma=".($_POST['ma']).",la=".($_POST['la'])." where id=".$rowg['id']);
		}
		else
		{
			$intgrd=executework("insert into tob_grade values(".$maxid1.",'".($_POST['state'])."','".$dates."',".($_POST['bq']).",".($_POST['mq']).",".($_POST['lq']).",".($_POST['bp']).",".($_POST['mp']).",".($_POST['lp']).",".($_POST['ba']).",".($_POST['ma']).",".($_POST['la']).",1)");
		}
		
		for($i=1;$i<=$n;$i++)
		{
			$tval=0;
			$tval=(float)$_POST['aprice'.$i]*(float)$_POST['qsold'.$i];
			$selsum=executework("select sum(qsold) as qs,sum(tvalue) as tv from tob_auction where tdate<'".$dates."' and platf=".($_POST['fid'.$i]));
			$rowsm=@mysqli_fetch_array($selsum);
			$ctval=$tval+$rowsm['tv'];
			$cqs=(float)$_POST['qsold'.$i]+(float)$rowsm['qs'];
			if($cqs>0)
			$cavg=$ctval/$cqs;
			else
			$cavg=0;
			$selrec=executework("select * from tob_auction where tdate='".$dates."' and platf=".($_POST['fid'.$i]));
			$cnt=@mysqli_num_rows($selrec);
			if($cnt>0)
			{
				$rowm=@mysqli_fetch_array($selrec);
				$uprec=executework("update tob_auction set apf=".set_num(($_POST['apf'.$i])).",bales=".set_num(($_POST['bales'.$i])).",ns=".set_num(($_POST['ns'.$i])).",nb=".set_num(($_POST['nb'.$i])).",rr=".set_num(($_POST['rr'.$i])).",cr=".set_num(($_POST['cr'.$i])).",tot=".set_num(($_POST['tot'.$i])).",bsold=".set_num(($_POST['bsold'.$i])).",qsold=".set_num(($_POST['qsold'.$i])).",aprice=".set_num(($_POST['aprice'.$i])).",cprice=".set_num($cavg).",tvalue=".$tval." where id=".($rowm['id']));
				//echo "<br>update tob_auction set apf=".set_num(($_POST['apf'.$i])).",bales=".set_num(($_POST['bales'.$i])).",ns=".set_num(($_POST['ns'.$i])).",nb=".set_num(($_POST['nb'.$i])).",rr=".set_num(($_POST['rr'.$i])).",cr=".set_num(($_POST['cr'.$i])).",tot=".set_num(($_POST['tot'.$i])).",bsold=".set_num(($_POST['bsold'.$i])).",qsold=".set_num(($_POST['qsold'.$i])).",aprice=".set_num(($_POST['aprice'.$i])).",cprice=".set_num($cavg).",tvalue=".$tval." where id=".($rowm['id']);
			}
			else
			{
				if(empty($_POST['cdate'.$i]))
				$cdate="null";
				else
				$cdate="'".date('Y-m-d',strtotime($_POST['cdate'.$i]))."'";
				
				if(empty($_POST['edate'.$i]))
				$edate="NULL";
				else
				$edate="'".date('Y-m-d',strtotime($_POST['edate'.$i]))."'";
				$intrec=executework("insert into tob_auction values(".$maxid.",".$ndate1.",'".$dates."',".($_POST['fid'.$i]).",".set_num(($_POST['apf'.$i])).",".set_num(($_POST['aqty'.$i])).",".set_num(($_POST['eqty'.$i])).",".$cdate.",".$edate.",".set_num(($_POST['bales'.$i])).",".set_num(($_POST['ns'.$i])).",".set_num(($_POST['nb'.$i])).",".set_num(($_POST['rr'.$i])).",".set_num(($_POST['cr'.$i])).",".set_num(($_POST['tot'.$i])).",".set_num(($_POST['bsold'.$i])).",".set_num(($_POST['hbid'.$i])).",".set_num(($_POST['lbid'.$i])).",".set_num(($_POST['buyers'.$i])).",".set_num(($_POST['qsold'.$i])).",".set_num(($_POST['aprice'.$i])).",".set_num($cavg).",".$tval.",1)");
				echo "insert into tob_auction values(".$maxid.",".$ndate1.",'".$dates."',".($_POST['fid'.$i]).",".set_num(($_POST['apf'.$i])).",".set_num(($_POST['aqty'.$i])).",".set_num(($_POST['eqty'.$i])).",".$cdate.",'".$edate."',".set_num(($_POST['bales'.$i])).",".set_num(($_POST['ns'.$i])).",".set_num(($_POST['nb'.$i])).",".set_num(($_POST['rr'.$i])).",".set_num(($_POST['cr'.$i])).",".set_num(($_POST['tot'.$i])).",".set_num(($_POST['bsold'.$i])).",".set_num(($_POST['hbid'.$i])).",".set_num(($_POST['lbid'.$i])).",".set_num(($_POST['buyers'.$i])).",".set_num(($_POST['qsold'.$i])).",".set_num(($_POST['aprice'.$i])).",".set_num($cavg).",".$tval.",1)";
				//echo "insert into tob_auction values(".$maxid.",".$ndate1.",'".$dates."',".$_POST['fid'.$i].",".set_num($_POST['apf'.$i]).",".set_num($_POST['aqty'.$i]).",".set_num($_POST['eqty'.$i]).",'".datepattrn1($_POST['cdate'.$i])."','".datepattrn1($_POST['edate'.$i])."',".set_num($_POST['bales'.$i]).",".set_num($_POST['ns'.$i]).",".set_num($_POST['nb'.$i]).",".set_num($_POST['rr'.$i]).",".set_num($_POST['cr'.$i]).",".set_num($_POST['tot'.$i]).",".set_num($_POST['bsold'.$i]).",".set_num($_POST['hbid'.$i]).",".set_num($_POST['lbid'.$i]).",".set_num($_POST['buyers'.$i]).",".set_num($_POST['qsold'.$i]).",".set_num($_POST['aprice'.$i]).",".set_num($cavg).",".$tval.",1)";
				$maxid++;
			}
		}
		$succ=1;
		redirect("auctions1.php?succ=suc&stat=".$_POST['state']);
		exit();
	}
	
?>
<?php include_once("header.php");?>
<form action="auctions.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check(this);">
  <table width="100%" border="0" align="center">
    <tr>
      <td width="25%">&nbsp;</td>
      <td width="5%">&nbsp;</td>
      <td width="70%">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><span class="style1">Add Auctions </span> </td>
    </tr>
    
	<?php
		if(!empty($_GET['succ']) && $_GET['succ']==1)
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
	
<?php	
if(!empty($pdat) && !empty($stat))
	{
	//echo df;
		//echo "select distinct tdate,state,tob_platform.catg,year from tob_auction,tob_platform where tob_auction.platf=tob_platform.id AND tob_auction.tdate='".(datepattrn1($pdat))."' and tob_platform.state='".$stat."' order by tob_platform.catg";
	$sel=executework("select distinct tdate,state,tob_platform.catg,year from tob_auction,tob_platform where tob_auction.platf=tob_platform.id AND tob_auction.tdate='".(datepattrn1($pdat))."' and tob_platform.state='".$stat."' order by tob_platform.catg");
	$cn=mysqli_num_rows($sel);
		$rowy=@mysqli_fetch_array($sel);
		$yrs=$rowy['year'];
//	$sq=mysqli_fetch_array($sel);
	
	}
	if(!empty($_POST['pdate']))
	$pd=$_POST['pdate'];
	else if(!empty($_GET['vid']))
	$pd=datepattrn($_GET['vid']);
	else
	$pd='';
	?>
    <tr>
      <td height="30" style="padding-left:35px;"><span class="style4">State</span></td>
      <td height="30"><div align="center"><strong>:</strong></div></td>
      <td height="30"><label>
        <select name="state" id="state">
          <option value="">Select</option>
          <option value="Andhra Pradesh" selected="selected">Andhra Pradesh</option>
          <option value="Karnataka">Karnataka</option>
        </select>
        </label>
          <?php
					if(!empty($stat))
					{
					?>
          <script type="text/javascript">
					 var ct='<?php echo($stat); ?>';
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
    <tr>
      <td height="30" valign="top" class="style4" style="padding-left:35px;"><div align="left">Auction Year</div></td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td class="style8"><label>
<select name="year" id="year" onchange="chk();">
  <?php
		 for($i=2009;$i<=$yr;$i++)
		 {
		 ?>
  <option value="<?php echo $i ?>"><?php echo $i ?></option>
  <?php
		 }
		 ?>
</select>
<?php
					if(!empty($yrs))
					{
					?>
        <script type="text/javascript">
					 var ctp='<?php echo $yrs ?>';
					 var j;
					for(j=0;j<document.form1.year.options.length;j++)
					{
						if(document.form1.year.options[j].value==ctp)
						{
							document.form1.year.options[j].selected=true;
						}
					}
					</script>
        <?php
					}
			
	if(!empty($_POST['plats']) && !empty($_POST['year']))
	{		
		$selauct=executework("select * from tob_auct where platf=".($_POST['plats'])." and year=".($_POST['year']));
		$cnta=@mysqli_num_rows($selauct);
		$rowa=@mysqli_fetch_array($selauct);
	}
				  ?>
      </label></td>
    </tr>
    <tr>
      <td height="30" style="padding-left:35px;"><span class="style4">Date</span></td>
      <td height="30"><div align="center"><strong>:</strong></div></td>
      <td height="30"><label>
      <input name="pdate" type="text" id="pdate" value="<?php echo($pdat); ?>";/>
      </label> 
        &nbsp; <label>
      <input type="button" name="Button" value="Go!!  " onclick="chk();"/>
      </label></td>
    </tr>
	<?php
	if(!empty($stat))
	{
		//echo "select distinct catg,seqid,sno from tob_platform where state='".($stat)."' and isactive=1 order by field(catg,'NBS','SBS','SLS','NLS'),seqid,sno";
		//$sel=executework("select distinct catg,seqid,sno from tob_platform where state='".($stat)."' and isactive=1 order by field(catg,'NBS','SBS','SLS','NLS'),seqid,sno");
		$sel=executework("select distinct catg from tob_platform where state='".($stat)."' and isactive=1 order by field(catg,'NBS','SBS','SLS','NLS')");
		$cnts=@mysqli_num_rows($sel);
		
	}
	if(!empty($stat) && !empty($pdat))
	{
		$selgr=executework("select * from tob_grade where state='".($stat)."' and pdate='".datepattrn1($pdat)."'");
		$rowgr=@mysqli_fetch_array($selgr);
	}
	?>
    
    <tr>
      <td height="50" class="style4" style="padding-left:35px;">&nbsp;</td>
      <td height="30">&nbsp;</td>
      <td height="30">&nbsp;</td>
    </tr>
	<?php
	$catg1='';
	if(!empty($pdat) && $cnts>0)
	{
	?>
    <tr>
      <td height="50" colspan="3" class="style4"><table width="800" align="center" cellpadding="1" cellspacing="1" bgcolor="#0000FF">
        <tr>
          <td bgcolor="#FFFFFF"><div align="center"><strong>Platform</strong></div></td>
          <td bgcolor="#FFFFFF"><div align="center"><strong>APF No. </strong></div></td>
          <td bgcolor="#FFFFFF"><div align="center"><strong>Bales Sold </strong></div></td>
          <td bgcolor="#FFFFFF"><div align="center"><strong>Quantity Sold </strong></div></td>
          <td bgcolor="#FFFFFF"><div align="center"><strong>Average Price </strong></div></td>
          <td bgcolor="#FFFFFF"><div align="center"><strong>Cummulative Average Price </strong></div></td>
          </tr>
	<?php
		$dates1="";
		$i=1;
		$j=1;
		while($rowd=@mysqli_fetch_array($sel))
		{
			//echo "select * from tob_platform where state='".$stat."' and catg='".$rowd['catg']."' and isactive=1 order by seqid,sno,apfno";
			$seldet=executework("select * from tob_platform where state='".$stat."' and catg='".$rowd['catg']."' and isactive=1 order by seqid,sno,apfno");

			$k=$i;
			while($row=@mysqli_fetch_array($seldet))
			{
				$dates1=$dates1.",cdate".$i.",edate".$i;
				
				$selm=executework("select * from tob_auction where platf=".$row['id']." and tdate='".datepattrn1($pdat)."' order by tdate desc limit 1 ");
				$cntm=@mysqli_num_rows($selm);
				
				$selr=executework("select apf,aqty,eqty,cdate,edate from tob_auction where platf=".$row['id']." and tdate<='".datepattrn1($pdat)."' order by tdate desc limit 1 ");
				$cntr=@mysqli_num_rows($selm);
				
				$selsum=executework("select sum(qsold) as qs,sum(tvalue) as tv from tob_auction where tdate<='".datepattrn1($pdat)."' and platf=".$row['id']);
				$rowsm=@mysqli_fetch_array($selsum);
				$ctval=$tval+$rowsm['tv'];
				$cqs=$_POST['qsold'.$i]+$rowsm['qs'];
				if($cntm>0 && $cqs>0)
				$cavg=$ctval/$cqs;
				else
				$cavg=0;
				
				if($cntm>0)
				$rowr=@mysqli_fetch_array($selm);
				else
				$rowr=@mysqli_fetch_array($selr);
			
	?>
        <tr>
          <td bgcolor="#FFFFFF"><?php echo $row['platform'] ?>
            <input name="fid<?php echo $i ?>" type="hidden" id="fid<?php echo $i ?>" value="<?php echo $row['id'] ?>" />          </td>
          <td bgcolor="#FFFFFF"><label>
            <input name="apf<?php echo $i ?>" type="text" id="apf<?php echo $i ?>" value="<?php echo $row['apfno'] ?>" size="5" readonly="true" />
          </label></td>
          <td bgcolor="#FFFFFF"><label>
          <input name="bsold<?php echo $i ?>" type="text" id="bsold<?php echo $i ?>" value="<?php if(!empty($rowr['bsold'])) echo $rowr['bsold'] ?>" onchange="caltot('bsold','bsd');" />
          </label></td>
          <td bgcolor="#FFFFFF"><label>
          <input name="qsold<?php echo $i ?>" type="text" id="qsold<?php echo $i ?>" value="<?php if(!empty($rowr['qsold'])) echo numround($rowr['qsold'],3) ?>" onchange="caltot('qsold','qsd');" />
          </label></td>
          <td bgcolor="#FFFFFF"><label>
            <input name="aprice<?php echo $i ?>" type="text" id="aprice<?php echo $i ?>" value="<?php if(!empty($rowr['aprice'])) echo numround($rowr['aprice'],2) ?>" />
          </label></td>
          <td bgcolor="#FFFFFF"><label><input name="cprice<?php echo $i ?>" type="text" id="cprice<?php echo $i ?>" value="<?php if(!empty($cavg)) echo numround($cavg,2) ?>" readonly="true" />
          </label>
          <input name="cm<?php echo $i ?>" type="hidden" id="cm<?php echo $i ?>" value="<?php if(!empty($rowr['cprice'])) echo $rowr['cprice'] ?>" />          </td>
          </tr>
	<?php		
			  	$i++;
			}
			$catg=$rowd['catg'];
//			if($catg1!="" && $catg1!=$catg)
//			{
			$m=$i-1;
	?>
        <tr>
          <td colspan="19" bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
        <tr bgcolor="#FFF4FF">
          <td><strong>Sub&nbsp;Total(<?php echo $catg ?>) </strong></td>
          <td><input name="stn<?php echo $j ?>" type="hidden" id="stn<?php echo $j ?>" value="<?php echo $k ?>" />
            <input name="fn<?php echo $j ?>" type="hidden" id="fn<?php echo $j ?>" value="<?php echo $m ?>" /></td>
          <td><input name="bsd<?php echo $j ?>" type="text" id="bsd<?php echo $j ?>" /></td>
          <td><input name="qsd<?php echo $j ?>" type="text" id="qsd<?php echo $j ?>" /></td>
          <td><input name="apr<?php echo $j ?>" type="text" id="apr<?php echo $j ?>" /></td>
          <td><input name="capr<?php echo $j ?>" type="text" id="capr<?php echo $j ?>" /></td>
        </tr>
        <tr>
          <td colspan="19" bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
		  <?php
//			}
			if($catg1!=$catg)
			{
				$catg1=$catg;
			}
			$j++;
		  }
		  ?>
        <tr bgcolor="#ECF9F9">
          <td><strong>Total </strong></td>
          <td>&nbsp;</td>
          <td><input name="nbsd" type="text" id="nbsd" /></td>
          <td><input name="nqsd" type="text" id="nqsd" /></td>
          <td><input name="napr" type="text" id="napr" /></td>
          <td><input name="ncapr" type="text" id="ncapr" /></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td colspan="3" class="style4">&nbsp;</td>
    </tr>
    <tr style="display:none">
      <td height="50" colspan="3" class="style4"><table width="600" cellpadding="1" cellspacing="1" bgcolor="#0000FF">
        <tr class="style1">
          <td width="25%" bgcolor="#FFFFFF"><div align="center"><span class="style8">Grade Out-turn</span></div></td>
          <td width="25%" bgcolor="#FFFFFF"><div align="center"><span class="style8">Quantity Marketed<br />
            (M.Kgs) </span></div></td>
          <td width="25%" bgcolor="#FFFFFF"><div align="center"><span class="style8">% Share </span></div></td>
          <td bgcolor="#FFFFFF"><div align="center"><span class="style8">Average Price </span></div></td>
        </tr>
        <tr>
          <td height="20" bgcolor="#FFFFFF">Bright Grades </td>
          <td bgcolor="#FFFFFF"><label>
            <input name="bq" type="text" id="bq" value="<?php if(!empty($rowgr['bq'])) echo numround($rowgr['bq'],3) ?>" />
          </label></td>
          <td bgcolor="#FFFFFF"><label>
            <input name="bp" type="text" id="bp" value="<?php if(!empty($rowgr['bp'])) echo numround($rowgr['bp'],2) ?>" />
          </label></td>
          <td bgcolor="#FFFFFF"><label>
            <input name="ba" type="text" id="ba" value="<?php if(!empty($rowgr['ba'])) echo numround($rowgr['ba'],2) ?>" />
          </label></td>
        </tr>
        <tr>
          <td height="20" bgcolor="#FFFFFF">Medium Grades </td>
          <td bgcolor="#FFFFFF"><label>
            <input name="mq" type="text" id="mq" value="<?php if(!empty($rowgr['mq'])) echo numround($rowgr['mq'],3) ?>" />
          </label></td>
          <td bgcolor="#FFFFFF"><label>
            <input name="mp" type="text" id="mp" value="<?php if(!empty($rowgr['mp'])) echo numround($rowgr['mp'],2) ?>" />
          </label></td>
          <td bgcolor="#FFFFFF"><label>
          <input name="ma" type="text" id="ma" value="<?php if(!empty($rowgr['ma'])) echo numround($rowgr['ma'],2) ?>" />
          </label></td>
        </tr>
        <tr>
          <td height="20" bgcolor="#FFFFFF">Low Grades </td>
          <td bgcolor="#FFFFFF"><label>
            <input name="lq" type="text" id="lq" value="<?php if(!empty($rowgr['lq'])) echo numround($rowgr['lq'],3) ?>" />
          </label></td>
          <td bgcolor="#FFFFFF"><label>
            <input name="lp" type="text" id="lp" value="<?php if(!empty($rowgr['lp'])) echo numround($rowgr['lp'],2) ?>" />
          </label></td>
          <td bgcolor="#FFFFFF"><label>
          <input name="la" type="text" id="la" value="<?php if(!empty($rowgr['la'])) echo numround($rowgr['la'],2) ?>" />
          </label></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="50" colspan="3" class="style4"><div align="center">
        <label>
        <input type="submit" name="Submit" value="Submit" />
        </label>
        <input name="n" type="hidden" id="n" value="<?php echo $i-1 ?>" />
        <input name="subm" type="hidden" id="subm" />
        <input name="h" type="hidden" id="h" value="<?php echo $j-1 ?>" />
      </div></td>
    </tr>
	<?php
	}
	?>
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
/*if(pdate!="")
{
	var pdates=new Array();
	pdates=pdate.split(',');
	for(k=0;k<pdates.length;k++)
	{
		$('#'+pdates[k]).datepicker();
		$('#'+pdates[k]).readOnly=true;
	}
}*/

//caltot('aqty','qa');
//caltot('eqty','qe');
//caltot('bales','nbs');
//caltot('ns','rns');
//caltot('nb','rnb');
//caltot('rr','rrr');
//caltot('cr','rcr');
//caltot('tot','rtot');
//caltot('hbid','hbd');
//caltot('lbid','lbd');
//caltot('buyers','nby');
caltot('qsold','qsd');
caltot('bsold','bsd');
$('#pdate').datepicker();
$('#pdate').readOnly=true;
</script>