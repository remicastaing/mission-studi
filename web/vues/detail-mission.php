<!doctype html>
<html lang="en">

<?php include('./vues/common/header.html'); ?>

<body class="d-flex flex-column h-100  text-bg-dark bg-dark bg-gradient">

    <!-- Begin Navbar -->
    <?php include('./vues/common/nav.php'); ?>


    <!-- Begin page content -->
    <main class=" flex-shrink-0">
        <div class="container">
            <div class="card w-100 text-bg-secondary ">
                <div class="h1 card-header d-grid gap-2 d-md-flex justify-content-md-end">
                    <div class="flex-fill">Mission</div>
                    <a href="<?= $lien ?>" class="h1 btn border-white">X</a>
                </div>
                <div class="card-body">


                    <form>
                        <?php foreach ($colonnes as $colonne) :
                            $attr = $colonne['nom']; ?>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label"><?= $colonne['denom'] ?></label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail3" value="<?= $mission->$attr ?>">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </form>

                    </hr>
                    <h5>Cibles:</h5>
                    <?= $tableCibles ?>
                    <hr>
                    <h5>Agents:</h5>
                    <?= $tableAgents ?>
                    </hr>
                    <h5>Contacts</h5>
                    <?= $tableContacts ?>
                    <hr>
                    <h5>Planques:</h5>
                    <?= $tablePlanques ?>
                </div>
                <div class="card-footer">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="<?= $lien_delete . "&id=" . $id ?>" class="btn btn-lg btn-danger fw-bold border-white ">Supprimer la mission</a>
                        <a href="<?= $lien_create . "&id=" . $id ?>" class="btn btn-lg btn-dark fw-bold border-white ">Modifier la mission</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Begin Footer -->
    <?php include('./vues/common/footer.html'); ?>


    <?php include('./vues/common/bootstrap.html'); ?>
</body>

</html>