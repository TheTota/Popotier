<?php

namespace src\services;


use src\models\RecipeEntity;



class RecipeService
{

	private $db;

    public static function fetchAll()
    {
        $db = DataBaseService::getInstance()->getDb();

        $recipes = $db->query('SELECT * FROM Recette');

        return self::createRecipeArray($recipes);
    }

    public static function findById($id): ?RecipeEntity
    {
        $db = DataBaseService::getInstance()->getDb();

        $recipe = $db->query("SELECT * FROM Recette WHERE id = '$id'")->fetch();

        if (!$recipe){
            return null;
        } else {
            return new RecipeEntity(
                $recipe['id'],
                $recipe['nom'],
                $recipe['image'],
                $recipe['date_creation'],
                $recipe['temps_cuisson'],
                $recipe['temps_preparation'],
                $recipe['nb_personnes'],
                $recipe['difficulte'],
                $recipe['prix_moyen'],
                $recipe['note_auteur'],
                $recipe['valide'],
                UserService::findById($recipe['id_auteur']),
                TypeService::findById($recipe['id_type']),
                ($recipe['id_admin'] == null) ? null : UserService::findById($recipe['id_admin']),
                StepService::findByRecette($recipe['id']),
                IngredientRecipeService::findAllByRecipe($recipe['id'])
            );
        }
    }

    public static function update(RecipeEntity $recipe)
    {
        $db = DataBaseService::getInstance()->getDb();

        $statement = $db->prepare("UPDATE Recette SET 
            nom = ?,
            image = ?,
            temps_cuisson = ?, 
            temps_preparation = ?,
            nb_personnes = ?,
            difficulte = ?,
            prix_moyen = ?,
            note_auteur = ?,
            valide = ?,
            id_type = ?,
            id_admin = ?
            
            WHERE id = ?
        ");

        $response = $statement->execute([
            $recipe->getName(),
            $recipe->getImage(),
            $recipe->getCookingTime(),
            $recipe->getPreparationTime(),
            $recipe->getPersonNumber(),
            $recipe->getDifficulty(),
            $recipe->getMeanPrice(),
            $recipe->getAuthorQuote(),
            $recipe->getValid(),
            $recipe->getType()->getId(),
            $recipe->getAdmin()->getEmail(),
            $recipe->getId()
        ]);

        if($response){
            return true;
        } else {
            return new \PDOException();
        }
    }

    public static function delete(RecipeEntity $id){
        $db = DataBaseService::getInstance()->getDb();
        $req = $db->exec("DELETE FROM Recette WHERE id=". $id );
    }

    public static function deleteByID($id){
        $db = DataBaseService::getInstance()->getDb();
        $req = $db->exec("DELETE FROM Recette WHERE id=". $id );
    }

    public static function findByValidation($validated): array
    {
        $db = DataBaseService::getInstance()->getDb();

        $recipes = $db->query("SELECT * FROM Recette WHERE valide = '$validated'");

        return self::createRecipeArray($recipes);
    }

    public static function add(RecipeEntity $recipe){
        $db = DataBaseService::getInstance()->getDb();
        $req = $db->prepare("INSERT INTO Recette (
							nom,
							image,
							temps_cuisson,
							temps_preparation,
							nb_personnes,
							difficulte,
							prix_moyen,
							note_auteur, 
							id_auteur,
							valide,
							id_type
							) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
        $req->execute([
            $recipe->getName(),
            $recipe->getImage(),
            $recipe->getCookingTime(),
            $recipe->getPreparationTime(),
            $recipe->getPersonNumber(),
            $recipe->getDifficulty(),
			$recipe->getMeanPrice(),
            $recipe->getAuthorQuote(),
            $recipe->getAuthor()->getId(),
			$recipe->getValid(),
            $recipe->getType()->getId()
        ]);

    }

    public static function fetchAllUserFavoriteRecipe($userId){
        $db = DataBaseService::getInstance()->getDb();
        $recipes = $db->query("SELECT * FROM Recette INNER JOIN Utilisateur_Like_Recette ON Recette.id = Utilisateur_Like_Recette.id_recette WHERE id_utilisateur = '$userId'");

        return self::createRecipeArray($recipes);
    }

    public static function fetchAllUserFavoriteRecipePaginated($userId, $page = null){
        $db = DataBaseService::getInstance()->getDb();
        $recipePerPage = 2;
        if( $page == null){
            $recipes = $db->query("SELECT * FROM Recette INNER JOIN Utilisateur_Like_Recette ON Recette.id = Utilisateur_Like_Recette.id_recette WHERE id_utilisateur = '$userId' LIMIT ".$recipePerPage);
        } else {
            $limit = ($page - 1) * $recipePerPage;
            $recipes = $db->query("SELECT * FROM Recette INNER JOIN Utilisateur_Like_Recette ON Recette.id = Utilisateur_Like_Recette.id_recette WHERE id_utilisateur = '$userId' LIMIT ".$limit.", ".$recipePerPage);
        }

        return self::createRecipeArray($recipes);
    }

    public static function fetchAllUserRecipe($userEmail){
        $db = DataBaseService::getInstance()->getDb();
        $recipes = $db->query("SELECT * FROM Recette WHERE id_auteur='" . $userEmail . "'");

        return self::createRecipeArray($recipes);
    }

    public static function fetchAllUserRecipePaginated($userId, $page = null){
        $db = DataBaseService::getInstance()->getDb();
        $recipePerPage = 2;

        if($page == null){
            $recipes = $db->query("SELECT * FROM Recette WHERE id_auteur='" . $userId . "' LIMIT ". $recipePerPage ." ");
        }else{
            $limit = ($page - 1) * $recipePerPage;
            $recipes = $db->query("SELECT * FROM Recette WHERE id_auteur='" . $userId . "' LIMIT ". $limit .", ".$recipePerPage." ");
        }

        return self::createRecipeArray($recipes);
    }

    public static function countUserRecipes($userEmail){
        $db = DataBaseService::getInstance()->getDb();

        return $db->query("SELECT COUNT(*) AS userRecipeCount FROM Recette WHERE id_auteur='" . $userEmail . "'")->fetch()[0];
    }

    public static function countUserLikedRecipes($userId) {
        $db = DataBaseService::getInstance()->getDb();

        return $db->query("SELECT COUNT(*) AS userLikedRecipeCount FROM Recette INNER JOIN Utilisateur_Like_Recette ON Recette.id = Utilisateur_Like_Recette.id_recette WHERE id_utilisateur = '$userId'")->fetch()[0];
    }

    private static function createRecipeArray(\PDOStatement $recipes): array
    {
        $recipesArray = array();
        foreach ($recipes as $recipe) {
            array_push(
                $recipesArray,
                new RecipeEntity(
                    $recipe['id'],
                    $recipe['nom'],
                    $recipe['image'],
                    $recipe['date_creation'],
                    $recipe['temps_cuisson'],
                    $recipe['temps_preparation'],
                    $recipe['nb_personnes'],
                    $recipe['difficulte'],
                    $recipe['prix_moyen'],
                    $recipe['note_auteur'],
                    $recipe['valide'],
                    UserService::findById($recipe['id_auteur']),
                    TypeService::findById($recipe['id_type']),
                    ($recipe['id_admin'] == null) ? null : UserService::findByEmail($recipe['id_admin']),
                    StepService::findByRecette($recipe['id']),
                    null
                )
            );
        }
        return $recipesArray;
    }

    public static function likeRecipe($userId, $recipeId) {
        $db = DataBaseService::getInstance()->getDb();

        $request = $db->prepare("INSERT INTO Utilisateur_Like_Recette (id_utilisateur, id_recette) VALUES (:userId, :recipeId)");

        $data = [
            'userId' => $userId,
            'recipeId' => $recipeId
        ];

        $request->execute($data);
    }

    public static function dislikeRecipe($userId, $recipeId) {
        $db = DataBaseService::getInstance()->getDb();
        $db->exec("DELETE FROM Utilisateur_Like_Recette WHERE id_utilisateur = '$userId' AND id_recette = '$recipeId'");
    }

    /**
     * Returns whether or not the given recipe is liked by the given use.
     *
     * @param $userId
     * @param $recipeId
     * @return bool
     */
    public static function recipeIsLiked($userId, $recipeId) {
        $db = DataBaseService::getInstance()->getDb();

        $result = $db->query("SELECT * FROM Utilisateur_Like_Recette WHERE id_utilisateur = '$userId' AND id_recette = '$recipeId'")->fetch();
        if ($result == false) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param $name
     * @return array|null
     * Return all the recipe that contain the string send in param in their name
     */
    public static function searchByName($name) {
        $db = DataBaseService::getInstance()->getDb();

        $recipes = $db->query("SELECT * FROM Recette WHERE nom LIKE '%$name%' AND valide = 1");

        if($recipes){
            return self::createRecipeArray($recipes);
        } else {
            return null;
        }
    }

    /**
     * @param $name
     * @return array|null
     * Return all the recipe that contain the string send in param in their name
     */
    public static function advancedSearch($name, $rating) { 
        $db = DataBaseService::getInstance()->getDb();

        $recipes = $db->query("SELECT * FROM Recette R WHERE nom LIKE '%$name%' AND valide = 1
                                         AND (SELECT coalesce(avg(valeur), 0) FROM Note WHERE id_recette = R.id) >= '$rating'");

        if($recipes){
            return self::createRecipeArray($recipes);
        } else {
            return null;
        }
    }


}