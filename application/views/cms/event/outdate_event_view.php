<div class="card shadow-sm mb-4 border-bottom-primary">
	<div class="card-header bg-white py-3">
		<div class="row">
			<div class="col">
				<h4 class="h5 align-middle m-0 font-weight-bold text-primary">
					Outdate Data Event
				</h4>
			</div>
			<div class="col-auto">
				<button class="btn btn-sm btn-primary btn-icon-split" onclick="history.back();">
					<span class="icon">
						<i class="fa fa-backward"></i>
					</span>
					<span class="text">
						Back
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
						<th width="30">No.</th>
						<th>Description</th>
						<th>Location</th>
						<th>Due Date</th>
                        <th>Info Type</th>
                        <th>Repeated By</th>
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
				<h5 class="modal-title" id="exampleModalLongTitle"><span class="active_status"></span> this <span class="info_type"></span>?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<h5 style="text-align:center">
					Do you really want to <span class="active_status"></span> this <span class="info_type"></span>?<br>
					<b><span class="id_info"></span></b>
				</h5>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<a href="" id="activate" class="btn btn-primary"><span class="active_status"></span></a>
			</div>
		</div>
	</div>
</div>

<!-- MODAL DELETE -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Delete <span class="info_type"></span></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<h5 style="text-align:center">
					Are you sure you want to delete this <span class="info_type"></span>? <br>
					<b><span class="id_info"></span></b>
                </h5>
                <h6 style="text-align:center">(Once data has been deleted can not be revert back)</h6>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<a href="" id="delete_button" class="btn btn-danger">Delete</a>
			</div>
		</div>
	</div>
</div>
