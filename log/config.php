<?php session_start();
$con=mysqli_connect("localhost","root","") or die(mysqli_error()."Nie mozna polaczyc sie z baza danych. Prosze chwile odczekac i sprobowac ponownie.");
mysqli_select_db($con,"sklep") or die(mysqli_error()."Nie mozna wybrac bazy danych.");
?>