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
			<div class="col-xl-12 col-lg-12 col-md-12">
				<div class="card o-hidden border-0 shadow-lg my-3">
					<div class="card-body p-lg-5 p-0">
						<!-- Nested Row within Card Body -->
						<img src="<?= base_url() ?>assets/CMS/img/register_success.svg" class="w-50 mx-auto d-block">
						<h1 class="text-center mt-5 font-weight-bold text-primary">Registration Success!</h1>
                        <h3 class="text-center text-primary">Please wait for verification email from admin!</h3>
						<a href="<?= base_url() ?>Auth" class="btn btn-lg btn-default text-primary font-weight-bold mx-auto d-block"><span class="fa fa-arrow-left"></span> Login</a>
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
