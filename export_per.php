<?php 
ob_start();
@session_start();
include "include/include.php";
$m=date('m');
$y=date('Y');
$selmaxy=executework("select max(year) as yr,max(month) as mn from tob_export group by year order by year desc limit 1");
$rowy=@mysqli_fetch_array($selmaxy);
$y=$rowy['yr'];
$m=$rowy['mn'];
if($m<=3)
$yy=$y-1;
else
$yy=$y;
$cyr=$yy."-".($yy+1);
$pyr=($yy-1)."-".$yy;
$categ=array('','FCV','Non FCV','Refuse Tobacco','Tobacco Products','Unmanufactured Tobacco');
$catg=implode(',',$categ);

for($k=1;$k<=2;$k++) {
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
		if($mn>=13) {
			$mn=1;
			$y1=$y1+1;
		}
	}
	
	$i=0;
	for($n=1;$n<count($categ);$n++) {
		$qry=" and catg='".$categ[$n]."'";
		$sq[$k][$n]="";
		$sv[$k][$n]="";
		for($j=1;$j<=12;$j++) {
			$qty="";
			$gv="";
			
      $sel = executework("SELECT catg,month,year,ROUND(quantity,0) as Quantity,ROUND(value,0) as gval from tob_export where isactive=1 and month=".$year[$j]['m']." and year=".$year[$j]['y'].$qry);

      // Ensure the query returned a result set and at least one row before accessing offsets
      $gv = 0;
      $qty = 0;
      if ($sel && @mysqli_num_rows($sel) > 0) {
        $rows = @mysqli_fetch_assoc($sel);
        if (is_array($rows)) {
          $gv = isset($rows['gval']) ? $rows['gval'] : 0;
          $qty = isset($rows['Quantity']) ? $rows['Quantity'] : 0;
        }
      }
			
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
} ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title> Export | Tobacco Board</title>
	<?php include "head.php"; ?>

  <link class="include" rel="stylesheet" type="text/css" href="graph/jquery.jqplot.min.css" />
  <link rel="stylesheet" type="text/css" href="graph/examples.min.css" />
  <link type="text/css" rel="stylesheet" href="graph/syntaxhighlighter/styles/shCoreDefault.min.css" />
  <link type="text/css" rel="stylesheet" href="graph/syntaxhighlighter/styles/shThemejqPlot.min.css" />

  <script language="javascript" type="text/javascript" src="https://code.google.com/p/explorercanvas/source/browse/trunk/excanvas.js"></script>
  <script class="include" type="text/javascript" src="graph/jquery.min.js"></script>
</head>

<body>

<?php include "tb_header.php"; ?>		

<!--------------Content--------------->
 <div id="main-content">
  <div id="content" class="container">
      <form id="graph" name="graph" method="post" action=""> 
        <div class="card mb-4">
          <div class="card-body">
            <div class="row gap-3 align-items-center">

              <div class="col-auto row">
                <label class="col-sm-4 col-form-label" for="catg">Category: </label>
                <div class="col-sm-8"><select class="form-select" id="catg" name="catg">
                  <option value="FCV" selected="selected">FCV</option>
                  <option value="Non FCV">Non FCV</option>
                  <option value="Refuse Tobacco" >Refuse Tobacco</option>
                  <option value="Tobacco Products">Tobacco Products</option>
                  <option value="Unmanufactured Tobacco">Unmanufactured Tobacco</option>
                </select></div>
                
                <?php if(!empty($_POST['catg']))
                  $mn1=$_POST['catg'];

                  if(!empty($mn1)) { ?>
                    <script>
                      $('#catg').val('<?php echo $mn1; ?>');
                    </script>
                  <?php } ?>
              </div>

              <div class="col-auto form-check">
                <input class="form-check-input" type="radio" name="tp" type="radio" value="q" checked="checked" id="tp" checked>
                <label class="form-check-label" for="tp">
                  Quantity
                </label>
              </div>

              <div class="col-auto form-check">
                <input class="form-check-input" type="radio" name="tp" type="radio" value="v" id="tpv" checked>
                <label class="form-check-label" for="tpv">
                  Value
                </label>
              </div>
              
              <div class="col-auto ms-auto">
                <button name="grph" type="submit" id="grph" value="Submit" class="btn btn-primary">Submit</button>
              </div>

            </div>
          </div>
        </div> 
        
      <?php if(!empty($_POST['yr']))
				$yrs=$_POST['yr'];

        if(!empty($yrs)) { ?>
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

        <?php } ?>

              <?php
                if(!empty($_POST['tp']))
                $tps=$_POST['tp'];

            if(!empty($tps)) { ?>
        
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

          <?php } ?>


  
  
    <div class="example-content">
      <!-- Example scripts go here -->
       <div class="row pt-4">
         <div id="chart2" style="height: 600px" class="col-md-6"></div>
         <div id="chart3" style="height: 600px" class="col-md-6"></div>

       </div>
        

            
                            
                            
<script type="text/javascript"> 
  var categ=new Array();
  categ=Array('','FCV','Non FCV','Refuse Tobacco','Tobacco Products','Unmanufactured Tobacco');

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
								
  var gcat= document.getElementById("catg").value;
  var gcatn=categ.indexOf(gcat);

  if(gcatn==1)
  var strq=sq11+","+sq12;
  if(gcatn==2)
  var strq=sq21+","+sq22;
  if(gcatn==3)
  var strq=sq31+","+sq32;
                  
  var arrq=strq.split(',');
                  
  if(gcatn==1)
  var strv=sv11+","+sv12;
  if(gcatn==2)
  var strv=sv21+","+sv22;
  if(gcatn==3)
  var strv=sv31+","+sv32;
  var arrv=strv.split(',');
  var smaxx = Math.max.apply(Math, arrq);
  if(smaxx=="")
  smaxx=2000;
  var rem1=parseFloat(smaxx)/1000;
  var rem2=Math.round(rem1);
  smaxx=((parseFloat(rem2)+1)*1000);

  var smaxv = Math.max.apply(Math, arrv);
  if(smaxv=="")
  smaxv=200;
  var rem1=parseFloat(smaxv)/100;
  var rem2=Math.round(rem1);
  smaxv=((parseFloat(rem2)+1)*100);

  $(document).ready(function(){

	chngc();
	
  });
  function grph(chrt,y,cat,qv){
  
		if(y==1) {
			var xlab=categ[cat]+'('+cyr+')';
			var tit="Exports For Current Year";
		}
		else
		{
			var xlab=categ[cat]+'('+pyr+')';
			var tit="Exports For Previous Year";
		}
		if(qv=='q')
		var ylab='Q<br>u<br>a<br>n<br>t<br>i<br>t<br>y<br> <br>I<br>n<br> <br>T<br>o<br>n<br>s';
		else
		var ylab='V<br>a<br>l<br>u<br>e<br> <br>i<br>n<br> <br>R<br>u<br>p<br>e<br>e<br>s<br>/<br>C<br>r<br>o<br>r<br>e<br>s';
		var sqv1=window['s'+qv+cat+y];
		var str1= new Array();
		str1=sqv1;

		var str=str1.split(',');
		if(qv=='q') {
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
    
	  	if(qv=='q')
		smax=parseInt(smaxx)+1000;
	  	else
		smax=smaxv;
	  
		var smin = Math.min.apply(Math, s);
		var rem1=parseFloat(smin)/100;
		var rem2=Math.round(rem1);
		//alert(smin);
		smin=((parseFloat(rem2)-1)*100)-500;
		if(smin=="")
		smin=4000;
	  mnn=0;

		    s1=[s[0],s[1],s[2],s[3],s[4],s[5],s[6],s[7],s[8],s[9],s[10],s[11]];
 //       var s2 = [7, 5, 3, 2];
         var ticks = ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'];
	  //alert(s1);
        
      plot2 = $.jqplot(chrt, [s1], {
          title: {
            text: tit,
            fontSize: '18px',
            textColor: 'var(--bs-dark)',
            fontFamily: 'Inter, sans-serif',
          },
          grid: {
            background: '#ffffff',
            borderColor: '#e0e0e0',
            shadow: false,
            drawBorder: true,
            gridLineColor: '#f5f5f5',
            gridLineWidth: 1,
          },
          seriesDefaults: {
            renderer: $.jqplot.BarRenderer,
            rendererOptions: {
              varyBarColor: true,
              barWidth: 25,
              shadow: false,
              barPadding: 5,
              barMargin: 10,
              animation: { speed: 1000 },
              highlightMouseOver: true,
            },
            pointLabels: {
              show: true,
              formatString: '%d',
              location: 'n',
              ypadding: 5,
              fontSize: '0.9rem',
              textColor: '#34495e',
            },
            markerOptions: {
              show: false,
              style: 'filledCircle',
              size: 10,
              color: '#2ecc71',
            },
          },
          series: [
            {
              renderer: $.jqplot.BarRenderer,
              rendererOptions: { varyBarColor: true },
              showHighlight: true,
            },
          ],
          axes: {
            xaxis: {
              renderer: $.jqplot.CategoryAxisRenderer,
              ticks: ticks,
              label: xlab,
              labelOptions: {
                fontSize: '1rem',
                textColor: '#2c3e50',
              },
              tickOptions: {
                angle: 0,
                fontSize: '0.9rem',
                textColor: '#7f8c8d',
                showMark: true,
              },
            },
            yaxis: {
              min: mnn,
              max: smax,
              numberTicks: 11,
              label: ylab,
              labelOptions: {
                fontSize: '1rem',
                textColor: '#2c3e50',
              },
              tickOptions: {
                fontSize: '0.9rem',
                textColor: '#7f8c8d',
              },
            },
          },
          highlighter: {
            show: true,
            showMarker: true,
            showTooltip: true,
            tooltipAxes: 'y',
            tooltipLocation: 'n',
            tooltipFadeSpeed: 'fast',
            sizeAdjust: 7.5,
            tooltipFormatString: '<b>%s</b>',
          },
          animate: true,
          animateReplot: true,

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

	var val1=window['s'+val+catn+1].split(',');
	var val2=window['s'+val+catn+2].split(',');
	var chk1=0; var chk2=0;
	for(i=0;i<val1.length;i++)
	{
		if(val1[i]!='')
			chk1=1;
	}
	for(i=0;i<val2.length;i++)
	{
		if(val2[i]!='')
			chk2=1;
	}
	if(chk1==1)
  	grph('chart2',1,catn,val);
 	if(chk2==1)
 	grph('chart3',2,catn,val);
}
  </script>


                           <!-- End additional plugins -->
                  </div>
                </form>
              <a href="javascript:window.print()" target="_blank"></a>
      </div>
  </div>

<!--------------Footer--------------->
<?php include "tb_footer.php"; ?>
<?php include "graph.php"; ?>


</body>
</html>