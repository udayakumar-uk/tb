<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION['tobadmin'])) {
	$qry='';
	$yr=date('Y');
	
	if(!empty($_POST['year']))
	$yrs=$_POST['year'];
	else
	$yrs=$yr;
?>
<?php 
if(!empty($_GET['dwnld']) && $_GET['dwnld']==1) {
	 $file = "auction_csv.csv";
	 $filename=str_replace(' ','',$file);

	if (file_exists('auctions_csv/'.$file)) 
	{
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.$filename);
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public'); 
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile('auctions_csv/'.$file);
	    exit;
	 redirect("auctions_csv.php?qid=".$examc);
	}

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  	<?php include_once("head.php")?>
	<title>Auctions | Tobacco Board</title>
	<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script> 
	<script src="../jquery.ui-1.5.2/ui/ui.datepicker.js" type="text/javascript"></script>
	<link href="../jquery.ui-1.5.2/themes/ui.datepicker.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function chk() {
	document.form1.submit();
}

function gettoday() {

	var today=new Date();

	var tyear=today.getFullYear(); 

	var tmonth=today.getMonth()+1;

	var tday=today.getDate();

	var todate=tyear+"/"+tmonth+"/"+tday;

	return todate;

}

function validate_date(valdate) {

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

function check(form1) {
	if(document.form1.state.value=="") {
		alert("State Should Not Be Empty");
		document.form1.state.focus();
		return false;
	}
	else if(document.form1.pdate.value=="") {
		alert("Select Date");
		document.form1.pdate.focus();
		return false;
	}
	else if(validate_date(document.form1.pdate.value)==false) {
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

function field_chk(st) {
	if(document.getElementById(st).value=="") {
	}
}
function num_check(st) {
	if(document.getElementById(st).value!="" && isNaN(document.getElementById(st).value)==true) {
		alert("Only numbers are allowed");
		document.getElementById(st).value="";
		document.getElementById(st).focus();
		return false;
	}
	else
	return true;
}
function tots(i) {
	var bal=document.getElementById("bales"+i).value;
	var tots=document.getElementById("tot"+i).value;
	//alert(tots);
	if(num_check("bales"+i) && bal!="" && tots!="") {
		var tot=parseFloat(bal)-parseFloat(tots);
		document.getElementById("bsold"+i).value=tot;
	}
}
function totb(i) {
	var ns=document.getElementById("ns"+i).value;
	var nb=document.getElementById("nb"+i).value;
	var rr=document.getElementById("rr"+i).value;
	var cr=document.getElementById("cr"+i).value;
	
	if((ns!="" || nb!="" || rr!="" || cr!="") && (num_check("ns"+i) && num_check("nb"+i) && num_check("rr"+i) && num_check("cr"+i))) {
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

function caltot(st,st1) {
	var h=document.form1.h.value;
	var j=1;
	var a,b;
	var tot=0;
	var val;
	for(i=1;i<=h;i++) {
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
</head>

<body>

<section id="adminLayout">

	<?php include "header.php" ?>

	<?php include "sidebar.php"; ?>
	
	<main id="adminMain" class="container-fluid">
		
<?php function datepattrn($a) {
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
	function datepattrn1($a) {
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

	function numround($st,$n) {
		if($st!="")
		{
			$n1=pow(10 ,$n);
			$num=round($st*$n1)/($n1);
		}
		return $num;
	}

	function set_num($st) {
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

<?php

if( (!empty($_POST['submit'])) && ($_POST['submit']=='Submit')) {
	print_r($_POST);
		if(($_FILES['file']['name'])!="")
		{
			$target_path="auctions_csv/";
			$nam1=basename($_FILES['file']['name']);
			$len1=strlen($nam1);
			$pos1=strrpos($nam1,'.');
			$sub1=substr($nam1,$pos1,$len1);
			$mapimg1=$nam1;
			$target_pathsm1=$target_path.$mapimg1;
			if(file_exists($target_pathsm1))
			{
			  unlink($target_pathsm1);
			}
			move_uploaded_file($_FILES['file']['tmp_name'],$target_pathsm1);
			$i=0;	
			$file = fopen("auctions_csv/".$mapimg1,"r");
			$i=0;
			if($file !== FALSE) 
			{
			  		
			  while(! feof($file)) 
			 {
			   $cols = fgetcsv($file, 0, ",");
			   $lines[]=$cols;
			   //echo "<br>ival=".$i;
			   //print_r($cols);
			   if($cols[0]!="")
			   {
				  if($i >=0)
				  {	
					if($cols[1]!="")
					{
						$cols[1]=$cols[1];
					}
					else
					{
						$cols[1]=0;
					}
					
					$sel=executework("select * from tob_platform where apfno='".$cols[1]."'");
					
					$row1=@mysqli_fetch_array($sel);
					$tvalue=(float)$cols[4]*(float)$cols[5];
					  
					  $get_data=executework("select * from tob_auction where year='".$_POST['year']."' and tdate='".date('Y-m-d',strtotime($cols[0]))."' and platf='".$row1['id']."'");
					  
						//echo "<br>dt=".$cols[0];
					   if(@mysqli_num_rows($get_data)>0)
					   {
					   $row=@mysqli_fetch_array($get_data);
					   $updt=executework("update tob_auction set year='".$_POST['year']."',tdate='".date('Y-m-d',strtotime($cols[0]))."',platf='".$row1['id']."',apf='".$cols[1]."',bsold='".$cols[3]."',qsold='".$cols[4]."',aprice='".$cols[5]."',tvalue='".$tvalue."' where year='".$_POST['year']."' and tdate='".date('Y-m-d',strtotime($cols[0]))."' and platf='".$row['id']."'");
					  // $updt=executework("update tob_auction set year='".$_POST['year']."',tdate='".date('Y-m-d',strtotime($cols[0]))."',platf='".$row1['id']."',apf='".$cols[1]."',aqty='',eqty='',cdate='',edate='',bales='',ns='',nb='',rr='',cr='',tot='',bsold='".$cols[3]."',hbid='',lbid='',buyers='',qsold='".$cols[4]."',aprice='".$cols[5]."',tvalue='".$tvalue."' where year='".$_POST['year']."' and tdate='".date('Y-m-d',strtotime($cols[0]))."' and platf='".$row['id']."'");
					   	//echo "<br><br>update tob_auction set year='".$_POST['year']."',tdate='".date('Y-m-d',strtotime($cols[0]))."',platf='".$row1['id']."',apf='".$cols[1]."',aqty='',eqty='',cdate='',edate='',bales='',ns='',nb='',rr='',cr='',tot='',bsold='".$cols[3]."',hbid='',lbid='',buyers='',qsold='".$cols[4]."',aprice='".$cols[5]."',tvalue='".$tvalue."' where year='".$_POST['year']."' and tdate='".date('Y-m-d',strtotime($cols[0]))."' and platf='".$row['id']."'";
					   }
					   else 
					   {
					   //echo ("<br><br>insert into tob_auction (id,year,tdate,platf,apf,aqty,eqty,cdate,edate,bales,ns,nb,rr,cr,tot,bsold,hbid,lbid,buyers,qsold,aprice,cprice,tvalue,isactive) values('','".$_POST['year']."','".date('Y-m-d',strtotime($cols[0]))."','".$row1['id']."','".$cols[1]."','','','','','','','','','','','".$cols[3]."','','','','".$cols[4]."','".$cols[5]."','','','1')");
					 //  exit();
					 
					// echo "<br>insert into tob_auction (year,tdate,platf,apf,bsold,qsold,aprice,tvalue,isactive) values('".$_POST['year']."','".date('Y-m-d',strtotime($cols[0]))."','".$row1['id']."','".$cols[1]."','".$cols[3]."','".$cols[4]."','".$cols[5]."','".$tvalue."','1')";
					   $ins=executework("insert into tob_auction (year,tdate,platf,apf,bsold,qsold,aprice,tvalue,isactive) values('".$_POST['year']."','".date('Y-m-d',strtotime($cols[0]))."','".$row1['id']."','".$cols[1]."','".$cols[3]."','".$cols[4]."','".$cols[5]."','".$tvalue."','1')");

					}
				  }
				}				
			   $i++;
			 }
			 
			 
			 fclose($file);
				}
			redirect("auctions_csv.php?bsuc=1");
		}
}?>



	<div class="row">
		<h2 class="admin-title col">Add Auctions</h2>
	
		<div class="col-auto">
			<a href="auctions_csv.php?dwnld=1" class="btn btn-secondary">Download Sample File</a>
		</div>
		<?php if(!empty($_GET['succ']) && $_GET['succ']==1){ ?>
			<div class="col-auto">
				<div class="alert alert-success d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
					<span class="flex-shrink-0 me-2 material-symbols-rounded">check_circle</span>
					<span> Data Stored  Successfully</span>
				</div>
			</div>
		<?php } ?>
	</div>



	<form action="auctions_csv.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check(this);">

	

	<div class="row">
		
		<div class="form-group col-lg-3 col-md-4">
			<label for="state" class="form-label">State</label>
			<select name="state" id="state" class="form-select">
				<option value="">Select</option>
				<option value="Andhra Pradesh" selected="selected">Andhra Pradesh</option>
				<option value="Karnataka">Karnataka</option>
			</select>
          	<?php
				if(!empty($stat)) { ?>
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
			<?php } ?>      
		</div>
		<div class="form-group col-lg-3 col-md-4">
			<label for="year" class="form-label">Auction Year</label>
			<select name="year" id="year" onchange="chk();" class="form-select">
				<?php
					for($i=2009;$i<=$yr;$i++) { ?>
					<option value="<?php echo $i ?>"><?php echo $i ?></option>
				<?php } ?>
			</select>
			<?php
			if(!empty($yrs)) { ?>
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
        <?php }
			
			if(!empty($_POST['plats']) && !empty($_POST['year'])) {		
				$selauct=executework("select * from tob_auct where platf=".($_POST['plats'])." and year=".($_POST['year']));
				$cnta=@mysqli_num_rows($selauct);
				$rowa=@mysqli_fetch_array($selauct);
			}  ?>   
		</div>
		<div class="form-group col-lg-6 col-md-4">
			<label for="file" class="form-label">Upload CSV</label>
			<div class="input-group form-group">
				<input name="file" type="file" id="file" class="form-control">
				<label class="input-group-text" for="file">Upload CSV</label>
			</div>
		</div>
	</div>
		
	<div class="submit-button text-end">
		<input type="submit" class="btn btn-primary" name="Submit" value="Submit" />
	</div>
			
	
</form>

</main>

</section>


<script>
pdate='<?php if(!empty($dates1)) echo $dates1 ?>';
/*if(pdate!="") {
	var pdates=new Array();
	pdates=pdate.split(',');
	for(k=0;k<pdates.length;k++) {
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

<?php include_once("footer.php");?>

<?php } else { ?>
	<script language="javascript">parent.location.href="index.php";</script>
<?php } ?>


</body>
</html>
