

<!DOCTYPE html>
<html>
    <head> SMS </head>
 
 <?php
//  
//  http://localhost/ php2016/SMS1.php
//  
//
//	set error reporting
error_reporting(E_ALL);
	
	//	open connection
$link = mysql_connect('localhost', 'root', '');

if(!$link)
{
	//
	//	print error and exit()
	echo "-ERR MySQL Error: ".mysql_error();//change text
	exit();
}

//
//	select db
mysql_select_db("ivo2016");
	//	get data from _GET
$smsID = $_GET["smsID"];
$MSISDN = $_GET["MSISDN"];
$mobileSP = $_GET["msp"];
$smsBody = $_GET["smsBody"];

//
//	prepare data (delete space and etc.)
$smsBody = str_replace(" ","", $smsBody);

//
//	add slashes
$smsID = addslashes($smsID);
$MSISDN = addslashes($MSISDN);
$mobileSP = addslashes($mobileSP);
$smsBody = addslashes($smsBody);
$ClientNumbers = explode(':',$smsBody); // arg 
    $A1 = $ClientNumbers[0];
	$B1 = $ClientNumbers[1];
	$C1 = $ClientNumbers[2];
	$D1 = $ClientNumbers[3];
	$E1 = $ClientNumbers[4];
	$F1 = $ClientNumbers[5];

	foreach ($ClientNumbers as $n) {  echo " $n";     } echo " <br />";
	
//
//	search SQL in codes
$selectSQL = "
	SELECT 
		* 
	FROM 
		numbers    
		
";
	
	
	
	//	exec SQL
$rSelect = mysql_query($selectSQL);

//  check result
if($rSelect == false)
{
	//
	//	print error and exit()
	echo "-ERR MySQL Error: ".mysql_error()."\nSQL: $selectSQL";
	exit();
}   
else 
{
	//
	//	get row count
	$count = mysql_num_rows($rSelect);   

	//
	//	check row count
	if($count == 0)
	{
		//
		//	print text for invalid code
		echo "+OK No enough numbers.";
		exit();
	}
	//	fetch data
	$row = mysql_fetch_array($rSelect);
	//
	//	get data
	$A1 = $row['A1'];
	$B1 = $row['B1'];
	$C1 = $row['C1'];
	$D1 = $row['D1'];
	$E1 = $row['E1'];
	$F1 = $row['F1'];

	//echo "A1=$A1,B1=$B1,C1=$C1,D1=$D1,E1=$E1, F1=$F1 ";
	
	
//
//	define function 
//
	
	
	$WinNumbers = array ($A1,$B1,$C1,$D1,$E1,$F1);
    echo "Values of Win number array is: <br />";
    foreach ($WinNumbers as $n) {  echo " $n";   } echo " <br />";
    $smsBody = $_GET["smsBody"];
    echo ' The beginning : ' . $smsBody . '<br>';
   //$count = getInfoFromSMSbody($smsBody, $WinNumbers);
    //echo '<br />  !!!!!!  After function: $count1=' . $count1 . '<br />';
	
	 foreach ($WinNumbers as $n) {  echo " $n";     } echo " <br />";
        echo '<br> = =============  <br>';
        // find count
        $count = 0;
        foreach ($ClientNumbers as $n) {
            echo ' * Value is ' . $n . ' <br />';
            for ($i = 0; $i < 6; $i++) {
                $w = $WinNumbers[$i];
                if ($w == $n) {
                    $count++;
                }
            }
        }
        echo '<br> = =============';
        echo '<br /> $count=' . $count . '<br />';
	
	
	$WinNumbers = array ($A1,$B1,$C1,$D1,$E1,$F1);
    function getInfoFromSMSbody($smsBody, $WinNumbers) {
        $ClientNumbers = explode(':', $smsBody);
        echo "Value of ClientNumber  array is: <br />";
        foreach ($ClientNumbers as $n) {  echo " $n";   } echo " <br />";
        echo "Value of Win number  array is: <br />";
        foreach ($WinNumbers as $n) {  echo " $n";     } echo " <br />";
        echo '<br> = =============  <br>';
        // find count
        $count = 0;
        foreach ($ClientNumbers as $n) {
            echo ' * Value is ' . $n . ' <br />';
            for ($i = 0; $i < 6; $i++) {
                $w = $WinNumbers[$i];
                if ($w == $n) {
                    $count++;
                }
            }
        }
        echo '<br> = =============';
        echo '<br /> $count=' . $count . '<br />';
        return $count;
	
	

		
		//	close connection
        mysql_close($link);

		
		
		
    }
}
	?>

</html> 
