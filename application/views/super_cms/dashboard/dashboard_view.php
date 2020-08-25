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

<div class="row">

	<!-- Area Chart -->
	<div class="col-xl-8 col-lg-7">
		<div class="card shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Income Overview <?= date('Y')?></h6>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<div class="chart-area">
					<canvas id="myAreaChart"></canvas>
				</div>
			</div>
		</div>
	</div>

	<!-- Pie Chart -->
	<div class="col-xl-4 col-lg-5">
		<div class="card shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">The Difference of Token Type Sales (This Month: <?= date("M") ?>)</h6>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<div class="chart-pie pt-4 pb-2">
					<canvas id="myPieChart"></canvas>
				</div>
				<div class="mt-4 text-center small">
					<span class="mr-2">
						<i class="fas fa-circle text-primary"></i> 1 Month Token
					</span>
					<span class="mr-2">
						<i class="fas fa-circle text-success"></i> 3 Months Token
					</span>
					<span class="mr-2">
						<i class="fas fa-circle text-info"></i> 1 Year Token
					</span>
				</div>
			</div>
		</div>
	</div>
</div>