<?php
$bdd = new PDO('mysql:host=localhost;dbname=hospitale2n;charset=utf8', 'root', '');
$patientsPerPage = 5;
$patientsReq = $bdd->query('SELECT COUNT(*) AS total FROM patients');
$patientsFetch = $patientsReq->fetchAll(PDO::FETCH_OBJ);
$patientsPage = $patientsFetch[0]->total / $patientsPerPage;
$numberPages = (int) ($patientsPage) + 1;
$total = $patientsFetch[0]->total;
$pageCourant = $_GET['page'];

if (isset($_GET['page'])) {
    $totalTest = ($total - (($_GET['page'] - 1) * $patientsPerPage));
    if ($totalTest > $patientsPerPage) {
        $patientsPerPage = $patientsPerPage;
    }
}

if (isset($_POST['recherche']) AND ! empty($_POST['recherche'])) {
    $recherche = htmlspecialchars($_POST['recherche']);
    $patients = $bdd->query("SELECT * FROM patients WHERE firstname LIKE  '%$recherche%' OR lastname LIKE '%$recherche%'");
    $reqFetch = $patients->fetchAll();
} elseif (isset($_GET['page'])) {
    $pageCourant = $_GET['page'];
    $depart = ($pageCourant - 1) * $patientsPerPage;
    $patients = $bdd->query("SELECT * FROM patients LIMIT $depart, $patientsPerPage");
    $reqFetch = $patients->fetchAll();
} else {
    header('Location: liste-patients.php?page=1');
}



// DELETE INFORMATIONS 

if (isset($_GET['deleteID'])) {
    $bdd = new PDO('mysql:host=localhost;dbname=hospitale2n;charset=utf8', 'root', '');
    $reqPat = $bdd->prepare('DELETE FROM patients WHERE id = :id');
    $reqPat->bindValue(':id', $_GET['deleteID']);
    $reqPat->execute();
    header('Location: liste-patients.php');
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
                <form method="POST" action="liste-patients.php?page=1" class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Recherche..." name="recherche" aria-label="Recherche...">
                    <button class="btn btn-warning my-2 my-sm-0" type="submit">Rechercher</button>
                </form>
            </ul>
        </div>
    </nav>



    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID Patient</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Fiche du patients</th>
                <th scope="col">Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_GET['page'])) {
                $i = ($_GET['page'] - 1) * $patientsPerPage + 1;

                foreach ($reqFetch as $value) {
                    ?>

                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $value['lastname'] ?></td>
                        <td><?= $value['firstname'] ?></td>
                        <td><a href="profil-patient.php?id=<?= $value['id'] ?>">click ici</a></td>
                        <td><a href="liste-patients.php?deleteID=<?= $value['id'] ?>"><i class="far fa-trash-alt"></i></a></td>
                    </tr>
                    <?php
                    $i++;
                }
            }
            ?>
        </tbody>
    </table>


    <?php if (isset($_GET['page'])) {
        ?>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="liste-patients.php?page=<?= (($pageCourant - 1) < 1 ? 1 : $pageCourant - 1) ?>">Previous</a></li>
    <?php for ($page = 1; $page <= $numberPages; $page++) { ?>

                    <li class="page-item"><a class="page-link" href="liste-patients.php?page=<?= $page ?>"><?= $page ?></a></li>
    <?php } ?>
                <li class="page-item"><a class="page-link" href="liste-patients.php?page=<?= (($pageCourant + 1) > $numberPages ? $numberPages : $pageCourant + 1) ?>">Next</a></li>
            </ul>
        </nav>

<?php } ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="main.js"></script>
</body>
</html>