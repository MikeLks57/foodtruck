<?php

namespace Model;

use \W\Model\Model;
use \W\Model\ConnectionModel;

class Order_productModel extends Model
{



	public function getOrderProduct($column)
	{
		$pdo = ConnectionModel::getDbh();
		$sql =	'SELECT '.$column.' FROM order_product ORDER BY ' .$column. ' DESC LIMIT 1';
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchColumn(0);
	}

}