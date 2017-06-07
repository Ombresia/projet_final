<?php
// Title de la page
$page_name = 'Portrait de l\'artiste peintre';
// Inclusion du header
require_once('views/page_top.php');

?>

    <!-- Page portrait de l'artiste -->
    <body>
    <main class="row">
        <section class="col-12 col-m-12 col-s-12 artiste">
            <div class="titre_main">
                <h2>Qui suis-je ?</h2>
            </div>

            <figure class="col-4 col-m-4 col-s-12"><img src="images/original/autoprotrait.jpg"></figure>

            <article class="col-6 col-m-6 col-s-12">
                <p>Originaire du Cameroun, c’est à l’âge de dix ans que j’ai gagné ma première poupée lors d’un
                    concours de dessin. Ce jour-là, j’ai dit à ma mère que dessiner serait mon métier, c’est pourquoi
                    j’ai étudié la
                    mode et la décoration d’intérieur. La cuisine et la pâtisserie, deux autres formes d’art à mes yeux,
                    vinrent s’ajouter par la suite, comme tant de cordes à mon arc.</p>
                <p> C’est en 2011 que j’ai vraiment commencé à explorer les arts en commençant à peindre sur différentes
                    matières, telles que la toile, l’acier, le bois puis la vitre. J’ai également touché à la sculpture
                    sur bois, acier et textile, puis à la pierre et l’argile. Finalement, c’est sur la vitre que mon
                    choix
                    s'est arrêté.</p>
                <p>Pour réduire les coûts et pousser plus loin mes nombreuses idées, j’ai appris à fabriquer mes propres
                    couleurs et à les adapter à la peinture sur vitre. J’ai alors commencé par peindre l’Afrique
                    d’autrefois. Je souhaitais montrer le peuple africain tel qu’il était avant l’influence européenne,
                    avec
                    les nombreuses traditions qui le définisse.</p>
                <p>À l’époque, je vivais dans une petite ville où mes enfants n’avaient pas d’amis à cause de leurs
                    différences. Un jour, mon fils est rentré de l’école et m’a dit :</p>
                <p>« Maman, personne ne m’aime. »</p>
                <p>À partir de ce jour, j’ai commencé à peindre le présent, et non plus le passé, en utilisant toutes
                    les
                    couleurs possibles et inimaginables, car c’est ainsi que je souhaite voir le monde.</p>
            </article>

            <div class="titre_main">
                <h2>Visiter mon atelier</h2>

                <figure class="col-5 col-m-4 col-s-12"><img src="images/original/33.jpg"></figure>

                <figure class="col-5 col-m-4 col-s-12"><img src="images/original/31.jpg"></figure>

                <p class="col-12 col-m-12 col-s-12">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusantium amet
                    blanditiis ea
                    exercitationem, iusto mollitia nam non nulla optio quod, recusandae totam voluptatum! Dolore nisi
                    numquam quos similique Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor illum
                    maiores, perferendis quod sit voluptatum. Cumque cupiditate dolorem fugiat, itaque non obcaecati
                    placeat porro quae saepe, sint sit tempore vel? Lorem ipsum dolor sit amet, consectetur adipisicing
                    elit. Alias at blanditiis commodi dolores eum expedita facilis fuga, harum hic illum in iure iusto
                    libero maxime mollitia placeat provident sequi voluptatibus.</p>


                <video controls src="video.ogv" class="col-12 col-m-12 col-s-12">Ici la description alternative</video>


            </div>

            <article>


            </article>
        </section>

        <?php
        // Inclusion des scripts JS
        require_once ('views/js_scripts.php');
        ?>

    </main>
    </body>

<?php
// Inclusion du footer
require_once('views/footer.php');