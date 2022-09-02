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
                    <div class="flex-fill"><?= $titre_create ?></div>
                    <a href="<?= $lien ?>" class="h1 btn border-white">X</a>
                </div>

                <div class="card-body">


                    <?= $form ?>



                </div>


            </div>
        </div>
    </main>

    <!-- Begin Footer -->
    <?php include('./vues/common/footer.html'); ?>


    <?php include('./vues/common/bootstrap.html'); ?>
</body>

</html>