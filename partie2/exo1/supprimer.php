<?php

$bdd = new PDO('mysql:host=localhost;dbname=hospitale2n;charset=utf8', 'root', '');
$req = $bdd->prepare('DELETE FROM appointments WHERE id = :id LIMIT 1');