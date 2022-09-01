
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



$daoPlanque = new DAOPlanque($DSN);

if ($id) {
    $choixPlanque = $daoPlanque->listByPays($id);

    $input = new SelectInput('planque', null, 'Planques', $choixPlanque, 'code', true);

    header('Content-Type: text/plain');
    print $input;
}

?>