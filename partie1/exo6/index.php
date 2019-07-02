<?php
$bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', '');
$rqtShows = $bdd->query('SELECT shows.title, shows.performer, shows.date, shows.startTime From shows LIMIT 20');

$shows = $rqtShows->fetchAll(PDO::FETCH_ASSOC); // je lui demande de me fetch un tableau associatif

foreach ($shows as $key => $value) { // je parcours mon tableau clients qui a une clé et une valeur(qui et un tableau associatif) 
    foreach ($value as $key2 => $value2) {
        ?>

        <p><?= $key2; ?> : <?= $value2; ?></p>

        <?php
    }
}
    ?>