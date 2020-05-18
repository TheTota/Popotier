<?php 

namespace src\services;



use src\models\RecipeTypeEntity;

class RecipeTypeService
{
	public static function fetchAll()
	{
        $db = DataBaseService::getInstance()->getDb();

		$recipeTypeAll = $db->query('SELECT * FROM  Type');

		return self::createRecipeTypeArray($recipeTypeAll);
	}

	public static function findById($id) {
	        $db = DataBaseService::getInstance()->getDb();

			$recipeType = $db->query("SELECT * FROM Type WHERE id = '$id'")->fetch();

			return new RecipeTypeEntity(
				$recipeType['id'],
				$recipeType['libelle']
			);
	}

	public static function createRecipeTypeArray(\PDOStatement $recipeTypeAll): array
	{
		$recipeTypeArray = array();
		foreach ($recipeTypeAll as $recipeType) {
			array_push(
				$recipeTypeArray,
				new RecipeTypeEntity(
					$recipeType['id'],
					$recipeType['libelle']
				)	
			);
		}
	}
}