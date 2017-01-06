function menuToggle() {
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
}

function refreshSliderPictures()
{
    var url = $("#showSliderPicsRoute").val();
    $.ajax({
        method: 'POST',
        url: url,
        data: 'json',
    }).done(function(r){
        var allSliderPics = "";
        r.sliderPictures.forEach(function(pics, key){
            allSliderPics +=  '<div class="col col-xs-12 col-sm-3 divImg">' + '<img src="assets/uploads/slider/' + pics.url + '" alt="' + pics.description + '" class="' + 'col-xs-12 img-thumbnail">'
                + '<input type="checkbox"' + 'class="checkImg"' + 'data-id="' + pics.id + '">' +
                '<span class="glyphicon glyphicon-remove alert-danger deleteImg"' + 'data-id="' + pics.id + '" data-url="' + pics.url + '"aria-hidden="' + 'true"></span>' + '</img></div>'
        });
        $("div.showImg").html(allSliderPics);
    });
}

function uploadFile()
{
    $('#sliderForm').on('submit', function(e) {
        // On empêche le navigateur de soumettre le formulaire
        e.preventDefault();

        var url = $("#addSliderPicsRoute").val();
        var formadata = new FormData(this);

        $.ajax({
            url: url,
            type: 'POST',
            contentType: false,
            processData: false,
            dataType: 'json', // selon le retour attendu
            data:formadata

        }).done(function(r) {
            $('.error').addClass('hide');
            var errorsTable = r.errors;
            if(errorsTable !== undefined) { // Si erreurs
                if(errorsTable.titleEmpty !== undefined ) {
                    $('.error.title-empty').removeClass('hide')
                }
                if(errorsTable.descriptionEmpty !== undefined) {
                    $('.error.description-empty').removeClass('hide')
                }
                if(errorsTable.fileEmpty !== undefined) {
                    $('.error.file-empty').removeClass('hide')
                }
                if(errorsTable.fileType !== undefined) {
                    $('.error.file-type').removeClass('hide')
                }
                if(errorsTable.fileSize !== undefined) {
                    $('.error.file-sizeMin').removeClass('hide')
                }
                if(errorsTable.fileSizeMax !== undefined) {
                    $('.error.file-sizeMax').removeClass('hide')
                }
                if(errorsTable.fileWeightMin !== undefined) {
                    $('.error.file-weightMin').removeClass('hide')
                }
                if(errorsTable.fileWeightMax !== undefined) {
                    $('.error.file-weightMax').removeClass('hide')
                }
                if(errorsTable.fileLoad !== undefined) {
                    $('.error.file-load').removeClass('hide')
                }
            }
            countUploadedFile()
            refreshSliderPictures();
        });
    });
}
function changeClassBtnBrowse()
{
    $('#btnBrowse').on('change', function(e){
        e.preventDefault();
        $('.glyphicon').removeClass('glyphicon-plus');
        $('.glyphicon').addClass('glyphicon-ok');

    })
}

function countUploadedFile()
{
    var url = $("#countSliderPicsRoute").val();
    $.ajax({
        url: url,
        type: 'GET',
    }).done(function (r) {
        $('#submit-file').removeClass("disabled");
        if(r >= 4) {
            $('#submit-file').addClass("disabled");
            $('#submit-file').click(function(e){
                if($(this).hasClass('disabled')) {
                    e.preventDefault();
                }
            });
        }
    });
}

function deletePic()
{
    $('body').on('click', ".deleteImg" ,function(e)
    {
        e.preventDefault();
        var filePathImg = "assets/uploads/img/" + $(this).data('url') ;
        var filePathSlider = "assets/uploads/slider/" + $(this).data('url');
        var idPic = $(this).data('id');
        var url = $("#deleteSliderPicsRoute").val();
        $.ajax({
                method: 'POST',
                url: url,
                data:{
                    idPic: idPic,
                    filePathImg: filePathImg,
                    filePathSlider: filePathSlider,
                },
            }).done(function(e)
                {
                    $('body>div.divImg').remove();
                    refreshSliderPictures();
                    countUploadedFile();
                });
    })
}

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
        var supplements = $('#supplement').val();

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

function map()
{
    /*Fonction pour cacher les marqueurs de GoogleMap et afficher uniquement celui du jour sélectionner. A ne pas effacer malgré le doublon dans le fichier map.php*/
    $('#selectDay').change(function(){
        markers.forEach( function(element, index) {
            element.setMap(null);
        });

        markers[document.getElementById('selectDay').value].setMap(map);
    });
    /*Fin de la fonction pour la map*/

}

function sendAbout()
{
    $('#about-form').submit(function(){
        $('#aboutContent').val($('#editeur').html());
    });
}

function editTexte() {
  tinymce.init({
    selector: '#editeur',
    width: "100%",
    height: "350",
  });
}


$(document).ready(function(){
    menuToggle();
    countUploadedFile();
    uploadFile();
    changeClassBtnBrowse();
    deletePic();
    deleteProductEvent();
    addProductEvent();
    searchProduct();
    map();
    refreshSliderPictures();
    if($('#admin').length > 0) {
       /* Utilise un input hidden qui sert à dire qu'une page est une page admin.
        > la condition sert à dire que seules les pages admin chargent ces scripts.*/
        sendAbout();
        editTexte();
    }
    
})