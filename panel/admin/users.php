<p class='alnl'>Użytkownicy</p>
<?php
	if(isset($_POST['delete']))
	{
		$baza->delete("DELETE FROM users WHERE id_user='".$_POST['delete']."'");
	}
	$licz=$baza->select("SELECT * FROM users");
	echo '<table>';
foreach($licz as $users)
{
	$iddel = $users['id_user'];
	echo  "<tr><td>".$users['nick']."</td><td><form action='admin.php?adminid=users' method='post'><input name='delete' type='hidden' value='$iddel'><input class='' type='submit' value='Usuń'></form></td></tr>";

}
echo '</table>'
			?>