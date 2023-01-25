<header>
    <nav>
        <ul>
            <li><a href="/">
                <img src="/static/img/logo.png" alt="Logo">
            </a></li>
            <li><a href="/category">Catégories</a></li>
            <?php if (Session::is_login()) { ?>
            <li><a href="/recipe/new">Nouvelle recette</a></li>
            <?php } ?>
            <li><a href="/recipe/search">Rechercher</a></li>
            <li><a href="/user/view">
                <img src="/static/img/default_user.svg" type="image/svg+xml">
            </a></li>
            
        </ul>
    </nav>
</header>
