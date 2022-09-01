<?php

include_once 'DAOGeneric.php';

class DAONationalite extends DAOGeneric
{

  protected $table = 'nationalite';
  protected $base_request = "SELECT *  FROM nationalite";
  protected $request_by_id = "SELECT *  FROM nationalite WHERE id= ?";

  public const colonnes = [
    ['denom'=> 'Pays', 'nom' => 'pays'],
    ['denom'=> 'Nationalité', 'nom' => 'nationalite'],
  ];


}