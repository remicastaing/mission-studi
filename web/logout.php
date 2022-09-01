
<?php

require('../vendor/autoload.php');

session_start();
$log = new Monolog\Logger('Studi');
$log->pushHandler(new Monolog\Handler\StreamHandler('php.log', Monolog\Logger::WARNING));


unset($_SESSION["admin"]);

include('vues/login.php');


