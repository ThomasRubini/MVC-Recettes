<?php

final class ApprController
{

    public function createAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        Session::login_or_die();

        $I_recipe_id = Utils::getOrDie($A_postParams, "recipe_id");
        $S_comment = Utils::getOrDie($A_postParams, "comment");
        $I_score = Utils::getOrDie($A_postParams, "score");


        $O_apprModel = new ApprModel();
        $O_apprModel->createAppr($_SESSION["ID"], $I_recipe_id, $S_comment, $I_score);

    }

    public function deleteAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        Session::admin_or_die();

        $I_appr_id = $A_urlParams[0];

        $O_apprModel = new ApprModel();

        $O_apprModel->deleteAppr($I_appr_id);

        echo "Appreciation $I_appr_id supprimée avec succès";
    }
    

}