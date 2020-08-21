<div class="row pt-5">
	<div class="col mt-5">
		<div class="card text-center border-bottom-info">
			<div class="card-body pt-5">
				<h1 class="card-title mt-5 pt-5">1 Month Package</h1>
                <h3 class="card-title mb-5 pb-5">Rp. 150.000.00,-</h3>
				<p class="card-text">Grant Access for 1 month after purchasing package.</p>
				<button data-toggle="modal" data-target="#purchase_token" onclick="purchaseToken('1month')" class="btn btn-lg btn-info mt-4 mb-4">Purchase</button>
			</div>
		</div>
	</div>
    <div class="col mt-5">
		<div class="card text-center border-bottom-primary">
			<div class="card-body pt-5">
                <h1 class="card-title mt-5 pt-5">3 Months package</h1>
                <h3 class="card-title mb-5 pb-5">Rp. 450.000.00,-</h3>
				<p class="card-text">Grant Access for 3 months after purchasing package.</p>
				<button data-toggle="modal" data-target="#purchase_token" onclick="purchaseToken('3month')" class="btn btn-lg btn-primary mt-4 mb-4">Purchase</button>
			</div>
		</div>
	</div>
    <div class="col mt-5">
		<div class="card text-center border-bottom-success">
            <div class="card-body pt-5">
                <h1 class="card-title mt-5 pt-5">1 Year Package</h1>
                <del><h6 class="text-muted">Rp. 1.800.000.00,-</h6></del>
                <h3 class="card-title mb-5 pb-3">Rp. 1.350.000.00,- <b>25% Off</b></h3>
				<p class="card-text">Grant Access for 1 year with 25% off after purchasing package.</p>
				<button data-toggle="modal" data-target="#purchase_token" onclick="purchaseToken('1year')" class="btn btn-lg btn-success mt-4 mb-4">Purchase</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="purchase_token" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Purchase Token</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" method="post" id="form_create"
				enctype="multipart/form-data">
				<div class="modal-body">
					<h5 class="text-center">Do you really want to purchase this <span class="token_type"></span> Package?</h5>
					<br>
					<div class="form-row">
						<div class="form-group col">
							<label>Telephone Number</label>
							<input type="number" class="form-control" name="no_telp" maxlength="13" required placeholder="Insert Phone Number...">
						</div>
						<div class="form-group col">
							<label>Email</label>
							<input type="email" class="form-control" name="email" maxlength="70" required placeholder="Insert Email...">
						</div>
					</div>
					<small class="form-text text-muted">Please insert active email and phone number for confirmation</small>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Submit</submit>
				</div>
			</form>
		</div>
	</div>
	
</div>