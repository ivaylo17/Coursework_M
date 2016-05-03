
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

$fDBG = 1;

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
        echo "  <br>Frm DB: T1_5_35= $T1_5_35,  T2_5_35= $T2_5_35 , T_6_49= $T_6_49,Date= $Date, Jokerposition=$Jokerposition, Jokernumbers=$Jokernumbers, Date= $Date <br>";
}

//   5/35  - Purvo teglene     $type = "1";
//case 1   5 ot 35
switch ($type) {

    case "1":

        $WinNumbers = explode(',', $T1_5_35);
        $NumEl = count($ClientNumbersArr);
        if ($NumEl != 5) {
            //	print error and exit()
            echo "+OK ERR Incorrect number of numbers for type $type";
            exit();
        }

        if ($fDBG == 1)
            echo "<br><br>* Values of Win number array is: <br />";
        foreach ($WinNumbers as $n) {
            if ($fDBG == 1)
                echo "     $n, ";
        } echo " <br />";


        // find recognized (shot)
        $NumOfShot = 0;
        foreach ($ClientNumbersArr as $n) {

            for ($i = 0; $i < 4; $i++) {
                $w = $WinNumbers[$i];
                if ($w == $n) {
                    $NumOfShot++;
                }
            }
        }
        echo "<br><br> +OK For type 1 (5/35) Poznati cisla=$NumOfShot";
        break;

    // case 2  5/35- Vtoro teglene 
    case "2":
        $WinNumbers = explode(',', $T2_5_35);
        $NumEl = count($ClientNumbersArr);
        if ($NumEl != 5) {
            //	print error and exit()
            echo "+OK -ERR Incorrect number of numbers for type $type";
            exit();
        }

        if ($fDBG == 1)
            echo "<br><br> ** Values of Win number array is: <br />";
        foreach ($WinNumbers as $n) {
            if ($fDBG == 1)
                echo "     $n, ";
        } echo " <br />";


        // find recognized (shot)
        $NumOfShot = 0;
        foreach ($ClientNumbersArr as $n) {

            for ($i = 0; $i < 4; $i++) {
                $w = $WinNumbers[$i];
                if ($w == $n) {
                    $NumOfShot++;
                }
            }
        }
        echo "<br><br> +OK For type 2 (5/35) Poznati cisla=$NumOfShot";
        break;


    //   case  3    6 ot 49
    case "3":
        $WinNumbers = explode(',', $T_6_49);
        $NumEl = count($ClientNumbersArr);
        if ($NumEl != 6) {
            //	print error and exit()
            echo "+OK -ERR Incorrect number of numbers for type $type";
            exit();
        }

        if ($fDBG == 1)
            echo "<br><br> Values of Win number array is: <br />";
        foreach ($WinNumbers as $n) {
            if ($fDBG == 1)
                echo "     $n, ";
        } echo " <br />";


        // find recognized (shot)
        $NumOfShot = 0;
        foreach ($ClientNumbersArr as $n) {

            for ($i = 0; $i < 6; $i++) {
                $w = $WinNumbers[$i];
                if ($w == $n) {
                    $NumOfShot++;
                }
            }
        }
        break;

		
		// Jokerposition
    case "4":

        $WinNumbers = explode(',', $Jokerposition);
        $NumEl = count($ClientNumbersArr);
        if ($NumEl != 3) {
            //	print error and exit()
            echo "+OK ERR Incorrect number of numbers for type $type";
            exit();
        }

        if ($fDBG == 1)
            echo "<br><br>* Values of Win number array is: <br />";
        foreach ($WinNumbers as $n) {
            if ($fDBG == 1)
                echo "     $n, ";
        } echo " <br />";


        // find recognized (shot)
        $NumOfShot = 0;
        foreach ($ClientNumbersArr as $n) {

            for ($i = 0; $i < 3; $i++) {
                $w = $WinNumbers[$i];
                if ($w == $n) {
                    $NumOfShot++;
                }
            }
        }
        echo "<br><br> +OK $Jokerposition  Poznati cisla=$NumOfShot";
        break;


    case "5":


        $WinNumbers = explode(',', $Jokernumbers);
        $NumEl = count($ClientNumbersArr);
        if ($NumEl != 3) {
            //	print error and exit()
            echo "+OK ERR Incorrect number of numbers for type $type";
            exit();
        }

        if ($fDBG == 1)
            echo "<br><br>* Values of Win number array is: <br />";
        foreach ($WinNumbers as $n) {
            if ($fDBG == 1)
                echo "     $n, ";
        } echo " <br />";


        // find recognized (shot)
        $NumOfShot = 0;
        foreach ($ClientNumbersArr as $n) {

            for ($i = 0; $i < 3; $i++) {
                $w = $WinNumbers[$i];
                if ($w == $n) {
                    $NumOfShot++;
                }
            }
        }
        echo "<br><br> +OK $Jokernumbers  Poznati cisla=$NumOfShot";
        break;
    default:
      
	  echo "Wrong SMS,please enter correct data!";
}





if ($fDBG == 1)
    echo '<br /> $NumOfShot=' . $NumOfShot . '<br />';


//	close connection
mysql_close($link);
?>


