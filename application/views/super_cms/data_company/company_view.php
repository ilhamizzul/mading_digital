<div class="row">
	<div class="col-xl-4 col-md-4 mb-4">
		<div class="card border-left-danger shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Company with Expired Validity
						</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $company_count['company_end_validity'] ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-building fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-4 col-md-4 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Active Company
						</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $company_count['active_company'] ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-building fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-4 col-md-4 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Company with waiting for approval
						</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $company_count['company_waiting_approval'] ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-building fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="card shadow-sm mb-4 border-bottom-primary">
	<div class="card-header bg-white py-3">
		<div class="row">
			<div class="col">
				<h4 class="h5 align-middle m-0 font-weight-bold text-primary">
					Data Actived Company
				</h4>
			</div>
			<div class="col-auto">
                <a href="<?= base_url() ?>company/validity_end" class="btn btn-sm btn-warning btn-icon-split">
					<span class="icon">
						<i class="fa fa-exclamation-triangle"></i>
					</span>
					<span class="text">
						Expired Validity
					</span>
                </a>
				<a href="<?= base_url() ?>company/company_approval" class="btn btn-sm btn-primary btn-icon-split">
					<span class="icon"><i class="fa fa-sign"></i></span>
					<span class="text">Waiting for approval</span>
                </a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped dt-responsive nowrap" id="dataTable">
				<thead>
					<tr>
                        <th>No.</th>
                        <th>Logo</th>
						<th>Company Name</th>
                        <th>Company Email</th>
                        <th>Validity</th>
                        <th>Owner Name</th>
                        <th>Owner Email</th>
                        <th>Created At</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
                    <?php $no = 1;
                    foreach ($data_company as $data):?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>
                            <?php if ($data['company_logo'] == null): ?>
                                <div class="p-1 bg-dark text-white w-50">NL</div>
                            <?php else: ?>
                                <img src="<?= base_url() ?>uploads/<?= $data['company_name'] ?>/company/<?= $data['company_logo'] ?>" class="w-50">
                            <?php endif; ?>
                        </td>
                        <td><?= $data['company_name'] ?></td>
                        <td><?= $data['company_email'] ?></td>
                        <td><?= $data['validity'] ?></td>
                        <td><?= $data['user_name'] ?></td>
                        <td><?= $data['user_email'] ?></td>
                        <td><?= $data['create_time'] ?></td>
                        <td>
                            <button class="btn btn-circle btn-sm btn-danger" title="Shutdown Account"><i class="fa fa-fw fa-power-off"></i></button>
                        </td>
					</tr>
                    <?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- MODAL TOGGLE ACTIVATION -->
<div class="modal fade" id="dataToggleActivation" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle"><span class="active_status"></span> this Data
					Carousel?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<h5 style="text-align:center">
					Do you really want to <span class="active_status"></span> this Carousel?
					<b><span class="id_carousel"></span></b>
				</h5>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<a href="" id="activate" class="btn btn-primary"><span class="active_status"></span></a>
			</div>
		</div>
	</div>
</div>
