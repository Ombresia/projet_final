<?php

/**
 * Fonctions de login a l'administration
 */

require_once('classes/authenticate.php');
require_once('classes/category.php');
require_once('classes/artwork.php');
require_once('classes/images.php');
require_once('classes/artist.php');
require_once('classes/search.php');

function register()
{
    $authenticate = new Authenticate();
    // Appel de la methode login de la classe Authenticate
    $authenticate->register('admin', 'admin');
}

function authentication($username, $password)
{
    $authenticate = new Authenticate();
    // Appel de la methode login de la classe Authenticn
    $authenticate->login($username, $password);
    if (isset($_SESSION['ISLOGGED'])) {
        echo json_encode("authenticated");
    } else {
        echo json_encode("try again");
    }
}

function disconnect()
{
    $authenticate = new Authenticate();
    $authenticate->logout();
    if(isset($_SESSION['ISLOGGED'])){
        echo json_encode("logout failed");
    } else {
        echo json_encode("logout successful");
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
    $images = new Images();
    switch ($type) {
        case 'Artworks':
            $search_result = $search->Artworks($string);
            $result = array();
            if (!$search_result == "no_result") {
                foreach ($search_result as $search) {
                    $images_result = $images->GetImage($search['id']);
                    $artwork['images'] = $images_result;
                    array_push($result, $artwork);
                }
            } else {
                $result = 'not found';
            }
            break;
        case 'Articles':
            $search_result = $search->Articles($string);
            $result = array();
            if (!$search_result == "no_result") {
                foreach ($search_result as $search) {
                    $images_result = $images->GetImage($search['id']);
                    $artwork['images'] = $images_result;
                    array_push($result, $artwork);
                }
            } else {
                $result = 'not found';
            }
            break;
        case 'Everything':
            $artwork_result = $search->Artworks($string . '*');
            $article_result = $search->Articles($string . '*');
            $result = array();
            if (gettype($artwork_result) == 'array') {
                foreach ($artwork_result as $search) {
                    $images_result = $images->GetImage($search['id']);
                    $search['images'] = $images_result;
                    array_push($result, $search);
                }
            }
            if (gettype($article_result) == 'array') {
                foreach ($article_result as $search) {
                    $images_result = $images->GetImage($search['id']);
                    $search['images'] = $images_result;
                    array_push($result, $search);
                }
            }
            if ($artwork_result == "no_result" && $article_result == "no_result"){
                $result = 'not found';
            }
            break;
        default :
            $result = 'not found';
    }
    print_r(json_encode($result));

}


function get_categories($category_type)
{
    $categories = new Category();
    $result = $categories->GetCategories($category_type);
    print_r(json_encode($result));
}

function get_artworks_by_cat_id($category_id)
{
    $artworks = new Artwork();
    $result = $artworks->GetArtworkByCategoryId($category_id);
    print_r(json_encode($result));
}

function get_artworks()
{
    $artworks = new Artwork();
    $images = new Images();
    $result = array();
    $artworks_result = $artworks->GetArtworks();
    foreach ($artworks_result as $artwork) {
        $images_result = $images->GetImage($artwork['id']);
        $artwork['images'] = $images_result;
        array_push($result, $artwork);
    }

    print_r(json_encode($result));
}


