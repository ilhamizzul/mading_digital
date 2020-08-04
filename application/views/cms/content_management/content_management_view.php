<div class="card shadow-sm mb-4 border-bottom-primary">
	<div class="card-header bg-white py-3">
		<div class="row">
			<div class="col">
				<h4 class="h5 align-middle m-0 font-weight-bold text-primary">
					Client View Management
				</h4>
			</div>
			<div class="col-auto">
				<a href="<?= base_url() ?>Client_view_management/color" class="btn btn-sm btn-primary btn-icon-split">
					<span class="icon">
						<i class="fa fa-brush"></i>
					</span>
					<span class="text">
						Color Library
					</span>
				</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="container">
			<form action="<?= base_url() ?>Client_view_management/update_template" method="post">
				<div class="row mt-4">
					<div class="col">
						<div class="form-group row">
							<label for="colFormLabelLg" class="col-sm-4 col-form-label col-form-label-lg">Navbar view</label>
							<div class="col-sm-8">
                                <select class="form-control form-control-lg" name="navigation_bar">
                                    <option value="true">Show</option>
                                    <option value="false">Hide</option>
                                </select>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="form-group row">
							<label for="colFormLabelLg" class="col-sm-4 col-form-label col-form-label-lg">Footer view</label>
							<div class="col-sm-8">
                                <select class="form-control form-control-lg" name="footer">
                                    <option value="true">Show</option>
                                    <option value="false">Hide</option>
                                </select>
							</div>
						</div>
					</div>
				</div>
                <div class="row mt-4">
					<div class="col">
						<div class="form-group row">
							<label for="colFormLabelLg" class="col-sm-4 col-form-label col-form-label-lg">Schedule view</label>
							<div class="col-sm-8">
                                <select class="form-control form-control-lg" name="schedule">
                                    <option value="true">Show</option>
                                    <option value="false">Hide</option>
                                </select>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="form-group row">
							<label for="colFormLabelLg" class="col-sm-4 col-form-label col-form-label-lg">Carousel view</label>
							<div class="col-sm-8">
                                <select class="form-control form-control-lg" name="carousel">
                                    <option value="true">Show</option>
                                    <option value="false">Hide</option>
                                </select>
							</div>
						</div>
					</div>
				</div>
                <button type="submit" class="btn btn-lg btn-primary mx-auto d-block mt-2">Submit Template</button>
			</form>
		</div>
	</div>
</div>
