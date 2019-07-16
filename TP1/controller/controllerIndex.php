<?php

require 'model/database.php';
require 'model/users.php';
require 'model/service.php';

$regexName = '/^[a-zA-ZéèÉÈôîêûÛÊÔÎùÙïöëüËÏÖÜç\']{2,17}[- \']?[a-zA-ZéèÉÈôîêûÛÊÔÎùÙïöëüËÏÖÜç]{0,17}$/';
$regexAddress = '/^([1-9]|[1-9][0-9]|[1-9][0-9]{2}|1[0-9]{3})[A|a|B|b]?[ ]?(bis)?[- ](avenue|Avenue|AVENUE|rue|Rue|RUE|Boulevard|BOULEVARD|boulevard|Impasse|IMPASSE|impasse|Allée|ALLEE|allée|hameau|Hameau|HAMEAU|Chemin|chemin|CHEMIN|lieu-dit|Lieu-dit|LIEU-DIT|lieu-Dit|Lieu-Dit)[- ][A-Za-zéèàâêŷûîôäëïöüÿùç]+([- ]?[A-Za-zéèàâêŷûîôäëïöüÿùç]{0,17}){0,3}$/';
$regexPostal = '/^((0[1-9]|[1-8][0-9]|9[0-5])[0-9]{3})|97[1-6]$/';
$regexPhone = '/^[+][3]{2}[1-9]([-. ]?)(([0-9]{2})\g1([0-9]{2}))(\g1([0-9]{2})){2}|[0][1-9]([-. ]?)(([0-9]{2})\g7([0-9]{2}))(\g7([0-9]{2})){2}$/';
$regexDate = '/^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/';
$regexService = '/^.+$/';


$users = new Users();
$usersSelect = $users->selectUsers();
$service = new Service();
$serviceSelect = $service->selectService();

if (isset($_GET['service'])) {
    $service->serviceName = $_GET['service'];
    $serviceCategories = $service->selectServiceList();
}

if (isset($_GET['delete'])) {
    $users->id = $_GET['delete'];
    $usersDelete = $users->deleteUsers();
    header('Location: index.php');
}
