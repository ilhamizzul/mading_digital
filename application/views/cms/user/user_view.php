<div class="card shadow-sm mb-4 border-bottom-primary">
	<div class="card-header bg-white py-3">
		<div class="row">
			<div class="col">
				<h4 class="h5 align-middle m-0 font-weight-bold text-primary">
					Data User
				</h4>
			</div>
			<div class="col-auto">
				<button class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#Insert">
					<span class="icon">
						<i class="fa fa-user-plus"></i>
					</span>
					<span class="text">
						Add User
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
						<th>User Name</th>
						<th>Username</th>
						<th>Role User</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
                    foreach ($data_users as $data) : ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $data['user_name'] ?></td>
						<td><?= $data['username']?></td>
						<td><?= $data['role'] ?></td>
						<td>
							<button
								class="btn btn-circle btn-sm <?= $data['active'] == 'true' ? 'btn-success' : 'btn-secondary' ?>"
								title="<?= $data['active'] == 'true' ? 'Turn Off User Privelege' : 'Turn On User Privelege' ?>" 
								onclick="toggleUser('<?= $data['id_user'] ?>')"
								data-toggle="modal" data-target="#dataToggleActivation"><i class="fa fa-fw fa-power-off"></i></button>
							<!-- <button class="btn btn-circle btn-sm btn-warning" title="Edit User" onclick="" data-toggle="modal"
								data-target="#Edit"><i class="fa fa-fw fa-edit"></i></button> -->
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
				<h5 class="modal-title" id="exampleModalLongTitle">Add New User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url()?>User_management/add_new_user" method="post" id="form_create_user">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" class="form-control" name="user_name">
                    </div>
                    <div class="form-row">    
                        <div class="form-group col">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username">
                        </div>
                        <div class="form-group col">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role">
                            <option value="">Chose...</option>
                            <option value="owner">Owner</option>
                            <option value="admin">Admin</option>
                        </select>
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
				<h5 class="modal-title" id="exampleModalLongTitle"><span class="active_status"></span> User <span class="user_name"></span></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
                <h5 style="text-align:center">Do you really want to <span class="active_status"></span> this user privelege?</h5>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<a href="" id="activate" class="btn btn-primary"><span class="active_status"></span></a>
			</div>
		</div>
	</div>
</div>