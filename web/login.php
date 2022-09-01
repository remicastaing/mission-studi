
<?php

require('../vendor/autoload.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


include('modeles/connexion.php');

require_once('modeles/DAOAdmin.php');

$daoAdmin = new DAOAdmin($DSN);

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email =  htmlspecialchars($_POST["email"]);
    $password =  htmlspecialchars($_POST["password"]);

    $admin = $daoAdmin->getByEmailPassword($email, $password);

    if ($admin) {
        $_SESSION['admin'] = $admin;
        include('vues/welcome.php');
    } else {
        include('vues/login.php');
    }
} else {



    include('vues/login.php');
}
