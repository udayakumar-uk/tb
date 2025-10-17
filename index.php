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
<html lang="en">
<head>
	<title>Tobacco Board</title>
	
	<!-- slider -->
	<link rel="stylesheet" type="text/css" href="./slick/slick.css">
	<link rel="stylesheet" type="text/css" href="./slick/slick-theme.css">

	<?php include "head.php"; ?>

</head>
<body>

<?php include "tb_header.php"; ?>

<?php 
	$selatest=executework("select * from tob_latest where archive=0 order by id desc limit 8");
	$lnews='';
	$divider=' <span class="text-light px-3"> | </span> ';
	$lnews_arr = array();
	while($rowlt=@mysqli_fetch_array($selatest)){
		if($rowlt['tfile']!="") {
			$tf="<a class='d-inline-block' href='tbdata/latest/".$rowlt['tfile']."' target=_blank >";
			$tf1="</a>";
		} else {
			$tf="";
			$tf1="";
		}
		$lnews_arr[] = $tf.$rowlt['description'].$tf1;
	}
	$lnews = implode($divider, $lnews_arr);
?>




<main>
	<section class="slider-section">

	
		<marquee class="d-block py-2 bg-goldenbrown text-white" scrollamount="5" direction="left" onMouseOver="this.stop();" onMouseOut="this.start();">
			<?php echo $lnews ?>
		</marquee>

		<div id="homeBanner" class="carousel slide" data-bs-ride="false">
			<div class="carousel-indicators">
				<button type="button" data-bs-target="#homeBanner" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
				<button type="button" data-bs-target="#homeBanner" data-bs-slide-to="1" aria-label="Slide 2"></button>
				<button type="button" data-bs-target="#homeBanner" data-bs-slide-to="2" aria-label="Slide 3"></button>
				<button type="button" data-bs-target="#homeBanner" data-bs-slide-to="3" aria-label="Slide 4"></button>
			</div>
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="./img/slider/slider-1.jpg" class="d-block w-100" alt="Tobacco Board Image">
				</div>
				<div class="carousel-item">
					<img src="./img/slider/slider-4.jpg" class="d-block w-100" alt="Tobacco Board Image">
				</div>
				<div class="carousel-item">
					<img src="./img/slider/slider-2.jpg" class="d-block w-100" alt="Tobacco Board Image">
				</div>
				<div class="carousel-item">
					<img src="./img/slider/slider-3.jpg" class="d-block w-100" alt="Tobacco Board Image">
				</div>
			</div>
			<button class="carousel-control-prev" type="button" data-bs-target="#homeBanner" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></strong>
				<span class="visually-hidden">Previous</strong>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#homeBanner" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></strong>
				<span class="visually-hidden">Next</strong>
			</button>
		</div>
	</section>

	
	<section class="vismis-section pb-5 mb-4">
		<div class="container">
			<div class="row m-0">
				<div class="col-md-6 p-0">
					<div class="vis-wrapper vismis-wrapper box-shadow box-shadow-lg">
						<h3 class="sub-title text-white">Mission</h3>
						<p>To strive for the overall development of tobacco growers and the Indian Tobacco Industry.</p>
					</div>
				</div>
				<div class="col-md-6 p-0">
					<div class="mis-wrapper vismis-wrapper box-shadow box-shadow-lg">
						<h3 class="sub-title text-white">Vision</h3>
						<p>Tobacco Board is committed to accomplishing its role - the expressed will of Parliament - for the smooth functioning of a vibrant farming system, fair and remunerative prices to tobacco growers and export promotion.</p>
					</div>
				</div>
			</div>
		</div>
	</section>


	<section class="profile-section pb-4 mb-4 mb-md-5" id="main-content">
		<div class="container">
			<div class="profile-content text-center">
				<div class="col">
					<h1 class="title no-dash">WELCOME TO TOBACCO BOARD</h1>
					<p>Tobacco is one of the important commercial crops grown in India. It provides employment directly and indirectly to<strong class="text-coalgreen"> 45.7</strong> million people and <strong class="text-coalgreen">Rs.12,005.89 crore </strong>in terms of foreign exchange to the National exchequer during 2023-24. India has a prominent place in the production of tobacco in the world. During <strong class="text-coalgreen">2022</strong>, India stands as<strong class="text-coalgreen"> 2nd largest country </strong>in Production <strong class="text-coalgreen">(FAO Stat data, 2022)</strong>, <strong class="text-coalgreen">2nd Largest Exporter</strong> (in quantity terms) and <strong class="text-coalgreen">5th Largest Exporter </strong>of unmanufactured tobacco (in value terms) in the world <strong class="text-coalgreen">(ITC Trademap data 2022)</strong>. India produces different styles of Flue Cured Virginia tobacco, which vary in their physical and chemical characteristics.</p>
				</div>
				<div class="profile-wrapper row justify-content-center py-3">
					<div class="col-md-4">
						<a href="./profile/Yashwanth_Profile.pdf" target="_blank" class="profile-card box-shadow h-100 flex-row text-start">
							<img src="./img/profile/Shri_Yashwanth_Kumar_Chidipothu.jpeg" class="card-img-top border flex-shrink-0" alt="Shri Yashwanth Kumar Chidipothu">
							<div class="card-body">
								<h4 class="card-title fs-6 text-dark">Shri Yashwanth Kumar Chidipothu</h4>
								<small class="card-text text-goldenbrown lh-sm fw-600">CHAIRMAN</small>
							</div>
						</a>
					</div>
					<div class="col-md-4">
						<a href="javascript:;" class="profile-card box-shadow h-100 flex-row text-start">
							<img src="./img/profile/Ms_Vishwasree_B_IAS.jpeg" class="card-img-top border flex-shrink-0" alt="Ms. Vishwasree B, IAS">
							<div class="card-body">
								<h4 class="card-title fs-6 text-dark">Ms.Vishwasree B, IAS</h4>
								<small class="card-text text-goldenbrown lh-sm fw-600">EXECUTIVE DIRECTOR</small>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>


	<section class="priceTable-section py-5 mb-4 mb-md-5">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">

					<div class="title-height">
						<h3 class="sub-title text-white">FCV TOBACCO AUCTION PRICES</h3>
					</div>
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
				</div>
				
				<div class="col-lg-6">
					<?php
						$variety=array('FCV','Non FCV', 'Refuse Tobacco', 'Tobacco Products', 'Un Manufactured Tobacco');
						$sel=executework("select * from tob_homexport");
						$data=array();
						while($row=@mysqli_fetch_array($sel))
						{
							$vart=$row['variety'];
							$data[$vart]=$row;
						}
						
						$selid=executework("select * from tob_gsettings where graph='Action Graph'");
						$cnt=@mysqli_num_rows($selid);
						$row=@mysqli_fetch_array($selid);
						
						$fmn=$row['export_fmonth'];
						$fyr=$row['export_fyear'];
						$tmn=$row['export_tmonth'];
						$tyr=$row['export_tyear'];

						$fcv=array('FCV','Non FCV','Refuse Tobacco','Tobacco Products','Unmanufactured Tobacco');
						$fcv1=array('FCV','Non FCV','Refuse Tobacco','Tobacco Products','Un manufactured Tobacco');
						$seldl=executework("select * from tob_dollar where id=1");
						$rowdl=@mysqli_fetch_array($seldl);
						$usd=$rowdl['dollar'];
						$selcm=executework("select month,year from tob_export order by year desc,month desc limit 1");
						$rowcm=@mysqli_fetch_array($selcm);
					?>
					<div class="d-flex justify-content-between">
						<div class="title-height">
							<h3 class="sub-title text-white">EXPORT PERFORMANCE</h3>
						</div>
						<div class="text-white text-end" style="font-size: 14px; line-height: 1.4;">
							<strong class="fs-5">Current Month - <?php echo strtoupper(date('M y',strtotime($tyr."-".$tmn."-01"))); ?></strong>
							<br>
							<small>Cumulative - <?php echo date('M y',strtotime($fyr."-".$fmn."-01"))." - ".date('M y',strtotime($tyr."-".$tmn."-01")); ?></small>
						</div>
					</div>
					<div class="table-responsive">
						
						<table class="table table-bordered bg-white overflow-hidden rounded-4 no-cellspace">
							<thead>
								<tr>
									<th>Variety</th>
									<th class="text-end">Qty(M.Tons)</th>
									<th class="text-end">Value(Rs Cr.)</th>
									<th class="text-end">Value(M.USD)</th>
								</tr>
								<?php 
								for($i=0;$i<5;$i++) {
									$vart=$variety[$i];
								?>
								<tr>
									<th><?php echo $vart; ?></th>
									<td class="text-end">
										<p class="text-primary lh-1 fw-600 m-0 intersemibold"><?php echo round($data[$vart]['cqty']); ?></p>
										<small class="text-secondary d-inline-block"><?php echo round($data[$vart]['mqty']); ?></small>
									</td>
									<td class="text-end">
										<p class="text-primary lh-1 fw-600 m-0 intersemibold"><?php echo round($data[$vart]['cvalr']); ?></p>
										<small class="text-secondary d-inline-block"><?php echo round($data[$vart]['mvalr']); ?></small>
									</td>
									<td class="text-end">
										<p class="text-primary lh-1 fw-600 m-0 intersemibold"><?php echo round($data[$vart]['cvald']); ?></p>
										<small class="text-secondary d-inline-block"><?php echo round($data[$vart]['mvald']); ?></small>
									</td>
								</tr>
								<?php } ?>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>

				</div>
			</div>
		</div>
	</section>

	<section class="statics-section pb-4 mb-4 mb-md-5">
		<div class="container">
			<div class="row">
				<div class="col-md-4 my-3">
					<div class="card box-shadow">
						<div class="card-body">
							<span class="card-icon material-symbols-rounded d-block">bar_chart</span>
							<h5 class="card-title no-dash interbold mt-2 mb-3">STATISTICS</h5>

							<ul class="card-list">
								<?php 
								$arr=array('Production Data','Auction Data','Exports Data','Extension Data');
								for($i=0;$i<count($arr);$i++) {
									$archive="where archive='0' and stype='".$arr[$i]."'";
									$select=executework("select * from tob_statistics ".$archive." order by id desc limit 2");
									$count=@mysqli_num_rows($select);
									$rowc=@mysqli_fetch_array($select);
									if($count>0 && $rowc['tdate']>=date('Y-m-d', strtotime(date('Y-m-d'). ' - 5 days')))
										$new=1;
									else
										$new=0;
									?>
								<li>
									<a href="statistics.php?stype=<?php echo $arr[$i]; ?>" class="d-flex justify-content-between align-items-center">
										
										<span class="position-relative">
											<?php echo $arr[$i]; ?>
											<?php if($new==1){ ?> 
												<span class="position-absolute top-50 start-100 translate-middle p-1 ms-2 bg-danger rounded-circle">
													<span class="visually-hidden">New alerts</span>
												</span>
											<?php } ?> 
										</span>
										<!-- <img src="new.png" width="25" height="auto" /> -->
										<span class="material-symbols-rounded">arrow_forward</span>
									</a>
								</li>

								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-4 my-3">
					<div class="card box-shadow">
						<div class="card-body">
							<span class="card-icon material-symbols-rounded d-block">pie_chart</span>
							<h5 class="card-title no-dash interbold mt-2 mb-3">CIRCULARS</h5>


							<ul class="card-list">
								<?php 
								$arr=array('Grower Community','Trader Community','Official');
								for($i=0;$i<count($arr);$i++) {
									$archive="where archive='0' and stype='".$arr[$i]."'";
									$select=executework("select * from tob_circulars ".$archive." order by id desc limit 1");
									$count=@mysqli_num_rows($select);
									$rowc=@mysqli_fetch_array($select);
									if($count>0 && $rowc['ndate']>=date('Y-m-d', strtotime(date('Y-m-d'). ' - 5 days')))
									$new=1;
									else
									$new=0;
								?>
								
									<li>
										<a href="circulars.php?stype=<?php echo $arr[$i]; ?>" class="d-flex justify-content-between align-items-center">
											<span class="position-relative">
											<?php echo $arr[$i]; ?>
											<?php if($new==1){ ?> 
												<span class="position-absolute top-50 start-100 translate-middle p-1 ms-2 bg-danger rounded-circle">
													<span class="visually-hidden">New alerts</span>
												</span>
											<?php } ?> 
											</span> 
											<span class="material-symbols-rounded">arrow_forward</span>
										</a>
									</li>
								
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-4 my-3">
					<div class="card box-shadow">
						<div class="card-body">
							<span class="card-icon material-symbols-rounded d-block">monitoring</span>
							<h5 class="card-title no-dash interbold mt-2 mb-3">PUBLICATIONS</h5>
							<ul class="card-list">
								<?php 
									$archive="where home=1 and archive='0'";
									$select=executework("select * from tob_publications ".$archive." order by id desc limit 2");
									$count=@mysqli_num_rows($select);
									while($rown=@mysqli_fetch_array($select))
									{
										if($rown['tfile']="" && $rown['tfile']='#')
										$link="tbdata/publicationsfiles/".$rown['tfile'];
										else
										$link=$rown['tfile'];
										$fcheck=explode(".",$rown['tfile']);
									?>
										<li>
											<a href="./tbdata/pdf/<?php echo $rown['hdescription']; ?>" target="<?php  if($link!="#"){?>_blank<?php  }?>" class="d-flex justify-content-between align-items-center">
												<span><?php echo $rown['description']; ?></span>
												<span class="material-symbols-rounded">arrow_forward</span>
											</a>
										</li>
									<?php } ?>
								<li><a href="publications.php" class="btn btn-primary box-shadow box-shadow-lg mt-3 d-block">View More <span class="material-symbols-rounded align-middle">arrow_forward</span></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	
	<section class="tender-section pb-4 mb-4 mb-md-5 py-4 py-md-5">

		<div class="title-height text-center">
			<h3 class="title text-white">Active Tenders</h3>
		</div>



		<div class="container">
			<div class="row py-4">
				<?php 
					$archive1="where home=1 and archive='0'";
					$select=executework("select * from tob_tender ".$archive1." order by id desc limit 4");
					$count=@mysqli_num_rows($select);
					if($count>0) {
						while($rown=@mysqli_fetch_array($select)) {
							if($rown['mfile']!="") {
								$link1="tbdata/tenderfiles/$rown[mfile]";
								$link="reg.php?pg=".$rown['mfile']."&id=".$rown['id'];
							} else {
								$link="#";
							}
							if($rown['subtitle1']!='' && $rown['tfile']!="") {
								$links1="reg.php?pg=".$rown['tfile']."&id=".$rown['id'];
							} else {
								$links1="#";
							}
							if($rown['subtitle2']!='' && $rown['sfile']!="") {
								$links2="reg.php?pg=".$rown['sfile']."&id=".$rown['id'];
							} else {
								$links2="#";
							}
							$fcheck=explode(".",$rown['tfile']);
							// Card design
							?>
							<div class="col-md-6 col-lg-3">
								<div class="card h-100 box-shadow shadow-none">
									<div class="card-body d-flex flex-column justify-content-between">
										<div class="card-title mb-2">
											<?php if($rown['isactive']=='0') { ?>
												<a href="javascript:;" class="line-clamp line-clamp-3" onClick="show_pop('<?php echo $link ?>')">
													<?php echo $rown['description']; ?>
												</a>
											<?php } else { ?>
												<a href="javascript:;" class="line-clamp line-clamp-3" class="text-dark">
													<?php echo $rown['description']; ?>
												</a>
											<?php } ?>
										</div>

										<?php if($rown['subtitle1']!='') { ?>
											<a href="javascript:;" <?php if($links1!='#' && $links1!='') { ?>onClick="show_pop('<?php echo $links1; ?>');" <?php } ?> class="mt-2 lh-sm badge bg-goldenbrown text-white px-2 py-1 text-uppercase line-clamp line-clamp-2">
												<?php echo $rown['subtitle1']; ?>
											</a>
										<?php } ?>
										<?php if($rown['subtitle2']!='') { ?>
											<a href="javascript:;" <?php if($links2!='#' && $links2!='') { ?>onClick="show_pop('<?php echo $links2 ?>')" <?php } ?> class="mt-2 lh-sm badge bg-goldenbrown text-white px-2 py-1 text-uppercase line-clamp line-clamp-2">
												<?php echo $rown['subtitle2']; ?>
											</a>
										<?php } ?>

										<?php if(!empty($rown['closing_date'])) { ?>
											<div class="mt-3">
												<span class="d-block text-secondary small">Closing Date:</span>
												<span class="fw-bold text-danger">
													<?php echo date('d M Y', strtotime($rown['closing_date'])); ?>
												</span>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
						<?php 
						}
					}
				?>
			</div>
			<div class="container text-center">
				<a href="tenders.php" class="btn btn-secondary box-shadow box-shadow-lg mt-4">See All Tenders <span class="material-symbols-rounded align-middle">arrow_forward</span></a>
			</div>

		</div>
	</section>

	
	<section class="gallery-section py-4 mb-4 mb-md-5">
		<div class="container text-center">
			<h2 class="title">Gallery</h2>
			
			<section class="gallery-wrapper slider my-4">
				<div class="slider-wrapper">
					<img src="./tbdata/photogallery/oimages/20.jpg" alt="Gallery Image" class="rounded-3">
				</div>
				<div class="slider-wrapper">
					<img src="./tbdata/photogallery/oimages/21.jpg" alt="Gallery Image" class="rounded-3">
				</div>
				<div class="slider-wrapper">
					<img src="./tbdata/photogallery/oimages/23.jpg" alt="Gallery Image" class="rounded-3">
				</div>
				<div class="slider-wrapper">
					<img src="./tbdata/photogallery/oimages/24.jpg" alt="Gallery Image" class="rounded-3">
				</div>
				<div class="slider-wrapper">
					<img src="./tbdata/photogallery/oimages/25.jpg" alt="Gallery Image" class="rounded-3">
				</div>
				<div class="slider-wrapper">
					<img src="./tbdata/photogallery/oimages/26.jpg" alt="Gallery Image" class="rounded-3">
				</div>
				<div class="slider-wrapper">
					<img src="./tbdata/photogallery/oimages/27.jpg" alt="Gallery Image" class="rounded-3">
				</div>
				<div class="slider-wrapper">
					<img src="./tbdata/photogallery/oimages/29.jpg" alt="Gallery Image" class="rounded-3">
				</div>
				<div class="slider-wrapper">
					<img src="./tbdata/photogallery/oimages/30.jpg" alt="Gallery Image" class="rounded-3">
				</div>
				<div class="slider-wrapper">
					<img src="./tbdata/photogallery/oimages/32.jpeg" alt="Gallery Image" class="rounded-3">
				</div>
			</section>
			
			<a href="javascript:;" class="btn btn-primary box-shadow box-shadow-lg mt-4">See More <span class="material-symbols-rounded align-middle">arrow_forward</span></a>
		</div>
	</section>

	
	<section class="register-section pb-4 mb-4 mb-md-5">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-4 col-lg-3 pb-3">
					<a href="http://tobaccoboard.in" target="_blank" class="reg-card reg-card-1 d-flex align-items-center gap-3 p-3 box-shadow">
						<span class="reg-icon material-symbols-rounded">captive_portal</span>
						<div class="reg-text lh-sm">
							<strong class="d-block text-dark">Online Traders</strong>
							<small class="text-secondary">Registration & Return</small>
						</div>
					</a>
				</div>
				<div class="col-md-4 col-lg-3 pb-3">
					<a href="https://www.tobaccoboard-eoffice.com/tb-grower/" target="_blank" class="reg-card reg-card-2 d-flex align-items-center gap-3 p-3 box-shadow">
						<span class="reg-icon material-symbols-rounded">eco</span>
						<div class="reg-text lh-sm">
							<strong class="d-block text-dark">FCV Tobacco</strong>
							<small class="text-secondary">Grown online Registration & Return</small>
						</div>
					</a>
				</div>
				<div class="col-md-4 col-lg-3 pb-3">
					<div class="reg-card reg-card-3 no-link d-flex align-items-center gap-3 p-3 box-shadow">
						<span class="reg-icon material-symbols-rounded">warning</span>
						<div class="reg-text lh-sm">
							<strong class="d-block text-dark">Emergency Security Alert</strong>
							<a href="./tbdata/pdf/Critical_Advisory_in_view_of_G20_Summit.pdf" target="_blank">&#8226;<small class="lh-1 mt-0">Attachment 1</small></a>
							<a href="./tbdata/pdf/Advisory_CIAD_2023_S3.pdf" target="_blank">&#8226;<small class="lh-1 mt-0">Attachment 2</small></a>
							<a href="./tbdata/pdf/NR_239_GR_500.jpg" target="_blank">&#8226;<small class="lh-1 mt-0">Attachment 3</small></a>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-lg-3 pb-3">
					<div class="reg-card reg-card-4 d-flex align-items-center gap-3 p-3 box-shadow">
						<span class="reg-icon material-symbols-rounded">beenhere</span>
						<div class="reg-text lh-sm">
							<strong class="d-block text-dark">Stay Safe Online</strong>
							<a href="https://www.mygov.in/staysafeonline" target="_blank">&#8226;<small class="lh-1 mt-0">Awareness topics</small></a>
							<a href="https://staysafeonline.in/awareness-material" target="_blank">&#8226;<small class="lh-1 mt-0">Awareness material</small></a>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-lg-3 pb-3">
					<a href="https://www.cvc.gov.in/?q=guidelines/tender-guidelines" target="_blank" class="reg-card reg-card-5 d-flex align-items-center gap-3 p-3 box-shadow">
						<span class="reg-icon material-symbols-rounded">book</span>
						<div class="reg-text lh-sm">
							<strong class="d-block text-dark">CVC guidelines for Tender process</strong>
						</div>
					</a>
				</div>
				<div class="col-md-4 col-lg-3 pb-3">
					<a href="javascript:;" data-bs-toggle="modal" data-bs-target="#videoPopup" class="reg-card reg-card-6 d-flex align-items-center gap-3 p-3 box-shadow">
						<span class="reg-icon material-symbols-rounded">video_library</span>
						<div class="reg-text lh-sm">
							<strong class="d-block text-dark">Tobacco Board PIDPI</strong>
						</div>
					</a>
				</div>
				<div class="modal fade" id="videoPopup" tabindex="-1" aria-labelledby="videoPopupLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header pb-0 border-0">
								<h1 class="modal-title fs-5" id="videoPopupLabel">Tobacco Board PIDPI</h1>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<video class="img-fluid" controls id="CVC-PIDPI-VAW-2023-comp">
									<source src="./video/CVC-PIDPI-VAW-2023-comp.mp4" type="video/mp4">	
									Your browser does not support the video tag.
								</video> 
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

</main>


<!--------------Footer--------------->
<?php  include "tb_footer.php"; ?>

<script src="./slick/slick.js"></script>

<script>

$(document).on('ready', function() {

	$(".gallery-wrapper").slick({
		arrows: false,
		infinite: true,
		// centerMode: true,
		slidesToShow: 4,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 4000,
		responsive: [
			{
				breakpoint: 992,
				settings: {
					slidesToShow: 3,
				}
			},
			{
				breakpoint: 576,
				settings: {
					slidesToShow: 2,
				}
			}
		]
	});
});

</script>

</body>
</html>