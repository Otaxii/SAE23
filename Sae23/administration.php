<h2>Ajouter un capteur</h2>
<form action="ajouter_capteur.php" method="post">
    <label>Salle: </label>
    <input type="text" name="salle">
    <label>Bâtiment: </label>
    <select name="code_batiment">
        <?php
        // Connexion à la base de données
        $db = mysqli_connect("localhost", "BACQUIE", "passroot", "sae23") or die('Connexion impossible');

        // Récupérer tous les bâtiments
        $query_batiments = "SELECT * FROM Batiment";
        $result_batiments = mysqli_query($db, $query_batiments);

        // Parcourir les bâtiments et les afficher dans la liste déroulante
        while ($batiment = mysqli_fetch_assoc($result_batiments)) {
            echo "<option value='" . $batiment['CodeBat'] . "'>" . $batiment['Nom'] . "</option>";
        }
        ?>
    </select>
    <input type="submit" value="Ajouter">
</form>

<h2>Supprimer un capteur</h2>
<form action="supprimer_capteur.php" method="post">
    <label>Code du capteur: </label>
    <input type="text" name="code_capteur">
    <input type="submit" value="Supprimer">
</form>

