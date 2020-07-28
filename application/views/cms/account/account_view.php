<div class="card shadow-sm mb-4 border-bottom-primary">
	<div class="card-header bg-white py-3">
		<div class="row">
			<div class="col">
				<h4 class="h5 align-middle m-0 font-weight-bold text-primary">
					Data Account User
				</h4>
			</div>
		</div>
	</div>
	<div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <?php if($this->session->userdata('profile_picture') == null): ?>
                        <img class="img-profile rounded-circle img-fluid img-thumbnail w-50 mx-auto d-block" src="<?= base_url() ?>assets/CMS/img/default_user.webp">
                    <?php else: ?>
                        <img class="img-profile rounded-circle img-fluid img-thumbnail w-50 mx-auto d-block" src="<?= base_url() ?>uploads/<?= $this->session->userdata('company_name')?>/user/<?= $data_account['profile_picture'] ?>">
                    <?php endif; ?>
                    <h4 class="h3 text-center mt-2 font-weight-bold text-primary">
                        <?= $data_account['user_name'] ?>
                    </h4>
                </div>
                <div class="col border-left">
                    <h4 class="h5 font-weight-bold text-primary">Avatar</h4>
                    <?php if($data_account['profile_picture'] == null): ?>
                        <img class="img-profile rounded-circle img-fluid img-thumbnail" width="10%" src="<?= base_url() ?>assets/CMS/img/default_user.webp">
                    <?php else: ?>
                        <img class="img-profile rounded-circle img-fluid img-thumbnail" width="10%" src="<?= base_url() ?>uploads/<?= $this->session->userdata('company_name')?>/user/<?= $data_account['profile_picture'] ?>">
                    <?php endif; ?>
                    <button class="ml-2 btn btn-sm btn-primary" data-toggle="modal" data-target="#change_picture">Change Profile Picture</button>
                    <hr>
                    <h4 class="h5 font-weight-bold text-primary">Biodata</h4>
                    <form action="<?= base_url()?>User_account/update_profile" method="post" id="form_update_profile">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-control" value="<?= $data_account['user_name'] ?>" name="user_name">
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" value="<?= $data_account['username'] ?>" name="username">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" value="<?= $data_account['email'] ?>" name="email">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" name="address" rows="3"><?= $data_account['address'] ?></textarea>
                        </div>
                    </form>
                    <hr>
                    <h4 class="h5 font-weight-bold text-primary">Password</h4>
                    <button class="ml-2 btn btn-sm btn-primary" data-toggle="modal" data-target="#change_password">Change Password</button>
                    <hr>
                    <button type="submit" id="btn_update_profile" class="btn btn-primary text-center">Update Profile</button>
                    <a href="<?= base_url() ?>Dashboard" class="btn btn-secondary text-center" >Cancel</a>
                </div>
            </div>
        </div>
	</div>
</div>

<!-- MODAL CHANGE PASSWORD -->
<div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Change New Password</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url()?>User_account/change_password" method="post" id="form_change_password">
                    <div class="form-group">
                        <label>Old Password</label>
                        <input type="password" class="form-control" name="old_password">
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" class="form-control" name="new_password">
                    </div>
                </form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" id="btn_change_password" class="btn btn-primary">Submit</button>
			</div>
		</div>
	</div>
</div>

<!-- MODAL CHANGE PROFILE PICTURE -->
<div class="modal fade" id="change_picture" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Change Profile Picture</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
                <?php if($this->session->userdata('profile_picture') == null): ?>
                    <img class="img-profile rounded-circle img-fluid img-thumbnail w-50 mx-auto d-block" src="<?= base_url() ?>assets/CMS/img/default_user.webp">
                <?php else: ?>
                    <img class="img-profile rounded-circle img-fluid img-thumbnail w-50 mx-auto d-block" src="<?= base_url() ?>uploads/<?= $this->session->userdata('company_name')?>/user/<?= $data_account['profile_picture'] ?>">
                <?php endif; ?>
                <h4 class="h6 text-center mt-2 font-weight-bold text-primary">Current Profile Picture</h4>
				<form action="<?= base_url()?>User_account/change_profile_picture" method="post" id="form_change_picture">
                    <div class="form-group">
                        <label>Upload Profile Picture</label>
                        <input type="file" class="form-control" name="profile_picture">
                    </div>
                </form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" id="btn_change_picture" class="btn btn-primary">Submit</button>
			</div>
		</div>
	</div>
</div>