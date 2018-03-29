<!DOCTYPE>
<html>

<?php
include 'headerButtons.php';
?>

<body>
<div class="bodyDiv"></div>

<div class="bodyDiv">
    <h1>Information d'une envolée</h1>

    <form action="modifenvolee.php" method="post">
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
    </form>

    <br>
    <br>
    
    <br>
    <form action="insertenvolee.php" method="post">

        <table>
            <tr><th>Information de l'envolée</th></tr>
            <tr>
                <td>Date de départ</td>
                <td><input type="date" name="date"></td>
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
                <td><input type="text" name="idvol"></td>
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
