$(document).ready(function() {
    var registerForm = $("#registerForm");
    registerForm.submit(function(e){
        e.preventDefault();
        var formData = registerForm.serialize();
        $('#username-error').html("");
        $('#email-error').html("");
        $('#password-error').html("");
        $("#register-username").removeClass("has-error");
        $("#register-email").removeClass("has-error");
        $("#register-password").removeClass("has-error");

        $.ajax({
            url:'/register',
            type:'POST',
            data:formData,
            success:function(data){
                location.reload(true);
            },
            error: function (data) {
                console.log(data.responseText);
                var obj = jQuery.parseJSON( data.responseText );
               if(obj.username){
                    $("#register-username").addClass("has-error");
                    $('#username-error').html( obj.username );
                }
                if(obj.email){
                    $("#register-email").addClass("has-error");
                    $('#email-error').html( obj.email );
                }
                if(obj.password){
                    $("#register-password").addClass("has-error");
                    $('#password-error').html( obj.password );
                }
            }
        });
    });
});