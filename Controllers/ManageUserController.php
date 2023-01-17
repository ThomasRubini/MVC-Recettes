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

    public function defaultAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        self::admin_or_die();
    }

    public function searchAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        
    }
}
