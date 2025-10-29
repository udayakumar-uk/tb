<?php 
ob_start();
@session_start();
include "include/include.php";
$selcont=executework("select * from tob_cms where pageid=83");
$rowc=@mysqli_fetch_array($selcont);?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title> Sitemap | Tobacco Board</title>
  
  <?php include "head.php"; ?>
</head>
<body>

<?php include "tb_header.php"; ?>

<!--------------Content--------------->
<div id="main-content">
  <div id="content" class="container">

    <div class="row">
      <ul class="col-md-4">
        <li><a href="index.php">Home</a></li>
        <li>
          <a href="#">About Us</a>
          <ul>
            <li><a href="bactivities.php">Board&nbsp;Activities</a></li>
            <li><a href="#" tabindex="-1">Board&nbsp;Act&nbsp;&&nbsp;Rules</a>
                <ul>
                    <li><a href="act.php">Board&nbsp;Act</a></li>
                    <li><a href="forms.php">Forms</a></li>
                </ul>
            </li>
            <li><a href="bmembers.php">Board Members</a></li>
            <li><a href="orgchart.php">Organization&nbsp;Chart</a></li>
            <li><a href="contactus.php">Administrative&nbsp;Offieces</a></li>
            <li><a href="#" tabindex="-1">Employees Corner</a>
                <ul>
                    <li><a href="empcorner.php?stype=Transfers And Postings">Transfers&nbsp;&&nbsp;Postings</a></li>
                    <li><a href="empcorner.php?stype=Appointment Orders">Appointment&nbsp;Orders</a></li>
                    <li><a href="empcorner.php?stype=Promotions">Promotions</a></li>
                    <li><a href="empcorner.php?stype=Utility Forms">Utility&nbsp;Forms</a></li>
                    <li><a href="circulars.php">Circulars&nbsp;&&nbsp;Notifications</a></li>
                </ul>
            </li>
            <li><a href="#" tabindex="-1">Others</a>
                <ul>
                    <li><a href="news.php">News&nbsp;&&nbsp;Events</a></li>
                    <li><a href="photogallery.php">Photogallery</a></li>
                    <li><a href="publications.php">Publications</a></li>
                    <li><a href="rta.php">RTI Act</a></li>
                    <li><a href="tenders.php">Tenders</a></li>
                </ul>
            </li>
          </ul>
        </li>
      </ul>
      <ul class="col-md-4">
        <li>
          <a href="#">Tobacco Varities</a>
          <ul>
            <li><a href="#" tabindex="-1">FCV Tobacco</a>
                <ul>
                    <li><a href="fcvm.php">FCV(Mysore)</a></li>
                    <li><a href="fcvs.php">FCV(SLS)</a></li>
                    <li><a href="fcvn.php">FCV(NLS)</a></li>
                    <li><a href="fcvb.php">FCV(SBS)</a></li>
                </ul>
            </li>
            <li><a href="#" tabindex="-1">Non FCV Tobacco</a>
                <ul>
                    <li><a href="#" tabindex="-1">Burley</a>
                        <ul>
                            <li><a href="b_mansoon.php">Mansoon</a></li>
                            <li><a href="b_tradition.php">Traditional</a></li>
                        </ul>
                    </li>
                    <li><a href="orental.php">Oriental</a></li>
                    <li><a href="aircured.php">Air Cured</a></li>
                    <li><a href="#" tabindex="-1">Sun&nbsp;Cured</a>
                        <ul>
                            <li><a href="sc_eluru.php">Natu(Eluru)</a></li>
                            <li><a href="sc_kurnool.php">Natu(Kurnool)</a></li>
                        </ul>
                    </li>
                    <li><a href="fire_cured.php">Fire&nbsp;Cured</a></li>
                    <li><a href="beedi.php">Beedi</a></li>
                    <li><a href="#" tabindex="-1">Cigar</a>
                        <ul>
                            <li><a href="wrapper.php">Wrapper</a></li>
                            <li><a href="filter.php">Filter</a></li>

                        </ul>
                    </li>
                    <li><a href="lanka_tobacco.php">Lanka&nbsp;Tobacco</a></li>
                    <li><a href="cheroot.php">Cheroot</a></li>
                    <li><a href="#" tabindex="-1">Chewing&nbsp;Tobacco</a>
                        <ul>
                            <li><a href="red_chopadia.php">Red&nbsp;Chopadia</a></li>
                            <li><a href="ristica.php">Rustica</a></li>
                            <li><a href="chew_bihar.php">Bihar</a></li>
                            <li><a href="chew_wb.php">West&nbsp;Bengal</a></li>
                            <li><a href="chew_tn.php">Tamil&nbsp;Nadu</a></li>
                            <li><a href="chew_bc.php">Black&nbsp;Chopadia</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
          </ul>
        </li>
      </ul>
      <ul class="col-md-4">
		    <li>
          <a href="#">Crop Planning & Regulation</a>
          <ul>
            <li> <a href="propolicy.php">Production Policy</a></li>
            <li><a href="#" tabindex="-1">Criteria&nbsp;for&nbsp;Registration</a>
                <ul>
                    <li><a href="commnur.php">Nursary Registrations</a></li>
                    <li><a href="regdfcv.php">Grower&nbsp;and&nbsp;Barn&nbsp;Operator&nbsp;Registrations</a></li>
                    <li><a href="lfcr.php">Licence For Construction of Barn</a></li>
                </ul>
            </li>
            <li><a href="penaltyforvio.php">Penalities For Violation</a></li>
            <li><a href="welfaremeasures.php">Grower&nbsp;Welfare&nbsp;Measures</a></li>
          </ul>
        </li>
        <li>
          <a href="#">Services To FCV Growers<span class="caret"></span></a>
          <ul>
              <li> <a href="input.php">Supply of Inputs</a></li>
              <li><a href="cropdev.php">Crop Development Activities</a></li>
              <li><a href="fcv.php">Assistance to FCV Growers</a></li>
              <li><a href="welfaresch.php">Welfare Schemes</a></li>
          </ul>
        </li>
		    <li>
         	<a href="#">Auction System<span class="caret"></span></a>
          <ul>
            <li>
              <a href="#" tabindex="-1">Indroduction</a>
              <ul>
                  <li><a href="auctions.php">Auction&nbsp;Performance</a></li>
                  <li><a href="eauction.php">e-Auction System</a></li>
                  <li><a href="modus.php">Modus Operandi</a></li>
                  <li><a href="flowchart.php">Flow Chart</a></li>
              </ul>
            </li>
    
            <li>
              <a href="#" tabindex="-1">Auction&nbsp;Platform&nbsp;Locations</a>
              <ul>
                <li><a href="apa.php">Andhra Pradesh</a></li>
                <li><a href="apk1.php">Karnataka</a></li>
                <li><a href="fap.php">Facilities&nbsp;at&nbsp;Auction&nbsp;Platforms</a></li>
              </ul>
            </li>        
          </ul>
        </li>

        <li>
          <a href="#">Assistance To Exporterts<span class="caret"></span></a>
          <ul>
            <li><a href="export_per.php">Export Performance</a></li>
            <li><a href="exporters.php">Assistance to Exporters </a></li>
            <li><a href="#" tabindex="-1">Export Promotion Activities </a>
                <ul>
                  <li><a href="indentives.php">Incentives/Benefits</a></li>
                </ul>
            </li>
            <li>
              <a href="#" tabindex="-1">Traders Facilitation </a>
              <ul>
                <li><a href="expdir.php">Directory</a></li>
                <li><a href="registrationp.php">Registration&nbsp;Procedure</a></li>
                <li><a href="registrationfees.php">Registration&nbsp;Fee</a></li>
                <li><a href="downloadf13.php">Online&nbsp;Registration</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li>
          <a href="contactus1.php">Contact Us</a>
        </li>
      </ul>
    </div>
  </div>
</div>


<!--------------Footer--------------->
<?php include "tb_footer.php"; ?>

</body>
</html>	