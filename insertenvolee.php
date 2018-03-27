<!DOCTYPE>
<html>

<?php
include 'headerButtons.php';
?>
<body>

</body>
</html>

<?php
$date = $_POST["date"];
$duree = $_POST["duree"];
$segment = $_POST["segment"];
$heuredepart = $_POST["time"];
$depart = $_POST["aeDepart"];
$arrive = $_POST["aeArrivee"];
$avion = $_POST["avion"];
$pilote = $_POST["pilote"];
$idvol = $_POST["idvol"];

insertVol($idvol);
insertEnvolee($date,$idvol);
insertSegment($duree,$segment,$heuredepart,$idvol,$depart,$arrive,$avion,$pilote);

//Insertion de l'identifiant d'un vol dans la base de données.
function insertVol($idvol)
{
    $mysqli = new mysqli("127.0.0.1","root","","portair");
    if ($mysqli->connect_errno)
    {
        printf("Connect failed: %s\n", mysqli_connect_error());
        header('Location: index.php?Connect=fail');
    }
    if($stmt = $mysqli->prepare("INSERT INTO vol(noVol) VALUES (?)"))
    {
        if (!$stmt->bind_param("s",$idvol))
        {
            echo "Binding parameters failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        mysqli_stmt_execute($stmt);
		//Vérification si une valeur a été entrée pour le numéro de vol
        if ($idvol == '0')
        {
            header('Location: entreenvolee.php?error=vol');
        }
    }
}

//insertion d'une envolée composé de l'identifiant de vol et de la date de l'envolée.
function insertEnvolee($date,$idvol)
{
    $mysqli = new mysqli("127.0.0.1","root","","portair");
    if ($mysqli->connect_errno)
    {
        printf("Connect failed: %s\n", mysqli_connect_error());
        header('index.php?Connect=fail');
    }
    $formatdate = date("Y-m-d",strtotime($date));
    if($stmt = $mysqli->prepare("INSERT INTO envolee(idEnvolee,Date,Vol_idVol) VALUES (?,?,?)"))
    {
        if (!$stmt->bind_param("sss",$id, $formatdate,$idvol))
        {
            echo "Binding parameters failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        mysqli_stmt_execute($stmt);
		//S'il y a erreur dans la requête à cause de la date
        if (!$stmt)
        {
			header('Location: entreenvolee.php?error=date');
        }
    }
}

//insertion du segment d'un vol dans la base de données.
function insertSegment($duree,$segment,$heuredepart,$idvol,$depart,$arrive,$avion ,$pilote)
{
    $mysqli = new mysqli("127.0.0.1","root","","portair");
	//Vérification si l'aéroport de départ est différent de celui d'arrivée
	if($depart == $arrive)
	{
		header('Location: entreenvolee.php?error=aeroport');
	}
	//Vérification si la durée a été remplis
	else if($duree == '0')
	{
		header('Location: entreenvolee.php?error=duree');
	}
    if ($mysqli->connect_errno)
    {
        printf("Connect failed: %s\n", mysqli_connect_error());
        header('Location: index.php?Connect=fail');
    }
    $datetime = date("H:m:s",strtotime($heuredepart));
    if($stmt = $mysqli->prepare("INSERT INTO segmentvol(TypeSegment,Duree,HeureDepart,Aeropart_idAeropartDepart,Aeropart_idAeropartArrivee,Appareil_idAppareil,Pilote_idPilote,Vol_idVol) VALUES (?,?,?,?,?,?,?,?)"))
    {
        if (!$stmt->bind_param("ssssssss",$segment,$duree,$datetime,$depart,$arrive,$avion,$pilote,$idvol))
        {
            echo "Binding parameters failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        mysqli_stmt_execute($stmt);		
		//S'il y a erreur dans la requête à cause d'une mauvaise valeur entrée dans la table de segment de vol
        if (!$stmt)
        {
           header('Location: entreenvolee.php?error=segment');
        }
		echo "Oppération réussie !";
    }
}
?>



