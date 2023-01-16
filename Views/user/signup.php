<p>
    <?php
    if ($A_view["success"]) {
        echo "Compte créé avec succès";
    } else {
        echo "La création de compte à échoué. Raison : ".$A_view["msg"];
    }
    ?>
</p>