<?php
require '../controller/controllerAddUsers.php';
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
                    <a class="nav-link" href="../index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Ajouter un utilisateur</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Service
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="../index.php?service=Maintenance">Maintenance</a>
                        <a class="dropdown-item" href="../index.php?service=Web Developer">Web Developer</a>
                        <a class="dropdown-item" href="../index.php?service=Web Design">Web Designer</a>
                        <a class="dropdown-item" href="../index.php?service=Reférenceur">Reférenceur</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>


    <div class="container-fluid">
        <div class="row mx-auto">
            <div class="col-8 mx-auto">
                <form method="POST" action="addUsersForm.php">
                    <div class="form-row mt-5 text-center">
                        <div class="form-group col-md-6">
                            <label for="lastName"><b>Nom</b></label>
                            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Nom" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="firstname"><b>Prénom</b></label>
                            <input type="text" class="form-control" id="firstname" name="firstName" placeholder="Prénom" required />
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label for="address"><b>Adresse</b></label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Adresse" required />
                    </div>
                    <div class="form-row text-center">
                        <div class="form-group col-md-3">
                            <label for="postalCode"><b>Code Postal</b></label>
                            <input type="text" class="form-control" id="postalCode" name="postalCode" placeholder="exemple : 76620" required />
                        </div>
                        <div class="form-group col-md-3">
                            <label for="phoneNumber"><b>Numéro de Téléphone</b></label>
                            <input type="text" class="form-control" name="phoneNumber" id="phoneNumber" placeholder="exemple : 0724756857" required />
                        </div>
                        <div class="form-group col-md-3">
                            <label for="birthdate"><b>Date de naissance</b></label>
                            <input type="date" class="form-control" id="birthdate" name="birthDate" placeholder="Date de naissance" required />
                        </div>
                        <div class="form-group col-md-3">
                            <label for="service" class="d-block"><b>Service</b></label>
                            <select name="service" id="service">
                                <?php foreach ($serviceSelect as $value) { ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['serviceName'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-block btn-primary">Ajouter Utilisateur</button>
                </form>
            </div>
        </div>
    </div>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>