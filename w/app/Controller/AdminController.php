<?php

namespace Controller;

use \W\Controller\Controller;

class AdminController extends Controller
{

    /**
     * Page d'accueil par défaut
     */
    public function home()
    {
        $this->allowTo('admin');
        $this->show('admin/home');
    }

}