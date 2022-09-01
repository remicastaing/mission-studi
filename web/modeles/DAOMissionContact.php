<?php

include_once 'DAOLien.php';

class DAOMissionContact extends DAOLien
{

    protected $table = 'mission_contact';

    protected $colonnes = ['mission', 'contact'];
}
