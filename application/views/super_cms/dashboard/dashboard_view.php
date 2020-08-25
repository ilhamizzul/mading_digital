<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<div class="row">
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Company Waiting for
							Approval
						</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">
							<?= $data_count['company_pending_approval'] ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-building fa-2x text-gray-300"></i>
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
						<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Pending Transaction
						</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data_count['pending_transaction'] ?>
						</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-exchange-alt fa-2x text-gray-300"></i>
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
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Income summary (This
							Month : <?= date("M") ?>)</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= $data_count['monthly_income'] ?>,-
						</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
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
						<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Income</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= $data_count['total_income'] ?>,-
						</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-money-bill fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
