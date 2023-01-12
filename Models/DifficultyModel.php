<?php

final class DifficultyModel
{

    public function getByID($I_difficuly_id)
    {
        if ($I_difficuly_id == 1) {
            return "Facile";
        } else {
            return null;
        }
    }
}
