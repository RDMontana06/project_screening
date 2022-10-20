<!-- Modal -->
<div class="modal fade" id="buyoutDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Buyout Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="updateBuyoutCompany" method="post">
					{{ csrf_field() }}
					<input type="text" name="project_id" id="hiddenId" value="" hidden>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="companyName">Buyout Company Name <small>(Required)</small></label>
								<input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name"
									required>
							</div>
							<div class="form-group">
								<label for="contactPerson">Buyout Contact Person <small>(Required)</small></label>
								<input type="text" class="form-control" id="contact_person" name="contact_person"
									placeholder="Contact Person" required>
							</div>
							<div class="form-group">
								<label for="contactNumber">Buyout Contact Number <small>(Required)</small></label>
								<input type="text" class="form-control" id="contact_number" name="contact_number"
									placeholder="Contact Number" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="amount">Buyout Total Amount <small>(Required)</small></label>
								<input type="number" class="form-control" step="0.01" min="0.01" id="total_amt" name="total_amt"
									placeholder="0.00">
							</div>
							<div class="form-group">
								<label>Buyout Attachments</label>
								<input type="file" name="attachment" class="form-control">
							</div>
						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-outline-primary">Save changes</button>
			</div>
			</form>
		</div>
	</div>
</div>
