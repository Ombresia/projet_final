<?php
// Title de la page
$page_name = 'Posez-moi vos questions';
// Inclusion du header
require_once('views/page_top.php');

?>

    <!-- Page du formulaire de contact -->
    <body>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2794.302556627608!2d-73.64289478465318!3d45.544238836120506!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4cc918e0c061b07f%3A0x647a6b6d7cb681a7!2sISI%2C+l&#39;Institut+sup%C3%A9rieur+d&#39;informatique!5e0!3m2!1sfr!2sca!4v1496847016449"
            width="100%" height="350" frameborder="0" style="border:0" allowfullscreen class="googlemap"></iframe>
    <main class="row contact">

        <section class="col-12">

            <div class="titre_main">

                <h2>Me contacter</h2>
            </div>
            <form action="contact.php" method="post" novalidate="novalidate">
                <ul>
                    <!-- Firstname -->
                    <li class="input input--manami">
                        <input type="text" id="firstname" name="firstname" required="required"
                               class="input__field input__field--manami"/>
                        <label for="firstname" class="input__label input__label--manami">
                            <span class="input__label-content input__label-content--manami">Prénom (*)</span>
                        </label>
                    </li>
                    <span class="tooltip">
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                        <span class="tooltiptext">Le prénom doit contenir au moins 1 caractère pour être valide.</span>
                    </span>

                    <!-- Lastname -->
                    <li class="input input--manami">
                        <input type="text" id="lastname" name="lastname" required="required"
                               class="input__field input__field--manami"/>
                        <label for="lastname" class="input__label input__label--manami">
                            <span class="input__label-content input__label-content--manami">Nom (*)</span>
                        </label>
                    </li>
                    <span class="tooltip">
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                        <span class="tooltiptext">Le nom doit contenir au moins 1 caractère pour être valide.</span>
                    </span>

                    <!-- Phone -->
                    <li class="input input--manami">
                        <input type="tel" id="phone" name="phone" class="input__field input__field--manami"/>
                        <label for="phone" class="input__label input__label--manami">
                            <span class="input__label-content input__label-content--manami">Téléphone</span>
                        </label>
                    </li>
                    <span class="tooltip">
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                        <span class="tooltiptext">Le numéro de téléphone doit être au format XXX-XXX-XXXX.</span>
                    </span>

                    <!-- Email -->
                    <li class="input input--manami">
                        <input type="email" id="email" name="email" required="required"
                               class="input__field input__field--manami"/>
                        <label for="email" class="input__label input__label--manami">
                            <span class="input__label-content input__label-content--manami">Courriel (*)</span>
                        </label>
                    </li>
                    <span class="tooltip">
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                        <span class="tooltiptext">Le courriel doit être sous la forme non@exemple.com</span>
                    </span>

                    <!-- Sujet du contact -->
                    <li class="input input--manami">
                        <input type="text" id="subject" name="subject" required="required"
                               class="input__field input__field--manami"/>
                        <label for="subject" class="input__label input__label--manami">
                            <span class="input__label-content input__label-content--manami">Sujet (*)</span>
                        </label>
                    </li>
                    <span class="tooltip">
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                        <span class="tooltiptext">Le sujet doit contenir au moins 1 caractère pour être valide.</span>
                    </span>

                    <!-- Message -->
                    <li>
                        <label for="message" class="message">Message (*)</label>

                    </li>
                    <li>
                        <textarea id="message" name="message" required="required"></textarea>
                    </li>
                    <li>
                        <input type="submit" id="contact_submit" name="contact_submit" value="Envoyer"/>
                    </li>
                </ul>
            </form>
        </section>
    </main>

    <?php
    // Inclusion des scripts js
    require_once('views/js_scripts.php');
    ?>

    </body>

<?php
// Inclusion du footer
require_once('views/footer.php');