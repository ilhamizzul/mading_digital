<div class="card shadow-sm mb-4 border-bottom-primary">
	<div class="card-header bg-white py-3">
		<div class="row">
			<div class="col">
				<h4 class="h5 align-middle m-0 font-weight-bold text-primary">
					Outdate Data Event
				</h4>
			</div>
			<div class="col-auto">
				<a href="<?= base_url() ?>Event" class="btn btn-sm btn-primary btn-icon-split">
					<span class="icon">
						<i class="fa fa-backward"></i>
					</span>
					<span class="text">
						Back
					</span>
				</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped dt-responsive nowrap" id="dataTable">
				<thead>
					<tr>
						<th width="30">No.</th>
						<th>Description</th>
						<th>Location</th>
						<th>Due Date</th>
                        <th>Info Type</th>
                        <th>Repeated By</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
                    foreach ($data_event as $data) : ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $data['info_description'] ?></td>
						<td><?= $data['location']?></td>
						<td><?= $data['due_date'] ?></td>
                        <td><?= $data['info_type'] ?></td>
                        <td><?= $data['repeater'] ?></td>
						<td>
						<button
								class="btn btn-circle btn-sm btn-warning" title="Retrieve Data"
								onclick="retrieveEvent('<?= $data['id_info'] ?>')" data-toggle="modal"
								data-target="#retrieveData"><i class="fa fa-fw fa-upload"></i></button>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- MODAL TOGGLE ACTIVATION -->
<div class="modal fade" id="retrieveData" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Retrieve back this <span class="info_type"></span>?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<h5 class="text-center">
					Do you really want to retrieve back this <span class="info_type"></span>?<br>
					<b><span class="id_info"></span></b>
				</h5><br>
				<form action="" method="post" id="form-retrieve">
					<div class="form-group w-50 mx-auto d-block">
						<input class="form-control dateTimePicker" id="due_date" name="due_date" required>
					</div>
				</form>
				<h5 class="text-center text-warning">Please change due date first</h5>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button id="retrieve" class="btn btn-warning">Retrieve</button>
			</div>
		</div>
	</div>
</div>
