
<?php
session_start();

require('../vendor/autoload.php');
require_once 'util/utilitaires.php';
require_once 'util/logger.php';
require_once 'util/table.php';
require_once 'modeles/connexion.php';
require_once 'util/form/form.php';


require_once 'modeles/DAOMission.php';
require_once 'modeles/DAOSpecialite.php';
require_once 'modeles/DAONationalite.php';
require_once 'modeles/DAOAgent.php';
require_once 'modeles/DAOCible.php';
require_once 'modeles/DAOContact.php';
require_once 'modeles/DAOPlanque.php';
require_once 'modeles/DAOMissionStatut.php';
require_once 'modeles/DAOMissionType.php';



$nom_objets = 'missions';
$lien = 'mission.php';
$titre_create = 'Ajouter une mission';
$lien_create = 'mission.php?action=create';
$lien_delete = 'mission.php?action=delete';


$daoMission = new DAOMission($DSN);
$daoMissionType = new DAOMissionType($DSN);
$daoMissionStatut = new DAOMissionStatut($DSN);
$daoCible = new DAOCible($DSN);
$daoAgent = new DAOAgent($DSN);
$daoContact = new DAOContact($DSN);
$daoPlanque = new DAOPlanque($DSN);

$colonnes = DAOMission::colonnes;

$colonnesCible = DAOCible::colonnes;
$colonnesAgent = DAOAgent::colonnes;
$colonnesContact = DAOContact::colonnes;
$colonnesPlanque = DAOPlanque::colonnes;

$lien_cible = 'cible.php?action=read';
$lien_agent = 'agent.php?action=read';
$lien_contact = 'contact.php?action=read';
$lien_planque = 'planque.php?action=read';

$daoSpecialite = new DAOSpecialite($DSN);

$daoNationalite = new DAONationalite($DSN);

switch ($action) {
    case 'create':
        $choixPays = $daoNationalite->list();
        $choixStatut = $daoMissionStatut->list();
        $choixType = $daoMissionType->list();
        $choixSpecialite = $daoSpecialite->list();

        $choixCible = $daoCible->list();




        $choixAgent = $daoAgent->list();
        $choixContact = $daoContact->list();
        $choixPlanque = $daoPlanque->list();

        $form = new Form([
            new Identifiant(),
            new TextInput('titre', null, 'Mission'),
            new TextInput('description', null, 'Description'),
            new SelectInput('pays', null, 'Pays', $choixPays),
            new SelectInput('type', null, 'Type', $choixType),
            new SelectInput('specialite', null, 'Spécialités nécessaire', $choixSpecialite, 'nom'),
            new DateInput('debut', null, 'Début de la mission'),
            new DateInput('fin', null, 'Fin de la mission'),
            new SelectInput('statut', null, 'Statut', $choixStatut),
            new SelectInput('cible', null, 'Cibles', $choixCible, 'code', true),
            new SelectInput('agent', null, 'Agents', $choixAgent, 'code', true),
            new SelectInput('contact', null, 'Contacts', $choixContact, 'code', true),
            new SelectInput('planque', null, 'Planques', $choixPlanque, 'code', true),
        ], $lien);





        $data = $form->isset();

        if ($data) {

            // Tentative avec formulaire mission complet

            $daoMission->upsert($data);

            $choixAgent = $daoAgent->listAgentsAutresPays($data->cible, $data->specialite);
            $choixContact = $daoContact->listByPays($data->pays);
            $choixPlanque = $daoPlanque->listByPays($data->pays);

            $form = new Form([
                new Identifiant(),
                new TextInput('titre', null, 'Mission'),
                new TextInput('description', null, 'Description'),
                new SelectInput('pays', null, 'Pays', $choixPays),
                new SelectInput('type', null, 'Type', $choixType),
                new SelectInput('specialite', null, 'Spécialités nécessaire', $choixSpecialite, 'nom'),
                new DateInput('debut', null, 'Début de la mission'),
                new DateInput('fin', null, 'Fin de la mission'),
                new SelectInput('statut', null, 'Statut', $choixStatut),
                new SelectInput('cible', null, 'Cibles', $choixCible, 'code', true),
                new SelectInput('agent', null, 'Agents', $choixAgent, 'code', true),
                new SelectInput('contact', null, 'Contacts', $choixContact, 'code', true),
                new SelectInput('planque', null, 'Planques', $choixPlanque, 'code', true),
            ], $lien);

            $form->fill($data);
        } else {
            // Tentative avec formulaire mission restreint

            $form = new Form([
                new Identifiant(),
                new TextInput('titre', null, 'Mission'),
                new TextInput('description', null, 'Description'),
                new SelectInput('pays', null, 'Pays', $choixPays),
                new SelectInput('type', null, 'Type', $choixType),
                new SelectInput('specialite', null, 'Spécialités nécessaire', $choixSpecialite, 'nom'),
                new DateInput('debut', null, 'Début de la mission'),
                new DateInput('fin', null, 'Fin de la mission'),
                new SelectInput('statut', null, 'Statut', $choixStatut),
                new SelectInput('cible', null, 'Cibles', $choixCible, 'code', true),
            ], $lien);



            $data = $form->isset();

            if ($data) {
                $daoMission->upsert($data);

                $choixAgent = $daoAgent->listAgentsAutresPays($data->cible, $data->specialite);
                $choixContact = $daoContact->listByPays($data->pays);
                $choixPlanque = $daoPlanque->listByPays($data->pays);

                $form = new Form([
                    new Identifiant(),
                    new TextInput('titre', null, 'Mission'),
                    new TextInput('description', null, 'Description'),
                    new SelectInput('pays', null, 'Pays', $choixPays),
                    new SelectInput('type', null, 'Type', $choixType),
                    new SelectInput('specialite', null, 'Spécialités nécessaire', $choixSpecialite, 'nom'),
                    new DateInput('debut', null, 'Début de la mission'),
                    new DateInput('fin', null, 'Fin de la mission'),
                    new SelectInput('statut', null, 'Statut', $choixStatut),
                    new SelectInput('cible', null, 'Cibles', $choixCible, 'code', true),
                    new SelectInput('agent', null, 'Agents', $choixAgent, 'code', true),
                    new SelectInput('contact', null, 'Contacts', $choixContact, 'code', true),
                    new SelectInput('planque', null, 'Planques', $choixPlanque, 'code', true),
                ], $lien);

                $form->fill($data);
            }
        }




        if ($id) {
            $mission = $daoMission->get($id);

            $mission->cible = [];
            foreach ($daoMission->getCibles($id) as $value) {
                $mission->cible[] = $value->id;
            }

            $mission->agent = [];
            foreach ($daoMission->getAgents($id) as $value) {
                $mission->agent[] = $value->id;
            }

            $mission->contact = [];
            foreach ($daoMission->getContacts($id) as $value) {
                $mission->contact[] = $value->id;
            }

            $mission->planque = [];
            foreach ($daoMission->getPlanques($id) as $value) {
                $mission->planque[] = $value->id;
            }

            $choixAgent = $daoAgent->listAgentsAutresPays($mission->cible, $mission->specialite);
            $choixContact = $daoContact->listByPays($mission->pays);
            $choixPlanque = $daoPlanque->listByPays($mission->pays);

            $form = new Form([
                new Identifiant(),
                new TextInput('titre', null, 'Mission'),
                new TextInput('description', null, 'Description'),
                new SelectInput('pays', null, 'Pays', $choixPays),
                new SelectInput('type', null, 'Type', $choixType),
                new SelectInput('specialite', null, 'Spécialités nécessaire', $choixSpecialite, 'nom'),
                new DateInput('debut', null, 'Début de la mission'),
                new DateInput('fin', null, 'Fin de la mission'),
                new SelectInput('statut', null, 'Statut', $choixStatut),
                new SelectInput('cible', null, 'Cibles', $choixCible, 'code', true),
                new SelectInput('agent', null, 'Agents', $choixAgent, 'code', true),
                new SelectInput('contact', null, 'Contacts', $choixContact, 'code', true),
                new SelectInput('planque', null, 'Planques', $choixPlanque, 'code', true),
            ], $lien);

            $form->fill($mission);
        }

        require_once 'vues/create-mission.php';
        break;

    case 'delete':
        $daoMission->delete($id);
        $objets = $daoMission->list();

        require_once('vues/liste.php');
        break;

    default:



        if ($id) {
            $mission = $daoMission->get($id);
            $mission->agent = $daoMission->getAgents($id);
            $mission->cible = $daoMission->getCibles($id);
            $mission->contact = $daoMission->getContacts($id);
            $mission->planque = $daoMission->getPlanques($id);


            $tableCibles = new Table($mission->cible, $colonnesCible, $lien_cible, 'table-danger');

            $tableAgents = new Table($mission->agent, $colonnesAgent, $lien_agent);

            $tableContacts = new Table($mission->contact, $colonnesContact, $lien_contact);

            $tablePlanques= new Table($mission->planque, $colonnesPlanque, $lien_planque);

            require_once('vues/detail-mission.php');
        } else {
            $objets = $daoMission->list();

            require_once('vues/liste.php');
        }
}
