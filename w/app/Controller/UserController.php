<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Security\AuthentificationModel;
use \W\Model\UsersModel;
use \Model\RecoverytokensModel;
use \Model\ConfirmtokensModel;
use \Service\MailerService;
use \Model\ContactModel;

class UserController extends Controller
{

    public function login()
    {
        $user= $this->getUser();
        // Si on a essayé de se connecté
        if(isset($_POST['login'])) {
            $errors = [];

            if(isset($_POST['g-recaptcha-response'])){
                $captcha=$_POST['g-recaptcha-response'];
            }
            if(!$captcha)
            {
                $errors['captcha']['check'] = true;
            }

            $secretKey = "6LcFdA8UAAAAAExeiIF3ab3aLAmAFDyzUbjtnp3P";
            $ip = $_SERVER['REMOTE_ADDR'];
            $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
            $responseKeys = json_decode($response,true);
            if(intval($responseKeys["success"]) !== 1 ) {
                echo '<h2>You are a F$%K&¤G ROBOT ! Get the @$%K out</h2>';
            } else {
                $authModel = new AuthentificationModel();
                $userModel = new UsersModel();

                // L'id d'un utilisateur
                $userId = $authModel->isValidLoginInfo($_POST['mail'], $_POST['pass']);

                if($userId > 0) {
                    // Connexion
                    $user = $userModel->find($userId);
                    if($user['confirmed_at'] == NULL)
                    {
                        $errors['confirmed']['notconfirmed'] = true;
                        $this->show('user/login', ['error' => $errors]);
                    } else {
                        // Placer user en session : $_SESSION['user'] = $user
                        $authModel->logUserIn($user);

                        if($user['role'] == 'admin')
                        {
                            $this->redirectToRoute('admin_home');
                        } else {
                            $this->redirectToRoute('default_home');
                        }

                    }

                } else {

                    // Echec de la connexion
                    $this->show('user/login', ['error' => true]);
                }
            }
        } else {
            $this->show('user/login', ['user' => $user]);
        }
    }

    public function logout()
    {
        $authModel = new AuthentificationModel();
        $authModel->logUserOut();
        $this->redirectToRoute('default_home');
    }

    public function passwordRecovery()
    {
        $tokenModel = new RecoverytokensModel();
        $userModel = new UsersModel();
        if(isset($_POST['send-mail'])) {
            $user = $userModel->getUserByUsernameOrEmail($_POST['mail']);
            if(!empty($user)) {
                // Ajouter un token de reset de mot de passe
                $token = \W\Security\StringUtils::randomString(32);
                $tokenModel->insert([
                    'id_user' 	=> $user['id'],
                    'token' 	=> $token,
                ]);

                // Envoyer un mail
                $resetUrl = 'http://127.0.0.1:8080' . $this->generateUrl('user_reset_password', ['token' => $token]);

                $messageHtml =<<< EOT
<h1>Réinitialisation de votre mot de passe</h1>
Quelqu'un a demandé la réinitialisation de votre mot de passe.<br>
<a href="$resetUrl">Cliquez ici</a> pour finaliser l'opération<br>
Si vous n'êtes pas à l'origine de ce mail, bla bla bla..
EOT;

                $messagePlain =<<< EOT
Réinitialisation de votre mot de passe
Quelqu'un a demandé la réinitialisation de votre mot de passe.
Accédez à $resetUrl pour finaliser l'opération
Si vous n'êtes pas à l'origine de ce mail, bla bla bla..
EOT;


                $mymailer = new MailerService();
                $mymailer->sendMail($user['mail'], $user['name'], 'Réinitialisation du mot de passe', $messageHtml, $messagePlain);

                $this->redirectToRoute('default_home');
            }
        } else {
            $this->show('user/password-recovery');
        }
    }

    public function resetPassword($token)
    {
        $tokenModel = new RecoverytokensModel();
        $authModel = new AuthentificationModel();
        $tokens = $tokenModel->search(['token' => $token]);
        if(count($tokens) > 0) {
            $myToken = $tokens[0];
        }
        if(!empty($myToken)) {
            // Le token existe bien en base

            // Si j'ai reçu une soumission
            if(isset($_POST['update-password'])) {
                // Modification du mot de passe, si confirmation exacte
                if($_POST['password'] == $_POST['password-confirm']) {
                    $userModel = new UsersModel();
                    $userModel->update(['password' => $authModel->hashPassword($_POST['password'])], $myToken['id_user']);

                    $tokenModel->delete($myToken['id']);

                    $this->redirectToRoute('user_login');
                }
            }

            // Sinon
            $this->show('user/reset-password');
        } else {
            $this->redirectToRoute('default_home');
        }
    }

    public function confirm($token)
    {
        $tokenModel = new ConfirmtokensModel();
        $tokens = $tokenModel->search(['token' => $token]);
        if (count($tokens) > 0) {
            $myToken = $tokens[0];
        }
        if (!empty($myToken)) {
            // Le token existe bien en base

            // Si j'ai reçu une soumission
            if (isset($_POST['confirm-account'])) {
                // Modification du mot de passe, si confirmation exacte
                $userModel = new UsersModel();
                $userModel->update(['confirmed_at' => date('Y-m-d')], $myToken['id_user']);

                $tokenModel->delete($myToken['id']);

                $this->redirectToRoute('user_login', ['success' => 'Votre compte a etait activée !']);
            } else {
                $this->show('user/confirm-account');
            }
        } else {
            $this->redirectToRoute('user_login', ['errors' => ['La confirmation de votre compte a echouée']]);
        }
    }

    public function signin()
    {
        $usersModel = new UsersModel();
        $authModel = new AuthentificationModel();

        if(isset($_POST['add-user'])) {

            $errors = [];
            $confirm =[];
            $nameExist = $usersModel->usernameExists($_POST['pseudo']);
            $mailExist = $usersModel->emailExists($_POST['mail']);
            $pattern = '/^[0][6-7]{1}[0-9]{7}[0-9]$/';


            if(empty($_POST['pseudo'])) {
                $errors['pseudo']['empty'] = true;
            }
            if($nameExist){
                $errors['pseudo']['exist'] = true;
            }
            if(empty($_POST['lastname'])) {
                $errors['lastname']['empty'] = true;
            }
            if(empty($_POST['firstname'])) {
                $errors['firstname']['empty'] = true;
            }
            if(empty($_POST['phone'])) {
                $errors['phone']['empty'] = true;
            }
            if(preg_match( $pattern , $_POST['phone'])){
                $phone = $_POST['phone'];
            } else{
                $errors['phone']['invalid'] = true;
            }
            if(empty($_POST['mail'])) {
                $errors['mail']['empty'] = true;
            }
            if($mailExist) {
                $errors['mail']['exist'] = true;
            }
            elseif(!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                $errors['mail']['bad'] = true;
            }
            if(empty($_POST['password'])) {
                $errors['password']['empty'] = true;
            }
            if(empty($_POST['password2'])) {
                $errors['password2']['empty'] = true;
            }
            elseif($_POST['password2'] != $_POST['password']) {
                $errors['confirmPass'] = true ;
            }
            if(isset($_POST['g-recaptcha-response'])){
                $captcha=$_POST['g-recaptcha-response'];
            }
            if(!$captcha)
            {
                $errors['captcha']['check'] = true;
            }
            else{
                $secretKey = "6LeX2Q4UAAAAAN7qkqbeLzu-u1hK_PV3dsgqusLE";
                $ip = $_SERVER['REMOTE_ADDR'];
                $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
                $responseKeys = json_decode($response,true);
                if(intval($responseKeys["success"]) !== 1) {
                    echo '<h2>You are a F$%K&¤G ROBOT ! Get the @$%K out</h2>';
                } else {
                    if(count($errors) === 0) {
                        // Ajouter si OK
                        $usersModel->insert([
                            'username' 	=> $_POST['pseudo'],
                            'mail' 	=> $_POST['mail'],
                            'password' 	=> $authModel->hashpassword($_POST['password']),
                            'role' => 'user',
                        ]);
                        $this->confirmAccount($_POST['mail']);
                        $this->redirectToRoute('user_login');
                    }
                }
            }
            if(count($errors) === 0) {
                // Ajouter si OK
                $usersModel->insert([
                    'username' 	=> $_POST['pseudo'],
                    'lastname'  => $_POST['lastname'],
                    'firstname' => $_POST['firstname'],
                    'phone' => $phone,
                    'mail' 	=> $_POST['mail'],
                    'password' 	=> $authModel->hashpassword($_POST['password']),
                    'role' => 'user',
                ]);
                $this->confirmAccount($_POST['mail']);
                $this->redirectToRoute('user_login');
            }
            $this->show('user/signin', ['errors' => $errors, 'confirm' => $confirm]);
        }

        else {
            // Sinon, afficher le formulaire
            $this->show('user/signin');
        }
    }

    private function confirmAccount($email)
    {
        $tokenModel = new ConfirmtokensModel();
        $userModel = new UsersModel();
        if (isset($_POST['add-user'])) {
            $user = $userModel->getUserByUsernameOrEmail($email);
            if (!empty($user)) {
                // Ajouter un token
                $token = \W\Security\StringUtils::randomString(32);
                $tokenModel->insert([
                    'id_user' => $user['id'],
                    'token' => $token,
                ]);

                // Envoyer un mail
                $confirmAccount = 'http://127.0.0.1:8080'.$this->generateUrl('user_confirm_account', ['token' => $token]);

                $messageHtml = <<< EOT
<h1>Confirmation de votre compte</h1>
Bonjour $user[name]<br>
<a href="$confirmAccount">Cliquez ici</a> pour finaliser votre inscription<br>
Si vous n'êtes pas à l'origine de ce mail, bla bla bla..
EOT;

                $messagePlain = <<< EOT
Confirmation de votre compte
Bonjour $user[name],
Accédez à $confirmAccount pour finaliser votre inscription
Si vous n'êtes pas à l'origine de ce mail, bla bla bla..
EOT;

                $myMailer = new MailerService();
                $myMailer->sendMail($user['mail'], $user['name'], 'Confirmation de compte', $messageHtml, $messagePlain);
            }
        } else {
            $this->redirectToRoute('user_login', ['errors' => ['Le mail de confirmation n\' a pas pu être envoyé']]);
        }
    }

    public function contact() { 

        if (isset($_POST['send_message'])) {
            $errors = array();

            $lastname = trim($_POST['lastname']);
            $lastname = filter_var($lastname, FILTER_SANITIZE_SPECIAL_CHARS);
            $object = trim($_POST['object']);
            $object = filter_var($object, FILTER_SANITIZE_SPECIAL_CHARS);
            $textarea = trim($_POST['textarea']);
            $textarea = filter_var($textarea, FILTER_SANITIZE_SPECIAL_CHARS);
            $mail = filter_var($_POST['mail'], FILTER_SANITIZE_SPECIAL_CHARS);


            if (!empty($_POST['lastname'])) {
                if (strlen($_POST['lastname']) < 4) {
                    $errors['lastname'] = 'Votre nom doit comprendre au moins 4 caractères.';
                }
            }
            else {
    // Si on a pas précisé d'objet
                $errors['lastname']['empty'] = true;
            }
            if (!empty($_POST['object'])) {
                if (strlen($_POST['object']) < 10) {
                    $errors['object'] = 'L\'objet doit comprendre au moins 10 caractères.';
                }
            }
            else {
    // Si on a pas précisé d'objet
                $errors['object'] = 'Merci d\'indiquer l\'objet de votre message.';
            }
            if (!empty($_POST['textarea'])) {
                if (strlen($_POST['textarea']) < 10) {
                    $errors['textarea'] = 'Votre message doit comprendre au moins 10 caractères.';
                }
            }
            else {
    // Si on a pas écris dans le textarea
                $errors['textarea']['empty'] = true;
            }

            if (!empty($_POST['mail'])) {
    // On teste la validité du mail
                $isMailValid = filter_var($mail, FILTER_VALIDATE_EMAIL);

                if (!$isMailValid) {
                    $errors['mail'] = 'L\'email renseigné n\'est pas valide.';
                }
            }
            else {
                $errors['mail'] = 'Merci de renseigner votre email.';
            }

$formValid = false;
    // Le formulaire est valide si je n'ai pas enregistré d'erreurs
        if (count($errors) == 0) {
            $formValid = true;
        }

        $adminMail = 'lenajilian76@hotmail.fr';
        $messageHtml = '<h1>' . $lastname . '</h1> vous a envoyer le message suivant :<br>' . $textarea;
        $messagePlain = $lastname . ' vous a envoyer le message suivant :' . $textarea;




            /*Envoie le mail à l'administrateur*/
        if ($formValid = true) {
            $myMailer = new MailerService();
            $myMailer->sendMail($adminMail, $lastname, $object, $messageHtml, $messagePlain);
        }




            if (isset($_POST['checkbox'])) {
                $messageHtml = 'Le message suivant a été envoyé à l\'administrateur du site' . $object . '<br>' . $textarea;
                $messagePlain = 'Le message suivant a été envoyé à l\'administrateur du site' . $object . $textarea;
                /*Envoie une copie si la personne coche la checkbox*/
                $myMailer->sendMail($_POST['mail'], $lastname, $object, $messageHtml, $messagePlain);
            }

            $this->show('contact', ['errors' => $errors, 'formValid' => $formValid]);

        }

        else {
        // Sinon, afficher le formulaire
            $this->show('contact');
        }
    }
}