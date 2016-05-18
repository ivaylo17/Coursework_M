
<?php

//  
//                                       
//                                         
//                                         
//	set error reporting
error_reporting(E_ALL);
//	open connection
$link = mysql_connect('localhost', 'root', '');
if (!$link) {
    //
    //	print error and exit()
    echo " MySQL Error: " . mysql_error();
    exit();
}
$fDBG = 0;
//
//	select db
mysql_select_db("lotto"); //17.05
//	get data from _GET
$smsID = $_GET["smsID"];
$MSISDN = $_GET["MSISDN"];
$mobileSP = $_GET["msp"];
$smsBody = $_GET["smsBody"];
//
//	prepare data (delete space and etc.)
$smsBody = str_replace(" ", "", $smsBody);
if ($fDBG == 1)
    echo "<br>  smsBody=$smsBody";
//
//	add slashes
$smsID = addslashes($smsID);
$MSISDN = addslashes($MSISDN);
$mobileSP = addslashes($mobileSP);
$smsBody = addslashes($smsBody);
$args = explode(':', $smsBody);  // !!!ERR be     
$type = $args[0];
$ClientNumbersString = $args[1];
if ($fDBG == 1)  echo "<br>  Entered   (Client) data: ClientNumbersString = $ClientNumbersString <br>";
$ClientNumbersArr = explode(',', $ClientNumbersString);
if ($fDBG == 1)    echo '<br> INPUT  DATA ';
if ($fDBG == 1)    echo '<br> Entered type of game =' . $type;
if ($fDBG == 1)    echo "<br>  Entered   (Client) data: <br>";
if ($fDBG == 1)    foreach ($ClientNumbersArr as $n) {   echo "     $n, ";  } echo " <br />";
//
//	select SQL   //17.05
$selectSQL = "
	SELECT 
		* 
	FROM 
	       lotto  
           WHERE type = '$type'
        ORDER BY  DT  DESC LIMIT 1	
";
//	exec SQL
$rSelect = mysql_query($selectSQL);
//  check result
if ($rSelect == false) {
    //
    //	print error and exit()
    echo "-ERR MySQL Error: " . mysql_error() . "\nSQL: $selectSQL";
    exit();
} //else {
//
//	get row count
$NumOfRows = mysql_num_rows($rSelect);
if ($fDBG == 1)    echo "<br> NumOfRows =$NumOfRows ";
//	check row count
if ($NumOfRows == 0) {
    echo "+OK Invalid type of game. "; 
    exit();
}
//	fetch data
while ($row = mysql_fetch_array($rSelect)) {
    //	get data
    $id = $row['id'];
    $Game = $row['Game'];
    $Data = $row['Data'];
    $DT = $row['DT'];
    if ($fDBG == 1)  echo "  <br>From lotto : Game=$Game, Data=$Data, DT=$DT ";
}
$WinNumbers = explode(',', $Data);
$NumEl = count($ClientNumbersArr);
if ($fDBG == 1) {echo "<br>* Values of Win number array is: ";    foreach ($WinNumbers as $n)    echo " $n, ";} 
if ($fDBG == 1){ echo "<br>* Values of ClientNumbersArr  is: <br />"; foreach ($ClientNumbersArr as $n)  echo "  $n, ";}
// find recognized (shot)
$dif = array_diff($WinNumbers, $ClientNumbersArr);
if ($type == 1)    $NumOfShot = 5 - count($dif);
if ($type == 2)    $NumOfShot = 6 - count($dif);
if ($type == 3)    $NumOfShot = 3 - count($dif);

echo "<br>";
echo "+OK For $Game Poznati cisla=$NumOfShot";
//	close connection
mysql_close($link);
?>
