<?php
    $array_recette = array(
        "imageRecette" => "/static/img/recettes/36.jpg",
        "nomRecette" => "Croissant",
        "descriptionRecette" => "C’est l’incontournable de la boulangerie française, avec sa croûte dorée et croustillante à l'extérieur et sa mie moelleuse et aérienne à l'intérieur. Il est souvent garni de beurre, ce qui lui donne un goût riche et délicieux. Il est idéal pour le petit-déjeuner ou pour un en-cas de fin de matinée accompagné d'un bon café ou d'un chocolat chaud.",
        "tempsCuisson" => "1h30",
        "typeCuisson" => "au four",
        "Contient" => "gluten, lactose",
        "ingredients" => ["500g de farine", "7g de sel", "70g de sucre", "25g de levure fraiche", "250ml de lait", "250g de beurre"],
        "preparation" => [
            "Dans un grand bol, mélanger la farine, le sel et le sucre. Creuser un puits au milieu et y casser la levure. Ajouter petit à petit le lait tiède, en mélangeant jusqu'à l'obtention d'une pâte lisse.",
            "Laisser reposer la pâte dans un endroit chaud pendant 1 heure, ou jusqu'à ce qu'elle double de volume.",
            "Etaler la pâte en un grand rectangle. Étaler le beurre entre 2 feuilles de papier sulfurisé pour en faire un rectangle de la même taille que la pâte. Placer le beurre sur la moitié inférieure de la pâte, en laissant 1 cm de bord libre. Rabattre la partie supérieure de la pâte sur le beurre, en appuyant légèrement sur les bords pour les sceller.",
            "Etaler la pâte en un grand rectangle de nouveau, en veillant à ne pas faire sortir le beurre. Plier la pâte en 3, en superposant les bords inférieur et supérieur sur le milieu. Tourner la pâte de 90 degrés, et étaler de nouveau en un grand rectangle. Plier de nouveau en 3. Réfrigérer la pâte pendant 1 heure.",
            "Etaler la pâte en un grand rectangle encore une fois, en veillant à ne pas faire sortir le beurre. Découper des triangles égaux en utilisant un rouleau à pâtisserie ou un couteau. Rouler chaque triangle de la base vers le pointe pour former des croissants.",
            "Laisser lever les croissants pendant 30 minutes à 1 heure, jusqu'à ce qu'ils aient doublé de volume.",
            "Préchauffer le four à 220 degrés C (thermostat 7).",
            "Badigeonner les croissants d'un peu de lait et les faire cuire pendant 20 minutes environ jusqu'à ce qu'ils soient dorés."],
    );
?>

<main>

    <img src="<?= $array_recette["imageRecette"] ?>" alt="Image d'illustration de la recette">

    <section class="infosRecette">
        <header>
            <h1><?= $array_recette["nomRecette"] ?></h1>
            <p>
                <?= $array_recette["tempsCuisson"] ?> —
                Cuisson : <?= $array_recette["typeCuisson"] ?> —
                Contient : <?= $array_recette["Contient"] ?>
            </p>
        </header>
        <p><?= $array_recette["descriptionRecette"] ?></p>
    </section>

    <section class="ingredientsRecette">
        <h2>Ingrédients</h2>
        <ul>
            <?php
                foreach($array_recette["ingredients"] as $ingredient)
                    echo "<li>".$ingredient."</li>";
            ?>
        </ul>
    </section>

    <section>
        <h2>Préparation</h2>
        <ol>
            <?php
                foreach($array_recette["preparation"] as $instructions)
                    echo "<li>".$instructions."</li>";
            ?>
        </ol>
    </section>

</main>
