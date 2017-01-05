<?php

namespace Controller;

use \W\Controller\Controller;
use Twilio\Rest\Client;
use Model\OrdersModel;
use Model\Order_productModel;
use Model\Order_product_suppModel;
use Model\ProductsModel;
use Model\SupplementsModel;
use Model\IngredientsModel;
use Model\UsersModel;
use Model\AdminModel;

class AdminController extends Controller
{

    /**
     * Page d'accueil par défaut
     */
    /*public function home()
    {
        $this->show('admin/home');
    }*/



	public function aboutAdmin()
    {
    	$adminModel = new AdminModel();
    	if(!isset($_SESSION['user_logged']))
    	{
    		/*header('location: login.php');*/
    	}
    	$aboutContent = $adminModel->getOption();
    	if (isset($_POST['sendOptions'])) {
    		$errors = [];

		    // Vérifier si le téléchargement du fichier n'a pas été interrompu
    		if ($_FILES['my-logo']['error'] != UPLOAD_ERR_OK) {
		        // A ne pas faire en-dehors du DOM, bien sur.. En réalité on utilisera une variable intermédiaire
    			$errors['my-logo'] = 'Merci de choisir un fichier';
    		} else {
		        // Objet FileInfo
    			$finfo = new finfo(FILEINFO_MIME_TYPE);

		        // Récupération du Mime
    			$mimeType = $finfo->file($_FILES['my-logo']['tmp_name']);

    			$extFoundInArray = array_search(
    				$mimeType, array(
    					'bmp' => 'image/bmp',
    					'jpg' => 'image/jpeg',
    					'png' => 'image/png',
    					'gif' => 'image/gif',
    					)
    				);
    			if ($extFoundInArray === false) {
    				$errors['my-logo'] =  'Le fichier n\'est pas une image';
    			} else {
		            // Renommer nom du fichier
    				$shaFile = sha1_file($_FILES['my-logo']['tmp_name']);
    				$nbFiles = 0;
		            $fileName = ''; // Le nom du fichier, sans le dossier
		            do {
		            	$fileName = $shaFile . $nbFiles . '.' . $extFoundInArray;
		            	$fullPath = './assets/uploads/img/' . $fileName;
		            	$nbFiles++;
		            } while(file_exists($fullPath));

		            $infos = getimagesize($_FILES['my-logo']['tmp_name']);
		            $width = $infos[0];
		            $height = $infos[1];
		            if($width < 255 || $height < 255) {
		            	$errors['my-logo'] = 'L\'image doit mesurer plus de 255px de hauteur et de largeur';
		            }

		            $size = $_FILES['my-logo']['size'];
		            if($size > 10000000) {
		                // Si l'image fait plus de 10 Mo
		            	$errors['my-logo'] = 'L\'image est trop lourde (plus de 10 Mo)';
		            }

		            // Maintenant, on ajoute en base, et on place le fichier temporaire dans le dossier uploads/
		            if(count($errors) == 0) {
		            	updateOption('logo', $fileName);
		            	$moved = move_uploaded_file($_FILES['my-logo']['tmp_name'], $fullPath);
		            	if (!$moved) {
		            		$errors['my-logo'] = 'Erreur lors de l\'enregistrement';
		            	}
		            }
		        }
		    } // Fin si fichier présent

		    if(isset($_POST['aboutContent'])){
		    	$content = $_POST['aboutContent'];
		    	updateOption('aboutContent', $content);
		    }
		}

		$this->show('admin/aboutAdmin', ['aboutContent'=>'lkiujhgf']);
	}

	public function displayOrder(){
		// Récupère les différentes commandes
		$ordersModel = new OrdersModel();
		$orders = $ordersModel->findAll(); 	
		
		foreach ($orders as $order) {
			// Récupère l'utilisateur en fonction de l'id inscrit en commande
			$usersModel = new UsersModel();
			$users = $usersModel->find($order['id_user']);
			$tableUser[] = ["id" => $order['id'],
							"id_user" => $users['id'],
							"lastname" => $users['lastname'],
							"firstname" => $users['firstname'],
							"total" => $order['total']];
			// Récupère les différents produits
			$orderProductModel = new Order_productModel();
			$orderProduct = $orderProductModel->findAllById($order['id']);

			foreach ($orderProduct as $product) {
				
				// Récupère les différents supplements
				$orderProductSupplementModel = new Order_product_suppModel();
				$ops = $orderProductSupplementModel->findAllById($product['id']);
	
				// Récupère le nom du prosuit par rapport a l'id produit dans la commande
				$products = new ProductsModel();
				$prod = $products->find($product['id_product']);

				$tableIng = [];
				foreach ($ops as $sup) {

					// Récupère les différents supplements
					$supplements = new SupplementsModel();
					$supplement = $supplements->find($sup['id_supplement']);

					// Récupère le nom de l'ingredient en fonction de l'id supplement dans la table order product supp
					$ingredients = new IngredientsModel();
					$ingredient = $ingredients->find($supplement['id_ingredient']);
					
					$tableIng[] = ["ingredient" => $ingredient['name']];
				}
				
				$tableIngredient = $tableIng;
				unset($tableIng);	

				$tableProduct[] = ["prod" => $prod['name'],
									"ing" => $tableIngredient,];

			}
			$tableProducts = $tableProduct;
			unset($tableProduct);
			
			$table[] = ["users" => $tableUser,
						"product" => $tableProducts,];
			unset($tableUser);
		}
		if (!$orders) {
			$table = [];
		}
		/*print_r($table);die();*/
		$this->show('admin/order', ['allOrder' => $table] );

	}

	public function sentSmsCommand()
    {
        // Step 2: set our AccountSid and AuthToken from https://twilio.com/console
        /*$AccountSid = "AC3d93538f75c6c5d653af473dfaa9d66f";
        $AuthToken = "b8bdda66b0467aee1448dc9128f4029a";*/

        $AccountSid = "ACa121f0882dcc6e36980d9bbb891d46d2";
        $AuthToken = "4230ec8470815b0e490d3a308c3559e3";


        // Step 3: instantiate a new Twilio Rest Client
        $client = new Client($AccountSid, $AuthToken);

        $orderId = $_POST['order'];
        $ordersModel = new OrdersModel();
        $order = $ordersModel->find($orderId);

        $userId = $order['id_user'];
        $usersModel = new usersModel();
        $user = $usersModel->find($userId);

        // Step 4: make an array of people we know, to send them a message.
        // Feel free to change/add your own phone number and name here.
        $people = array(
            "+33".$user['phone'] => $user['lastname']." ".$user['firstname'],
        );

        // Step 5: Loop over all our friends. $number is a phone number above, and
        // $name is the name next to it
        foreach ($people as $number => $name) {

            $sms = $client->account->messages->create(

            // the number we are sending to - Any phone number
                $number,

                array(
                    // Step 6: Change the 'From' number below to be a valid Twilio number
                    // that you've purchased
                    /*'from' => "+33756798518",*/
                    'from' => "+33644641786",

                    // the sms body
                    'body' => "Bonjour $name, Votre commande est en préparation, elle sera prête d'ici 20min. Vous pouvez d'hors et déjà venir. Pizz'Truck ! Ne pas répondre, message automatique"
                )
            );

            // Display a confirmation message on the screen
            echo json_encode(['result' => "success"]);
        }
    }

    public function deleteOrder(){
    	
    	$orderId = $_POST['order'];

		/*recherche chaque produit de la commande en fonction de l'id commande*/
    	$orderProductModel = new Order_productModel();
    	$orderProducts = $orderProductModel->findAllById($orderId);

    	/*recherche chaque supplement du produit en fonction de l'id produit*/
    	foreach ($orderProducts as $orderProduct) {
    		$orderProductSupplementModel = new Order_product_suppModel();
    		$orderProductSupplement = $orderProductSupplementModel->findAllById($orderProduct['id']);

    		foreach ($orderProductSupplement as $ops) {

    			/*supprime chaque supplements trouver*/
    			$orderProductSupplementModel = new Order_product_suppModel();
    			$orderProductSupplementModel->delete($ops['id']);
    		}

    		/*supprime chaque produit trouver*/
			$orderProductModel = new Order_productModel();
	    	$orderProductModel->delete($orderProduct['id']);
    	}

    	/*supprime la commande*/
    	$ordersModel = new OrdersModel();
    	$ordersModel->delete($orderId);

    }


}