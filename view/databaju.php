<?php
	if(!isset($_SESSION['id'])){
		header('location: index.php');
	}
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">&raquo; Input Barang</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Input Data
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" action="" method="post">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control">
                                        <option value=""> - choose - </option>
                                        <option value=""> Anak-anak</option>
                                        <option value=""> Remaja </option>
                                        <option value=""> Dewasa</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Merk</label>
                                    <input class="form-control" type="text" name="icon" />
                                </div>
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input class="form-control" type="text" name="icon" />
                                </div>
                                <div class="form-group">
                                    <label>Ukuran</label>
                                    <select class="form-control">
                                        <option value="">S</option>
                                        <option value="">M</option>
                                        <option value="">L</option>
                                        <option value="">XL</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="file" />
                                </div>
                                <button type="submit" name="submit" class="btn btn-success">Save</button>
                                <button type="reset" class="btn btn-warning">Reset</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    List Data
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th class="text-center">Baju</th>
                                    <th>Category</th>
                                    <th>Merk</th>
                                    <th>Harga</th>
                                    <th>Ukuran</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> 1 </td>
                                    <td class="text-center">
                                        <img src="asset/no-image.png" width="88">
                                    </td>
                                    <td>Anak-anak</td>
                                    <td class="center">Levi's 501</td>
                                    <td>Rp.200.000</td>
                                    <td>S</td>
                                    <td class="center">
                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">Edit</button>
                                    </td>
                                    <td class="center"><a href="index.php?barang-delete=" class="btn btn-primary btn-xs" type="button">Delete</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Section -->
    <!-- Modal 1 -->
    <div class="modal fade" id="myModal" tabindex = "-1" role = "dialog" aria-labelledby = "myModalLabel" aria-hidden = "true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                </button>
                <h4 class="modal-title" id="myModalLabel">Edit Barang</h4>
            </div>
            <div class = "modal-body">
                <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="firstname" class="col-sm-2 control-label">Category</label>
                    <div class="col-md-10">
                    <select class="form-control">
                        <option value="">--Pilih Category--</option>
                        <option value=""> Anak-anak </option>
                        <option value=""> Remaja </option>
                        <option value=""> Dewasa </option>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="namabarang" class="col-sm-2 control-label">Nama Barang</label>
                    <div class="col-md-10">
                    <input type="text" name="merk" id="modalmerk" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="harga" class="col-sm-2 control-label">Harga</label>
                    <div class="col-md-10">
                    <input type="text" name="harga" id="modalharga" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="ukuran" class="col-sm-2 control-label">Ukuran</label>
                    <div class="col-md-10">
                    <select class="form-control">
                        <option value="">--Pilih Ukuran--</option>
                        <option value=""> S </option>
                        <option value=""> M </option>
                        <option value=""> L </option>
                        <option value=""> XL </option>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="image" class="col-sm-2 control-label">Image</label>
                    <input id="modalimage" type="file" name="file"/>
                </div>
                </form>
            </div>
            <div class = "modal-footer">
                <button type = "button" class = "btn btn-default" data-dismiss = "modal">
                Close
                </button>
                <button type = "button" class = "btn btn-primary" id="modalsave" data-dismiss ="modal">
                Submit
                </button>
            </div>
            </div>
        </div>
        </div>
    </div>