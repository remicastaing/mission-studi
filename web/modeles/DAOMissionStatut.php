<?php

include_once 'DAOGeneric.php';

class DAOMissionStatut extends DAOGeneric
{
    protected $table = "mission_statut";
    protected $base_request = "SELECT *  FROM mission_statut";


}