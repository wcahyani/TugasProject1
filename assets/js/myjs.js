$('document').ready(function()
{
    //hilangkan error-box jika ada perubahan pd text field
    $('.form-control, .form-file').change(function(){
        $(this).siblings('.error-box').empty();
    });

    //reset form saat modal ditutup
    $('.modal').on('hidden.bs.modal', function(){
        $('.error-box').empty();
        $(this).find('form').trigger("reset");
    });

    //form update data profil
    $('#formUpdateProfil').submit(function(e){
        e.preventDefault();
        var url = 'action/profil.php?action=editprofil';
        var data = $(this).serialize();

        $.post(url, data, function(result){
            var data = JSON.parse(result);

            if(data.hasil != 'sukses'){
                $('#errorNama').text(data.error.nama_member);
                $('#errorAlamat').text(data.error.alamat_member);
                $('#errorTtl').text(data.error.ttl_member);
                $('#errorJk').text(data.error.jk_member);
                $('#errorHp').text(data.error.hp_member);
                $('#errorEmail').text(data.error.email);
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
                    $('#errorfile').text(data.error.file);
                }
                else{
                    $('#mymodaleditgambar').modal('hide');
                    //load ulang profil page
                }
            }
        });
    });
});