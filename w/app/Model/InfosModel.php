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

	public function getOption()
    {
    	$pdo = ConnectionModel::getDbh();
        $stmt = $pdo->query('SELECT * FROM infos');
        return $stmt->fetch();
    }

    public function updateOption($logo, $about)
    {
        $pdo = ConnectionModel::getDbh();

        $sql = 'UPDATE infos SET logo = :logo, about = :about ';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':logo', $logo);
        $stmt->bindParam(':about', $about);
        $stmt->execute();
    }

}