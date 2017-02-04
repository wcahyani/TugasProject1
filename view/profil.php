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

	$stmt = $con->select('tabel_profile', ['id_profile' => $_SESSION['id']]);
	$stmt->execute();

	$data = $stmt->fetch(PDO::FETCH_OBJ);
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">&raquo; Profil</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="col-md-5">
				<img id="imageProfil" class="img-responsive" src="images/profil/<?= $data->foto ?>" width="800">
				<button class="btn btn-info btn-md" data-target="#mymodaleditgambar" data-toggle="modal" id="editFotoButton"><i class="fa fa-camera fa-fw"></i></button>
			</div>
            <div class="col-md-7">
                <table class="table table-striped">
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td id="dataNama"><?= ($data->nama_member != null) ? $data->nama_member : '-' ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td id="dataAlamat"><?= ($data->alamat_member != null) ? $data->alamat_member : '-' ?></td>
                    </tr>
                    <tr>
                        <td>E-mail</td>
                        <td>:</td>
                        <td id="dataEmail"><?= ($data->email != null) ? $data->email : '-' ?></td>
                    </tr>
                    <tr>
                        <td>No.Telp</td>
                        <td>:</td>
                        <td id="dataTlp"><?= ($data->tlp_member != null) ? $data->tlp_member : '-' ?></td>
                    </tr>
                </table>
				<button class="btn btn-info btn-md" data-target="#mymodaledit" data-toggle="modal" id="editProfilButton" type="button">Edit Profil</button>
				<button class="btn btn-info btn-md" data-target="#myModalpass" data-toggle="modal" id="editPassButton">Edit Password</button>
            </div>
        </div>
    </div>
	
	<!-- Modal Section -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="mymodaledit" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Edit Profile</h4>
                </div>
				<form class="form-horizontal" role="form" id="formUpdateProfil">
					<div class="modal-body">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="firstname">Nama:</label>
							<div class="col-md-10">
								<input class="form-control" id="editNama" name="editNama" type="text">
								<div class="error-box" id="editNamaError"></div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="alamat">Alamat:</label>
							<div class="col-md-10">
								<input class="form-control" id="editAlamat" name="editAlamat" type="text">
								<div class="error-box" id="editAlamatError"></div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="hobi">Email :</label>
							<div class="col-md-10">
								<input class="form-control" id="editEmail" name="editEmail" type="email">
								<div class="error-box" id="editEmailError"></div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="profil">No.Telp :</label>
							<div class="col-md-10">
								<input class="form-control" id="editTlp" name="editTlp" type="text">
								<div class="error-box" id="editTlpError"></div>
							</div>
						</div>
						<!--<div class="form-group">
							<label for="image" class="col-sm-2 control-label">Image</label>
							<input id="image" type="file" name="file"/>
						</div>-->
					</div>
					<div class="modal-footer">
						<button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
						<button class="btn btn-primary" id="editProfilButton" type="submit">Submit</button>
					</div>
				</form>
            </div>
        </div>
    </div>
	<!-- End of Profile Modal -->

    <!-- Modal Edit Password -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="myModalpass" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Edit Password</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="passLama">Password Lama</label>
                            <div class="col-md-10">
                                <input class="form-control" id="passLama" name="passLama" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="passBaru">Password Baru</label>
                            <div class="col-md-10">
                                <input class="form-control" id="passBaru" name="passBaru" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="passBaru2">Konfirmasi Password Baru</label>
                            <div class="col-md-10">
                                <input class="form-control" id="passBaru2" name="passBaru2" type="text">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Close</button> <button class="btn btn-primary" data-dismiss="modal" id="modalsave" type="button">Submit</button>
                </div>
            </div>
        </div>
    </div>

	<!-- Modal Section -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="mymodaleditgambar" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Edit Profile</h4>
                </div>
				<form class="form-horizontal" role="form" id="formgantifoto">
					<div class="modal-body">
						<div class="form-group">
							<label for="image" class="col-sm-2 control-label">Image</label>
							<input id="editFoto" type="file" name="editFoto"/>
							<div class="error-box" id="editFotoError"></div>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
						<button class="btn btn-primary" id="editProfilButton" type="submit">Submit</button>
					</div>
				</form>
            </div>
        </div>
    </div>
</div>