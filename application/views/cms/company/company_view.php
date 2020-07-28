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
                    <?php if($data_company['company_logo'] == null): ?>
                        <div class="bg-gradient-dark p-5 text-center text-white font-weight-bold">
                            No Image Found
                        </div>
                    <?php else: ?>
                        <img class="img-profile img-fluid img-thumbnail w-75 mx-auto d-block" src="<?= base_url() ?>uploads/<?= $this->session->userdata('company_name')?>/company/<?= $data_company['company_logo'] ?>">
                    <?php endif; ?>
                    <h4 class="h3 text-center mt-2 font-weight-bold text-primary">
                        <?= $data_company['company_name'] ?>
                    </h4>
                </div>
                <div class="col border-left">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">All Users</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_users; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">All Active Users</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_active_users; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h4 class="h5 font-weight-bold text-primary">Logo</h4>
                    <?php if($data_company['company_logo'] == null): ?>
                        <div class="bg-gradient-dark pr-1 pl-1 pt-2 pb-2 text-center text-white w-25 d-inline">
                            No Image Found
                        </div>
                    <?php else: ?>
                        <img class="img-profile img-fluid img-thumbnail" width="20%" src="<?= base_url() ?>uploads/<?= $this->session->userdata('company_name')?>/company/<?= $data_company['company_logo'] ?>">
                    <?php endif; ?>
                    <button class="ml-2 btn btn-sm btn-primary" data-toggle="modal" data-target="#change_logo">Change Logo</button>
                    <hr>
                    <h4 class="h5 font-weight-bold text-primary">Company Profile</h4>
                    <form action="<?= base_url()?>Company_management/update_company" method="post" id="form_update_company">
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" class="form-control" value="<?= $data_company['company_name'] ?>" name="company_name">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" value="<?= $data_company['email'] ?>" name="email">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" name="address" rows="3"><?= $data_company['address'] ?></textarea>
                        </div>
                    </form>
                    <hr>
                    <button type="submit" id="btn_update_company" class="btn btn-primary text-center">Update Company Profile</button>
                    <button onclick="history.back();" class="btn btn-secondary text-center" >Cancel</button>
                </div>
            </div>
        </div>
	</div>
</div>

<!-- MODAL CHANGE COMPANY LOGO -->
<div class="modal fade" id="change_logo" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Change Company Logo</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
                <?php if($data_company['company_logo'] == null): ?>
                    <div class="bg-gradient-dark p-5 text-center text-white font-weight-bold">
                        No Image Found
                    </div>
                <?php else: ?>
                    <img class="img-profile img-fluid img-thumbnail w-50 mx-auto d-block" src="<?= base_url() ?>uploads/<?= $this->session->userdata('company_name')?>/company/<?= $data_company['company_logo'] ?>">
                <?php endif; ?>
                <h4 class="h6 text-center mt-2 font-weight-bold text-primary">Current Company Logo</h4>
				<form action="<?= base_url()?>Company_management/change_company_logo" method="post" id="form_change_logo" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Upload Company Logo</label>
                        <input type="file" class="form-control" name="company_logo">
                    </div>
                </form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" id="btn_change_logo" class="btn btn-primary">Submit</button>
			</div>
		</div>
	</div>
</div>