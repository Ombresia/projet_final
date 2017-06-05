/****************************************************************************/
/* Fonction d'ouverture du menu mobile */
/****************************************************************************/

jQuery(function ($) {
    $('.menu-btn').click(function () {
        $('.responsive-menu').toggleClass('expand')
    })
})

/****************************************************************************/
/* Administration du site */
/****************************************************************************/

$(function () {
    /* Add an artwork to the galery */
    $('button#new_artwork').on('click', function () {
        $('h1').text('Ajouter une nouvelle oeuvre à la Galerie');
    })
})

