#!/opt/lampp/bin/php
<?php
	//data recovery via MQTT broker and storage in a file
   	shell_exec('mosquitto_sub -h mqtt.iut-blagnac.fr -t Student/by-room/B203/data -C 1 | jq ".[0].temperature, .[1].deviceName, .[1].devEUI, .[1].room, .[1].Building" > /home/ndupont/Desktop/stockage_donnees/B203.txt');
        $id_bd=mysqli_connect("localhost", "DUPONT", "22209481", "sae23") or die('Connexion impossible'); //connexion to the data base
	
	$bat=trim(shell_exec('more /home/ndupont/Desktop/stockage_donnees/B203.txt | sed -n 5p | tr -d \'"\''));//recovery and line filtering of data stored in the file
	$room=trim(shell_exec('more /home/ndupont/Desktop/stockage_donnees/B203.txt | sed -n 4p | tr -d \'"\''));//recovery and line filtering of data stored in the file
	$code=trim(shell_exec('more /home/ndupont/Desktop/stockage_donnees/B203.txt | sed -n 3p | tr -d \'"\''));//recovery and line filtering of data stored in the file
	$nom=trim(shell_exec('more /home/ndupont/Desktop/stockage_donnees/B203.txt | sed -n 2p | tr -d \'"\'')); //recovery and line filtering of data stored in the file
	$valeur=trim(shell_exec('more /home/ndupont/Desktop/stockage_donnees/B203.txt | sed -n 1p')); //recovery and line filtering of data stored in the file
	$valeurMDP="passgim";
	$valeurLogin="batgim";
	$CodeBat="2";
    
        echo $valeur;
        echo $nom;
        echo $code;
        echo $room;
	echo $bat;
	
   	//queries and sending filtered data to the database
	$requetebat="INSERT INTO `Batiment` (`CodeBat`, `Nom`, `Login`, `MDP`) VALUES ('2','$bat','$valeurLogin','$valeurMDP')";
	$requetecapt="INSERT INTO `Capteur` (`CodeCapt`, `Salle`, `Type`, `CodeBat`) VALUES ('$code','$room','Temperature','$CodeBat')";
	$requetevaleur="INSERT INTO `Mesure` (`Valeur`, `CodeCapt`) VALUES ('$valeur','$code')";
	if (mysqli_query($id_bd,$requetebat)){}
	if (mysqli_query($id_bd,$requetecapt)){}
	mysqli_query($id_bd,$requetevaleur);
?>
