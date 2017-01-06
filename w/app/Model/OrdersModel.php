<?php

namespace Model;

use \W\Model\Model;
use \W\Model\ConnectionModel;

class OrdersModel extends Model
{

	public function getOrder($column)
	{
		$pdo = ConnectionModel::getDbh();
		$sql =	'SELECT '.$column.' FROM orders ORDER BY ' .$column. ' DESC LIMIT 1';
		$id_order = $pdo->prepare($sql);
		$id_order->execute();
		return $id_order->fetchColumn(0);
	}

	public function updateOrder($id, $date_begin)
	{
		$pdo = ConnectionModel::getDbh();
		$sql = 	'UPDATE orders SET date_begin = :date_begin WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		$stmt->bindparam(':id', $id);
		$stmt->bindparam(':date_begin', $date_begin);
		$stmt->execute();
	}

}