<!doctype html>
<html lang="en">

<?php include('./vues/common/header.html'); ?>
<link href="./stylesheets/login.css" rel="stylesheet">

<body class="text-center text-bg-dark bg-dark bg-gradient">


    <?php include('./vues/common/nav.php'); ?>


    <!-- Begin page content -->
    <main class="form-signin w-100 m-auto text-dark">
        <form method="POST" action="login.php">
            <img class="mb-4" src="./images/agent.svg" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Accès administrateur</h1>

            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Adresse mail</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Mot de passe</label>
            </div>


            <button class="w-100 btn btn-lg btn-primary" type="submit">Se connecter</button>

        </form>
    </main>

    <?php include('./vues/common/footer.html'); ?>


    <?php include('./vues/common/bootstrap.html'); ?>
</body>

</html>