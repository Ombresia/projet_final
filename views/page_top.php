<?php
// Inclusion des variables et constantes
require_once('common/defines.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content=""/>
    <meta name="author" content="Elorry Detcheverry et Virginie Cuzin"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="robots" content="noindex,nofollow"/>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title><?= $page_name . ' - ' . ARTIST ?></title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Tangerine" rel="stylesheet">
    <link rel="stylesheet" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/normalize.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="scripts/modernizr-custom.js"></script>
</head>

<header>

    <?php
    // Inclusion de la navigation secondaire
    require_once('views/sec_nav.php');
    ?>

    <!-- Logo -->
    <div></div>
    <!-- Navigation principale -->
    <nav></nav>

</header>