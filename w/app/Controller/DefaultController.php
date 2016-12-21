<?php

namespace Controller;


use Model\ProductsModel;
use Model\CategoriesModel;
use \W\Controller\Controller;


class DefaultController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function home()
	{
		$this->show('default/home');
	}

	public function displayMenu($idCategory = 1)
	{
		// Récupère les différents categories
		// Il nous faut le modèle pour cela :
		$categoryModel = new CategoriesModel();

		$category = $categoryModel->findAll();

	
		// Récupère les différents menus
		// Il nous faut le modèle pour cela :
		$menuModel = new ProductsModel();
		$menu = $menuModel->findProductsByCategory($idCategory);

		$this->show('menu', ['allCategory' => $category, 'allMenu' => $menu] );


	}



}