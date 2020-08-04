<div class="card shadow-sm mb-4 border-bottom-primary">
	<div class="card-header bg-white py-3">
		<div class="row">
			<div class="col">
				<h4 class="h5 align-middle m-0 font-weight-bold text-primary">
					Client View Management - Color Library
				</h4>
			</div>
			<div class="col-auto">
				<button class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#Insert">
					<span class="icon">
						<i class="fa fa-plus"></i>
					</span>
					<span class="text">
						Add New Color
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
						<th>Title</th>
						<th>Background</th>
						<th>Navbar - Footer</th>
						<th>Default Text</th>
						<th>News Text</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
                    foreach ($data_color as $data) : ?>
					<tr>
						<td><?= $no++ ?></td>
						<td>
							<?= $data['title'] ?>
						</td>
						<td>
							<div class="shadow-lg w-50 p-5 rounded"
								style="background-image : linear-gradient(to bottom right, <?= $data['bg_color1'] ?>, <?= $data['bg_color2'] ?>, <?= $data['bg_color3'] ?>);">
							</div>
						</td>
						<td>
							<div class="shadow-lg w-50 p-5 rounded"
								style="background-color : <?= $data['nav_color'] ?>"></div>
						</td>
						<td>
							<div class="shadow-lg w-50 p-5 rounded"
								style="background-color : <?= $data['txt_color'] ?>"></div>
						</td>
						<td>
							<div class="shadow-lg w-50 p-5 rounded"
								style="background-color : <?= $data['txt_news_color'] ?>"></div>
						</td>
						<td>
							<button
								class="btn btn-circle btn-sm <?= $data['active'] == true ? 'btn-success' : 'btn-secondary' ?>"
								title="<?= $data['active'] == false ? 'Use This Color' : '' ?>"
								onclick="toggleColor('<?= $data['id_color'] ?>')" data-toggle="modal"
								<?= ($data['active'] == true) ? 'disabled' : ''?> data-target="#dataToggleActivation"><i
									class="fa fa-fw fa-power-off"></i></button>
							<button
								class="btn btn-circle btn-sm <?= ($data['active'] == true) ? 'btn-secondary' : 'btn-warning'?>"
								title="Edit color" <?= ($data['active'] == true) ? 'disabled' : ''?>
								onclick="editColor('<?= $data['id_color'] ?>')" data-toggle="modal"
								data-target="#Edit"><i class="fa fa-fw fa-edit"></i></button>
							<button
								class="btn btn-circle btn-sm <?= ($data['active'] == true) ? 'btn-secondary' : 'btn-danger'?>"
								title="Delete Color" <?= ($data['active'] == true) ? 'disabled' : ''?>
								onclick="deleteColor('<?= $data['id_color'] ?>')" data-toggle="modal"
								data-target="#delete"><i class="fa fa-fw fa-trash"></i></button>
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
				<h5 class="modal-title" id="exampleModalLongTitle">Add New Color</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url()?>Client_view_management/add_new_color" method="post" id="form_create"
				enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label>Title</label>
						<input type="text" class="form-control" name="title" required maxlength="25"
							placeholder="Insert Title...">
					</div>
					<div class="form-group">
						<label>Background Color</label>
						<div class="form-row">
							<div class="col">
								<input type="color" class="form-control" name="bg_color1" required>
							</div>
							<div class="col">
								<input type="color" class="form-control" name="bg_color2" required>
							</div>
							<div class="col">
								<input type="color" class="form-control" name="bg_color3" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Footer & Navbar Color</label>
						<input type="color" class="form-control" name="nav_color" required>
					</div>
					<div class="form-row">
						<div class="form-group col">
							<label>Default Text</label>
							<input type="color" class="form-control" name="txt_color" required>
						</div>
						<div class="form-group col">
							<label>News Text</label>
							<input type="color" class="form-control" name="txt_news_color">
						</div>
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

<!-- MODAL EDIT -->
<div class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Edit Color - <span class="title"></span></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" method="post" id="form_edit" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label>Title</label>
						<input type="text" class="form-control" id="title" name="title" required maxlength="25"
							placeholder="Insert Title...">
					</div>
					<div class="form-group">
						<label>Background Color</label>
						<div class="form-row">
							<div class="col">
								<input type="color" class="form-control" id="bg_color1" name="bg_color1" required>
							</div>
							<div class="col">
								<input type="color" class="form-control" id="bg_color2" name="bg_color2" required>
							</div>
							<div class="col">
								<input type="color" class="form-control" id="bg_color3" name="bg_color3" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Footer & Navbar Color</label>
						<input type="color" class="form-control" id="nav_color" name="nav_color" required>
					</div>
					<div class="form-row">
						<div class="form-group col">
							<label>Default Text</label>
							<input type="color" class="form-control" id="txt_color" name="txt_color" required
								maxlength="6">
						</div>
						<div class="form-group col">
							<label>News Text</label>
							<input type="color" class="form-control" id="txt_news_color" name="txt_news_color"
								required>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-warning">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- MODAL TOGGLE ACTIVATION -->
<div class="modal fade" id="dataToggleActivation" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle"><span class="active_status"></span> this <span
						class="info_type"></span>?</h5>
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
				<h5 class="modal-title" id="exampleModalLongTitle">Delete Color -  <span class="title"></span></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<h5 style="text-align:center">
					Are you sure you want to delete this color? <br>
					<b><span class="id_color"></span></b>
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
