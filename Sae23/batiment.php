<?php

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connexion à la base de données
    $conn = mysqli_connect("localhost", "DUPONT", "22209481", "sae23");

    // Vérification de la connexion à la base de données
    if (!$conn) {
        die("Échec de la connexion à la base de données : " . mysqli_connect_error());
    }

    // Préparation de la requête SQL pour vérifier les informations de connexion
    $query = "SELECT * FROM Batiment WHERE Login = '$username' AND MDP= '$password'";
    $result = mysqli_query($conn, $query);

    // Vérification des résultats de la requête
    if (mysqli_num_rows($result) == 1) {
        // Nom d'utilisateur et mot de passe corrects
        $_SESSION['username'] = $username;
		$_SESSION['logged_in'] = true;
    }
}
?>

<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
}
else{
	header('Location: gestion.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bât</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <h1>Bâtiment </h1>
    <!-- Ajoutez votre contenu spécifique à la page de consultation ici -->
    <ul>
        <li><a href="index.html">Accueil</a></li>
        <li><a href="login.php">Administration</a></li>
        <li><a href="gestion.php">Gestion</a></li>
        <li><a href="consultation.php">Consultation</a></li>
        <li><a href="gestion_de_projet.html">Gestion de Projet</a></li>
    </ul>
<?php
    
			if (isset($_POST['username']) && isset($_POST['password'])) {
            // Connexion à la base de données
            $db = mysqli_connect("localhost", "DUPONT", "22209481", "sae23") or die('Connexion impossible');
			$username = $_POST['username'];
   			$password = $_POST['password'];

            if ($username == "batrt") {

				echo "<h3>Bâtiment RT</h3>";

    			echo "<table>";
        		echo "<tbody>";
            	echo "<tr>";
                echo "<th>Salle</th>";
                echo "<th>Température</th>";
            	echo "</tr>";

                // Récupérer toutes les mesures avec la salle correspondante
                $query_all_measures = "SELECT Mesure.*, Capteur.Salle FROM Mesure JOIN Capteur ON Mesure.CodeCapt = Capteur.CodeCapt WHERE Capteur.CodeBat = 1";
                $result_all_measures = mysqli_query($db, $query_all_measures);

                while ($measure = mysqli_fetch_assoc($result_all_measures)) {
                    // Afficher chaque mesure avec la salle correspondante
                    echo "<tr>";
                    echo "<td>" . $measure['Salle'] . "</td>";
                    echo "<td>" . $measure['Valeur'] . "</td>";
                    echo "</tr>";
                }

                echo "</tbody></table>";
                echo "<table><tbody>";

                $query_measures = "SELECT Capteur.Salle, Mesure.Valeur, MAX(Mesure.Valeur) AS ValeurMax, MIN(Mesure.Valeur) AS ValeurMin, AVG(Mesure.Valeur) AS Moyenne FROM Mesure JOIN Capteur ON Mesure.CodeCapt = Capteur.CodeCapt WHERE Capteur.CodeBat = 1 GROUP BY Capteur.CodeCapt";
                $result_measures = mysqli_query($db, $query_measures);

                echo "<table><tbody>";
                echo "<tr>";
                echo "<th>Salle</th>";
                echo "<th>Température maximale</th>";
                echo "<th>Température minimale</th>";
                echo "<th>Moyenne de température</th>";
                echo "</tr>";

                while ($measure = mysqli_fetch_assoc($result_measures)) {
                    // Afficher chaque mesure avec la salle, la valeur maximale, la valeur minimale et la moyenne correspondantes
                    echo "<tr>";
                    echo "<td>" . $measure['Salle'] . "</td>";
                    echo "<td>" . $measure['ValeurMax'] . "</td>";
                    echo "<td>" . $measure['ValeurMin'] . "</td>";
                    echo "<td>" . $measure['Moyenne'] . "</td>";
                    echo "</tr>";
                }

                echo "</tbody></table>";

                // Fermer la connexion à la base de données
                mysqli_close($db);
            } elseif ($username == "batgim") {

				echo "<h3>Bâtiment GIM</h3>";

    			echo "<table>";
        		echo "<tbody>";
            	echo "<tr>";
                echo "<th>Salle</th>";
                echo "<th>Température</th>";
            	echo "</tr>";
                // Récupérer toutes les mesures avec la salle correspondante
                $query_all_measures = "SELECT Mesure.*, Capteur.Salle FROM Mesure JOIN Capteur ON Mesure.CodeCapt = Capteur.CodeCapt WHERE Capteur.CodeBat = 2";
                $result_all_measures = mysqli_query($db, $query_all_measures);

                while ($measure = mysqli_fetch_assoc($result_all_measures)) {
                    // Afficher chaque mesure avec la salle correspondante
                    echo "<tr>";
                    echo "<td>" . $measure['Salle'] . "</td>";
                    echo "<td>" . $measure['Valeur'] . "</td>";
                    echo "</tr>";
                }

                echo "</tbody></table>";
                echo "<table><tbody>";

                $query_measures = "SELECT Capteur.Salle, Mesure.Valeur, MAX(Mesure.Valeur) AS ValeurMax, MIN(Mesure.Valeur) AS ValeurMin, AVG(Mesure.Valeur) AS Moyenne FROM Mesure JOIN Capteur ON Mesure.CodeCapt = Capteur.CodeCapt WHERE Capteur.CodeBat = 2 GROUP BY Capteur.CodeCapt";
                $result_measures = mysqli_query($db, $query_measures);

                echo "<table><tbody>";
                echo "<tr>";
                echo "<th>Salle</th>";
                echo "<th>Température maximale</th>";
                echo "<th>Température minimale</th>";
                echo "<th>Moyenne de température</th>";
                echo "</tr>";

                while ($measure = mysqli_fetch_assoc($result_measures)) {
                    // Afficher chaque mesure avec la salle, la valeur maximale, la valeur minimale et la moyenne correspondantes
                    echo "<tr>";
                    echo "<td>" . $measure['Salle'] . "</td>";
                    echo "<td>" . $measure['ValeurMax'] . "</td>";
                    echo "<td>" . $measure['ValeurMin'] . "</td>";
                    echo "<td>" . $measure['Moyenne'] . "</td>";
                    echo "</tr>";
                }

                echo "</tbody></table>";

                // Fermer la connexion à la base de données
                mysqli_close($db);
            }
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

