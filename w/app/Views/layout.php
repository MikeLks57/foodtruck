<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $this->e($title) ?></title>
	
	<!-- polices -->
	<link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Catamaran" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Ranchers" rel="stylesheet">
    <!-- polices -->

    <!-- Bootstrap Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Bootstrap Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Fichier CSS -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  	<link rel="stylesheet" href="/resources/demos/style.css">
  	<link rel="stylesheet" href="<?= $this->assetUrl('dist/css/bootstrap-tokenfield.css') ?>">
    <link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>">
</head>
<body>
	<!-- Container englobant l'ensemble de la page -->
	<div class="container-fluid allPage">

		<!-- Header et navbar -->
		<header class="main-header">
			<nav class="navbar navbar-default">
		  		<div class="container-fluid navbar-default">
		  			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        		<span class="sr-only">Toggle navigation</span>
		        		<span class="icon-bar"></span>
		        		<span class="icon-bar"></span>
			      	</button>
			    	<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
			    		<ul class="nav navbar-nav">
				        	<li><a href="<?= $this->url('default_home') ?>">Accueil<span class="sr-only">(current)</span></a></li>
				        	<li><a href="<?= $this->url('display_menu') ?>">Carte</a></li>
				        	<li><a href="<?= $this->url('default_about') ?>">Infos</a></li>
				        	<li><a href="<?= $this->url('user_contact') ?>">Contact</a></li>
				        	<?php if(!isset($_SESSION['user'])) : ?>
                            	<li><a id="connect" href="<?= $this->url('user_login') ?>">Connexion</a></li>
                        	<?php else : ?>
                            	<li><a id="disconnect" href="<?= $this->url('user_logout') ?>">Déconnexion</a></li>
                        	<?php endif ?>
				        	<li><a href="<?= $this->url('user_signin') ?>">S'inscrire</a></li>
			      		</ul>
      				</div>
				</div>
			</nav>
		</header>
		<!-- /Header et navbar -->

		<main>
			<!-- Container englobant le contenu de la page -->
	        <div class="container-fluid main-container">
		
		        <section>
		            <?= $this->section('messages') ?>
		        </section>

				<section>
					<?= $this->section('main_content') ?>
				</section>

			</div>
			<!-- /Container englobant le contenu -->
		</main>

    	
		<!-- Footer -->
		<footer>
			<div class="container-fluid">
	        	<div class="row footer">
	        		<div class="col-xs-12 col-sm-5 firstCol">
	    				<p>
	    					Inscrivez vous à notre newsletter<br>
	    					et recevez nos promotions en exclusivité
	    				</p>
	    				<p>
	    					<form action="#" method="POST">
	    						<input type="text" name="newsletter">
	    						<input type="submit" class="btn btn-default" name="validNewsletter">
	    					</form>
	    				</p>
	        		</div>
	    			<div class="col-xs-12 col-sm-4 secondCol">
	    				<p>
	    					<a href="<?= $this->url('default_home') ?>">Accueil</a><br>
	    					<a href="<?= $this->url('display_menu') ?>">Carte</a><br>
	    					<a href="<?= $this->url('default_about') ?>">Infos</a><br>
	    					<a href="<?= $this->url('user_contact') ?>">Contact</a><br>
	    					<?php if(!isset($_SESSION['user'])) : ?>
                            	<a id="connect" href="<?= $this->url('user_login') ?>">Connexion</a><br>
                        	<?php else : ?>
                            	<a id="disconnect" href="<?= $this->url('user_logout') ?>">Déconnexion</a><br>
                        	<?php endif ?>
                        	<a href="<?= $this->url('user_signin') ?>">S'inscrire</a>
	    				</p>
	    			</div>
	    			<div class="col-xs-12 col-sm-3 thirdCol">
						<p>
	    					<a href="<?= $this->url('display_CGU') ?>">Mentions légales</a><br>
						</p>
						<p>
							<a href="https://www.facebook.com/PizzTruck-1899035546992648"><img src="<?= $this->assetUrl('img/facebook.png') ?>" alt="icone facebook" width="40px" height="40px"></a>
							<a href=""><img src="<?= $this->assetUrl('img/twitter.png') ?>" alt="icone twitter" width="40px" height="40px"></a>
							<a href=""><img src="<?= $this->assetUrl('img/instagram.png') ?>" alt="icone instagram" width="40px" height="40px"></a>
						</p>
	    			</div>
	    			<div class="col-xs-12 text-right">
	    				<p>
	    					©Pizz’Truck 2016
	    				</p>
	    			</div>
		        </div>
	        </div>
		</footer>
		<!-- /Footer -->
	
	</div>
	<!-- /Container englobant l'ensemble de la page -->

	<script
  	src="https://code.jquery.com/jquery-2.2.4.min.js"
  	integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  	crossorigin="anonymous"></script>
  	<script
  	src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  	integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  	crossorigin="anonymous"></script>
  	<!-- Bootstrap Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	
  	<!-- Script captcha -->
  	<script src='https://www.google.com/recaptcha/api.js'></script>
	<!-- Fichier Script Tokens JS -->
	<script src="<?= $this->assetUrl('dist/bootstrap-tokenfield.min.js') ?>"></script>
	<!-- Fichier Script JS -->
	<script src="<?= $this->assetUrl('js/script.js') ?>"></script>

	<?= $this->section('scripts') ?>

</body>
</html>