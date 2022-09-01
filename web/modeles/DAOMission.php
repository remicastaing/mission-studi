<?php

include_once 'DAOGeneric.php';

require_once 'DAOMissionAgent.php';
require_once 'DAOMissionCible.php';
require_once 'DAOMissionContact.php';
require_once 'DAOMissionPlanque.php';

class DAOMission extends DAOGeneric
{
    protected $table = 'mission';

    public const colonnes = [
        ['denom' => 'Mission', 'nom' => 'titre'],
        ['denom' => 'Description', 'nom' => 'description'],
        ['denom' => 'Pays', 'nom' => 'pays_clair'],
        ['denom' => 'Type', 'nom' => 'type'],
        ['denom' => 'Statut', 'nom' => 'statut'],
        ['denom' => 'Date de début', 'nom' => 'debut'],
        ['denom' => 'Date de fin', 'nom' => 'fin'],
    ];

    protected $cible;
    protected $agent;
    protected $contact;
    protected $planque;

    protected $base_request = "SELECT m.id, m.titre, m.description, m.pays, n.pays as pays_clair, mt.type, m.specialite, s.nom as specialite_clair, ms.statut, m.debut, m.fin FROM mission m, mission_type mt, nationalite n, mission_statut ms, specialite s  WHERE m.type = mt.id and m.pays = n.id and m.statut = ms.id AND m.specialite = s.id";

    protected $request_by_id = '';

    function __construct($dsn)
    {
        parent::__construct($dsn);

        $this->request_by_id = $this->base_request . ' and m.id = ?';

        $this->cible = new DAOMissionCible($dsn);
        $this->agent = new DAOMissionAgent($dsn);
        $this->contact = new DAOMissionContact($dsn);
        $this->planque = new DAOMissionPlanque($dsn);
    }

    public function getCibles($id)
    {
        return $this->executeRequest('select o.id, o.nom, o.prenom, o.code, o.naissance, o.nationalite, n.nationalite as nationalite_clair from cible o , mission_cible m, nationalite n where o.id = m.cible AND o.nationalite = n.id and m.mission = ?', [$id]);
    }

    public function getAgents($id)
    {
        return $this->executeRequest('select o.id, o.nom, o.prenom, o.code, o.naissance, o.nationalite, n.nationalite as nationalite_clair from agent o , mission_agent m, nationalite n where o.id = m.agent AND o.nationalite = n.id and m.mission = ?', [$id]);
    }

    public function getContacts($id)
    {
        return $this->executeRequest('select o.id, o.nom, o.prenom, o.code, o.naissance, o.nationalite, n.nationalite as nationalite_clair  from contact o , mission_contact m, nationalite n where o.id = m.contact AND o.nationalite = n.id and m.mission = ?', [$id]);
    }

    public function getPlanques($id)
    {
        return $this->executeRequest('select o.id, o.code, o.adresse, o.pays, n.pays as pays_clair, pt.type  
        from planque o , mission_planque m, nationalite n, planque_type pt 
        where o.id = m.planque AND o.pays = n.id and o.type = pt.id and m.mission = ?', [$id]);
    }
}
