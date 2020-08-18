<?php if ($data_company['onTrial']):?>
	<div class="alert alert-warning alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<i class="fa  fa-exclamation-triangle"></i> This application still on trial! to be a member, <a href="">click this link!</a>
	</div>
<?php endif; ?>
<?php 
	$validity = strtotime($data_company['validity']);
	$date = strtotime(date('Y-m-d'));
	$expired_in = date('j', $validity-$date);
	if($expired_in <= 7 && $expired_in > 0):
?>
	<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<i class="fa fa-exclamation-triangle"></i> Validity time access almost ended! remaining time: <b><?= $expired_in ?> days</b>
	</div>
<?php 
	endif; 
	if($expired_in == 0):
?>
	<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<i class="fa  fa-exclamation-triangle"></i> Validity time ended! All access has been locked. </b>
	</div>
<?php endif; ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>
<div class="row">
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Active Carousel
						</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data_count['active_carousel'] ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-image fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Active Event</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data_count['active_event'] ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-warning shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Active Slogan</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data_count['active_slogan'] ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-comments fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-info shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Active News</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data_count['active_news'] ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-comments fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
