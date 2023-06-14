#!/opt/lampp/bin/php
<?php
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connexion à la base de données
    $conn = mysqli_connect("localhost", "BACQUIE", "passroot", "sae23");

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

        if ($username == "batrt") {
            header('Location: batimentRT.php');
        } elseif ($username == "batgim") {
            header('Location: batimentGIM.php');
        } else {
            // Utilisateur inconnu
            header('Location: login.php?erreur=1');
        }

      exit();
    }
 else {
    header('Location: login.php');
    exit();
}
}
?>

