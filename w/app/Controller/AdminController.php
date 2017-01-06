<?php

namespace Controller;

use \W\Security\AuthentificationModel;
use \W\Controller\Controller;
use \Service\ImageManagerService;
use Model\InfosModel;
use \Service\MailerService;
use Model\UsersModel;
use Model\SliderModel;


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
                echo json_encode(["errors" => $errors]);
            }
        }
    }

    public function adminAbout()
    {
        $adminModel = new InfosModel();
        if(!isset($_SESSION['user_logged']))
        {
            /*header('location: admin-menu.php');*/
        }
        $aboutContent = $adminModel->getOption();
        
        // Maintenant, on ajoute en base, et on place le fichier temporaire dans le dossier uploads/
        if(isset($_POST['sendOptions'])){
            $content = $_POST['aboutContent'];
            $fileName = ''; // Le nom du fichier, sans le dossier
            $ncontents = new InfosModel();
            $ncontent = $ncontents->updateOption($fileName, $content);
        }
        echo 'Les modifications ont bien été sauvegardées.<br>
        >> <a href="admin-menu">Retourner à l\'accueil</a>';
        //Redirection vers la page menu avec un message de validation.    
    }

    public function getAbout()
    {
        $AdminModel= New InfosModel();
        $ncontent = $AdminModel->find(1);
        $this->show('admin/aboutAdmin', ['allContent' => $ncontent]);
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

    public function adminAccount()
    {
        $this->allowTo('admin');
        $usersModel = new UsersModel();
        $authModel = new AuthentificationModel();
        if(isset($_POST['update-password']))
        {
            $errors = [];
            $id = $_SESSION['user']['id'];

            if(empty($_POST['password']))
            {
                $errors['password']['empty'] = true;
            }
            if(empty($_POST['confirmPass']))
            {
                $errors['confirmPass']['empty'] = true;
            }
            elseif($_POST['confirmPass'] != $_POST['password'])
            {
                $errors['confirmPass'] = true ;
            }
            if(count($errors) === 0) {
                // Ajouter si OK
                $usersModel->update([
                    'password'  => $authModel->hashpassword($_POST['password']),
                    'role' => 'user',
                    ], $id);
                $this->accountModification($_SESSION['user']['mail']);
                $this->redirectToRoute('admin_admin_account');
            }
            $this->show('admin/adminAccount', ['errors' => $errors]);
        } else {
            // Sinon, afficher le formulaire
            $this->show('admin/adminAccount');
        }
    }
    

    private function accountModification($mail)
    {
        $userModel = new UsersModel();
        $user = $userModel->getUserByUsernameOrEmail($mail);
        if(!empty($user)) {

                 // Envoyer un mail
            $resetUrl = 'http://127.0.0.1:8080' . $this->generateUrl('user_contact');

            $messageHtml =<<< EOT
<h1>Modification de vos informations</h1>
Quelqu'un a modifié vos informations personnelles.<br>
Connectez-vous à votre compte pour voir vos nouvelles informations.
Si vous n'êtes pas à l'origine de ce mail, veuillez nous contacter via notre page <a href="$resetUrl">Contact</a>.<br>

<h4>Pizz'Truck</h4>
EOT;

            $messagePlain =<<< EOT
Modification de vos informations
Quelqu'un a modifié vos informations personnelles.
Connectez-vous à votre compte pour voir vos nouvelles informations.
Accédez à $resetUrl si vous n'êtes pas à l'origine de ce mail,
pour nous contacter.

Pizz'Truck
EOT;


            $mymailer = new MailerService();
            $mymailer->sendMail($user['mail'], $user['name'], 'Réinitialisation du mot de passe', $messageHtml, $messagePlain);
            $this->redirectToRoute("admin_admin_account");
        }
    }




}