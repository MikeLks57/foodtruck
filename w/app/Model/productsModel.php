<?php

namespace Model;

use W\Model\Model;
use W\Model\ConnectionModel;
use PDO;

class ProductsModel extends Model
{
	public function getProductsByIdCategory($idCategory)
	{
		$pdo = ConnectionModel::getDbh();
		$sql = 'SELECT products.id as productId, products.name as productName, products.description as productDescription, products.price as productPrice, products.picture as productPicture, categories.name as categoryName, categories.id as categoryId FROM products INNER JOIN categories ON products.id_category = categories.id WHERE id_category = :idCategory AND visibility = 1 AND deleted = 0 ORDER BY products.position';
		$products = $pdo->prepare($sql);
		$products->bindParam(':idCategory', $idCategory, PDO::PARAM_INT);
		$products->execute();
		return $products->fetchAll();
	}

	public function getProductsByVisibility()
	{
		$pdo = ConnectionModel::getDbh();
		$sql = 'SELECT products.id as productId, products.name as productName, products.description as productDescription, products.price as productPrice, products.picture as productPicture, categories.name as categoryName, categories.id as categoryId FROM products INNER JOIN categories ON id_category = categories.id WHERE visibility = 0 AND deleted = 0 ORDER BY products.position';
		$products = $pdo->prepare($sql);
		$products->execute();
		return $products->fetchAll();
	}

	public function getProductsNonClasses()
	{
		$pdo = ConnectionModel::getDbh();
		$sql = 'SELECT products.id as productId, products.name as productName, products.description as productDescription, products.price as productPrice, products.picture as productPicture, categories.name as categoryName, categories.id as categoryId FROM products INNER JOIN categories ON id_category = categories.id WHERE products.id_category = 5000 AND deleted = 0 ORDER BY products.position';
		$products = $pdo->prepare($sql);
		$products->execute();
		return $products->fetchAll();	
	}

	public function getProductsHighlight()
	{
		$pdo = ConnectionModel::getDbh();
		$sql = 'SELECT products.id as productId, products.name as productName, products.description as productDescription, products.price as productPrice, products.picture as productPicture, categories.name as categoryName, categories.id as categoryId FROM products INNER JOIN categories ON id_category = categories.id WHERE products.highlight = 1 ORDER BY products.position';
		$products = $pdo->prepare($sql);
		$products->execute();
		return $products->fetchAll();		
	}

	public function getInfosByIdProd($idProd)
	{
		$pdo = ConnectionModel::getDbh();
		$sql = 'SELECT products.id as productId, products.name as productName, products.description as productDescription, products.price as productPrice, products.picture as productPicture, categories.name as categoryName, categories.id as categoryId FROM products INNER JOIN categories ON id_category = categories.id WHERE products.id = :idProd';
		$infos = $pdo->prepare($sql);
		$infos->bindParam(':idProd', $idProd, PDO::PARAM_INT);
		$infos->execute();
		return $infos->fetchAll();
	}

	public function reOrderProducts($order, $idProduct)
	{
		$pdo = ConnectionModel::getDbh();
		$sql = 'UPDATE products SET position = :order WHERE id = :idProduct';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':order', $order, PDO::PARAM_INT);
		$stmt->bindParam(':idProduct', $idProduct, PDO::PARAM_INT);
		$stmt->execute();
	}

	public function updateProductsDeletedCat($idCat)
	{
		$pdo = ConnectionModel::getDbh();
		$sql = 'UPDATE products SET id_category = 5000 WHERE id_category = :idCat';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':idCat', $idCat, PDO::PARAM_INT);
		$stmt->execute();
	}

	public function createProduct($productName, $productDescription, $productPrice, $productPicture, $idCategory)
	{
		$pdo = ConnectionModel::getDbh();
		$sql = 'INSERT INTO products (name, description, price, picture, id_category) VALUES (:productName, :productDescription, :productPrice, :productPicture, :idCategory)';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':productName', $productName);
		$stmt->bindParam(':productDescription', $productDescription);
		$stmt->bindParam(':productPrice', $productPrice);
		$stmt->bindParam(':productPicture', $productPicture);
		$stmt->bindParam(':idCategory', $idCategory);
		$stmt->execute();
	}

	public function deleteProduct($idProduct)
	{
		$pdo = ConnectionModel::getDbh();
		$sql = 'UPDATE products SET visibility = 0 AND deleted = 1 WHERE id = :idProduct';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':idProduct', $idProduct, PDO::PARAM_INT);
		$stmt->execute();
	}

	public function deleteProductNonClasse($idProduct)
	{
		$pdo = ConnectionModel::getDbh();
		$sql = 'UPDATE products SET deleted = 1 WHERE id = :idProduct';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':idProduct', $idProduct, PDO::PARAM_INT);
		$stmt->execute();
	}

	public function deleteProductNoVisible($idProduct)
	{
		$pdo = ConnectionModel::getDbh();
		$sql = 'UPDATE products SET deleted = 1 WHERE id = :idProduct';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':idProduct', $idProduct, PDO::PARAM_INT);
		$stmt->execute();
	}

	public function getIdProductByName($productName)
	{
		$pdo = ConnectionModel::getDbh();
		$sql = 'SELECT id FROM products WHERE name LIKE :productName LIMIT 1';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':productName', $productName, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchColumn(0);
	}

	public function sleepProduct($idProduct)
	{
		$pdo = ConnectionModel::getDbh();
		$sql = 'UPDATE products SET visibility = 0 WHERE id = :idProduct';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':idProduct', $idProduct, PDO::PARAM_INT);
		$stmt->execute();
		echo "La fonction s'est bien déroulée";
	}

	public function displayProduct($idProduct)
	{
		$pdo = ConnectionModel::getDbh();
		$sql = 'UPDATE products SET visibility = 1 WHERE id = :idProduct';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':idProduct', $idProduct, PDO::PARAM_INT);
		$stmt->execute();
		echo "La fonction s'est bien déroulée";
	}
	




}

