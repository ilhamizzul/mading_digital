<div class="card shadow-sm mb-4 border-bottom-primary">
	<div class="card-header bg-white py-3">
		<div class="row">
			<div class="col">
				<h4 class="h5 align-middle m-0 font-weight-bold text-primary">
					Data Token Request
				</h4>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped dt-responsive nowrap" id="dataRequest">
				<thead>
					<tr>
                        <th>No.</th>
                        <th>Company Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Token</th>
						<th>Token Type</th>
						<th>Requested At</th>
                        <th>Action</th>
					</tr>
				</thead>
				<tbody>
                    <?php $no = 1;
                    foreach ($data_request as $data):?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data['company_name'] ?></td>
                        <td><?= $data['no_telp'] ?></td>
                        <td><?= $data['email'] ?></td>
                        <td><?= $data['token'] ?></td>
                        <td><?= $data['token_type']?></td>
                        <td><?= $data['requestAt'] ?></td>
                        <td>
                        <button class="btn btn-circle btn-sm btn-success" data-toggle="modal" data-target="#modalAcceptRequest" onclick="acceptRequest('<?= $data['id_transaction'] ?>', '<?= $data['company_name'] ?>', '<?= $data['email'] ?>')" title="Accept Request"><i class="fas fa-fw fa-check"></i></button>
                        </td>
					</tr>
                    <?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow-sm mb-4 border-bottom-primary">
	<div class="card-header bg-white py-3">
		<div class="row">
			<div class="col">
				<h4 class="h5 align-middle m-0 font-weight-bold text-primary">
					Data Token Transaction
				</h4>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped dt-responsive nowrap" id="dataTransaction">
				<thead>
					<tr>
                        <th>No.</th>
                        <th>Company Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Token</th>
						<th>Token Type</th>
						<th>Requested At</th>
					</tr>
				</thead>
				<tbody>
                    <?php $no = 1;
                    foreach ($data_transaction as $data):?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data['company_name'] ?></td>
                        <td><?= $data['no_telp'] ?></td>
                        <td><?= $data['email'] ?></td>
                        <td><?= $data['token'] ?></td>
                        <td><?= $data['token_type']?></td>
                        <td><?= $data['requestAt'] ?></td>
					</tr>
                    <?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal fade" id="modalAcceptRequest" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Accept token purchase request?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<h5 class="text-center">
					Do you really want to accept token request from "<span class="company_name"></span>" company?
				</h5>
                <small class="form-text text-center text-muted">Please make sure the company has sent the funds before accepting a request!</small>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<a href="" id="granted" class="btn btn-primary">Accept Request</a>
			</div>
		</div>
	</div>
</div>
