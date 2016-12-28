<?php

namespace Model;

use \W\Model\ConnectionModel;
use \W\Model\Model;

class SupplementsModel extends Model
{
	public function findSupplementsByCategory($id)
	{
		$pdo = ConnectionModel::getDbh();
		$sql = 	'SELECT supplements.id, supplements.id_ingredient, supplements.price, supplements.id_category, ingredients.name '.
				'FROM supplements '.
				'INNER JOIN categories ON categories.id = supplements.id_category '.
				'INNER JOIN ingredients ON ingredients.id = supplements.id_ingredient '.
				'WHERE categories.id = :id';

		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();

		return $stmt->fetchAll();
	}

	public function getIdSupplementByName($name)
	{
		$pdo = ConnectionModel::getDbh();
		$sql =	'SELECT supplements.id FROM supplements INNER JOIN ingredients ON ingredients.id = supplements.id_ingredient WHERE name LIKE "%'.$name.'%"';
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetch();
	}
}