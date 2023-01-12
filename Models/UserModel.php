<?php

final class UserModel
{

    public function getNameByID($I_id)
    {
        if ($I_id == 1) {
            return "Thomas";
        } else {
            return null;
        }
    }
}
