<?php
	if(!isset($_SESSION['id'])){
		header('location: index.php');
	}

    spl_autoload_register(function ($class)
	{
		if (file_exists('model/'. $class .'.php'))
			require 'model/'. $class . '.php';
		else
			exit('Tidak dapat membuka class '.$class.'!');
	});

	require 'config/config.php';

	$stmt = $con->select('kategori');
	$stmt->execute();

    $no = 1;
?>

<div id="page-wrapper">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">&raquo; Kategori</h1>
    </div>
</div>

<div id="alert-box"></div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Data Kategori
            </div>
            <div class="panel-body">
                <button type="button" class="btn btn-primary btn-tambah" id="inputCatButton" data-toggle="modal" data-target="#modalCatInput">
                    <i class="fa fa-plus-circle"></i> Tambah Kategori
                </button>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover tabelcat" id="tabel-kategori">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Kategori</th>
                                <th>Keterangan</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody id="rowcat">
                            <?php while($row = $stmt->fetch(PDO::FETCH_OBJ)) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row->nama_kategori ?></td>
                                <td><?= ($row->ket_kategori != null) ? $row->ket_kategori : '-' ?></td>
                                <td class="center"><button type="button" data-id="<?= $row->id_kategori ?>" class="btn btn-primary btn-xs editCatButton" data-toggle="modal" data-target="#myModalcat">Edit</button></td>
                                <td class="center"><button type="button" data-id="<?= $row->id_kategori ?>" class="btn btn-primary btn-xs deleteCatButton">Delete</button></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal input -->
<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="modalCatInput" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Tambah Kategori</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="#" method="post" id="formInputCat">
                    <div class="form-group">
                        <label>Nama kategori</label>
                        <input class="form-control" type="text" name="Nama" id="Nama" />
                        <div class="error-box" id="NamaError"></div>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input class="form-control" type="text" name="Ket" />
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-warning">Reset</button>
                        <button type="submit" name="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="myModalcat" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Edit Category</h4>
            </div>
            <form class="form-horizontal" id="formEditCat" name="formEditCat" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="firstname">Nama Kategori</label>
                        <div class="col-md-10">
                            <input class="form-control" id="editId" name="editId" type="hidden">
                            <input class="form-control" id="oldNama" name="oldNama" type="hidden">
                            <input class="form-control" id="editNama" name="editNama" type="text">
                            <div class="error-box" id="editNamaError"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="keterangan">Keterangan</label>
                        <div class="col-md-10">
                            <input class="form-control" id="editKet" name="editKet" type="text">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
                    <button class="btn btn-primary" id="modalsave">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>