<?php
// Demarrage d'une session
if (!isset($_SESSION)) {
    session_start();
}
?>

<nav>
    <!-- Icones des reseaux sociaux -->
    <div></div>
    <!-- Recherche -->
    <form action="" method="get">
        <label></label>
        <input type="search" id="search" name="search"/>
        <input type="submit"/>
    </form>
    <!-- Favoris -->
    <i class="fa fa-heart" aria-hidden="true"></i></li>
</nav>