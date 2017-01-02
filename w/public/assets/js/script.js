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


$(document).ready(function(){
    menuToggle();
    countUploadedFile();
    uploadFile();
    changeClassBtnBrowse();
    refreshSliderPictures();
    deletePic();

})