<?php
    if (isset($A_view["errmsg"])){
        echo "<p> Error: {$A_view["errmsg"]} </p>";
    }
?>
<main>
    <section>
        <form method="POST" action="/user/signin">
            <label for="email">Entrez votre email</label>
            <input type="email" name="email" id="email" placeholder="Email" required>
            <label for="password">Entrez votre mot de passe</label>
            <input type="password" name="password" id="password" placeholder="Mot de passe" required>
            <input type="hidden" name="return_uri" value="<?= $A_view["return_uri"] ?>">
            <input type="submit" value="Envoyer">
        </form>
    </section>
    <hr>
    <section>
        <form method="POST" action="/user/signup" id="signin">
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