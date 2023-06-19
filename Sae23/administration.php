 <?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {          
}
else{											// Check if the administrator is logged in to avoid accessing the page without logging in.
	header('Location: login.php');
}
?>
 <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Administration</title>
	<link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <h1>Administration</h1>

    <ul>
        <li><a href="index.html">Accueil</a></li>
        <li><a href="login.php">Administration</a></li>
        <li><a href="gestion.php">Gestion</a></li>
        <li><a href="consultation.html">Consultation</a></li>
		<li><a href="gestion_de_projet.html">Gestion de Projet</a></li>
    </ul>

    <h1>Suppression de capteur</h1>

    <form method="post" action="">
        <label for="salle">Sélectionnez une salle :</label>
        <select name="salle" id="salle">
            <?php
            // Connexion à la base de données
          $db = mysqli_connect("localhost", "DUPONT", "22209481", "sae23") or die('Connexion impossible');

           
            $query_salles = "SELECT DISTINCT Salle FROM Capteur";
            $result_salles = mysqli_query($db, $query_salles);
													
          
            while ($salle = mysqli_fetch_assoc($result_salles)) {
                echo "<option value='" . $salle['Salle'] . "'>" . $salle['Salle'] . "</option>"; 		//It connects to the database and retrieves the room to see which ones can be deleted from a drop-down menu. 
            }

            // Fermeture de la connexion à la base de données
            mysqli_close($db);
            ?>
        </select>

        <input type="submit" name="submit" value="Supprimer">
    </form>

<?php

    if (isset($_POST['submit'])) {
   
        $salle = $_POST['salle'];						
		echo $salle;

        $db = mysqli_connect("localhost", "DUPONT", "22209481", "sae23") or die('Connexion impossible');

        // Sensor deletion according to room selected
		$query_suppression = "DELETE FROM Capteur WHERE Salle = '$salle'";
        mysqli_query($db,$query_suppression) or die ("Il ne veux pas supprimé le Capteur");

        // Check if deletion was successful
        if (mysqli_affected_rows($db) > 0) {
            echo "<p>Le capteur de la salle '" . $salle . "' a été supprimé avec succès.</p>";
        } else {
            echo "<p>La suppression du capteur a échoué. Veuillez réessayer.</p>";
        }


        mysqli_close($db);
    }
    ?>


    <h1>Ajout de capteur</h1>

    <form method="post" action="">
        <label for="salle">Salle :</label>
        <input type="text" name="salle" id="salle" required><br><br>

        <label for="codecapt">Code Capteur :</label>
        <input type="text" name="codecapt" id="codecapt" required><br><br>

        <label for="type">Type :</label>
        <input type="text" name="type" id="type" required><br><br>

        <label for="valeur">CodeBat :</label>
        <input type="number" name="CodeBat" id="CodeBat" required><br><br>

        <input type="submit" name="submit" value="Ajouter">
    </form>

    <?php
    // Check if the form has been submitted
    if (isset($_POST['submit'])) {
        // Récupération des valeurs du formulaire
        $salle = $_POST['salle'];
        $codecapt = $_POST['codecapt'];
        $type = $_POST['type'];
        $valeur = $_POST['CodeBat'];

       $db = mysqli_connect("localhost", "DUPONT", "22209481", "sae23") or die('Connexion impossible');

        // Inserting the new sensor
        $query_insertion = "INSERT INTO Capteur (Salle, CodeCapt, Type, CodeBat) VALUES ('$salle', '$codecapt', '$type', $valeur)";
        mysqli_query($db, $query_insertion);

        // Check if insertion was successful
        if (mysqli_affected_rows($db) > 0) {
            echo "<p>Le capteur a été ajouté avec succès.</p>";
        } else {
            echo "<p>L'ajout du capteur a échoué. Veuillez réessayer.</p>";
        }

        
        mysqli_close($db);
    }
    ?>

<footer>
  <a href="https://www.iut-blagnac.fr/fr/" class="footer-left">IUT Blagnac</a>
  <a href="https://www.iut-blagnac.fr/fr/departement-rt" class="footer-right">BUT Réseaux et Télécommunication</a>
</footer>

</body>
</html>
