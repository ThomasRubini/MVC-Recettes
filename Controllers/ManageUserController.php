<?php

final class ManageUserController
{

    public function defaultAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        Session::admin_or_die();

        return View::show("manageUser/search");
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

    }
    
    private function searchQueryViewAction(Array $A_urlParams = null, Array $A_postParams = null, Array $A_getParams = null)
    {
        $S_query = $A_getParams["query"];

        $O_userModel = new UserModel();
        $A_results = $O_userModel->searchUsers($S_query);

        var_dump($A_results);

        echo "Terme de recherche choisi: $S_query";
    }

}
