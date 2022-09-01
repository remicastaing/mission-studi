<?php

$db_url = getenv("DATABASE_URL");

if ($db_url){

    $db = parse_url(getenv("DATABASE_URL"));
    $DSN = "pgsql:" . sprintf(
        "host=%s;port=%s;user=%s;password=%s;dbname=%s",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/"));

} else {

    $host = 'localhost';
    $dbname = 'missionstudi';
    $username = 'postgres';
    $password = '';
    
    $DSN = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
    

}

