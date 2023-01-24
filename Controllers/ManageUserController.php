<?php

final class ManageUserController
{

    public function defaultAction(Array $A_urlParams = null, Array $A_postParams = null, Array $A_getParams = null)
    {
        Session::admin_or_die();

        self::searchAction($A_urlParams, $A_postParams, $A_getParams);
    }

    public function searchAction(Array $A_urlParams = null, Array $A_postParams = null, Array $A_getParams = null)
    {
        Session::admin_or_die();

        if (isset($A_getParams["query"])) {
            self::searchQueryViewAction($A_urlParams, $A_postParams, $A_getParams);
        } else {
            self::searchViewAction($A_urlParams, $A_postParams, $A_getParams);
        }
    }
    
    private function searchViewAction(Array $A_urlParams = null, Array $A_postParams = null, Array $A_getParams = null)
    {
        Session::admin_or_die();

        View::show("manageUser/manage_users", array("QUERY" => null));
    }
    
    private function searchQueryViewAction(Array $A_urlParams = null, Array $A_postParams = null, Array $A_getParams = null)
    {
        Session::admin_or_die();

        $S_query = $A_getParams["query"];

        $A_results = UserModel::searchUsers($S_query);

        View::show("manageUser/manage_users", array(
            "QUERY" => $S_query,
            "RESULTS" => $A_results)
        );
    }

    public function updateAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        Session::admin_or_die();

        $I_user_id = Utils::intOrDie(Utils::getOrDie($A_postParams, "user_id"));
        $O_user = UserModel::getByID($I_user_id);

        if (isset($A_postParams["enable"])) {
            $O_user->B_DISABLED = false;
            $O_user->update();
        }else if (isset($A_postParams["disable"])) {
            $O_user->B_DISABLED = true;
            $O_user->update();
        }else if (isset($A_postParams["delete"])) {
            $O_user->delete();
        }

        header("Location: ".$_SERVER['HTTP_REFERER']);
    }

}
