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
						Add Admin
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
						<th>Email</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
                    foreach ($data_super_users as $data) : ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $data['user_name'] ?></td>
						<td><?= $data['username']?></td>
						<td><?= $data['email'] ?></td>
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
				<h5 class="modal-title" id="exampleModalLongTitle">Add New Admin</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url()?>User_management/add_new_admin" method="post" id="form_create_user">
			<div class="modal-body">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" class="form-control" name="user_name" required maxlength="40" placeholder="Insert Full Name...">
                    </div>
                    <div class="form-row">    
                        <div class="form-group col">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" required maxlength="50" placeholder="Insert Username...">
                        </div>
                        <div class="form-group col">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" required maxlength="25" placeholder="Insert Password...">
                        </div>
                    </div>
                    <div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" name="email" required maxlength="70" placeholder="Insert Email...">
                    </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit"class="btn btn-primary">Submit</button>
			</div>
			</form>
		</div>
	</div>
</div>