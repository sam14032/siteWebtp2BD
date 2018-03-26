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

function insertVol($idvol)
{
    $mysqli = new mysqli("127.0.0.1","root","","portair");
    if ($mysqli->connect_errno)
    {
        printf("Connect failed: %s\n", mysqli_connect_error());
        header('index.php?Connect="fail"');
    }
    if($stmt = $mysqli->prepare("INSERT INTO vol(noVol) VALUES (?)"))
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

function insertEnvolee($date,$idvol)
{
    $mysqli = new mysqli("127.0.0.1","root","","portair");
    if ($mysqli->connect_errno)
    {
        printf("Connect failed: %s\n", mysqli_connect_error());
        header('index.php?Connect="fail"');
    }
    $formatdate = date("Y-m-d",strtotime($date));
    if($stmt = $mysqli->prepare("INSERT INTO envolee(idEnvolee,Date,Vol_idVol) VALUES (?,?,?)"))
    {
        if (!$stmt->bind_param("sss",$id, $formatdate,$idvol))
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


function insertSegment($duree,$segment,$heuredepart,$idvol,$depart,$arrive,$avion ,$pilote)
{
    $mysqli = new mysqli("127.0.0.1","root","","portair");
    if ($mysqli->connect_errno)
    {
        printf("Connect failed: %s\n", mysqli_connect_error());
        header('index.php?Connect="fail"');
    }
    $datetime = date("H:m:s",strtotime($heuredepart));
    echo"$datetime";
    if($stmt = $mysqli->prepare("INSERT INTO segmentvol(TypeSegment,Duree,HeureDepart,Aeropart_idAeropartDepart,Aeropart_idAeropartArrivee,Appareil_idAppareil,Pilote_idPilote,Vol_idVol) VALUES (?,?,?,?,?,?,?,?)"))
    {
        echo "here";
        if (!$stmt->bind_param("ssssssss",$segment,$duree,$datetime,$depart,$arrive,$avion,$pilote,$idvol))
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



