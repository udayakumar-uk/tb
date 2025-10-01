<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Responsive Image Gallery</title>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> 
        <meta name="description" content="Responsive Image Gallery with jQuery" />
        <meta name="keywords" content="jquery, carousel, image gallery, slider, responsive, flexible, fluid, resize, css3" />
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="galcss/demo1.css" />
		<link rel="stylesheet" type="text/css" href="galcss/style.css" />
		<link rel="stylesheet" type="text/css" href="galcss/elastislide.css" />
		<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow&v1' rel='stylesheet' type='text/css' />
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css' />
		<noscript>
			<style>
				.es-carousel ul{
					display:block;
				}
			</style>
		</noscript>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript" src="galjs/jquery.tmpl.min.js"></script>
		<script type="text/javascript" src="galjs/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="galjs/jquery.elastislide.js"></script>
		<script type="text/javascript" src="galjs/gallery.js"></script>
		<script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">	
			<div class="rg-image-wrapper">
				{{if itemsCount > 1}}
					<div class="rg-image-nav">
						<a href="#" class="rg-image-nav-prev">Previous Image</a>
						<a href="#" class="rg-image-nav-next">Next Image</a>
					</div>
				{{/if}}
				<div class="rg-image" style="height:400px"></div>
				<div class="rg-loading"></div>
				<div class="rg-caption-wrapper">
					<div class="rg-caption" style="display:none;">
						<p></p>
					</div>
				</div>
			</div>
		</script>
    </head>
    <body>
		<div class="container" align="center">
			<div class="header">
				
				<span class="right_ab">
					
				</span>
				<div class="clr"></div>
			</div><!-- header -->
			
			<div class="content">
				
				<div id="rg-gallery" class="rg-gallery">
					<div class="rg-thumbs">						
						<div class="es-carousel-wrapper">
							<div class="es-nav">
								<span class="es-nav-prev">Previous</span>
								<span class="es-nav-next">Next</span>
							</div>
							<div class="es-carousel">
                            
								<ul>
                                <?php 
								//$selecty=executework("select * from tob_album_title where title='".$_GET['tit']."'");
								//$rowt=@mysqli_fetch_array($selecty);
							
							//$sel2=executework("select * from tob_images where titleid='". $rowt['id'] ."' order by id desc");
							//echo "select * from tob_images where titleid='". $rowt['id'] ."' order by id desc";
							$sel=executework("select * from tob_images where titleid='". $_GET['tit'] ."' order by position");
							//echo "select * from tob_images where titleid='". $_GET['tit'] ."' order by position";
							//$row=@mysqli_fetch_array($sel2);
									$cnts=@mysqli_num_rows($sel);
									$i=1;
									while($rows=@mysqli_fetch_array($sel))
									{
							$add="https://tobaccoboard.com/admin/photogallery/oimages/".$rows['image'];
					
									$width="";
									$height="";
									$thumb_height = 120;
									
									// Get new sizes
									//list($width, $height) = getimagesize($add);
									//$ratio = ($height/$width);
									//$newwidth = ($thumb_height/$ratio);
									$newheight = $thumb_height;
								  ?>
                                     <li><a href="#"><img src="https://tobaccoboard.com/admin/photogallery/thimages/<?php echo $rows['image']?>" width="80" height="40" data-large="https://tobaccoboard.com/admin/photogallery/oimages/<?php echo $rows['image']?>" /></a></li>
                                    <?php
									$i++;
									}				 
									 ?>									
								</ul>
							</div>
						</div>
						<!-- End Elastislide Carousel Thumbnail Viewer -->
					</div><!-- rg-thumbs -->
				</div><!-- rg-gallery -->
				
			</div><!-- content -->
		</div><!-- container -->
		
    </body>
</html>