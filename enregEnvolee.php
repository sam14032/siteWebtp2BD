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
        <form action="" method="post">


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
                        <select name='segement'>
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
                            <option value="QSI">Sept-iles</option>
                            <option value="QGA">Gaspé</option>
                            <option value="QRY">Rimouski</option>
                            <option value="QBC">Baie-Comeau</option>
                            <option value="QMJ">Mont-Jolie</option>
                            <option value="QHP">Havre St-Pierre</option>
                        </select>
                    </td>
                </tr>
                <tr><td>Arrivée</td>
                    <td>
                        <select name="aeArrivee">
                            <option value="QSI">Sept-iles</option>
                            <option value="QGA">Gaspé</option>
                            <option value="QRY">Rimouski</option>
                            <option value="QBC">Baie-Comeau</option>
                            <option value="QMJ">Mont-Jolie</option>
                            <option value="QHP">Havre St-Pierre</option>
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
                            <option value="1">CADM</option>
                            <option value="2">COPA</option>
                        </select>
                    </td>
                </tr>
                <tr><td>Pilote</td>
                    <td>
                        <select name="pilote">
                            <option value="1">Serge Korvac</option>
                            <option value="2">Robert Hallec</option>
                            <option value="3">Steve Tremblay</option>
                        </select>
                    </td>
                </tr>
            </table>
            <br>
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