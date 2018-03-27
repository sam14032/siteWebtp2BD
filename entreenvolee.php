<!DOCTYPE>
<html>

<?php
include 'headerButtons.php';
?>

//création du formulaire et des erreurs.
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


                <tr><td>Identifiant du segment</td>
                    <td>
                        <select name='segment'>
                            <option value='A'>A</option>
                            <option value='B'>B</option>
                            <option value='C'>C</option>
                            <option value='D'>D</option>
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
						<td><input type="text" name="idvol"></td>
                    </td>
                </tr>
            </table>
            <input type="submit" name="submit" value="Submit">
			<?php
			//Gestion des erreurs possibles 
			if (isset($_GET["error"]))
			{
				if($_GET["error"] == "vol")
				{
					echo "Le vol n'est pas valide";
				}
				else if ($_GET["error"] == "date")
				{
					echo "La date n'est pas valide";
				}
				else if ($_GET["error"] == "segment")
				{
					echo "La durrée en minute et/ou l'heure de départ n'est ou ne sont pas valide(s)";
				}
				else if ($_GET["error"] == "aeroport")
				{
					echo"Le départ et l'arrivé ne peut être pareil.";
				}            
                else if ($_GET["error"] == "duree")
                {
                    echo"La durée ne peut être de zéro.";
                }
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
?>