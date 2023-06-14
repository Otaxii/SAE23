#!/opt/lampp/bin/php
<?php
	while (true) //infinite loop
{
   	shell_exec('mosquitto_sub -h mqtt.iut-blagnac.fr -t Student/by-room/E106/data -C 1 | jq ".[0].temperature, .[1].deviceName, .[1].devEUI, .[1].room, .[1].Building" > /home/ndupont/Desktop/stockage_donnees/E106.txt');
       $id_bd=mysqli_connect("localhost", "DUPONT", "22209481", "sae23") or die('Connexion impossible'); //connexion to the database
	
	$bat=shell_exec('more /home/ndupont/Desktop/stockage_donnees/E106.txt | sed -n 5p | tr -d \'"\''); //recovery and line filtering of data stored in the file
	$room=shell_exec('more /home/ndupont/Desktop/stockage_donnees/E106.txt | sed -n 4p | tr -d \'"\''); //recovery and line filtering of data stored in the file
	$code=shell_exec('more /home/ndupont/Desktop/stockage_donnees/E106.txt | sed -n 3p | tr -d \'"\''); //recovery and line filtering of data stored in the file
	$nom=shell_exec('more /home/ndupont/Desktop/stockage_donnees/E106.txt | sed -n 2p | tr -d \'"\''); //recovery and line filtering of data stored in the file
        $valeur=shell_exec('more /home/ndupont/Desktop/stockage_donnees/E106.txt | sed -n 1p'); //recovery and line filtering of data stored in the file
	$valeurMDP="passrt";
	$valeurLogin="batrt";
	$CodeBat="1";
    
        echo $valeur;
        echo $nom;
        echo $code;
        echo $room;
	echo $bat;
	
   	//queries and sending filtered data to the database
        $requetebat="INSERT INTO `Batiment` (`CodeBat`, `Nom`, `Login`, `MDP`) VALUES ('1','$bat','$valeurLogin','$valeurMDP')";
	$requetecapt="INSERT INTO `Capteur` (`CodeCapt`, `Nom`, `Type`, `CodeBat`) VALUES ('$code','$room','Temperature','$CodeBat')";
	$requetevaleur="INSERT INTO `Mesure` (`Valeur`, `CodeCapt`) VALUES ('$valeur','$code')";
	if (mysqli_query($id_bd,$requetebat)){}
	if (mysqli_query($id_bd,$requetecapt)){}
	mysqli_query($id_bd,$requetevaleur);
}
?>
