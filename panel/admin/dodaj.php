<!doctype html>
<head>
<script src="../ckeditor/ckeditor.js"></script>
</head>
<body>

<form action="text.php" method="POST" enctype="multipart/form-data">
Autor <input type="text" name="autor"  placeholder="Autor"> <br> <br>
Tytuł <input type="text" name="tytul"  placeholder="Tytuł"> <br> <br>
Ilosc <input type="number" name="ilosc"  placeholder="Ilość">  <br><br>
Cena brutto <input type="number" step="any" name="brutto"  placeholder="Cena brutto"> <br> <br>
Cena netto <input type="number" step="any" name="netto"  placeholder="Cena netto"> <br> <br>
Wydawnictwo <input type="text" name="wydawnictwo"  placeholder="Wydawnictwo">  <br><br>
Dostawca <input type="number" name="dostawca"  placeholder="Dostawca"> <br> <br>
Ilość stron <input type="number" name="ilosc_stron"  placeholder="Ilość stron"> <br> <br>
Okładka <input type="text" name="okladka"  placeholder="Okładka">  <br><br>
Kategoria <input type="number" name="kategoria"  placeholder="Kategoria"> <br> <br>
Rok wydania <input type="number" name="rok_wydania"  placeholder="Rok wydania">  <br><br>
ISBN <input type="number" name="isbn"  placeholder="ISBN"> <br> <br>
Wydanie <input type="number" name="wydanie"  placeholder="Wydanie"> <br> <br>
Typ <input type="number" name="typ"  placeholder="Typ">  <br><br>
Okładka<input type="file" name="cover"><br><br>
Opis <textarea name="opis" id="editor1" rows="10" cols="80">
 
 </textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>
 
 <input type="submit" name="submit" value="Wyślij">
 <input type="reset" name="reset"> 
 </form> 
 <p>Typ:<br>
 1-Książka<br>
 2-Muzyka<br>
 3-Gra<br>
 </p>
 </body>
 </html>