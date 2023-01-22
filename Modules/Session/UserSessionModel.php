<?php

class UserSessionModel
{

    public function isUserActive($I_id)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT DISABLED FROM USER WHERE ID=:id");
        $stmt->bindParam("id", $I_id);
        $stmt->execute();
        
        $row = $stmt->fetch();
        if ($row === false) return false;
        return $row["DISABLED"] !== 1;
    }

    public function isUserAdmin($I_id)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT ADMIN FROM USER WHERE ID=:id");
        $stmt->bindParam("id", $I_id);
        $stmt->execute();
        
        $row = $stmt->fetch();
        if ($row === false) return false;
        return $row["ADMIN"] === 1;
    }

}
