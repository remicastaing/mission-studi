<!doctype html>
<html lang="en">

<?php include('./vues/common/header.html'); ?>

<body class="d-flex flex-column h-100 text-white text-bg-dark">


    <?php include('./vues/common/nav.php'); ?>


    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Listes des <?= $nom_objets ?></h1>


            <table class="table table-striped table-hover table-dark w-100">
                <thead>
                    <tr>
                        <?php foreach ($colonnes as $colonne) : ?>
                            <th scope="col"><?= $colonne['denom'] ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objets as $objet) : ?>
                        <tr class="clickable" onclick="window.location='<?= $lien ?>?id=<?= $objet->id ?>'">
                            <?php foreach ($colonnes as $idx => $colonne) :
                                $attr = $colonne['nom'];
                                if ($idx == 0) {
                                    echo ("<th scope='row'>" . $objet->$attr . "</th>");
                                } else {
                                    echo ("<td>" . $objet->$attr . "</th>");
                                }
                            ?>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="<?= $lien_create ?>" class="btn btn-lg btn-dark fw-bold border-white "><?= $titre_create ?></a>
            </div>

        </div>
    </main>

    <?php include('./vues/common/footer.html'); ?>


    <?php include('./vues/common/bootstrap.html'); ?>
</body>

</html>