<?php
$bdd = new PDO('mysql:host=localhost;dbname=hospitale2n;charset=utf8', 'root', '');
if(count($_POST) > 0) {
$mail = $_POST['mail'];
$phone = $_POST['phone'];
$searchPhone = $bdd->prepare('SELECT phone FROM patients WHERE phone = :phone');
$searchPhone->bindValue(':phone', $phone);
$searchPhone->execute();
$resultSearchPhone = $searchPhone->fetchAll();
$searchMail = $bdd->prepare('SELECT mail FROM patients WHERE mail = :mail');
$searchMail->bindValue(':mail', $mail);
$searchMail->execute();
$resultSearchMail = $searchMail->fetchAll();
$errorMessage = [];
if (count($resultSearchMail) === 0 AND count($resultSearchPhone) === 0) {
        $req = $bdd->prepare('INSERT INTO patients(lastname, firstname, birthdate, phone, mail) VALUES(:lastname, :firstname, :birthdate, :phone, :mail)');
        $req->bindValue('lastname', $_POST['lastname']);
        $req->bindValue('firstname', $_POST['firstname']);
        $req->bindValue('birthdate', $_POST['birthdate']);
        $req->bindValue('phone', $_POST['phone']);
        $req->bindValue('mail', $_POST['mail']);
        $req->execute();
    }
    if (count($resultSearchMail) > 0)  {
      $errorMessage['mail'] = 'Cette adresse mail existe déjà';  
    } if (count($resultSearchPhone) > 0) {
        $errorMessage['phone'] = 'Ce numéro existe déjà';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Accueil<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="liste-patients.php">Patients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="liste-rendezvous.php">Rendez-Vous</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ajouter
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="ajout-patient.php">Ajouter un patient</a>
                        <a class="dropdown-item" href="ajouter-rendezvous.php">Ajouter un rendez vous</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row mx-auto">
            <div class="col-2 mx-auto">
                <form class="mt-2" action="ajout-patient.php" method="post">

                    <p><label for="lastname">Nom : </label> <input type="text" name="lastname" id="lastname" /></p>
                    <p><label for="firstname">Prénom : </label> <input type="text" name="firstname" id="firstname" /></p>
                    <p><label for="birthdate">Date de Naissance : </label> <input type="text" name="birthdate" id="birthdate" /></p>
                    <p><?= (isset($errorMessage['mail'])) ? $errorMessage['mail'] : ' '; ?><label for="mail">Mail  : </label> <input type="email" name="mail" id="mail" /></p>
                    <p><?= (isset($errorMessage['phone'])) ? $errorMessage['phone'] : ' '; ?><label for="phone">Numéro de Téléphone  : </label> <input type="tel" name="phone" id="phone" /></p>
                    <input type="submit" value="Envoyer" />
                    </p>
                </form>
            </div> 
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="main.js"></script>
</body>
</html>