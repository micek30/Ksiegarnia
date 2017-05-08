
<?php

    echo'<p><h2>Wyniki wyszukiwania</h2></p>';
    $_POST['phrase'] = trim($_POST['phrase']);
// sprawdzenie, czy użytkownik wpisał dane
    if (empty($_POST['phrase']))
// jeśli nie, to wyświetl komunikat i zakończ działanie skryptu
        die('Formularz wypełniony niepoprawnie! Nie można wyświetlić wyników wyszukiwania!');
// jeśli jednak dane są wpisane poprawnie
    else {
// połączenie z bazą danych, NIE ZAPOMINJ USTAWIĆ WŁASNYCH DANYCH!
        $base = mysqli_connect('localhost', 'root', '', 'sklep');
// skonstruowanie zapytania
// zwróć uwagę na operator Like - to on jest sercem całej aplikacji. Pozwala wyszukać dany ciąg w bazie danych
// jak zapewne zauważyłeś, przed frazą i po niej umieszczam znaki procenta %
// ten znak symbolizuje dowolny inny ciąg znaków, więc jest niezbędny do skutecznego wyszukiwania
// połaczenie operatorem Or pozwala na wyszukiwanie danego ciągu zarówno w nazwie, jak i opisie produktu
// UWAGA! Tutaj też nie zapomnij ustawić swoich danych!
        $query = "SELECT id_product,autor,tytul From magazyn Where magazyn.tytul Like '%{$_POST['phrase']}%' Or autor Like '%{$_POST['phrase']}%'";
// wysłanie zapytania do bazy danych
        $result = mysqli_query($base, $query);
// ustalenie ilości wyszukanych obiektów
        $obAmount = mysqli_num_rows($result);
// wyswietlenie ilości wyszukanych obiektów
        echo 'Znaleziono: ' . $obAmount . '<br /><br />';
// wyświetlenie wyników w pętli
        for ($x = 0; $x < $obAmount; $x++) {
// przekształcenie danych na tablicę
            $row = mysqli_fetch_assoc($result);
// wyświetlenie numeru identyfikacyjnego
            echo $x + 1;
            echo '. ';
// wyświetlenie nazwy produktu
            // echo $row['tytul'];
            //echo $row['autor'];
            echo '<td><a href="index.php?id=tresc&amp;id_prod=' . $row["id_product"] . '&amp;">' . $row['tytul'] . '</a></td>';
            echo '<br>';
        }
    }
// zamknięcie połączenia
    mysqli_close($base);
// koniec aplikacji
?>