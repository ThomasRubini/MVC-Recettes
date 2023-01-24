<?php
$array_header = array(
    '<img src="/static/img/logo.png" alt="Logo">' => "/",
    "Recette" => "/Recipe/view/36",
    "+" => "/recipe/new",
    "Rechercher" => "rechercher",
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
