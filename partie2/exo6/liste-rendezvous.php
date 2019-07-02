<?php
$bdd = new PDO('mysql:host=localhost;dbname=hospitale2n;charset=utf8', 'root', ''); 
$req = $bdd->query('SELECT appointments.dateHour, appointments.idPatients, patients.lastname, patients.firstname FROM appointments INNER JOIN patients ON appointments.idPatients = patients.id');
$reqFetch = $req->fetchAll();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Formulaire Patient</title>
    </head>
    <body>

        <?php foreach ($reqFetch as $value) {
            ?>
        
        <p>Rendez vous le <?= $value['dateHour'] ?> avec <?= $value['firstname'] . ' ' . $value['lastname'] ?></p>
        
        <?php } ?>
        
        <a href="ajouter-rendezvous.php">Ajouter un rendez-vous</a>
        
</body>
</html>