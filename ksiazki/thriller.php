<link rel="stylesheet" type="text/css" href="css/style.css">
<?php
    $con = mysql_connect("localhost","root","");
    if (!$con)
    {
        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("sklep", $con);

    $result = mysql_query("SELECT * FROM magazyn WHERE kategoria LIKE '1'");

    while($row = mysql_fetch_array($result))
    {
        $plik=$row['id_product'];
        $sciezka_1='0.jpg';
        $nazwa=str_replace("0","$plik", $sciezka_1);
        $sciezka="images/covers/".$nazwa;
        echo '<div class="left_col_left"><img src='.$sciezka.' height="150" width="100" /></div><div class="left_col_right"><a href="index.php?id=tresc&amp;id_prod=' . $row['id_product'] . '&amp;">' . $row['autor'] . '       "' . $row['tytul'] .'"</a><br><br></div>';
    }

    mysql_close($con);
?>