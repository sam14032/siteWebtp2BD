<?php
$date = $_POST["date"];
$duree = $_POST["duree"];
$segment = $_POST["segment"];
$heuredepart = $_POST["time"];
$depart = $_POST["aeDepart"];
$arrive = $_POST["aeArrivee"];
$avion = $_POST["avion"];
$pilote = $_POST["pilote"];

$mysqli = new mysqli("localhost","host","");
if ($mysqli_connect_errno())
{
    printf("Connect failed: %s\n", mysqli_connect_error());
    header("index.php?")
}
?>