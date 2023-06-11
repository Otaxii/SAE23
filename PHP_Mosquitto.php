#!/opt/lampp/bin/php
<?php
   $temp=shell_exec('mosquitto_sub -h mqtt.iut-blagnac.fr -t Student/by-room/B101/data -C 1 | jq ".[] | {temperature,deviceName}"');
    //$id_bd=mysqli_connect("localhost", "DUPONT", "22209481", "sae23") or die('Connexion impossible');
     echo $temp;
    //$requete="INSERT INTO `Mesure` (`Valeur`, `CodeCapt`) VALUES ($temp,1)";
    //mysqli_query($id_bd,$requete) or die ("Ajout échoué $requete");
    
?>

