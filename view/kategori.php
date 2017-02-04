<?php
	if(!isset($_SESSION['id'])){
		header('location: index.php');
	}
?>

<div id="page-wrapper">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">&raquo; Category</h1>
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
                                <label>Name</label>
                                <input class="form-control" type="text" name="name" />
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input class="form-control" type="text" name="icon" />
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
                                <th>Name</th>
                                <th>Keterangan</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Anak-anak</td>
                                <td>Pakaian untuk anak anak umur 1-7 tahun</td>
                                <td class="center"><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalcat">Edit</button></td>
                                <td class="center"><a href="index.php?category-delete=" class="btn btn-primary btn-xs" type="button">Delete</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Section -->
<div class="modal fade" id="myModalcat" tabindex = "-1" role = "dialog" aria-labelledby = "myModalLabel" aria-hidden = "true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
            </button>
            <h4 class="modal-title" id="myModalLabel">Edit Category</h4>
          </div>
          <div class = "modal-body">
            <form class="form-horizontal" role="form">
              <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">Category</label>
                <div class="col-md-10">
                <input type="text" name="category" id="modalcategory" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label for="keterangan" class="col-sm-2 control-label">Keterangan</label>
                <div class="col-md-10">
                  <input type="text" name="keterangan" id="modalketerangan" class="form-control">
                </div>
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