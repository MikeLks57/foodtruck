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
});

