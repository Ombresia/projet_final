<?php
// Title de la page
$page_name = 'Posez-moi vos questions';
// Inclusion du header
require_once('views/page_top.php');

?>

    <!-- Page du formulaire de contact -->
    <body>
    <main class="row">
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
                        <span class="tooltiptext">Le courriel doit contenir au moins 1 caractère @ pour être valide.</span>
                    </span>
                    <li class="input input--manami">
                        <input type="text" id="subject" name="subject" required="required"
                               class="input__field input__field--manami"/>
                        <label for="subject" class="input__label input__label--manami">
                            <span class="input__label-content input__label-content--manami">Sujet (*)</span>
                        </label>
                    </li>
                    <span class="tooltip">
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                        <span class="tooltiptext">Le prénom doit contenir au moins 1 caractère pour être valide.</span>
                    </span>

                    <li>
                        <label for="message">Message *</label>
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
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