#!/opt/lampp/bin/php
<?php
	while (true)
{
   	shell_exec('mosquitto_sub -h mqtt.iut-blagnac.fr -t Student/by-room/B201/data -C 1 | jq ".[0].temperature, .[1].deviceName, .[1].devEUI, .[1].room, .[1].Building" > /home/ndupont/Desktop/stockage_donnees/B201.txt');
    $id_bd=mysqli_connect("localhost", "DUPONT", "22209481", "sae23") or die('Connexion impossible');
	
	$bat=shell_exec('more /home/ndupont/Desktop/stockage_donnees/B201.txt | sed -n 5p | tr -d \'"\'');
	$room=shell_exec('more /home/ndupont/Desktop/stockage_donnees/B201.txt | sed -n 4p | tr -d \'"\'');
	$code=shell_exec('more /home/ndupont/Desktop/stockage_donnees/B201.txt | sed -n 3p | tr -d \'"\'');
	$nom=shell_exec('more /home/ndupont/Desktop/stockage_donnees/B201.txt | sed -n 2p | tr -d \'"\'');
    $valeur=shell_exec('more /home/ndupont/Desktop/stockage_donnees/B201.txt | sed -n 1p');
	$valeurMDP="passgim";
	$valeurLogin="batgim";
	$CodeBat="2";
    
    echo $valeur;
    echo $nom;
    echo $code;
    echo $room;
	echo $bat;
   
    $requetebat="INSERT INTO `Batiment` (`CodeBat`, `Nom`, `Login`, `MDP`) VALUES ('2','$bat','$valeurLogin','$valeurMDP')";
	$requetecapt="INSERT INTO `Capteur` (`CodeCapt`, `Nom`, `Type`, `CodeBat`) VALUES ('$code','$room','Temperature','$CodeBat')";
	$requetevaleur="INSERT INTO `Mesure` (`Valeur`, `CodeCapt`) VALUES ('$valeur','$code')";
	if (mysqli_query($id_bd,$requetebat)){}
	if (mysqli_query($id_bd,$requetecapt)){}
	mysqli_query($id_bd,$requetevaleur);
}
?>
