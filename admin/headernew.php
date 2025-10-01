<?php
date_default_timezone_set("Asia/Calcutta");
		if(isset($_SESSION['tobadmin']) && $_SESSION['tobadmin']=='admin')
		{
			$detai=array('ADD','VIEW','MODIFY','DELETE','PRINT');
			$stateos=array('Andra Pradesh','Karnataka');
		}
		else if(isset($_SESSION['tobadmin']))
		{
			$sel=executework("select * from tob_employeeview where username='".$_SESSION['tobadmin']."'");
			$rowp=@mysqli_fetch_array($sel);
			$details=array($rowp['permissions']);
			foreach($details as $detail)
			$detai=explode(',',$detail);
			
			$stateos=array($rowp['state']);
			//foreach($stateos as $stateo)
			//$sst=explode(',',$stateo);
			$sst=implode("','",$stateos);
			
		}
		else
		$detai=array();
		$sst=array();
	if(!empty($_SESSION['tob']) && $_SESSION['tob']=='admin')
	{
	$selectr=executework("select * from tob_admin where admin='".$_SESSION['tobadmin']."'");
	$rowtr=@mysqli_fetch_array($selectr);
	}
	if(!empty($_SESSION['tob']) && $_SESSION['tob']=='state')
	{
	$stct=executework("select * from tob_employeeview where username='".$_SESSION['tobadmin']."'");
	$rowct=@mysqli_fetch_array($stct);
	}
	if(empty($rowct['previous_date']) || $rowtr['previous_date']=='0000-00-00 00:00:00')
	$apdt=$rowtr['current_dt'];
	else
	$apdt=$rowtr['previous_date'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">

<!--

.style2 {font-family: Arial, Helvetica, sans-serif; font-size: 20px; color: #327DC0;}

.style9 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold; color: #FFFFFF; }

a.a:link {

	color: #FFFFFF;

	text-decoration: none;

}

a.a:visited {
	color: #FFFFFF;
	text-decoration: none;
}

a.a:hover {
	color: #FFFFFF;
	text-decoration: none;
}
a.a:active {
	color: #FFFFFF;
	text-decoration: none;
}

.style12 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #FFFFFF; }
.style14 {color: #0000CC}
-->

</style>


</head>
<style>
@import url(https://fonts.googleapis.com/css?family=Roboto:400,700,500);

/* main Styles */

html { box-sizing: border-box; }

*, *:before, *:after { box-sizing: inherit; }

body {
  background: #fafafa;
  font-family: "Roboto", sans-serif;
  font-size: 14px;
  margin: 0;
}

a { text-decoration: none; }

.container {
  width: 1000px;
  margin: auto;
}

h1 { text-align:center; margin-top:150px;}

/* Navigation Styles */

/*nav { background: #333399;
	color:#FFFFFF !important;
 }
nav a {
	color:#FFFFFF !important;
	font-weight:bold;
}
nav ul {
  font-size: 0;
  margin: 0;
  padding: 0;
}

nav ul li {
  display: inline-block;
  position: relative;
}

nav ul li a {
  color: #fff;
  display: block;
  font-size: 14px;
  padding: 15px 14px;
  transition: 0.3s linear;
}

nav ul li:hover { background: #373737 }

nav ul li ul {
  border-bottom: 5px solid #2ba0db;
  display: none;
  position: absolute;
  width: 250px;
}

nav ul li ul li {
  border-top: 1px solid #444;
  display: block;
}

nav ul li ul li:first-child { border-top: none; }

nav ul li ul li a {
  background: #373737;
  display: block;
  padding: 10px 14px;
}

nav ul li ul li a:hover { background: #126d9b; }

nav .fa.fa-angle-down { margin-left: 6px; }
*/</style>

<!--  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<style>
.dropdown-submenu {
  position: relative;
}

.dropdown-submenu .dropdown-menu {
  top: 0;
  left: 100%;
  margin-top: -1px;
}
</style>
--><style>
#nav {
    list-style:none inside;
    margin:0;
    padding:0;
    text-align:center;
	width:120%
    }

#nav li {
    display:block;
    position:relative;
    float:left;
    background: #333399; /* menu background color */
    }

#nav li a {
    display:block;
  
    text-decoration:none;
    width:auto; /* this is the width of the menu items */
    line-height:35px; /* this is the hieght of the menu items */
    color:#ffffff; /* list item font color */
	padding:8px;
    }
        
#nav li li a {
	font-size:100%;
 	display:block;
    text-decoration:none;
    width:200px; /* this is the width of the menu items */
    line-height:35px; /* this is the hieght of the menu items */
    color:#ffffff; /* list item font color */
	padding:3px;
	float:left;
} /* smaller font size for sub menu items */
    
#nav li:hover {background:#003f20;} /* highlights current hovered list item and the parent list items when hovering over sub menues */



/*--- Sublist Styles ---*/
#nav ul {
    position:absolute;
    padding:0;
    left:0;
    display:none; /* hides sublists */
	z-index:999999;
    }

#nav li:hover ul ul {display:none;} /* hides sub-sublists */

#nav li:hover ul {display:block;} /* shows sublist on hover */

#nav li li:hover ul {
    display:block; /* shows sub-sublist on hover */
    margin-left:200px; /* this should be the same width as the parent list item */
    margin-top:-35px; /* aligns top of sub menu with top of list item */
    }
</style>
<body>

<script language="JavaScript1.2">mmLoadMenus();</script>
<?php
$selm=executework("select * from tob_pages where menu_id=0 and isactive=1 order by morder");
?>

<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td width="412" background="tob2_imgs/logo_bg1.jpg"><img src="../img/logo.png" width="475" height="93" /></td>

    <td width="568" background="tob2_imgs/logo_bg1.jpg"><div align="center" class="style2">TOBACCO BOARD ADMIN </div></td>

  </tr>

  <tr>

    <td colspan="2" height="">
    <?php include "menu_new.php"; ?>
    </td></tr></table>
    

<script>
$('nav li').hover(
  function() {
	  $('ul', this).stop().slideDown(200);
  },
	function() {
    $('ul', this).stop().slideUp(200);
  }
);
</script>


<script>
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>
