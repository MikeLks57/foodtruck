function menuToggle() {
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
}

function searchUser(){
    $('.search').on('input', function(){
        var $this = $(this);
        var searchUser = $('#searchUser').val();
        var url = $('#url_search_user').val();

        if (searchUser == "") {
            document.location.href="/foodtruck/w/public/admin-role";
        } else {
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    form: $this.parent('form').serialize(),
                    searchUser: searchUser
                }
            }).done(function (r) {
                $('#usersFind').html(r);
            });
        }
    });
}

function updateEvent() {
    $('body').on('click', ".updateUser" ,function(e)
    {
        e.preventDefault();
        var id = $(this).data('id');
        var role = $('#idRole'+id).val();
        var url = $('#updateRole').val();

        console.log(role);
        console.log(id);
        console.log(url);
        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'json', // selon le retour attendu
            data: {
                    id : id,
                    role: role
            }
        }).done(function(r){
            $('.success').addClass('hide');
        }).always(function(r){
            $('.success.update').removeClass('hide');
        })
    });
}


$(document).ready(function()
{
    menuToggle();
    searchUser();
    updateEvent();
});