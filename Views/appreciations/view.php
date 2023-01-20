<?php
$appreciations = array(
    array(
        "NAME" => "test",
        "PROFILE_IMG" => "1.jpg",
        "COMMENT" => "j'me présente, je m'appelle henry",
        "NOTE" => "2",
        "DATE" => DATE("2020-07-08")
    ),
    array(
        "NAME" => "test",
        "PROFILE_IMG" => "1.jpg",
        "COMMENT" => "j'me présente, je m'appelle henry",
        "NOTE" => "2",
        "DATE" => DATE("2020-07-08")
    ),
    array(
        "NAME" => "test",
        "PROFILE_IMG" => "1.jpg",
        "COMMENT" => "j'me présente, je m'appelle henry",
        "NOTE" => "2",
        "DATE" => DATE("2020-07-08")
    ),
    array(
        "NAME" => "AAAA",
        "PROFILE_IMG" => "/static/img/recipes/1.jpg",
        "COMMENT" => "j'me présente, je m'appelle henry",
        "NOTE" => "2",
        "DATE" => DATE("2020-07-08")
    ),
);
?>


<section>
    <h1> Appréciations: </h1>
    <form method="POST" action="/">
        <label for="comment">Entrez votre commentaire :</label>
        <input type="text" name="comment" id="comment" placeholder="Commentaire">

        <label for="note">Laissez une note :</label>
        <input type="radio" name="note" id="note" value="0"> 0
        <input type="radio" name="note" id="note" value="1" title="1"> 1
        <input type="radio" name="note" id="note" value="2" title="2"> 2
        <input type="radio" name="note" id="note" value="3" title="3" required> 3
        <input type="radio" name="note" id="note" value="4" title="4"> 4
        <input type="radio" name="note" id="note" value="5" title="5"> 5

        <input type="submit" value="Envoyer">
    </form>

    <?php
        foreach ($appreciations as $appreciation){
            View::show("appreciations/appreciation", $appreciation);
        }
    ?>
</section>