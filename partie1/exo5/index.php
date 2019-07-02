<?php
$bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', '');
$rqtClients = $bdd->query('SELECT clients.lastName, clients.firstName From clients WHERE lastName LIKE \'M%\' ORDER BY lastName');

$clients = $rqtClients->fetchAll(PDO::FETCH_ASSOC); // je lui demande de me fetch un tableau associatif

foreach ($clients as $key => $value) { // je parcours mon tableau clients qui a une clé et une valeur(qui et un tableau associatif) 
    foreach ($value as $key2 => $value2) {
        ?>

        <p><?= $key2; ?> : <?= $value2; ?></p>

        <?php
    }
}
    ?>