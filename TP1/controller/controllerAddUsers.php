<?php

require '../model/database.php';
require '../model/users.php';
require '../model/service.php';

$regexName = '/^[a-zA-ZéèÉÈôîêûÛÊÔÎùÙïöëüËÏÖÜç\']{2,17}[- \']?[a-zA-ZéèÉÈôîêûÛÊÔÎùÙïöëüËÏÖÜç]{0,17}$/';
$regexAddress = '/^([1-9]|[1-9][0-9]|[1-9][0-9]{2}|1[0-9]{3})[A|a|B|b]?[ ]?(bis)?[- ](avenue|Avenue|AVENUE|rue|Rue|RUE|Boulevard|BOULEVARD|boulevard|Impasse|IMPASSE|impasse|Allée|ALLEE|allée|hameau|Hameau|HAMEAU|Chemin|chemin|CHEMIN|lieu-dit|Lieu-dit|LIEU-DIT|lieu-Dit|Lieu-Dit)[- ][A-Za-zéèàâêŷûîôäëïöüÿùç]+([- ]?[A-Za-zéèàâêŷûîôäëïöüÿùç]{0,17}){0,3}$/';
$regexPostal = '/^((0[1-9]|[1-8][0-9]|9[0-5])[0-9]{3})|97[1-6]$/';
$regexPhone = '/^[+][3]{2}[1-9]([-. ]?)(([0-9]{2})\g1([0-9]{2}))(\g1([0-9]{2})){2}|[0][1-9]([-. ]?)(([0-9]{2})\g7([0-9]{2}))(\g7([0-9]{2})){2}$/';
$regexDate = '/^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/';
$regexService = '/^.+$/';


$users = new Users();
$service = new Service();
$serviceSelect = $service->selectService();


$errorMessage = array();

if (COUNT($_POST) > 0) {
    if (!empty($_POST['lastName'])) {
        if (preg_match($regexName, $_POST['lastName'])) {
            $lastName = strip_tags(htmlspecialchars($_POST['lastName']));
            $users->lastName = $lastName;
        } else {
            $errorMessage['lastName'] = 'Votre nom de famille est nul.';
        }
    } else {
        $errorMessage['lastName'] = 'Pourquoi vous n\'avez pas de nom de famille?';
    }
    if (!empty($_POST['firstName'])) {
        if (preg_match($regexName, $_POST['firstName'])) {
            $firstName = strip_tags(htmlspecialchars($_POST['firstName']));
            $users->firstName = $firstName;
        } else {
            $errorMessage['firstName'] = 'Ton prénom est vraiment moche, je ne l\'accepte pas.';
        }
    } else {
        $errorMessage['firstName'] = 'Il est votre prénom?';
    }
    if (!empty($_POST['address'])) {
        if (preg_match($regexAddress, $_POST['address'])) {
            $address = strip_tags(htmlspecialchars($_POST['address']));
            $users->address = $address;
        } else {
            $errorMessage['address'] = 'Cette adresse n\'est pas sur terre!';
        }
    } else {
        $errorMessage['address'] = 'Merci de rentrer une adresse.';
    }
    if (!empty($_POST['postalCode'])) {
        if (preg_match($regexPostal, $_POST['postalCode'])) {
            $postalCode = strip_tags(htmlspecialchars($_POST['postalCode']));
            $users->postalCode = $postalCode;
        } else {
            $errorMessage['postalCode'] = 'Mauvais code postal';
        }
    } else {
        $errorMessage['postalCode'] = 'Merci de rajouter un code postal';
    }
    if (!empty($_POST['phoneNumber'])) {
        if (preg_match($regexPhone, $_POST['phoneNumber'])) {
            $phoneNumber = strip_tags(htmlspecialchars($_POST['phoneNumber']));
            $users->phoneNumber = $phoneNumber;
        } else {
            $errorMessage['phoneNumber'] = 'Je ne connais pas ce numéro.';
        }
    } else {
        $errorMessage['phoneNumber'] = 'Merci de renseigner un numéro.';
    }
    if (!empty($_POST['birthDate'])) {
        if (preg_match($regexDate, $_POST['birthDate'])) {
            $birthDate = strip_tags(htmlspecialchars($_POST['birthDate']));
            $users->birthDate = $birthDate;
        } else {
            $errorMessage['birthDate'] = 'Je ne connais pas ce numéro.';
        }
    } else {
        $errorMessage['birthDate'] = 'Merci de renseigner un numéro.';
    }
    if (!empty($_POST['service'])) {
        if (preg_match($regexService, $_POST['service'])) {
            $service = strip_tags(htmlspecialchars($_POST['service']));
            $users->id_service = $service;
        } else {
            $errorMessage['service'] = 'Ce métier ne fais pas partie de chez nous.';
        }
    } else {
        $errorMessage['service'] = 'Merci de renseigner un metier.';
    }
    if (count($errorMessage) === 0) {
        if ($users->addUsers() == TRUE) {
            $success = TRUE;
            header('Location: ../index.php');
        }
    }
}
