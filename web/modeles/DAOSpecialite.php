<?php

include_once 'DAOGeneric.php';

class DAOSpecialite extends DAOGeneric
{
    protected $table = 'specialite';

    protected $base_request = "SELECT a.*  FROM specialite a";



    }
