<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Consultation</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <h1>Consultation</h1>

    <ul>
        <li><a href="index.html">Accueil</a></li>
        <li><a href="login.php">Administration</a></li>
        <li><a href="gestion.php">Gestion</a></li>
        <li><a href="gestion_de_projet.html">Gestion de Projet</a></li>
    </ul>

    <h3>Bâtiment R&T</h3>

    <table>
        <thead>
            <tr>
                <th>Salle</th>
                <th>Température</th>
            </tr>
        </thead>
        <tbody>
            <?php
           
            $db = mysqli_connect("localhost", "DUPONT", "22209481", "sae23") or die('Connexion impossible');

            // Retrieve the last value for each room in the R&T building
            $query_dernieres_valeurs_rt = "SELECT Mesure.Valeur, Capteur.Salle FROM Mesure JOIN Capteur ON Mesure.CodeCapt = Capteur.CodeCapt WHERE Capteur.CodeBat = 1 AND Mesure.CodeMes IN (SELECT MAX(CodeMes) FROM Mesure WHERE CodeCapt IN (SELECT CodeCapt FROM Capteur WHERE CodeBat = 1) GROUP BY CodeCapt)";
            $result_dernieres_valeurs_rt = mysqli_query($db, $query_dernieres_valeurs_rt);

            // Display the last value for each room in the R&T building
            while ($mesure_rt = mysqli_fetch_assoc($result_dernieres_valeurs_rt)) {
                echo "<tr>";
                echo "<td>" . $mesure_rt['Salle'] . "</td>";
                echo "<td>" . $mesure_rt['Valeur'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <h3>Bâtiment GIM</h3>

    <table>
        <thead>
            <tr>
                <th>Salle</th>
                <th>Température</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Retrieve the last value for each room in the GIM building
            $query_dernieres_valeurs_gim = "SELECT Mesure.Valeur, Capteur.Salle FROM Mesure JOIN Capteur ON Mesure.CodeCapt = Capteur.CodeCapt WHERE Capteur.CodeBat = 2 AND Mesure.CodeMes IN (SELECT MAX(CodeMes) FROM Mesure WHERE CodeCapt IN (SELECT CodeCapt FROM Capteur WHERE CodeBat = 2) GROUP BY CodeCapt)";
            $result_dernieres_valeurs_gim = mysqli_query($db, $query_dernieres_valeurs_gim);

            // Display the last value for each room in the GIM building
            while ($mesure_gim = mysqli_fetch_assoc($result_dernieres_valeurs_gim)) {
                echo "<tr>";
                echo "<td>" . $mesure_gim['Salle'] . "</td>";
                echo "<td>" . $mesure_gim['Valeur'] . "</td>";
                echo "</tr>";
            }

            
            mysqli_close($db);
            ?>
        </tbody>
    </table>

    <footer>
        <a href="https://www.iut-blagnac.fr/fr/" class="footer-left">IUT Blagnac</a>
        <a href="https://www.iut-blagnac.fr/fr/departement-rt" class="footer-right">BUT Réseaux et Télécommunication</a>
    </footer>

</body>
</html>

