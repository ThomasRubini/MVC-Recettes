<?php
$array_header = array(
    '<img src="/static/img/logo.png" alt="Logo">' => "/",
    "Catégories" => "/category",
    "Nouvelle recette" => "/recipe/new",
    "Recherche" => "rechercher",
    '<img src="/static/img/default_user.svg" type="image/svg+xml">' => "/user/view"
);
?>
<header>
    <nav>
        <ul>
            <?php
                foreach ($array_header as $key => $value) {
                    echo '<li><a href="'.$value.'">'.$key.'</a></li>';
                }
            ?>
        </ul>
    </nav>
</header>
