<?php
if(!$_POST['id'])
{
echo '<center><form action="admin.php?adminid=edytuj&edytuj=1" method="post">
<select name="id"> ';
$zapytanie = "SELECT * FROM spis ORDER BY `id` DESC";
$idzapytania = $baza->SELECT($zapytanie);
for ($i=0 ; $i<count($idzapytania) ; $i++)
echo '<option value="'.$idzapytania[$i]['id'].'">'.$idzapytania[$i]['nazwa'].'</option>';
echo'
</select>
<input type="submit" value="Wybierz">
<br>
</form>';
}
elseif($_POST['id'])
{
if($_POST['edycja'])
{
$zapytanie = $baza->update( 'UPDATE spis SET nazwa= "'.$_POST['nazwa'].'", tresc= "'.$_POST['tresc'].'", platforma= "'.$_POST['platforma'].'" WHERE id="'.$_POST['id'].'"');

echo '<center>Zedytowano artykuł\'a<br><br>';
}
else
{
echo '<center><form action="admin.php?adminid=edytuj&edytuj=2" method="post">
 ';
$zapytanie = $baza->select('SELECT * FROM spis WHERE id="'.$_POST['id']. '" LIMIT 1');


echo '  

              <br> <table width="700" border="0">
		<input type="hidden" name="id" value="'.$zapytanie[0]['id'].'">
		<input type="hidden" name="edycja" value="wartość" />
 <tr>
    <td><br>nazwa:<br>
<br><input type="text" name="nazwa" value="'.$zapytanie[0]['nazwa'].'" size="70"> 
<br> 
<br>Treść:<br>
<textarea name="tresc" cols="100" rows="50">'.$zapytanie[0]['tresc'].'</textarea> '
								?><script>
								CKEDITOR.replace( 'tresc' );
									CKEDITOR.config.width = 575;
           					</script>
                                <?php
echo'<br> 
<br> Platforma: <br>
<textarea id="skrot" name="platforma" cols="100" rows="20">'.$zapytanie[0]['platforma'].'</textarea> '
							?><script>
                					CKEDITOR.replace( 'platforma' );
									CKEDITOR.config.width = 575;
           					</script>
                                <?php
echo'<br> 
<input type="submit" value="Edytuj"><br> 
</form>
   </td>
  </tr>
</table>';
}
}
?>