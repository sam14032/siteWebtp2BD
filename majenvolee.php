<!DOCTYPE>
<html>

<?php
include 'headerButtons.php';
?>

<body>
<div class="bodyDiv"></div>

<div class="bodyDiv">
    <h1>Information d'une envolée</h1>

    <form action="majenvolee.php" method="post">
        <table>
            <tr>
                <th>Sélectionner l'envolée</th>
            </tr>
            <tr>
                <td><select name="envolee">
                        <?php
                        selectEnvolee();
                        ?>
                    </select>
                </td>
            </tr>
        </table>

        <input type="submit" name="submit" value="Sélectionner">
    </form>
    <br>
    <br>
    <?php
    if (isset($_POST["envolee"]))
    {
        $envolee = $_POST["envolee"];
        selectEnvoleeFromDB($envolee);
        showModification();
        echo'
        <input type="submit" name="submit" value="Modifier">
        </form>
        ';
    }
    ?>
    <?php
    //Gestion des erreurs possibles
    if (isset($_GET["error"]))
    {
        if ($_GET["error"] == "date")
        {
            echo "La date n'est pas valide";
        }
    }
    ?>

    </form>
</div>
<div class="bodyDiv"></div>
<div class ="clear"></div>
</body>
</html>


<?php
function showModification()
{

    echo'
    <form action="insertenvolee.php" method="post">

        <table>
            <tr><th>Information de lenvolée</th></tr>
            <tr>
                <td>Date de départ</td>
                <td><input type="date" name="date"></td>
            </tr>
            <tr><td>Appareil</td>
                <td>
                    <select name="avion">
    ';

    selectAppareil();
    echo '
                    </select>
                </td>
            </tr>
            <tr><td>Pilote</td>
                <td>
                    <select name="pilote">
                    ';
    selectPilote();
    echo'
                    </select>
                </td>
            </tr>
            <tr>
                <td>Identifiant vol</td>
                <td>
                <select name="idvol">
                ';
    selectVol();
    echo'
                    </select>
                    </td>
            </tr>
        </table>
        ';
}

//idEnvolee,Date,Vol_idVol,Pilote_idPilote,Appareil_idAppareil
//permet d'aller chercher les identifiants et les noms des pilotes depuis la base de données
function selectEnvolee()
{
    $mysqli = new mysqli("127.0.0.1","root","","portair");
    if ($stmt = $mysqli->prepare("SELECT idEnvolee FROM envolee"))
    {
        $stmt->execute();
        $result= $stmt->get_result();
        if ($result->num_rows !=0)
        {
            while ($row = $result->fetch_assoc())
            {
                $nom = $row['idEnvolee'];
                echo"<option value='$nom'>$nom</option>";
            }
        }
    }
}
//permet d'aller chercher les identifiants et les noms des pilotes depuis la base de données
function selectPilote()
{
    $mysqli = new mysqli("127.0.0.1","root","","portair");
    if ($stmt = $mysqli->prepare("SELECT idPilote,Nom FROM pilote"))
    {
        $stmt->execute();
        $result= $stmt->get_result();
        if ($result->num_rows !=0)
        {
            while ($row = $result->fetch_assoc())
            {
                $nom = $row['Nom'];
                $id = $row['idPilote'];
                echo"<option value='$id'>$nom</option>";
            }
        }
    }
}

//permet d'aller chercher les identifiants et les noms des avions depuis la base de données.
function selectAppareil()
{
    $mysqli = new mysqli("127.0.0.1","root","","portair");
    if ($stmt = $mysqli->prepare("SELECT idAppareil,Nom FROM appareil"))
    {
        $stmt->execute();
        $result= $stmt->get_result();
        if ($result->num_rows !=0)
        {
            while ($row = $result->fetch_assoc())
            {
                $nom = $row['Nom'];
                $id = $row['idAppareil'];
                echo"<option value='$id'>$nom</option>";
            }
        }
    }
}

function selectVol()
{
    $mysqli = new mysqli("127.0.0.1","root","","portair");
    if ($stmt = $mysqli->prepare("SELECT noVol FROM vol"))
    {
        $stmt->execute();
        $result= $stmt->get_result();
        if ($result->num_rows !=0)
        {
            while ($row = $result->fetch_assoc())
            {
                $nom = $row['noVol'];
                echo"<option value='$nom'>$nom</option>";
            }
        }
    }
}

function selectEnvoleeFromDB($envolee)
{
    echo"<table>
            <tr><th>Envolée actuelle</th></tr>";
    $mysqli = new mysqli("127.0.0.1","root","","portair");
    if ($stmt = $mysqli->prepare("SELECT * FROM envolee WHERE idEnvolee = ?"))
    {
        $stmt->bind_param("s",$envolee);
        $stmt->execute();
        $result= $stmt->get_result();
        if ($result->num_rows !=0)
        {
            while ($row = $result->fetch_assoc())
            {
                $date = $row['Date'];
                $vol = $row['Vol_idVol'];
                $pilote = $row['Pilote_idPilote'];
                $avion = $row["Appareil_idAppareil"];
                echo"<tr><td>Date :</td><td> $date</td></tr>";
                echo"<tr><td>Vol :</td><td> $vol</td></tr>";
                echo"<tr><td>Pilote :</td><td> $pilote</td></tr>";
                echo"<tr><td>Avion :</td><td> $avion</td></tr>";
            }
        }
    }
    echo"</table>";
}
?>
