<?php

namespace Model;

use \W\Model\ConnectionModel;
use \W\Model\Model;

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
}