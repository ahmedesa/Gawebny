<div class="modal fade" id="m_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">
					Add New Category
				</h5>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{ url('/dashbord/category') }}" >
					@csrf
					<div class="form-group">
						<label class="form-control-label">
							Category Name in English
						</label>
						<input required type="text" name="name_en" class="form-control" >
					</div>
					<div class="form-group">
						<label class="form-control-label">
							Category Name in Arabic
						</label>
						<input required type="text" name="name_ar" class="form-control" >
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							Close
						</button>
						<button type="submit" class="btn btn-primary">
							Save
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>