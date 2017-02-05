    <div class="container">
        <div class="row" style="padding-top: 200px">
            <div class="panel panel-default col-md-6 col-md-offset-3">
                <div class="panel-heading" style='background: yellow'>
                    <h3 class="panel-title">
                        Form Login
                    </h3>
                </div>

                <div class="panel-body">
                    <form action="#" class="form-horizontal" id="formlogin" method="post" name="formlogin">
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="inputUsername">Username</label>
                            <div class="col-md-10">
                                <input class="form-control" id="Username" name="Username" placeholder="Username" type="text">
                                <div class="error-box" id="UsernameError">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="inputPassword">Password</label>
                            <div class="col-md-10">
                                <input class="form-control" id="Password" name="Password" placeholder="Password" type="password">
                                <div class="error-box" id="PasswordError">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-md-10">
                                <button class="btn btn-success" id="Login" type="submit"><i class="fa fa-user-o"></i>Login</button>
								<button class="btn btn-info btn-md" data-target="#myModalregist" data-toggle="modal" id="regist" type="button">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Section -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="myModalregist" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">
                        Register
                    </h4>
                </div>

                <form class="form-horizontal" role="form" id="formregister">
                	<div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="firstname">Email:</label>
                            <div class="col-md-10">
                                <input class="form-control" id="Email" name="email" type="email" placeholder="Email">
                                <div class="error-box" id="EmailError"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="username">Username:</label>
                            <div class="col-md-10">
                                <input class="form-control" id="UsernameRegist" name="username" type="text" placeholder="Username">
                                <div class="error-box" id="UsernameRegistError"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="password">Password:</label>
                            <div class="col-md-10">
                                <input class="form-control" id="PasswordRegist" name="password" type="password" placeholder="Password">
                                <div class="error-box" id="PasswordRegistError"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="password2">Comfrim:</label>
                            <div class="col-md-10">
                                <input class="form-control" id="Konfirmasi" name="konfirmasi" placeholder="Ketik ulang password" type="password">
                                <div class="error-box" id="KonfirmasiError"></div>
                            </div>
                        </div>
					</div>

					<div class="modal-footer">
						<button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
						<button class="btn btn-primary" type="submit">Submit</button>
					</div>
                </form>
            </div>
        </div>
    </div>