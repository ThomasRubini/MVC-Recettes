<?php

final class ManageUserController
{

    private function getOrDie($DICT, $key)
    {
        if (isset($DICT[$key])) return $DICT[$key];
        else die("Key $key not present");
    }

    public function defaultAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        Session::admin_or_die();

        return View::show("manageUser/default");
    }

    public function searchAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        Session::admin_or_die();
        
        $S_search = self::getOrDie($_POST, "search");
        echo "Terme de recherche choisi: $S_search";
    }
}
