<?php
require_once ('common/functions.php');

// $_POST['function'] vaut les fonctions authenticate(), search() ...
if (isset($_POST['function'])){
    if (isset($_POST['parameters'])){
        call_user_func_array($_POST['function'],$_POST['parameters']);
    }
}
else
{
    if(isset($_GET['function'])){
        if (isset($_GET['parameters']) && !empty($_GET['parameters'])){
            call_user_func_array($_GET['function'],$_GET['parameters']);
        }
        else
        {
            call_user_func($_GET['function'],null);
        }
    }
}