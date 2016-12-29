/*Fonction pour cacher les marqueurs de GoogleMap et afficher uniquement celui du jour sélectionner. A ne pas effacer malgré le doublon dans le fichier map.php*/
$(function(){
    $('#selectDay').change(function(){
        markers.forEach( function(element, index) {
            element.setMap(null);
        });

        markers[document.getElementById('selectDay').value].setMap(map);
    });
});
/*Fin de la fonction pour la map*/




/*Fonction pour l'éditeur de texte dans About côté Admin*/

tinymce.init({
  selector: "textarea",  
  plugins: "autosave",				/*Ajoute l'utilisation sauvegarde automatique*/
  toolbar: "restoredraft",			/*Sauvegarde automatique*/
  plugins: "textcolor",				/*Ajoute l'utilisation du choix de couleurs de texte*/
  toolbar: "forecolor backcolor",	/*Ajoute le bouton de choix de couleurs pour le texte dans la toolbar*/
});
/*Fin de la fonction pour l'éditeur de texte dans About côté Admin*/