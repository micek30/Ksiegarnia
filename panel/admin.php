<?php 
	session_start();
	include "../SQL/class.mysql.php";
	$baza = new MySQL('localhost', 'root', '', 'sklep');
	if(!isset($_GET['adminid'])) $_GET['adminid']='gl';
	?>
<!doctype html>
<head>
<script src="../ckeditor/ckeditor.js"></script>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css">
  
   <title>Panel Administratora</title>
</head>
<body>




<div id='cssmenu'>
<ul>
   <li class='active'><a href="admin.php?adminid=users">Użytkownicy</a>
   </li>
   <li class='active'><a>Sklep</a>
      <ul>
         <li><a href="admin.php?adminid=ksiazki">Książki</a></li>
       <li><a href="admin.php?adminid=muzyka">Muzyka</a></li>
		 <li><a href="admin.php?adminid=newsy">Newsy</a></li>
		 <li><a href="admin.php?adminid=zamowienia">Zamówienia</a></li>
		 <li><a href="admin.php?adminid=dostawcy">Dostawcy</a></li>
		 <li><a href="admin.php?adminid=dodaj">Dodaj</a></li>
		 <li><a href="admin.php?adminid=usun">Usuń</a></li>
		 <li><a href="admin.php?adminid=edytuj">Edytuj</a></li>
      </ul>
   </li>
   <li class='active'><a href='../index.php'>Powrót na stronę</a></li>
</ul>
</div>


<div class="panel">
	<p class="alnl">
<?php
	  
						switch($_GET['adminid']) {
							case 'users':
								include "admin/users.php"; break;
							case 'ksiazki':
								include "admin/ksiazki.php"; break;
							case 'muzyka':
								include "admin/muzyka.php"; break;
							case 'newsy':
								include "admin/newsy.php"; break;
							case 'zamowienia':
								include "admin/zamowienia.php"; break;
							case 'dostawcy':
								include "admin/dostawcy.php"; break;
							case 'dodaj':
								include "admin/dodaj.php"; break;	
							case 'usun':
								include "admin/usun.php"; break;
							case 'edytuj':
								include "admin/edytuj.php"; break;	
									
									
									case 'gl':
								echo "<div class='tytul'>Panel administratora</div>"; break;
							
						}
				?>
 </p>
 </div>

</body>
<html>
