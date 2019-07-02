<?php
if (isset($_GET['id'])) {
$bdd = new PDO('mysql:host=localhost;dbname=hospitale2n;charset=utf8', 'root', ''); 
$id = $_GET['id'];
$req = $bdd->prepare('SELECT appointments.dateHour, appointments.idPatients, patients.lastname, patients.firstname FROM appointments INNER JOIN patients ON appointments.idPatients = patients.id WHERE appointments.id = :id');
$req->bindValue(':id', $id);
$req->execute();
$reqFetch = $req->fetchAll();
var_dump($reqFetch);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Formulaire Patient</title>
    </head>
    <body>

        <?php foreach($reqFetch as $value) { ?>
       
        <p><?= $value['dateHour'] ?></p>
        <p><?= $value['firstname'] ?></p>
        <p><?= $value['lastname'] ?></p>
      
        <?php } }?>
</body>
</html>