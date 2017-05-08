<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="content type" content="text/html; charset=utf-8">
    <link href="../css/style.css" rel="stylesheet" type="text/css">
</HEAD>
<BODY>
<p>Rejestracja</p>
    <form action="log/text.php" method="POST" enctype="multipart/form-data">
        Podaj nick*	<input type="text" name="nick" maxlength="20" placeholder="podaj nick"> Co najmniej 3 znaki<br> <br>
        Podaj hasło*	<input type="password" name="password" maxlength="30" placeholder="podaj hasło"> Co najmniej 2 znaki <br> <br>
        Podaj email*	<input type="text" name="email" maxlength="30" placeholder="podaj e-mail"><br><br>
        Podaj adres	<input type="text" name="adres" maxlength="30" placeholder="podaj adres"> <br> <br>
        Podaj kod pocztowy<input type="text" name="postal" maxlength="30" placeholder="podaj kod pocztowy"> (np.95-100)<br> <br>
        Podaj miasto	<input type="text" name="miasto" maxlength="30" placeholder="podaj miasto"><br> <br>
        <input type="submit" name="submit" value="Wyślij">
        <input type="reset" name="reset">
    </form>

<p> kryteria onaczone gwiazdką * są wymagane do rejestracji</p>

</BODY>
</HTML>

