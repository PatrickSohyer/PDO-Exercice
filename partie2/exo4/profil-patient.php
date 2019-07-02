<?php

    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <title>Formulaire Patient</title>
        </head>
        <body>

            <?php foreach ($reqFetch as $value) { ?>

                <p><?= $value['lastname'] ?></p>
                <p><?= $value['firstname'] ?></p>
                <p><?= $value['birthdate'] ?></p>
                <p><?= $value['phone'] ?></p>
                <p><?= $value['mail'] ?></p>

            <?php }
            ?>


</body>
</html>