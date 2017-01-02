<?php

namespace Controller;

use Model\SliderModel;
use \W\Controller\Controller;
use \Service\ImageManagerService;

class AdminController extends Controller
{

    private $adminModel;

    /**
     * Page d'accueil admin par défaut
     */

    public function home()
    {
        $this->allowTo('admin');
        $this->show('admin/home');
    }

    public function __construct() {
        $this->adminModel = new SliderModel();
    }

    public function displaySlider()
    {
        $this->show('admin/slider');
    }

    public function getSliderPics()
    {
        $sliderPictures = $this->adminModel->findAll('id', 'DESC');
        return $sliderPictures;
    }

    public function getSliderPicsAjax()
    {
        $sliderPictures = $this->getSliderPics();
        $this->showJson(['sliderPictures' => $sliderPictures]);
    }

    public function add()
    {
        $this->allowTo('admin');
        $sliderModel = new SliderModel();

        if(isset($_POST['send-file'])) {
            $errors = [];

            if(empty($_POST['title'])){
                $errors['titleEmpty'] = true;
            }
            if(empty($_POST['description'])){
                $errors['descriptionEmpty'] = true;
            }

            if($_FILES['my-file']['error'] == UPLOAD_ERR_INI_SIZE) {
                $errors['fileWeightMax'] = true;
            }
            // Vérifier si le téléchargement du fichier n'a pas été interrompu
            elseif ($_FILES['my-file']['error'] != UPLOAD_ERR_OK) {
                // A ne pas faire en-dehors du DOM, bien sur.. En réalité on utilisera une variable intermédiaire
                $errors['fileEmpty'] = true;
            } else {
                // Objet FileInfo
                $finfo = new \finfo(FILEINFO_MIME_TYPE);

                // Récupération du Mime
                $mimeType = $finfo->file($_FILES['my-file']['tmp_name']);

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
                    $shaFile = sha1_file($_FILES['my-file']['tmp_name']);
                    $nbFiles = 0;
                    $fileName = ''; // Le nom du fichier, sans le dossier
                    do {
                        $fileName = $shaFile . $nbFiles . '.' . $extFoundInArray;
                        $fullPath = 'assets/uploads/img/' . $fileName;
                        $nbFiles++;
                    } while(file_exists($fullPath));

                    $infos = getimagesize($_FILES['my-file']['tmp_name']);
                    $width = $infos[0];
                    $height = $infos[1];

                    if($width < 700 || $height < 350) {
                        $errors['fileSize'] = true;
                    }

                    if($width > 1500 || $height > 800) {
                        $errors['fileSizeMax'] = true;
                    }

                    $size = $_FILES['my-file']['size'];

                    if($size > 2000000) {
                        // Si l'image fait plus de 2 Mo
                        $errors['fileWeightMin'] = true;
                    }
                }
            }
            if(count($errors) === 0) {
                $moved = move_uploaded_file($_FILES['my-file']['tmp_name'], $fullPath);

                $miniFile = new ImageManagerService();
                $miniFile->resize($fullPath, null, 140, 140, false, 'assets/uploads/slider/' . $fileName,  false);

                // Ajouter si OK
                $sliderModel->insert([
                    'title' 		=> $_POST['title'],
                    'description' 	=> $_POST['description'],
                    'url' 			=> $fileName,
                ]);
                if (!$moved) {
                    $errors['file']['load'] = true;
                }
                echo json_encode(['result' => "success"]);
            } else {
                //$this->getSliderPics();
                echo json_encode(["errors" => $errors]);
            }

        } else {
            // Sinon, afficher le formulaire
            //$this->getSliderPics();
            echo json_encode(['result' => "nop"]);
        }
    }

    public function countPicsSlider(){
        $sliderPictures = $this->adminModel->getNbPictures();
        echo $sliderPictures;
    }

    public function deleteSliderPic()
    {
        unlink($_POST['filePathSlider']);
        unlink($_POST['filePathImg']);
        $sliderPictures = $this->adminModel->delete($_POST['idPic']);
    }

}