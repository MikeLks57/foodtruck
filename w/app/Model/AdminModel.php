<?php

namespace Model;

use W\Model\Model;
use W\Model\ConnectionModel;

class AdminModel extends Model
{
	public function getOption()
    {
    	$pdo = ConnectionModel::getDbh();
        $stmt = $pdo->query('SELECT * FROM infos');
        return $stmt->fetch();
    }
	
}