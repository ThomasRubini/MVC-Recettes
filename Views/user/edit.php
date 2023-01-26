<?php
$O_user = $A_view["USER"];
?>
<main>

    <?php
        if ($O_user->B_ADMIN) {
            echo "<p>Compte administrateur</p>";
            echo "<a href='/manageUser'>Gestion des utilisateurs</a>";
        }
    ?>

    <a href="/user/logout">Se déconnecter</a>

    <form class="userForm" action="/user/update" method="post" enctype="multipart/form-data">
        <label for="profilPicture">Changer l'image de profil&nbsp;</label>
        <input type="file" name="profilPicture" id="profilPicture" accept="image/*">

        <label for="username">Changer le nom d'utilisateur&nbsp;</label>
        <input type="text" name="username" id="username" placeholder="<?= $O_user->S_USERNAME ?>">

        <label for="email">Changer d'e-mail&nbsp;</label>
        <input type="email" name="email" id="email" placeholder="<?= $O_user->S_EMAIL ?>">

        <input type="submit" value="Enregistrer">
    </form>

    <hr>

    <a href="/user/delete">Supprimer le compte ⚠️</a>

</main>
