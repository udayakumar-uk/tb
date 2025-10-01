<?php 
ob_start();
@session_start();
include "include/include.php";
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
    <!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>Tobacco Board</title>
	<meta name="description" content="Free Html5 Templates and Free Responsive Themes Designed by Kimmy | zerotheme.com">
	<meta name="author" content="www.zerotheme.com">
    <!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="css/zerogrid.css">
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
	<link rel="stylesheet" href="css/responsiveslides.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!--[if lt IE 8]>
       <div style=' clear: both; text-align:center; position: relative;'>
         <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
           <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
        </a>
      </div>
    <![endif]-->
    <!--[if lt IE 9]>
		<script src="js/html5.js"></script>
		<script src="js/css3-mediaqueries.js"></script>
	<![endif]-->
	<!--<link href='./images/favicon.ico' rel='icon' type='image/x-icon'/>-->
	<script src="js/jquery.min.js"></script>
	<script src="js/responsiveslides.js"></script>
	<script>
    $(function () {
      $("#slider").responsiveSlides({
        auto: true,
        pager: true,
        nav: true,
        speed: 500,
        maxwidth: 800,
        namespace: "centered-btns"
      });
    });
	function show_pop(dname,id)
{
	if(dname!="" && dname!='#')
	{
		window.open(dname,"DisplayWindow","resizable=no,titlebar=no,toolbar=no,scrollbars=yes,directories=no,menubar=no,width=600,height=900,left=300,top=25");
	}
}
  </script>
<!--<style>
.dropbtn {
   /* background-color: #4CAF50;*/
    color: white;
  /*  padding: 16px;*/
    font-size: 13px;
    border: none;
    cursor: pointer;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #003300;
    min-width: 190px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color:#fff;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {background-color: #669900}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
  /*  background-color: #3e8e41;*/
}
.bottom a{
padding:5px;
color:#950C16;
font-size:12px;
}
.bottom{
border-bottom:2px solid #bd6424;
}
.bottom1 a{
padding:5px;
color:#0f5f17;
font-size:12px;
}
.bottom2{
    background-color: #0f5f17;
    border-radius: 7px;
    width: 100%;
    padding: 8px;
	margin-bottom:5px;
}
.bottom2 a{
padding:0 5px;
color:#fff;
font-size:12px;
}
.bottom3 {
padding:5px;
color:#666;
font-size:12px;
}

.holder {
    background-color: #eee;
    width: 440px;
    overflow: hidden;
    padding: 10px;
    font-family: Helvetica;
    height: 205px;
}
.holder .mask {
  position: relative;
  left: 0px;
  top: 10px;
  width:440px;
  height:205px;
  overflow: hidden;
}
.holder ul {
  list-style:none;
  margin:0;
  padding:0;
  position: relative;
}
.holder ul li {
 padding: 3px 0px;
border-bottom: 1px solid #ccc;
}
.holder ul li a {
  color:#413c3c;
  text-decoration:none;
  font-size:12px;
}
.gal img{
border: #999 5px solid;
margin:5px 2px;
}
ul.list li a {
    font-size: 13px;
    color: #686666;
    line-height: 25px;
}
.main-content article {
    margin: 0 0 10px 0;
    overflow: hidden;
    position: relative;
}
.sidebar section {
    margin-bottom: 0px;
}
.sidebar .content {
    padding: 10px;
}
</style>-->    
<style>
.dropbtn {
   /* background-color: #4CAF50;*/
    color: white;
  /*  padding: 16px;*/
    font-size: 13px;
    border: none;
    cursor: pointer;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #003300;
    min-width: 190px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color:#fff;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {background-color: #669900}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
  /*  background-color: #3e8e41;*/
}
.bottom a{
padding:5px;
color:#950C16;
font-size:12px;
}
.bottom{
border-bottom:2px solid #bd6424;
}
.bottom1 a{
padding:5px;
color:#0f5f17;
font-size:12px;
}
.bottom2{
    background-color: #0f5f17;
    border-radius: 7px;
    width: 100%;
    padding: 8px;
	margin-bottom:5px;
}
.bottom2 a{
padding:0 5px;
color:#fff;
font-size:12px;
}
.bottom3 {
padding:5px;
color:#666;
font-size:12px;
}

.navbar-inverse .navbar-nav > .active > a, .navbar-inverse .navbar-nav > .active > a:focus, .navbar-inverse .navbar-nav > .active > a:hover {
    color: #fff;
    background-color: transparent;
}
.navbar-nav > li > a {
    padding-top: 1px;
    padding-bottom: 1px;
}
.navbar-collapse {
    padding-right: 0;
    padding-left: 0px;
	}
	.container-fluid {
    padding-right: 0;
    padding-left: 0;
    margin-right: auto;
    margin-left: auto;
}

.navbar {
    position: relative;
    min-height: 40px;
    margin-bottom: 2px;
    border: 1px solid transparent;
       
}
.navbar-inverse .navbar-nav > li > a{
color:#fff;
}

.nav > li > a {
    position: relative;
    display: block;
    padding: 2px 6px;
	}
.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 160px;
    padding: 5px 0;
    margin: 2px 0 0;
    font-size: 14px;
    text-align: left;
    list-style: none;
    background-color: #003300;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: 1px solid #ccc;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: 4px;
     -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
    box-shadow: 0 6px 12px rgba(0,0,0,.175);
}	
.dropdown-menu > li > a:focus, .dropdown-menu > li > a:hover {
    color: #fff;
    text-decoration: none;
    background-color: #669900;
	
}
.dropdown-menu > li > a{
color:#fff;
}
.navbar-inverse .navbar-nav > .open > a, .navbar-inverse .navbar-nav > .open > a:focus, .navbar-inverse .navbar-nav > .open > a:hover {
    color: #fff;
    background-color: #003300;
}
.h2, h2 {
    font-size: 15px;
	font-weight:bold;
	padding:5px;
}

.navbar-inverse {
    background-color: transparent;
    border-color: #fff;
}
.navbar-toggle {
background:#333;
}
.headtitles {
    color: #a05404;
    font-size: 20px;
    line-height: 40px;
}
/*.topnav {
  overflow: hidden;
  background-color: #333;
  width:100%;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav .icon {
  display: none;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }

}*/
.breadcrumb {
    padding: 5px 1px;
    margin-bottom: 5px;
    list-style: outside none none;
    background-color:#fff;
    border-radius: 4px;
}

</style>
</head>
<body>
<?php include "tb_header.php"; ?>		
<!--------------Content--------------->
<section id="content">
	<div class="zerogrid">
		<div class="row block">
		<?php include "tb_leftmenu.php"; ?>
			<div class="main-content col11">
				<article>
				<!--<h2 style="border-bottom:2px solid #c66f2f">ABOUT US</h2>-->
					<div class="heading">
					<div id="breadcrumbs-four">
	<a href="index.php" class="active">Home</a>
	<a href="#">Tenders</a>
	
</div>
                    <!--<p><span class="navclass"> <a href="index.php" style="color:#FFFFFF" >Home</a></span>  &nbsp; &raquo;&nbsp; 
	 	                   <span class="navclass"><a href="#" style="color:#FFFFFF"> About Us</a></span>  &nbsp; &raquo;&nbsp; 
                           <span class="navclass"><a href="#" style="color:#FFFFFF"> Board Activities</a></span>
                      </p>-->
						<!--<h2><a href="#">Sample post with, links, paragraphs and comments</a></h2>-->
						<!--<p class="info">>>> Posted by Admin - 01/01/2012 - 0 Comments</p>-->
					</div>
					<div class="content" style="padding-top:15px; text-align:justify">
                          <?php // echo $rowc['content'] ?>
			<div class="innercontent">
			<div id="innermenu" class="innermenbox" style="display:none;">
			</div>
            <div class="rightcorner1">
              <div class="innercontent">
                <div>
                  <div>
                    <div>
                      <div>
                        <table width="100%" border="0">
                          <?php
		$max_recs_per_page=30;
		if(!empty($_GET['ar']) && $_GET['ar']==1)
		$archive="where archive=1";
		else
		$archive="where archive=0";
		
		$select=executework("select * from tob_tender $archive order by id desc");
		$count=@mysqli_num_rows($select);
		$row=@mysqli_fetch_array($select);
if ($count > 0)
{
      ?>
                          <tr>
                            <td><table width="95%" border="0" align="center">
                                <?php
	if (empty($_GET['page_index']))
	{
		$page_index=1;
	}	
	else
	{
		$page_index=$_GET['page_index'];
	}
	$total_recs = $count;
	$pages = $count / $max_recs_per_page; 
	if ($pages < 1)
	{ 
		$pages = 1; 
	}
	if ($pages / (int) $pages <> 1)
	{ 
		$pages = (int) $pages + 1; 
	} 
	else
	{ 
		$pages = $pages; 
	}
	$page12=(int) $page_index;
	
	$pagenow1 = ($max_recs_per_page*($page12-1)); 

	$select1= executework("select * from tob_tender $archive order by id desc LIMIT $pagenow1, $max_recs_per_page");
	$count1 = @mysqli_num_rows($sql1);
	
	if($pages > 1)
	{
	?>
                                <tr>
                                  <td colspan="2" align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Page&nbsp;
                                          <?php
	  for($im=1;$im<=$pages;$im++)
	  {
	  		if($page12 != $im)
			{
				?>
                                          <a href="tenders.php?page_index=<?php echo "$im" ?>&amp;ar=<?php echo $_GET['ar']?>" class="hlink1"><?php echo "$im" ?></a>&nbsp;
                                          <?php
			}
			else
			{
					?>
                                          <font color="red"><?php echo "$im" ?></font>&nbsp;
                                          <?php
			}
		}
	?>
                                  </strong></font></td>
                                </tr>
                                <?php
	}
	?>
                            </table></td>
                          </tr>
                          <tr>
                            <td><table width="100%" border="1" align="center" cellpadding="7" cellspacing="1" bgcolor="#EDEDED">
                                <tr bgcolor="#EEDF73">
                                  <td width="23%" height="30" bgcolor="#EDEDED"><div align="left"><strong>Tender Notice No </strong></div></td>
                                  <td width="33%" bgcolor="#EDEDED"><div align="left"><strong>Description of Tender </strong></div></td>
                                  <td width="20%" bgcolor="#EDEDED"><div align="left"><strong>Status</strong></div></td>
                                  <!--<td width="24%"><div align="left"><strong>Awarded To </strong></div></td>-->
                                </tr>
                          <tr>
                            <td colspan="4" bgcolor="#FFFFFF"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <?php
		  	$i=1;$b=1;
		  	while($rows=@mysqli_fetch_array($select1))
			{
				if($rows['mfile']!="")
				{
					$link1="admin/tenderfiles/".$rows['mfile'];
					$link="reg.php?pg=".$rows['mfile']."&id=".$rows['id'];
				}
				else
				$link="#";
				
				$fcheck=explode(".",$rows['mfile']);

				if($i%2)
				$bgcolor="#FFFFFF";
				else
				$bgcolor="#F4F4F4";
		  ?>
				<tr valign="top">
				  <td width="23%" height="25" align="left" bgcolor="<?php echo $bgcolor ?>" style="padding-right:15px;"><?php echo $rows['tenderno'] ?></td>
				  <td width="33%" align="left" bgcolor="<?php echo $bgcolor ?>" style="padding-right:15px;">
				    <div align="left">
					<?php
				   if($rows['isactive']=='0')
					 {
				  	if(!empty($rows['mfile']))
					{
				  ?>				    
				      <a href="#" onClick="show_pop('<?php echo $link ?>')"><?php echo $rows['description']; if($fcheck[1]=='pdf'){?>&nbsp;<img src="tob2_imgs/pdf_icon.gif" width="12" height="15" border="0" />				        </a>&nbsp;&nbsp;&nbsp;<a href="<?php echo $link?>" target="<?php if($link!="#"){?>_blank<?php }?>"><img src="tob2_imgs/newindow_icon.gif" border="0" />											
				          </a>
				    <?php
					}
				   	}
					else
					{
						echo $rows['description'];
					}
					}
					else
					{
				   ?>		
				       <?php
					
				  	if(!empty($rows['mfile']))
					{
				  ?>				    
				      <?php echo $rows['description']; if($fcheck[1]=='pdf'){?>&nbsp;<img src="tob2_imgs/pdf_icon.gif" width="12" height="15" border="0" />
				      <?php }?>
				      &nbsp;&nbsp;&nbsp;<img src="tob2_imgs/newindow_icon.gif" border="0" />											
				      
				    <?php
				   	}
					else
					{
						echo $rows['description'];
					}
					}
				   ?>
				   
				   
				   
				   	
				      </div></td>
				  <td width="20%" align="left" bgcolor="<?php echo $bgcolor ?>" style="padding-right:15px;"><?php echo $rows['tstatus']?></td>
				  <!--<td width="24%" align="left" bgcolor="<?php echo $bgcolor?>" style="padding-right:15px;"><?php echo $rows['award']?></td>-->
				</tr>
				<tr valign="top">
				  <td height="25" align="left" bgcolor="<?php echo $bgcolor?>" style="padding-right:15px;">&nbsp;</td>
				   <td align="left" bgcolor="<?php echo $bgcolor?>" style="padding-right:15px;">
				  <?php
				if($rows['tfile']!="")
				{
					$link1="admin/tenderfiles/$rows[tfile]";
					$link="reg.php?pg=".$rows['tfile']."&id=".$rows['id'];
				}
				else
				$link="#";
				
				$fcheck=explode(".",$rows['tfile']);

				if($i%2)
				$bgcolor="#FFFFFF";
				else
				$bgcolor="#F4F4F4";

				  if($rows['isactive']=='0')
				  {
				  if(isset($rows['tfile']) && $rows['tfile']!="")
				  {
				  ?>
				  <p><a href="#" onClick="show_pop('<?php echo $link ?>')"><?php echo $rows['subtitle1']; if($fcheck[1]=='pdf'){?>&nbsp;<img src="tob2_imgs/pdf_icon.gif" width="12" height="15" border="0" />				        </a>&nbsp;&nbsp;&nbsp;<a href="<?php echo $link ?>" target="<?php if($link!="#"){ ?>_blank<?php } ?>"><img src="tob2_imgs/newindow_icon.gif" border="0" />											
				  </a></p>
				  
				  	<?php
					}
				   	}
					else
					{
						echo $rows['subtitle1'];
					}
					}
					else
					{
				   ?>		
				   <?php
				  	if(!empty($rows['tfile']))
					{
				   ?>				    
				      <?php echo $rows['subtitle1']; if($fcheck[1]=='pdf'){?>&nbsp;<img src="tob2_imgs/pdf_icon.gif" width="12" height="15" border="0" />
				      <?php }?>
				      &nbsp;&nbsp;&nbsp;<img src="tob2_imgs/newindow_icon.gif" border="0" />											
				      
				    <?php
				   	}
					else
					{
						echo $rows['subtitle1'];
					}
					}
				    ?>


				<?php
				if($rows[sfile]!="")
				{
					$link2="admin/tenderfiles/".$rows['sfile'];
					$links="reg.php?pg=".$rows['sfile']."&id=".$rows['id'];
				}
				else
				$links="#";
				
				$fcheck=explode(".",$rows['tfile']);

				if($i%2)
				$bgcolor="#FFFFFF";
				else
				$bgcolor="#F4F4F4";

				  if($rows['isactive']=='0')
				  {
				  if(isset($rows['sfile']) && $rows['sfile']!="")
				  {
				  ?>
				  <p><a href="#" onClick="show_pop('<?php echo $links ?>')"><?php echo $rows['subtitle2']; if($fcheck[1]=='pdf'){ ?>&nbsp;<img src="tob2_imgs/pdf_icon.gif" width="12" height="15" border="0" />				        </a>&nbsp;&nbsp;&nbsp;<a href="<?php echo $links ?>" target="<?php if($links!="#"){ ?>_blank<?php }?>"><img src="tob2_imgs/newindow_icon.gif" border="0" />											
				  </a></p>
				  
				  	<?php
					}
				   	}
					else
					{
						echo $rows['subtitle2'];
					}
					}
					else
					{
				   ?>		
				   <?php
				  	if(!empty($rows['sfile']))
					{
				   ?>				    
				      <?php echo $rows['subtitle2']; if($fcheck[1]=='pdf'){?>&nbsp;<img src="tob2_imgs/pdf_icon.gif" width="12" height="15" border="0" />
				      <?php }?>
				      &nbsp;&nbsp;&nbsp;<img src="tob2_imgs/newindow_icon.gif" border="0" />											
				      
				    <?php
				   	}
					else
					{
						echo $rows['subtitle2'];
					}
					}
				    ?>


				  
				  <td align="left" bgcolor="<?php echo $bgcolor ?>" style="padding-right:15px;">&nbsp;</td>
				  </tr>
            <?php	
				$i++;
			}

			?>
								</table></td>
							  </tr>
                            </table></td>
                          </tr>
    <?php
		}
		else
		{
	?>
                          <tr>
                            <td height="90" colspan="3"><div align="center">
                                <p class="style32">&nbsp;</p>
                              <p>Required Information Not Available</p>
                              <p class="style32">&nbsp;</p>
                            </div></td>
                          </tr>
     <?php
		}
	?>
                          <tr>
                            <td style="padding-left:15px;">&nbsp;</td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    </div>
                </div>
              </div>
              </div>
              </div>
					</div>
				<!--	<div class="footer">
						<p class="more"><a class="button" href="#">Read more >></a></p>
					</div>-->
				</article>
				
			</div>
			
			
			
		</div>
	</div>
</section>

<!--------------Footer--------------->
<?php include "tb_footer.php"; ?>
<script>
jQuery.fn.liScroll = function(settings) {
	settings = jQuery.extend({
		travelocity: 0.03
		}, settings);		
		return this.each(function(){
				var $strip = jQuery(this);
				$strip.addClass("newsticker")
				var stripHeight = 1;
				$strip.find("li").each(function(i){
					stripHeight += jQuery(this, i).outerHeight(true); // thanks to Michael Haszprunar and Fabien Volpi
				});
				var $mask = $strip.wrap("<div class='mask'></div>");
				var $tickercontainer = $strip.parent().wrap("<div class='tickercontainer'></div>");								
				var containerHeight = $strip.parent().parent().height();	//a.k.a. 'mask' width 	
				$strip.height(stripHeight);			
				var totalTravel = stripHeight;
				var defTiming = totalTravel/settings.travelocity;	// thanks to Scott Waye		
				function scrollnews(spazio, tempo){
				$strip.animate({top: '-='+ spazio}, tempo, "linear", function(){$strip.css("top", containerHeight); scrollnews(totalTravel, defTiming);});
				}
				scrollnews(totalTravel, defTiming);				
				$strip.hover(function(){
				jQuery(this).stop();
				},
				function(){
				var offset = jQuery(this).offset();
				var residualSpace = offset.top + stripHeight;
				var residualTime = residualSpace/settings.travelocity;
				scrollnews(residualSpace, residualTime);
				});			
		});	
};

$(function(){
    $("ul#ticker01").liScroll();
});
</script>


</body></html>