<?php
$page_name = 'admin';
require_once ('common/functions.php');
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content="Page d'administration du site de Christine Ngoy"/>
    <meta name="author" content="Elorry Detcheverry et Virginie Cuzin"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="robots" content="noindex,nofollow"/>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title><?= $page_name . ' - ' . ARTIST; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Tangerine" rel="stylesheet">
    <link rel="stylesheet" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/normalize.css"/>
    <link rel="stylesheet" type="text/css" href="css/admin.css"/>
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="scripts/modernizr-custom.js"></script>
    <!-- Scripts de l'editeur de texte -->
    <script src="scripts/plugins/tinymce/tinymce.min.js?apiKey=oki1g7dc3hafn6shl04zx9l19qwu9h2mj1es03uf13sp3lvu"></script>
</head>

<header>
    <nav id="sec_nav">
        <!-- Logo -->
        <p id="logo">Christine NGOY</p>
        <div>
            <!-- Alertes -->
            <button><i class="fa fa-bell" aria-hidden="true" class="icone"></i>Mes alertes</button>
        </div>
    </nav>
</header>

<body>
<nav id="main_nav"></nav>
<main id="container">
    <!-- Changer le titre en fonction de la categorie cliquee dans la main_nav -->
    <h1>Bienvenue Christine</h1>
    <div id="wrapper">
        <section id="welcome">
            <p>Veuillez vous connecter à votre compte.</p>

            <!-- Connection -->
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username"/>
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password"/>
                <button id="submit_login">Se connecter</button>
        </section>
    </div>
    <?php
    require_once ('views/js_scripts.php');
    ?>
</main>
</body>
