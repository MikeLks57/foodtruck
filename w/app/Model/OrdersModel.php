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

}