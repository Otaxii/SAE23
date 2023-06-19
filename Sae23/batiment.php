<?php
// recover login and password 
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

   
    $conn = mysqli_connect("localhost", "DUPONT", "22209481", "sae23");

    
    if (!$conn) {
        die("Échec de la connexion à la base de données : " . mysqli_connect_error());
    }

    // Verify login information
    $query = "SELECT * FROM Batiment WHERE Login = '$username' AND MDP= '$password'";
    $result = mysqli_query($conn, $query);

    // Check query results
    if (mysqli_num_rows($result) == 1) {
        // Nom d'utilisateur et mot de passe corrects
        $_SESSION['username'] = $username;
		$_SESSION['logged_in'] = true;
    }
}
?>
// Check that the user has logged in first, to avoid accessing the page without logging in. 
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
          
            $db = mysqli_connect("localhost", "DUPONT", "22209481", "sae23") or die('Connexion impossible');
			$username = $_POST['username'];
   			$password = $_POST['password'];
				
	// Depending on the user, either the rt building is displayed or the gim building.
				
            if ($username == "batrt") {

				echo "<h3>Bâtiment RT</h3>";

    			echo "<table>";
        		echo "<tbody>";
            	echo "<tr>";
                echo "<th>Salle</th>";
                echo "<th>Température</th>";
            	echo "</tr>";

                // Retrieve all measurements with the corresponding room
                $query_all_measures = "SELECT Mesure.*, Capteur.Salle FROM Mesure JOIN Capteur ON Mesure.CodeCapt = Capteur.CodeCapt WHERE Capteur.CodeBat = 1";
                $result_all_measures = mysqli_query($db, $query_all_measures);

                while ($measure = mysqli_fetch_assoc($result_all_measures)) {
                    // Display each measurement with the corresponding room
                    echo "<tr>";
                    echo "<td>" . $measure['Salle'] . "</td>";
                    echo "<td>" . $measure['Valeur'] . "</td>";
                    echo "</tr>";
                }

                echo "</tbody></table>";
                echo "<table><tbody>";
	 	// Calculates the average, max and min values of a room
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
                    // Display each measurement with the corresponding room, maximum value, minimum value and average.Calculates the average, max and min values of a room
                    echo "<tr>";
                    echo "<td>" . $measure['Salle'] . "</td>";
                    echo "<td>" . $measure['ValeurMax'] . "</td>";
                    echo "<td>" . $measure['ValeurMin'] . "</td>";
                    echo "<td>" . $measure['Moyenne'] . "</td>";
                    echo "</tr>";
                }

                echo "</tbody></table>";

             
                mysqli_close($db);
            } elseif ($username == "batgim") {

				echo "<h3>Bâtiment GIM</h3>";

    			echo "<table>";
        		echo "<tbody>";
            	echo "<tr>";
                echo "<th>Salle</th>";
                echo "<th>Température</th>";
            	echo "</tr>";
                // Retrieve all measurements with the corresponding room
                $query_all_measures = "SELECT Mesure.*, Capteur.Salle FROM Mesure JOIN Capteur ON Mesure.CodeCapt = Capteur.CodeCapt WHERE Capteur.CodeBat = 2";
                $result_all_measures = mysqli_query($db, $query_all_measures);

                while ($measure = mysqli_fetch_assoc($result_all_measures)) {
                    // Display each measurement with the corresponding room
                    echo "<tr>";
                    echo "<td>" . $measure['Salle'] . "</td>";
                    echo "<td>" . $measure['Valeur'] . "</td>";
                    echo "</tr>";
                }

                echo "</tbody></table>";
                echo "<table><tbody>";
		// Display each measurement with the corresponding room, maximum value, minimum value and average.Calculates the average, max and min values of a room
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
                    // Display each measurement with the corresponding room, maximum value, minimum value and average.
                    echo "<tr>";
                    echo "<td>" . $measure['Salle'] . "</td>";
                    echo "<td>" . $measure['ValeurMax'] . "</td>";
                    echo "<td>" . $measure['ValeurMin'] . "</td>";
                    echo "<td>" . $measure['Moyenne'] . "</td>";
                    echo "</tr>";
                }

                echo "</tbody></table>";

                
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

