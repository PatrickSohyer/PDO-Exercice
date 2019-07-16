<?php
require 'controller/controllerIndex.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/main.css" />

    <title>Chez Michou!</title>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Chez Michou</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view/addUsersForm.php">Ajouter un utilisateur</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Service
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="index.php?service=Maintenance">Maintenance</a>
                        <a class="dropdown-item" href="index.php?service=Web Developer">Web Developer</a>
                        <a class="dropdown-item" href="index.php?service=Web Designer">Web Designer</a>
                        <a class="dropdown-item" href="index.php?service=Reférenceur">Reférenceur</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <?php if (isset($serviceCategories)) {
                foreach ($serviceCategories as $value) { ?>
                    <div class="col-4">
                        <div class="card text-center">
                            <div class="card-header">
                                <p class="h2"><b><?= $value['usersLN'] . ' ' . $value['usersFN'] ?></b></p>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><b>Adresse : </b> <?= $value['usersPC'] . ', ' . $value['usersAD']  ?></p>
                                <p class="card-text"><b>Age : </b> <?= $value['usersBD'] ?></p>
                                <p class="card-text"><b>Numéro de téléphone : </b> <?= $value['usersPN'] ?></p>
                                <p class="card-text"><b>Service : </b> <?= $value['serviceN'] ?></p>
                                <a href="index.php?delete=<?= $value['usersID'] ?>" class="btn btn-primary">supprimer le compte</a>
                            </div>
                        </div>
                    </div>
                <?php }
            } else {
                foreach ($usersSelect as $value) { ?>
                    <div class="col-4">
                        <div class="card text-center">
                            <div class="card-header">
                                <p class="h2"><b><?= $value['lastName'] . ' ' . $value['firstName'] ?></b></p>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><b>Adresse : </b> <?= $value['postalCode'] . ', ' . $value['address']  ?></p>
                                <p class="card-text"><b>Age : </b> <?= $value['birthDate'] ?></p>
                                <p class="card-text"><b>Numéro de téléphone : </b> <?= $value['phoneNumber'] ?></p>
                                <p class="card-text"><b>Service : </b> <?= $value['serviceName'] ?></p>
                                <a href="index.php?delete=<?= $value['idUsers'] ?>" class="btn btn-primary">supprimer le compte</a>
                            </div>
                        </div>
                    </div>
                <?php }
            }
            ?>
        </div>
    </div>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>