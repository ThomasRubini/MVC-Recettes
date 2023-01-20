<?php

final class ManageUserController
{

    public function defaultAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        Session::admin_or_die();

        return View::show("manageUser/default");
    }

    public function searchAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        Session::admin_or_die();

        $S_search = Utils::getOrDie($_POST, "search");
        echo "Terme de recherche choisi: $S_search";
    }
}
