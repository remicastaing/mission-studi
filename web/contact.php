
<?php
session_start();

require('../vendor/autoload.php');
require_once 'util/utilitaires.php';

checkAdmin();


require_once 'util/logger.php';
require_once 'modeles/connexion.php';
require_once 'util/form.php';


require_once 'modeles/DAOContact.php';
require_once 'modeles/DAONationalite.php';


$nom_objet = 'Contact';
$nom_objets = 'contacts';
$lien = 'contact.php';
$titre_create = "Ajouter un contact";
$lien_create = 'contact.php?action=create';
$lien_delete = 'contact.php?action=delete';



$daoContact = new DAOContact($DSN);

$colonnes = DAOContact::colonnes;


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
            $daoContact->upsert($data);
            $form->fill($data);
        }

        if ($id) {
            $contact = $daoContact->get($id);

            $form->fill($contact);
        }

        require_once 'vues/create-personne.php';
        break;

    case 'delete':
        $daoContact->delete($id);
        $objets = $daoContact->list();

        require_once('vues/liste.php');
        break;

    default:



        if ($id) {
            $objet = $daoContact->get($id);

            require_once('vues/detail-personne.php');
        } else {
            $objets = $daoContact->list();

            require_once('vues/liste.php');
        }
}
