<?php
	ob_start();
	include "../SQL/class.mysql.php";
	$baza = new MySql("localhost","root","","sklep");
	

	$autor=$_POST['autor'];
	$tytul=$_POST['tytul'];
	$ilosc=$_POST['ilosc'];
	$brutto=$_POST['brutto'];
    $netto=$_POST['netto'];
	$wydawnictwo=$_POST['wydawnictwo'];
	$dostawca=$_POST['dostawca'];
    $ilosc_stron=$_POST['ilosc_stron'];
	$okladka=$_POST['okladka'];
	$kategoria=$_POST['kategoria'];
    $rok_wydania=$_POST['rok_wydania'];
	$isbn=$_POST['isbn'];
	$wydanie=$_POST['wydanie'];
    $typ=$_POST['typ'];
	$opis=$_POST['opis'];


$fhandle = fopen($_FILES['cover']['tmp_name'], "r");
$content = base64_encode(fread($fhandle, $_FILES['cover']['size']));
fclose($fhandle);
$zapytanie = mysql_query("INSERT INTO magazyn (cover) VALUES (\"".$content."\")");

	if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
       if( empty($autor)  || empty($tytul) || empty($ilosc) || empty($brutto) || empty($netto) || empty($wydawnictwo) || empty($dostawca) || empty($ilosc_stron) || empty($okladka) || empty($kategoria) || empty($rok_wydania) || empty($isbn) || empty($wydanie) || empty($typ) || empty($opis)) // Sprawdzanie czy pola formularza nie są puste
       {
         die('Wypełnij wszystkie dane.');
       }
	  
       else
    {
        $baza = new MySql("localhost","root","","sklep");
        $id=$baza -> insert("INSERT INTO `magazyn`(`autor`,`tytul`,`ilosc`,`cena_brutto`,`cena_netto`,`wydawnictwo`,`dostawca`,`ilosc_stron`,`okladka`,`kategoria`,`rok_wydania`,`ISBN`,`wydanie`,`typ`,`opis`) VALUES ( '$autor', '$tytul', '$ilosc', '$brutto', '$netto', '$wydawnictwo', '$dostawca', '$ilosc_stron', '$okladka', '$kategoria', '$rok_wydania', '$isbn', '$wydanie', '$typ', '$opis')");
        if($id >0)
        {
         header('location:admin.php?adminid=dodaj');

        }else{echo'Błąd';}
       }
}     
	


?>



