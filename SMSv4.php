
<?php

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
mysql_select_db("lotto");
//	get data from _GET
$smsID = $_GET["smsID"];
$MSISDN = $_GET["MSISDN"];
$mobileSP = $_GET["msp"];
$smsBody = $_GET["smsBody"];

//
//	prepare data (delete space and etc.)
$smsBody = str_replace(" ", "", $smsBody);
if ($fDBG == 1)
    echo "<br>  smsBody=$smsBody <br>";

//
//	add slashes
$smsID = addslashes($smsID);
$MSISDN = addslashes($MSISDN);
$mobileSP = addslashes($mobileSP);
$smsBody = addslashes($smsBody);

$args = explode(':', $smsBody);  // !!!ERR be     
$type = $args[0];
$ClientNumbersString = $args[1];
if ($fDBG == 1)
    echo "<br>  Entered   (Client) data: ClientNumbersString = $ClientNumbersString <br>";

$ClientNumbersArr = explode(',', $ClientNumbersString);

if ($fDBG == 1)
    echo '<br> INPUT  DATA ';
if ($fDBG == 1)
    echo '<br> Entered type of game =' . $type;

if ($fDBG == 1)
    echo "<br>  Entered   (Client) data: <br>";
if ($fDBG == 1)
    foreach ($ClientNumbersArr as $n) {
        echo "     $n, ";
    } echo " <br />";


//
//	select SQL 
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
$NumOfRows = mysql_num_rows($rSelect);
if ($fDBG == 1)
    echo "<br>   count (NumOfRows) =$NumOfRows <br>";
//	check row count
if ($NumOfRows == 0) {
    //
    //	print text for invalid code 
    echo "+OK No enough numbers";
    exit();
}

//	fetch data
while ($row = mysql_fetch_array($rSelect)) {
    //	get data
    $id = $row['id'];
    $T1_5_35 = $row['A1'];
    $T2_5_35 = $row['B1'];
    $T_6_49 = $row['C1'];
    $Jokerposition = $row['Jokerposition'];
    $Jokernumbers = $row['Jokernumbers'];
    $Date = $row['Date'];
    if ($fDBG == 1)
        echo "  <br>Frm DB: T1_5_35= $T1_5_35,  T2_5_35= $T2_5_35 , T_6_49= $T_6_49, Jokerposition=$Jokerposition, Jokernumbers=$Jokernumbers, Date= $Date <br>";
}

//case 1   5 ot 35
switch ($type) {

    case "1":

        $arr1 = explode(',', $T1_5_35);
        $NumEl = count($ClientNumbersArr);
        if ($NumEl != 5) {
            //	print error and exit()
            echo "+OK ERR Please enter 5 numbers";
            exit();
        }


        $dif = array_diff($arr1, $ClientNumbersArr);
        $NumElcl = count($arr1);
        $NumEld = count($dif);

        $NumofShot = $NumElcl - $NumEld;
        if ($fDBG == 1)
		echo " NumofShot=$NumofShot ";
        echo "<br><br> +OK For type 1 (5/35) Poznati cisla=$NumofShot";
        break;

    // case 2  5/35- Vtoro teglene 

    case "2":
	
        $arr2 = explode(',', $T2_5_35);
        $NumEl = count($ClientNumbersArr);
        if ($NumEl != 5) {
            //	print error and exit()
            echo "+OK ERR Please enter 5 numbers";
            exit();
        }
        $dif = array_diff($arr2, $ClientNumbersArr);

        $NumElcl = count($arr2);
        $NumEld = count($dif);

        $NumofShot = $NumElcl - $NumEld;
        if ($fDBG == 1)
		echo " NumofShot=$NumofShot ";
        echo "<br><br> +OK For type 2 (5/35) Poznati cisla=$NumofShot";
        break;

    //   case  3    6 ot 49
    case "3":

        $arr3 = explode(',', $T_6_49_35);
        $NumEl = count($ClientNumbersArr);
        if ($NumEl != 6) {
            //	print error and exit()
            echo "+OK -ERR  Please enter 6 numbers";
            exit();
        }
        $dif = array_diff($arr3, $ClientNumbersArr);
        $NumElcl = count($arr3);
        $NumEld = count($dif);

        $NumofShot = $NumElcl - $NumEld;
        if ($fDBG == 1)
		echo " NumofShot=$NumofShot ";
        echo "<br><br> +OK For type 3 (6/49) Poznati cisla=$NumofShot";
        break;

    // Jokerposition
    case "4":

        $arr4 = explode(',', $Jokerposition);
        $NumEl = count($ClientNumbersArr);
        if ($NumEl != 3) {
            //	print error and exit()
            echo "+OK ERR Please enter 3 numbers";
            exit();
        }

        $dif = array_diff($arr4, $ClientNumbersArr);
        $NumElcl = count($arr4);
        $NumEld = count($dif);

        $NumofShot = $NumElcl - $NumEld;
        if ($fDBG == 1)
		echo " NumofShot=$NumofShot ";
        echo "<br><br> +OK For type 4 Jokerposition Poznati cisla=$NumofShot";
        break;

    //Jokernumbers
    case "5":

        $arr5 = explode(',', $Jokernumbers);
        $NumEl = count($ClientNumbersArr);
        if ($NumEl != 3) {
            //	print error and exit()
            echo "+OK ERR Please enter 3 numbers";
            exit();
        }
        $dif = array_diff($arr5, $ClientNumbersArr);
        $NumElcl = count($arr5);
        $NumEld = count($dif);

        $NumofShot = $NumElcl - $NumEld;
        if ($fDBG == 1)
		echo " NumofShot=$NumofShot ";
        echo "<br><br> +OK For type 5  Jokernumbers Poznati cisla=$NumofShot";
        break;

    default:

        echo "Wrong SMS,please enter correct data!";
}

//	close connection
mysql_close($link);
?>


