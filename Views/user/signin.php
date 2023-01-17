<p>
    <?php
    if ($A_view["success"]) {
        echo "Authentifié avec succès !";
    } else {
        echo "Authentification échouée. Raison : ".$A_view["msg"];
    }
    ?>
</p>