<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/include.php");
?>
 
 
<?php
$qry=''; $qry1='';
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
	
function graph_data($state,$catg,$platf,$qdate){
	
	$str="";
	$cmprice='';
	$st1="";

	$qr='';
	if($catg!='')
	$qr.=" and catg='".$catg."'";
	if($platf!='')
	$qr.=" and id in (".$platf.")";

	if(!empty($qdate))
	{
		$qr1=" and tob_auction.tdate<='".$qdate."'";
	}
	
	$selplat=executework("select * from tob_platform where state='".$state."' and isactive=1".$qr." order by platform");
	$cntp=@mysqli_num_rows($selplat);
	
	$tqty='';$tval='';
	
	while($row=@mysqli_fetch_array($selplat))
	{
		//print_r($row);
		$seldata=executework("select tdate,aprice,cprice,qsold from tob_platform,tob_auction where tob_platform.id=tob_auction.platf  and tob_auction.aprice>0 and tob_platform.id=".$row['id'].$qr1." order by tob_auction.tdate desc");
		$cntd=@mysqli_num_rows($seldata);
		if($cntd>0){
			$dates='';$aprice='';$qty=0; $dval=0;
			while($rowd=@mysqli_fetch_array($seldata))
			{
				$selm=executework("select sum(qsold) as qs,sum(tvalue) as tv from tob_auction where tdate<='".$rowd['tdate']."' and platf=".$row['id']);
				$rowm=@mysqli_fetch_array($selm);
				
				if(empty($rowm['qs']))
				$qs=0;
				else
				$qs=$rowm['qs'];
				
				if(empty($rowm['tv']))
				$tv=0;
				else
				$tv=$rowm['tv'];
				
				if($tv>0)
				$cprice=$tv/$qs;
				else
				$cprice=0;
				
				if($rowd['aprice']>0)
				{
					if($dates=='')
					$dates=$rowd['tdate'];
					else
					$dates.="^".$rowd['tdate'];

					if($aprice=='')
					$aprice=round($rowd['aprice']);
					else
					$aprice.="^".round($rowd['aprice']);

					if($cmprice=='')
					$cmprice=round($cprice);
					else
					$cmprice.="^".round($cprice);
					
					$qty+=$rowd['qsold'];
					
					$dval+=($rowd['qsold']*$rowd['aprice']);
				}
			}
			if($tqty=="")
			$tqty=$qty;
			else
			$tqty=$tqty.":".$qty;
			
			if($qty>0)
			$val=$dval/$qty;
			else
			$val=0;
			
			if($tval=="")
			$tval=round($val);
			else
			$tval=$tval.":".round($val);
	
			if($str=="")
			$str=$row['platform']."*".$dates."*".$aprice."*".$cmprice;
			else
			$str=$str."~".$row['platform']."*".$dates."*".$aprice."*".$cmprice;
			
			if(empty($st))
			$st=$row['platform'];
			else
			$st=$st.":".$row['platform'];
			
			if(empty($td))
			$td=$dates;
			else
			$td=$td.":".$dates;
			
			if(empty($prc))
			$prc=$aprice;
			else
			$prc=$prc.":".$aprice;
	
			if(empty($aprc))
			$aprc=$cmprice;
			else
			$aprc=$aprc.":".$cmprice;
			
		}
	}
	//echo "st=".$st." -----";
	return $tqty."#".$tval."#".$str."#".$st."#".$td."#".$prc."#".$aprc;
}

$seldst=executework("select * from tob_gsettings where graph='Action Graph'");
$rowg=@mysqli_fetch_array($seldst);
if(!empty($_POST['state']))
$stat=$_POST['state'];
else
$stat=$rowg['dstate_graph'];

if(!empty($_POST['platform'])){
	$plats=implode('^',$_REQUEST['platform']);
	$plats1=implode(',',$_REQUEST['platform']);
}
if(!empty($plats)){
	$qry=" and id in (".$plats1.")";
}

//$seldat=executework("select tob_auction.tdate from tob_platform,tob_auction where tob_platform.id=tob_auction.platf and tob_platform.id=".$row['id']." and tob_auction.year=".$yr." order by tob_auction.tdate");

if(!empty($_POST['pdate'])){
	$qdate=datepattrn1($_POST['pdate']);
	$qdate1=$_POST['pdate'];
	$yr=substr($qdate,0,4);
	$gdate=date('Y-m-d',strtotime(str_replace('/','-',$_POST['pdate'])));
}
else
{
	$yr=date('Y');
	$seldat=executework("select tdate from tob_auction where isactive=1".$qry." order by tdate desc limit 1");
	$rowdt=@mysqli_fetch_array($seldat);
	$qdate1=datepattrn($rowdt['tdate']);
	$gdate=date('Y-m-d',strtotime($rowdt['tdate']));
}
if(!empty($qdate)){
	$qry1=" and tob_auction.tdate<='".$qdate."'";
}

$selplat1=executework("select * from tob_platform where state='".$stat."' and isactive=1 order by catg, platform");
$cntp1=@mysqli_num_rows($selplat1);
$u=0;
$grplat=array();
while($row1=@mysqli_fetch_array($selplat1)){
	$catg=$row1['catg'];
	$plat1[$u]=array($row1['id'],$row1['platform'],$catg);
	if($catg!='')
	$grplat[$catg][]=array($row1['id'],$row1['platform']);
	$u++;
}
$selplat=executework("select * from tob_platform where state='".$stat."' and isactive=1".$qry." order by platform");
$cntp=@mysqli_num_rows($selplat);
$t=0;

$tqty="";
$tval="";
//$dt=" and cdate!='0000-00-00' and aprice>0";
//if(empty($_POST['tp']) || $_POST['tp']=='q')
//$dt=" and (tob_auct.cdate!='0000-00-00' OR tob_auct.cdate!='') and tob_auction.aprice>0";
//else
$dt=" and tob_auction.aprice>0";

while($row=@mysqli_fetch_array($selplat)){
	$plat[$t]=array($row['id'],$row['platform']);
	//$selqdat=executework("select tdate,aprice,cprice,qsold from tob_platform,tob_auct,tob_auction where tob_platform.id=tob_auction.platf and tob_auct.platf=tob_auction.platf and tob_auct.year=tob_auction.year and tob_platform.id=".$row['id'].$qry1.$dt." order by tob_auction.tdate desc");
	$selqdat=executework("select tdate,aprice,cprice,qsold from tob_platform,tob_auction where tob_platform.id=tob_auction.platf and tob_platform.id=".$row['id'].$qry1.$dt." order by tob_auction.tdate desc");
		//echo "<br><br>select tdate,aprice,cprice,qsold from tob_platform,tob_auction where tob_platform.id=tob_auction.platf and tob_platform.id=".$row['id'].$qry1.$dt." order by tob_auction.tdate desc";
//	$selqdat=executework("select tdate,aprice,qsold from tob_platform,tob_auction where tob_platform.id=tob_auction.platf and tob_platform.id=".$row['id']." and tob_auction.year=".$yr.$qry1.$dt." order by tob_auction.tdate");
	$cntd=@mysqli_num_rows($selqdat);
	if($cntd>0)
	{
		$k=0;
		$str="";
		$str1="";
		$st1="";
		$st2="";
		$st3="";
		$qty=0;
		$vald=0;
		while($rowqd=@mysqli_fetch_array($selqdat)){
		
			$selsum=executework("select sum(qsold) as qs,sum(tvalue) as tv from tob_auction where tdate<='".$rowqd['tdate']."' and platf=".$row['id']);
			//echo "<br>select sum(qsold) as qs,sum(tvalue) as tv from tob_auction where tdate<='".$rowqd['tdate']."' and platf=".$row['id'];
			$rowsm=@mysqli_fetch_array($selsum);
			$ctval=$rowsm['tv'];
			$cqs=$rowsm['qs'];
			if($cqs>0)
			$cprice=$ctval/$cqs;
			else
			$cprice=0;
			//echo "cprc=".$cprice;
			if($rowqd['aprice']>0)
			{
				$dates[$t]['d'][$k]=$rowqd['tdate'];
				$dates[$t]['v'][$k]=round($cprice);
				if($st1=="")
				$st1=$rowqd['tdate'];
				else
				$st1=$st1."^".$rowqd['tdate'];
	
				if($st2=="")
				$st2=round($rowqd['aprice']);
				else
				$st2=$st2."^".round($rowqd['aprice']);
				
				if($st3=="")
				$st3=round($cprice);
				else
				$st3=$st3."^".round($cprice);
				
				
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
		$str=$row['platform']."*".$st1."*".$st2."*".$st3;
		else
		$str=$str."~".$row['platform']."*".$st1."*".$st2."*".$st3;
		
		if(empty($st))
		$st=$row['platform'];
		else
		$st=$st.":".$row['platform'];
		
		if(empty($td))
		$td=$st1;
		else
		$td=$td.":".$st1;
		
		if(empty($prc))
		$prc=$st2;
		else
		$prc=$prc.":".$st2;

		if(empty($aprc))
		$aprc=$st3;
		else
		$aprc=$aprc.":".$st3;
	}
	$t++;
}
if(!empty($stat))
$mn1=$stat;
if($mn1=='Andhra Pradesh'){
	$ap="checked=true";
	$kt="";
}
else if($mn1=='Karnataka'){
	$ap="";
	$kt="checked=true";
}

//echo "aprc=".$aprc;
//echo "<br>prc=".$prc;
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>FCV Tobacco Auctions  | Tobacco Board, Guntur</title>
  
  	<?php include "head.php"; ?>

	<link class="include" rel="stylesheet" type="text/css" href="jqplot1/jquery.jqplot.min.css" />
	<link href="jquery.ui-1.5.2/themes/ui.datepicker.css" rel="stylesheet" type="text/css" />
	
	<script class="include" type="text/javascript" src="jqplot1/jquery.min.js"></script>

	<script language="javascript">
		function toggle_forms(st,frm){
			document.getElementById(frm).action=st;
			document.getElementById(frm).submit();
		}
		function checkAll(formname, checktoggle){
		var checkboxes = new Array(); 
		checkboxes = document[formname].getElementsByTagName('input');
		for (var i=0; i<checkboxes.length; i++)  {
			if (checkboxes[i].type == 'checkbox')   {
			checkboxes[i].checked = checktoggle;
			}
		}
		if(checktoggle=='true')
		document[formname].submit();
		}
		function subform(){
			checkAll('actn','');
		//	document.getElementById("platform[]").checkedvalue="";
			document.actn.submit();
		}

		function chkcatg(chk){
			var cls=$(chk).val();
			var chkd=$(chk).prop("checked");
			
			if(chkd)
			$('.'+cls).prop("checked",true);
			else
			$('.'+cls).prop("checked",false);
			document.actn.submit();
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
							<input class="form-check-input" type="radio" name="state" id="state" value="Andhra Pradesh" <?php echo $ap ?> onChange="subform();">
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

					<button class="col-auto btn btn-primary b" onClick="toggle_forms('auctions.php','actn');"><span class="material-symbols-outlined">table</span> View in Table Format</button>
			
				</div>
			</div>

			
                
		<?php if(!empty($_POST['yr']))
			$yrs=$_POST['yr'];  ?>
						
			<?php
			if(!empty($_POST['yr']))
			$yrs=$_POST['yr'];

			if(!empty($yrs)) { ?>
				<script type="text/javascript">
					var yrs='<?php echo $yrs ?>';
					var j;
					for(j=0;j<document.actn.yr.length;j++) {
						if(document.actn.yr[j].value==yrs)
						{
							document.actn.yr[j].checked=true;
						}
					}
				</script>
			<?php } ?>

			<?php
			if(!empty($_POST['tp']))
			$tps=$_POST['tp'];
			else
			$tps='';

			if($tps!="") {
			?>
			
			<script type="text/javascript">
				var tps='<?php echo $tps ?>';
				var j;
				for(j=0;j<document.actn.tp.length;j++) {
					if(document.actn.tp[j].value==tps)
					{
						document.actn.tp[j].checked=true;
					}
				}
			</script>
			<?php } ?>
			
			
            <div class="example-content pt-4"> 
                <div id="chart2" style="width:100%; height:500px;"></div>
			
                <table width="100%" style="display:none">
					<?php
					$catgg='';
					$catgg1='';
					for($i=0;$i<count($plat1);$i++) {
						$chkk="";$chkk1="";
						if(isset($_POST['platform']))
						{
							if(in_array($plat1[$i][0],$_POST['platform']))
							{
								$chkk="checked=true";
							}
							else
							{
								$chkk="";
							}
						}
						else
						$chkk="checked=true";
						
						if($catgg1!=$plat1[$i][2])
						$catgg=$plat1[$i][2];
						else
						$catgg='';
						if($catgg!='') {
							if(isset($_POST['catg'])) {
								if(in_array($plat1[$i][2],$_POST['catg'])) {
									$chkk1="checked=true";
								}
								else {
									$chkk1="";
								}
							}
							else
							$chkk1="checked=true";
								
							?>
							<tr bgcolor="#e08e2f">
								<td><label><input name="catg[]" type="checkbox" value="<?php echo $plat1[$i][2] ?>" <?php echo $chkk1 ?> id="catg[]" onChange="chkcatg(this);" />
								&nbsp;&nbsp;<?php echo $catgg ?></label></td>
							</tr>
						<?php } ?>

							<tr bgcolor="#FFFFFF">
								<td><label><input class="<?php echo $plat1[$i][2]; ?>" name="platform[]" type="checkbox"  style="margin-left:15px;" value="<?php echo $plat1[$i][0] ?>" <?php echo $chkk ?> id="platform[]" onChange="actn.submit();" />
								&nbsp;&nbsp;<?php echo $plat1[$i][1] ?></label></td>
							</tr>
								<!--<option value="<?php //echo $plat1[$i][0] ?>"><?php //echo $plat1[$i][1] ?></option>-->
								<?php
								$catgg1=$plat1[$i][2];
					} ?>
					<tr bgcolor="#FFFFFF">
						<td class="style38"><div align="center"><a style="cursor:pointer" onClick="checkAll('actn', 'true');"><strong>Check All</strong></a></div></td>
					</tr>
					<tr bgcolor="#FFFFFF">
						<td class="style38"><div align="center"><strong><a style="cursor:pointer" onClick="checkAll('actn','');">Uncheck All</a></strong></div></td>
					</tr>
				</table>
                            
						
			<script class="" type="text/javascript">
				$(document).ready(function(){
					if(document.actn.tp[0].checked) {
						graph1();
					}
					else {
						graph3();
					}
				});

function graph1(){
	//alert("chk");
	var st1='<?php echo $st ?>';
	var td1='<?php echo $td ?>';
	var prc1='<?php echo $prc ?>';
	var gmin='<?php echo $rowg['min2']; ?>';
	var gmax='<?php echo $rowg['max2']; ?>';
	var st=new Array();
	var td=new Array();
	var prc=new Array();
	var tot=new Array();

	st=st1.split(':');
	td=td1.split(':');
	prc=prc1.split(':');
	var prca=new Array();
	var a=0;
	for(i=0;i<st.length;i++)
	{
		var tds=td[i].split('^');
		var prcs=prc[i].split('^');
		var tot1=new Array();
		for(j=0;j<tds.length;j++){
			tot1[j]=Array(tds[j],prcs[j]);
			prca[a]=prcs[j];
			a++;
		}
		tot[i]=tot1;
	}
//	alert("tot="+prca);
		var smax = Math.max.apply(Math, prca);
		var smin = Math.min.apply(Math, prca);
		if(smax=="")
		smax=200;
		else
		smax=parseInt(smax);
		
		if(smin=="")
		smin=120;
		else
		smin=parseInt(smin);

		var rema1=parseFloat(smin)/10;
		var rema2=Math.round(rema1);
		if(rema2>rema1)
		var xtra=10;
		else
		xtra=0;
		smin=(parseFloat(rema2)*10)-parseInt(xtra);

		var dif=parseFloat(smax)-parseFloat(smin);
		var dif1=parseFloat(dif)/10;
		var dif1=Math.round(dif1)+1;
		smax=parseFloat(smin)+(parseFloat(dif1)*10);
		//smin=gmin/1;
		//smax=gmax/1;
		//alert(smin+"   ---   "+smax);
	var plot3 = $.jqplot('chart2', tot, 
    { 
      //title:'Line Style Options', 
      // Set default options on all series, turn on smoothing.
      seriesDefaults: {
          rendererOptions: {
              smooth: true
          }
      },
	  //seriesColors:['#85802b', '#00749F', '#73C774', '#C7754C', '#C7754B'],
      // Series options are specified as an array of objects, one object
      // for each series.
        legend: {
            show: true,
		labels:st,
            placement: 'outsideGrid'
        },
			axesDefaults: {
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
          angle: -30,
		   fontSize: '7px'
        }
    },
            axes: {
				 yaxis: {
					min: smin,
					max: smax,
				  
				  angle: 90
				},
				xaxis:{
					renderer:$.jqplot.DateAxisRenderer
				}
            },
      series:[ 
	  	{
            lineWidth:2, 
            markerOptions: { style:"filledSquare", size:5 }
		},
           
      ]
    });
}

function graph3(){
	var st1='<?php echo $st ?>';
	var td1='<?php echo $td ?>';
	var prc1='<?php echo $aprc ?>';
	var gmin='<?php echo $rowg['min3']; ?>';
	var gmax='<?php echo $rowg['max3']; ?>';
	//alert("prc="+prc1);
	var st=new Array();
	var td=new Array();
	var prc=new Array();
	var tot=new Array();

	st=st1.split(':');
	td=td1.split(':');
	prc=prc1.split(':');
	var prca=new Array();
	var a=0;
	for(i=0;i<st.length;i++)
	{
		var tds=td[i].split('^');
		var prcs=prc[i].split('^');
		var tot1=new Array();
		for(j=0;j<tds.length;j++){
			tot1[j]=Array(tds[j],prcs[j]);
			prca[a]=prcs[j];
			a++;
		}
		tot[i]=tot1;
	}
//	alert(tot);
		var smax = Math.max.apply(Math, prca);
		var smin = Math.min.apply(Math, prca);
		if(smax=="")
		smax=200;
		else
		smax=parseInt(smax);
		
		if(smin=="")
		smin=120;
		else
		smin=parseInt(smin);

		var rema1=parseFloat(smin)/10;
		var rema2=Math.round(rema1);
		if(rema2>rema1)
		var xtra=10;
		else
		xtra=0;
		smin=(parseFloat(rema2)*10)-parseInt(xtra);

		var dif=parseFloat(smax)-parseFloat(smin);
		var dif1=parseFloat(dif)/10;
		var dif1=Math.round(dif1)+1;
		smax=parseFloat(smin)+(parseFloat(dif1)*10);

//		alert(smax+"--"+smin);
/*		var rem1=parseFloat(smax)/100;
		var rem2=Math.round(rem1);
//		alert(rem2);
		if(rem2<rem1)
		var xtr=50;
		else
		xtr=0;
//		alert(tot);
		smax=(parseFloat(rem2)*100)+parseInt(xtr);
		
*/
		smax=gmax/1;
		smin=gmin/1;
		var plot3 = $.jqplot('chart2', tot, 
    { 
      //title:'Line Style Options', 
      // Set default options on all series, turn on smoothing.
      seriesDefaults: {
          rendererOptions: {
              smooth: true
          }
      },
	  //seriesColors:['#85802b', '#00749F', '#73C774', '#C7754C', '#C7754B'],
      // Series options are specified as an array of objects, one object
      // for each series.
        legend: {
            show: true,
		labels:st,
            placement: 'outsideGrid'
        },
			axesDefaults: {
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
          angle: -30,
		   fontSize: '7px'
        }
    },
            axes: {
				 yaxis: {
					min: smin,
					max: smax,
				  
				  angle: 90
				},
				xaxis:{
					renderer:$.jqplot.DateAxisRenderer
				}
            },
      series:[ 
	  	{
            lineWidth:2, 
            markerOptions: { style:"filledSquare", size:5 }
		},
           
      ]
    });
}
 
   function graph2(){
  
	var st1='<?php echo $st ?>';
	var tqty1='<?php echo $tqty ?>';
	var tval1='<?php echo $tval ?>';

	var tqty=new Array();
	var s=new Array();
	var st=new Array();

	tqty=tqty1.split(':');
	s=tval1.split(':');
	st=st1.split(':');

	var xlab='<?php echo $qdate1 ?>';
	var tit="Domestic Auction Information (Platform Wise)";

		var ylab='Cumulative Average Price';
		var smax = Math.max.apply(Math, s);
		//alert(smax);
		if(smax=="")
		smax=200;
		var rem1=parseFloat(smax)/100;
		var rem2=Math.round(rem1);
		//alert(rem1);
		if(rem2<rem1)
		var xtr=50;
		else
		xtr=0;
		smax=(parseFloat(rem2)*100)+parseInt(xtr);

//		s1=[s[0],s[1],s[2],s[3],s[4],s[5],s[6],s[7],s[8],s[9],s[10],s[11]];
 //       var s2 = [7, 5, 3, 2];
//         var ticks = ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'];
        var ticks = st;
        plot2 = $.jqplot('chart2', [s], {
            seriesDefaults: {
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true },
				markerOptions: {
				seriesColors: [ "#4bb2c5", "#c5b47f", "#EAA228", "#579575", "#839557", "#958c12", "#953579", "#4b5de4", "#d8b83f", "#ff5800", "#0085cc"],
					show: true,             // wether to show data point markers.
					style: 'filledCircle',  // circle, diamond, square, filledCircle.
				}
            },
            animate: true,
            // Will animate plot on calls to plot1.replot({resetAxes:true})
            animateReplot: true,
			title: tit,
            fontSize: '14px',
            textColor: 'var(--bs-dark)',
            fontFamily: 'Inter, sans-serif',
           	series:[{
				pointLabels: {
					show: true
				},
				renderer: $.jqplot.BarRenderer,
				rendererOptions:{ varyBarColor : true },
				showHighlight: true,
				//  yaxis: 'y2axis',
				rendererOptions: {
					// Speed up the animation a little bit.
					// This is a number of milliseconds.  
					// Default for bar series is 3000.  
					animation: {
						speed: 2500
					},
					barWidth: 30,
					barPadding: 25,
					barMargin: 15,
					highlightMouseOver: true
				}
			}, 
			{
				rendererOptions: {
					// speed up the animation a little bit.
					// This is a number of milliseconds.
					// Default for a line series is 2500.
					animation: {
						speed: 2000
					},
				}
			} ],
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
					tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
                    ticks: ticks,
					label:xlab,
					tickOptions: {
						angle: 90,
						fontSize: '1rem',
						showMark: true,
                	}
                },
				yaxis: {
					min: 0,
					max: smax,
					numberTicks: 11, 
					tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
	                pointLabels: { show: true },
					label:ylab,
					tickOptions: {
						angle: 90,
						fontSize: '1rem',
						showMark: true,
					}
				}
            },
            highlighter: {
                show: true, 
                showLabel: true, 
                tooltipAxes: 'y',
                sizeAdjust: 7.5 , tooltipLocation : 'ne'
            }
        });
    }
    </script>
                            <!-- End example scripts -->
                            <!-- Don't touch this! -->

				</div>
			</form>


<script language="javascript">

	function graph_sub(chart,st1,td1,prc1,gmin,gmax){
		//alert("chk");
	//	var st1='<?php echo $st ?>';
	//	var td1='<?php echo $td ?>';
	//	var prc1='<?php echo $prc ?>';
	//	var gmin='<?php echo $rowg['min2']; ?>';
	//	var gmax='<?php echo $rowg['max2']; ?>';
		var st=new Array();
		var td=new Array();
		var prc=new Array();
		var tot=new Array();

		st=st1.split(':');
		td=td1.split(':');
		prc=prc1.split(':');
		var prca=new Array();
		var a=0;
		for(i=0;i<st.length;i++)
		{
			var tds=td[i].split('^');
			var prcs=prc[i].split('^');
			var tot1=new Array();
			for(j=0;j<tds.length;j++){
				tot1[j]=Array(tds[j],prcs[j]);
				prca[a]=prcs[j];
				a++;
			}
			tot[i]=tot1;
		}
	//	alert("tot="+prca);
			var smax = Math.max.apply(Math, prca);
			var smin = Math.min.apply(Math, prca);
			if(smax=="")
			smax=200;
			else
			smax=parseInt(smax);
			
			if(smin=="")
			smin=120;
			else
			smin=parseInt(smin);

			var rema1=parseFloat(smin)/10;
			var rema2=Math.round(rema1);
			if(rema2>rema1)
			var xtra=10;
			else
			xtra=0;
			smin=(parseFloat(rema2)*10)-parseInt(xtra);

			var dif=parseFloat(smax)-parseFloat(smin);
			var dif1=parseFloat(dif)/10;
			var dif1=Math.round(dif1)+1;
			smax=parseFloat(smin)+(parseFloat(dif1)*10);
			//smin=gmin/1;
			//smax=gmax/1;
			//alert(smin+"   ---   "+smax);
		var plot3 = $.jqplot(chart, tot, 
		{ 
		//title:'Line Style Options', 
		// Set default options on all series, turn on smoothing.
		seriesDefaults: {
				rendererOptions: {
					smooth: true
				}
			}, 
			legend: {
				show: true,
			labels:st,
				placement: 'outsideGrid'
			},
			axesDefaults: {
				tickRenderer: $.jqplot.CanvasAxisTickRenderer,
				tickOptions: {
					angle: -30,
					fontSize: '7px'
				}
			},
			axes: {
				yaxis: {
					min: smin,
					max: smax,
				
				// angle: 90
				},
				xaxis:{
					renderer:$.jqplot.DateAxisRenderer
				}
			},
			series:[ {
				lineWidth:2, 
				markerOptions: { style:"filledSquare", size:5 }
			}]
		});
	}
	</script>
	<div class="text-center my-5">
		<h3 class="title">Region Wise Graph</h3>
	</div>
        <?php
		$i=0;
		$n=ceil(12/count($grplat));
		$wid="100%";
		$hgt='500px';
		foreach($grplat as $catg=>$val){
//			echo "<br><br><br>";
//			echo $stat."  --  ".$catg."  --  ".$gdate;
			$data=graph_data($stat,$catg,'',$gdate);
			$data1=explode('#',$data);
			//$data;
		?>
        
		<h4 class="text-center my-3"><?php echo $catg; ?></h4>
        
		<div class="mb-5" id="subchart<?php echo $i+1; ?>" style="width:<?php echo $wid; ?>; height:<?php echo $hgt; ?>"></div>

		<script>
			$(document).ready(function(){
				if(document.actn.tp[0].checked) {
					graph_sub('subchart<?php echo $i+1; ?>','<?php echo $data1[3]; ?>','<?php echo $data1[4]; ?>','<?php echo $data1[5]; ?>','','');
				}
				else {
					graph_sub('subchart<?php echo $i+1; ?>','<?php echo $data1[3]; ?>','<?php echo $data1[4]; ?>','<?php echo $data1[6]; ?>','','');
				}
			});
		</script>

        <?php $i++; } ?>
	</div>			
</div>

<!--------------Footer--------------->

<?php include "tb_footer.php"; ?>
<?php include "jqplot.php"; ?>

<script src="jquery.ui-1.5.2/ui/ui.datepicker.js" type="text/javascript"></script>

<script>
	
	jQuery('#pdate').datepicker();
	jQuery('#pdate').readOnly=true;

</script>



</body>
</html>