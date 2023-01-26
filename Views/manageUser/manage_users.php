<?php $S_query = $A_view["QUERY"]; ?>
<main class="manageUser">
    <h1 class="accounts_management_title">Gestion de comptes</h1>
    <form method="GET" action="/manageUser/search">
        <label for="username">Saisissez un nom d'utilisateur</label>
        <input type="text" id="username" name="query" placeholder="<?= ($S_query == null)? "Nom de l'utilisateur" : "$S_query" ?>">
        <input type="submit" value="Rechercher">
    </form>
    <section>
        <?php
        if ($S_query == null) {
            echo '<h2 class="username_required_title">Nom d\'utilisateur requis</h2>
        <p class="username_required_description">Un nom d\'utilisateur est requis pour gérer des utilisateurs.</p>';
        } else {
            $A_results = $A_view["RESULTS"];
            if (empty($A_results)) {
                echo '<h2 class="no_user_results_title">Aucun résultat</h2>
            <p class="no_user_results_description">Vérifiez l\'orthographe et la casse de votre saisie.</p>';
            } else {
                echo '<ul class="user_account_list">';

                foreach ($A_results as $O_user) {
                    echo '<li class="user_account" data-id="' . $O_user->I_ID . '">
                <img class="user_acccount_picture" src=' . $O_user->getProfilePicLink() . ' alt="Photo de profil de ' . $O_user->S_USERNAME . '">
                <h3 class="user_account_name">' . $O_user->S_USERNAME . '</h3>
                </li>';

                    echo '</ul>
                <form method="POST" action="/manageUser/update">
                    <input type="hidden" name="user_id" value="'.$O_user->I_ID.'" id="accounts_to_manage">
                    <input type="submit" name="enable" value="Activer">
                    <input type="submit" name="disable" value="Désactiver">
                    <input type="submit" name="delete" value="Supprimer">
                </form>';
                }

            }
        }
        ?>
    </section>
</main>
