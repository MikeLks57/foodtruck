function menuToggle() {
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
}

function sendSms(){
    $('input#sendSms').click(function(e){
        e.preventDefault();
        var url = $("#sendSms").val();
        console.log(url);
        $.ajax({
            method: 'POST',
            url: url,
        }).done(function(r){
            $('input#sendSms').addClass('hide');
            $('#stopCommand').removeClass('hide');
        });
    })
}

function deleteCommand(){
    $('input#stopCommand').click(function(e){
        e.preventDefault();
        var url = $("#sendSms").val();
        console.log(url);
        $.ajax({
            method: 'POST',
            url: url,
        }).done(function(r){
            $('input#stopCommand').addClass('hide');
            $('#sendSms').removeClass('hide');
        });
    })
}

$(document).ready(function()
{
    menuToggle();
    sendSms();
    deleteCommand();
});