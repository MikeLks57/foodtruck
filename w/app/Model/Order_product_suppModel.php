<?php

namespace Model;

use \W\Model\Model;
use \W\Model\ConnectionModel;

class Order_product_suppModel extends Model
{
	public function findAllById($id)
	{
		$pdo = ConnectionModel::getDbh();
		$sql = 	'SELECT * FROM order_product_supp WHERE id_op = :id';
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetchAll();
	}
}