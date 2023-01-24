<?php
$username_requested = $A_view["QUERY"];
$user_accounts_results = $A_view["RESULTS"];
?>
<main>
    <h1 class="accounts_management_title">Gestion de comptes</h1>
    <form method="GET" action="manage_users">
        <label for="username">Saisissez un nom d'utilisateur</label>
        <input type="search" id="username" name="query" placeholder="Nom de l'utilisateur">
    </form>
    <section>
        <?php
        if ($username_requested === null) {
            echo '<h2 class="username_required_title">Nom d\'utilisateur requis</h2>
        <p class="username_required_description">Un nom d\'utilisateur est requis pour gérer des utilisateurs.</p>';
        } else {
            echo '<h3 class="username_searched">' . $username_requested . '</h3>';
            if (empty($user_accounts_results)) {
                echo '<h2 class="no_user_results_title">Aucun résultat</h2>
            <p class="no_user_results_description">Vérifiez l\'orthographe et la casse de votre saisie.</p>';
            } else {
                echo '<ul class="user_account_list">';

                foreach ($user_accounts_results as $key => $user_account_result) {
                    $user_account_name = $user_account_result["NAME"];
                    echo '<li class="user_account" data-id="' . $user_account_result["USER_ID"] . '">
                <img class="user_acccount_picture" src=' . $user_account_result["AVATAR"] . ' alt="Photo de profil de ' . $user_account_name . '">
                <h3 class="user_account_name">' . $user_account_name . '</h3>
                </li>';
                }

                echo '</ul>
            <form method="POST" action="manage_users">
                <input id="accounts_to_manage" type="text" hidden>
                <input type="submit" name="enable" value="Activer">
                <input type="submit" name="disable" value="Désactiver">
                <input type="submit" value="Supprimer">
            </form>';
            }
        }
        ?>
    </section>
</main>
