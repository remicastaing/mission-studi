<?php

include_once 'DAOGeneric.php';

class DAOPlanqueType extends DAOGeneric
{
    protected $table = "planque_type";
    protected $base_request = "SELECT *  FROM planque_type";


}