<?php
if (isset($_GET['deleteID'])) {
    $bdd = new PDO('mysql:host=localhost;dbname=hospitale2n;charset=utf8', 'root', '');
    $req = $bdd->prepare('DELETE FROM appointments WHERE id = :id');
    $req->bindValue(':id', $_GET['deleteID']);
    $req->execute();
    header('Location: liste-rendezvous.php');
}
setlocale(LC_ALL, 'fr_FR.UTF8');
$bdd = new PDO('mysql:host=localhost;dbname=hospitale2n;charset=utf8', 'root', '');
$req = $bdd->query('SELECT appointments.dateHour, patients.lastname, patients.firstname, appointments.id AS appID FROM appointments INNER JOIN patients ON appointments.idPatients = patients.id');
$reqFetch = $req->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />

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

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Date du rendez vous</th>
                <th scope="col">Fiche du patients</th>
                <th scope="col">Supprimer rendez vous</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($reqFetch as $value) {
                ?>

                <tr>
                    <th scope="row"><?= $i ?></th>
                    <td><?= $value['lastname'] ?></td>
                    <td><?= $value['firstname'] ?></td>
                    <td><?= strftime('%d %B %Y à %Hh%M', strtotime($value['dateHour'])) ?></td>
                    <td><a href="rendezvous.php?id=<?= $value['appID'] ?>">click ici</a></td>
                    <td><a href="liste-rendezvous.php?deleteID=<?= $value['appID'] ?>"><i class="far fa-trash-alt"></i></a></td>
                </tr>
                <?php $i++;
            }
            ?>
        </tbody>
    </table>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="main.js"></script>
</body>
</html>