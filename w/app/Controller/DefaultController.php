<?php

namespace Controller;

use \W\Controller\Controller;
use Model\ProductsModel;
use Model\CategoriesModel;
use \Model\IngredientsModel;
use \Model\Ingredients_productModel;
use Model\sliderModel;
use Model\mapModel;
use Service\ImageManagerService;
use PDO;


class DefaultController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function home()
	{
		$this->show('default/home', ['allSlider' => $this->slider()]);
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

	public function slider()
	{
		$sliderModel = new sliderModel();
		$slider = $sliderModel->findAll();
		return $slider;
		/*$this->show('home', ['allSlider' => $slider]);*/
	}

	public function map()
	{
		$mapModel= New mapModel();
		$map = $mapModel->findAll();
		$this->show('map', ['allMap' => $map]);
	}

	public function displayAdminMenuPage()
	{
		$categories = $this->getAllCategories();
		$this->show('admin/menu'/*, ['categories' => $categories]*/);
	}

	public function displayCGU()
	{
		$this->show('mentionsLegales');
	}


/*-------------------fonctions liées aux catégories-------------------*/

	public function getCategoriesAjax()
	{
		$categories = $this->getCategories();
		$this->showJson(['categories' => $categories]);
	}

	public function getCategories()/*sans la catégorie non classé*/
	{
		$categoryModel = new CategoriesModel();
		$categories = $categoryModel->getCategoriesExcept();
		return $categories;
	}

	public function getAllCategories()/*toutes les catégories*/
	{
		$categoryModel = new CategoriesModel();
		$allCategories = $categoryModel->findAll('position');
		return $allCategories;
	}

	public function reorganiseCategories()
	{
		$categoryModel = new CategoriesModel();
		
		if(isset($_POST['category'])) {

			function safe($var) {
				$var = mysql_real_escape_string($var);
				$var = addcslashes($var, '%_');
				$var = trim($var);
				$var = htmlspecialchars($var);
				return $var;
			}

			foreach($_POST['category'] as $order => $id_category) {
	    		$categoryModel->reOrderCategories(safe($order), safe($id_category));
			}

		} else {
			$message = "pas de post category";
			echo $message;
		}
	}

	public function addCategory()
	{
		if(isset($_POST['newCategory'])) {
			$newCategory = $_POST['newCategory'];

			$categoryModel = new CategoriesModel();
			$categoryModel->insert([
				'name' 		=> $newCategory,
			]);
		} else {
			$message = "Erreur";
			echo $message;
		}
	}

	public function deleteCategory()
	{
		if(isset($_POST['idCategory'])){
			$idCategory = $_POST['idCategory'];
			
			$productsModel = new productsModel();
			$productsModel->updateProductsDeletedCat($idCategory);

			$categoryModel = new CategoriesModel();
			$categoryModel->delete($idCategory);

		} else {
			$message = "Erreur";
			echo $message;
		}
	}

	public function updateCategory()
	{
		if(isset($_POST['updateCategory']) && isset($_POST['idCategory'])){
			$updateCategory = $_POST['updateCategory'];
			$idCategory = $_POST['idCategory'];
			
			$categoryModel = new CategoriesModel();
			$categoryModel->update([
				'name' 		=> $updateCategory,
			], $idCategory);
		}
	}
/*-------------------Fin des fonctions liées aux catégories-------------------*/


/*-------------------fonctions liées aux ingrédients-------------------*/

	public function getIngredients()
	{
		$ingredientsModel = new IngredientsModel();
		$allIngredients = $ingredientsModel->findAll();
		return $allIngredients;
	}

	public function getIngredientsAjax()
	{
		$allIngredients = $this->getIngredients();
		$this->showJson(['ingredients' => $allIngredients]);
	}

	public function getIngredientsByIdProduct($idProduct)
	{
		$ingredientsModel = new IngredientsModel();
		$ingredientsByIdProduct = $ingredientsModel->getIngredientsByIdProduct($idProduct);
		return $ingredientsByIdProduct;
	}

	public function getIngredientIdByName($ingredientName)
	{
		$ingredientsModel = new IngredientsModel();
		$ingredientIdByName = $ingredientsModel->getIngredientIdByName($ingredientName);
		return $ingredientIdByName;
	}

	public function insertIngredientIfNotExists($ingredientName)
	{
		$ingredientsModel = new IngredientsModel();
		$ingredientExists = $ingredientsModel->ingredientExists($ingredientName);
		if($ingredientExists == false){
			$ingredientsModel->insert([
				'name'	=>	$ingredientName,
			]);
		} 
	}

/*-------------------Fin des fonctions liées aux ingrédients-------------------*/


/*-------------------fonctions liées aux produits-------------------*/

	public function getProductsByIdCat($idCategory)
	{
		$productsModel = new ProductsModel();
		$productsByCat = $productsModel->getProductsByIdCategory($idCategory);
		return $productsByCat;
	}

	public function getProductsByIdCatAjax()
	{
		if(isset($_GET['idCategory'])) {
			$idCategory = $_GET['idCategory'];
			$productsByCat = $this->getProductsByIdCat($idCategory);
			$this->showJson(['products' => $productsByCat]);	
		}
	}

	public function getProductsByVisibility()
	{
		$productsModel = new ProductsModel();
		$productsNoVisible = $productsModel->getProductsByVisibility();
		return $productsNoVisible;
	}

	public function getProductsByVisibilityAjax()
	{
		$productsNoVisible = $this->getProductsByVisibility();
		$this->showJson(['productsNoVisible' => $productsNoVisible]);
	}

	public function getProductsNonClasses()
	{
		$productsModel = new ProductsModel();
		$productsNonClasses = $productsModel->getProductsNonClasses();
		return $productsNonClasses;
	}

	public function getHighlightProducts()
	{
		$productsModel = new ProductsModel();
		$productsHighlight = $productsModel->getProductsHighlight();
		return $productsHighlight;
	}

	public function getHighlightProductsAjax()
	{
		$productsHighlight = $this->getHighlightProducts();
		$this->showJson(['productsHighlight' => $productsHighlight]);
	}

	public function getProductsNonClassesAjax()
	{
		$productsNonClasses = $this->getProductsNonClasses();
		$this->showJson(['productsNonClasses' => $productsNonClasses]);
	}


	public function getIdProductByName($productName)
	{
		$productsModel = new ProductsModel();
		$idProduct = $productsModel->getIdProductByName($productName);
		return $idProduct; 	
	}

	public function reorganiseProducts()
	{
		$productsModel = new ProductsModel();
		
		if(isset($_POST['product'])) {
			
			function safe($var) {
				$var = mysql_real_escape_string($var);
				$var = addcslashes($var, '%_');
				$var = trim($var);
				$var = htmlspecialchars($var);
				return $var;
			}

			foreach($_POST['product'] as $order => $id_product) {
	    		$productsModel->reOrderProducts(safe($order), safe($id_product));
			}

		}
	}

	public function addProduct()
	{
		if(isset($_POST['send-file'])) {

			$errors = [];

			if(isset($_POST['productName'])){
				$productName = trim(htmlspecialchars($_POST['productName']));
				if(empty($productName)){
					$errors['productNameEmpty'] = true;
				}
				if(strlen($productName) < 2 || strlen($productName) > 50){
					$errors['productNameLength'] = true;	
				}
			}

			if(isset($_POST['productDescription'])) {
				$productDescription = trim(htmlspecialchars($_POST['productDescription']));
				if(empty($productDescription)){
					$errors['productDescriptionEmpty'] = true;
				}
				if(strlen($productDescription) < 10 || strlen($productDescription) > 500){
					$errors['productDescriptionLength'] = true;	
				}
			}

			if(isset($_POST['productPrice'])) {
				$productPrice = trim(htmlspecialchars($_POST['productPrice']));
				if(empty($productPrice)){
					$errors['productPriceEmpty'] = true;
				}
				if(!filter_var($productPrice, FILTER_SANITIZE_NUMBER_FLOAT)){
					$errors['productPriceType'] = true;
				}
			}

			if(isset($_POST['idCategoryHidden'])) {
				$idCategory = trim(htmlspecialchars($_POST['idCategoryHidden']));
				if(empty($idCategory)){
					$errors['idCategoryMissing'] = true;
				}
				if(!filter_var($idCategory, FILTER_SANITIZE_NUMBER_INT)){
					$errors['idCategoryType'] = true;
				}
			}

			if(isset($_POST['tokenfieldValues'])) {
				$ingredientsList = $_POST['tokenfieldValues'];
				if(empty($ingredientsList)){
					$errors['ingredientsListEmpty'] = true;
				}
				$productIngredients = explode(", ", $_POST['tokenfieldValues']);
				foreach($productIngredients as $ingredient){
					$ingredientName = trim(htmlspecialchars(ucwords(strtolower($ingredient))));
					if(!filter_var($ingredientName, FILTER_SANITIZE_STRING) && !empty($ingredientName)){
						$errors['ingredientType'] = true;
					}else{
						$this->insertIngredientIfNotExists($ingredientName);
					}
				}
			}

			if($_FILES['productPicture']['error'] == UPLOAD_ERR_INI_SIZE) {
				$errors['fileWeightMax'] = true;
			}
        	// Vérifier si le téléchargement du fichier n'a pas été interrompu
			elseif ($_FILES['productPicture']['error'] != UPLOAD_ERR_OK) {
            // A ne pas faire en-dehors du DOM, bien sur.. En réalité on utilisera une variable intermédiaire
				$errors['fileEmpty'] = true;
			} else {
            // Objet FileInfo
				$finfo = new \finfo(FILEINFO_MIME_TYPE);

            // Récupération du Mime
				$mimeType = $finfo->file($_FILES['productPicture']['tmp_name']);

				$extFoundInArray = array_search(
					$mimeType, array(
						'bmp' => 'image/bmp',
						'jpg' => 'image/jpeg',
						'png' => 'image/png',
						'gif' => 'image/gif',
						)
					);
				if ($extFoundInArray === false) {
                	$errors['fileType'] =  true; // Autres erreurs a faire
            	} else {
                    // Renommer nom du fichier
                	$shaFile = sha1_file($_FILES['productPicture']['tmp_name']);
                	$nbFiles = 0;
                    $fileName = ''; // Le nom du fichier, sans le dossier
                    do {
                    	$fileName = $shaFile . $nbFiles . '.' . $extFoundInArray;
                    	$fullPath = 'assets/uploads/img/productPictures/' . $fileName;
                    	$nbFiles++;
                    } while(file_exists($fullPath));

                	$infos = getimagesize($_FILES['productPicture']['tmp_name']);
                    $width = $infos[0];
                    $height = $infos[1];

                    if($width < 50 || $height < 50) {
                    	$errors['fileSizeMin'] = true;
                    }

                    if($width > 1000 || $height > 1000) {
                    	$errors['fileSizeMax'] = true;
                    }

                	$size = $_FILES['productPicture']['size'];

                	if($size > 2000000) {
                    	// Si l'image fait plus de 2 Mo
                		$errors['fileWeightMax'] = true;
                	}
            	}
        	}

            if(count($errors) === 0) {
            	$moved = move_uploaded_file($_FILES['productPicture']['tmp_name'], $fullPath);

            	$miniFile = new ImageManagerService();
            	$miniFile->resize($fullPath, null, 150, 150, false, 'assets/uploads/img/productPictures/mini/' . $fileName,  false);

                // Ajouter si OK
                $productsModel = new ProductsModel();
            	$productsModel->insert([
            		'name' 			=> $productName,
            		'description' 	=> $productDescription,
            		'price'			=> $productPrice,
            		'picture' 		=> $fileName,
            		'id_category'	=> $idCategory,
            		]);
            	
            	$idProduct = $this->getIdProductByName($productName);

            	$ingredientsProductModel = new Ingredients_productModel();
            	foreach($productIngredients as $ingredientName){
	            	$idIngredient = $this->getIngredientIdByName($ingredientName);
					$ingredientsProductModel->insert([
            			'id_ingredient' => $idIngredient,
            			'id_product' 	=> $idProduct,
            		]);
				}

            	if (!$moved) {
            		$errors['file']['load'] = true;
            	}
            	$this->showJson(['result' => "success"]);
            } else {
            	$this->showJson(["errors" => $errors]);
            }
        } else {
			$message = "aucune donnée";
			echo $message;
		}

		
			/*[name] => boites-a-pizza-ppt-carton-compact.jpg
            [type] => image/jpeg
            [tmp_name] => D:\xampp\tmp\php6D6A.tmp
            [error] => 0
            [size] => 18976*/


	}

	public function deleteProduct()
	{
		if(isset($_POST['idProduct'])){
			$idProduct = $_POST['idProduct'];
			
			$ingredientsProductModel = new Ingredients_productModel();
			$ingredientsProductModel->deleteProductIngredient($idProduct);

			$productModel = new ProductsModel();
			$productModel->deleteProduct($idProduct);

		} else {
			$message = "Erreur";
			echo $message;
		}
	}

	public function deleteProductNonClasse()
	{
		if(isset($_POST['idProduct'])){
			$idProduct = $_POST['idProduct'];
			
			$ingredientsProductModelNonClasse = new Ingredients_productModel();
			$ingredientsProductModelNonClasse->deleteProductIngredient($idProduct);

			$productModelNonClasse = new ProductsModel();
			$productModelNonClasse->deleteProductNonClasse($idProduct);

		} else {
			$message = "Erreur";
			echo $message;
		}
	}

	public function deleteProductNoVisible()
	{
		if(isset($_POST['idProduct'])){
			$idProduct = $_POST['idProduct'];
			
			$ingredientsProductModelNoVisible = new Ingredients_productModel();
			$ingredientsProductModelNoVisible->deleteProductIngredient($idProduct);

			$productModelNoVisible = new ProductsModel();
			$productModelNoVisible->deleteProductNoVisible($idProduct);

		} else {
			$message = "Erreur";
			echo $message;
		}
	}

	public function getInfosByIdProd($idProd)
	{
		$productsModel = new ProductsModel();
		$infosProduct = $productsModel->getInfosByIdProd($idProd);
		return $infosProduct;
	}

	public function getInfosByIdProdAjax()
	{
		if(isset($_GET['idProd'])) {
			$idProd = $_GET['idProd'];
			$infos = $this->getInfosByIdProd($idProd);
			$ingredients = $this->getIngredientsByIdProduct($idProd);
			$this->showJson(['infosProduct' => $infos, 'ingredients' => $ingredients]);
		} else {
			$message = "rien n'a transité";
			echo $message;
		}
	}

	public function sleepProduct()
	{
		if(isset($_POST['idProduct'])) {
			$idProduct = $_POST['idProduct'];
			$productsModel = new ProductsModel();
			$productsModel->sleepProduct($idProduct);
			echo "la fonction a été lancée";
		}
	}

	public function displayProduct()
	{
		if(isset($_POST['idProduct'])) {
			$idProduct = $_POST['idProduct'];
			$productsModel = new ProductsModel();
			$productsModel->displayProduct($idProduct);
			echo "la fonction a été lancée";
		} else {
			echo "aucune donnée transmise";
		}
	}

	/*public function updateProduct()
	{
		if(isset($_POST['updateProduct']) && isset($_POST['idCategory'])){
			$updateCategory = $_POST['updateCategory'];
			$idCategory = $_POST['idCategory'];
			
			$categoryModel = new CategoriesModel();
			$categoryModel->update([
				'name' 		=> $updateCategory,
			], $idCategory);

			$message = "La catégorie a bien été modifiée";
			echo $message;

		} else {
			$message = "Erreur dans le controlleur";
			echo $message;
		}
	}*/

/*-------------------Fin des fonctions liées aux produits-------------------*/
	
	
}