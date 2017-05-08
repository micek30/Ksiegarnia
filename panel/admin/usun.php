<p class='tytul'>USUŃ</p>
<div class="content">
<?php
	if(isset($_POST['delete']))
	{
		$baza->delete("DELETE FROM magazyn WHERE id_ksiazka='".$_POST['delete']."'");
	}
	$licz=$baza->select("SELECT * FROM magazyn");
	echo '<table>';
			foreach($licz as $spis)
			{
				$iddel = $spis['id_user'];
				echo  "<tr><td>".$spis['tytul']."</td><td><form action='admin.php?adminid=usun' method='post'><input name='delete' type='hidden' value='$iddel'><input class='button' type='submit' value='Usuń'></form></td></tr>";
			}
			echo '</table>';
?></div>