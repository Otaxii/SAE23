#!/opt/lampp/bin/php
<?php
$salle='B201';

$db = mysqli_connect("localhost", "DUPONT", "22209481", "sae23") or die('Connexion impossible');

        // Suppression du capteur en fonction de la salle sélectionnée
		$query_suppression = "DELETE FROM Capteur WHERE Salle = '$salle\n'";
        mysqli_query($db,$query_suppression) or die ("Il ne veux pas supprimé le Capteur");
?>
