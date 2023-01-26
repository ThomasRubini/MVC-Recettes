<?php
    if (isset($A_view["errmsg"])){
        echo "<p class=\"inMainRegisterPage\"> Error: {$A_view["errmsg"]} </p>";
    }
?>
<main class="registerPage">
    <section>
        <form class="registerForm" method="POST" action="/user/signin">
            <h2>Connexion</h2>
            <label for="email">Entrez votre email</label>
            <input type="email" name="email" id="email" placeholder="Email" required>
            <label for="password">Entrez votre mot de passe</label>
            <input type="password" name="password" id="passzword" placeholder="Mot de passe" required>
            <input type="hidden" name="return_uri" value="<?= $A_view["return_uri"] ?>">
            <input type="submit" value="Envoyer">
        </form>
    </section>
    <hr>
    <section>
        <form class="registerForm" method="POST" action="/user/signup" id="signin">
            <h2>Inscription</h2>
            <label for="email">Entrez votre email</label>
            <input type="email" name="email" id="email" placeholder="Email" required>
            <label for="text">Entrez votre nom d'utilisateur</label>
            <input type="text" name="username" id="username" placeholder="Nom d'utilisateur" required>
            <label for="password">Entrez votre mot de passe</label>
            <input type="password" name="password" id="password" placeholder="Mot de passe" required>
            <label for="password_confirm">Confirmez le mot de passe</label>
            <input type="password" name="password_confirm" id="password_confirm" placeholder="Confirmer le mot de passe" required>
            <input type="hidden" name="return_uri" value="<?= $A_view["return_uri"] ?>">
            <input type="submit" value="Envoyer">
        </form>
    </section>
</main>
