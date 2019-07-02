<?php
$bdd = new PDO('mysql:host=localhost;dbname=hospitale2n;charset=utf8', 'root', ''); 
$req = $bdd->query('SELECT * FROM appointments INNER JOIN patients ON appointments.idPatients = patients.id');
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

        <?php foreach ($reqFetch as $value) {
            ?>
        
        <p><a href="rendezvous.php?id=<?= $value['id']; ?>">Rendez vous de <?= $value['firstname'] . ' ' . $value['lastname'] ?></a></p>
        
        <?php } ?>
        
        <a href="ajouter-rendezvous.php">Ajouter un rendez-vous</a>
        
</body>
</html>