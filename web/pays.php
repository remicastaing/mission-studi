
<?php
session_start();

require('../vendor/autoload.php');
require_once 'util/utilitaires.php';
require_once 'util/logger.php';
require_once 'modeles/connexion.php';
require_once 'util/form/form.php';


require_once 'modeles/DAONationalite.php';



$nom_objet = 'Pays';
$nom_objets = 'pays';
$lien = 'pays.php';
$titre_create = 'Ajouter une pays';
$lien_create = 'pays.php?action=create';
$lien_delete = 'pays.php?action=delete';





$daoNationalite = new DAONationalite($DSN);


$colonnes = DAONationalite::colonnes;


switch ($action) {
    case 'create':


        $form = new Form([
            new Identifiant(),
            new TextInput('nationalite', 'Test', 'Nationalité'),
            new TextInput('pays', null, 'Pays'),
        ]);

        $data = $form->isset();

        if ($data) {
            $daoNationalite->upsert($data);
            $form->fill($data);
        }

        if ($id) {
            $pays = $daoNationalite->get($id);

            $form->fill($pays);
        }

        require_once 'vues/create-pays.php';
        break;

    case 'delete':
        $daoNationalite->delete($id);
        $objets = $daoNationalite->list();

        require_once('vues/liste.php');
        break;

    default:



        if ($id) {
            $objet = $daoNationalite->get($id);

            require_once('vues/detail-pays.php');
        } else {
            $objets = $daoNationalite->list();

            require_once('vues/liste.php');
        }
}
