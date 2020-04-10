<?php 

namespace Src\Services;

require_once 'src/models/RecipeTypeEntity.php';

use Src\Models\RecipeTypeEntity;

class RecipeTypeService
{
	public static function fetchAll()
	{
        $db = DataBaseService::getInstance()->getDb();

		$recipeTypeAll = $db->query('SELECT * FROM  Type');

		return self::createRecipeTypeArray($recipesTypeAll);
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
		foreach ($recipesTypeAll as $recipeType) {
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