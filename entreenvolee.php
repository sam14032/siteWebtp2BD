<!DOCTYPE>
<html>

<?php
include 'headerButtons.php';
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
                <tr><th>Information du segment</th></tr>

                <tr>
                    <td>Date de départ</td>
                    <td><input type='date' name='date'></td>
                </tr>

                <tr><td>Durée en minute</td>
                    <td><input type="text" name="duree"></td></tr>
                <?php
                if (isset($_GET["durMin"]))
                {
                    echo"La durée ne peut être de zéro.";
                }
                ?>

                <tr><td>Identifiant du segment</td>
                    <td>
                        <select name='segment'>
                            <option value='A'>A</option>
                            <option value='B'>B</option>
                            <option value='C'>C</option>
                            <option value='D'>D</option>
                            <option value='E'>E</option>
                        </select>
                    </td>
                </tr>
                <tr><td>Heure de départ</td><td><input type="time" name="time"></td></tr>
            </table>

            <br>
            <br>

            <table>
                <tr><th>Aéroport</th></tr>
                <tr><td>Départ</td>
                    <td>
                        <select name="aeDepart">
                            <option value="1">Sept-iles</option>
                            <option value="2">Gaspé</option>
                            <option value="3">Rimouski</option>
                            <option value="4">Baie-Comeau</option>
                            <option value="5">Mont-Jolie</option>
                            <option value="6">Havre St-Pierre</option>
                        </select>
                    </td>
                </tr>
                <tr><td>Arrivée</td>
                    <td>
                        <select name="aeArrivee">
                            <option value="1">Sept-iles</option>
                            <option value="2">Gaspé</option>
                            <option value="3">Rimouski</option>
                            <option value="4">Baie-Comeau</option>
                            <option value="5">Mont-Jolie</option>
                            <option value="6">Havre St-Pierre</option>
                        </select>
                    </td>
                </tr>
            </table>
            <?php
            if (isset($_GET["erDepart"]))
            {
                echo"Le départ et l'arrivé ne peut être pareil.";
            }
            ?>

            <br>

            <table>
                <tr><th>Information de l'appareil</th></tr>
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
            </table>
            <br>
            <table>
                <tr><th>Vol</th></tr>
                <tr>
                    <td>Identifiant vol</td>
                    <td>
                        <select name="idvol">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </td>
                </tr>
            </table>
            <input type="submit" name="submit" value="Submit">
            <?php
            if (isset($_GET["Error"]))
            {
                echo"Tout les champs doivent être remplis";
            }
            ?>
        </form>
    </div>
    </div>
    <div class="bodyDiv"></div>
    <div class ="clear"></div>
</body>
</html>

<?php

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
?>