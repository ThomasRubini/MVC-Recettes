<main>

    <?php if($A_view["ADMIN"]) echo "<p>Compte administrateur</p>"; ?>

    <a href="/user/logout">Se déconnecter</a>

    <form action="/user/update" method="post">
        <label for="profilPicture">Changer l'image de profil&nbsp;</label>
        <input type="file" name="profilPicture" id="profilPicture" accept="image/*">

        <label for="username">Changer le nom d'utilisateur&nbsp;</label>
        <input type="text" name="username" id="username" placeholder="<?= $A_view["USERNAME"] ?>">

        <label for="email">Changer d'e-mail&nbsp;</label>
        <input type="email" name="email" id="email" placeholder="<?= $A_view["EMAIL"] ?>">

        <button type="button">Enregistrer</button>
    </form>

    <hr>

    <a href="/user/delete">Supprimer le compte ⚠️</a>

</main>
