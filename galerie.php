<?php
// Title de la page
$page_name = 'Visitez ma galerie';
// Inclusion du header
require_once('views/page_top.php');
// Inclusion des fonctions php
require_once('common/functions.php');
?>

    <body id="top">
    <!-- Page de la galerie -->

    <main class="row">
        <section class="col-12 col-m-12 col-s-12 galerie">
            <div class="titre_main">
                <h2>Mes oeuvres</h2>
            </div>

            <section class="col-12 col-m-12 col-s-12">
                <nav>
                    <ul id="categories_artworks">
                        <?php ?>
                    </ul>
                </nav>
                <div class="content">
                    <div class="grid">

                    </div>
                    <!-- /grid -->
                    <div class="preview">
                        <button class="action action--close"><i class="fa fa-times" aria-hidden="true"></i><span
                                    class="text-hidden">Close</span></button>
                        <div class="description description--preview"></div>
                    </div>
                    <!-- /preview -->
                </div>
                <!-- /content -->
            </section>
            <!-- /container -->
        </section>
    </main>

    <?php
    // Inclusion du arrow
    require_once('views/arrow.php');
    // Inclusion des scripts js
    require_once('views/js_scripts.php');
    ?>

    <script>

        $(document).ready(function () {
            console.log('DOM construit');

            $(document).on('click', '#categories_artworks li', function () {
                var id = $(this).attr('id');
                display_artworks_by_cat_id(id);
            });

            function display_categories($category_type) {
                $.getJSON("_controller.php", {function: "get_categories", parameters: [$category_type]},
                    function (data) { // data vaut result de la fonction sous forme d'array
                        console.log(data);
                        // Pour chaque categorie cat_title dans data, on passe la fonction
                        $.each(data, function (index, cat_data) {
                            console.log(cat_data.CAT_TITLE);
                            $('ul#categories_artworks')
                                .append('<li id="' + cat_data.ID + '" class="trigger">' + cat_data.CAT_TITLE + '</li>');
                        });
                    })
            };


            function display_artworks_by_cat_id(id) {
                $.getJSON("_controller.php", {function: "get_artworks_by_cat_id", parameters: [id]},
                    function (data) { // data vaut result de la fonction sous forme d'array
                        $('.grid').empty();
                        $.each(data, function (index, art_data) {
                                var original_image_path = '';
                                var original_image_size = '';
                                var image_content_type = '';

                                $(art_data.images).each(function (i, image_data) {
                                    if (image_data.image_type == 'original') {
                                        original_image_path = image_data.image_path;
                                        original_image_size = image_data.data_size;
                                        image_content_type = image_data.content_type;
                                    } else {
                                        thumbs_image_path = image_data.image_path;
                                    }
                                });
                                var final_div = '<div id="' + index + '" data-size="' + original_image_size + '" class="grid__item">'
                                final_div += '<a href="' + original_image_path + '" class="img-wrap">';
                                final_div += '<img src="' + thumbs_image_path + '" alt="' + image_content_type + '"/>';
                                final_div += '<div class="description description--grid">';
                                final_div += '<h3>' + art_data.art_title + '</h3>';
                                final_div += '<p>' + art_data.art_description + '</p><p><em>' + art_data.FIRSTNAME + ' ' + art_data.LASTNAME + '</em></p>';
                                final_div += '</div>';
                                final_div += '</a>';
                                final_div += '</div>';
                                $('.grid').append(final_div);
                            }
                        );
                        init_grid();
                    })
            };

            function display_artworks() {
                $.getJSON("_controller.php", {function: "get_artworks", parameters: ['']},
                    function (data) { // data vaut result de la fonction sous forme d'array
                        // Pour chaque artwork trouvee on boucle
                        $('.grid').empty();
                        $.each(data, function (index, art_data) {
                                var original_image_path = '';
                                var original_image_size = '';
                                var image_content_type = '';

                                $(art_data.images).each(function (i, image_data) {
                                    if (image_data.image_type == 'original') {
                                        original_image_path = image_data.image_path;
                                        original_image_size = image_data.data_size;
                                        image_content_type = image_data.content_type;
                                    } else {
                                        thumbs_image_path = image_data.image_path;
                                    }
                                });
                                var final_div = '<div id="' + index + '" data-size="' + original_image_size + '" class="grid__item">'
                                final_div += '<a href="' + original_image_path + '" class="img-wrap">';
                                final_div += '<img src="' + thumbs_image_path + '" alt="' + image_content_type + '"/>';
                                final_div += '<div class="description description--grid">';
                                final_div += '<h3>' + art_data.art_title + '</h3>';
                                final_div += '<p>' + art_data.art_description + '</p><p><em>' + art_data.FIRSTNAME + ' ' + art_data.LASTNAME + '</em></p>';
                                final_div += '</div>';
                                final_div += '</a>';
                                final_div += '</div>';
                                $('.grid').append(final_div);
                            }
                        );
                        init_grid();
                    })
            }
            ;

            /**
             * fonction d'initialisation de la grille
             */
            function init_grid() {
                console.log('test');

                var support = {transitions: Modernizr.csstransitions},
                    // transition end event name
                    transEndEventNames = {
                        'WebkitTransition': 'webkitTransitionEnd',
                        'MozTransition': 'transitionend',
                        'OTransition': 'oTransitionEnd',
                        'msTransition': 'MSTransitionEnd',
                        'transition': 'transitionend'
                    },
                    transEndEventName = transEndEventNames[Modernizr.prefixed('transition')],
                    onEndTransition = function (el, callback) {
                        var onEndCallbackFn = function (ev) {
                            if (support.transitions) {
                                if (ev.target != this) return;
                                this.removeEventListener(transEndEventName, onEndCallbackFn);
                            }
                            if (callback && typeof callback === 'function') {
                                callback.call(this);
                            }
                        };
                        if (support.transitions) {
                            el.addEventListener(transEndEventName, onEndCallbackFn);
                        }
                        else {
                            onEndCallbackFn();
                        }
                    };

                new GridFx(document.querySelector('.grid'), {
                    imgPosition: {
                        x: -0.5,
                        y: 1
                    },
                    onOpenItem: function (instance, item) {
                        instance.items.forEach(function (el) {
                            if (item != el) {
                                var delay = Math.floor(Math.random() * 50);
                                el.style.WebkitTransition = 'opacity .5s ' + delay + 'ms cubic-bezier(.7,0,.3,1), -webkit-transform .5s ' + delay + 'ms cubic-bezier(.7,0,.3,1)';
                                el.style.transition = 'opacity .5s ' + delay + 'ms cubic-bezier(.7,0,.3,1), transform .5s ' + delay + 'ms cubic-bezier(.7,0,.3,1)';
                                el.style.WebkitTransform = 'scale3d(0.1,0.1,1)';
                                el.style.transform = 'scale3d(0.1,0.1,1)';
                                el.style.opacity = 0;
                            }
                        });
                    },
                    onCloseItem: function (instance, item) {
                        instance.items.forEach(function (el) {
                            if (item != el) {
                                el.style.WebkitTransition = 'opacity .4s, -webkit-transform .4s';
                                el.style.transition = 'opacity .4s, transform .4s';
                                el.style.WebkitTransform = 'scale3d(1,1,1)';
                                el.style.transform = 'scale3d(1,1,1)';
                                el.style.opacity = 1;

                                onEndTransition(el, function () {
                                    el.style.transition = 'none';
                                    el.style.WebkitTransform = 'none';
                                });
                            }
                        });
                    }
                })

                /* GridFx.prototype._getWinSize = function () {
                 return {
                 width: document.documentElement.clientWidth,
                 height: window.innerHeight
                 };
                 };

                 window.GridFx = GridFx;*/
            }

            display_categories('artworks');
            display_artworks();
        })
        ;
    </script>
    </body>

<?php
// Inclusion du footer
require_once('views/footer.php');
?>