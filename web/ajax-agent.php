
<?php
session_start();

require('../vendor/autoload.php');
require_once 'util/utilitaires.php';
require_once 'util/logger.php';
require_once 'modeles/connexion.php';
require_once 'util/form.php';

require_once 'modeles/DAOAgent.php';
require_once 'modeles/DAOContact.php';
require_once 'modeles/DAOPlanque.php';



$daoAgent = new DAOAgent($DSN);

$cible = isset($_GET['cible']) ? $_GET['cible'] : false;

$specialite = isset($_GET['specialite']) ? $_GET['specialite'] : false;

if ($cible) {
    $choixAgent = $daoAgent->listAgentsAutresPays($cible, $specialite);

    $input = new SelectInput('agent', null, 'Agents', $choixAgent, 'code', true);

    header('Content-Type: text/plain');
    print $input;
}

?>