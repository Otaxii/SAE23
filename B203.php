#!/opt/lampp/bin/php
<?php
   	shell_exec('mosquitto_sub -h mqtt.iut-blagnac.fr -t Student/by-room/B203/data -C 1 | jq ".[0].temperature, .[1].deviceName, .[1].devEUI, .[1].room, .[1].Building" > /home/sae23miceli/Desktop/stockage_donnees/B203.txt');
    //$id_bd=mysqli_connect("localhost", "miceli", "22211833", "sae23") or die('Connexion impossible');
	
	$bat=shell_exec('more /home/sae23miceli/Desktop/stockage_donnees/B203.txt | sed -n 5p | tr -d \'"\'');
	$room=shell_exec('more /home/sae23miceli/Desktop/stockage_donnees/B203.txt | sed -n 4p | tr -d \'"\'');
	$code=shell_exec('more /home/sae23miceli/Desktop/stockage_donnees/B203.txt | sed -n 3p | tr -d \'"\'');
	$nom=shell_exec('more /home/sae23miceli/Desktop/stockage_donnees/B203.txt | sed -n 2p | tr -d \'"\'');
    $valeur=shell_exec('more /home/sae23miceli/Desktop/stockage_donnees/B203.txt | sed -n 1p');
    
    echo $valeur;
    echo $nom;
    echo $code;
    echo $room;
	echo $bat;
   
    //$requete="INSERT INTO `Mesure` (`Valeur`, `CodeCapt`) VALUES ($temp,1)";
    //mysqli_query($id_bd,$requete) or die ("Ajout échoué $requete");
?>
