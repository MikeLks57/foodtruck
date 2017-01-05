<?php

namespace Model;

use W\Model\Model;
use W\Model\ConnectionModel;
use PDO;

class ProductsModel extends Model
{
	public function findProductsByCategory($id)
	{
		$pdo = ConnectionModel::getDbh();
		$sql = 'SELECT products.id, products.name, products.description, products.price, products.picture, products.id_category FROM products INNER JOIN categories ON categories.id = products.id_category WHERE categories.id = :id';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();

		return $stmt->fetchAll();
	}
	
	public function getAllProductsByIdCategory($idCategory)
	{
		$pdo = ConnectionModel::getDbh();
		$sql = 'SELECT products.id as productId, products.name as productName, products.description as productDescription, products.price as productPrice, products.picture as productPicture, categories.name as categoryName FROM products INNER JOIN categories ON id_category = categories.id WHERE id_category = :idCategory';
		$products = $pdo->prepare($sql);
		$products->bindParam(':idCategory', $idCategory, PDO::PARAM_INT);
		$products->execute();
		return $products->fetchAll();
	}

	public function getIdProductByName($name)
	{
		$pdo = ConnectionModel::getDbh();
		$sql =	'SELECT id FROM products WHERE name LIKE "%'.$name.'%"';
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetch();
	}

	public function getIngredientsByProduct($idProduct)
	{
		$sql = 'SELECT ingredients.name as ingredients, products.name as productName FROM ingredients INNER JOIN ingredients_product ON ingredients_product.id_ingredient = ingredients.id AND ingredients_product.id_product = products.id WHERE id_product = :idProduct'; 
	}
}

