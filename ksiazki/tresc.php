<link rel="stylesheet" type="text/css" href="css/style.css">
<?php
    $id = $_GET['id_prod'];
    $con = mysql_connect("localhost", "root", "");
    if (!$con) {
        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("sklep", $con);

    $result = mysql_query("SELECT * FROM magazyn WHERE id_product LIKE '$id'");

    while($row = mysql_fetch_array($result))
    {
        $plik = $row['id_product'];
        $sciezka = '0.jpg';
        $nazwa = str_replace("0", "$plik", $sciezka);
        $src = "images/covers/" . $nazwa;
        echo '
        <div class="left_col_left">
            <img src='.$src.' height="150" width="100" />
        </div>
       
        <div class="left_col_right">
            ' . $row['autor'] . '       "' . $row['tytul'] .'"
        </div>
       
       
        <div class="koszyk">
        
        <form action="dod_koszyk.php" method="post">
            <input type="submit" name="dod_koszyk"  value="Dodaj do koszyka"/>
        </form>
        
        </div>
        
        
        <div class="opis">' . $row['opis'] . '</div>';
    }

    mysql_close($con);
?>