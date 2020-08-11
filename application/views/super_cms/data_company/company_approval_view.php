<div class="card shadow-sm mb-4 border-bottom-primary">
	<div class="card-header bg-white py-3">
		<div class="row">
			<div class="col">
				<h4 class="h5 align-middle m-0 font-weight-bold text-primary">
					Data Company Waiting List
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
                        <th>Created At</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
                    <?php $no = 1;
                    foreach ($data_company as $data):?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data['company_name'] ?></td>
                        <td><?= $data['company_email'] ?></td>
                        <td><?= $data['user_name'] ?></td>
                        <td><?= $data['user_email'] ?></td>
                        <td><?= $data['create_time'] ?></td>
                        <td>
                            <button class="btn btn-circle btn-sm btn-success" data-toggle="modal" data-target="#modalGrantAccess" onclick="grantAccess('<?= $data['id_company'] ?>')" title="Grant Access"><i class="fa fa-fw fa-power-off"></i></button>
                        </td>
					</tr>
                    <?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- MODAL GRANT ACCESS -->
<div class="modal fade" id="modalGrantAccess" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Grant Access to <span class="company_name"></span>?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<h5 style="text-align:center">
					Do you really want to grant access to this company?
					<b><span class="company_name"></span> - <span class="company_id"></span></b>
				</h5>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<a href="" id="granted" class="btn btn-primary">Grant Access</a>
			</div>
		</div>
	</div>
</div>
