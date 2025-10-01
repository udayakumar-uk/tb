<?php
//ob_start();
//session_start();
//header("Cache-control: private"); 
include_once("include/includei.php");
$qry=''; $qry1='';$st=''; $td=''; $prc=''; $yrs=''; $tp=''; $tps=''; $tvalv='';

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
$arr= array('1' => 'थोर्रेडू','2' => 'केसारा','3' => 'वेल्लम्पीली-I','4' => 'वेल्लम्पीली-II, केसारा','5' => 'ओंगोल-I','6' => 'ओंगोल-II','7' => 'तंगूतूर-I','8' => 'कांदेपी','9' => 'पोडिली-I','10' => 'पोडिली-II','11' => 'कंडुकर-I','12' => 'कंडुकर-II','13' => 'कलिगीरी','14' => 'डी.सी.पल्ली','15' => 'देवरापल्ली','16' => 'जे.आर.गुडेम-I','17' => 'जे.आर.गुडेम-II','18' => 'कोयालयागुडेम','19' => 'गोपालपुरम','20' => 'तंगूतूर-II','21' => 'एच.डी.कोटे-I','22' => 'हुनसुर-I','23' => 'हुनसुर-II','24' => 'पेरियापाटना-I','25' => 'पेरियापाटना-II','26' => 'पेरियापाटना-III','27' => 'रामनाथपुरा-I','28' => 'कंपालापुरा-I','29' => 'कंपालापुरा-II','30' => 'रामनाथपुरा-II','31' => 'हुनसुर-III','32' => 'एच.डी.कोटे-II','33' => 'कनिगिरी' );
	
if(!empty($_POST['state']))
$stat=$_POST['state'];
else
$stat='Karnataka';
if($stat=='Karnataka')
$statt='कर्नाटक';
else if($stat=='Andhra Pradesh')
$statt='आंध्र प्रदेश';
else
$statt=$stat;
/*if($_POST['platform']!="")
{
	$plats=implode('^',$_REQUEST['platform']);
	$plats1=implode(',',$_REQUEST['platform']);
}
if($plats!="")
{
	$qry=" and id in (".$plats1.")";
}
*/
//$seldat=executework("select tob_auction.tdate from tob_platform,tob_auction where tob_platform.id=tob_auction.platf and tob_platform.id=".$row['id']." and tob_auction.year=".$yr." order by tob_auction.tdate");

if(!empty($_POST['pdate']))
{
	$qdate2=datepattrn1($_POST['pdate']);
	
}
else
{
	$qdate2=date('Y-m-d');
	
}

	$seldat1=executework("select tdate from tob_auction where isactive=1 and platf in(select id from tob_platform where state='".$stat."')".$qry." order by tdate limit 1");
	$rowdt1=@mysqli_fetch_array($seldat1);
if(!empty($_POST['pdate']))
{
	$qdate=datepattrn1($_POST['pdate']);
	$qdate1=$_POST['pdate'];
	$yr=substr($qdate,0,4);
}
else
{
	$seldat=executework("select tdate from tob_auction where isactive=1".$qry." order by tdate desc limit 1");
	$rowdt=@mysqli_fetch_array($seldat);
	$qdate1=datepattrn($rowdt['tdate']);
}
$yr=substr($rowdt1['tdate'],0,4);

if(!empty($qdate))
{
	$qry1=" and tob_auction.tdate<='".$qdate."'";
}

$selplat1=executework("select * from tob_platform where state='".$stat."' order by platform");
$cntp1=@mysqli_num_rows($selplat1);
$u=0;
while($row1=@mysqli_fetch_array($selplat1))
{
	$plat1[$u]=array($row1['id'],$row1['platform']);
	$u++;
}
$selplat=executework("select * from tob_platform where state='".$stat."'".$qry." order by platform");
$cntp=@mysqli_num_rows($selplat);

$t=0;
$str="";

$tqty="";
$tval="";
$days=0;
while($row=@mysqli_fetch_array($selplat))
{
	$plat[$t]=array($row['id'],$row['platform']);
	$selqdat=executework("select tdate,aprice,qsold from tob_platform,tob_auction where tob_platform.id=tob_auction.platf and tob_platform.id=".$row['id'].$qry1." order by tob_auction.tdate");
	$cntd=@mysqli_num_rows($selqdat);
	if($cntd>0)
	{
		$days=$cntd;
		$k=0;
		$str1="";
		$st1="";
		$st2="";
		$qty=0;
		$vald=0;
		while($rowqd=@mysqli_fetch_array($selqdat))
		{
			if($rowqd['aprice']>0)
			{
				$dates[$t]['d'][$k]=$rowqd['tdate'];
				$dates[$t]['v'][$k]=round($rowqd['aprice']);
				if($st1=="")
				$st1=$rowqd['tdate'];
				else
				$st1=$st1."^".$rowqd['tdate'];
	
				if($st2=="")
				$st2=round($rowqd['aprice']);
				else
				$st2=$st2."^".round($rowqd['aprice']);
				
				
				$qty=$qty+$rowqd['qsold'];
				$vald=$vald+($rowqd['qsold']*$rowqd['aprice']);
				$k++;
			}
		}
		if($tqty=="")
		$tqty=$qty;
		else
		$tqty=$tqty.":".$qty;
		
		if($qty>0)
		$val=$vald/$qty;
		else
		$val=0;
		
		if($tval=="")
		$tval=round($val);
		else
		$tval=$tval.":".round($val);

		if($str=="")
		$str=$row['platform']."*".$st1."*".$st2;
		else
		$str=$str."~".$row['platform']."*".$st1."*".$st2;
		
		if($st=="")
		$st=$row['platform'];
		else
		$st=$st.":".$row['platform'];
		
		if($td=="")
		$td=$st1;
		else
		$td=$td.":".$st1;
		
		if($prc=="")
		$prc=$st2;
		else
		$prc=$prc.":".$st2;
	}
	$t++;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FCV Tobacco Auctions  | Tobacco Board, Guntur</title>
<link class="include" rel="stylesheet" type="text/css" href="graph/jquery.jqplot.min.css" />
    <link rel="stylesheet" type="text/css" href="graph/examples.min.css" />
    <link type="text/css" rel="stylesheet" href="graph/syntaxhighlighter/styles/shCoreDefault.min.css" />
    <link type="text/css" rel="stylesheet" href="graph/syntaxhighlighter/styles/shThemejqPlot.min.css" />
  
  <!--[if lt IE 9]><script language="javascript" type="text/javascript" src="../excanvas.js"></script><![endif]-->
    <script class="include" type="text/javascript"    src="graph/jquery.min.js"></script>
<script src="jquery.ui-1.5.2/ui/ui.datepicker.js" type="text/javascript"></script>
<link href="jquery.ui-1.5.2/themes/ui.datepicker.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--
.style36 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.style38 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
-->
</style>
<script language="javascript">
function toggle_forms(st,frm)
{
	document.getElementById(frm).action=st;
	document.getElementById(frm).submit();
}
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
</head>
<body>
<?php
	function numround($st,$n)
	{
		if($st!="")
		{
			$n1=pow(10 ,$n);
			$num=round($st*$n1)/($n1);
		}
		return $num;
	}
	function num_deczero($n)
	{
		$exn='';
		for($i=1;$i<=$n;$i++)
		$exn=$exn."0";
		return $exn;
	}
	function num_fround($st,$n)
	{
		if($st=="")
		$st=0;
		$exn='';
		if($st!="" && $st!=0)
		{
			$st=numround($st,$n);
			if($st=="")
			$st=0;
			$nd=numberOfDecimals($st);
			$n2=$n-$nd;
			if($nd==0)
			$num=$st.".".num_deczero($n);
			else if($n2>0)
			{
				for($i=1;$i<=$n2;$i++)
				$exn=$exn."0";
				$num=$st.num_deczero($n2);
			}
			else
			$num=$st;
		}
		else
		{
			//echo "extn=".$exn;
			$num="0.".num_deczero($n);
		}
		return $num;
	}
function numberOfDecimals($value)
{
    if ((int)$value == $value)
    {
        return 0;
    }
    else if (! is_numeric($value))
    {
        // throw new Exception('numberOfDecimals: ' . $value . ' is not a number!');
        return false;
    }

    return strlen($value) - strrpos($value, '.') - 1;
}
?>
<a name="top" id="top"></a>
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><img src="tob2_imgs/spacer.png" width="1" height="2" /></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><?php include_once("header.php")
  ?></td>
  </tr>
  <tr>
    <td width="225" rowspan="2" valign="top" bgcolor="#ededed" >
	<?php include_once("leftmenu.php")
  ?>	</td>
    <td colspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tabbor">
      <tr>
        <td width="92%" height="25" bgcolor="#e7e6e6"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td><div class="breadcrumb flat"> <a href="#" class="active">&#2361;&#2379;&#2350;</a> <a href="#">एफसीवी तम्बाकू नीलामी </a></div>
                  <script src="js/crumb.js" type="text/javascript">
                  </script>
              </td>
            </tr>
        </table></td>
        <td width="8%" bgcolor="#e7e6e6"><?php
		   		if(empty($_GET['prin']))
				{
		   ?>
            <a href="#" onclick="MM_openBrWindow('bactivities.php?prin=y','','width=800,height=600')"><img src="tob2_imgs/printButton.gif" border="0" /></a> <a href="#" onclick="MM_openBrWindow('auctions.php?prin=y','','width=800,height=600')">Print</a>
            <?php
		   		}
		   ?>
        </td>
      </tr>
    </table>
      <?php
					if(!empty($_POST['state']))
					$mn1=$_POST['state'];
					else
					$mn1='Karnataka';
					if($mn1=='Andhra Pradesh')
					{
						$ap="checked=true";
						$kt="";
					}
					else if($mn1=='Karnataka')
					{
						$ap="";
						$kt="checked=true";
					}
	?>
      <br />
      <table width="99%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30" align="justify"><div class="rightcorner1">
          <div class="innercontent">
            <div class="rightcorner1">
              <div class="innercontent">
                <div>
                  <div>
                    <form id="actn" name="actn" method="post" action="">
                      <div> <br />
                          <table width="800" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#F0F0F0">
                            <tr bgcolor="#FFF0FF">
                              <td width="31%" bgcolor="#FFF0FF" class="style38"><label>
                                <input type="radio" name="state" id="state" value="Andhra Pradesh" <?php echo $ap ?> onchange="actn.submit();" />
                                &nbsp;&nbsp;आंध्र प्रदेश 
                              </label></td>
                              <td width="27%" bgcolor="#FFF0FF" class="style38"><label>
                              <input name="tp" type="radio" value="q" checked="checked" onchange="actn.submit();" />
                              </label>
दिन की जानकारी </td>
                              <td width="35%" align="center"><div align="left">तारीख :&nbsp;
                                      <label>
                                      <input name="pdate" type="text" id="pdate" value="<?php echo $qdate1 ?>" onchange="actn.submit();" />
                                      </label>
                              </div></td>
                              <td width="7%" align="center" bgcolor="#FFF0FF">&nbsp;</td>
                            </tr>
                            <tr bgcolor="#FFF0FF">
                              <td bgcolor="#FFF0FF" class="style38"><label>
                              <input type="radio" name="state" id="state2" value="Karnataka" <?php echo $kt ?> onchange="actn.submit();" />
&nbsp;&nbsp;कर्नाटक </label></td>
                              <td bgcolor="#FFF0FF" class="style38"><input name="tp" type="radio" value="v" onchange="actn.submit();" />
संचयी जानकारी  </td>
                              <td align="center" bgcolor="#FFF0FF" class="style38"><div align="left"><a style="cursor:pointer" onclick="toggle_forms('auctions1.php','actn');" class="b">ग्राफ़ प्रारूप में देखें</a></div></td>
                              <td align="center" bgcolor="#FFF0FF">&nbsp;</td>
                              <?php
					if(!empty($_POST['yr']))
					$yrs=$_POST['yr'];

					if($yrs!="")
					{
					?>
                              <script type="text/javascript">
					 var yrs='<?php echo $yrs ?>';
					 var j;
					for(j=0;j<document.actn.yr.length;j++)
					{
						if(document.actn.yr[j].value==yrs)
						{
							document.actn.yr[j].checked=true;
						}
					}
					        </script>
                              <?php
					}
				  ?>
                                <?php
					if(!empty($_POST['tp']))
					$tps=$_POST['tp'];

					if($tps!="")
					{
					?>
                                <script type="text/javascript">
					 var tps='<?php echo $tps ?>';
					 var j;
					for(j=0;j<document.actn.tp.length;j++)
					{
						if(document.actn.tp[j].value==tps)
						{
							document.actn.tp[j].checked=true;
						}
					}
					              </script>
                                <?php
					}
				  ?>
                            </tr>
							<tr bgcolor="#FFF0FF">
							  <td height="32" colspan="4" align="center" valign="middle" bgcolor="#FFF9FF">&nbsp;</td>
						    </tr>
							<tr bgcolor="#FFF0FF">
							<td height="32" colspan="4" align="center" valign="middle" bgcolor="#FFF9FF">
							   
                               <span class="style36"><?php echo $yr." ".$statt; ?> नीलामी - बिक्री रिपोर्ट</span>			                 </td>
                            </tr>
							
							
							<tr bgcolor="#FFF0FF">
							<td height="32" colspan="4" align="center" valign="middle" bgcolor="#FFF9FF" class="style38">
							<?php
							
							
							$sel3=executework("select * from tob_grade where pdate<='".$qdate2."' and state='".$stat."' order by pdate desc limit 1");
							$row=@mysqli_fetch_array($sel3);
								$adate=$row['pdate'];
								
						?>							 &nbsp;&nbsp; नीलामी वर्ष प्रारंभ : <?php echo $yr ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; दिन : <?php echo $days ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; नीलामी की तारीख : <?php echo datepattrn($adate) ?></td>
						    </tr>
							  
							  <tr bgcolor="#FFF0FF">
							<td height="32" colspan="4" align="center" valign="middle" bgcolor="#FFF9FF">
							
							  <table width="80%" border="0" cellpadding="1" cellspacing="1" bgcolor="#000033">
						<?php
							if(!empty($_POST['tp']) && $_POST['tp']=='v')
							{
						?>
							  <tr>
                                <td bgcolor="#FFFFFF"><div align="center"><span class="style36">नीलामी प्लेटफार्म का नाम</span></div></td>
								<td bgcolor="#FFFFFF"><div align="center"><span class="style36">मात्रा प्राधिकृत (एम.के.जी.एस.)</span></div></td>
								<td bgcolor="#FFFFFF"><div align="center"><span class="style36"> संचयी कुल गांवों का बाजार</span></div></td>
								<td bgcolor="#FFFFFF"><div align="center"><span class="style36">बाजारबद्ध संचयी मात्रा (केजीएस)</span></div></td>
								<td bgcolor="#FFFFFF"><div align="center"><span class="style36"> संचयी औसत मूल्य (रु। / किलो)</span></div></td>
								<td bgcolor="#FFFFFF"><div align="center"><span class="style36">नीलामी की समाप्ति तिथि (डी-एम-वाई)</span></div></td>
							  </tr>
							  <?php
							}
							else
							{
						?>
							  <tr>
                                <td bgcolor="#FFFFFF"><div align="center"><span class="style36">नीलामी प्लेटफार्म का नाम</span></div></td>
								<td bgcolor="#FFFFFF"><div align="center"><span class="style36">मात्रा प्राधिकृत (एम.के.जी.एस.)</span></div></td>
								<td bgcolor="#FFFFFF"><div align="center"><span class="style36"> कुल बालों की बिक्री</span></div></td>
								<td bgcolor="#FFFFFF"><div align="center"><span class="style36">मात्राबद्ध बाज़ार (केजीएस।)</span></div></td>
								<td bgcolor="#FFFFFF"><div align="center"><span class="style36"> औसत मूल्य (रुपये / किग्रा)</span></div></td>
								<td bgcolor="#FFFFFF"><div align="center"><span class="style36">नीलामी की समाप्ति तिथि (डी-एम-वाई)</span></div></td>
							  </tr>
							  <?php
							}
							$sel1=executework("select *,tob_platform.id as hid from tob_auction,tob_platform where tob_auction.platf=tob_platform.id and state='".$stat."' and tdate='".$adate."' and tob_platform.isactive=1 order by field(tob_platform.catg,'NBS','SBS','SLS','NLS'),tob_platform.seqid,tob_platform.sno,tob_platform.apfno");
							$cntt=@mysqli_num_rows($sel1);
							$qau=0;
							$tbal=0;
							$tquat=0;
							$tvalu=0;
							while($row1=@mysqli_fetch_array($sel1))
							{
								$selauct=executework("select * from tob_auct where platf=".$row1['platf']." and year=".$yr);
								$rowa=@mysqli_fetch_array($selauct);
								$selsm=executework("select sum(bsold) as bsold,sum(qsold) as qsold,sum(tvalue) as tval from tob_auction where platf=".$row1['platf']." and tdate between '".$rowa['cdate']."' and '".$row1['tdate']."'");
								$rows=@mysqli_fetch_array($selsm);
								if(!empty($_POST['tp']) && $_POST['tp']=='v')
								{
									$eq=$rows['qsold'];
									$eb=$rows['bsold'];
									$ep=$row1['cprice'];
								}
								else
								{
									$eq=$row1['qsold'];
									$eb=$row1['bsold'];
									$ep=$row1['aprice'];
								}
								$qau+=$rowa['qauth'];
								$tbal+=$eb;
								$tquat+=$eq;
								$tvalu+=$row1['tvalue'];
								$tvalv+=$rows['tval'];
								$hid=$row1['hid'];
							?>
							  <tr>
                                <td bgcolor="#FFFFFF"><span class="style38"><?php echo $arr[$hid]; //echo $row1['platform'] ?></span></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo num_fround($rowa['qauth'],2) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo $eb ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo num_fround($eq,1) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo num_fround($ep,2) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="center"><span class="style38">
								  <?php if($rowa['edate']!="" && $rowa['edate']!='0000-00-00') { echo datepattrn($rowa['edate']); } ?>
								  </span></div></td>  
                              </tr>
							  <?php
							
							}
							//echo "tval=".$tvalv."--".$tvalu."--".$tquat;
							if(!empty($tquat) && $tquat>0)
							{
								if(!empty($_POST['tp']) && $_POST['tp']=='v')
								$tcpr=$tvalv/$tquat;
								else
								$tcpr=$tvalu/$tquat;
							}
							else
							$tcpr=0;
							 ?>
							  <tr>
							    <td bgcolor="#FFFFFF" class="style36"><strong>कुल योग </strong></td>
							    <td bgcolor="#FFFFFF"><div align="right"><strong><?php echo num_fround($qau,2) ?></strong></div></td>
							    <td bgcolor="#FFFFFF"><div align="right"><strong><?php echo $tbal ?></strong></div></td>
							    <td bgcolor="#FFFFFF"><div align="right"><strong><?php echo num_fround($tquat,1) ?></strong></div></td>
							    <td bgcolor="#FFFFFF"><div align="right"><strong><?php echo num_fround($tcpr,2) ?></strong></div></td>
							    <td bgcolor="#FFFFFF">&nbsp;</td>
							    </tr>
							  </table>							  </td>
							  </tr>
							  <tr bgcolor="#FFF0FF">
							    <td height="32" colspan="4" align="center" valign="middle" bgcolor="#FFF9FF">&nbsp;</td>
						    </tr>
							<?php
							if(!empty($_POST['tp']) && $_POST['tp']=='v')
							{
							?>
							  <tr bgcolor="#FFF0FF">
							    <td height="32" colspan="4" align="center" valign="middle" bgcolor="#FFF9FF"><table width="66%" border="0" cellpadding="1" cellspacing="1" bgcolor="#000033">
							<tr>
                                <td width="25%" bgcolor="#FFFFFF"><div align="center" class="style36">ग्रेड आउट-मोड़</div></td>
								<td width="27%" bgcolor="#FFFFFF"><div align="center" class="style36">मात्राबद्ध बाज़ार (एम.के.जी.एस.)</div></td>
								  
								<td width="26%" bgcolor="#FFFFFF"><div align="center" class="style36">% साझा करें</div></td>
							  <td width="22%" bgcolor="#FFFFFF"><div align="center" class="style36">औसत मूल्य (रुपये / किग्रा)</div></td>
                            </tr>
							  <tr>
                                <td bgcolor="#FFFFFF"><span class="style38">ब्राइट ग्रेड</span></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo numround($row['bq'],3) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo numround($row['bp'],2) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo numround($row['ba'],2) ?></span></div></td>
                              </tr>
							  <tr>
                                <td bgcolor="#FFFFFF"><span class="style38">मध्यम ग्रेड</span></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo numround($row['mq'],3) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo numround($row['mp'],2) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo numround($row['ma'],2) ?></span></div></td>
                              </tr>
							  <tr>
                                <td bgcolor="#FFFFFF"><span class="style38">कम अंक</span></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo numround($row['lq'],3) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo numround($row['lp'],2) ?></span></div></td>
								<td bgcolor="#FFFFFF"><div align="right"><span class="style38"><?php echo numround($row['la'],2) ?></span></div></td>
                              </tr>
							  </table></td>
						    </tr>
							<?php
							}
							?>
                          </table>
                        <br />
                         
                            
                        </form>
                    </div>
                </div>
              </div>
              </div>
              </div>
          <a href="javascript:window.print()" target="_blank"></a> </div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="2" valign="top"><table width="100%" border="0">
      <tr>
        <td width="39%">&nbsp;<!--Page Updated on :--> <?php if(!empty($row['tdate'])){?><span class="update"><?php echo datepattrn($row['tdate'])?></span><?php }?></td>
        <td width="41%"><div align="center"></div></td>
        <td width="20%"><div align="right"><a href="#top" ><img src="tob2_imgs/bact2top.jpg" width="94" height="27" border="0" title="Back to top" alt="Back to Top" /></a></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><img src="tob2_imgs/spacer.png" width="220" height="1" /></td>
    <td width="683" valign="top"><img src="tob2_imgs/spacer.png" width="535" height="1" /></td>
    <td width="394" valign="top"><img src="tob2_imgs/spacer.png" width="225" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><?php  include_once("footer.php")
  ?></td>
  </tr>
</table>
</body>
</html>
<script language="javascript">
jQuery('#pdate').datepicker();
jQuery('#pdate').readOnly=true;
</script>
                            