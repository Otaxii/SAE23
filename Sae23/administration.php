 <?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
}
else{
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

            // Récupération de toutes les salles
            $query_salles = "SELECT DISTINCT Salle FROM Capteur";
            $result_salles = mysqli_query($db, $query_salles);

            // Affichage des options du menu déroulant
            while ($salle = mysqli_fetch_assoc($result_salles)) {
                echo "<option value='" . $salle['Salle'] . "'>" . $salle['Salle'] . "</option>";
            }

            // Fermeture de la connexion à la base de données
            mysqli_close($db);
            ?>
        </select>

        <input type="submit" name="submit" value="Supprimer">
    </form>

<?php
    // Vérification si le formulaire a été soumis
    if (isset($_POST['submit'])) {
        // Récupération de la salle sélectionnée dans le menu déroulant
        $salle = $_POST['salle'];
		echo $salle;

        // Connexion à la base de données
        $db = mysqli_connect("localhost", "DUPONT", "22209481", "sae23") or die('Connexion impossible');

        // Suppression du capteur en fonction de la salle sélectionnée
		$query_suppression = "DELETE FROM Capteur WHERE Salle = '$salle'";
        mysqli_query($db,$query_suppression) or die ("Il ne veux pas supprimé le Capteur");

        // Vérification si la suppression a réussi
        if (mysqli_affected_rows($db) > 0) {
            echo "<p>Le capteur de la salle '" . $salle . "' a été supprimé avec succès.</p>";
        } else {
            echo "<p>La suppression du capteur a échoué. Veuillez réessayer.</p>";
        }

        // Fermeture de la connexion à la base de données
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
    // Vérification si le formulaire a été soumis
    if (isset($_POST['submit'])) {
        // Récupération des valeurs du formulaire
        $salle = $_POST['salle'];
        $codecapt = $_POST['codecapt'];
        $type = $_POST['type'];
        $valeur = $_POST['CodeBat'];

        // Connexion à la base de données
       $db = mysqli_connect("localhost", "DUPONT", "22209481", "sae23") or die('Connexion impossible');

        // Insertion du nouveau capteur
        $query_insertion = "INSERT INTO Capteur (Salle, CodeCapt, Type, CodeBat) VALUES ('$salle', '$codecapt', '$type', $valeur)";
        mysqli_query($db, $query_insertion);

        // Vérification si l'insertion a réussi
        if (mysqli_affected_rows($db) > 0) {
            echo "<p>Le capteur a été ajouté avec succès.</p>";
        } else {
            echo "<p>L'ajout du capteur a échoué. Veuillez réessayer.</p>";
        }

        // Fermeture de la connexion à la base de données
        mysqli_close($db);
    }
    ?>

<footer>
  <a href="https://www.iut-blagnac.fr/fr/" class="footer-left">IUT Blagnac</a>
  <a href="https://www.iut-blagnac.fr/fr/departement-rt" class="footer-right">BUT Réseaux et Télécommunication</a>
</footer>

</body>
</html>
