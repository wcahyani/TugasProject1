$('document').ready(function()
{
    //fungsi hilangkan tanda error jika form di submit
    //a = id form
    function refreshError(a){
        a.find('.error-box').empty();
        a.find('.glyphicon').remove();
        a.find('.form-group').removeClass('has-error has-feedback');
    }

    //hilangkan tanda error jika ada perubahan pd text field
    $('.form-control, .form-file').change(function(){
        var formGroup = $(this).parents('.form-group');

        formGroup.find('.error-box').empty();
        formGroup.removeClass('has-error has-feedback');
        formGroup.find('.glyphicon').remove();
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
        refreshError($(this));

        var url = '../action/login.php';
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
                //redirect setelah login sukses
                window.location.href = 'index.html';
            }
        });
    })

    //form register
    $('#formregister').submit(function(e){
        e.preventDefault();
        refreshError($(this));

        var url = 'action/register.php';
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
                alert('hi');
                //redirect ke index
            }
        });
    });

    //form update data profil
    $('#formUpdateProfil').submit(function(e){
        e.preventDefault();
        refreshError($(this));
        
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

    //form input produk
    $('#formInsertProduk').submit(function(e){
        e.preventDefault();
        refreshError($(this));

        var url = 'action/produk.php?action=insert';
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
                    $.each(data.error, function(key, value){
                        $('#'+ key +'Error').text(value);
                        $('#'+ key).parents('.form-group').addClass('has-error has-feedback');
                        $('#'+ key).after('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
                    });
                }
                else{
                    alert('hey');
                    //$('#mymodaleditgambar').modal('hide');
                    //load ulang table produk
                }
            }
        });
    });

    //form edit produk
    $('#formEditProduk').submit(function(e){
        e.preventDefault();
        refreshError($(this));

        var url = 'action/produk.php?action=update';
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
                    $.each(data.error, function(key, value){
                        $('#'+ key +'Error').text(value);
                        $('#'+ key).parents('.form-group').addClass('has-error has-feedback');
                        $('#'+ key).after('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
                    });
                }
                else{
                    alert('hey');
                    //$('#mymodaleditgambar').modal('hide');
                    //load ulang table produk
                }
            }
        });
    });

    //delete data produk
    $('.hapus').click(function(e){
        e.preventDefault();
        var ids = $(this).data('id');

        var url = 'action/produk.php?action=delete';
        var data = {id : ids};

        $.get(url, data, function(){
            //load ulang table produk
        });
    });
});