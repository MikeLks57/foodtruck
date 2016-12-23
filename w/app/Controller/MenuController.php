<?php

namespace Controller;

use \W\Controller\Controller;
use Service\ImageManagerService;
use \Model\ProductsModel;
use \Model\CategoriesModel;
use \Model\IngredientsModel;
use \Model\Ingredients_productModel;

class MenuController extends Controller
{

	public function displayMenuAdmin()
	{
		$productsModel = new ProductsModel();
		$allProductsCat = $productsModel->getAllProductsByIdCategory(1);
		$this->show('admin/menu', ['allProducts' => $allProductsCat]);
	}
	
}
