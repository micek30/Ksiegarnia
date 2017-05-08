<?
session_register("koszyk");
if ($show != "usun_kosz") // zmienna $show znajduje sie w adresie np.index.php?show=xxx
{
    $koszyk = $_SESSION["koszyk"];
    $id = 10;//$_POST["spid"]; // ta zmienna okresla id produktu (id wysylamy za pomoc a formularza np w polu hidden o nazwie spid
    if ($_POST["ilosc"] == "")
    {
        $ilosc = 1;
    } else {
        $ilosc = $_POST["ilosc"];
    }

    if ($show == "koszyk")
    {
        $stara_ilosc = $koszyk[$id];
        $koszyk[$id] = $ilosc + $stara_ilosc;
    }
    elseif ($show == "usun")
    {
        $stara_ilosc = $koszyk[$id];
        if ($stara_ilosc - $ilosc <= 0)
        {
            $koszyk[$id] = null;
        } else {
            $koszyk[$id] = $stara_ilosc - $ilosc;
        }
    }
    else
    {
        if ($koszyk != null)
        {
            foreach($koszyk as $id => $ilosc)
            {
                $count = 0;
                $zapytanie = "SELECT autor, tytul, cena FROM produkty WHERE id='$id' "; // dzieki temu zapytaniu uzyskujemy nazwe produktu oraz jego cene pobraną z bazy
                $wykonaj = mysql_query ($zapytanie);
                $wiersz = mysql_fetch_array ($wykonaj);
                $fltPrice = "".$wiersz['cena']."";
                $arrProducts[$count++]['overall_price'] = $ilosc * $fltPrice;
                echo "<a href=\"index.php?show=produkty&id=$id&".SESID."\">".$wiersz['nazwa']."</a><br> x ".$ilosc." szt. (".$arrProducts['0']['overall_price']." PLN)<br>";
                $fltOverall_price += $ilosc * $fltPrice; // podliczamy sume wszystkich towarow w koszyku
            }
            echo '<br>
Suma: $fltOverall_price PLN";

        }
        else
        {
            echo "Koszyk pusty!";
        }
    }
    $_SESSION["koszyk"] = $koszyk;';
    echo "<br> <a href = \"?show=usun_kosz\">Usun koszyk</a>";
}
else
{   session_unregister("koszyk");
    echo "Usuniety!";
}
?>