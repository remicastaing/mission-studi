<?php

include_once 'DAOGeneric.php';

class DAOPersonne extends DAOGeneric
{
    protected $table = '';

    public const colonnes = [
        ['denom'=> 'Code', 'nom' => 'code'],
        ['denom'=> 'Nom', 'nom' => 'nom'],
        ['denom'=> 'Prénom', 'nom' => 'prenom'],
        ['denom'=> 'Date de naissance', 'nom' => 'naissance'],
        ['denom'=> 'Nationalité', 'nom' => 'nationalite_clair'],
      ];

    protected $base_request = "";
    protected $request_by_id = null;

    function __construct($dsn) {
        parent::__construct($dsn);

        $this->base_request = "SELECT t.id, t.nom, t.prenom, t.naissance, t.nationalite, n.nationalite as nationalite_clair  , t.code  FROM $this->table t , nationalite n WHERE t.nationalite = n.id";
        $this->request_by_id = $this->base_request." AND t.id = ?";
    }

    public function listByMissionId($id)
    {
        $request = "SELECT t.id, t.nom, t.prenom, t.naissance, n.nationalite , t.code  FROM $this->table t , nationalite n, mission_$this->table mt WHERE t.nationalite = n.id and mt.mission = ?";

        return $this->executeRequest($request, [$id]);
    }

    public function listByPaysId($id)
    {
        return $this->executeRequest($this->base_request.' AND a.nationalite = ?', [$id]);
    }


}