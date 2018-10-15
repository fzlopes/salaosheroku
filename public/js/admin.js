$(function(){

    /**
     * Envio/validação do fomulário de alterar dados pessoais
     */
    $('#formChangeProfile').on('submit',function(e){
        e.preventDefault(e);

        $.ajax({
            type:"POST",
            url:'/user/'+$('input[name=userId]').val()+'/change-profile',
            data:$(this).serialize(),
            dataType: 'json',
            success: function(data){
                $( "#alert-messages" ).html('' +
                    '<div class="alert alert-success alert-dismissable" id="alertSucesso">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>' +
                    '<strong>Maravilha!</strong> ' + data.message +
                    '</div>'
                );
                $("#alert-messages").removeClass("hide");
            },
            error : function(data){


                var errors = $.parseJSON(data.responseText);
                var errorsMessage = '';
                for(var index in errors) {
                    errorsMessage = errorsMessage +
                        '<div class="alert alert-danger alert-dismissable">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>' +
                        '<strong>Erro:</strong> ' + errors[index] +
                        '</div>';
                }
                $("#alert-messages").html(errorsMessage);
                $("#alert-messages").removeClass("hide");
            }
        })
    });

    /**
     * Envio/validação do fomulário de alterar foto
     */
    $('#formChangePicture').on('submit',function(e){
        e.preventDefault(e);

        if (!$('#picture').val()) {
            $( "#alert-messages" ).html('' +
                '<div class="alert alert-danger alert-dismissable">' +
                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>' +
                '<strong>Erro:</strong> É obrigatório escolher uma foto para poder alterar sua imagem do perfil.' +
                '</div>'
            );
            $("#alert-messages").removeClass("hide");
            return;
        } else {
            $("#alert-messages").addClass("hide");
        }

        var formData = new FormData($('#formChangePicture')[0]);

        $.ajax({
            type:"POST",
            url:'/user/'+$('input[name=userId]').val()+'/change-picture',
            data:formData,
            processData: false,
            contentType: false,
            cache : false,
            dataType: 'json',
            success: function(data){
                $( "#alert-messages" ).html('' +
                    '<div class="alert alert-success alert-dismissable" id="alertSucesso">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>' +
                    '<strong>Maravilha!</strong> ' + data.message +
                    '</div>'
                );
                $("#alert-messages").removeClass("hide");
            },
            error : function(data){
                var errors = $.parseJSON(data.responseText);
                $( "#alert-messages" ).html('' +
                    '<div class="alert alert-danger alert-dismissable">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>' +
                    '<strong>Erro:</strong> ' + ((errors.message != null) ? errors.message : errors.picture[0]) +
                    '</div>'
                );
                $("#alert-messages").removeClass("hide");
            }
        });
    });

    /**
     * Envio/validação do fomulário de alterar senha
     */
    $('#formChangePassword').on('submit',function(e){
        e.preventDefault(e);

        if ($("#password_confirmation").val() != $("#password").val()) {
            $('#password_confirmation').parent().addClass('has-error');
            return;
        }

        $.ajax({
            type:"POST",
            url:'/user/'+$('input[name=userId]').val()+'/change-password',
            data:$(this).serialize(),
            dataType: 'json',
            success: function(data){
                console.log(data);
                $('#formChangePassword')[0].reset();
                $( "#alert-messages" ).html('' +
                    '<div class="alert alert-success alert-dismissable" id="alertSucesso">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>' +
                    '<strong>Maravilha!</strong> ' + data.message +
                    '</div>'
                );
                $("#alert-messages").removeClass("hide");
            },
            error : function(data){
                var errors = $.parseJSON(data.responseText);
                $( "#alert-messages" ).html('' +
                    '<div class="alert alert-danger alert-dismissable">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>' +
                    '<strong>Erro:</strong> ' + ((errors.message != null) ? errors.message : errors.password[0]) +
                    '</div>'
                );
                $("#alert-messages").removeClass("hide");
            }
        })
    });

    /**
     * Validação da confirmação de senha no formulário de alteração de senha
     */
    $('#password_confirmation').keyup(function () {
        if ($("#password_confirmation").val() == $("#password").val()) {
            $('#password_confirmation').parent().removeClass('has-error');
        } else {
            $('#password_confirmation').parent().addClass('has-error');
        }
    });

    /**
     * Remover imagem do perfil
     */
    $('#formRemovePicture').on('submit',function(e){
        e.preventDefault(e);
        console.log('teste');

        $.ajax({
            type:"POST",
            url:'/user/'+$('input[name=userId]').val()+'/remove-picture',
            data:$(this).serialize(),
            dataType: 'json',
            success: function(data){
                $( "#alert-messages" ).html('' +
                    '<div class="alert alert-success alert-dismissable" id="alertSucesso">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>' +
                    '<strong>Maravilha!</strong> ' + data.message +
                    '</div>'
                );
                $("#alert-messages").removeClass("hide");
            },
            error : function(data){
                var errors = $.parseJSON(data.responseText);
                $( "#alert-messages" ).html('' +
                    '<div class="alert alert-danger alert-dismissable">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>' +
                    '<strong>Erro:</strong> ' + errors.message +
                    '</div>'
                );
                $("#alert-messages").removeClass("hide");
            }
        });
    });


    $("#btnCancel1").click(function() {
        $("#tab1").toggleClass("active");
        $("#tab2").toggleClass("active");
    });
    $("#btnCancel2").click(function() {
        $("#tab1").toggleClass("active");
        $("#tab3").toggleClass("active");
    });


});