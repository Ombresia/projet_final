<?php

/**
 * Fonctions de login a l'administration
 */

require_once('classes/authenticate.php');

function register() {
    $authenticate = new Authenticate();
    // Appel de la methode login de la classe Authenticate
    $authenticate->register('admin','admin');
}

function authentication() {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $authenticate = new Authenticate();
    // Appel de la methode login de la classe Authenticate
    echo "test";
    $authenticate->login($username,$password);
    if(!isset($_SESSION['ISLOGGED'])) {
        header('Location: administration_login.php');
        echo '<p>Nom d\'utilisateur ou mot de passe invalide.</p>';
    } else {
        if ($_SESSION['ADMIN'] == 'Y') {
            header('Location: administration.php');
        }
    }

}