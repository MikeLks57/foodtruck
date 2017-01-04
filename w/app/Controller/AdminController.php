<?php

namespace Controller;

use Model\SliderModel;
use Twilio\Rest\Client;
use \W\Controller\Controller;
use \Service\ImageManagerService;
use Model\AdminModel;
use W\Model\UsersModel;


class AdminController extends Controller
{

    private $adminModel;

    public function __construct() {
        $this->adminModel = new SliderModel();
    }
    /**
     * Page d'accueil admin par défaut
     */

    public function home()
    {
        $this->allowTo('admin');
        $this->show('admin/home');
    }

    public function displaySlider()
    {
        $this->allowTo('admin');
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
                        $fullPath = 'assets/uploads/img/slider/' . $fileName;
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
                $miniFile->resize($fullPath, null, 140, 140, false, 'assets/uploads/img/slider-mini/' . $fileName,  false);

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
                echo json_encode(["errors" => $errors]);
            }
        }
    }

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
                $finfo = new \finfo(FILEINFO_MIME_TYPE);

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

    public function searchUsers()
    {
        $this->allowTo('admin');
        if (isset($_POST['form'])) {
            $UserModel = new UsersModel();
            $search = [
                'username' => $_POST['searchUser'],
            ];
            $usersFind = $UserModel->search($search);
            $this->show('admin/displayUsers', ['allUsers' => $usersFind]);
        }
    }

    public function role()
    {
        $this->allowTo('admin');
        $this->show('admin/role');
    }

    public function updateUser()
    {
        $usersModel = new UsersModel();
        $errors = [];

        $usersModel->update(
            ['role' 	=> $_POST['role']],
            $_POST['id']
        );
    }
}