<?php

include_once 'DAOLien.php';

class DAOMissionCible extends DAOLien
{

    protected $table = 'mission_cible';

    protected $colonnes = ['mission', 'cible'];
}
