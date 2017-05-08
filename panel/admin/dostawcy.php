<p class='tytul'>Dostawcy</p>
<div class="content">
	<?php
	if(isset($_POST['delete']))
	{
		$baza->delete("DELETE FROM magazyn WHERE id_ksiazka='".$_POST['delete']."'");
	}
	$licz=$baza->select("SELECT * FROM magazyn WHERE typ LIKE '1'");
	echo '<table>';
	foreach($licz as $spisksiazek)
	{
		$iddel = $spisksiazek['id_ksiazka'];
		echo  "<tr><td>".$spisksiazek['tytul']."</td><td><form action='admin.php?adminid=ksiazki' method='post'><input name='delete' type='hidden' value='$iddel'><input class='' type='submit' value='Usuń'></form></td></tr>";

	}
	echo '</table>'

	?></div>