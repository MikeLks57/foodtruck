function menuToggle() {
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
}

function sendSms(){
    $('input.sendSms').click(function(e){
        e.preventDefault();
        var url = $("#sendSms").val();
        var orderId = $(this).attr('data-orderId');
        var orderBtn = $(this);
        var orderIdSiblings = orderBtn.siblings();
        console.log(orderIdSiblings);
        console.log(url);
        console.log(orderId);
        
        $.ajax({
            method: 'POST',
            url: url,
            data: {
                order: orderId,
            }
        }).done(function(r){
            orderBtn.addClass('hide');
            orderIdSiblings.removeClass('hide');
            console.log(r);
        });
    })
}

function deleteCommand(){
    $('input.stopCommand').click(function(){
        var url = $("#stopCommand").val();
        var orderId = $(this).attr('data-orderId');
        var deleteBtn = $(this);
        console.log(url);
        $.ajax({
            method: 'POST',
            url: url,
            data: {
                order: orderId,
            }
        }).done(function(r){
            deleteBtn.addClass('hide');
        });
    })
}

$(document).ready(function()
{
    menuToggle();
    sendSms();
    deleteCommand();
});