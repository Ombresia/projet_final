<?php
// Title de la page
$page_name = 'Posez-moi vos questions';
// Inclusion du header
require_once('views/page_top.php');

// Validation php formulaire
$validation = array(
    'firstname' => array(
        'value' => '',
        'is_valid' => false,
        'error_msg' => 'Le prénom doit au moins contenir 1 caractère valide.',
    ),
    'lastname' => array(
        'value' => '',
        'is_valid' => false,
        'error_msg' => 'Le nom doit au moins contenir 1 caractère valide.',
    ),
    'phone' => array(
        'value' => '',
        'is_valid' => false,
        'error_msg' => 'Le numéro de téléphone n\'est pas valide (ex. 555-000-0000).',
        'regex' => '/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i',
    ),
    'email' => array(
        'value' => '',
        'is_valid' => false,
        'error_msg' => 'L\'adresse courriel n\'est pas valide (ex. exemple@gmail.com).',
        'regex' => '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD',
    ),
    'subject' => array(
        'value' => '',
        'is_valid' => false,
        'error_msg' => 'Le sujet du message doit au moins contenir 1 caractère valide.',
    ),
    'message' => array(
        'value' => '',
        'is_valid' => false,
        'error_msg' => 'Le message doit au moins contenir 1 caractère valide.',
    )
);

// Réception des données
$en_reception = array_key_exists('contact_submit', $_POST);
//var_dump($_POST);

if ($en_reception) {
    // Firstname
    $v =& $validation['firstname'];
    $v['value'] = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING));
    $v['is_valid'] = strlen($v['value']) >= 1;
    $firstname = $v['value'];

    // Lastname
    $v =& $validation['lastname'];
    $v['value'] = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING));
    $v['is_valid'] = strlen($v['value']) >= 1;
    $lastname = $v["value"];

    // Phone
    $v =& $validation['phone'];
    $v['value'] = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
    $v['is_valid'] = (1 === preg_match($v['regex'], $v['value']));

    // Email
    $v =& $validation['email'];
    $v['value'] = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
    $v['is_valid'] = (1 === preg_match($v['regex'], $v['value']));

    // Subject
    $v =& $validation['subject'];
    $v['value'] = trim(filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING));
    $v['is_valid'] = strlen($v['value']) >= 1;

    // Message
    $v =& $validation['message'];
    //$v['value'] = trim($_POST['message']);
    $v['value'] = trim(filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING));
    $v['is_valid'] = strlen($v['value']) >= 1;

    $formulaire_valide = true;
    foreach ($validation as $val) {
        if (!$val['is_valid']) {
            $formulaire_valide = false;
            break;
        }
    }
    if ($formulaire_valide) {
        exit;
    }
}

?>

    <!-- Page du formulaire de contact -->
    <body id="top">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d178187.8403085168!2d-73.80690718520306!3d45.747436906204136!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4cc8dc711510e05f%3A0xf97eef202e671f32!2sTerrebonne%2C+QC!5e0!3m2!1sfr!2sca!4v1497240775525"
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
                               class="input__field input__field--manami"
                               value="<?= $en_reception ? $_POST['firstname'] : '' ?>"/>
                        <label for="firstname" class="input__label input__label--manami">
                            <span class="input__label-content input__label-content--manami">Prénom (*)</span>
                        </label>
                    </li>
                    <span class="tooltip">
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                        <span class="tooltiptext">Le prénom doit contenir au moins 1 caractère pour être valide.</span>
                    </span>
                    <?php
                    if ($en_reception && !$validation['firstname']['is_valid']) {
                        echo '<p class="error_msg"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>' . $validation['firstname']['error_msg'].'</p>';
                    }
                    ?>

                    <!-- Lastname -->
                    <li class="input input--manami">
                        <input type="text" id="lastname" name="lastname" required="required"
                               class="input__field input__field--manami" value="<?= $en_reception ? $_POST['lastname'] : '' ?>"/>
                        <label for="lastname" class="input__label input__label--manami">
                            <span class="input__label-content input__label-content--manami">Nom (*)</span>
                        </label>
                    </li>
                    <span class="tooltip">
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                        <span class="tooltiptext">Le nom doit contenir au moins 1 caractère pour être valide.</span>
                    </span>
                    <?php
                    if ($en_reception && !$validation['lastname']['is_valid']) {
                        echo '<p class="error_msg"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>' . $validation['lastname']['error_msg'].'</p>';
                    }
                    ?>

                    <!-- Phone -->
                    <li class="input input--manami">
                        <input type="tel" id="phone" name="phone" class="input__field input__field--manami" value="<?= $en_reception ? $_POST['phone'] : '' ?>"/>
                        <label for="phone" class="input__label input__label--manami">
                            <span class="input__label-content input__label-content--manami">Téléphone</span>
                        </label>
                    </li>
                    <span class="tooltip">
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                        <span class="tooltiptext">Le numéro de téléphone doit être au format XXX-XXX-XXXX.</span>
                    </span>
                    <?php
                    if ($en_reception && !$validation['phone']['is_valid']) {
                        echo '<p class="error_msg"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>' . $validation['phone']['error_msg'].'</p>';
                    }
                    ?>

                    <!-- Email -->
                    <li class="input input--manami">
                        <input type="email" id="email" name="email" required="required"
                               class="input__field input__field--manami" value="<?= $en_reception ? $_POST['email'] : '' ?>"/>
                        <label for="email" class="input__label input__label--manami">
                            <span class="input__label-content input__label-content--manami">Courriel (*)</span>
                        </label>
                    </li>
                    <span class="tooltip">
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                        <span class="tooltiptext">Le courriel doit être sous la forme non@exemple.com</span>
                    </span>
                    <?php
                    if ($en_reception && !$validation['email']['is_valid']) {
                        echo '<p class="error_msg"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>' . $validation['email']['error_msg'].'</p>';
                    }
                    ?>

                    <!-- Sujet du contact -->
                    <li class="input input--manami">
                        <input type="text" id="subject" name="subject" required="required"
                               class="input__field input__field--manami" value="<?= $en_reception ? $_POST['subject'] : '' ?>"/>
                        <label for="subject" class="input__label input__label--manami">
                            <span class="input__label-content input__label-content--manami">Sujet (*)</span>
                        </label>
                    </li>
                    <span class="tooltip">
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                        <span class="tooltiptext">Le sujet doit contenir au moins 1 caractère pour être valide.</span>
                    </span>
                    <?php
                    if ($en_reception && !$validation['subject']['is_valid']) {
                        echo '<p class="error_msg"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>' . $validation['subject']['error_msg'].'</p>';
                    }
                    ?>

                    <!-- Message -->
                    <li class="input input--manami">
                        <label for="message" class="message">Message (*)</label>

                    </li>
                    <li>
                        <textarea id="message" name="message" cols="150" rows="20" required="required"><?= $en_reception ? $_POST['message'] : '' ?></textarea>
                    </li>
                    <?php
                    if ($en_reception && !$validation['message']['is_valid']) {
                        echo '<p class="error_msg"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>' . $validation['message']['error_msg'].'</p>';
                    }
                    ?>

                    <!-- Submit -->
                    <li>
                        <input type="submit" id="contact_submit" name="contact_submit" value="Envoyer"/>
                    </li>
                </ul>
            </form>
        </section>
    </main>

    <?php
    // Inclusion du arrow_top
    require_once ('views/arrow.php');
    // Inclusion des scripts js
    require_once('views/js_scripts.php');
    ?>

    </body>

<?php
// Inclusion du footer
require_once('views/footer.php');