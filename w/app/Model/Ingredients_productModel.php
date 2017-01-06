<?php

namespace Model;

use W\Model\Model;
use W\Model\ConnectionModel;
use PDO;

class Ingredients_productModel extends Model
{
	public function deleteProductIngredient($idProduct)
	{
		$pdo = ConnectionModel::getDbh();
		$sql= 'DELETE FROM ingredients_product WHERE id_product = :idProduct';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':idProduct', $idProduct, PDO::PARAM_INT);
		$stmt->execute();
	}
}