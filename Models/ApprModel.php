<?php

final class ApprModel {
    public function getRecipeApprs($I_recipe_id)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT * FROM APPPRECIATION WHERE ID = :recipe_id");
        $stmt->bindParam("recipe_id",$I_recipe_id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function createAppr($I_user_id, $I_recipe_id, $S_Comment, $I_score)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("
            INSERT INTO APPPRECIATION (COMMENT,SCORE,DATE,AUTHOR_ID,RECIPE_ID) VALUES (:comment, :score, :date, :author_id, :recipe_id)
        ");
        $stmt->bindParam("comment",$S_Comment);
        $stmt->bindParam("score",$I_score);
        $_date = date("Y-m-d");
        $stmt->bindParam("date",$_date);
        $stmt->bindParam("author_id",$I_user_id);
        $stmt->bindParam("recipe_id",$I_recipe_id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function deleteAppr($I_appr_id)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("DELETE FROM APPPRECIATION WHERE ID = :appr_id");
        $stmt->bindParam("appr_id", $I_appr_id);
        $stmt->execute();
    }

    public function getApprByID($I_appr_id)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT * FROM APPPRECIATION WHERE ID = :appr_id");
        $stmt->bindParam("appr_id", $I_appr_id);
        $stmt->execute();

        $row = $stmt->fetch();
        if ($row === false) return null;
        return $row;
    }

    public function updateAppreciation($I_appr_id)
    {

    }
}
