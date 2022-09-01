
<?php
session_start();

require('../vendor/autoload.php');
require_once 'util/utilitaires.php';
require_once 'util/logger.php';

checkAdmin();



require_once 'modeles/connexion.php';
require_once 'util/form.php';


require_once 'modeles/DAOAgent.php';
require_once 'modeles/DAOSpecialite.php';
require_once 'modeles/DAONationalite.php';



$nom_objets = 'agents';
$lien = 'agent.php';
$titre_create = 'Ajouter un agent';
$lien_create = 'agent.php?action=create';
$lien_delete = 'agent.php?action=delete';



$daoAgent = new DAOAgent($DSN);

$colonnes = DAOAgent::colonnes;

$daoSpecialite = new DAOSpecialite($DSN);

$daoNationalite = new DAONationalite($DSN);


switch ($action) {
    case 'create':
        $choixNationalite = $daoNationalite->list();

        $choixSpecialite = $daoSpecialite->list();

        $form = new Form([
            new Identifiant(),
            new TextInput('nom', null, 'Nom'),
            new TextInput('prenom', null, 'Prenom'),
            new TextInput('code', null, 'Code'),
            new DateInput('naissance', null, 'Date de naissance'),
            new SelectInput('nationalite', null, 'Nationalité',  $choixNationalite),
            new SelectInput('specialite', null, 'Spécialités', $choixSpecialite, 'nom', true),
        ], $lien);

        $data = $form->isset();

        if ($data) {
            $daoAgent->upsert($data);
            $form->fill($data);
        }

        if ($id) {
            $agent = $daoAgent->get($id);

            $specialite = [];
            foreach ($daoAgent->getSpecialites($id) as $value) {
                $specialite[] = $value->id;
            }
            $agent->specialite = $specialite;

            $form->fill($agent);
        }

        require_once 'vues/create-agent.php';
        break;

    case 'delete':
        $daoAgent->delete($id);
        $objets = $daoAgent->list();

        require_once('vues/liste.php');
        break;

    default:



        if ($id) {
            $agent = $daoAgent->get($id);
            $agent->specialite = $daoAgent->getSpecialites($id);

            require_once('vues/detail-agent.php');
        } else {
            $objets = $daoAgent->list();

            require_once('vues/liste.php');
        }
}
