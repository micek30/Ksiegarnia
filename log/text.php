<?php
	ob_start();
	include "../SQL/class.mysql.php";
	include ("config.php");
	$baza = new MySql("localhost","root","","sklep");
	

	$nick=$_POST['nick'];
	$haslo=$_POST['password'];
	$email=$_POST['email'];
	$adres=$_POST['adres'];
	$postal=$_POST['postal'];
	$miasto=$_POST['miasto'];

	if($_SERVER['REQUEST_METHOD'] == 'POST') 
      {
       if(empty($nick) || empty($haslo) || empty($email)) // Sprawdzanie czy pola formularza nie są puste
       {
         die ( 'Wypełnij wszystkie dane.' );
       }
	   elseif(!preg_match ('/^[A-Z0-9]{3,30}$/i',$haslo))
	   {
		   die('Niezgodne hasło');
	   }
	   elseif(!preg_match ('/^[A-Z0-9]{2,30}$/i',$nick))
	   {
		   die('Niezgodny login');
	   }
	   //elseif(count($baza->SELECT('select `nick` FROM users WHERE nick="'.$nick.'"')) >0)
	   elseif($count=$baza->insert('select `nick` FROM users WHERE nick="'.$nick.'"') >0)
	   {
		   die ('Istnieje użytkownik o takiej nazwie');
	   }
	   elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) // Sprawdzanie poprawności adresu Email
       {
        die ('Niepoprawny adres E-mail.' );
       }
       else
       {
        //$baza = new MySql("localhost","root","","sklep");
        $id=$baza -> insert("INSERT INTO 'users'(`nick`,`haslo`,`email`,`adres`,`kod_pocztowy`,`miasto`) VALUES('$nick' , '$haslo', '$email', '$adres', '$postal', '$miasto')");
		//$id=mysqli_query($con,"INSERT INTO 'users'(`nick`,`haslo`,`email`,`adres`,`kod_pocztowy`,`miasto`) VALUES('$nick' , '$haslo', '$email', '$adres', '$postal', '$miasto')");
        if($id >0)
        {
         echo $nick;
         echo $id;
		 //header("location: ../index.php?id=reg_success");
        }
		else
		{
			echo $haslo;
			echo $id;
			//header("location:../index.php?id=reg_fail");
		}
       }
     }

$_SESSION['login'] = $login;

?>



