<?php

final class UserModel
{

    public function getNameByID($I_id)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT NAME FROM USER WHERE ID=:id");
        $stmt->bindParam("id", $I_id);
        $stmt->execute();
        
        $row = $stmt->fetch();
        if ($row === false) return null;
        return $row["NAME"];
    }
}
