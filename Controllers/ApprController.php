<?php

final class ApprController
{

    public function createAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        Session::login_or_die();

        $I_recipe_id = Utils::intOrDie(Utils::getOrDie($A_postParams, "recipe_id"));
        $S_comment = Utils::getOrDie($A_postParams, "comment");
        $I_note = Utils::intOrDie(Utils::getOrDie($A_postParams, "note"));

        $O_appr = new ApprModel($S_comment, $I_note,date("Y-m-d"),$_SESSION["ID"],$I_recipe_id);
        $O_appr->insert();
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }

    public function deleteAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        Session::login_or_die();

        $I_appr_id = Utils::intOrDie($A_urlParams[0]);

        $O_appr = ApprModel::getApprById($I_appr_id);

        if ($O_appr === null) {
            throw new HTTPSpecialCaseException(404);
        }
        
        if ($O_appr->I_AUTHOR_ID !== $_SESSION["ID"]) {
            Session::admin_or_die();
        }

        $O_appr->delete();

        header("Location: ".$_SERVER['HTTP_REFERER']);
    }
}
