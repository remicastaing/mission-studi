<?php

include_once 'DAOGeneric.php';

class DAOLien extends DAOGeneric
{

    protected $colonnes = [];

    protected $insertRequest = "";





    public function __construct($dsn)
    {
        parent::__construct($dsn);

        $index = 0;
        $colonnes = '';
        $valeurs = '';
        foreach ($this->colonnes as $colonne) {

            $colonnes .= $index == 0 ? $colonne : ', ' . $colonne;
            $valeurs .=  $index == 0 ? ":$colonne" : ", :$colonne";
            $index++;
        }

        $this->insertRequest = "INSERT INTO $this->table ($colonnes) VALUES ($valeurs)";


    }


    public function deleteInsert($col_data, $data, $col, $id)
    {


        $this->delete($id, $col);

        foreach($data as $value){
            $donnees = [":$col" => $id, ":$col_data" => $value];

            $res = $this->executeRequest($this->insertRequest, $donnees);
        }
        
    }


}
