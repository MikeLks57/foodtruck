<?php

namespace Model;

use W\Model\Model;
use W\Model\ConnectionModel;
use PDO;

class CategoriesModel extends Model
{
	public function reOrderCategories($order, $idCategory)
	{
		$pdo = ConnectionModel::getDbh();
		$sql = 'UPDATE categories SET position = :order WHERE id = :idCategory';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':order', $order, PDO::PARAM_INT);
		$stmt->bindParam(':idCategory', $idCategory, PDO::PARAM_INT);
		$stmt->execute();
	}

	public function getCategoriesExcept()
	{
		$pdo = ConnectionModel::getDbh();
		$sql = 'SELECT categories.id as id, categories.name as name, categories.position as position FROM categories WHERE categories.id NOT IN (5000) ORDER BY position ASC';
		$categories = $pdo->query($sql);
		$categories->execute();
		return $categories->fetchAll();
	}
}

