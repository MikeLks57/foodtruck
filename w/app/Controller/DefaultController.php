<?php

namespace Controller;

use \W\Controller\Controller;
use Model\sliderModel;

class DefaultController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function home()
	{
		$this->show('default/home');
	}

	public function slider()
	{
		$sliderModel = new sliderModel();
		$slider = $sliderModel->findAll();
		$this->show('slider', ['allSlider' => $slider]);
	}

}