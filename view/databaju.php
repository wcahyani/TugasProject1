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
    require 'model/Produk.php';
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">&raquo; Produk</h1>
        </div>
    </div>

    <div id="alert-box"></div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Data Produk
                </div>
                <div class="panel-body">
                    <button type="button" class="btn btn-primary btn-tambah" id="inputProButton" data-toggle="modal" data-target="#modalProInput">
                        <i class="fa fa-plus-circle"></i> Tambah Produk
                    </button>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="tabel-produk">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th class="text-center">Baju</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Ukuran</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody id="rowpro">
                                <?php
                                $produk = new Produk($con);
                                $data = $produk->getAllProduk();

                                $no = 1;
                                ?>

                                <?php while($row = $data->fetch(PDO::FETCH_OBJ)) : ?>
                                    <tr>
                                        <td><?= $no++ ?> </td>
                                        <td class="text-center">
                                            <img src="images/produk/<?= $row->foto_produk ?>" width="88">
                                        </td>
                                        <td><?= $row->nama_produk ?></td>
                                        <td><?= $row->nama_kategori ?></td>
                                        <td><?= $row->harga_produk ?></td>
                                        <td><?= strtoupper($row->ukuran) ?></td>
                                        <td class="center">
                                            <button type="button" data-id="<?= $row->id_produk ?>" class="btn btn-primary btn-xs editProButton" data-toggle="modal" data-target="#myModal">Edit</button>
                                        </td>
                                        <td class="center">
                                            <button type="button" data-id="<?= $row->id_produk ?>" href="index.php?barang-delete=" class="btn btn-primary btn-xs deleteProButton">Delete</button>
                                        </td>
                                    </tr>
                                <?php endwhile ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Section -->
    <div class="modal fade" id="myModal" tabindex = "-1" role = "dialog" aria-labelledby = "myModalLabel" aria-hidden = "true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                </button>
                <h4 class="modal-title" id="myModalLabel">Edit Barang</h4>
            </div>
            <form class="form-horizontal" role="form" id="formEditProduk">
                <div class = "modal-body">
                    <div class="form-group">
                        <label for="namabarang" class="col-sm-2 control-label">Nama Barang</label>
                        <div class="col-md-10">
                            <input type="hidden" class="form-control" name="editIdProduk" id="editIdProduk"/>
                            <input type="text" class="form-control" name="editNamaProduk" id="editNamaProduk"  placeholder="Nama Produk"/>
                            <div class="error-box" id="editNamaProdukError"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="harga" class="col-sm-2 control-label">Harga</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="editHarga" id="editHarga"  placeholder="Harga"/>
                            <div class="error-box" id="editHargaError"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php 
                            $stmt = $con->select('kategori');
                            $stmt->execute();
                        ?>
                        <label for="firstname" class="col-sm-2 control-label">Category</label>
                        <div class="col-md-10">
                            <select class="form-control" name="editKategori" id="editKategori">
                                <?php while($row = $stmt->fetch(PDO::FETCH_OBJ)) : ?>
                                    <option value="<?= $row->id_kategori ?>"> <?= $row->nama_kategori ?> </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ukuran" class="col-sm-2 control-label">Ukuran</label>
                        <div class="col-md-10">
                            <select class="form-control" name="editUkuran" id="editUkuran">
                                <option value="s"> S </option>
                                <option value="m"> M </option>
                                <option value="l"> L </option>
                                <option value="xl"> XL </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image" class="col-sm-2 control-label">Image</label>
                        <div class="col-md-10">
                            <input type="file" id="editFoto" name="editFoto" class="form-file">
                            <div class="error-box" id="editFotoError"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="harga" class="col-sm-2 control-label">Deskripsi</label>
                        <div class="col-md-10">
                            <textarea type="text" class="form-control" name="editDeskripsi" id="editDeskripsi"  placeholder="Deskripsi"/></textarea>
                            <div class="error-box" id="editDeskripsiError"></div>
                        </div>
                    </div>
                </div>
                <div class = "modal-footer">
                    <button type = "button" class = "btn btn-default" data-dismiss = "modal">Close</button>
                    <button class = "btn btn-primary" id="modalsave">Submit</button>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal Input -->
    <div class="modal fade" id="modalProInput" tabindex = "-1" role = "dialog" aria-labelledby = "myModalLabel" aria-hidden = "true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                </button>
                <h4 class="modal-title" id="myModalLabel">Edit Barang</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="" method="post" id="formInsertProduk">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" name="NamaProduk" id="NamaProduk"  placeholder="Nama Produk"/>
                        <div class="error-box" id="NamaProdukError"></div>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" class="form-control" name="Harga" id="Harga"  placeholder="Harga"/>
                        <div class="error-box" id="HargaError"></div>
                    </div>
                    <div class="form-group">
                        <?php 
                            $stmt = $con->select('kategori');
                            $stmt->execute();
                        ?>
                        <label>Category</label>
                        <select class="form-control" name="Kategori" id="Kategori">
                            <?php while($row = $stmt->fetch(PDO::FETCH_OBJ)) : ?>
                                <option value="<?= $row->id_kategori ?>"> <?= $row->nama_kategori ?> </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Ukuran</label>
                        <select class="form-control" name="Ukuran" id="Ukuran">
                            <option value="s">S</option>
                            <option value="m">M</option>
                            <option value="l">L</option>
                            <option value="xl">XL</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" id="Foto" name="Foto" class="form-file">
                        <div class="error-box" id="FotoError"></div>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Produk</label>
                        <textarea type="text" class="form-control" name="Deskripsi" id="Deskripsi"  placeholder="Keterangan"/></textarea>
                        <div class="error-box" id="DeskripsiError"></div>
                    </div>
                    <div class = "modal-footer">
                        <button type="reset" class="btn btn-warning">Reset</button>
                        <button type="submit" name="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>