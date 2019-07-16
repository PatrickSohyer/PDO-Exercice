<?php
setlocale(LC_ALL, 'fr_FR.UTF8');
if (isset($_GET['id'])) {
    $bdd = new PDO('mysql:host=localhost;dbname=hospitale2n;charset=utf8', 'root', '');
    $id = $_GET['id'];
    $req = $bdd->prepare('SELECT * FROM patients LEFT JOIN appointments ON patients.id = appointments.idPatients WHERE patients.id = :id');
    $req->bindValue(':id', $id);
    $req->execute();
    $reqFetch = $req->fetchAll();
    if (count($_POST) > 0) {
        $reqmodify = $bdd->prepare('UPDATE patients SET lastname = :newlastname, firstname = :newfirstname, birthdate = :newbirthdate, mail = :newmail, phone = :newphone WHERE id = :id');
        $reqmodify->bindValue(':newlastname', $_POST['newlastname']);
        $reqmodify->bindValue(':id', $id);
        $reqmodify->bindValue(':newfirstname', $_POST['newfirstname']);
        $reqmodify->bindValue(':newmail', $_POST['newmail']);
        $reqmodify->bindValue(':newphone', $_POST['newphone']);
        $reqmodify->bindValue(':newbirthdate', $_POST['newbirthdate']);
        if ($reqmodify->execute()) {
            header('Location: liste-patients.php');
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

        <?php foreach ($reqFetch as $value) { ?>

            <div class="container-fluid">
                <div class="row mx-auto mt-4">
                    <div class="col-12 mx-auto">
                        <div class="card mx-auto" style="width: 18rem;">
                            <div class="card-header">
                                Informations
                            </div>
                            <ul class="list-group list-group-flush">
                                <form method="POST" action="profil-patient.php?id=<?= $id ?>">
                                    <li class="list-group-item infoPatients">Nom : <?= $value['lastname'] ?></li>
                                    <label class="modifyInfoPatients list-group-item" for="newlastname">Nom : </label><input class="modifyInfoPatients" type="text" name="newlastname" value="<?= $value['lastname'] ?>" id="newlastname" />
                                    <li class="list-group-item infoPatients">Prénom : <?= $value['firstname'] ?></li>
                                    <label class="modifyInfoPatients list-group-item" for="newfirstname">Prénom : </label><input class="modifyInfoPatients" type="text" name="newfirstname" value="<?= $value['firstname'] ?>" id="newfirstname" />
                                    <li class="list-group-item infoPatients">Date de naissance : <?= $value['birthdate'] ?></li>
                                    <label class="modifyInfoPatients list-group-item" for="newbirthdate">Date de naissance : </label><input class="modifyInfoPatients" type="text" name="newbirthdate" value="<?= $value['birthdate'] ?>" id="newbirthdate" />
                                    <li class="list-group-item infoPatients">Adresse Mail : <?= $value['mail'] ?></li>
                                    <label class="modifyInfoPatients list-group-item" for="newmail">Adresse Mail</label><input class="modifyInfoPatients" type="email" name="newmail" value="<?= $value['mail'] ?>" id="newmail" />
                                    <li class="list-group-item infoPatients">Numéro de Téléphone : <?= $value['phone'] ?></li>
                                    <label class="modifyInfoPatients list-group-item" for="newphone">Numéro de Téléphone</label><input class="modifyInfoPatients" type="tel" name="newphone" value="<?= $value['phone'] ?>" id="newphone" />
                                    <?php if ($value['dateHour'] == TRUE) { ?>
                                        <li class="list-group-item infoPatients">Rendez vous : <?= strftime('%d %B %Y à %Hh%M', strtotime($value['dateHour'])) ?></li>
                                    <?php
                                    } else {
                                        echo ' ';
                                    }
                                    ?>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success buttonSendModify">Envoyer Modifications</button>
                                    </div>
                                </form>
                            </ul>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-danger mt-2 buttonModify">Modifier</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
    }
    ?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="main.js"></script>
</body>
</html>