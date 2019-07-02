<?php
$bdd = new PDO('mysql:host=localhost;dbname=hospitale2n;charset=utf8', 'root', ''); 
$req = $bdd->query('SELECT * FROM patients');
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
        
        <p><a href="profil-patient.php?id=<?= $value['id'] ?>"><?= $value['lastname'] . ' ' . $value['firstname'] ?></a></p>
        
        <?php } ?>
        
        
</body>
</html>