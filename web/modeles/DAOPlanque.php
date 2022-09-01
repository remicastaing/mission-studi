<?php

include_once 'DAOGeneric.php';

class DAOPlanque extends DAOGeneric
{

  protected $table = 'planque';

  public const colonnes = [
    ['denom' => 'Code', 'nom' => 'code'],
    ['denom' => 'Adresse', 'nom' => 'adresse'],
    ['denom' => 'Pays', 'nom' => 'pays_clair'],
    ['denom' => 'Type', 'nom' => 'type'],
  ];

  protected $base_request = "SELECT p.id, p.code, pt.type, p.adresse , p.pays, n.pays as pays_clair FROM planque p , nationalite n, planque_type pt WHERE p.pays = n.id AND p.type = pt.id";

  protected $request_by_id = "SELECT p.id, p.code, pt.type, p.adresse ,  p.pays, n.pays as pays_clair   FROM planque p , nationalite n, planque_type pt WHERE p.pays = n.id AND p.type = pt.id AND p.id = ?";


  public function listByPays($id)
  {
      return $this->executeRequest($this->base_request.' AND n.id = ?', [$id]);
  }
}
