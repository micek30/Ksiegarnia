<?php include("config.php");
/*if(isset($_POST['login']))
{
    $login = $_POST['login'];
    echo 'login';
}
if(isset($_POST['haslo']))
{
    $login = $_POST['haslo'];
    echo 'haslo';
} */
$login = isset($_POST['login']) ? $_POST['login'] : '';
$haslo = isset($_POST['haslo']) ? $_POST['haslo'] : '';
echo ($login);
$haslo = addslashes($haslo);
$login = addslashes($login);
$login = htmlspecialchars($login);

if ($_GET['login'] != '')        //jezeli ktos przez adres probuje kombinowac
    {
    exit;
    }
if ($_GET['haslo'] != '') //jezeli ktos przez adres probuje kombinowac
    {
    exit;
    }

if (!$login OR empty($login)) {
    echo '<p class="alert">Wypełnij pole z loginem!</p>';
    exit;
}
if (!$haslo OR empty($haslo)) {
    echo '<p class="alert">Wypełnij pole z hasłem!</p>';
    exit;
}

$istnick = mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(*) FROM `users` WHERE `nick` = '$login' AND `haslo` = '$haslo'")); // sprawdzenie czy istnieje uzytkownik o takim nicku i hasle
if ($istnick[0] == 0) {
    echo 'Logowanie nieudane. Sprawdź pisownię nicku oraz hasła.';
}
else
{
    $_SESSION['login'] = $login;
    //$_SESSION['haslo'] = $haslo;
    $_SESSION['check'] = true;
    echo 'Logowanie udane';
    header("Location: ../index.php");
}
?>