<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");

$m=date('m');
$y=date('Y');
$selmaxy=executework("select max(year) as yr,max(month) as mn from tob_export group by year order by year desc limit 1
");
$rowy=@mysqli_fetch_array($selmaxy);
$y=$rowy['yr'];
$m=$rowy['mn'];
if($m<=3)
$yy=$y-1;
else
$yy=$y;
$cyr=$yy."-".($yy+1);
$pyr=($yy-1)."-".$yy;
$categ=array('','FCV','Tobacco Products','अनमानयुक्त तंबाकू');
$catg=implode(',',$categ);
for($k=1;$k<=2;$k++)
{
	$mn=4;
	if($k==1)
	$y1=$yy;
	else
	$y1=$yy-1;
	for($i=1;$i<=12;$i++)
	{
		$year[$i]['m']=$mn;
		$year[$i]['y']=$y1;
		$mn++;
		if($mn>=13)
		{
			$mn=1;
			$y1=$y1+1;
		}
	}
	
	$i=0;
	for($n=1;$n<count($categ);$n++)
	{
		$qry=" and catg='".$categ[$n]."'";
		$sq[$k][$n]="";
		$sv[$k][$n]="";
		for($j=1;$j<=12;$j++)
		{
			$qty="";
			$gv="";
			
			$sel=executework("SELECT catg,month,year,ROUND(quantity,0) as Quantity,ROUND(value,0) as gval from tob_export where isactive=1 and month=".$year[$j]['m']." and year=".$year[$j]['y'].$qry);

			$row=@mysqli_fetch_array($sel);
			$gv=$row['gval'];
			$qty=$row['Quantity'];
			
			if($j==1)
			{
				$sq[$k][$n]=$qty;
				$sv[$k][$n]=$gv;
			}
			else
			{
				$sq[$k][$n]=$sq[$k][$n].",".$qty;
				$sv[$k][$n]=$sv[$k][$n].",".$gv;
			}
			
		}
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
</head><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Export Performance | Tobacco Board, Guntur</title>

<style type="text/css">
<!--
.style30 {color: #990000}
.style32 {	font-size: 16px;
	color: #CC0000;
	font-weight: bold;
}
.style29 {color: #990000; font-weight: bold; }
-->
</style>
    <link class="include" rel="stylesheet" type="text/css" href="graph/jquery.jqplot.min.css" />
    <link rel="stylesheet" type="text/css" href="graph/examples.min.css" />
    <link type="text/css" rel="stylesheet" href="graph/syntaxhighlighter/styles/shCoreDefault.min.css" />
    <link type="text/css" rel="stylesheet" href="graph/syntaxhighlighter/styles/shThemejqPlot.min.css" />
  
    <script class="include" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<!--[if IE]><script language="javascript" type="text/javascript" src="graph/excanvas.min.js"></script><![endif]-->
  <script language="JavaScript" type="text/javascript" src="https://code.google.com/p/explorercanvas/source/browse/trunk/excanvas.js"></script>
    <script class="include" type="text/javascript" src="graph/jquery.min.js"></script>
<script language="JavaScript" type="text/javascript">
//   j = jQuery.noConflict();
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
</head>
<body>
<?php
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
?>
<a name="top" id="top"></a>
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><img src="tob2_imgs/spacer.png" width="1" height="2" /></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><?php include_once("header.php")
  ?></td>
  </tr>
  <tr>
    <td width="224" rowspan="2" valign="top" bgcolor="#ededed" >
	<?php include_once("leftmenu.php")
  ?>	</td>
    <td colspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tabbor">
      <tr>
        <td width="92%" height="25" bgcolor="#e7e6e6"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td><div class="breadcrumb flat"> <a href="#" class="active">&#2361;&#2379;&#2350;</a> <a href="#">निर्यात प्रदर्शन</a></div>
                  <script src="js/crumb.js"  type="text/javascript">
                  </script>
              </td>
            </tr>
        </table></td>
        <td width="8%" bgcolor="#e7e6e6"><?php
		   		if(empty($_GET['prin']))
				{
		   ?>
            <a href="#" onclick="MM_openBrWindow('bactivities.php?prin=y','','width=800,height=600')"><img src="tob2_imgs/printButton.gif" border="0" /></a> <a href="#" onclick="MM_openBrWindow('export_per.php?prin=y','','width=800,height=600')">Print</a>
            <?php
		   		}
		   ?>
        </td>
      </tr>
    </table>
      <br />
      <table width="99%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30" align="justify"><div class="rightcorner1">
          <div class="innercontent">
            <div class="rightcorner1">
              <div class="innercontent">
                <div>
                  <div>
                    <form id="graph" name="graph" method="post" action="">
                      <div> <br />
                          <table width="720" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#F0F0F0">
                            <tr bgcolor="#FFF0FF">
                              <td width="53%" height="43" bgcolor="#EDEDED"><label> &nbsp;&nbsp; <!--Category-->वर्ग :
                                <select name="catg" id="catg">
                                      <option value="FCV" selected="selected">एफसीवी</option>
                                      <option value="Tobacco Products">तम्बाकू उत्पाद</option>
                                      <option value="Unmanufactured Tobacco">अनमानयुक्त तंबाकू</option>
                                    </select>
                                    <?php
					if(!empty($_POST['catg']))
					$mn1=$_POST['catg'];
					else
					$mn1='';

					if($mn1!="")
					{
					?>
                                    <script type="text/javascript">
					 var mn1='<?php echo $mn1 ?>';
					 var j;
					for(j=0;j<=document.graph.catg.options.length;j++)
					{
						if(document.graph.catg.options[j].value==mn1)
						{
							document.graph.catg.options[j].selected=true;
						}
					}
					        </script>
                                    <?php
					}
				  ?>
                              </label></td>
                              <td width="14%" bgcolor="#EDEDED">&nbsp;
                                  <label>
                                  <input name="tp" type="radio" value="q" checked="checked" />
                                  </label>
                                <!--Quantity-->मात्रा</td>
                              <td width="33%" align="center" bgcolor="#EDEDED"><div align="left">
                                  <input name="tp" type="radio" value="v" />
                                <!--Value-->मूल्य </div></td>
                              <?php
					if(!empty($_POST['yr']))
					$yrs=$_POST['yr'];

					if(!empty($yrs))
					{
					?>
                              <script type="text/javascript">
					 var yrs='<?php echo $yrs ?>';
					 var j;
					for(j=0;j<document.graph.yr.length;j++)
					{
						if(document.graph.yr[j].value==yrs)
						{
							document.graph.yr[j].checked=true;
						}
					}
					    </script>
                              <?php
					}
				  ?>
                            </tr>
                            <tr bgcolor="#FFF0FF">
                              <td height="32" colspan="3" align="center" valign="middle" bgcolor="#EDEDED"><label>
                                <?php
					if(!empty($_POST['tp']))
					$tps=$_POST['tp'];

					if(!empty($tps))
					{
					?>
                                <script type="text/javascript">
					 var tps='<?php echo $tps ?>';
					 var j;
					for(j=0;j<document.graph.tp.length;j++)
					{
						if(document.graph.tp[j].value==tps)
						{
							document.graph.tp[j].checked=true;
						}
					}
					              </script>
                                <?php
					}
				  ?>
                                <input name="grph" type="submit" id="grph" value="Submit" />
                              </label></td>
                            </tr>
                          </table>
                        <br />
                          <div class="example-content">
                            <!-- Example scripts go here -->
                            <div id="chart2" style="margin-top:20px; margin-left:40px; width:700px; height:500px;"></div>
                            <table width="700" border="0">
                              <tr>
                                <td><div align="center"></div></td>
                              </tr>
                            </table>
                            <div id="chart3" style="margin-top:20px; margin-left:40px; width:700px; height:500px;"></div>
                            <table width="700" border="0">
                              <tr>
                                <td><div align="center"></div></td>
                              </tr>
                            </table>
                            <!--<pre class="code brush:js"></pre>-->
                            <script class="" type="text/javascript">
//JQ = jQuery.noConflict();
 var categ=new Array();
 categ=Array('','FCV','Tobacco Products','Unmanufactured Tobacco');
 var categ1=Array('','एफसीवी','तम्बाकू उत्पाद','अनमानयुक्त तंबाकू');
// var sq1[1]='<?php //echo $sq[1][1] ?>';
// var sv1[1]='<?php //echo $sv[1][1] ?>';/ var sq1[2]='<?php //echo $sq[1][2] ?>';
// var sv1[2]='<?php //echo $sv[1][2] ?>';
// var sq1[3]='<?php //echo $sq[1][3] ?>';
// var sv1[3]='<?php //echo $sv[1][3] ?>';
// 
// var sq2[1]='<?php //echo $sq[2][1] ?>';
// var sv2[1]='<?php //echo $sv[2][1] ?>';
// var sq2[2]='<?php //echo $sq[2][2] ?>';
// var sv2[2]='<?php //echo $sv[2][2] ?>';
// var sq2[3]='<?php //echo $sq[2][3] ?>';
// var sv2[3]='<?php //echo $sv[2][3] ?>';

 var sq11='<?php echo $sq[1][1] ?>';
 var sv11='<?php echo $sv[1][1] ?>';
 var sq21='<?php echo $sq[1][2] ?>';
 var sv21='<?php echo $sv[1][2] ?>';
 var sq31='<?php echo $sq[1][3] ?>';
 var sv31='<?php echo $sv[1][3] ?>';
 
 var sq12='<?php echo $sq[2][1] ?>';
 var sv12='<?php echo $sv[2][1] ?>';
 var sq22='<?php echo $sq[2][2] ?>';
 var sv22='<?php echo $sv[2][2] ?>';
 var sq32='<?php echo $sq[2][3] ?>';
 var sv32='<?php echo $sv[2][3] ?>';
 var pyr='<?php echo $pyr ?>';
 var cyr='<?php echo $cyr ?>';
//JQ = jQuery.noConflict()
//jQuery.noConflict();
  $(document).ready(function(){
	chngc();
	
  });
  function grph(chrt,y,cat,qv){
  
		if(y==1)
		{
			var xlab=categ1[cat]+'('+cyr+')';
			var tit="Exports For Current Year";
			tit ="चालू वर्ष के लिए निर्यात";
		}
		else
		{
			var xlab=categ1[cat]+'('+pyr+')';
			var tit="Exports For Previous Year";
			tit = "पिछले वर्ष के लिए निर्यात";
		}
		if(qv=='q')
		var ylab = "टन में मात्रा";
		//var ylab='Q<br>u<br>a<br>n<br>t<br>i<br>t<br>y<br> <br>I<br>n<br> <br>T<br>o<br>n<br>s';
		else
		var ylab ="रुपये/लाख में मूल्य";
		//var ylab='V<br>a<br>l<br>u<br>e<br> <br>i<br>n<br> <br>R<br>u<br>p<br>e<br>e<br>s<br>/<br>L<br>a<br>k<br>h<br>s';
		var sqv1=window['s'+qv+cat+y];
		var str1= new Array();
		str1=sqv1;

		var str=str1.split(',');
		if(qv=='q')
		{
			if(cat==2)
			var mnn=1000;
			else
			var mnn=5000;
		}
		else
		{
			if(cat==2)
			var mnn=4000;
			else
			var mnn=6000;
		}
		var s=str;
		var smax = Math.max.apply(Math, s);
		if(smax=="")
		smax=500;
		var rem1=parseFloat(smax)/100;
		var rem2=Math.round(rem1);
//		alert(rem2.length);
		smax=(parseFloat(rem2)+1)*100;

		s1=[s[0],s[1],s[2],s[3],s[4],s[5],s[6],s[7],s[8],s[9],s[10],s[11]];
 //       var s2 = [7, 5, 3, 2];
         var ticks = ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'];
         var ticks = ['अप्रैल', 'मई', 'जून', 'जुलाई', 'अगस्त', 'सितंबर', 'अक्टूबर', 'नवम्बर', 'दिसम्बर', 'जनवरी', 'फरवरी', 'मार्च'];
        
        plot2 = $.jqplot(chrt, [s1], {
            seriesDefaults: {
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true },
				markerOptions: {
//							show: true,             // wether to show data point markers.
//							style: 'filledCircle',  // circle, diamond, square, filledCircle.
//													// filledDiamond or filledSquare.
//							lineWidth: 2,       // width of the stroke drawing the marker.
							size: 15,            // size (diameter, edge length, etc.) of the marker.
//							color: '#666666'    // color of marker, set to color of line by default.
//							shadow: true,       // wether to draw shadow on marker or not.
//							shadowAngle: 45,    // angle of the shadow.  Clockwise from x axis.
//							shadowOffset: 1,    // offset from the line of the shadow,
//							shadowDepth: 3,     // Number of strokes to make when drawing shadow.  Each stroke
//												// offset by shadowOffset from the last.
//							shadowAlpha: 0.07   // Opacity of the shadow
						}
            },
             animate: true,
            // Will animate plot on calls to plot1.replot({resetAxes:true})
            animateReplot: true,
			title: tit,
           series:[
                {
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
                        barPadding: -25,
                        barMargin: 0,
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
                }
            ],
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: ticks,
					label:xlab,
					tickOptions: {
                    angle: 0,
                    fontSize: '10pt',
                    showMark: true,
                }
                },
				yaxis: {
					min: mnn,
					max: smax,
					numberTicks: 11, 
	                pointLabels: { show: true },
					label:ylab,
					tickOptions: {
                    angle: 0,
                    fontSize: '10pt',
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
    
        $('#'+chrt).bind('jqplotDataHighlight', 
            function (ev, seriesIndex, pointIndex, data) {
                $('#info2').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
            }
        );
            
        $('#'+chrt).bind('jqplotDataUnhighlight', 
            function (ev) {
                $('#info2').html('Nothing');
            }
        );
    }
function chngc()
{
	var cat=document.getElementById("catg").value;
//	var tp=document.form1.tp.checked;
	var val;
	var tp1=document.graph.tp.length;
	for(i = 0; i < tp1; i++) {
		if(document.graph.tp[i].checked) {
			val=document.graph.tp[i].value;
		}
	}

if (!Array.prototype.indexOf) {
    Array.prototype.indexOf = function (searchElement, fromIndex) {
      if ( this === undefined || this === null ) {
        throw new TypeError( '"this" is null or not defined' );
      }

      var length = this.length >>> 0; // Hack to convert object.length to a UInt32

      fromIndex = +fromIndex || 0;

      if (Math.abs(fromIndex) === Infinity) {
        fromIndex = 0;
      }

      if (fromIndex < 0) {
        fromIndex += length;
        if (fromIndex < 0) {
          fromIndex = 0;
        }
      }

      for (;fromIndex < length; fromIndex++) {
        if (this[fromIndex] === searchElement) {
          return fromIndex;
        }
      }

      return -1;
    };
  }
	var catn=categ.indexOf(cat);

  	grph('chart2',1,catn,val);
  	grph('chart3',2,catn,val);
}
                        </script>
                            <!-- End example scripts -->
                            <!-- Don't touch this! -->
                            <script class="include" type="text/javascript" src="graph/jquery.jqplot.min.js"></script>
                            <script type="text/javascript" src="graph/syntaxhighlighter/scripts/shCore.min.js"></script>
                            <script type="text/javascript" src="graph/syntaxhighlighter/scripts/shBrushJScript.min.js"></script>
                            <script type="text/javascript" src="graph/syntaxhighlighter/scripts/shBrushXml.min.js"></script>
                            <!-- Additional plugins go here -->
                            <script class="include" type="text/javascript" src="graph/jquery.jqplot.min.js"></script>
                            <script class="include" type="text/javascript" src="graph/plugins11/jqplot.barRenderer.min.js"></script>
                            <script class="include" type="text/javascript" src="graph/plugins11/jqplot.pieRenderer.min.js"></script>
                            <script class="include" type="text/javascript" src="graph/plugins11/jqplot.categoryAxisRenderer.min.js"></script>
                            <script class="include" type="text/javascript" src="graph/plugins11/jqplot.pointLabels.min.js"></script>
 <script type="text/javascript" src="graph/plugins11/jqplot.highlighter.min.js"></script>
<script type="text/javascript" src="graph/plugins11/jqplot.cursor.min.js"></script>
<script type="text/javascript"   src="graph/plugins11/jqplot.canvasTextRenderer.min.js"></script>
<script type="text/javascript"   src="graph/plugins11/jqplot.canvasAxisLabelRenderer.min.js"></script>
<script type="text/javascript"   src="graph/plugins11/jqplot.canvasAxisTickRenderer.min.js"></script>
                           <!-- End additional plugins -->
                          </div>
                        <!--	<script type="text/javascript" src="example.min.js"></script>
-->
                      </div>
                        </form>
                    </div>
                </div>
              </div>
              </div>
              </div>
          <a href="javascript:window.print()" target="_blank"></a> </div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="2" valign="top"><table width="100%" border="0">
      <tr>
        <td width="39%">&nbsp;<!--Page Updated on :--> <?php if(!empty($row['tdate'])){?><span class="update"><?php echo datepattrn($row['tdate'])?></span><?php }?></td>
        <td width="41%"><div align="center"></div></td>
        <td width="20%"><div align="right"><a href="#top" ><img src="tob2_imgs/bact2top.jpg" width="94" height="27" border="0" title="Back to top" alt="Back to Top" /></a></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><img src="tob2_imgs/spacer.png" width="220" height="1" /></td>
    <td width="677" valign="top"><img src="tob2_imgs/spacer.png" width="535" height="1" /></td>
    <td width="401" valign="top"><img src="tob2_imgs/spacer.png" width="225" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><?php include_once("footer.php")
  ?></td>
  </tr>
</table>
</body>
</html>
