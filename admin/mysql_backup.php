<?php
ob_start();
session_start();
//header("Cache-control: private"); 
include "include/includei.php";
///include "include/dbfunctions.php";
function create_zip($files = array(),$ndir,$destination = '',$overwrite = true) {
  //if the zip file already exists and overwrite is false, return false
  if(file_exists($destination) && !$overwrite) { return false; }
  //vars
  $valid_files = array();
  //if files were passed in...
  if(is_array($files)) {
    //cycle through each file
    foreach($files as $file) {
      //make sure the file exists
	  $file1=$ndir.$file.".csv";
      if(file_exists($file1))
	  {
	   	 $valid_files[] = $file;
      }
    }
  }
//  echo "des=".$destination;
  //if we have good files...
  if(count($valid_files))
   {
    //create the archive
    $zip = new ZipArchive();
	//echo "des=".$destination=$destination;
//	echo $overwrite;
	//---------deleted Content------------//
//	echo $overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE;
	//echo "///////////////";
	//echo $overwrite;
//	
//	$res = $zip->open($destination,$overwrite ? ZipArchive::CREATE: ZIPARCHIVE::CREATE);
//	echo $res."////////////////////".$destination;
//	 if(res != true)
//	 {  echo "wel";
//	 	exit();
//     	return false;
//     }
//	exit();
	
//    if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) != true)
//	 { 
//     	return false;
//     }
	 $zip->open($destination, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE);
	//---------deleted Content------------//
    //add the files
	
    foreach($valid_files as $file)
	{
	  $file1=$ndir."/".$file.".csv";
      $zip->addFile($file1,$file.".csv");
    }
    //debug
    //echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
	//print_r($zip);
    //close the zip -- done!
    $zip->close();
    
    //check to make sure the file exists
    return file_exists($destination);
  }
  else
  {
    return false;
  }
}


//include_once("phpfunctions.php");
//include_once("header.php");
if($_SESSION['tobadmin']!="")
{
$datefg = date('dmYHis');
/* backup the db OR just a table */
function backup_tables($ndir,$tables)
{
	//get all of the tables
	if($tables == '*')
	{
	$tables = array();
	$result = executework('SHOW TABLES');
	while($row = @mysqli_fetch_row($result))
	{
		$tables[] = $row[0];
	}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	//cycle through
	$return='';
	foreach($tables as $table)
	{
		exportMysqlToCsv($table,$ndir."/".$table.'.csv');

	$result = executework('SELECT * FROM '.$table.'');
	$num_fields = @mysqli_num_fields($result);
	$row2 = @mysqli_fetch_row(executework('SHOW CREATE TABLE '.$table));
	$return.= '\n\n'.$row2[1].';\n\n';
		for ($i = 0; $i < $num_fields; $i++)
		{
		while($row = @mysqli_fetch_row($result))
		{
		$return.= 'INSERT INTO '.$table.' VALUES(';
		for($j=0; $j<$num_fields; $j++)
		{
		$row[$j] = addslashes($row[$j]);
		$row[$j] = ereg_replace('\n','\\n',$row[$j]);
		if (isset($row[$j])) { $return.= '”'.$row[$j].'”' ; } else { $return.= '”"'; }
		if ($j<($num_fields-1)) { $return.= ','; }
		}
		$return.= ');\n';
		}
		}
	$return.='\n\n\n';
			$fname=$table.'.csv';
			$fileName = $fname; 
			//echo "hi7777-------".$fileName;
	}
}
function exportMysqlToCsv($table,$filename)
{
    $csv_terminated = "\n";
    $csv_separator = ",";
    $csv_enclosed = '"';
    $csv_escaped = "\\";
    $sql_query = "select * from $table ";
    // Gets the data from the database
    $result = executework($sql_query);
    $fields_cnt = @mysqli_num_fields($result);
    $schema_insert = '';
    for ($i = 0; $i < $fields_cnt; $i++)
    {
        $l = $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed,
            stripslashes(mysqli_field_name($result, $i))) . $csv_enclosed;
        $schema_insert .= $l;
        $schema_insert .= $csv_separator;
    } // end for
    $out = trim(substr($schema_insert, 0, -1));
    $out .= $csv_terminated;
    // Format the data
    while ($row = @mysqli_fetch_array($result))
    {
        $schema_insert = '';
        for ($j = 0; $j < $fields_cnt; $j++)
        {
            if ($row[$j] == '0' || $row[$j] != '')
            {
 
                if ($csv_enclosed == '')
                {
                    $schema_insert .= $row[$j];
                } else
                {
                    $schema_insert .= $csv_enclosed . 
					str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $row[$j]) . $csv_enclosed;
                }
            } else
            {
                $schema_insert .= '';
            }
 
            if ($j < $fields_cnt - 1)
            {
                $schema_insert .= $csv_separator;
            }
        } // end for
 
        $out .= $schema_insert;
        $out .= $csv_terminated;
    } // end while
 
/*    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Length: " . strlen($out));
    // Output to browser with appropriate mime type, you choose ;)
    header("Content-type: text/x-csv");
    //header("Content-type: text/csv");
    //header("Content-type: application/csv");
    header("Content-Disposition: attachment; filename=$filename");
*/ 
	$handle = fopen($filename,'w+');
	fwrite($handle,$out);
	fclose($handle);
//   echo $out;
 //   exit;
 
}

/*if(!is_dir($datefg))
{
	mkdir($datefg);
}
*/

foreach (scandir("backup") as $item) {
    if ($item == '.' || $item == '..') continue;
    unlink("backup".DIRECTORY_SEPARATOR.$item);
	
	//echo  unlink($datefg.DIRECTORY_SEPARATOR.$item);
}//delTree("smartbackup/".$cid."/".$dr);


$ndir="backup/";

	$tabls=array('tob_vacancies','tob_upload','tob_tender','tob_statistics','tob_states','tob_reg','tob_publications','tob_platfrm','tob_platform','tob_page','tob_nletter','tob_news','tob_location','tob_latest','tob_imageslide','tob_images','tob_gsettings','tob_grade','tob_expreg','tob_export','tob_employeeview','tob_employee','tob_designation','tob_cms1','tob_cms','tob_circulars','tob_auction','tob_auct','tob_album_title','tob_admin');//$tabls=array('honda_admin','honda_booking','honda_consultant','honda_declare','honda_freeze','honda_new','honda_privileges','honda_purchase','honda_recpt','honda_retail','honda_sales','honda_transfer','honda_users');
	//$frm='1,2,6,7,8,9,10';


$dat=date('dmYHis');
//	backup_tables('localhost','vidyar48_athithi','athithi2004','vidyar48_athithi',$ndir,$frm,$cid,$tabls);
	$dd =backup_tables($ndir,$tabls);
	
	//$dd =backup_tables('localhost','syama124_exaams','Ex@m2In','syama124_exaams',$ndir,$tabls);
	
	//print_r(backup_tables('localhost','root','','ag',$ndir,$tabls));
//	$fil=$ndir."/pmed_".$datefg.".zip";	

$fil=$ndir."tbb_".$datefg.".zip";	
$result = create_zip($tabls,$ndir,$fil);
//header("Location: $fil");
//echo "echo hi---------".$fil;
redirect($fil);
}
else
{
?>
<script language="javascript">location.href="index.php";</script>
<?php
}
?>