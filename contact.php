<?php
// Title de la page
$page_name = 'Posez-moi vos questions';
// Inclusion du header
require_once('views/page_top.php');

?>

    <!-- Page du formulaire de contact -->
    <body>
        <main>
            <h1>Me contacter</h1>
            <section>
                <form action="contact.php" method="post" novalidate="novalidate">
                    <ul>
                        <li>
                            <label for="first_name">Prénom *</label>
                            <input type="text" id="first_name" name="first_name" required="required" autofocus="autofocus"/>
                            <i class="fa fa-question-circle" aria-hidden="true"></i>
                        </li>
                        <li>
                            <label for="name">Nom *</label>
                            <input type="text" id="name" name="name" required="required"/>
                            <i class="fa fa-question-circle" aria-hidden="true"></i>
                        </li>
                        <li>
                            <label for="phone">Téléphone</label>
                            <input type="tel" id="phone" name="phone"/>
                            <i class="fa fa-question-circle" aria-hidden="true"></i>
                        </li>
                        <li>
                            <label for="email">Courriel *</label>
                            <input type="email" id="email" name="email" required="required"/>
                            <i class="fa fa-question-circle" aria-hidden="true"></i>
                        </li>
                        <li>
                            <label for="subject">Sujet *</label>
                            <input type="text" id="subject" name="subject" required="required"/>
                            <i class="fa fa-question-circle" aria-hidden="true"></i>
                        </li>
                        <li>
                            <label for="message">Message *</label>
                            <i class="fa fa-question-circle" aria-hidden="true"></i>
                        </li>
                        <li>
                            <textarea id="message" name="message" required="required"></textarea>
                        </li>
                        <li>
                            <input type="submit"/>
                        </li>
                    </ul>
                </form>
            </section>
        </main>
    </body>

<?php
// Inclusion du footer
require_once('views/footer.php');