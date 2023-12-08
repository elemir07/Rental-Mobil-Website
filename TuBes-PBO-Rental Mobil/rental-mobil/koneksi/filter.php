<?php

if(isset($_REQUEST['search']))
{
    $merk = $_REQUEST['merk'];
    foreach ($_REQUEST['merk'] as $merk) {
        $statearray[] = mysql_real_escape_string($merk);
    }
    $states = implode ("','", $statearray);
    $codes = implode ("','", $codesarray);
    $hsn = implode ("','", $hsnarray);
    $sql = "SELECT * FROM mobil WHERE merk IN ('$states')";

    //Now we search for our search term, in the field the user specified
    $result = mysql_query($sql) or die(mysql_error());

    //This counts the number or results - and if there wasn't any it gives them a     little     message explaining that
    if (mysql_num_rows($result) == 0)
    {
        echo "Sorry, but we can not find an entry to match your query...<br><br>";
    }
    else
    {
        echo "<table border='1' width='900' class='srchrslt'>
        <tr class='head'>
        <td>merk</td>
        </tr>";

        //And we display the results
        while($row = mysql_fetch_assoc( $result ))
        {              
            echo "<tr>";
            echo "<td>" . $row['merk'] . " </td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}