<?php

namespace Model;
use W\Model\Model;
use W\Model\ConnectionModel;

class InfosModel extends Model
{

	public function getInfo($column)
	{
		$pdo = ConnectionModel::getDbh();
		$sql = 'SELECT ' . $column . ' FROM infos LIMIT 1';
		$infos = $pdo->prepare($sql);
		$infos->execute();
		return $infos->fetchColumn(0);
	}

	public function aboutAdmin($name) {
		global $pdo;
		$stmt = $pdo->prepare('SELECT value FROM infos WHERE name = :name');
		$stmt->bindValue(':name', $name);
		$stmt->execute();
		return $stmt->fetch()['value'];
	}

}