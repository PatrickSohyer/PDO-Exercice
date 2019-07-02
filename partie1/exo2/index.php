<?php 

$bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', '');
$rqtShowTypes = $bdd->query('SELECT * From showtypes');

$showtypes = $rqtShowTypes->fetchAll(); // je lui demande de me fetch un tableau associatif

$i = 1;
foreach ($showtypes as $types) { // je parcours mon tableau clients qui a une clé et une valeur(qui et un tableau associatif) 
       
?>

<p><?= $i; ?> : <?= $types['type']; ?></p>




<?php
$i++;
}?>
