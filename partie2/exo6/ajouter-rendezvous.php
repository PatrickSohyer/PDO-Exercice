<?php 
$bdd = new PDO('mysql:host=localhost;dbname=hospitale2n;charset=utf8', 'root', '');
$reqPatients = $bdd->query('SELECT * FROM patients');
$patientsFetch = $reqPatients->fetchAll();
if(count($_POST) > 0) {
$req = $bdd->prepare('INSERT INTO appointments(dateHour, idPatients) VALUES(:dateHour, :idPatients)');
$req->bindValue(':dateHour', $_POST['dateHour']);
$req->bindValue(':idPatients', $_POST['idPatients']);
$req->execute();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Formulaire Patient</title>
    </head>
    <body>

        <form action="rendezvous.php" method="post">

            <p><label for="dateHour">Heure : </label><input type="text" name="dateHour" id="dateHour" /></p>
            <p><select name="idPatients"> <?php foreach($patientsFetch as $patient) { ?><option value="<?= $patient['id']; ?>"><?= $patient['lastname'] . ' ' . $patient['firstname'] ?></option><?php } ?></select></p>
            <input type="submit" value="Envoyer" />
        </p>
    </form>

</body>
</html>