<!DOCTYPE>
<html>

<?php
include 'headerButtons.php';
//création du formulaire et des erreurs.
?>

<body>
<div class="bodyDiv"></div>

<div class="bodyDiv">
    <br>
    <br>

    <h1>Information d'une envolée</h1>

    <br>
    <form action="insertenvolee.php" method="post">

        <table>
            <tr><th>Information de l'envolée</th></tr>
            <tr>
                <td>Date de départ</td>
                <td><input type='date' name='date'></td>
            </tr>
            <tr><td>Appareil</td>
                <td>
                    <select name="avion">
                        <?php
                        selectAppareil();
                        ?>
                    </select>
                </td>
            </tr>
            <tr><td>Pilote</td>
                <td>
                    <select name="pilote">
                        <?php
                        selectPilote();
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Identifiant vol</td>
                <td>
                    <select name="idvol">
                        <?php
                        selectVol();
                        ?>
                    </select>
                </td>
            </tr>
        </table>
        <input type="submit" name="submit" value="Submit">
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
?>
