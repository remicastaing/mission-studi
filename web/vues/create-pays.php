<!doctype html>
<html lang="en">

<?php include('./vues/common/header.html'); ?>

<body class="d-flex flex-column h-100 text-white text-bg-dark">

    <!-- Begin Navbar -->
    <?php include('./vues/common/nav.php'); ?>


    <!-- Begin page content -->
    <main class=" flex-shrink-0">
        <div class="container">
            <div class="card w-100 text-bg-secondary ">
                <div class="card-header">
                    Creation d'un pays
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