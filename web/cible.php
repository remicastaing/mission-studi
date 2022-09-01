
<?php
session_start();

require('../vendor/autoload.php');
require_once 'util/utilitaires.php';

checkAdmin();

require_once 'util/logger.php';
require_once 'modeles/connexion.php';
require_once 'util/form.php';


require_once 'modeles/DAOCible.php';
require_once 'modeles/DAONationalite.php';


$nom_objet = 'Cible';
$nom_objets = 'cibles';
$lien = 'cible.php';
$titre_create = "Ajouter une cible";
$lien_create = 'cible.php?action=create';
$lien_delete = 'cible.php?action=delete';



$daoCible = new DAOCible($DSN);

$colonnes = DAOCible::colonnes;


$daoNationalite = new DAONationalite($DSN);

switch ($action) {
    case 'create':
        $choixNationalite = $daoNationalite->list();

        $form = new Form([
            new Identifiant(),
            new TextInput('nom', null, 'Nom'),
            new TextInput('prenom', null, 'Prenom'),
            new TextInput('code', null, 'Code'),
            new DateInput('naissance', null, 'Date de naissance'),
            new SelectInput('nationalite', null, 'Nationalité', $choixNationalite),
        ], $lien);

        $data = $form->isset();

        if ($data) {
            $daoCible->upsert($data);
            $form->fill($data);
        }

        if ($id) {
            $cible = $daoCible->get($id);

            $form->fill($cible);
        }

        require_once 'vues/create-personne.php';
        break;

    case 'delete':
        $daoCible->delete($id);
        $objets = $daoCible->list();

        require_once('vues/liste.php');
        break;

    default:



        if ($id) {
            $objet = $daoCible->get($id);

            require_once('vues/detail-personne.php');
        } else {
            $objets = $daoCible->list();

            require_once('vues/liste.php');
        }
}
