<?php
require_once ('common/functions.php');

// $_POST['function'] vaut les fonctions authenticate(), search() ...
if (isset($_POST['function'])){
    $parameters = null;
    if (isset($_POST['parameters'])){
        var_dump($_POST);
        foreach ($_POST['parameters'] as $parameter){
            $parameters .=  $parameter . ',';

        }
    }
    var_dump($parameters);
    var_dump(substr($parameters,0,-1));
    $_POST['function'](substr($parameters,0,-1));
}