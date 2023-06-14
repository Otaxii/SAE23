#!/opt/lampp/bin/php
<?php
    $temp=5;
    echo $temp;
    $id_bd=mysqli_connect("localhost", "DUPONT", "22209481", "sae23") or die('Connexion impossible');
    $requete="INSERT INTO `Mesure` (`Valeur`, `CodeCapt`) VALUES ($temp,1)";
    mysqli_query($id_bd,$requete) or die ("Ajout échoué $requete");
?>
