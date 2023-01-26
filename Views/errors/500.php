<main class="errorPage">
    <h1>Erreur 500</h1>
    <h2>Erreur interne du serveur 😥</h2>
    <?php
    if (isset($A_view)) {
        echo '<p>Message d\'erreur&nbsp;: ' . $A_view .'</p>';
    }
    ?>
    <a href="/">Retourner à l'accueil<a>
</main>
