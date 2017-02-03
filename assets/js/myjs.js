$('document').ready(function()
{
    //hilangkan tanda error jika ada perubahan pd text field
    $('.form-control, .form-file').change(function(){
        $(this).siblings('.error-box').empty();
        $(this).parents('.form-group').removeClass('has-error has-feedback');
        $(this).siblings('.glyphicon').remove();
    });

    //reset form saat modal ditutup
    $('.modal').on('hidden.bs.modal', function(){
        $('.error-box').empty();
        $(this).find('form').trigger("reset");
        $(this).find('.form-group').removeClass('has-error has-feedback');
        $(this).find('.glyphicon').remove();
    });

    //form login
    $('#formlogin').submit(function(e){
        e.preventDefault();
        var url = 'action/login.php';
        var data = $(this).serialize();

        $.post(url, data, function(result){
            var data = JSON.parse(result);

            if(data.hasil != 'sukses'){
                $.each(data.error, function(key, value){
                    $('#'+ key +'Error').text(value);
                    $('#'+ key).parents('.form-group').addClass('has-error has-feedback');
                    $('#'+ key).after('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
                });
            }
            else{
                //redirect ke halaman utama
            }
        });
    })

    //form update data profil
    $('#formUpdateProfil').submit(function(e){
        e.preventDefault();
        var url = 'action/profil.php?action=editprofil';
        var data = $(this).serialize();

        $.post(url, data, function(result){
            var data = JSON.parse(result);

            if(data.hasil != 'sukses'){
                $.each(data.error, function(key, value){
                    $('#'+ key +'Error').text(value);
                    $('#'+ key).parents('.form-group').addClass('has-error has-feedback');
                    $('#'+ key).after('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
                });
            }
            else{
                $('#mymodaledit').modal('hide');
                //load ulang profil page
            }
        });
    });

    //form update foto profil
    $('#formgantifoto').submit(function(e){
        e.preventDefault();
        var url = 'action/profil.php?action=editfoto';
        var data = new FormData($(this)[0]);

        $.ajax({
			url 		: url,
			type		: 'POST',
			data 		: data,
			cache 		: false,
			contentType : false,
			processData : false,
			success		: function(result){
                var data = JSON.parse(result);

                if(data.hasil != 'sukses'){
                    $('#editFotoError').text(data.error.file);
                }
                else{
                    $('#mymodaleditgambar').modal('hide');
                    //load ulang profil page
                }
            }
        });
    });
});