<div class="card shadow-sm mb-4 border-bottom-primary">
	<div class="card-header bg-white py-3">
		<div class="row">
			<div class="col">
				<h4 class="h5 align-middle m-0 font-weight-bold text-primary">
					Data Token
				</h4>
			</div>
			<div class="col-auto">
                <button data-toggle="modal" data-target="#insert_token" class="btn btn-sm btn-primary btn-icon-split">
					<span class="icon">
						<i class="fa fa-plus"></i>
					</span>
					<span class="text">
						Generate Token
					</span>
                </button>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped dt-responsive nowrap" id="dataTable">
				<thead>
					<tr>
                        <th>No.</th>
                        <th>Token</th>
						<th>Token Type</th>
						<th>Created At</th>
					</tr>
				</thead>
				<tbody>
                    <?php $no = 1;
                    foreach ($data_token as $data):?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data['token'] ?></td>
                        <td><?= $data['token_type']?></td>
                        <td><?= $data['createdAt'] ?></td>
					</tr>
                    <?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- MODAL INSERT -->
<div class="modal fade" id="insert_token" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Add New Token</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url()?>Token/add_new_token" method="post" id="form_create"
				enctype="multipart/form-data">
			<div class="modal-body">
					<div class="form-group">
						<label>Count Generate Token</label>
						<input type="number" class="form-control" name="count" placeholder="Insert how many token you want to make (max 50)..."  required min="0" maxlength="50">
					</div>
					<div class="form-group">
						<label>Token Type</label>
						<select class="form-control type" name="token_type" required>
							<option value="">Chose...</option>
							<option value="1month">1 Month Token</option>
							<option value="3months">3 Months Token</option>
							<option value="1year">1 Year Token</option>
						</select>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
			</form>
		</div>
	</div>
</div>
