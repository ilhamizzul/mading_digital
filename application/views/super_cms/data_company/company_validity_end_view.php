<div class="card shadow-sm mb-4 border-bottom-primary">
	<div class="card-header bg-white py-3">
		<div class="row">
			<div class="col">
				<h4 class="h5 align-middle m-0 font-weight-bold text-primary">
					Data Company Ended Validity
				</h4>
			</div>
			<div class="col-auto">
				<a href="<?= base_url() ?>Company" class="btn btn-sm btn-primary btn-icon-split">
					<span class="icon"><i class="fa fa-angle-left"></i></span>
					<span class="text">Go Back</span>
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
						<th>Company Name</th>
                        <th>Company Email</th>
                        <th>Owner Name</th>
                        <th>Owner Email</th>
						<th>Validity</th>
                        <th>Created At</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$no = 1;
						foreach ($data_company as $data):
					?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data['company_name'] ?></td>
                        <td><?= $data['company_email'] ?></td>
                        <td><?= $data['user_name'] ?></td>
                        <td><?= $data['user_email'] ?></td>
						<td><?= $data['validity'] ?></td>
                        <td><?= $data['create_time'] ?></td>
					</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Expired Company</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<h5 class="text-center">
					<i class="mb-4 text-danger fa fa-exclamation-triangle fa-5x"></i><br>
					There is <span class="count_expired"></span> company whose expiration period exceeds 3 months <br>
					Delete those company?
				</h5>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<a href="<?= base_url() ?>Company/delete_company" id="activate" class="btn btn-danger">Delete</a>
			</div>
		</div>
	</div>
</div>
