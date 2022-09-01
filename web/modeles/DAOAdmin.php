<?php

include_once 'DAOGeneric.php';

class DAOAdmin extends DAOGeneric
{   
    protected $table = 'administrateur';
    
    protected $base_request = "SELECT * FROM administrateur a";

    protected $request_by_id = '';

    function __construct($dsn) {
        parent::__construct($dsn);

        $this->request_by_id = $this->base_request.' and m.id = ?';
    }


    function getByEmailPassword($email, $password){

        $request = $this->base_request." WHERE a.email= ?  AND a.password = ?";
        $hashed_pwd = md5($password);

        $admin = $this->executeRequest($request, [$email, $hashed_pwd]);

        if($admin){
            $admin = $admin[0];
        }

        return $admin;
    }


}