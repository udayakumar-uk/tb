<?php 
ob_start();
@session_start();
include "include/include.php";
$selcont=executework("select * from tob_cms where pageid=1");
$rowc=@mysqli_fetch_array($selcont);?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Board Activities | Tobacco Board</title>
	
	<?php include "head.php"; ?>

<style>

#breadcrumbs-four{
  overflow: hidden;
  width: 100%;
}

#breadcrumbs-four a{
  float: left;
  margin: 0 .5em 0 1em;
}

#breadcrumbs-four a{
  background: #ddd;
  padding: .4em 1em;
  float: left;
  text-decoration: none;
  color: #444;
  text-shadow: 0 1px 0 rgba(255,255,255,.5); 
  position: relative;
}

#breadcrumbs-four a:hover{
  background: #b77836;
  color:#fff;
}

#breadcrumbs-four a::before,
#breadcrumbs-four a::after{
  content:'';
  position:absolute;
  top: 0;
  bottom: 0;
  width: 1em;
  background: #ddd;
  transform: skew(-10deg);  
}

#breadcrumbs-four a::before{

  left: -.5em;
  border-radius: 5px 0 0 5px;
}

#breadcrumbs-four a:hover::before{
  background: #b77836;
}

#breadcrumbs-four a::after{
  right: -.5em;   
  border-radius: 0 5px 5px 0;
}

#breadcrumbs-four a:hover::after{
  background: #b77836;
}

#breadcrumbs-four .current,
#breadcrumbs-four .current:hover{
  font-weight: bold;
  background: #b77836;
}

#breadcrumbs-four .current::after,
#breadcrumbs-four .current::before{
  content: normal;
  background: #b77836;
}
</style>

</head>
<body>

<?php include "tb_header.php"; ?>

<!--------------Content--------------->
<section id="content">
	<div class="zerogrid">
		<div class="row block">

		  <!-- <?php /* include  "tb_leftmenu.php"; */ ?> -->
			
			<div class="main-content col11">
				
				<div class="container">
            <div class="heading">

              <div id="breadcrumbs-four">
                <a href="index.php">Home</a>
                <a href="#">About Us</a>
                <a href="">Board Activities</a>
              </div>
            </div>

            <div id="main-content" class="content" >
              <?php echo $rowc['content'] ?>
            </div>
        </div>
				
			</div>
		</div>
	</div>
</section>

<!--------------Footer--------------->
<?php include "tb_footer.php"; ?>


</body>
</html>