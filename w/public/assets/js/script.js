$(function(){
    function deleteProductEvent(){
        $('.delete').click(function(e){
            e.preventDefault();
            var $this = $(this);
            $.ajax({
                url : $('#url_delete').val(),
                method : 'post',
                data: {
                    form: $this.parent('form').serialize(),
                    nbProduct: $this.attr('data-id'),
                }
            }).done(function(r){
                // Si ajout, affichage les produits dans la commande
                $('#command').html(r);
                deleteProductEvent();
            }).always(function(r){
                $('#command').html(r);
                deleteProductEvent();
            });
        });
    }

    $('.order').click(function(e){
        e.preventDefault();
        var $this = $(this);
        $.ajax({
            url : $('#url_delete').val(),
            method : 'post',
            data: {
                form: $this.parent('form').serialize(),
                nbProduct: $this.attr('data-id'),
            }
        }).done(function(r){
            // Si ajout, affichage les produits dans la commande
            $('#command').html(r);
            deleteProductEvent();
        }).always(function(r){
            $('#command').html(r);
            deleteProductEvent();
        });
    });
}

function addProductEvent(){
    $('.order').click(function(e){
        e.preventDefault();
        var $this = $(this);

        $.ajax({
            url : $('#url_order').val(),
            method : 'post',
            data: $this.parent('form').serialize(),

        }).done(function(r){
            // Si ajout, affichage les produits dans la commande
            $('#command').html(r);
        }).always(function(r){
            $('#command').html(r);
            deleteProductEvent();
        });
    });       
}

function priceSupplement(){
    $('select.supplement').on('change', function(e){
        var optionPrice = 0;
        $('select.supplement').each(function(){
            if( $(this).find('option:selected').data('price') !== undefined) {
                optionPrice += $(this).find('option:selected').data('price');
            }

        })
        console.log(optionPrice);
        $('#supplement-price').val( optionPrice )
    });    
}

/*Fonction pour cacher les marqueurs de GoogleMap et afficher uniquement celui du jour sélectionner. A ne pas effacer malgré le doublon dans le fichier map.php*/
$('#selectDay').change(function(){
    markers.forEach( function(element, index) {
        element.setMap(null);
    });

function searchProduct(){
    $('.search').on('input', function(){
        var $this = $(this);
        var searchProduct = $('#search').val();

        if (searchProduct == "") {
           document.location.href="/foodtruck/w/public/menu";
       } else {
            $.ajax({
                url : $('#url_search').val(),
                method : 'post',
                data: {
                    form: $this.parent('form').serialize(),
                    searchpro: searchProduct,
                }
            }).done(function(response){
                $('#menu').replaceWith(response);
            });
       }  
    });
}

$(document).ready(function(){
    deleteProductEvent();
    priceSupplement();
    addProductEvent();
    searchProduct();
    /*Fin de la fonction pour la map*/
  /*Fonction pour l'éditeur de texte dans About côté Admin*/

    tinymce.init({
      selector: "textarea",  
      plugins: "autosave",				/*Ajoute l'utilisation sauvegarde automatique*/
      toolbar: "restoredraft",			/*Sauvegarde automatique*/
      plugins: "textcolor",				/*Ajoute l'utilisation du choix de couleurs de texte*/
      toolbar: "forecolor backcolor",	/*Ajoute le bouton de choix de couleurs pour le texte dans la toolbar*/
    });/*Fin de la fonction pour l'éditeur de texte dans About côté Admin*/
});

