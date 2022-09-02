
<?php
session_start();

require('../vendor/autoload.php');
require_once 'util/utilitaires.php';

checkAdmin();

require_once 'util/logger.php';
require_once 'modeles/connexion.php';
require_once 'util/form/form.php';

require_once 'modeles/DAOAgent.php';
require_once 'modeles/DAOContact.php';
require_once 'modeles/DAOPlanque.php';



$daoContact = new DAOContact($DSN);

if ($id) {
    $choixContact = $daoContact->listByPays($id);

    $input = new SelectInput('contact', null, 'Contacts', $choixContact, 'code', true);

    header('Content-Type: text/plain');
    print $input;
}

?>