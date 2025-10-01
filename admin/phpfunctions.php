<?php
// Change date format from yyyy/mm/dd to dd/mm/yyyy

function datepattrn($a)
{

	if($a!="" && $a!='0000-00-00')
	{
		$b = substr($a,5, 2);// month
	
		$c = substr($a,7, 1);// '-'
	
		$d= substr($a,8, 2);// day
	
		$e = substr($a,4, 1);// '-'
	
		$f = substr($a,0, 4);// year
	
		$g=$d."/".$b."/".$f;
	}
	else
	$g="";

	return $g;
}



// Change date format from dd/mm/yyyy to yyyy/mm/dd

function datepattrn1($a)

{

	if($a!="" && $a!='00-00-0000')
	{
		$b = substr($a,3, 2);// month
	
		$c = substr($a,2, 1);// '-'
	
		$d= substr($a,0, 2);// day
	
		$e = substr($a,5, 1);// '-'
	
		$f = substr($a,6, 4);// year
	
		$g=$f."/".$b."/".$d;
	}
	else
	$g="";

	return $g;

}


// Change date format from yyyy/mm/dd HH:ii:ss to dd/mm/yyyy HH:ii:ss

function datimpattrn($a)
{

	if($a!="")
	{
		$b = substr($a,5, 2);// month
	
		$c = substr($a,7, 1);// '-'
	
		$d= substr($a,8, 2);// day
	
		$e = substr($a,4, 1);// '-'
	
		$f = substr($a,0, 4);// year
		
		$h= substr($a,11,8);
	
		$g=$d."/".$b."/".$f." ".$h;
	}
	else
	$g="";

	return $g;
}


// Change date format from dd/mm/yyyy HH:ii:ss to yyyy/mm/dd HH:ii:ss

function datimpattrn1($a)
{

	if($a!="")
	{
		$b = substr($a,3, 2);// month
	
		$c = substr($a,2, 1);// '-'
	
		$d= substr($a,0, 2);// day
	
		$e = substr($a,5, 1);// '-'
	
		$f = substr($a,6, 4);// year
	
		$h= substr($a,11,8);
	
		$g=$f."/".$b."/".$d." ".$h;
		
	}
	else
	$g="";

	return $g;

}



// delete folders and sub folders of a directory
function delTree($dir) {
    $files = glob( $dir . '*', GLOB_MARK );
    foreach( $files as $file ){
        if( substr( $file, -1 ) == '/' )
            delTree( $file );
        else
            unlink( $file );
    }
    //rmdir( $dir );
}


/// creating zip of a dir
function createZipFromDir($dir, $zip_file) {
    $zip = new ZipArchive;
    if (true !== $zip->open($zip_file, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE)) {
        return false;
    }
    zipDir($dir, $zip);
    return $zip;
}

function zipDir($dir, $zip, $relative_path = DIRECTORY_SEPARATOR) {
    $dir = rtrim($dir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    if ($handle = opendir($dir)) {
       while (false !== ($file = readdir($handle))) {
            if (file === '.' || $file === '..') {
                continue;
            }
            if (is_file($dir . $file)) {
                $zip->addFile($dir . $file, $file);
            } elseif (is_dir($dir . $file)) {
                zipDir($dir . $file, $zip, $relative_path . $file);
            }
        }
    }
    closedir($handle);
}

// zip files and download
function zipFilesAndDownload($file_names,$archive_file_name,$file_path)
{
  //create the object
  $zip = new ZipArchive();
  //create the file and throw the error if unsuccessful
  if ($zip->open($archive_file_name, ZIPARCHIVE::CREATE )!==TRUE) {
    exit("cannot open <$archive_file_name>\n");
  }

  //add each files of $file_name array to archive
  foreach($file_names as $files)
  {
//  	echo $file_path.$files.".csv<br>";
	$file1="/".$files.".csv";
    $zip->addFile($file_path.$file1,$file1);
//	echo $zip->addFile($file_path.$file1,$file1);
  }
//  print_r($zip);
  $zip->close();

  //then send the headers to foce download the zip file
  header("Content-type: application/zip");
  header("Content-Disposition: attachment; filename=$archive_file_name");
  header("Pragma: no-cache");
  header("Expires: 0");
  readfile("$archive_file_name");
  exit;
}

// creating zip of a folder
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
	  $file1=$ndir."/".$file.".csv";
      if(file_exists($file1)) {
        $valid_files[] = $file;
      }
    }
  }
//  echo "des=".$destination;
  //if we have good files...
  if(count($valid_files)) {
    //create the archive
    $zip = new ZipArchive();
    if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
      return false;
    }
    //add the files
    foreach($valid_files as $file) {
	  $file1=$ndir."/".$file.".csv";
      $zip->addFile($file1,$file.".csv");
    }
    //debug
    //echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
//    print_r($zip);
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

// get max of a filed value in a table *** 1 ****
function max_id($table,$field)
{
	$selmax=executework("select max(".$field.") from ".$table);
	$rows=@mysqli_fetch_array($selmax);
	if($rows[0]!="")
	$maxid=$rows[0]+1;
	else
	$maxid=1;
	return $maxid;
}

// get max of a filed value in a table *** 101 ****
function max_id1($table,$field)
{
	$selmax=executework("select max(".$field.") from ".$table);
	$rows=@mysqli_fetch_array($selmax);
	if($rows[0]!="")
	$maxid=$rows[0]+1;
	else
	$maxid=101;
	return $maxid;
}

// get max of a filed value in a table *** 1001 ****
function max_id2($table,$field)
{
	$admn=array();
	
	$selmax=executework("select max(".$field.") from ".$table);
	$rows=@mysqli_fetch_array($selmax);
	if($rows[0]!="")
	$maxid=$rows[0]+1;
	else
	$maxid=1001;
	return $maxid;
}

// round the number to n no of decimals
function numround($st,$n)
{
	if($st!="")
	{
		$n1=pow(10 ,$n);
		$num=round($st*$n1)/($n1);
	}
	return $num;
}

// get no of days between 2 days
function GetDays($sStartDate, $sEndDate){  
  // Firstly, format the provided dates.  
  // This function works best with YYYY-MM-DD  
  // but other date formats will work thanks  
  // to strtotime().  
  $sStartDate = gmdate("Y-m-d", strtotime($sStartDate));  
  $sEndDate = gmdate("Y-m-d", strtotime($sEndDate));  
  
  // Start the variable off with the start date  
  $aDays[] = datepattrn($sStartDate);  
  
  // Set a 'temp' variable, sCurrentDate, with  
  // the start date - before beginning the loop  
  $sCurrentDate = $sStartDate;
  
  // While the current date is less than the end date
  while($sCurrentDate < $sEndDate){
    // Add a day to the current date  
    $sCurrentDate = gmdate("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));  
  
    // Add this new day to the aDays array  
    $aDays[] = datepattrn($sCurrentDate);  
  }
  
  // Once the loop has finished, return the  
  // array of days.  
  return $aDays;  
}

function get_timest()
{
	$tm=0;
	$tm=(5*60*60)+(30*60);
	return $tm;
}

function generate_droplist_bydata($qr,$label,$val)
{
	while($row=@mysqli_fetch_array($qr))
	{
		$drp=$drp."<option value=";
		$drp.=$row[$val]." />";
		$drp.=$row[$label];
		$drp.="</option>";
	}
	return $drp;
}

// --- random no generation
function str_rand($length, $seeds)
{
    // Possible seeds
    $seedings['alpha'] = 'abcdefghijklmnopqrstuvwqyz';
    $seedings['numeric'] = '0123456789';
    $seedings['alphanum'] = 'abcdefghijklmnopqrstuvwqyz0123456789';
    $seedings['hexidec'] = '0123456789abcdef';
    
    // Choose seed
    if (isset($seedings[$seeds]))
    {
        $seeds = $seedings[$seeds];
    }
    
    // Seed generator
    list($usec, $sec) = explode(' ', microtime());
    $seed = (float) $sec + ((float) $usec * 100000);
    mt_srand($seed);
    
    // Generate
    $str = '';
    $seeds_count = strlen($seeds);
    
    for ($i = 0; $length > $i; $i++)
    {
        $str .= $seeds[mt_rand(0, $seeds_count - 1)];
    }
    
    return $str;
}

?>