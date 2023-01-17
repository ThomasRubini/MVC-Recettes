<?php

final class ManageUserController
{

    public static function admin_or_die(){
        Session::login_or_die();

        $O_userModel = new UserModel();
        if (!$O_userModel->isUserAdmin($_SESSION["ID"])) {
            header("Location: /");
            die();
        }
    }

    private function getOrDie($DICT, $key)
    {
        if (isset($DICT[$key])) return $DICT[$key];
        else die("Key $key not present");
    }

    public function defaultAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        self::admin_or_die();

        return View::show("manageUser/default");
    }

    public function searchAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        self::admin_or_die();
        $S_search = self::getOrDie($_POST, "search");
        echo "Terme de recherche choisi: $S_search";
    }
}
