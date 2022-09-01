<?php

include_once 'DAOLien.php';

class DAOAgentSpecialite extends DAOLien
{

    protected $table = 'agent_specialite';

    protected $colonnes = ['agent', 'specialite'];
}
