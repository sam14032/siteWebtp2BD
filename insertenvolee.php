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
$avion = $_POST["avion"];
$pilote = $_POST["pilote"];
$idvol = $_POST["idvol"];

insertEnvolee($date,$idvol,$avion,$pilote);



//insertion d'une envolée composé de l'identifiant de vol et de la date de l'envolée.
function insertEnvolee($date,$idvol,$avion,$pilote)
{
    $mysqli = new mysqli("127.0.0.1","root","","portair");
    if ($mysqli->connect_errno)
    {
        printf("Connect failed: %s\n", mysqli_connect_error());
        header('index.php?Connect=fail');
    }
    $formatdate = date("Y-m-d",strtotime($date));
    if($stmt = $mysqli->prepare("INSERT INTO envolee(idEnvolee,Date,Vol_idVol,Appareil_idAppareil,Pilote_idPilote) VALUES (?,?,?,?,?)"))
    {
        if (!$stmt->bind_param("sssss",$id, $formatdate,$idvol,$avion,$pilote))
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

?>



