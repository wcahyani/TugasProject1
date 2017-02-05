$(document).ready(function()
{
    /*$('#dataTables-example').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url : "action/category.php?action=select",
            columns: [
                { "data": "nm_kategori"},
                { "data": "ket_kategori" },
            ]
        }
    });*/

    $('#tabel-kategori').DataTable();
    
    $('#tabel-produk').DataTable();

    //--------------------------------------------- Misc ----------------------------------------------------//

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

    //--------------------------------------------- Login/Register ----------------------------------------------------//

    //form login
    $('#formlogin').submit(function(e){
        e.preventDefault();
        refreshError($(this));

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
                //redirect setelah login sukses
                window.location.href = 'index.php';
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
                window.location.href = 'index.php?profil';
            }
        });
    });

    //--------------------------------------------- Profil ----------------------------------------------------//

    //ambil data untuk edit profil
    $('#editProfilButton').click(function(){
        var url = 'action/profil.php?action=datafoto';
        $.getJSON(url, function(result){
            $('#editNama').val(result.nama_member);
            $('#editAlamat').val(result.alamat_member);
            $('#editEmail').val(result.email);
            $('#editTlp').val(result.tlp_member);
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
                $.each(data.update, function(key, value){
                    $('#data'+ key).text(value);
                });

                $('#mymodaledit').modal('hide');
                $('#alert-box').html(
                    '<div class="alert alert-success">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                        '<strong>Berhasil : </strong> Data profil berhasil diperbaharui' +
                    '</div>'
                );
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
                    $('#imageProfil').attr('src', 'images/profil/' + data.foto);
                }
            }
        });
    });

    //form ganti password
    $('#formPassword').submit(function(e){
        e.preventDefault();
        refreshError($(this));

        var url = 'action/profil.php?action=password';
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
                $('#myModalpass').modal('hide');
                $('#alert-box').html(
                    '<div class="alert alert-success">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                        '<strong>Berhasil : </strong> Password berhasil diperbaharui' +
                    '</div>'
                );
            }
        });
    })

    //--------------------------------------------- Produk ----------------------------------------------------//

    //load data produk
    function loadProduk(){
        $('#rowpro').load('action/produk.php?action=select', function(){
            //$('#dataTables-example').dataTable();
        });
    }

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
                    loadProduk();
                    $('#modalProInput').modal('hide');
                    $('#alert-box').html(
                        '<div class="alert alert-success">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                            '<strong>Berhasil : </strong> Produk <b>' + data.data + '</b> berhasil ditambahkan' +
                        '</div>'
                    );
                }
            }
        });
    });

    //ambil data untuk edit produk
    $('#rowpro').on('click', '.editProButton', function(){
        var url = 'action/produk.php?action=selectid';
        var ids = $(this).data('id');
        var data = {id : ids};

        $.getJSON(url, data, function(result){
            $('#editIdProduk').val(result.id_produk);
            $('#editNamaProduk').val(result.nama_produk);
            $('#editHarga').val(result.harga_produk);
            $('#editKategori').val(result.id_kategori);
            $('#editUkuran').val(result.ukuran);
            $('#editDeskripsi').val(result.ket_produk);
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
                    loadProduk();
                    $('#myModal').modal('hide');
                    $('#alert-box').html(
                        '<div class="alert alert-success">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                            '<strong>Berhasil : </strong> Produk <b>' + data.data + '</b> berhasil diperbaharui' +
                        '</div>'
                    );
                }
            }
        });
    });

    //delete data produk
    $('#rowpro').on('click', '.deleteProButton', function(){
        var konfirm = confirm("Hapus Barang ?");

        if(konfirm){
            var url = 'action/produk.php?action=delete';
            var ids = $(this).data('id');
            var data = {id : ids};

            $.getJSON(url, data, function(result){
                if(result.hasil == 'sukses'){
                    loadProduk();
                    $('#alert-box').html(
                        '<div class="alert alert-success">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                            '<strong>Berhasil : </strong> Produk <b>' + result.data + '</b> berhasil dihapus' +
                        '</div>'
                    );
                }
            });
        }
    });

    //--------------------------------------------- Kategori ----------------------------------------------------//

    //load data kategori
    function loadKategori(){
        $('#rowcat').load('action/category.php?action=select', function(){
            //$('#dataTables-example').dataTable();
        });
    }

    //form input kategori
    $("#formInputCat").submit(function(e){
        e.preventDefault();
        
        var url = 'action/category.php?action=insert';
        var data = $(this).serialize();

        $.post(url, data, function(result){
            var data = JSON.parse(result);

            if(data.hasil != 'sukses'){
                $('#NamaError').text(data.error.nama);
                $('#Nama').parents('.form-group').addClass('has-error has-feedback');
                $('#Nama').after('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
            }
            else{
                loadKategori();
                $('#modalCatInput').modal('hide');
                $('#alert-box').html(
                    '<div class="alert alert-success">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                        '<strong>Berhasil : </strong> Kategori <b>' + data.data + '</b> berhasil ditambahkan' +
                    '</div>'
                );
            }
        });
    });

    //ambil data untuk edit kategori
    $('#rowcat').on('click', '.editCatButton', function(){
        var url = 'action/category.php?action=selectid';
        var ids = $(this).data('id');
        var data = {id : ids};

        $.getJSON(url, data, function(result){
            $('#editId').val(result.id_kategori);
            $('#oldNama').val(result.nama_kategori);
            $('#editNama').val(result.nama_kategori);
            $('#editKet').val(result.ket_kategori);
        });
    });

    //form update kategori
    $('#formEditCat').submit(function(e){
        e.preventDefault();

        var url = 'action/category.php?action=update';
        var data = $(this).serialize();

        $.post(url, data, function(result){
            var data = JSON.parse(result);

            if(data.hasil != 'sukses'){
                $('#editNamaError').text(data.error.nama);
                $('#editNama').parents('.form-group').addClass('has-error has-feedback');
                $('#editNama').after('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
            }
            else{
                loadKategori();
                $('#myModalcat').modal('hide');
                $('#alert-box').html(
                    '<div class="alert alert-success">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                        '<strong>Berhasil : </strong> Kategori <b>' + data.data + '</b> berhasil diperbaharui' +
                    '</div>'
                );
            }
        });
    });

    //delete kategori
    $('#rowcat').on('click', '.deleteCatButton', function(){
        var konfirm = confirm("Hapus Kategori ?");

        if(konfirm){
            var url = 'action/category.php?action=delete';
            var ids = $(this).data('id');
            var data = {id : ids};

            $.getJSON(url, data, function(result){
                if(result.hasil == 'sukses'){
                    loadKategori();
                    $('#alert-box').html(
                        '<div class="alert alert-success">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                            '<strong>Berhasil : </strong> Kategori <b>' + result.data + '</b> berhasil dihapus' +
                        '</div>'
                    );
                }
            });
        }
    });
});