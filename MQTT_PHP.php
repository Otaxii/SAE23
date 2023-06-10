#!/opt/lampp/bin/php
<?php
printf("Voici les valeur");
mysqli_connect("192.168.103.25", "DUPONT", "passroot");
printf("Connexion au serveur BD résussi");
$valeurhum = shell_exec('mosquitto_sub -h "mqtt.iut-blagnac.fr" -t "Student/by-deviceName/AM107-5/data" -C 1 | jq ".[0].humidity"');
printf($valeurhum);
mysqli_query()
?>
