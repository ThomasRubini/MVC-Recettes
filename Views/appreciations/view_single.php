<section>
    <header>
        <img src="<?= $A_view["AUTHOR_IMG_LINK"] ?>" alt="profile picture">
        <h3> <?= $A_view["AUTHOR_NAME"] ?> </h3>
        <p> <?= $A_view["NOTE"] ?> </p>
        <p> <?= $A_view["DATE"] ?> </p>
        <?= $A_view["SHOW_REMOVE_BUTTON"]===true? "<a href=/appr/delete/".$A_view["ID"].">Supprimer l'appréciation</a>" : "" ?>
    </header>
    <p> <?= $A_view["COMMENT"] ?> </p>
</section>