<?php

include_once 'DAOLien.php';

class DAOMissionAgent extends DAOLien
{

    protected $table = 'mission_agent';

    protected $colonnes = ['mission', 'agent'];
}
