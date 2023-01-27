<?php
$O_recipe = $A_view["RECIPE"];
?>
<section class="apprecitations">
    <h2> Appréciations: </h2>
    <form method="POST" action="/appr/create">
        <label for="comment">Ajoutez un commentaire :</label>
        <textarea type="text" name="comment" id="comment" placeholder="Votre commentaire"></textarea>

        <section class="appreciationNoteValue">
            <label for="note">Laissez une note :</label>
            <input type="radio" name="note" id="note" value="0"> 0
            <input type="radio" name="note" id="note" value="1" title="1"> 1
            <input type="radio" name="note" id="note" value="2" title="2"> 2
            <input type="radio" name="note" id="note" value="3" title="3" required> 3
            <input type="radio" name="note" id="note" value="4" title="4"> 4
            <input type="radio" name="note" id="note" value="5" title="5"> 5
        </section>
        <input type="hidden" name="recipe_id" value="<?= $O_recipe->I_ID ?>">

        <input type="submit" value="Envoyer">
    </form>

    <?php
        foreach ($O_recipe->getApprs() as $O_appr){
            View::show("appreciations/view_single", array(
                "ADMIN" => $A_view["ADMIN"],
                "USER_ID" => $A_view["USER_ID"],
                "APPR" => $O_appr
            ));
        }
    ?>
</section>
