<?php 
include_once("include/include.php");
///include "phpfunctions.php";

function export_per()
{
	$m=date('m');
	$y=date('Y');
	if($m<=3)
	$yy=$y-1;
	else
	$yy=$y;
	$cyr=$yy."-".($yy+1);
	$pyr=($yy-1)."-".$yy;
	$categ=array('','FCV','Tobacco Products','Unmanufactured Tobacco');
	$catg=implode(',',$categ);
	for($k=1;$k<=2;$k++)
	{
		$mn=4;
		if($k==1)
		$y1=$yy;
		else
		$y1=$yy-1;
		for($i=1;$i<=12;$i++)
		{
			$year[$i]['m']=$mn;
			$year[$i]['y']=$y1;
			$mn++;
			if($mn>=13)
			{
				$mn=1;
				$y1=$y1+1;
			}
		}
		
		$i=0;
		for($n=1;$n<count($categ);$n++)
		{
			$qry=" and catg='".$categ[$n]."'";
			$sq[$k][$n]="";
			$sv[$k][$n]="";
			for($j=1;$j<=12;$j++)
			{
				$qty="";
				$gv="";
				$sel=executework("SELECT catg,month,year,ROUND(quantity,0) as Quantity,ROUND(value,0) as gval from tob_export where isactive=1 and month=".$year[$j]['m']." and year=".$year[$j]['y'].$qry);
				$row=@mysqli_fetch_array($sel);
				$gv=$row['gval'];
				$qty=$row['Quantity'];
				if($j==1)
				{
					$sq[$k][$n]=$qty;
					$sv[$k][$n]=$gv;
				}
				else
				{
					$sq[$k][$n]=$sq[$k][$n].",".$qty;
					$sv[$k][$n]=$sv[$k][$n].",".$gv;
				}
				
			}
		}
	}
	$arr[0]=$sq;
	$arr[1]=$sv;
	return $arr;
}

function auctions()
{
	$stat='Andhra Pradesh';
	if($_POST['platform']!="")
	{
		$plats=implode('^',$_REQUEST['platform']);
		$plats1=implode(',',$_REQUEST['platform']);
	}
	$plats1=14;
	if($plats!="")
	{
		$qry=" and id in (".$plats1.")";
	}
	
	//$seldat=executework("select tob_auction.tdate from tob_platform,tob_auction where tob_platform.id=tob_auction.platf and tob_platform.id=".$row['id']." and tob_auction.year=".$yr." order by tob_auction.tdate");
	
	if($_POST['pdate']!="")
	{
		$qdate=datepattrn1($_POST['pdate']);
		$qdate1=$_POST['pdate'];
		$yr=substr($qdate,0,4);
	}
	else
	{
		$yr=date('Y');
		$seldat=executework("select tdate from tob_auction where isactive=1 and year=".$yr.$qry." order by tdate desc limit 1");
		$rowdt=@mysqli_fetch_array($seldat);
		$qdate1=datepattrn($rowdt['tdate']);
	}
	if($qdate!="")
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
//	echo "select * from tob_platform where state='".$stat."'".$qry." order by platform";
	$cntp=@mysqli_num_rows($selplat);
	$t=0;
	$str="";
	
	$tqty="";
	$tval="";
	$dt=" and (tob_auct.cdate!='0000-00-00' OR tob_auct.cdate!='') and tob_auction.aprice>0";
	while($row=@mysqli_fetch_array($selplat))
	{
		$plat[$t]=array($row['id'],$row['platform']);
		$selqdat=executework("select tdate,aprice,qsold from tob_platform,tob_auct,tob_auction where tob_platform.id=tob_auction.platf and tob_auct.platf=tob_auction.platf and tob_auct.year=tob_auction.year and tob_platform.id=".$row['id']." and tob_auction.year=".$yr.$qry1.$dt." order by tob_auction.tdate desc");
//		$selqdat=executework("select tdate,aprice,qsold from tob_platform,tob_auct,tob_auction where tob_platform.id=tob_auction.platf and tob_auct.platf=tob_auction.platf and tob_auct.year=tob_auction.year and tob_platform.home=1 and tob_platform.id=".$row['id']." and tob_auction.year=".$yr.$qry1.$dt." order by tob_auction.tdate desc");
		$cntd=@mysqli_num_rows($selqdat);
		if($cntd>0)
		{
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
	$tt[0]=$st;
	$tt[1]=$td;
	$tt[2]=$prc;

	return $tt;
}

function auctions1_280414()
{
	$stat='Andhra Pradesh';
	if($_POST['platform']!="")
	{
		$plats=implode('^',$_REQUEST['platform']);
		$plats1=implode(',',$_REQUEST['platform']);
	}
	$plats1=14;
	if($plats!="")
	{
		$qry=" and id in (".$plats1.")";
	}
	
	//$seldat=executework("select tob_auction.tdate from tob_platform,tob_auction where tob_platform.id=tob_auction.platf and tob_platform.id=".$row['id']." and tob_auction.year=".$yr." order by tob_auction.tdate");
	
	if($_POST['pdate']!="")
	{
		$qdate=datepattrn1($_POST['pdate']);
		$qdate1=$_POST['pdate'];
		$yr=substr($qdate,0,4);
	}
	else
	{
		$yr=date('Y');
		$seldat=executework("select tdate from tob_auction where isactive=1 and home=1".$qry." order by tdate desc limit 1");
		$rowdt=@mysqli_fetch_array($seldat);
		$qdate1=datepattrn($rowdt['tdate']);
	}
	if($qdate!="")
	{
		$qry1=" and tob_auction.tdate<='".$qdate."'";
	}
	
	$selplat1=executework("select * from tob_platform where state='".$stat."' and home=1 order by platform");
	$cntp1=@mysqli_num_rows($selplat1);
	$u=0;
	while($row1=@mysqli_fetch_array($selplat1))
	{
		$plat1[$u]=array($row1['id'],$row1['platform']);
		$u++;
	}
	$selplat=executework("select * from tob_platform where state='".$stat."' and home=1".$qry." order by platform limit 5");
//	echo "select * from tob_platform where state='".$stat."'".$qry." order by platform";
	$cntp=@mysqli_num_rows($selplat);
	$t=0;
	$str="";
	
	$tqty="";
	$tval="";
	$dt=" and (tob_auct.cdate!='0000-00-00' OR tob_auct.cdate!='') and tob_auction.aprice>0";
	while($row=@mysqli_fetch_array($selplat))
	{
		$plat[$t]=array($row['id'],$row['platform']);
		$selqdat=executework("select tdate,aprice,qsold from tob_platform,tob_auct,tob_auction where tob_platform.id=tob_auction.platf and tob_auct.platf=tob_auction.platf and tob_auct.year=tob_auction.year and tob_platform.id=".$row['id'].$qry1.$dt." order by tob_auction.tdate desc");
//		$selqdat=executework("select tdate,aprice,qsold from tob_platform,tob_auct,tob_auction where tob_platform.id=tob_auction.platf and tob_auct.platf=tob_auction.platf and tob_auct.year=tob_auction.year and tob_platform.home=1 and tob_platform.id=".$row['id']." and tob_auction.year=".$yr.$qry1.$dt." order by tob_auction.tdate desc");
		$cntd=@mysqli_num_rows($selqdat);
		if($cntd>0)
		{
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
	$tt[0]=$st;
	$tt[1]=$td;
	$tt[2]=$prc;

	return $tt;
}
function auctions1()
{
	$st='';$td='';$prc='';
	$seldst=executework("select * from tob_gsettings where graph='Action Graph'");
	$rowg=@mysqli_fetch_array($seldst);
	$stat=$rowg['dstate_home'];
	$plats='';
//	$stat='Andhra Pradesh';
	if(isset($_POST['platform']) && $_POST['platform']!="")
	{
		$plats=implode('^',$_REQUEST['platform']);
		$plats1=implode(',',$_REQUEST['platform']);
	}
	$plats1=14;
	if($plats!="")
	{
		$qry=" and id in (".$plats1.")";
	}
	else
	$qry='';
	
	//$seldat=executework("select tob_auction.tdate from tob_platform,tob_auction where tob_platform.id=tob_auction.platf and tob_platform.id=".$row['id']." and tob_auction.year=".$yr." order by tob_auction.tdate");
	
	if(isset($_POST['pdate']) && $_POST['pdate']!="")
	{
		$qdate=datepattrn1($_POST['pdate']);
		$qdate1=$_POST['pdate'];
		$yr=substr($qdate,0,4);
	}
	else
	{
		$yr=date('Y');
		$seldat=executework("select tdate from tob_auction where isactive=1 and home=1 ".$qry." order by tdate desc limit 1");
		$rowdt=@mysqli_fetch_array($seldat);
		$qdate='';
		$qdate1=datepattrn($rowdt['tdate']);
	}
	if($qdate!="")
	{
		$qry1=" and tob_auction.tdate<='".$qdate."'";
	}
	else
	$qry1='';
	
	$selplat1=executework("select * from tob_platform where state='".$stat."' and home=1 order by platform");
	$cntp1=@mysqli_num_rows($selplat1);
	$u=0;
	while($row1=@mysqli_fetch_array($selplat1))
	{
		$plat1[$u]=array($row1['id'],$row1['platform']);
		$u++;
	}
	$selplat=executework("select * from tob_platform where state='".$stat."' and home=1".$qry." order by platform limit 5");
//	echo "select * from tob_platform where state='".$stat."'".$qry." order by platform";
	$cntp=@mysqli_num_rows($selplat);
	$t=0;
	$str="";
	
	$tqty="";
	$tval="";
	$dt=" and (tob_auct.cdate!='0000-00-00' OR tob_auct.cdate!='') and tob_auction.aprice>0";
	while($row=@mysqli_fetch_array($selplat))
	{
		$plat[$t]=array($row['id'],$row['platform']);
		$selqdat=executework("select tdate,aprice,qsold from tob_platform,tob_auct,tob_auction where tob_platform.id=tob_auction.platf and tob_auct.platf=tob_auction.platf and tob_auct.year=tob_auction.year and tob_platform.id=".$row['id'].$qry1.$dt." and tob_auction.tdate between '".$rowg['fdate']."' and '".$rowg['tdate']."' order by tob_auction.tdate desc");
//		$selqdat=executework("select tdate,aprice,qsold from tob_platform,tob_auct,tob_auction where tob_platform.id=tob_auction.platf and tob_auct.platf=tob_auction.platf and tob_auct.year=tob_auction.year and tob_platform.home=1 and tob_platform.id=".$row['id']." and tob_auction.year=".$yr.$qry1.$dt." order by tob_auction.tdate desc");
		$cntd=@mysqli_num_rows($selqdat);
		if($cntd>0)
		{
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
	$tt[0]=$st;
	$tt[1]=$td;
	$tt[2]=$prc;

	return $tt;
}

?>
