<?php

namespace Controller;


use \W\Controller\Controller;
use Model\ProductsModel;
use Model\CategoriesModel;
use Model\SupplementsModel;
use Model\OrdersModel;
use Model\Order_productModel;
use Model\Order_product_suppModel;
use Model\sliderModel;
use Model\mapModel;
use Model\infosModel;

class DefaultController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function home()
	{
		$this->show('default/home');
	}

	public function confirmOrder()
	{
		$this->show('confirmOrder');
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

		// Récupère les différents supplements
		// Il nous faut le modèle pour cela :
		$supplementModel = new SupplementsModel();
		$supplements = $supplementModel->findSupplementsByCategory($idCategory);

		$this->show('menu', ['allCategory' => $category, 'allMenu' => $menu, 'allSupplement' => $supplements] );


	}

	public function addProductSupplements()
	{
		$_SESSION['basket'] []= [
			'name_product' => $_POST['nameProduct'],
			'supplements' => $_POST['supplement'],
			'priceProduct' => $_POST['price'],
			'priceSupplement' => $_POST['supplement-price'],
		];
		$command = $_SESSION['basket'];

		$this->show('default/displayOrder', ['command' => $command]);
	}

	public function deleteProductSupplements()
	{
		if (isset($_POST['form'])) {
			unset($_SESSION['basket'][$_POST['nbProduct']]);
			$command = $_SESSION['basket'];
			$this->show('default/displayOrder', ['command' => $command]);
		} 
	}

	public function addOrder()
	{
		if (isset($_POST['addOrder'])) {

			/*insertion de l'id user dans la table order*/
			$addOrderModel = new ordersModel();
			$orderModel = $addOrderModel->insert([
				'id_user' 	=> $_SESSION['user']['id'],
				'total' => $_POST['total'],
			]);

			/*selectionne le dernier id order ajouter dans la table order*/
			$getIdOrder = new ordersModel();
			$id_order = $getIdOrder->getOrder('id');

			foreach ($_SESSION['basket'] as $products) {
				
				/*chercher l'id du produit par rapport a son nom*/
				$getIdProductByName = new ProductsModel();
				$id_product = $getIdProductByName->getIdProductByName($products['name_product']);
				
				/*ajoute l'id order et l'id produit dans la table order product*/
				$addOrderProductModel = new order_productModel();
				$orderProductModel = $addOrderProductModel->insert([
					'id_order' => $id_order,
					'id_product' => $id_product['id'],
				]);
			
				/*selectionne le dernier id ajouter dans la table order product*/
				$getIdOp = new order_productModel();
				$id_order_product = $getIdOp->getOrderProduct('id');

				foreach ($products['supplements'] as $supplements) {
					if ($supplements != '0')
					{
						/*chercher l'id du supplement par rapport a son nom*/
						$getIdSupplementByName = new SupplementsModel();
						$id_supplement = $getIdSupplementByName->getIdSupplementByName($supplements);
						
						/*ajoute l'id order product et l'id supplement dans la table order product supplement*/
						$addOrderProductSuppModel = new order_product_suppModel();
						$OrderProductSuppModel = $addOrderProductSuppModel->insert([
							'id_op' => $id_order_product,
							'id_supplement' => $id_supplement['id'],
						]);	
					}
				}
			}
			unset($_SESSION['basket']);
			$this->redirectToRoute('confirm_order');

		}
	}

	public function searchProduct()
	{
		if (isset($_POST['form'])) {
			$ProductsModel = new ProductsModel();
			$search = [
					'name' => $_POST['searchpro'],
				];
			$productFind = $ProductsModel->search($search);
			$this->show('default/displayMenu', ['allMenu' => $productFind]);	
		} 	
	}

	public function slider()
	{
		$sliderModel = new sliderModel();
		$slider = $sliderModel->findAll();
		$this->show('slider', ['allSlider' => $slider]);
	}

	public function map()
	{
		$mapModel= New mapModel();
		$map = $mapModel->findAll();
		$this->show('map', ['allMap' => $map]);
	}

	public function about()
	{
		$aboutModel= New InfosModel();

		$about = $aboutModel->getInfo('about');
		$this->show('about', ['about' => $about]);
	}
}