<?php

include_once 'DAOPersonne.php';

class DAOContact extends DAOPersonne
{

    protected $table = 'contact';


    public function listByPays($id)
    {
        return $this->executeRequest($this->base_request.' AND n.id = ?', [$id]);
    }


}