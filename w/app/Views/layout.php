<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?= $this->e($title) ?></title>

	<!-- polices -->

	<!-- Bootstrap Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Bootstrap Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>">
</head>
<body>
	<div class="container">
		<header class="main-header">
			<nav class="navbar navbar-default">
		  		<div class="container-fluid navbar-default">
		  			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        		<span class="sr-only">Toggle navigation</span>
		        		<span class="icon-bar"></span>
		        		<span class="icon-bar"></span>
		        		<span class="icon-bar"></span>
		        		<span class="icon-bar"></span>
		        		<span class="icon-bar"></span>
			      	</button>
			    	<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
			    		<ul class="nav navbar-nav">
				        	<li class="active"><a href="<?= $this->url('default_home') ?>">Accueil<span class="sr-only">(current)</span></a></li>
				        	<li><a href="">Carte</a></li>
				        	<li><a href="">Infos</a></li>
				        	<li><a href="">Contact</a></li>
				        	<li><a href="">Connexion</a></li>
			      		</ul>
      				</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav><!-- /.nav.navbar-default -->	
		</header><!-- /.main-header -->

		<section>
			<?= $this->section('main_content') ?>
		</section>

		<footer>
			<div class="container-fluid footer-default">
        		<div class="row">
        			<div class="col-xs-12 col-md-5">
        				<p>
        					Inscrivez vous à notre newsletter<br>
        					et recevez nos promotions en exclusivité
        				</p>
        				<p>
        					<form action="#" method="POST">
        						<input type="text" name="newsletter">
        						<input type="submit" name="validNewsletter">
        					</form>
        				</p>
        				<p>
        					©Pizz’Truck 2016
        				</p>
        			</div>
        			<div class="col-md-4">
        				<p>
        					<a href="">Plan du site</a><br>
        					<a href="">Accueil</a><br>
        					<a href="">Carte</a><br>
        					<a href="">Infos</a><br>
        					<a href="">Contact</a><br>
        					<a href="">Connexion</a><br>
        				</p>
        			</div>
        			<div class="col-md-3">
						<p>
							<a href="">Charte des réseaux sociaux</a><br>
        					<a href="">Mentions légales</a><br>
        					<a href="">CGU</a><br>
						</p>
						<p>
							/Icones Réseaux sociaux\
						</p>
        			</div>
        			<!-- <div class="col-xs-12">
        				<p>
        					/Icones Réseaux sociaux\
        				</p>
        			</div>
        			<div class="col-xs-12">
        				Plan du site
        			</div>
        			<div class="col-xs-12">
        				<a href="">Accueil</a> | <a href="">Carte</a> | <a href="">Infos</a> | <a href="">Contact</a> | <a href="">Connexion</a>
        			</div>
        			<div class="col-xs-12">
        				<p>
        					©Pizz’Truck 2016
        				</p>
        			</div> -->
	        	</div><!-- <div class="row"> -->
	        </div><!-- <div class="container-fluid footer-default"> -->
		</footer>
	</div><!-- <div class="container"> -->

	<!-- Jquery 3.0.0 slim minified -->
	<script
	src="https://code.jquery.com/jquery-3.0.0.slim.min.js"
	integrity="sha256-Rf4BadfyCtsvHmO89BUZcbYvNNvZvOT08ALfEzvCsD0="
	crossorigin="anonymous"></script>
	<!-- Bootstrap Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<!-- Fichier Script JS -->
	<script src="<?= $this->assetUrl('js/script.js') ?>"></script>

</body>
</html>