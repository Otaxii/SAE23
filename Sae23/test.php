#!/opt/lampp/bin/php
<?php
// Connexion à la base de données
$id_bd=mysqli_connect("localhost", "BACQUIE", "passroot", "sae23");
echo "salut" >> /home/hbacquie/Documents/test.txt;



// Vérification de la connexion
if (!$id_bd) {
    die("Échec de la connexion à la base de données : " . mysqli_connect_error());
} else {
    echo "Connexion à la base de données réussie !";
}

// Fermer la connexion
mysqli_close($id_bd);
?>

