<?php
// Title de la page
$page_name = 'L\'art de la peinture sur vitre';
// Inclusion du header
require_once('views/page_top.php');

?>

    <!-- Page d'accueil -->
    <body id="top">

    <section id="slider">
        <input type="radio" id="slider1" name="slider"/>
        <input type="radio" id="slider2" name="slider"/>
        <input type="radio" id="slider3" name="slider"/>

        <!-- Le carousel -->
        <div id="slides">
            <div id="overflow">
                <div class="inner">
                    <div class="photo">
                        <h3>Titre</h3>
                        <img src="images/thumbs/slider3.jpg" alt=""/>
                    </div>
                    <div class="photo">
                        <h3>Titre</h3>
                        <img src="images/thumbs/slider2.jpg" alt=""/>
                    </div>
                    <div class="photo">
                        <h3>Titre</h3>
                        <img src="images/thumbs/slider1.jpg" alt=""/>
                    </div>
                </div>
                <!-- Fin du inner -->
            </div>
            <!-- Fin overflow -->
        </div>
        <!-- Fin slides -->
        <div id="active">
            <label for="slider1"></label>
            <label for="slider2"></label>
            <label for="slider3"></label>

        </div>
    </section>
    <!-- Fin slider -->
    <main class="row accueil">
        <section class="col-12 col-m-12 col-s-12">
            <div class="titre_main">
                <i class="fa fa-calendar fa-lg" aria-hidden="true"></i>
                <h2>Mes rendez vous</h2>
            </div>

            <article>
                <div class="event_lieu"><h3>Galerie Du Lac</h3> <span>22/08/2017</span></div>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam dignissimos libero natus nemo nisi
                    officia quo rerum vero? Fuga nemo nobis soluta unde ut! Consequuntur earum est mollitia quos
                    repellat! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias animi assumenda,
                    consectetur debitis dicta explicabo fuga ipsum libero magni maxime odit pariatur quam sed similique
                    ullam voluptates voluptatibus. Adipisci, aperiam.</p>
            </article>

            <article>
                <div class="event_lieu"><h3>Galerie Lafayette </h3> <span>16/10/2017</span></div>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam dignissimos libero natus nemo nisi
                    officia quo rerum vero? Fuga nemo nobis soluta unde ut! Consequuntur earum est mollitia quos
                    repellat!</p>
            </article>

            <div class="titre_main">
                <i class="fa fa-picture-o fa-lg" aria-hidden="true"></i>
                <h2>Mes dernières oeuvres</h2>
            </div>

            <section id="derniere_oeuvres">

                <figure>
                    <img src="images/thumbs/12.jpg" alt="">
                    <h3>Titre de l'oeuvre</h3>
                </figure>

                <figure>
                    <img src="images/thumbs/2.jpg" alt="">
                    <h3>Titre de l'oeuvre</h3>
                </figure>

                <figure>
                    <img src="images/thumbs/3.jpg" alt="">
                    <h3>Titre de l'oeuvre</h3>
                </figure>

                <figure>
                    <img src="images/thumbs/4.jpg" alt="">
                    <h3>Titre de l'oeuvre</h3>
                </figure>

            </section>


        </section>

        <?php
        // Inclusion des scripts JS
        require_once('views/js_scripts.php');
        ?>

    </main>
    <?php
    // Inclusion du arrow
    require_once ('views/arrow.php')
    ?>
    </body>

<?php
// Inclusion du footer
require_once('views/footer.php');