<!DOCTYPE>
<html>

<?php
include 'headerButtons.php';
?>
<h1>Bienvenu sur Portair</h1>
<br>
<?php
	//Gestion d'une erreur de connection à la base de donnée
	if(isset($_GET['Connect']))
	{
		echo "Erreur dans la requete SQL";
	}
?>
</html>
