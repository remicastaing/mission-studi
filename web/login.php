
<?php

require('../vendor/autoload.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$log = new Monolog\Logger('Studi');
$log->pushHandler(new Monolog\Handler\StreamHandler('php.log', Monolog\Logger::WARNING));


include('modeles/connexion.php');

require_once('modeles/DAOAdmin.php');

$daoAdmin = new DAOAdmin($DSN);

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email =  htmlspecialchars($_POST["email"]);
    $password =  htmlspecialchars($_POST["password"]);
    $log->warn($email);

    $admin = $daoAdmin->getByEmailPassword($email, $password);
    $log->warn($admin ? 'Connecté' : 'Non connecté');

    if ($admin) {
        $_SESSION['admin']=$admin;
        include('vues/welcome.php');
    } else {
        include('vues/login.php');
    }
    
} else {
    

   
    include('vues/login.php');
}

