<?php
$bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', '');
$rqtClients = $bdd->query('SELECT * From clients');

$clients = $rqtClients->fetchAll();

foreach($clients as $key) {
        ?>

        <p>Nom : <?= $key['lastName'] ?></p>
        <p>Prénom : <?= $key['firstName'] ?></p>
        <p>Date de naissance : <?= $key['birthDate'] ?></p>
        <?php if($key['card'] == 0) { ?><p>Carte de fidélité : Non </p><?php } else { ?>
        <p>Carte de fidélité : Oui </p> <?php } ?>
        <?php if($key['card'] == 1) { ?>
        <p>Numéro de la carte : <?= $key['cardNumber']; ?></p> <?php } else {  } ?> 
        
<?php } ?>
