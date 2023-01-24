<?php

final class ApprController
{

    public function createAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        Session::login_or_die();

        $I_recipe_id = Utils::intOrDie(Utils::getOrDie($A_postParams, "recipe_id"));
        $S_comment = Utils::getOrDie($A_postParams, "comment");
        $I_score = Utils::intOrDie(Utils::getOrDie($A_postParams, "score"));

        $O_apprModel = new ApprModel();
        $O_apprModel->createAppr($_SESSION["ID"], $I_recipe_id, $S_comment, $I_score);
        
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }

    public function deleteAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        Session::login_or_die();

        $I_appr_id = Utils::intOrDie($A_urlParams[0]);

        $O_apprModel = new ApprModel();
        $A_appr = $O_apprModel->getApprById($I_appr_id);

        if ($A_appr === null) {
            throw new HTTPSpecialCaseException(404);
        }
        
        if ($A_appr["AUTHOR_ID"] !== $_SESSION["ID"]) {
            Session::admin_or_die();
        }

        $O_apprModel->deleteAppr($I_appr_id);

        header("Location: ".$_SERVER['HTTP_REFERER']);
    }
}
