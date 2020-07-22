<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?= $title ?></title>

	<!-- Custom fonts for this template-->
	<link href="<?= base_url() ?>assets/cms/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link
		href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
		rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="<?= base_url() ?>assets/cms/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

	<div class="container">
		<!-- Outer Row -->
		<div class="row justify-content-center mt-5 pt-lg-5">
			<div class="col-xl-10 col-lg-12 col-md-9">
				<div class="card o-hidden border-0 shadow-lg">
					<div class="card-body p-lg-5 p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
							<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
							<div class="col-lg-6">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4">Sistem Mading Digital - Login</h1>
									</div>
									<?php 
                                        $success = $this->session->flashdata('success');
                                        $failed = $this->session->flashdata('failed');

                                        if (!empty($failed)) {
                                            echo '
                                                <div class="alert alert-danger alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <i class="fa fa-times-circle"></i> '.$failed.'
                                                </div>
                                            ';
                                        }

                                        if (!empty($success)) {
                                            echo '
                                                <div class="alert alert-success alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <i class="fa fa-check-circle"></i> '.$success.'
                                                </div>
                                            ';
                                        }
                                    ?>
									<form class="user" method="post" action="<?= base_url() ?>Auth/">
										<div class="form-group">
											<input type="text" class="form-control form-control-user" name="username"
												aria-describedby="emailHelp" placeholder="Username...">
										</div>
										<div class="form-group">
											<input type="password" class="form-control form-control-user"
												name="password" placeholder="Password...">
										</div>
										<button type="submit" class="btn btn-primary btn-user btn-block">
											Login
										</button>
									</form>
									<hr>
									<div class="text-center">
										<a class="small" href="forgot-password.html">Forgot Password?</a>
									</div>
									<div class="text-center">
										<a class="small" href="register.html">Create an Account!</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<!-- Bootstrap core JavaScript-->
	<script src="<?= base_url() ?>assets/cms/vendor/jquery/jquery.min.js"></script>
	<script src="<?= base_url() ?>assets/cms/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="<?= base_url() ?>assets/cms/vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="<?= base_url() ?>assets/cms/js/sb-admin-2.min.js"></script>

</body>

</html>
