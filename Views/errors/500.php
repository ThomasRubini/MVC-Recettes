<main class="error_main">
    <h1 class="error_code_title">Erreur 500</h1>
    <h2 class="error_code_description">Erreur interne du serveur 😥</h2>
    <?php
    if (isset($A_view)) {
        echo '<p class="error_message">Message d\'erreur&nbsp;: ' . $A_view .'</p>';
    }
    ?>
    <a href="/">Retourner à l'accueil<a>
</main>
