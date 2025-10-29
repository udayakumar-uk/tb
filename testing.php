<?php 
	ob_start();
	@session_start();
	include "include/include.php";
	$selectp=executework("select * from tob_album_title,tob_images where tob_album_title.id=tob_images.titleid and tob_images.cover=1 order by tob_album_title.position desc,tob_images.cover,tob_images.position desc");
	$countp=@mysqli_num_rows($selectp);
	$base_url="http://".$_SERVER['SERVER_NAME'];
	$base_path=$_SERVER['DOCUMENT_ROOT'];
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
	<title>Tobacco Board</title>
	
	<!-- slider -->
	<link rel="stylesheet" type="text/css" href="./slick/slick.css">
	<link rel="stylesheet" type="text/css" href="./slick/slick-theme.css">

	<?php include "head.php"; ?>

</head>
<body>

<?php include "tb_header.php"; ?>

		<div class="container">

<div class="table-responsive">
    <table class="table table-bordered bg-white overflow-hidden rounded-4">
        <thead>
            <tr>
                <th scope="col">State</th>
                <th scope="col">Year</th>
                <th scope="col" style="min-width: 100px;">Date</th>
                <th scope="col">Days</th>
                <th scope="col">Qty(M.Kgs)</th>
                <th scope="col">Avg.Price</th>
            </tr>
        </thead>
        <tbody>
            
            <?php
                $statess=array('Andhra Pradesh','Karnataka');
                $states1=array('AP','KARNATAKA');
                $catgs[0]=array('NBS','NLS','SBS','SLS');
                $catgs[1]=array('Mysore','Periyapatna');
                $catgs1[0]=array('NBS','NLS','SBS','SLS');
                $catgs1[1]=array('Mysore','P.patna');
            ?>

            <?php 
                for($i=0;$i<2;$i++){
                $selauct=executework("select * from tob_auctsetting where state='".$statess[$i]."' and status='1'");
                $rowc=@mysqli_fetch_array($selauct);
            ?>

            <tr>
                <th scope="row" rowspan="2"><?php echo strtoupper($statess[$i]); ?></th>
                <td><?php echo $rowc['year']."(Final)"; ?></td>
                <td><?php echo date('d-m-Y',strtotime($rowc['sdate'])); ?></td>
                <td><?php echo $rowc['days']; ?></td>
                <td><?php echo $rowc['qty']; ?></td>
                <td><?php echo $rowc['avg']; ?></td>
            </tr>

            <?php
                $sel3=executework("select * from tob_auction,tob_platform where tob_auction.platf=tob_platform.id and tob_platform.state='".$statess[$i]."' and date(tdate)<='".date('Y-m-d')."' and tob_platform.isactive=1 order by tob_auction.tdate desc limit 1");
                $row=@mysqli_fetch_array($sel3);
                $adate=$row['tdate'];
                $yr=$row['year'];
                $selycnt=executework("select distinct count(distinct tdate) as cnt from tob_platform,tob_auction where tob_platform.id=tob_auction.platf and tob_platform.state='".$statess[$i]."' and date(tdate)<='".date('Y-m-d')."' and tob_auction.year=".$yr." order by cnt desc limit 1");
                $rowycnt=@mysqli_fetch_array($selycnt);
                if(!empty($rowycnt['cnt']))
                $days=$rowycnt['cnt'];
            
                $qrv=" and year ='".$yr."'";
                $selsm=executework("select sum(bsold) as bsold,sum(qsold) as qsold,sum(tvalue) as tval,sum(aprice) as apric from tob_auction where platf in(select id from tob_platform where state='".$statess[$i]."')".$qrv);
                $rows=@mysqli_fetch_array($selsm);
                $avg=$rows['tval']/$rows['qsold'];
                if($rows['qsold']>0)
                {
                    $yrr=$yr;
            ?>
            <tr>
                <td><a href="auctions.php?state=<?php echo $statess[$i]; ?>" class="text-primary"><?php echo $yrr; ?></a></td>
                <td><a href="auctions.php?state=<?php echo $statess[$i]; ?>" class="text-primary"><?php echo date('d-m-Y',strtotime($adate)); ?></a></td>
                <td><a href="auctions.php?state=<?php echo $statess[$i]; ?>" class="text-primary"><?php echo $days; ?></a></td>
                <td><a href="auctions.php?state=<?php echo $statess[$i]; ?>" class="text-primary"><?php echo round($rows['qsold']/1000000,2); ?></a></td>
                <td><a href="auctions.php?state=<?php echo $statess[$i]; ?>" class="text-primary"><?php echo round($avg,2); ?></a></td>
            </tr> 

            <?php } ?>
        <?php } ?>

        </tbody>
    </table>
</div>

	<section><h2>Tea Auction Data Visualization</h2>

  <div class="chart-container">
    <h3>Bar Chart – Quantity (M.Kgs)</h3>
    <div id="barChart" style="height:400px; width:700px;"></div>
  </div>

  <div class="chart-container">
    <h3>Pie Chart – Average Price (₹)</h3>
    <div id="pieChart" style="height:400px; width:500px;"></div>
  </div>

	</section>
</div>


<!--------------Footer--------------->
<?php include "tb_footer.php"; ?>
<?php include "graph.php"; ?>


<!-- const data = [
  { state: "ANDHRA PRADESH", year: "2024(Final)", qty: 215.35, price: 288.65, days: 179, date: "14-10-2024"}, 
  { state: "ANDHRA PRADESH", year: "2025", qty: 158.81, price: 258.2, days: 151, date: "13-09-2025"}, 
  { state: "KARNATAKA", year: "2023(Final)", qty: 88.86, price: 257.46, days: 125, date: "14-03-2024"}, 
  { state: "KARNATAKA", year: "2024", qty: 84.86, price: 257.62, days: 145, date: "11-04-2025"}
]; -->

<script>
const data = [
  { state: "ANDHRA PRADESH", year: "2024(Final)", qty: 215.35, price: 288.65, days: 179, date: "14-10-2024"}, 
  { state: "ANDHRA PRADESH", year: "2025", qty: 158.81, price: 258.2, days: 151, date: "13-09-2025"},
  { state: "KARNATAKA", year: "2023(Final)", qty: 88.86, price: 257.46, days: 125, date: "14-03-2024"}, 
  { state: "KARNATAKA", year: "2024", qty: 84.86, price: 257.62, days: 145, date: "11-04-2025"}
];



// ---- Bar Chart ----
const barValues = data.map(d => d.qty);
const barLabels = data.map(d => `${d.state} (${d.year})`);

$.jqplot('barChart', [barValues], {
  title: 'Quantity (M.Kgs) by State & Year',
  seriesDefaults: {
    renderer: $.jqplot.BarRenderer,
    rendererOptions: { barWidth: 30, varyBarColor: true },
    pointLabels: { show: true }
  },
  axes: {
    xaxis: {
      renderer: $.jqplot.CategoryAxisRenderer,
      ticks: barLabels
    },
    yaxis: {
      label: 'Qty (M.Kgs)'
    }
  },
  highlighter: {
    show: true,
    tooltipAxes: 'y',
    tooltipContentEditor: function(str, seriesIndex, pointIndex, plot) {
      const item = data[pointIndex];
      return `
        <b>${item.state} (${item.year})</b><br>
        Date: ${item.date}<br>
        Days: ${item.days}<br>
        Qty: ${item.qty} M.Kgs<br>
        Price: ₹${item.price}
      `;
    }
  },
  cursor: { show: false }
});

// ---- Pie Chart ----
const pieData = data.map(d => [ `${d.state} (${d.year})`, d.qty ]);

$.jqplot('pieChart', [pieData], {
  title: 'Qty Distribution by State & Year',
  seriesDefaults: {
    renderer: $.jqplot.PieRenderer,
    rendererOptions: { showDataLabels: true }
  },
  
  legend: { show: true, location: 'e' }
});
</script>



</body>
</html>