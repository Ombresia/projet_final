<?php

/**
 * Fonctions de login a l'administration
 */

require_once('classes/authenticate.php');

function register()
{
    $authenticate = new Authenticate();
    // Appel de la methode login de la classe Authenticate
    $authenticate->register('admin', 'admin');
}

function authentication($username,$password)
{
    $authenticate = new Authenticate();
    // Appel de la methode login de la classe Authenticate
    $authenticate->login($username, $password);
    if (!isset($_SESSION['ISLOGGED'])) {
        return false;
    }
    return true;
}


/**
 * Fonction search
 * @param $type : Articles, Artworks, Everything
 * @param $string : keywords written in the Search Bar
 */
function search($type, $string)
{
    $search = new Search();
    $result = 'not found';
    switch ($type) {
        case 'Artworks':
            $result = $search->Artworks($string);
            break;
        case 'Articles':
            $result = $search->Articles($string);
            break;
        case 'Everything':
            $result = $search->Everything($string);
            break;
        default :
            return ($result);
    }
    return ($result);

}