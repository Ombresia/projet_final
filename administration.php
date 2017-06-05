<?php
require_once('common/defines.php');
$page_name = 'admin';
// Authentication test : Si pas logged redirection vers page de login
session_start();
if(isset($_SESSION['ISLOGGED'])) {
    if (!$_SESSION['ISLOGGED']){
        header('Location: administration_login.php');
    }
}
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
    <!-- Scripts de l'editeur de texte -->
    <script src="scripts/plugins/tinymce/tinymce.min.js?apiKey=oki1g7dc3hafn6shl04zx9l19qwu9h2mj1es03uf13sp3lvu"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="scripts/modernizr-custom.js"></script>
    <script src="scripts/functions.js"></script>
    <script src="scripts/main.js"></script>

</head>

<header>
    <nav id="sec_nav">
        <!-- Logo -->
        <p id="logo">Christine NGOY</p>
        <div>
            <!-- Connection -->
            <button class="menu-btn"><i class="fa fa-user" aria-hidden="true"></i>Se connecter</button>
            <!-- Alertes -->
            <button><i class="fa fa-bell" aria-hidden="true" class="icone"></i>Mes alertes</button>
        </div>
    </nav>
</header>

<body>
<nav id="main_nav">
    <ul>
        <li><a href="#">Galerie</a>
            <ul>
                <li>
                    <button id="new_artwork">
                        <i class="fa fa-plus" aria-hidden="true" class="icone"></i>Ajouter une nouvelle oeuvre
                    </button>
                </li>
                <li>
                    <button>
                        <i class="fa fa-pencil" aria-hidden="true" class="icone"></i>Modifier une oeuvre
                    </button>
                </li>
                <li>
                    <button>
                        <i class="fa fa-trash" aria-hidden="true" class="icone"></i>Supprimer une oeuvre
                    </button>
                </li>
            </ul>
        </li>
        <li><a href="#">Blog</a>
            <ul>
                <li>
                    <button>
                        <i class="fa fa-plus" aria-hidden="true" class="icone"></i>Écrire un nouvel article
                    </button>
                </li>
                <li>
                    <button>
                        <i class="fa fa-pencil" aria-hidden="true" class="icone"></i>Modifier un article
                    </button>
                </li>
                <li>
                    <button>
                        <i class="fa fa-trash" aria-hidden="true" class="icone"></i>Supprimer un article
                    </button>
                </li>
            </ul>
        </li>
        <li><a href="#">Événements</a>
            <ul>
                <li>
                    <button>
                        <i class="fa fa-plus" aria-hidden="true" class="icone"></i>Créer un nouvel événement
                    </button>
                </li>
                <li>
                    <button>
                        <i class="fa fa-pencil" aria-hidden="true" class="icone"></i>Modifier un événement
                    </button>
                </li>
                <li>
                    <button>
                        <i class="fa fa-trash" aria-hidden="true" class="icone"></i>Supprimer un événement
                    </button>
                </li>
            </ul>
        </li>
        <li><a href="#">Commentaires</a>
            <ul>
                <li>
                    <button><i class="fa fa-eye" aria-hidden="true"></i>Approuver les commentaires</button>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<main id="container">
    <!-- Changer le titre en fonction de la categorie cliquee dans la main_nav -->
    <h1>
        <?php
        echo 'Bienvenue Christine'
        ?>
    </h1>
    <div id="wrapper">
        <!-- Galerie -->
        <section id="galery_add">
            <form action="" method="post">
                <textarea></textarea>
            </form>
        </section>
        <section id="galery_modify"></section>
        <section id="galerie_delete"></section>
        <!-- Blog -->
        <section id="article_write"></section>
        <section id="article_modify"></section>
        <section id="article_delete"></section>
        <!-- Evenements -->
        <section id="event_create"></section>
        <section id="event_modify"></section>
        <section id="event_delete"></section>
        <!-- Commentaires -->
        <section id="comment_approve"></section>
    </div>
</main>
</body>
