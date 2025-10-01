<?php
//ob_start();
//session_start();
//header("Cache-control: private"); 
include_once("include/includei.php");

/*$selcont=executework("select * from tob_cms where pageid=3");
$rowc=@mysql_fetch_array($selcont);
*/
$selb=executework("SELECT min(`sl_no`) as min_sl,max(`sl_no`) as max_sl FROM `tob_brdmember`");
$rowb=@mysqli_fetch_array($selb);
$s=1;

$min=$rowb['min_sl'];
$max=$rowb['max_sl'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tobacco Board, Guntur</title>
<style>
.members {
	-webkit-box-shadow: inset 0px 0px 15px 0px rgba(31,31,31,1);
	-moz-box-shadow: inset 0px 0px 15px 0px rgba(31,31,31,1);
	box-shadow: inset 0px 0px 15px 0px rgba(31,31,31,1);
	padding:15px;
}

.members1 {
	-webkit-box-shadow: 10px 10px 0px 1px rgba(133,133,133,0.73);
	-moz-box-shadow: 10px 10px 0px 1px rgba(133,133,133,0.73);
	box-shadow: 10px 10px 0px 1px rgba(133,133,133,0.73);
		box-shadow: inset 0px 0px 15px 0px rgba(31,31,31,1);
	padding:15px;

}
</style>
</head>
<body>
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
    <td width="230" rowspan="2" valign="top" bgcolor="#ededed" >
	<?php include_once("leftmenu.php")
  ?>	</td>
    <td colspan="2" valign="middle"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#e7e6e6" class="tabbor">
      <tr>
        <td height="25" bgcolor="#e7e6e6"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td><div class="breadcrumb flat"> <a href="#" class="active">Home</a> <a href="#">About Us</a> <a href="#">Board Members</a> </div>
                </td>
          </tr>
        </table>
        </td>
           <td width="8%" bgcolor="#e7e6e6">
		   <?php
		   		if(empty($_GET['prin']))
				{
		   ?>
		   <a href="#" onclick="MM_openBrWindow('bactivities.php?prin=y','','width=800,height=600')"><img src="tob2_imgs/printButton.gif" border="0" /></a> <a href="#" onclick="MM_openBrWindow('bactivities.php?prin=y','','width=800,height=600')">Print</a>
		   <?php
		   		}
		   ?>
		   </td>
      </tr>
    </table>
      
      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#FF9900" style="border-spacing:10px">
        <tr>
         <?php /*?> <td><div align="center"><span class="innercontent"><?php echo $rowc['content'] ?></span></div></td><?php */?>
         <?php
		 
		 	for($i=$min;$i<=$max;$i++)
			{
				$sel_brd=executework("select * from tob_brdmember where status='1' and sl_no='".$i."' order by sl_no,id desc");
				$cnt_brd=@mysqli_num_rows($sel_brd);
				if($cnt_brd>0)
				{
					while($row_brd=@mysqli_fetch_array($sel_brd))
					{
		 ?>
             <td class="members1" style="width:50%; min-height:100px; height:130px; vertical-align:top">
             <?php
                //if(($row_brd['sl_no']!="")&&($row_brd['sl_no']==$i))
             ?>
    <table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">
    <tbody>
    <tr>
    <td width="85" style="vertical-align:top"><?php if(!empty($row_brd['image'])) { ?><img style="margin-right: 10px;" src="../tbdata/members/<?php echo $row_brd['image']; ?>" alt="" width="69" height="88" /> <?php } else {?><img style="margin-right: 10px;" src="../tbdata/members/boardmembers_thumb.gif" alt="" width="69" height="88" /><?php }?></td>
    <td width="819" style="vertical-align:top"><strong><?php echo $row_brd['name']; ?></strong><br /><strong><?php echo $row_brd['designation']; ?></strong><br /> <?php echo $row_brd['addr']; ?></td>
    </tr>
    </tbody>
    </table>
  
<!--<td>
<p>&nbsp;</p>
</td>-->
  </td>
		<?php
				$s++;
				
						if($s>2) 
						{ 
							$s=1;
				 ?> 
					   </tr> <tr> 
						<?php 
						} 
				
					} 
				}
				else
				{
				?>
                <td class="members1" style="width:50%; min-height:100px; height:130px; vertical-align:top">
                <table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">
    <tbody>
    <tr>
    <td width="85" style="vertical-align:top;">&nbsp;</td>
    <td width="819" style="vertical-align:top">&nbsp;</td>
    </tr>
    </tbody>
    </table>
                </td>
		<?php
				$s++;
				
						if($s>2) 
						{ 
							$s=1;
				 ?> 
					   </tr> <tr> 
						<?php 
						} 
				
				}
        	} 
        
        ?>
        </tr>
      </table>      </td>
  </tr>
  <tr>

    <td colspan="2" valign="top"><table width="90%" border="0" align="right">
      <tr>
        <td>&nbsp;</td>
        <td width="20%"><div align="right"><a href="#top" ><img src="tob2_imgs/bact2top.jpg" width="94" height="27" border="0" title="Back to top" alt="Back to Top" /></a></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><img src="tob2_imgs/spacer.png" width="220" height="1" /></td>
    <td width="826" valign="top"><img src="tob2_imgs/spacer.png" width="535" height="1" /></td>
    <td width="263" valign="top"><img src="tob2_imgs/spacer.png" width="225" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><?php include_once("footer.php")
  ?></td>
  </tr>
</table>
</body>
</html>

                            
                            