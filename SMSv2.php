<!DOCTYPE html>
<html>
    <head> </head>
    <?php
    //  http://localhost/PHP2016/ivoSMS1.php?smsID=1&MSISDN=359899866747&msp=87&smsBody=12:4:23:39:9:48
//  
//
//	set error reporting
    error_reporting(E_ALL);

    //	open connection
    $link = mysql_connect('localhost', 'root', '');

    if (!$link) {
        //
        //	print error and exit()
        echo "-ERR MySQL Error: " . mysql_error();
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
    $smsBody = str_replace(" ", "", $smsBody);

//
//	add slashes
    $smsID = addslashes($smsID);
    $MSISDN = addslashes($MSISDN);
    $mobileSP = addslashes($mobileSP);
    $smsBody = addslashes($smsBody);
    
    $ClientNumbers = explode(':', $smsBody);
    echo "<br>  Entered   (Client) data: <br>";
    foreach ($ClientNumbers as $n) {
        echo "     $n, ";
    } echo " <br />";


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
    if ($rSelect == false) {
        //
        //	print error and exit()
        echo "-ERR MySQL Error: " . mysql_error() . "\nSQL: $selectSQL";
        exit();
    } //else {
    //
        //	get row count
    $count = mysql_num_rows($rSelect);
    echo "<br>   count (NumOfRows) =$count <br>";
    //	check row count
    if ($count == 0) {
        //
        //	print text for invalid code
        echo "+OK No enough numbers";
        exit();
    }

    //	fetch data
    while ($row = mysql_fetch_array($rSelect)) {
        //	get data
        $A1 = $row['A1'];
        $B1 = $row['B1'];
        $C1 = $row['C1'];
        $D1 = $row['D1'];
        $E1 = $row['E1'];
        $F1 = $row['F1'];
        echo "  <br> A1= $A1,  B1= $B1, C1= $C1, D1= $D1,  E1= $A1,  F1= $F1 <br>";
    }


    $WinNumbers = array($A1, $B1, $C1, $D1, $E1, $F1);
    echo "Values of Win number array is: <br />";
    foreach ($WinNumbers as $n) {
        echo "     $n, ";
    } echo " <br />";


    // find recognized (shot)
    $NumOfShot = 0;
    foreach ($ClientNumbers as $n) {
        echo ' * Value is ' . $n . ' <br />';
        for ($i = 0; $i < 6; $i++) {
            $w = $WinNumbers[$i];
            if ($w == $n) {
                $NumOfShot++;
            }
        }
    }
    echo '<br /> $NumOfShot=' . $NumOfShot . '<br />';


    //	close connection
    mysql_close($link);
   
    ?>

</html> 
