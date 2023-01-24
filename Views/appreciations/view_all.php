<section>
    <h1> Appréciations: </h1>
    <form method="POST" action="/appr/create">
        <label for="comment">Entrez votre commentaire :</label>
        <input type="text" name="comment" id="comment" placeholder="Commentaire">

        <label for="note">Laissez une note :</label>
        <input type="radio" name="note" id="note" value="0"> 0
        <input type="radio" name="note" id="note" value="1" title="1"> 1
        <input type="radio" name="note" id="note" value="2" title="2"> 2
        <input type="radio" name="note" id="note" value="3" title="3" required> 3
        <input type="radio" name="note" id="note" value="4" title="4"> 4
        <input type="radio" name="note" id="note" value="5" title="5"> 5

        <input type="hidden" name="recipe_id" value="<?= $A_view["ID"] ?>">

        <input type="submit" value="Envoyer">
    </form>

    <?php
        foreach ($A_view["APPRS"] as $A_appr){
            $A_appr["SHOW_REMOVE_BUTTON"] = $A_view["ADMIN"];
            View::show("appreciations/view_single", $A_appr);
        }
    ?>
</section>
