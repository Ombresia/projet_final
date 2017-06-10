<?php

/**
 * Fonctions de login a l'administration
 */

require_once('classes/authenticate.php');
require_once('classes/category.php');
require_once('classes/artwork.php');
require_once('classes/images.php');
require_once('classes/artist.php');

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
    if (isset($_SESSION['ISLOGGED'])) {
        echo "success";
    } else {
        echo "failed";
    }
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
    }
    print_r(json_encode($result));

}



function get_categories($category_type){
    $categories = new Category();
    $result = $categories->GetCategories($category_type);
    print_r(json_encode($result));
}

function get_artworks_by_cat_id($category_id){
    $artworks = new Artwork();
    $result = $artworks->GetArtworkByCategoryId($category_id);
    print_r(json_encode($result));
}

function get_artworks(){
    $artworks = new Artwork();
    $images = new Images();
    $result = array();
    $artworks_result = $artworks->GetArtworks();
    foreach ($artworks_result as $artwork) {
        $images_result = $images->GetImage($artwork['id'],'artworks');
        $artwork['images'] = $images_result;
        array_push($result,$artwork);
    }

    print_r(json_encode($result));
}


