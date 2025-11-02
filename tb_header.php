<?php
$base_url="https://".$_SERVER['SERVER_NAME'];
function remove_tag($string,$tag)
{	
	$string=str_replace('<'.$tag.'>','',$string,$temp=1);
	$string=str_replace("<\\".$tag.'>','',$string,$temp=1);
	return $string;
}
function remove_firstp($string)
{	
	$string=str_replace('<p>','',$string);
	$string=str_replace('<\p>','',$string);
	return $string;
	// urldecode($string);
}
?>


<header>
	
<?php include 'tb_header_topbar.php' ?>

	<nav class="navbar navbar-expand-xl sticky-top flex-wrap py-0">
		<div class="logo-section flex-wrap w-100">
			<div class="container-fluid">
				<div class="d-flex align-items-center justify-content-between">
					<div class="navbar-brand head-logo d-none d-xl-block mx-0">
						<a href="./" title="Logo"><img src="./img/logo-1.png" width="250" alt="logo"></a> 
					</div>
					<div class="navbar-brand head-logo mx-0">
						<a href="./" title="Logo"><img src="./img/logo.png" width="250" alt="logo"></a> 
					</div>
					<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
						<span class="navbar-toggler-icon"></strong>
					</button>
				</div>
			</div>
		</div>
		<div class="nav-section flex-wrap w-100">
			<div class="container-fluid">
				<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar">
					<div class="offcanvas-header">
						<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
					</div>
					<div class="offcanvas-body">
						<ul class="navbar-nav align-items-center gap-2 justify-content-between justify-content-xl-center flex-grow-1">
							<li class="nav-item">
								<a class="nav-link active" aria-current="page" href="indexeng.php">Home</a>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle"  href="javascript:;" role="button" data-bs-toggle="dropdown" aria-expanded="false"> About Us </a>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item" href="bactivities.php">Board Activities</a></li>
									<li class="dropdown-submenu">
										<a class="dropdown-item dropdown-toggle" href="javascript:;">Board Act & Rules</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="act.php">Board Act</a></li>
											<li><a class="dropdown-item" href="forms.php">Forms</a></li>
										</ul>
									</li>
									<li><a class="dropdown-item" href="bmembers.php">Board Members</a></li>
									<li><a class="dropdown-item" href="orgchart.php">Organization Chart</a></li>
									<li><a class="dropdown-item" href="contactus.php">Administrative Offieces</a></li>
									<li class="dropdown-submenu">
										<a class="dropdown-item dropdown-toggle" href="javascript:;">Employees Corner</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="empcorner.php?stype=Transfers And Postings">Transfers & Postings</a></li>
											<li><a class="dropdown-item" href="empcorner.php?stype=Appointment Orders">Appointment Orders</a></li>
											<li><a class="dropdown-item" href="empcorner.php?stype=Promotions">Promotions</a></li>
											<li><a class="dropdown-item" href="empcorner.php?stype=Utility Forms">Utility Forms</a></li>
											<li><a class="dropdown-item" href="circulars.php">Circulars & Notifications</a></li>
										</ul>
									</li>
									<li class="dropdown-submenu">
										<a class="dropdown-item dropdown-toggle" href="javascript:;">Others</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="news.php">News & Events</a></li>
											<!-- <li><a class="dropdown-item text-danger	" href="photogallery.php">Photogallery</a></li> -->
											<li><a class="dropdown-item" href="publications.php">Publications</a></li>
											<li><a class="dropdown-item" href="rta.php">RTI Act</a></li>
											<li><a class="dropdown-item" href="tenders.php">Tenders</a></li>
										</ul>
									</li>
								</ul>
							</li>

							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle"  href="javascript:;" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Assistance To Exporterts </a>
								<ul class="dropdown-menu">								
									<li><a class="dropdown-item" href="export_per.php">Export Performance</a></li>
									<li><a class="dropdown-item" href="exporters.php">Assistance to Exporters</a></li>
									<li class="dropdown-submenu">
										<a class="dropdown-item dropdown-toggle" href="javascript:;">Export Promotion Activities</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="indentives.php">Incentives/Benefits</a></li>
										</ul>
									</li>
									<li class="dropdown-submenu">
										<a class="dropdown-item dropdown-toggle" href="javascript:;">Traders Facilitation</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="expdir.php">Directory</a></li>
											<li><a class="dropdown-item" href="registrationp.php">Registration Procedure</a></li>
											<li><a class="dropdown-item" href="registrationfees.php">Registration Fee</a></li>
											<li><a class="dropdown-item" href="downloadf13.php">Online Registration</a></li>
										</ul>
									</li>
								</ul>
							</li>

							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle"  href="javascript:;" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Crop Planning & Regulation </a>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item" href="propolicy.php">Production Policy</a></li>
									<li class="dropdown-submenu">
										<a class="dropdown-item dropdown-toggle" href="javascript:;">Criteria for Registration</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="commnur.php">Nursary Registrations</a></li>
											<li><a class="dropdown-item" href="regdfcv.php">Grower and Barn Operator Registrations</a></li>
											<li><a class="dropdown-item" href="lfcr.php">Licence For Construction of Barn</a></li>
										</ul>
									</li>
									<li><a class="dropdown-item" href="penaltyforvio.php">Penalities For Violation</a></li>
									<li><a class="dropdown-item" href="welfaremeasures.php">Grower Welfare Measures</a></li>
								</ul>
							</li>


							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle"  href="javascript:;" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Tobacco Varities </a>
								<ul class="dropdown-menu">
									<li class="dropdown-submenu">
										<a class="dropdown-item dropdown-toggle" href="javascript:;">FCV Tobacco</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="fcvm.php">FCV(Mysore)</a></li>
											<li><a class="dropdown-item" href="fcvs.php">FCV(SLS)</a></li>
											<li><a class="dropdown-item" href="fcvn.php">FCV(NLS)</a></li>
											<li><a class="dropdown-item" href="fcvb.php">FCV(SBS)</a></li>
										</ul>
									</li>

									<li class="dropdown-submenu">
										<a class="dropdown-item dropdown-toggle" href="javascript:;">Non FCV Tobacco</a>
										<ul class="dropdown-menu">
											<li class="dropdown-submenu">
												<a class="dropdown-item dropdown-toggle" href="javascript:;">Burley</a>
												<ul class="dropdown-menu">
													<li><a class="dropdown-item" href="b_mansoon.php">Mansoon</a></li>
													<li><a class="dropdown-item" href="b_tradition.php">Traditional</a></li>
												</ul>
											</li>
											<li><a class="dropdown-item" href="orental.php">Oriental</a></li>
											<li><a class="dropdown-item" href="aircured.php">Air Cured</a></li>
											<li class="dropdown-submenu">
												<a class="dropdown-item dropdown-toggle" href="javascript:;">Sun Cured</a>
												<ul class="dropdown-menu">
													<li><a class="dropdown-item" href="sc_eluru.php">Natu(Eluru)</a></li>
													<li><a class="dropdown-item" href="sc_kurnool.php">Natu(Kurnool)</a></li>
												</ul>
											</li>
											<li><a class="dropdown-item" href="fire_cured.php">Fire Cured</a></li>
											<li><a class="dropdown-item" href="beedi.php">Beedi</a></li>
											<li class="dropdown-submenu">
												<a class="dropdown-item dropdown-toggle" href="javascript:;">Cigar</a>
												<ul class="dropdown-menu">
													<li><a class="dropdown-item" href="wrapper.php">Wrapper</a></li>
													<li><a class="dropdown-item" href="filter.php">Filter</a></li>
												</ul>
											</li>
											<li><a class="dropdown-item" href="lanka_tobacco.php">Lanka Tobacco</a></li>
											<li><a class="dropdown-item" href="cheroot.php">Cheroot</a></li>
											<li class="dropdown-submenu">
												<a class="dropdown-item dropdown-toggle" href="javascript:;">Chewing Tobacco</a>
												<ul class="dropdown-menu">
													<li><a class="dropdown-item" href="red_chopadia.php">Red Chopadia</a></li>
													<li><a class="dropdown-item" href="ristica.php">Rustica</a></li>
													<li><a class="dropdown-item" href="chew_bihar.php">Bihar</a></li>
													<li><a class="dropdown-item" href="chew_wb.php">West Bengal</a></li>
													<li><a class="dropdown-item" href="chew_tn.php">Tamil Nadu</a></li>
													<li><a class="dropdown-item" href="chew_bc.php">Black Chopadia</a></li>
												</ul>
											</li>
										</ul>
									</li>								
								</ul>
							</li>
							
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle"  href="javascript:;" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Auction System </a>
								<ul class="dropdown-menu">
									<li class="dropdown-submenu">
										<a class="dropdown-item dropdown-toggle" href="javascript:;">Indroduction</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="auctions.php">Auction Performance</a></li>
											<li><a class="dropdown-item" href="eauction.php">e-Auction System</a></li>
											<li><a class="dropdown-item" href="modus.php">Modus Operandi</a></li>
											<li><a class="dropdown-item" href="flowchart.php">Flow Chart</a></li>
										</ul>
									</li>
									<li class="dropdown-submenu">
										<a class="dropdown-item dropdown-toggle" href="javascript:;">Auction Platform Locations</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="apa.php">Andhra Pradesh</a></li>
											<li><a class="dropdown-item" href="apk1.php">Karnataka</a></li>
											<li><a class="dropdown-item" href="fap.php">Facilities at Auction Platforms</a></li>
										</ul>
									</li>
								</ul>
							</li>

							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="javascript:;" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Services To FCV Growers </a>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item" href="input.php">Supply of Inputs</a></li>
									<li><a class="dropdown-item" href="cropdev.php">Crop Development Activities</a></li>
									<li><a class="dropdown-item" href="fcv.php">Assistance to FCV Growers</a></li>
									<li><a class="dropdown-item" href="welfaresch.php">Welfare Schemes</a></li>
								</ul>
							</li>

							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="contactus1.php">Contact Us</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</nav>
</header>

<div class="modal fade" id="alertModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content shadow-lg border-0 rounded-3">
			<div class="modal-header">
				<h5 class="modal-title" id="alertModalLabel"><span class="material-symbols-rounded notranslate">warning</span> Important Alert</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<p class="mb-0">Welcome! This alert is shown only once during your current session.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>