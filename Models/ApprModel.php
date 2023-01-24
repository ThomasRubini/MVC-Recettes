<?php

final class ApprModel {

    public function searchRecipeApprsWithAuthors($I_recipe_id)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("
            SELECT APPRECIATION.*, USER.USERNAME as AUTHOR_NAME,
            CONCAT('/user/profilePic/', APPRECIATION.AUTHOR_ID) AS AUTHOR_IMG_LINK
            FROM APPRECIATION
            JOIN USER ON USER.ID = APPRECIATION.AUTHOR_ID
            WHERE RECIPE_ID = :recipe_id
        ");
        $stmt->bindParam("recipe_id", $I_recipe_id);
        $stmt->execute();

        $rows = $stmt->fetchAll();

        return $rows;
    }

    public function searchRecipeApprs($I_recipe_id)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT * FROM APPRECIATION WHERE RECIPE_ID = :recipe_id");
        $stmt->bindParam("recipe_id", $I_recipe_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function createAppr($I_user_id, $I_recipe_id, $S_Comment, $I_note)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("
            INSERT INTO APPRECIATION (COMMENT,NOTE,DATE,AUTHOR_ID,RECIPE_ID) VALUES (:comment, :note, :date, :author_id, :recipe_id)
        ");
        $stmt->bindParam("comment",$S_Comment);
        $stmt->bindParam("note",$I_note);
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
        $stmt = $O_model->prepare("DELETE FROM APPRECIATION WHERE ID = :appr_id");
        $stmt->bindParam("appr_id", $I_appr_id);
        $stmt->execute();
    }

    public function getApprByID($I_appr_id)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT * FROM APPRECIATION WHERE ID = :appr_id");
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
