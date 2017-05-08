<link rel="stylesheet" type="text/css" href="css/style.css">
<?php
$con = mysql_connect("localhost","root","");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("sklep", $con);

$result = mysql_query("SELECT * FROM magazyn WHERE kategoria LIKE '4'");

    while($row = mysql_fetch_array($result))
    {
        $plik=$row['id_product'];
        $sciezka='0.jpg';
        $nazwa=str_replace("0","$plik", $sciezka);
        $src="images/covers/".$nazwa;
        echo "<div class='left_col_left'><img src=$src height='150' width='100' /> </div><div class='left_col_right'>{$row['tytul']}'   '{$row['autor']}<br><br></div>";

    }

mysql_close($con);
?>