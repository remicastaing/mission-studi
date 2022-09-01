<?php

$METHODE = "_POST";

$id =  isset($$METHODE['id']) ? $$METHODE['id'] : false;

if(isset($_POST['id'])){
    $id = $_POST['id'];
} elseif (isset($_GET['id'])){
    $id = $_GET['id'];
}

$action = isset($_GET['action']) ? $_GET['action'] : false;

function checkAdmin(){
    if (!isset($_SESSION['admin'])) {
        include 'login.php';
        exit();
    }
}

function out($var){
    echo '</br>';
    var_dump($var);
}