<?php $this->layout('layout', ['title' => 'Accueil']) ?>


<?php $this->start('main_content') ?>

<!-- Affichage du titre -->

<div class="row title">
	<div class="col-xs-12">
		<img src="<?= $this->assetUrl('img/PizzTruck.png') ?>" alt="Titre Pizz'Truck" class="img-responsive center-block">
		<img src="<?= $this->assetUrl('img/logo.png') ?>" alt="Logo Pizz'Truck" id="logo" class="img-responsive center-block" width="180px">

	</div>
</div>


<!-- Affichage du carousel -->

<div class="row carousel">
	<div class="col-xs-12">
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

			<!-- Indicators -->
			<ol class="carousel-indicators">
			<?php $i=0; foreach ($allSlider as $slider) :  ?>
				<li data-target="#carousel-example-generic" data-slide-to="0" <?php if($i === 0) echo 'class="active"' ?>></li>
			<?php $i++; endforeach; ?>
			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
				
				<?php $i=0; foreach ($allSlider as $slider): ?>
					<!-- Boucle pour passer la class active uniquement à l'image 0 -->
					<div class="item<?php if($i === 0) echo ' active' ?>">
						<img src="<?php echo $this->assetUrl('img/'.$slider['url']) ?>" class="center-block" alt="<?= $slider['title'] ?>">
						<div class="carouselFigcaption">
							<div class="carousel-caption">
								<h2><?= $slider['title'] ?></h2>
								<p><?= $slider['description'] ?></p>
							</div>
						</div>
					</div>
				<!-- Incrémentation des images à chaque boucle pour changer d'image -->
				<?php $i++; endforeach; ?>

			</div>

			<!-- Controls -->
			<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
				<img src="<?= $this->assetUrl('img/flecheGaucheCarousel.png') ?>" alt="" class="glyphicon glyphicon-chevron-left" aria-hidden="true" max-width="30" max-height="30">
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control"  href="#carousel-example-generic" role="button" data-slide="next">
				<img src="<?= $this->assetUrl('img/flecheDroiteCarousel.png') ?>" alt="" class="glyphicon glyphicon-chevron-right" aria-hidden="true">
				<span class="sr-only">Next</span>
			</a>

		</div>
	</div>
</div>

<!-- Icones de présentation -->
<section class="welcome">
	<div class="row welcome">
		<div class="col-xs-12">
			<div class="row">
				<h2>Bienvenue</h2>
				<div class="col-xs-12 col-sm-4">
					<div class="rond center-block"><img src="<?= $this->assetUrl('img/iconeMenu.png')?>" id="iconeMenu" alt="icone de menu" class="img-responsive center-block"></div>
					<h3>Consultez notre carte en ligne</h3>
					<p>Margharita, Reine, Saumonita... Toutes nos pizzas sont cuites au feu de bois et préparées avec les meilleurs ingrédients. Le plus dur sera de choisir...</p>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="rond center-block"><img src="<?= $this->assetUrl('img/iconeClic.png')?>" alt="icone de commande" class="img-responsive center-block"></div>
					<h3>Commandez en un clic</h3>
					<p>Et payez directement en ligne! Rapide, pratique et sécurisé, plus besoin de compter la monnaie</p>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="rond center-block"><img src="<?= $this->assetUrl('img/iconeBoite.png')?>" alt="icone de boite" class="img-responsive center-block"></div>
					<h3>Récupérez votre commande</h3>
					<p>Vous recevez un sms lorsque notre pizzaiolo commence votre commande! Plus de temps d'attente pour venir récupérer votre précieuse cargaison!</p>
				</div>
			</div>
		</div>
	</div>
</section>


<!-- Affichage des images à la une -->

<section class="highlightPictures">
	<div class="row highlightPictures">
		<div class="col-xs-12">
			<div class="row">
				<div class="col-xs-12 col-md-6 thumbnailsContainer">
					<div class="row">
						<div class="col-xs-12">
							<h2>Nos meilleures ventes</h2>
							<div class="col-xs-6 thumbnails">
								<img src="<?= $this->assetUrl('img/highlight1.png') ?>" alt="Pepperoni" class="img-responsive">
							</div>
							<div class="col-xs-6 thumbnails">
								<img src="<?= $this->assetUrl('img/highlight2.jpg') ?>" alt="Vesuvia" class="img-responsive">
							</div>
							<div class="col-xs-6 thumbnails">
								<img src="<?= $this->assetUrl('img/highlight3.jpg') ?>" alt="Pizza Roma" class="img-responsive">
							</div>
							<div class="col-xs-6 thumbnails">
								<img src="<?= $this->assetUrl('img/highlight4.jpg') ?>" alt="Pizza Poulet" class="img-responsive">
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-6 fullpicContainer">
					<div class="col-xs-12 fullpic">
						<figure class="figure">
							<img src="<?= $this->assetUrl('img/highlight3.jpg') ?>" alt="Pizza Roma" class="img-responsive fullpic">
							<figcaption class="figure-caption highlightFullpic"><h3>Eternelle Pizza Roma</h3><p>Un grand classique revisité pour l\'occasion. Le tout parsemé de basilic frais</p></figcaption>
						</figure>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="nousTrouver">
	<div class="row nousTrouver">
		<div class="col-xs-12">
			<h2>Nous trouver</h2>

			<!-- Boucle pour sélectionner le jour de la semaine -->
			<label for="selectDay" class="selectDay">Selectionner le jour où vous souhaitez retirer votre commande :</label>

			<?php 
			$dates = array(0 => 'Lundi', 1 => 'Mardi', 2 => 'Mercredi', 3 => 'Jeudi', 4 => 'Vendredi', 5 => 'Samedi'); ?>

			<select name="selectDay" id="selectDay">
			<?php foreach ($dates as $date => $day) {
			    echo '<option value="' . $date .'">' . $day . '</option>';
			};
			?>
			</select>
			<!-- Fin de la boucle pour sélectionner le jour de la semaine -->


			<!-- Début de l'affichage de la map -->
			<div id="container">
			    <div id="map">
			        Veuillez patienter pendant le chargement de la carte...
			    </div>
			</div>

		</div>
	</div>
</section>

<?php $this->stop('main_content') ?>


<?php $this->start('scripts'); ?>

<script>
    var markers = [];
    var map;
    function initMap() {
        // Création de la carte dans le DOM.
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 49.259, lng: 6.178},
          scrollwheel: true,
          zoom: 10
      });
        /*Boucle permettant de générer les pointeurs avec coordonées sur la carte avec incrémentation car il y a 6 ID de pointeurs.*/
        <?php foreach($allMap as $map): ?>
        markers.push(new google.maps.Marker({
            position: {lat: <?=$this->e($map['lat'])?>, lng: <?=$this->e($map['lng'])?>},
            map: map,
            title:  '<?=$this->e($map['title'])?>',
            icon: '<?= $this->assetUrl('img/pizzaCursor.png') ?>'
        }));
    <?php endforeach; ?>
    /*Fonction pour cacher tous les marqueurs*/
    markers.forEach( function(element, index) {
        element.setMap(null);
    });
    /*Fonction pour seléctionner le lieu à afficher selon le jour sélectionné*/
    markers[document.getElementById('selectDay').value].setMap(map);
}
</script>
<!-- Fin de l'affichage de la map -->

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYCfeM7STNK-THLChOV9aoxmX7BKLAUQQ&callback=initMap"
async defer></script>

<?php $this->stop('scripts'); ?>





