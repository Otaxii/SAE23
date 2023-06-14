<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bât</title>
	<link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <h1>Bâtiment GIM</h1>
    <!-- Ajoutez votre contenu spécifique à la page de consultation ici -->
    <ul>
        <li><a href="index.html">Accueil</a></li>
        <li><a href="login.php">Administration</a></li>
        <li><a href="gestion.php">Gestion</a></li>
		<li><a href="consultation.php">Consultation</a></li>
        <li><a href="gestion_de_projet.html">Gestion de Projet</a></li>
    </ul>

	<h3>Bâtiment GIM</h3> 

    <table>
        <tbody>
            <tr>
                <th>Salle</th>
                <th>Température</th>
            </tr>

            <?php
            // Connexion à la base de données
            $db = mysqli_connect("localhost", "DUPONT", "22209481", "sae23") or die('Connexion impossible');

            // Récupérer toutes les mesures
            $query_all_measures = "SELECT Mesure.*, Capteur.Salle FROM Mesure JOIN Capteur ON Mesure.CodeCapt = Capteur.CodeCapt WHERE Capteur.CodeBat = 0";
            $result_all_measures = mysqli_query($db, $query_all_measures);

            while ($measure = mysqli_fetch_assoc($result_all_measures)) {
                // Afficher chaque mesure
                echo "<tr>";
                echo "<td>" . $measure['Salle'] . "</td>";
                echo "<td>" . $measure['Valeur'] . "</td>";
                echo "</tr>";
            }
            ?>

        </tbody>
    </table>

    <footer>
        <a href="https://www.iut-blagnac.fr/fr/" class="footer-left">IUT Blagnac</a>
        <a href="https://www.iut-blagnac.fr/fr/departement-rt" class="footer-right">BUT Réseaux et Télécommunication</a>
    </footer>

</body>
</html>
