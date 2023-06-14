<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Consultation</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <h1>Consultation</h1>
    <!-- Ajoutez votre contenu spécifique à la page de consultation ici -->
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
            // Connexion à la base de données
            $db = mysqli_connect("localhost", "BACQUIE", "passroot", "sae23") or die('Connexion impossible');

            // Récupérer la dernière valeur de chaque salle pour le bâtiment R&T
            $query_dernieres_valeurs_rt = "SELECT Mesure.Valeur, Capteur.Salle FROM Mesure JOIN Capteur ON Mesure.CodeCapt = Capteur.CodeCapt WHERE Capteur.CodeBat = 1 AND Mesure.CodeMes IN (SELECT MAX(CodeMes) FROM Mesure WHERE CodeCapt IN (SELECT CodeCapt FROM Capteur WHERE CodeBat = 1) GROUP BY CodeCapt)";
            $result_dernieres_valeurs_rt = mysqli_query($db, $query_dernieres_valeurs_rt);

            // Afficher la dernière valeur de chaque salle pour le bâtiment R&T
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
            // Récupérer la dernière valeur de chaque salle pour le bâtiment GIM
            $query_dernieres_valeurs_gim = "SELECT Mesure.Valeur, Capteur.Salle FROM Mesure JOIN Capteur ON Mesure.CodeCapt = Capteur.CodeCapt WHERE Capteur.CodeBat = 0 AND Mesure.CodeMes IN (SELECT MAX(CodeMes) FROM Mesure WHERE CodeCapt IN (SELECT CodeCapt FROM Capteur WHERE CodeBat = 2) GROUP BY CodeCapt)";
            $result_dernieres_valeurs_gim = mysqli_query($db, $query_dernieres_valeurs_gim);

            // Afficher la dernière valeur de chaque salle pour le bâtiment GIM
            while ($mesure_gim = mysqli_fetch_assoc($result_dernieres_valeurs_gim)) {
                echo "<tr>";
                echo "<td>" . $mesure_gim['Salle'] . "</td>";
                echo "<td>" . $mesure_gim['Valeur'] . "</td>";
                echo "</tr>";
            }

            // Fermer la connexion à la base de données
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

