<?php 
session_start();
ob_start();
if (!isset($_SESSION['koszyk']))
{
	$_SESSION['koszyk']=array('ksiazki'=>array(),'akcesoria'=>array());
}
include "SQL/class.mysql.php";
?>

<!DOCTYPE HTML>
<HTML>
	<head>
		<title> Księgarnia jak marzenie</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" type="text/css" href="css/style.css">    <!-- ścieżka do styli -->
		<link rel="stylesheet" type="text/css" href="css/search.css">    <!-- ścieżka do styli wyszukiwarki-->
		<meta charset='utf-8'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">       <!--menu -->
		<meta name="viewport" content="width=device-width, initial-scale=1">    <!--menu -->
		<link rel="stylesheet" href="css/cssmenu/styles.css">   <!--menu -->
		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script><!--menu -->
        
        <!--<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'><!--czcionka naglowka -->
		<link href="css/Lobster/Lobster-Regular.ttf" rel='stylesheet' type='text/css'>
	<body>
	<div class="page_content">
		<div class="header">
			<?php
			if (empty ($_SESSION['check'])) $_SESSION['check']=false;
			if($_SESSION['check'] == false)  echo '<div class="zaloguj"><a href="index.php?id=log">Zaloguj</a></div>';
			elseif($_SESSION['check'] == true)   echo '<div class="zaloguj"><a href="index.php?id=logout">Wyloguj</a></div>';
			if ($_SESSION['check'] ==false) echo '<div class="zarejestruj"><a href="index.php?id=rejestracja">Zarejestruj</a></div>';
			?>

        </div>
		<div id='cssmenu'>
			<ul>
				<li class='active'><a href="index.php"><span>Główna</span></a></li>
				<li class='has-sub'><a href='#'><span>Książki</span></a>
					<ul>
						<li><a href='index.php?id=thriller'><span>Thriller, Horror</span></a></li>
						<li><a href='index.php?id=fantasy'><span>Fantastyka</span></a></li>
						<li><a href='index.php?id=mlodziez'><span>Dla młodzieży</span></a></li>
						<li><a href='index.php?id=kryminal'><span>Kryminał</span></a></li>
						<li><a href='index.php?id=literatura'><span>Literatura</span></a></li>
						<li><a href='index.php?id=obyczajowa'><span>Literatura obyczajowa</span></a></li>
						<li><a href='index.php?id=faktu'><span>Literatura faktu</span></a></li>
						<li><a href='index.php?id=biografie'><span>Biografie</span></a></li>
						<li><a href='index.php?id=historia'><span>Historia</span></a></li>
						<li><a href='index.php?id=kuchnia'><span>Poradniki, kuchnia</span></a></li>
						<li class='last'><a href='index.php?romans'><span>Romans</span></a></li>
					</ul>
				</li>
				<li class='has-sub'><a href='#'><span>Muzyka</span></a>
					<ul>
						<li><a href='#'><span>Newsy</span></a></li>
						<li class='last'><a href='#'><span>Contact</span></a></li>
					</ul>
				</li>
				<li class='last'><a href='#'>About</a></li>
				<?php
				if(isset($_SESSION['login']) && $_SESSION['login']=='admin')
					echo '<li class="last"><a href="panel/admin.php">Panel admina</a></li>';
				?>
					<form class="form-wrapper cf" method="POST" action="index.php?id=search">
						<input type="text" name='phrase' placeholder="Wyszukaj..." required>
						<button type="submit">Wyszukaj</button>
					</form>


			</ul>
		</div>          <!--rozwijane menu-->
		<div class="content">
			<div class="left_col">
               <?php
				/*include "search.php";
				include "log/logowanie.php";
				include "log/wyloguj.php";
				include "log/rejestracja.php";
			   	//include "log/login.php";
				include "log/reg_success.php";
				include "log/reg_fail.php";
				include "ksiazki/kryminal.php";
				include "ksiazki/thriller.php";
				//include "muzyka/muzyka.php";
				//include "news/news.php";
				include "glowna.php";
				include "ksiazki/tresc.php";//zmiana zawartości*/
			   if (!isset($_GET['id'])) {
						include "glowna.php";
					}   //zmiana zawartości
					else {
						switch($_GET['id']) {
							case 'log':
								include "log/logowanie.php"; break;
							case "rejestracja":
								include "log/rejestracja.php"; break;
							case 'muzyka':
								include "muzyka/muzyka.php"; break;
							case "news":
								include "news/news.php"; break;
							case "reg_success":
								include "log/reg_success.php";break;
							case "reg_fail":
								include "log/reg_fail.php";break;
							case "logout":
								include "log/wyloguj.php";break;
							case "search":
								include "search.php";break;
							case "tresc":
								include "ksiazki/tresc.php";break;
							case "koszyk":
								include "SQL/koszyk.php";break;
							case "thriller":
								include "ksiazki/thriller.php";break;
							case "kryminal":
								include "ksiazki/kryminal.php";break;
						}
					}                       //zmiana zawartości
					?>

			</div>
			<div class="right_col">
                <?php
                if($_SESSION['check'] == false)  echo 'Nie jesteś zalogowany';
                else if($_SESSION['check'] ==true) echo  "Użytkownik: ".$_SESSION['login']; ?>
				<div class="left_col_left"><a href="index.php?id=koszyk&amp;show=koszyk&amp;">Koszyk</a></div>
			</div>
		</div>
	
		<div class="footer">
			<div class="left_footer">
				<p>Księgarnia jak marzenie</p>
			</div>
			<div class="right_footer">
				<p>Krzysztof Mickiewicz</p>
			</div>
		</div>
	</div>

	</body>
</html>

<?php
ob_end_flush();
?>