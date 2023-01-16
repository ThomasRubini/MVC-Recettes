<?php
    $array_account = array(
        "username" => "Jean_Michel_du_13",
        "email" => "jeanmicheldu13@gmail.com"
    );
?>

<main>
    <a href="/disconnect">Se déconnecter</a>

    <form action="/account/disconnect" method="post">
        <label for="profilPicture">Changer l'image de profil&nbsp;</label>
        <input type="file" name="profilPicture" id="profilPicture" accept="image/*">

        <label for="username">Changer le nom d'utilisateur&nbsp;</label>
        <input type="text" name="username" id="username" placeholder="<?= $array_account["username"] ?>">

        <label for="email">Changer d'e-mail&nbsp;</label>
        <input type="email" name="email" id="email" placeholder="<?= $array_account["email"] ?>">

        <button type="button">Enregistrer</button>
    </form>

    <hr>

    <a href="/account/delete">Supprimer le compte ⚠️</a>

</main>
