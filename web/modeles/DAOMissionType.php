<?php

include_once 'DAOGeneric.php';

class DAOMissionType extends DAOGeneric
{
    protected $table = "mission_type";
    protected $base_request = "SELECT *  FROM mission_type";


}