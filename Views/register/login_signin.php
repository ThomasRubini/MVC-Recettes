<main>
    <section>
        <form method="POST" action="/user/login">
            <input type="email" name="email" id="email" placeholder="Email" required>
            <input type="password" name="password" id="password" placeholder="Mot de passe" required>
            <input type="submit" value="Envoyer">
        </form>
    </section>
    <section>
        <form method="POST" action="/user/register" id="signin">
            <input type="email" name="email" id="email" placeholder="Email" required>
            <input type="text" name="username" id="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" id="password" placeholder="Mot de passe" required>
            <input type="password" name="password_confirm" id="password_confirm" placeholder="Confirmer le mot de passe" required>
            <input type="submit" value="Envoyer">
        </form>
    </section>
</main>