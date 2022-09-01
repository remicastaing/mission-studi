<?php

include_once 'DAOLien.php';

class DAOMissionPlanque extends DAOLien
{

    protected $table = 'mission_planque';

    protected $colonnes = ['mission', 'planque'];
}
