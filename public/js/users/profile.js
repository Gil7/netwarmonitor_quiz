$(document).ready(function () {
    $.ajax({
        url: '/getMyProfile',
        success: function(data){
            $("#name").val(data.user.name)
            $("#email").val(data.user.email)
            $("#user_id").val(data.user.id)
        },
        error: function(err){

        },
        complete: function(){

        }
    })
    $("#btn_update_profile").on('click', function(e){
        e.preventDefault();
        var data = $("#form_profile").serialize();
        var id = $("#user_id").val();
        $.ajax({
            url : '/users/' + id,            
            method : 'PUT',
            data : data,
            success: function(data){
                console.log(data)
                swal(data.message, {
                    icon: "warning",
                });
                
            },
            error: function(err){
                console.log(err)
                swal("Ha surgido un error, vuelve a intentarlo", {
                    icon: "warning",
                });
            }
        })
    })
});