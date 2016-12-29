<?php

namespace Controller;

use \W\Controller\Controller;
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

    

}