<?php

final class RecipeModel
{

    public function getByID($I_id)
    {
        if ($I_id == 36) {
            return array(
                "id" => 36,
                "name" => "Ma recette num 36",
                "desc" => "Une brève description de la recette 36",
                "recipe" => "Etape 1\nEtape 2\nEtape 3",
                "difficulty_id" => 1,
                "author_id" => 1,
            );
        } else {
            return null;
        }
    }
}
