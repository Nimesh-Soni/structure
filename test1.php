<?php
require_once("includes-nct/config-nct.php");
echo CurrencyConvert(10,'usd','eur');

//echo convertCurrency(1, "USD", "INR");
//echo currency('USD','EUR',10);
function currency($from_Currency,$to_Currency,$amount) {
    $amount = urlencode($amount);
    $from_Currency = urlencode($from_Currency);
    $to_Currency = urlencode($to_Currency);
    $url = "http://www.google.com/ig/calculator?hl=en&q=$amount$from_Currency=?$to_Currency";
    $ch = curl_init();
    $timeout = 0;
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch,  CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $rawdata = curl_exec($ch);
    curl_close($ch);
    $data = explode('"', $rawdata);
    $data = explode(' ', $data['3']);
    $var = $data['0'];
    return round($var,2);
}
function convertCurrency($amount, $from, $to){
    $url  = "https://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
    $data = file_get_contents($url);
    preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
    $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
    return round($converted, 3);
}
exit;
/*$Bar = "a";
  $Foo = "Bar";
  $World = "Foo";
  $Hello = "World";
  $a = "Hello";

  echo '<br/>'.$a; //Returns Hello
  echo '<br/>'.$$a; //Returns World
  echo '<br/>'.$$$a; //Returns Foo
  echo '<br/>'.$$$$a; //Returns Bar
  echo '<br/>'.$$$$$a; //Returns a

  echo '<br/>'.$$$$$$a; //Returns Hello
  echo '<br/>'.$$$$$$$a; //Returns World

  $nameTypes    = array("first", "last", "company");
$name_first   = "John";
$name_last    = "Doe";
$name_company = "PHP.net";

// Then this loop is ...
foreach($nameTypes as $type)
  print ${"name_$type"} . "\n";

// ... equivalent to this print statement.
print "$name_first\n$name_last\n$name_company\n";

$tab = array("one", "two", "three") ;
$a = "tab" ;
${$a}[] =  "four" ; // <==== this is the correct way to do it
print_r($tab) ;

require_once("includes-nct/config-nct.php");
// $ds contains the total number of bytes available on "/"
//$ds = disk_total_space(DIR_UPD);
//echo $ds = disk_total_space("/");

// On Windows:
//echo '<br/>'.$ds = disk_total_space("C:");
//echo '<br/>'.$ds = disk_total_space("D:");

function folderSize($dir){
$count_size = 0;
$count = 0;
$dir_array = scandir($dir);
  foreach($dir_array as $key=>$filename){
    if($filename!=".." && $filename!="."){
       if(is_dir($dir."/".$filename)){
          $new_foldersize = foldersize($dir."/".$filename);
          $count_size = $count_size+ $new_foldersize;
        }else if(is_file($dir."/".$filename)){
          $count_size = $count_size + filesize($dir."/".$filename);
          $count++;
        }
   }
 }
return $count_size;
}
	$folder_name = DIR_UPD;
  echo folderSize($folder_name);

function sizeFormat($bytes){ 
$kb = 1024;
$mb = $kb * 1024;
$gb = $mb * 1024;
$tb = $gb * 1024;

if (($bytes >= 0) && ($bytes < $kb)) {
return $bytes . ' B';

} elseif (($bytes >= $kb) && ($bytes < $mb)) {
return ceil($bytes / $kb) . ' KB';

} elseif (($bytes >= $mb) && ($bytes < $gb)) {
return ceil($bytes / $mb) . ' MB';

} elseif (($bytes >= $gb) && ($bytes < $tb)) {
return ceil($bytes / $gb) . ' GB';

} elseif ($bytes >= $tb) {
return ceil($bytes / $tb) . ' TB';
} else {
return $bytes . ' B';
}
}

$folder_name = DIR_UPD;
echo '<br/>'.sizeFormat(folderSize($folder_name));*/
?>