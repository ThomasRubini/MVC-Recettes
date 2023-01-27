<?php
    $O_appr = $A_view["APPR"];
?>

<section>
    <header>
        <img src="<?= $O_appr->getAuthorOrAnon()->getProfilePicLink() ?>" alt="profile picture">
        <h3> <?= $O_appr->getAuthorOrAnon()->S_USERNAME ?> </h3>
        <p>Le <?= $O_appr->S_DATE ?> </p>
        <p> <?= $O_appr->I_NOTE ?>/5 </p>
        <?php
        $B_can_delete = (
            $A_view["ADMIN"] ||
            ($A_view["USER_ID"] === $O_appr->I_AUTHOR_ID && $O_appr->I_AUTHOR_ID !== null)
        );
        if ($B_can_delete) { ?>
            <a href="/appr/delete/<?= $O_appr->I_ID ?>">Supprimer l'appréciation</a>
        <?php } ?>
    </header>
    <p> <?= $O_appr->S_COMMENT ?> </p>
</section>
