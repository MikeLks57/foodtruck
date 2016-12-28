
$(function(){
    $('.order').click(function(e){
        e.preventDefault();
        var $this = $(this);
        var supplements = $('#supplement').val();

        $.ajax({
            url : $('#url_order').val(),
            method : 'post',
            data: $this.parent('form').serialize(),

        }).done(function(r){
            // Si ajout, affichage les produits dans la commande
            $('#command').html(r);
            console.log(r);
        }).always(function(r){
            $('#command').html(r);
            console.log('success');
        });
    });

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
        }).always(function(r){
            $('#command').html(r);
        });
    });
 


/*Fonction pour cacher les marqueurs de GoogleMap et afficher uniquement celui du jour sélectionner. A ne pas effacer malgré le doublon dans le fichier map.php*/

    $('#selectDay').change(function(){
        markers.forEach( function(element, index) {
            element.setMap(null);
        });

        markers[document.getElementById('selectDay').value].setMap(map);
    });
});
/*Fin de la fonction pour la map*/

