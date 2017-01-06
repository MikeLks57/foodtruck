<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $this->e($title) ?></title>
	<!-- polices -->
	<link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Catamaran" rel="stylesheet">

	<!-- Bootstrap Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- Bootstrap Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Fichier CSS -->
	<link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/admin-style.css') ?>">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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
				        	<li class="active"><a href="<?= $this->url('default_home') ?>">Accueil<span class="sr-only">(current)</span></a></li>
				        	<li><a href="<?= $this->url('display_menu') ?>">Carte</a></li>
				        	<li><a href="">Infos</a></li>
				        	<li><a href="">Contact</a></li>
				        	<li><a href="">Connexion</a></li>
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
	    					<a href="">Plan du site</a><br>
	    					<a href="">Accueil</a><br>
	    					<a href="">Carte</a><br>
	    					<a href="">Infos</a><br>
	    					<a href="">Contact</a><br>
	    					<a href="">Connexion</a><br>
	    				</p>
	    			</div>
	    			<div class="col-xs-12 col-sm-3 thirdCol">
						<p>
							<a href="">Charte des réseaux sociaux</a><br>
	    					<a href="">Mentions légales</a><br>
	    					<a href="">CGU</a><br>
						</p>
						<p>
							<a href=""><img src="" alt=""></a>
							<a href=""><img src="" alt=""></a>
							<a href=""><img src="" alt=""></a>
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

	<?= $this->section('scripts') ?>
	<!-- Jquery 3.0.0 slim minified -->
	<!-- <script
	src="https://code.jquery.com/jquery-3.0.0.slim.min.js"
	integrity="sha256-Rf4BadfyCtsvHmO89BUZcbYvNNvZvOT08ALfEzvCsD0="
	crossorigin="anonymous"></script> -->
	<!-- Script jQuery -->
	<!-- <script
	  	src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
	  	integrity="sha256-/SIrNqv8h6QGKDuNoLGA4iret+kyesCkHGzVUUV0shc="
	  	crossorigin="anonymous"></script> -->
  	<script
  	src="https://code.jquery.com/jquery-2.2.4.min.js"
  	integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  	crossorigin="anonymous"></script>
  	<script
  	src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  	integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  	crossorigin="anonymous"></script><!-- Bootstrap Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	
  	<!-- Script captcha -->
  	<script src='https://www.google.com/recaptcha/api.js'></script>
	
	<!-- Fichier Script JS -->
	<script src="<?= $this->assetUrl('js/script.js') ?>"></script>

</body>
</html>