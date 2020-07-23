<div class="card shadow-sm mb-4 border-bottom-primary">
	<div class="card-header bg-white py-3">
		<div class="row">
			<div class="col">
				<h4 class="h5 align-middle m-0 font-weight-bold text-primary">
					Data Carousel
				</h4>
			</div>
			<div class="col-auto">
				<button class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#Insert">
					<span class="icon">
						<i class="fa fa-plus"></i>
					</span>
					<span class="text">
						Add New Data
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
						<th>Data Carousel</th>
						<th>Title</th>
						<th>Description</th>
						<th>Data Type</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
                    foreach ($data_carousel as $data) : ?>
					<tr>
						<td><?= $no++ ?></td>
						<td>
							<?php if($data['data_type'] == 'image') : ?>
							<img src="<?= base_url() ?>uploads/<?= $this->session->userdata('company_name')?>/carousel/image/<?= $data['data_carousel'] ?>"
								style="max-width: 200px; height: auto;" alt="" srcset="">
							<?php else : ?>
							<video width="250" height="auto" controls>
								<source
									src="<?= base_url() ?>uploads/<?= $this->session->userdata('company_name')?>/carousel/video/<?= $data['data_carousel'] ?>"
									type="video/mp4">
							</video>
							<?php endif; ?>
						</td>
						<td><?= $data['title']?></td>
						<td><?= $data['description'] ?></td>
						<td><?= $data['data_type'] ?></td>
						<td>
							<button
								class="btn btn-circle btn-sm <?= $data['active'] == 'true' ? 'btn-success' : 'btn-secondary' ?>"
								title="<?= $data['active'] == 'true' ? 'Hide Data Carousel' : 'Show Data Carousel' ?>"
								onclick="toggleCarousel('<?= $data['id_carousel'] ?>')" data-toggle="modal"
								data-target="#dataToggleActivation"><i class="fa fa-fw fa-power-off"></i></button>
							<button class="btn btn-circle btn-sm btn-warning" title="Edit Carousel" onclick=""
								data-toggle="modal" data-target="#Edit"><i class="fa fa-fw fa-edit"></i></button>
							<button
								class="btn btn-circle btn-sm <?= ($data['active'] == 'true') ? 'btn-secondary' : 'btn-danger'?>"
								title="Delete Carousel" <?= ($data['active'] == 'true') ? 'disabled' : ''?> onclick="deleteCarousel('<?= $data['id_carousel'] ?>')"
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
				<h5 class="modal-title" id="exampleModalLongTitle">Add New Carousel</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url()?>Carousel/add_new_carousel" method="post" id="form_create"
					enctype="multipart/form-data">
					<div class="form-group">
						<label>Title</label>
						<input type="text" class="form-control" name="title">
					</div>
					<div class="form-group">
						<label>Description</label>
						<textarea class="form-control" name="description" rows="3"></textarea>
					</div>
					<div class="form-row">
						<div class="form-group col">
							<label>Upload File</label>
							<input type="file" class="form-control" name="data_carousel">
						</div>
						<div class="form-group col">
							<label>Data Type</label>
							<select class="form-control" name="data_type">
								<option value="">Chose...</option>
								<option value="image">Image</option>
								<option value="video">Video</option>
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
<!-- <div class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Edit Data User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="" method="post">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" class="form-control" id="user_name" name="user_name">
                    </div>
                    <div class="form-row">    
                        <div class="form-group col">
                            <label>Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="form-group col">
                            <label>Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select id="role" class="form-control" name="role">
                            <option value="">Chose...</option>
                            <option value="owner">Owner</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Submit</button>
			</div>
		</div>
	</div>
</div> -->

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

<!-- MODAL DELETE -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Delete Carousel</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<h5 style="text-align:center">
					Are you sure you want to delete this Carousel? <br>
					<b><span class="id_carousel"></span></b>
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
