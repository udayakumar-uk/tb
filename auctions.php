<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/include.php");
?>

<?php
	function numround($st,$n){
		if(!empty($st)) {
			$n1=pow(10 ,$n);
			$num=round($st*$n1)/($n1);
		}
		return $num;
	}
	function num_deczero($n){
		$exn='';
		for($i=1;$i<=$n;$i++)
		$exn=$exn."0";
		return $exn;
	}
	function num_fround($st,$n){
		$exn='';
		if($st=="")
		$st=0;
		if($st!="" && $st!=0) {
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
	function numberOfDecimals($value){
		if ((int)$value == $value) {
			return 0;
		}
		else if (! is_numeric($value)) {
			// throw new Exception('numberOfDecimals: ' . $value . ' is not a number!');
			return false;
		}

		return strlen($value) - strrpos($value, '.') - 1;
	}
?>

<?php
	$qry1='';$tvalv=0;
	$qry=''; $st=''; $prc=''; $td=''; $yrs='';

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
	
	if(!empty($_POST['state']))
	$stat=$_POST['state'];
	else if(!empty($_GET['state']))
	$stat=$_GET['state'];
	else
	$stat='Karnataka';
/*if($_POST['platform']!=""){
	$plats=implode('^',$_REQUEST['platform']);
	$plats1=implode(',',$_REQUEST['platform']);
}
if($plats!=""){
	$qry=" and id in (".$plats1.")";
}
*/
//$seldat=executework("select tob_auction.tdate from tob_platform,tob_auction where tob_platform.id=tob_auction.platf and tob_platform.id=".$row['id']." and tob_auction.year=".$yr." order by tob_auction.tdate");

	if(!empty($_POST['pdate'])){
		$qdate2=date('Y-m-d',strtotime(str_replace('/','-',$_POST['pdate'])));
	}
	else {
		$qdate2=date('Y-m-d');
	}
		$seldat1=executework("select year from tob_auction where isactive=1 and platf in(select id from tob_platform where state='".$stat."')".$qry." order by tdate desc limit 1");
		$rowdt1=@mysqli_fetch_array($seldat1);
	if(!empty($_POST['pdate'])){
		$qdate=datepattrn1($_POST['pdate']);
		$qdate1=$_POST['pdate'];
		$yr=substr($qdate,0,4);
	}
	else {
		$seldat=executework("select tdate from tob_auction where isactive=1".$qry." order by tdate desc limit 1");
		$rowdt=@mysqli_fetch_array($seldat);
		$qdate1=datepattrn($rowdt['tdate']);
	}
	//$yr=substr($rowdt1['tdate'],0,4);
	$yr=$rowdt1['year'];
	if(!empty($qdate)){
		$qry1=" and tob_auction.tdate<='".$qdate."'";
	}

	$selplat1=executework("select * from tob_platform where state='".$stat."' order by platform");
	$cntp1=@mysqli_num_rows($selplat1);
	$u=0;
	while($row1=@mysqli_fetch_array($selplat1)){
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
	$selycnt=executework("select distinct count(distinct tdate) as cnt from tob_platform,tob_auction where tob_platform.id=tob_auction.platf and tob_platform.state='".$stat."'".$qry1." and tob_auction.year=(select distinct year from tob_platform,tob_auction where tob_platform.id=tob_auction.platf and tob_platform.state='".$stat."'"." order by tob_auction.year desc limit 1) order by cnt desc limit 1");
	$rowycnt=@mysqli_fetch_array($selycnt);
	if(!empty($rowycnt['cnt']))
	$days=$rowycnt['cnt'];
	while($row=@mysqli_fetch_array($selplat)){
		$plat[$t]=array($row['id'],$row['platform']);
		$selqdat=executework("select distinct tdate,aprice,qsold from tob_platform,tob_auction where tob_platform.id=tob_auction.platf and tob_platform.id='".$row['id']."'".$qry1." order by tob_auction.tdate");
		$selqdat1=executework("SELECT year FROM tob_auction where platf='".$row['id']."'".$qry1." order by year desc limit 1");
		$rowd1=@mysqli_fetch_array($selqdat1);
		if(empty($rowd1['year']))
		$year=date('Y');
		else
		$year=$rowd1['year'];
		//$selqdat=executework("SELECT tdate,aprice,qsold FROM tob_auction WHERE year=".$year." AND platf=29");
		$cntd=@mysqli_num_rows($selqdat);
		if($cntd>0){
	//		if($cntd>$days)
	//		$days=$cntd;
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
	} ?>

    <?php
		if(!empty($_POST['state']))
		$mn1=$_POST['state'];
		else if(!empty($_GET['state']))
		$mn1=$_GET['state'];
		else
		$mn1='Karnataka';
		if($mn1=='Andhra Pradesh') {
			$ap="checked=true";
			$kt="";
		}
		else if($mn1=='Karnataka') {
			$ap="";
			$kt="checked=true";
		}
	?>

	
<!DOCTYPE html>
<html lang="en">
<head>
	<title>FCV Tobacco Auctions  | Tobacco Board, Guntur</title>
  
  	<?php include "head.php"; ?>

	<link class="include" rel="stylesheet" type="text/css" href="graph/jquery.jqplot.min.css" />
    <link type="text/css" rel="stylesheet" href="graph/syntaxhighlighter/styles/shCoreDefault.min.css" />
    <link type="text/css" rel="stylesheet" href="graph/syntaxhighlighter/styles/shThemejqPlot.min.css" />
	<link type="text/css" rel="stylesheet" href="jquery.ui-1.5.2/themes/ui.datepicker.css" />
  


	<script language="javascript">
		function toggle_forms(st,frm) {
			document.getElementById(frm).action=st;
			document.getElementById(frm).submit();
		}
		function MM_openBrWindow(theURL,winName,features) { //v2.0
			window.open(theURL,winName,features);
		}
	</script>
</head>
<body>


<?php include "tb_header.php"; ?>

<!--------------Content--------------->

	
<div id="main-content">
    <div id="content" class="container">
    	<form id="actn" name="actn" method="post" action="">

            <div class="card box-shadow my-3">
				<div class="card-body d-flex align-items-end flex-wrap gap-2">

					<div class="col-auto bg-light flex-grow-1 rounded-3 p-2 border">
						<div class="form-check mb-1">
							<input class="form-check-input" type="radio" name="state" id="state" value="Andhra Pradesh" <?php echo $ap ?> onChange="actn.submit();">
							<label class="form-check-label" for="state">
								Andhra Pradesh
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="state" id="state2" value="Karnataka" <?php echo $kt ?> onChange="actn.submit();" >
							<label class="form-check-label" for="state2">
								Karnataka
							</label>
						</div>
					</div>

					<div class="col-auto bg-light flex-grow-1 rounded-3 p-2 border">
						<div class="form-check mb-1">
							<input class="form-check-input" type="radio" name="tp" id="tp" value="q" checked="checked" onChange="actn.submit();">
							<label class="form-check-label" for="tp">
								Day Information
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="tp" id="tp2" type="radio" value="v" onChange="actn.submit();" >
							<label class="form-check-label" for="tp2">
								Cumulative Information 
							</label>
						</div>
					</div>

					<div class="col-auto">
						<label class="form-check-label" for="pdate">
							Date: 
							<input class="form-control" name="pdate" type="text" id="pdate" value="<?php echo $qdate1 ?>" onChange="actn.submit();"/>
						</label>
					</div>

					<button class="col-auto btn btn-primary b" onClick="toggle_forms('auctions1.php','actn');"><span class="material-symbols-outlined">bar_chart_4_bars</span> View in Graph Format</button>
            
				</div>
			</div>

			<?php if(!empty($_POST['yr']))
				$yrs=$_POST['yr'];

				if(!empty($yrs)) { ?>

				<script type="text/javascript">
					var yrs='<?php echo $yrs ?>';
					var j;
					for(j=0;j<document.actn.yr.length;j++) {
						if(document.actn.yr[j].value==yrs) {
							document.actn.yr[j].checked=true;
						}
					}
				</script>
			<?php } ?>

			<?php
				if(!empty($_POST['tp']))
				$tps=$_POST['tp'];

				if(!empty($tps))
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
            <?php } ?>

			<div class="sales-report text-center py-4">
				<h4 class="title"><?php echo $yr." ".$stat; ?> Auctions - Sales Report</h4> 
				
				<?php $sel3=executework("select * from tob_auction,tob_platform where tob_auction.platf=tob_platform.id and state='".$stat."' and date(tdate)<='".$qdate2."' and tob_platform.isactive=1 order by tob_auction.tdate desc limit 1");
					$row=@mysqli_fetch_array($sel3);
						$adate=$row['tdate']; ?>
				<div class="d-flex flex-wrap justify-content-center gap-4 py-3">
					<span>Start Auction Year : <strong><?php echo $yr ?></strong></span>
					<span>Day : <strong><?php echo $days ?></strong></span>
					<span>Auction Date : <strong><?php echo datepattrn($adate) ?></strong></span>
				</div>
				
					<table cellpadding="5" class="table table-bordered table-striped table-hover">
						<thead>
						<?php if(!empty($_POST['tp']) && $_POST['tp']=='v'){ ?>
							<tr>
								<th>Name of the Auction Platform</th>
								<th>Quantity Authorized (M.Kgs.)</th>
								<th>Cumulative Total Bales Marketed</th>
								<th>Cumulative Quantity Marketed (Kgs.)</th>
								<th>Cumulative Average Price (Rs./Kg)</th>
								<th>End Date Of Auction (d-m-y)</th>
							</tr>
						<?php } else { ?>
							<tr>
                                <th>Name of the Auction Platform
								<th>Quantity Authorized (M.Kgs.)
								<th>Total Bales Marketed
								<th>Quantity Marketed (Kgs.)
								<th>Average Price (Rs./Kg)
								<th>End Date Of Auction (d-m-y)
							</tr>
						<?php }
							
							$qrv='';
							//if(!empty($_POST['tp']) && $_POST['tp']=='q')
							//$qrv=" and tdate='".$adate."'";
							$sel1=executework("select distinct platf,platform,tob_platform.catg,tob_platform.seqid from tob_auction,tob_platform where tob_auction.platf=tob_platform.id and state='".$stat."'".$qrv." and tob_platform.isactive=1 order by field(tob_platform.catg,'NBS','SBS','SLS','NLS'),tob_platform.seqid");
							$cntt=@mysqli_num_rows($sel1);
							$qau=0;
							$tbal=0;
							$tquat=0;
							$tvalu=0;
							while($row1=@mysqli_fetch_array($sel1)){
								$selauct=executework("select * from tob_auct where platf=".$row1['platf']." and year=".$yr);
								
								$rowa=@mysqli_fetch_array($selauct);
								$qrv='';
								if(!empty($_POST['tp']) && $_POST['tp']=='v')
								$qrv=" and tdate between '".$rowa['cdate']."' and '".$adate."'";
								else
								$qrv=" and tdate='".$adate."'";
								$selsm=executework("select sum(bsold) as bsold,sum(qsold) as qsold,sum(tvalue) as tval,sum(aprice) as apric from tob_auction where platf='".$row1['platf']."'".$qrv);
								$rows=@mysqli_fetch_array($selsm);

								if(!empty($_POST['tp']) && $_POST['tp']=='v')
								{
									$eq=$rows['qsold'];
									$eb=$rows['bsold'];
									if($eq>0)
									$ep=$rows['tval']/$eq;
									else
									$ep=0;
									//$ep=$row1['cprice'];
								}
								else
								{
									$eq=$rows['qsold'];
									$eb=$rows['bsold'];
									$ep=$rows['apric'];
								}
								$qau+=$rowa['qauth'];
								$tbal+=$eb;
								$tquat+=$eq;
								$tvalu+=$rows['tval'];
								$tvalv+=$rows['tval'];
								if($eb>0)
								{
							?>
							
							
						</thead>
							<tr>
                                <td><?php echo $row1['platform'] ?></td>
								<td><?php echo num_fround($rowa['qauth'],2) ?></td>
								<td><?php echo $eb ?></td>
								<td><?php echo num_fround($eq,1) ?></td>
								<td><?php echo num_fround($ep,2) ?></td>
								<td> <?php if($rowa['edate']!="" && $rowa['edate']!='0000-00-00' && $rowa['edate']!='1970-01-01') { echo datepattrn($rowa['edate']); } ?> </td>
                            </tr>
						<?php }  }
							//echo "tval=".$tvalv."--".$tvalu."--".$tquat;
							if($tquat>0){
								if(!empty($_POST['tp']) && $_POST['tp']=='v')
								$tcpr=$tvalv/$tquat;
								else
								$tcpr=$tvalu/$tquat;
							}
							else
							$tcpr=0;
							 ?>
							 
						<tr>
							<td>Grand Total</td>
							<td><?php echo num_fround($qau,2) ?></td>
							<td><?php echo $tbal ?></td>
							<td><?php echo num_fround($tquat,1) ?></td>
							<td><?php echo num_fround($tcpr,2) ?></td>
						</tr>
					</table>
							  
				<?php if(!empty($_POST['tp']) && $_POST['tp']=='v'){ ?>
				<?php } ?>            
			</div>
        </form>
	</div>
</div>




<!--------------Footer--------------->

<script class="include" type="text/javascript" src="graph/jquery.min.js"></script>
<script src="jquery.ui-1.5.2/ui/ui.datepicker.js" type="text/javascript"></script>

<script language="javascript">
	jQuery('#pdate').datepicker();
	jQuery('#pdate').readOnly=true;
</script>

<?php include "tb_footer.php"; ?>

</body>
</html>