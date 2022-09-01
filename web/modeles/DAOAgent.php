<?php

include_once 'DAOPersonne.php';

include_once 'DAOAgentSpecialite.php';

class DAOAgent extends DAOPersonne
{

    protected $table = 'agent';

    protected $specialite;

    public function __construct($dsn)
    {
        parent::__construct($dsn);

        $this->specialite = new DAOAgentSpecialite($dsn);
    }


    public function listAgentsAutresPays($cibles, $specialite)
    {
        $in  = str_repeat('?,', count($cibles) - 1) . '?';

        $request = "SELECT t.id, t.nom, t.prenom, t.naissance, n.nationalite , t.code  
                            FROM agent t , nationalite n 
                            WHERE t.nationalite = n.id
                            and t.id not in 
                            (select agent from agent_specialite a_s where a_s.specialite =  ?)
                            and t.nationalite not in
                                (select c.nationalite  from cible c 
                                where c.id  in ($in))
                    UNION
                    SELECT t.id, t.nom, t.prenom, t.naissance, n.nationalite , CONCAT(t.code, ' ***')  
                            FROM agent t , nationalite n, agent_specialite a_s  
                            WHERE t.nationalite = n.id
                            and t.id= a_s.agent
                            and a_s.specialite  = ?
                            and t.nationalite not in
                                (select c.nationalite  from cible c 
                                where c.id  in ($in))";


        $donnees = array_merge([$specialite], $cibles, [$specialite], $cibles);

        $res =  $this->executeRequest($request, $donnees);

        return $res;
    }

    public function getSpecialites($id)
    {
        return $this->executeRequest('select * from specialite s , agent_specialite as a_s where s.id = a_s.specialite and a_s.agent = ?', [$id]);
    }
}
