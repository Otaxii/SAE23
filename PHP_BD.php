#!/opt/lampp/bin/php
<?php
    $temp=shell_exec('mosquitto_sub -h 192.168.102.209 -t iut/# -C 1');
    echo $temp;
    $id_bd=mysqli_connect("localhost", "DUPONT", "22209481", "sae23") or die('Connexion impossible');
    $requete="INSERT INTO `Mesure` (`Valeur`, `CodeCapt`) VALUES ($temp,1)";
    mysqli_query($id_bd,$requete) or die ("Ajout échoué $requete");
?>
