<?php

?>
<script type="text/javascript">
    //menu mobile
    jQuery(function ($) {
        $('.menu-btn').click(function () {
            $('.responsive-menu').toggleClass('expand');

        });
        $('.menu-btn-ml').click(function () {

            $('.responsive-ml').toggleClass('expand');

        });
        $('.menu-btn-contact').click(function () {

            $('.responsive-contact').toggleClass('expand');
        })
    })

</script>
<footer id="footer_base">
    <div id="plan_site" class="col-3">
        <h4>Plan du site</h4>
        <nav>
            <ul>
                <li>
                    <a href="../index.php">Accueil</a>
                </li>
                <li>
                    <a href="../artiste.php">L'artiste</a>
                </li>
                <li>
                    <a href="../galerie.php">La galerie</a>
                </li>
                <li>
                    <a href="../contact.php">Contact</a>
                </li>
            </ul>
        </nav>
    </div>
    <div id="mentions_legales" class="col-3">
        <h4>Mentions légales</h4>
        <p>Copyright 2017</p></div>

    <div id="contact" class="col-3">
        <h4>Contact</h4>
        <p>christine.ngoy@gmail.com</p>
    </div>

</footer>

<!----------- FOOTER MOBILE ---------------->

<div class="mobile_footer">

    <!------- Mentions légales ---->
    <div class="menu-btn-ml" id="menu-btn">
        <i class="fa fa-arrows-v -lg" aria-hidden="true"></i> <h4>Mentions légales</h4>
    </div>

    <div class="responsive-ml">
        <div id="mentions_legales" class="col-3 col-s-12">

            <p>Copyright 2017</p></div>
    </div>

    <!--------- Contact ---->

    <div class="menu-btn-contact" id="menu-btn">
        <i class="fa fa-arrows-v -lg" aria-hidden="true"></i> <h4>Contact</h4>
    </div>

    <div class="responsive-contact">
        <div id="mentions_legales" class="col-3 col-s-12">

            <p>christine.ngoy@gmail.com/p></div>
    </div>

</div>