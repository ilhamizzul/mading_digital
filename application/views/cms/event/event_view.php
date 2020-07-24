<div class="card shadow-sm mb-4 border-bottom-primary">
	<div class="card-header bg-white py-3">
		<div class="row">
			<div class="col">
				<h4 class="h5 align-middle m-0 font-weight-bold text-primary">
					Data Event
				</h4>
			</div>
			<div class="col-auto">
				<button class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#Insert">
					<span class="icon">
						<i class="fa fa-plus"></i>
					</span>
					<span class="text">
						Add New Event
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
								class="btn btn-circle btn-sm <?= $data['active'] == 'true' ? 'btn-success' : 'btn-secondary' ?>"
								title="<?= $data['active'] == 'true' ? 'Hide Event' : 'Show Event' ?>"
								onclick="toggleEvent('<?= $data['id_info'] ?>')" data-toggle="modal"
								data-target="#dataToggleActivation"><i class="fa fa-fw fa-power-off"></i></button>
							<button class="btn btn-circle btn-sm <?= ($data['active'] == 'true') ? 'btn-secondary' : 'btn-warning'?>" title="Edit Event" <?= ($data['active'] == 'true') ? 'disabled' : ''?> onclick="editEvent('<?= $data['id_info'] ?>')"
								data-toggle="modal" data-target="#Edit"><i class="fa fa-fw fa-edit"></i></button>
							<button
								class="btn btn-circle btn-sm <?= ($data['active'] == 'true') ? 'btn-secondary' : 'btn-danger'?>"
								title="Delete Event" <?= ($data['active'] == 'true') ? 'disabled' : ''?> onclick="deleteEvent('<?= $data['id_info'] ?>')"
								data-toggle="modal" data-target="#delete"><i class="fa fa-fw fa-trash"></i></button>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- MODAL INSERT -->
<div class="modal fade" id="Insert" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Add New Event</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url()?>Event/add_new_event" method="post" id="form_create"
					enctype="multipart/form-data">
					<div class="form-group">
						<label>Description</label>
						<input type="text" class="form-control" name="description">
					</div>
					<div class="form-row">
                        <div class="form-group col">
                            <label>Location</label>
                            <input type="text" class="form-control" name="location">
                        </div>
                        <div class="form-group col">
                            <label>Due Date</label>
                            <input class="form-control dateTimePicker" name="due_date">
                        </div>
                    </div>
					<div class="form-row">
                        <div class="form-group col">
							<label>Repeated By</label>
							<select class="form-control" name="id_repeater">
                                <option value="">Chose...</option>
                                <?php foreach ($data_repeater as $data) : ?>
								    <option value="<?= $data['id_repeater'] ?>"><?= $data['description'] ?></option>
                                <?php endforeach; ?>
							</select>
						</div>
						<div class="form-group col">
							<label>Info Type</label>
							<select class="form-control" name="info_type">
								<option value="">Chose...</option>
								<option value="event">Event</option>
                                <option value="slogan">Slogan</option>
                                <option value="news">News</option>
							</select>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" id="create_button" class="btn btn-primary">Submit</button>
			</div>
		</div>
	</div>
</div>

<!-- MODAL EDIT -->
<div class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Add New Carousel</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
                <div class="row">
                    <form action="" class="col" method="post" id="form_edit" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label>Upload File</label>
                                <input type="file" class="form-control" name="data_carousel">
                            </div>
                            <div class="form-group col">
                                <label>Data Type</label>
                                <select class="form-control" name="data_type">
                                    <option value="" id="data_type" selected></option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <div class="col card">
                        <div class="card-img-top" id="data_preview">

                        </div>
                        <div class="card-body">
                            <center><p class="card-text" id="data_carousel"></p></center>
                        </div>
                    </div>
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" id="edit_button" class="btn btn-warning">Submit</button>
			</div>
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
