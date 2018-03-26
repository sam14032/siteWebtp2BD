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
$mysqli = new mysqli("127.0.0.1","root","","portair");
if ($mysqli->connect_errno)
{
    printf("Connect failed: %s\n", mysqli_connect_error());
    header('index.php?Connect="fail"');
}
insertEnvolee($mysqli,$date,$idvol);
insertVol($mysqli,$idvol);
insertSegment($mysqli,$duree,$segment,$heuredepart,$idvol,$depart,$arrive,$avion,$pilote);

function insertVol($mysqli,$idvol)
{
    if($stmt = $mysqli->prepare("INSERT INTO vol(noVol,Date) VALUES (?)"))
    {
        if (!$stmt->bind_param("s",$idvol))
        {
            echo "Binding parameters failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        mysqli_stmt_execute($stmt);
        if (!$stmt)
        {
            header('index.php?Insert="fail"');
        }
    }

}

function insertEnvolee($mysqli,$date,$idvol)
{
    if($stmt = $mysqli->prepare("INSERT INTO envolee(idEnvolee,Date,Vol_id_Vol) VALUES (?,?)"))
    {
        $formatdate = date("Y,m,d",strtotime($date));
        if (!$stmt->bind_param("ss",null, $date,$idvol))
        {
            echo "Binding parameters failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        mysqli_stmt_execute($stmt);
        if (!$stmt)
        {
            header('index.php?Insert="fail"');
        }
    }

}


function insertSegment($mysqli,$duree,$segment,$heuredepart,$idvol,$depart,$arrive,$avion ,$pilote)
{
    if($stmt = $mysqli->prepare("INSERT INTO segmentvol(Duree,TypeSegment,HeureDepart,Envolee_idVol,Aeropart_idAeroportDepart,Aeropart_idAeroportArrivee,Appareil_idAppareil,Pilote_idPilote) VALUES (?,?,?,?,?,?,?,?)"))
    {
        if (!$stmt->bind_param("ss",$duree, $segment,$heuredepart,$idvol,$depart,$arrive,$avion,$pilote))
        {
            echo "Binding parameters failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        mysqli_stmt_execute($stmt);
        if (!$stmt)
        {
            header('index.php?Insert="fail"');
        }
    }
}
?>



