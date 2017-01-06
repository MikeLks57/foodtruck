 <?php  $this->layout('layout') ?>

 <?php $this->start('main_content'); ?>



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


<?php 
$this->stop('main_content'); 

$this->start('scripts'); ?>

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

<?php 
$this->stop('scripts'); ?>