<?php

namespace Model;

use W\Model\Model;
use W\Model\ConnectionModel;
use PDO;

class IngredientsModel extends Model
{
	public function getIngredientsByIdProduct($idProduct)
	{
		$pdo = ConnectionModel::getDbh();
		$sql = 'SELECT ingredients.id as ingredientId, ingredients.name as ingredientName FROM ingredients INNER JOIN ingredients_product ON ingredients_product.id_ingredient = ingredients.id WHERE ingredients_product.id_product = :idProduct';
		$ingredients = $pdo->prepare($sql);
		$ingredients->bindParam(':idProduct', $idProduct, PDO::PARAM_INT);
		$ingredients->execute();
		return $ingredients->fetchAll();
	}

	public function ingredientExists($ingredientName)
	{
		$pdo = ConnectionModel::getDbh();
		$sql = 'SELECT COUNT(name) AS nbName FROM ingredients WHERE name LIKE :ingredientName';
		$stmt = $pdo->prepare($sql);
		$ingredient = $ingredientName;
		$stmt->bindParam(':ingredientName', $ingredient, PDO::PARAM_STR);
		$stmt->execute();
		$count = $stmt->fetch();

		if($count['nbName'] > 0) {
			return true;
		}
	}

	public function getIngredientIdByName($ingredientName)
	{
		$pdo = ConnectionModel::getDbh();
		$sql = 'SELECT id FROM ingredients WHERE name LIKE :ingredientName LIMIT 1';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':ingredientName', $ingredientName, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchColumn(0);
	}



}


