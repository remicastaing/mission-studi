
<?php
session_start();

require('../vendor/autoload.php');
require_once 'util/utilitaires.php';

checkAdmin();


require_once 'util/logger.php';
require_once 'modeles/connexion.php';
require_once 'util/form/form.php';


require_once 'modeles/DAOPlanque.php';
require_once 'modeles/DAONationalite.php';
require_once('modeles/DAOPlanqueType.php');


$nom_objet = 'Planque';
$nom_objets = 'planques';
$lien = 'planque.php';
$titre_create = 'Ajouter une planque';
$lien_create = 'planque.php?action=create';
$lien_delete = 'planque.php?action=delete';



$daoPlanque = new DAOPlanque($DSN);
$daoPlanqueType = new DAOPlanqueType($DSN);
$daoNationalite = new DAONationalite($DSN);


$colonnes = DAOPlanque::colonnes;


switch ($action) {
    case 'create':
        $choixPays = $daoNationalite->list();
        $choixType = $daoPlanqueType->list();

        $form = new Form([
            new Identifiant(),
            new TextInput('code', null, 'Code'),
            new TextInput('adresse', null, 'Adrresse'),
            new SelectInput('pays', null, 'Pays', $choixPays),
            new SelectInput('type', null, 'Type', $choixType),
        ], $lien);

        $data = $form->isset();

        if ($data) {
            $daoPlanque->upsert($data);
            $form->fill($data);
        }

        if ($id) {
            $planque = $daoPlanque->get($id);

            $form->fill($planque);
        }

        require_once 'vues/create-planque.php';
        break;

    case 'delete':
        $daoPlanque->delete($id);
        $objets = $daoPlanque->list();

        require_once('vues/liste.php');
        break;

    default:



        if ($id) {
            $objet = $daoPlanque->get($id);

            require_once('vues/detail-planque.php');
        } else {
            $objets = $daoPlanque->list();

            require_once('vues/liste.php');
        }
}
